CREATE TABLE `sline_spot_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='景点字段扩展表'