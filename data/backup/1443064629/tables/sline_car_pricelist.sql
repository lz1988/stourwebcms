CREATE TABLE `sline_car_pricelist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` int(11) DEFAULT NULL COMMENT '最小值',
  `max` int(11) DEFAULT NULL COMMENT '最大值',
  `webid` int(11) DEFAULT NULL COMMENT 'sline编号',
  `aid` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='报价区间分类'