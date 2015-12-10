<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

//根据目的地id获取相应拼音

function getPinyinById($destid)
{
	global $dsql;
	$sql = "SELECT pinyin FROM #@__destinations WHERE id = '$destid' and isopen = 1";
	$row = $dsql->GetOne($sql);
	return $row['pinyin'];
	
}

//根据目的地拼音获取目的地id

function getDestIdByPy($pinyin)
{
	global $dsql;
	$sql = "SELECT id FROM #@__destinations WHERE pinyin = '$pinyin' and isopen = 1";
	$row = $dsql->GetOne($sql);
	return $row['id'];
	
}

//获取当前目的地优化信息

function getSeo($kindid)
{
	global $dsql;
	
	$sql="select kindname,seotitle,keyword,description,jieshao,tagword,templetpath,pinyin,templet,iswebsite,weburl from #@__destinations where id=$kindid";
	$row=$dsql->GetOne($sql);
    $row['pinyin'] = !empty($row['pinyin']) ? $row['pinyin'] : $kindid;
	return $row;
}

//按栏目获取总访问次数

function getVisit($typeid,$kindid)
{
	global $dsql;
	$table=array("1"=>"#@__line","2"=>"#@__hotel","3"=>"#@__car","4"=>"#@__article","5"=>"#@__spot","6"=>"#@__photo");
	$tablename=$table[$typeid];
	$sql="select SUM(shownum) as num from {$tablename} where FIND_IN_SET($kindid,kindlist)";
	$row=$dsql->GetOne($sql);
	return $row['num'];

}

//获取目的地上级
function getParkind($id)
{
	global $dsql,$parentname,$parenturl;
	$sql = "select pid from #@__destinations where id='$id'";
	$pid = $dsql->GetOne($sql);
	$pname = $dsql->GetOne("select id,kindname from #@__destinations where id='$pid[pid]'");
	if(is_array($pname))
	{
		$str = ' &raquo; <a href="' . $GLOBALS['cfg_cmsurl'] . '/' . $pname['id'] . '/" rel="nofollow">' . $pname['kindname'] . '</a>';
		$parentname=$pname['kindname'];
		
		$parenturl="{$GLOBALS['cfg_cmsurl']}/{$pname['id']}/";
	}
	else
	{
		$str = '';
		$parentname='全部';
		$parenturl="{$GLOBALS['cfg_cmsurl']}/destinations/";
	}
	return $str;
}


//获取一个推荐景点图片作为封面
function getLitpic($kindid)
{
   global $dsql;
   $sql="select frontpic,webid from #@__spot where FIND_IN_SET($kindid,kindlist) and frontpic!='' order by boutique desc,isjian desc,addtime desc";
   $row=$dsql->GetOne($sql);
   if(is_array($row))
   {
     $litpic=GetWebURLByWebid($row['webid']).$row['frontpic'];
   }
   else
   {
	 $litpic=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif"; 
   }
   return $litpic;	
	
}

//获取数量是否存在
function getChannelCount($typeid,$kindid)
{
	global $dsql;
	$flag = 0;
	$table=array("1"=>"#@__line","2"=>"#@__hotel","3"=>"#@__car","4"=>"#@__article","5"=>"#@__spot","6"=>"#@__photo");
	$tablename=$table[$typeid];
	$sql="select 1 from {$tablename} where FIND_IN_SET($kindid,kindlist) limit 1";
	$flag=$dsql->ExecuteNoneQuery2($sql);
	return $flag;

}

//景点相关攻略关键词
function getRelativeRaiderTag($kindid)
{
	global $dsql;
	$arr=array();
	$sql="select tagword from #@__spot where FIND_IN_SET($kindid,kindlist) and tagword!='' order by isding desc,isjian desc,displayorder asc limit 0,20";
	$dsql->SetQuery($sql);
	$dsql->Execute();
	while($row=$dsql->GetArray())
	{
	   if(!empty($row['tagword']))
	   {
		  if(!in_array($row['tagword'],$arr))
		  array_push($arr,$row['tagword']); 
	   }	
	}
	$tag=join(',',$arr);
	
	return $tag;
	
	
}

//判断是否有下级分类
function checkHasNext($kindid)
{
	global $dsql;
	$flag=0;
	$sql="select 1 from #@__destinations where pid=$kindid and isopen=1 limit 1";
	$row=$dsql->GetOne($sql);
	if($row)
	{
      $flag=1;
		
	}
	return $flag;
	
	
}

//判断是否有属性.
function checkHasAttr($kindid)
{
   	global $dsql;
	$flag=0;
	$sql="select id,attrname from #@__line_attr where webid='0' and isopen='1' order by displayorder asc";
	$dsql->SetQuery($sql);
    $dsql->Execute();
	while($row=$dsql->GetArray())
	{
		if(CheckExistAttr(1,$kindid,$row['id']))
		{
		   $flag=1;
		   break;
		}
		
	}
	return $flag;
	
}

/*------聚合页面-------*/

function getKindSeo($kid,$type)
{
  global $dsql;
  $table=array(
      'lines'=>'#@__line_kindlist',
	  'hotels'=>'#@__hotel_kindlist',
	  'cars'=>'#@__car_kindlist',
	  'raiders'=>'#@__article_kindlist',
	  'spots'=>'#@__spot_kindlist',
	  'photos'=>'#@__photo_kindlist');
  $tablename=$table[$type];
  $sql="select a.seotitle,b.kindname,a.keyword,a.tagword,a.description,a.jieshao,a.templetpath from $tablename as a inner join #@__destinations as b on a.kindid=b.id where a.kindid=$kid";
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  return $row;	
}

//导入智能标题
function importAutoTitle($type,$row)
{
	$file=SLINEDATA."/autotitle.cache.inc.php"; //载入智能title配置
	$arr=array();
	if(file_exists($file))
	{
	   require($file);	
	   
	   if($type=='lines')
		{
		   $g_title=str_replace('XXX',$row['kindname'],$cfg_line_title);
		   $g_desc=str_replace('XXX',$row['kindname'],$cfg_line_desc);
		}
		else if($type=='hotels')
		{
		    $g_title=str_replace('XXX',$row['kindname'],$cfg_hotel_title);
		    $g_desc=str_replace('XXX',$row['kindname'],$cfg_hotel_desc);	
		}
		else if($type=='cars')
		{
		    $g_title=str_replace('XXX',$row['kindname'],$cfg_cars_title);
		    $g_desc=str_replace('XXX',$row['kindname'],$cfg_cars_desc);
		}
		else if($type=='raiders')
		{
		    $g_title=str_replace('XXX',$row['kindname'],$cfg_article_title);
		    $g_desc=str_replace('XXX',$row['kindname'],$cfg_article_desc);	
		}
		else if($type=='spots')
		{
		    $g_title=str_replace('XXX',$row['kindname'],$cfg_spots_title);
		    $g_desc=str_replace('XXX',$row['kindname'],$cfg_spots_desc);	
		}
		else if($type=='photos')
		{
		    $g_title=str_replace('XXX',$row['kindname'],$cfg_photo_title);
		    $g_desc=str_replace('XXX',$row['kindname'],$cfg_photo_desc);;	
		}
		
		array_push($arr,$g_title,$g_desc);
	 
	}
	
	return $arr;
	
}

//获取上级
function getGatherParkind($id, $typeid, $type)
{
	global $dsql,$parentname,$parenturl;
	$arr = array('1'=>'线路','2'=>'酒店','3'=>'租车','4'=>'攻略','5'=>'景点','6'=>'相册');
	//$arrType = array('lines'=>'1','hotels'=>'2','cars'=>'3','raiders'=>'4','spots'=>'5','photos'=>'6');
	$sql = "select pid from #@__destinations where id='$id'";
	$pid = $dsql->GetOne($sql);
	$pname = $dsql->GetOne("select id,kindname,pinyin from #@__destinations where id='$pid[pid]'");
	$str = '<a href="' . $GLOBALS['cfg_cmsurl'] . '/' . $type . '/" rel="nofollow">' . $arr[$typeid] . '首页</a>';
	if(is_array($pname))
	{
		$str .= ' &raquo; <a href="' . $GLOBALS['cfg_cmsurl'] . '/' . $pname['pinyin'] . '/' . $type . '/" rel="nofollow">' . $pname['kindname'] . $arr[$typeid] . '</a>';
		$parentname=$pname['kindname'];
		
		$parenturl="{$GLOBALS['cfg_cmsurl']}/{$pname['pinyin']}/lines/";
		
	}
	else
	{
		$str .= '';
		$parentname='全部';
		$parenturl="{$GLOBALS['cfg_cmsurl']}/lines/";
	}
	return $str;
}

//检测是否有轮播广告.
function checkHasFocus($typeid,$destid)
{
	global $dsql;
	$flag=0;
	$arr=array('1'=>'LineFocus','2'=>'HotelFocus','4'=>'ArticleFocus','5'=>'SpotFocus','6'=>'PhotoFocus');
	$sql="select 1 from #@__advertise where webid=0 and adtype=4 and tagname='$arr[$typeid]' and FIND_IN_SET($destid,kindlist) limit 1";
	$row=$dsql->ExecuteNoneQuery2($sql);
	if($row)
	{
	   $flag=1;	
	}
	return $flag;
	
}

/*
 * //获取目的地相关线路,酒店,攻略数据配置文件
 * 根据文件生成时间判断,如果生成时间大于2小时,则重新生成文件,反之则引用缓存文件
 * @param int destid
 * @return file
 * */
function getDestNumCache($kindid)
{
    $dir = SLINEDATA.'/dest/cache/';
    if(!is_dir($dir))
    {
        mkdir($dir);
    }
    $current_time = time();
    $file = $dir.$kindid.'.cache.php';
    if(file_exists($file))
    {
        $ftime = filemtime($file);
        $difftime = (int)(($current_time-$ftime)/3600);//转化为小时
        if($difftime > 2) //如果大于2小时,则直接生成新的缓存.
        {
          genDestNumCache($kindid);//生成缓存
        }
    }
    else //如果不存在则生成缓存
    {
        genDestNumCache($kindid);//生成缓存
    }
    return include($file);
}

//生成目的地相关缓存
function genDestNumCache($kindid)
{
   $linenum = get_item_num($kindid,1);
   $hotelnum = get_item_num($kindid,2);
   $carnum = get_item_num($kindid,3);
   $articlenum = get_item_num($kindid,4);
   $spotnum = get_item_num($kindid,5);
   $photonum = get_item_num($kindid,6);
   $filepath = SLINEDATA.'/dest/cache/'.$kindid.'.cache.php';
    $fp = fopen($filepath,'w');
    flock($fp,3);
    fwrite($fp,"<"."?php\r\n");
    fwrite($fp,"return array(\r\n");
    $content .= "'linenum'=>'".$linenum."',";
    $content .= "'hotelnum'=>'".$hotelnum."',";
    $content .= "'carnum'=>'".$carnum."',";
    $content .= "'articlenum'=>'".$articlenum."',";
    $content .= "'spotnum'=>'".$spotnum."',";
    $content .= "'photonum'=>'".$photonum."'";
    $content .= ")\r\n";
    fwrite($fp,$content);
    fwrite($fp,"?".">");
    fclose($fp);


}

//获取目的地相关数量
function get_item_num($kindid,$typeid)
{
    global $dsql;
    $table = array(
        '1'=>'#@__line',
        '2'=>'#@__hotel',
        '3'=>'#@__car',
        '4'=>'#@__article',
        '5'=>'#@__spot',
        '6'=>'#@__photo'
    );
    $tablename = $table[$typeid];
    $where = $typeid == 3 ? '' : "where find_in_set($kindid,kindlist)";
    $sql = "select count(*) as num from {$tablename} {$where}";
    $row = $dsql->GetOne($sql);
    return $row['num'] ? $row['num'] : 0;
}
/*
 * 根据相关产品数量生成目的地来访次数随机值*/

function get_visit_count($arr)
{
    $total = 0;
    foreach($arr as $value)
    {
        $total +=intval($value);
    }
    if($total > 100)
      $total = $total + intval(substr(time(),-4,4)) ;
    else
        $total = $total + intval(substr(time(),-3,3)) ;
    return $total;



}

/*
 * 获取目的地图片(HTML)
 * */

function getPiclistArr($kindid,$width,$height)
{
    global $dsql;
    $flag=0;
    $sql="select litpic,piclist from #@__destinations where id=$kindid";

    $row=$dsql->GetOne($sql);

    if(empty($row['litpic']) && empty($row['piclist']))
    {
        $df_big = getDefaultImage();
        $out ="<img src=\"{$df_big}\" width='{$width}' height='{$height}'/>";
    }


    else if(!empty($row['litpic']) && empty($row['piclist']))
    {

        $temp_arr=explode('||',str_replace('litimg','allimg',$row['litpic']));
        $out ="<img src=\"{$temp_arr[0]}\" width='{$width}' height='{$height}' title='{$temp_arr[1]}'/>";

    }

    if(!empty($row['piclist']))
    {
        $picarr=explode(',',$row['piclist']);
        foreach($picarr as $key=>$value)
        {
            $temp_arr=explode('||',$value);

            $pic = str_replace('litimg','allimg',$temp_arr[0]);
            $out.="<img src=\"{$pic}\" width='{$width}' height='{$height}' title='{$temp_arr[1]}' />";

        }

    }
    return $out;







}

/*
 * 获取攻略属性及数量*/
function get_raider_attr($destid)
{
    global $dsql;
    $sql = "select id from #@__article_attr where pid=0 and isopen=1 order by displayorder asc";
    $arr = $dsql->getAll($sql);
    $out = array();
    foreach($arr as $row)
    {
        $group = get_attr_child($row['id'],$destid);
        if(!empty($group))
        {
            array_push($out,$group);
        }

    }
    $attrarr = array();
    foreach($out as $v)//处理返回二维数组
    {
        foreach($v as $_v)
        {
            $attrarr[]=$_v;
        }
    }
    return $attrarr;
}

function get_attr_child($groupid,$destid)
{
    global $dsql;
    $out = array();
    $sql = "select * from #@__article_attr where pid = '$groupid' and isopen = 1";

    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $num = get_attr_num($row['id'],$destid);
        if(!empty($num)) //排除没有攻略的属性
        {
            $ar = array('attrid'=>$row['id'],'attrname'=>$row['attrname'],'attrnum'=>$num);
            array_push($out,$ar);
        }

    }
    return $out;

}

function get_attr_num($attrid,$destid)
{
    global $dsql;
    $sql = "select count(*) as num from #@__article where find_in_set($attrid,attrid) and find_in_set($destid,kindlist)";

    $row = $dsql->GetOne($sql);
    return $row['num'] ? $row['num'] : 0 ;
}

