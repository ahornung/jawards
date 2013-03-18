<?php
/*************************************************************
 * JAwards - The Joomla Awards Component
 * Author: Armin Hornung @  www.arminhornung.de
 * Released under GNU/GPL License : 
 * http://www.gnu.org/copyleft/gpl.html
 *************************************************************/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');
// TODO: move everything from controller to separate classes
jimport('joomla.html.pagination');

// config file:
class JAwardsController extends JController
{
    function listusers(){
        // config file:
        require(JPATH_ADMINISTRATOR.DS.'components/com_jawards'.DS."config.jawards.php");
        $award = JRequest::getInt( 'award' , 0 );
        // TODO:  $jAwards_Config['number_awards']
        $limit = JRequest::getInt( 'limit',15);
        $limitstart = JRequest::getInt( 'limitstart', 0);
        $option = JRequest::getVar('option', 'com_jawards');
        
        $database = &JFactory::getDbo();
        
        $grouping = $jAwards_Config['groupawards'];
        // get number of users for pagination:
        $query = "SELECT COUNT(";
        if ($grouping)
            $query .= "DISTINCT ";
        $query .="userid) FROM #__jawards_awards" 
                    . "\n WHERE award = $award";
            
        $database->setQuery($query);
        $total = $database->loadResult();

        // Load the users:
        $selname = ($jAwards_Config['realname'])?"u.name as username":"u.username";
        $query = "SELECT ua.*,$selname, u.id AS userid";
        if ($grouping)
            $query .=", COUNT(ua.userid) AS count";
        $query .= " FROM #__jawards_awards as ua"
        . "\n LEFT JOIN #__users AS u ON u.id = ua.userid"
        . "\n WHERE ua.award = $award";
        if ($grouping)
            $query .= "\n GROUP BY u.id";
        
        $query .= "\n ORDER BY username"
            . " \n LIMIT $limitstart,$limit";
            
        $database->setQuery( $query );
        if(!$result = $database->query()) {
            echo $database->stderr();
            return false;
        }
        $rows = $database->loadObjectList();
        
        // Load Award details:
        $query = "SELECT * FROM #__jawards_medals WHERE id=$award";
        $database->setQuery( $query );

        if(!$result = $database->query()) {
            echo $database->stderr();
            return false;
        }
        
        $awardres = $database->loadObject();
        $pageNav = new JPagination($total, $limitstart, $limit);
        
        // TODO: view!
        // include CSS template:
        $template = '<link type="text/css" rel="stylesheet" href="' .  JUri::base(true).'/components/com_jawards/template.css" />';
        JFactory::getDocument()->addCustomTag($template);
        
        echo "<div class=\"ja_award_details\"><img class=\"ja_medal\" src=\"images/medals/$awardres->image\"><h3> $awardres->name</h3>";
        echo "<p>$awardres->desc_text</p></div>";
        if (count($rows)==0){
            echo JText::_('AWARDS_NO_USERS');
        }
        else {
            echo "<p>".JText::_('AWARDS_FOLLOWING_USERS_AWARDED')."</p>";

            
            
            ?>
            
            <!--TODO: <form action="index.php" id="medalsForm" name="awardForm" method="post">
                            <div align="right">
                                <?php echo JText::_('AWARDS_ADM_DISPLAY')."# "; echo $pageNav->getLimitBox("index.php?option=$option&task=listusers&award=$awardres->id"); ?>
                            </div>
                            <input type="hidden" name="option" value="<?php echo $option ?>" />
                            <input type="hidden" name="limit" value="<?php echo $pageNav->limit;?>" />
                            <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart;?>" />
                            <input type="hidden" name="Itemid" value="<?php echo $menuItem->id;?>" />
                        </form>
                -->
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
            <div align="center"><?php echo $pageNav->getPagesLinks("index.php?option=$option&task=listusers&award=$awardres->id"). "<br />";
                                      echo $pageNav->getPagesCounter() ?></div>
            
            
            
            <div class="back_button"><a href="<?php echo JRoute::_("index.php?option=$option"); ?> "><?php echo JText::_('AWARDS_BACK_OVERVIEW') ?></a></div>
            
<?php   
        }
    if ($jAwards_Config['showcredits'])
        $this->createFooter();   
        
    
    }
    
    function listmedals(){
        require(JPATH_ADMINISTRATOR.DS.'components/com_jawards'.DS."config.jawards.php");
        
        // TODO: model!
        // TODO:  $jAwards_Config['number_medals']
        $limit = JRequest::getInt( 'limit',15);
        $limitstart = JRequest::getInt( 'limitstart', 0);
        $option     = 'com_jawards';
        
        $database = &JFactory::getDbo();
        
        // get number of medals for pagination:
        $query = "SELECT COUNT(*) FROM #__jawards_medals";
        $database->setQuery($query);
        $total = $database->loadResult();

        $query = "SELECT a.*, COUNT(b.award) AS count FROM #__jawards_medals AS a"
            . " \n LEFT OUTER JOIN #__jawards_awards AS b"
            . " \n ON a.id=b.award"
            . " \n GROUP BY a.id"
            . "\n ORDER BY a.ordering,a.name"
            . " \n LIMIT $limitstart,$limit";
        
        $database->setQuery( $query );

        if(!$result = $database->query()) {
            echo $database->stderr();
            return false;
        }
        $rows = $database->loadObjectList();

        
        $pageNav = new JPagination($total, $limitstart, $limit);
        
        // TODO: view !
        
        //$mainframe = &JFactory::getApplication();
        // include CSS template:
        $template = '<link type="text/css" rel="stylesheet" href="' . JUri::base(true) .'/components/com_jawards/template.css" />';
        JFactory::getDocument()->addCustomTag($template);

        echo ("<div class=\"componentheading\">". JText::_('AWARDS_HEADING') ."</div>");
        echo ("<p class=\"ja_introtext\">".$jAwards_Config['introtext']."</p>");
                
                ?>
               <!-- TODO <form action="index.php" id="medalsForm" name="medalsForm" method="post">
                    <div align="right">
                            <?php echo JText::_('AWARDS_ADM_DISPLAY')."# "; echo $pageNav->getLimitBox("index.php?option=$option"); ?>
                    </div>
                    <input type="hidden" name="limit" value="<?php echo $pageNav->limit;?>" />
                    <input type="hidden" name="limitstart" value="<?php echo $pageNav->limitstart;?>" />
                </form>
                -->
                <?php
        foreach($rows as $row){
            echo "<div class=\"ja_award_list\"><h3>$row->name</h3>
                <p><img class=\"ja_medal\" alt=\"$row->image\" src=\"images/medals/$row->image\">
                $row->desc_text</p>";
            if ($row->count){
                echo "<p><a href=\"".JRoute::_("index.php?option=$option&task=listusers"
                . "&award=$row->id"). "\" class=\"readon\">($row->count " .JText::_('AWARDS_AWARDED').")</a></p></div>";
                }
            else{
                echo "<p><span class=\"readon\">(0 ".JText::_('AWARDS_AWARDED').")</span></p></div>";
            }
                
            
        }
        
        ?>
        
        <div align="center"><?php echo $pageNav->getPagesLinks("index.php?option=$option"). "<br />";
                                      echo $pageNav->getPagesCounter() ?></div>
        
        <?php      
        if ($jAwards_Config['showcredits'])
            $this->createFooter();
    
    }
    
    function createFooter(){ 
?>
    <div class="ja_footer">Powered by 
        <a href="http://www.arminhornung.de/Joomla/jAwards_en.html" target="_blank">
            <img src="<?php echo JUri::base(false);?>administrator/components/com_jawards/images/medal_gold.png"/>jAwards
        </a>
    </div>
<?php   
        }
    
}

?>
