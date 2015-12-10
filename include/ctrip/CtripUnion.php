<?php

/* PHP SDK
 * @version 2.0.0
 * @author magicsky0@163.com
 * @copyright © 2014, Ctrip Corporation. All rights reserved.
 */
date_default_timezone_set('Asia/Shanghai');

define( "CU_DEVELOP", FALSE ); // 是否开启开发者模式，打印调试信息
define( "CU_ROOT", str_replace('\\','/',dirname(__FILE__))."/" );
define( "CU_CLASS_PATH", CU_ROOT."class/" );
define( "CU_COMM_PATH", CU_ROOT."comm/" );

require CU_CLASS_PATH."CU.class.php";