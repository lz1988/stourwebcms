<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取目的地列表标签
 *
 * @version        $Id: destlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


 
require_once(SLINEINC.'/view.class.php');

function lib_destlist(&$ctag,&$refObj)
{
    global $dsql;
    include(SLINEDATA."/webinfo.php");
    $attlist = "row|20,destid|,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	

    $innertext = trim($ctag->GetInnerText());    $artlist = '';
    $destid = isset($refObj->Fields['kindid']) ? $refObj->Fields['kindid'] : $destid; 
	
	$destid = empty($destid) ? 0 : $destid;
    
    if($innertext=='') return '';
	
	$tablename = '#@__destinations';
   
    //获得类别ID总数的信息
    $ids = array();
	$kindnames=array();
	$sql = "select id,kindname from {$tablename} where pid='$destid' and isopen=1 order by displayorder asc,pinyin asc";//获取下一级
	
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
		
		$pv->Fields['destname']=$kindnames[$i];
		$pv->Fields['parentid']=$ids[$i];
		$pv->Fields['kindid']=$ids[$i];
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();
    }

    return $artlist;
}

 ?>
