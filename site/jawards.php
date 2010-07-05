<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Ported to Joomla 1.5 native by Chris Lehr @ http://www.housemanticore.com 
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/
 
// ensure this file is being included by a parent file
defined('_JEXEC') or die('Restricted access');

global $jAwards_Config;

require_once(JApplicationHelper::getPath('front_html'));
require_once(JApplicationHelper::getPath('class'));
jimport('joomla.html.pagination');

// config file:
require_once(JPATH_ADMINISTRATOR.DS.'components/com_jawards'.DS."config.jawards.php");

$award = intval(JRequest::getVar( 'award' , '' ));
$Itemid = intval( JRequest::getVar( 'Itemid', '' ));
$limit_medals = intval(JRequest::getVar( 'limit', JRequest::getVar( 'limit', $jAwards_Config['number_medals'])));
$limit_users = intval(JRequest::getVar( 'limit', JRequest::getVar( 'limit', $jAwards_Config['number_users'])));
$limitstart = intval(JRequest::getVar( 'limitstart', JRequest::getVar( 'limitstart', 0)));
$option 		= JRequest::getVar( 'option', JRequest::getVar( 'option', 'com_jawards' ));

$database = &JFactory::getDbo();

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
	$database = &JFactory::getDbo();
	
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
    $pageNav = new JPagination($total, $limitstart, $limit);
	HTML_jAwards::displayAwards($rows, $menuItem[0], $option, $pageNav);
}

function listUsers($award, $option, $limit, $limitstart=0) {
	global $jAwards_Config;
	$database = &JFactory::getDbo();
        
    $grouping = $jAwards_Config['groupawards'];
    // get number of users for pagination:
    $query = "SELECT COUNT(";
    if ($grouping)
        $query .= "DISTINCT ";
    $query .="userid) FROM #__jawards_awards" 
                . "\n WHERE award = $award";
        
	$database->setQuery($query);
	$total = $database->loadResult();

	// Load the users:
	$selname = ($jAwards_Config['realname'])?"u.name as username":"u.username";
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
	$pageNav = new JPagination($total, $limitstart, $limit);
	HTML_jAwards::showUsers($rows, $awardres[0], $option, $pageNav);

}

?>