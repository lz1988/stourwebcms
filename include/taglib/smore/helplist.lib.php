<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取帮助列表标签
 *
 * @version        $Id: helplist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


 
require_once(SLINEINC.'/view.class.php');

function lib_helplist(&$ctag,&$refObj)
{
    global $dsql;
    include(SLINEDATA."/webinfo.php");
    $attlist = "row|5,helpkindid|,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	

    $innertext = trim($ctag->GetInnerText());    $artlist = '';
    $helpkindid=isset($refObj->Fields['helpkindid']) ? $refObj->Fields['helpkindid']:''; //针对指定kindid只查询一个分类的信息.

	$typeid=isset($refObj->Fields['typeid']) ? $refObj->Fields['typeid']:'0';
    
    if($innertext=='') return '';
   
    //获得类别ID总数的信息
    $ids = array();
	$kindnames=array();

	if($flag == 'all')
	{
		$sql="select id,kindname,litpic from #@__help_kind where webid=0 and isopen=1 order by displayorder asc";
	}
	else
	{
		if($helpkindid=='')
	    {
		  $sql="select id,kindname,litpic from #@__help_kind where webid=0 and isopen=1 order by displayorder asc limit 0,{$row}";
		}
		else
		{
		  $sql="select id,kindname,litpic from #@__help_kind where webid=0 and isopen=1 and id=$helpkindid order by displayorder asc limit 0,{$row}";
		}
		
	}

    $dsql->SetQuery($sql);
    $dsql->Execute();
    while($row = $dsql->GetArray()) 
	{
        $ids[] = $row['id'];
		$kindnames[]= $row['kindname'];//获取帮助分类名称
		$imgsrc[]=$row['litpic'];

    }

    if(!isset($ids[0])) return ''; //如里分类不存在则退出

  
    for($i=0;isset($ids[$i]);$i++)
    {
       
        $pv = new View($typeid);
		
		if($imgsrc[$i]!='')
		{
			$kindname="<img src=\"{$imgsrc[$i]}\" alt=\"{$kindnames[$i]}\">";
			
	    }
		else
		{
		    $kindname = $kindnames[$i];	
		}
		$url = $GLOBALS['cfg_base_url']."/help/index_{$ids[$i]}.html";
		$pv->Fields['kindname']=$kindname;
        $pv->Fields['helpkindname'] = $kindnames[$i];
		$pv->Fields['ids']=$ids[$i];
		$pv->Fields['id']=$ids[$i];
		$pv->Fields['sonid']=$ids[$i];
		$pv->Fields['url'] = $url;
        $pv->Fields['litpic']=$imgsrc[$i];
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();
    }
  
    return $artlist;
}

 ?>
