<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-11-05 19:09:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-05 19:09:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-05 19:23:37 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:23:37 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(81): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:26:40 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:26:40 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:27:42 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:27:42 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:27:42 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-05 19:27:42 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-05 19:29:01 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:29:01 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:29:02 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:29:02 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:29:02 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:29:02 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:29:02 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:29:02 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:43:04 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:43:04 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:43:05 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:43:05 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:43:05 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:43:05 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:43:06 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:43:06 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 19:43:06 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 19:43:06 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')   where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,a.supplierlist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)   where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 20:25:33 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 20:25:33 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 20:25:44 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-05 20:25:44 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-05 20:25:44 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 20:25:44 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 20:25:50 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-05 20:25:50 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-05 20:25:50 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 20:25:50 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-05 20:25:55 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-05 20:25:55 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-05 20:25:55 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-05 20:25:55 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}