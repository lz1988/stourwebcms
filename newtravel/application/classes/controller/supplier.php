<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Supplier extends Stourweb_Controller{

    /*
     * 供应商总控制器
     *
     */
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'index')
        {

            $param = $this->params['action'];
            $right = array(
                'read'=>'slook',
                'save'=>'smodify',
                'delete'=>'sdelete',
                'update'=>'smodify'
            );
            $user_action = $right[$param];
            if(!empty($user_action))
                Common::getUserRight('supplier',$user_action);


        }
        if($action == 'add')
        {
            Common::getUserRight('supplier','sadd');
        }
        if($action == 'edit')
        {
            Common::getUserRight('supplier','smodify');
        }
        if($action == 'ajax_save')
        {
            Common::getUserRight('supplier','smodify');
        }

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);


    }

    public function action_index()
    {
        $action=$this->params['action'];
        if(empty($action))  //显示列表
        {
            $this->display('stourtravel/supplier/list');
        }
        else if($action=='read')    //读取列表
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $keyword=Arr::get($_GET,'keyword');

            $order='order by a.addtime desc';

            if(!empty($keyword))
            {
                $w ="where (a.suppliername like '%{$keyword}%' or a.telephone like '%{$keyword}%' or a.mobile like '%{$keyword}%')";
            }


            $sql="select a.*  from sline_supplier as a $w $order limit $start,$limit";
            //echo $sql;


            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_supplier a ")->execute()->as_array();
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
        else if($action=='delete') //删除某个记录
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;

            if(is_numeric($id)) //
            {
                $model=ORM::factory('supplier',$id);
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
                $model=ORM::factory('supplier')->where('id','=',$id)->find();

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
     * 保存
     * */
    public function action_ajax_save()
    {
        $action = ARR::get($_POST,'action');//当前操作
        $id = ARR::get($_POST,'id');

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

        $model->suppliername = ARR::get($_POST,'suppliername');
        $model->linkman = ARR::get($_POST,'linkman');
        $model->mobile = ARR::get($_POST,'mobile');
        $model->telephone = ARR::get($_POST,'telephone');
        $model->address = ARR::get($_POST,'address');
        $model->litpic = ARR::get($_POST,'litpic');
        $model->fax = ARR::get($_POST,'fax');
        $model->qq = ARR::get($_POST,'qq');
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
      以json方式返回供应商列表
   */
    public function action_ajax_supplier_list()
    {
        $model=ORM::factory('supplier');
        $list=$model->get_all();
        echo json_encode($list);
    }
    /*
      设置产品供应商
    */
    public function action_ajax_set_supplier()
    {
        $product_arr=array(
            1=>'line',
            2=>'hotel',
            3=>'car',
            4=>'article',
            5=>'spot',
            6=>'photo',
            8=>'visa',
            13=>'tuan'
        );

        $typeid=ARR::get($_POST,'typeid');
        $productid=ARR::get($_POST,'productid');
        $supplierids=ARR::get($_POST,'supplierids');
        $model=ORM::factory($product_arr[$typeid],$productid);
        $is_success='ok';
        $productid_arr=explode('_',$productid);
        foreach($productid_arr as $k=>$v)
        {
            $model=ORM::factory($product_arr[$typeid],$v);
            if($model->id)
            {
                $model->supplierlist=$supplierids;
                $model->save();
                if(!$model->saved())
                    $is_success='no';
            }
        }
        echo $is_success;
    }

    /*
     * ajax检测是否存在
     * */
    public function action_ajax_check()
    {
        $field = $this->params['type'];
        $val = ARR::get($_POST,'val');//值
        $mid = ARR::get($_POST,'mid');//会员id
        $flag = Model_Member::checkExist($field,$val,$mid);
        echo $flag;
    }

    public function action_dialog_set()
    {
        $suppliers=$_GET['suppliers'];
        $id=$_GET['id'];
        $typeid=$_GET['typeid'];
        $selector=urldecode($_GET['selector']);
        $supplierArr=explode(',',$suppliers);
        $supplierList=ORM::factory('supplier')->get_all();

        $this->assign('supplierArr',$supplierArr);
        $this->assign('selector',$selector);
        $this->assign('supplierList',$supplierList);
        $this->display('stourtravel/supplier/dialog_set');
    }

}