<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 通用模块套餐调用标签
 *
 * @version        $Id: gettongyongsuit.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 


function lib_gettongyongsuit(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|10,productid|0";
	$webid=0;
	
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
    $productid = $productid ? $productid : $refObj->Fields['articleid'];
    $sql="select a.* from sline_model_suit a where a.productid='$productid' order by a.displayorder asc";

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
                    else $ctp->Assign($tagid,'');
                }
        }
      $revalue .= $ctp->GetResult();
    }

    return $revalue;
}
