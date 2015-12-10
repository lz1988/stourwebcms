<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用任意表的数据标签
 *
 * @version        $Id: loop.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 

function lib_loop(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="table|,tablename|,row|8,sort|,sorttype|desc,if|,ifcase|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
    if(!empty($table)) $tablename = $table;

    if($tablename==''||$innertext=='') return '';
    if($if!='') $ifcase = $if;

    if($sort!='') $sort = " ORDER BY $sort $sorttype ";
    if($ifcase!='') $ifcase=" WHERE $ifcase ";
	else $ifcase="WHERE webid=$sys_webid";
    $dsql->SetQuery("SELECT * FROM $tablename $ifcase $sort LIMIT 0,$row");
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
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