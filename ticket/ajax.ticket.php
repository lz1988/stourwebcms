<?php 
/*-----机票ajax操作控制器-----*/
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once (SLINEINC.'/ctrip/CtripUnion.php');
require_once (SLINEINC.'/ctrip/CtripFunc.php');

//获取低价日历

if($action == 'getLowerPrice')
{
    $enddate = date("Y-m-d",strtotime("+1months",strtotime($startdate)));
    $arr = array(
        'startcity'=>$dCode,
        'arrivecity'=>$aCode,
        'startdate'=>$startdate,
        'enddate'=>$enddate


    );

    $cu = new CU('flight','OTA_FlightLowPriceSearch');

    $rt = $cu->OTA_FlightLowPriceSearch($arr,'array');

    $pricelist = CtripFunc::getLowerPriceList($rt);

    print_r(json_encode($pricelist));

}
//查询机票
if($action == 'getFlight')
{
    $arr =array(
    'startcity'=>$dCode,
    'arrivecity'=>$aCode,
    'departdate'=>$startdate,
    'searchtype'=>$searchType
);


$cu = new CU('flight','OTA_FlightSearch');

$rt = $cu->OTA_FlightSearch($arr,'array');

$flightlist = $rt['FlightSearchResponse']['FlightRoutes']['DomesticFlightRoute']['FlightsList']['DomesticFlightData'];

$out = CtripFunc::handleFlightList($flightlist);

echo json_encode($out);


}


