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

class HTML_jAwards {
	function displayAwards(&$rows, &$menuItem, &$option, &$pageNav) {
		global $Itemid, $jAwards_Config;
		$mainframe = &JFactory::getApplication();
		// include CSS template:
		$template = '<link type="text/css" rel="stylesheet" href="' . JUri::base(true) .'/components/com_jawards/template.css" />';
		$mainframe->addCustomHeadTag($template);

		echo ("<div class=\"componentheading\">". JText::_('AWARDS_HEADING') ."</div>");
		echo ("<p class=\"ja_introtext\">".$jAwards_Config['introtext']."</p>");
                
                ?>
                <form action="index.php" id="medalsForm" name="medalsForm" method="post">
                    <div align="right">
                            <?php echo JText::_('AWARDS_ADM_DISPLAY')."# "; echo $pageNav->getLimitBox("index.php?option=$option&Itemid=$menuItem->id"); ?>
                    </div>
                    <input type="hidden" name="option" value="<?php echo $option ?>" />
                    <input type="hidden" name="limit" value="<?php echo $pageNav->limit;?>" />
                    <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart;?>" />
                    <input type="hidden" name="Itemid" value="<?php echo $menuItem->id;?>" />
                </form>
                
                <?php
		foreach($rows as $row){
			echo "<div class=\"ja_award_list\"><h3>$row->name</h3>
				<p><img class=\"ja_medal\" alt=\"$row->image\" src=\"images/medals/$row->image\">
				$row->desc_text</p>";
			if ($row->count){
				echo "<p><a href=\"".JRoute::_("index.php?option=$option&task=listusers"
				. "&award=$row->id&Itemid=$menuItem->id"). "\" class=\"readon\">($row->count " .JText::_('AWARDS_AWARDED').")</a></p></div>";
				}
			else{
				echo "<p><span class=\"readon\">(0 ".JText::_('AWARDS_AWARDED').")</span></p></div>";
			}
				
			
		}
		
		?>
		
		<div align="center"><?php echo $pageNav->getPagesLinks("index.php?option=$option&Itemid=$menuItem->id"). "<br />";
		                              echo $pageNav->getPagesCounter() ?></div>
		
		<?php

		HTML_jAwards::createFooter();
	}

	function showUsers(&$rows, &$awardres, &$option, &$pageNav) {

		global $Itemid, $jAwards_Config;
		$mainframe = &JFactory::getApplication();		
		// include CSS template:
		$template = '<link type="text/css" rel="stylesheet" href="' .  JUri::base(true).'/components/com_jawards/template.css" />';
		$mainframe->addCustomHeadTag($template);
		
		echo "<div class=\"ja_award_details\"><img class=\"ja_medal\" src=\"images/medals/$awardres->image\"><h3> $awardres->name</h3>";
		echo "<p>$awardres->desc_text</p></div>";
		if (count($rows)==0){
			echo JText::_('AWARDS_NO_USERS');
		}
		else {
			echo "<p>".JText::_('AWARDS_FOLLOWING_USERS_AWARDED')."</p>";

			
			
			?>
			<form action="index.php" id="medalsForm" name="awardForm" method="post">
                            <div align="right">
                                <?php echo JText::_('AWARDS_ADM_DISPLAY')."# "; echo $pageNav->getLimitBox("index.php?option=$option&task=listusers&award=$awardres->id&Itemid=$Itemid"); ?>
                            </div>
                            <input type="hidden" name="option" value="<?php echo $option ?>" />
                            <input type="hidden" name="limit" value="<?php echo $pageNav->limit;?>" />
                            <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart;?>" />
                            <input type="hidden" name="Itemid" value="<?php echo $menuItem->id;?>" />
                        </form>
                
                <?php
                        $line = 0;
                        
			$t_heading='<table class="ja_userstable" cellpadding="5px" cellspacing="0px" ><tbody>'.
			'<tr class="sectiontableheader"><td>'.JText::_('AWARDS_NAME').'</td><td>'.JText::_('AWARDS_DATE')."</td>";

			if ($jAwards_Config['showawardreason']){
				$t_heading .="<td>".JText::_('AWARDS_REASON')."</td>";
			}
			$t_heading.="</tr>";
			echo $t_heading;
			foreach ($rows as $row){
				$t_row = ""; 
				$linecolor=($line % 2) + 1;
				$link = JRoute::_("index.php?option=com_comprofiler&task=userProfile&user=$row->userid");

				$t_row.='<tr class="sectiontableentry'.$linecolor  . '"><td>';
				if ($jAwards_Config['cbintegration'])
					$t_row.="<a href=\"$link\">$row->username</a>";
				else
					$t_row.="$row->username";
					 
				// grouping:
				if ($jAwards_Config['groupawards'] && $row->count > 1)
					$t_row .= "&nbsp;(". $row->count."x)";
				$t_row.="</td><td>"
						.strftime($jAwards_Config['dateformat'],strtotime($row->date))
						."</td>";
					
				if ($jAwards_Config['showawardreason'])
					$t_row.= "<td>$row->reason</td>";
				
				$t_row .="</tr>";
				echo $t_row;
				$line++;
			}
?>
			</tbody></table>
			<div align="center"><?php echo $pageNav->getPagesLinks("index.php?option=$option&task=listusers&award=$awardres->id&Itemid=$Itemid"). "<br />";
		                              echo $pageNav->getPagesCounter() ?></div>
			
			
			
			<div class="back_button"><a href="<?php echo JRoute::_("index.php?option=$option&Itemid=$Itemid"); ?> "><?php echo JText::_('AWARDS_BACK_OVERVIEW') ?></a></div>
			
<?php 	
		}

	HTML_jAwards::createFooter();	
	}
	
	function createFooter(){
		global $jAwards_Config;
		
		if ($jAwards_Config['showcredits']){ 
?>
	<div class="ja_footer">Powered by 
		<a href="http://www.arminhornung.de/Joomla/jAwards_en.html" target="_blank">
			<img src="<?php echo JUri::base(true);?>/administrator/components/com_jawards/images/medal_gold.png"/>jAwards
		</a>
	</div>
<?php	
		}
	}
}
?>
	

