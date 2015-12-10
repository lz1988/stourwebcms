CREATE TABLE `sline_car_suit_price` (
  `carid` int(11) NOT NULL,
  `suitid` int(11) NOT NULL DEFAULT '0',
  `day` int(11) NOT NULL DEFAULT '0',
  `adultprofit` int(11) DEFAULT NULL,
  `adultbasicprice` int(11) DEFAULT NULL,
  `adultprice` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT '0' COMMENT '库存',
  PRIMARY KEY (`suitid`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8