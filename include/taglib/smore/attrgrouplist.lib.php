<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 属性分类调用标签
 *
 * @version        $Id: attrgrouplist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

require_once(SLINEINC.'/view.class.php');

function lib_attrgrouplist(&$ctag,&$refObj)
{

    global $dsql;

    $attlist="row|8,flag|,filterid|";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);

    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnerText());

    $artlist = '';

    $typeid = $typeid ? $typeid : $refObj->Fields['typeid'];
    if(empty($typeid)) return '';

	$tablearr=array('1'=>'#@__line_attr','2'=>'#@__hotel_attr','3'=>'#@__car_attr','4'=>'#@__article_attr','5'=>'#@__spot_attr','6'=>'#@__photo_attr','11'=>'#@__jieban_attr','13'=>'#@__tuan_attr');

    $tablename=isset($tablearr[$typeid]) ? $tablearr[$typeid] : '#@__model_attr';

   
    if($innertext=='') return '';

   

    //获得类别ID总数的信息

    $groupids = array();

	$groupnames=array();
	
	$w = !empty($filterid) ? " and id not in($filterid)" : '';//排除不要的项
    $w.= $typeid>13 ? " and typeid=$typeid" : '';//如果是扩展模块,则增加typeid判断

    $dest_id = $GLOBALS['dest_id'] ? $GLOBALS['dest_id'] : 0;
    if($flag =='bydestid')//按目的地读取属性组
    {
        $w.= !empty($dest_id) ? " and FIND_IN_SET($dest_id,destid)" : '';

    }

	$sql="select id,attrname as groupname from {$tablename} where pid=0 and isopen=1 {$w} order by displayorder asc limit 0,$row" ;
	

    $dsql->SetQuery($sql);

    $dsql->Execute();

    while($row = $dsql->GetArray()) 
	{
	   //if(isHasAttr($row['id'],$tablename,$kindid))
	   {
	     $groupids[] = $row['id'];
		 $groupnames[]=$row['groupname'];//获取组名
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



//获得数量和访问值.

	function isHasAttr($groupid,$tablename,$kindid)

	{

	  global $dsql;
	  $flag=0;
	  $sql="select id from {$tablename} where pid='$groupid' and isopen=1  ";
	  
	  $dsql->SetQuery($sql);

      $dsql->Execute('chlist');

      while($res = $dsql->GetArray('chlist')) 
	  {
		 //if(groupAttCheck($res['id'],$kindid))
		 {

		    $flag=1;

			break;	 

		 }
      }

	

	  return $flag;

	}

	function groupAttCheck($id,$kindid)
	{

		global $dsql;

		$flag=0;

		$where=$kindid!=0 ? " and FIND_IN_SET($kindid,kindlist) " : '';

		$sql="select 1 from #@__line where FIND_IN_SET($id,attrid) $where limit 1";

		$flag=$dsql->ExecuteNoneQuery2($sql);
	    return $flag;


	}



 ?>