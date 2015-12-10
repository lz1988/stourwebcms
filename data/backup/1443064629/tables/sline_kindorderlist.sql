CREATE TABLE `sline_kindorderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `typeid` int(1) unsigned DEFAULT NULL COMMENT '栏目类型',
  `aid` varchar(255) DEFAULT NULL COMMENT '文章的aid',
  `classid` int(11) DEFAULT NULL COMMENT '分类id',
  `displayorder` int(11) unsigned DEFAULT '9999' COMMENT '排序ID',
  `istejia` int(1) unsigned DEFAULT '0' COMMENT '特惠',
  `isding` int(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `isjian` int(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `displayorder` (`displayorder`),
  KEY `isding` (`isding`),
  KEY `IDX_AI_WE_CL_TY` (`aid`,`webid`,`classid`,`typeid`) USING BTREE,
  KEY `IDX_AI_TY_CL` (`aid`,`typeid`,`classid`) USING BTREE,
  KEY `IDX_CL_TY_AI_WE` (`classid`,`typeid`,`aid`,`webid`) USING BTREE,
  KEY `IDX_TY_CL_AI` (`typeid`,`classid`,`aid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ssmall分类排序表'