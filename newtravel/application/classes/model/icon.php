<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Icon extends ORM {

    //重写delete方法
    public function delete()
    {
        Common::deleteRelativeImage($this->picurl);
        parent::delete();
    }

    public static function getIconName($iconlist)
    {
        $icon_arr = explode(',',$iconlist);
        $arr = array();
        foreach($icon_arr as $v)
        {
            $name = ORM::factory('icon',$v)->get('kind');
            array_push($arr,$name);
        }
        return $arr;

    }
    
}