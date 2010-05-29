CREATE TABLE IF NOT EXISTS `#__jawards_medals` (
`id` int(11) NOT NULL auto_increment,
`ordering` int(11) NOT NULL default '0',
`image` tinytext NOT NULL,
`name` tinytext NOT NULL,
`desc_text` text,
`default_reason` text,
PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
		  
CREATE TABLE IF NOT EXISTS `#__jawards_awards` (
`id` int(11) NOT NULL auto_increment,
`userid` int(11) NOT NULL,
`award` int(11) NOT NULL,
`date` date NOT NULL default '2000-01-01',
`reason` text,
PRIMARY KEY  (`id`),
INDEX idx_userid (`userid`),
INDEX idx_award (`award`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;