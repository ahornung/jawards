<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined('_JEXEC') or die('Restricted access');

class mosMedal extends JTable {
	var $id 			= null;
	var $image 			= null;
	var $name 			= null;
	var $desc_text		= null;
	var $default_reason	= null;
	var $ordering		= null;
	var $checked_out	= null;

	 function __construct(&$db) {
	   parent::__construct('#__jawards_medals', 'id', $db);
	 }

//	function mosMedal( &$_db ) {
//		$this->mosDBTable( '#__jawards_medals', 'id', $_db );	
//	}

}

class mosAward extends JTable {
	var $id				= null;
	var $award			= null;
	var $userid			= null;
	var $date			= null;
	var $reason			= null;

	 function __construct(&$db) {
	   parent::__construct('#__jawards_awards', 'id', $db);
	 }
	 
//	function mosAward( &$_db ) {
//		$this->mosDBTable( '#__jawards_awards', 'id', $_db );
//		$this->set( 'date', date( 'Y-m-d' ) );
//	}
}
?>