<?php defined('SYSPATH') or die('No direct script access.');
class Controller_User extends Stourweb_Controller{

    public function before()
    {
        parent::before();
        $session = Session::instance();
        $roleid = $session->get('roleid');
        if($roleid != 1)
        {
            exit(__('onlysys'));
        }
        $this->assign('cmsurl', URL::site());
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

    }

    public function action_list()
    {
        $action=$this->params['action'];
        if(empty($action))
        {
            $roles=ORM::factory('role')->get_all();
            $this->assign('roles',json_encode($roles));
            $this->display('stourtravel/user/list');
        }
        else if($action=='read')
        {
            $start=Arr::get($_GET,'start');
            $limit=Arr::get($_GET,'limit');
            $sort=json_decode(Arr::get($_GET,'sort'));

            $w="a.id is not null";
            $sql="select a.*,b.rolename from sline_admin a left join sline_role b on a.roleid=b.roleid where $w order by a.roleid limit $start,$limit ";
            $totalcount_arr=DB::query(Database::SELECT,"select count(*) as num from sline_admin a  where $w")->execute()->as_array();
            $list=DB::query(Database::SELECT,$sql)->execute()->as_array();

            $result['total']=$totalcount_arr[0]['num'];
            $result['lists']=$list;
            $result['success']=true;
            echo json_encode($result);
        }
        else if($action=='update')
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');

            $model=ORM::factory('admin',$id);
            $model->$field=$val;
            $model->save();
            if($model->saved())
                echo 'ok';
            else
                echo 'no';
        }
        else if($action=='delete') //删除某个记录
        {

            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            if(is_numeric($id))
            {
                $model=ORM::factory('admin',$id);
                $model->deleteClear();
            }
        }
    }

    /*
     * 管理用户添加
     */
    public function action_ajax_save()
    {
        $id=Arr::get($_POST,'id');
        $pwd=$_POST['password'];
        if($id)
        {
           $model=ORM::factory('admin',$id);
            if(!empty($pwd))
                $model->password=md5($pwd);
        }
        else
        {
            $model=ORM::factory('admin');
            $model->username=Arr::get($_POST,'username');
            $model->password=md5($pwd);
        }
        $model->roleid=Arr::get($_POST,'roleid');
        $model->beizu=Arr::get($_POST,'beizu');
        $model->save();
        if($model->saved())
        {
            $model->reload();
            $_arr=$model->as_array();
            echo json_encode(array('status'=>true,'msg'=>'保存成功'));
        }
        else
        {
            echo json_encode(array('status'=>false,'msg'=>'保存失败'));
        }
    }
    public function action_ajax_checkuser()
    {
        $username=Arr::get($_POST,'username');
        $model=ORM::factory('admin')->where("username='$username'")->find();
        if($model->id)
            echo 'false';
        else
            echo 'true';
    }
    /*
     * 权限管理
     */
    public function action_right()
    {
        $action=$this->params['action'];
        if(empty($action))
        {
            $model=ORM::factory('role');
            $list=$model->get_all();
            $this->assign('list',$list);
            $this->display('stourtravel/user/rightlist');
        }
        else if($action=='save')
        {
            $rolename_arr=Arr::get($_POST,'rolename');
            $description_arr=Arr::get($_POST,'description');
            foreach($rolename_arr as $k=>$v)
            {
                $model=ORM::factory('role',$k);
                if($model->roleid)
                {
                    $model->rolename=$v;
                    $model->description=$description_arr[$k];
                    $model->save();
                }
            }
            echo 'ok';
        }
        else if($action=='add')
        {
            $model=ORM::factory('role');
            $model->rolename='自定义';
            $model->create();
            $model->reload();
            echo $model->roleid;

        }
        else if($action=='del')
        {
            $id=Arr::get($_POST,'id');
            if($id==1)
            {
                echo 'no';
            }
            else
            {
                $model=ORM::factory('role',$id);
                $model->delete();
                echo 'ok';
            }
        }
    }
    /*
     * 设置权限
     */
    public function action_setright()
    {
       $action=$this->params['action'];
       if(empty($action))
       {
           $menu=include(APPPATH.'config/menu_sub.php');
           $roleid=$this->params['roleid'];
           if(empty($roleid))
               exit('权限ID错误');
           $role_module=ORM::factory('role_module')->where("roleid=$roleid")->get_all();
           foreach($role_module as $k=>$v)
           {
               $role_module[$v['moduleid']]=$v;
           }
           $list=array();
           $id=1000;
           foreach($menu['chinesename'] as $k=>$v)
           {
              if($k=='chinesename')
                  continue;
              $new_array=array();
              $new_array['text']=$v;
              $new_array['id']='id_'.$id;
              $id++;
              $new_array['isparent']=1;
              $children=array();
              foreach($menu[$k] as $key=>$val)
              {
                  $new_child=array();
                  $new_child['key']=$key;
                  $new_child['slook']=$role_module[$key]['slook'];
                  $new_child['smodify']=$role_module[$key]['smodify'];
                  $new_child['sadd']=$role_module[$key]['sadd'];
                  $new_child['sdelete']=$role_module[$key]['sdelete'];
                  $new_child['text']=$val['name'];
                  $new_child['leaf']=true;
                  $new_child['id']='id_'.$id;
                  $id++;
                  $children[]=$new_child;
              }
              $new_array['children']=$children;
              $list[]=$new_array;

           }
           $this->assign('roleid',$roleid);
           $this->assign('list',$list);
           $this->display('stourtravel/user/rightset');
       }
        else if($action=='update')
        {
            $field=Arr::get($_POST,'field');
            $moduleid=Arr::get($_POST,'moduleid');
            $value=Arr::get($_POST,'value');
            $roleid=Arr::get($_POST,'roleid');
            Model_Role_Module::setField($roleid,$moduleid,$field,$value);
        }

    }
    public function action_dialog_edit()
    {
        $id=$_GET['id'];
        if(!empty($id))
        {
            $model=ORM::factory('admin',$id);
            if($model->loaded())
            {
                $info=$model->as_array();
                $this->assign('info',$info);
            }
        }
        $roles=ORM::factory('role')->get_all();
        $this->assign('roles',$roles);
        $this->display('stourtravel/user/dialog_edit');
    }






}