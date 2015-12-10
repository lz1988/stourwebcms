<?php
/**
 * Created by Phpstorm.
 * User: netman
 * Date: 14-5-10
 * Time: 上午10:43
 */

class Taglib_Article {

    /*
     * 获取文章标签
     * @param 参数
     * @return array

   */
    public static function getarticle($params)
    {
        $default=array('row'=>10,'limit'=>0,'type'=>'top','flag'=>'new');
        $params=array_merge($default,$params);
        extract($params);
        $model = ORM::factory('line');
        $list = $model
            ->limit($row)
            ->offset($limit)
            ->find_all()->as_array();
        foreach($list as $key => $row)
        {
            $list[$key] = $row->as_array();
        }

        return $list;




    }

} 