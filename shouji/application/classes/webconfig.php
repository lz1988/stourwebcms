<?php
/**
 * Created by netman.
 * User: Administrator
 * Date: 14-3-23
 * Time: 下午5:28
 * desription:配置读取静态类
 */
class Webconfig{

    public static function getConfig($varname)
    {

        $config = ORM::factory('sysconfig');


        $row = $config->where("varname='{$varname}'")->find()->as_array();

      /* $out = array();
        foreach($row as $obj)
        {
            $out[] = $obj->as_array();
        }
        print_r($out);*/
        return $row['value'];

        //return $row['value'];
       /* f


        //return $row['value'];*/
    }

}