<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License :
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class jAwardsInterface{
	var $_itemId = NULL;

	function jAwardsInterface(){

	}

	/**
	 * Adds a medal to the list of available medals
	 * 
	 * @param $name string Name of the medal
	 * @param $image string Filename of medal image
	 * @param $description string Descritpion text
	 * @param $defaultReason string Default reason for medal
	 * @return integer ID of newly created medal (0 when an error occured)
	 */
	function addMedal($name, $image, $description="", $defaultReason = ""){
		global $database;
		$name = $database->getEscaped($name);
		$image = $database->getEscaped($image);
		$description = $database->getEscaped($description);
		$defaultReason = $database->getEscaped($defaultReason);
		
		$query = "INSERT INTO #__jawards_medals 
					(name, image, desc_text, default_reason)	
		VALUES ('$name','$image', '$description','$defaultReason')";
		$database->setQuery($query);
    	if (!$database->query()) {
      		echo "<script> alert('".$database->getErrorMsg()."'); </script>n";
      		return false;
    	}
    	
    	$query = "SELECT id FROM #__jawards_medals WHERE
    			name = $name AND
				image = $image AND
				desc_text = $description AND
				default_reason = $defaultReason";
		
		return $database->loadResult(); 
	}
	
	/**
	 * Awards a user with a medal
	 * 
	 * @param $userId integer ID of user
	 * @param $medalId integer ID of medal
	 * @param $date string date (empty string, default: current)
	 * @param $reason string reason for medal (empty string, default: use def. reason from medal
	 * @return bool success
	 */
	function addAward($userId, $medalId, $date = "", $reason = ""){
		global $database;
		$userId = intval($userId);
		$medalId = intval($medalId);
		$date = $database->getEscaped($date);
		$reason = $database->getEscaped($reason);
		
		if ($date = ""){
			$date = date( 'Y-m-d' );
		}
		
		if ($reason == ""){ // use default
			$query = "SELECT default_reason FROM #__jawards_medals WHERE id = $medalId";
			$reason = $database->loadResult(); 
		}
		
		$query = "INSERT INTO #__jawards_medals 
					(userid, award, date, reason)
					VALUES ($userId, $medalId, $date, $reason)";
		$database->setQuery($query);
    	if (!$database->query()) {
      		echo "<script> alert('".$database->getErrorMsg()."'); </script>n";
      		return false;
    	}
		return true;
	}
	
	/**
	 * Deletes all awards of id $medalId from user with ID $userId
	 * 
	 * @param $userId integer ID of user
	 * @param $medalId integer ID of medal
	 * @return bool success
	 */
	function delAwardFromUser($userId, $medalId){
		global $database;
		$userId = intval($userId);
		$medalId = intval($medalId);
		
		$query = "DELETE FROM #__jawards_awards
					WHERE userid = $userId
					AND awards = $medalId";
		
		$database->setQuery($query);
    	if (!$database->query()) {
      		echo "<script> alert('".$database->getErrorMsg()."'); </script>n";
      		return false;
    	}
		return true;
	}
	
	/**
	 * Deletes a medal
	 * 
	 * @param $medalId integer ID of medal
	 * @return bool success
	 */
	function delMedal($medalId){
		global $database;
		$medalId = intval($medalId);
		
		$query = "DELETE FROM #__jawards_medals
					WHERE id = $medalId";
		
		$database->setQuery($query);
    	if (!$database->query()) {
      		echo "<script> alert('".$database->getErrorMsg()."'); </script>n";
      		return false;
    	}
		return true;
	}
	
	/**
	 * Returns the number of awards of a user (e.g. for pagination)
	 * @param $userId integer ID of user
	 * @return integer
	 */
	function getNumAwardsUser($userId){
		global $database;
		$userId = intval($userId);
		
		// TODO: grouping
		$query = "SELECT count (id) FROM #__jawards_awards WHERE userid = $userId";
		$database->setQuery($query);
    	if (!$database->query()) {
      		echo "<script> alert('".$database->getErrorMsg()."'); </script>n";
      		exit();
    	}
    	return $database->loadResult(); 
	}
	
	/**
	 * Returns the awards of a user
	 * 
	 * @param $userId integer Joomla ID of user
	 * @param $sorting string DB-sorting string
	 * @param $numRows integer number of rows to return (pagination)
	 * @param $limitStart string where to start (pagination)
	 * @return db-rows
	 */
	function getAwardsUser($userId, $sorting, $numRows = NULL, $limitStart = 0){
		global $database;
	    // validation:
    	$userId = intval($userId);
    	$sorting = $database->getEscaped($sorting);    
    	if (is_null($numRows)){ // no limit given: return all pictures
      		$limit = "";
    	} else{
      		$limitStart = intval($limitStart);
      		$numRows = intval($numRows);
      		$limit = "\n LIMIT ".$limitStart.",".$numRows;
    	}
    	
    	// TODO: query..
    	
    	return false;
	}

	/**
	 * Fetches ItemID of jAwards from a Menu Item in the DB
	 * and constructs "&ItemID=X"-Link from it. To prevent malformed
	 * URLs e.g. for SEF, an empty string is returned if no valid
	 * ItemID can be found in the database.
	 *
	 * @return string
	 */
	function getItemId() {
		global $database;
		if (!isset($this->_itemId) || is_null($this->_itemId)){
			$database->setQuery("SELECT id FROM #__menu WHERE link LIKE '%com_jawards%' AND access='0' ORDER BY id DESC Limit 1");
			$Itemid= $database->loadResult();
			if ($Itemid=='' || $Itemid==NULL) {
				$database->setQuery("SELECT id FROM #__menu WHERE link LIKE '%com_jawards%' AND access='1' ORDER BY id DESC Limit 1");
				$Itemid = $database->loadResult();
			}
			$Itemid = ($Itemid=="" || $Itemid==NULL) ? "" : "&Itemid=".$Itemid;
			 
			$this->_itemId = $Itemid;
		}
		return $this->_itemId;
	}
}



?>