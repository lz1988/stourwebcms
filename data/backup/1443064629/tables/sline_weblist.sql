CREATE TABLE `sline_weblist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webname` varchar(255) DEFAULT NULL COMMENT '网站名称',
  `weburl` varchar(255) DEFAULT NULL COMMENT '网站地址',
  `webid` int(11) DEFAULT NULL,
  `webroot` varchar(255) DEFAULT NULL,
  `webprefix` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_WEBID_WEBPREFIX` (`webid`,`webprefix`) USING BTREE,
  KEY `IDX_WEBID_WEBURL` (`webid`,`weburl`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='sline网站列表'