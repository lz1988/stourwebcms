<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

/**
 * 属性分类调用标签与attrgrouplist配合使用.
 *
 * @version        $Id: getattrbygroup.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 require_once(SLINEINC.'/view.class.php');

function lib_getattrbygroupid(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|80,typeid|,groupname|,groupid|,filterid|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    
	$attrtable=array('1'=>'#@__line_attr','2'=>'#@__hotel_attr','3'=>'#@__car_attr','4'=>'#@__article_attr','5'=>'#@__spot_attr','6'=>'#@__photo_attr','11'=>'#@__jieban_attr','13'=>'#@__tuan_attr');
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$typeid = empty($typeid) ? $refObj->Fields['typeid'] : $typeid;
	$tablename=isset($attrtable[$typeid]) ? $attrtable[$typeid] : '#@__model_attr';
    $w = !empty($filterid) ? " and id not in($filterid)" : '';//排除不要的项
    $w.= $typeid>13 ? " and typeid=$typeid" : '';//如果是扩展模块,则增加typeid判断
	if(!empty($groupname)) //通过组名获取
	{
	 $sql="select id from {$tablename} where  attrname='$groupname' $w";
	 $row=$dsql->GetOne($sql);
	 if(is_array($row))
	 $pid=$row['id'];
	}
	else //与attrgrouplist搭配使用
	{
	   $pid =empty($groupid)?$refObj->Fields['attrid']:$groupid;	
	}
	if(empty($pid))return;
	$sql="select id,attrname from {$tablename} where pid='$pid' {$w} order by displayorder asc limit 0,{$row}";
    $dsql->SetQuery($sql);
    $dsql->Execute();


    while($row = $dsql->GetArray()) 
	{
	   //if(isHasAttr($row['id'],$tablename,$kindid))
	   {
	     $groupids[] = $row['id'];
		 $groupnames[]=$row['attrname'];//获取组名
	   }
    }


    if(!isset($groupids[0])) return ''; //如里不存在则退出

    $GLOBALS['itemindex']=0;

    for($i=0;isset($groupids[$i]);$i++)
    {

        $GLOBALS['itemindex']++;

        $pv = new View(0);

		$pv->Fields['groupname']=$groupnames[$i];

		$pv->Fields['groupid']=$groupids[$i];
		$pv->Fields['attrid']=$groupids[$i];
		$pv->Fields['typeid']=$typeid;
      
        $pv->SetTemplet($innertext,'string');

        $artlist .= $pv->GetResult();

    }
    return $artlist;
    
}



