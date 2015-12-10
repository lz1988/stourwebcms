<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__).'/func.php');
require_once(dirname(__FILE__).'/config.php');
require_once SLINEINC."/listview.class.php";
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))require_once($file);

//存储前一个用户选择导航.
$dest_id=isset($dest_id) ? $dest_id : 0;
$attrid = isset($attrid) ? $attrid : 0;
$monthid = isset($monthid) ? $monthid : 0;
$dayid = isset($dayid) ? $dayid : 0;

if(!is_numeric($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
{
    if($dest_id!='all')
    {
        $d_id = Helper_Archive::getDestIdByPinYin($dest_id);
        $dest_id = !empty($d_id) ? $d_id : 0;
    }
    else
    {
        $dest_id = 0 ;
    }
}
$pkname = get_par_value($dest_id,$typeid);//上一级
getTopNavDest($dest_id);
//替换操作
$GLOBALS['dest_id'] = Helper_Archive::pregReplace($dest_id,2);
$GLOBALS['attrid'] =  Helper_Archive::pregReplace($attrid,4);
$GLOBALS['monthid'] = Helper_Archive::pregReplace($monthid,2);
$GLOBALS['dayid'] = Helper_Archive::pregReplace($dayid,4);

//下级目的地
$destlist = Helper_Archive::getChildDest($dest_id,$typeid);
//以下是条件判断
$where = " where a.ishidden=0 and a.status=1";
$wheercount = $where;
//属性
if($attrid)
{
    $attrwhere = Helper_Archive::getAttrWhere($attrid);//属性条件
    $where.= $attrwhere;
    $wherecount.= $attrwhere;
}
//月份
if($monthid)
{
    $where.= " and MONTH(startdate)='$monthid'";
    $wherecount.=" and MONTH(startdate)='$monthid'";
}
//天数
if($dayid)
{
    $ar = explode('_',$dayid);
    $before = $ar[0];
    $after = $ar[1];
    $w = " and (day>='$before' and day<='$after')";
    $where.=$w;
    $wherecount.=$w;
}

//如果选择目的地
if(!empty($dest_id))
{
    $where.=" and find_in_set($dest_id,a.kindlist)";
    $wherecount.=" and find_in_set($dest_id,a.kindlist)";

}
$sql="select a.* from sline_jieban a left join sline_allorderlist b on(a.id=b.aid and b.typeid=$typeid ) {$where} order by b.displayorder asc, a.addtime desc ";


//下级目的地
$destlist = Helper_Archive::getChildDest($dest_id,$typeid);



$seoinfo = JieBan::getChannelSeo($typeid);//优化信息标题

$pv = new ListView($typeid);
$pv->pagesize=16;//分页条数.
$pv->SetSql($sql);
//seo变量赋值
foreach($destinfo as $k=>$v)
{
    $pv->Fields[$k] = $v;
}
foreach($seoinfo as $k=>$v)
{
    $pv->Fields[$k] = $v;
}

$pv->Fields['typeid'] = $typeid;
$pv->Fields['monthid'] = $monthid;
$pv->Fields['pageno'] = $pageno;
$pv->SetParameter('destid',$dest_id);
$pv->SetParameter('monthid',$monthid);
$pv->SetParameter('day',$day);
$pv->SetParameter('attrid',$attrid);

$templet= SLINETEMPLATE ."/".$cfg_df_style ."/jieban/index.htm";	//默认模板
$pv->SetTemplet($templet);
$pv->Display();
exit();


?>
