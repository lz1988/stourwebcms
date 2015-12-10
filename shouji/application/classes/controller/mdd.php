<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Mdd extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $this->assign('cmsurl', URL::site());
    }

    //目的地列表
    public function action_index(){
        //定位第一级目的地
        $seoinfo = Common::getChannelSeo(12);
        foreach($seoinfo as $key=>$v)
        {
            $this->assign($key,$v);
        }
        $mmdlist = ORM::factory('destinations')->where("pid=0 and isopen=1")->get_all();
        //定位第二级目的地

         if(!empty($mmdlist)){
            foreach ($mmdlist as $key1 => $value1) {
                
                $mmdlist2 = ORM::factory('destinations')->where("pid=".$value1['id']." and isopen=1")->get_all();
               
                //定位第三级目的地
                if(!empty($mmdlist2)){
                    foreach ($mmdlist2 as $key2 => $value2) {
                        
                        $mmdlist3 = ORM::factory('destinations')->where("pid=".$value2['id']." and isopen=1")->get_all();

                        $mmdlist2[$key2]['nextlist'] = $mmdlist3; //附加数组到上一级

                    }
                }

                $mmdlist[$key1]['nextlist'] = $mmdlist2;    //附加数组到上一级

            }
         }
         $this->assign('list',$mmdlist);
         $this->display('mdd/index');
    }

    //目的地
    public function action_city(){
        $kindid=$this->params['id'];
        //当前目地的信息
        $row =ORM::factory('destinations')->where("id=$kindid")->find()->as_array();
        $tempic = trim($row['piclist'],',');
        if(empty($tempic)){
            $row['pic_arr'] = array();
        }else{
            $temarr = explode(",",trim($row['piclist'],','));
            foreach ($temarr as $key => $value) {
                $row['pic_arr'][$key] = explode("||",$value);
            }
        }
        //数据统计(攻略，线路，酒店，租车，门票，相册,团购)
        $Tjarr = array();
        $Tjarr['lines'] = ORM::factory('line')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
        $Tjarr['article'] = ORM::factory('article')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
        $Tjarr['hotel'] = ORM::factory('hotel')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
        $Tjarr['car'] = ORM::factory('car')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
        $Tjarr['spot'] = ORM::factory('spot')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
        $Tjarr['photo'] = ORM::factory('photo')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
        $Tjarr['tuan'] = ORM::factory('tuan')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->count_all();
       

        //推荐数据调用
        //文章（有图片的跟没有图片的）
        $articlelist1 =  ORM::factory('article')->where("litpic is not NULL and litpic<>'' and find_in_set(".$kindid.",kindlist) and ishidden=1")->order_by("modtime",'desc')->limit(4)->get_all();
        $articlelist2 =  ORM::factory('article')->where("find_in_set(".$kindid.",kindlist) and ishidden=1")->order_by("modtime",'desc')->limit(3)->get_all();
        //去掉html标记
        if(!empty($articlelist2)){
           foreach ($articlelist2 as $key => $value) {
              $articlelist2[$key]['content'] = Common::cutstr_html($value['content'],30);
            } 
        }
        
        //推荐线路，租车，酒店，门票,景区
        $lineslist = ORM::factory('line')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->order_by("modtime",'desc')->limit(4)->get_all();
        $carlist = ORM::factory('car')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->order_by("modtime",'desc')->limit(4)->get_all();
        $hotellist = ORM::factory('hotel')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->order_by("modtime",'asc')->limit(4)->get_all();
        $spotlist = ORM::factory('spot')->where("find_in_set(".$kindid.",kindlist) and ishidden=0")->order_by("modtime",'asc')->limit(4)->get_all();
        $photolist = ORM::factory('photo')->where("litpic is not NULL and litpic<>'' and find_in_set(".$kindid.",kindlist) and ishidden=1")->order_by("modtime",'asc')->limit(4)->get_all();

        //做一个初始标记，前台好设为选定状态（线路1，租车2，酒店3，门票4）
        $sts=4;
        if(!empty($spotlist)){
            $sts=4;
        }
        if(!empty($hotellist)){
            $sts=3;
        }
        if(!empty($carlist)){
            $sts=2;
        }
        if(!empty($lineslist)){
            $sts=1;
            foreach($lineslist as $key=> $line)
            {
                $lineslist[$key]['lineprice'] = Model_Line::getMinPrice($line['id']);
            }
        }
        $row['title'] = !empty($row['seotitle']) ? $row['seotitle'] : $row['kindname'];


        //数据压入
        $this->assign('row',$row);
        $this->assign('tj',$Tjarr);
        $this->assign('sts',$sts);
        $this->assign('articlarr1',$articlelist1);
        $this->assign('articlarr2',$articlelist2);
        $this->assign('lineslist',$lineslist);
        $this->assign('carlist',$carlist);
        $this->assign('hotellist',$hotellist);
        $this->assign('spotlist',$spotlist);
        $this->assign('photolist',$photolist);
        $this->display('mdd/mdd');
    }

    /*
     * 首页目的地搜索
     * */
    public function action_search()
    {
        $keyword = Arr::get($_POST,'keyword');
        //检测是否直接输入的目的地
        $sql = "select id from sline_destinations where kindname='$keyword' and isopen=1";

        $row = DB::query(1,$sql)->execute()->as_array();

        if(!empty($row[0]['id']))
        {
            $this->request->redirect('mdd/city/id/'.$row[0]['id']);
        }
        else
        {
            $sql = "select * from sline_destinations where kindname like '%{$keyword}%'";
            $arr = DB::query(1,$sql)->execute()->as_array();
            $this->assign('mddlist',$arr);
            $this->assign('keyword',$keyword);
            $this->display('mdd/search');
        }
    }

}