<?php
/**
 * @version        $Id: query.php 1 8:24 2015年1月22日 netman $
 * @package        Smore.User
 */
require_once(dirname(__FILE__)."/config.php");
require_once SLINEINC."/listview.class.php";





//查询首页
if(!isset($dopost))
{
    $pv = new View(0);
    $pv->SetTemplet(MEMBERTEMPLET . "order_query.htm");
    $pv->Display();
	
}

if($dopost=='search')
{   
	//判断是否是从订单页跳转
    if(!empty($_POST))
    {
        $mobile = Helper_Archive::pregReplace($searchkey,2);
    }
    if(empty($mobile)) header("location:{$GLOBALS['cfg_basehost']}/member/query.php");
    $sql = "select * from sline_member_order where linktel='$mobile' and pid=0 order by addtime desc";

    $dzorder = QueryOrder::getDzOrder($searchkey);

    $pv = new ListView(0);
    $pv->pagesize=100;//分页条数.
    $pv->SetSql($sql);
    $pv->Fields['searchkey'] = $mobile;
    $pv->SetTemplet(MEMBERTEMPLET . "order_query.htm");
    $pv->Display();
    exit();
}
//在线支付
if($dopost == 'payonline')
{
    $order = Helper_Archive::getOrderInfo($orderid);
    if($order['typeid']!=2)
    {
        if(empty($order['dingjin'])) //非订金支付
        {
            $price = intval($order['dingnum']) * $order['price'] +intval($order['childnum']) * $order['childprice'] + intval($order['oldnum']) * $order['oldprice'];
            if(!empty($order['usejifen']) && !empty($order['jifentprice']))
            {
                $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
            }
        }
        else //订金支付
        {
            $price = (intval($order['dingnum'])+intval($order['childnum'])+intval($order['oldnum'])) * $order['dingjin'];
            if(!empty($order['usejifen']) && !empty($order['jifentprice']))
            {
                $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
            }
        }
    }
    else //当为酒店时
    {

        $orderlist = Helper_Archive::getChildOrder($orderid);
        $price = 0;
        $totalnum = 0;
        foreach($orderlist as $row)
        {
            $price += intval($row['dingnum']) * intval($row['price']);
            $totalnum+=$row['dingnum'];

        }
        if(!empty($order['dingjin']))
        {
            $dingjin = $totalnum * $order['dingjin'];
        }
    }

    $price = !empty($dingjin) ? $dingjin : $price;

    if(empty($price))
    {
        $url = "{$GLOBALS['cfg_basehost']}/member/";
        header("location:$url");
        exit;
    }
    echo Helper_Archive::payOnline($order['ordersn'],$order['productname'],$price,$choosepay);
}

class QueryOrder{
    //获取产品信息
    public static function getProductInfo($id,$typeid,$productname='')
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
            '1'=>array('field'=>'title as title,sellpoint,litpic as litpic','link'=>'lines'),
            '2'=>array('field'=>'title as title, sellpoint,litpic','link'=>'hotels'),
            '3'=>array('field'=>'title as title,sellpoint,litpic','link'=>'cars'),
            '4'=>array('field'=>'title','link'=>'article'),
            '5'=>array('field'=>'title as title,sellpoint,litpic','link'=>'spots'),
            '8'=>array('field'=>'title,sellpoint,litpic','link'=>'visa'),
            '13'=>array('field'=>'title,sellpoint,litpic','link'=>'tuan')

        );
        $field = $fields[$typeid]['field'];
        if($typeid>13)
        {
            $tablename='sline_model_archive';
            $field = 'title,litpic';
        }


        $sql = "select aid,{$field},webid from {$tablename} where id='$id'";



        $row = $dsql->GetOne($sql);
        return $row;


    }

    //获取产品名称
  public static function getProductName($id,$typeid)
  {

      $row = QueryOrder::getProductInfo($id,$typeid);

      $links=array(
          '1'=>array('link'=>'lines'),
          '2'=>array('link'=>'hotels'),
          '3'=>array('link'=>'cars'),
          '4'=>array('link'=>'article'),
          '5'=>array('link'=>'spots'),
          '8'=>array('link'=>'visa'),
          '13'=>array('link'=>'tuan')
      );
      if($typeid>13)
      {
          $module_info = Helper_Archive::getModuleInfo($typeid);
          $link = $module_info['pinyin'];
      }
      else
      {
          $link =$links[$typeid]['link'];
      }

      $weburl = GetWebURLByWebid($row['webid']);
      $out = "<a href=\"{$weburl}/{$link}/show_{$row['aid']}.html\" target=\"_blank\">{$row['title']}</a>";
      return $out;

  }
 //获取封面图
  public static function getLitpic($id,$typeid)
  {
      $row = self::getProductInfo($id,$typeid);
      return $row['litpic'] ? $row['litpic'] : getDefaultImage();

  }
 //获取卖点
  public static function getSellPoint($id,$typeid)
  {
      $row = self::getProductInfo($id,$typeid);
      return $row['sellpoint'] ? cutstr_html($row['sellpoint'],70) : '';

  }

 //获取产品类型
   public static function getSuitName($productname)
   {
       $rule = '/\(.*\)/';
       preg_match($rule,$productname,$match);
       return $match[0] ? preg_replace('/\(|\)/','',$match[0]) : $productname;
   }

 //获取购买数量
    public static function getBuyNum($arr)
    {
        if($arr['typeid']!=1)
        {
            if($arr['typeid']==2)
            {
                $orderlist = Helper_Archive::getChildOrder($arr['id']);
                $price = 0;
                $totalnum = 0;
                foreach($orderlist as $row)
                {
                    $price += intval($row['dingnum']) * intval($row['price']);
                    $totalnum+=$row['dingnum'];

                }
                $out = $totalnum;

            }
            else
            {
                $out = $arr['dingnum'];
            }

        }
        else
        {
            $out = $arr['dingnum'] ? '成人:'.$arr['dingnum'] : '';
            $out.= $arr['childnum'] ? '小孩:'.$arr['childnum'] : '';
            $out.= $arr['oldnum'] ? '老人:'.$arr['oldnum'] : '';
        }

        return $out;
    }

    //获取使用日期
    public static function getUseDate($arr)
    {
        if($arr['typeid']!=2)
        {
            return $arr['usedate'];
        }
        else
        {
            $orderlist = Helper_Archive::getChildOrder($arr['id']);
            $usedate = array();

            foreach($orderlist as $row)
            {
                if(!in_array($row['usedate'],$usedate))
                {
                   array_push($usedate,$row['usedate']);
                }
            }
            return implode(',',$usedate);
        }
    }




//获取订单状态
 public static function getOrderStatus($status,$paytype)
    {
        switch($status)
        {
            case '0':
                $out = '<span class="color_wfk">未处理</span>';
                break;
            case '1':
                $out = '<span class="color_wfk">处理中</span>';
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
                $out='<span class="color_ywc">交易完成</span>';
                break;
        }
        /* if($paytype == '3')
         {
             $out = '<span class="color_wfk">等待处理</span>';
         }*/
        return $out;

    }

    //根据typeid获取channelname
   public static function getOrderName($typeid)
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
            default:
                $info = Helper_Archive::getModuleInfo($typeid);
                $out = $info['modulename'].'订单';


        }

        return $out;
    }
    //获取付款状态
    public static function getPayStatus($ispay)
    {
        return $ispay ? '已付款' : '<span class="notice">未付款</span>';
    }

    //付款类型
    public static function getPayType($paytype)
    {
       switch($paytype)
       {
           case 1:
               $out = '全款支付';
               break;
           case 2:
               $out = '订金支付';
               break;
           case 3:
               $out = '二次确认';
               break;

       }
       return $out;
    }
    //获取总价格
    public static function getTotalPrice($arr)
    {
        if($arr['typeid']!=2)
          return intval($arr['dingnum'])*$arr['price'] + intval($arr['childnum'])*$arr['childprice'] + intval($arr['oldnum'])*$arr['oldprice'];
        else
        {
            $orderlist = Helper_Archive::getChildOrder($arr['id']);
            $price = 0;
            $totalnum = 0;
            foreach($orderlist as $row)
            {
                $price += intval($row['dingnum']) * intval($row['price']);
                $totalnum+=$row['dingnum'];

            }
           return $price;

        }
    }

    //获取支付金额
    public static function getNeedPay($order)
    {
        if($order['typeid']!=2)
        {
            if(empty($order['dingjin'])) //非订金支付
            {
                $price = intval($order['dingnum']) * $order['price'] +intval($order['childnum']) * $order['childprice'] + intval($order['oldnum']) * $order['oldprice'];
                if(!empty($order['usejifen']) && !empty($order['jifentprice']))
                {
                    $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
                }
            }
            else //订金支付
            {
                $price = (intval($order['dingnum'])+intval($order['childnum'])+intval($order['oldnum'])) * $order['dingjin'];
                if(!empty($order['usejifen']) && !empty($order['jifentprice']))
                {
                    $price = $price-intval($order['jifentprice']);//减去积分抵现的价格.
                }
            }
        }
        else //当为酒店时
        {

            $orderlist = Helper_Archive::getChildOrder($order['id']);
            $price = 0;
            $totalnum = 0;
            foreach($orderlist as $row)
            {
                $price += intval($row['dingnum']) * intval($row['price']);
                $totalnum+=$row['dingnum'];

            }
            if(!empty($order['dingjin']))
            {
                $dingjin = $totalnum * $order['dingjin'];
            }
        }

        $price = !empty($dingjin) ? $dingjin : $price;
        return $price;
    }


    //获取自定义定单

    public static function getDzOrder($mobile)
    {
        global $dsql;
        $sql = "select * from sline_dzorder where phone like '%$mobile%'";
        $arr = $dsql->getAll($sql);
        foreach($arr as $key=>$row)
        {

            $arr[$key]['orderstatus'] =self::getOrderStatus($row['status'],'');
            $arr[$key]['ispay'] = $row['status']==2 ? '已付款' : '未付款';
            $arr[$key]['paytype'] = '订金支付';
            $arr[$key]['price'] = $row['dingjin'];
            $arr[$key]['ordertype'] = '自定义订单';
       /* [field:array runphp='yes']
                      if(@me['status']==1)
                      {
                          @me='<p class="btn_pay" data-orderid="'.@me['id'].'">立即支付</p>';
                      }
                      else if(@me['status']==2)
                      {
                          @me='<p class="btn_haspay">支付成功</p>';
                      }
                      else if(@me['status']==0)
                      {
                          @me='<p class="btn_haspay">等待处理</p>';
                      }
                      else
                      {
                          @me='<p class="btn_haspay">订单取消</p>';
                      }

                   [/field:array]*/

        }
        return $arr;
    }

}








