<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-04-30 17:10:15 --- ERROR: View_Exception [ 0 ]: The requested view public/found could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
2015-04-30 17:10:15 --- STRACE: View_Exception [ 0 ]: The requested view public/found could not be found ~ APPPATH\classes\stourweb\view.php [ 281 ]
--
#0 D:\web\standsmore\newtravel\application\classes\stourweb\view.php(157): Stourweb_View->set_filename('public/found')
#1 D:\web\standsmore\newtravel\application\classes\stourweb\view.php(30): Stourweb_View->__construct('public/found', Array)
#2 D:\web\standsmore\newtravel\application\classes\stourweb\view.php(544): Stourweb_View::factory('public/found', Array)
#3 D:\web\standsmore\newtravel\application\cache\tplcache\stourtravel\index.php(40): Stourweb_View::template('public/found')
#4 D:\web\standsmore\newtravel\application\classes\stourweb\view.php(72): include('D:\web\standsmo...')
#5 D:\web\standsmore\newtravel\application\classes\stourweb\view.php(373): Stourweb_View->capture('D:\web\standsmo...', Array)
#6 D:\web\standsmore\newtravel\application\classes\stourweb\controller.php(105): Stourweb_View->render()
#7 D:\web\standsmore\newtravel\application\classes\controller\index.php(22): Stourweb_Controller->display('stourtravel/ind...')
#8 [internal function]: Controller_Index->action_index()
#9 D:\web\standsmore\newtravel\system\classes\kohana\request\client\internal.php(116): ReflectionMethod->invoke(Object(Controller_Index))
#10 D:\web\standsmore\newtravel\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#11 D:\web\standsmore\newtravel\system\classes\kohana\request.php(1160): Kohana_Request_Client->execute(Object(Request))
#12 D:\web\standsmore\newtravel\index.php(121): Kohana_Request->execute()
#13 {main}