<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_jawards' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}


// Language:
if (file_exists($mosConfig_absolute_path."/administrator/components/com_jawards/language/".$mosConfig_lang.".php"))
	include_once($mosConfig_absolute_path."/administrator/components/com_jawards/language/".$mosConfig_lang.".php");
else 
	include_once($mosConfig_absolute_path."/administrator/components/com_jawards/language/english.php");
	

require_once( $mainframe->getPath( 'admin_html' ) );
require_once( $mainframe->getPath( 'class' ) );

$showallusers = mosGetParam($_REQUEST, 'showallusers', '');
$cid = mosGetParam( $_REQUEST, 'cid', array(0) );
$sortby = mosGetParam( $_REQUEST, 'sortby',"date");
define('JA_JABSPATH',$mainframe->getCfg( 'absolute_path' ));
define('JA_MEDABSPATH',JA_JABSPATH.'/images/medals');

if (!is_array( $cid )) {
	$cid = array($cid);
}
switch ($task) {
	
	// Config:
	case 'showconfig':
		showConfig($option);
		break;
	case 'saveconfig':
		saveConfig($option);
		break;
	
		
	//Medal Management events

	case 'newmedal':
		editMedal(null, $option );
		break;

	case 'editmedal':
		editMedal( $cid[0], $option );
		break;

	case 'editmedalA':
		editMedal( $cid[0], $option );
		break;

	case 'savemedal':
		saveMedal( $option );
		break;

	case 'cancelmedal':
		cancelEditMedal( $option );
		break;

	case 'listmedals':
		viewMedals( $option );
		break;
		
	case 'removemedal':
		removeMedal($cid, $option);
		break;
		
    case 'orderup':
    	reorder($cid[0], -1, $option);
		break;
    
	case 'orderdown':
		reorder($cid[0], 1, $option);
		break;
            
	case 'saveorder':
		saveOrder($cid, $option);
		break;

	case 'upload':
		HTML_medals::showUploadsForm($option);
		break;
	
	case 'uploadMedalImage':
		uploadFile($option);
		break;

	// Award Management Events

	case 'new':
		editAward( null, $option, $showallusers );
		break;

	case 'cancel':
		cancelEditAward();
		break;

	case 'save':
		saveAward( $task );
		break;

	case 'edit':
		editAward( $cid[0], $option, true );
		break;

	case 'editA':
		editAward( $cid[0], $option );
		break;

	case 'remove':
		removeAward( $cid );
		break;
		
	case 'massaward':
		massAward($option);
		break;
		
	case 'mass_save':
		saveMassAward($task);
		break;

	case 'list':
	default:
		viewAwards( $option, $sortby);
		break;
}

function showConfig( $option ) {
	include_once( "components/com_jawards/config.jawards.php" );
	
	$lists = array();	
	// make a standard yes/no list
	$yesno = array();
	$yesno[] = mosHTML::makeOption( '0', _AWARDS_NO );
	$yesno[] = mosHTML::makeOption( '1', _AWARDS_YES );
	
	$exampleDate = "2008-02-28";
	$dateformat = array();
	$dateformat[] = mosHTML::makeOption('%Y-%m-%d', strftime('%Y-%m-%d',strtotime($exampleDate)));
	$dateformat[] = mosHTML::makeOption('%d.%m.%Y', strftime('%d.%m.%Y',strtotime($exampleDate)));
	$dateformat[] = mosHTML::makeOption('%d-%m-%Y', strftime('%d-%m-%Y',strtotime($exampleDate)));
	$dateformat[] = mosHTML::makeOption('%m/%d/%Y', strftime('%m/%d/%Y',strtotime($exampleDate)));
	$dateformat[] = mosHTML::makeOption('%B %d %Y', strftime('%B %d %Y',strtotime($exampleDate)));
	$dateformat[] = mosHTML::makeOption('%d. %B %Y', strftime('%d. %B %Y',strtotime($exampleDate)));

	
	$lists['showawardReason'] = mosHTML::selectList( $yesno, 'cfg_showawardreason', 'class="inputbox" size="1"', 'value', 'text', $ja_config['showawardreason'] );
	$lists['showcredits'] = mosHTML::selectList( $yesno, 'cfg_showcredits', 'class="inputbox" size="1"', 'value', 'text', $ja_config['showcredits'] );
	$lists['cbIntegration'] = mosHTML::selectList( $yesno, 'cfg_cbintegration', 'class="inputbox" size="1"', 'value', 'text', $ja_config['cbintegration'] );
	$lists['groupawards'] = mosHTML::selectList( $yesno, 'cfg_groupawards', 'class="inputbox" size="1"', 'value', 'text', $ja_config['groupawards'] );
	$lists['introtext'] = "<textarea class=\"inputbox\" cols=\"70\" rows=\"5\" name=\"cfg_introtext\">" .$ja_config['introtext'] ."</textarea>";
	$lists['number_medals'] = "<input type=\"text\" size=\"3\" maxlength=\"3\" name=\"cfg_number_medals\" value=\"".$ja_config['number_medals'] ."\" />";
	$lists['number_users'] = "<input type=\"text\" size=\"3\" maxlength=\"3\" name=\"cfg_number_users\" value=\"".$ja_config['number_users'] ."\" />";
	$lists['date_format'] = mosHTML::selectList( $dateformat, 'cfg_dateformat', 'class="inputbox" size="1"', 'value', 'text', $ja_config['dateformat'] );
	
	HTML_awards::config($ja_config, $lists, $option);
	
	
}


function saveConfig ( $option ) {
	
   //Add code to check if config file is writeable.
   $configfile = "components/com_jawards/config.jawards.php";
   @chmod ($configfile, 0766);
   if (!is_writable($configfile)) {
      mosRedirect("index2.php?option=$option", "FATAL ERROR: Config File  $configfile Not writeable" );
   }

   $txt = "<?php\n";
   foreach ($_POST as $k=>$v) {
   	  if (is_array($v)) $v = implode("|*|", $v);
      if (strpos( $k, 'cfg_' ) === 0) {
         if (!get_magic_quotes_gpc()) {
            $v = addslashes( $v );
         }
         $txt .= "\$ja_config['".substr( $k, 4 )."']='$v';\n";
      }
   }
   $txt .= "?>";

   if ($fp = fopen( $configfile, "w")) {
      fputs($fp, $txt, strlen($txt));
      fclose ($fp);
      mosRedirect( "index2.php?option=$option&task=showconfig", "Configuration file saved" );
   } else {
      mosRedirect( "index2.php?option=$option", "FATAL ERROR: File could not be opened." );
   }
}

function viewAwards( $option, $sortby="date") {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	
	// Input from Search field:
	$search = $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
    	$search = $database->getEscaped( trim( strtolower( $search ) ) );
    	
    	// Input from medal filtering list:
    	$medal_id = intval($mainframe->getUserStateFromRequest( "medals_filter", 'medals_filter', 0 ));

	// get the total number of records:
	$query = "SELECT COUNT(*)"
	. "\n FROM #__jawards_awards AS a"
	. "\n LEFT JOIN #__users AS u ON a.userid = u.id";
	if ($search) {
    		$query .= "\n WHERE LOWER(u.username) LIKE '%$search%' ";
		if ($medal_id)
			$query .= "\n AND a.award = $medal_id";
		
	}
	else if ($medal_id)
		$query .= "\n WHERE a.award = $medal_id";
	$database->setQuery( $query );
	
	$total = $database->loadResult();
	
	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );
	
	// Ordering the results:
	switch ($sortby){
		case "user":	$order = "u.username";
				break;
		
		case "award":	$order = "m.name";
				break;
		
		case "date":
		default:	$order = "a.date DESC";
		// u.username, m.name
	}

	// Constructing the main query:
	$query = "SELECT a.*, m.image, m.name, u.username"
	. "\n FROM #__jawards_awards AS a "
	. "\n LEFT JOIN #__jawards_medals AS m ON a.award = m.id"
	. "\n LEFT JOIN #__users AS u ON a.userid = u.id";
	
	// A username is searched for in the input field:
	if ($search) {
    		$query .= "\n WHERE LOWER(u.username) LIKE '%$search%' ";
		if ($medal_id)
			$query .= "\n AND a.award = $medal_id";
	}
	else if ($medal_id)
		$query .= "\n WHERE a.award = $medal_id";
		
	$query.= "\n ORDER BY $order"
	.	"\n LIMIT $pageNav->limitstart, $pageNav->limit";
	
	$database->setQuery( $query );

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();
	
	// get list of Medals for dropdown filter
	$query = "SELECT m.id AS value, m.name AS text, m.ordering"
	. "\n FROM #__jawards_medals AS m"
	. "\n ORDER BY m.ordering,m.name"
	;
	
	$medals_dropdown[] = mosHTML::makeOption( '0', " - "._AWARDS_ADM_SELECT_MEDAL." - " );
	$database->setQuery( $query );
	$medals_dropdown = array_merge( $medals_dropdown, $database->loadObjectList() );

	$lists['medals'] = mosHTML::selectList( $medals_dropdown, 'medals_filter', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $medal_id );
	HTML_awards::showAwards( $rows, $pageNav, $option, $search, $lists );
}

function removeAward( $cid ) {
	global $database;
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$query = "DELETE FROM #__jawards_awards"
		. "\n WHERE id IN ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	mosRedirect( 'index2.php?option=com_jawards' );
}

function editAward( $awardid, $option, $showallusers=false ) {
	global $database, $my;
	mosCommonHTML::loadOverlib();
	$lists = array();

	$row = new mosAward($database);
	$row->load( $awardid );
	
	// Build User select list
	$sql	= "SELECT id as value,username as text"
	. "\n FROM #__users"
	. "\n ORDER BY username";

	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}
	
	$userlist = array();
	$userslist[] 	= mosHTML::makeOption( '0', _AWARDS_ADM_SELECT_USER, 'value', 'text' );
	$userslist 	= array_merge( $userslist, $database->loadObjectList() );
	$lists['users'] = mosHTML::selectList( $userslist, 'userlist', 'class="inputbox" size="1" onChange="javascript:document.adminForm.userid.value=document.adminForm.userlist.value;"','value', 'text', $row->userid);

	// Build Medal select list
	$sql	= "SELECT id,name"
	. "\n FROM #__jawards_medals"
	. "\n ORDER BY ordering,name";
	
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}
	
	$medalslist = array();
	$medalslist[] 	= mosHTML::makeOption( '0', _AWARDS_ADM_SELECT_MEDAL, 'id', 'name' );
	$medalslist 	= array_merge( $medalslist, $database->loadObjectList());
	$lists['medals'] 	= mosHTML::selectList( $medalslist, 'award', 'class="inputbox" size="1" onChange="javascript:changeDefaultReason()"','id', 'name', $row->award);
	
	// Build Reason list
	$sql	= "SELECT id,default_reason"
	. "\n FROM #__jawards_medals"
	. "\n ORDER BY id";
	
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}
	
	$reasonlist = array();
	$reasonrows = $database->loadObjectList();
	foreach ($reasonrows as $reason) {
		$reasonlist[$reason->id] = $reason->default_reason;
	}
	$lists['reason'] = $reasonlist;
	
  	HTML_awards::awardForm( $row, $lists, $option, $showallusers );
}
function massAward($option){
	global $database;
	mosCommonHTML::loadOverlib();
	
	$lists = array();
	
	// Build User select list
	$sql	= "SELECT id as value,username as text"
	. "\n FROM #__users"
	. "\n ORDER BY username";

	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}

	$userslist 	= $database->loadObjectList();
	$seluserslist = array();
	$lists['users'] = mosHTML::selectList( $userslist, 'userlist', 'class="inputbox" multiple="true" size="20" width="150px"','value', 'text', '');
	$lists['selusers'] = mosHTML::selectList( $seluserslist, 'seluserlist[]', 'class="inputbox" multiple="true" size="20" width="150px"','value', 'text', '');
	
	
	
	// Build Medal select list
	$sql	= "SELECT *"
	. "\n FROM #__jawards_medals"
	. "\n ORDER BY ordering,name";
	
	
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}

	$medalslist[] 	 = mosHTML::makeOption( '0', _AWARDS_ADM_SELECT_MEDAL, 'id', 'name' );
	$medalslist 	 = array_merge( $medalslist, $database->loadObjectList() );
	$lists['medals'] = mosHTML::selectList( $medalslist, 'award', 'class="inputbox" size="1" onChange="javascript:changeDefaultReason()"','id', 'name','');

	
		// Build Reason list
	$sql	= "SELECT id,default_reason"
	. "\n FROM #__jawards_medals"
	. "\n ORDER BY id";
	
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}
	
	$reasonlist = array();
	$reasonrows = $database->loadObjectList();
	foreach ($reasonrows as $reason) {
		$reasonlist[$reason->id] = $reason->default_reason;
	}
	$lists['reason'] = $reasonlist;
	
  	HTML_awards::massAwardForm($lists, $option);

}


function saveMassAward( $task ) {
	global $database;

	$userids = mosGetParam($_POST, 'seluserlist', array());
	$awardid = intval(mosGetParam($_POST, 'award', ''));
	$reason = $database->getEscaped(mosGetParam($_POST, 'reason'));
	$date = $database->getEscaped(mosGetParam($_POST, 'date'));

	$numusers = count($userids);
	$msg = "Saved Awards for $numusers.";
	
	// inserting query:
	$sql = "INSERT INTO #__jawards_awards (userid, award,date,reason) \n VALUES ";
	
	for($i=0; $i< $numusers; $i++){
		$userid = intval($userids[$i]);
		$sql .= ("('$userid','$awardid', '$date', '$reason')");
		if ($i < $numusers-1)
			$sql .= ", ";
	
	}
	
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}
		
  	mosRedirect( 'index2.php?option=com_jawards', $msg );
}

function saveAward( $task ) {
	global $database;

	$row = new mosAward($database);

	$msg = 'Saved Award info';
	
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	mosRedirect( 'index2.php?option=com_jawards', $msg );
}

function cancelEditAward() {
	global $database;

	$row = new mosAward($database);
	$row->bind( $_POST );
	mosRedirect( 'index2.php?option=com_jawards' );
}



// ---------- MEDAL MANAGEMENT ----------

function viewMedals( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit );
	$limitstart = $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 );
	
	$search = $mainframe->getUserStateFromRequest( "medalsearch{$option}", 'medalsearch', '' );
    $search = $database->getEscaped( trim( strtolower( $search ) ) );
	
	// get the total number of records
	$query = "SELECT COUNT(*)"
	. "\n FROM #__jawards_medals";
	if ($search) {
    	$query .= "\n WHERE LOWER(#__jawards_medals.name) LIKE '%$search%' ";
	}
	
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once("includes/pageNavigation.php");
	$pageNav = new mosPageNav( $total, $limitstart, $limit );

	$sql = "SELECT *"
	. "\n FROM #__jawards_medals as m";
	
	if ($search) {
    	   $sql .= "\n WHERE LOWER(m.name) LIKE '%$search%' ";
	}
	$sql .= "\n ORDER BY m.ordering,m.name";
	$sql .= "\n LIMIT $pageNav->limitstart, $pageNav->limit";
	
	$database->setQuery($sql);

	if(!$result = $database->query()) {
		echo $database->stderr();
		return;
	}
	$rows = $database->loadObjectList();

	HTML_Medals::showMedals( $rows, $pageNav, $option, $search );
}

function editMedal( $id, $option ) {
	global $database, $my;

	$row = new mosMedal($database);
	$row->load($id);
	
	// Imagelist
	$javascript 	= 'onchange="changeDisplayImage();"';
	$directory 		= '/images/medals';
	$lists['image'] = mosAdminMenus::Images( 'image', $row->image, $javascript, $directory );

	HTML_Medals::medalForm( $row, $lists, $option );
}

function saveMedal($option) {
	global $database;

	$row = new mosMedal( $database );
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if(!$row->id){
            $row->ordering = 999999999;
        }
	if (!$row->check()) {
		mosRedirect( "index2.php?option=$option&task=editclient&cid[]=$row->id", $row->getError() );
	}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	$row->updateOrder();
	$row->checkin();
	$msg = 'Saved Medal info';
	mosRedirect( "index2.php?option=$option&amp;task=listmedals",$msg );
}

function cancelEditMedal( $option ) {
	global $database;
	$row = new mosMedal( $database );
	$row->bind( $_POST );
	
	mosRedirect( "index2.php?option=$option&amp;task=listmedals" );
}

function reorder($id, $direction, $option){
    global $database;
    
    $row = new mosMedal($database);
    $row->load($id);
    
    $row->move($direction);
    
    mosRedirect("index2.php?option=$option&amp;task=listmedals");
}

function saveOrder($cid, $option){
    global $database;
    
    $order = mosGetParam( $_POST, 'order', array(0) );
    $row = new mosMedal($database);
    $conditions = array();
    
    for($i=0,$n=count($cid);$i<$n;$i++){
        $row->load($cid[$i]);
			
        if ($row->ordering != $order[$i]) {
			$row->ordering = $order[$i];
				
            if (!$row->store()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
				exit();
            }

        }
        
        $row->updateOrder();
	}

	mosRedirect("index2.php?option=$option&task=listmedals");
}
  
function uploadFile ( $option ) {

	// check for upload errors:
	if ($_FILES["medal_file"]["error"] > 0){
		mosRedirect( "index2.php?option=$option&amp;task=showconfig&amp;task=listmedals", "UPLOAD ERROR: " . $_FILES["medal_file"]["error"] );
	} else {
		$upload_path = JA_MEDABSPATH.'/'.$_FILES["medal_file"]["name"];
		
		if (file_exists($upload_path)){
      			mosRedirect( "index2.php?option=$option&amp;task=showconfig&amp;task=listmedals", "UPLOAD ERROR: File ".$upload_path ."already exists");
      		}
    		else  {
			move_uploaded_file($_FILES["medal_file"]["tmp_name"], $upload_path);
			@chmod ($upload_path, 0777);
			mosRedirect( "index2.php?option=$option&amp;task=showconfig&amp;task=listmedals", "Successfully uploaded. ");
      		}

	}

}

function removeMedal( $cid ) {
	global $database;
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		
		// Check for existing awards with a medal to be deleted:
		$checkQuery = "SELECT COUNT(*) FROM #__jawards_awards"
			."\n WHERE award IN ($cids)";
		$database->setQuery($checkQuery);
		$numberOfAwards = $database->loadResult();

		
		if ($numberOfAwards > 0){
			mosRedirect( 'index2.php?option=com_jawards',"No Medal deleted! There are still $numberOfAwards awards associated to the medals you wanted to delete. Please delete them first." );		
		}
		else{
			
		
			$query = "DELETE FROM #__jawards_medals"
			. "\n WHERE id IN ( $cids )";
			
			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
			mosRedirect( 'index2.php?option=com_jawards&task=listmedals','Selected Medals deleted!' );
		}
	}
	
}





?>