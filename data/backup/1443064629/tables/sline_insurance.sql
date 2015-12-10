CREATE TABLE `sline_insurance` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `companykey` varchar(50) DEFAULT NULL COMMENT '接口提供商标识',
  `productcode` varchar(255) DEFAULT NULL COMMENT '产品代码',
  `productname` varchar(255) DEFAULT NULL,
  `defaultprice` decimal(10,2) DEFAULT '0.00' COMMENT '默认价格',
  `ourprice` decimal(10,2) DEFAULT '0.00',
  `content` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8