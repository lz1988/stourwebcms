<?php

//车辆搜索页面.
require_once (dirname(__FILE__) . "/../include/common.inc.php");
require_once(SLINEDATA."/webinfo.php");
require_once SLINEINC."/listview.class.php";
require_once (dirname(__FILE__) . "/car.func.php");
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))
{
  require_once($file);	
}
if(isset($totalresult)) $totalresult = intval(preg_replace("/[^\d]/", '', $totalresult));//总记录数

if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页

$dest_id=RemoveXSS($dest_id);
$carkindid=Helper_Archive::pregReplace($carkindid,2);
$attrid=Helper_Archive::pregReplace($attrid,4);
$startplaceid=Helper_Archive::pregReplace($startplaceid,2);

$typeid=3;
$carkindname='';
$carbrandname='';
$priceinfo=''; //初始化


$dest_id=!empty($dest_id) ? $dest_id : 0;
//这里增加子站判断
if($GLOBALS['sys_child_webid']!=0&&empty($dest_id))$dest_id=$GLOBALS['sys_child_webid'];
if(!is_numeric($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
{
    $dest_id = Helper_Archive::pregReplace($dest_id,8);//只能字母.数字
    if($dest_id!='all')
    {
        $d_id = Helper_Archive::getDestIdByPinYin($dest_id);
        $dest_id = !empty($d_id) ? $d_id : $dest_id;
    }
    else
    {
        $dest_id = 0;
    }
}
//$sql="select distinct a.aid,a.* from #@__car a where a.webid is not null";
$where=" where a.webid=0 ";
//租车城市
if(!empty($startplace))
{
	$startcity=$dsql->GetOne("select id from #@__startplace where cityname like '%{$startplace}%'");
	$startplaceid=$startcity['id'];
}

if($startplaceid!=0)//出发城市
{
    //$sql.=" and a.startplaceid=$startplaceid ";
    $where.=" and a.startplaceid=$startplaceid ";
    $startcityname = getStartCityName($startplaceid);
}
if($carkindid!=0) //车型分类
{

  //$sql=$sql." and a.carkindid=$carkindid ";
  $car_where.=" and a.carkindid=$carkindid ";
}

if($attrid!=0)//租车属性
{

  $attrid_arr=explode('_',$attrid);
  foreach($attrid_arr as $k=>$v)
  {
      if($k == 0){
          $attr_where.=" and find_in_set($v,a.attrid)";
      }
      else
      {
          $attr_where.=" and find_in_set($v,a.attrid)";
      }

  }
  //$sql.=$attr_where;
  //$where.=$attr_where.$car_where;
}

if(strlen($attr_where)== '')
{
   $where .= $car_where;
}else{
   $where .=  $car_where.$attr_where;	
}
//目的地
$where.= !empty($dest_id) ? "and FIND_IN_SET($dest_id,a.kindlist)" : '';
//排序
switch($displayorder)
	{
	 case '3':
	   $orderby=" order by a.shownum desc,a.displayorder asc, a.modtime desc,a.addtime desc";
	   break;
	 case '2':
       $orderby=" order by a.shownum desc,a.displayorder asc, a.modtime desc,a.addtime desc";
	   break;
	 case '1':
       $orderby=" order by b.isjian desc,a.displayorder asc,a.modtime desc,a.addtime desc";
	   break;
	 default:
       $orderby=" order by b.displayorder asc,a.modtime desc,a.addtime desc";
	   break;  	
	}
if(empty($dest_id))
{
    $sql = "select a.* from sline_car a left join sline_allorderlist b on(a.id=b.aid and b.typeid=$typeid) {$where} {$orderby}";
}
else
{
    $sql = "select a.* from sline_car a left join sline_kindorderlist b on(a.id=b.aid and b.typeid=$typeid and b.classid='$dest_id') {$where} {$orderby}";
}


$pv = new ListView($typeid);

$pv->pagesize=10;//分页条数.

$pv->SetSql($sql);

$channelname=GetTypeName($typeid);

if($carkindid!=0)
{
   $carkindname=getCarKind($carkindid);
   $carkindtitle = getCarKindTitle($carkindid);
}
$destinfo = getDestInfo($typeid,$dest_id);//目的地优化信息;

$seoarr=Generateinfo();
$seoarr['channelname']=$channelname;//栏目名称
//当前页数->title里面使用
$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
//下级目的地
$destlist = Helper_Archive::getChildDest($dest_id,$typeid);
//seo变量赋值

foreach($seoarr as $k=>$v)
{
$pv->Fields[$k] = $v;

}
$jieshao=$destinfo['jieshao'];

$pv->SetParameter('jieshao',$jieshao);
$pv->SetParameter('dest_id',$dest_id);
$pv->SetParameter('startplaceid', $startplaceid);
$pv->SetParameter('carkindid', $carkindid);
$pv->SetParameter('displayorder', $displayorder);
$pv->SetParameter('attrid', $attrid);
getTopNavDest($dest_id);
//模板选择
$templet = Helper_Archive::getUseTemplet('car_list');//获取使用模板
$templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."cars/" ."car_search.htm";	//默认模板
$pv->SetTemplet($templet);
$pv->Display();

/**
*  生成searchtitle,keyword,description等信息.
*
* @access    private
* @return    array
*/
function GenerateInfo()
{

    global $carkindname,$searchkey,
           $startcityname,$carkindtitle,$attrid,$seatnum,$destinfo;

    $arr=array();

    $seo = array();
    $keyword = array();

    if(!empty($carkindname))
    {
        if(!empty($carkindtitle)) //如果车型优化信息不为空,则使用优化信息标题.
        {
            array_push($seo,$carkindtitle);
        }
        else
        {
            array_push($seo,$carkindname);//车型信息
        }
        array_push($keyword,$carkindname);

    }

    if(!empty($attrid))
    {
        $out = getCarAttrName3($attrid); //属性信息
        array_push($seo,implode('_',$out));
        array_push($keyword,implode(',',$out));
    }

    if (!empty($searchkey))
    {
        array_push($seo, $searchkey . '列表'); //按名称搜索
    }
    if (empty($seo))
    {
        $info = getCarChannelSeo();
        array_push($seo, $info['seotitle']);
        array_push($keyword, $info['keyword']);
        $descrition = $info['description'];
    }
    $keyword = empty($destinfo['keyword']) ? $keyword : array($destinfo['keyword']);

    $searchtitle=empty($carkindtitle)?implode("_",$seo):$carkindtitle;
    $descrition = empty($destinfo['description']) ? $descrition : $destinfo['description'];
    $arr['searchtitle'] = empty($destinfo['seotitle']) ? $searchtitle : $destinfo['seotitle'];
    $arr['keyword'] = "<meta name=\"keywords\" content=\"" . implode(',', $keyword) . "\"/>";
    $arr['description'] = !empty($descrition) ? "<meta name=\"description\" content=\"" . $descrition . "\"/>" : '';

    return $arr;
}


?>﻿