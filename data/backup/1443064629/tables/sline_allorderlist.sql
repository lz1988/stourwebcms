CREATE TABLE `sline_allorderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(2) unsigned DEFAULT '0',
  `typeid` int(1) unsigned DEFAULT NULL COMMENT '栏目类型',
  `aid` int(11) DEFAULT NULL COMMENT '文章的aid',
  `classid` int(11) DEFAULT NULL COMMENT '分类id',
  `displayorder` int(11) unsigned DEFAULT '9999' COMMENT '排序ID',
  `istejia` int(1) unsigned DEFAULT '0' COMMENT '特惠',
  `isding` int(1) unsigned DEFAULT '0' COMMENT '是否置顶',
  `isjian` int(1) unsigned DEFAULT '0' COMMENT '是否推荐',
  PRIMARY KEY (`id`),
  KEY `typeid` (`typeid`),
  KEY `classid` (`classid`),
  KEY `IDX_AID_TYPEID` (`aid`,`typeid`) USING BTREE,
  KEY `IDX_AI_WE_TY` (`aid`,`webid`,`typeid`) USING BTREE,
  KEY `IDX_TYPEID_AID` (`typeid`,`aid`) USING BTREE,
  KEY `IDX_TY_AI_WE` (`typeid`,`aid`,`webid`) USING BTREE,
  KEY `IDX_typeid_aid_displayorder` (`typeid`,`aid`,`displayorder`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='ssmall全局排序表'