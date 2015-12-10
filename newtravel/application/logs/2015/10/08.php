<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2015-10-08 13:49:40 --- ERROR: Kohana_Exception [ 0 ]: Cannot update nav model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1486 ]
2015-10-08 13:49:40 --- STRACE: Kohana_Exception [ 0 ]: Cannot update nav model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1486 ]
--
#0 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/model/nav.php(47): Kohana_ORM->update()
#1 /www/web/testdata_souxw_com/public_html/newtravel/application/classes/controller/config.php(271): Model_Nav->saveNav(Array)
#2 [internal function]: Controller_Config->action_ajax_savenav()
#3 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client/internal.php(116): ReflectionMethod->invoke(Object(Controller_Config))
#4 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /www/web/testdata_souxw_com/public_html/newtravel/system/classes/kohana/request.php(1160): Kohana_Request_Client->execute(Object(Request))
#6 /www/web/testdata_souxw_com/public_html/newtravel/index.php(121): Kohana_Request->execute()
#7 {main}