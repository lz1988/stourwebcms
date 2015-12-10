<?php
/**
 * Created by Phpstorm.
 * User: netman
 * Date: 14-11-13
 */

class Taglib_Ad {

    /*
     * 广告调用标签
     * @param 参数
     * @return array

   */
    //轮播图获取
    public static function getRollAd($params)
    {
        $default=array('row'=>10,'name'=>0);
        $params=array_merge($default,$params);

        extract($params);
        $sql="SELECT * FROM sline_advertise WHERE tagname = '$name'  ORDER BY displayorder asc ";

        $list = DB::query(1,$sql)->execute()->as_array();

        return $list;




    }

} 