CREATE TABLE `sline_hotel_room_price` (
  `hotelid` int(11) NOT NULL,
  `suitid` int(11) NOT NULL DEFAULT '0' COMMENT '户型id',
  `day` int(11) NOT NULL DEFAULT '0',
  `profit` int(11) DEFAULT NULL,
  `basicprice` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `number` int(11) DEFAULT NULL COMMENT '库存',
  UNIQUE KEY `suitid` (`suitid`,`day`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8