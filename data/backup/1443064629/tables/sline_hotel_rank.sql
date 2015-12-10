CREATE TABLE `sline_hotel_rank` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `webid` int(3) NOT NULL DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `hotelrank` varchar(255) DEFAULT NULL,
  `orderid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AID_WEBID` (`aid`,`webid`) USING BTREE,
  KEY `IDX_ORDERID` (`orderid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC