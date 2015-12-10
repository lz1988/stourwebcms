<?php
//聚合页面
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../include/destinations.class.php");
require_once(dirname(__FILE__)."/dest.func.php");
require_once SLINEINC."/view.class.php";

$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))
{
   require_once($file);	
}

//兼容以前老地址,如果使用以前老地址访问则301跳转到新的地址
if(preg_match("/^\d*$/",$destid))
{
   $py = getPinyinById($destid);
   $url = $cfg_basehost."/{$type}/{$py}/";
   head301($url);
}
if($type!='raiders')
{
    $url = $cfg_basehost."/{$type}/{$destid}/";
    head301($url);
}

$destpy = $destid;//拼音赋值
$kindid=$destid=getDestIdByPy($destpy);//获取目的地ID
if(empty($type)) exit('Error!');
$arr=array('lines'=>'1','hotels'=>'2','cars'=>'3','raiders'=>'4','spots'=>'5','photos'=>'6');

$destyp = Helper_Archive::getDestPinyin($destid);



$typedd=array("1"=>"line","2"=>"hotel","3"=>"car","4"=>"article",5=>"spot",6=>"photo");
$typeid=$arr[$type];

$pv = new View($typeid);

getTopNavDest($destid);//目的地导航信息
$row=getKindSeo($destid,$type); //获取seo信息.

$g_arr=importAutoTitle($type,$row); //导入智能标题.

if(empty($row['seotitle']))
{
   $row['seotitle']=!empty($g_arr[0]) ? $g_arr[0] : $row['kindname'] ;	
}

if(empty($row['description']))
{
  $row['seodescription']=!empty($g_arr[1]) ? "<meta name=\"description\" content=\"".$g_arr[1]."\"/>" : '';
}
else
{
  $row['seodescription']="<meta name=\"description\" content=\"".$row['description']."\"/>";
}
$row['seokeyword']=!empty($row['keywords'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
$row['typename'] = GetTypeName(12);

$pv->Fields['kindid']=$destid;//当前选中的目的地.




$hasnext=checkHasNext($destid);//检测是否有下一级.
if($hasnext)
 $GLOBALS['condition']['__hasnext']=1;

foreach($row as $k=>$v)
{
  $pv->Fields[$k] = $v;
}

//属性元素组
$attrarr = get_raider_attr($destid);
$pv->Fields['piclist'] = getPiclistArr($kindid,725,304); //目的地图片

$templet=!empty($row['templetpath']) ? "{$typedd[$typeid]}/{$row['templetpath']}/index.htm" : "gather_{$type}.htm";//针对不同分类模板.

$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."destination/" .$templet);
$pv->Display();
exit();

