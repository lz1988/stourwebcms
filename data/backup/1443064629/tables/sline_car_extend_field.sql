CREATE TABLE `sline_car_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  `e_cartext` varchar(255) DEFAULT NULL COMMENT '车辆描述',
  `e_xinneng` mediumtext COMMENT '性能描述',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='租车字段扩展表'