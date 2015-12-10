CREATE TABLE `sline_car_kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL COMMENT 'sline对应ID',
  `aid` int(11) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL COMMENT '分类信息',
  `title` varchar(255) DEFAULT NULL COMMENT '分类标题',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `tagword` varchar(255) DEFAULT NULL COMMENT '文章相关词',
  `description` mediumtext COMMENT '信息描述',
  `orderid` varchar(255) DEFAULT NULL COMMENT '排序',
  `displayorder` int(11) unsigned DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='车务类别表'