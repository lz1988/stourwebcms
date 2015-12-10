CREATE TABLE `sline_email_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msgtype` char(30) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `isopen` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8