<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用副导航数据标签
 *
 * @version        $Id: serverlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
/*>>sline>>
<name>读取副导航列表</name>
<demo>
{sline:serverlist}
  <a href='[field:url/]'>[field:servername/]</a>
{/sline:loop}
</demo>

>>sline>>*/
 

function lib_serverlist(&$ctag,&$refObj)
{
    global $dsql;
    $sql="select aid,servername from #@__serverlist where webid='0' and isdisplay=1 order by displayorder asc";
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
		
		$row['url']="{$GLOBALS['cfg_base_url']}/servers/index_{$row['aid']}.html";
		$row['title']=$row['servername'];
		
		
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