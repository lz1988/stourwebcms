CREATE TABLE `sline_line_extend` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '标识',
  `lineid` int(11) NOT NULL COMMENT '线路ID',
  `istemplets` int(2) NOT NULL,
  `relativeraider` varchar(50) NOT NULL,
  `relativehotel` varchar(50) NOT NULL COMMENT '关联酒店',
  `relativeticket` varchar(50) NOT NULL COMMENT '关联机票',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8