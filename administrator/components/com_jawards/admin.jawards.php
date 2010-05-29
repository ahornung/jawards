<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Ported to Joomla 1.5 native by Chris Lehr @ http://www.housemanticore.com
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined('_JEXEC') or die('Restricted access');

// config:	
global $jAwards_Config;
global $database; 

require_once(JPATH_COMPONENT.DS."config.jawards.php");
	
require_once( JApplicationHelper::getPath( 'admin_html' ) );
require_once( JApplicationHelper::getPath( 'class' ) );

$showallusers = JRequest::getVar( 'showallusers', '');
$cid = JRequest::getVar( 'cid', array(0) );
$sortby = JRequest::getVar( 'sortby',"date");
$task = JRequest::getVar( 'task', null);

define('JA_JABSPATH',JPATH_ROOT);
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
	global $jAwards_Config;
	
	$jAwards_Config['number_medals'] = intval($jAwards_Config['number_medals']);
	$jAwards_Config['number_users'] = intval($jAwards_Config['number_users']);
	if ($jAwards_Config['number_medals'] < 1)
		$jAwards_Config['number_medals'] = 15;
		
	if ($jAwards_Config['number_users'] < 1)
		$jAwards_Config['number_users'] = 15;
	
	$lists = array();	
	// make a standard yes/no list
	$yesno = array();
	$yesno[] = JHTML::_('select.option', '0', JText::_('AWARDS_NO') );
	$yesno[] = JHTML::_('select.option', '1', JText::_('AWARDS_YES') );
	
	$exampleDate = "2008-02-28";
	$dateformat = array();
	$dateformat[] = JHTML::_('select.option','%Y-%m-%d', strftime('%Y-%m-%d',strtotime($exampleDate)));
	$dateformat[] = JHTML::_('select.option','%d.%m.%Y', strftime('%d.%m.%Y',strtotime($exampleDate)));
	$dateformat[] = JHTML::_('select.option','%d-%m-%Y', strftime('%d-%m-%Y',strtotime($exampleDate)));
	$dateformat[] = JHTML::_('select.option','%m/%d/%Y', strftime('%m/%d/%Y',strtotime($exampleDate)));
	$dateformat[] = JHTML::_('select.option','%B %d %Y', strftime('%B %d %Y',strtotime($exampleDate)));
	$dateformat[] = JHTML::_('select.option','%d. %B %Y', strftime('%d. %B %Y',strtotime($exampleDate)));

	
	$lists['showawardReason'] = JHTML::_('select.genericlist', $yesno, 'cfg_showawardreason', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['showawardreason'] );
	
	$lists['showcredits'] = JHTML::_('select.genericlist', $yesno, 'cfg_showcredits', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['showcredits'] );
	
	$lists['cbIntegration'] = JHTML::_('select.genericlist', $yesno, 'cfg_cbintegration', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['cbintegration'] );
	
	$lists['emailUsers'] = JHTML::_('select.genericlist', $yesno, 'cfg_emailusers', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['emailusers'] );
	
	$lists['realname'] = JHTML::_('select.genericlist', $yesno, 'cfg_realname', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['realname'] );
	
	$lists['groupawards'] = JHTML::_('select.genericlist', $yesno, 'cfg_groupawards', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['groupawards'] );
	
	$lists['introtext'] = "<textarea class=\"inputbox\" cols=\"70\" rows=\"5\" name=\"cfg_introtext\">" .$jAwards_Config['introtext'] ."</textarea>";
	
	$lists['number_medals'] = "<input type=\"text\" size=\"3\" maxlength=\"3\" name=\"cfg_number_medals\" value=\"".$jAwards_Config['number_medals'] ."\" />";
	
	$lists['number_users'] = "<input type=\"text\" size=\"3\" maxlength=\"3\" name=\"cfg_number_users\" value=\"".$jAwards_Config['number_users'] ."\" />";
	
	$lists['date_format'] = JHTML::_('select.genericlist', $dateformat, 'cfg_dateformat', 'class="inputbox" size="1"', 'value', 'text', $jAwards_Config['dateformat'] );
	
	//Class Call on admin.jawards.html.php
	HTML_awards::config($jAwards_Config, $lists, $option);
}


function saveConfig ( $option ) {
	global $mosConfig_absolute_path;
	$saveConfigRedirect = &JFactory::getApplication();

   //Add code to check if config file is writeable.
   $configfile = JPATH_COMPONENT.DS."/config.jawards.php";
   @chmod ($configfile, 0766);
   if (!is_writable($configfile)) {
      $saveConfigRedirect->redirect("index2.php?option=$option", "FATAL ERROR: Config File  $configfile Not writeable" );
   }

   $txt = "<?php\n";
   foreach ($_POST as $k=>$v) {
   	  if (is_array($v)) $v = implode("|*|", $v);
      if (strpos( $k, 'cfg_' ) === 0) {
         if (!get_magic_quotes_gpc()) {
            $v = addslashes( $v );
         }
         $txt .= "\$jAwards_Config['".substr( $k, 4 )."']='$v';\n";
      }
   }
   $txt .= "?>";

   if ($fp = fopen( $configfile, "w")) {
      fputs($fp, $txt, strlen($txt));
      fclose ($fp);
      $saveConfigRedirect->redirect( "index2.php?option=$option&task=showconfig", "Configuration file saved" );
   } else {
      $saveConfigRedirect->redirect( "index2.php?option=$option", "FATAL ERROR: File could not be opened." );
   }
}

function viewAwards( $option, $sortby="date") {
	global $mainframe, $mosConfig_list_limit, $jAwards_Config;
	$database = &JFactory::getDbo();

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
    	$query .= "\n WHERE (LOWER(u.username) LIKE '%$search%' OR LOWER(u.name) LIKE '%$search%')";
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
		case "user":	$order = "username";
				break;
		
		case "award":	$order = "m.name";
				break;
		
		case "date":
		default:	$order = "a.date DESC";
	}

	// Constructing the main query:
	$selname = ($jAwards_Config['realname'])?"u.name as username":"u.username as username";
	$query = "SELECT a.*, m.image, m.name, $selname"
	. "\n FROM #__jawards_awards AS a "
	. "\n LEFT JOIN #__jawards_medals AS m ON a.award = m.id"
	. "\n LEFT JOIN #__users AS u ON a.userid = u.id";
	
	// A username is searched for in the input field:
	if ($search) {
    		$query .= "\n WHERE (LOWER(u.username) LIKE '%$search%' OR LOWER(u.name) LIKE '%$search%')";
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
	
	$medals_dropdown[] = JHTML::_('select.option', '0', " - ".JText::_('AWARDS_ADM_SELECT_MEDAL')." - " );
	$database->setQuery( $query );
	$medals_dropdown = array_merge( $medals_dropdown, $database->loadObjectList() );

	$lists['medals'] = JHTML::_('select.genericlist', $medals_dropdown, 'medals_filter', 'class="inputbox" size="1" onchange="document.adminForm.submit( );"', 'value', 'text', $medal_id );
	
	HTML_awards::showAwards( $rows, $pageNav, $option, $search, $lists );
}

function removeAward( $cid ) {
	$saveConfigRedirect = &JFactory::getApplication();
	$database = &JFactory::getDbo();
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
	$saveConfigRedirect->redirect( 'index2.php?option=com_jawards' );
}

// Adds and Edits Awards
function editAward( $awardid, $option, $showallusers=false ) {
	global $my, $jAwards_Config;
	$database = &JFactory::getDbo();
	JHTML::_('behavior.tooltip');
	$lists = array();

	$row = new mosAward($database);
	$row->load( $awardid );
	
	// bind previous values:
	$row->id = JRequest::getVar( 'id', $row->id);
	$row->award = JRequest::getVar( 'award', $row->award);
	$row->userid = JRequest::getVar( 'userid', $row->userid);
	$row->reason = JRequest::getVar( 'reason', $row->reason);
	$row->date = JRequest::getVar( 'date', $row->date);
	$showallusers = JRequest::getVar( 'showallusers', $showallusers);
	
	if ($row->date=='') {
		$addDate = date($jAwards_Config['dateformat']);
		$addDate = str_ireplace("%","",$addDate);
		$row->date = $addDate;
	}
	
	if ($showallusers){
		// Build User select list
		$selname = ($jAwards_Config['realname'])?"name":"username";
		$sql	= "SELECT id as value,$selname as text"
		. "\n FROM #__users"
		. "\n ORDER BY $selname";
	
		$database->setQuery($sql);
		if (!$database->query()) {
			echo $database->stderr();
			return;
		}
		$userlist = array();
		
		$userslist[] 	= JHTML::_('select.option', '0', JText::_('AWARDS_ADM_SELECT_USER'), 'value', 'text' );
		$userslist 	= array_merge( $userslist, $database->loadObjectList() );
		$lists['users'] = JHTML::_('select.genericlist', $userslist, 'userlist', 'class="inputbox" size="1" onChange="javascript:document.adminForm.userid.value=document.adminForm.userlist.value;"','value', 'text', $row->userid);
	}
	
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
	$medalslist[] 	= JHTML::_('select.option', '0', JText::_('AWARDS_ADM_SELECT_MEDAL'), 'id', 'name' );
	$medalslist 	= array_merge( $medalslist, $database->loadObjectList());
	$lists['medals'] 	= JHTML::_('select.genericlist', $medalslist, 'award', 'class="inputbox" size="1" onChange="javascript:changeDefaultReason()"','id', 'name', $row->award);
	
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
	global $jAwards_Config;
	$database = &JFactory::getDbo();
	JHTML::_('behavior.tooltip');
	
	$lists = array();
	
	// Build User select list
	$selname = ($jAwards_Config['realname'])?"name":"username";
	$sql	= "SELECT id as value,$selname as text"
	. "\n FROM #__users"
	. "\n ORDER BY $selname";

	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}

	$userslist 	= $database->loadObjectList();
	$seluserslist = array();
	$lists['users'] = JHTML::_('select.genericlist', $userslist, 'userlist', 'class="inputbox" multiple="true" size="20" width="150px"','value', 'text', '');
	$lists['selusers'] = JHTML::_('select.genericlist', $seluserslist, 'seluserlist[]', 'class="inputbox" multiple="true" size="20" width="150px"','value', 'text', '');
	
	
	
	// Build Medal select list
	$sql	= "SELECT *"
	. "\n FROM #__jawards_medals"
	. "\n ORDER BY ordering,name";
	
	
	$database->setQuery($sql);
	if (!$database->query()) {
		echo $database->stderr();
		return;
	}

	$medalslist[] 	 = JHTML::_('select.option', '0', JText::_('AWARDS_ADM_SELECT_MEDAL'), 'id', 'name' );
	$medalslist 	 = array_merge( $medalslist, $database->loadObjectList() );
	$lists['medals'] = JHTML::_('select.genericlist', $medalslist, 'award', 'class="inputbox" size="1" onChange="javascript:changeDefaultReason()"','id', 'name','');

	
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
	global $jAwards_Config,$mosConfig_mailfrom,$mosConfig_fromname,
		$mosConfig_live_site, $mosConfig_sitename;
		
	$database = &JFactory::getDbo();
	$saveConfigRedirect = &JFactory::getApplication();

	$userids = JRequest::getVar('seluserlist', array());
	$awardid = intval(JRequest::getVar( 'award', ''));
	$reason = $database->getEscaped(JRequest::getVar('reason'));
	$date = $database->getEscaped(JRequest::getVar( 'date'));

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
	/// send out email
	if ($jAwards_Config['emailusers']){
		$database->setQuery("SELECT name FROM #__jawards_medals WHERE id = $awardid");
		$awardname = $database->loadResult();
		set_time_limit(900);
		for($i=0; $i< $numusers; $i++){
			$userid = intval($userids[$i]);
			$user = new mosUser($database);
			$user->load($userid);
		
			$subject = _AWARDS_EMAIL_SUBJECT;
			$text = sprintf(_AWARDS_EMAIL_TEXT, $user->name, $awardname, $mosConfig_live_site,$mosConfig_sitename);
			mosMail($mosConfig_mailfrom,$mosConfig_fromname,$user->email,$subject,$text);  
		}
	}
		
  	$saveConfigRedirect->redirect( 'index2.php?option=com_jawards', $msg );
}

function saveAward( $task ) {
	global $jAwards_Config,$mosConfig_mailfrom,$mosConfig_fromname,
		$mosConfig_live_site, $mosConfig_sitename;
	
	$database = &JFactory::getDbo();
	$saveConfigRedirect = &JFactory::getApplication();

	$row = new mosAward($database);

	$msg = 'Saved Award info';
	
	if (!$row->bind( $_POST )) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if(intval($row->id) == 0 && $jAwards_Config['emailusers']){ // new award
		$sendEmail = true;
	}
	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit();
	}
	// send out email
	if ($sendEmail){
		$user = new mosUser($database);
		$user->load($row->userid);
		
		$database->setQuery("SELECT name FROM #__jawards_medals WHERE id = ".intval($row->award));
		$awardname = $database->loadResult();
		
		$subject = _AWARDS_EMAIL_SUBJECT;
		$text = sprintf(_AWARDS_EMAIL_TEXT, $user->name, $awardname, $mosConfig_live_site,$mosConfig_sitename);
		mosMail($mosConfig_mailfrom,$mosConfig_fromname,$user->email,$subject,$text);  
	}
	$saveConfigRedirect->redirect( 'index2.php?option=com_jawards', $msg );
}

function cancelEditAward() {
	$db = &JFactory::getDbo();

	$row = new mosAward($database);
	$row->bind( $_POST );
	$saveConfigRedirect = &JFactory::getApplication();
	$saveConfigRedirect->redirect('index2.php?option=com_jawards');
}



// ---------- MEDAL MANAGEMENT ----------

function viewMedals( $option ) {
	global  $mainframe, $mosConfig_list_limit;
	$database = &JFactory::getDbo();
	
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
	global $my;
	$database = &JFactory::getDbo();

	$row = new mosMedal($database);
	$row->load($id);
	
	// Imagelist
	$javascript 	= 'onchange="changeDisplayImage();"';
	$directory 		= '/images/medals';
	$lists['image'] =JHTML::_('list.images','image', $row->image, $javascript, $directory );

	HTML_Medals::medalForm( $row, $lists, $option );
}

function saveMedal( $option ) {
	$saveConfigRedirect = &JFactory::getApplication();
	$database = &JFactory::getDbo();

	$row = new mosMedal( $database );
	if (!$row->bind( $_POST )) {
		echo $row->getError();
		exit();
	}
	
	if(!$row->id){
            $row->ordering = 999999999;
        }
		
	if (!$row->check()) {
		$saveConfigRedirect->redirect( "index2.php?option=$option&task=editclient&cid[]=$row->id", $row->getError() );
	}

	if (!$row->store()) {
		echo $row->getError();
		exit();
	}
	$row->reorder();
	$row->checkin();
	$msg = 'Saved Medal info';
	$saveConfigRedirect->redirect( "index2.php?option=$option&task=listmedals",$msg );
}

function cancelEditMedal( $option ) {
	$saveConfigRedirect = &JFactory::getApplication();
	$database = &JFactory::getDbo();
	$row = new mosMedal( $database );
	$row->bind( $_POST );
	
	$saveConfigRedirect->redirect( "index2.php?option=$option&task=listmedals" );
}

function reorder($id, $direction, $option){
	global $saveConfigRedirect;
    $database = &JFactory::getDbo();
    
    $row = new mosMedal($database);
    $row->load($id);
    
    $row->move($direction);
    
    $saveConfigRedirect->redirect("index2.php?option=$option&task=listmedals");
}

function saveOrder($cid, $option){
	$saveConfigRedirect = &JFactory::getApplication();
    $db = &JFactory::getDbo();
    
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
        
        $row->reorder();
	}

	$saveConfigRedirect->redirect("index2.php?option=$option&task=listmedals");
}
  
function uploadFile ( $option ) {
	$saveConfigRedirect = &JFactory::getApplication();

	// check for upload errors:
	if ($_FILES["medal_file"]["error"] > 0){
		$saveConfigRedirect->redirect( "index2.php?option=$option&task=listmedals", "UPLOAD ERROR: " . $_FILES["medal_file"]["error"] );
	} else {
		$upload_path = JA_MEDABSPATH.'/'.$_FILES["medal_file"]["name"];
		
		if (file_exists($upload_path)){
      			$saveConfigRedirect->redirect( "index2.php?option=$option&task=listmedals", "UPLOAD ERROR: File ".$upload_path ."already exists");
      		}
    		else  {
			
			move_uploaded_file($_FILES["medal_file"]["tmp_name"], $upload_path);
			@chmod ($upload_path, 0755);
			$saveConfigRedirect->redirect( "index2.php?option=$option&task=listmedals", "Successfully uploaded. ");
      		}
	}

}

function removeMedal( $cid ) {
	$saveConfigRedirect = &JFactory::getApplication();
	$database = &JFactory::getDbo();
	if (count( $cid )) {
		$cids = implode( ',', $cid );
		
		// Check for existing awards with a medal to be deleted:
		$checkQuery = "SELECT COUNT(*) FROM #__jawards_awards"
			."\n WHERE award IN ($cids)";
		$database->setQuery($checkQuery);
		$numberOfAwards = $database->loadResult();

		
		if ($numberOfAwards > 0){
			$saveConfigRedirect->redirect( 'index2.php?option=com_jawards',"No Medal deleted! There are still $numberOfAwards awards associated to the medals you wanted to delete. Please delete them first." );		
		}
		else{
			
		
			$query = "DELETE FROM #__jawards_medals"
			. "\n WHERE id IN ( $cids )";
			
			$database->setQuery( $query );
			if (!$database->query()) {
				echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
			}
			$saveConfigRedirect->redirect( 'index2.php?option=com_jawards&task=listmedals','Selected Medals deleted!' );
		}
	}
	
}





?>