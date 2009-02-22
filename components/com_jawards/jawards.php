<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/
 
// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mainframe, $mosConfig_absolute_path, $ja_config;

require_once($mainframe->getPath('front_html'));
require_once($mainframe->getPath('class'));
require_once($mosConfig_absolute_path."/includes/pageNavigation.php");

// Language:
if (file_exists($mosConfig_absolute_path."/administrator/components/com_jawards/language/".$mosConfig_lang.".php"))
        include_once($mosConfig_absolute_path."/administrator/components/com_jawards/language/".$mosConfig_lang.".php");
else 
        include_once($mosConfig_absolute_path."/administrator/components/com_jawards/language/english.php");
// config file:
require_once($mosConfig_absolute_path."/administrator/components/com_jawards/config.jawards.php");

$award = intval(mosGetParam( $_GET, 'award' , '' ));
$Itemid = intval( mosGetParam( $_REQUEST, 'Itemid', '' ));
$limit_medals = intval(mosGetParam($_REQUEST, 'limit', mosGetParam($_POST, 'limit', $ja_config['number_medals'])));
$limit_users = intval(mosGetParam($_REQUEST, 'limit', mosGetParam($_POST, 'limit', $ja_config['number_users'])));
$limitstart = intval(mosGetParam($_REQUEST, 'limitstart', mosGetParam($_POST, 'limitstart', 0)));
$option 		= mosGetParam( $_REQUEST, 'option', mosGetParam( $_POST, 'option', 'com_jawards' ));

//check if the Itemid is set correctly
if ($Itemid==0 or $Itemid == "") {
	$database->setQuery("SELECT id from #__menu WHERE link='index.php?option=com_jawards'");
	$Itemid=$database->loadResult();
}

switch ($task) {

	case "listusers":
		listUsers($award, $option, $limit_users, $limitstart);
		break;

	default:
		view($Itemid, $option, $limit_medals, $limitstart);
		break;
}


function view($Itemid, $option, $limit, $limitstart=0) {
	global $database, $mainframe;
	
	// get number of medals for pagination:
	$query = "SELECT COUNT(*) FROM #__jawards_medals";
	$database->setQuery($query);
	$total = $database->loadResult();

	$query = "SELECT a.*, COUNT(b.award) AS count FROM #__jawards_medals AS a"
		. " \n LEFT OUTER JOIN #__jawards_awards AS b"
		. " \n ON a.id=b.award"
		. " \n GROUP BY a.id"
		. "\n ORDER BY a.ordering,a.name"
		. " \n LIMIT $limitstart,$limit";
	
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$rows = $database->loadObjectList();

	$query = "SELECT * FROM #__menu WHERE id='$Itemid'";
	$database->setQuery($query);
	$menuItem = $database->loadObjectList();

    $pageNav = new mosPageNav($total, $limitstart, $limit);
	HTML_jAwards::displayAwards($rows, $menuItem[0], $option, $pageNav);
}

function listUsers($award, $option, $limit, $limitstart=0) {
	global $database, $mainframe, $ja_config;
        
    $grouping = $ja_config['groupawards'];
    // get number of users for pagination:
    $query = "SELECT COUNT(";
    if ($grouping)
        $query .= "DISTINCT ";
    $query .="userid) FROM #__jawards_awards" 
                . "\n WHERE award = $award";
        
	$database->setQuery($query);
	$total = $database->loadResult();

	// Load the users:
	$selname = ($ja_config['realname'])?"u.name as username":"u.username";
	$query = "SELECT ua.*,$selname, u.id AS userid";
	if ($grouping)
		$query .=", COUNT(ua.userid) AS count";
	$query .= " FROM #__jawards_awards as ua"
	. "\n LEFT JOIN #__users AS u ON u.id = ua.userid"
	. "\n WHERE ua.award = $award";
	if ($grouping)
		$query .= "\n GROUP BY u.id";
	
	$query .= "\n ORDER BY username"
		. " \n LIMIT $limitstart,$limit";
		
	$database->setQuery( $query );
	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	$rows = $database->loadObjectList();
	
	// Load Award details:
	$query = "SELECT * FROM #__jawards_medals WHERE id=$award";
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return false;
	}
	
	$awardres = $database->loadObjectList();
	$pageNav = new mosPageNav($total, $limitstart, $limit);
	HTML_jAwards::showUsers($rows, $awardres[0], $option, $pageNav);

}

?>