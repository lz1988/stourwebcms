<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-11-07 21:36:37 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-07 21:36:37 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-07 21:36:37 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(78): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-07 21:36:37 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-07 23:37:38 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-07 23:37:38 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-11-07 23:37:38 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-07 23:37:38 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-07 23:37:45 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-07 23:37:45 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-07 23:37:51 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-07 23:37:51 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(80): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}
2014-11-07 23:53:52 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2014-11-07 23:53:52 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')  where a.id is not null order by a.modtime desc limit  0,10' at line 1 [ select a.id,a.aid,a.linename,a.iconlist,a.satisfyscore,a.lineprice,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.linepic,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia from sline_line as a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=1 and b.classid=)  where a.id is not null order by a.modtime desc limit  0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 F:\stourweb\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 F:\stourweb\shouji\application\classes\controller\lines.php(83): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Lines->action_list()
#3 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Lines))
#4 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#6 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#7 {main}