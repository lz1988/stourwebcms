<?php
/**
 * Created by PhpStorm.
 * User: netman
 * Date: 14-10-24
 * Time: 上午10:22
 */

class QunarXml {

    public $xmlhead = "<?xml version='1.0' encoding='UTF-8'?>\n";

    public $xmlstart = "<routes>\n";

    public $xmlend = "</routes>\n";

    public $xml_list_start = "<list>\n";

    public $xml_list_end = "</list>\n";

    /*
     * 生成单个信息描述
     * */
    public function genSingleInfo($mark,$info)
    {
        $info = empty($info) ? "暂无" : strip_tags($info);
        return "<{$mark}>".$info."</{$mark}>\n";
    }

    /*
     * 生成多个块体.
     * */
    public function genMutilInfo($mark,$childmark,$info_arr)
    {
       $out = '';
       if(isset($info_arr[0]))
       {
           $out = "<{$mark}>\n";
           foreach($info_arr as $v)
           {
               $out.="<{$childmark}>".$this->replaceSpecialChar(strip_tags($v))."</{$childmark}>\n";
           }
           $out.="</{$mark}>\n";
       }

        return $out;
    }

    /*
     * 生成途经景点
     * */
    public function genDaySpot($spotarr)
    {
       $head = "<sights>\n";
       $end = "</sights>\n";
       $out = '';
       foreach($spotarr as $row)
       {
           $out.="<sight>\n";
           $out.="<title>".$row['title']."</title>\n";
           $out.="<sight_alias>".$row['title']."</sight_alias>\n";
           $out.="<sight_image>".$GLOBALS['cfg_basehost'].$row['litpic']."</sight_image>\n";
           $out.="</sight>\n";


       }
       if(!empty($out))
       $out = $head.$out.$end;
       return $out;
    }

    /*
     * 生成天数行程
     * */
    public function genDayJieShao($lineinfo)
    {
        $head = "<daily_trips>\n";
        $end = "</daily_trips>\n";
        $out = '';
        foreach($lineinfo as $row)
        {
            $out.="<daily_trip>\n";
            $out.="<day>".$row['day']."</day>\n";
            $out.="<desc>".$this->replaceSpecialChar(strip_tags($row['jieshao']))."</desc>\n";
            $out.="<title>".$row['title']."</title>\n";
            if(!empty($row['dayspot']))
            {
                $out.="<sights>\n";
                foreach($row['dayspot'] as $v)
                {
                    $out.="<sight>".$v."</sight>\n";
                }
                $out.="</sights>\n";
            }

            $out.="<traffic>".$this->getTransport($row['traffic'])."</traffic>\n";
            $out.="<hotel_name>".$this->replaceSpecialChar(strip_tags($row['hotel']))."</hotel_name>\n";
            $out.="<hotel_star>无</hotel_star>\n";
            $out.="<beverage>".$row['beverage']."</beverage>\n";
            $out.="</daily_trip>\n";


        }
        return $head.$out.$end;

    }

    /*
     * 生成预订日期
     * */
    public function genLineDate($datearr)
    {
        $head = "<route_dates>\n";
        $end = "</route_dates>\n";
        $out = '';
        foreach($datearr as $row)
        {
            $out.="<route_date>\n";

            $out.="<date>".MyDate('Y-m-d',$row['day'])."</date>\n";
            $out.="<price>".$row['adultprice']."</price>\n";
            $out.="<child_price>".$row['childprice']."</child_price>\n";
            $out.="<stock>9999</stock>\n";
            $out.="<price_desc>无</price_desc>\n";
            $out.="</route_date>\n";
        }
        if(!empty($out))
        $out = $head.$out.$end;
        return $out;

    }

    public function writeXml($body,$filename)
    {
        $xmlbody = $this->xmlhead.$this->xmlstart.$body.$this->xmlend;
        $fp = fopen($filename,'w');
        $flag = fwrite($fp,$xmlbody);
        if($flag)
        {
            echo "{$filename}文件创建成功!";
        }


    }

    public function writeListXml($body,$filename)
    {
        $xmlbody = $this->xmlhead.$this->xml_list_start.$body.$this->xml_list_end;
        $fp = fopen($filename,'w');
        $flag = fwrite($fp,$xmlbody);
        if($flag)
        {
            echo "{$filename}文件创建成功!";
        }
    }

    //获取交通
    public  function getTransport($ids)
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


   public function replaceSpecialChar($C_char)
    {

     $C_char=HTMLSpecialChars($C_char); //将特殊字元转成 HTML 格式

     $C_char=nl2br($C_char); //使用nl2br内置函数将回车符替换为<br>

     $C_char=str_replace("&nbsp;","",$C_char); //将"&nbsp"替换为" "空格

     return $C_char;//返回处理结果
    }





} 