<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once (SLINEINC.'/ctrip/ticket/piao.class.php');
require_once SLINEINC."/view.class.php";
$typeid = 5;
$action = $action ? $action : 'search';

//搜索页面
if($action == 'search')
{
    $k1 = Helper_Archive::pregReplace($k1,1);
    $k2 = Helper_Archive::pregReplace($k2,1);
    $k3 = Helper_Archive::pregReplace($k3,1);
    $page = Helper_Archive::pregReplace($page,2);

    $key_arr= array(
        'k1'=>$k1,
        'k2'=>$k2,
        'k3'=>$k3
    );
    $keywordlist = array();
    if(!empty($k1))$keywordlist[]=array('keyword'=>$k1,'type'=>'区域','keywordtag'=>'k1');
    if(!empty($k2))$keywordlist[]=array('keyword'=>$k2,'type'=>'景区','keywordtag'=>'k2');
    if(!empty($k3))$keywordlist[]=array('keyword'=>$k3,'type'=>'类型','keywordtag'=>'k3');
    $keyword = implode(',', array_filter($key_arr));


    $page = $page ? $page : 1;
    $pagesize = 10;
    $pv = new View($typeid);
    $pv->GetChannelKeywords($typeid); //根据栏目类型获取关键词.介绍,栏目名称
    $piao = new Piao();
    $list = $piao->getSpotList($page, $pagesize, $keyword, 0);
    $zone = $list['zone'];
    $jingqu = $list['jingqu'];
    $spotkind = $list['spotkind'];
    $spotlist = $list['spotlist'];//景点列表
    $pagecount = $list['pagecount'];
    $rowcount = $list['rowcount'];
    if($rowcount==0)$spotlist=null;

//存在条件
    if (count($keywordlist)>0) $GLOBALS['condition']['_haskeyword'] = 1; //是否已选择了关键词
    if (count($zone)>0&&is_array($zone[0])) $GLOBALS['condition']['_haszone'] = 1; //是否有区域
    if (count($jingqu)>0&&is_array($jingqu[0])) $GLOBALS['condition']['_hasjingqu'] = 1; //是否有景区
    if (count($spotkind)>0&&is_array($spotkind[0])) $GLOBALS['condition']['_hasspotkind'] = 1; //是否有景区类型

    if (count($zone)>12) $haszonemore = 1;
    if (count($jingqu)>12) $hasjingqumore = 1;
    if (count($spotkind)>12) $hasspotkindmore = 1;



    $templet = SLINETEMPLATE . "/" . $cfg_df_style . "/" . "spots/" . "spot_ctrip.htm";
    $pv->SetTemplet($templet);
    $pv->Display();
    exit();
}

//详细页面
if($action == 'show')
{
    $productid = Helper_Archive::pregReplace($productid,2);
    $piao = new Piao($typeid);
    $info = $piao->getSpotDetail($productid);

    $suit = $info['suit'];
    $litpic = CtripTicket::getLitpic($info['image']);

    $piclist = $info['piclist'];


    if(empty($info['jieshao']))
    {

        $url = "http://u.ctrip.com/union/CtripRedirect.aspx?TypeID=502&AllianceID=".$GLOBALS['cfg_ctrip_allianceid']."&SID=".$GLOBALS['cfg_ctrip_sid']."&Ouid=&locationID=".$info['id'];
        header("location:$url");//复杂套餐直接到携程预订
        exit;
    }
    $pv = new View();
    foreach($info as $k=>$v)
    {
        $pv->Fields[$k] = $v;//模板变量赋值
    }
    $pv->Fields['typeid'] = $typeid;
    $templet = SLINETEMPLATE . "/" . $cfg_df_style . "/" . "spots/" . "spot_ctrip_show.htm";
    $pv->SetTemplet($templet);
    $pv->Display();
    exit();

}



class CtripTicket{

    public static function getTicketList($suitlist)
    {
        $out = '';
        $i = 1;
        foreach($suitlist as $row)
        {
            $style = $i>5 ? " style='display:none'" : '';
            $out.= '<dl'.$style.'>
             		<dt class="attractions_dt">
            			 <a href="javascript:;">'.$row['Name'].'</a>
            		 </dt>
            		 <dd class="attractions_dd">
             		￥'.$row['MarketPrice'].'
             		</dd>
            	 	<dd class="attractions_dd2">
           		 	 ￥'.$row['Price'].'
            		 </dd>
             		<dd class="attractions_dd3">
            	 	<a href="javascript:;" class="suit_ding">预 定</a>
             		</dd>
            	 </dl>';
            $i++;

        }
        return $out;
    }

    public static function getLitpic($image)
    {
        $ext = explode('.',$image);
        $pic = explode('_',$image);
        $litpic = $pic[0].'.'.$ext[count($ext)-1];
        return $litpic;
    }

    /*
     * 获得票类型
     * */
    public static function getPiaoList($suitlist)
    {

        $head = '<div class="ticket_type">
                  <ul class="type_ul">
                    <li class="li_1">票面类型</li>
                    <li class="li_2">票面价</li>
                    <li class="li_2">优惠价</li>

                  </ul>';
        $foot = '</div>';
        $list = '';
        foreach($suitlist as $row)
        {
           // $bookurl = $row['spotid'].'-'.$row['productid'].'-'.$row['suitid'];

            $bookurl=urlencode("http://piao.ctrip.com/Thingstodo-Booking-OnlineWebSite/TicketOrderInput.aspx?scenicID=".$row['spotid']."&productID=".$row['productid']."&ticketID=".$row['suitid']);

            $url = "http://u.ctrip.com/union/CtripRedirect.aspx?TypeID=25&allianceid=".$GLOBALS['cfg_ctrip_allianceid']."&sid=".$GLOBALS['cfg_ctrip_sid']."&Ouid=&jumpUrl=".$bookurl;

            $title = $row['tickettype']!='无' ? "[".$row['tickettype']."]".$row['name'] : $row['name'];
            $list.='<div class="type_list"><dl>
			<dt class="dl_title"><a href="javascript:void()">'.$title.'</a></dt>
			<dd class="dd1">&yen;'.$row['marketprice'].'</dd>
			<dd class="dd2">&yen;'.$row['price'].'</dd>

			<dd class="dd6"><a href="'.$url.'" target="_blank" class="btn_ding" >预定</a></dd>
			</dl>
			<div class="con_hide">
			<s class="s_bg"></s>
			<p>'.$row['description'].'</p>
			</div></div>';


        }
        $out = !empty($list) ? $head.$list.$foot : '';
        return $out;
    }

}
?>
