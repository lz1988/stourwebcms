<?php 
@session_start();
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/article.func.php");
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))
{
   require_once($file);	
}
$typeid=4; //攻略栏目
foreach($_GET as $key=>$value)
{
    $_GET[$key]=RemoveXSS($value);
}
foreach($_POST as $key=>$value)
{
    $_POST[$key]=RemoveXSS($value);
}
require_once SLINEINC."/listview.class.php";

if(isset($totalresult)) $totalresult = intval(preg_replace("/[^\d]/", '', $totalresult));//总记录数

if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页
//这里增加子站判断
if($GLOBALS['sys_child_webid']!=0&&empty($dest_id))$dest_id=$GLOBALS['sys_child_webid'];

if(!is_numeric($dest_id)&&!empty($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
   {
       $d_id = Helper_Archive::getDestIdByPinYin($dest_id);
       $dest_id = !empty($d_id) ? $d_id : $dest_id;
	   if($dest_id=='all')
	   {
		   $dest_id=0;
	   }
   }

$where=" where a.id!=0";
if(!empty($dest_id))
{
	$where.=" and FIND_IN_SET($dest_id,a.kindlist)";
}
if(!empty($attrid))
{
	$attrid_arr=explode('_',$attrid);
	foreach($attrid_arr as $k=>$v)
	{
	  $where.=!empty($v)?" and FIND_IN_SET($v,a.attrid)":'';
	}
	//$where.=" and FIND_IN_SET($attrid,a.attrid)";
}
if(!empty($dest_id) && !empty($attrid))
{
    $left_table = '#@__attrorderlist b';
    $sql = "select a.* from #@__article a left join {$left_table} on (b.classid='$attrid' and a.id=b.aid  and b.typeid=4) {$where} order by b.isding desc,b.displayorder asc,a.modtime desc,a.addtime desc";
}
else
{
    $left_table = '#@__kindorderlist b';
    $sql = "select a.* from #@__article a left join {$left_table} on (b.classid='$dest_id' and a.id=b.aid  and b.typeid=4 ) {$where} order by b.isding desc,b.displayorder asc,a.modtime desc,a.addtime desc";
}


//SEO信息
$dest_id=empty($dest_id)?0:$dest_id;

$seoarr=array(); //seo信息数组


$attr_str=str_replace('_',',',$attrid);
$attrname=getAttName($attr_str);//属性


$arr=getArticleSeoInfo($typeid,$dest_id);

$seoarr=generateInfo($arr);//生成seo信息
$tagwords=GetTagsLink($arr['tagwords']);
$seoarr['typename']=GetTypeName($typeid);
$seoarr['pkname'] = get_par_value($dest_id,$typeid);



//获取上级开启了导航的目的地
getTopNavDest($dest_id);

//当前页数->title里面使用

$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
$pv = new ListView($typeid);

$dest_pinyin=getArticleDestPinyin($dest_id);
$dest_url=empty($dest_pinyin)?'/destination/':'/'.$dest_pinyin.'/';

//目的地列表
$destlist=getArticleChildDest($dest_id);
//目的地面包
$mianbao=getArticleMianbaoHtml($dest_id);

$destname=Helper_Archive::getDestName($dest_id);

$pv->Fields['destjieshao']=getArticleDestJieshao($dest_id);
$pv->Fields['kindid']=$dest_id;
$pv->Fields['tagwords'] =$tagwords;
$pv->pagesize=15;//分页条数.

$pv->SetSql($sql);

//seo变量赋值

  foreach($seoarr as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }

  
//注意以下这两句与伪静态规则有关系,不能写反了.
  $pv->SetParameter('dest_id',$dest_id);
  
  $pv->SetParameter('attrid',$attrid);
//模板选择
  $templet = Helper_Archive::getUseTemplet('article_list');//获取使用模板
  $templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."raiders/" ."article_search.htm";	//默认模板
  $pv->SetTemplet($templet);
  $pv->Display();
   


?>
