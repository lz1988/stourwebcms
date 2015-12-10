<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once(dirname(__FILE__)."/car.func.php");
Helper_Archive::loadModule('common');
$typeid=3; //租车栏目
$webid=0;
require_once SLINEINC."/view.class.php";
$pv = new View($typeid);
if(!isset($aid,$webid)) exit('Wrong Id');
$aid=RemoveXSS($aid);//防止跨站攻击
$carid=$aid;

updateVisit($aid,$typeid);//更新访问量

$row = getCarInfo($aid);

if(empty($row['id']))
{
	head404();

}
$row['price'] = getCarNewRealPrice($aid,$row['webid']);//当月报价;
$prenext=GetPreNext($aid,$getmonth);//获取上一条,下一条
foreach($prenext as $k=>$v)
{
  $pv->Fields[$k] = $v;
}

//声明各个模型
$_startModule=new CommonModule('sline_startplace');
$_suitModule=new CommonModule('sline_car_suit');

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
			  
  //$row['litpic']=!empty($row['litpic']) ? $row['litpic'] : getDefaultImage();
  $row['title']=!empty($row['seotitle'])?$row['seotitle']:$row['title'];
  $row['subname']=$row['title'];
  $row['startcity']=$_startModule->getField('cityname',"id='{$row['startplaceid']}'");
  $row['carkind'] = getCarKind($row['carkindid']);
  $row['brandid'] = getCarBrand($row['carbrandid']);
  $row['taglook']=GetTagsLink($row['tagword']);
  $row['attrname']=getCarAttrName($row['attrid'],'租车类型');
  $row['tanknum']=getCarAttrName($row['attrid'],'厢型');
  $row['description']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
  $row['keyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";

  $taocan=$_suitModule->getAll("carid={$row['id']}");
  
  $pic_arr=getCarPicList($row['piclist'],$row['title'],$row['litpic']);
  //print_r($pic_arr);
  $row['litpic']=getUploadFileUrl($row['litpic']);
  $row['thumbpic']=$pic_arr['thumbpic'];
  $row['bigpic']=$pic_arr['bigpic'];
  $row['commenthomeid']=$row['id'];
  $row['carseries']=getSeries($row['id'],'03');//编号
  
  foreach($row as $k=>$v)
  {
    $pv->Fields[$k] = $v;
  }
			
}
$pv->Fields['seotitle']=!empty($row['seotitle']) ? $row['seotitle'] : $row['title'];
$pv->Fields['arealist']=getAreaList($aid);
$pv->Fields['typename'] = GetTypeName($typeid);//获取栏目名称.
$templets = $row['templet'];
if(strpos($templets,'uploadtemplets')!==false)
{
    $templet = SLINETEMPLATE.'/smore/'.$templets.'/index.htm';//使用自定义模板
}
else
{
    $templet = SLINETEMPLATE ."/".$cfg_df_style ."/" ."cars/" ."car_show.htm";//系统标准模板
}
$pv->SetTemplet($templet);
$pv->Display();
exit();
 
 

?>
