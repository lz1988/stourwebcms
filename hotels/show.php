<?php 
  require_once(dirname(__FILE__)."/../include/common.inc.php");
  require_once SLINEINC."/view.class.php";
  require_once "hotel.func.php";
  $typeid=2; //酒店栏目
  $pv = new View($typeid);
  if(!isset($aid)) head404();;
  $aid=RemoveXSS($aid);//防止跨站攻击
  updateVisit($aid,$typeid);//更新访问次数
  $row = getHotelInfo($aid,1);//获取酒店信息
  if(empty($row['id']))
  {
	head404();
  }
  $row['litpic']= getUploadFileUrl($row['litpic']);

  $row['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
  $row['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
  $row['subname']=$row['title'];
  $minprice = Helper_Archive::getHotelMinPrice($row['id']);
  $row['hotelprice']= $minprice == 0 ? "电询" : '<span>&yen;</span><strong>'.$minprice.'</strong><s>起</s>';
  //$row['imagecount']=GetImageCount($row['hotelpics']);
  $row['pkname'] = get_par_value($row['kindlist'],$typeid);//上级目的地
  if(empty($row['telephone']))
  {
	$tel=getHotelNumber($row['webid']);
	$row['telephone']=$tel;
  }
  $row['commenthomeid']=$row['id']; //读取评论用
	
    //获取上级开启了导航的目的地
    getTopNavDest($row['kindlist']);

   $extendRow=$dsql->GetOne("select * from #@__hotel_extend_field where productid={$row['id']}");
   if(!empty($extendRow))
   {
       unset($extendRow['id']);
       unset($extendRow['productid']);
       $row=array_merge($row,$extendRow);
   }

	foreach($row as $k=>$v)
	{
	   $pv->Fields[$k] = $v;
	}
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

  //是否显示条件.
  if(!empty($row['fuwu']))
  $GLOBALS['condition']['_hasfuwu']=1;
  if(!empty($row['traffic']))
  $GLOBALS['condition']['_hastraffic']=1;
  
  if(!empty($row['aroundspots']))
  $GLOBALS['condition']['_hasaroundspots']=1;
  if(!empty($row['notice']))
  $GLOBALS['condition']['_hasnotice']=1;
  if(!empty($row['equipment']))
  $GLOBALS['condition']['_hasequipment']=1;
  //图片获取
  $picArr = getPiclistArr($row['piclist']);

  $biglist = !empty($picArr['big']) ? $picArr['big'] : array(array('0'=>$row['litpic']));//大图
  $GLOBALS['thumblist'] =!empty($picArr['thumb']) ? $picArr['thumb'] : array(array('0'=>$row['litpic']));//大图 $picArr['thumb'];//小图
  //特色服务项目
  $service = getHotelService($row['attrid'],202);
  $typename=GetTypeName($typeid);//获取栏目名称.
  $pv->Fields['typename'] = $typename;
  $pv->Fields['service'] = $service;
  $pv->Fields['title']=!empty($row['seotitle'])?$row['seotitle']:$row['title'];
  $templets = $row['templet'];

    if(strpos($templets,'uploadtemplets')!==false)
    {
        $templet = SLINETEMPLATE.'/smore/'.$templets.'/index.htm';//使用自定义模板
    }
    else
    {
        $templet = SLINETEMPLATE ."/".$cfg_df_style ."/" ."hotels/hotel_show.htm";//系统标准模板
    }

  $pv->SetTemplet($templet);
  
  $pv->Display();
  
  exit();



?>
