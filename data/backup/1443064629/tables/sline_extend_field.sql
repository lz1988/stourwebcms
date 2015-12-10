CREATE TABLE `sline_extend_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '类别',
  `fieldname` varchar(50) NOT NULL DEFAULT '0' COMMENT '字段名称',
  `fieldtype` varchar(50) NOT NULL DEFAULT '0' COMMENT '字段类型',
  `description` varchar(50) NOT NULL DEFAULT '0' COMMENT '字段描述',
  `tips` varchar(255) NOT NULL DEFAULT '0' COMMENT '填写描述',
  `isopen` int(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否可用',
  `addtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `modtime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `isunique` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否唯一',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='产品字段扩展表'