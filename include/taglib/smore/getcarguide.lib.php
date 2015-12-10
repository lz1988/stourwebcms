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

function lib_getcarguide(&$ctag,&$refObj)
{

    global $dsql;

    $attlist="row|8,flag|,limit|0";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);

    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnerText());

    $artlist = '';


	switch($flag)
    {
        
        case 'stylelist':
            $sqlstr="select * from #@__car_kind  order by displayorder asc";

        break;
        case 'brandlist':
            $sqlstr="select * from #@__car_brand where webid=0";
        break;
        
        case "pricerange":
            $sqlstr="select * from #@__car_pricelist where webid=0";
        
        break;      
    }
   
    //获得类别ID总数的信息

    $groupids = array();

	$groupnames=array();
	
    if(empty($sqlstr)) return '';
    $dsql->SetQuery($sqlstr);
    $dsql->Execute();

    while($row = $dsql->GetArray()) 
	{
	   //if(isHasAttr($row['id'],$tablename,$kindid))
	   {
	     $groupids[] = $row['id'];
		 $groupnames[]=$row['kindname'];//获取组名
	   }
    }



    if(!isset($groupids[0])) return ''; //如里不存在则退出

    $GLOBALS['itemindex']=0;

    for($i=0;isset($groupids[$i]);$i++)
    {

        $GLOBALS['itemindex']++;

        $pv = new View(0);

		$pv->Fields['groupname']=$groupnames[$i];

        $pv->Fields['kindid']=$groupids[$i];
		$pv->Fields['groupid']=$groupids[$i];
		$pv->Fields['attrid']=$groupids[$i];
      
        $pv->SetTemplet($innertext,'string');

        $artlist .= $pv->GetResult();

    }
    return $artlist;

}






 ?>