<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 首页轮播广告调用
 *
 * @version        $Id: rolling.lib.php 1 9:29 2011.05.03 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
 
 
function lib_rollingad(&$ctag, &$refObj)
{
    global $dsql;
    $attlist = "typeid|0,name|IndexSpotRollingAd,row|30,limit|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    if($name=='') return '';
    $innertext = trim($ctag->GetInnertext());
    $revalue='';
    $webid = $GLOBALS['sys_child_webid'];//webid赋值
	$sql="SELECT * FROM #@__advertise WHERE tagname = '$name' and typeid=0 and webid='$webid'  ORDER BY displayorder asc limit $limit,$row";

	$dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['step'] = 0;
    while($row = $dsql->GetArray())
    {
        $GLOBALS['step']++;
		$row['picurl']=$GLOBALS['cfg_cmsurl'].$row['picurl'];
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
