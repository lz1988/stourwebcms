<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-10-08 16:29:26 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL shouji was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-08 16:29:26 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL shouji was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\shouji\index.php(127): Kohana_Request->execute()
#3 {main}
2014-10-08 16:29:57 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: shouji/index.php ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-08 16:29:57 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: shouji/index.php ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 D:\web\shouji\index.php(127): Kohana_Request->execute()
#1 {main}
2014-10-08 16:31:52 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL login/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-08 16:31:52 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL login/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\web\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\shouji\index.php(120): Kohana_Request->execute()
#3 {main}