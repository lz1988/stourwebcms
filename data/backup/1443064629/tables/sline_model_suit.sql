CREATE TABLE `sline_model_suit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productid` int(11) NOT NULL COMMENT '产品id',
  `suitname` varchar(255) DEFAULT NULL COMMENT '套餐名称',
  `description` text COMMENT '描述',
  `displayorder` int(11) DEFAULT '9999' COMMENT '排序',
  `jifenbook` int(11) DEFAULT '0' COMMENT '预订送积分',
  `jifentprice` int(11) DEFAULT '0' COMMENT '积分抵现金',
  `jifencomment` int(11) DEFAULT '0' COMMENT '评论送积分',
  `paytype` tinyint(1) unsigned DEFAULT '1' COMMENT '支付类型',
  `number` int(11) DEFAULT '-1' COMMENT '库存',
  `dingjin` varchar(255) DEFAULT NULL COMMENT '定金',
  `sellprice` varchar(255) DEFAULT NULL COMMENT '市场价格',
  `ourprice` varchar(255) DEFAULT NULL COMMENT '本站价格',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC