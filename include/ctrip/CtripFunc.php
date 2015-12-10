<?php
/**
 * User: netman
 * Date: 14-12-19
 * Time: 下午3:41
 */

class CtripFunc {


    /*
   * 机票信息处理
   * */



    public static function handleFlightList($data)
    {


        $out = array();

        $k=1;
        foreach($data as $row)
        {
            $flight_no = $row['Flight'];


            if(in_array($flight_no,$out)) //如果已经记录
            {

                $flight = array();
                $flight['seat'] = self::getSeatLevel($row['Class']);
                $flight['price'] = $row['Price'];
                $flight['rernote'] = $row['Rernote'];
                $flight['leftticket'] = $row['Quantity']; //剩余票
                $flight['refund'] = $row['RebateAmount']; //返现
                $flight['adulttax'] = $row['AdultTax'];//成人税
                $flight['oiltax'] = $row['AdultOilFee'];//燃油附加税
                $flight['remark'] = $row['Remark'] ;//备注
                $flight['rate'] = $row['Rate']!=1 ? $row['Rate']*10 : 1;//折扣率
                $flight['policyid'] = $row['PolicyID'];
                $flight['class'] = $row['Class'];
                $flight['producttype'] = $row['ProductType'];
                $out[$flight_no]['seatlist'][] = $flight;

            }
            else
            {

                $out[$flight_no]['flightno'] = $row['Flight'];//航班号
                $out[$flight_no]['airlinecode'] = strtolower($row['AirlineCode']);
                $out[$flight_no]['crafttype'] = $row['CraftType'];//机型

                $out[$flight_no]['punctualityrate'] = $row['PunctualityRate'];//准点率
                $out[$flight_no]['mealtype'] = self::getMealType($row['MealType']);//餐饮
                $out[$flight_no]['punctualityrate'] = $row['PunctualityRate'];//参考准点率
                $out[$flight_no]['departtime'] = date('H:i',strtotime($row['TakeOffTime']));//起飞时间
                $out[$flight_no]['arrivetime'] = date('H:i',strtotime($row['ArriveTime']));//到达时间

                $out[$flight_no]['startairport'] = self::getAirPortName($row['DPortCode']); //起飞机场
                $out[$flight_no]['arriveairport'] = self::getAirPortName(($row['APortCode'])); //目的地机场
                $out[$flight_no]['flightname'] = self::getFlightName($row['AirlineCode']);//航空公司名称
                //


                $flight = array();
                $flight['seat'] = self::getSeatLevel($row['Class']);

                $flight['price'] = $row['Price'];
                $flight['rernote'] = $row['Rernote'];//改
                $flight['endnote'] = $row['Endnote'];//转
                $flight['refnote'] = $row['Refnote'];//签
                $flight['leftticket'] = $row['Quantity']; //剩余票
                $flight['refund'] = $row['RebateAmount']; //返现
                $flight['adulttax'] = $row['AdultTax'];//成人税
                $flight['oiltax'] = $row['AdultOilFee'];//燃油附加税
                $flight['remark'] = $row['Remark'] ;//备注
                $flight['rate'] = $row['Rate']!=1 ? $row['Rate']*10 : 1;//折扣率
                $flight['policyid'] = $row['PolicyID'];
                $flight['producttype'] = $row['ProductType'];
                $flight['class'] = $row['Class'];
                $out[$flight_no]['seatlist'][]=$flight;



            }
            $k++;


        }

        return $out;


    }

    //返回舱位等级
    public static function getSeatLevel($level)
    {
        $data = array(
            'Y'=>'经济舱',
            'C'=>'公务舱',
            'F'=>'头等舱'
        );
        return $data[$level];

    }

    //获取航班名称
    public static function getFlightName($code)
    {
        if(empty($code))return '';
        $code = trim($code);
        $airlinelist =  include ('airline.php');
        return $airlinelist[$code]['ShortName'];

    }
   //获取机场名称
    public static function getAirPortName($code)
    {
        if(empty($code))return '';
        $code = trim($code);
        $airportlist =  include ('airport.php');
        return $airportlist[$code]['AirPortName'];

    }

    //餐饮对应
    public static function getMealType($code)
    {
        $arr = array('B','M','D','L');//有餐饮情况
        return in_array($code,$arr) ? '有' : '无';
    }

   //处理低价日历
    public static function getLowerPriceList($data)
    {
        $list = $data['FlightLowPriceSearchResponse']['FlightsLowestPrices']['FlightLowPriceIndexWSEntity'];
        foreach($list as $key => $row)
        {

            $list[$key]['week'] = self::getWeek($row['DepartDate']);
            $list[$key]['departdate'] = date('m-d',strtotime($row['DepartDate']));
            $list[$key]['departdate_full'] = date('Y-m-d',strtotime($row['DepartDate']));
            $newkey = strtotime($row['DepartDate']);
            $list[$newkey] = $list[$key];
            unset($list[$key]);
        }
        sort($list);//排序
        return $list;

    }

    //获取星期
    public static function getWeek($time)
    {
        $time = strtotime($time);
        $weekarray=array("日","一","二","三","四","五","六");
        return "周".$weekarray[date("w",$time)];
    }



} 