<?php

/* PHP SDK
 * @version 2.0.0
 * @author netman
 * @description:国内机票查询
 * @copyright © 2014, Ctrip Corporation. All rights reserved.
 */

class OTA_FlightSearch
{
	public $open_api = '/Flight/DomesticFlight/OTA_FlightSearch.asmx';
	public $start_city; //出发地
	public $arrive_city = '';  //目的地
	public $depart_date = '';  //出发日期
    public $search_type = 'S'; //S（单程）D（往返程）M（联程）
	
	public function __construct($open_api,$args)
	{
        $this->start_city = $args['startcity'];
        $this->arrive_city = $args['arrivecity'];
        $this->depart_date = $args['departdate'];
        $this->search_type = $args['searchtype'];
        $this->open_api = $open_api.$this->open_api; // TODO:检测open api，如果不合法则覆盖重写

    }

	
	/**
	 * 构造请求xml字符串
	 * @param int $uid
	 * @param int $sid
	 * @param string $stmp
	 * @param string $sign
	 * @param stirng $type
	 */
	public function request_xml( $uid, $sid, $stmp, $sign, $type )
	{

        $request_xml =
          '<?xml version="1.0" encoding="utf-8"?>'
          .'<Request>'
          .'<Header AllianceID="'.$uid.'" SID="'.$sid.'" TimeStamp="'.$stmp.'" RequestType="OTA_FlightSearch" Signature="'.$sign.'" />'
          .'<FlightSearchRequest>'
          .'<SearchType>'.$this->search_type.'</SearchType>'
          .'<Routes>'
          .'<FlightRoute>'
          .'<DepartCity>'.$this->start_city.'</DepartCity>'
          .'<ArriveCity>'.$this->arrive_city.'</ArriveCity>'
          .'<DepartDate>'.$this->depart_date.'</DepartDate>'
         // .'<AirlineDibitCode></AirlineDibitCode>'
          //.'<DepartPort></DepartPort>'
          //.'<ArrivePort></ArrivePort>'
         // .'<EarliestDepartTime></EarliestDepartTime>'
        //  .'<LatestDepartTime></LatestDepartTime>'
          .'</FlightRoute>'
          .'</Routes>'
          //.'<SendTicketCity></SendTicketCity>'
          .'<IsSimpleResponse>false</IsSimpleResponse>'
          .'<IsLowestPrice>false</IsLowestPrice>'
          .'<PriceTypeOptions>'
          .'<string>NormalPrice</string>'
          .'</PriceTypeOptions>'
          .'<ProductTypeOptions>Normal</ProductTypeOptions>'
          .'<OrderBy>DepartTime</OrderBy>'
          .'<Direction>ASC</Direction>'
          .'</FlightSearchRequest>'
          .'</Request>';

// 需要将此处的xml嵌入到外层xml中，故需要将其转义
		$request_xml = str_replace("<",@"&lt;",$request_xml);
		$request_xml = str_replace(">",@"&gt;",$request_xml);
		
		return $request_xml;
	}




	
	public function respond_xml( $string )
	{
		// 将内层xmll中转义的符号恢复
		$string = str_replace("&lt;","<",$string);
		$string = str_replace("&gt;",">",$string);
		return simplexml_load_string($string);	
	}
}
