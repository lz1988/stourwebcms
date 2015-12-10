<?php
/**
 * Created by PhpStorm.
 * User: netman
 * QQ: 87482723
 * Time: 15-1-28 下午7:44
 */
Class TongYong{

    public static function getModuleInfo($typeid)
    {
        global $dsql;
        $sql = "select * from sline_model where id='$typeid'";
        $row = $dsql->GetOne($sql);
        return $row;
    }
    /*
     * 目的地信息
     * */
    public static function getDestSeoInfo($desttable,$destid=0)
    {

            global $dsql,$cfg_line_title,$cfg_line_desc;
            $arr=array();
            if($destid)
            {

                $sql="select a.kindname,b.seotitle,b.jieshao,b.keyword,b.tagword,b.description,a.pinyin from #@__destinations as a inner join {$desttable} as b on a.id=b.kindid where a.id={$destid} ";
                $row=$dsql->GetOne($sql);

                $cfg_line_title=str_replace('XXX',$row['kindname'],$cfg_line_title);
                $cfg_line_desc=str_replace('XXX',$row['kindname'],$cfg_line_desc);
                if(empty($row['seotitle']))
                {

                    $arr['seotitle']=empty($cfg_line_title) ? $row['kindname'] : $cfg_line_title;
                }
                else
                {
                    $arr['seotitle']=$row['seotitle'];

                }
                if(empty($row['description']))
                {
                    $arr['description']=empty($cfg_line_desc) ? $row['description'] : $cfg_line_desc;
                }
                else
                {
                    $arr['description']=$row['description'];
                }


                $arr['typename']=$row['kindname'];
                $arr['dest_jieshao']=$row['jieshao'];
                $arr['dest_name'] = $row['kindname'];
                $arr['kindid'] = $destid;
                $arr['dest_id'] = $destid;
                $arr['dest_pinyin'] = $row['pinyin'];
                $arr['tagword']=$row['tagword'];
                $arr['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
                $arr['seodescription']=!empty($arr['description'])?"<meta name=\"description\" content=\"".$arr['description']."\"/>":"";
                $arr['pinyin'] = $row['pinyin'];
            }

            return $arr;

    }
    /*
     *获取优化标题信息
     * */
    public static function getSeoInfo($info,$attrid,$typeid)
    {
        $row = array();
        if(!empty($info['seotitle']))
        {
            $row['searchtitle'] = $info['seotitle'] . self::getAttrName($attrid);

        }
        else
        {
            $row = self::getChannelSeo($typeid);
            $row['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
            $row['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
            $row['searchtitle'] = $row['seotitle'];

        }
        return $row;

    }

    /*
     * 获取属性名称
     * */
    public static function getAttrName($attrid)
    {

            global $dsql;
            $arr = explode(',',$attrid);
            $namelist = '';
            foreach($arr as $id)
            {
                $sql = "select attrname from sline_model_attr where id='$id'";
                $row = $dsql->GetOne($sql);
                $namelist.=$row['attrname'].'|';
            }
            return $namelist;

    }

    /*
     * 获取栏目优化信息
     * */
    public static function getChannelSeo($typeid)
    {
        global $dsql;

        $sql="select seotitle,shortname as typename ,tagword,url,keyword as seokeyword,description as seodescription,jieshao from #@__nav where typeid ={$typeid} and webid='0'";

        $row = $dsql->GetOne($sql);

        if(is_array($row))
        {
            $row['seotitle']=empty($row['seotitle'])?$row['typename']:$row['seotitle'];

        }
        return $row;
    }

    /*
     * 获取搜索地址
     * */
    public static function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('attrid'))
    {
            global $module_pinyin;
            $url ='/'.$module_pinyin.'/';
            $table = 'sline_model_attr';
            return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table);

    }
    /*
     * 获取最低价
     * */
    public static function getProductMinPrice($productid)
    {
        global $dsql;
        $sql = "select min(ourprice) as price from sline_model_suit where productid='$productid'";
        $row = $dsql->GetOne($sql);
        return $row['price'] ? '￥'.$row['price'] : ' 电询';
    }

    /*
     * 更新访问次数
     * */
   public static function updateVisit($id)
   {
       global $dsql;
       $sql = "update sline_model_archive set shownum=shownum+1 where id='$id'";
       $dsql->ExecNoneQuery($sql);
   }

    /*
     * 获取产品信息
     * */
    public static function getProductInfo($aid,$typeid)
    {
        global $dsql,$module_extend_table;
        $sql = "select a.*,a.id as articleid,b.* from sline_model_archive a left join $module_extend_table b on (a.id=b.productid) where a.aid='$aid' and a.typeid='$typeid'";
        $row = $dsql->GetOne($sql);
        return $row;
    }

    /*
     * 分析处理图片
     * */
    public static function handlePicture($piclist)
    {
        $out = array();
        $arr = explode(',',$piclist);
        foreach($arr as $row)
        {
            $p = explode('||',$row);
            $out[]=array('desc'=>$p[1],'litpic'=>getUploadFileUrl($p[0]));
        }
        return $out;

    }
    /*
     * 获取套餐信息
     * */
    public static function getSuitInfo($suitid)
    {
        global $dsql;
        $sql = "select *,id as suitid from sline_model_suit where id='$suitid'";
        $row = $dsql->GetOne($sql);
        return $row;
    }






}