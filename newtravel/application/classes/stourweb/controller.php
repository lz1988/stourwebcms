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

       $controller = $this->request->controller();
       $action = $this->request->action();
       $second_action=$this->params['action'];

       if($controller != 'login')
       {


           $needCheck=1;//uplodify检测

           if($needCheck)
           {
               $session = Session::instance();
               $session_username = $session->get('username');
               $cookie_username = Cookie::get('username');
               $uploadcookie = Arr::get($_POST,'uploadcookie');

               $serectkey = !empty($cookie_username) ? $cookie_username : $session_username;
               $serectkey = !empty($serectkey) ? $serectkey : $uploadcookie;


               if(isset($serectkey))
               {
                   $result = Common::checkLogin($serectkey);
                   if(!$result)
                   {
                       $session = Session::instance();
                       $session->delete('username');
                       $session->delete('userid');
                       $session->delete('roleid');
                       Cookie::delete('username');
                       $this->request->redirect('login/index');
                   }
                   else
                   {
                       $session = Session::instance();
                       $serectkey = Common::authcode($result['username'].'||'.$result['password'],'');
                       $session->set('username',$serectkey);
                       $session->set('userid',$result['id']);
                       $session->set('roleid',$result['roleid']);
                       Cookie::set('username', $serectkey);
                       $rolemodule=ORM::factory('role_module')->where("roleid='{$result[0]['roleid']}'")->as_array();
                       $session->set('rolemodule',$rolemodule);
                   }



               }
               else
               {
                   $session = Session::instance();
                   $session->delete('username');
                   $session->delete('userid');
                   $session->delete('roleid');
                   Cookie::delete('username');
                   $this->request->redirect('login/index');
               }

               Common::addLog($controller,$action,$second_action);

           }


       }




   }

   /*
    * 显示模板
    * @param string $tpl,模板名
    * */
   public function display($tpl)
   {
       $view = Stourweb_View::factory($tpl);

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