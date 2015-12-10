<?php

if(!defined('SLINEINC'))

{

    exit("Request Error!");

}

/**

 * 调用酒店数据标签

 *

 * @version        $Id: gethotellist.lib.php netman

 * @package        Stourweb.Taglib

 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.

 * @link           http://www.stourweb.com

 */

 



 



function lib_gethotellist(&$ctag,&$refObj)

{

    global $dsql;

    $attlist="row|8,flag|,type|top,sonid|,limit|0";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);

    extract($ctag->CAttribute->Items, EXTR_SKIP);



    $innertext = trim($ctag->GetInnertext());

    $revalue = '';

	$basefield = 'a.id,a.sellpoint,a.aid,a.kindlist,a.title,a.address,a.litpic,a.ishidden,a.hotelrankid,a.webid,a.hotelrankid as hotelrankids,a.shownum,a.iconlist';

    if($type=='top' && empty($flag)) return '';

	//如果调用二级栏目则必须在显示类里指定sonid

	$limit=!empty($limit)?$limit:0;

	//加目的地页面显示条件

	$destwhere=(isset($refObj->Fields['kindid'])) ? "and FIND_IN_SET({$refObj->Fields['kindid']},a.kindlist) " : ''; //用于聚合页面

	if($type=='mdd')

	{  

	    $sonid=$refObj->Fields['kindid'];

        if($GLOBALS['sys_child_webid']!=0)

        {

            $dest_id = $GLOBALS['sys_child_webid'];//当前级目的地id.

        }

        $sonid = $sonid ? $sonid : $dest_id;



	    if(!isset($sonid)) return '';

		if($flag=='hot')

		{

		  $orderby='order by case when b.displayorder is null then 9999 end,b.displayorder asc';

		  

		}

		else if($flag=='recommend')

		{

		  $orderby='order by case when b.displayorder is null then 9999 end,b.displayorder asc';

		}

		else if($flag=='specical')

		{

		  $orderby='case when b.displayorder is null then 9999 end,b.displayorder asc';

		}

		else

		{

		  $orderby='order by case when b.displayorder is null then 9999 end,b.displayorder asc';

		}

        $orderby.=",a.modtime desc,a.addtime desc";

		

			$where = "FIND_IN_SET($sonid,a.kindlist)";

			$sql="select {$basefield},b.isding,b.isjian,b.istejia from #@__hotel a left join #@__kindorderlist as b on (a.id=b.aid and b.classid='$sonid' and b.typeid='2') where " . $where . " and (a.ishidden='0' or a.ishidden is null){$orderby} limit {$limit},{$row}";

	     

	}

	

	else if($type=='rank')

	{

	   if(isset($refObj->Fields['sonid']))

	   {

	        $sonid=$refObj->Fields['sonid'];

			$sql="select a.*,b.hotelrank from #@__hotel a left join #@__hotel_rank b on a.hotelrankid=b.aid  where a.webid=0 and a.hotelrankid={$sonid}   and a.ishidden='0' order by a.modtime desc,a.addtime desc limit {$limit},{$row}";

			

	   }

	   else return '';

	

	}

	

	else if($type=='rankhot')

	{

		$sql="select a.*,b.hotelrank from #@__hotel a left join #@__hotel_rank b on a.hotelrankid=b.aid where a.ishidden='0' order by a.shownum desc limit {$limit},{$row}";

	

	}

	//读取专题

	else if($type=='theme')

	{

		$themeid=$refObj->Fields['themeid'];

		if(empty($themeid))return '';

		$sql="select a.*,b.hotelrank,a.price as price from #@__hotel a left join #@__hotel_rank b on (a.hotelrankid=b.aid and a.webid=b.webid)  where a.ishidden='0' and FIND_IN_SET($themeid,a.themelist)  order by a.modtime desc,a.addtime desc,a.shownum desc limit {$limit},{$row}";

		

	}

	

	else if($type=='top')

	{

		

		

		if($flag=='recommend')

		{

		   $sql="select {$basefield},b.displayorder,b.isding,b.isjian,b.istejia,a.ishidden,a.price from #@__hotel a left join #@__allorderlist b on(a.id=b.aid and b.typeid=2)  where a.ishidden='0' order by case when b.displayorder is null then 9999 end,b.displayorder asc,a.modtime desc,a.addtime desc  limit {$limit},{$row}";

		 

		  

		}

		else if($flag=='special')

		{

			

		   $sql="select {$basefield},b.displayorder,b.isding,b.isjian,b.istejia as istehui,a.ishidden from #@__hotel a left join #@__allorderlist b on(a.id=b.aid and b.typeid=2)  order by case when b.displayorder is null then 9999 end,b.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

		}

		else if($flag=='hot')

		{

			

		   $sql="select a.*,b.hotelrank,a.price as price from #@__hotel a left join #@__hotel_rank b on (a.hotelrankid=b.aid and a.webid=b.webid)  where a.ishidden='0'   group by a.title order by a.shownum desc,a.modtime desc,a.addtime desc limit {$limit},{$row}";





		}

		else if($flag=='relative')

		{

		 

			 $kindlist=$refObj->Fields['kindlist'];

		     $maxkindid=array_remove_value($kindlist);//最后一级.
            $maxkindid=empty($maxkindid)?$GLOBALS['dest_id']:$maxkindid;
			 $maxkindid = empty($maxkindid) ? 0 : $maxkindid;

		     $where=" FIND_IN_SET($maxkindid,a.kindlist) ";

		   //排序顺序：置顶+tag关联》排序+ tag关联》最新更新+tag关联

		   $sql="select a.*,b.hotelrank from #@__hotel a left join #@__hotel_rank b on (a.hotelrankid=b.aid and a.webid=b.webid)  where  a.ishidden='0'  and {$where} order by a.modtime desc,a.addtime desc limit {$limit},{$row} ";

		

		}

		

		else return '';

    }



    $dsql->SetQuery($sql);

    $dsql->Execute();

    $ctp = new STTagParse();

    $ctp->SetNameSpace("field","[","]");

    $ctp->LoadSource($innertext);

    $GLOBALS['autoindex'] = 0;


		

    while($row = $dsql->GetArray())

    {

		$GLOBALS['autoindex']++;

		$urlname = GetPinyin($row['kindname']);

		$flag != "channel" ? $webroot=GetWebURLByWebid($row['webid']) : "";

		$row['url']=GetWebURLByWebid($row['webid'])."/hotels/show_{$row['aid']}.html" ;

		$row['title']=$row['title'];



		//$row['price']=empty($row['price'])?GetHotelMinPrice($row['webid'],$row['aid']):$row['price'];

		$row['kindname'] = getHotelKindCity2($row['kindlist']);

		$row['commentnum']=Helper_Archive::getCommentNum($row['id'],2); //评论次数

		$row['sellnum']=Helper_Archive::getSellNum($row['id'],2)+$row['bookcount']; //销售数量

		$row['satisfyscore']=Helper_Archive::getSatisfyScore($row['id'],2); //满意度

		$row['listingprice'] = getHotelSellPrice2($row['id']);//挂牌价

        $row['price'] = Helper_Archive::getHotelMinPrice($row['id']);

		$row['sellprice'] = empty($row['price']) ? '0' : $row['price'];

		$row['price2'] = empty($row['price'])?'电询': '&yen;'.$row['price'].'起'; //样式2

		$row['price3'] = empty($row['price'])?'电询': '<strong>&yen;'.$row['price'].'</strong><span>起</span>';

        $row['price4'] = empty($row['price'])?'电询': '<span>&yen;</span><strong>'.$row['price'].'</strong><i>起</i>';//目的地页面用

		$row['price']=empty($row['price'])?'<span class="rmb_1">电询</span>':"<span class='rmb_1'>&yen;</span>".$row['price']."<span>起</span>";



	

		$litpic=getUploadFileUrl($row['litpic']);

	    $row['lit240']=getUploadFileUrl(str_replace('litimg','lit240',$row['litpic']));

	    $row['lit160']=getUploadFileUrl(str_replace('litimg','lit160',$row['litpic']));

        $row['litpic']=$litpic;

		$row['typeurl'] = $GLOBALS['cfg_cmsurl'] . "/hotels/{$urlname}_{$row['id']}.html";

		

        foreach($ctp->CTags as $tagid=>$ctag)

        {

                if($ctag->GetName()=='array')

                {

                        $ctp->Assign($tagid, $row);

                }

                else

                {

				     

                    if(!empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 

					else $ctp->Assign($tagid,'');

                }

        }

        $revalue .= $ctp->GetResult();

		

    }

	



    return $revalue;

}





function getHotelMinPrice($webid,$hotelid)

{

	global $dsql;

 	$sql="select min(price) as minprice from #@__hotel_room where webid='{$webid}' and hotelid='{$hotelid}'";

	$row=$dsql->GetOne($sql);

	return $row['minprice'];





}



//取得酒店的挂牌价格

function getHotelSellPrice2($hotelid)

{

	global $dsql;

 	$sql="select min(price) as minprice,sellprice from #@__hotel_room where hotelid='{$hotelid}'";

	$row=$dsql->GetOne($sql);

	return intval($row['sellprice']);

}



//取得酒店的地址，按kindlist最大数值来取

function getHotelKindCity2($kindlist)

{

	global $dsql;

	if(empty($kindlist))

		return '';

 	$sql="select kindname from #@__destinations where id in ({$kindlist}) order by id desc";

	$row=$dsql->GetOne($sql);

	return $row['kindname'];

}