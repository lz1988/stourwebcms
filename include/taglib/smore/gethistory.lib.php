<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 访问历史标签代码
 *
 * @version        $Id: gethistory.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


function lib_gethistory(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|6";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	
    if(isset($_COOKIE['St']['line']))
    {
        $list = unserialize($_COOKIE['St']['line']);
        $arr = getLineList($list);

    }
    else
    {
        return;
    }

    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    foreach($arr as $row)
    {
        $GLOBALS['autoindex']++;

        foreach($ctp->CTags as $tagid=>$ctag)
        {
            if($ctag->GetName()=='array')
            {
                $ctp->Assign($tagid, $row);
            }
            else
            {
                if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]);
            }
        }
        $revalue .= $ctp->GetResult();
    }
    return $revalue;
}

function getLineList($arr)
{
    global $dsql;
    $out = array();
    $arr = array_reverse($arr);
    foreach($arr as $v)
    {
        $sql = "select *,litpic,price as price from #@__line where id = {$v['id']}";
        $row = $dsql->GetOne($sql);
        $out[]=array(
            'title'=>$row['title'],
            'url'=>$GLOBALS['cfg_cmsurl'] . '/lines/show_' . $row['aid'] . ".html",
            'price'=>$row['price'],
            'litpic'=>empty($row['litpic']) ? getUploadFileUrl($row['litpic']) : $GLOBALS['cfg_cmsurl'] . $row['litpic'],
            'time'=>formatViewTime($v['time'])
        );

    }
    return $out;

}
function formatViewTime ($time)
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
?>