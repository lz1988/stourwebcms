CREATE TABLE `sline_sms_msg` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `msgtype` varchar(255) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `isopen` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8