CREATE TABLE `sline_hotel_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `productid` int(11) DEFAULT NULL COMMENT '产品id',
  `e_engname` varchar(255) DEFAULT NULL COMMENT '酒店英文名',
  `e_newcontent` mediumtext COMMENT '新的测试',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='酒店字段扩展表'