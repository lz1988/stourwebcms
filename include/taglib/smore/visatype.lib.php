<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 获取签证分类标签
 *
 * @version        $Id: visatype.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 

function lib_visatype(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="typeid|0,row|5,flag|kind,limit|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	//签证类型
	if($flag == 'kind')
	{
	  $sql="select * from #@__visa_kind where isopen=1 order by displayorder asc";
	}
	//签发城市
	else if($flag == 'city')
	{
	  $sql = "select * from #@__visa_city order by displayorder asc";	
	}
	//签证国家
	else if($flag == 'country')
	{
	  $sql = "select * from #@__visa_area where isopen = 1 and pid!=0 order by displayorder asc limit {$limit},{$row}";
	}
    //热门签证国家
    else if($flag == 'hotcountry')
    {
      $sql = "select * from #@__visa_area where isopen = 1 and pid!=0 and ishot=1 order by displayorder asc limit {$limit},{$row}";
    }
    //通过pid获取国家
    else if($flag =='getcountrybypid')
    {
        $pid = $refObj->Fields['areaid'] ? $refObj->Fields['areaid'] : 0;
        if(empty($pid))exit;
        $sql = "select * from #@__visa_area where isopen = 1 and pid='$pid' order by displayorder,pinyin asc limit {$limit},{$row}";
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
	
        $row['title']=$row['kindname'];
        $row['litpic'] = isset($row['litpic']) ? $row['litpic'] : getDefaultImage();


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
