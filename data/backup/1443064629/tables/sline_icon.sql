CREATE TABLE `sline_icon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL,
  `kind` char(50) NOT NULL,
  `picurl` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8