<?php 

/**----
search.php 可接收5个参数


countryid:签证国家id
cityid:签发城市
visatypeid:签证类型id
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



$countryid = !empty($countryid) ? Helper_Archive::pregReplace($countryid,2) : 0;
$visatypeid = !empty($visatypeid) ? Helper_Archive::pregReplace($visatypeid,2) : 0;
$cityid = !empty($cityid) ? Helper_Archive::pregReplace($cityid,2) : 0;

//签证国家判断
if(!empty($countryid))
{
     $countryname = getAreaName($countryid);
  
     $where.=" and nationid='$countryid'";
	 $navtitle.=$countryname;
   
   
}
//签证类型条件
if(!empty($visatypeid))
{
   $where.=" and visatype='$visatypeid'";	
   $navtitle.=getVisaType($visatypeid);
}
//签证城市条件
if(!empty($cityid))
{
   $where.=" and cityid='$cityid'";	
   $navtitle = getVisaCity($cityid).'签发'.$navtitle;
	
}

$sql="select a.* from #@__visa a left join #@__allorderlist b on (a.id=b.aid and b.typeid={$typeid} and a.webid=b.webid) where a.ishidden=0 {$where} order by case when b.displayorder is null then 9999 end,b.displayorder asc,a.modtime desc,a.addtime desc";


$seoarr=array(); //seo信息数组
$seoarr['navtitle']=$seoarr['searchtitle']=$navtitle."列表";
$seoarr['typename'] = GetTypeName($typeid);

$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
$pv = new ListView($typeid);

$pv->pagesize=10;//分页条数.
$pv->SetSql($sql);

//seo变量赋值

  foreach($seoarr as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }
$pv->SetParameter('countryid',$countryid);
$pv->SetParameter('cityid',$cityid);
$pv->SetParameter('visatypeid',$visatypeid);
$pv->SetParameter('temppara',0);
//模板选择
$templet = Helper_Archive::getUseTemplet('visa_list');//获取使用模板
$templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."visa/visa_search.htm";	//默认模板
$pv->SetTemplet($templet);
$pv->Display();
  
exit();
   
//搜索Url
function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('countryid','cityid','visatypeid'),$url="/visa/",$table="")
{
    
	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table,0);
}

?>
