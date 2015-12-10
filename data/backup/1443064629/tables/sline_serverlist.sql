CREATE TABLE `sline_serverlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL,
  `aid` int(11) unsigned DEFAULT NULL,
  `servername` varchar(20) DEFAULT NULL COMMENT '名称',
  `keywords` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` longtext COMMENT '详细内容',
  `addtime` int(11) unsigned DEFAULT NULL,
  `modtime` int(11) unsigned DEFAULT NULL,
  `isdisplay` int(1) unsigned DEFAULT '1' COMMENT '是否显示',
  `isauto` int(1) DEFAULT '0' COMMENT '是否默认分类',
  `displayorder` int(5) DEFAULT '9999',
  `sline_yqlj` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='副导航表'