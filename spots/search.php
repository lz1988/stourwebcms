<?php 

/**----
search.php 可接收4个参数

  参数1:$dest_id 即对应目的地id
  参数2:$priceid,价格id.
  参数3:$sorttype,排序
  参数4:$attrid,属性id
  参数5:$pageno,当前页



*------*/
@session_start();
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
require_once(dirname(__FILE__)."/spot.func.php");
$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
if(file_exists($file))
{
   require_once($file);	
}
foreach($_GET as $key=>$value)
{
    $_GET[$key]=RemoveXSS($value);
}
foreach($_POST as $key=>$value)
{
    $_POST[$key]=RemoveXSS($value);
}
$typeid=5; //景点栏目
require_once SLINEINC."/listview.class.php";


if(isset($pageno)) $pageno = intval(preg_replace("/[^\d]/", '', $pageno));//当前页

///没有设置,则默认为全部


$dest_id = RemoveXSS($dest_id);//防止跨站攻击
$attrid = $attrid ? $attrid : 0;//防止跨站攻击
$priceid = $priceid ? $priceid : 0 ;
$sorttype = $sorttype ? $sorttype : 0;
//这里增加子站判断
if($GLOBALS['sys_child_webid']!=0&&empty($dest_id))$dest_id=$GLOBALS['sys_child_webid'];

if(!is_numeric($dest_id)) //如果dest_id不是数字,则用户使用拼音访问需要获取相应的目的地id,否则,则直接赋值
{
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
//关键词搜索
$where=" where a.id is not null";

if(!empty($spotname))
  $keyword=$spotname;

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
	
}
//目的地条件
    if($dest_id&&empty($key_dest))
	{
	   $where .=" and FIND_IN_SET($dest_id,a.kindlist)";	
	}
//价格条件
    if(!empty($priceid)&& $priceid!=0)
	{
	   $pricearr=getSpotMinMaxprice($priceid);//取得价格范围的最小与最大值 .
	   $where.=" and a.price >= {$pricearr['min']} and a.price <= {$pricearr['max']} ";
	}

//属性条件
	if($attrid)
	{ 
	   if(is_array($attrid))
	     $attrid=implode(',',$attrid);
	   $attrwhere = Helper_Archive::getAttrWhere($attrid);//属性条件
	   $where.= $attrwhere;
	  
	}

//排序条件
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

   $sql="select a.*,b.isjian ,b.isding,b.istejia from #@__spot a left join #@__kindorderlist b on (a.id=b.aid and b.typeid={$typeid} and a.webid=b.webid and b.classid='$dest_id') {$where} and a.ishidden=0 order by b.displayorder asc,a.modtime desc,a.addtime desc  ";
   
    
    $destinfo = getDestInfo($typeid,$dest_id);//目的地优化信息;
	
	$searchtitle = getSearchTitle($destinfo,$priceid,$attrid);
	$seoarr=array(); //seo信息数组
	//当前页数->title里面使用
	$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
	//父级与当前级信息
	$seoarr['pkname'] = getCurkind($dest_id);
	$seoarr['dest_id']=$destid;
	$seoarr['searchtitle'] = $searchtitle;
    $seoarr['typename'] = GetTypeName($typeid);
	//是否存在下级目的地
	//$GLOBALS['condition']['_hasnext'] = Helper_Archive::checkDestHasChild($dest_id);
    //下级目的地
    $destlist = Helper_Archive::getChildDest($dest_id,$typeid);


//针对名称搜索
   if(isset($dopost)&&$dopost=='searchname')
   {
	    $where="where a.title like '%$searchkey%'";
		$wherecount="where a.title like '%$searchkey%'";
	    $sql="select a.* from #@__spot a $where order by a.isding desc,a.displayorder asc";
		$seoarr['searchkey']=$searchkey;
	   
   }



        //其他栏目URL
        if(empty($dest_id))
        {
            $dest_url=$GLOBALS['cfg_basehost'].'/destination/';
            $hotel_url=$GLOBALS['cfg_basehost'].'/hotels/';
            $raider_url=$GLOBALS['cfg_basehost'].'/raiders/';
            $photo_url=$GLOBALS['cfg_basehost'].'/photos/';
        }
        else
        {
            $pinyin=Helper_Archive::getDestPinyin($dest_id);
            $pinyin = !empty($pinyin) ? $pinyin : $dest_id;
            $dest_url=$GLOBALS['cfg_basehost'].'/'.$pinyin.'/';
            $hotel_url=$GLOBALS['cfg_basehost'].'/hotels/'.$pinyin.'/';
            $raider_url=$GLOBALS['cfg_basehost'].'/raiders/'.$pinyin.'/';
            $photo_url=$GLOBALS['cfg_basehost'].'/photos/'.$pinyin.'/';

        }




//当前页数->title里面使用
$seoarr['pageno']=(!empty($pageno))?'第'.$pageno.'页-':"";
$pv = new ListView($typeid);

$pv->pagesize=40;//分页条数.
$pv->Fields['tagword'] =$tagwords;
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

 $pv->Fields['searchname']=empty($pv->Fields['dest_name'])?$keyword:$pv->Fields['dest_name'];
 $pv->Fields['searchname']= empty($pv->Fields['searchname']) ? '全部' : $pv->Fields['searchname'];

  //分页搜索条件
 $pv->SetParameter('dest_id',$dest_id);
 $pv->SetParameter('priceid',$priceid);
 $pv->SetParameter('sorttype',$sorttype);
 $pv->SetParameter('keyword',$keyword);
 $pv->SetParameter('attrid',$attrid);
  //获取上级开启了导航的目的地
  getTopNavDest($dest_id);
//模板选择
 $templet = Helper_Archive::getUseTemplet('spot_list');//获取使用模板
 $templet=!empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."spots/" ."spot_search.htm";	//默认模板
 $pv->SetTemplet($templet);
 $pv->Display();
 exit();
   
//本页面用到的函数
   /**
     *  获得档目名称
     *
     * @access    private
     * @return    arr
     */

	function getDestInfo($typeid,$childid=0)
	{ 
	   
	   $childid=empty($childid)?0:$childid;
	   global $dsql,$cfg_spot_title,$cfg_spot_desc;
	  
	   $arr=array();
	 
	   $sql="select a.kindname,b.seotitle,b.jieshao,b.keyword,b.tagword,b.description from #@__destinations as a inner join #@__spot_kindlist as b on a.id=b.kindid where a.id={$childid} ";
	
	  $row=$dsql->GetOne($sql);
	  
	   $cfg_spot_title=str_replace('XXX',$row['kindname'],$cfg_spot_title);
	   $cfg_spot_desc=str_replace('XXX',$row['kindname'],$cfg_spot_desc);
	   if(empty($row['seotitle']))
	   {
			
		   $arr['seotitle']=empty($cfg_spot_title) ? $row['kindname'] : $cfg_spot_title;
	   }
	   else
		{
		   $arr['seotitle']=$row['seotitle'];
			
	   }
		if(empty($row['description']))
	   {
			
		   $arr['description']=empty($cfg_spot_desc) ? $row['description'] : $cfg_spot_desc;
	   }
	   else
		{
		   $arr['description']=$row['description'];
		}
	   
	 
	  $arr['typename']=$row['kindname'];
	  $arr['dest_jieshao']=$row['jieshao'];
	  $arr['dest_name'] = $row['kindname'];
	  $arr['kindid'] = $childid;
	  $arr['tagword']=$row['tagword'];
	  $arr['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
	  $arr['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
      $arr['pinyin'] = $row['pinyin'];
	  return $arr;
	}
	
	//获取当前级
	function getCurkind($id)
	{
		global $dsql;
		$sql = "select id,kindname,pinyin from #@__destinations where id='$id'";
		$pname = $dsql->GetOne($sql);
		$str = getParKind($id);//上一级信息
		if(is_array($pname))
		{
		
			$str .= ' &raquo; <a href="' . $GLOBALS['cfg_cmsurl'] . '/spots/'.$pname['pinyin'].'/" rel="nofollow">' . $pname['kindname'] . '景点</a>';
		}
		else
		{
			$str .= '';
		}
		
		return $str;
	}
	//获取上一级
	function getParKind($id)
	{
		global $dsql;
		$sql = "select pid from #@__destinations where id='$id'";
		
		$pre = $dsql->GetOne($sql);
		$pid = $pre['pid'];
		//上一级信息
		$sql = "select id,kindname,pinyin from #@__destinations where id='$pid'";
		
		$pname = $dsql->GetOne($sql);
		
		if(is_array($pname))
		{
		
			$str = ' &raquo; <a href="' . $GLOBALS['cfg_cmsurl'] . '/spots/'.$pname['pinyin'].'/" rel="nofollow">' . $pname['kindname'] . '景点</a>';
		}
		else
		{
			$str = '';
		}
		return $str;
		
	}

/**
     *  生成searchtitle,keyword,description等信息.
     *
     * @access    private
     * @return    array
     */
function getSearchTitle($info,$priceid,$attrid)
{
   global $searchkey,$dest_id;
   $arr=array();
   $searchtitle="{$info['seotitle']}|";
 
   if($priceid!=0)
   	{
     	$pricearr=getSpotMinMaxprice($priceid);
	 
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
	if(!empty($attrid))
	{
	   $searchtitle.= getSpotAttrName($attrid) ; 	
	}
   
    return $searchtitle;
}
//获取attrname
function getSpotAttrName($attrid)
{
	global $dsql;
	$arr = explode(',',$attrid);
	foreach($arr as $id)
	{
	  $sql = "select attrname from #@__spot_attr where id='$id'";
	  $row = $dsql->GetOne($sql);
	  $namelist.=$row['attrname'].'|'; 	
	}
	
	return $namelist;
}

//搜索Url
function getSearchUrl($val=null,$key=null,$exclude=null,$arr=array('priceid','sorttype','keyword','attrid'),$url="/spots/",$table="#@__spot_attr")
{
    
	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}


?>
