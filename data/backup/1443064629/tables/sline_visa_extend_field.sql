CREATE TABLE `sline_visa_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='签证字段扩展表'