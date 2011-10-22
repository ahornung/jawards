<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
/**
 * HelloWorld Model
 */
class JAwardsModelJAwards extends JModelItem
{
    protected $msg;
 
    /**
     * Get the message
     * @return string The message to be displayed to the user
     */
    public function getMsg() 
    {
        if (!isset($this->msg)) 
        {
            $this->msg = 'Hello World!';
        }
        return $this->msg;
    }
}

?>
