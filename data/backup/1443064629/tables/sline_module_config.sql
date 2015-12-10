CREATE TABLE `sline_module_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL COMMENT '页面ID',
  `pagename` varchar(255) DEFAULT NULL,
  `shortname` varchar(255) DEFAULT NULL COMMENT '前台调用标识',
  `typeid` int(11) unsigned DEFAULT '0',
  `moduleids` varchar(255) DEFAULT NULL COMMENT '存储需要显示模块id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='模块配置表'