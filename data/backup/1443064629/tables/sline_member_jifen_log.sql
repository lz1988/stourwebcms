CREATE TABLE `sline_member_jifen_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberid` int(11) DEFAULT NULL,
  `content` text COMMENT '积分描述',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `type` int(1) unsigned DEFAULT NULL COMMENT '消息类型,1,使用,2,获取',
  `jifen` int(11) unsigned DEFAULT NULL COMMENT '本次操作的积分数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员积分使用记录表'