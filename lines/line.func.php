<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");

//获取介绍
function GetJieShao($lineid, $webid, $templets)
{
	$func="getJieShao_".$GLOBALS['cfg_df_style'];
	$func = function_exists($func) ? $func : 'getJieShao_smore';
	$temp=$func($lineid,$webid,$templets);
	return $temp;
}

//获取途经景点
function GetRecSpot($lineid,$webid)
{
	$func="getRecSpots_".$GLOBALS['cfg_df_style'];
	$func = function_exists($func) ? $func : 'getRecSpots_default';
	$temp=$func($lineid,$webid);
	return $temp;
}

//default模板获取途经景点
function getRecSpots_default($lineid,$webid)
{
	global $dsql;
	$weburl=GetWebURLByWebid($webid);//获取站点url
	//$str1 = "<div class=\"dl_gs\"><h4 style=\"font-size:12px;\">途径景点：</h4>";
	$str2 = "<div style=\"float:left; border:1px solod #000; width:710px\"><h4 style=\"font-size:12px; float:left\">途经城市和主要景点：</h4><ul class=\"gd_sp\">";
	$str3 = "";
	$str4 = "";
	$temp = "";
	$sql="select title,litpic,spotid from #@__line_spot where lineid='$lineid' and webid=0 order by displayorder asc";
	$res = $dsql->getAll($sql);
	$numberrow=count($res);
	if(empty($res)) //如果为空则直接返回.
	{
	   return '';	
	}
	$idx = 0;
	foreach($res AS $row)
	{
		if($idx < 5)
		{
			if($row['litpic']=="")
			$row['litpic']=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
			$str3.="<div class='ty'><a href='{$weburl}/spots/show_{$row['spotid']}.html' target='_blank'><img src='{$weburl}{$row['litpic']}' border='0' width='100' height='75'></a>"."<a href='{$weburl}/spots/show_{$row['spotid']}.html' class='spotname' target='_blank'>{$row['title']}</a></div>";
		}
		else
		{
			$str4 .= "<li><a href=\"{$weburl}/spots/show_{$row['spotid']}.html\">{$row['title']}</a></li>";
		}
		$idx++;
	}
	$str5 = "</div>";
	$str6 = "</ul>";
	//$temp = $str1.$str3.$str5.$str2.$str4.$str6;
	
	  $temp = $str2.$str4.$str5.$str6.$str3;
	
	return $temp;
}

function getRecSpots_standard($lineid,$webid)
{
	global $dsql;
	$weburl=GetWebURLByWebid($webid);//获取站点url
	$str = "<div class=\"piclist\"> <ul class=\"pic-ul\">";
	
	 $sql="select title,litpic,spotid from #@__line_spot where lineid='$lineid' and webid=0 order by displayorder asc";
	$res = $dsql->getAll($sql);
	$numberrow=count($res);
	if(empty($res)) //如果为空则直接返回.
	{
	   return '';	
	}
	$idx = 0;
	foreach($res AS $row)
	{
		
			
			$row['litpic']=!empty($row['litpic']) ? $row['litpic'] : getDefaultImage();
			$str.="<li><a class=\"imgGroup\" href=\"{$weburl}/spots/show_{$row['spotid']}.html\"><img width=\"125\" height=\"135\"  src=\"{$row['litpic']}\"></a><p>{$row['title']}</p></li>";

	}
    $str.="</ul></div>";
	return $str;
	
}


//西藏模板获取途经景点
function getRecSpots_xizang($lineid,$webid)
{
	global $dsql;
	$weburl=GetWebURLByWebid($webid);//获取站点url
	$str2 = "<dl><dt class=\"fl\">途经城市和主要景点：</dt>";
	$str3 = " <ul class=\"showlinejd\">";
	$str3middle="";
	$str2middle = "";
	$str2end="</dl>";
	$str3end="</ul>";
	$temp = "";
	$sql="select title,litpic,spotid from #@__line_spot where lineid='$lineid' and webid=0 order by displayorder asc";
	$res = $dsql->getAll($sql);
	$numberrow=count($res);
	if(empty($res)) //如果为空则直接返回.
	{
	   return '';	
	}
	$idx = 0;
	foreach($res AS $row)
	{
		if($idx > 8)
		{
			if($row['litpic']=="")
			$row['litpic']=$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
			
			$str3middle.="<li><span><a href=\"/spots/show_{$row['spotid']}.html\" target=\"_blank\"><img src=\"{$row['litpic']}\" alt=\"{$row['title']}\"/></a></span><span><a href=\"/spots/show_{$row['spotid']}.html\" target=\"_blank\">{$row['title']}</a></span></li>";
		
		}
		else
		{
			$str2middle.=" <dd><a href=\"/spots/show_{$row['spotid']}.html\">{$row['title']}</a></dd>";
		}
		$idx++;
	}

	//$temp = $str1.$str3.$str5.$str2.$str4.$str6;
	
	  $temp = $str2.$str2middle.$str2end.$str3.$str3middle.$str3end;
	
	return $temp;
	
}

//默认模板
function getJieShao_default($lineid, $webid, $templets)
{
	global $dsql;
	$str = "";
	$sql = "select isstyle,lineday,txtjieshao,jieshao from #@__line where aid='$lineid' and webid='$webid'";
	$row = $dsql->GetOne($sql);
	if(empty($row['isstyle']) || $row['isstyle'] == 0)
	{
		$row['isstyle'] = 1;
	}
	else
	{
		$row['isstyle'] = $row['isstyle'];
	}
	if($row['isstyle'] == 1)
	{
		$str = $row['jieshao'];
	}
	elseif($row['isstyle'] == 2)
	{
		$arr = explode(",",$row['txtjieshao']);
		for($i=1; $i<=$row['lineday']; $i++)
		{
			if($templets == 1 || empty($templets))
			{
				$detail = explode("||",$arr[$i-1]);
				$str .= "<div class=\"xc_ts\">";
				$str .= "<dl class=\"style_list\">";
				$str .= "<dt><span>第" . $i . "天：</span>" . $detail[0] ."</dt>";
				$str .= "<dd class=\"xc_bg_1\"><span>饮食：</span>" . GetAttr("food",$detail[1]) . "</dd>";
				$str .= "<dd class=\"xc_bg_2\"><span>&nbsp;&nbsp;住宿：</span>" . $detail[3] . "</dd>";
				$str .= "<dd class=\"xc_bg_3\"><span>交通：</span>" . GetAttr("trans",$detail[2]) . "</dd>";
				$str .= "</dl>";
				$str .= "<p>";
				$str .= $detail[4];
				$str .= "</p>";
				$str .= "<ul class=\"img_xc clearfix\">";
				$str .= GetImage($detail[7],$detail[6],$detail[5]);
				$str .= "</ul>";
				$str .= "</div>";
			}
			else if($templets == 2)
			{
				$detail = explode("||",$arr[$i-1]);
				$str .= "<div class=\"md_xingc_box\">";
				$str .= "<p class=\"title\">第" . $i . "天：</span>" . $detail[0] ."</p>";
				$str .= '<div class="shishu">';
				$str .= '<div class="tt">';
				$str .= "<p><span>饮食：</span>" . GetAttr("food",$detail[1]) . "<span>住宿：</span>" . (empty($detail[3]) ? "无" : $detail[3]) . "<span>交通：</span>" . GetAttr("trans",$detail[2]) . "</p>";
				$str .= '</div></div>';
				$str .= '<div class="cont">';
				$str .= $detail[4];
				$str .= "</div>";
				$str .= "<div class=\"md_xc_imglist\">";
				$str .= '<ul class="clearfix">';
				$str .= GetImage($detail[7],$detail[6],$detail[5],$templets);
				$str .= '</ul>';
				$str .= "</div>";
				$str .= "</div>";
			}
		}
	}
	return $str;
	
}

//标准版1行程样式
function getJieShao_standard($lineid, $webid, $templets)
{
	global $dsql;
	$str = "";
	$sql = "select isstyle,lineday,txtjieshao,jieshao from #@__line where aid='$lineid' and webid='$webid'";
	$row = $dsql->GetOne($sql);
	if(empty($row['isstyle']) || $row['isstyle'] == 0)
	{
		$row['isstyle'] = 1;
	}
	else
	{
		$row['isstyle'] = $row['isstyle'];
	}
	if($row['isstyle'] == 1) //编辑器里编辑的行程,直接读取
	{
		$str = $row['jieshao'];
	}
	elseif($row['isstyle'] == 2) //按天数上传的行程
	{
		$arr = explode(",",$row['txtjieshao']);
		for($i=1; $i<=$row['lineday']; $i++)
		{
			
				$detail = explode("||",$arr[$i-1]);
				$str .= '<div class="d_g_title">';
                $str .="<h3><span>第<b>". $i . "</b>天</span>" . $detail[0] ."</h3>";
                $str .="<span class=\"xingchen_ys\"><i></i><b>饮食：</b>" . GetAttr("food",$detail[1]) ." </span>";
				$str .="<span class=\"xingchen_zs\"><i></i><b>住宿：</b>" . $detail[3] . "</span>";
                $str .="<span class=\"xingchen_jt\"><i></i><b>交通：</b>" . GetAttr("trans",$detail[2]) ."</span>";
                $str .="</div>";
				$str .= "<p>";
				$str .= $detail[4];
				$str .= "</p>";
				//图片
				$str .= "<div class=\"showpicture\"><ul>";
				$str .= GetImageStandard($detail[7],$detail[6],$detail[5]);
				$str .= "</ul>";
				$str .= "</div>";
			
		
		}
	}
	return $str;
	
}


//西藏模板获取行程内容
function getJieShao_xizang($lineid, $webid, $templets)
{
	global $dsql;
	$str = "";
	$sql = "select isstyle,lineday,txtjieshao,jieshao from #@__line where aid='$lineid' and webid='$webid'";
	$row = $dsql->GetOne($sql);
	if(empty($row['isstyle']) || $row['isstyle'] == 0)
	{
		$row['isstyle'] = 1;
	}
	else
	{
		$row['isstyle'] = $row['isstyle'];
	}
	if($row['isstyle'] == 1)
	{
		$str = $row['jieshao'];
	}
	elseif($row['isstyle'] == 2)
	{
		$arr = explode(",",$row['txtjieshao']);
		for($i=1; $i<=$row['lineday']; $i++)
		{
			
				$detail = explode("||",$arr[$i-1]);
				$str .= "<dl class=\"travelnum travel\">";
				$str .=" <dt>第<b>{$i}</b>天：{$detail[0]}</dt>";
				$str .=" <dd><span>饮食：".GetAttr("food",$detail[1])."</span><span>住宿：".$detail[3]."</span><span>交通：".GetAttr("trans",$detail[2])."</span></dd>";
			
				$str .= "</dl>";
				$str .= "<div>";
				$str .= $detail[4];
				$str .= "</div>";
				$str .= "<ul class=\"img_xc clearfix\">";
				$str .= GetImage($detail[7],$detail[6],$detail[5]);
				$str .= "</ul>";
			
		}
	}
	return $str;
	
}

function checkJieShao3($lineid)
{
    global $dsql;
    $sql = "select count(*) as num from #@__line_jieshao where lineid='$lineid'";
    $row = $dsql->GetOne($sql);
    return $row['num']>0 ? 1 : 0;

}

//标准版smore行程样式
function getJieShao_smore($lineid)
{
    global $dsql;
    if(checkJieShao3($lineid))
    {
        return getJieShao_transfer($lineid);
    }
    else
    {

        $str = "";
        $sql = "select aid,isstyle,lineday,txtjieshao,jieshao,showrepast from #@__line where id='$lineid' ";
        $row = $dsql->GetOne($sql);
        $repast_style = empty($row['showrepast']) ? "style='display:none'" : '';
        if(empty($row['isstyle']) || $row['isstyle'] == 0)
        {
            $row['isstyle'] = 1;
        }
        else
        {
            $row['isstyle'] = $row['isstyle'];
        }
        if($row['isstyle'] == 1) //编辑器里编辑的行程,直接读取
        {
            $out = $row['jieshao'];
        }
        elseif($row['isstyle'] == 2) //按天数上传的行程
        {
            $arr = explode(",",$row['txtjieshao']);
            for($i=1; $i<=$row['lineday']; $i++)
            {

                $detail = explode("||",$arr[$i-1]);


                //餐饮信息
                $foodarr = explode(' ',$detail[1]);
                $breakinfo = in_array(1,$foodarr) ? '含' : '不含';
                $lunchinfo = in_array(2,$foodarr) ? '含' : '不含';
                $supperinfo = in_array(3,$foodarr) ? '含' : '不含';
                $b_desc = !empty($detail[8]) ? $detail[8] : '无';
                $l_desc = !empty($detail[9]) ? $detail[9] : '无';
                $s_desc = !empty($detail[10]) ? $detail[10] : '无';


                //酒店信息
                $hotelinfo = getInfo('#@__hotel',"where title='$detail[3]'");
                $hashotel = !empty($hotelinfo['title']) ? 1 : 0;//是否有对应酒店.
                if($hashotel)
                {

                    $hotel_desc = cutstr_html(strip_tags($hotelinfo['content']),180);
                    $rankinfo = getInfo('#@__hotel_rank',"where aid = '{$hotelinfo['hotelrandid']}' and webid=0",'hotelrank');
                    $hotelrank = $rankinfo['hotelrank'];//酒店星级
                    $hotel_big_piclist = getHotelPic($hotelinfo,'big');//大图

                    $hotel_thumb_piclist = getHotelPic($hotelinfo,'thumb');//小图
                    $photoclass = empty($hotelinfo['piclist']) ? "style='display:none'" : '';//酒店轮播图是否显示.

                    $simple_hotel_style =  "style='display:none'"; //简单酒店隐藏

                }
                else
                {
                    $hotelstyle = "style='display:none'"; //酒店隐藏
                    $simple_hotel_style =  "style='display:block'"; //简单酒店显示
                }



                $out.='  <div class="day_level">
                	<div class="piont"></div>
                  <div class="xc_top">
                    <div class="xc_bg_pic">第'.$i.'天</div>
                    <h3>'. $detail[0] .'</h3>
                  </div>
                  <div class="xc_bom">
                    <div class="xc_cont">
                      <p>
                       '.$detail[4].'
                      </p>

                    </div>
                  </div>';

                $out.= getDaySpot($i,$row['aid'],$webid);

                $out.=' <div class="dinner_top "'.$repast_style.'>
                    <div class="dinner_bg_pic"></div>
                    <h3>用餐情况<span>（根据个人需求，可自行加菜，各地饮食习惯不同，请自行携带喜爱小菜）</span></h3>
                  </div>
                  <div class="dinner_data "'.$repast_style.'>
                    <table width="860" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="125">早餐</td>
                        <td align="center"><span>'.$breakinfo.'</span></td>
                        <td><b>参考：</b>'.$b_desc.'</td>
                      </tr>
                      <tr>
                        <td width="80">中餐</td>
                        <td align="center"><span>'.$lunchinfo.'</span></td>
                        <td><b>参考：</b>'.$l_desc.'</td>
                      </tr>
                      <tr>
                        <td>晚餐</td>
                        <td align="center"><span>'.$supperinfo.'</span></td>
                        <td><b>参考：</b>'.$s_desc.'</td>
                      </tr>
                    </table>
                  </div>
                  <div class="hotel_top" '.$simple_hotel_style.'>
                     <div class="hotel_bg_pic"></div>
                     <h3>住宿:'.$detail[3].'</h3>
                  </div>
                  <div class="hotel_top" '.$hotelstyle.'>
                    <div class="hotel_bg_pic"></div>
                    <h3>'.$hotelinfo['title'].'<span>（因季节不同，酒店需求不同，酒店只为参考，入住以实际安排为主）</span></h3>
                  </div>
                  <div class="hotel_all" '.$hotelstyle.'>
                  	<div class="h_left">
                    	<div class="h_top">
                      	<ul class="txt_js">
                        	<li class="title">地址：'.$hotelinfo['address'].'</li>
                          <li class="star_level"><b class="fl">参考星级：</b><span>'.$$hotelrank.'</span></li>
                          <li class="atc_txt">
                          	<p>'.$hotel_desc.'</p>
                          </li>
                        </ul>
                      </div>
                    	<div class="h_bot">
						'.getHotelExistAttr($hotelinfo['attrid']).'

                      </div>
                    </div>
                    <div class="h_rig" '.$photoclass.'>
                    	<!--酒店滚动图片开始-->
                      <div class="scrolltab">
                        <!--<span id="sLeftBtnA" class="sLeftBtnABan"></span>-->
                        <!--<span id="sRightBtnA" class="sRightBtnA"></span>-->
                        <ul class="ulBigPic">

                         '.$hotel_big_piclist.'


                        </ul><!--ulBigPic end-->
                        <div class="opacity_p"></div>
                        <div class="dSmallPicBox">
                          <div class="dSmallPic">
                            <ul class="ulSmallPic" style="width:2646px;left:0px" rel="stop">
                              '.$hotel_thumb_piclist.'
                            </ul>
                          </div>
                        </div>
                      </div>
                    	<!--酒店滚动图片开始-->
                    </div>
                  </div>
                </div>';




            }
        }

        return $out;
    }



	
	
}


function getJieShao_transfer($lineid)
{
    global $dsql;

    $str = "";
    $sql = "select aid,isstyle,lineday,jieshao,showrepast from #@__line where id='$lineid' ";
    $row = $dsql->GetOne($sql);
    $repast_style = empty($row['showrepast']) ? "style='display:none'" : '';
    $lineday = $row['lineday'];
    $out = '';
    if(empty($row['isstyle']) || $row['isstyle'] == 0)
    {
        $row['isstyle'] = 1;
    }
    else
    {
        $row['isstyle'] = $row['isstyle'];
    }
    if($row['isstyle'] == 1) //编辑器里编辑的行程,直接读取
    {
        $out = $row['jieshao'];
    }

    else if($row['isstyle'] == 2) //按天数上传的行程
    {
        $sql = "select * from #@__line_jieshao where lineid='$lineid' order by day asc";
        $arr = $dsql->getAll($sql);


        for($i=1; $i<=$lineday; $i++)
        {


            $j = $i-1;



            //餐饮信息

            $breakinfo = $arr[$j]['breakfirsthas'] ? '含' : '不含';
            $lunchinfo = $arr[$j]['lunchhas'] ? '含' : '不含';
            $supperinfo = $arr[$j]['supperhas'] ? '含' : '不含';
            $b_desc = !empty($arr[$j]['breakfirst']) ? $arr[$j]['breakfirst'] : '无';
            $l_desc = !empty($arr[$j]['lunch']) ? $arr[$j]['lunch'] : '无';
            $s_desc = !empty($arr[$j]['supper']) ? $arr[$j]['supper'] : '无';


            //酒店信息
            $arr[$j]['hotel'] = str_replace('\'','',$arr[$j]['hotel']);
            $hotelinfo = getInfo('#@__hotel',"where title='{$arr[$j]['hotel']}'");

            $hashotel = !empty($hotelinfo['title']) ? 1 : 0;//是否有对应酒店.
            if($hashotel)
            {

                $hotel_desc = cutstr_html(strip_tags($hotelinfo['content']),180);
                $rankinfo = getInfo('#@__hotel_rank',"where aid = '{$hotelinfo['hotelrandid']}' and webid=0",'hotelrank');
                $hotelrank = $rankinfo['hotelrank'];//酒店星级
                $hotel_big_piclist = getHotelPic($hotelinfo,'big');//大图

                $hotel_thumb_piclist = getHotelPic($hotelinfo,'thumb');//小图
                $photoclass = empty($hotelinfo['piclist']) ? "style='display:none'" : '';//酒店轮播图是否显示.

                $simple_hotel_style =  "style='display:none'"; //简单酒店隐藏

            }
            else
            {
                $hotelstyle = "style='display:none'"; //酒店隐藏
                $simple_hotel_style =  "style='display:block'"; //简单酒店显示
            }



            $out.='  <div class="day_level">
                	<div class="piont"></div>
                  <div class="xc_top">
                    <div class="xc_bg_pic">第'.$i.'天</div>
                    <h3>'. $arr[$j]['title'] .'</h3>
                  </div>
                  <div class="xc_bom">
                    <div class="xc_cont">
                      <p>
                       '.$arr[$j]['jieshao'].'
                      </p>

                    </div>
                  </div>';

            $out.= getDaySpot($i,$lineid);

            $out.=' <div class="dinner_top "'.$repast_style.'>
                    <div class="dinner_bg_pic"></div>
                    <h3>用餐情况<span>（根据个人需求，可自行加菜，各地饮食习惯不同，请自行携带喜爱小菜）</span></h3>
                  </div>
                  <div class="dinner_data "'.$repast_style.'>
                    <table width="860" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="125">早餐</td>
                        <td align="center"><span>'.$breakinfo.'</span></td>
                        <td><b>参考：</b>'.$b_desc.'</td>
                      </tr>
                      <tr>
                        <td width="80">中餐</td>
                        <td align="center"><span>'.$lunchinfo.'</span></td>
                        <td><b>参考：</b>'.$l_desc.'</td>
                      </tr>
                      <tr>
                        <td>晚餐</td>
                        <td align="center"><span>'.$supperinfo.'</span></td>
                        <td><b>参考：</b>'.$s_desc.'</td>
                      </tr>
                    </table>
                  </div>
                  <div class="hotel_top" '.$simple_hotel_style.'>
                     <div class="hotel_bg_pic"></div>
                     <h3>住宿:'.$arr[$j]['hotel'].'</h3>
                  </div>
                  <div class="hotel_top" '.$hotelstyle.'>
                    <div class="hotel_bg_pic"></div>
                    <h3>'.$hotelinfo['title'].'<span>（因季节不同，酒店需求不同，酒店只为参考，入住以实际安排为主）</span></h3>
                  </div>
                  <div class="hotel_all" '.$hotelstyle.'>
                  	<div class="h_left">
                    	<div class="h_top">
                      	<ul class="txt_js">
                        	<li class="title">地址：'.$hotelinfo['address'].'</li>
                          <li class="star_level"><b class="fl">参考星级：</b><span>'.$$hotelrank.'</span></li>
                          <li class="atc_txt">
                          	<p>'.$hotel_desc.'</p>
                          </li>
                        </ul>
                      </div>
                    	<div class="h_bot">
						'.getHotelExistAttr($hotelinfo['attrid']).'

                      </div>
                    </div>
                    <div class="h_rig" '.$photoclass.'>
                    	<!--酒店滚动图片开始-->
                      <div class="scrolltab">
                        <!--<span id="sLeftBtnA" class="sLeftBtnABan"></span>-->
                        <!--<span id="sRightBtnA" class="sRightBtnA"></span>-->
                        <ul class="ulBigPic">

                         '.$hotel_big_piclist.'


                        </ul><!--ulBigPic end-->
                        <div class="opacity_p"></div>
                        <div class="dSmallPicBox">
                          <div class="dSmallPic">
                            <ul class="ulSmallPic" style="width:2646px;left:0px" rel="stop">
                              '.$hotel_thumb_piclist.'
                            </ul>
                          </div>
                        </div>
                      </div>
                    	<!--酒店滚动图片开始-->
                    </div>
                  </div>
                </div>';




        }
    }

    return $out;


}

/*-------------
 标准模板函数
 @2013-10-10
--------------*/

//酒店轮播图HTML
function getHotelPic($hotelinfo,$type='big')
{
	$picarr = RemoveEmpty(explode(',',$hotelinfo['piclist']));
	
	$url = GetWebURLByWebid($hotelinfo['webid']).'/hotels/show_'.$hotelinfo['aid'].'.html';
    $k = 1;
	$out = '';
	foreach($picarr as $pic)
	{
	 
	     $p = explode('||',$pic);
		 $picname = !isset($p[1]) ? $p[1] : $hotelinfo['title'];//图片名称
		 $litpic = getUploadFileUrl($p[0]); //图片地址
		 if($type == 'big')
		 {
			  $class = $k==1 ? 'liSelected' : '';
			  $out.=' <li class="'.$class.'"><span class="sPic"><i class="iBigPic"><a href="javascript:;" target="_blank" ><img  width="485" height="325" src="'.$litpic.'" /></a></i></span></li>';
		 }
		 else if($type == 'thumb')
		 {
			 $thumb = str_replace('litimg','lit160',$litpic);
			 $out .=' <li class="'.$class.'"><span class="sPic"><img  src="'.$thumb.'" width="65" height="50" /></span></li>';	
			 
		 }
		 
		 $k++;
		
		
	   
	}
	return $out;  			  
	
}

//检测是否有图

//获取酒店存在属性
function getHotelExistAttr($attrid)
{
	Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__hotel_attr');
	$arr = explode(',',$attrid);
	
	$group = array();
	foreach($arr as $id)
	{
	    $row = $model->getOne("id='$id'");	
		
		$attrname = $row['attrname'];
		$groupname = $model->getField('attrname',"id='{$row['pid']}'");
		
	    $group[$groupname][] = $attrname;
	}
	
	foreach($group as $key =>$value)
	{
		$out.="<p>".$key.":".implode(',',$value).'</p>';
		
	}
	return $out;
	
}



//获取线路里的景点图片(smore模板).
function getSpotPic($spotinfo,$spotid,$webid)
{
	$picarr = explode(',',$spotinfo['piclist']);
	
	$url = GetWebURLByWebid($spotinfo['webid']).'/spots/show_'.$spotinfo['aid'].'.html';
    $k = 1;
	foreach($picarr as $pic)
	{
	  if($k<=3)
	  {
	     
		 $p = explode('||',$pic);
		 $picname = !empty($p[1]) ? $p[1] : $spotinfo['title'];//图片名称
		 $litpic = !empty($p[0]) ? getUploadFileUrl($p[0]) : getUploadFileUrl($spotinfo['litpic']); //图片地址
		 //array_push($out,array('picname'=>$picname,'litpic'=>$litpic));
		 $out.='<li><a class="sl_a1" href="'.$url.'" target="_blank"><img class="fl" src="'.$litpic.'" width="245" height="175" alt="'.$picname.'" title="'.$picname.'" /></a><a class="sl_a2" href="'.$url.'" target="_blank">'.$picname.'</a></li>';
		 $k++;
	   }
	   
	}
	return $out;
	
}

function getDaySpot($day,$lineid,$webid=0)
{
	global $dsql;
	$sql = "select * from #@__line_dayspot where day = '$day' and lineid='$lineid'";
	$arr = $dsql->getAll($sql);
	foreach($arr as $row)
	{
		$spotinfo = getInfo('#@__spot',"where id='{$row['spotid']}' ",'aid,content,piclist,litpic,title,webid');
		$description = cutstr_html(strip_tags($spotinfo['content']),200);//景点描述
		
		
		$spotpic = getSpotPic($spotinfo,$row['spotid'],$webid);
		
		
		$out.=' <div class="spot_top">
                    <div class="spot_bg_pic"></div>
                    <h3>'.$row['title'].'</h3>
                  </div>
                  <div class="spot_num">
                  	<div class="spot_p">
                    	<p>'.$description.'</p>
                    </div>
                    <ul class="spot_img">'
					.$spotpic.
					'
                    </ul>
                  </div>';
		
	}
	return $out;
	
	
}



function GetImageStandard($url,$name,$smallurl)
{
	$imgname = explode(" ",$name);
	$imgarr = explode(" ",$url);
	$imgsmallarr = explode(" ",$smallurl);
	$str = "";
	for($j=0; isset($imgarr[$j]); $j++)
	{
		if(!empty($imgarr[$j]))
		{
			if(empty($imgsmallarr[$j]))
			{
			  $imgsmallarr[$j]=$imgarr[$j];
			}
		
		   if(file_exists($GLOBALS['cfg_basedir'].$imgsmallarr[$j]))
		   {
			   $str .="<li><img class=\"fl\" src=\"".$imgsmallarr[$j] ."\" alt=\"" . $imgname[$j] . "\" title=\"" . $imgname[$j] . "\" width=\"360\" height=\"250\" /><span>". $imgname[$j] ."</span></li>"; 
		   }
		  
		  
			
			
		}
		
	}
	return $str;
}
//线路信息
function getStandardInfo($aid)
{
	global $dsql;
    $webid = $GLOBALS['sys_child_webid'];
	//$sql="select * from #@__line where webid='$webid' and aid=$aid";
	$sql="select a.*,b.dingjin as dj from #@__line as  a LEFT JOIN #@__line_suit as b on(a.id = b.lineid) where webid='$webid' and aid=$aid";
    $row=$dsql->GetOne($sql);
	return $row;	
}
//扩展信息
function getExtendInfo($aid)
{
	global $dsql;
	$extsql = "select * from #@__line_extend where lineid=$aid";
    $rowext=$dsql->GetOne($extsql);
	return $rowext;
	
}
//评论数量
function getPyNum($row)
{
	global $dsql;
	$arr=$dsql->GetOne("select count(*) as num from #@__allcomments where typeid=1 and webid={$row['webid']} and postid={$row['aid']}");

    $total=empty($arr['num'])? '0' : $arr['num'];
	
	return $total;
}

//线路内容模块

function getLineContent($row,$istemplets)
{
  global $dsql;
  $linecontent=array();
  $sql="select columnname,chinesename from #@__line_content where webid=0 and isopen=1 order by displayorder asc";
  $dsql->Execute('me',$sql);
  while($arr = $dsql->GetArray())
  {
	 if($arr['columnname']=="payment")
	 {
		if($row[$arr['columnname']]=="")
		{
		  $row[$arr['columnname']]=$GLOBALS['cfg_payment'];
		}
	 }
	 if($arr['columnname']=="linespot")
	 {
		 //$row[$arr['columnname']]=GetRecSpot($row['aid'],'0');
		 $row[$arr['columnname']] = '';
	 }
	 if($arr['columnname']=="pinglun")
	 {
		 $row[$arr['columnname']] = '';
		// $row[$arr['columnname']]=GetIncFeedBack($row['aid'],1,$row['linename'],'0');
         //$row[$arr['columnname']] = getLineComment();
	 }
	 if($arr['columnname']=="booking")
	 {
		
		{
		   	$row[$arr['columname']]= '';
		}
		
	 }
	 if($arr['columnname']=="zuche")
	 {
		$row[$arr['columnname']]='';
	 }
	 if($arr['columnname']=="jieshao")
	 {
		 $row[$arr['columnname']]=GetJieShao($row['aid'],'0',$istemplets);
	 }
	 if(!empty($row[$arr['columnname']]))//判断是否为空
	 {
	    if($arr['columnname']!='jieshao')
		{
		  $linecontent[$arr['chinesename']]="<div class='pid_l10'>".$row[$arr['columnname']].'</div>'; 	
		}
		else
	    {
		  $linecontent[$arr['chinesename']]=$row[$arr['columnname']];
		}
	    
	 }
  }
  
  return $linecontent;
	
}

//新版获取线路内容
 function getLineContent2($row)
{
    if($row['columnname']!='jieshao')
    {
        $content = $row['content'];
    }
    else
    {
        $content = getJieShao_smore($row['productid']); //行程内容
    }
    return $content;



}


//获取线路评论

function getLineComment($articleid)
{
   $innertext ='
                    {sline:getcommentlist flag="hotel"}
                    <div class="pl_list">
                    <ul class="fl">
                        <li class="li_1">
                        <div class="pl_pic"><img class="fl" src="[field:litpic/]" width="73" height="73" /></div>
                        <div class="pl_txt">
                            <dl>
                            <dt>会员：[field:nickname/]</dt>
                            <dd>
                              <p><b>导游服务：</b><span><s style=" width: [field:percent1/]"></s></span></p>
                              <p><b>线路游玩：</b><span><s style=" width: [field:percent2/]"></s></span></p>
                              <p><b>往返交通：</b><span><s style=" width: [field:percent3/]"></s></span></p>
                              <p><b>餐饮住宿：</b><span><s style=" width: [field:percent4/]"></s></span></p>
                            </dd>
                          </dl>
                        </div>
                        <div class="pl_myd">
                            <span><s style=" width:[field:percent/]"></s></span>
                        </div>
                      </li>
                      <li class="li_2">
                        <s class="jt_bg"></s>
                        <p>[field:content/]</p>
                      </li>
                    </ul>
                  </div>
                  {/sline:getcommentlist}
                ';

}


//获取最近报价
function getMonthPriceList($lineid)
{

    global $dsql;

    $time = strtotime(date('Y-m-d'));//现在时间
    $sql = "select * from #@__line_suit_price where lineid='$lineid' and day > '$time' order by day asc limit 0,5";


    $arr = $dsql->getAll($sql);
    $monthprice=array();


    foreach($arr as $row)
    {
        $key = date('m-d',$row['day']);
        $monthprice[$key]=$row['adultprice'];


    }


    return $monthprice;

	
}


//分析处理图片
function getPiclistArr($row)
{
    $num=0;
    if(empty($row['litpic'])&&empty($row['piclist']))//没有任何图片时处理
	{

		  $temp_small=empty($GLOBALS['cfg_df_img'])?'/templets/default/images/pic_tem.gif':$GLOBALS['cfg_df_img'];
          $temp_big=empty($GLOBALS['cfg_df_img'])?'/templets/default/images/pic_tem.gif':$GLOBALS['cfg_df_img'];

		  $biglist =' <li><img src="'.$temp_big.'" width="611" height="300"/></li>';
          $thumblist =' <li><s></s><img src="'.$temp_small.'" width="96" height="65"/></li>';
		 
	}
	else if(empty($row['piclist'])&&!empty($row['litpic'])) //只上传封面的情况.
	{
          $litpic=str_replace('litpic','lit160',$row['litpic']);
          $bigpic = str_replace('litimg','allimg',$litpic);
		  $biglist =' <li><img src="'.$biglist.'" width="611" height="300"/></li>';
          $thumblist =' <li><s></s><img src="'.$litpic.'" width="96" height="65"/></li>';
		
	}
	else
	{

	   $picarr=explode(',',$row['piclist']);
	   if(!empty($row['litpic']))
	   //array_unshift($picarr,$row['linepic']);//排除封面图片
	   foreach($picarr as $value)
	   {  
		  if(empty($value))
		  {
		   continue;
		  }
		   $temparr=explode('||',$value);
           $bigpic = str_replace('litimg','allimg',$temparr[0]);
		   $biglist .=' <li><img src="'.$bigpic.'" alt="'.$temparr[1].'" width="611" height="300"/></li>';
		   $thumbpic=str_replace('allimg','lit160',$temparr[0]);
		   $thumblist.='<li><s></s><img src="'.$thumbpic.'" width="96" height="65"/></li>';
		   $num++;
		}
	}

	return array($biglist,$thumblist);
}
//处理出发日期列表和出发日期下拉选择
function getLineStartDate($row)
{
	global $dsql;
	$today=time();
    $montharr=getMonthPriceList($row['id']);
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
				$text = $key.'(周'.getCnWeek($weekday).')成人价'.$value.' 儿童价'.$row['childprice'];
				$monthli.='<option value="'.$key.'" data-price="'.$value.'" data-childprice="'.$row['childprice'].'">'.$text.'</option>';
				
				//$monthli.='<li class="a1" adult="'.$value.'" content="'.date('m',$today).'-'.$key.'周'.getCnWeek($weekday).'出发,&lt;b&gt;'.'&lt;/b&gt;元/成人,&lt;b&gt;'.$value.'&lt;/b&gt;元/儿童" date="'.date('Y-m',$today).'-'.$key.'" childprice="'.$row['childprice'].'" personchildren="'.$row['childprice'].'" jounerygroupid="0">'.date('m',$today).'-'.$key.'周'.getCnWeek($weekday).',<b>'.$value.'</b>元/成人,<b>'.$row['childprice'].'</b>元/儿童</li>';
			
	     }
		if(!empty($monthstr))
		{    
		     $monthstr=trim($monthstr,'、');
			 $monthstr.='日,';
		}
		
     }
	 return array('monthstr'=>$monthstr,'monthli'=>$monthli);
	
}
//航空公司名称
function getPlaneCompany($ticketid)
{
	global $dsql;
	$sql = "select company from #@__ticket where aid='$ticketid'";
	$row = $dsql->GetOne($sql);
	return empty($row['company']) ? '' : '<' . $row['company'] . '>';
}
//获取星期
function getCnWeek($num)
{
	$arr=array('日','一','二','三','四','五','六');
	return $arr[(int)$num];
}

//获取交通
function getTransport($ids)
{
	$transport=array("1"=>"飞机","2"=>"汽车","3"=>"火车","4"=>"轮船");
	$arr = explode(',',$ids);
    $out = '';
	foreach($arr as $value)
	{
	   $out.=$transport[$value].',';	
	}
	return substr($out,0,strlen($out)-1);
	
}



?>