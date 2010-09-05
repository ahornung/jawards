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

require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch ($task) {
	case 'config':
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

	case 'medals':
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

	case 'awards':	
	default:
		TOOLBAR_awards::_DEFAULT();
		break;
}
?>