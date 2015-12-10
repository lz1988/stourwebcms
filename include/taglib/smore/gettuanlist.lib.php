<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

/**
 * 调用团购显示数据标签
 *
 * @version        $Id: gettuanlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

function lib_gettuanlist(&$ctag,&$refObj)
{
	
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,flag|,type|top,limit|0,haspic|1,day|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$basefield ='a.*';


    $time = time();
	if($type=='mdd')
	{  
	   if($flag=='recommend')
	   {
		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.addtime desc';
	   }
	   else if($flag=='hot')
	   {
		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.addtime desc';
	   }
	   else if($flag=='new')
	   {
		  $orderby='order by a.addtime desc'; 
		   
	   }
	   else
	   {
		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.addtime desc';
	   }
	   if(isset($refObj->Fields['kindid']))
	   {
	        $sonid=$refObj->Fields['kindid'];
			$number=isset($refObj->Fields['shownumber']) ? $refObj->Fields['shownumber'] : $row;//如果模块设置了显示数量则使用.

			$where="a.ishidden=0 and FIND_IN_SET($sonid,a.kindlist) and a.endtime>$time and a.starttime<=$time";
			$where.=!empty($haspic)?" and a.litpic is not null":''; 
		  
			$sql="select {$basefield} from #@__tuan as a left join #@__kindorderlist as c on (c.classid=$sonid and a.id=c.aid and c.typeid=4)  where $where  {$orderby}  limit {$limit},{$number}";
			
			
	   }
	   else return '';
	} 
	else if($type=='daytime')
	{
		if(!empty($day)){
				$day = date('Y-m-d',strtotime($day));
				$day = strtotime($day);
				$sql="select {$basefield} from #@__tuan a where a.ishidden=0 and starttime={$day} and endtime!='' order by a.addtime asc,a.endtime asc limit {$limit},{$row}";
		}else{
		   	$sql="select {$basefield} from #@__tuan a where a.ishidden=0 and endtime>{$time} and endtime!='' and a.starttime>{$time}   order by a.starttime asc,a.addtime desc limit {$limit},{$row}";	
		}
	}
	else if($flag=='recommend')
	{
	   $sql="select {$basefield},b.isjian,b.isding as isding,b.displayorder from #@__tuan a left join #@__allorderlist b on (a.id=b.aid and b.typeid=13) where a.ishidden=0 and a.endtime>{$time}  order by case when b.displayorder is null then 9999 end,b.displayorder asc,a.addtime desc limit {$limit},{$row}";

	 
	}

	else if($flag=='new')
	{
	   $sql="select {$basefield} from #@__tuan a where a.ishidden=0 and endtime>{$time} and endtime!='' and a.starttime<={$time}   order by a.addtime desc limit {$limit},{$row}";
	  
	}
	else if($flag=='hot')
	{
	   $sql="select {$basefield} from #@__tuan a where a.ishidden=0 and endtime>{$time} and endtime!='' and a.starttime<={$time}   order by a.shownum desc,a.addtime desc limit {$limit},{$row}";

	}
	else if($flag=='byendtime')
	{
	   $sql="select {$basefield} from #@__tuan a where a.ishidden=0 and endtime>{$time} and endtime!='' and a.starttime<={$time}   order by a.endtime asc,a.addtime desc limit {$limit},{$row}";

	}
	else if($flag=='photo') //幻灯显示
	{
	   	$sql="select {$basefield} from #@__tuan a where a.ishidden=0 and a.litpic !='' and endtime>{$time} and endtime!='' and a.starttime<=$time order by a.addtime desc limit {$limit},{$row}";
		
	}
	else if($flag=='nostart')
	{
	   $sql="select {$basefield} from #@__tuan a where a.ishidden=0 and endtime>{$time} and endtime!='' and a.starttime>{$time}   order by a.starttime asc,a.addtime desc limit {$limit},{$row}";

	}
	else if($flag=='relative')
	{
		$kindlist=$refObj->Fields['kindlist'];
		$maxkindid=get_exist_kind($kindlist);//最后一级.
		$maxkindid = empty($maxkindid) ? 0 : $maxkindid;
		$where=" FIND_IN_SET($maxkindid,a.kindlist) ";
	    //排序顺序：置顶+tag关联》排序+ tag关联》最新更新+tag关联
	    $sql="select a.* from #@__tuan a where find_in_set('$attrid',a.attrid) where a.ishidden=0 and endtime>{$time} and endtime!='' and a.starttime<=$time  order by a.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row} ";
	
	}
	else if($type=='theme')
	{
	    $themeid=$refObj->Fields['themeid'];
		if(empty($themeid))return '';
		$sql="select a.* from #@__tuan a where a.ishidden=0 and FIND_IN_SET($themeid,a.themelist) and endtime>{$time} and endtime!='' and a.starttime<=$time  order by a.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";
		
	}


	else return '';

    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
	
    $ctp->LoadSource($innertext);
    
    $GLOBALS['autoindex'] = 0;

    while($row = $dsql->GetArray())
    {
		$GLOBALS['autoindex']++;
		$webroot=GetWebURLByWebid($row['webid']);
		$sonid=$refObj->Fields['sonid'];
		
		$row['url']=$webroot."/tuan/show_{$row['aid']}.html";
		
		$row['litpic']=getUploadFileUrl($row['litpic']);
	    $row['lit240']=str_replace('litimg','lit240',$row['litpic']);
	    $row['lit160']=str_replace('litimg','lit160',$row['litpic']);
		
		$row['attrname']=getTuanAttrname($row['attrid']);
		$row['attrnamearr']=getTuanAttrname($row['attrid'],true);
		$row['destname']=Helper_Archive::getBelongDestName($row['kindlist']);//所属目的地
		$row['destid']=array_remove_value($row['kindlist']);
		$row['discount']=floor($row['price']/$row['sellprice']*100)/10; //折扣
        $row['booknum']=Helper_Archive::getSellNum($row['id'],13)+$row['virtualnum'];
		$row['satisfyscore']=Helper_Archive::getSatisfyScore($row['id'],13); //满意度
        $row['price'] = $row['price'];
        foreach($ctp->CTags as $tagid=>$ctag)
        {
                if($ctag->GetName()=='array')
                {
                        $ctp->Assign($tagid, $row);
                }
                else
                {
                    if(isset($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 
                }
        }
        $revalue .= $ctp->GetResult();
		
    }
    return $revalue;
}
function getTuanAttrname($attrid,$isarr=false)
{
   global $dsql;
   
   //如果需要的是数组
   if($isarr)
   {
	 $sql="select id,attrname from #@__tuan_attr where id in ($attrid)";
     $result=$dsql->getAll($sql);
	  foreach($result as $v)
	  {
		$newresult[$v['id']]=$v['attrname'];
	  }
	  return $newresult;      
   }
   
   //如果需要的不是数组
   $name='其它';
   if(!empty($attrid))
   {
     $sql="select attrname from #@__tuan_attr where id in ($attrid)";
     $row=$dsql->GetOne($sql);
	 $name=$row['attrname'];
   }
   return $name;

}

