<?php 
/**----
酒店搜索
search.php 参数

  参数1:$dest_id 即目的地id
  参数2:$rankid.即星级
  参数3:$priceid.即价格id
  参数4:$attrid,即属性id,用逗号分隔。
  参数5:$totalresult,总页数.
  参数6:$pageno,当前页 

*------*/
@session_start();
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/hotel.func.php");
require_once SLINEINC."/listview.class.php";
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))
{
   require_once($file);	
}
$typeid = 2;

$encode = mb_detect_encoding($keyword);

if($encode != 'UTF-8')
{
    $keyword = iconv($encode,'utf-8',$keyword);
}


if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页

//关键词搜索
if(!empty($dest_keyword))
{
	$sqldest="select id from #@__destinations where kindname like '%{$dest_keyword}%'";
	$destall=$dsql->getAll($sqldest);
	foreach($destall as $v)
	{
		$destwhere.=" find_in_set({$v['id']},a.kindlist)";
		if(empty($dest_id))
		{
			//$_REQUEST['dest_id']=$v['id'];
			$dest_id=$v['id'];
		}
	}
}


$dest_id=isset($dest_id) ? $dest_id : 0;
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

$pkname = get_par_value($dest_id,$typeid);//上一级
//获取上级开启了导航的目的地
getTopNavDest($dest_id);

$day=isset($day) ? Helper_Archive::pregReplace($day,2): 0;

$priceid=isset($priceid) ? Helper_Archive::pregReplace($priceid,2): 0;

$attrid=isset($attrid) ? Helper_Archive::pregReplace($attrid,4): 0;

$rankid = isset($rankid) ? Helper_Archive::pregReplace($rankid,2): 0;

$sorttype=isset($sorttype) ? Helper_Archive::pregReplace($sorttype,2):1;

$keyword = isset($keyword) ? Helper_Archive::pregReplace($keyword,3) : '';

if(!empty($keyword))
{
    $where="where a.ishidden='0'  and title like '%".$keyword."%'";
}
else
{
    $where=" where a.ishidden='0'" ;
    $where.= !empty($dest_id) ? "and FIND_IN_SET($dest_id,a.kindlist)" : '';
}



if(!empty($rankid) && $rankid!=0) $where.=" and a.hotelrankid=$rankid";
if(!empty($priceid)&& $priceid!=0)
{
   $pricearr=getMinMaxprice($priceid);//取得价格范围的最小与最大值 .
   $where.=" and a.price >= '{$pricearr['min']}' and a.price <= '{$pricearr['max']}' ";
}
//属性
if($attrid)
{ 
   $attrwhere = Helper_Archive::getAttrWhere($attrid);//属性条件
   $where.= $attrwhere;
  
}
  
$orderby=" order by b.displayorder asc";
if(!empty($sorttype) && $sorttype!=0)
{
	if($sorttype==1)//特价排序
	{
	   $orderby = "order by b.istejia desc";
	}
	else if($sorttype==2) //价格
	{
	    $orderby=" order by a.price asc";	
	}
	else if($sorttype==3) //销量
	{
		$orderby=" order by a.shownum desc";
	}
	else if($sorttype==4)//人气
	{
	    $orderby=" order by a.shownum desc";
	}
	else if($sorttype==5) //满意度
	{
		$orderby=" order by a.shownum desc";
	}
}

 
if(!empty($dest_id))
{
    $sql="select a.*,b.isjian ,b.isding,b.istejia from #@__hotel a left join #@__kindorderlist b on (a.id=b.aid and b.typeid={$typeid} and a.webid=b.webid and b.classid='$dest_id') {$where} {$orderby},b.displayorder asc,a.modtime desc,a.addtime desc  ";
}
else
{
    $sql="select a.*,b.isjian ,b.isding,b.istejia from #@__hotel a left join #@__allorderlist b on (a.id=b.aid and b.typeid={$typeid} and a.webid=b.webid ) {$where} {$orderby},b.displayorder asc,a.modtime desc,a.addtime desc  ";
}



$destinfo = getDestInfo($typeid,$dest_id);//目的地优化信息;
$searchtitle = getSearchTitle($destinfo,$rankid,$priceid,$attrid);
$seoarr=array(); //seo信息数组
//当前页数->title里面使用
$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
//父级与当前级信息
$seoarr['pkname'] = get_par_value($dest_id,$typeid);
$seoarr['dest_id']=$destid;



$seoarr['typename']= getTypeName($typeid);
;
$pv = new ListView($typeid);

$pv->pagesize=15;//分页条数.


$pv->SetSql($sql);

//seo变量赋值
  foreach($destinfo as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }
  foreach($seoarr as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }
//搜索标题赋值  
$pv->Fields['searchtitle'] = $searchtitle;

//下级目的地
$destlist = Helper_Archive::getChildDest($dest_id,$typeid);

//注意以下这两句与伪静态规则有关系,不能写反了.

	$pv->SetParameter('dest_id',$dest_id);
	
	$pv->SetParameter('rankid',$rankid);
  
	$pv->SetParameter('priceid',$priceid);

    $pv->SetParameter('sorttype',$sorttype);

    $pv->SetParameter('keyword',$keyword);

    $pv->SetParameter('attrid',$attrid);


//其他栏目URL
if(empty($dest_id))
{
    $dest_url=$GLOBALS['cfg_basehost'].'/destination/';
    $hotel_url=$GLOBALS['cfg_basehost'].'/hotels/';
    $raider_url=$GLOBALS['cfg_basehost'].'/raiders/';
    $photo_url=$GLOBALS['cfg_basehost'].'/photos/';
}else
{
    $pinyin=Helper_Archive::getDestPinyin($dest_id);
    $pinyin = !empty($pinyin) ? $pinyin : $dest_id;
    $dest_url=$GLOBALS['cfg_basehost'].'/'.$pinyin.'/';
    $hotel_url=$GLOBALS['cfg_basehost'].'/hotels/'.$pinyin.'/';
    $raider_url=$GLOBALS['cfg_basehost'].'/raiders/'.$pinyin.'/';
    $photo_url=$GLOBALS['cfg_basehost'].'/photos/'.$pinyin.'/';

}
//模板选择
$templet = Helper_Archive::getUseTemplet('hotel_list');//获取使用模板
$templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/hotels/hotel_search.htm";	//默认模板
$pv->SetTemplet($templet);
$pv->Display();
exit();
/**
     *  获得档目名称
     *
     * @access    private
     * @return    arr
     */

function getDestInfo($typeid,$childid=0)
{ 
   
  global $dsql,$cfg_hotel_title,$cfg_hotel_desc;
  
  $arr=array();
 
   $sql="select a.kindname,b.seotitle,a.pinyin,b.jieshao,b.keyword,b.tagword,b.description from #@__destinations as a inner join #@__hotel_kindlist as b on a.id=b.kindid where a.id={$childid} ";

  $row=$dsql->GetOne($sql);
  
   $cfg_hotel_title=str_replace('XXX',$row['kindname'],$cfg_hotel_title);
   $cfg_hotel_desc=str_replace('XXX',$row['kindname'],$cfg_hotel_desc);
   if(empty($row['seotitle']))
   {
	   $arr['seotitle']=empty($cfg_hotel_title) ? $row['kindname'] : $cfg_hotel_title;
   }
   else
   {
       $arr['seotitle']=$row['seotitle'];   
   }
    if(empty($row['description']))
   {
	    
	   $arr['description']=empty($cfg_hotel_desc) ? $row['description'] : $cfg_hotel_desc;
   }
   else
	{
       $arr['description']=$row['description'];
    }

  $arr['keyword'] = $row['keyword'];
  $arr['typename']=$row['kindname'];
  $arr['dest_jieshao']=$row['jieshao'];
  $arr['dest_name'] = $row['kindname'];
  $arr['kindid'] = $childid;
  $arr['dest_id'] = $childid;
  $arr['dest_pinyin'] = $row['pinyin'];
  $arr['tagword']=$row['tagword'];
  $arr['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$arr['keyword']."\"/>":"";
  $arr['seodescription']=!empty($arr['description'])?"<meta name=\"description\" content=\"".$arr['description']."\"/>":"";
  $arr['pinyin'] = $row['pinyin'];
  return $arr;
}


   


/**
 *  生成searchtitle,keyword,description等信息.
 *
 * @access    private
 * @return    array
 */
function getSearchTitle($info,$rankid,$priceid,$attrid)
{
   	global $searchkey,$dest_id;
	$arr=array();
	$rankname = getRank($rankid);
	
	$searchtitle="{$info['seotitle']}|";
	
   	if($priceid!=0)
   	{
     	$pricearr=getMinMaxprice($priceid);
	 
		if($pricearr['min']!=""&&$pricearr['max']=="")
		{
			$price.="价格在{$pricearr['min']}以上";
		}
		else
		{
	     	$price.="价格范围在{$pricearr['min']}-{$pricearr['max']}之间";
	    }
		$searchtitle.=$price;
   	}
   	if($rankname!="")
   	{
	    $searchtitle.="{$rankname}|"; 
   	}
	if(!empty($attrid))
	{
	   $searchtitle.= getHotelAttrName($attrid) ; 	
	}
  
   
    //$arr['searchtitle']=$searchtitle;
   
   // if(!empty($searchkey)) //如果针对的是名称搜索
	//{
		//$arr['searchtitle']="{$searchkey}酒店列表";
   	   // $arr['subtitle']="{$searchkey}酒店列表";
	//}

   //	return $arr;
   return $searchtitle;
}
//获取满意度
function getSatisfyScore($id)
{
	$rand = mt_rand(3,5);
	$score = Helper_Archive::getSatisfyScore($id,2);
	return $score;
}
//获取attrname
function getHotelAttrName($attrid)
{
	global $dsql;
	$arr = explode(',',$attrid);
	foreach($arr as $id)
	{
	  $sql = "select attrname from #@__hotel_attr where id='$id'";
	  $row = $dsql->GetOne($sql);
	  $namelist.=$row['attrname'].'|'; 	
	}
	
	return $namelist;
}

//取得酒店的挂牌价格
function getHotelSellPrice($hotelid)
{
	global $dsql;
 	$sql="select min(price) as minprice,sellprice from #@__hotel_room where hotelid='{$hotelid}'";
	$row=$dsql->GetOne($sql);
	return intval($row['sellprice']);
}
//取得酒店的地址，按kindlist最大数值来取
function getHotelKindCity($kindlist)
{
	global $dsql;
	if(empty($kindlist))
		return '';
 	$sql="select kindname from #@__destinations where id in ({$kindlist}) order by id desc";
	$row=$dsql->GetOne($sql);
	return $row['kindname'];
}

//搜索Url
function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('rankid','priceid','sorttype','title','attrid'),$url="/hotels/",$table="#@__hotel_attr")
{

	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}
?>