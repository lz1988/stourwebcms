<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Role_Module extends ORM {
     
    public static function setField($roleid,$moduleid,$field,$value)
    {
        $module=new self;
        $onemodule=$module->where("roleid=$roleid and moduleid='$moduleid'")->find();
        if($onemodule->roleid)
        {
            $query = DB::update('role_module')->set(array($field=>$value))->where("roleid=$roleid and moduleid='$moduleid'");
            $result=$query->execute();
            if($result>=1)
                return true;
        }
        else
        {
            $onemodule=new self;
            $onemodule->roleid=$roleid;
            $onemodule->moduleid=$moduleid;
            $onemodule->$field=$value;
            $onemodule->save();
            if($onemodule->saved())
                return true;
        }
        return false;

    }
}