CREATE TABLE `sline_sysconfig` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT NULL,
  `varname` varchar(30) DEFAULT NULL COMMENT '变量名称',
  `info` varchar(255) DEFAULT NULL COMMENT '参数描述',
  `value` mediumtext COMMENT '变量值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统变量配置表'