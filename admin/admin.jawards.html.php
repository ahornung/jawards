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

include_once(JPATH_SITE.DS."components".DS."com_jawards".DS."jawards.interface.php");
jimport('joomla.html.html.grid');
JHtml::_('behavior.formvalidation'); 

?>
  <script language="javascript">
  <!--
  window.addEvent('domready', function() {
    document.formvalidator.setHandler('dropselected',
    function (value) {
        return (value > 0);
    });
  });
  //-->
  </script>

<?php
class HTML_awards {
	
	function config(&$jAwards_Config, &$lists, $option){
		$rowcount = 0;
		?>
		<script language="javascript" type="text/javascript">
		<!--
  		Joomla.submitbutton = function(pressbutton) {
    		var form = document.adminForm;
    		if (pressbutton == 'cancel') {
      			submitform(pressbutton);
      			return;
    		}
		    
    		try {
    			document.adminForm.onsubmit();
    		}
    		catch(e){}
      		<?php
			$editor = &JFactory::getEditor();
			echo $editor->save('cfg_introtext');
			 ?>
      		submitform(pressbutton);
    	}
		//-->
		</script>
        
		<form action="index.php" method="post" name="adminForm" id="adminForm" id="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<?php echo JText::_('AWARDS_ADM_CONFIG'); ?>
			</th>
			
		</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">
		<tr align="center" valign="middle" class="row0">
        	<th width="20%">&nbsp;</th>
         	<th width="20%"><?php echo JText::_('AWARDS_ADM_CUR_SETTING'); ?></th>
         	<th width="60%"><?php echo JText::_('AWARDS_ADM_EXPLANATION'); ?></th>
      	</tr>
		<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
        	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_INTROTEXT'); ?></td>
         	<td align="left" valign="top">
      		<?php
	           $editor =& JFactory::getEditor();
			   echo $editor->display('cfg_introtext', $jAwards_Config['introtext'], '400', '400', '20', '20', false);
			?>
         	</td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_INTROTEXT_EXPLANATION'); ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_NUMBERMEDALS'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['number_medals']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_NUMBERMEDALS_EXPLANATION'); ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_NUMBERUSERS'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['number_users']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_NUMBERUSERS_EXPLANATION'); ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_DATEFORMAT'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['date_format']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_DATEFORMAT_EXPLANATION'); ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_REALNAME'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['realname']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_REALNAME_EXPLANATION'); ?></td>
      	</tr>      	
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_CB_INTEGRATION'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['cbIntegration']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_CB_INTEGRATION_EXPLANATION'); ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_USERNAME_IDS'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['username_ids']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_USERNAME_IDS_EXPLANATION'); ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_EMAIL_USERS'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['emailUsers']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_EMAIL_USERS_EXPLANATION'); ?></td>
      	</tr>
        <tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_SHOWREASON'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['showawardReason']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_SHOWREASON_EXPLANATION'); ?></td>
      	</tr>
		<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_GROUP'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['groupawards']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_GROUP_EXPLANATION'); ?></td>
      	</tr>	
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_CREDITS'); ?></td>
         	<td align="left" valign="top"><?php echo $lists['showcredits']; ?></td>
         	<td align="left" valign="top"><?php echo JText::_('AWARDS_ADM_CREDITS_EXPLANATION'); ?></td>
      	</tr>
      </table>
		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="hidemainmenu" value="0">
		</form>	
		
		<?php
		createFooter();
			
	}

	function showAwards( &$rows, &$pageNav, $option, &$search, &$lists) {
		$user = &JFactory::getUser();
		
		JHTML::_('behavior.tooltip');
		?>
		<form action="index.php" method="post" name="adminForm" id="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo JText::_('AWARDS_ADM_AWARDS_MANAGER'); ?>
			</th>
			
		</tr>
		</table>
		<p><?php echo JText::_('AWARDS_ADM_AWARDS_MANAGER_EXPLANATION'); ?></p>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
      		<td width="100%" class="sectionname"></td>
		    <td nowrap="nowrap"><?php echo JText::_('AWARDS_ADM_DISPLAY'); ?> #<br>
        		<?php echo $pageNav->getLimitBox(); ?>
	        </td>
	        <td width="right" valign="bottom">
			<?php
				echo $lists['medals'];
			?>
		</td>

      		<td><?php echo JText::_('AWARDS_ADM_FILTER_USER'); ?>:<br>
				<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
      		</td>
      		
	  		</tr>
  		</table>
  		
		<table class="adminlist">
		<tr>
			<th width="20">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th align="left" nowrap>
			<a href="index.php?option=com_jawards&amp;task=awards&amp;sortby=award" title="<?php echo JText::_('AWARDS_ADM_ORDERBY_AWARD'); ?>"><?php echo JText::_('AWARDS_AWARD'); ?></a>
			</th>
			<th align="left" nowrap>
			<a href="index.php?option=com_jawards&amp;task=awards&amp;sortby=user" title="<?php echo JText::_('AWARDS_ADM_ORDERBY_AWARDED_TO'); ?>"><?php echo JText::_('AWARDS_ADM_AWARDED_TO'); ?></a>
			</th>
			<th align="left" nowrap>
			<a href="index.php?option=com_jawards&amp;task=awards&amp;sortby=date" title="<?php echo JText::_('AWARDS_ADM_ORDERBY_DATE'); ?>"><?php echo JText::_('AWARDS_DATE'); ?></a>
			</th>
		</tr>
		<?php
		$editLink="index.php?option=com_jawards&amp;task=editA&amp;hidemainmenu=1&amp;cid=";
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			
			$img = "<img src=\"../images/medals/$row->image\" border=\"0\" align=\"left\"/>";
			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				<?php echo $pageNav->getRowOffset( $i ); ?>
				</td>
				<td align="center">
					<?php 
					echo JHTML::_('grid.id', $i, $row->id ); ?> 
				</td>
				<td align="left">
				<a href="<?php echo $editLink.($row->id) ?>"  title="<?php echo JText::_('AWARDS_ADM_EDIT_AWARD'); ?>">
					<?php echo $img."&nbsp;";
 					echo $row->name; ?></a>
					
					
				</td>
				
				<td align="left">
				<?php echo $row->username; ?>
				</td>
				<td align="left">
				<?php echo $row->date; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		<tr>
        <th align="center" colspan="5">
          <?php echo $pageNav->getPagesLinks(); ?></th>
	    </tr>
        <tr>
        <td align="center" colspan="5">
          <?php echo $pageNav->getPagesCounter(); ?></td>
	    </tr>
		</table>
		

		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
		
		createFooter();
	}

	function awardForm( &$_row, &$lists, $_option, $showallusers ) {
?>
		<script language="javascript">
		<!--
<?php HTML_awards::createAutoReasonJS($lists['reason'], is_null($_row->userid)); ?>
		
		Joomla.submitbutton = function(pressbutton) {	
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var f = document.adminForm;
            if (document.formvalidator.isValid(f)) {
                f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
                submitform(pressbutton);    
            }
            else {
                var msg = new Array();
                msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_INVALID_INPUT')?>');
                if ($('userlist').hasClass('invalid')) {
                    msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_SELECT_USER')?>');    
                }
                if($('award').hasClass('invalid')){
                    msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_SELECT_AWARD')?>');
                }
                alert (msg.join('\n'));
                //TODO: validate entered date!
            }
		}
		//-->
		</script>
		<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
	    <input type="hidden" name="check" value="post"/>
		<table class="adminheading">
		<tr>
			<th>
			<?php echo JText::_('AWARDS_AWARD'); ?>
			<small>
			<?php echo $_row->id ? JText::_('AWARDS_ADM_EDIT') : JText::_('AWARDS_ADM_NEW') ;?>
			</small>
			</th>
		</tr>
		</table>
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo JText::_('AWARDS_ADM_DETAILS'); ?>
			</th>
		</tr>
				<tr>
				<td>
			<?php echo JText::_('AWARDS_ADM_USERID'); ?>
				</td>
				<td align="left">
								
				<?php 
				
				if ($showallusers){
					?>
						<input class="inputbox" readonly type="text" name="userid" class="required validate-numeric validate-dropselected" size="5" maxlength="10" valign="top" value="<?php echo $_row->userid; ?>">
						
						<?php echo $lists['users'];
				}
				 else{
				 	?>
				 		<input class="inputbox" type="text" name="userid" class="required validate-numeric validate-dropselected" size="5" maxlength="10" valign="top" value="<?php echo $_row->userid; ?>">
				 		<a href="#" onclick="document.adminForm.showallusers.value='true';document.adminForm.submit();"><?php echo JText::_('AWARDS_ADM_SHOW_USERS'); ?></a>
				 	<?php
				 	
				 }
						?> 
				</td>
				</tr>
		<tr>
			<td>
			<?php echo JText::_('AWARDS_MEDAL'); ?>:
			</td>
			<td align="left">
			<?php echo $lists['medals']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<span class="editlinktip">
					<?php echo JHTML::_('tooltip',JText::_('AWARDS_ADM_DATE_EXPLANATION'),JText::_('AWARDS_DATE'),'',JText::_('AWARDS_DATE'),'',false); ?>:
				</span>			
			</td>
			<td align="left">
			<input class="inputbox required" type="text" name="date" id="date" size="10" maxlength="10" valign="top" value="<?php echo $_row->date; ?>">
			</td>
		</tr>
		<tr>
			<td width="10%">
				<span class="editlinktip">
					<?php echo JHTML::_('tooltip',JText::_('AWARDS_ADM_REASON_EXPLANATION'),JText::_('AWARDS_REASON'),'',JText::_('AWARDS_REASON'),'',false);  ?>:
				</span>
			</td>
			<td>
			<textarea class="inputbox" cols="70" rows="5" name="reason"><?php 
				echo $_row->reason	?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="3">
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $_option; ?>">
		<input type="hidden" name="task" value="<?php echo ($_row->id) ?"editA" : "new" ;?>" />
		<input type="hidden" name="showallusers" value="<?php echo $showallusers; ?>">
		<input type="hidden" name="id" value="<?php echo $_row->id; ?>">
		</form>
<?php
	}
	
	function massAwardForm(&$lists, $_option) {
		
?>
		<script language="javascript">
		<!--	
<?php 
		HTML_awards::createAutoReasonJS($lists['reason']);
?>	
		function init() {
 			document.adminForm["seluserlist[]"].options[0] = null;
		}
		
		function turn(from, to) {

			var offered = new Array();
			var choosed = new Array();
			var entries = new Object(); // Assoc. array

			for(var i = 0; i < from.length; i++) {
				entries[from[i].text] = from[i].value;
				if(from[i].selected == true) { // search for selected entries
					choosed[choosed.length] = from[i].text; // append to array
				}
				else {
					offered[offered.length] = from[i].text;
				}
			}

			for(i = 0; i < to.length; i++) {
				entries[to[i].text] = to[i].value;
				choosed[choosed.length] = to[i].text;
			}

			from.length = 0; // delete to- and from-options
			to.length = 0;

			offered.sort(); // sort temp. lists
			choosed.sort();

			for(var j = 0; j < offered.length; j++) { // recreate from-list from temp
				from[j] = new Option(offered[j], entries[offered[j]]);
			}

			for(j = 0; j < choosed.length; j++) { // recreate to-list from temp
				to[j] = new Option(choosed[j], entries[choosed[j]]);
			}
		}
		
		Joomla.submitbutton = function(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			var f = document.adminForm;
            if (document.formvalidator.isValid(f)) {
                for(var j = 0; j < document.adminForm["seluserlist[]"].length; j++) {
                    document.adminForm["seluserlist[]"][j].selected = true; 
                }
                f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
                submitform(pressbutton);    
            } else {
                var msg = new Array();
                msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_INVALID_INPUT')?>');
                if ($('award').hasClass('invalid')) {
                    msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_SELECT_AWARD')?>');    
                }
                // TODO: check if user selected:
//                             } else if (document.adminForm["seluserlist[]"].length == 0){
//                 alert("<?php echo JText::_('AWARDS_ADM_ERROR_SELECT_USER'); ?>");
                // TODO: check entered date
                alert (msg.join('\n'));
            }
		}
		
		window.onload = init;
		//-->
		</script>
		<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
		<input type="hidden" name="check" value="post"/>
		<table class="adminheading">
		<tr>
			<th>
			<?php echo JText::_('AWARDS_ADM_MASS_AWARD'); ?>
			</th>
		</tr>
		</table>
		
		<table class="adminform">
		<tr>
			<th colspan="3">
			<?php echo JText::_('AWARDS_ADM_SELECT_USERS'); ?>
			</th>
		</tr>
		<tr>
			<td width="33%" style="text-align:center !important;">
				<span class="editlinktip">
<?php echo JHTML::_('tooltip', JText::_('AWARDS_ADM_SELECT_USERS_HINT'),JText::_('AWARDS_ADM_AVAILABLE_USERS'),'',JText::_('AWARDS_ADM_AVAILABLE_USERS'),'',false); ?>
				</span>
				<br />		
				<br />		
<?php echo $lists['users']; ?>
			</td>
			<td width="33%" style="text-align:center !important;">
				<input type="button" name="toLeft" value=" &lt; <?php echo JText::_('AWARDS_ADM_REMOVE'); ?>" onclick="turn(this.form['seluserlist[]'],this.form.userlist)" />
				<input type="button" name="toRight" value="<?php echo JText::_('AWARDS_ADM_ADD'); ?> &gt; " onclick="turn(this.form.userlist,this.form['seluserlist[]'])" />
			</td>
			<td width="33%" style="text-align:center !important;">
				<span class="editlinktip">
					<?php echo JHTML::_('tooltip', JText::_('AWARDS_ADM_SELECT_USERS_HINT'),JText::_('AWARDS_ADM_SELECTED_USERS'),'',JText::_('AWARDS_ADM_SELECTED_USERS'),'',false); ?>
				</span>
				<br />		
				<br />	
				<?php echo $lists['selusers']; ?>
			</td>
		</tr>
		</table>
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo JText::_('AWARDS_ADM_DETAILS'); ?>
			</th>
		</tr>
		<tr>
			<td>
			<?php echo JText::_('AWARDS_MEDAL'); ?>:
			</td>
			<td align="left">
			<?php echo $lists['medals']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<span class="editlinktip">
					<?php echo JHTML::_('tooltip', JText::_('AWARDS_ADM_DATE_EXPLANATION'),JText::_('AWARDS_DATE'),'',JText::_('AWARDS_DATE'),'',false); ?>:
				</span>
			</td>
			<td align="left">
				<input class="inputbox required" type="text" name="date" size="10" maxlength="10" valign="top" value="<?php echo date( 'Y-m-d' ) ?>">
			</td>
		</tr>
		<tr>
			<td width="10%">
				<span class="editlinktip">
					<?php echo JHTML::_('tooltip',JText::_('AWARDS_ADM_REASON_EXPLANATION'),JText::_('AWARDS_REASON'),'',JText::_('AWARDS_REASON'),'',false);  ?>:
				</span><br>
				<small><?php echo JText::_('AWARDS_ADM_FOR_ALL_USERS'); ?></small>
			</td>
			<td>
				<textarea class="inputbox" cols="70" rows="5" name="reason"></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $_option; ?>">
		<input type="hidden" name="task" value="">
		</form>
		<?php
	}
	
	/**
	 * Creates Javascript associations between medals and reasons,
	 * to fill the default reason
	 *
	 * @param $reasons: the array of default reasons 
	 * @param $doChange: whether to do the change (false when editing medals)
	 */
	function createAutoReasonJS($reasons, $doChange = true){
?>
	
		var reasons = new Array();
		reasons[0] = '';	
<?php
		foreach($reasons as $id => $reason)
		{
			if (is_null($reason))
				$reason = "";
			   
			echo "reasons[$id] = '".preg_replace('#\r?\n#', '\\n', addslashes($reason))."';\n";
		}
		
?>
		function changeDefaultReason() {
<?php
		if ($doChange){
?>
			var idx = getSelectedValue('adminForm','award');
			if (document.adminForm.award.value!=0 && reasons[idx] != '') {
				document.adminForm.reason.value=reasons[idx];
			}
<?php 
		}
?> 
		}
<?php 
	}
}

class HTML_medals {

	function showMedals( &$rows, &$pageNav, $option, &$search ) {
		$user = &JFactory::getUser();

		JHTML::_('behavior.tooltip');
		?>
		<form action="index.php" method="post" name="adminForm" id="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo JText::_('AWARDS_ADM_MEDALS_MANAGER'); ?>
			</th>
		</tr>
		</table>
		<p>
		<?php echo JText::_('AWARDS_ADM_MEDALS_MANAGER_EXPLANATION'); ?>
		</p>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="100%" class="sectionname"></td>
				<td nowrap="nowrap"><?php echo JText::_('AWARDS_ADM_DISPLAY'); ?> #<br>
				<?php echo $pageNav->getLimitBox(); ?>
				</td>
		
				<td><?php echo JText::_('AWARDS_ADM_FILTER_MEDAL'); ?>:<br>
				<input type="text" name="medalsearch" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
				</td>
			</tr>
		</table>
		<table class="adminlist">
			<tr valign="bottom">
				<th width="20px">
				#				</th>
			  <th width="20px">
				<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />				</th>
			  <th width="5%" colspan="2" align="center"><?php echo JText::_('AWARDS_ADM_REORDER'); ?></th>
			  <th width="2%" style="white-space:nowrap;"><?php echo JText::_('AWARDS_ADM_ORDER'); echo JHTML::_('grid.order', $rows, "filesave.png"); ?> </th>
			  <th align="left" nowrap>
				<?php echo JText::_('AWARDS_ADM_IMAGE'); ?>				</th>
				
			  <th align="left" nowrap>
				<?php echo JText::_('AWARDS_ADM_NAME'); ?>				</th>
				
		  </tr>
		<?php
		$editLink="index.php?option=com_jawards&amp;task=editmedalA&amp;hidemainmenu=1&amp;cid=";
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			$checked = JHTML::_('grid.id', $i, $row->id );
			
			$img = "<img src=\"../images/medals/$row->image\" border=\"0\" align=\"left\"/>";
			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				    <?php echo $pageNav->getRowOffset( $i );?>
				</td>
				<td align="center">
				    <?php //echo mosHTML::idBox($i, $row->id); ?>
                    <?php echo $checked; ?>
				</td>
				
				<td align="right">
				    <?php echo $pageNav->orderUpIcon( $i); ?>
				</td>
				<td align="left">
				    <?php echo $pageNav->orderDownIcon( $i, $n); ?>
				</td>
				<td align="center">
				    <input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				
				<td align="left">
					<a href="<?php echo $editLink.($row->id) ?>"  title="<?php echo JText::_('AWARDS_ADM_EDIT_MEDAL'); ?>"><?php echo $img; ?></a>
 									
				</td>
				
				<td align="left">
				<a href="<?php echo $editLink.($row->id) ?>"  title="<?php echo JText::_('AWARDS_ADM_EDIT_MEDAL'); ?>"><?php echo $row->name; ?></a>
				</td>
				
			</tr>
<?php
			$k = 1 - $k;
		}
?>
			<tr>
				<th align="center" colspan="7">
					<?php echo $pageNav->getPagesLinks(); ?>
				</th>
			</tr>
			<tr>
				<td align="center" colspan="7">
					<?php echo $pageNav->getPagesCounter(); ?>
				</td>
			</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="medals">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
		
		createFooter();
	}


	function showUploadsForm($option){
        ?>
                <script language="javascript">
                <!--
                    window.addEvent('domready', function() {
                        document.formvalidator.setHandler('imgfile',
                        function (value) {
                            regex=/\.jpg$|\.jpe$|\.jpeg$|\.gif$|\.png$/i;
                            return regex.test(value);
                        });
                    });
                    
               Joomla.submitbutton = function(pressbutton) {

                        var f = document.adminForm;
                        if (pressbutton == 'cancel') {
                                submitform( pressbutton );
                                return;
                        }
                        // do field validation
                        if (document.formvalidator.isValid(f)) {
                            f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
                            submitform(pressbutton);    
                        }
                        else {
                            alert("<?php echo JText::_('AWARDS_ADM_ERROR_WRONG_EXTENSION'); ?>");
                            }
                            // TODO: differentiate error:
//                         var entered_filename = trim(document.adminForm.medal_file.value);
//                         searchextension = new RegExp('\.jpg$|\.jpe$|\.jpeg$|\.gif$|\.png$','ig');
//                         searchextensiontest = searchextension.test(entered_filename);
//                         if (entered_filename < 1) {
//                                 alert( "<?php echo JText::_('AWARDS_ADM_ERROR_ENTER_FILE'); ?>" );
//                         } else if (searchextensiontest != true){
//                                 alert("<?php echo JText::_('AWARDS_ADM_ERROR_WRONG_EXTENSION'); ?>");
//  
//                          }else {
//                                 submitform( pressbutton );
//                         }
                }
                </script>
                <table class="adminheading">
                <tr>
                      <th>
                        <?php echo JText::_('AWARDS_ADM_MEDAL_IMAGE_UPLOAD'); ?>
                        </th>
                </tr>
                </table>
                <form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">
                <input type="hidden" name="check" value="post"/>
                <table class="adminform">
                <tr>
                        <th colspan="2">
                        <?php echo JText::_('AWARDS_ADM_MEDAL_IMAGE'); ?>
                        </th>
                </tr>
                <tr>
                        <td width="10%">
                        <?php echo JText::_('AWARDS_ADM_FILE'); ?>:
                        </td>
                        <td>
                               <input class="inputbox required validate-imgfile" type="file" name="medal_file" size="30" maxlength="60" valign="top" />

                        </td>
                </tr>
                </table>

                <input type="hidden" name="option" value="<?php echo $option; ?>">
                <input type="hidden" name="task" value="medals">
                <input type="hidden" name="hidemainmenu" value="1">
                </form>

        <?php
	}



	function medalForm( &$row, &$lists, $option ) {
		
		?>
		<script language="javascript">
		<!--
		function changeDisplayImage() {
			if (document.adminForm.image.value !='0') {
				document.adminForm.imagelib.src='../images/medals/' + document.adminForm.image.value;
			} else {
				document.adminForm.imagelib.src='images/blank.png';
			}
		}
		
  window.addEvent('domready', function() {
    document.formvalidator.setHandler('imglist',
    function (value) {
        return (value != '0')
    });
  });
  		
		Joomla.submitbutton = function(pressbutton) {
			if (pressbutton == 'cancelmedal') {
				submitform( pressbutton );
				return;
			}
			var f = document.adminForm;
            if (document.formvalidator.isValid(f)) {
                <?php 
                $editor = &JFactory::getEditor();
                echo $editor->save('desc_text');
                ?>
                f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
                submitform(pressbutton);    
            } else {
                var msg = new Array();
                msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_INVALID_INPUT')?>');
                if ($('name').hasClass('invalid')) {
                    msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_ENTER_MEDALNAME')?>');    
                }
                if($('image').hasClass('invalid')){
                    msg.push('<?php echo JText::_('AWARDS_ADM_ERROR_SELECT_IMAGE')?>');
                }
                alert (msg.join('\n'));
            }
		}
		//-->
		</script>
		<table class="adminheading">
		<tr>
			<th>
			<?php echo JText::_('AWARDS_MEDAL'); ?>:
			<small>
			<?php echo $row->id ? JText::_('AWARDS_ADM_EDIT') :  JText::_('AWARDS_ADM_NEW');?>
			</small>
			</th>
		</tr>
		</table>
		<p><?php echo JText::_('AWARDS_ADM_EDIT_MEDAL_EXPLANATION'); ?></p>
		<form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate">
		<input type="hidden" name="check" value="post"/>
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo JText::_('AWARDS_ADM_DETAILS'); ?>
			</th>
		</tr>
		<tr>
			<td width="10%">
			<?php echo JText::_('AWARDS_ADM_NAME'); ?>:
			</td>
			<td>
				<input class="inputbox required" type="text" name="name" id="name" size="30" maxlength="60" valign="top" value="<?php echo $row->name; ?>" />
			</td>
		</tr>
		<tr>
			<td width="10%">
			<?php echo JText::_('AWARDS_ADM_DESCRIPTION'); ?>:
			</td>
			<td>
			<?php 
			$editor =& JFactory::getEditor();
			echo $editor->display('desc_text',  $row->desc_text, '400', '400', '20', '20', false);
			   
            ?> 
			</td>
		</tr>
		<tr>
			<td width="10%">
			<?php echo JText::_('AWARDS_ADM_DEFAULTREASON'); ?>:
			</td>
			<td>
			<textarea class="inputbox" cols="70" rows="5" name="default_reason"><?php echo 
				$row->default_reason; ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="10%">
			<?php echo JText::_('AWARDS_ADM_IMAGE'); ?>:
			</td>
			<td>
			<?php echo $lists['image']; ?>
				</td>
				</tr>
				<tr>
				<td></td><td>
			<?php
		if (eregi("gif|jpg|png", $row->image)) {
			?>
				<img src="../images/medals/<?php echo $row->image; ?>" name="imagelib">
				<?php
			} else {
			?>
				<img src="images/blank.png" name="imagelib">
				<?php
}
		
			?>
			
			</td>
		</tr>
	
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="id" value="<?php echo $row->id; ?>">
		<input type="hidden" name="task" value="">
		</form>
		<?php
	}
}
function createFooter(){
	 
?>
	<div style="padding:10px;text-align:center">Powered by 
		<a href="http://www.arminhornung.de/Joomla/jAwards_en.html" target="_blank">
			<img style="border:0px;vertical-align:middle;" src="<?php echo JUri::base(false);?>components/com_jawards/images/medal_gold.png"/>jAwards
		</a> <?php echo jAwardsInterface::getVersion(); ?>
	</div>
<?php	
	
}
?>