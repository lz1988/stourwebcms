<?php
/**
 * User: Netman
 * Date: 14-3-27
 * Time: 下午9:53
 */ 

class Stourweb_Controller extends Controller {

  // 用户数据赋值
   public $_data = array();
   public $params = array();
    /*
     * before
     */
   public function before()
   {
       $params = $this->request->param('params');

       $this->params = $this->analyze_param($params);
       $this->assign('cmsurl', URL::site()); //手机版相对地址
       $this->assign('computerurl',$GLOBALS['cfg_deskurl']);//电脑版地址
       $this->assign('weburl', $GLOBALS['cfg_basehost']);//当前域名
       $this->assign('publicurl',$GLOBALS['cfg_public_url']);//公共资源css,images地址
       $this->assign('webname',Common::getSysConf('value','cfg_webname',0));//当前站点名.
       $this->assign('logo',Common::getSysPara('cfg_m_logo'));
       $this->assign('cmscontroller', $this->request->controller());
       //$controller = $this->request->controller();
       //用户是否登陆
       $session_mobile=Session::instance()->get('mobile');
       $cookie_mobile=Cookie::get('mobile');
       if(!empty($session_mobile))
       {
           $GLOBALS['userinfo'] = Common::checkLogin($session_mobile);
       }
       else if(!empty($cookie_mobile))
       {
           $GLOBALS['userinfo'] = Common::checkLogin($session_mobile);
       }

       $this->assign('user',$GLOBALS['userinfo']);



      /*if($controller != 'login')
       {

           $needCheck=1;//uplodify检测
           if ($_SERVER['HTTP_USER_AGENT'] == 'Shockwave Flash')
           {
               $needCheck=0; // avoid uplodify check.
           }
           if($needCheck)
           {
               $session = Session::instance();
               $session_username = $session->get('username');
               $cookie_username = Cookie::get('username');
               if(!isset($session_username) && !isset($cookie_username))
               {
                   $this->request->redirect('login/index');
               }
               else if(isset($cookie_username)&&!isset($session_username))
               {
                   $sql="select * from sline_admin where username='{$cookie_username}'";

                   $curuser=DB::query(1,$sql)->execute()->as_array();

                   if(empty($curuser[0]['id']))
                   {
                       $this->request->redirect('login/index');
                   }

                   $session = Session::instance();
                   $session->set('username',$curuser[0]['username']);
                   $session->set('userid',$curuser[0]['id']);
                   $session->set('roleid',$curuser[0]['roleid']);
                   $rolemodule=ORM::factory('role_module')->where("roleid='{$curuser[0]['roleid']}'")->as_array();
                   $session->set('rolemodule',$rolemodule);

               }
              /* if(empty($username))
               {
                   $this->request->redirect('login/index');
               }

           }

       }*/



   }

   /*
    * 显示模板
    * @param string $tpl,模板名
    * */
   public function display($tpl)
   {

       $file = $GLOBALS['cfg_templet'].'/'.$tpl;


       if(!file_exists(APPPATH.'/views/'.$GLOBALS['cfg_templet'].'/'.$tpl.'.php'))
       {
           $file = 'mobile/'.$tpl;
       }
       //$tpl = !empty($GLOBALS['cfg_templet']) ? $GLOBALS['cfg_templet'].'/'.$tpl : $tpl;//是否定义默认模板判断.

       $view = Stourweb_View::factory($file);

       foreach($this->_data as $key=>$value)
       {
           $view->set($key,$value);
       }

       $this->response->body($view->render());

   }

  /*
   * 模板赋值,控制器赋值
   * @param string $key
   * @param string $value
   * */
   public function assign($key,$value)
   {

       $this->_data[$key] = $value;

   }
    /*
  * 变量值分析器
  * @param string $param
  * */
    public function analyze_param($param)
    {

        $arr = explode('/',$param);

        $out = array();
        for($i = 0;isset($arr[$i]) ;$i=$i+1)
        {
           if($i % 2 ==0)
           {
               $key = $arr[$i];
               $value= isset($arr[$i+1]) ? $arr[$i+1] : 0;
               $out[$key] = $value;
           }

        }
        return $out;

    }


} 