<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Visit extends Stourweb_Controller{

    /*
     * 访问总控制器
     *
     */
    private   $engine_list = array(
        array('agentname' => "百度(BAIDU)",'agent'=>'BAIDU'),
        array('agentname' => "谷歌(GOOGLE)",'agent'=>'GOOGLE'),
        array('agentname' => "搜狗(SOGOU)",'agent'=>'SOGOU'),
        array('agentname' => "搜狗(SOGOU)",'agent'=>'SOSO'),
        array('agentname' => "360",'agent'=>'360SO'),
        array('agentname' => "谷歌中国(GOOGLE CHINA)",'agent'=>'GOOGLE CHINA'),
        array('agentname' => "雅虎中国(YAHOO CHINA)",'agent'=>'YAHOO CHINA'),
        array('agentname' => "雅虎(YAHOO)",'agent'=>'YAHOO'),
        array('agentname' => "有道(YODAO)",'agent'=>'YODAO'),
        array('agentname' => "外链(OTHER)",'agent'=>'OTHER'),
        array('agentname' => "内链(INNER)",'agent'=>'INNER')


    );
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('engine_list',json_encode($this->engine_list));

    }

    public function action_index()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/tools/visit_list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');
            $sttime = ARR::get($_GET,'sttime');
            $engine = ARR::get($_GET,'searchengine');

            $order='order by a.access_time desc';
            $w = "where a.id is not null";
            if(!empty($keyword))
            {
                $w.=" and a.keywords like '%{$keyword}%'";
            }
            if(!empty($sttime))
            {
                $sttime = strtotime($sttime);
                $w.=" and a.access_time >= $sttime ";
            }
            if(!empty($ettime))
            {
                $ettime = strtotime($ettime);
                $w.=" and a.access_time <= $sttime ";
            }
            if(!empty($engine))
            {
                $w.=" and a.searchengine = '$engine'";
            }



            $sql="select a.*  from sline_stats as a $w $order limit $start,$limit";



            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_stats a $w ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
                $v['access_time'] = Common::myDate('Y-m-d H:i:s',$v['access_time']);
                $v['searchengine'] = $this->getSearchEngine($v['searchengine']);
                $new_list[] = $v;

            }
            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$new_list;
            $result['success']=true;

            echo json_encode($result);
        }
        else if($action=='save')   //保存字段
        {

        }
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id)) //
            {
                $model=ORM::factory('stats',$id);
                $model->delete();
            }
        }
        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            if(is_numeric($id))
            {
                $model=ORM::factory('stats')->where('id','=',$id)->find();

            }

            if($model->id)
            {
                $model->$field=$val;

                $model->update();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }
        }
    }
    //获取搜索引擎
    private function getSearchEngine($engine)
    {
        if($engine == "OTHER")
        {
            $out = "外链";
        }
        elseif($engine == "INNER")
        {
            $out = "内链";
        }
        else
        {
            $out = $engine;
        }
        return $out;


    }




}