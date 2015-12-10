<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
//加载线路
if($dopost == 'getlinelist')
{
	
	 $offset=($curpage-1)*$pagesize;
	 //  这里处理成目的地可多选的操作.
	 if(isset($dest_id) && !empty($dest_id))
	 {
		 $dest_id_arr = explode(',',$dest_id);
		 $j = 1;
		 foreach($dest_id_arr as $did)
		 {
		     $flag = $j==1 ? ' and ' : 'or';
			 $where.= " {$flag} FIND_IN_SET($did,a.kindlist)";
			 $j++;	 
		 } 
		 
	 }
	 if(!empty($priceid)&& $priceid!=0)
     {
       $pricearr=getMinMax($priceid);//取得价格范围的最小与最大值 .
       
       $where.=" and a.price >= {$pricearr['min']} and a.price <= {$pricearr['max']} ";
     }
	 //按名称搜索
	 if(!empty($searchkey)||($searchkey!=0))$where.=" and title like '%{$searchkey}%'";
    
	 if(!empty($attrlist))
	 {
	   $where.= getAttWhere($attrlist);	 
	 }
	 
	  $sql="select * from #@__line a where a.ishidden=0 {$where} ";
	  $sql.=" limit $offset,$pagesize";
	  debug($sql);
	  $arr=$dsql->getAll($sql);
	  $i=1;
	  $out='';
	  foreach($arr as $row)
	  {
			
			$percent=mt_rand(92,95).'%';
		
			
			$url=!empty($stdate) ? "/line/show_{$row['aid']}.html" : "/lines/show_{$row['aid']}.html";
			
			$real=getLineRealPrice($row['aid'],$row['webid']);
            $lineprice=!empty($real) ? $real : $row['price'];//线路报价
			$litpic = getUploadFileUrl($row['litpic']);
			$sellpoint = !empty($row['sellpoint']) ? $row['sellpoint'] : cn_substr(strip_tags($row['features']),200);
			$award2 = !empty($row['award2']) ? $row['award2'] : 0;//抵现
			$award3 = !empty($row['award3']) ? $row['award3'] : 0;//返现
			
			$css = 'bor_bot_0';
		    $out.='<div class="list_con">
          	<div class="list_pic">
            	<a class="fl" href="'.$url.'"><img class="fl" src="'.$litpic.'" width="150" height="115" title="'.$row['title'].'" alt="'.$row['title'].'" /></a>
            </div>
           	<div class="list_txt">
            	<p class="p1"><a href="'.$url.'" target="_blank">'.$row['title'].'</a></p>
              <p class="p2">线路特色：'.$sellpoint.'</p>
              <p class="p3">行程时间：'.$row['lineday'].' 天</p>
              <p class="p4">出团日期：'.$row['linedate'].'</p>
              <p class="p5">
              	<span>销量：<b>295</b>人已购买</span>
                <span>评论：<b>209</b>条评论</span>
                <span class="sp_star"><strong class="fl">满意度：</strong><b><s style=" width:80%"></s></b></span>
              </p>
            </div>
            <div class="list_price">
            	<p class="p1"><span>&yen;'.$lineprice.'</span>起</p>
              <p class="p2"><a href="'.$url.'" target="_blank">查看详情</a></p>
              <p class="p3">
              	<span class="sp_1"><b>'.$award3.'</b><s></s></span>
              	<span class="sp_2"><b>'.$award2.'</b><s></s></span>
              </p>
            </div>
          </div>';
			
			
				$i++;
		
	  }
	  $totalnum=getTotalNumber($sql);
	  $totalpage=ceil($totalnum/$pagesize);
	 
	    
	 //$out= preg_replace("/".$searchkey."/", "<font style='color:#f60'>".$searchkey."</font>", $out);
	  if(empty($out))
	  {
		  $out='<div class="nht_box" style="height:200px;width:960px; text-align:center"><img style="margin-top:40px" src="'.$cfg_templets_skin.'/images/nodata.jpg"/></div>';
		  
	  }
	  $data['list']=$out;
	  $data['pageinfo']=setPageInfo($curpage,$totalpage);
	  $data['total']=$totalnum;
	  $data['totalpage']=$totalpage;
	  //$data['rechotel']=$recHotel;
	  //array_push($data,$out,$pageinfo,$totalnum);
	  echo json_encode($data);
	
}

//获取线路价格范围
function getMinMax($priceid)
{
  global $dsql;
  $arr=array();
  $tablename='#@__line_pricelist';
  $arr['min']='';
  $arr['max']='';
  $sql="select lowerprice,highprice from {$tablename} where id=$priceid";
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  {
     $arr['min']=!empty($row['lowerprice'])?$row['lowerprice']:0;
	 $arr['max']=!empty($row['highprice'])?$row['highprice']:0;
  }
 
  return $arr;
	 
}

//分页信息

function setPageInfo($currentpage,$totalpage,$pagename='Search')
{
	
	
	$out.=' <p class="page_right"> ';
	
	//上一页
	if($currentpage > 1)
	{
		$out.=' <a class="prev" title="上一页" href="javascript:$.AjaxSearch.changePage(\'pre\');">上一页</a>';
	}
	
    //第一页
	if($totalpage > 1)
	{
		if($currentpage == 1 )
		{
		   $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="javascript:void(0);" class="current">1</a>&nbsp;';	
		}
		else
		{
		   	 $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="javascript:$.AjaxSearch.page(1);" >1</a>&nbsp;';	
		}
		
	}
	$out.= $totalpage >=1 ? '' : '';
	
	//是否显示省略号
    $out.= $currentpage-2 > 2 ? '<span class="point">...</span>&nbsp;' : '';
	
	//中间数字部分

      
		$list_len = 2;
        $total_list = $list_len * 2 + 1;
        if($currentpage >= $total_list)
        {
            $j = $currentpage-$list_len;
            $total_list = $currentpage+$list_len;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage-1;
            }
        }
        else
        {
            $j=2;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage-1;
            }
        }
        for($j;$j<=$total_list;$j++)
        {
            if($j==$currentpage)
            {
                $out.= '<a onclick="return false;" href="javascript:void(0);" class="current">'.$currentpage.'</a>&nbsp;';
            }
            else
            {
               $out.='<a title="'.$j.'" href="javascript:$.AjaxSearch.page('.$j.');">'.$j.'</a>&nbsp;';
            }
        }
	//结尾省略号
    if($totalpage-$currentpage > 2)
	{
	     $out.='<span class="point">...</span>&nbsp;';	
	}
	//最后一页
	if($totalpage > 1)
	{
		if($currentpage == $totalpage)
		{
			$out.='<a title="'.$totalpage.'" href="javascript:void" class="current">'.$totalpage.'</a></span>&nbsp;';
			
		}
		else
		{
		  $out.='<a title="'.$totalpage.'" href="javascript:$.AjaxSearch.page('.$totalpage.');">'.$totalpage.'</a></span>&nbsp;';
		}
	}
	//下一页
	if($currentpage < $totalpage)
	{
		$out.='<a class="next" title="下一页" href="javascript:$.AjaxSearch.changePage(\'next\');">下一页</a>';
	}
	
   $out.='</p>';
   
   return $out;
   
  
	
}