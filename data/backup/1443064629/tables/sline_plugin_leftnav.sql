CREATE TABLE `sline_plugin_leftnav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL,
  `pid` int(11) unsigned DEFAULT NULL,
  `linkurl` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned NOT NULL DEFAULT '9999',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1',
  `litpic` varchar(200) DEFAULT NULL COMMENT '图标',
  `remark` varchar(200) DEFAULT NULL COMMENT '自定义说明',
  PRIMARY KEY (`id`),
  KEY `IDX_PID_DISPLAYORDER` (`pid`,`displayorder`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8