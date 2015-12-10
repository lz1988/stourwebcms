CREATE TABLE `sline_photo_picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webid` int(11) DEFAULT NULL,
  `pid` int(11) NOT NULL COMMENT '所属相册id',
  `litpic` varchar(100) DEFAULT NULL COMMENT '小图连接地址',
  `bigpic` varchar(100) DEFAULT NULL COMMENT '大图连接地址',
  `description` varchar(200) DEFAULT NULL,
  `isindex` int(1) DEFAULT NULL,
  `modtime` int(10) unsigned DEFAULT NULL,
  `displayorder` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC