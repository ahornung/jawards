<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/
 
// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class HTML_jAwards {
	function displayAwards(&$rows, &$menuItem, &$option, &$pageNav) {
		global $Itemid, $mosConfig_live_site, $mosConfig_absolute_path, $mainframe, $mosConfig_lang, $ja_config;
	
		// include CSS template:
		$template = '<link type="text/css" rel="stylesheet" href="' .  $mosConfig_live_site.'/components/com_jawards/template.css" />';
		$mainframe->addCustomHeadTag($template);

		echo ("<div class=\"componentheading\">". _AWARDS_HEADING ."</div>");
		echo ("<p class=\"ja_introtext\">".$ja_config['introtext']."</p>");
                
                ?>
                <form action="index.php" id="medalsForm" name="medalsForm" method="post">
                    <div align="right">
                            <?php echo _AWARDS_ADM_DISPLAY."# "; echo $pageNav->writeLimitBox("index.php?option=$option&Itemid=$menuItem->id"); ?>
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
				echo "<p><a href=\"".sefRelToAbs("index.php?option=$option&task=listusers"
				. "&award=$row->id&Itemid=$menuItem->id"). "\" class=\"readon\">($row->count " ._AWARDS_AWARDED.")</a></p></div>";
				}
			else{
				echo "<p><span class=\"readon\">(0 "._AWARDS_AWARDED.")</span></p></div>";
			}
				
			
		}
		
		?>
		
		<div align="center"><?php echo $pageNav->writePagesLinks("index.php?option=$option&Itemid=$menuItem->id"). "<br />";
		                              echo $pageNav->writePagesCounter() ?></div>
		
		<?php

		HTML_jAwards::createFooter();
	}

	function showUsers(&$rows, &$awardres, &$option, &$pageNav) {

		global $Itemid, $mainframe, $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_lang, $ja_config;
				
		// include CSS template:
		$template = '<link type="text/css" rel="stylesheet" href="' .  $mosConfig_live_site.'/components/com_jawards/template.css" />';
		$mainframe->addCustomHeadTag($template);
		
		echo "<div class=\"ja_award_details\"><img class=\"ja_medal\" src=\"images/medals/$awardres->image\"><h3> $awardres->name</h3>";
		echo "<p>$awardres->desc_text</p></div>";
		if (count($rows)==0){
			echo _AWARDS_NO_USERS;
		}
		else {
			echo "<p>"._AWARDS_FOLLOWING_USERS_AWARDED."</p>";

			
			
			?>
			<form action="index.php" id="medalsForm" name="awardForm" method="post">
                            <div align="right">
                                <?php echo _AWARDS_ADM_DISPLAY."# "; echo $pageNav->writeLimitBox("index.php?option=$option&task=listusers&award=$awardres->id&Itemid=$Itemid"); ?>
                            </div>
                            <input type="hidden" name="option" value="<?php echo $option ?>" />
                            <input type="hidden" name="limit" value="<?php echo $pageNav->limit;?>" />
                            <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart;?>" />
                            <input type="hidden" name="Itemid" value="<?php echo $menuItem->id;?>" />
                        </form>
                
                <?php
                        $line = 0;
                        
			$t_heading='<table class="ja_userstable" cellpadding="5px" cellspacing="0px" ><tbody>'.
			'<tr class="sectiontableheader"><td>'._AWARDS_NAME.'</td><td>'._AWARDS_DATE."</td>";

			if ($ja_config['showawardreason']){
				$t_heading .="<td>"._AWARDS_REASON."</td>";
			}
			$t_heading.="</tr>";
			echo $t_heading;
			foreach ($rows as $row){
				$t_row = ""; 
				$linecolor=($line % 2) + 1;
				$link = sefRelToAbs("index.php?option=com_comprofiler&task=userProfile&user=$row->userid");

				$t_row.='<tr class="sectiontableentry'.$linecolor  . '"><td>';
				if ($ja_config['cbintegration'])
					$t_row.="<a href=\"$link\">$row->username</a>";
				else
					$t_row.="$row->username";
					 
				// grouping:
				if ($ja_config['groupawards'] && $row->count > 1)
					$t_row .= "&nbsp;(". $row->count."x)";
				$t_row.="</td><td>"
						.strftime($ja_config['dateformat'],strtotime($row->date))
						."</td>";
					
				if ($ja_config['showawardreason'])
					$t_row.= "<td>$row->reason</td>";
				
				$t_row .="</tr>";
				echo $t_row;
				$line++;
			}
?>
			</tbody></table>
			<div align="center"><?php echo $pageNav->writePagesLinks("index.php?option=$option&task=listusers&award=$awardres->id&Itemid=$Itemid"). "<br />";
		                              echo $pageNav->writePagesCounter() ?></div>
			
			
			
			<div class="back_button"><a href="<?php echo sefRelToAbs("index.php?option=$option&Itemid=$Itemid"); ?> "><?php echo _AWARDS_BACK_OVERVIEW ?></a></div>
			
<?php 	
		}

	HTML_jAwards::createFooter();	
	}
	
	function createFooter(){
		global $mosConfig_live_site, $ja_config;
		
		if ($ja_config['showcredits']){ 
?>
	<div class="ja_footer">Powered by 
		<a href="http://www.arminhornung.de/index.php?section=Joomla&amp;file=jAwards&amp;l=en" target="_blank">
			<img src="<?php echo $mosConfig_live_site;?>/administrator/components/com_jawards/images/medal_gold.png"/>jAwards
		</a>
	</div>
<?php	
		}
	}
}
?>
	

