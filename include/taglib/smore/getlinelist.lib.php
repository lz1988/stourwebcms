<?php

if(!defined('SLINEINC'))

{

    exit("Request Error!");

}

/**

 * 调用线路数据标签

 *

 * @version        $Id: getlinelist.lib.php netman

 * @package        Stourweb.Taglib

 * @copyright      Copyright (c) 2008 - 2014, Stourweb, Inc.

 * @link           http://www.stourweb.com

 */

 

/* >>sline>>

<name>按类型读取线路列表</name>

<demo>

{sline:getlinelist row=5,flag='recommend'}

  <a href='[field:url/]'>[field:linename/]</a>

{/sline:getlinelist}

   

	

	<iterm>row:记录条数</iterm>

	

	<iterm>type:顶级栏目或者子栏目(top,son)</iterm>

	

	<iterm>flag:recommend:推荐线路 specials:特价线路 hot:热点线路</iterm>

	

	<iterm>sonid:子栏目id,当type=son时此项必须设置</iterm>

</demo>



>>sline>>*/

 



function lib_getlinelist(&$ctag,&$refObj)

{

	global $startcity;

    global $dsql;

	include(SLINEDATA."/webinfo.php");

    $attlist="row|8,flag|,type|top,sonid|,limit|0,";

    FillAttsDefault($ctag->CAttribute->Items,$attlist);

    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $webid=0;

    $innertext = trim($ctag->GetInnertext());

    $revalue = '';

	$basefield = "a.aid,a.id,a.webid,a.title,a.seotitle,a.sellpoint,a.litpic,a.storeprice,a.price,a.linedate,a.features,a.transport,a.lineday,a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount,a.attrid,a.kindlist,a.color,a.iconlist";

	

	

	

    if($type=='top' && empty($flag)) return '';

	//如果调用二级栏目则必须在显示类里指定sonid

	$limit=!empty($limit)?$limit:0;

	if($type=='startcity')

	{

		$sql="select  {$basefield} from #@__line as a left join #@__kindorderlist as c on (a.id=c.aid) where a.ishidden=0 and c.typeid=1 and startcity='{$startcity}' and c.classid=$sonid and FIND_IN_SET($sonid,a.kindlist) {$orderby}  limit {$limit},{$row}";

	}

	if($type=='mdd') //指定目的地时关联文章调用.

	{

	   if($flag=='hot')

	   {

		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc';

	   }

	   else if($flag=='recommend')

	   {

		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc';

	   }

	   else if($flag=='specical')

	   {

		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc ';

	   }

	   else

	   {

		   $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc';

	   }

	   $sonid=isset($definekind) ? $definekind : $refObj->Fields['kindid'];

       //这里增加子站的判断

        if($GLOBALS['sys_child_webid']!=0)

        {

            $dest_id = $GLOBALS['sys_child_webid'];

        }

       $sonid = $sonid ? $sonid : $dest_id;

	   $shownum=isset($row) ? $row : $refObj->Fields['shownum'];

	   $shownum = empty($shownum) ? 6 : $shownum;





	   if(isset($sonid))

	   {



			$number=isset($refObj->Fields['shownumber']) ? $refObj->Fields['shownumber'] : $row;//如果模块设置了显示数量则使用.

			$sql="select {$basefield},c.isjian,c.istejia,c.isding  from #@__line as a left join #@__kindorderlist as c on (c.classid=$sonid and a.id=c.aid  and c.typeid=1) where a.ishidden=0 and  FIND_IN_SET($sonid,a.kindlist) {$orderby}  limit {$limit},{$shownum}";







	   }



	   else return '';

	}

	//搜索页面推荐.

	else if($type=='searchrec')

	{

		if($GLOBALS['childid']!=0)

		{

		  $kchild=$GLOBALS['childid'];

		  $sql="select  distinct {$basefield}  from #@__line as a left join #@__kindorderlist as c on (c.classid=$kchild and a.id=c.aid  and c.typeid=1) where a.ishidden=0 and c.isjian=1 and FIND_IN_SET($kchild,a.kindlist) order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc  limit 0,4";

		}

		else

		{

		   $sql="select {$basefield} a from #@__line where a.ishidden=0 and a.isjian=1  order by a.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

		

		}

	

	}

	//目的地推荐

	else if($type=='destsearchrec')

	{

		if($GLOBALS['destid']!=0)

		{

		  $kchild=$GLOBALS['destid'];

		  $sql="select {$basefield} from #@__line as a left join #@__kindorderlist as c on (c.classid=$kchild and a.id=c.aid  and c.typeid=1) where  a.ishidden=0 and FIND_IN_SET($kchild,a.kindlist) {$orderby}  limit 0,4";

		}

		else

		{

		   $sql="select {$basefield} from #@__line a where a.ishidden=0 and a.isjian=1  order by a.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

		

		}

	

	}

	

	

	//普通调用

	else if($type=='top')

	{

	   

		if($flag=='recommend') //排序规则:置顶》排序》最新更新

		{

		    $sql="select {$basefield},b.isding,b.istejia,b.displayorder from #@__line as a left join #@__allorderlist b on (a.id=b.aid and b.typeid=1) where a.ishidden=0 order by case when b.displayorder is null then 9999 end, b.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

		}

		else if($flag=='specical')

		{

		  

		    $sql="select {$basefield},b.isding,b.istejia,b.displayorder from #@__line as a left join #@__allorderlist b on (a.id=b.aid and b.typeid=1) where a.ishidden=0 order by b.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

		}

		else if($flag=='hot')

		{

		   $sql="select {$basefield} from #@__line a where a.ishidden=0  order by a.shownum desc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

		   

		}

		else if($flag=='attribute')

		{	

			if(empty($attrid)){

				$attrid=$refObj->Fields['attrid'];

			}

		   	$sql="select {$basefield} from #@__line a where FIND_IN_SET('$attrid',a.attrid) and a.ishidden=0  order by a.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

			

		}

		else if($flag=='relative')

		{

		   

		   $kindlist=$refObj->Fields['kindlist'];

		   $maxkindid=array_remove_value($kindlist);//最后一级.
           $maxkindid=empty($maxkindid)?$GLOBALS['dest_id']:$maxkindid;

		   $maxkindid = empty($maxkindid) ? 0 : $maxkindid;

		   $where=" FIND_IN_SET($maxkindid,a.kindlist) ";


		   $sql="select {$basefield} from #@__line a where {$where} and a.ishidden=0 order by a.shownum desc,a.modtime desc,a.addtime desc limit 0,{$row}";

		}

		else if($flag=='listexcept')

		{

			$sql="select aid from #@__line where isjian=1 and a.ishidden=0 order by isjian desc,displayorder asc limit 0,5";

			$dsql->Execute("list",$sql);

			$a="";

			 while($str=$dsql->GetArray("list"))

			 {    

				 $a.=$str["aid"].",";

			 }

			 $a=substr($a,0,-1);

			 if(!$a=="")

			 {

				$a="and aid not in ($a)";

			 }

			$sql="select {$basefield} from #@__line a where {$a} order by  a.shownum desc limit {$limit},{$row}";

			

			};

    }

	

	else if($type=='theme')

	{

	   	$themeid=$refObj->Fields['themeid'];

		if(empty($themeid))return '';

		$sql="select {$basefield} from #@__line a where a.ishidden=0 and FIND_IN_SET($themeid,a.themelist) order by a.modtime desc,a.addtime desc limit 0,{$row}";

		

	}

	else if($type="day")

	{

		$dayid=$refObj->Fields['groupid'];

		if(empty($dayid))return '';

		$sql="select {$basefield} from #@__line a where a.ishidden=0 and a.lineday=$dayid order by a.modtime desc,a.addtime desc limit 0,{$row}";

		

	}
		



    $dsql->SetQuery($sql);

    $dsql->Execute();

    $ctp = new STTagParse();

    $ctp->SetNameSpace("field","[","]");

    $ctp->LoadSource($innertext);

    $GLOBALS['autoindex'] = 0;

	$num=0;

    while($row = $dsql->GetArray())

    {

        $GLOBALS['autoindex']++;

		$webroot=GetWebURLByWebid($row['webid']);

		$url= $webroot . "/lines/show_{$row['aid']}.html";;

		$row['url']= $url;

		$row['bookurl']= "{$webroot}/lines/booking_{$row['aid']}.html";

        $startcity = getStartCityName($row['startcity']);

        $startcity = !empty($startcity) ? "[{$startcity}出发]" : '';

        if(!empty($GLOBALS['cfg_startcity_open']))

        {

            $row['title']="{$startcity}{$row['title']}";

        }

        else

        {

            $row['title']="{$row['title']}";

        }





        $row['startcity']=$startcity;

        $row['color'] = !empty($row['color']) ? "color:{$row['color']}" : '';

		$real=getLineRealPrice($row['aid'],$row['webid']);

		$row['lineprice']=$real ? $real : $row['price'];

		

		$row['commentnum']=Helper_Archive::getCommentNum($row['id'],1); //评论次数

		$row['sellnum']=Helper_Archive::getSellNum($row['id'],1); //销售数量

		//$row['satisfyscore']=Helper_Archive::getSatisfyScore($row['id'],1); //满意度

        //获取后台满意度拼接%

        $row['satisfyscore'] = !empty($row['satisfyscore'])?$row['satisfyscore']."%" : "";

		

		if(!empty($row['lineprice'])&&!empty($row['storeprice']))

		   $row['discount']=abs((int)$row['storeprice']-(int)$row['price']);

		 else

		   $row['discount']=0; 

		 

	

		$row['price'] = empty($row['lineprice'])?'<span class="rmb_1">电询</span>':"<span class='rmb_1'>&yen;</span><span class='rmb_2'>".$row['lineprice'].'</span>';

        $row['price2'] = empty($row['lineprice'])?'<span>电询</span>' : '<span>&yen;</span><strong>'.$row['lineprice'].'</strong><i>起</i>';



        $row['agentprice'] = intval($row['storeprice']);

		

		$row['sellprice'] = empty($row['lineprice'])?'0':$row['lineprice']; //没有HTML标识的价格

		

		$row['storeprice']=!empty($row['storeprice'])?"<span class=\"rmb_2\">&yen;</span>".$row['storeprice']:"<span class=\"rmb_1\">电询</span>";





		

		$row['lineseries']=getSeries($row['id'],'01');

		//$row['lit240']=getPicByName($row['linepic'],'lit240');

		//$row['lit160']=getPicByName($row['linepic'],'lit160');

		

		$row['litpic']=getUploadFileUrl($row['litpic']);

		$row['lit240']=getUploadFileUrl(str_replace('litimg','lit240',$row['litpic']));

		$row['lit160']=getUploadFileUrl(str_replace('litimg','lit160',$row['litpic']));

        $row['jifentprice'] = !empty($row['jifentprice']) ? '&yen;'.$row['jifentprice'] : '无';

        $row['startdate'] = getLine_StartDate($row);//团期

        $row['jifentprice'] = MLine::getMinTprice($row['id']);



		$row['list']=$num;



		

        foreach($ctp->CTags as $tagid=>$ctag)

        {

                if($ctag->GetName()=='array')

                {

                        $ctp->Assign($tagid, $row);

                }

                else

                {

                   $ctp->Assign($tagid,$row[$ctag->GetName()]); 

                }

        }

        $revalue .= $ctp->GetResult();
		

    }
		

    return $revalue;

}



//新增线路处理函数

//处理出发日期列表和出发日期下拉选择

function getLine_StartDate($row)

{

    global $dsql;

    $today=time();

    $montharr=getMonthPrice_List($row['id']);



    $monthstr='';

    $monthli='';

    $curday=(int)date('d',$today);

    if(empty($montharr))

    {

        $monthstr=empty($row['linedate'])?'电询' : $row['linedate'];

    }

    else

    {

        //$monthstr=!empty($montharr)? date('m').'月':'';

        foreach($montharr as $key=>$value)

        {



            $monthstr.=$key.'、';

            $weekday=date('w',strtotime(date('Y',$today).'-'.$key));



        }

        if(!empty($monthstr))

        {

            $monthstr=trim($monthstr,'、');

            $monthstr.='日,';

        }



    }

    return $monthstr;



}

//获取最近报价

function getMonthPrice_List($lineid)

{

    global $dsql;



    $time = time();

    $sql = "select * from #@__line_suit_price where lineid='$lineid' and day>{$time} order by day asc limit 0,9";





    $arr = $dsql->getAll($sql);

    $monthprice=array();





    foreach($arr as $row)

    {

        $key = date('m-d',$row['day']);

        $monthprice[$key]=$row['adultprice'];





    }





    return $monthprice;



}



//获取出发城市



function getStartPlace($placeid)

{

    global $dsql;

    $sql = "select cityname from #@__startplace where id='$placeid'";

    $row = $dsql->GetOne($sql);

    return !empty($row['cityname']) ? '['.$row['citname'].']' : '';

}



class MLine {



    public static function getMinTprice($lineid)

    {

        global $dsql;

        $sql = "select min(jifentprice) as price from sline_line_suit where lineid='$lineid'";

        $row = $dsql->GetOne($sql);

        return $row['price'] ? $row['price'] : 0 ;



    }





}

