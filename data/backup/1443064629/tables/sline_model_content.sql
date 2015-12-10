CREATE TABLE `sline_model_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '1',
  `typeid` int(4) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL,
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isline` int(1) DEFAULT '0',
  `isrealfield` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类'