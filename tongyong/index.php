<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(SLINEROOT.'/tongyong/func.php');
require_once(dirname(__FILE__).'/config.php');
require_once SLINEINC."/listview.class.php";
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))require_once($file);

//存储前一个用户选择导航.
$dest_id=isset($dest_id) ? $dest_id : 0;
$attrid = isset($attrid) ? $attrid : 0;
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

$GLOBALS['startcity']=$GLOBALS['cityid'] =  Helper_Archive::pregReplace($startcity,2);
//下级目的地
$destlist = Helper_Archive::getChildDest($dest_id,$typeid);
//以下是条件判断
$where = $wherecount = " where a.ishidden=0 and a.typeid=$typeid";
if($attrid)
{
    $attrwhere = Helper_Archive::getAttrWhere($attrid);//属性条件
    $where.= $attrwhere;
    $wherecount.= $attrwhere;
}

//如果选择目的地
if(!empty($dest_id))
{
    $where.=" and find_in_set($dest_id,a.kindlist)";
    $wherecount.=" and find_in_set($dest_id,a.kindlist)";
    $sql="select a.* from sline_model_archive a left join sline_kindorderlist b on(a.id=b.aid and b.typeid=$typeid and b.classid=$dest_id ) {$where} order by b.displayorder asc, a.modtime desc,a.addtime desc ";
}
else //通用排序
{
    $sql="select a.* from sline_model_archive a left join sline_allorderlist b on(a.id=b.aid and b.typeid=$typeid ) {$where} order by b.displayorder asc, a.modtime desc,a.addtime desc ";
}


$destinfo = TongYong::getDestSeoInfo($module_dest_table,$dest_id);//目的地优化信息;

$seoinfo = TongYong::getSeoInfo($destinfo,$attrid,$typeid);//组合搜索标题



//下级目的地
$destlist = Helper_Archive::getChildDest($dest_id,$typeid);
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
$pv->Fields['modulename'] = $module_name;
$pv->Fields['modulepinyin'] = $module_pinyin;

$pv->SetParameter('destid',$dest_id);
$pv->SetParameter('attrid',$attrid);

//获取当前文件夹名
//兼容win linux 
$filename =str_replace("\\",'/',dirname(__FILE__));
//获取当前文件夹名
$filename = explode("/",$filename);
$key = count($filename)-1;
$url = $filename[$key]."_index";
$templet = Helper_Archive::getUseTemplet($url);//获取使用模板
$templet= !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/tongyong/tongyong_index.htm";	//默认模板

$pv->SetTemplet($templet);
$pv->Display();
exit();


?>
