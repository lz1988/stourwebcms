CREATE TABLE `sline_spot_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL COMMENT 'sline对应ID',
  `attrname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `displayorder` int(11) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `issystem` int(1) DEFAULT '0',
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='车务品牌表'