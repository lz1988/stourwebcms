<?php 
/*-----线路ajax操作控制器-----*/
require_once(dirname(__FILE__)."/../include/common.inc.php");



//新版读取日历报价
if($dopost=='getcarprice')
{
    $time = time();
    $sql="select * from #@__car_suit_price where suitid='$suitid' and day >'$time'";
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $str='';
    $str='{"data":[ ';
    while($row = $dsql->GetArray())
    {
        $day = date('Y-m-d',$row['day']);//
        $adultprice = $row['adultprice'];//成人价格
        //$oldprice = $row['oldprice'];//老人价格

        $str.='{ "pdatetime": "'.$day.'", "price": "'.$adultprice.'","childprice": "","description": "", "info": ""},';

    }
    //$str.=" ]";
    $str = substr($str, 0 ,strlen($str) - 1);
    $str.=' ]}';
    echo $str;
    exit();
}


