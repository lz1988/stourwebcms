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

function lib_getarcattrlist(&$ctag,&$refObj)
{

    global $dsql;

    $attlist="row|8,flag|,filterid|";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);

    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnerText());

    $artlist = '';

    $sql="select * from #@__article_attr where isopen=1 and pid!=0 order by displayorder asc";
	if($flag=='mdd')
	{
		$sql="select a.*,count(b.id) as num from #@__article_attr as a inner join #@__article as b on find_in_set(a.id,b.attrid) where find_in_set($kindid,b.kindlist) group by a.id"; 
	}

   

    //获得类别ID总数的信息

    $groupids = array();

	$groupnames=array();
	

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

 ?>