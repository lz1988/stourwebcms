CREATE TABLE `sline_search_keyword` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) DEFAULT NULL,
  `keynumber` int(11) unsigned DEFAULT '1',
  `displayorder` int(4) DEFAULT '9999' COMMENT '排序',
  `isopen` int(1) DEFAULT '0' COMMENT '是否开启',
  `addtime` int(10) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='搜索词表'