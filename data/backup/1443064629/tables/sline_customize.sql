CREATE TABLE `sline_customize` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dest` varchar(80) DEFAULT NULL,
  `starttime` int(11) DEFAULT NULL,
  `startplace` varchar(80) DEFAULT NULL,
  `days` int(11) DEFAULT NULL,
  `adultnum` int(11) DEFAULT NULL,
  `childnum` int(11) DEFAULT NULL,
  `planerank` varchar(30) DEFAULT NULL,
  `hotelrank` varchar(30) DEFAULT NULL,
  `room` varchar(30) DEFAULT NULL,
  `food` varchar(30) DEFAULT NULL,
  `sex` varchar(6) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contacttime` varchar(50) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `contactname` varchar(30) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `content` text,
  `viewstatus` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8