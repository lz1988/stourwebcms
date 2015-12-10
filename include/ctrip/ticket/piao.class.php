<?php

/* PHP SDK
 * @version 2.0.0
 * @author netman
 * @description:景点查询
 * @copyright © 2014, Ctrip Corporation. All rights reserved.
 */

class Piao
{
	public $open_api = 'http://openapi.ctrip.com/vacations/OpenServer.ashx';
    private $alliance_id = null;
    private $sid = null;
    private $signature = null;
    private $key = null;

	
	public function __construct()
	{
        $this->alliance_id = $GLOBALS['cfg_ctrip_allianceid'] ? $GLOBALS['cfg_ctrip_allianceid'] : '29976';
        $this->sid = $GLOBALS['cfg_ctrip_sid'] ? $GLOBALS['cfg_ctrip_sid'] : '469606';
        $this->key = $GLOBALS['cfg_ctrip_key'] ? $GLOBALS['cfg_ctrip_key'] : '16F7715F-AA5C-4F17-954E-7C5DFAB8A6BC';

    }


    /*
     * 获取签名
     * */
    public function setSignature( $interface )
    {

        list($usec, $sec) = explode(" ", microtime());
        $this->signature = $this->UMD5(
            $sec
            .$this->alliance_id
            .$this->UMD5($this->key)
            .$this->sid
            .$interface
        );

    }



    /**
	 * 生成请求串

	 */
	public function gen_request($interface,$requestbody)
	{
        $this->setSignature($interface);
       /* $arr = array(
         'AllianceID'=>$this->alliance_id,
           'SID'=>$this->sid,
           'ProtocolType'=>0,
           'Signature'=>$this->signature,
           'TimeStamp'=>time(),
           'Channel'=>'Vacations',
           'Interface'=>$interface,
           'IsError'=>true,
           'RequestBody'=>$requestbody,
           'ResponseBody'=>'',
           'ErrorMessage'=>''
       );*/

        $out = '{"AllianceID":"'.$this->alliance_id.'","SID":"'.$this->sid.'","ProtocolType":0,"Signature":"'.$this->signature.'","TimeStamp":'.time().',"Channel":"Vacations","Interface":"'.$interface.'","IsError":true,"RequestBody":"'.$requestbody.'","ResponseBody":"","ErrorMessage":""}';



       return $out;




    }
    //	查询门票景点列表
    /*
     *@page:当前页
     *@pagesize:一页显示数量
     *@keyword:查询关键词
     *@cityid:售卖城市id
     * */
    public function getSpotList($page,$pagesize,$keyword,$cityid)
    {
        $interface = 'TicketSenicSpotSearch';
        $request_body = "<ScenicSpotSearchRequest>";
        $request_body.="<DistributionChannel>9</DistributionChannel>";
        $request_body.="<PagingParameter>";
        $request_body.="<PageIndex>".$page."</PageIndex>";
        $request_body.="<PageSize>".$pagesize."</PageSize>";
        $request_body.="</PagingParameter>";
        $request_body.="<SearchParameter>";
        $request_body.="<Keyword>".iconv('UTF-8','GB2312',$keyword)."</Keyword>";
        $request_body.="<SaleCityID>".$cityid."</SaleCityID>";
        $request_body.="</SearchParameter>";
        $request_body.="</ScenicSpotSearchRequest>";
        $body = $this->gen_request($interface,$request_body);
        $url = $this->open_api."?RequestJson=". urlencode($body);
        $ar = $this->respond_xml($this->http($url));
        $out = array();
        $out['zone'] = $this->_getZone($ar);
        $out['jingqu'] = $this->_getJingQu($ar);
        $out['spotkind'] = $this->_getSpotKind($ar);
        $out['spotlist'] = $this->_getSpotInfo($ar);
        $out['pagecount'] = $ar['PagingCount'];
        $out['rowcount'] = $ar['RowCount'];
        return $out;
    }

    //获取区域
    public function _getZone($data)
    {
        $zone = $data['LabelSatistics']['LabelSatisticsDTO'][0]['SubLabelSatistics']['SubLabelSatisticsDTO'];
        return is_array($zone[0]) ? $zone : array($zone);
    }
    //获取景区
    public function _getJingQu($data)
    {
        $jingqu = $data['LabelSatistics']['LabelSatisticsDTO'][1]['SubLabelSatistics']['SubLabelSatisticsDTO'];
        return is_array($jingqu[0]) ? $jingqu : array($jingqu);
    }
    //获取类型
    public function _getSpotKind($data)
    {
        $spotkind = $data['LabelSatistics']['LabelSatisticsDTO'][2]['SubLabelSatistics']['SubLabelSatisticsDTO'];
        return is_array($spotkind[0]) ? $spotkind : array($spotkind);
    }
    //获取景点信息
    public function _getSpotInfo($data)
    {
          $out = array();
          if(count($data['ScenicSpotListItemList'])>0)
          {
              $spotlist = $data['ScenicSpotListItemList']['ScenicSpotListItemDTO'];
              if(is_array($spotlist[1]))
              {
                  foreach($spotlist as $v)
                  {

                      $ticketsuit = isset($v['ProductListItemList']['ProductListItemDTO']['ResourceListItemList']['ResourceListItemDTO']) ? $v['ProductListItemList']['ProductListItemDTO']['ResourceListItemList']['ResourceListItemDTO'] :$v['ProductListItemList']['ProductListItemDTO'] ;
                      $v['suitlist'] = is_array($ticketsuit[0]) ? $ticketsuit : array($ticketsuit);
                      unset($v['ProductListItemList']);
                      unset($v['Activity'],$v['TicketGroupAttributes']);
                      $out[]=$v;
                  }
              }
              else
              {
                  $ticketsuit = isset($spotlist['ProductListItemList']['ProductListItemDTO']['ResourceListItemList']['ResourceListItemDTO']) ? $spotlist['ProductListItemList']['ProductListItemDTO']['ResourceListItemList']['ResourceListItemDTO'] :$spotlist['ProductListItemList']['ProductListItemDTO'] ;
                  //$v['suitlist'] = $ticketsuit;
                  $spotlist['suitlist']=is_array($ticketsuit[0]) ? $ticketsuit : array($ticketsuit);
                  unset($spotlist['ProductListItemList']);
                  unset($spotlist['Activity'],$spotlist['TicketGroupAttributes']);
                  $out[] = $spotlist;
              }

          }
          else
          {
              $spotlist = $data['ScenicSpotListItemList']['ScenicSpotListItemDTO'];
              $ticketsuit = isset($spotlist['ProductListItemList']['ProductListItemDTO']['ResourceListItemList']['ResourceListItemDTO']) ? $spotlist['ProductListItemList']['ProductListItemDTO']['ResourceListItemList']['ResourceListItemDTO'] :$spotlist['ProductListItemList']['ProductListItemDTO'] ;
              //$v['suitlist'] = $ticketsuit;
              $spotlist['suitlist']=is_array($ticketsuit[0]) ? $ticketsuit : array($ticketsuit);
              unset($spotlist['ProductListItemList']);
              unset($spotlist['Activity'],$spotlist['TicketGroupAttributes']);
              $out[] = $spotlist;

          }



          return $out;
    }

    /*
     * 获取景点详细信息
     * */
    public function getSpotDetail($productid)
    {
        $interface = 'TicketSenicSpotInfo';
        $request_body='<ScenicSpotInfoRequest>';
        $request_body.='<DistributionChannel>9</DistributionChannel>';
        $request_body.='<ID>';
        $request_body.='<int>'.$productid.'</int>';
        $request_body.='</ID>';
        $request_body.='</ScenicSpotInfoRequest>';
        $body = $this->gen_request($interface,$request_body);
        $url = $this->open_api."?RequestJson=". urlencode($body);
        $ar = $this->respond_xml($this->http($url));
        $info = $this->_getTicketDetail($ar);
        return $info;



    }
    /*
     * 分析处理获取的接口数据(景点详细)
     * */
    public function _getTicketDetail($data)
    {
        $spotdetail = $data['ScenicSpotList']['ScenicSpotDTO'];
        $scenicid = $spotdetail['ID'];//景点ID
        $notice = $this->_getNotice($spotdetail['ProductList']);
        $jieshao = $this->_getJieShao($spotdetail['ProductList']);
        $suit = $this->_getSuit($spotdetail['ProductList'],$scenicid);
        $piclist = $this->_getPicList($jieshao);
        unset($spotdetail['TicketGroupAttributes'],$spotdetail['ProductList']);

        $spotdetail['notice'] = $notice;
        $spotdetail['jieshao'] = $jieshao;
        $spotdetail['suit'] = $suit;
        $spotdetail['piclist'] = $piclist;

        $spot = array_change_key_case($spotdetail);//key转换为小写
        return $spot;
    }

    /*
     * 组合生成预订须知
     * */
    public function _getNotice($data)
    {
        $out = '';
        $info = $data['ProductDTO']['ProductAddInfoList']['ProductAddInfoDTO'];
        foreach($info as $row)
        {
            $desc='';
            if(is_array($row['ProductAddInfoDetailList']['ProductAddInfoDetailDTO'][1]))
            {
                foreach($row['ProductAddInfoDetailList']['ProductAddInfoDetailDTO'] as $r)
                {
                    $desc.=$r['DescDetail']."</br>";
                }
            }
            else
            {
                $desc.=$row['ProductAddInfoDetailList']['ProductAddInfoDetailDTO']['DescDetail'];
            }

            $out.=$row['AddInfoSubTitleName']."</br>".$desc."</br>";
        }
        return $out;
    }

    /*
     * 景点介绍(详细页)
     * */
    public function _getJieShao($data)
    {

        $info = $data['ProductDTO']['ProductDescriptionInfo']['Introduction'];
        return $info;
    }
    /*
     *获取套餐(详细页面)
     * */
    public function _getSuit($data,$spotid)
    {
        $info = $data['ProductDTO']['ResourceList']['ResourceDTO'];
        $productid = $data['ProductDTO']['ProductBasicInfo']['ID'];
        $out = array();
        if(is_array($info[1]))
        {
            foreach($info as $row)
            {
                $ar = array();
                $ar['name'] = $row['Name'];//套餐名称
                $ar['price'] = $row['Price'];
                $ar['marketprice'] = $row['MarketPrice'];
                $desc = '';
                foreach($row['ResourceAddInfoList']['ResourceAddInfoDTO'] as $r)
                {
                    $desc.=$r['SubTitle'].":".$r['Description']."</br>";
                }
                $ar['description'] = $desc;
                $ar['suitid'] = $row['ID'];
                $ar['tickettype'] = $this->_getTicketType($row['TicketType']);
                $ar['productid'] = $productid;
                $ar['spotid'] = $spotid;
                $out[]=$ar;

            }
        }
        else
        {
            $ar = array();
            $ar['name'] = $info['Name'];//套餐名称
            $ar['price'] = $info['Price'];
            $ar['marketprice'] = $info['MarketPrice'];
            $desc = '';
            foreach($info['ResourceAddInfoList']['ResourceAddInfoDTO'] as $r)
            {
                $desc.=$r['SubTitle'].":".$r['Description']."</br>";
            }
            $ar['description'] = $desc;
            $ar['suitid'] = $info['ID'];
            $ar['tickettype'] = $this->_getTicketType($info['TicketType']);
            $ar['productid'] = $productid;
            $ar['spotid'] = $spotid;
            $out[]=$ar;
        }
        return $out;
    }

    /*
     * 提取图片(详细页)
     * */
    public function _getPicList($info)
    {
        $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.JPG|\.GIF|\.PNG]))[\'|\"].*?[\/]?>/";
         preg_match_all($pattern,$info,$match);
        $out = array();
        foreach($match[1] as $row)
        {
            if(strpos($row,'pkgpic')===false)
            {
                $ext = explode('.',$row);
                $pic = explode('_',$row);
                $out[] = array('litpic'=>$pic[0].'.'.$ext[count($ext)-1]) ;
            }
            else
            {
                $out[] = array('litpic'=>$row) ;
            }



        }
        return $out;

    }
    /*
     * 获取门票类型
     * */
    public function _getTicketType($type)
    {
        //0，无。1，特惠。2.单票。4.套票
        switch($type)
        {
            case 0:
                $out='无';
                break;
            case 1:
                $out='特惠票';
                break;
            case 2:
                $out='单票';
                break;
            case 4:
                $out='套票';
                break;
        }
        return $out;
    }






    public function UMD5($str)
    {
        $coutw = $str;
        if (strlen($str) > 0)
        {
            $coutw = strtoupper(md5($str));
        }
        return $coutw;
    }

    public function respond_xml($string, $type='array')
    {


        $simplexml = simplexml_load_string($string);
        $list = json_decode(json_encode($simplexml),TRUE);
        $simplexml = simplexml_load_string($list['ResponseBody']);
        return json_decode(json_encode($simplexml),TRUE);

    }





    /*
        * curl http访问
        * */
    public function http($url,$method='get',$postfields='')
    {

        $ci=curl_init();
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
        if($method=='POST')
        {
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response=curl_exec($ci);
        curl_close($ci);
        return $response;

    }
}
