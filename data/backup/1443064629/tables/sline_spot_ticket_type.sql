CREATE TABLE `sline_spot_ticket_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kindname` varchar(255) DEFAULT NULL COMMENT '门票类型名称',
  `spotid` varchar(255) DEFAULT NULL COMMENT '景点id',
  `description` varchar(255) DEFAULT NULL COMMENT '类型描述',
  `displayorder` int(11) unsigned DEFAULT '9999',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8