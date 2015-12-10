<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
//加载通用模型类
Helper_Archive::loadModule('common');
//获取车务信息
function getCarInfo($aid)
{
	global $dsql;
    $webid = $GLOBALS['sys_child_webid'];
	$sql = "select a.* from #@__car a where a.aid = '$aid' and a.webid = '$webid'";
	$row =$dsql->GetOne($sql);
	return $row;
}
/**
     *  获得上一篇,下一篇
     *
     * @access    private
     * @return    string
     */

function GetPreNext($id,$month)
    {
        global $dsql,$sys_webid;
		
		$aid=$id;
	    $info =array();
      
          
            $preRow =  $dsql->GetOne("Select a.* From #@__car a where a.aid<$aid and a.webid=$sys_webid  order by a.aid desc limit 1");
            $nextRow = $dsql->GetOne("Select a.* From #@__car a  where a.aid>$aid And a.webid=$sys_webid  order by a.aid asc limit 1");

          
            if(is_array($preRow))
            {
                $url = $GLOBALS['cfg_cmsurl']."/cars/show_{$preRow['aid']}.html";
				$price=(empty($preRow['price']) || $preRow['price']==0) ? '电询' :  "￥{$preRow['price']}";
                $info['pre'] = "上一篇：<a href='$url'>{$preRow['title']}</a> {$price} ";
               
            }
            else
            {
                $info['pre'] = "上一篇：没有了 ";
                
            }
            if(is_array($nextRow))
            {
                $url = $GLOBALS['cfg_cmsurl']."/cars/show_{$nextRow['aid']}.html";
				$price=(empty($nextRow['price']) || $nextRow['price']==0) ? '电询' :  "￥{$nextRow['price']}";
                $info['next'] = "下一篇：<a href='$url'>{$nextRow['title']}</a> {$price}";
            }
            else
            {
                $info['next'] = "下一篇：没有了 ";
               
            }
      
      
        return $info;
    }


function GetKind($kindid,$webid)
{
	
	$str=getCarKind($kindid,$webid);
	return $str;
	
}

//主站获取车型
function getCarKind($kindid,$webid=0)
{
  global $dsql;
  $out='';
  $sql="select kindname from #@__car_kind where aid='$kindid' and webid='$webid'";
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  {
	  $out=$row['kindname'];
  }
  return $out;
	
}
//主站获取车型seo
function getCarKindTitle($kindid,$webid=0)
{
    global $dsql;
    $out='';
    $sql="select title from #@__car_kind where id='$kindid' and webid='$webid'";
    $row=$dsql->GetOne($sql);
    if(is_array($row))
    {
        $out=$row['title'];
    }
    return $out;

}

function setMoney($str)
 {
   return (empty($str)||$str==0) ? '电询' : "￥{$str}";	 
 } 

function getCarBrand($brandid,$webid=0)
{
	global $dsql;
	$sql="select kindname from #@__car_brand where aid='$brandid' and webid=$webid";
	$out='暂无';
	$row=$dsql->GetOne($sql);
	if(is_array($row))
	{
		$out=$row['kindname'];
	}
	return $out;
	
	
	
}

//获取出发地
function GetStartCity($kindlist)
{
	global $dsql;
	$arr=explode(',',$kindlist);
	for($i=0;isset($arr[$i]);$i++)
	{
		$sql="select kindname from #@__car_kindlist where id='{$arr[$i]}'";
		$row=$dsql->GetOne($sql);
		$out.="{$row['kindname']} ";
	}
	return $out;
	
	
}
//获取最小值,最大值.

function GetMaxMinPrice($aid,$webid=0)
{
	global $dsql;
	$sql="select min,max from #@__car_pricelist where webid=$webid and aid=$aid";
	
	$row=$dsql->GetOne($sql);
	return $row;
	
	
}

//获取车务主站所属分类

function getChildKind($aid)
{
	global $dsql;
	$sql="select a.kindname ,b.seotitle,b.jieshao,b.keyword,b.tagword,b.description from #@__destinations as a inner join #@__car_kindlist as b on a.id=b.kindid where a.id={$aid} ";
	$row=$dsql->GetOne($sql);
	return $row;
	
	
}

//子站车务获取车型
function getCarKindName($kindid,$webid)
{
  global $dsql;
  $out='未定义';
  $getpid="select id from #@__nav where typeid=3 and webid=$webid";
  $row=$dsql->GetOne($getpid);
  if(is_array($row))
  {
    $sql="select shortname from #@__nav where webid=$webid and aid=$kindid and pid={$row['id']}";
    $arr=$dsql->GetOne($sql);
	$out=$arr['shortname'];
  }
  return $out;
	
	
}

//获取车子价格
function GetCarPrice($aid,$childid=0)
{
  global $dsql;
  $kindwhere=$childid==0 ? '' : " and kindarea='{$childid}'";
  $currentmonth=GetMonthHandle();
  $sql="select $currentmonth as price from #@__car_month where carid=$aid and webid=0 {$kindwhere}";
 
  $row=$dsql->GetOne($sql);
 
  $price=is_array($row) ? "￥".$row['price'] : '电询';
  return $price;
	
	
}

//获取选择区域
 function getAreaList($aid)
 {
	global $dsql;
	$sql="select kindarea from #@__car_month where webid=0 and carid=$aid ";
	$arr=$dsql->getAll($sql);
	if(is_array($arr))
	{
		$out="<select name=\"area\" onchange=\"getcarprice(this.options[this.options.selectedIndex].value)\">";
		for($i=0;isset($arr[$i]['kindarea']);$i++)
		{
			$sql="select kindname,id from #@__destinations where id= '{$arr[$i]['kindarea']}'";
			$ar=$dsql->GetOne($sql);
			$out.="<option value=\"{$ar['id']}\">{$ar['kindname']}</option>";
			
		}
		
		
	}
	$out.="</select>";
	return $out;
	 
	 
 }
 
 //搜索页面使用
 /**
*  获得线路条数和访问次数
*
* @access    private
* @return    arr
*/
function getCarCount($where)
{
	global $dsql,$sys_webid;
	$arr=array();
	$sql="select count(*) as num,SUM(shownum) as showcount from #@__car a left join (select carid,min(price) as minprice from #@__car_suit group by carid) as b on a.id=b.carid where a.webid is not null {$where}";
	
	$row=$dsql->GetOne($sql);
	if(is_array($row))
	{
	$arr[]=isset($row['num']) ? $row['num'] : 0;
	$arr[]=isset($row['showcount'])?$row['showcount'] : 0;
}

return $arr;
}

//获取上级分类
function getPreLevelList($kindid)
{
  global $dsql,$brandid,$carkindid,$childid,$priceid;
  $getsql="select pid from #@__destinations where id=$kindid";
  $row=$dsql->GetOne($getsql);
  $pid=$row['pid'];
  if($pid!=0)
  {
	$sql="select pid from #@__destinations where id={$pid}";
	$row=$dsql->GetOne($sql);
	$pid=$row['pid'];
  }
  if($kindid==0)
  {
    $pid=0;	
  }
  
  $sql="select id,kindname from #@__destinations where pid='{$pid}' and isopen=1 order by displayorder asc";
  
  $dsql->SetQuery($sql);
  $dsql->Execute();
  while($row=$dsql->GetArray())
  {
	if(CheckExistDest(3,$row['id']))
	{
	  $class=($kindid==$row['id']) ? 'car_all_xz' :"";
	  $url="{$GLOBALS['cfg_cmsurl']}/cars/search_{$row['id']}_{$carkindid}_{$brandid}_{$priceid}.html";
	  $out.="<a href=\"{$url}\" class=\"{$class}\">{$row['kindname']}</a>";
	}

  }
return $out;


}


//获取同级分类
function getSameLevelList($kindid)
{
  global $dsql,$brandid,$carkindid,$childid,$priceid;
  if($kindid==0)
  {
	return '';	
  }
  $getsql="select pid from #@__destinations where id=$kindid";
  $row=$dsql->GetOne($getsql);
  $pid=$row['pid'];
  $sql="select id,kindname from #@__destinations where pid={$pid} and isopen=1 order by displayorder asc";
  $dsql->SetQuery($sql);
  $dsql->Execute();
  while($row=$dsql->GetArray())
  {
	if(CheckExistDest(3,$row['id']))
	{
	  $class=($kindid==$row['id']) ? 'car_all_xz' :"";
	  $url="{$GLOBALS['cfg_cmsurl']}/cars/search_{$row['id']}_{$carkindid}_{$brandid}_{$priceid}.html";
	  $out.="<a href=\"{$url}\" class=\"{$class}\">{$row['kindname']}</a>";
	}

  }
return $out;


}
//获取下级分类
function getNextLevelList($kindid)
{
  global $dsql,$brandid,$carkindid,$childid,$priceid;
  
  $sql="select id,kindname from #@__destinations where pid={$kindid} and isopen=1 order by displayorder asc";
  $dsql->SetQuery($sql);
  $dsql->Execute();
  while($row=$dsql->GetArray())
  {
	if(CheckExistDest(3,$row['id']))
	{
	  $class=($kindid==$row['id']) ? 'car_all_xz' :"";
	  $url="{$GLOBALS['cfg_cmsurl']}/cars/search_{$row['id']}_{$carkindid}_{$brandid}_{$priceid}.html";
	  $out.="<a href=\"{$url}\" class=\"{$class}\">{$row['kindname']}</a>";
	}
  
  }
  return $out;


}
//车辆图片
function getLitpic($litpic)
{

  return empty($litpic) ? getDefaultImage() : $litpic;
}

//车辆属性
function getCarAttrName($attrid,$pname=null)
{
	$_attrModule=new CommonModule('sline_car_attr');
	$_arr=explode(',',$attrid);
	
	$pid=$_attrModule->getField('id',"attrname='$pname'");
	
	foreach($_arr as $k=>$v)
	{
		$v=trim($v);
		if(empty($v))
		  continue;
		$where="id=$v";
		$where.=empty($pid)?'':" and pid=$pid";  
		$str.=$_attrModule->getField('attrname',$where).',';
	}
	$str=trim($str,',');
	return $str;
}

function getCarPicList($piclist,$carname=null,$litpic='')
{
	$_arr =array();
    if(!empty($piclist))
    {
        $_arr=explode(',',$piclist);
        //$litpics=$_arr;
        $i=0;
        foreach($_arr as $k=>$v)
        {
            $pic = explode('||',$v);
            $picture = $pic[0];
            $desc = $pic[1] ? $pic[1] : $carname;
            if($i<2)
            {
                $p160=getUploadFileUrl(str_replace('litimg','lit160',$picture));
                $str160.='<dd rel="'.$picture.'" class="thumbpic"><img src="'.$p160.'" width="105" height="80" alt="'.$desc.'" title="'.$desc.'"></dd>';
            }

            $bigpic=getUploadFileUrl(str_replace('litimg','allimg',$picture));
            $strbig.='<a class="bigpics" rel="group" href="'.$bigpic.'">更多</a>';
            $i++;
        }
    }
    else
    {
        $str160=$strbig=getUploadFileUrl($litpic);

    }



	//$result['litpic']=!empty($_arr[0]) ? getUploadFileUrl($_arr[0]) : getUploadFileUrl($litpic);
	$result['thumbpic']=$str160;
	$result['bigpic']=$strbig;
	return $result;
}

function getCarTaocanHtml($carid)
{
	$_suitModel=new CommonModule('sline_car_suit_type');
	$result=$_suitModel->getAll("carid=$carid","displayorder asc");
	foreach($result as $k=>$v)
	{

        if(check_has_suit($v['id']))
        {
            $str.='
		<div class="car_type">
              <ul class="type_ul">
              	<li class="li_1">'.$v['kindname'].'</li>
              </ul>
              <div class="type_list">
                   '.getTaoCanDetail($carid,$v['id']).'
               </div>
            </div>';

        }

	}
	return $str;
}
function getTaoCanDetail($carid,$suittypeid)
{
    $_suitModel=new CommonModule('sline_car_suit');
    $arr=$_suitModel->getAll("carid=$carid and suittypeid='$suittypeid'","displayorder asc");
    foreach($arr as $v)
    {
        $price = getCarNewRealPrice(null,null,$carid,$v['id']);//最低报价
        $price = empty($price) ? '电询' : '&yen;'.$price;
        $supportdj = !empty($v['dingjin']) ? '<img src="'.$GLOBALS['cfg_templets_skin'].'/images/zcdj.gif" />' : '';
        $jifentprice = $v['jifentprice']?$v['jifentprice']:'无';
        $out.=' <dl>
                  <dt class="dl_title"><a href="javascript:void()">'.$v['suitname'].'</a></dt>
                  <dd class="dd1">'.$v['unit'].'</dd>
                  <dd class="dd2">'.$price.'</dd>
                  <dd class="dd3">
										<div class="car-date">
											<input type="text" id="" class="car-bj usedate" data-suitid="'.$v['id'].'" data-carid="'.$carid.'" name="" value="用车日期" />
										</div>
									</dd>
									<dd class="dd4"><span>'.$jifentprice.'</span></dd>
                  <dd class="dd5">'.$supportdj.'</dd>
                  <dd class="dd6"><a href="javascript:;" class="btn_ding">预定</a></dd>
                </dl>
                <div class="con_hide">
                	<s class="s_bg"></s>
                	'.$v['content'].'
                </div> ';
    }
    return $out;

}
//检测是否有子套餐.
function check_has_suit($suittypeid)
{
    $_suitModel=new CommonModule('sline_car_suit');
    $num=$_suitModel->getCount("suittypeid='$suittypeid'");
    return $num;
}
//获取套餐单日报价
function getSuitPriceByDay($suitid,$day)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__car_suit_price');
    $price = $model->getField('adultprice',"day='".strtotime($day)."' and suitid=".$suitid);
    return $price;
}
function getSuitNumberByDay($suitid,$day)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__car_suit_price');
    $number = $model->getField('number',"day='".strtotime($day)."' and suitid=".$suitid);
    return intval($number);
}
/*
function getCarSearchUrl($item,$value)
{
	$search_arr=array('dest_id','carkindid','carpriceid','startplaceid','attrid','carbrandid','tanknum','searnum');
	
	foreach($search_arr as $k=>$v)
	{
		if($k!=$item&&!empty($_REQUEST[$k]))
		{
			$url.='&'.$k.'='.$v;
		}
	}
	$url.='&'.$item.'='.$value;
	return trim($url,'&');
}*/
function getCarUrl($val=null,$key=null,$exclude=null)
{
	$arr=array('startplaceid','carkindid','displayorder','attrid');
	$url="/cars/";
	$table="#@__car_attr";
	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table,1);
}
function getCarAttrUrlCls($class,$attrid,$groupid=null,$table="#@__car_attr")
{
	 return Helper_Archive::getAttrUrlCls($class,$attrid,$groupid,$table);
}

function getCarAttrGroupUrlCls($groupid)
{
    global $attrid;

    return Helper_Archive::getAttrUrlCls('on',$attrid,$groupid,'#@__car_attr');
}



function getCarAttrName2($attrid)
{
    $arr = getCarAttrArr($attrid);
    foreach($arr as $v)
    {
        $out.="<span>{$v}</span>";
    }
    return $out;

}

function getCarAttrArr($attrid,$esplit=',')
{
    global $dsql;
    $arr = explode($esplit,$attrid);
    $out = array();
    foreach($arr as $id)
    {
        $sql = "select attrname from #@__car_attr where id='$id' and pid!=0";
        $row = $dsql->GetOne($sql);
        if(!empty($row['attrname']))
            array_push($out,$row['attrname']);

    }

    return $out;
}

//获取attrname
function getCarAttrName3($attrid)
{
    global $dsql;
    $arr = explode('_',$attrid);
    $out = array();
    foreach($arr as $id)
    {
        $sql = "select attrname from #@__car_attr where id='$id'";
        $row = $dsql->GetOne($sql);
        array_push($out,$row['attrname']);
    }

    return $out;
}

//获取栏目优化信息
function getCarChannelSeo()
{
    global $dsql;
    $sql="select shortname,seotitle,keyword,description from #@__nav where typeid=3 and webid='0'";
    $row = $dsql->GetOne($sql);
    return $row;

}
function getDestInfo($typeid,$childid=0)
{

    global $dsql,$cfg_car_title,$cfg_car_desc;

    $arr=array();

    $sql="select a.kindname,b.seotitle,a.pinyin,b.jieshao,b.keyword,b.tagword,b.description from #@__destinations as a inner join #@__car_kindlist as b on a.id=b.kindid where a.id={$childid} ";

    $row=$dsql->GetOne($sql);
    if(empty($row))
        return null;
    $cfg_car_title=str_replace('XXX',$row['kindname'],$cfg_car_title);
    $cfg_car_desc=str_replace('XXX',$row['kindname'],$cfg_car_desc);
    if(empty($row['seotitle']))
    {
        $arr['seotitle']=empty($cfg_car_title) ? $row['kindname'] : $cfg_car_title;
    }
    else
    {
        $arr['seotitle']=$row['seotitle'];
    }
    if(empty($row['description']))
    {

        $arr['description']=empty($cfg_car_desc) ? $row['description'] : $cfg_car_desc;
    }
    else
    {
        $arr['description']=$row['description'];
    }

    $arr['jieshao']=$row['jieshao'];
    $arr['destname'] = $row['kindname'];
    $arr['pinyin'] = $row['pinyin'];
    $arr['tagword']=$row['tagword'];
    $arr['keyword']=$row['keyword'];
    $arr['description']=$row['description'];

    return $arr;
}
 ?>