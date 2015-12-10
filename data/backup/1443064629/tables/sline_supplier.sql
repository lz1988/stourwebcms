CREATE TABLE `sline_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suppliername` varchar(255) DEFAULT NULL COMMENT '供应商名称',
  `linkman` varchar(100) DEFAULT NULL COMMENT '联系人',
  `telephone` varchar(100) DEFAULT NULL COMMENT '联系电话',
  `mobile` varchar(100) DEFAULT NULL COMMENT '手机',
  `fax` varchar(50) DEFAULT NULL COMMENT '传真',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `litpic` varchar(255) DEFAULT NULL,
  `qq` varchar(255) DEFAULT NULL,
  `addtime` int(10) unsigned DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='供应商表'