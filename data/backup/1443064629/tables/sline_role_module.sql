CREATE TABLE `sline_role_module` (
  `roleid` int(11) NOT NULL,
  `moduleid` char(15) DEFAULT NULL,
  `slook` tinyint(1) NOT NULL DEFAULT '0',
  `smodify` tinyint(1) NOT NULL DEFAULT '0',
  `sadd` tinyint(1) NOT NULL DEFAULT '0',
  `sdelete` tinyint(1) NOT NULL DEFAULT '0',
  `sall` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8