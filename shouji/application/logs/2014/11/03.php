<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-11-03 13:34:41 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  order by displayorder asc limit  0,4' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  order by displayorder asc limit  0,4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 13:34:41 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  order by displayorder asc limit  0,4' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  order by displayorder asc limit  0,4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 13:55:01 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a' in 'field list' [ select a.id,a.aid,a.linename,a.iconlist,a,satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=0)  order by displayorder asc limit  0,4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 13:55:01 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a' in 'field list' [ select a.id,a.aid,a.linename,a.iconlist,a,satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=0)  order by displayorder asc limit  0,4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 14:21:56 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'min(adultprice) as minprice' in 'field list' [ SELECT `min(adultprice) as minprice`, `sline_line_suit_price`.`lineid` AS `lineid`, `sline_line_suit_price`.`suitid` AS `suitid`, `sline_line_suit_price`.`day` AS `day`, `sline_line_suit_price`.`childprofit` AS `childprofit`, `sline_line_suit_price`.`childbasicprice` AS `childbasicprice`, `sline_line_suit_price`.`childprice` AS `childprice`, `sline_line_suit_price`.`oldprofit` AS `oldprofit`, `sline_line_suit_price`.`oldbasicprice` AS `oldbasicprice`, `sline_line_suit_price`.`oldprice` AS `oldprice`, `sline_line_suit_price`.`adultprofit` AS `adultprofit`, `sline_line_suit_price`.`adultbasicprice` AS `adultbasicprice`, `sline_line_suit_price`.`adultprice` AS `adultprice` FROM `sline_line_suit_price` AS `sline_line_suit_price` WHERE lineid=6007 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 14:21:56 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'min(adultprice) as minprice' in 'field list' [ SELECT `min(adultprice) as minprice`, `sline_line_suit_price`.`lineid` AS `lineid`, `sline_line_suit_price`.`suitid` AS `suitid`, `sline_line_suit_price`.`day` AS `day`, `sline_line_suit_price`.`childprofit` AS `childprofit`, `sline_line_suit_price`.`childbasicprice` AS `childbasicprice`, `sline_line_suit_price`.`childprice` AS `childprice`, `sline_line_suit_price`.`oldprofit` AS `oldprofit`, `sline_line_suit_price`.`oldbasicprice` AS `oldbasicprice`, `sline_line_suit_price`.`oldprice` AS `oldprice`, `sline_line_suit_price`.`adultprofit` AS `adultprofit`, `sline_line_suit_price`.`adultbasicprice` AS `adultbasicprice`, `sline_line_suit_price`.`adultprice` AS `adultprice` FROM `sline_line_suit_price` AS `sline_line_suit_price` WHERE lineid=6007 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `min(adu...', false, Array)
#1 E:\stourcms\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 E:\stourcms\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 E:\stourcms\shouji\application\classes\controller\index.php(26): Kohana_ORM->find()
#4 [internal function]: Controller_Index->action_index()
#5 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-03 14:22:15 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'min(adultprice) as minprice' in 'field list' [ SELECT `min(adultprice) as minprice`, `sline_line_suit_price`.`lineid` AS `lineid`, `sline_line_suit_price`.`suitid` AS `suitid`, `sline_line_suit_price`.`day` AS `day`, `sline_line_suit_price`.`childprofit` AS `childprofit`, `sline_line_suit_price`.`childbasicprice` AS `childbasicprice`, `sline_line_suit_price`.`childprice` AS `childprice`, `sline_line_suit_price`.`oldprofit` AS `oldprofit`, `sline_line_suit_price`.`oldbasicprice` AS `oldbasicprice`, `sline_line_suit_price`.`oldprice` AS `oldprice`, `sline_line_suit_price`.`adultprofit` AS `adultprofit`, `sline_line_suit_price`.`adultbasicprice` AS `adultbasicprice`, `sline_line_suit_price`.`adultprice` AS `adultprice` FROM `sline_line_suit_price` AS `sline_line_suit_price` WHERE lineid=6007 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 14:22:15 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'min(adultprice) as minprice' in 'field list' [ SELECT `min(adultprice) as minprice`, `sline_line_suit_price`.`lineid` AS `lineid`, `sline_line_suit_price`.`suitid` AS `suitid`, `sline_line_suit_price`.`day` AS `day`, `sline_line_suit_price`.`childprofit` AS `childprofit`, `sline_line_suit_price`.`childbasicprice` AS `childbasicprice`, `sline_line_suit_price`.`childprice` AS `childprice`, `sline_line_suit_price`.`oldprofit` AS `oldprofit`, `sline_line_suit_price`.`oldbasicprice` AS `oldbasicprice`, `sline_line_suit_price`.`oldprice` AS `oldprice`, `sline_line_suit_price`.`adultprofit` AS `adultprofit`, `sline_line_suit_price`.`adultbasicprice` AS `adultbasicprice`, `sline_line_suit_price`.`adultprice` AS `adultprice` FROM `sline_line_suit_price` AS `sline_line_suit_price` WHERE lineid=6007 LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `min(adu...', false, Array)
#1 E:\stourcms\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 E:\stourcms\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 E:\stourcms\shouji\application\classes\controller\index.php(26): Kohana_ORM->find()
#4 [internal function]: Controller_Index->action_index()
#5 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-03 15:31:46 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:46 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:31:48 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:48 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:31:48 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:48 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:31:49 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:49 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:31:49 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:49 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:31:49 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:49 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:31:49 --- ERROR: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:31:49 --- STRACE: Database_Exception [ 1052 ]: Column 'displayorder' in order clause is ambiguous [ select * from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1 ) order by displayorder asc ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select * from s...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:32:17 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 [ select min(adultprice) as minprice from  sline_line_suit_price where day>UNIX_TIMESTAMP() and lineid= ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:32:17 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 [ select min(adultprice) as minprice from  sline_line_suit_price where day>UNIX_TIMESTAMP() and lineid= ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select min(adul...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(27): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:32:19 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 [ select min(adultprice) as minprice from  sline_line_suit_price where day>UNIX_TIMESTAMP() and lineid= ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:32:19 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 [ select min(adultprice) as minprice from  sline_line_suit_price where day>UNIX_TIMESTAMP() and lineid= ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select min(adul...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(27): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:32:21 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 [ select min(adultprice) as minprice from  sline_line_suit_price where day>UNIX_TIMESTAMP() and lineid= ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:32:21 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 [ select min(adultprice) as minprice from  sline_line_suit_price where day>UNIX_TIMESTAMP() and lineid= ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select min(adul...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\index.php(27): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Index->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:41:14 --- ERROR: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:41:14 --- STRACE: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, NULL, false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:41:16 --- ERROR: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:41:16 --- STRACE: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, NULL, false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:41:16 --- ERROR: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:41:16 --- STRACE: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, NULL, false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:41:16 --- ERROR: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-03 15:41:16 --- STRACE: Database_Exception [ 1065 ]: Query was empty [  ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, NULL, false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(16): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_index()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-03 15:53:45 --- ERROR: View_Exception [ 0 ]: The requested view mobile/lines could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-03 15:53:45 --- STRACE: View_Exception [ 0 ]: The requested view mobile/lines could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 E:\stourcms\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/lines')
#1 E:\stourcms\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/lines', NULL)
#2 E:\stourcms\shouji\application\classes\stourweb\controller.php(81): Stourweb_View::factory('mobile/lines')
#3 E:\stourcms\shouji\application\classes\controller\lines.php(48): Stourweb_Controller->display('mobile/lines')
#4 [internal function]: Controller_Lines->action_index()
#5 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#6 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-03 16:03:25 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 128 ]
2014-11-03 16:03:25 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 128 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:29:58 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:29:58 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:27 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:27 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:28 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:28 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:29 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:29 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:29 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:29 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:30 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:30 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:53 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:53 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:55 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:55 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:55 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:55 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:55 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:55 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:30:55 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
2014-11-03 16:30:55 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 33 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:33:30 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 27 ]
2014-11-03 16:33:30 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 27 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:34:52 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 52 ]
2014-11-03 16:34:52 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 52 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:34:53 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 52 ]
2014-11-03 16:34:53 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 52 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:35:01 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 27 ]
2014-11-03 16:35:01 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\cache\tplcache\mobile\lines\index.php [ 27 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-03 16:43:44 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL lineslist/kindid/3704 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 16:43:44 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL lineslist/kindid/3704 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 16:44:12 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL lineslist/kindid/3704 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 16:44:12 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL lineslist/kindid/3704 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 16:44:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL lines/list/kindid/3501 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
2014-11-03 16:44:17 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL lines/list/kindid/3501 was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 17:00:03 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 17:00:03 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 17:08:26 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 17:08:26 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 17:21:13 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 17:21:13 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 17:30:56 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 17:30:56 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 17:56:52 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 17:56:52 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 18:03:27 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 18:03:27 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 18:11:47 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 18:11:47 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-03 20:12:47 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-03 20:12:47 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}