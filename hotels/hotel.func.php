<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");

//获取酒店信息
function getHotelInfo($aid,$show=1)
{
   global $dsql;
   $webid = $GLOBALS['sys_child_webid'];
   $where = $show==1 ? "a.aid=$aid" : "a.id=$aid";
   $sql="select a.*,b.hotelrank from #@__hotel a left join #@__hotel_rank b on (a.hotelrankid=b.id) where  {$where} and a.webid='$webid'";
   $row=$dsql->GetOne($sql);
   return $row;
	
}

//获取酒店客服电话
function getHotelNumber($webid)
{
	global $dsql,$sys_webid;
	$sql="select phone,qq from #@__talist where webid=$webid and kind=2";
	$row=$dsql->GetOne($sql);
	$tel='';
	$strqq='';
	if(is_array($row))
	{
		if(!empty($row['phone']))
		{
		   $tel=$row['phone'];
		}
	   	
	}
    return $tel;
	
	
}

  /**
     *  获得价格,房型信息的基本信息
     *
     * @access    private
     * @return    arr
     */
function getprice($id)
{ 
   global $dsql,$sys_webid;
   $arr=array();
   $sql="select * from #@__hotel_room where id=$id and webid=0";
   $row=$dsql->GetOne($sql);
   if(is_array($row))
   {
     $arr[0]=$row['price'];
	 $arr[1]=getRoomName($row);
   }
   return $arr;

}
  /**
     *  获得aid,根据酒店id
     *
     * @access    private
     * @return    id
     */
function getId($aid)
{
	global $dsql;
	$sql = "select id from #@__hotel where aid = '$aid' and webid = 0";
	$row = $dsql->GetOne($sql);
	return $row['id'];
	
}

//根据酒店ID获取房型
function getKind($hotelid)
{
	global $dsql,$sys_webid;
	$str = "";
	$sql = "select * from #@__hotel_room where hotelid=$hotelid and webid=0";
	$res = $dsql->getAll($sql);
	foreach($res AS $row)
	{
		$roomname=$row['roomname'];
		$str .= '<tr>' . 
            	'<td width="223" height="35" style=" padding-left:10px; color:#16b">' . $roomname . '</td>' . 
            	'<td height="35" align="center" style=" color:#f60; font-weight:bold; font-size:16px; ' . 
				'font-family:Arial, Helvetica, sans-serif">￥' . $row['price'] . '</td>' . 
            	'<td align="right"><input type="text" class="note same" name="cellnum" onkeyup="GetSum(this)" maxlength="3" /></td>' . 
				'<input type="hidden" name="roomcell" id="roomcell' . $row['id'] . '" value="' . $row['roomname'] . '" />' . 
				'<input type="hidden" name="price" id="price" value="' . $row['price'] . '" />' . 
				'<input type="hidden" name="sumprice" id="sumprice" />' . 
          	    '</tr>';
	}
	return $str;
}

/**
 *  获得价格范围的最小.最大值
 *
 * @access    private
 * @return    arr
 */
function getMinMaxprice($priceid)
{
	 
  global $dsql;
  $arr=array();
  $arr['min']='';
  $arr['max']='';
  $sql="select min,max from #@__hotel_pricelist where id=$priceid";
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  {
     $arr['min']=!empty($row['min'])?$row['min']:0;
	 $arr['max']=!empty($row['max'])?$row['max']:0;
  }
 
  return $arr;
}

/**
 *  获得酒店条数和访问次数
 *
 * @access    private
 * @return    arr
 */
function getHotelCount($where)
{
  	global $dsql;
  	$arr=array();
  	$sql="select count(*) as num,SUM(a.shownum) as showcount from #@__hotel a left join #@__hotel_rank b on a.hotelrankid=b.id {$where}";
  	$row=$dsql->GetOne($sql);
  	if(is_array($row))
  	{
    	$arr[]=isset($row['num']) ? $row['num'] : 0;
   		$arr[]=isset($row['showcount'])?$row['showcount'] : 0;
  	}
  	return $arr;
}

/**
     *  获得酒店星级
     *
     * @access    private
     * @return    string
     */
function getRank($rankid)
{
  global $dsql;
  $rankname='';
  $sql="select hotelrank from #@__hotel_rank where id='$rankid'";
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  {
     $rankname=$row['hotelrank'];
  }
 
  return $rankname;
}






//分析处理图片,返回大图,小图数组
function getPiclistArr($piclist)
{
    
       $picarr=explode(',',$piclist);
       $biglist = $thumblist = array();
	   foreach($picarr as $value)
	   {  
			if(empty($value))
			{
			 continue;
			}
		   $temparr=explode('||',$value);
		     $biglist[] =array('url'=>getUploadFileUrl(str_replace('litimg','allimg',$temparr[0])),'title'=>$temparr[1]);//大图
		     $thumbpic= array('url'=>getUploadFileUrl(str_replace('litimg','lit160',$temparr[0])),'title'=>$temparr[1]);
		   //$biglist[] =array('big'=>getUploadFileUrl(str_replace('litimg','allimg',$temparr[0])));//大图 
		   //$thumbpic= array('thumb'=>getUploadFileUrl(str_replace('litimg','lit160',$temparr[0])));
		   $thumblist[] = $thumbpic;//小图
		}
       //return array($biglist,$thumblist);
	   return array('big'=>$biglist,'thumb'=>$thumblist);
}

//获取餐标中文
function getBreakFirst($num)
{
	switch($num)
	{
		case 0:
		 $out='无';
		 break;
		case 1:
		 $out='含';
		 break;
		case 2:
		 $out='双早';
		 break;
		 case 3:
		 $out='单早';
		 break;
		 case 4:
		 $out='早餐';
		 break; 
		  case 5:
		 $out='早晚餐';
		 break; 
		  case 6:
		 $out='三餐';
		 break; 
		  case 7:
		 $out='一价全包';
		 break; 
		 case 8:
		 $out='用晚含早';
		 break; 
		default:
		  $out='无';
		 break;
		
	}
	return $out;
	
	
}

//获取餐标中文
function getComputer($num)
{
	switch($num)
	{
		case 0:
		 $out='无';
		 break;
		case 1:
		 $out='含';
		 break;
		case 2:
		 $out='有线';
		 break;
		 case 3:
		 $out='无线';
		 break;
		default:
		  $out='无';
		 break;	
	}
	return $out;
	
	
}
//获取酒店特色服务
function getHotelService($attrid,$groupid)
{
	global $dsql;
	Helper_Archive::loadModule('common');
	$_model = new CommonModule('#@__hotel_attr');
	$attr = explode(',',$attrid);
	foreach($attr as $id)
	{
	   $name = $_model->getField('attrname',"pid='$groupid' and id='$id'");	
	   $out.=!empty($name) ? $name.'|' : '';
	}
	return $out;
	
}
//获取酒店房型具体图片(html)
function getRoomPicList($piclist)
{
	    $out = '';
        $picarr=explode(',',$piclist);
		$k=0;
		foreach($picarr as $value)
	    {  
		  $temparr=explode('||',$value);
          if(!empty($temparr[0]))
          {
              $thumbpic=getUploadFileUrl(str_replace('litimg','lit160',$temparr[0]));

              $out.='<a rel="group" href="'.$temparr[0].'"><img src="'.$thumbpic.'" width="90" height="60" alt="'.$temparr[1].'" title="'.$temparr[1].'" /></a>';
          }

		}
		return $out;
	
}

Class Hotel{

    public static function getHotelContent($row)
    {
        if($row['columnname']=='tupian')//图片模块特殊处理
        {

            $out=' <ul class="hotel_pic_list">';
            $i=1;
            foreach($GLOBALS['thumblist'] as $thumb)
            {
                $cs = $i%4==0 ? "class='mr_0'" : '';
                $big = str_replace('lit160','allimg',$thumb['url']);
                $out.='<li'.$cs.'><a  rel="group" href="'.$big.'"><img class="fl" src="'.$thumb['url'].'" width="215" height="150" /></a></li>';
                $i++;
            }
            $out.='</ul>';
            return $out;

        }
        else
        {
            return $row['content'];
        }

    }


}

