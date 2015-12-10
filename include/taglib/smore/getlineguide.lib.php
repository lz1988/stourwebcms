<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 线路分类导航调用标签
 *
 * @version        $Id: getlineguide.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
/*>>sline>>
<name>线路分类导航调用标签</name>
<demo>
{sline:getlineguide row='5'}
  <a href='[field:url/]'>[field:servername/]</a>
{/sline:getlineguide}
</demo>

>>sline>>*/
 

function lib_getlineguide(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|10,flag|";
	$webid=0;
	
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
	if($flag=='day')
	{
     $sql="select id,word from #@__line_day  where webid=0 order by word asc";
	
	}
	else if($flag=='price')
	{
	   $sql="select id,aid,lowerprice as min,highprice as max from #@__line_pricelist where webid=0 order by min limit 0,{$row}";
	}
	else if($flag=='attr')
	{
	   $sql="select id,attrname from #@__line_attr where webid=0 and isopen='1' and pid!=0 order by displayorder asc limit 0,{$row}";
	}
	
	
	$innertext = trim($ctag->GetInnertext());
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$revalue='';
	$rowcount=$dsql->GetTotalRow();
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
	   if($flag=='day')
	   {	
		 $number=substr($row['word'],0,2);
		 $arr=array("零","一","二","三","四","五","六","七","八","九");
		 if(strlen($number)==1)
		 {
		       $result=$arr[$number];
		  }
		  else
		  {
			   if($number==10)
			   {
				$result="十";
			   }
			   else
			   {
					if($number<20)
					{
					$result="十";
					}
					else
					{
					$result=$arr[substr($number,0,1)]."十";
					}
					if(substr($number,1,1)!="0")
					{
					  $result.=$arr[substr($number,1,1)]; 
					}
			   }
		  }
		if(CheckLineDay($row['word'])) //检测是否存在.
		 {
		   if($GLOBALS['autoindex']==$rowcount)
			{
				$row['title']=$result."日游以上";
			}
			else
			{
			  $row['title']=$result."日游";
			}
		    $childid=isset($GLOBALS['childid']) ? $GLOBALS['childid'] : (isset($GLOBALS['destid']) ? $GLOBALS['destid'] : 0);
			$priceid=isset($GLOBALS['priceid']) ? $GLOBALS['priceid'] :0;
			$attrid=isset($GLOBALS['attrid']) ? $GLOBALS['attrid'] :0;
		   $row['url']="{$GLOBALS['cfg_cmsurl']}/lines/search_{$childid}_{$row['word']}_{$priceid}_{$attrid}.html";
		 }
		 else
		 {
		    continue;
		 }
	   }
	   else if($flag=='price')
	   {
		   if(CheckLinePrice($row['min'],$row['max'])) //检测价格范围是否存在.
			{
			   if($row['min']!=''&& $row['max']!='' && $row['min']!=0)
			   {
				  $row['title']=$row['min'].'~'.$row['max'].'';
			   }
			   else if($row['min']=='' || $row['min']==0)
			   {
				  $row['title']=$row['max'].'以下';
			   }
			   else if($row['max']=='')
			   {
				  $row['title']=$row['min'].'以上';
			   }
			   $childid=isset($GLOBALS['childid']) ? $GLOBALS['childid'] : (isset($GLOBALS['destid']) ? $GLOBALS['destid'] : 0);
			   $day=isset($GLOBALS['day']) ? $GLOBALS['day'] :0;
			   $attrid=isset($GLOBALS['attrid']) ? $GLOBALS['attrid'] :0;
				$row['url']="{$GLOBALS['cfg_cmsurl']}/lines/search_{$childid}_{$day}_{$row['aid']}_{$attrid}.html";
			 //$row['title']=(empty($row['lowerprice'])?'0':$row['lowerprice'])."元~".$row['highprice']."元";
			}
		   else
		   {
			  continue;
		   }
	      
	   }
	   else if($flag=='attr')
	   {

		    $asonid = $GLOBALS['destid'];
		    $childid=isset($GLOBALS['childid']) ? $GLOBALS['childid'] : (isset($GLOBALS['destid']) ? $GLOBALS['destid'] : 0);
		   if(CheckExistAttrGuide('1',$asonid,$row['id']))
		   {
			   $row['attr_id'] = $row['id'];
			   $row['attr_name'] = $row['attrname'];
			   $row['title']=$row['attrname'];
			   $row['url']="{$GLOBALS['cfg_cmsurl']}/lines/search_{$childid}_0_0_{$row['id']}.html";
		   }
		   else
		   {
			   continue;
		   }
	   }
        foreach($ctp->CTags as $tagid=>$ctag)
        {
                if($ctag->GetName()=='array')
                {
                        $ctp->Assign($tagid, $row);
                }
                else
                {
                    if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 
                }
        }
      $revalue .= $ctp->GetResult();
    }

    return $revalue;
}
//检测函数
function CheckLineDay($value)
{
	global $dsql;
	$flag=0;
	$kindid = isset($GLOBALS['childid']) ? $GLOBALS['childid'] : 0;
	$destid = isset($GLOBALS['destid']) ? $GLOBALS['destid'] : 0;
	
	if($kindid != 0)
	{
		$sql="select 1 from #@__line where lineday='$value' and ishidden=0 and FIND_IN_SET($kindid,kindlist) limit 1";
	}
	else if($destid != 0)
	{
		$sql="select 1 from #@__line where lineday='$value' and ishidden=0 and FIND_IN_SET($destid,kindlist) limit 1";
	}
	else
	{
		$sql="select 1 from #@__line where lineday='$value' and ishidden=0 limit 1";
	}
	
	$flag=$dsql->ExecuteNoneQuery2($sql);
	return $flag;
	
}
function CheckLinePrice($min,$max)
{
	global $dsql;
	$flag=0;
	$kindid = isset($GLOBALS['childid']) ? $GLOBALS['childid'] : 0;
	$destid = isset($GLOBALS['destid']) ? $GLOBALS['destid'] : 0;
	$min=!empty($min) ? $min : 0;
	$max=!empty($max) ? $max : 99999;
	if($kindid != 0)
	{
		$sql="select 1 from #@__line where price>=$min and price<=$max  and ishidden=0 and FIND_IN_SET($kindid,kindlist) limit 1";
	}
	else if($destid != 0)
	{
		$sql="select 1 from #@__line where price>=$min and price<=$max  and ishidden=0 and FIND_IN_SET($destid,kindlist) limit 1";
	}
	else
	{
		$sql="select 1 from #@__line where price>=$min and price<=$max and ishidden=0 limit 1";
	}
	
	$flag=$dsql->ExecuteNoneQuery2($sql);
	return $flag;
	
	
}