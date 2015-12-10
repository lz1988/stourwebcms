CREATE TABLE `sline_plugin_nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL,
  `pid` int(11) unsigned DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned NOT NULL DEFAULT '9999',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8