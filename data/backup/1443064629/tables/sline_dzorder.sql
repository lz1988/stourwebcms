CREATE TABLE `sline_dzorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ordersn` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `dingjin` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `travelnum` int(11) DEFAULT NULL,
  `description` text,
  `addtime` int(11) DEFAULT NULL,
  `finishtime` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `viewstatus` tinyint(1) DEFAULT '0',
  `paysource` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8