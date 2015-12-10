CREATE TABLE `sline_visa_booking` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(11) unsigned DEFAULT '0',
  `visaid` int(11) NOT NULL,
  `visaname` varchar(255) DEFAULT NULL COMMENT '酒店名称',
  `dingnum` varchar(100) DEFAULT NULL COMMENT '预订数量',
  `price` varchar(255) DEFAULT NULL,
  `info` varchar(255) DEFAULT NULL COMMENT '其它备注信息',
  `dingname` varchar(255) DEFAULT NULL,
  `dingtel` varchar(255) DEFAULT NULL COMMENT '预订联系人电话',
  `addtime` int(10) unsigned DEFAULT NULL COMMENT '添加时间',
  `modtime` int(10) unsigned DEFAULT NULL COMMENT '处理时间',
  `status` int(1) unsigned DEFAULT NULL COMMENT '处理状态',
  `ordersn` varchar(255) DEFAULT NULL,
  `bianhao` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC