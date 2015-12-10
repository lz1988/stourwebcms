<?php

/* PHP SDK
 * @version 2.0.0
 * @author netman
 * description:获取机场信息信息
 * @copyright © 2014, Ctrip Corporation. All rights reserved.
 */

class OTA_FltGetAirportInfos
{
	public $open_api = '/Flight/FlightProduct/OTA_FltGetAirportInfos.asmx';
	public $airport_code; //机场信息代码

	
	public function __construct($open_api,$args)
	{

        $this->airport_code = $args['airport_code'];
        $this->open_api = $open_api.$this->open_api;

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
          .'<Header AllianceID="'.$uid.'" SID="'.$sid.'" TimeStamp="'.$stmp.'" RequestType="'.$type.'" Signature="'.$sign.'" />'
          .'<GetAirportInfosRequest>'
          .'<AirportCode>'.$this->airport_code.'</AirportCode>'
          .'</GetAirportInfosRequest>'
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
