CREATE TABLE `sline_qq_kefu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0',
  `qqname` varchar(50) DEFAULT NULL,
  `qqnum` varchar(20) DEFAULT NULL,
  `isopen` tinyint(3) DEFAULT '1',
  `displayorder` int(4) DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8