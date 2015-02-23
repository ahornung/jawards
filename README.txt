jAwards: User-Awards in Joomla!
===================================

Copyright 2005-2009, Armin Hornung
http://www.arminhornung.de

Released under GNU/GPL License : 
http://www.gnu.org/copyleft/gpl.html


INSTALLATION:
=============

Just install the component in the Backend of Joomla! and the corresponding 
version of the Community Builder plugin in the CB configuration. After that, 
you can start creating medals and handing them out in the backend.

Additionally, you can provide an overview of medals and who got which one by 
creating a link to the jAwards-Component in the Menu Manager.


UPGRADING:
==========

 * General:

!!!Important!!! First of all, backup your database! There are changes in the 
database structure in versions 0.5 and 0.9, so the database has to be modified 
by the installation script when upgrading.

Make note of your settings or save your config file and the CSS if you made 
some changes. Then, uninstall the component. Your medals and awards will remain.
Install the jAwards-component as described above, and check the output of the 
installation script. 

To upgrade the CB-Plugin to the latest version also just uninstall it, and 
install the newest version available.


 * Upgrading from pre-0.9:
After upgrading you can re-order medals in the Medals Manager. You can also 
assign a default reason in the "Edit Medal" view.


 * Upgrading from pre-0.5:
You should edit all your existing medals and give them a description for the 
Frontend overview. You can also add a "reason" to each award you already handed
out.




CB-PLUGIN:
==========

To display the medals in the user profiles (managed by Community Builder), you 
need to install the CB-plugin for jAwards (and publish it afterwards!). 

The currently newest version (0.5) requires jAwards 1.0 or later.

The plugin displays the awards just how they are configured in jAwards itself
(reason, date formatting...)
The information link at the end of the tab points to the new jAwards frontend, 
but can be disabled or pointed somewhere else too.


FORUM INTEGRATION:
Download the latest file for Simpleboard / Joomlaboard / Fireboard Integration 
from the "Docs" section at Joomlacode.org and follow the instructions there.



Detailed information is available at 

http://joomlacode.org/gf/project/jawards/ 
    or
http://www.arminhornung.de/Joomla/jAwards_en.html


CHANGELOG:
==========

v1.0: 2009-07-05
==================
- no changes to 1.0 beta, all tests successful

v1.0 (beta1): 2009-03-28
==================
- added optional display of real name instead of username
- feature #11458: WYSIWYG-editor for backend texts 
- improved usability in medal form
- added API for other components to access jAwards functionality 
    (adding / deleting medals and awards, user's awards...)
    see documentation of file jawards.interface.php
- added optional notificaion of users upon receiving a new award


v0.91: 2008-10-18
==================
- bugfix #12871: config declared global for J1.5
- Added DB-indices for improved performance
- small corrections in CSS and French language

v0.9: 2008-06-04
==================
- revised Mass-awarding for better usability
- added "default reason" for medals. Reason for an award is pre-filled
    with default reason when handing out a new award
- added formatting options for dates in Frontend
- medals can be (re)ordered manually
- fixed awards when using more than 127 medals
- added Dutch language (few constants missing)

v0.8: 2008-01-27
==================
- added Backend internationalization, available languages:
	English, German, French
- added introductory text configuration option
- added grouping config option. To use grouping in the CB plugin, you
	need to use the newest version of the plugin (0.4)
- added frontend CSS styling, check template.css in components/com_jawards/
- added frontend pagination

v0.72: 2007-05-31
==================
- Frontend ItemID fixed when missing
- Medal upload in backend is possible again, with implementation
	independent of Joomla! Mediamanager


v0.7: 2007-03-21
==================
- Implemented sorting options in backend, just click column titles.
- With mass-awarding, one can one give multiple users the same medal
    at once


v0.65: 2006-09-11
==================
- Improved Backend usability: Award names link to medals or awards now
- Fixed search for user in Awards Management (Backend)
- Fixed Frontend to be compatible with register_globals set to OFF

v0.6: 2006-06-19
==================
- Deletion of not needed medals is now possible in Medal 
	Management.
- Frontend language file inclusion (different from English)
	fixed.
- When handing out a new award, the complete list of users
	is only displayed on request - instead it's possible to
	enter just a userid for performance on sites with a large
	number of members

v0.51: 2006-04-24
==================
- Frontend Awards display fixed for MySQL 4.0 compatibility

v0.5: 2006-04-05
==================
- Change in Database structure, so a modifying SQL-Script is
	necessary. New Columns in medal and award, and renamed 
	table for standard-conformity (#__jawards_...)
- Fix: Users in all kinds of lists are now sorted by Username
- first Frontend implementation: Displays information about the 
	medals, and users awarded with the medals
- Medals are now associated with an descriptive text (see above),
	which can be entered in the backend
- An Award now comes along with an optional reason for the award
- Configurational page in the backend added


v0.4: 2006-01-07
==================
- Uploaded Medal images are now selectable with displayed image
	when creating or editing medals
- Fix in pagination when search filter active in medals / awards

v0.3: 2006-01-03
==================
- Medals and Awards list is now searchable

v0.2: 2005-12-26
==================
- The CB-plugin (Version 0.2 at least) now reads the language
	files in the subfolder /language/ of the component.
- Installation fixes: /images/medals is now created and SQL 
	query fix
- re-branding to "jAwards" along with moving everything to
	the Joomlaforge
	
v0.11: 2005-12-21
==================
- corrected SQL creation query in install file of component

v0.1: 2005-12-15
==================
- basic functions
- the "medals" folder has to be created manually via FTP!
- Links and language still hardcoded
 
