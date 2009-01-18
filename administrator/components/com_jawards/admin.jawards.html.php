<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

class HTML_awards {
	
	function config(&$ja_config, &$lists, $option){
		$rowcount = 0;
		?>
		<script language="javascript" type="text/javascript">
		<!--
  		function submitbutton(pressbutton) {
    		var form = document.adminForm;
    		if (pressbutton == 'cancel') {
      			submitform(pressbutton);
      			return;
    		}
		    
    		try {
    			document.adminForm.onsubmit();
    		}
    		catch(e){}
      		<?php getEditorContents('editor1', 'cfg_introtext') ; ?>
      		submitform(pressbutton);
    	}
		//-->
		</script>

		<form action="index2.php" method="post" name="adminForm">

		<table class="adminheading">
		<tr>
			<th>
			<?php echo _AWARDS_ADM_CONFIG; ?>
			</th>
			
		</tr>
		</table>
		
		<table cellpadding="4" cellspacing="0" border="0" width="95%" class="adminform">
		<tr align="center" valign="middle" class="row0">
        	<th width="20%">&nbsp;</th>
         	<th width="20%"><?php echo _AWARDS_ADM_CUR_SETTING; ?></th>
         	<th width="60%"><?php echo _AWARDS_ADM_EXPLANATION; ?></th>
      	</tr>
		<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
        	<td align="left" valign="top"><?php echo _AWARDS_ADM_INTROTEXT; ?></td>
         	<td align="left" valign="top">
      		<?php editorArea('editor1', $ja_config['introtext'] ,
                 'cfg_introtext', '500', '200', '70', '10') ; ?>
         	</td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_INTROTEXT_EXPLANATION; ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_NUMBERMEDALS; ?></td>
         	<td align="left" valign="top"><?php echo $lists['number_medals']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_NUMBERMEDALS_EXPLANATION; ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_NUMBERUSERS; ?></td>
         	<td align="left" valign="top"><?php echo $lists['number_users']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_NUMBERUSERS_EXPLANATION; ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_DATEFORMAT; ?></td>
         	<td align="left" valign="top"><?php echo $lists['date_format']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_DATEFORMAT_EXPLANATION; ?></td>
      	</tr>
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_REALNAME; ?></td>
         	<td align="left" valign="top"><?php echo $lists['realname']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_REALNAME_EXPLANATION; ?></td>
      	</tr>      	
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_CB_INTEGRATION; ?></td>
         	<td align="left" valign="top"><?php echo $lists['cbIntegration']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_CB_INTEGRATION_EXPLANATION; ?></td>
      	</tr>
        <tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_SHOWREASON; ?></td>
         	<td align="left" valign="top"><?php echo $lists['showawardReason']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_SHOWREASON_EXPLANATION; ?></td>
      	</tr>
		<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_GROUP; ?></td>
         	<td align="left" valign="top"><?php echo $lists['groupawards']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_GROUP_EXPLANATION; ?></td>
      	</tr>	
      	<tr align="center" valign="middle" class="row<?php $rowcount = ($rowcount+1)%2; echo $rowcount;?>">
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_CREDITS; ?></td>
         	<td align="left" valign="top"><?php echo $lists['showcredits']; ?></td>
         	<td align="left" valign="top"><?php echo _AWARDS_ADM_CREDITS_EXPLANATION; ?></td>
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
		global $my;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _AWARDS_ADM_AWARDS_MANAGER; ?>
			</th>
			
		</tr>
		</table>
		<p><?php echo _AWARDS_ADM_AWARDS_MANAGER_EXPLANATION; ?></p>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
      		<td width="100%" class="sectionname"></td>
		    <td nowrap="nowrap"><?php echo _AWARDS_ADM_DISPLAY; ?> #<br>
        		<?php echo $pageNav->writeLimitBox(); ?>
	        </td>
	        <td width="right" valign="bottom">
			<?php echo $lists['medals'];?>
		</td>

      		<td><?php echo _AWARDS_ADM_FILTER_USER; ?>:<br>
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
			<a href="index2.php?option=com_jawards&amp;task=list&amp;sortby=award" title="<?php echo _AWARDS_ADM_ORDERBY_AWARD; ?>"><?php echo _AWARDS_AWARD; ?></a>
			</th>
			<th align="left" nowrap>
			<a href="index2.php?option=com_jawards&amp;task=list&amp;sortby=user" title="<?php echo _AWARDS_ADM_ORDERBY_AWARDED_TO; ?>"><?php echo _AWARDS_ADM_AWARDED_TO; ?></a>
			</th>
			<th align="left" nowrap>
			<a href="index2.php?option=com_jawards&amp;task=list&amp;sortby=date" title="<?php echo _AWARDS_ADM_ORDERBY_DATE; ?>"><?php echo _AWARDS_DATE; ?></a>
			</th>
		</tr>
		<?php
		$editLink="index2.php?option=com_jawards&amp;task=editA&amp;hidemainmenu=1&amp;cid=";
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			
			$img = "<img src=\"../images/medals/$row->image\" border=\"0\" align=\"left\"/>";
			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td align="center">
					<?php echo mosHTML::idBox($i, $row->id); ?> 
				</td>
				<td align="left">
				<a href="<?php echo $editLink.($row->id) ?>"  title="<?php echo _AWARDS_ADM_EDIT_AWARD; ?>">
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
          <?php echo $pageNav->writePagesLinks(); ?></th>
	    </tr>
        <tr>
        <td align="center" colspan="5">
          <?php echo $pageNav->writePagesCounter(); ?></td>
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
<?php 
		HTML_awards::createAutoReasonJS($lists['reason'], is_null($_row->userid));
		
?>
		
		function submitbutton(pressbutton) {	
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			var entered_userid = trim(document.adminForm.userid.value);
			if (entered_userid < 1) {
				alert( "<?php echo _AWARDS_ADM_ERROR_SELECT_USER; ?>" );
			} else if (getSelectedValue('adminForm','award') < 1) {
				alert( "<?php echo _AWARDS_ADM_ERROR_SELECT_AWARD; ?>" );
			} else {
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<form action="index2.php" method="post" name="adminForm">
				
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _AWARDS_AWARD; ?>
			<small>
			<?php echo $_row->userid ? _AWARDS_ADM_EDIT : _AWARDS_ADM_NEW ;?>
			</small>
			</th>
		</tr>
		</table>
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo _AWARDS_ADM_DETAILS; ?>
			</th>
		</tr>
				<tr>
				<td>
			<?php echo _AWARDS_ADM_USERID; ?>
				</td>
				<td align="left">
								
				<?php 
				
				if ($showallusers){
					?>
						<input class="inputbox" readonly type="text" name="userid" size="5" maxlength="10" valign="top" value="<?php echo $_row->userid; ?>">
						
						<?php echo $lists['users'];
				}
				 else{
				 	?>
				 		<input class="inputbox" type="text" name="userid" size="5" maxlength="10" valign="top" value="<?php echo $_row->userid; ?>">
				 		<a href="index2.php?option=com_jawards&amp;task=new&amp;showallusers=true"><?php echo _AWARDS_ADM_SHOW_USERS; ?></a>
				 	<?php
				 	
				 }
						?> 
				</td>
				</tr>
		<tr>
			<td>
			<?php echo _AWARDS_MEDAL; ?>:
			</td>
			<td align="left">
			<?php echo $lists['medals']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<span class="editlinktip">
					<?php echo mosToolTip(_AWARDS_ADM_DATE_EXPLANATION,_AWARDS_DATE, 300,'',_AWARDS_DATE,'',false); ?>:
				</span>			
			</td>
			<td align="left">
			<input class="inputbox" type="text" name="date" size="10" maxlength="10" valign="top" value="<?php echo $_row->date; ?>">
			</td>
		</tr>
		<tr>
			<td width="10%">
				<span class="editlinktip">
					<?php echo mosToolTip(_AWARDS_ADM_REASON_EXPLANATION,_AWARDS_REASON, 300,'',_AWARDS_REASON,'',false);  ?>:
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
		<input type="hidden" name="id" value="<?php echo $_row->id; ?>">
		<input type="hidden" name="task" value="">
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
		
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancel') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (getSelectedValue('adminForm','award') < 1) {
				alert("<?php echo _AWARDS_ADM_ERROR_SELECT_AWARD; ?>");
			} else if (document.adminForm["seluserlist[]"].length == 0){
				alert("<?php echo _AWARDS_ADM_ERROR_SELECT_USER; ?>");
			} else{
				for(var j = 0; j < document.adminForm["seluserlist[]"].length; j++) {
  					document.adminForm["seluserlist[]"][j].selected = true; // Alle Eintraege selektieren und
 				}
				submitform( pressbutton );
			}
		}
		
		window.onload = init;
		//-->
		</script>
		<form action="index2.php" method="post" name="adminForm">
		
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _AWARDS_ADM_MASS_AWARD; ?>
			</th>
		</tr>
		</table>
		
		<table class="adminform">
		<tr>
			<th colspan="3">
			<?php echo _AWARDS_ADM_SELECT_USERS; ?>
			</th>
		</tr>
		<tr>
			<td width="33%" style="text-align:center !important;">
				<span class="editlinktip">
<?php echo mosToolTip(_AWARDS_ADM_SELECT_USERS_HINT,_AWARDS_ADM_AVAILABLE_USERS, 300,'',_AWARDS_ADM_AVAILABLE_USERS,'',false); ?>
				</span>
				<br />		
				<br />		
<?php echo $lists['users']; ?>
			</td>
			<td width="33%" style="text-align:center !important;">
				<input type="button" name="toLeft" value=" &lt; <?php echo _AWARDS_ADM_REMOVE; ?>" onclick="turn(this.form['seluserlist[]'],this.form.userlist)" />
				<input type="button" name="toRight" value="<?php echo _AWARDS_ADM_ADD; ?> &gt; " onclick="turn(this.form.userlist,this.form['seluserlist[]'])" />
			</td>
			<td width="33%" style="text-align:center !important;">
				<span class="editlinktip">
					<?php echo mosToolTip(_AWARDS_ADM_SELECT_USERS_HINT,_AWARDS_ADM_SELECTED_USERS, 300,'',_AWARDS_ADM_SELECTED_USERS,'',false); ?>
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
			<?php echo _AWARDS_ADM_DETAILS; ?>
			</th>
		</tr>
		<tr>
			<td>
			<?php echo _AWARDS_MEDAL; ?>:
			</td>
			<td align="left">
			<?php echo $lists['medals']; ?>
			</td>
		</tr>
		<tr>
			<td>
				<span class="editlinktip">
					<?php echo mosToolTip(_AWARDS_ADM_DATE_EXPLANATION,_AWARDS_DATE, 300,'',_AWARDS_DATE,'',false); ?>:
				</span>
			</td>
			<td align="left">
				<input class="inputbox" type="text" name="date" size="10" maxlength="10" valign="top" value="<?php echo date( 'Y-m-d' ) ?>">
			</td>
		</tr>
		<tr>
			<td width="10%">
				<span class="editlinktip">
					<?php echo mosToolTip(_AWARDS_ADM_REASON_EXPLANATION,_AWARDS_REASON, 300,'',_AWARDS_REASON,'',false);  ?>:
				</span><br>
				<small><?php echo _AWARDS_ADM_FOR_ALL_USERS; ?></small>
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
		global $my;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _AWARDS_ADM_MEDALS_MANAGER; ?>
			</th>
		</tr>
		</table>
		<p>
		<?php echo _AWARDS_ADM_MEDALS_MANAGER_EXPLANATION; ?>
		</p>
		<table cellpadding="4" cellspacing="0" border="0" width="100%">
			<tr>
				<td width="100%" class="sectionname"></td>
				<td nowrap="nowrap"><?php echo _AWARDS_ADM_DISPLAY; ?> #<br>
				<?php echo $pageNav->writeLimitBox(); ?>
				</td>
		
				<td><?php echo _AWARDS_ADM_FILTER_MEDAL; ?>:<br>
				<input type="text" name="medalsearch" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
				</td>
			</tr>
		</table>
		<table class="adminlist">
			<tr>
				<th width="20px">
				#
				</th>
				<th width="20px">
				<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />
				</th>
				<th colspan="2" align="center" width="5%"><?php echo _AWARDS_ADM_REORDER; ?></th>
				<th width="2%"><?php echo _AWARDS_ADM_ORDER; ?> <a href="javascript: saveorder( <?php echo count($rows)-1; ?> )"><img src="images/filesave.png" border="0" width="16" height="16" alt="Save Order" /></a></th>
				<th align="left" nowrap>
				<?php echo _AWARDS_ADM_IMAGE; ?>
				</th>
				
				<th align="left" nowrap>
				<?php echo _AWARDS_ADM_NAME; ?>
				</th>
				
			</tr>
		<?php
		$editLink="index2.php?option=com_jawards&amp;task=editmedalA&amp;hidemainmenu=1&amp;cid=";
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];
			
			$img = "<img src=\"../images/medals/$row->image\" border=\"0\" align=\"left\"/>";
			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td align="center">
				    <?php echo $pageNav->rowNumber( $i );?>
				</td>
				<td align="center">
				    <?php echo mosHTML::idBox($i, $row->id); ?>
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
					<a href="<?php echo $editLink.($row->id) ?>"  title="<?php echo _AWARDS_ADM_EDIT_MEDAL; ?>"><?php echo $img; ?></a>
 									
				</td>
				
				<td align="left">
				<a href="<?php echo $editLink.($row->id) ?>"  title="<?php echo _AWARDS_ADM_EDIT_MEDAL; ?>"><?php echo $row->name; ?></a>
				</td>
				
			</tr>
<?php
			$k = 1 - $k;
		}
?>
			<tr>
				<th align="center" colspan="7">
					<?php echo $pageNav->writePagesLinks(); ?>
				</th>
			</tr>
			<tr>
				<td align="center" colspan="7">
					<?php echo $pageNav->writePagesCounter(); ?>
				</td>
			</tr>
		</table>

		<input type="hidden" name="option" value="<?php echo $option; ?>">
		<input type="hidden" name="task" value="listmedals">
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
                function submitbutton(pressbutton) {

                        var form = document.adminForm;
                        if (pressbutton == 'cancel') {
                                submitform( pressbutton );
                                return;
                        }
                        // do field validation
                        var entered_filename = trim(document.adminForm.medal_file.value);
                        searchextension = new RegExp('\.jpg$|\.jpe$|\.jpeg$|\.gif$|\.png$','ig');
                        searchextensiontest = searchextension.test(entered_filename);
                        if (entered_filename < 1) {
                                alert( "<?php echo _AWARDS_ADM_ERROR_ENTER_FILE; ?>" );
                        } else if (searchextensiontest != true){
                                alert("<?php echo _AWARDS_ADM_ERROR_WRONG_EXTENSION; ?>");
 
                         }else {
                                submitform( pressbutton );
                        }
                }
                //-->
                </script>
                <table class="adminheading">
                <tr>
                      <th>
                        <?php echo _AWARDS_ADM_MEDAL_IMAGE_UPLOAD; ?>
                        </th>
                </tr>
                </table>
                <form action="index2.php" method="post" name="adminForm" enctype="multipart/form-data">
                <table class="adminform">
                <tr>
                        <th colspan="2">
                        <?php echo _AWARDS_ADM_MEDAL_IMAGE; ?>
                        </th>
                </tr>
                <tr>
                        <td width="10%">
                        <?php echo _AWARDS_ADM_FILE; ?>:
                        </td>
                        <td>
                               <input class="inputbox" type="file" name="medal_file" size="30" maxlength="60" valign="top" />

                        </td>
                </tr>
                </table>

                <input type="hidden" name="option" value="<?php echo $option; ?>">
                <input type="hidden" name="task" value="listmedals">
                <input type="hidden" name="hidemainmenu" value="1">
                </form>

        <?php
	}



	function medalForm( &$row, &$lists, $option ) {
		
		?>
		<script language="javascript">
		<!--
		function changeDisplayImage() {
			if (document.adminForm.image.value !='') {
				document.adminForm.imagelib.src='../images/medals/' + document.adminForm.image.value;
			} else {
				document.adminForm.imagelib.src='images/blank.png';
			}
		}		
		
		function submitbutton(pressbutton) {
			var form = document.adminForm;
			if (pressbutton == 'cancelmedal') {
				submitform( pressbutton );
				return;
			}
			// do field validation
			if (form.name.value == "") {
				alert( "<?php echo _AWARDS_ADM_ERROR_ENTER_MEDALNAME; ?>" );
			} else if (!getSelectedValue('adminForm','image')) {
				alert( "<?php echo _AWARDS_ADM_ERROR_SELECT_IMAGE; ?>" );
			} else {
				<?php getEditorContents('editor1', 'desc_text') ; ?>
				submitform( pressbutton );
			}
		}
		//-->
		</script>
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _AWARDS_MEDAL; ?>:
			<small>
			<?php echo $row->id ? _AWARDS_ADM_EDIT :  _AWARDS_ADM_NEW;?>
			</small>
			</th>
		</tr>
		</table>
		<p><?php echo _AWARDS_ADM_EDIT_MEDAL_EXPLANATION; ?></p>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminform">
		<tr>
			<th colspan="2">
			<?php echo _AWARDS_ADM_DETAILS; ?>
			</th>
		</tr>
		<tr>
			<td width="10%">
			<?php echo _AWARDS_ADM_NAME; ?>:
			</td>
			<td>
				<input class="inputbox" type="text" name="name" size="30" maxlength="60" valign="top" value="<?php echo $row->name; ?>" />
			</td>
		</tr>
		<tr>
			<td width="10%">
			<?php echo _AWARDS_ADM_DESCRIPTION; ?>:
			</td>
			<td>
			<?php editorArea('editor1', $row->desc_text ,
                 'desc_text', '500', '200', '70', '10') ; ?> 
			</td>
		</tr>
		<tr>
			<td width="10%">
			<?php echo _AWARDS_ADM_DEFAULTREASON; ?>:
			</td>
			<td>
			<textarea class="inputbox" cols="70" rows="5" name="default_reason"><?php echo 
				$row->default_reason; ?></textarea>
			</td>
		</tr>
		<tr>
			<td width="10%">
			<?php echo _AWARDS_ADM_IMAGE; ?>:
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
		global $mosConfig_live_site, $ja_config;
		
	 
?>
	<div style="padding:10px;text-align:center">Powered by 
		<a href="http://www.arminhornung.de/index.php?section=Joomla&amp;file=jAwards&amp;l=en" target="_blank">
			<img style="border:0px;vertical-align:middle;" src="<?php echo $mosConfig_live_site;?>/administrator/components/com_jawards/images/medal_gold.png"/>jAwards
		</a> v0.9
	</div>
<?php	
	
}
?>