<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 热搜词调用
 *
 * @version        $Id: getsearchkey.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
 

function lib_getsearchkey(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
    $sql="select keyword as title from #@__search_keyword where isopen = 1 order by keynumber desc limit 0,{$row}";
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
        $url = GetWebURLByWebid(0); //这里获取主域名
		$row['url']=$url."/cloudsearch.php?keyword={$row['title']}";
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