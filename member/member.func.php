<?php
/*------
会员模块功能函数
-------*/


//获取产品名称
function getProductName($id,$typeid,$productname='')
{
	global $dsql;
	$channeltable=array(
	  "1"=>"#@__line",
	  "2"=>"#@__hotel",
	  "3"=>"#@__car",
	  "4"=>"#@__article",
	  "5"=>"#@__spot",
	  "6"=>"#@__photo",
	  "7"=>"#@__theme",
	  "8"=>"#@__visa",
	  "9"=>"#@__ticket",
	  "10"=>"#@__leave",
	  "11"=>"#@__advertise",
	  "12"=>"#@__allcomments",
	  "13"=>"#@__tuan");
	$tablename = $channeltable[$typeid];
	$fields=array(
	  '1'=>array('field'=>'title','link'=>'lines'),
	  '2'=>array('field'=>'title','link'=>'hotels'),
	  '3'=>array('field'=>'title','link'=>'cars'),
	  '4'=>array('field'=>'title','link'=>'article'),
	  '5'=>array('field'=>'title','link'=>'spots'),
	  '8'=>array('field'=>'title','link'=>'visa'),
	  '13'=>array('field'=>'title','link'=>'tuan')
	  );
	 $field = $fields[$typeid]['field'];
	 $link =$fields[$typeid]['link'];

    //如果为空,则是通用模块
     if(empty($field))
     {
         $moduleinfo = Helper_Archive::getModuleInfo($typeid);
         $field = 'title';
         $link = $moduleinfo['pinyin'];
         $tablename = 'sline_model_archive';

     }
	$sql = "select aid,{$field} as title,webid from {$tablename} where id='$id'";
	$row = $dsql->GetOne($sql);
	$title = !empty($productname) ? $productname : $row['title'];
    $weburl = GetWebURLByWebid($row['webid']);
	$out = "<a href=\"{$weburl}/{$link}/show_{$row['aid']}.html\" target=\"_blank\">{$title}</a>";
	return $out;
	
}

//获取订单状态
function getOrderStatus($status,$paytype)
{
	switch($status)
	{
		case '0':
		 $out = '<span class="color_wfk">等待处理</span>';
		 break;
		case '1':
		 $out = '<span class="color_wfk">等待付款</span>';
		 break;
		case '2':
		 $out = '<span class="color_ywc">付款成功</span>';
		 break;
		case '3':
         $out = '<span class="color_yqx">取消订单</span>';
         break;
        case '4':
		 $out = '<span class="color_yqx">已退款</span>';
         break;
        case '5':
		 $out = '<span class="color_ywc">交易完成</span>';
		 break;
	}
   /* if($paytype == '3')
    {
        $out = '<span class="color_wfk">等待处理</span>';
    }*/
	return $out;
	
}
 
//根据typeid获取订单名称
function getOrderName($typeid)
{
	switch($typeid)
	{
		case "1":
		 $out = '线路订单';
		 break;
		case "2":
		 $out = '酒店订单';
		 break;
		case "3":
		 $out = '租车订单';
		 break;
		case "5":
		 $out = '门票订单';
		 break;
		case "8":
		 $out = '签证订单';
		 break;
		case "13":
		 $out = '团购订单';
		 break;
		    
		
	}
	return $out;
}

//根据typeid获取订单详细显示模板
function getOrderTemplet($typeid)
{
	switch($typeid)
	{
		case "1":
		 $out = 'order_line_detail.htm';
		 break;
		case "2":
		 $out = 'order_hotel_detail.htm';
		 break;
		case "3":
		 $out = 'order_car_detail.htm';
		 break;
		case "5":
		 $out = 'order_spot_detail.htm';
		 break;
		case "8":
		 $out = 'order_visa_detail.htm';
		 break;
		case "13":
		 $out = 'order_tuan_detail.htm';
		 break;
		    
		
	}
	return $out;
}

//获取评论HTMl
function getPinLunHtml($typeid,$orderid,$productautoid)
{
	$pltype = array(
	       '1'=>array('导游服务','线路游玩','往返交通','餐饮住宿'),
		   '2'=>array('设施装潢','交通位置','卫生情况','性价比'),
		   '3'=>array('车辆性能','服务态度','舒适情况','性价比'),
		   '5'=>array('风景评分','食宿评分','交通评分','人文评分'),
		   '13'=>array('住宿环境','交通位置','卫生情况','性价比'),
		   '8'=>array('服务态度','办理流程','办理速度','性价比')
	
	);
	$style = $typeid>13 ? "style='display:none'" : '';
	$out='<div class="pop_box">
                  	<div class="closed"></div>
                  	<div class="pop_abs"></div>
                    <dl class="box_dl" '.$style.'>
                      <dt>服务评分：</dt>';
    $itemtype = $pltype[$typeid];
	$k = 1;
	foreach($itemtype as $v)
	{
	   $out.='<dd><label>'.$v.':</label><span class="score_'.$k.'" data-orderid="'.$orderid.'"></span></dd>';	
	   $k++;
	}
	
    $out.='</dl>
                    <div class="pop_title">评价内容：</div>
                    <div class="pop_con"><textarea class="msg" rows="" id="msg_'.$orderid.'"></textarea></div>
                    <div class="submit_div"><input type="button" data-productid="'.$productautoid.'" data-orderid="'.$orderid.'" data-typeid="'.$typeid. '" class="submit_btn" value="确认评价" /><p>评价内容10-500字</p></div>
					<input type="hidden" id="score_1_'.$orderid.'">
				    <input type="hidden" id="score_2_'.$orderid.'">
				    <input type="hidden" id="score_3_'.$orderid.'">
				    <input type="hidden" id="score_4_'.$orderid.'">
                  </div>';
	return $out;
	
}
//获取是好评/中评/差评

function getPinLunLevel($scores)
{
	$k = 0;
	foreach($scores as $score)
	{
	   $total += $score;
	   $k++;
	}
	$avg = round($total/$k,1);
	
	if($avg>4)
	{
	   $flag = 1;//好	
	}
	else if($avg>2.5)
	{
	  $flag = 2; //中评	
	}
	else
	{
	  $flag =3;	//差评
	}
	
	return $flag;	
}

//获取通用模块信息
function getTongYongInfo()
{
    global $dsql;
    $sql = "select * from sline_model where id>13 and isopen=1";
    $arr = $dsql->getAll($sql);
    return $arr;
}



