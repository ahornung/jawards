<?php

/*****************************************
* English language file for jAwards
*
* Author: Armin Hornung
******************************************/


// Frontend Language constants:
DEFINE ('_AWARDS_HEADING', 'Medals Overview');
DEFINE ('_AWARDS_INFORMATION', 'Information about the Awards');
DEFINE ('_AWARDS_AWARD', 'Award');
DEFINE ('_AWARDS_MEDAL', 'Medal');
DEFINE ('_AWARDS_DATE', 'Date awarded');
DEFINE ('_AWARDS_REASON', 'Reason for Award');
DEFINE ('_AWARDS_NOAWARD', 'The user has received no awards yet.');
DEFINE ('_AWARDS_NAME', 'Name');
DEFINE ('_AWARDS_USER', 'User');
DEFINE ('_AWARDS_USERS', 'Users');
DEFINE ('_AWARDS_AWARDED', 'awarded');
DEFINE ('_AWARDS_FOLLOWING_USERS_AWARDED', 'The following Users were awarded with this medal:');
DEFINE ('_AWARDS_NO_USERS', 'No users were awarded with this medal yet.');
DEFINE ('_AWARDS_YES','Yes');
DEFINE ('_AWARDS_NO','No');
DEFINE ('_AWARDS_BACK_OVERVIEW','Back to medal overview');

// Backend Language constants:
DEFINE ('_AWARDS_ADM_CONFIG','jAwards Configuration');
DEFINE ('_AWARDS_ADM_CUR_SETTING','Current Setting');
DEFINE ('_AWARDS_ADM_EXPLANATION','Explanation');
DEFINE ('_AWARDS_ADM_CB_INTEGRATION','Community Builder Integration');
DEFINE ('_AWARDS_ADM_CB_INTEGRATION_EXPLANATION','Makes all names in Award-lists links to the CB-Userprofile');
DEFINE ('_AWARDS_ADM_GROUP','Group Awards');
DEFINE ('_AWARDS_ADM_GROUP_EXPLANATION','Displays multiple identical awards as one group with the total quantity. Only the first date and reason are shown in the frontend.');
DEFINE ('_AWARDS_ADM_SHOWREASON','Show award reason');
DEFINE ('_AWARDS_ADM_SHOWREASON_EXPLANATION','Enables the output of a text describing the reason for the award in all Award-lists. The reason can be given when handing out a medal.');
DEFINE ('_AWARDS_ADM_INTROTEXT','Frontend introductory text');
DEFINE ('_AWARDS_ADM_INTROTEXT_EXPLANATION','A short explaining introductory text that can be displayed at the front end. Leave empty if you do not wish to use this.');
DEFINE ('_AWARDS_ADM_AWARDS_MANAGER','Awards Manager');
DEFINE ('_AWARDS_ADM_AWARDS_MANAGER_EXPLANATION','Here is where you hand out existing medals, edit or delete already awarded ones. You may need to create some medals in the Medals Manager first!');
DEFINE ('_AWARDS_ADM_DISPLAY','Display');
DEFINE ('_AWARDS_ADM_FILTER_USER','Filter User');
DEFINE ('_AWARDS_ADM_ORDERBY_AWARD','Order by name of award alphabetically');
DEFINE ('_AWARDS_ADM_AWARDED_TO','Awarded to');
DEFINE ('_AWARDS_ADM_ORDERBY_AWARDED_TO','Order by name of user alphabetically');
DEFINE ('_AWARDS_ADM_ORDERBY_DATE','Order by date descending');
DEFINE ('_AWARDS_ADM_EDIT_AWARD','Edit Award');
DEFINE ('_AWARDS_ADM_ERROR_SELECT_USER','Please select an user to give the award to.');
DEFINE ('_AWARDS_ADM_ERROR_SELECT_AWARD','Please select an award to hand out.');
DEFINE ('_AWARDS_ADM_EDIT','edit');
DEFINE ('_AWARDS_ADM_NEW','new');
DEFINE ('_AWARDS_ADM_DETAILS','Details');
DEFINE ('_AWARDS_ADM_USERID','UserId');
DEFINE ('_AWARDS_ADM_SHOW_USERS','Show users');
DEFINE ('_AWARDS_ADM_MASS_AWARD','Mass-award users:');
DEFINE ('_AWARDS_ADM_SELECT_USERS','Select Users');
DEFINE ('_AWARDS_ADM_SELECT_USERS_HINT','(hold CTRL to select multiple ones)');
DEFINE ('_AWARDS_ADM_FOR_ALL_USERS','(for all users)');
DEFINE ('_AWARDS_ADM_MEDALS_MANAGER','Medal Manager');
DEFINE ('_AWARDS_ADM_MEDALS_MANAGER_EXPLANATION','New Medals can be created here, and existing ones edited or deleted. Medal images are uploaded to /images/medals/ in the path of your Joomla-installation, and need to exist before creating a medal in the manager.');
DEFINE ('_AWARDS_ADM_FILTER_MEDAL','Filter Medal');
DEFINE ('_AWARDS_ADM_IMAGE','Image');
DEFINE ('_AWARDS_ADM_NAME','Name');
DEFINE ('_AWARDS_ADM_EDIT_MEDAL','Edit Medal');
DEFINE ('_AWARDS_ADM_ERROR_ENTER_MEDALNAME','Please fill in the name of your medal.');
DEFINE ('_AWARDS_ADM_ERROR_SELECT_IMAGE','Please select an image as medal.');
DEFINE ('_AWARDS_ADM_EDIT_MEDAL_EXPLANATION','Make sure the medal images exists in the directory /images/medals/ of your Joomla-installation, or upload it now with the button "Upload"!');
DEFINE ('_AWARDS_ADM_DESCRIPTION','Description');
DEFINE ('_AWARDS_ADM_ERROR_ENTER_FILE','Please enter a filename to upload!');
DEFINE ('_AWARDS_ADM_ERROR_WRONG_EXTENSION','Only JPEG, GIF or PNG images are valid uploads');
DEFINE ('_AWARDS_ADM_MEDAL_IMAGE_UPLOAD','Medal Image Upload');
DEFINE ('_AWARDS_ADM_MEDAL_IMAGE','Medal Image');
DEFINE ('_AWARDS_ADM_FILE','File');
DEFINE ('_AWARDS_ADM_SELECT_USER','Select User');
DEFINE ('_AWARDS_ADM_SELECT_MEDAL','Select Medal');
DEFINE ('_AWARDS_ADM_NUMBERMEDALS','Default number of medals in frontend');
DEFINE ('_AWARDS_ADM_NUMBERMEDALS_EXPLANATION','Number of medals to display in the frontend medal overview per page. Multiplies of 5 are recommended to correspond with the dropdown-list to change the number.');
DEFINE ('_AWARDS_ADM_NUMBERUSERS','Default number of users in lists');
DEFINE ('_AWARDS_ADM_NUMBERUSERS_EXPLANATION','Number of users to display in the frontend per page. Multiplies of 5 are recommended to correspond with the dropdown-list to change the number.');

// new in 0.9:
DEFINE ('_AWARDS_ADM_ORDER','Order');
DEFINE ('_AWARDS_ADM_REORDER','Reorder');
DEFINE ('_AWARDS_ADM_DEFAULTREASON','Default reason for this medal');
DEFINE ('_AWARDS_ADM_DATEFORMAT','Date formatting');
DEFINE ('_AWARDS_ADM_DATEFORMAT_EXPLANATION','Format of the date of handing out the award. Spelled-out month names are written according to the setting of your Locale in the Joomla config or on the server.');
DEFINE ('_AWARDS_ADM_DATE_EXPLANATION','Please enter the date in the ISO standard YYYY-MM-DD. In the jAwards config, you can set up how the date is formatted for the Frontend.');
DEFINE ('_AWARDS_ADM_REASON_EXPLANATION','Will be shown to the users in the Frontend only when enabled in the general jAwards config. A default reason will be pre-filled for new awards, when you entered one for the medal.');
DEFINE ('_AWARDS_ADM_AVAILABLE_USERS','Available users');
DEFINE ('_AWARDS_ADM_SELECTED_USERS','Selected users');
DEFINE ('_AWARDS_ADM_ADD','add');
DEFINE ('_AWARDS_ADM_REMOVE','remove');
DEFINE ('_AWARDS_ADM_CREDITS','Show credits');
DEFINE ('_AWARDS_ADM_CREDITS_EXPLANATION','Show Credits (link to jAwards homepage) in Frontend');

?>
