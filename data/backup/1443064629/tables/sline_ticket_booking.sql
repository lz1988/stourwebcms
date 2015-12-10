CREATE TABLE `sline_ticket_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatherid` int(11) NOT NULL COMMENT '机票ID',
  `name` varchar(50) NOT NULL COMMENT '订票人',
  `ordernum` int(11) NOT NULL COMMENT '预定机票张数',
  `planedate` int(10) NOT NULL COMMENT '航班日期',
  `cell` varchar(50) NOT NULL COMMENT '联系电话',
  `qqmsn` varchar(50) NOT NULL COMMENT 'QQ',
  `emaill` varchar(50) NOT NULL COMMENT '邮箱',
  `status` int(1) unsigned NOT NULL DEFAULT '0',
  `webid` int(11) NOT NULL DEFAULT '1',
  `ordersn` varchar(255) DEFAULT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC