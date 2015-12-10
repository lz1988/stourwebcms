<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 条件判断调用
 *
 * @version        $Id: if.lib.php 1 9:29 2012.07.24 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
require_once(SLINEINC.'/view.class.php');
function lib_if(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|20,showall|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $condition=isset($GLOBALS['condition'][$var]) ? $GLOBALS['condition'][$var]:0;//
    $innertext = trim($ctag->GetInnertext());
	$revalue='';
   
    if($condition)
    {
     $pv = new View(0);
	 $pv->Fields['typeid']=0;
	 $pv->Fields=$refObj->Fields;
     $pv->SetTemplet($innertext,'string');
     $revalue .= $pv->GetResult();
    }
    return $revalue;
}
 



