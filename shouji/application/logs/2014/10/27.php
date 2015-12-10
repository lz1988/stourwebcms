<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-10-27 22:00:58 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL trunk was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-27 22:00:58 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL trunk was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\trunk\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\trunk\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\trunk\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-27 22:01:01 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL trunk was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-27 22:01:01 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL trunk was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\trunk\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\trunk\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\trunk\index.php(120): Kohana_Request->execute()
#3 {main}