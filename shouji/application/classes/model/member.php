<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Member extends ORM {

    protected  $_primary_key = 'mid';

      /*
       * 检查是否存在相同数据
       * */
    public static function checkExist($field,$value,$mid='')
    {
        $flag = 1;
        $model = ORM::factory('member')->where($field,'=',$value);
        if(!empty($mid))
        {
            $model->where('mid','!=',$mid);
        }
        else
        {

        }
        $model->find();
        if($model->loaded() && !empty($model->mid))
        {
            $flag = 0;
        }
        return $flag  ;
    }

    public static function login($mobile,$pwd)
    {
        $pwd = md5($pwd);
        $out = 0;
        $where = "mobile='$mobile' and pwd='$pwd'";

        $userinfo = ORM::factory('member')->where("mobile='$mobile' and pwd='$pwd'")->find()->as_array();

        if($userinfo['mid'])
        {
            //将用户信息保存到session
            $session = Session::instance();
            $serectkey = Common::authcode($userinfo['mobile'].'||'.$userinfo['pwd'],'');
            $session->set('mobile',$serectkey);
            Cookie::set('mobile', $serectkey);
            $out = $userinfo;
        }
        return $out;

    }



}