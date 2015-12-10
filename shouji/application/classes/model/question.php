<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Question extends ORM {

    protected  $_table_name = 'question';
    public static $channeltable=array(
        1=>'line',
        2=>'hotel',
        3=>'car',
        4=>'article',
        5=>'spot',
        6=>'photo',
        13=>'tuan'
    );
    //获取产品名称
    public function getProductName($id,$typeid)
    {

        $tablename = 'sline_'.self::$channeltable[$typeid];
        $fields=array(
            '1'=>array('field'=>'title','link'=>'lines'),
            '2'=>array('field'=>'title','link'=>'hotels'),
            '3'=>array('field'=>'title','link'=>'cars'),
            '4'=>array('field'=>'title','link'=>'article'),
            '5'=>array('field'=>'title','link'=>'spots'),
            '6'=>array('field'=>'title','link'=>'photos'),
            '8'=>array('field'=>'title','link'=>'visa'),
            '13'=>array('field'=>'title','link'=>'tuan')

        );
        $field = $fields[$typeid]['field'];
        $link =$fields[$typeid]['link'];

        $sql = "select aid,{$field} as title from {$tablename} where id='$id'";

        $row = DB::query(Database::SELECT,$sql)->execute();


        $out = "<a href=\"/{$link}/show_{$row[0]['aid']}.html\" class='product-title' target=\"_blank\">{$row[0]['title']}</a>";

        return $out;

    }
}