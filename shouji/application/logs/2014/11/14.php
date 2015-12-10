<?php defined('SYSPATH') OR die('No direct script access.'); ?>

2014-11-14 17:34:34 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2014-11-14 17:34:34 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\web\standsmore\shouji\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db(NULL)
#1 D:\web\standsmore\shouji\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\web\standsmore\shouji\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(1763): Kohana_Database_MySQL->list_columns('weblist')
#4 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(445): Kohana_ORM->list_columns()
#5 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(390): Kohana_ORM->reload_columns()
#6 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(255): Kohana_ORM->_initialize()
#7 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\web\standsmore\shouji\application\classes\common.php(118): Kohana_ORM::factory('weblist')
#9 D:\web\standsmore\shouji\application\bootstrap.php(174): Common::getWebInfo(0)
#10 D:\web\standsmore\shouji\index.php(104): require('D:\web\standsmo...')
#11 {main}
2014-11-14 17:35:37 --- ERROR: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
2014-11-14 17:35:37 --- STRACE: Database_Exception [  ]:  ~ MODPATH\database\classes\kohana\database\mysql.php [ 108 ]
--
#0 D:\web\standsmore\shouji\modules\database\classes\kohana\database\mysql.php(75): Kohana_Database_MySQL->_select_db(NULL)
#1 D:\web\standsmore\shouji\modules\database\classes\kohana\database\mysql.php(171): Kohana_Database_MySQL->connect()
#2 D:\web\standsmore\shouji\modules\database\classes\kohana\database\mysql.php(359): Kohana_Database_MySQL->query(1, 'SHOW FULL COLUM...', false)
#3 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(1763): Kohana_Database_MySQL->list_columns('weblist')
#4 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(445): Kohana_ORM->list_columns()
#5 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(390): Kohana_ORM->reload_columns()
#6 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(255): Kohana_ORM->_initialize()
#7 D:\web\standsmore\shouji\modules\orm\classes\kohana\orm.php(46): Kohana_ORM->__construct(NULL)
#8 D:\web\standsmore\shouji\application\classes\common.php(118): Kohana_ORM::factory('weblist')
#9 D:\web\standsmore\shouji\application\bootstrap.php(174): Common::getWebInfo(0)
#10 D:\web\standsmore\shouji\index.php(104): require('D:\web\standsmo...')
#11 {main}
2014-11-14 17:43:14 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
2014-11-14 17:43:14 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL public/images/chang_on.png was not found on this server. ~ SYSPATH\classes\kohana\request\client\internal.php [ 87 ]
--
#0 D:\web\standsmore\shouji\system\classes\kohana\request\client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 D:\web\standsmore\shouji\system\classes\kohana\request.php(1158): Kohana_Request_Client->execute(Object(Request))
#2 D:\web\standsmore\shouji\index.php(120): Kohana_Request->execute()
#3 {main}