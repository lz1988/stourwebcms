<?php
return array
(
    'default' => array
    (
        'type'       => 'mysql',
        'connection' => array(
            'hostname'   => '~dbhost~',

            'database'   => '~dbname~',
            'username'   => '~dbuser~',
            'password'   => '~dbpwd~',
            'persistent' => FALSE,
        ),
        'table_prefix' => 'sline_',
        'charset'      => 'utf8',
        'caching'      => FALSE,
        'profiling'    => TRUE,
    ),

);