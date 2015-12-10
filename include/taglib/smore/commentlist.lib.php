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

function lib_commentlist(&$ctag,&$refObj)
{

    global $dsql;

    include(SLINEDATA."/webinfo.php");

    $attlist="row|8,flag|,typeid|1,limit|0";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);

    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnerText());

   
    if($innertext=='') return '';

     
	 $id=$refObj->Fields['commenthomeid'];
	 $pageno=$refObj->Fields['commentpage'];
	 $pageno=empty($pageno)?1:$pageno;
	 if(empty($id)||empty($typeid))
	   return '';
	 $offset=($pageno-1)*$row;
	 
	 $sql="select * from #@__comment where articleid='$id' and typeid='$typeid' and pid=0 and isshow=1 order by addtime desc limit $offset,$row";
	 
	 
	      
     $result=$dsql->getAll($sql);
      
	

     $GLOBALS['itemindex']=0;
    foreach($result as $k=>$row)
    {

        $GLOBALS['itemindex']++;
        $pv = new View(0);
		
		$userinfo=$GLOBALS['User']->getInfoByMid($row['memberid']);
		$row['litpic']=$userinfo['litpic'] ? $userinfo['litpic'] : '/templets/smore/images/member_default.gif';
		$row['nickname']=empty($userinfo['nick'])?'匿名':$userinfo['nickname'];
		$row['commentid']=$row['id'];
		$row['articleid']=$id;
		
		foreach($row as $key=>$val)
		{
			$pv->Fields[$key]=$val;
		}
		
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();

    }
    return $artlist;

}



//获得数量和访问值.

	


 ?>