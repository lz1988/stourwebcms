<?php 

/**----
countrypy:签证国家拼音
cityid:签发城市
totalresult,总页数.
pageno,当前页

*------*/
@session_start();
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once(dirname(__FILE__)."/visa.func.php");
$typeid=8; //签证栏目
require_once SLINEINC."/listview.class.php";

if(isset($totalresult)) $totalresult = intval(preg_replace("/[^\d]/", '', $totalresult));//总记录数

if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页

$countrypy = !empty($countrypy) ? RemoveXSS($countrypy) : 0;

$cityid = !empty($cityid) ? RemoveXSS($cityid) : 0;

$countryinfo = getNationInfo($countrypy);


$where.=" and nationid='{$countryinfo['id']}'";

//签证城市条件
if(!empty($cityid))
{
   $where.=" and cityid='$cityid'";
}

$sql="select a.* from #@__visa a left join #@__allorderlist b on (a.id=b.aid and b.typeid={$typeid} and a.webid=b.webid) where a.ishidden=0 {$where} order by case when b.displayorder is null then 9999 end,b.displayorder asc,a.modtime desc,a.addtime desc";




$seoarr=array(); //seo信息数组
$seoarr['typename'] = GetTypeName($typeid);
$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
$seoarr['seotitle'] = $countryinfo['seotitle'] ? $countryinfo['seotitle'] : $countryinfo['kindname'];
$seoarr['seodescription']=!empty($countryinfo['description'])?"<meta name=\"description\" content=\"".$countryinfo['description']."\"/>":"";
$seoarr['seokeyword']=!empty($countryinfo['keyword'])?"<meta name=\"keywords\" content=\"".$countryinfo['keyword']."\"/>":"";
$seoarr['jieshao'] = $countryinfo['jieshao'];
$seoarr['litpic_guoqi'] = $countryinfo['countrypic'] ? $countryinfo['countrypic'] : getDefaultImage();
$seoarr['bigpic'] = $countryinfo['bigpic'] ? $countryinfo['bigpic'] : '/templets/smore/images/guojia_bg.jpg';
$seoarr['countryname'] = $countryinfo['kindname'];
$pv = new ListView($typeid);

$pv->pagesize=8;//分页条数.
$pv->SetSql($sql);

//seo变量赋值

  foreach($seoarr as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }

$pv->SetParameter('countrypy',$countrypy);
$pv->SetParameter('cityid',$cityid);

//模板选择
$templet = Helper_Archive::getUseTemplet('visa_list');//获取使用模板
$templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."visa/list.htm";	//默认模板
$pv->SetTemplet($templet);
$pv->Display();
exit();
   


?>
