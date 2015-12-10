<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
} 
/**
 * 调用副导航数据标签
 *
 * @version        $Id: licenselist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
/*>>sline>>
<name>读取许可证文件列表</name>
<demo>
{sline:license}
    <li><a href="[field:litpic/]" target="_blank"><img src="[field:litpic/]" border="0" /></a></li>
{/sline:license}
</demo>

>>sline>>*/
 

function lib_licenselist(&$ctag,&$refObj)
{
    global $dsql;
    $sql="select picurl,litpic,licenseurl as url,licensename as title from #@__license where webid='0' order by displayorder asc";
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