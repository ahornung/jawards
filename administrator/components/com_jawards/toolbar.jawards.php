<?php
/*************************************************************
 * Joomla Awards Component
 * Author Armin Hornung
 * @ Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ($task) {
	case 'showconfig':
		TOOLBAR_config::_DEFAULT();
		break;

	case 'newmedal':
	case 'editmedal':
	case 'editmedalA':
		TOOLBAR_medals::_EDIT();
		break;
	case 'upload':
		TOOLBAR_medals::_UPLOAD();
		break;

	case 'listmedals':
		TOOLBAR_medals::_DEFAULT();
		break;

	case 'massaward':
		TOOLBAR_awards::_MASS();
		break;
	case 'new':
	case 'edit':
	case 'editA':
		TOOLBAR_awards::_EDIT();
		break;

	default:
		TOOLBAR_awards::_DEFAULT();
		break;
}
?>