<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Footernav extends Stourweb_Controller{

   /*
    * 底部导航管理控制器
    * */

    public function before()
    {
        parent::before();
        $action = $this->request->action();
        if($action == 'index')
        {
            Common::getUserRight('footernav','slook');
        }
        if($action == 'addnav')
        {
            Common::getUserRight('footernav','sadd');
        }
        if($action == 'editnav')
        {
            Common::getUserRight('footernav','smodify');
        }
        if($action == 'ajax_del')
        {
            Common::getUserRight('footernav','sdelete');
        }
        if($action == 'ajax_savefooternav')
        {
            Common::getUserRight('footernav','sdelete');
        }


        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->parentkey = $this->params['parentkey'];
        $this->itemid = $this->params['itemid'];
        $weblist = Common::getWebList();
        $this->assign('weblist',$weblist);
        $this->assign('helpico',Common::getIco('help'));
        $this->model = new Model_FooterNav();

    }

    public function action_index()
    {
        //$config = Common::getConfig('menu.产品');

        $this->display('stourtravel/footernav');

    }
    /*
   * 底部导航添加
   * */
    public function action_addnav()
    {
        $this->assign('webid',$this->params['webid']);
        $this->assign('action','ajax_addsave');//保存方法
        $this->display('stourtravel/footernav_edit');
    }
    /*
     * 底部导航修改
     * */
    public function action_editnav()
    {
        $navid = $this->params['id'];
        $serverinfo = ORM::factory('footernav',$navid)->as_array();
        $this->assign('serverinfo',$serverinfo);
        $this->assign('action','ajax_editsave');
        $this->display('stourtravel/footernav_edit');
    }
    /*
     * 底部保存添加(ajax)
     * */
    public function action_ajax_addsave()
    {
        $model = ORM::factory('footernav');
        $model->servername = ARR::get($_POST,'servername');
        $model->content = ARR::get($_POST,'content');
        $model->webid = ARR::get($_POST,'webid');
        $model->aid = Common::getLastAid('sline_serverlist');
        $model->save();
        $flag = false;
        if($model->saved())
        {
            $flag = true;
        }
        echo json_encode(array('status'=>$flag));
    }
    /*
     * 底部修改保存(ajax)
     * */
    public function action_ajax_editsave()
    {
        $navid = ARR::get($_POST,'articleid');
        $model = ORM::factory('footernav',$navid);
        $model->servername =  ARR::get($_POST,'servername');
        $model->content = ARR::get($_POST,'content');
        if($model->update())
        {
            $flag = true;
        }
        echo json_encode(array('status'=>$flag));

    }
    /*
     * 删除
     * */
    public function action_ajax_del()
    {
        $navid = ARR::get($_GET,'id');
        $model = ORM::factory('footernav',$navid);
        $model->delete();
        $out = array();
        if(!$model->loaded())
        {
            $out['status'] = true;
        }
        else
        {
            $out['status'] = false;
        }
        echo json_encode($out);

    }

    /*
    * 底部导航获取(ajax)
    * */
    public function action_ajax_getfooternav()
    {

        $webid = ARR::get($_GET,'webid');
        $model =  new Model_FooterNav();
        $arr = $model->getFooterNav($webid);

        $out = array();
        foreach($arr as $row)
        {

            $openstatus = $row['isdisplay'] ? Common::getIco('show') : Common::getIco('hide');
            $tr ='
                  <tr>
                  <td height="40" align="center"><input type="text"  name="displayorder[]" class="tb-text text_60 al" value="'.$row['displayorder'].'" /></td>
                  <td><input type="text"  name="servername[]" class="tb-text text_300 pl-5" value="'.$row['servername'].'" /></td>
                  <td align="center" onclick="changeShow(this)">'.$openstatus.'<input type="hidden" name="isdisplay[]" value='.$row['isdisplay'].'></td>
                  <td align="center"><a href="javascript:;" class="row-mod-btn" onclick="edit('.$row['id'].')" title="修改"></a></td>
                  <td align="center"><a href="javascript:;" class="row-del-btn" onclick="del('.$row['id'].',this)" title="删除"></a><input type="hidden" name="id[]" value="'.$row['id'].'"/></td>
                </tr>
            ';
            array_push($out,$tr);
        }
        echo json_encode(array('trlist'=>$out));


    }
    /*
    * 底部导航保存(ajax)
    * */
    public function action_ajax_savefooternav()
    {

        $model = new Model_FooterNav();
        $model->saveNav($_POST);
        echo json_encode(array('status'=>true));
    }




}