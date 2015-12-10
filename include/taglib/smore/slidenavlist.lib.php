<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 左侧导航分类调用
 *
 * @version        $Id: slidenavlist.lib.php 1 9:29 2012.07.25 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
require_once(SLINEINC.'/view.class.php');
function lib_slidenavlist(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|20,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = trim($ctag->GetInnertext());
	$revalue='';

	$sql="select id,linkurl,kindname,litpic,remark,color from #@__plugin_leftnav where pid=0 and isopen=1  order by displayorder asc limit 0,{$row}";
   
	 $kindnames=array();
	 $ids=array();
	 $linkurls=array();
	 $litpics=array();

	 $arr=$dsql->getAll($sql);
	 for($i=0;isset($arr[$i]['id']);$i++)
	 {

		$id=$arr[$i]['id'];
         $kindname = !empty($arr[$i]['color']) ? '<font color="'.$arr[$i]['color'].'">'.$arr[$i]['kindname'].'</font>' : $arr[$i]['kindname'];
		//$kindname=$arr[$i]['kindname'];
		$linkurl=$arr[$i]['linkurl'];
		$litpic = $arr[$i]['litpic'];
		$remark = $arr[$i]['remark'];
		 array_push($ids,$id);	
	     array_push($kindnames,$kindname);
	     array_push($litpics,$litpic);
	     array_push($remarks,$remark);
		 array_push($linkurls,$linkurl);

     }

	$GLOBALS['autoindex']=0;
    for($k=0;isset($ids[$k]);$k++)
    {
      $GLOBALS['autoindex']++;
	  $pv = new View(0);
	  $pv->Fields['kindname']=$kindnames[$k];
	  $pv->Fields['url']=$linkurls[$k];
	  $pv->Fields['kindid']=$ids[$k];
	  $pv->Fields['litpic']=$litpics[$k];
	  $pv->Fields['remark']=$remarks[$k];
      $pv->SetTemplet($innertext,'string');
      $revalue .= $pv->GetResult();
    }
    return $revalue;
}

 



