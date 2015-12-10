CREATE TABLE `sline_car_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '0',
  `columnname` varchar(30) DEFAULT NULL COMMENT '使用的字段名称',
  `chinesename` varchar(100) DEFAULT NULL COMMENT '中文显示名称',
  `displayorder` int(3) DEFAULT '0' COMMENT '显示顺序',
  `issystem` int(1) DEFAULT NULL COMMENT '是否系统字段',
  `isopen` int(1) DEFAULT NULL COMMENT '是否使用1，0',
  `isrealfield` int(1) unsigned DEFAULT '1' COMMENT '是否真实字段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='内容分类表'