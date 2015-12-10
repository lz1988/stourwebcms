<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Advertise_Type extends ORM {


    /*
         * 检查是否存在相同数据
         * */
    public static function checkExist($field,$value,$id='')
    {
        $flag = 'true';
        $model = ORM::factory('advertise_type')->where($field,'=',$value);
        if(!empty($id))
        {
            $model->where('id','!=',$id);
        }
        $model->find();
        if($model->loaded() && !empty($model->id))
        {
            $flag = 'false';
        }
        return $flag  ;
    }



}