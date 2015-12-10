CREATE TABLE `sline_member_order_tourer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` varchar(255) DEFAULT '0' COMMENT '订单编号',
  `tourername` varchar(255) DEFAULT '0' COMMENT '游客姓名',
  `sex` enum('男','女') DEFAULT '男',
  `cardtype` varchar(255) DEFAULT '0' COMMENT '证件类型',
  `cardnumber` varchar(255) DEFAULT '0' COMMENT '证件号码',
  `mobile` varchar(15) DEFAULT '0' COMMENT '手机',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单游客表'