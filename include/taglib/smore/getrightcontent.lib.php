<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取右侧列表标签
 *
 * @version        $Id: getrightcontent.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

require_once(SLINEINC.'/view.class.php');

function lib_getrightcontent(&$ctag,&$refObj)
{
    global $dsql,$sys_webid;
    include(SLINEDATA."/webinfo.php");
    $attlist="pagename|index";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	$typeid=isset($refObj->Fields['typeid'])?$refObj->Fields['typeid']:0;//

	//if($typeid==0) return'';
	//if($pagename=="")return'';
	//$cloudlist="<div  id=\"search_right\"></div>"; //云搜索
    $webid = $GLOBALS['sys_child_webid'];
	$innertext=$cloudlist;
	$sql="select moduleids from #@__module_config where webid=$webid and shortname='$pagename' and typeid='$typeid'";
   
	$row=$dsql->GetOne($sql);
    

	if(is_array($row))
	{ 
	   $mids=explode(',',$row['moduleids']);//拆分
	   for($i=0;isset($mids[$i]);$i++)
	   {
		   $sql="select body from #@__module_list where aid='{$mids[$i]}' and webid=$sys_webid";
		   $dsql->SetQuery($sql);
		   $dsql->Execute();
		   while($arr=$dsql->GetArray())
		   {
			  $innertext.=$arr['body'];
		   }
	   }
    }
    $artlist = '';
   
    
    if($innertext=='') return '';//如里为空则退出

   
       $GLOBALS['itemindex']=0;
 
        $GLOBALS['itemindex']++;
        $pv = new View($typeid);
		$pv->Fields['tagword']=$refObj->Fields['tagword'];
		$pv->Fields['kindlist']=$refObj->Fields['kindlist'];
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();
   
  
    return $artlist;
}

 ?>
