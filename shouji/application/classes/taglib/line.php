<?php
/**
 * Created by Phpstorm.
 * User: netman
 * Date: 14-11-13
 */

class Taglib_Line {

    /*
     * 获取线路标签
     * @param 参数
     * @return array

   */
    public static function getLine($params)
    {
        $default=array('row'=>10,'limit'=>0,'type'=>'top','flag'=>'new');
        $params=array_merge($default,$params);

        extract($params);

        //获取最新线路
        if($flag == 'new')
        {
            $sql = "select a.* from sline_line a order by a.modtime desc,a.addtime desc limit {$limit},{$row}";
        }
        else if($flag == 'byorder') //根据排序获取线路
        {
            $sql = "select a.* from sline_line a left join sline_allorderlist b on (a.id=b.aid and b.typeid=1) where ishidden=0 order by ifnull(b.displayorder,9999) asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

        }
        $list = DB::query(1,$sql)->execute()->as_array();

        foreach($list as $key=>$value)
        {
            $list[$key]['title'] = $list[$key]['title'];
            $list[$key]['url'] = $GLOBALS['cfg_cmspath'].'lines/show/id/'.$list[$key]['id'];
            $list[$key]['litpic'] = !empty($list[$key]['litpic']) ? $list[$key]['litpic'] : Common::getDefaultImage();
            $list[$key]['satisfyscore'] = !empty($list[$key]['satisfyscore']) ? $list[$key]['satisfyscore'] : mt_rand(92,96).'%';
            $list[$key]['lineprice'] = Model_Line::getMinPrice($list[$key]['id']);
        }

        return $list;




    }

} 