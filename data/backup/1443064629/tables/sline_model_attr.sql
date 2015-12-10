CREATE TABLE `sline_model_attr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) NOT NULL DEFAULT '0' COMMENT '站点id',
  `typeid` int(11) NOT NULL COMMENT '模型id',
  `attrname` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isopen` int(11) unsigned DEFAULT '0',
  `issystem` int(11) unsigned DEFAULT '0',
  `pid` int(10) DEFAULT NULL,
  `destid` varchar(255) DEFAULT NULL,
  `litpic` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='扩展模块属性表'