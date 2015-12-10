CREATE TABLE `sline_advertise_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `webid` varchar(255) DEFAULT '0',
  `position` varchar(255) DEFAULT NULL COMMENT '广告位置',
  `tagname` varchar(255) DEFAULT NULL COMMENT '标识',
  `width` int(11) DEFAULT NULL COMMENT '宽度',
  `height` int(11) DEFAULT NULL COMMENT '高度',
  `type` int(1) DEFAULT NULL COMMENT '广告类型 1,首页广告,2,栏目广告,3,自定义广告',
  `issystem` int(11) DEFAULT '0' COMMENT '是否是系统广告',
  `addtime` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COMMENT='广告分类表'