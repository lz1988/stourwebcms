CREATE TABLE `sline_help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL COMMENT '帮助标题',
  `kindid` int(2) unsigned DEFAULT NULL COMMENT '帮助所属分类',
  `body` longtext COMMENT '帮助详细内容',
  `displayorder` int(5) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `type_id` varchar(255) DEFAULT NULL COMMENT '显示到',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='帮助信息表'