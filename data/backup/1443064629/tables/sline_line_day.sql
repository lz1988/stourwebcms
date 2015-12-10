CREATE TABLE `sline_line_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(3) DEFAULT '1',
  `aid` int(11) unsigned DEFAULT NULL,
  `word` int(3) unsigned DEFAULT NULL COMMENT '天数(只能输入数字)',
  `isdisplay` int(1) unsigned DEFAULT '0' COMMENT '是否在前台显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='线路天数分类表'