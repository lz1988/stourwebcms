<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 客服调用数据标签
 *
 * @version        $Id: getkefu.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
/*>>sline>>
<name>读取客服信息</name>
<demo>
{sline:getkefu}
  [field:name/]-[field:phone/]-[field:qq/]
{/sline:getkefu}

</demo>

>>sline>>*/
 

function lib_getkefu(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="typeid|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	$typeid=isset($refObj->Fields['typeid'])?$refObj->Fields['typeid']:0; //如果没有指定typeid则载入默认客服
	
	$arr=array(1,2,3,7);
	
	if(isset($GLOBALS['childid']))
	{
		$linekindid = $GLOBALS['childid'];
	}
	else if(isset($GLOBALS['destid']))
	{
		$linekindid = $GLOBALS['destid'];
	}
	else
	{
		$deAid = $dsql->GetOne("select kindlist from #@__line where aid='$GLOBALS[aid]'");
		$kArr = explode(',', $deAid['kindlist']);
		$linekindid = max($kArr);
	}
	
	if(!in_array($typeid,$arr)) //特殊处理
	{
	  $typeid=0;
	}
	if($typeid==7)
	{
	  $typeid=4;//特殊处理
	}

    $innertext = trim($ctag->GetInnertext());
	
	
	
    $revalue = '';
	$sql="select * from #@__talist where webid=0 and kind=$typeid";
	$row=$dsql->GetOne($sql);
	if($row['tauser']==""&&($row['phone']==""||$row['qq']==""||$row['email']==""))
	{
		$sql="select * from #@__talist where webid=$sys_webid and kind=0";
	}
	if($typeid == 1)
	{
		if($linekindid == '' || $linekindid =='0' || $linekindid == 0)
		{
			$sql="select * from #@__talist where webid=0 and kind=$typeid";
		}
		else
		{
			$sql="select * from #@__talist where webid=0 and kind=$typeid and FIND_IN_SET($linekindid,destinations)";
		}
	}
    //echo $sql;
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
		$row['name']=$row['tauser'];
		$row['face'] = empty($row['face']) ? $GLOBALS['cfg_templets_skin'] . "/images/pic_tem.gif" : $row['face'];
		$row['year'] = $row['jobtime'] . "年";
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