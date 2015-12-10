<?php
if(!defined('SLINEINC'))
{
   exit("Request Error!");
}
/**
 * 调用车务信息数据标签
 *
 * @version        $Id: getcarlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
 

//require_once("carfun.php");
function lib_getcarlist(&$ctag,&$refObj)
{
	
    global $dsql,$sys_webid;	
	include(SLINEDATA."/webinfo.php");
	
	$attlist="row|8,limit|0";
	FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = $ctag->GetInnerText();
	$dtp2 = new STTagParse();
    $dtp2->SetNameSpace('field','[',']');
    $dtp2->LoadSource($innertext);
		//加目的地页面显示条件
	$destwhere=(isset($refObj->Fields['kindid'])) ? "and FIND_IN_SET({$refObj->Fields['kindid']},a.kindlist) " : ''; 
	if($type=='mdd') 
	{
        $pid=$refObj->Fields['kindid'];
        //这里增加子站的判断
        if($GLOBALS['sys_child_webid']!=0)
        {
            $dest_id = $GLOBALS['sys_child_webid'];
        }
        $pid = $pid ? $pid : $dest_id;

        $sqlstr = "select a.* from sline_car a left join sline_kindorderlist b on (a.id=b.aid and b.typeid=3) where find_in_set($pid,a.kindlist) order by case when a.displayorder is null then 9999 end asc limit $limit,$row";

			
		
	}
	else if($type=='kind')
	{
			$kindid = $refObj->Fields['kindid'];
			$sqlstr="select distinct a.id, a.*,b.minprice  from #@__car a left join(select min(price) as minprice,carid from #@__car_suit group by carid) as b on a.id=b.carid left join #@__kindorderlist as c on (a.id=c.aid  and c.typeid=3) where a.carkindid = $kindid and a.webid=0 group by a.title order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc limit $limit,$row";
	}
	else if($type=='theme')
	{
		      $themeid=$refObj->Fields['themeid'];
		      if(empty($themeid))return '';
			  $sqlstr="select a.*,b.minprice,c.kindname as brand,d.kindname as kind   from #@__car a left join (select min(price) as minprice,carid from #@__car_suit group by carid) as b on a.id=b.carid left join #@__car_brand c on c.aid=a.carbrandid and a.webid=c.webid left join #@__car_kind d on d.aid=a.carkindid and a.webid=d.webid where a.ishidden=0 and a.webid=0 and FIND_IN_SET($themeid,a.themelist) order by a.modtime desc,a.addtime desc limit $limit,$row";
		
		
	}
	else
	{
	  switch($flag)
	  {
		  case 'hot'://热门?暂时以istop排序？ 查询a结果可以优化
          case 'recommend':
			  $sqlstr="select a.* from #@__car a left join sline_allorderlist b on (a.id=b.aid and b.typeid=3) where a.ishidden=0 and a.webid='{$GLOBALS['sys_child_webid']}'  order by ifnull(b.displayorder,9999) asc, a.addtime desc,a.modtime desc limit $limit,$row";

		  break;

		  case 'listofkind':
			  $pid=$refObj->Fields['sonid'];
			  $getmonth=GetMonthHandle();
			  $sqlstr="select a.*,b.minprice   from #@__car a left join (select min(price) as minprice,carid from #@__car_suit group by carid) as b on a.id=b.carid  where FIND_IN_SET($pid,kindlist) and a.webid=0 order by a.modtime desc,a.addtime desc limit $limit,$row";
			  
			  break;
		  case 'relative':
			 $tagword=isset($refObj->Fields['tagword'])?$refObj->Fields['tagword']:''; //获取指定tagword
			 if($tagword=='') return '';
			  $tagword=explode(",",$tagword);
			  $i=1;
			  $where='';
			  foreach($tagword as $key=>$value)
			   {
				   if($i==1)
					{
					  $where.="a.tagword like '%$value%'";
					}
					 else
					 {
					   $where.="or a.tagword like '%$value%'";
					 }
					 $i++;
			   }
			   $getmonth=GetMonthHandle();//排序顺序：置顶+tag关联》排序+ tag关联》最新更新+tag关联
			  $sqlstr="select a.*,b.minprice,c.kindname as brand,d.kindname as kind   from #@__car a left join (select min(price) as minprice,carid from #@__car_suit group by carid) as b on a.id=b.carid left join #@__car_brand c on c.aid=a.carbrandid and c.webid=a.webid left join #@__car_kind d on d.aid=a.carkindid and d.webid=a.webid  where  {$where} and a.ishidden=0 and a.webid=0  order by a.modtime desc,a.addtime desc limit $limit,$row";
			   
		  break;
		  
		  
	  }
	}

	if(empty($sqlstr)) return '';
    $dsql->SetQuery($sqlstr);
    $dsql->Execute();
    $totalRow = $dsql->GetTotalRow();
	$likeType='';
    $GLOBALS['autoindex'] = 0;//??

	for($i=0;$i < $totalRow;$i++)
    {
         $GLOBALS['autoindex']++;
         if($tablerow=$dsql->GetArray())
		 {
             $url = GetWebURLByWebid($tablerow['webid']);
			 $tablerow['url'] = $url."/cars/show_{$tablerow['aid']}.html";;
			 $tablerow['title']=$tablerow['title'];
			

			 $tablerow['lit240'] = getUploadFileUrl(str_replace('litimg','lit240',$tablerow['litpic']));
			 $tablerow['lit160'] = getUploadFileUrl(str_replace('litimg','lit160',$tablerow['litpic']));
			 $tablerow['litpic'] = getUploadFileUrl($tablerow['litpic']);

             $real=getCarNewRealPrice($tablerow['aid'],$tablerow['webid']);

             $tablerow['minprice'] = $real ? $real : $tablerow['minprice'];
             $tablerow['sellprice'] = $real ? $real : 0;
             
			 $tablerow['price']=empty($tablerow['minprice'])?'电询':$tablerow['minprice'];
             $tablerow['price2']=empty($tablerow['minprice'])?'电询': '<span>&yen;</span><strong>'.$tablerow['minprice'].'</strong><i>起</i>';//目的地页面用
             if(is_array($dtp2->CTags))
			 {
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
			 $likeType.= $dtp2->GetResult();
         }
    }
	
    //Loop for $i
    $dsql->FreeResult();
	//print_r($likeType);
	return $likeType;
	

}
