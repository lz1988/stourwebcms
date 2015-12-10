CREATE TABLE `sline_line_suit_price` (
  `lineid` int(11) NOT NULL,
  `suitid` int(11) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0',
  `childprofit` int(11) DEFAULT NULL,
  `childbasicprice` int(11) DEFAULT NULL,
  `childprice` int(11) DEFAULT NULL,
  `oldprofit` int(11) DEFAULT NULL,
  `oldbasicprice` int(11) DEFAULT NULL,
  `oldprice` int(11) DEFAULT NULL,
  `adultprofit` int(11) DEFAULT NULL,
  `adultbasicprice` int(11) DEFAULT NULL,
  `adultprice` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL COMMENT '描述',
  `number` int(11) DEFAULT NULL COMMENT '库存',
  `roombalance` int(11) DEFAULT '0',
  PRIMARY KEY (`suitid`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8