CREATE TABLE `sline_image` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL DEFAULT '1' COMMENT '分组ID',
  `image_name` varchar(60) DEFAULT NULL COMMENT '图片名称',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片路径',
  `size` int(11) NOT NULL DEFAULT '0',
  `is_hidden` enum('0','1') NOT NULL DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8 COMMENT='图片库分组'