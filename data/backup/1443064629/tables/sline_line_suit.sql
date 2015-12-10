CREATE TABLE `sline_line_suit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lineid` int(11) NOT NULL,
  `suitname` varchar(255) DEFAULT NULL,
  `description` text,
  `displayorder` int(11) DEFAULT '999999',
  `jifenbook` int(11) DEFAULT '0',
  `jifentprice` int(11) DEFAULT '0',
  `jifencomment` int(11) DEFAULT '0',
  `propgroup` varchar(6) DEFAULT NULL,
  `paytype` tinyint(1) unsigned DEFAULT '1',
  `dingjin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lineid` (`lineid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8