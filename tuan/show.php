<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/tuan.func.php");
$typeid=13; //团购栏目`

require_once SLINEINC."/view.class.php";


$pv = new View($typeid);
if(!isset($aid)) exit('Wrong Id');

$aid=RemoveXSS($aid);//防止跨站攻击

updateVisit($aid,$typeid);//更新访问次数


$row = getTuanInfo($aid);//基本信息

//如果不存在则跳转至404页面
if(empty($row['id']))
{
	head404();
}
$time = time();


if($time<$row['starttime'] || $time>$row['endtime'])
{
    ShowMsg("当前团购不能进行预订!",-1,1);
    exit;
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

if(is_array($row))
{
   $row['enddatetime']=date('Y/m/d H:i:s',$row['endtime']); //截止时间
   $row['discount']=floor($row['price']/$row['sellprice']*100)/10; //折扣
   $row['piclist']=getImgList($row['piclist']); //获取轮播图片
   $row['seokeyword']=empty($row['keyword'])?'':"<meta name=\"keywords\" content=\"{$row['keyword']}\"/>";
   $row['seodescription']=empty($row['description'])?'':"<meta name=\"description\" content=\"{$row['description']}\"/>";
   $row['seotitle'] = empty($row['seotitle']) ? $row['title'] : $row['seotitle'];
   $row['booknum']=Helper_Archive::getSellNum($row['id'],13)+$row['virtualnum'];
   $row['typename'] = GetTypeName($typeid);
   $row['satisfyscore']=  empty($row['satisfyscore'])?$row['satisfyscore']:$row['satisfyscore'].'%';
   		
   foreach($row as $k=>$v)
   {
	  $pv->Fields[$k] = $v;//模板变量赋值
   }
	
}

$templets = $row['templet'];

if(strpos($templets,'uploadtemplets')!==false)
{
    $templet = SLINETEMPLATE.'/smore/'.$templets.'/index.htm';//使用自定义模板
}
else
{
    $templet = SLINETEMPLATE ."/".$cfg_df_style ."/" ."tuan/tuan_show.htm";//系统标准模板
}
$pv->SetTemplet($templet);

$pv->Display();

exit();




?>
