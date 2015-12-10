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
function lib_getslidenavbyid(&$ctag,&$refObj)
{
    global $dsql,$outlist;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,kindid|0,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$sql="select id,kindname as categoryname,linkurl as url,color from #@__plugin_leftnav where pid='{$kindid}' and isopen=1 order by displayorder asc limit 0,{$row}";
	$arr=$dsql->getAll($sql);

	for($i=0;isset($arr[$i]);$i++)
	{
        $row=$arr[$i];
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


