<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 获取结伴标签代码
 *
 * @version        $Id: getjieban.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


function lib_getjieban(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|6,flag|new,limit|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';

    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    if($flag == 'new')
    {
        $sql = "select * from sline_jieban where status=1 order by addtime desc limit {$limit},{$row}";
    }
    else if($flag =='finish')
    {
        $sql = "select * from sline_jieban where status=2 order by addtime desc limit {$limit},{$row}";
    }
    else if($flag == 'join')
    {
        $jiebanid = $refObj->Fields['id'];
        $sql = "select * from sline_jieban_join  where jiebanid='$jiebanid' group by memberid order by addtime desc";

    }
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $GLOBALS['autoindex']++;
        if($flag!='join')
        {
            $row['title'] = TagJB::getJiebanTitle($row);
            $row['kindnamelist'] = TagJB::getKindnameList($row,'-');
            $row['posttime'] = TagJB::formatViewTime($row['addtime']);
            $row['membername'] = TagJB::getMemberName($row['memberid']);
            $row['url'] = $GLOBALS['cfg_cmsurl'].'/jieban/show_'.$row['id'].'.html';
            $row['attrlist'] = TagJB::getAttrList($row['attrid']);
            $row['joinnum'] = TagJB::getJoinNumber($row['id']);
        }
        else
        {
            $memberinfo = Helper_Archive::getMemberInfo($row['memberid']);
            $row['membername'] = $memberinfo['nickname'];
            $row['litpic'] = $memberinfo['litpic'] ? $memberinfo['litpic'] : '/templets/smore/images/member_default.gif';
            $row['joinnum'] = TagJB::getSingleJoinNumber($row['jiebanid'],$row['memberid']);
        }


        foreach($ctp->CTags as $tagid=>$ctag)
        {

            if($ctag->GetName()=='array')
            {
                $ctp->Assign($tagid, $row);
            }
            else
            {
                if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]);
                else $ctp->Assign($tagid,'');
            }
        }
        $revalue .= $ctp->GetResult();
    }
    return $revalue;
}

class TagJB{
    /*
  * 获取结伴title
  * */
    public static function getJiebanTitle($arr)
    {

        $title = $arr['title'];

        $dest = self::getKindnameList($arr);
        $dest = explode(',',$dest);
        $dest = implode('-',$dest);
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
    public static function formatViewTime ($time)
    {
        $time=time()-$time;
        $year = floor($time / 60 / 60 / 24 / 365);
        $time -= $year * 60 * 60 * 24 * 365;
        $month = floor($time / 60 / 60 / 24 / 30);
        $time -= $month * 60 * 60 * 24 * 30;
        $week = floor($time / 60 / 60 / 24 / 7);
        $time -= $week * 60 * 60 * 24 * 7;
        $day = floor($time / 60 / 60 / 24);
        $time -= $day * 60 * 60 * 24;
        $hour = floor($time / 60 / 60);
        $time -= $hour * 60 * 60;
        $minute = floor($time / 60);
        $time -= $minute * 60;
        $second = $time;

        //这里修改读随机的.
        /*  $hour = mt_rand(0,3);
          $minute = mt_rand(0,60);
          $second = mt_rand(0,60);*/
        $elapse = '';
        $unitArr = array('年' =>'year', '个月'=>'month', '周'=>'week', '天'=>'day',
            '小时'=>'hour', '分钟'=>'minute', '秒'=>'second'
        );
        foreach ( $unitArr as $cn => $u )
        {
            if ( $$u > 0 )
            {
                $elapse = $$u . $cn;
                break;
            }
        }


        return $elapse.'前';
    }
    //获取会员列表
    public static function getMemberName($memberid)
    {
        global $dsql;
        $sql = "select nickname from sline_member where mid='$memberid'";
        $row = $dsql->GetOne($sql);
        return $row['nickname'];
    }
    //获取属性列表
    public static function getAttrList($attrid)
    {
        global $dsql;
        $out = '';
        $arr = explode(',',$attrid);
        foreach($arr as $atid)
        {
            $sql = "select attrname from sline_jieban_attr where id='$atid'";
            $row = $dsql->GetOne($sql);
            if(!empty($row['attrname']));
            $out.="<span>{$row['attrname']}</span>";

        }
        return $out;
    }
    //获取加入人数
    public static function getJoinNumber($id,$memberid=0)
    {
        global $dsql;
        $sql = "select SUM(adultnum) as adultnum,SUM(childnum) as childnum from sline_jieban_join where jiebanid='$id'";
        $sql.= $memberid ? " and memberid='$memberid'" : '';
        $row = $dsql->GetOne($sql);
        $num = intval($row['adultnum'])+ intval($row['childnum']);
        return $num;
    }
    //获取单个会员加入人数
    public static function getSingleJoinNumber($id,$memberid)
    {
        global $dsql;
        $sql = "select SUM(adultnum) as adultnum,SUM(childnum) as childnum from sline_jieban_join where jiebanid='$id' and memberid='$memberid'";
        $row = $dsql->GetOne($sql);
        $num = intval($row['adultnum'])+ intval($row['childnum']);
        return $num;
    }

}


?>