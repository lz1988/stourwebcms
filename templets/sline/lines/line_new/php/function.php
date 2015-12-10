<?php
/*
 * 模板自定义函数类,可以在这里编写当前模板用到的函数
 * @author netman
 */

class Line{

    public  static function getLineContent($row)
    {


       /* if($row['columnname']!='jieshao')
        {
            $content = $row['content'];
        }
        else
        {

           // $content = self::getLineJieShao($row['productid']); //行程内容
        }
        return $content;*/





    }

    /*
     * 获取简洁版行程内容样式
     * */
    public static function getLineJieShao($lineid)
    {
       if(self::checkJieShao3($lineid))
       {
           return self::getLineJieShao2($lineid);
       }
       else
       {
           global $dsql;
           $out = "";
           $sql = "select aid,isstyle,lineday,txtjieshao,jieshao,showrepast,transport,webid from #@__line where id='$lineid' ";
           $row = $dsql->GetOne($sql);
           $repast_style = empty($row['showrepast']) ? "style='display:none'" : '';
           $webid = $row['webid'];
           if(empty($row['isstyle']) || $row['isstyle'] == 0)
           {
               $row['isstyle'] = 1;
           }
           else
           {
               $row['isstyle'] = $row['isstyle'];
           }
           if($row['isstyle'] == 1) //编辑器里编辑的行程,直接读取
           {
               $out = $row['jieshao'];
           }
           elseif($row['isstyle'] == 2) //按天数上传的行程
           {
               $arr = explode(",",$row['txtjieshao']);
               //$transport = getTransport($row['transport']);
               for($i=1; $i<=$row['lineday']; $i++)
               {

                   $detail = explode("||",$arr[$i-1]);


                   //餐饮信息
                   $foodarr = explode(' ',$detail[1]);
                   $breakinfo = in_array(1,$foodarr) ? '含' : '不含';
                   $lunchinfo = in_array(2,$foodarr) ? '含' : '不含';
                   $supperinfo = in_array(3,$foodarr) ? '含' : '不含';
                   $breakinfo = !empty($detail[8]) ? $detail[8] : $breakinfo;
                   $lunchinfo = !empty($detail[9]) ? $detail[9] : $lunchinfo;
                   $supperinfo = !empty($detail[10]) ? $detail[10] : $supperinfo;
                   $transport = self::getTransport($detail[2]);
                   $out.=' <div class="nr_num_day">
                      <div class="con_div_1">
                        <div class="day_num">第'.$i.'天</div>
                        <div class="day_tit">'.$detail[0].'</div>
                      </div>
                      <div class="day_can" '.$repast_style.'>
                        <span class="tit">用餐</span>
                        <span class="txt">早餐：'.$breakinfo.'</span>
                        <span class="txt">中餐：'.$lunchinfo.'</span>
                        <span class="txt">晚餐：'.$supperinfo.'</span>
                      </div>
                      <div class="day_su">
                        <span class="tit">住宿</span>
                        <span class="txt">'.$detail[3].'</span>
                      </div>
                      <div class="day_jiao">
                        <span class="tit">交通</span>
                        <span class="txt">'.$transport.' </span>
                      </div>
                      <div class="day_ap">
                        <span class="tit">安排</span>
                        <div class="ap_con">
                          '.$detail[4].'
                        </div>
                      </div>
                     '.self::getDaySpot($i,$row['id'],$webid).'
                    </div>
                    ';








               }
           }

           return $out;

       }


    }
   public static function checkJieShao3($lineid)
    {
        global $dsql;
        $sql = "select count(*) as num from #@__line_jieshao where lineid='$lineid'";
        $row = $dsql->GetOne($sql);
        return $row['num']>0 ? 1 : 0;

    }

    public static function getLineJieShao2($lineid)
    {
        global $dsql;
        $out = "";
        $sql = "select aid,isstyle,lineday,jieshao,showrepast,transport,webid from #@__line where id='$lineid' ";
        $row = $dsql->GetOne($sql);
        $repast_style = empty($row['showrepast']) ? "style='display:none'" : '';
        //$webid = $row['webid'];
        $lineday = $row['lineday'];
        if(empty($row['isstyle']) || $row['isstyle'] == 0)
        {
            $row['isstyle'] = 1;
        }
        else
        {
            $row['isstyle'] = $row['isstyle'];
        }
        if($row['isstyle'] == 1) //编辑器里编辑的行程,直接读取
        {
            $out = $row['jieshao'];
        }

        elseif($row['isstyle'] == 2) //按天数上传的行程
        {

            $sql = "select * from #@__line_jieshao where lineid='$lineid' order by day asc";
            $arr = $dsql->getAll($sql);


            //$transport = getTransport($row['transport']);
            for($i=1; $i<=$lineday; $i++)
            {


                //$detail = explode("||",$arr[$i-1]);
                $j = $i-1;


                //餐饮信息

                $breakinfo = $arr[$j]['breakfirsthas'] ? '含' : '不含';
                $lunchinfo = $arr[$j]['lunchhas'] ? '含' : '不含';
                $supperinfo = $arr[$j]['supperhas'] ? '含' : '不含';
                $breakinfo =!empty($arr[$j]['breakfirst']) ? $arr[$j]['breakfirst'] : $breakinfo;
                $lunchinfo = !empty($arr[$j]['lunch']) ? $arr[$j]['lunch'] : $lunchinfo;
                $supperinfo = !empty($arr[$j]['supper']) ? $arr[$j]['supper'] : $supperinfo;
                $transport = self::getTransport($arr[$j]['transport']);
                $out.=' <div class="nr_num_day">
                      <div class="con_div_1">
                        <div class="day_num">第'.$i.'天</div>
                        <div class="day_tit">'.$arr[$j]['title'].'</div>
                      </div>
                      <div class="day_can" '.$repast_style.'>
                        <span class="tit">用餐</span>
                        <span class="txt">早餐：'.$breakinfo.'</span>
                        <span class="txt">中餐：'.$lunchinfo.'</span>
                        <span class="txt">晚餐：'.$supperinfo.'</span>
                      </div>
                      <div class="day_su">
                        <span class="tit">住宿</span>
                        <span class="txt">'.$arr[$j]['hotel'].'</span>
                      </div>
                      <div class="day_jiao">
                        <span class="tit">交通</span>
                        <span class="txt">'.$transport.' </span>
                      </div>
                      <div class="day_ap">
                        <span class="tit">安排</span>
                        <div class="ap_con">
                          '.$arr[$j]['jieshao'].'
                        </div>
                      </div>
                     '.self::getDaySpot($i,$lineid,0).'
                    </div>
                    ';








            }
        }

        return $out;

    }

    public static function getDaySpot($day,$lineid,$webid)
    {
        global $dsql;
        $out = null;
        $sql = "select * from #@__line_dayspot where day = '$day' and lineid='$lineid'";
        $arr = $dsql->getAll($sql);
        foreach($arr as $row)
        {
            $spotinfo = getInfo('#@__spot',"where id='{$row['spotid']}' ",'aid,content,piclist,litpic,title,webid');
            $description = cutstr_html(strip_tags($spotinfo['content']),200);//景点描述
            $spotpic = self::getSpotPic($spotinfo,$row['spotid'],$webid);

            $out.='    <div class="day_spot">
                        <span class="tit">景点</span>
                        <div class="spot_con">
                          <h4 class="tit">'.$row['title'].'</h4>
                          <div class="txt">
                            <p>'.$description.'</p>
                          </div>
                          <ul class="ul_list">
                           '.$spotpic.'
                          </ul>
                        </div>
                      </div>';



        }
        return $out;


    }

    public static function getSpotPic($spotinfo,$spotid,$webid)
    {
        $picarr = explode(',',$spotinfo['piclist']);

        $url = GetWebURLByWebid($spotinfo['webid']).'/spots/show_'.$spotinfo['aid'].'.html';
        $k = 1;
        foreach($picarr as $pic)
        {
            if($k<=3)
            {

                $p = explode('||',$pic);
                $picname = !empty($p[1]) ? $p[1] : $spotinfo['title'];//图片名称
                $litpic = !empty($p[0]) ? getUploadFileUrl($p[0]) : getUploadFileUrl($spotinfo['litpic']); //图片地址
                //array_push($out,array('picname'=>$picname,'litpic'=>$litpic));

                $out.='  <li><a class="fl" href="'.$url.'" target="_blank"><img class="fl" src="'.$litpic.'" width="170" height="125" alt="'.$picname.'" title="'.$picname.'" /></a><p><a href="'.$url.'" target="_blank">'.$picname.'</a></p></li>';
                $k++;
            }

        }
        return $out;

    }
    public static function getLineAttrName2($attrid)
    {
        $arr = self::getLineAttrArr($attrid);
        foreach($arr as $v)
        {
            $out.="<span>{$v}</span>";
        }
        return $out;

    }

    public static function getLineAttrArr($attrid,$esplit=',')
    {
        global $dsql;
        $arr = explode($esplit,$attrid);
        $out = array();
        $i = 0;
        foreach($arr as $id)
        {
            $sql = "select attrname from #@__line_attr where id='$id' and pid!=0";
            $row = $dsql->GetOne($sql);
            if(!empty($row['attrname']) && $i<6)
                array_push($out,$row['attrname']);
            $i++;

        }

        return $out;
    }

    /*
     * 获取行程内的交通
     * */
    public static function getTransport($con)
    {
        $transtext = array(
            "1"=>"飞机",
            "2"=>"汽车",
            "3"=>"火车",
            "4"=>"轮船",
            "5"=>"自驾");
        $transarr = explode(",",$con);

        $str ="";
        for($i=0; isset($transarr[$i]); $i++)
        {

            $str .= !empty($transtext[$transarr[$i]]) ? $transtext[$transarr[$i]] . "、" : '';

        }
        $str = empty($str) ? '无' : substr($str,0,strlen($str)-3);
       // $str = '未填写';
        return $str;
    }


}