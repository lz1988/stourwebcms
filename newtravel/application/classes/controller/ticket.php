<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Ticket  extends Stourweb_Controller{
    public function before()
    {
        parent::before();
        $action = $this->request->action();

        if($action == 'list')
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
                Common::getUserRight('ticket',$user_action);


        }



        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        $this->assign('weblist',Common::getWebList());

    }

    //ctrip接口配置
    public function action_ctrip()
    {
        $this->display('stourtravel/ticket/ctrip');
    }

    //写入到ctrip网站配置文件里
    public function action_ajax_write_sid()
    {
        $sid = Arr::get($_POST,'sid');
        $key = Arr::get($_POST,'key');
        $alid = Arr::get($_POST,'alid');
        $writefile = BASEPATH.'/ctrip/public/cu_token.json';
        $arr = array(
            'uid'=>Arr::get($_POST,'alid'),
            'sid'=>Arr::get($_POST,'sid'),
            'key'=>Arr::get($_POST,'key')
        );
        $str = json_encode($arr);
        $fp = fopen($writefile,'wb');
        $flag = fwrite($fp,$str);
        fclose($fp);
        echo $flag;
        exit;
       //$str={"uid":"29976","sid":"469606","key":"16F7715F-AA5C-4F17-954E-7C5DFAB8A6BC"}
    }



}