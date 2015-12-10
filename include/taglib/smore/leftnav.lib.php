<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 线路首页左侧导航分类调用
 *
 * @version        $Id: leftnav.lib.php 1 9:29 2014.01.28 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
require_once(SLINEINC.'/view.class.php');
function lib_leftnav(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|20,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = trim($ctag->GetInnertext());
	$revalue='';
    $table = "#@__destinations";
	$sql="select id,kindname,pinyin from {$table} where pid= 0 and isopen=1 order by displayorder asc";
    
	$kindnames=array();
	$ids = $pinyin = array();
	
	$arr=$dsql->getAll($sql);
	 for($i=0;isset($arr[$i]['id']);$i++)
	 {

		$ids[]=$arr[$i]['id'];
		$kindname[]=$arr[$i]['kindname'];	
		$pinyin[]=$arr[$i]['pinyin']; 
     }

	$GLOBALS['autoindex']=0;
    for($k=0;isset($ids[$k]);$k++)
    {
      $GLOBALS['autoindex']++;
	  $pv = new View(0);
	  $pv->Fields['kindname']=$kindnames[$k];
	  $pv->Fields['kindid']=$ids[$k];
	  $pv->Fields['pinyin']= $pinyin[$k];
      $pv->SetTemplet($innertext,'string');
	 
      $revalue .= $pv->GetResult();
    }
    return $revalue;
}

 



