<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取签证目的地标签
 *
 * @version        $Id: visaarealist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


 
require_once(SLINEINC.'/view.class.php');

function lib_visaarealist(&$ctag,&$refObj)
{
    global $dsql;
    include(SLINEDATA."/webinfo.php");
    $attlist = "row|20,pid|0,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	

    $innertext = trim($ctag->GetInnerText());    $artlist = '';
    $pid = isset($refObj->Fields['areaid']) ? $refObj->Fields['areaid'] : 0;

    
    if($innertext=='') return '';
	
	$tablename = '#@__visa_area';
   
    //获得类别ID总数的信息
    $ids = array();
	$kindnames=array();
	$sql = "select id,kindname from {$tablename} where pid='$pid' and isopen=1 order by displayorder asc,pinyin asc";//获取下一级
	
    $dsql->SetQuery($sql);
    $dsql->Execute();
    while($row = $dsql->GetArray()) 
	{
        $ids[] = $row['id'];
		$kindnames[]= $row['kindname'];//目的地名称
		
    }

    if(!isset($ids[0])) return ''; //如里分类不存在则退出
    for($i=0;isset($ids[$i]);$i++)
    {
       
        $pv = new View(0);
		$pv->Fields['areaname']=$kindnames[$i];
		$pv->Fields['areaid']=$ids[$i];
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();
    }
  
    return $artlist;
}

 ?>
