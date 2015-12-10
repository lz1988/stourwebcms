CREATE TABLE `sline_attrorderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `typeid` int(1) unsigned DEFAULT NULL COMMENT '栏目类型',
  `aid` varchar(255) DEFAULT NULL COMMENT '文章的aid',
  `classid` int(11) DEFAULT NULL COMMENT '分类id',
  `displayorder` int(11) unsigned DEFAULT '9999' COMMENT '排序ID',
  `istejia` int(1) unsigned DEFAULT '0' COMMENT '特惠',
  `isding` int(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `isjian` int(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  `destid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='属性分类排序表'