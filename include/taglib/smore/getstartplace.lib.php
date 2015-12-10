<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取目的地列表标签
 *
 * @version        $Id: destlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


 
require_once(SLINEINC.'/view.class.php');

function lib_getstartplace(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|20,flag|top,limit|0,pname|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	if($flag=='top')
	{
		$sql="select * from #@__startplace where isopen=1 and pid!=0 order by displayorder asc limit $limit,$row";
	}
	else if($flag=='son')
	{
		if(empty($pname)) return '';
		$sqld="select id from #@__startplace where cityname='$pname'";
		$_field=$dsql->GetOne($sqld);
		if(empty($_field)) return '';	
		$sql="select * from #@__startplace where pid={$_field['id']} where isopen=1 order by displayorder asc limit $limit,$row";
	}
	
	
	$innertext = trim($ctag->GetInnertext());
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$revalue='';
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
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

 ?>
