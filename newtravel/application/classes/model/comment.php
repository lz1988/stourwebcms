<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Comment extends ORM {


    /*
    * 获取会员名称
    * */
    public static function getMemberName($memberid)
    {

        $model = ORM::factory('member')->where('mid','=',$memberid)->find();

        if(isset($model->nickname))
        {
            $nickname = $model->nickname;


        }

        return $nickname ? $nickname : '匿名';
    }
    /*
     * 获取评论模块
     * */
    public static function getPinlunModule($typeid)
    {
        $module_arr = array(
            '1'=>'线路',
            '2'=>'酒店',
            '3'=>'租车',
            '4'=>'文章',
            '5'=>'门票/景点',
            '6'=>'相册',
            '8'=>'签证',
            '13'=>'团购'
        );
        return $module_arr[$typeid];
    }
}