<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

/**
 * 文章属性调用标签
 *
 * @version        $Id: getarcattr.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 

function lib_getarcattr(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|8,limit|0,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';

	$kindid=$refObj->Fields['kindid'];
	$sql="select * from #@__article_attr where isopen=1 and pid!=0 order by displayorder asc limit {$limit},{$row}";
	if($flag=='mdd')
	{
		$sql="select a.*,count(b.id) as num from #@__article_attr as a inner join #@__article as b on find_in_set(a.id,b.attrid) where find_in_set($kindid,b.kindlist) group by a.id limit {$limit},{$row}";
	}

    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
		
       if(checkExist($row['id']))
	   {
		  
		   $destid=isset($GLOBALS['destid']) ? $GLOBALS['destid'] : 0;
           $py = Helper_Archive::getDestPinyin($destid);
           $py = !empty($py) ? $py : 'all';
		  //$row['url'] = $GLOBALS['cfg_cmsurl']."/raiders/search.php?attrid={$row['id']}&destid={$destid}";
           $row['url'] = $GLOBALS['cfg_cmsurl']."/raiders/".$py.'-'.$row['id'];
		  $row['title']=$row['attrname'];
		  $row['number']=getCount($row['id']);
		  if($flag=='mdd')
		  {
			  $row['number']=$row['num'];
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
		  $GLOBALS['autoindex']++;
	   }
	   else
	   {
		  continue;   
	   }
    }
    return $revalue;
}

function checkExist($attid)
{
	global $dsql;
	$destid=isset($GLOBAL['destid']) ? $GLOBALS['destid'] : 0;
	$flag=0;
	if($destid!=0)
	{
	   $sql="select 1 from #@__article where FIND_IN_SET({$attid},attrid) and FIND_IN_SET($destid,kindlist) limit 1";	
	}
	else
	{
	  $sql="select 1 from #@__article where FIND_IN_SET({$attid},attrid) limit 1";
	}
	$flag=$dsql->ExecuteNoneQuery2($sql);
	return $flag;
	
}

function getCount($attid)
{
	global $dsql;
	$sql="select count(*) as num from #@__article where FIND_IN_SET({$attid},attrid)";
	$row=$dsql->GetOne($sql);
	$num=$row['num'];
	return $num;
	
}