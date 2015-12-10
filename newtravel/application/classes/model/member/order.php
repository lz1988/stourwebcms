<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member_Order extends ORM {

     public static $statusNames=array(0=>'未处理',1=>'处理中',2=>'付款成功',3=>'取消订单',4=>'已退款',5=>'交易完成');
    /*
     * 返积分操作
     * */
    public static function refundJifen($orderid)
    {
        $row = ORM::factory('member_order')->where('id='.$orderid)->find()->as_array();
        if(isset($row))
        {
            $memberid = $row['memberid'];
            $jifenbook = intval($row['jifenbook']);
            $member = ORM::factory('member')->where("mid=$memberid");
            $member->jifen = intval($member->jifen) + $jifenbook;
            $member->save();
            if($member->saved())
            {
                $memberid = $member->mid;
                $content = "预订{$row['productname']}获得{$jifenbook}积分";
                self::addJifenLog($memberid,$content,$jifenbook,2);
            }

        }

    }

    public static function addJifenLog($memberid,$content,$jifen,$type)
    {
        $addtime = time();
        $sql = "insert into sline_member_jifen_log(memberid,content,jifen,`type`,addtime) values ('$memberid','$content','$jifen','$type','$addtime')";
        DB::query(Database::INSERT,$sql)->execute();

    }


    /*
     * 返库存操作
     * */
    public static function refundStorage($orderid,$op)
    {
        $row = ORM::factory('member_order')->where('id='.$orderid)->find()->as_array();
        if(isset($row))
        {
            $dingnum = intval($row['dingnum'])+intval($row['childnum']);
            $suitid = $row['suitid'];
            $productid = $row['productautoid'];
            $typeid = $row['typeid'];
            $usedate = strtotime($row['usedate']);


            $storage_table=array(
                    '1'=>'sline_line_suit_price',
                    '2'=>'sline_hotel_room_price',
                    '3'=>'sline_car_suit_price',
                    '5'=>'sline_spot_ticket',
                    '8'=>'sline_visa',
                    '13'=>'sline_tuan'
            );
            $table = $storage_table[$typeid];
            if(empty($table))
                return;
            //加库存
            if($op=='plus')
            {
                if($typeid==1||$typeid==2||$typeid==3)
                 $sql = "update {$table} set number=number+$dingnum where day='$usedate' and suitid='$suitid'";
                elseif($typeid==13)
                 $sql = "update {$table} set totalnum=CAST(totalnum AS SIGNED)+$dingnum where id=$productid";
                else
                 $sql = "update {$table} set number=number+$dingnum where id=$productid";
            }
            else if($op=='minus')
            {
                if($typeid==1||$typeid==2||$typeid==3)
                    $sql = "update {$table} set number=number-$dingnum where day='$usedate' and suitid='$suitid'";
                elseif($typeid==13)
                    $sql = "update {$table} set totalnum=CAST(totalnum AS SIGNED)-$dingnum where id=$productid";
                else
                    $sql = "update {$table} set number=number-$dingnum where id=$productid";
            }
            DB::query(2,$sql)->execute();
        }

    }
    public static function getStatusName($key)
    {
        return self::$statusNames[$key];
    }
    public static function getStatusNamesJs()
    {
        $jsonArr=array();
        foreach(self::$statusNames as $k=>$v)
        {
            $jsonArr[]=array('status'=>$k,'name'=>$v);
        }
        return $jsonArr;
    }
    public static function getPaySources()
    {
        $sql="select paysource from sline_member_order where paysource is not null group by paysource";
        $result=DB::query(Database::SELECT,$sql)->execute()->as_array();
        $arr=array();
        foreach($result as $k=>$v)
        {
            $arr[]=$v['paysource'];
        }
        return $arr;
    }
}