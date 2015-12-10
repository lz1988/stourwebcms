<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 中间导航分类调用标签
 *
 * @version        $Id: middlenavlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

/*>>smore>>

>>smore>>*/
 
require_once(SLINEINC.'/view.class.php');

function lib_middlenavlist(&$ctag,&$refObj) 
{
    global $dsql;
    $attlist = "row|5,kindid|,flag|,type|,row|6,readad|1,limit|0,destid|,pid|,leftad|indexleftad,isnav|1,ishot|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	$typeid=isset($refObj->Fields['typeid']) ? $refObj->Fields['typeid']:1; //首页的显示与线路一致.
	$adflag='';
    
	if(!empty($flag))//首页调用其它栏目的中间导航
	{
		 $tablename=array("1"=>"#@__line_kindlist","2"=>"#@__hotel_kindlist","3"=>"#@__car_kindlist","4"=>"#@__article_kindlist","5" =>"#@__spot_kindlist","6"=>"#@__photo_kindlist","13"=>"#@__tuan_kindlist");


		if($flag=='raider') //首页中间调用攻略
		{
			$typeid=4;
			if($readad)
			{
			 $adflag="IndexRaiderMiddleNavAd";
			}
		
		}
		else if($flag=='line') //首页中间调用线路
		{
			$typeid=1;
			if($readad)
			{
			  $adflag="IndexLineMiddleNav";
			}
		}
		else if($flag=='hotel')
		{
		   $typeid=2;
		   if($readad)//是否读取广告
		   {
		    $adflag="IndexHotelMiddleNav";
		   }
		}
		else if($flag=='car')
		{
		   $typeid=3;	
		}
		else if($flag=='spot')
		{
		   $typeid=5;	
		}
		else if($flag=='photo')
		{
		   $typeid=6;	
		}
		else if($flag=='tuan')
		{
		   $typeid=13;	
		}
		if(!empty($pid))
		  $w=" and a.pid=$pid";

           $tablename = isset($tablename[$typeid]) ? $tablename[$typeid] : '#@__'.$flag.'_kindlist';
		
		   if($isnav==1)
           {
		   	$sql="select a.kindname,b.kindid,b.shownum,a.jieshao,a.pinyin,a.litpic,a.pinyin from  #@__destinations as a inner join {$tablename} as b on a.id=b.kindid where b.isnav=1 and a.isopen=1 $w order by b.displayorder asc limit $limit,$row";
		   }else if($ishot==1)
           {
		   	$sql="select a.kindname,b.kindid,b.shownum,a.jieshao,a.pinyin,a.litpic,a.pinyin from  #@__destinations as a inner join {$tablename} as b on a.id=b.kindid where b.ishot=1 and a.isopen=1 $w order by b.displayorder asc limit $limit,$row";
		   }
           else
           {
		   	$sql="select a.kindname,b.kindid,b.shownum,a.jieshao,a.pinyin,a.litpic,a.pinyin from  #@__destinations as a inner join {$tablename} as b on a.id=b.kindid where a.isopen=1 $w order by b.displayorder asc limit $limit,$row";
		   }
		
	}
	if($type=='gather')
	{
	   	$kindid=isset($refObj->Fields['kindid']) ? $refObj->Fields['kindid']:36; 
		
		if($destid)
		  $kindid=$destid;
		if(isHasChild($kindid))//如果有子级则显示子级内容
		{
		  $sql="select id as kindid,kindname,pinyin,litpic from #@__destinations  where pid=$kindid and isopen=1 order by displayorder asc limit 0,{$row}"; 	
		}
		else
		{ 
		   $sql="select id as kindid,kindname,pinyin,litpic from #@__destinations  where id=$kindid and isopen=1 order by displayorder asc limit 0,{$row}"; 
		  	
		}
	}


    //首页目的地显示
    if($type == 'index')
    {
        $sql="select a.id as kindid,a.* from #@__destinations a where a.isnav = '1' and a.isopen = 1 order by a.displayorder asc limit $limit,$row";
        $adflag="IndexMiddleAd";
    }

    //$adflag="IndexMiddleAd";

    $innertext = trim($ctag->GetInnerText());
	
    $artlist = '';
    if($innertext=='') return '';
   
    //获得类别ID总数的信息
    $ids = array();
	$kindnames=array();
	
	


    $dsql->SetQuery($sql);
    $dsql->Execute();
    while($row = $dsql->GetArray()) 
	{
        //if(Exist($row['kindid'],$typeid))
		//{
		  $ids[] = $row['kindid'];
		  $kindnames[]=$row['kindname'];//获取导航分类名称
		  $shownumber[]=!empty($row['shownum']) ? $row['shownum'] :8;
		  $pinyins[]=$row['pinyin'];
		  $litpic[]=getUploadFileUrl($row['litpic']);
		  $jieshao[]=$row['jieshao'];
		//}
		//$numbers[]=$row['row'];//显示数量
    }
    //如里子分类不存在则取当前级(聚合页面用)
	
	 /* if(!isset($ids[0]))
	  {
		  $kindid=$refObj->Fields['kindid'];
		  $kindnames[]=$refObj->Fields['kindname'];
		  $ids[]=$kindid;
		   
	  } */
	

     $GLOBALS['itemindex']=0;

    for($i=0;isset($ids[$i]);$i++)
    {
        $GLOBALS['itemindex']++;
        $newinnertext=$innertext;

		$pv = new View($typeid);
        $pv->Fields['leftad'] = getMiddleAd($leftad,$i);
        $pv->Fields['middlead'] = getMiddleAd($adflag,$i);
		$pv->Fields['kindname']=$kindnames[$i];
		//$pv->Fields['sonid']=$ids[$i];
		//$pv->Fields['shownumber']=$numbers[$i];
		$pv->Fields['pinyin']=!empty($pinyins[$i]) ? $pinyins[$i] : $ids[$i];
		$pv->Fields['shownum']=$shownumber[$i];
		$pv->Fields['kindid']=$ids[$i];
        $pv->Fields['destid']=$ids[$i];
		$pv->Fields['kindpy']=$pinyins[$i];
		$pv->Fields['jieshao']=$jieshao[$i];

		//$pv->Fields['kindchild']=GetChild($ids[$i],$typeid);
		$pv->Fields['litpic']=$litpic[$i];
        $pv->SetTemplet($newinnertext,'string');
        $artlist .= $pv->GetResult();
    }
	
  
    return $artlist;
}
function GetChild($kindid,$typeid)
{
	global $dsql;
	$tablename=array("1"=>"#@__line_kindlist","2"=>"#@__hotel_kindlist","3"=>"#@__car_kindlist","4"=>"#@__article_kindlist","5" =>"#@__spot_kindlist","6"=>"#@__photo_kindlist","13"=>"#@__tuan_kindlist");
	$channel=array("1"=>"lines","2"=>"hotels","3"=>"cars","4"=>"raiders","5" =>"spots","6"=>"photos","13"=>"tuan");
	$kindtable=$tablename[$typeid];
	$sql="select distinct a.kindname,a.kindname,a.id,a.pinyin from #@__destinations as a inner join  {$kindtable} as b on a.id=b.kindid where a.pid=$kindid and a.isopen=1 order by b.displayorder asc limit 0,5";
	$dsql->SetQuery($sql);
	$dsql->Execute();
	while($row=$dsql->GetArray())
	{
		//$id=intval($row['id'])<10 ? "0".$row['id'] : $row['id'];
		 
		//$url="{$GLOBALS['cfg_cmsurl']}/{$row['pinyin']}/{$channel[$typeid]}/";
        $pinyin = !empty($row['pinyin']) ? $row['pinyin'] : $row['id'];
		$url="{$GLOBALS['cfg_cmsurl']}/lines/{$pinyin}/";
		$out.="<a href=\"{$url}\" target=\"_blank\" data-id=\"{$row['id']}\" >{$row['kindname']}</a>";
		
	}
	return $out;
}

//是否存在
function Exist($kindid,$typeid)
{  
    global $dsql;
	$flag=0;
	$table=array("1"=>"#@__line","2"=>"#@__hotel","3"=>"#@__car","4"=>"#@__article","5"=>"#@__spot","6"=>"#@__photo","10"=>"#@__leave","13"=>"#@__tuan");
	$tablename=$table[$typeid];
	$sql="select 1 from $tablename where FIND_IN_SET($kindid,kindlist) limit 1";
	$flag = $dsql->ExecuteNoneQuery2($sql);
	return $flag;
}

//获取导航中间(左侧)广告
function getMiddleAd($adflag,$whichone)
{
	global $dsql,$sys_webid;
	$out='';
    $whichone = (int)$whichone + 1;
	if(!empty($adflag))
	{
	  $sql="select tagname,normalbody from #@__advertise where tagname like '{$adflag}{$whichone}%' order by displayorder asc ";
	  $row=$dsql->GetOne($sql);
	  if(is_array($row))
	  {
		  $out.= str_replace('padding-bottom:10px;','padding-top:10px;',$row['normalbody']);
	  }
	}
	
	
	return $out;	
	
}





//聚合页面是否有子级
function isHasChild($kindid)
{
	global $dsql;
	$flag = 0;
	$sql = "select 1 from #@__destinations where pid = '$kindid' and isopen = 1 limit 1";
	$flag = $dsql->ExecuteNoneQuery2($sql);
	return $flag;
	
	
}

 ?>
