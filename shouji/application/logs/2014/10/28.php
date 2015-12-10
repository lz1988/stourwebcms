<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-10-28 21:56:38 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:56:38 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:57:05 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: index.php ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 21:57:05 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: index.php ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 21:57:15 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:57:15 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:59:40 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:59:40 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:59:41 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:59:41 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:59:42 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:59:42 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:59:42 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:59:42 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:59:42 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:59:42 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 21:59:42 --- ERROR: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2014-10-28 21:59:42 --- STRACE: View_Exception [ 0 ]: The requested view stourtravel/public/public_js could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 F:\stourweb\shouji\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('stourtravel/pub...')
#1 F:\stourweb\shouji\application\classes\stourweb\view.php(30): Stourweb_View->__construct('stourtravel/pub...', Array)
#2 F:\stourweb\shouji\application\classes\stourweb\view.php(544): Stourweb_View::factory('stourtravel/pub...', Array)
#3 F:\stourweb\shouji\application\cache\tplcache\mobile\index.php(7): Stourweb_View::template('stourtravel/pub...')
#4 F:\stourweb\shouji\application\classes\stourweb\view.php(72): include('F:\stourweb\sho...')
#5 F:\stourweb\shouji\application\classes\stourweb\view.php(373): Stourweb_View->capture('F:\stourweb\sho...', Array)
#6 F:\stourweb\shouji\application\classes\stourweb\controller.php(88): Stourweb_View->render()
#7 F:\stourweb\shouji\application\classes\controller\index.php(16): Stourweb_Controller->display('mobile/index')
#8 [internal function]: Controller_Index->action_index()
#9 F:\stourweb\shouji\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#12 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#13 {main}
2014-10-28 22:00:15 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:00:15 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:00:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:17 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:00:17 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:00:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:17 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:17 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:17 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:00:17 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:00:17 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:13 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:01:13 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:01:13 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:13 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:13 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:13 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:13 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:13 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:13 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:13 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:15 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:01:15 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:01:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:40 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:01:40 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:01:40 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:40 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test2.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:40 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:40 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test4.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:40 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:40 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test1.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:01:40 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:01:40 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL images/pic/test3.jpg was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:02:10 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:02:10 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:02:11 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:02:11 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:02:12 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:02:12 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:02:13 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:02:13 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:02:15 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
2014-10-28 22:02:15 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: images/logo.png ~ SYSPATH\classes\kohana\request.php [ 1146 ]
--
#0 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#1 {main}
2014-10-28 22:06:16 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL lines/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-10-28 22:06:16 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL lines/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}
2014-10-28 22:07:47 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL lines/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
2014-10-28 22:07:47 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL lines/index was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 111 ]
--
#0 F:\stourweb\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 F:\stourweb\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 F:\stourweb\shouji\index.php(120): Kohana_Request->execute()
#3 {main}