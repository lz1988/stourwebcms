<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member extends ORM {

    protected  $_primary_key = 'mid';

      /*
       * 检查是否存在相同数据
       * */
    public static function checkExist($field,$value,$mid='')
    {
        $flag = 'true';
        $model = ORM::factory('member')->where($field,'=',$value);
        if(!empty($mid))
        {
            $model->where('mid','!=',$mid);
        }
        else
        {

        }
        $model->find();
        if($model->loaded() && !empty($model->mid))
        {
            $flag = 'false';
        }
        return $flag  ;
    }



}