<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取评论
 *
 * @version        $Id: getcomment.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


 
require_once(SLINEINC.'/view.class.php');

function lib_getcommentlist(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|5,flag|all,type|comment,level|0,limit|0,isproduct|0";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	//$commenthomeid=$refObj->Fields['commenthomeid'];
	//根据aid来获取当前aid的评论
	//$commenthomeid=$refObj->Fields['aid'];


	//获取全部评论
	if($flag=='all')
	{
		$where = 'where typeid!=4 and typeid !=6';
	}
	else if($flag == 'line') //线路评论
	{
	   	$where = 'where typeid = 1';
		$commenthomeid=$refObj->Fields['id'];
	}
	else if($flag == 'hotel')
	{
	   	$where = 'where typeid = 2';
		$commenthomeid=$refObj->Fields['id'];
	}
	else if($flag == 'car')
	{
	   	$where = 'where typeid = 3';
		$commenthomeid=$refObj->Fields['id'];
	}
	else if($flag == 'spot')
	{
	   	$where = 'where typeid = 5';
        $commenthomeid=$refObj->Fields['id'];
	}
	else if($flag == 'visa')
	{
	   	$where = 'where typeid = 8';

		$commenthomeid=$refObj->Fields['id'];
	}
	else if($flag == 'tuan')
	{
	   	$where = 'where typeid = 13';
		$commenthomeid=$refObj->Fields['aid'];
	}
    else if($flag == 'tongyong')
    {
        $typeid = $refObj->Fields['typeid'];
        if(empty($typeid))return '';
        $where = "where typeid = $typeid";
    }
	
	if($level!=0)//好评产品
	{
	    $where.= " and level=$level";	
	}

	if(!empty($commenthomeid))
		$where.=' and articleid='.$commenthomeid;

    $where.=" and isshow=1 ";
	
	$sql="select * from #@__comment {$where}  order by addtime  desc limit $limit,$row";
	if($isproduct==1)
	{
       $sql="select * from #@__comment {$where} group by typeid,articleid order by addtime desc limit $limit,$row";
	}

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
        $awardinfo = getAwardInfo($row['orderid']);
        $row['jifentprice'] = $awardinfo['jifentprice'];
        $row['jifencomment'] = $awardinfo['jifencomment'];
        $row['jifenbook'] = $awardinfo['jifenbook'];
		$row['score'] = getScore($row); //分数
		$row['nickname'] = getMemberName($row['memberid']); //昵称
        $row['litpic']=getMemberPic($row['memberid']);
		$row['pltime'] = Helper_Archive::formatAddTime($row['addtime']); //评论时间
		$row['percent']=20*$row['score'].'%';
        $row['percent1']=20*$row['score1'].'%';
		$row['percent2']=20*$row['score2'].'%';
		$row['percent3']=20*$row['score3'].'%';
		$row['percent4']=20*$row['score4'].'%';

		$row['productname'] = $row['typeid']!='4' && $row['typeid']!='6'  ? getOrderName2($row['articleid'],$row['typeid'],'',$row['id']) : '';
        if($row['productname']=='')continue;

		$row['sellnum'] = getSellNum($row['productautoid']);//销售数量
        foreach($ctp->CTags as $tagid=>$ctag)
        {
			if($ctag->GetName()=='array')
			{
					$ctp->Assign($tagid, $row);
			}
			else
			{
				if( $row[$ctag->GetName()]) $ctp->Assign($tagid,$row[$ctag->GetName()]);
			}
        }
      	$revalue .= $ctp->GetResult();
    }

    return $revalue;
}

function getScore($row)
{
	$score_all = floatval($row['score1'])+floatval($row['score2'])+floatval($row['score3'])+floatval($row['score4']);
	$score = round($score_all/4,1);
	return $score;
	
	
}
//获取会员名
function getMemberName($mid)
{
	Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__member');
	$membername = $model->getField('nickname',"mid='$mid'");
	return $membername ? $membername : '游客';
	
}

//获取会员头像
function getMemberPic($mid)
{
    Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__member');
	$pic = $model->getField('litpic',"mid='$mid'");
    $pic = $pic ? $pic : '/templets/smore/images/member_default.gif';
    return $pic;

}

//获取产品名称
function getOrderName2($id,$typeid,$productname='',$commentid)
{

	global $dsql;
	$channeltable=array(
	  "1"=>"#@__line",
	  "2"=>"#@__hotel",
	  "3"=>"#@__car",
	  "5"=>"#@__spot",
	  "8"=>"#@__visa",
	  "13"=>"#@__tuan");
	$tablename = $typeid<14 ? $channeltable[$typeid] : '#@__model_archive';
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
     if($typeid>13)
     {
         $model_info = getExtendModelInfo($typeid);
         $link = $model_info['pinyin'];
         $field = 'title';

     }

	  $sql = "select aid,{$field} as title,webid from {$tablename} where id='$id'";
	  $row = $dsql->GetOne($sql);

    if(empty($row))
	{
		$sql_del="delete from #@__comment where id=$commentid";
		//$dsql->ExecuteNoneQuery($sql_del);
        return mysql_error();
	}

	$title = !empty($productname) ? $productname : $row['title'];
	
	$url=GetWebURLByWebid($row['webid']);
	$out = "<a href=\"{$url}/{$link}/show_{$row['aid']}.html\" target=\"_blank\">{$title}</a>";
	return $out;
	
}
//获取销售数量
function getSellNum($productautoid)
{
	Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__member_order');
	$num = $model->getCount("productautoid='$productautoid'");
	return $num ? $num : mt_rand(3,20) ;
	
}
//获取奖励信息
function getAwardInfo($orderid)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__member_order');
    $row = $model->getOne("id='$orderid'",null,'jifenbook,jifentprice,jifencomment');
    return $row;
}

//获取文章信息
function getArticleInfo2($id)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__article');
    $row = $model->getOne("id='$id'");
    return $row;
}

//获取扩展模型信息
function getExtendModelInfo($typeid)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__model');
    $row = $model->getOne("id='$typeid'");
    return $row;

}


 ?>
