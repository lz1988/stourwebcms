<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-11-08 09:26:46 --- ERROR: ErrorException [ 1 ]: Class 'Model_sline_destinations' not found ~ MODPATH\orm\classes\kohana\orm.php [ 46 ]
2014-11-08 09:26:46 --- STRACE: ErrorException [ 1 ]: Class 'Model_sline_destinations' not found ~ MODPATH\orm\classes\kohana\orm.php [ 46 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:28:32 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 09:28:32 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(83): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 09:28:32 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-08 09:28:32 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 09:30:41 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Destinations as array ~ APPPATH\classes\controller\lines.php [ 112 ]
2014-11-08 09:30:41 --- STRACE: ErrorException [ 1 ]: Cannot use object of type Model_Destinations as array ~ APPPATH\classes\controller\lines.php [ 112 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:30:45 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Destinations as array ~ APPPATH\classes\controller\lines.php [ 112 ]
2014-11-08 09:30:45 --- STRACE: ErrorException [ 1 ]: Cannot use object of type Model_Destinations as array ~ APPPATH\classes\controller\lines.php [ 112 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:30:46 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Destinations as array ~ APPPATH\classes\controller\lines.php [ 112 ]
2014-11-08 09:30:46 --- STRACE: ErrorException [ 1 ]: Cannot use object of type Model_Destinations as array ~ APPPATH\classes\controller\lines.php [ 112 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:54:15 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\classes\controller\lines.php [ 71 ]
2014-11-08 09:54:15 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\classes\controller\lines.php [ 71 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:55:22 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\classes\controller\lines.php [ 108 ]
2014-11-08 09:55:22 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\classes\controller\lines.php [ 108 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:55:24 --- ERROR: ErrorException [ 4 ]: parse error ~ APPPATH\classes\controller\lines.php [ 108 ]
2014-11-08 09:55:24 --- STRACE: ErrorException [ 4 ]: parse error ~ APPPATH\classes\controller\lines.php [ 108 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 09:55:35 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-08 09:55:35 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 09:55:35 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 09:55:35 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:00 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:00 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:01 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:01 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:08 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:08 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:16 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:16 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:23 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:23 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:24 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:24 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:01:24 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:01:24 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:36 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:36 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:37 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:37 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:37 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:37 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:38 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:38 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:38 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:38 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=3513)  where a.id is not null and find_in_set(3513,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:42 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:42 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:43 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:43 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:02:45 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:02:45 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(74): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:03:31 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-08 10:03:31 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 10:03:31 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:03:31 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,0' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:20 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:20 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:27 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:27 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:30 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:30 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:32 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:32 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,0 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:42 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:42 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:44 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:44 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:44 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:44 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:04:46 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:04:46 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and lineday=images order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:06:59 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:06:59 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:33:23 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=images)  where a.id is not null and find_in_set(images,a.kindlist) order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:33:23 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=images)  where a.id is not null and find_in_set(images,a.kindlist) order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:33:59 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=images)  where a.id is not null and find_in_set(images,a.kindlist) order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:33:59 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'images' in 'where clause' [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=images)  where a.id is not null and find_in_set(images,a.kindlist) order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(76): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:41:18 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-08 10:41:18 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 10:41:18 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:41:18 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(75): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:41:39 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '},a.attrid) order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and find_in_set(0},a.attrid) order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:41:39 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '},a.attrid) order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and find_in_set(0},a.attrid) order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(75): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 10:53:43 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-08 10:53:43 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 10:56:11 --- ERROR: Database_Exception [ 1305 ]: FUNCTION www_standsmore_com.intval does not exist [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and find_in_set(intval($attrid),a.attrid) order by a.modtime desc limit  0,20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 10:56:11 --- STRACE: Database_Exception [ 1305 ]: FUNCTION www_standsmore_com.intval does not exist [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=12)  where a.id is not null and find_in_set(12,a.kindlist) and find_in_set(intval($attrid),a.attrid) order by a.modtime desc limit  0,20 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 E:\stourcms\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 E:\stourcms\shouji\application\classes\controller\lines.php(75): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 E:\stourcms\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 E:\stourcms\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 E:\stourcms\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 E:\stourcms\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 11:52:27 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 11:52:27 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/i...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/i...', NULL)
#2 D:\web\shouji\application\classes\stourweb\controller.php(87): Stourweb_View::factory('mobile/mobile/i...')
#3 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('mobile/index')
#4 [internal function]: Controller_Index->action_index()
#5 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-08 11:52:41 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/m_base.css ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-11-08 11:52:41 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/m_base.css ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 D:\web\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-11-08 11:52:41 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/style.css ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-11-08 11:52:41 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/style.css ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 D:\web\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-11-08 12:13:02 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')' ~ APPPATH\cache\tplcache\mobile\user\register.php [ 28 ]
2014-11-08 12:13:02 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')' ~ APPPATH\cache\tplcache\mobile\user\register.php [ 28 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 12:13:43 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:13:43 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(28): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:06 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:06 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:10 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:10 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:10 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:10 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:11 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:11 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:11 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:11 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:11 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:11 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:11 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:11 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:16:19 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:19 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/i...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/i...', NULL)
#2 D:\web\shouji\application\classes\stourweb\controller.php(88): Stourweb_View::factory('mobile/mobile/i...')
#3 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('mobile/index')
#4 [internal function]: Controller_Index->action_index()
#5 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-08 12:16:19 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:19 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/i...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/i...', NULL)
#2 D:\web\shouji\application\classes\stourweb\controller.php(88): Stourweb_View::factory('mobile/mobile/i...')
#3 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('mobile/index')
#4 [internal function]: Controller_Index->action_index()
#5 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-08 12:16:20 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:20 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/i...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/i...', NULL)
#2 D:\web\shouji\application\classes\stourweb\controller.php(88): Stourweb_View::factory('mobile/mobile/i...')
#3 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('mobile/index')
#4 [internal function]: Controller_Index->action_index()
#5 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-08 12:16:20 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:20 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/index could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/i...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/i...', NULL)
#2 D:\web\shouji\application\classes\stourweb\controller.php(88): Stourweb_View::factory('mobile/mobile/i...')
#3 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('mobile/index')
#4 [internal function]: Controller_Index->action_index()
#5 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#6 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-08 12:16:33 --- ERROR: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:16:33 --- STRACE: View_Exception [ 0 ]: The requested view public/foot could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/foot')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/foot', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/foot', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(27): Stourweb_View::template('public/foot')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:12 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:18:12 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:13 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:18:13 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:13 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:18:13 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:13 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:18:13 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:13 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:18:13 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:13 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-11-08 12:18:13 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:18:51 --- ERROR: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 12:18:51 --- STRACE: View_Exception [ 0 ]: The requested view public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/top')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/top', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('public/top', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\user\register.php(11): Stourweb_View::template('public/top')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(95): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\user.php(13): Stourweb_Controller->display('user/register')
#8 [internal function]: Controller_User->action_register()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 12:48:54 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL user/login was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
2014-11-08 12:48:54 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL user/login was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
--
#0 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 14:17:49 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '$this' (T_VARIABLE) ~ APPPATH\classes\controller\user.php [ 15 ]
2014-11-08 14:17:49 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '$this' (T_VARIABLE) ~ APPPATH\classes\controller\user.php [ 15 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 14:18:48 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL user/user/doreg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
2014-11-08 14:18:48 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL user/user/doreg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
--
#0 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-08 14:22:17 --- ERROR: Kohana_Exception [ 0 ]: The password property does not exist in the Model_Member class ~ MODPATH\orm\classes\kohana\orm.php [ 761 ]
2014-11-08 14:22:17 --- STRACE: Kohana_Exception [ 0 ]: The password property does not exist in the Model_Member class ~ MODPATH\orm\classes\kohana\orm.php [ 761 ]
--
#0 D:\web\shouji\modules\orm\classes\kohana\orm.php(703): Kohana_ORM->set('password', 'd41d8cd98f00b20...')
#1 D:\web\shouji\application\classes\controller\user.php(39): Kohana_ORM->__set('password', 'd41d8cd98f00b20...')
#2 [internal function]: Controller_User->action_doreg()
#3 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#4 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 14:31:15 --- ERROR: ErrorException [ 2048 ]: Declaration of Model_Weblist::save() should be compatible with Kohana_ORM::save(Validation $validation = NULL) ~ APPPATH\classes\model\weblist.php [ 103 ]
2014-11-08 14:31:15 --- STRACE: ErrorException [ 2048 ]: Declaration of Model_Weblist::save() should be compatible with Kohana_ORM::save(Validation $validation = NULL) ~ APPPATH\classes\model\weblist.php [ 103 ]
--
#0 D:\web\shouji\system\classes\kohana\core.php(505): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\shouji\a...', 103, Array)
#1 D:\web\shouji\system\classes\kohana\core.php(505): Kohana_Core::auto_load()
#2 [internal function]: Kohana_Core::auto_load('Model_weblist')
#3 D:\web\shouji\modules\orm\classes\kohana\orm.php(46): spl_autoload_call('Model_weblist')
#4 D:\web\shouji\application\classes\common.php(118): Kohana_ORM::factory('weblist')
#5 D:\web\shouji\application\bootstrap.php(174): Common::getWebInfo(0)
#6 D:\web\shouji\index.php(104): require('D:\web\shouji\a...')
#7 {main}
2014-11-08 14:31:55 --- ERROR: ErrorException [ 2048 ]: Declaration of Model_Weblist::save() should be compatible with Kohana_ORM::save(Validation $validation = NULL) ~ APPPATH\classes\model\weblist.php [ 103 ]
2014-11-08 14:31:55 --- STRACE: ErrorException [ 2048 ]: Declaration of Model_Weblist::save() should be compatible with Kohana_ORM::save(Validation $validation = NULL) ~ APPPATH\classes\model\weblist.php [ 103 ]
--
#0 D:\web\shouji\system\classes\kohana\core.php(505): Kohana_Core::error_handler(2048, 'Declaration of ...', 'D:\web\shouji\a...', 103, Array)
#1 D:\web\shouji\system\classes\kohana\core.php(505): Kohana_Core::auto_load()
#2 [internal function]: Kohana_Core::auto_load('Model_weblist')
#3 D:\web\shouji\modules\orm\classes\kohana\orm.php(46): spl_autoload_call('Model_weblist')
#4 D:\web\shouji\application\classes\common.php(118): Kohana_ORM::factory('weblist')
#5 D:\web\shouji\application\bootstrap.php(174): Common::getWebInfo(0)
#6 D:\web\shouji\index.php(104): require('D:\web\shouji\a...')
#7 {main}
2014-11-08 14:32:28 --- ERROR: Kohana_Exception [ 0 ]: The mobile2 property does not exist in the Model_Member class ~ MODPATH\orm\classes\kohana\orm.php [ 761 ]
2014-11-08 14:32:28 --- STRACE: Kohana_Exception [ 0 ]: The mobile2 property does not exist in the Model_Member class ~ MODPATH\orm\classes\kohana\orm.php [ 761 ]
--
#0 D:\web\shouji\modules\orm\classes\kohana\orm.php(703): Kohana_ORM->set('mobile2', '13980703200')
#1 D:\web\shouji\application\classes\controller\user.php(38): Kohana_ORM->__set('mobile2', '13980703200')
#2 [internal function]: Controller_User->action_doreg()
#3 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#4 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 D:\web\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-08 14:33:13 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'password' in 'where clause' [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile=13980703200 and password='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 14:33:13 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'password' in 'where clause' [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile=13980703200 and password='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(44): Model_Member::login('13980703200', NULL)
#5 [internal function]: Controller_User->action_doreg()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 14:34:39 --- ERROR: ErrorException [ 1 ]: Cannot use object of type Model_Member as array ~ APPPATH\classes\model\member.php [ 39 ]
2014-11-08 14:34:39 --- STRACE: ErrorException [ 1 ]: Cannot use object of type Model_Member as array ~ APPPATH\classes\model\member.php [ 39 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2014-11-08 15:16:25 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 15:16:25 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(72): Model_Member::login(NULL, NULL)
#5 [internal function]: Controller_User->action_dologin()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 15:25:41 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 15:25:41 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(72): Model_Member::login(NULL, NULL)
#5 [internal function]: Controller_User->action_dologin()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 15:26:38 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 15:26:38 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(72): Model_Member::login(NULL, NULL)
#5 [internal function]: Controller_User->action_dologin()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 15:37:02 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 15:37:02 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(72): Model_Member::login(NULL, NULL)
#5 [internal function]: Controller_User->action_dologin()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 15:39:01 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 15:39:01 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(76): Model_Member::login(NULL, NULL)
#5 [internal function]: Controller_User->action_dologin()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 15:39:59 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 15:39:59 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1' at line 1 [ SELECT `sline_member`.`mid` AS `mid`, `sline_member`.`mtype` AS `mtype`, `sline_member`.`nickname` AS `nickname`, `sline_member`.`pwd` AS `pwd`, `sline_member`.`truename` AS `truename`, `sline_member`.`sex` AS `sex`, `sline_member`.`rank` AS `rank`, `sline_member`.`money` AS `money`, `sline_member`.`email` AS `email`, `sline_member`.`mobile` AS `mobile`, `sline_member`.`jifen` AS `jifen`, `sline_member`.`litpic` AS `litpic`, `sline_member`.`safequestion` AS `safequestion`, `sline_member`.`safeanswer` AS `safeanswer`, `sline_member`.`jointime` AS `jointime`, `sline_member`.`joinip` AS `joinip`, `sline_member`.`logintime` AS `logintime`, `sline_member`.`loginip` AS `loginip`, `sline_member`.`checkmail` AS `checkmail`, `sline_member`.`checkphone` AS `checkphone`, `sline_member`.`province` AS `province`, `sline_member`.`city` AS `city`, `sline_member`.`cardid` AS `cardid`, `sline_member`.`address` AS `address`, `sline_member`.`postcode` AS `postcode`, `sline_member`.`connectid` AS `connectid`, `sline_member`.`from` AS `from` FROM `sline_member` AS `sline_member` WHERE mobile= and pwd='d41d8cd98f00b204e9800998ecf8427e' LIMIT 1 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', false, Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1160): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1008): Kohana_ORM->_load_result(false)
#3 D:\web\shouji\application\classes\model\member.php(34): Kohana_ORM->find()
#4 D:\web\shouji\application\classes\controller\user.php(76): Model_Member::login(NULL, NULL)
#5 [internal function]: Controller_User->action_dologin()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 15:42:23 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:42:23 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/p...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/p...', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('mobile/mobile/p...', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\index.php(12): Stourweb_View::template('mobile/public/t...')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(108): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('index')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 15:42:25 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:42:25 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/p...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/p...', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('mobile/mobile/p...', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\index.php(12): Stourweb_View::template('mobile/public/t...')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(108): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('index')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 15:42:26 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:42:26 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/p...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/p...', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('mobile/mobile/p...', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\index.php(12): Stourweb_View::template('mobile/public/t...')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(108): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('index')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 15:42:27 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:42:27 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/p...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/p...', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('mobile/mobile/p...', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\index.php(12): Stourweb_View::template('mobile/public/t...')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(108): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('index')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 15:42:27 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:42:27 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/p...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/p...', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('mobile/mobile/p...', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\index.php(12): Stourweb_View::template('mobile/public/t...')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(108): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('index')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 15:42:27 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:42:27 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/public/top could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/p...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/p...', Array)
#2 D:\web\shouji\application\classes\stourweb\view.php(545): Stourweb_View::factory('mobile/mobile/p...', Array)
#3 D:\web\shouji\application\cache\tplcache\mobile\index.php(12): Stourweb_View::template('mobile/public/t...')
#4 D:\web\shouji\application\classes\stourweb\view.php(72): include('D:\web\shouji\a...')
#5 D:\web\shouji\application\classes\stourweb\view.php(374): Stourweb_View->capture('D:\web\shouji\a...', Array)
#6 D:\web\shouji\application\classes\stourweb\controller.php(108): Stourweb_View->render()
#7 D:\web\shouji\application\classes\controller\index.php(40): Stourweb_Controller->display('index')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-11-08 15:49:30 --- ERROR: View_Exception [ 0 ]: The requested view mobile/mobile/lines/index could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
2014-11-08 15:49:30 --- STRACE: View_Exception [ 0 ]: The requested view mobile/mobile/lines/index could not be found ~ APPPATH\classes\stourweb\view.php [ 282 ]
--
#0 D:\web\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('mobile/mobile/l...')
#1 D:\web\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('mobile/mobile/l...', NULL)
#2 D:\web\shouji\application\classes\stourweb\controller.php(100): Stourweb_View::factory('mobile/mobile/l...')
#3 D:\web\shouji\application\classes\controller\lines.php(50): Stourweb_Controller->display('mobile/lines/in...')
#4 [internal function]: Controller_Lines->action_index()
#5 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#6 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#8 D:\web\shouji\index.php(120): Kohana_Request->execute()
#9 {main}
2014-11-08 16:21:18 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 16:21:18 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', 'Model_Member_Or...', Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1151): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1033): Kohana_ORM->_load_result(true)
#3 D:\web\shouji\modules\orm\classes\kohana\orm.php(1043): Kohana_ORM->find_all()
#4 D:\web\shouji\application\classes\controller\user.php(109): Kohana_ORM->get_all()
#5 [internal function]: Controller_User->action_orderlist()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 16:22:41 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 16:22:41 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', 'Model_Member_Or...', Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1151): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1033): Kohana_ORM->_load_result(true)
#3 D:\web\shouji\modules\orm\classes\kohana\orm.php(1043): Kohana_ORM->find_all()
#4 D:\web\shouji\application\classes\controller\user.php(109): Kohana_ORM->get_all()
#5 [internal function]: Controller_User->action_orderlist()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 16:26:10 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 16:26:10 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', 'Model_Member_Or...', Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1151): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1033): Kohana_ORM->_load_result(true)
#3 D:\web\shouji\modules\orm\classes\kohana\orm.php(1043): Kohana_ORM->find_all()
#4 D:\web\shouji\application\classes\controller\user.php(109): Kohana_ORM->get_all()
#5 [internal function]: Controller_User->action_orderlist()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 16:26:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-08 16:26:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'mid' in 'where clause' [ SELECT `sline_member_order`.`id` AS `id`, `sline_member_order`.`ordersn` AS `ordersn`, `sline_member_order`.`memberid` AS `memberid`, `sline_member_order`.`typeid` AS `typeid`, `sline_member_order`.`webid` AS `webid`, `sline_member_order`.`productaid` AS `productaid`, `sline_member_order`.`productname` AS `productname`, `sline_member_order`.`productautoid` AS `productautoid`, `sline_member_order`.`litpic` AS `litpic`, `sline_member_order`.`price` AS `price`, `sline_member_order`.`childprice` AS `childprice`, `sline_member_order`.`usedate` AS `usedate`, `sline_member_order`.`dingnum` AS `dingnum`, `sline_member_order`.`childnum` AS `childnum`, `sline_member_order`.`ispay` AS `ispay`, `sline_member_order`.`status` AS `status`, `sline_member_order`.`linkman` AS `linkman`, `sline_member_order`.`linktel` AS `linktel`, `sline_member_order`.`linkemail` AS `linkemail`, `sline_member_order`.`linkqq` AS `linkqq`, `sline_member_order`.`isneedpiao` AS `isneedpiao`, `sline_member_order`.`addtime` AS `addtime`, `sline_member_order`.`finishtime` AS `finishtime`, `sline_member_order`.`ispinlun` AS `ispinlun`, `sline_member_order`.`jifencomment` AS `jifencomment`, `sline_member_order`.`jifentprice` AS `jifentprice`, `sline_member_order`.`jifenbook` AS `jifenbook`, `sline_member_order`.`dingjin` AS `dingjin`, `sline_member_order`.`suitid` AS `suitid`, `sline_member_order`.`paytype` AS `paytype`, `sline_member_order`.`oldnum` AS `oldnum`, `sline_member_order`.`oldprice` AS `oldprice` FROM `sline_member_order` AS `sline_member_order` WHERE mid=4 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'SELECT `sline_m...', 'Model_Member_Or...', Array)
#1 D:\web\shouji\modules\orm\classes\kohana\orm.php(1151): Kohana_Database_Query->execute(Object(Database_MySQL))
#2 D:\web\shouji\modules\orm\classes\kohana\orm.php(1033): Kohana_ORM->_load_result(true)
#3 D:\web\shouji\modules\orm\classes\kohana\orm.php(1043): Kohana_ORM->find_all()
#4 D:\web\shouji\application\classes\controller\user.php(109): Kohana_ORM->get_all()
#5 [internal function]: Controller_User->action_orderlist()
#6 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#7 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#9 D:\web\shouji\index.php(120): Kohana_Request->execute()
#10 {main}
2014-11-08 16:45:31 --- ERROR: Kohana_Exception [ 0 ]: The mid property does not exist in the Model_Member_Order class ~ MODPATH\orm\classes\kohana\orm.php [ 688 ]
2014-11-08 16:45:31 --- STRACE: Kohana_Exception [ 0 ]: The mid property does not exist in the Model_Member_Order class ~ MODPATH\orm\classes\kohana\orm.php [ 688 ]
--
#0 D:\web\shouji\modules\orm\classes\kohana\orm.php(604): Kohana_ORM->get('mid')
#1 D:\web\shouji\application\classes\model\member\order.php(14): Kohana_ORM->__get('mid')
#2 D:\web\shouji\application\classes\controller\user.php(110): Model_Member_Order->getOrderList('4')
#3 [internal function]: Controller_User->action_orderlist()
#4 D:\web\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_User))
#5 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\shouji\index.php(120): Kohana_Request->execute()
#8 {main}