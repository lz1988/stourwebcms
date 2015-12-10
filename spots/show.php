<?php 

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once(dirname(__FILE__)."/spot.func.php");
$typeid=5; //景点栏目
require_once SLINEINC."/view.class.php";
$pv = new View($typeid);
if(!isset($aid)) exit('Wrong Id');
$aid=RemoveXSS($aid);//防止跨站攻击
updateVisit($aid,$typeid);
$row = getSpotInfo($aid);

if(empty($row['id']))
{
	head404();
}

$webroot=GetWebURLByWebid($row['webid']);
//查询所属景点分类

$row['seotitle']=!empty($row['seotitle']) ? $row['seotitle'] : $row['title'];
$row['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
$row['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
$row['litpic'] = getUploadFileUrl($row['litpic']);
$row['level'] = getSpotAttr($row['attrid'],'等级');
$row['theme'] = getSpotAttr($row['attrid']);
$row['price'] = !empty($row['price']) ? "￥{$row['price']}" : '电询';
$row['commenthomeid']=$row['id'];
$row['pkname'] = get_par_value($row['kindlist'],$typeid);
$row['typename'] = GetTypeName($typeid);

foreach($row as $k=>$v)
{
  $pv->Fields[$k] = $v;
}

//支付方式
$paytypeArr=explode(',',$GLOBALS['cfg_pay_type']);
if(in_array(1,$paytypeArr))//支付宝
{
    $GLOBALS['condition']['_haszhifubao'] = 1;
}
if(in_array(2,$paytypeArr))//快钱
{
    $GLOBALS['condition']['_haskuaiqian'] = 1;
}
if(in_array(3,$paytypeArr))//汇潮
{
    $GLOBALS['condition']['_hashuicao'] = 1;
}
if(in_array(4,$paytypeArr))//银联
{
    $GLOBALS['condition']['_hasyinlian'] = 1;
}
if(in_array(5,$paytypeArr))//钱包
{
    $GLOBALS['condition']['_hasqianbao'] = 1;
}
if(in_array(7,$paytypeArr))//贝宝
{
    $GLOBALS['condition']['_hasbeibao'] = 1;
}
if(in_array(8,$paytypeArr))//微信
{
    $GLOBALS['condition']['_hasweixin'] = 1;
}


/*$prenext=getPreNext($aid);//获取上一条,下一条
foreach($prenext as $k=>$v {
	$pv->Fields[$k] = $v;
}*/
//图片获取
$picArr = getPiclistArr($row['piclist']);
$biglist = $picArr['big'];//大图
$thumblist = $picArr['thumb'];//小图
//获取上级开启了导航的目的地
getTopNavDest($row['kindlist']);
$typename=GetTypeName($typeid);//获取栏目名称.
$pv->Fields['typename'] = $typename;

$templet = getTemplet($row['id']);//获取显示模板

$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."spots/" .$templet);

$pv->Display();

exit();





?>
