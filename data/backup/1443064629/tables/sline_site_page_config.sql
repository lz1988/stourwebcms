CREATE TABLE `sline_site_page_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT NULL COMMENT '子站id',
  `pageid` int(11) unsigned DEFAULT NULL COMMENT '页面id',
  `path` varchar(255) DEFAULT NULL COMMENT '模板路径',
  `isuse` tinyint(1) unsigned DEFAULT '0' COMMENT '是否使用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='子站用户页面配置表'