<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取订单标签
 *
 * @version        $Id: getorderlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


 
require_once(SLINEINC.'/view.class.php');

function lib_getorderlist(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|5,flag|all,limit|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	//获取全部订单
	if($flag=='all')
	{
		$where = '';
	}
	else if($flag == 'line') //线路订单
	{
	   	$where = 'where typeid = 1';
	}
	else if($flag == 'hotel')
	{
	   	$where = 'where typeid = 2';
	}
	else if($flag == 'car')
	{
	   	$where = 'where typeid = 3';
	}
	else if($flag == 'spot')
	{
	   	$where = 'where typeid = 5';
	}
	else if($flag == 'visa')
	{
	   	$where = 'where typeid = 8';
	}
	else if($flag == 'tuan')
	{
	   	$where = 'where typeid = 13';
	}
	
	$sql="select * from #@__member_order {$where} order by addtime desc limit $limit,$row";
	$innertext = trim($ctag->GetInnertext());
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$revalue='';
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
		$row['nickname'] = getNickName($row['memberid']); //昵称
		$row['dingtime'] = Helper_Archive::formatAddTime($row['addtime']); //预订时间
		$row['productname'] = getProName($row['productautoid'],$row['typeid'],$row['productname']);
        foreach($ctp->CTags as $tagid=>$ctag)
        {
			if($ctag->GetName()=='array')
			{
					$ctp->Assign($tagid, $row);
			}
			else
			{
				if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 
			}
        }
      	$revalue .= $ctp->GetResult();
    }

    return $revalue;
}

//获取会员名
function getNickName($mid)
{
	Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__member');
	$membername = $model->getField('nickname',"mid='$mid'");
	return $membername ? $membername : '匿名';
	
}
//获取产品名称
function getProName($id,$typeid,$productname='')
{
	global $dsql;
	$channeltable=array(
	  "1"=>"#@__line",
	  "2"=>"#@__hotel",
	  "3"=>"#@__car",
	  "5"=>"#@__spot",
	  "8"=>"#@__visa",
	  "13"=>"#@__tuan");
	$tablename = $channeltable[$typeid];
	$fields=array(
	  '1'=>array('field'=>'title','link'=>'lines'),
	  '2'=>array('field'=>'title','link'=>'hotels'),
	  '3'=>array('field'=>'title','link'=>'cars'),
	  '5'=>array('field'=>'title','link'=>'spots'),
	  '8'=>array('field'=>'title','link'=>'visa'),
	  '13'=>array('field'=>'title','link'=>'tuan')
	  
	  );
	 $field = $fields[$typeid]['field'];
	 $link =$fields[$typeid]['link'];
	$sql = "select aid,{$field} as title from {$tablename} where id='$id'";
	$row = $dsql->GetOne($sql);
	$title = !empty($productname) ? $productname : $row['title'];
	$out = "<a href=\"{$GLOBAL['cfg_basehost']}/{$link}/show_{$row['aid']}.html\" target=\"_blank\">{$title}</a>";
	return $out;
	
}

 ?>
