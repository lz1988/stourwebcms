<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Kefu extends Stourweb_Controller{

   private  $parentkey = null;
   private  $itemid = null;
   public function before()
   {
       parent::before();
       $action = $this->request->action();
       Common::getUserRight('kefu','smodify');

       $this->assign('parentkey',$this->params['parentkey']);
       $this->assign('itemid',$this->params['itemid']);
       $this->parentkey = $this->params['parentkey'];
       $this->itemid = $this->params['itemid'];
       $weblist = Common::getWebList();
       $this->assign('weblist',$weblist);
       $this->assign('helpico',Common::getIco('help'));



   }



    /*
     * 客服电话设置
     * */
    public function action_phone()
    {
        $this->display('stourtravel/kefu/phone');
    }

    /*
     * QQ客服
     * */
    public function action_qq()
    {
        $kefufile = BASEPATH.'/qqkefu/config.main.php';

        include_once($kefufile);


        $this->assign('pos',$pos);
        $this->assign('display',$display);
        $this->assign('posh',$posh);
        $this->assign('post',$post);
        $this->assign('qqcl',$qqcl);
        $this->assign('phonenum',$phonenum);
        $this->display('stourtravel/kefu/qq');
    }

    /*
     * 第三方客服
     * */
    public function action_other()
    {
        $this->display('stourtravel/kefu/third');
    }

    /*
     * 保存第三方客服
     * */
    public function action_ajax_save()
    {
        $kefufile = BASEPATH.'/qqkefu/config.main.php';
        $display = Arr::get($_POST,'display');
        $pos = Arr::get($_POST,'position');
        $posh = Arr::get($_POST,'posh');
        $post = Arr::get($_POST,'post');
        $phonenum = Arr::get($_POST,'phonenum');
        $qqcl = Arr::get($_POST,'qqcl');
        $str='<?php '."\r\n";

        if(empty($pos))
            $str.='$pos="left";'."\r\n";
        else
            $str.='$pos="'.$pos.'";'."\r\n";
        if(empty($posh))
            $str.='$posh="10px";'."\r\n";
        else
        {
            if(strpos($posh,'%')===false&&strpos($posh,'px')===false)
            {
                $posh=(int)$posh.'px';
            }
            $str.='$posh="'.$posh.'";'."\r\n";
        }
        if(empty($post))
            $str.='$post="50%";'."\r\n";
        else
        {
            if(strpos($post,'%')===false&&strpos($post,'px')===false)
            {
                $post=(int)$post.'px';
            }
            $str.='$post="'.$post.'";'."\r\n";
        }
        $str.= empty($display) ? '$display=0;'."\r\n" : '$display=1;'."\r\n";
        $str.= empty($qqcl) ? '$qqcl=1;'."\r\n" : '$qqcl="'.$qqcl.'";';
        $str.= !empty($phonenum) ? '$phonenum="'.$phonenum.'";' : '';
        Common::saveToFile($kefufile,$str);
        echo json_encode(array('status'=>true));


    }


    /*
     * qqlist
     * */
    public function action_qqlist()
    {

        $action=$this->params['action'];

        $attrtable = 'qq_kefu';
        if($action=='read')
        {


            $node=Arr::get($_GET,'node');
            $list=array();
            if($node=='root')//属性组根
            {
                $list=ORM::factory($attrtable)->where('pid','=','0')->get_all();

                $list[]=array(
                    'leaf'=>true,
                    'id'=>'0add',
                    'qqname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(0)">添加</button>',
                    'displayorder'=>'add'
                );
            }
            else //子级
            {
                $list=ORM::factory($attrtable)->where('pid','=',$node)->get_all();
                foreach($list as $k=>$v)
                {

                    $list[$k]['leaf']=true;
                }
                $list[]=array(
                    'leaf'=>true,
                    'id'=>$node.'add',
                    'qqname'=>'<button class="dest-add-btn df-add-btn" onclick="addSub(\''.$node.'\')">添加</button>',
                    'displayorder'=>'add'
                );
            }
            echo json_encode(array('success'=>true,'text'=>'','children'=>$list));
        }
        else if($action=='addsub')//添加子级
        {
            $pid=Arr::get($_POST,'pid');

            $model=ORM::factory($attrtable);
            $model->pid=$pid;
            $model->qqname="未命名";
            $model->save();

            if($model->saved())
            {
                $model->reload();
                echo json_encode($model->as_array());
            }
        }
        else if($action=='save') //保存修改
        {
            $rawdata=file_get_contents('php://input');
            $field=Arr::get($_GET,'field');
            $data=json_decode($rawdata);
            $id=$data->id;
            if($field)
            {
                $model=ORM::factory($attrtable,$id);
                if($model->id)
                {
                    $model->$field=$data->$field;
                    $model->save();
                    if($model->saved())
                        echo 'ok';
                    else
                        echo 'no';
                }
            }

        }


        else if($action=='delete')//属性删除
        {
            $rawdata=file_get_contents('php://input');
            $data=json_decode($rawdata);
            $id=$data->id;
            if(!is_numeric($id))
            {
                echo json_encode(array('success'=>false));
                exit;
            }
            $model=ORM::factory($attrtable,$id);
            $model->delete();

        }
        else if($action=='update')//更新操作
        {
            $id=Arr::get($_POST,'id');
            $field=Arr::get($_POST,'field');
            $val=Arr::get($_POST,'val');
            $model=ORM::factory($attrtable,$id);
            if($model->id)
            {
                $model->$field=$val;
                $model->save();
                if($model->saved())
                    echo 'ok';
                else
                    echo 'no';
            }
        }

    }










}