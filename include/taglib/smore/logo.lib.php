<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 网站Logo调用
 *
 * @version        $Id: GetLogo.lib.php 1 9:29 2012.05.08 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
require_once(SLINEINC.'/view.class.php');
function lib_logo(&$ctag,&$refObj)
{
    
   $innertext = trim($ctag->GetInnertext());
   $revalue='';
   $a=!empty($GLOBALS['typeid'])?$GLOBALS['typeid']:'0'; 
  // $b=explode(',',$GLOBALS['cfg_logodisplay']);
  // if(in_array($a,$b) || $a=='12')

   
     $pv = new View(0);
     $pv->SetTemplet($innertext,'string');
     $revalue .= $pv->GetResult();
     return $revalue;
}
 



