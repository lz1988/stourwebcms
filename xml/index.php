<?php

require_once (dirname(dirname(__FILE__)) . "/include/common.inc.php");

require_once SLINEINC."/view.class.php";

require_once "QunarXml.php";


//$xml = new QunarXml();
//$filename = dirname(__FILE__).'/line.xml';
//$body = getlines();

//$xml->writeXml($body,$filename);

$weburl = 'http://www.lvyou.com';
$xml = new QunarXml();
getlines();
//获取线路
function getLines()
{



    global $dsql,$xml,$weburl;
    $xml_url_list = '';
    $sql = "select * from sline_line limit 10";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
       $filename = dirname(__FILE__).'/'.$row['id'].'.xml';
       $url = $GLOBALS['cfg_basehost']."/lines/show_{$row['aid']}.html";
       $price_arr =  XmlLine::getLineMinPrice($row['id']);
       $overcity = explode(',',$row['overcity']);
       $overspot_arr = XmlLine::getOverSpot($row['id']);
        //线路图片处理
       $lineimages = explode(",",$row['piclist']);
       $image_arr = array();
       foreach($lineimages as $image)
       {
           $im = explode('||',$image);
           $image_arr[] = $GLOBALS['cfg_basehost'].$im[0];

       }


       //线路行程介绍
       $linejieshao = XmlLine::getLineJieshao($row['id']);
       //线路日历
       $linedate = XmlLine::getLineDate($row['id']);
       $out = '';
       $out.="<route>\n";
       $out.=$xml->genSingleInfo('title',$row['title']);
       $out.=$xml->genSingleInfo('url',$url);
       $out.=$xml->genSingleInfo('price',$price_arr['price']);
       $out.=$xml->genSingleInfo('childprice',$price_arr['childprice']);
       $out.=$xml->genSingleInfo('price_diff','无');
       $out.=$xml->genSingleInfo('function','跟团游');
       $out.=$xml->genSingleInfo('departure',getStartCityName($row['startcity']));
        $out.=$xml->genSingleInfo('type','国内游');
        $out.=$xml->genSingleInfo('subject',XmlLine::getLineAttr($row['attrid']));
        $out.=$xml->genSingleInfo('date_of_departure',date('Y-m-d'));
        $out.=$xml->genSingleInfo('date_of_expire',date('Y-m-d',strtotime(date('Y-m-d') . '+5day')));

        $out.=$xml->genSingleInfo('advance_day',$row['linebefore']);
        $out.=$xml->genSingleInfo('day_num',$row['lineday']);
        $out.=$xml->genSingleInfo('hotel_night',$row['linenight']);
        $out.=$xml->genSingleInfo('to_traffic',XmlLine::getTransport($row['transport']));
        $out.=$xml->genSingleInfo('back_traffic',XmlLine::getTransport($row['transport']));
        $out.=$xml->genSingleInfo('promotion','无');
        $out.=$xml->genMutilInfo('cities','city',$overcity);

        $out.=$xml->genDaySpot($overspot_arr);
        $out.=$xml->genMutilInfo('images','image',$image_arr);

        $out.=$xml->genMutilInfo('features','feature',array($row['features']));
        $out.=$xml->genMutilInfo('fee_includes','fee_include',array($row['feeinclude']));
        $out.=$xml->genMutilInfo('fee_excludes','fee_exclude',array($row['reserved2']));
        $out.=$xml->genMutilInfo('booking_terms','booking_term',array($row['beizhu']));
        $out.=$xml->genMutilInfo('visa_infos','visa_info',array('暂无'));
        $out.=$xml->genMutilInfo('contract_styles','contract_style',array($row['payment']));
        $out.=$xml->genDayJieShao($linejieshao);
        $out.=$xml->genLineDate($linedate);
        $out.= "</route>\n";


        $xml->writeXml($out,$filename);
        $xml_url_list.="<url>{$weburl}/xml/{$row['id']}.xml</url>\n";





    }

    $list_file_name = dirname(__FILE__).'/list.xml';
    $xml->writeListXml($xml_url_list,$list_file_name);
    echo 'ok';

}
class XmlLine{


    //获取线路最低价格
    public static function getLineMinPrice($lineid)
    {
        global $dsql;
        $sql = "select min(adultprice) as price,min(childprice) as childprice from sline_line_suit_price where lineid='$lineid'";
        $row = $dsql->GetOne($sql);
        return $row;
    }
    //获取线路属性
    public static function getLineAttr($attrid)
    {
        global $dsql;
        $attr= explode(',',$attrid);
        $out = array();
        foreach($attr as $id)
        {
            $sql = "select attrname from #@__line_attr where id='$id'";
            $row = $dsql->GetOne($sql);
            $out[]=$row['attrname'];

        }
        return implode('|',$out);

    }
    //获取交通
    public static function getTransport($ids)
    {
        $transport=array("1"=>"飞机","2"=>"汽车","3"=>"火车","4"=>"轮船");
        $arr = explode(',',$ids);
        $out = '';
        foreach($arr as $value)
        {
            $out.=$transport[$value].',';
        }
        return substr($out,0,strlen($out)-1);

    }
    //获取途径景点
    public static function getOverSpot($lineid)
    {
        global $dsql;
        $sql = "select * from sline_line_dayspot where lineid='$lineid'";
        $arr = $dsql->getAll($sql);
        return $arr;
    }

    //获取线路行程
    public static function getLineJieshao($lineid)
    {
        global $dsql;
        $sql = "select * from sline_line_jieshao where lineid='$lineid'";
        $arr = $dsql->getAll($sql);
        foreach($arr as $key => $row)
        {
            $dayspot = array();
            $sql = "select spotname from sline_line_dayspot where lineid='$lineid' and day='{$row['day']}'";
            $ar = $dsql->getAll($sql);
            foreach($ar as $r)
            {
                $dayspot[]=$r['spotname'];
            }
            $arr[$key]['dayspot']=$dayspot;
        }
        return $arr;
    }

    //获取线路日期报价
    public static function getLineDate($lineid)
    {
        global $dsql;
        $day = time();
        $sql = "select * from sline_line_suit_price where lineid='$lineid' and day>'$day' limit 30";
        $arr = $dsql->getAll($sql);
        return $arr;

    }


}




?>