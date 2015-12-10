CREATE TABLE `sline_tool_link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `type` int(1) DEFAULT '2' COMMENT '1,重要目标关键词,2,长尾关键词',
  `linkurl` varchar(500) DEFAULT NULL COMMENT '链接地址',
  `linelink` int(6) DEFAULT '0' COMMENT '线路链接数量',
  `addtime` int(10) unsigned DEFAULT '0',
  `hotellink` int(6) unsigned DEFAULT '0',
  `carlink` int(6) unsigned DEFAULT '0',
  `articlelink` int(6) unsigned DEFAULT '0',
  `spotlink` int(6) unsigned DEFAULT '0',
  `photolink` int(6) unsigned DEFAULT '0',
  `visalink` int(6) unsigned DEFAULT '0',
  `questionlink` int(6) unsigned DEFAULT '0',
  `tuanlink` int(6) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='智能链接优化表'