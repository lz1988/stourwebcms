CREATE TABLE `sline_keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) DEFAULT NULL,
  `title` char(255) DEFAULT NULL,
  `linkurl` varchar(255) NOT NULL,
  `webid` int(3) DEFAULT '1',
  `keyword` varchar(255) DEFAULT NULL COMMENT '具体长尾词语',
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC