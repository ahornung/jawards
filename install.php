<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

/**
 * Update procedure based on Community Builder update procedure,
 * original copyright:
 * 
 * JoomlaJoe and Beat, www.joomlapolis.com
 * http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU/GPL version 2
 */
 

/** ensure this file is being included by a parent file */
defined('_JEXEC') or die('Restricted access');

function com_install() {
	global $mainframe;
    $db = & JFactory::getDBO();

    jimport('joomla.filesystem.folder');
    jimport('joomla.filesystem.file');

    $path = JPATH_ADMINISTRATOR.DS.'components'.DS.'com_jawards1.5';

# Show installation result to user
  ?>
	<center>
Installation of jAwards, the awards-component for Joomla! 1.5
    	<br /> Copyright 2010 Chris Lehr
    	<br /> Released under GNU/GPL
             <h3>Installation Process:</h3>
        
	<?php
	# Set up new icons for admin menu
      echo "Start correcting icons in administration backend.<br />";
      $db->setQuery("UPDATE #__components SET admin_menu_img='components/com_jawards/images/medal_gold.png' WHERE admin_menu_link='option=com_jawards'");
      $iconresult[0] = $db->query();
      $db->setQuery("UPDATE #__components SET admin_menu_img='components/com_jawards/images/medal_silver.png' WHERE admin_menu_link='option=com_jawards&task=listmedals'");
      $iconresult[1] = $db->query();
      $db->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_jawards&task=showconfig'");
      $iconresult[2] = $db->query();
         
      foreach ($iconresult as $i=>$icresult) {
        if ($icresult) {
          echo "<font color='green'>FINISHED:</font> Image of menu entry $i has been corrected.<br />";
        } else {
          echo "<font color='red'>ERROR:</font> Image of menu entry $i could not be corrected.<br />";
        }
      }
	
	if(is_writable(JPATH_SITE.DS."images/")) {
		if(!file_exists(JPATH_SITE.DS."images/medals/")){
	    	if(mkdir(JPATH_SITE.DS."images/medals/")) 
	    		print "<font color=green>".JPATH_SITE.DS."images/medals/ successfully created!</font><br />";
			else 
				print "<font color=red>".JPATH_SITE.DS."images/medals/ Failed to be to be created, please do so manually!</font><br />";
		}  
	else 
	    print "<font color=green>".JPATH_SITE.DS."images/medals/ already exists.</font><br />";
	} 
	else 
		print "<font color=red>".JPATH_SITE.DS."images/ is not writable!<br />  Manually create a directory medals in it and make it writable to be able to upload medals!  </font><br />";

// Upgrade Array:

	//Special check: Table Renaming
	$db->setQuery("SELECT COUNT(*) FROM #__jawards_medals");
	if(!$db->query()) {
		echo $db->stderr();
	}
	$newCount = $db->loadRow();
	$db->setQuery("SELECT COUNT(`desc`) FROM #__awards");
	$result = $db->query();
	
	// New Table is empty, old one exists => Rename old one!
	if ($result && $newCount[0] == 0){
		print "Replacing empty new table with existing one from v.0.4 or older... <br />";
		$db->setQuery("DROP TABLE `#__jawards_medals`, `#__jawards_awards`");
		$db->query();
		$db->setQuery("RENAME TABLE `#__awards` TO `#__jawards_medals`,
	  							`#__user_awards` TO `#__jawards_awards`");
	  	
	  	if($db->query())	
	  		print "<font color=\"green\">Tables sucessfully renamed!</font><br />";
	  	else
	  		echo $db->stderr();
	}
	
// v 0.4 to 0.5 (up to 0.8)
	  	
	$JAUpgrades[0]['test'] = "SELECT reason FROM #__jawards_awards";
	$JAUpgrades[0]['updates'][0] = "ALTER TABLE `#__jawards_medals` CHANGE `desc` `name` TINYTEXT NOT NULL ";
	$JAUpgrades[0]['updates'][1] = "ALTER TABLE `#__jawards_medals` ADD `desc_text` TEXT AFTER `name` ";
	$JAUpgrades[0]['updates'][2] = "ALTER TABLE `#__jawards_awards` ADD `reason` TEXT AFTER `date` ";
	$JAUpgrades[0]['message'] = "v0.4 to v0.5: add description text to medals, reason to awards.";

// v 0.8 to 0.9

	$JAUpgrades[1]['test'] = "SELECT ordering FROM #__jawards_medals";
	$JAUpgrades[1]['updates'][0] = "ALTER TABLE `#__jawards_awards` MODIFY `award` INT(11) NOT NULL ";
	$JAUpgrades[1]['updates'][1] = "ALTER TABLE `#__jawards_medals` ADD `default_reason` TEXT AFTER `desc_text` ";
	$JAUpgrades[1]['updates'][2] = "ALTER TABLE `#__jawards_medals` ADD `ordering` int(11) NOT NULL default '0' AFTER `id` ";
	$JAUpgrades[1]['message'] = "v0.8 to v0.9: fix for > 127 medals, add ordering, default_reason to medals.";

// v 0.9 to 0.91

	$JAUpgrades[2]['test'] = "SHOW INDEX FROM `#__jawards_awards` where `Key_name`='idx_userid'";
	$JAUpgrades[2]['updates'][0] = "CREATE INDEX `idx_userid` ON `#__jawards_awards` (userid)";
	$JAUpgrades[2]['updates'][1] = "CREATE INDEX `idx_award` ON `#__jawards_awards` (award)";
	$JAUpgrades[2]['message'] = "v0.9 to v0.91: Indices added for improved DB performance";
		
	//Apply Upgrades
	foreach ($JAUpgrades AS $JAUpgrade) {
		$db->setQuery($JAUpgrade['test']);
		//if it fails test then apply upgrade
		if (!$db->query()) {
			foreach($JAUpgrade['updates'] as $JAScript) {
				$db->setQuery($JAScript);
				if(!$db->query()) {
					//Upgrade failed
					print("<font color=red>".$JAUpgrade['message']." failed! SQL error:" . $db->stderr(true)."</font><br />");
					return;
				}
			}
			//Upgrade was successful
			print "<font color=green>".$JAUpgrade['message']." Upgrade Applied Successfully!</font><br />";			
		} 
	}

?>
        <br /><font color="green"><b>Installation finished.</b></font>
      
  </center>
  <?php
}

?>
