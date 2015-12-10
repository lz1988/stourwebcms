<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用帮助数据标签
 *
 * @version        $Id: gethleplist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
 

function lib_gethelplist(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,type|top,sonid|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
    if($type=='top' && empty($flag)) return '';
	$typeid=isset($refObj->Fields['typeid'])?$refObj->Fields['typeid']:0;//如果网页没有指定typeid则获取所有网站帮助.
	  //如果调用二级栏目则必须在显示类里指定sonid
	if($type=='son')
	{  
	   if(isset($refObj->Fields['sonid'])||!empty($sonid))
	   {
	        $sonid=empty($refObj->Fields['sonid'])?$sonid:$refObj->Fields['sonid'];

			$str="and" . " (FIND_IN_SET($typeid,type_id) or FIND_IN_SET('-1',type_id))";

			$sql="select aid,title,addtime,modtime from #@__help where webid=0 and   kindid={$sonid} $str order by displayorder asc,addtime desc limit 0,{$row}";
	   }
	   else return '';
	}
    else if($type=='kind')
    {  
       if(isset($refObj->Fields['sonid'])||!empty($sonid))
       {
            $sonid=empty($refObj->Fields['sonid'])?$sonid:$refObj->Fields['sonid'];
            
            $sql="select aid,title,addtime,modtime from #@__help where webid=0 and   kindid={$sonid} order by displayorder asc,addtime desc limit 0,{$row}";

            
       }
       else return '';
    }  
	else if($type=='top')
	{
		$sql="select aid,title,addtime,modtim from #@__help where webid=0 order by displayorder asc,addtime desc limit 0,{$row}";
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
		$row['url']=GetWebURLByWebid(0)."/help/show_{$row['aid']}.html";
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