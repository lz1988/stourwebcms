<?php defined('SYSPATH') OR die('No direct access allowed.');

include(BASEPATH.'/data/common.inc.php');

return array
(
    'default' => array
    (
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => $cfg_dbhost,
            'database'   => $cfg_dbname,
            'username'   => $cfg_dbuser,
            'password'   => $cfg_dbpwd,
            'persistent' => FALSE,
        ),
        'table_prefix' => 'sline_',
        'charset'      => 'utf8',
        'caching'      => FALSE,
        'profiling'    => TRUE,
    )

);