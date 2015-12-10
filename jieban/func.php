<?php
/**
 * Created by PhpStorm.
 * User: netman
 * QQ: 87482723
 * Time: 15-1-28 下午7:44
 */
Class JieBan{

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
    public static function getSeoInfo($attrid,$typeid)
    {
        $row = array();
        $sql="select seotitle,shortname as typename ,linktitle,tagword,url,keyword as seokeyword,description as seodescription,jieshao from #@__nav where typeid ={$typeid} and webid='0'";


        $row = $dsql->GetOne($sql);

        if(is_array($row))
        {
            $row['seotitle']=empty($row['seotitle'])?$row['typename']:$row['seotitle'];
            $row['typename']=!empty($row['linktitle']) ? $row['linktitle'] : $row['typename'];


        }
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

        $sql="select seotitle,shortname as typename ,tagword,url,keyword,jieshao,description from #@__nav where typeid ={$typeid} and webid='0'";

        $row = $dsql->GetOne($sql);

        if(is_array($row))
        {
            $row['seotitle']=empty($row['seotitle'])?$row['typename']:$row['seotitle'];
            $row['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
            $row['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";


        }
        return $row;
    }

    /*
     * 获取搜索地址
     * */
    public static function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('monthid','dayid','attrid'))
    {

            $url ='/jieban/';
            $table = 'sline_jieban';
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
       $sql = "update sline_jieban set shownum=shownum+1 where id='$id'";
       $dsql->ExecNoneQuery($sql);
   }

    /*
     * 获取产品信息
     * */
    public static function getProductInfo($id)
    {
        global $dsql,$module_extend_table;
        $sql = "select a.* from sline_jieban a  where a.id='$id'";
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

    /*
     * 获取结伴title
     * */
    public static function getJiebanTitle($arr)
    {
        $title = $arr['title'];

        $dest = self::getKindnameList($arr);
        $dest = explode(',',$dest);
        $dest = implode('--',$dest);
        return $title ? $title : $dest.$arr['day'].'日游行程';
    }

    public static function getKindnameList($arr,$separator=',')
    {
        global $dsql;
        $kindid_str = $arr['kindlist'];
        $userdest = $arr['userdest'];

        $kind_arr=explode(',',$kindid_str);
        foreach($kind_arr as $k=>$v)
        {
            $sql = "select kindname from sline_destinations where id='$v'";
            $dest = $dsql->GetOne($sql);


            if($dest['kindname'])
                $dest_str.=$dest['kindname'].$separator;
        }
        $dest_str=trim($dest_str,$separator);


        return $userdest!='null' ? $userdest : $dest_str;
    }
    //获取属性列表
    public static function getAttrList($attrid)
    {
        global $dsql;
        $out = '';
        $arr = RemoveEmpty(explode(',',$attrid));
        foreach($arr as $atid)
        {
            $sql = "select attrname from sline_jieban_attr where id='$atid'";
            $row = $dsql->GetOne($sql);

                $out.="<span>{$row['attrname']}</span>";



        }

        return $out;
    }
    //获取会员信息
    public static function getMemberName($memberid)
    {
        global $dsql;
        $sql = "select nickname from sline_member where mid='$memberid'";
        $row = $dsql->GetOne($sql);
        return $row['nickname'];
    }


    //获取加入人数
    public static function getJoinNumber($id)
    {
        global $dsql;
        $sql = "select SUM(adultnum) as adultnum,SUM(childnum) as childnum from sline_jieban_join where jiebanid='$id'";
        $row = $dsql->GetOne($sql);
        $num = intval($row['adultnum'])+ intval($row['childnum']);
        return $num;
    }

    //获取线路信息
    public static function getLineInfo($lineid)
    {
        global $dsql;
        $out = '';
        if(!empty($lineid) && $lineid!='null')
        {
            $sql = "select * from sline_line where id='$lineid'";
            $row = $dsql->GetOne($sql);
            $webroot=GetWebURLByWebid($row['webid']);
            $url = $webroot.'/lines/show_'.$row['aid'].'.html';
            $litpic = getUploadFileUrl($row['litpic']);
            $price = getLineRealPrice($row['aid'],$row['webid']);
            $out = '';
            $out.='<dl>';
            $out.='<dt><a class="fl" href="'.$url.'"><img class="fl" src="'.$litpic.'"  width="174" height="129" /></a></dt>';
            $out.='<dd>';
            $out.='<span class="tit"><a href="'.$url.'" target="_blank">'.$row['title'].'</a></span>';
            $out.='<span class="txt">'.$row['sellpoint'].'</span>';
            $out.='<span class="price">参考价：<em>￥'.$price.'</em>/人</span>';
            $out.='<span class="more-btn"><a href="'.$url.'" target="_blank">查看详情</a></span>';
            $out.='</dd>';
            $out.='</dl>';
        }

        return $out;
    }

    //获取行程图片
    public static function getPicture($arr)
    {
        $memo = $arr['memo'];
        preg_match_all("/<img([^>]*)\s*src=('|\")([^'\"]+)('|\")/",$memo,$matches);//带引号

        $new_arr=array_unique($matches[0]);//去除数组中重复的值
        $head = '<div class="slidepic">
                          <a class="next"></a>
                          <a class="prev"></a>
                          <div class="bd">
                              <div class="tempWrap">
                                  <ul class="picList">';
        $foot = ' </ul>
                              </div>
                          </div>
                      </div>';
        foreach($new_arr as $key)
        {
            $body.='<li><div class="pic"><a href="javascript:;" target="_blank">'.$key.'/></a></div></li>';
        }
        return $body ? $head.$body.$foot : '';

    }






}