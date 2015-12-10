<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");


//加载线路
if($dopost == 'gettuanlist')
{
	
	  $curpage=$curpage==0?1:$curpage;

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
	
	 //按名称搜索
	 if(!empty($searchkey)||($searchkey!=0))$where.=" and title like '%{$searchkey}%'";
	 
	
    
	 if(!empty($attrlist))
	 {
	   $where.= getAttWhere($attrlist);	 
	 }
	
	 
	  $sql="select * from #@__tuan a where 1=1 {$where} ";
	  $sql.=" limit $offset,$pagesize";
	 
	  $arr=$dsql->getAll($sql);
	  $i=1;
	  $out='';
	  foreach($arr as $row)
	  {
			
			$liclass=$i%2==0?'mr_rig_0':'';
		    $row['discount']=floor($row['price']/$row['sellprice']*100)/10; //折扣
			$row['enddatetime']=date('Y/m/d H:i:s',$row['endtime']); 
			$row['litpic']=empty($row['litpic'])?$cfg_df_img:$row['litpic'];
			$url=!empty($stdate) ? "/tuan/show_{$row['aid']}.html" : "/tuan/show_{$row['aid']}.html";
			
		    $out.='<li class="'.$liclass.'">
            	<h3><a href="/tuan/show_'.$row['aid'].'.html" target="_blank">'.$row['title'].'</a></h3>
              <div class="li_left">
              	<p class="p1"><span>'.$row['discount'].'</span>折</p>
                <p class="p2">
                	<span class="sp1 dao" id="tick'.$i.'"><strong class="RemainD"></strong>天<strong class="RemainH"></strong>时<strong class="RemainM"></strong>分<strong class="RemainS"></strong>秒</span>
                  <span class="sp2">原价：¥'.$row['sellprice'].'起</span>
				  <input type="hidden" class="ticktime" rel="tick'.$i.'" value="'.$row['enddatetime'].'"/>
                </p>
                <p class="p3"><span>¥'.$row['price'].'起</span><a href="#"><img class="fl" src="/templets/smore/images/buy_yd.png"></a></p>
              </div>
              <div class="li_rig"><a href="/tuan/show_'.$row['aid'].'.html" target="_blank"><img class="fl" src="'.$row['litpic'].'" width="325" height="190" alt="'.$row['title'].'" title="'.$row['title'].'"></a></div>
            </li>';
			
			
				$i++;
		
	  }
	  $totalnum=getTotalNumber($sql);
	  $totalpage=ceil($totalnum/$pagesize);
	 
	    
	 //$out= preg_replace("/".$searchkey."/", "<font style='color:#f60'>".$searchkey."</font>", $out);
	  if(empty($out))
	  {
		  $out='<div class="nht_box" style="height:100px;width:1210px; text-align:center"><img style="margin-top:40px" src="'.$cfg_templets_skin.'/images/nodata.jpg"/></div>';
		  
	  }
	  $data['list']=$out;
	  $data['pageinfo']=setPageInfo($curpage,$totalpage);
	  $data['total']=$totalnum;
	  $data['totalpage']=$totalpage;
	  //$data['rechotel']=$recTuan;
	  //array_push($data,$out,$pageinfo,$totalnum);
	  echo json_encode($data);
	
}


//分页信息

function setPageInfo($currentpage,$totalpage,$pagename='Search')
{
	
	
	$out.=' <p class="page_right"> ';
	
	//上一页
	if($currentpage > 1)
	{
		$out.=' <a class="prev" title="上一页" href="javascript:Tuan.'.$pagename.'.prevPage();">上一页</a>';
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
		   	 $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="javascript:Tuan.'.$pagename.'.page(1);" >1</a>&nbsp;';	
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
               $out.='<a title="'.$j.'" href="javascript:Tuan.'.$pagename.'.page('.$j.');">'.$j.'</a>&nbsp;';
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
		  $out.='<a title="'.$totalpage.'" href="javascript:Tuan.'.$pagename.'.page('.$totalpage.');">'.$totalpage.'</a></span>&nbsp;';
		}
	}
	//下一页
	if($currentpage < $totalpage)
	{
		$out.='<a class="next" title="下一页" href="javascript:Tuan.'.$pagename.'.nextPage();">下一页</a>';
	}
	
   $out.='</p>';
   
   return $out;
   
  
	
}