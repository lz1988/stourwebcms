<?php 

/**----
search.php 参数

  参数1:$dest_id 即目的地id
  参数2:$day,即对应天数.
  参数3:$priceid.即价格id
  参数4:$attrid,即属性id,用逗号分隔。
  参数5:$totalresult,总页数.
  参数6:$pageno,当前页
 *参数7:$startcity ,出发城市

*------*/

@session_start();
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../include/destinations.class.php");
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))
{
   require_once($file);	
}
$typeid=1; //线路栏目

require_once SLINEINC."/listview.class.php";

if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页

//这里增加子站判断
if($GLOBALS['sys_child_webid']!=0&&empty($dest_id))$dest_id=$GLOBALS['sys_child_webid'];

   if(!is_numeric($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
   {
       $dest_id = Helper_Archive::pregReplace($dest_id,8);//只能字母.数字
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

//存储前一个用户选择导航.
$dest_id=isset($dest_id) ? $dest_id : 0;
$pkname = get_par_value($dest_id,$typeid);//上一级
//获取上级开启了导航的目的地
getTopNavDest($dest_id);

$day=isset($day) ? $day: 0;

$priceid=isset($priceid) ? RemoveXSS($priceid): 0;

$attrid=isset($attrid) ? ($attrid): 0;

$sorttype=isset($sorttype) ? RemoveXSS($sorttype):6;

$keyword = isset($keyword) ? RemoveXSS($keyword) : 0 ;

$cityid = $startcity = isset($startcity) ? RemoveXSS($startcity) : 0;

//替换操作
$GLOBALS['dest_id'] = Helper_Archive::pregReplace($dest_id,2);
$GLOBALS['day'] =  Helper_Archive::pregReplace($day,2);
$GLOBALS['priceid'] =  Helper_Archive::pregReplace($priceid,2);
$GLOBALS['sorttype'] =  Helper_Archive::pregReplace($sorttype,2);
$GLOBALS['keyword'] =  Helper_Archive::pregReplace($keyword,3);
$GLOBALS['attrid'] =  Helper_Archive::pregReplace($attrid,4);

$GLOBALS['startcity']=$GLOBALS['cityid'] =  Helper_Archive::pregReplace($startcity,2);



$where="where a.ishidden=0 ";
$wherecount=" where  a.ishidden=0";



if(!empty($dest_keyword))
{
	$keyword=$dest_keyword;
}
//关键词搜索
if(!empty($keyword))
{
    $encode = mb_detect_encoding($keyword);
    if($encode != 'UTF-8')
    {
        $keyword = iconv($encode,'utf-8',$keyword);
    }
    $sqldest="select id from #@__destinations where kindname like '%{$keyword}%'";
	$destall=$dsql->getAll($sqldest);
	foreach($destall as $v)
	{
		$destwhere.=" or find_in_set({$v['id']},a.kindlist)";
		if(empty($dest_id))
		{
			//$_REQUEST['dest_id']=$v['id'];
			$dest_id=$v['id'];
			$key_dest=1;
		}
	}
	
	$namewhere="a.title like '%{$keyword}%'";
	$where.=" and ($namewhere $destwhere)";
	$whrecount.=" and ($namewhere $destwhere)";
}

$destkind = new destination($dest_id);
if(!empty($dest_id)&& $dest_id!=0)
{ 
  if(empty($key_dest))
  { 
  $where.=" and FIND_IN_SET($dest_id,a.kindlist)";
  $wherecount.="  and FIND_IN_SET($dest_id,a.kindlist)";
  $orderby=" order by b.isding desc,case when b.displayorder is null then 9999 end,b.displayorder asc ";
  }
  else
  $orderby=" order by b.isding desc,case when b.displayorder is null then 9999 end,b.displayorder asc ";
 }
 else
 {
	$orderby="order by a.isding desc,a.displayorder asc ";
 }

 //获取最大天数
  $daySql="select max(word) as days from #@__line_day where webid=0";
  $row = $dsql->GetOne($daySql);
  $days= $row['days'];

//天数
if(!empty($day) && $day!=0)
{ 
    if($days==$day)//大于等于最大天数的线路
	{
	    $where.=" and a.lineday>=$day ";
        $wherecount.=" and a.lineday>=$day ";
	}
	else
	{
		$where.=" and a.lineday=$day ";
        $wherecount.=" and a.lineday=$day ";
	}
    
}


//价格范围
if(!empty($priceid)&& $priceid!=0)
{
   $pricearr=getMinMaxprice($priceid);//取得价格范围的最小与最大值 .
   
   $where.=" and a.price >= {$pricearr['min']} and a.price <= {$pricearr['max']} ";
   $wherecount.=" and a.price >= {$pricearr['min']} and a.price <= {$pricearr['max']} ";
}

//出发城市
if(!empty($startcity) && $startcity!=0)
{
    $where.=" and a.startcity = '$startcity' ";
    $wherecount.=" and a.startcity = '$startcity' ";
}

//属性
if($attrid)
{ 
   $attrwhere = Helper_Archive::getAttrWhere($attrid);//属性条件
   $where.= $attrwhere;
  
   $wherecount.= $attrwhere;
}

  $fields="a.id,a.iconlist,a.aid,a.webid,a.title as title,a.piclist,a.seotitle,a.sellpoint,a.litpic as litpic,a.storeprice,a.price,a.linedate,a.transport,a.lineday,a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount,a.features,a.paytype,a.attrid,a.storeprice";

$orderby="order by a.modtime desc";
if(!empty($sorttype) && $sorttype!=0)
{
	if($sorttype==1)//特价排序
	{
	
	   $orderby = "order by b.istejia desc";
	}
	else if($sorttype==1) //推荐排序
	{
	
	   $orderby = "order by b.isjian desc";	
		
    }
	else if($sorttype==2) //价格
	{
	    $orderby=" order by a.price asc";	
	}

	else if($sorttype==3) //销量
	{
		$orderby=" order by a.bookcount desc";
	}
	else if($sorttype==4)//人气
	{
	    $orderby=" order by a.shownum desc";
	}
	
	
	else if($sorttype==5) //满意度
	{
		$orderby=" order by a.satisfyscore desc";
	}
    else if($sorttype==6) //按目的地设置的排序
    {
       $orderby=" order by case when b.displayorder is null then 9999 end,b.displayorder asc";
    }


}


//查询sql
if(!empty($dest_id))
{
    $sql="select {$fields},a.litpic as litpic,b.isjian,b.isding,b.istejia from #@__line as a left join #@__kindorderlist b on(a.id=b.aid and b.typeid=1 and b.classid=$dest_id ) {$where}{$orderby},modtime desc,addtime desc ";
}
else
{
    $sql="select {$fields},a.litpic as litpic,b.isjian,b.isding,b.istejia from #@__line as a left join #@__allorderlist b on(a.id=b.aid and b.typeid=1 ) {$where}{$orderby},modtime desc,addtime desc ";
}



$seoarr=array(); //seo信息数组

$temparr = getLineCount($wherecount);
$destinfo = getDestInfo($typeid,$dest_id);//目的地优化信息;
$searchtitle = getSearchTitle($destinfo,$day,$priceid,$attrid,$cityid);

$newnavtitle = getNewNavTitle($day,$attrid,$destinfo['dest_name'],$cityid);

$seoarr['totalline']=$temparr[0];
$seoarr['totalvisit']=$temparr[1];//总访问次数
//当前页数->title里面使用
$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
//父级与当前级信息
//$seoarr['pkname'] = getCurkind($dest_id);
$seoarr['pkname'] = get_par_value($dest_id,$typeid);
$seoarr['dest_id']=$destid;
$seoarr['channelname']= getTypeName($typeid);
//是否存在下级目的地
//$GLOBALS['condition']['_hasnext'] = Helper_Archive::checkDestHasChild($dest_id);

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
  foreach($seoarr as $k=>$v)
   {
      $pv->Fields[$k] = $v;
   }
$pv->Fields['startcity'] = $startcity;

$pv->Fields['searchname']=empty($pv->Fields['dest_name'])?$keyword:$pv->Fields['dest_name'];
$pv->Fields['searchname']=empty($pv->Fields['searchname'])?'全部':$pv->Fields['searchname'];
//搜索标题赋值

$pv->Fields['searchtitle'] = $searchtitle;
$pv->Fields['nav_title'] = $newnavtitle;


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




//设置翻页参数(如果使用伪静态,则不能弄反了)

  $pv->SetParameter('dest_id',$dest_id);

  $pv->SetParameter('param1',0);

  $pv->SetParameter('param2',0);

  $pv->SetParameter('day',$day);
  
  $pv->SetParameter('priceid',$priceid);

  $pv->SetParameter('sorttype',$sorttype);

  $pv->SetParameter('keyword',$keyword);

  $pv->SetParameter('startcity',$startcity);

  $pv->SetParameter('attrid',$attrid);

  $templet = Helper_Archive::getUseTemplet('line_list');//获取使用模板

  $templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/lines/line_search.htm";	//默认模板

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
  global $dsql,$webid,$cfg_line_title,$cfg_line_desc;
  $arr=array();
  if($childid) 
  {
	
	  $sql="select a.kindname,b.seotitle,b.jieshao,b.keyword,b.tagword,b.description,a.pinyin from #@__destinations as a inner join #@__line_kindlist as b on a.id=b.kindid where a.id={$childid} ";
  }
  $row=$dsql->GetOne($sql);
  
   $cfg_line_title=str_replace('XXX',$row['kindname'],$cfg_line_title);
   $cfg_line_desc=str_replace('XXX',$row['kindname'],$cfg_line_desc);
   if(empty($row['seotitle']))
   {
	    
	   $arr['seotitle']=empty($cfg_line_title) ? $row['kindname'] : $cfg_line_title;
   }
   else
	{
       $arr['seotitle']=$row['seotitle'];
        
   }
    if(empty($row['description']))
   {
	   $arr['description']=empty($cfg_line_desc) ? $row['description'] : $cfg_line_desc;
   }
   else
	{
       $arr['description']=$row['description'];
    }
   
 
  $arr['typename']=$row['kindname'];
  $arr['dest_jieshao']=$row['jieshao'];
  $arr['dest_name'] = $row['kindname'];
  $arr['kindid'] = $childid;
  $arr['dest_id'] = $childid;
  $arr['dest_pinyin'] = $row['pinyin'];
  $arr['tagword']=$row['tagword'];
  $arr['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
  $arr['seodescription']=!empty($arr['description'])?"<meta name=\"description\" content=\"".$arr['description']."\"/>":"";
  $arr['pinyin'] = $row['pinyin'];
  return $arr;
}


/**
     *  生成搜索标题
     *
     * @access    private
     * @return    array
     */
function getSearchTitle($info,$day,$priceid,$attrid,$startcity)
{
   global $cfg_line_title,$cfg_line_desc;
   
   $daylist=$day ? $day."日" : '';
   
   
   if($priceid!=0)
   {
     $pricearr=getMinMaxprice($priceid);
	
	 $price.="{$pricearr['min']}-{$pricearr['max']}";
	
   }
   else
   {
       $price='';
   }
   
 
 

   
 
/*情况一:线路+天数+费用*/
	if($day!="0"&&$priceid!="0")
	{
	   $searchtitle="{$info['seotitle']}" . getLineAttrName($attrid) . "{$day}日游线路_价格范围{$price}元以内";
	 
	   $navtitle="{$info['typename']}" . getLineAttrName($attrid) . "{$day}日游线路报价范围{$price}元以内"; //导航列表上面的导航标题
	}
/*情况二:线路*/
    if($day=="0"&&$priceid=="0"&&$attrid=="0")
	{
		$searchtitle="{$info['seotitle']}";
	   
	   	$navtitle="{$info['typename']}";
	}
/*情况三:天数*/
	if($day!="0"&&$priceid=="0")
	{
	   $searchtitle="{$info['seotitle']}" . getLineAttrName($attrid) . "{$day}日游线路";
	   
	   $navtitle="{$info['typename']}" . getLineAttrName($attrid) . "{$day}日游线路";
	}
	if($day=="0"&&$priceid=="0"&&$attrid!="0")
	{
	   	$searchtitle="{$info['seotitle']}" . getLineAttrName($attrid) . "线路";
	   	
	    $navtitle="{$info['typename']}" . getLineAttrName($attrid) . "线路";
	}
/*情况四:费用*/
	if($day=="0"&&$priceid!="0")
	{
	   $searchtitle="{$info['seotitle']}" . getLineAttrName($attrid) . "{$price}元以内线路";
	 
	   $navtitle="{$info['typenanme']}" . getLineAttrName($attrid) . "{$price}元以内线路";
	}

    /*出发城市*/

    if($startcity!='0')
    {
       $cityname = getStartCityName($startcity);


        $searchtitle ='['.$cityname.'出发]'.$searchtitle;

    }


  
   return $searchtitle;

}
/**
     *  获得线路条数和访问次数
     *
     * @access    private
     * @return    arr
     */
function getLineCount($where)
{
  global $dsql,$sys_webid,$dest_id,$typeid;
  $arr=array();
   $where=!empty($where) ? " {$where} " : '';
 
   $sql="select count(a.id) as num,SUM(a.shownum) as showcount from #@__line as a  left join #@__kindorderlist b on (a.id=b.aid and b.typeid='{$typeid}' and b.classid='{$dest_id}')  {$where}";  
 
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  {
   $arr[]=isset($row['num']) ? $row['num'] : 0;
   $arr[]=isset($row['showcount'])?$row['showcount'] : 0;
  }
  return $arr;
}

/**
     *  获得价格范围的最小.最大值
     *
     * @access    private
     * @return    arr
     */
function getMinMaxprice($priceid)
{
  global $dsql;
  $arr=array();
   $arr['min']='';
   $arr['max']='';
  $sql="select lowerprice as min,highprice as max from #@__line_pricelist where id=$priceid";
  $row=$dsql->GetOne($sql);

  if(is_array($row))
  {
     $arr['min']=!empty($row['min'])?$row['min']:0;
	 $arr['max']=!empty($row['max'])?$row['max']:99999;
  }
 
  return $arr;
}

//获取联合查询线路数量
function getLinesNum($childid,$attrid,$priceid,$day)
{
	global $dsql;
	$where = " where 1 and ishidden='0'";
	if($childid != 0)
	{
		$where .= " and FIND_IN_SET('$childid',kindlist)";
	}
	if($attrid != 0)
	{
		$where .= " and FIND_IN_SET('$attrid',attrid)";
	}
	if($day != 0)
	{
		$where .= " and lineday='$day'";
	}
	if($priceid != 0)
	{
		$parr = getMinMaxprice($priceid);
		$where .= " and price > '$parr[min]' and price < '$parr[max]'";
	}
	$sql = "select count(*) as dd from #@__line " . $where;
	$row = $dsql->GetOne($sql);
	return $row['dd'];
}

//获取新的navttile

function getNewNavTitle($day,$attrid,$destname,$cityid)
{
    //目的地
    $out = !empty($destname) ? $destname : '';
   //属性
    $arr = getLineAttrArr($attrid,'_');
    foreach($arr as $v)
    {
        $out.=".".$v;
    }
   //天数
    $out.=!empty($day) ? '.'.$day.'日游' : '';
    $out.='线路';
   //出发城市
   if($cityid)
   {
       $cityname = getStartCityName($cityid);
       $out = $cityname.'出发'.'.'.$out;
   }

    return $out;
}

//获取attrname
function getLineAttrName($attrid)
{
	global $dsql;
	$arr = explode(',',$attrid);
	foreach($arr as $id)
	{
	  $sql = "select attrname from #@__line_attr where id='$id'";
	  $row = $dsql->GetOne($sql);
	  $namelist.=$row['attrname'].'|'; 	
	}
	
	return $namelist;
}

//获取属性名2
//获取attrname
function getLineAttrName2($attrid)
{
    $arr = getLineAttrArr($attrid);
    foreach($arr as $v)
    {
        $out.="<span>{$v}</span>";
    }
    return $out;

}

function getLineAttrArr($attrid,$esplit=',')
{
    global $dsql;
    $arr = explode($esplit,$attrid);
    $out = array();
    foreach($arr as $id)
    {
        $sql = "select attrname from #@__line_attr where id='$id' and pid!=0";
        $row = $dsql->GetOne($sql);
        if(!empty($row['attrname']))
            array_push($out,$row['attrname']);

    }

    return $out;
}



//获取线路图标
function getLineIco($row)
{
	
	if($row['isjian'])$out.="<img src=\"{$GLOBALS['cfg_templets_skin']}/images/hot_pic.gif\" />";
	if($row['isding'])$out.="<img src=\"{$GLOBALS['cfg_templets_skin']}/images/top_pic.gif\" />";
	if($row['istejia'])$out.="<img src=\"{$GLOBALS['cfg_templets_skin']}/images/te_pic.gif\" />";
	return $out;
	
}
//获取满意度
function getSatisfyScore()
{
	$rand = mt_rand(3,5);
	return $rand;
}


//搜索Url
function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('para1','para2','day','priceid','sorttype','keyword','attrid','startcity'),$url="/lines/",$table="#@__line_attr")
{
    
	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}

//获取出团日期
function getStartDataStr($row)
{
  require_once(dirname(__FILE__)."/line.func.php");
  $arr = getLineStartDate($row);
  return  trim($arr['monthstr'],',');	
	
}


?>
