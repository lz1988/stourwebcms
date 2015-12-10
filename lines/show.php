<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/linecontent.php");
$typeid=1; //线路栏目
require_once SLINEINC."/view.class.php";

$pv = new View($typeid);
if(!isset($aid)) exit('Wrong Id');

$aid=RemoveXSS($aid);//防止跨站攻击

updateVisit($aid,$typeid);//更新访问次数

$row = getStandardInfo($aid);//基本信息


$rowext = getExtendInfo($aid);////扩展信息表

//如果不存在则跳转至404页面
if(empty($row['id']))
{
	head404();
}

$templets = $row['templet'];//使用的模板

loadUserFunc($templets);//载入用户自定义函数类

if(is_array($row))
{

   Helper_Archive::setHistoryCookie($row['id'],'line');
			  

   $real=getLineRealPrice($row['aid'],$row['webid']);
   $row['price'] = empty($row['price'])?'<span>电询</span>':$row['price'];
   $row['lineprice']=!empty($real) ? $real : $row['price'];//线路报价
   $row['transport']=$row['transport'];
   $row['dingjin']=$row['dj'];
   $row['score'] = Helper_Archive::getSatisfyScore($row['id'],$typeid);//分数
   $row['commentnum'] = Helper_Archive::getCommentNum($row['id'],$typeid);//点评数
   $row['commenthomeid'] = $row['id'];
   if(!empty($row['storeprice']) || $row['storeprice'] > $row['lineprice'])
   {
	 $row['cheap']=$row['storeprice']-$row['lineprice'];//优惠
   }
   else
   {
	  $row['cheap']=0; 
   }	   
   $pic_arr=getPiclistArr($row);//读取图片带样式列表
   $row['bigpiclist']=$pic_arr[0];//大图
   $row['thumblist']=$pic_arr[1];
  
        //获取后台满意度拼接%
  // $row['satisfyscore'] = !empty($row['satisfyscore'])?$row['satisfyscore'] : "";
   if(!empty($row['satisfyscore']))
   {
       if(strpos($row['satisfyscore'],'%')===false)
       {
          $row['satisfyscore'] = $row['satisfyscore'].'%';
       }

   }

   //$row['price']=!empty($row['lineprice'])?"<span class=\"rmb_1\">￥</span>".$row['lineprice']."</span>":"电询</span>";
   
   $row['storeprice']=!empty($row['storeprice'])?$row['storeprice']:"<span>无</span>";
   $row['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
   $row['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
   $row['seotitle']=!empty($row['seotitle']) ? $row['seotitle'] : $row['title'];
   $row['sellnum']=Helper_Archive::getSellNum($row['id'],1)+$row['bookcount']; //销售数量

   $row['lineseries']=getSeries($row['id'],'01');//编号
   $row['pkname'] = get_par_value($row['kindlist'],$typeid);//上一级
   //$row['pkname'] = getOrderKindlist($row['kindlist'],$typeid);
   $GLOBALS['lineattach'] = $row['linedoc'] ? $row['linedoc'] : '';

    //支付方式
    $paytypeArr=explode(',',$GLOBALS['cfg_pay_type']);
    if(in_array(1,$paytypeArr))//支付宝
    {
        $GLOBALS['condition']['_haszhifubao'] = 1;
    }
    if(in_array(2,$paytypeArr))//快钱
    {
        $GLOBALS['condition']['_haskuaiqian'] = 1;
    }
    if(in_array(3,$paytypeArr))//汇潮
    {
        $GLOBALS['condition']['_hashuicao'] = 1;
    }
    if(in_array(4,$paytypeArr))//银联
    {
        $GLOBALS['condition']['_hasyinlian'] = 1;
    }
    if(in_array(5,$paytypeArr))//钱包
    {
        $GLOBALS['condition']['_hasqianbao'] = 1;
    }
    if(in_array(7,$paytypeArr))//贝宝
    {
        $GLOBALS['condition']['_hasbeibao'] = 1;
    }
    if(in_array(8,$paytypeArr))//微信
    {
        $GLOBALS['condition']['_hasweixin'] = 1;
    }



   foreach($row as $k=>$v)
   {
	  $pv->Fields[$k] = $v;//模板变量赋值
   }
	
}
//$linecontent = getLineContent($row,$rowext['istemplets']);//线路介绍分类

 //获取上级开启了导航的目的地
getTopNavDest($row['kindlist']);
$typename=GetTypeName($typeid);//获取栏目名称.
$pv->Fields['typename'] = $typename;

if(strpos($templets,'uploadtemplets')!==false)
{
    $templet = SLINETEMPLATE.'/smore/'.$templets.'/index.htm';//使用自定义模板
}
else
{
    $templet = Helper_Archive::getUseTemplet('line_show');//获取系统默认使用模板

    $templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."lines/" . $templets;//系统标准模板
}
$pv->SetTemplet($templet);

$pv->Display();

exit();


//加载自定义函数(用于用户上传模板
function loadUserFunc($templet)
{
    $templet_path = explode('/',$templet);

    array_pop($templet_path);

    array_push($templet_path,'php/function.php');
    $function_file = SLINETEMPLATE.'/smore/lines/'.implode('/',$templet_path);
    if(file_exists($function_file))
    {
        include($function_file);
    }

}

function getLineAttrName2($attrid)
{
    $arr = getLineAttrArr($attrid);
    foreach($arr as $v)
    {
        $out.="<span>{$v}</span>";
    }
    return $out;

}

function getLineAttrArr($attrid,$esplit=',')
{
    global $dsql;
    $arr = explode($esplit,$attrid);
    $out = array();
    $i = 0;
    foreach($arr as $id)
    {
        $sql = "select attrname from #@__line_attr where id='$id' and pid!=0";
        $row = $dsql->GetOne($sql);
        if(!empty($row['attrname']) && $i<6)
            array_push($out,$row['attrname']);
        $i++;

    }

    return $out;
}


//分析处理图片
/***********
*$piclist       线路数组
*$bigtemp   大图字符串数据
*$thumbtemp     小图字符串数据
*$replacetemp 需替换字符串数据
*模版里面调整用实列：
{sline:field.piclist runphp='yes'}
  $bigtemp = '<li><img src="%src%" width="526" height="300"/></li>';
  $tumbtemp = '<li><img src="%src%" width="80" height="56"/></li>';
  @me=getPiclistArrZ(@me,1,$bigtemp,$tumbtemp,'%src%');
{/sline:field.piclist}
************/
function getPiclistArrZ($piclist,$isda=1,$bigtemp=' <li><img src="{src}" width="611" height="300"/></li>',$thumbtemp=' <li><s></s><img src="{src}" width="96" height="65"/></li>',$replacetemp='{src}')
{
  $num=0;
  if(empty($piclist))//没有任何图片时处理
  {

      $temp_small=empty($GLOBALS['cfg_df_img'])?'/templets/default/images/pic_tem.gif':$GLOBALS['cfg_df_img'];
      $temp_big=empty($GLOBALS['cfg_df_img'])?'/templets/default/images/pic_tem.gif':$GLOBALS['cfg_df_img'];

      $biglist = str_replace($replacetemp,$temp_big,$bigtemp);
      $thumblist = str_replace($replacetemp,$temp_small,$thumbtemp);
     
  }
  else
  {
     $picarr=explode(',',$piclist);
     foreach($picarr as $value)
     {  
      if(empty($value))
      {
       continue;
      }
       $temparr=explode('||',$value);
       $bigpic = str_replace('litimg','allimg',$temparr[0]);
       $biglist .= str_replace($replacetemp,$bigpic,$bigtemp);
       $thumbpic=str_replace('allimg','lit160',$temparr[0]);
       $thumblist .= str_replace($replacetemp,$thumbpic,$thumbtemp);
       $num++;
    }
  }
  if($isda==1){
    return $biglist;
  }else{
    return $thumblist;
  } 
}


//调用供应商名称
function getLineSupplier($supplierlist)
{
    global $dsql;
    $out = '';
    $sql = "select suppliername from #@__supplier where id=$supplierlist";
    $row = $dsql->GetOne($sql);
    if(!empty($row['suppliername']))
      $out = $row['suppliername'];
    return $out;

}
?>
