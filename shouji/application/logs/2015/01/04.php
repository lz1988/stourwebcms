<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-01-04 15:35:42 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL user/null was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
2015-01-04 15:35:42 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL user/null was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
--
#0 D:\web\standsmore\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\standsmore\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\standsmore\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2015-01-04 16:19:25 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/loading.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2015-01-04 16:19:25 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/loading.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\web\standsmore\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\standsmore\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\standsmore\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2015-01-04 17:11:20 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL page/query_order was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
2015-01-04 17:11:20 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL page/query_order was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
--
#0 D:\web\standsmore\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\standsmore\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\standsmore\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2015-01-04 17:13:31 --- ERROR: Database_Exception [ 1054 ]: Unknown column 'a.mobile' in 'where clause' [ select a.* from sline_member_order a where a.mobile='13980705977' order by a.addtime desc limit 0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
2015-01-04 17:13:31 --- STRACE: Database_Exception [ 1054 ]: Unknown column 'a.mobile' in 'where clause' [ select a.* from sline_member_order a where a.mobile='13980705977' order by a.addtime desc limit 0,10 ] ~ MODPATH\database\classes\kohana\database\mysql.php [ 194 ]
--
#0 D:\web\standsmore\shouji\modules\database\classes\kohana\database\query.php(251): Kohana_Database_MySQL->query(1, 'select a.* from...', false, Array)
#1 D:\web\standsmore\shouji\application\classes\model\member\order.php(102): Kohana_Database_Query->execute()
#2 D:\web\standsmore\shouji\application\classes\controller\page.php(112): Model_Member_Order->getOrderListByMobile('13980705977')
#3 [internal function]: Controller_Page->action_queryorder()
#4 D:\web\standsmore\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Page))
#5 D:\web\standsmore\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 D:\web\standsmore\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#7 D:\web\standsmore\shouji\index.php(120): Kohana_Request->execute()
#8 {main}