<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Attrlist {

    private  static $table_arr=array(
        1=>'line_attr',
        2=>'hotel_attr',
        3=>'car_attr',
        4=>'article_attr',
        5=>'spot_attr',
        6=>'photo_attr',
        11=>'jieban_attr',
        13=>'tuan_attr'
    );
    /*
    * 根据typeid获取产品属性的列表(netman)
    * */
    public static function getAttr($typeid,$pid=0)
    {
        $modelinfo = Model_Model::getModuleInfo($typeid);
        $attrtable = $modelinfo['attrtable'];
        $w = $typeid>13 ? "and typeid=$typeid" : '';
        $model=ORM::factory($attrtable);
        $list=$model->where("isopen=1 and pid={$pid} {$w}")->get_all();
        return $list;

    }

    /*
     * 获取产品属性表
     * */
    public static function getAttrTable($typeid)
    {
        $row = ORM::factory('model',$typeid)->as_array();
        return $row['attrtable'] ? $row['attrtable'] : null;
    }

    public static function getParentsStr($idstr,$typeid)
    {

        $table=self::getAttrTable($typeid);
        $table='sline_'.$table;
        $idArr=explode(',',$idstr);
        foreach($idArr as $v)
        {
            $sql="select pid from $table where id=:id";
            $result=DB::query(Database::SELECT,$sql)->param(":id",$v)->execute()->as_array();
            $pid=$result[0]['pid'];
            if($pid!=0&&!in_array($pid,$idArr))
                array_unshift($idArr,$pid);

        }
        return $idArr;
    }



 
}