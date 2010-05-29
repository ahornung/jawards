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

class TOOLBAR_config{
	function _DEFAULT(){
		JToolbarHelper::save('saveconfig');
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
	}

}

class TOOLBAR_awards {
	
	function _EDIT() {
		global $id;

		JToolbarHelper::save();
		JToolbarHelper::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			JToolbarHelper::cancel( 'cancel', 'Close' );
		} else {
			JToolbarHelper::cancel();
		}
	}
	
	function _MASS() {
		JToolbarHelper::save('mass_save');
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
	}
	
	function _DEFAULT() {
		JToolbarHelper::deleteList();
		JToolbarHelper::spacer();
		JToolbarHelper::editListX();
		JToolbarHelper::spacer();
		JToolbarHelper::addNew('new');
		JToolbarHelper::spacer();
		JToolbarHelper::addNew('massaward', 'Mass awarding');
		JToolbarHelper::spacer();
		JToolbarHelper::cancel( 'canelmedal' );
		JToolbarHelper::spacer();
	}
}

class TOOLBAR_medals {
	function _EDIT() {
		global $id;
		
		JToolbarHelper::save( 'savemedal' );
		JToolbarHelper::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			JToolbarHelper::cancel( 'cancelmedal', 'Close' );
		} else {
			JToolbarHelper::cancel( 'cancelmedal' );
		}
	}

	function _UPLOAD() {
		
		JToolbarHelper::save( 'uploadMedalImage' );
		JToolbarHelper::spacer();
		JToolbarHelper::cancel();
	}

	function _DEFAULT() {
		JToolbarHelper::deleteList('If there are still awards associated to the medals you have chosen, nothing will be deleted','removemedal','Remove');
		JToolbarHelper::spacer();
		JToolbarHelper::custom('upload', 'upload.png','upload.png', 'Upload medal', false );
		JToolbarHelper::spacer();
		JToolbarHelper::editListX( 'editmedal' );
		JToolbarHelper::spacer();
		JToolbarHelper::addNewX( 'newmedal' );
	}
}
?>