<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

class mosMedal extends mosDBTable {
	var $id 			= null;
	var $image 			= null;
	var $name 			= null;
	var $desc_text		= null;
	var $default_reason	= null;
	var $ordering		= null;
	var $checked_out	= null;

	function mosMedal( &$_db ) {
		$this->mosDBTable( '#__jawards_medals', 'id', $_db );
	
	}


}

class mosAward extends mosDBTable {
	var $id				= null;
	var $award			= null;
	var $userid			= null;
	var $date			= null;
	var $reason			= null;

	function mosAward( &$_db ) {
		$this->mosDBTable( '#__jawards_awards', 'id', $_db );
		$this->set( 'date', date( 'Y-m-d' ) );
	}


}
?>