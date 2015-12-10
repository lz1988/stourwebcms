<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用同级或者下级分类标签
 *
 * @version        $Id: getspotguide.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
/* >>smore>>
*/
 

function lib_getspotguide(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|15,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	
	if(!isset($flag)) return '';
	$kindid=$refObj->Fields['kindid'];
	$kindtable=$tablename[$typeid];
	if($flag=='price')//景点价格范围
	{
       $sql="select id,aid,min,max from #@__spot_pricelist where webid='0' limit 0,{$row}";
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
		if($flag=='price')
		{
		 
		   
		  	if($row['min']!=''&& $row['max']!='')
		 	{
		    	$row['title']=$row['min'].'元~'.$row['max'].'元';
		 	}
		 	else if($row['min']=='')
		 	{
		    	$row['title']=$row['max'].'元以下';
		 	}
		 	else if($row['max']=='')
		 	{
		    	$row['title']=$row['min'].'元以上';
		 	}
		
		}
		
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