<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Keyword extends Stourweb_Controller{

    /*
     * 关键词管理总控制器
     *
     */

    private $channelArr = array(
        '1'=>array('channelname'=>'线路','table'=>'sline_line','typeid'=>1,'fieldname'=>'title','url'=>'/lines/'),
        '2'=>array('channelname'=>'酒店','table'=>'sline_hotel','typeid'=>2,'fieldname'=>'title','url'=>'/hotels/'),
        '3'=>array('channelname'=>'租车','table'=>'sline_car','typeid'=>3,'fieldname'=>'title','url'=>'/cars/'),
        '4'=>array('channelname'=>'攻略','table'=>'sline_article','typeid'=>4,'fieldname'=>'title','url'=>'/raiders/'),
        '5'=>array('channelname'=>'景点','table'=>'sline_spot','typeid'=>5,'fieldname'=>'title','url'=>'/spots/'),
        '6'=>array('channelname'=>'相册','table'=>'sline_photo','typeid'=>6,'fieldname'=>'title','url'=>'/photos/'),
        '8'=>array('channelname'=>'签证','table'=>'sline_visa','typeid'=>8,'fieldname'=>'title','url'=>'/visa/'),
        '13'=>array('channelname'=>'团购','table'=>'sline_tuan','typeid'=>12,'fieldname'=>'title','url'=>'/tuan/'),
    );
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('channelArr',json_encode($this->channelArr));


    }

    public function action_index()
    {
        $action=$this->params['action'];

        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/tools/keyword_list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');
            $channelid = Arr::get($_GET,'channelid');
            $channelid = empty($channelid) ? 1 : $channelid;
            $type = Arr::get($_GET,'type');
            $type = empty($type) ? 0 : $type;


            $fieldname = $this->channelArr[$channelid]['fieldname'];

            $tablename = $this->channelArr[$channelid]['table'];
            $w = "where id > 0 ";
            $w.= $type ? "and (keyword is  NULL or keyword = '')" : "";
            $w.= $keyword ? " and keyword like '%{$keyword}%'" : '';

            $sql="select id, aid, {$fieldname} as title,keyword  from  {$tablename} $w limit $start,$limit";


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num  from  {$tablename} $w ")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
            $new_list=array();
            foreach($list as $k=>$v)
            {
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

        else if($action=='update')//更新某个字段
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $channelid = $this->params['channelid'];
            $tablename = $this->channelArr[$channelid]['table'];
            $modelname = str_replace('sline_','',$tablename);
            if(is_numeric($id))
            {
                $model=ORM::factory($modelname)->where('id','=',$id)->find();

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

    /*
     * 添加
     * */
    public function action_add()
    {
        $this->assign('action','add');
        $this->display('stourtravel/supplier/edit');
    }
    /*
     * 修改
     * */
    public function action_edit()
    {
        $id = $this->params['id'];//会员id.
        $this->assign('action','edit');
        $info = ORM::factory('supplier',$id)->as_array();
        $this->assign('info',$info);
        $this->display('stourtravel/supplier/edit');
    }

    /*
     * 生成Excel
     * */
    public function action_genexcel()
    {

        $typeid = $this->params['typeid'];

        $fieldname = $this->channelArr[$typeid]['fieldname'];

        $tablename = $this->channelArr[$typeid]['table'];

        $link = $this->channelArr[$typeid]['url'];


        $sql="select id, aid,seotitle,{$fieldname} as title,keyword  from  {$tablename}";


        $list=DB::query(Database::SELECT,$sql)->execute()->as_array();
        $table = "<table><tr>";
        $table.="<td>产品名称</td>";
        $table.="<td>优化标题</td>";
        $table.="<td>关键词</td>";
        $table.="<td>链接地址</td>";
        $table.="</tr>";
        foreach($list as $row)
        {

            $url = $GLOBALS['cfg_basehost'].$link.'show_'.$row['aid'].'.html';
            $table.="<tr>";

            $table.="<td>{$row['title']}</td>";
            $table.="<td>{$row['seotitle']}</td>";
            $table.="<td>{$row['keyword']}</td>";
            $table.="<td>{$url}</td>";
            $table.="</tr>";

        }
        $table.="</table>";
        $filename = date('Ymdhis');
        header ( 'Pragma:public');
        header ( 'Expires:0');
        header ( 'Cache-Control:must-revalidate,post-check=0,pre-check=0');
        header ( 'Content-Type:application/force-download');
        header ( 'Content-Type:application/vnd.ms-excel');
        header ( 'Content-Type:application/octet-stream');
        header ( 'Content-Type:application/download');
        header ( 'Content-Disposition:attachment;filename='.$filename.".xls" );
        header ( 'Content-Transfer-Encoding:binary');

        //define("FILETYPE","xls");
        //header("Content-type:application/vnd.ms-excel");
        //header('Content-type: charset=GBK');
        //header('Pragma: no-cache');
        //header('Expires: 0');
        //header("Content-Disposition:filename=".$info['name'].".xls");
        //$str = iconv("UTF-8//IGNORE","GBK//IGNORE",$str);
        echo $table;
        exit();
    }
    /*
     * 保存
     * */
    public function action_ajax_save()
    {
        $action = Arr::get($_POST,'action');//当前操作
        $id = Arr::get($_POST,'id');

        $status = false;


        //添加操作
        if($action == 'add' && empty($id))
        {
            $model = ORM::factory('supplier');
            $model->addtime = time();

        }
        else
        {
            $model = ORM::factory('supplier')->where('id','=',$id)->find();

        }

        $model->suppliername = Arr::get($_POST,'suppliername');
        $model->linkman = Arr::get($_POST,'linkman');
        $model->mobile = Arr::get($_POST,'mobile');
        $model->telephone = Arr::get($_POST,'telephone');
        $model->address = Arr::get($_POST,'address');
        $model->litpic = Arr::get($_POST,'litpic');
        $model->fax = Arr::get($_POST,'fax');
        $model->qq = Arr::get($_POST,'qq');
        $model->modtime = time();

        if($action=='add' && empty($id))
        {

            $model->create();
        }
        else
        {
            $model->update();
        }

        if($model->saved())
        {
            if($action=='add')
            {
                $productid = $model->id; //插入的产品id

            }
            else
            {
                $productid =null;
            }

            $status = true;
        }
        echo json_encode(array('status'=>$status,'productid'=>$productid));

    }

    /*
     * ajax检测是否存在
     * */
    public function action_ajax_check()
    {
        $field = $this->params['type'];
        $val = Arr::get($_POST,'val');//值
        $mid = Arr::get($_POST,'mid');//会员id
        $flag = Model_Member::checkExist($field,$val,$mid);
        echo $flag;
    }

}