<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Attrlist {

    private  static $table_arr=array(
        1=>'line_attr',
        2=>'hotel_attr',
        3=>'car_attr',
        4=>'article_attr',
        5=>'spot_attr',
        6=>'photo_attr',
        13=>'tuan_attr'
    );
    /*
    * 根据typeid获取产品属性的列表(netman)
    * */
    public static function getAttr($typeid,$pid=0)
    {
        $model=ORM::factory(self::$table_arr[$typeid]);
        $list=$model->where("isopen=1 and pid={$pid}")->get_all();

        return $list;

    }



 
}