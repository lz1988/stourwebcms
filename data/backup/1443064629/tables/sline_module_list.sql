CREATE TABLE `sline_module_list` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(11) unsigned DEFAULT NULL COMMENT '模块id',
  `webid` int(2) unsigned DEFAULT '1',
  `modulename` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `body` mediumtext COMMENT '模块内容',
  `issystem` int(1) unsigned DEFAULT '0',
  `type` int(1) DEFAULT '0' COMMENT '模块类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='右侧模块列表'