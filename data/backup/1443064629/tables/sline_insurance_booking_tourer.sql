CREATE TABLE `sline_insurance_booking_tourer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `orderid` int(11) NOT NULL DEFAULT '0' COMMENT '订单ID',
  `name` varchar(255) DEFAULT NULL COMMENT '姓名',
  `pinyin` varchar(255) DEFAULT NULL COMMENT '拼音',
  `sex` tinyint(1) NOT NULL DEFAULT '1' COMMENT '性别,0女， 1男',
  `cardtype` varchar(5) DEFAULT NULL COMMENT '证件类型',
  `cardcode` varchar(255) DEFAULT NULL COMMENT '证件号',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `mobile` varchar(50) DEFAULT NULL COMMENT '电话',
  `jobcode` varchar(10) DEFAULT NULL COMMENT '职业代码，慧择提供',
  `joblevel` tinyint(4) DEFAULT NULL COMMENT '职业水平',
  `job` varchar(100) DEFAULT NULL COMMENT '工作名称',
  `fltno` varchar(100) DEFAULT NULL COMMENT '航班号',
  `city` varchar(100) DEFAULT NULL COMMENT '所在地区',
  `insurantrelation` varchar(20) DEFAULT NULL COMMENT '与投保人关系 ',
  `count` int(11) DEFAULT NULL COMMENT '购买份数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8