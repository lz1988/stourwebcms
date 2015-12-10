CREATE TABLE `sline_ticket_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `destid` int(11) DEFAULT NULL COMMENT '目的地ID(扩展)',
  `companyname` varchar(255) DEFAULT NULL,
  `isdefault` int(1) unsigned DEFAULT '0' COMMENT '是否默认',
  `isopen` int(1) unsigned DEFAULT '0',
  `displayorder` int(11) DEFAULT '9999',
  `domain` varchar(255) DEFAULT NULL COMMENT '域名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8