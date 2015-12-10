<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用子分类标签
 *
 * @version        $Id: getslidenav.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 

 
$outlist='';
function lib_getslidenav(&$ctag,&$refObj)
{
    global $dsql,$outlist;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $kindid=$refObj->Fields['kindid'];
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$sql="select id,kindname as categoryname,litpic,remark,linkurl as url,color from #@__plugin_leftnav where pid='{$kindid}' and isopen=1 order by displayorder asc";
	$arr=$dsql->getAll($sql);
	for($i=0;isset($arr[$i]);$i++)
	{
        $row=$arr[$i];
	    $row['categorychild']=getCategoryChild2($row['id']);
        $row['categoryname'] =  !empty($row['color']) ? '<font color="'.$row['color'].'">'.$row['categoryname'].'</font>' : $row['categoryname'];
		if(!empty($row['url']) && $row['url']!="http://")
		{
		   $row['categoryname']="<a href=\"{$row['url']}\" target=\"_blank\" >{$row['categoryname']}</a>";
		}
		$ctp = new STTagParse();
		$ctp->SetNameSpace("field","[","]");
		$ctp->LoadSource($innertext);
		$outlist='';
	   
	
			
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

//根据kindid获取下级分类
function getCategoryChild2($kindid)
{
	 global $dsql;
	 $outlist='';
	 $sql="select id,kindname,linkurl,color from #@__plugin_leftnav where pid='$kindid' and isopen=1 order by displayorder asc";
	 
	 $arr=$dsql->getAll($sql);
  
	 for($i=0;isset($arr[$i]);$i++)
	  {
		    $row=$arr[$i];
	        $kindname = !empty($row['color']) ? '<font color="'.$row['color'].'">'.$row['kindname'].'</font>' : $row['kindname'];
	        $outlist.=" <a href=\"{$row['linkurl']}\" target=\"_blank\" >{$kindname}</a>";
	  }
	  return $outlist;

}

