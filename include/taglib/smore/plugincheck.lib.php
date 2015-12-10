<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 插件检测标签
 *
 * @version        $Id: plugincheck.lib.php 1 9:29 2012.06.01 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
require_once(SLINEINC.'/view.class.php');
function lib_plugincheck(&$ctag,&$refObj)
{
    global $dsql,$sys_webid;
	include(SLINEDATA."/webinfo.php"); 
    $attlist="row|20,identify|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	if(empty($identify)) return '';
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
    /* $sql="select isopen from #@__plugins where  identify='$identify' and webid=$sys_webid";

   $row=$dsql->GetOne($sql);*/


    if($GLOBALS[$identify] == 1)

    {
      $pv = new View(0);
      $pv->SetTemplet($innertext,'string');
      $revalue .= $pv->GetResult();
    }
    return $revalue;
}
 



