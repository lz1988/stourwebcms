<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order extends ORM {

    public static $statusNames=array(0=>'未处理',1=>'处理中',2=>'付款成功',3=>'取消订单',4=>'已退款',5=>'交易完成');
    private  $suit_table_arr = array(
        '1'=>array('table'=>'sline_line_suit','field'=>'suitname'),
        '2'=>array('table'=>'sline_hotel_room','field'=>'roomname'),
        '3'=>array('table'=>'sline_car_suit','field'=>'suitname'),
        '5'=>array('table'=>'sline_spot_ticket','field'=>'title')
    );
  /*
   * 获取订单列表
   * @param $mid :会员id
   * @param $pagesize 数量
   * @param $pageno 页数
   *
   * */
    public function getOrderList($mid,$pagesize=5,$pageno=1,$haspinlun=0)
    {

        $offset =($pageno-1)*$pagesize;
        $pinlun_where = $haspinlun ? " inner join sline_comment b on(a.id=b.orderid)" : "";
        $sql = "select a.* from sline_member_order a {$pinlun_where} where a.memberid='{$mid}' order by a.addtime desc limit {$offset},{$pagesize}";

       // $arr = ORM::factory('member_order')->where("memberid={$mid}")->limit($pagesize)->get_all();
        //print_r($arr);
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as $key=>$v)
        {
            $arr[$key]['suitname'] = self::getSuitName($v['suitid'],$v['typeid'],$v['productautoid']);//套餐名
            $arr[$key]['totalprice'] =  $v['price'] * $v['dingnum']+$v['childnum']*$v['childprice']+$v['oldnum']*$v['oldprice'];
        }
        return $arr;
    }

    /*
     * 获取套餐名
     * */
    public function getSuitName($suitid,$typeid,$id)
    {
        $arr= array(1,2,3,5);
        if(empty($suitid))
        {
            return '';
        }
        else
        {
            if(in_array($typeid,$arr))
            {
                $table = $this->suit_table_arr[$typeid]['table'];
                $field = $this->suit_table_arr[$typeid]['field'];
                $sql = "select {$field} as title from {$table} where id='{$suitid}'";
                $row = DB::query(1,$sql)->execute()->as_array();
                return $row[0]['title'] ? $row[0]['title'] : '';
            }

        }
    }

   /*
    * 获取单个订单详细信息
    * */
   public function getOrderDetail($orderid)
   {
       $arr = $this->where("id={$orderid}")->find()->as_array();
       $arr['suitname'] = self::getSuitName($arr['suitid'],$arr['typeid'],$arr['productautoid']);//套餐名
       $arr['totalprice'] = $arr['price'] * $arr['dingnum']+$arr['childnum']*$arr['childprice']+$arr['oldnum']*$arr['oldprice'];
       $arr['pinlun'] = $this->getOrderPinlun($orderid);
       return $arr;
   }
    /*
     * 获取订单评论信息
     * */
   public function getOrderPinlun($orderid)
   {
       $arr = ORM::factory('comment')->where("orderid='$orderid'")->find()->as_array();


       $score = $arr['score1']*20;
       $arr['satisfyscore'] = $score.'%';

       return $arr;


   }

    /*
 * 获取订单列表
 * @param $mid :会员id
 * @param $pagesize 数量
 * @param $pageno 页数
 *
 * */
    public function getOrderListByMobile($mobile,$pagesize=10,$pageno=1)
    {

        $offset =($pageno-1)*$pagesize;

        $sql = "select a.* from sline_member_order a where a.linktel='{$mobile}' order by a.addtime desc limit {$offset},{$pagesize}";


        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as $key=>$v)
        {
            $orderAmount = Common::StatisticalOrderAmount($v);
            $arr[$key]['suitname'] = self::getSuitName($v['suitid'],$v['typeid'],$v['productautoid']);//套餐名
            $arr[$key]['totalprice'] = $orderAmount['totalPrice'];
			$arr[$key]['totalnumber'] = $orderAmount['numberDescript'];
			$arr[$key]['typename'] =Common::$channel[$v['typeid']].'订单';

        }
        return $arr;
    }


}