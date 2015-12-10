<?php
/*----云搜索-----*/
require_once (dirname(__FILE__) . "/include/common.inc.php");
require_once (dirname(__FILE__) . "/include/listview.class.php");
$typeid = !empty($typeid) ? $typeid : 0;
$w = $typeid != 0 ? " and typeid={$typeid}" : '';

$keyword = $_GET['keyword'];
if (preg_match("/^[".chr(0xa1)."-".chr(0xff)."A-Za-z0-9_]+$/", $keyword)) //gb2312
{
    $keyword = iconv('gbk','utf-8',$keyword);
}

$keyword = RemoveXSS($keyword);

$keyword = Helper_Archive::pregReplace($keyword,6);//只能搜索中文英文和数字

$typeid = Helper_Archive::pregReplace($typeid,2);

if(isset($totalresult))
{
    $pageno = Helper_Archive::pregReplace($pageno,2);

    $totalresult = Helper_Archive::pregReplace($totalresult,2);
}

addSearchkey($keyword);//添加热搜词

require dirname(__FILE__)."/cloudsearch/pscws4.class.php";

$pscws = new PSCWS4('utf-8');

//
// 接下来, 设定一些分词参数或选项, set_dict 是必须的, 若想智能识别人名等需要 set_rule 
//
// 包括: set_charset, set_dict, set_rule, set_ignore, set_multi, set_debug, set_duality ... 等方法

$pscws->set_charset('utf-8');
$pscws->set_rule(dirname(__FILE__).'/cloudsearch/rules.utf8.ini');
$pscws->set_dict(dirname(__FILE__).'/cloudsearch/dict.utf8.xdb');
$pscws->send_text($keyword);
while ($some = $pscws->get_result())
{
    foreach ($some as $word)
    {
       $words[]=$word['word'];
    }
}

$where="ishidden=0";
foreach($words as $k=>$v)
{
    $where.=" and title like '%$v%'";
    if(mb_strlen($v,'utf-8')>1)
        $whereor.=" or title like '%$v%'";
}
$whereor=trim(trim($whereor),'or');
$wh=!empty($whereor)? "($where) or ($whereor)":$where;
$leftnavinfo = getLeftNav($wh,$typeid);
$whereor=empty($whereor)?$where:$whereor;

/*if($typeid)
{
    //  $wh.='('.$wh.')'." and typeid=$typeid";
    //  $whereor.=" and typeid=$typeid";
    // $where.=" and typeid=$typeid";
}*/


$sql="select a.* from (select *,case when $where then 1 when $whereor then 2 end as neworder from #@__search where ($wh)".$w.") a order by neworder";

$pv = new ListView(0);
$pv->pagesize=25;//分页条数.
$pv->SetSql($sql);
$pv->SetParameter('typeid',$typeid);
$pv->SetParameter('keyword',$keyword);
$templet = Helper_Archive::getUseTemplet('cloudsearch_index');//获取首页使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."" ."cloudsearch.htm";
$pv->SetTemplet($templet);
$pv->Display();
exit();

//获取图片html
function getLitPicHtml($row)
{
    $litpic = $row['litpic'];
    $url = getSearchUrl($row);
    if(!empty($litpic))
    {
        $litpic = getUploadFileUrl(str_replace('litpic','lit240',$litpic));
        $out = '<li class="li_img"><a href="'.$url.'" target="_blank"><img src="'.$litpic.'" width="118" height="90"  /></a></li>';

    }
    return $out;

}

//获取链接地址
function getSearchUrl($row)
{

    $typeid = $row['typeid'];
    $webid = $row['webid'];
    $aid = $row['aid'];
    $headimgid = $row['headimgid'];
    if($typeid==1)
    {
        $typename="lines";
    }
    else if($typeid==2)
    {
        $typename="hotels";
    }
    else if($typeid==3)
    {
        $typename="cars";
    }
    else if($typeid==4 && $webid==0)
    {
        $typename="raiders";
    }
    else if($typeid==4 && $webid!=0)
    {
        $typename="raider";
    }
    else if($typeid==5)
    {
        $typename="spots";
    }
    else if($typeid==6)
    {
        $typename="photos";
    }
    else if($typeid==8)
    {
        $typename="visa";
    }
    else if($typeid==13)
    {
        $typename="tuan";
    }

    $weburl=GetWebURLByWebid($webid);
    $headimgid = $headimgid ? "_{$headimgid}" : '';
    $url=$weburl."/".$typename."/show_{$aid}{$headimgid}.html";
    return $url;
}

//搜索页面左侧导航
function getLeftNav($where,$typeid)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__search');

    $arr = array(
        array('typeid'=>1,'channelname'=>'线路'),
        array('typeid'=>2,'channelname'=>'酒店'),
        array('typeid'=>3,'channelname'=>'车辆'),
        array('typeid'=>4,'channelname'=>'攻略'),
        array('typeid'=>5,'channelname'=>'门票'),
        array('typeid'=>6,'channelname'=>'相册'),
        array('typeid'=>8,'channelname'=>'签证'),
        array('typeid'=>13,'channelname'=>'团购')

    );

    // $where = "title like'%{$keyword}%'";
    //取得全部的查询数量
    $allnum = $model->getCount($where);//全部数量

    $out = array();
    $out[] = array('channelname'=>'全部','num'=>$allnum,'typeid'=>0);
    foreach($arr as $row)
    {



        $wh =" ($where) and typeid = '{$row['typeid']}'";

        $num = $model->getCount($wh);

        $out[] = array('channelname'=>$row['channelname'],'num'=>$num,'typeid'=>$row['typeid']);



    }

    return $out;

}
//添加热搜词表
function addSearchkey($keyword)
{
    global $dsql;
    $sql = "select 1 from #@__search_keyword where keyword = '$keyword' limit 1";
    if($dsql->ExecuteNoneQuery2($sql))
    {
        $updatesql = "update #@__search_keyword set keynumber = keynumber+1 where keyword = '$keyword'";
        $dsql->ExecuteNoneQuery($updatesql);

    }
    else
    {
        $time = time();
        $insertsql = "insert into #@__search_keyword(keyword,keynumber,addtime) values('$keyword',1,'$time')";
        $dsql->ExecuteNoneQuery($insertsql);
    }


}


