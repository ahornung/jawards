<?php
/*************************************************************
 * Joomla Awards Component
 * Author Armin Hornung
 * @ Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

class TOOLBAR_config{
	function _DEFAULT(){
		mosMenuBar::startTable();
		mosMenuBar::save('saveconfig');
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

}

class TOOLBAR_awards {
	
	function _EDIT() {
		global $id;

		mosMenuBar::startTable();
		mosMenuBar::save();
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancel', 'Close' );
		} else {
			mosMenuBar::cancel();
		}
		mosMenuBar::endTable();
	}
	
	function _MASS() {
		mosMenuBar::startTable();
		mosMenuBar::save('mass_save');
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}
	
	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::editListX();
		mosMenuBar::spacer();
		mosMenuBar::addNewX();
		mosMenuBar::spacer();
		mosMenuBar::addNew('massaward', 'Mass awarding');
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}
}

class TOOLBAR_medals {
	function _EDIT() {
		global $id;

		mosMenuBar::startTable();
		mosMenuBar::save( 'savemedal' );
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing content items the button is renamed `close`
			mosMenuBar::cancel( 'cancelmedal', 'Close' );
		} else {
			mosMenuBar::cancel( 'cancelmedal' );
		}

		mosMenuBar::endTable();
	}

	function _UPLOAD() {
		
		mosMenuBar::startTable();
		mosMenuBar::save( 'uploadMedalImage' );
		mosMenuBar::spacer();
		mosMenuBar::cancel();
		mosMenuBar::endTable();
	}

	function _DEFAULT() {
		mosMenuBar::startTable();
		mosMenuBar::deleteList('If there are still awards associated to the medals you have chosen, nothing will be deleted','removemedal','Remove');
		mosMenuBar::spacer();
		mosMenuBar::custom('upload', 'upload_f2.png','upload_f2.png', 'Upload medal', false );
		mosMenuBar::spacer();
		mosMenuBar::editListX( 'editmedal' );
		mosMenuBar::spacer();
		mosMenuBar::addNewX( 'newmedal' );
		mosMenuBar::endTable();
	}
}
?>