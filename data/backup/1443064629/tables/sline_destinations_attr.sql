CREATE TABLE `sline_destinations_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(1) unsigned DEFAULT '0',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `issystem` int(1) unsigned DEFAULT '0',
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8