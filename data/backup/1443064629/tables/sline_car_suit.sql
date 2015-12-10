CREATE TABLE `sline_car_suit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carid` int(11) DEFAULT NULL,
  `suitname` varchar(255) DEFAULT NULL,
  `content` text,
  `unit` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `jifenbook` int(11) DEFAULT '0',
  `jifentprice` int(11) DEFAULT NULL,
  `jifencomment` int(11) DEFAULT NULL,
  `paytype` int(1) unsigned DEFAULT '1',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  `suittypeid` int(11) DEFAULT '0' COMMENT '套餐类型id',
  `displayorder` int(11) DEFAULT '9999',
  `number` int(11) DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8