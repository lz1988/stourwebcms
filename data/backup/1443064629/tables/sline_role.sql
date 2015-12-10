CREATE TABLE `sline_role` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `rolename` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `masterid` int(11) DEFAULT NULL,
  `createdate` int(11) DEFAULT NULL,
  `isoptn` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8