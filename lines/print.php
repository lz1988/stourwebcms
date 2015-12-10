<?php 

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/linecontent.php");

$typeid=1; //线路栏目


require_once SLINEINC."/view.class.php";

$pv = new View($typeid);

if(!isset($aid)) exit('Wrong Id');
$aid=RemoveXSS($aid);//防止跨站攻击
$sql="select * from #@__line where webid=0 and aid=$aid";
$row=$dsql->GetOne($sql);
if(empty($row[id]))
{
	head404();
}
if(is_array($row))
		  {
		   

			 if(!empty($row['storeprice']) || $row['storeprice'] > $row['price'])
			 {
			   $row['cheap']=$row['storeprice']-$row['price'];
			 }
			 else
			 {
				$row['cheap']=0; 
			 }
			 $row['price']=!empty($row['price'])?"<span class=\"rmb_1\">￥</span>".$row['price']."</span>":"电询</span>";
			 $row['storeprice']=!empty($row['storeprice'])?$row['storeprice']."</span>":"无</span>";
			 $row['litpic']=empty($row['litpic'])? getDefaultImage():$row['litpic'];
			 $row['description']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
			 $row['keywords']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
			 $row['subname']=$row['title'];
			 $row['id']=strlen($row['id'])==1?"0".$row['id']:$row['id'];
			 $row['seotitle']=!empty($row['seotitle']) ? $row['seotitle'] : $row['title'];
             $row['startplacename'] = getStartCityName($row['startcity']);
		    foreach($row as $k=>$v)
            {
                $pv->Fields[$k] = $v;
            }
			//print_r($this->Fields);
		  }
$pv->Fields['title']=!empty($row['seotitle'])?$row['seotitle']:$row['title'];

$linecontent = getLineContentPrint($row,1);//线路介绍分类

$typename=GetTypeName($typeid);//获取栏目名称.

$pv->Fields['typename'] = $typename;
	
$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."lines/" ."print.htm");

$pv->Display();

//打印页面函数重写
//线路内容模块

function getLineContentPrint($row,$istemplets)
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

            $row[$arr['columnname']] = '';
        }
        if($arr['columnname']=="pinglun")
        {
            $row[$arr['columnname']] = '';

        }
        if($arr['columnname']=="booking")
        {


                $row[$arr['columname']]= '';


        }
        if($arr['columnname']=="zuche")
        {
            $row[$arr['columnname']]='';
        }
        if($arr['columnname']=="jieshao")
        {
            $row[$arr['columnname']]=getJieShaoPrint($row['aid'],'0',$istemplets);
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
//标准版smore行程样式
function getJieShaoPrint($lineid, $webid, $templets)
{
    global $dsql;
    $str = "";
    $sql = "select id,isstyle,lineday,jieshao,showrepast from #@__line where aid='$lineid' and webid='$webid'";
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
        $sql = "select * from #@__line_jieshao where lineid='{$row['id']}' order by day asc";
        $arr = $dsql->getAll($sql);
        for($i=1; $i<=$row['lineday']; $i++)
        {

            //$detail = explode("||",$arr[$i-1]);
            //餐饮信息
            $j=$i-1;
            $breakinfo = $arr[$j]['breakfirsthas'] ? '含' : '不含';
            $lunchinfo = $arr[$j]['lunchhas'] ? '含' : '不含';
            $supperinfo = $arr[$j]['supperhas'] ? '含' : '不含';
            $breakinfo =!empty($arr[$j]['breakfirst']) ? $arr[$j]['breakfirst'] : $breakinfo;
            $lunchinfo = !empty($arr[$j]['lunch']) ? $arr[$j]['lunch'] : $lunchinfo;
            $supperinfo = !empty($arr[$j]['supper']) ? $arr[$j]['supper'] : $supperinfo;

            //酒店信息

            $out .= '<div class="xc_day">
        	<div class="day_tit">
          	<span class="sp_1">第'.$i.'天</span>
            <span class="sp_2">'. $arr[$j]['title'] .'</span>
            <div class="day_con">
            	'.$arr[$j]['jieshao'].'
            </div>
          </div>';
          // $out.= getDaySpotPrint($i,$lineid,$webid);

              $out.='
              <div class="yc_con">
                <span class="tit">用餐情况:</span>
                <span class="can">早餐：'.$breakinfo.'</span>
                <span class="can">午餐：'.$lunchinfo.'</span>
                <span class="can">晚餐：'.$supperinfo.'</span>
              </div>
              <div class="zhusu">
                <span class="tit">住宿情况</span>
                <p class="hotel">'.$arr[$j]['hotel'].'</p>
              </div>
            </div>';





        }
    }

    return $out;


}

function getDaySpotPrint($day,$lineid,$webid)
{
    global $dsql;
    $sql = "select * from #@__line_dayspot where day = '$day' and lineid='$lineid' and webid='$webid'";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $spotinfo = getInfo('#@__spot',"where id='{$row['spotid']}' ",'aid,content,piclist,litpic,title,webid');
        $description = cutstr_html(strip_tags($spotinfo['content']),200);//景点描述


        $spotpic = getSpotPicPrint($spotinfo,$row['spotid'],$webid);

        $out.='<div class="jingdian">
          	<span class="tit">游玩景点 ：'.$row['title'].'</span>
            <div class="jd_con">
            	'.$description.'
            </div>
            <ul class="jd_ul">'
            	 .$spotpic.
            '</ul>

          </div>';


    }
    return $out;


}

function getSpotPicPrint($spotinfo,$spotid,$webid)
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

function getStartPlacePrint($id)
{
    $info = getInfo('#@__startplace',"where id='{$id}' ",'cityname');
    return $info['cityname'];

}

?>
