<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 栏目开关检测标签
 *
 * @version        $Id: channelcheck.lib.php 1 9:29 2015.04.22 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
require_once(SLINEINC.'/view.class.php');
function lib_channelcheck(&$ctag,&$refObj)
{
    global $dsql,$sys_webid;
	include(SLINEDATA."/webinfo.php"); 
    $attlist="typeid|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	if(empty($typeid)) return '';
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
    $webid = $GLOBALS['sys_child_webid'];
    $sql="select isopen from sline_nav where  typeid='$typeid' and webid='$webid'";
    $row=$dsql->GetOne($sql);


    if($row['isopen'] == 1)
    {
      $pv = new View(0);
      $pv->SetTemplet($innertext,'string');
      $revalue .= $pv->GetResult();
    }
    return $revalue;
}
 



