<?php
/**
 *  曾泽军
 *  2014-12-24
 */

class Taglib_Cars {

    /*
     * 获取按时间或排序查找租车信息
     * @param 参数
     * @return array
   */
    public static function getCars($params)
    {
        $default=array('row'=>10,'limit'=>0,'type'=>'top','flag'=>'new');
        $params=array_merge($default,$params);

        extract($params);

        //获取最新租车信息
        if($flag == 'new')
        {
            $sql = "select a.* from sline_car a order by a.modtime desc,a.addtime desc limit {$limit},{$row}";
        }
        else if($flag == 'top') //根据排序获取租车信息
        {
            $sql = "select a.* from sline_car a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) order by ifnull(b.displayorder,9999) asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

        }
        $list = DB::query(1,$sql)->execute()->as_array();

        foreach($list as $key=>$value)
        {
            $list[$key]['title'] = $list[$key]['title'];
            $list[$key]['url'] = $GLOBALS['cfg_cmspath'].'cars/show/id/'.$list[$key]['id'];
            $list[$key]['litpic'] = !empty($list[$key]['litpic']) ? $list[$key]['litpic'] : Common::getDefaultImage();
            $list[$key]['satisfyscore'] = !empty($list[$key]['satisfyscore']) ? $list[$key]['satisfyscore'] : mt_rand(92,96).'%';
            $list[$key]['content'] = Common::cutstr_html($list[$key]['content'],40);
        }

        return $list;




    }

} 