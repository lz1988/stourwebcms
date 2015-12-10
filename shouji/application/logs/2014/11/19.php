<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-11-19 09:34:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/loading.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-19 09:34:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/loading.gif was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\web\standsmore\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\standsmore\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\standsmore\shouji\index.php(120): Kohana_Request->execute()
#3 {main}