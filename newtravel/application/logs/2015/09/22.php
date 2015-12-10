<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-09-22 14:12:21 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.tprice' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:12:21 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.tprice' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(164): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Line->action_line()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:12:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.tprice' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:12:26 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.tprice' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(164): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Line->action_line()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:12:34 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.tprice' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:12:34 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.tprice' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.tprice,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(164): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Line->action_line()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:18:51 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.profit' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:18:51 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.profit' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(164): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Line->action_line()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:21:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.profit' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:21:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.profit' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.profit,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(164): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Line->action_line()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:21:50 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH/classes/controller/line.php [ 637 ]
2015-09-22 14:21:50 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected $end ~ APPPATH/classes/controller/line.php [ 637 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2015-09-22 14:22:46 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.lineclassid' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:22:46 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.lineclassid' in 'field list' [ select a.id,a.aid,a.title,a.supplierlist,a.iconlist,a.price,a.startcity,a.lineclassid as classid,a.attrid,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,a.lineclassid,a.webid,a.kindlist,a.ishidden,a.piclist,a.themelist,b.isjian,IFNULL(b.displayorder,9999) as displayorder,b.isding,b.istejia,ifnull(d.suitday,0) as suitday from sline_line as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1)   left join (select
c.lineid,c.id,min(c.suitday) as suitday from(select a.lineid,a.id,max(ifnull(b.day,0)) as suitday from sline_line_suit a left join sline_line_suit_price b on a.id=b.suitid group by a.id) c group by c.lineid) d on a.id=d.lineid where a.id is not null order by a.modtime desc  limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(164): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Line->action_line()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:24:26 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.areaid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.areaid,a.hotelrankid ,a.mainrankid,a.areaid as areaids,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:24:26 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.areaid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.areaid,a.hotelrankid ,a.mainrankid,a.areaid as areaids,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:24:55 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.areaid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.areaid,a.hotelrankid ,a.mainrankid,a.areaid as areaids,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:24:55 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.areaid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.areaid,a.hotelrankid ,a.mainrankid,a.areaid as areaids,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:25:56 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.areaid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.areaid,a.hotelrankid ,a.mainrankid,a.areaid as areaids,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:25:56 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.areaid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.areaid,a.hotelrankid ,a.mainrankid,a.areaid as areaids,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:26:19 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.hotelrankid ,a.mainrankid,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,' at line 1 [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,,a.hotelrankid ,a.mainrankid,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:26:19 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.hotelrankid ,a.mainrankid,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,' at line 1 [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,,a.hotelrankid ,a.mainrankid,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:28:47 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.mainrankid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.mainrankid,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:28:47 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.mainrankid' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.mainrankid,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:29:22 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.webidfs' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:29:22 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.webidfs' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:29:45 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.webidfs' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder DESC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:29:45 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.webidfs' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.webidfs,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder DESC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:29:58 --- ERROR: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if' at line 1 [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid.,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:29:58 --- STRACE: Database_Exception [ 1064 ]: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if' at line 1 [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid.,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:30:37 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.childkind' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder DESC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:30:37 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.childkind' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder DESC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:31:15 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.childkind' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:31:15 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.childkind' in 'field list' [ select a.id,a.aid,a.title,a.kindlist,a.attrid,a.hotelrankid,a.hotelrankid ,a.ishidden,a.webid,a.childkind,a.iconlist,a.supplierlist,a.themelist,b.isding,b.isjian,b.istejia,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,ifnull(b.displayorder,9999) as displayorder,ifnull(d.suitday,0) as suitday from sline_hotel as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=2) left join (select c.hotelid,c.id,min(c.suitday) as suitday from(select a.hotelid,a.id,max(b.day) as suitday
 from sline_hotel_room a left join sline_hotel_room_price b on a.id=b.suitid  group by a.id) c group by c.hotelid) d on a.id=d.hotelid  where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(150): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Hotel->action_hotel()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:43:37 --- ERROR: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ SHOW FULL COLUMNS FROM `sline_car_brand` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:43:37 --- STRACE: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ SHOW FULL COLUMNS FROM `sline_car_brand` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(1800): Kohana_Database_MySQL->list_columns('car_brand')
#2 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(455): Kohana_ORM->list_columns()
#3 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(400): Kohana_ORM->reload_columns()
#4 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(265): Kohana_ORM->_initialize()
#5 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(46): Kohana_ORM->__construct(NULL)
#6 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(67): Kohana_ORM::factory('car_brand')
#7 [internal function]: Controller_Car->before()
#8 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Car))
#9 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#11 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#12 {main}
2015-09-22 14:43:55 --- ERROR: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ SHOW FULL COLUMNS FROM `sline_car_brand` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:43:55 --- STRACE: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ SHOW FULL COLUMNS FROM `sline_car_brand` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(1800): Kohana_Database_MySQL->list_columns('car_brand')
#2 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(455): Kohana_ORM->list_columns()
#3 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(400): Kohana_ORM->reload_columns()
#4 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(265): Kohana_ORM->_initialize()
#5 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(46): Kohana_ORM->__construct(NULL)
#6 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(67): Kohana_ORM::factory('car_brand')
#7 [internal function]: Controller_Car->before()
#8 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(103): ReflectionMethod->invoke(Object(Controller_Car))
#9 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#11 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#12 {main}
2015-09-22 14:45:09 --- ERROR: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.carbrandid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) left join sline_car_brand c on (a.carbrandid=c.id and a.webid=0) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:45:09 --- STRACE: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.carbrandid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) left join sline_car_brand c on (a.carbrandid=c.id and a.webid=0) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:45:20 --- ERROR: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.carbrandid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) left join sline_car_brand c on (a.carbrandid=c.id and a.webid=0) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:45:20 --- STRACE: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.carbrandid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) left join sline_car_brand c on (a.carbrandid=c.id and a.webid=0) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:47:56 --- ERROR: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.carbrandid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) left join sline_car_brand c on (a.carbrandid=c.id and a.webid=0) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:47:56 --- STRACE: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_brand' doesn't exist [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.carbrandid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) left join sline_car_brand c on (a.carbrandid=c.id and a.webid=0) left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:49:24 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.carkindid' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:49:24 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.carkindid' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:49:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.carkindid' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:49:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.carkindid' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:51:36 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'c.kindname' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:51:36 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'c.kindname' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:52:59 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'c.kindname' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:52:59 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'c.kindname' in 'field list' [ select  a.id,a.webid,a.aid,a.title,a.supplierlist,a.seatnum,a.carkindid,a.kindlist,a.attrid,a.iconlist,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist
,a.ishidden,c.kindname as brandname,d.kindname as carkindname,IFNULL(b.displayorder,9999) as displayorder,ifnull(e.suitday,0) as suitday from sline_car as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3)  left join sline_car_kind d on (a.carkindid=d.id) left join (select c.carid,c.id,min(c.suitday) as suitday from(select a.carid,a.id,max(b.day) as suitday
 from sline_car_suit a left join sline_car_suit_price b on a.id=b.suitid  group by a.id) c group by c.carid) e on a.id=e.carid where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select  a.id,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(141): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Car->action_car()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:53:51 --- ERROR: Kohana_Exception [ 0 ]: The frecommend property does not exist in the Model_Car class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 14:53:51 --- STRACE: Kohana_Exception [ 0 ]: The frecommend property does not exist in the Model_Car class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('frecommend', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(543): Kohana_ORM->__set('frecommend', 0)
#2 [internal function]: Controller_Car->action_ajax_carsave()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:55:25 --- ERROR: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Hotel class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 14:55:25 --- STRACE: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Hotel class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('yesjian', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(475): Kohana_ORM->__set('yesjian', 0)
#2 [internal function]: Controller_Hotel->action_ajax_save()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:56:14 --- ERROR: Kohana_Exception [ 0 ]: The fuwu property does not exist in the Model_Hotel class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 14:56:14 --- STRACE: Kohana_Exception [ 0 ]: The fuwu property does not exist in the Model_Hotel class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('fuwu', '')
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/hotel.php(480): Kohana_ORM->__set('fuwu', '')
#2 [internal function]: Controller_Hotel->action_ajax_save()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Hotel))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:57:48 --- ERROR: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Line class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 14:57:48 --- STRACE: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Line class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('yesjian', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(613): Kohana_ORM->__set('yesjian', 0)
#2 [internal function]: Controller_Line->action_ajax_linesave()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:58:15 --- ERROR: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Line class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 14:58:15 --- STRACE: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Line class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('yesjian', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(613): Kohana_ORM->__set('yesjian', 0)
#2 [internal function]: Controller_Line->action_ajax_linesave()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:58:29 --- ERROR: Kohana_Exception [ 0 ]: The lineicon property does not exist in the Model_Line class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 14:58:29 --- STRACE: Kohana_Exception [ 0 ]: The lineicon property does not exist in the Model_Line class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('lineicon', '')
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/line.php(613): Kohana_ORM->__set('lineicon', '')
#2 [internal function]: Controller_Line->action_ajax_linesave()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Line))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 14:59:09 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.area' in 'field list' [ select a.aid,a.id,a.title,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 14:59:09 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.area' in 'field list' [ select a.aid,a.id,a.title,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.aid,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(115): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Spot->action_spot()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:00:10 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.area' in 'field list' [ select a.aid,a.id,a.title,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by displayorder ASC,a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:00:10 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.area' in 'field list' [ select a.aid,a.id,a.title,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by displayorder ASC,a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.aid,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(115): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Spot->action_spot()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:01:05 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.spotpicid' in 'field list' [ select a.aid,a.id,a.title,a.price,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:01:05 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.spotpicid' in 'field list' [ select a.aid,a.id,a.title,a.price,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.aid,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(115): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Spot->action_spot()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:01:07 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.spotpicid' in 'field list' [ select a.aid,a.id,a.title,a.price,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by displayorder ASC,a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:01:07 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.spotpicid' in 'field list' [ select a.aid,a.id,a.title,a.price,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by displayorder ASC,a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.aid,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(115): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Spot->action_spot()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:01:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.spotpicid' in 'field list' [ select a.aid,a.id,a.title,a.price,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by displayorder DESC,a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:01:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.spotpicid' in 'field list' [ select a.aid,a.id,a.title,a.price,a.spotpicid,a.tagword,a.kindlist,a.attrid,a.litpic,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.webid,a.piclist,a.themelist,a.iconlist,a.supplierlist,a.ishidden,b.isjian,ifnull(b.displayorder,9999) as displayorder,b.isding from sline_spot as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=5) where a.id is not null order by displayorder DESC,a.modtime desc  limit 0,30  ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.aid,a....', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(115): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Spot->action_spot()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:02:35 --- ERROR: Kohana_Exception [ 0 ]: The want property does not exist in the Model_Spot class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 15:02:35 --- STRACE: Kohana_Exception [ 0 ]: The want property does not exist in the Model_Spot class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('want', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(416): Kohana_ORM->__set('want', 0)
#2 [internal function]: Controller_Spot->action_ajax_save()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:03:24 --- ERROR: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Spot class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 15:03:24 --- STRACE: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Spot class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('yesjian', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/spot.php(430): Kohana_ORM->__set('yesjian', 0)
#2 [internal function]: Controller_Spot->action_ajax_save()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Spot))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:04:34 --- ERROR: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Visa class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 15:04:34 --- STRACE: Kohana_Exception [ 0 ]: The yesjian property does not exist in the Model_Visa class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('yesjian', 0)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/visa.php(373): Kohana_ORM->__set('yesjian', 0)
#2 [internal function]: Controller_Visa->action_ajax_save()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Visa))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:06:17 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.allow' in 'field list' [ select a.id,a.allow,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:06:17 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.allow' in 'field list' [ select a.id,a.allow,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:06:21 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.allow' in 'field list' [ select a.id,a.allow,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:06:21 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.allow' in 'field list' [ select a.id,a.allow,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:07:16 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.allow' in 'field list' [ select a.id,a.allow,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:07:16 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.allow' in 'field list' [ select a.id,a.allow,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:07:53 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.kind' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:07:53 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.kind' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:08:19 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.kind' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:08:19 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.kind' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kind,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:08:30 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.isindex' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:08:30 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.isindex' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:08:33 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.isindex' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:08:33 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.isindex' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:09:00 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.isindex' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:09:00 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.isindex' in 'field list' [ select a.id,a.aid,a.title,a.attrid,a.kindlist,a.isindex,a.webid,a.addtime,a.ishidden,a.themelist,a.iconlist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.iconlist,''))=0,0,1) as order_iconlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding,a.modtime,a.templet from sline_article as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=4) where a.id is not null order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Article->action_article()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:09:32 --- ERROR: Kohana_Exception [ 0 ]: The allow property does not exist in the Model_Article class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
2015-09-22 15:09:32 --- STRACE: Kohana_Exception [ 0 ]: The allow property does not exist in the Model_Article class ~ MODPATH/orm/classes/kohana/orm.php [ 771 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(713): Kohana_ORM->set('allow', NULL)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/article.php(341): Kohana_ORM->__set('allow', NULL)
#2 [internal function]: Controller_Article->action_ajax_save()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Article))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:10:27 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.alt' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.alt,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:10:27 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.alt' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.alt,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/photo.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Photo->action_photo()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Photo))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:11:06 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.alt' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.alt,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:11:06 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.alt' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.alt,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/photo.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Photo->action_photo()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Photo))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:11:41 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.alt' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.alt,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:11:41 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.alt' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.alt,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/photo.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Photo->action_photo()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Photo))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:11:58 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.photokind' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by displayorder DESC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:11:58 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.photokind' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by displayorder DESC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/photo.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Photo->action_photo()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Photo))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:12:25 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.photokind' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:12:25 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.photokind' in 'field list' [ select a.id,a.aid,a.title,a.litpic,a.headimgid,a.title,a.kindlist,a.attrid,a.webid,a.photokind,a.themelist,if(length(ifnull(a.attrid,''))=0,0,1) as order_attrid,if(length(ifnull(a.kindlist,''))=0,0,1) as order_kindlist,if(length(ifnull(a.themelist,''))=0,0,1) as order_themelist,
a.addtime,a.modtime,a.ishidden,b.isjian,ifnull(b.displayorder,999999) as displayorder,b.isding from sline_photo as a left join sline_allorderlist b on (a.id=b.aid and b.typeid=6) where a.id is not null and a.webid=0 order by displayorder ASC,a.modtime desc limit 0,30 ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/query.php(251): Kohana_Database_MySQL->query(1, 'select a.id,a.a...', false, Array)
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/photo.php(106): Kohana_Database_Query->execute()
#2 [internal function]: Controller_Photo->action_photo()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Photo))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}
2015-09-22 15:32:26 --- ERROR: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_pricelist' doesn't exist [ SHOW FULL COLUMNS FROM `sline_car_pricelist` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
2015-09-22 15:32:26 --- STRACE: Database_Exception [ 1146 ]: Table 'testdata_souxw_com.sline_car_pricelist' doesn't exist [ SHOW FULL COLUMNS FROM `sline_car_pricelist` ] ~ MODPATH/database/classes/kohana/database/mysql.php [ 194 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/modules/database/classes/kohana/database/mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#1 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(1800): Kohana_Database_MySQL->list_columns('car_pricelist')
#2 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(455): Kohana_ORM->list_columns()
#3 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(400): Kohana_ORM->reload_columns()
#4 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(265): Kohana_ORM->_initialize()
#5 /www/web/testdata_souxw_com/public_html/newtravel/modules/orm/classes/kohana/orm.php(46): Kohana_ORM->__construct(NULL)
#6 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/car.php(326): Kohana_ORM::factory('car_pricelist')
#7 [internal function]: Controller_Car->action_price()
#8 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Car))
#9 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#10 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#11 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#12 {main}
2015-09-22 20:14:46 --- ERROR: Database_Exception [ 1050 ]: Table 'sline_huiyi_kindlist' already exists [ CREATE TABLE `sline_huiyi_kindlist` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `kindid` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `seotitle` VARCHAR(255) NULL DEFAULT NULL,
                `keyword` VARCHAR(255) NULL DEFAULT NULL,
                `description` VARCHAR(255) NULL DEFAULT NULL,
                `tagword` VARCHAR(255) NULL DEFAULT NULL,
                `jieshao` TEXT NULL,
                `isfinishseo` INT(1) UNSIGNED NOT NULL DEFAULT '0',
                `displayorder` INT(4) UNSIGNED NULL DEFAULT '9999',
                `isnav` INT(1) UNSIGNED NULL DEFAULT '0' COMMENT '是否导航',
                `ishot` INT(1) UNSIGNED NULL DEFAULT '0' COMMENT '是否热门',
                `shownum` INT(8) NULL DEFAULT NULL,
                `templetpath` VARCHAR(255) NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                INDEX `kindid` (`kindid`)
            )
            COMMENT='模型目的地表'
            COLLATE='utf8_general_ci'
            ENGINE=MyISAM ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-09-22 20:14:46 --- STRACE: Database_Exception [ 1050 ]: Table 'sline_huiyi_kindlist' already exists [ CREATE TABLE `sline_huiyi_kindlist` (
                `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                `kindid` INT(11) UNSIGNED NOT NULL DEFAULT '0',
                `seotitle` VARCHAR(255) NULL DEFAULT NULL,
                `keyword` VARCHAR(255) NULL DEFAULT NULL,
                `description` VARCHAR(255) NULL DEFAULT NULL,
                `tagword` VARCHAR(255) NULL DEFAULT NULL,
                `jieshao` TEXT NULL,
                `isfinishseo` INT(1) UNSIGNED NOT NULL DEFAULT '0',
                `displayorder` INT(4) UNSIGNED NULL DEFAULT '9999',
                `isnav` INT(1) UNSIGNED NULL DEFAULT '0' COMMENT '是否导航',
                `ishot` INT(1) UNSIGNED NULL DEFAULT '0' COMMENT '是否热门',
                `shownum` INT(8) NULL DEFAULT NULL,
                `templetpath` VARCHAR(255) NULL DEFAULT NULL,
                PRIMARY KEY (`id`),
                INDEX `kindid` (`kindid`)
            )
            COMMENT='模型目的地表'
            COLLATE='utf8_general_ci'
            ENGINE=MyISAM ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\HTML\instest\newtravel\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(NULL, 'CREATE TABLE `s...', false, Array)
#1 D:\HTML\instest\newtravel\application\classes\model\model.php(80): Kohana_Database_Query->execute()
#2 D:\HTML\instest\newtravel\application\classes\model\model.php(26): Model_Model::createDestTable('huiyi')
#3 D:\HTML\instest\newtravel\application\classes\controller\model.php(154): Model_Model::createModel(Array)
#4 [internal function]: Controller_Model->action_ajax_model_save()
#5 D:\HTML\instest\newtravel\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Model))
#6 D:\HTML\instest\newtravel\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 D:\HTML\instest\newtravel\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#8 D:\HTML\instest\newtravel\index.php(121): Kohana_Request->execute()
#9 {main}
2015-09-22 20:14:54 --- ERROR: Database_Exception [ 1062 ]: Duplicate entry 'huiyi' for key 'pinyin' [ insert into sline_model(modulename,pinyin,maintable,addtable,issystem)values('会议','huiyi','model_archive','huiyi_extend_field',0) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-09-22 20:14:54 --- STRACE: Database_Exception [ 1062 ]: Duplicate entry 'huiyi' for key 'pinyin' [ insert into sline_model(modulename,pinyin,maintable,addtable,issystem)values('会议','huiyi','model_archive','huiyi_extend_field',0) ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\HTML\instest\newtravel\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(2, 'insert into sli...', false, Array)
#1 D:\HTML\instest\newtravel\application\classes\model\model.php(18): Kohana_Database_Query->execute()
#2 D:\HTML\instest\newtravel\application\classes\controller\model.php(154): Model_Model::createModel(Array)
#3 [internal function]: Controller_Model->action_ajax_model_save()
#4 D:\HTML\instest\newtravel\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Model))
#5 D:\HTML\instest\newtravel\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 D:\HTML\instest\newtravel\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#7 D:\HTML\instest\newtravel\index.php(121): Kohana_Request->execute()
#8 {main}