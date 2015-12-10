<?php
class Model_Page_Config extends ORM {
    public static function getTemplateList($pagename)
    {
        $model=ORM::factory('page')->where('pagename','=',$pagename)->find();
        if(!$model->loaded())
            return false;
        $id=$model->id;
        $list=ORM::factory('page_config')->where('pageid','=',$id)->get_all();
        return $list;
    }
    

}