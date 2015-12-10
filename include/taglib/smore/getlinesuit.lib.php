<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 线路套餐调用标签
 *
 * @version        $Id: getlinesuit.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 


function lib_getlinesuit(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|10,lineid|0";
	$webid=0;
	
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
    $lineid = $lineid ? $lineid : $refObj->Fields['id'];//线路id
    $sql="select a.* from #@__line_suit a where a.lineid='$lineid' order by a.displayorder asc";

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
        $row['title'] = $row['suitname'];//价格名称.

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
