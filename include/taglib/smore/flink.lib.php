<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 友情链接调用标签
 *
 * @version        $Id: flink.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

function lib_flink(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|20,showall|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	
    $typeid=isset($refObj->Fields['typeid'])?$refObj->Fields['typeid']:0;//如果网页没有指定typeid则获取所有友情链接.
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
    $webid = $GLOBALS['sys_child_webid'];//webid赋值
	if($showall=="all") //全部
	{
		$sql="select sitename,siteurl from #@__yqlj where webid='$webid'   order by addtime desc limit 0,{$row}";
	} 

	else //按栏目读取
	{
		$sql="select sitename,siteurl from #@__yqlj where webid='$webid' and locate($typeid,address) order by addtime desc limit 0,{$row}";
	}
	
    $dsql->SetQuery($sql);
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