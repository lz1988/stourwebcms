CREATE TABLE `sline_image_group` (
  `group_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '分组Id',
  `group_name` varchar(60) NOT NULL DEFAULT '' COMMENT '分组名称',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `do_not` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='图片库'