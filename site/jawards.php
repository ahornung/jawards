<?php

/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import joomla controller library
jimport('joomla.application.component.controller');
 
// Get an instance of the controller prefixed 
$controller = JController::getInstance('JAwards');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task', 'listmedals'));
 
// Redirect if set by the controller
$controller->redirect();


?>