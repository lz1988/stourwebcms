CREATE TABLE `sline_visa_area` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `pid` int(4) unsigned DEFAULT NULL,
  `kindname` varchar(255) DEFAULT NULL,
  `displayorder` int(4) unsigned DEFAULT '9999',
  `isopen` int(1) unsigned DEFAULT '1',
  `litpic` varchar(255) DEFAULT NULL COMMENT '国家封面图片',
  `bigpic` varchar(255) DEFAULT NULL COMMENT '国家栏目页顶部图片',
  `countrypic` varchar(255) DEFAULT NULL COMMENT '国家国旗',
  `jieshao` text COMMENT '国家介绍',
  `pinyin` varchar(255) DEFAULT NULL COMMENT '国家拼音',
  `seotitle` varchar(255) DEFAULT NULL COMMENT '优化标题',
  `keyword` varchar(255) DEFAULT NULL COMMENT '关键词',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `ishot` int(1) DEFAULT '0' COMMENT '是否热门',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8