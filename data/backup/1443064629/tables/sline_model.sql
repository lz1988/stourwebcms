CREATE TABLE `sline_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型id',
  `modulename` varchar(255) DEFAULT NULL COMMENT '模块名称',
  `pinyin` varchar(255) DEFAULT NULL COMMENT '拼音标识',
  `maintable` varchar(255) DEFAULT NULL COMMENT '主表',
  `addtable` varchar(255) DEFAULT NULL COMMENT '附加表',
  `attrtable` varchar(255) DEFAULT 'model_attr' COMMENT '属性表',
  `issystem` int(1) DEFAULT '0' COMMENT '是否系统',
  `isopen` int(1) DEFAULT '1' COMMENT '是否开启',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pinyin` (`pinyin`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='思途模型表'