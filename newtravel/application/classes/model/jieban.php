<?php
class Model_Jieban extends ORM {

    protected  $_table_name = 'jieban';

    public static function  genTitle($arr,$day)
    {
       $title = $arr['title'];
       $dest = Model_Destinations::getKindnameList($arr['kindlist']);
       $dest = explode(',',$dest);
       $dest = implode('--',$dest);
       return $title ? $title :$dest.$day.'日游行程';
    }
    /*
     * 获取加入人数
     * */
    public static function getJoinNum($jiebanid)
    {
        $sql = "select sum(adultnum) as adultnum,sum(childnum) as childnum from sline_jieban_join where jiebanid='$jiebanid'";
        $row = DB::query(1,$sql)->execute()->as_array();
        $num = intval($row[0]['adultnum'])+ intval($row[0]['childnum']);
        return $num;
    }


}