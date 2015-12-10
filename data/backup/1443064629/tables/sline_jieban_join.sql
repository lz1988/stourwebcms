CREATE TABLE `sline_jieban_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jiebanid` int(10) NOT NULL COMMENT '结伴id',
  `linkman` varchar(50) DEFAULT NULL COMMENT '联系人',
  `mobile` varchar(50) DEFAULT NULL COMMENT '联系人手机',
  `memberid` tinyint(10) DEFAULT NULL COMMENT '联系人会员id',
  `adultnum` tinyint(10) DEFAULT '1' COMMENT '大人数量',
  `childnum` tinyint(10) DEFAULT '0' COMMENT '小孩数量',
  `addtime` int(10) unsigned DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='结伴加入人员信息表'