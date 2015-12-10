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

    /*
     * 根据id,typeid获取满意度
     * */
    public static function getScore($id,$typeid)
    {
        $arr = ORM::factory('comment')->where("articleid='$id' and typeid='$typeid'")->get_all();
        $i = 0;
        $score = 0;
        foreach($arr as $row)
        {
            $score+= $row['score1'];
            $i++;
        }
        if($i!=0)
        {
            $avg = $score/$i;

            $out = sprintf("%.2f", $avg)*20;

        }
        else
        {
            $out = mt_rand(92,98);
        }
        $out.="%";
        return $out;

    }
    /*
     * 获取点评人数
     * */
    public static function getPinLunCount($id,$typeid)
    {
        $sql = "select count(*) as num from sline_comment where articleid='$articleid' and typeid='$typeid'";
        $arr = DB::query(1,$sql)->execute()->as_array();
        return $arr[0]['num'] ? $arr[0]['num'] : 0;
    }
}