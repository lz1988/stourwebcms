<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Config extends Stourweb_Controller{

   private  $parentkey = null;
   private  $itemid = null;
   public function before()
   {
       parent::before();
       $action = $this->request->action();
       if($action == 'base')//首页配置
       {
           Common::getUserRight('index','smodify');
       }
       if($action == 'mainnav')//主导航
       {
           Common::getUserRight('nav','slook');
       }
       if($action == 'addnav')//主导航
       {
           Common::getUserRight('nav','sadd');
       }
       if($action == 'ajax_addnavsave')//主导航
       {
           Common::getUserRight('nav','smodify');
       }
       if($action == 'ajax_delnav')//主导航
       {
           Common::getUserRight('nav','sdelete');
       }
       if($action == 'footer')
       {
           Common::getUserRight('nav','smodify');
       }
       if($action == 'logo')
       {
           Common::getUserRight('logo','smodify');
       }
       if($action == 'nopic')
       {
           Common::getUserRight('nophoto','smodify');
       }
       if($action == 'wx')
       {
           Common::getUserRight('weibo','smodify');
       }
       if($action == 'payment')
       {
           Common::getUserRight('payment','smodify');
       }
       if($action == 'payment')
       {
           Common::getUserRight('payment','smodify');
       }
       if($action == 'ordermail')
       {
           Common::getUserRight('ordermail','smodify');
       }
       if($action == 'thirdpart')
       {
           Common::getUserRight('thirdpart','smodify');
       }
       if($action == 'watermark')
       {
           Common::getUserRight('water','smodify');
       }
       if($action == 'tongji')
       {
           Common::getUserRight('tongji','smodify');
       }
       if($action == 'robots')
       {
           Common::getUserRight('robots','smodify');
       }
       if($action == 'gonggao')
       {
           Common::getUserRight('gonggao','smodify');
       }
       if($action == 'syspara')
       {
           Common::getUserRight('sys','smodify');
       }
       if($action == 'payset')
       {
           Common::getUserRight('pay','smodify');
       }
       if($action == 'ucenter')
       {
           Common::getUserRight('ucenter','smodify');
       }
       if($action == 'webico')
       {
           Common::getUserRight('webico','smodify');
       }
       if($action == 'mailport')
       {
           Common::getUserRight('mailport','smodify');
       }




       $this->assign('parentkey',$this->params['parentkey']);
       $this->assign('itemid',$this->params['itemid']);
       $this->parentkey = $this->params['parentkey'];
       $this->itemid = $this->params['itemid'];
       $weblist = Common::getWebList();
       $this->assign('weblist',$weblist);
       $this->assign('helpico',Common::getIco('help'));



   }

    /*
     * 设置中心-首页配置
     * */


    public function action_base()
    {
        $webid = $this->params['webid'] ? $this->params['webid'] : 0;//当前webid
        $this->assign('url',URL::site('config/base/parentkey/'.$this->parentkey.'/itemid/'.$this->itemid));
        $this->display('stourtravel/config/config_index');
    }

    /*
     * 设置中心-主导航
     * */
    public function action_mainnav()
    {
        $this->display('stourtravel/config/mainnav');
    }



    /*
    * 设置中心-主导航添加
    * */
    public function action_addnav()
    {
        $this->assign('webid',$this->params['webid']);
        $this->display('stourtravel/config/mainnav_add');
    }



    /*
     * 设置中心-主导航添加保存(ajax)
     *
     * */
    public function action_ajax_addnavsave()
    {

        $model = new Model_Nav();
        $model->shortname = Arr::get($_POST,'shortname');
        $model->linktitle = Arr::get($_POST,'linktitle');
        $model->url = Arr::get($_POST,'linkurl');
        $model->linktype = 0;
        $model->webid = Arr::get($_POST,'webid');;
        /*$model->set('seotitle',  Arr::get($_POST,'seotitle'));
        $model->set('keyword',Arr::get($_POST,'keyword'));
        $model->set('description',Arr::get($_POST,'description'));
        $model->set('tagword' , Arr::get($_POST,'tagword'));
        $model->set('jieshao' , Arr::get($_POST,'jieshao'));*/

        $model->create();
        $out = array();
        if($model->saved())
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
     * 设置中心--获取全部配置(ajax)
     * */
    public function action_ajax_getconfig()
    {
        $webid = Arr::get($_POST,'webid');
        $model =  new Model_Sysconfig();
        $arr = $model->getConfig($webid);

        echo json_encode($arr);
    }

    /*
     * 设置中心--保存配置(ajax)
     * */
    public function action_ajax_saveconfig()
    {
        $model =  new Model_Sysconfig();

        $flag = $model->saveConfig($_POST);

        echo json_encode(array('status'=>$flag));

    }

    /*
     * 设置中心--主导航获取(ajax)
     * */
    public function action_ajax_getnav()
    {

        $webid = Arr::get($_GET,'webid');
        $model =  new Model_Nav();
        $arr = $model->getNav($webid);

        $out = array();
        foreach($arr as $row)
        {
            $finishseo = $row['isfinishseo'] ? '已完成' : '<span style="color:red">未完成</span>';

            $openstatus = $row['isopen'] ? Common::getIco('show') : Common::getIco('hide');
            $sel1 = empty($row['kind']) ? "selected='seleted'" : '';
            $sel2 = $row['kind'] == 1 ? "selected='seleted'" : '';
            $sel3 = $row['kind'] == 2 ? "selected='seleted'" : '';
            $issystem = $row['linktype'];
            $editcls = $issystem ? "readonly='true'" : '';
            if($row['webid']==0||$row['typeid']==10)
            {
                $seotd='<td align="center" onclick="seoShow('.$row['id'].',\''.$row['shortname'].'\','.$issystem.')">'.$finishseo.'</td>';
            }
            else
            {
                $seotd = '<td align="center"></td>';
            }

            $tr = '<tr>
                        <td height="40px" align="center"><input type="text"  name="displayorder[]" class="tb-text text_60 al" value="'.$row['displayorder'].'" /></td>
                        <td><input type="text"  name="shortname[]" class="tb-text pl-5" style="width:90%" value='.$row['shortname'].' /></td>
                        <td><input type="text"  name="linktitle[]" class="tb-text pl-5" style="width:90%" value='.$row['linktitle'].' /></td>
                        <td><input type="text"  name="url[]" class="tb-text pl-5" style="width:90%" '.$editcls.' value='.$row['url'].' /></td>
                        <td align="center">
                            <select name="kind[]">
                                <option value="0" '.$sel1.'>无</option>
                                <option value="1" '.$sel2.'>最新</option>
                                <option value="2" '.$sel3.'>最热</option>
                            </select>
                        </td>'.
                           $seotd
                        .'<td align="center" onclick="changeShow(this)">'.$openstatus.'<input type="hidden" name="isopen[]" value='.$row['isopen'].'></td>
                        <td align="center"><a href="javascript:;" class="row-del-btn" onclick="navDel(this,'.$row['id'].',\''.$issystem.'\')" title="删除"></a><input type="hidden" name="id[]" value='.$row['id'].'></td>
                 </tr>';
            array_push($out,$tr);
        }
        $unkeyword = $model->getUnsetCount('keyword',$webid);//未设置关键词数量
        $undescription = $model->getUnsetCount('description',$webid);//未设置描述数量
        $unjieshao = $model->getUnsetCount('jieshao',$webid);//未设置介绍
        $info = array('unkeyword'=>$unkeyword,'undescription'=>$undescription,'unjieshao'=>$unjieshao);

        echo json_encode(array('trlist'=>$out,'infolist'=>$info));


    }

    /*
    * 设置中心--主导航保存(ajax)
    * */
    public function action_ajax_savenav()
    {
        $model = new Model_Nav();
        $model->saveNav($_POST);
        echo json_encode(array('status'=>true));
    }

    /*
     * 设置中心-主导航优化设置弹出框
     * */
    public function action_seoinfo()
    {
        $id = $this->params['id'];
        $seoinfo = ORM::factory('nav',$id)->as_array();
        $this->assign('seoinfo',$seoinfo);
        $this->display('stourtravel/config/mainnav_seo');

    }
    /*
   * 设置中心--主导航优化信息保存(ajax)
   * */
    public function action_ajax_saveseo()
    {

        $seotitle = Arr::get($_POST,'seotitle');
        $keyword = Arr::get($_POST,'keyword');
        $description = Arr::get($_POST,'description');
        $tagword = Arr::get($_POST,'tagword');
        $jieshao = Arr::get($_POST,'jieshao');
        if(!empty($seotitle) && !empty($keyword) && !empty($description)
           && !empty($tagword) && !empty($jieshao)
        )
        {
            $isfinish = 1;
        }
        else
        {
            $isfinish = 0;
        }


        $navid = Arr::get($_POST,'navid');
        $model = new Model_Nav($navid);
        $model->seotitle = $seotitle;
        $model->keyword = $keyword;
        $model->description = $description;
        $model->tagword = $tagword;
        $model->jieshao = $jieshao;
        $model->isfinishseo = $isfinish;

        /*$model->set('seotitle',  Arr::get($_POST,'seotitle'));
        $model->set('keyword',Arr::get($_POST,'keyword'));
        $model->set('description',Arr::get($_POST,'description'));
        $model->set('tagword' , Arr::get($_POST,'tagword'));
        $model->set('jieshao' , Arr::get($_POST,'jieshao'));*/

        $model->update();

        echo json_encode(array('status'=>true));



    }
    /*
     * 设置中心-主导航删除(ajax)
     * */
    public function action_ajax_delnav()
    {
        $navid = Arr::get($_GET,'id');
        $model = ORM::factory('nav',$navid);
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
    * 设置中心-网页底部
    * */

    public function action_footer()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('configinfo',$configinfo);
        $this->display('stourtravel/config/footer');
    }

    /*
      * 设置中心-logo设置
      *
      * */
    public function action_logo()
    {
        $this->display('stourtravel/config/logo');
    }
    /*
     * 设置中心-webico设置
     *
     * */
    public function action_webico()
    {
        $this->display('stourtravel/config/webico');
    }

    /*
     * 设置中心-邮箱设置
     * */
    public function action_mailport()
    {
        $this->display('stourtravel/config/mailport');
    }


    /*
     * 获取logo设置显示栏目
     * */
    public function action_ajax_getlogodisplay()
    {
        $webid = Arr::get($_POST,'webid');
        $logodisplay = Arr::get($_POST,'logodisplay');

        $ids=explode(',',$logodisplay);
        $checkstatus = in_array('0',$ids) ? "checked='checked'" : '';

        $out='<input type="checkbox" name="display" value="0" '.$checkstatus.' class="checkbox fl mt-8"><span class="fl mt-2 ml-5 mr-20">首页</span>';
        $arr =   ORM::factory('nav')->select('shortname','typeid')
                ->where("typeid in (1,2,3,4,5,6,8,9,10,13)",'','')
                ->and_where('webid','=',$webid)
                ->get_all();

        foreach($arr as $row)
        {

            $checkstatus=in_array($row['typeid'],$ids) ?  "checked='checked'" : '';
            $out.='<input type="checkbox" name="display" value="'.$row['typeid'].'"'.$checkstatus.'class="checkbox fl mt-8" >';
            $out.='<span class="fl mt-2 ml-5 mr-20">'.$row['shortname'].'</span>';

        }
        echo $out;



    }



   /*
    * 无图设置
    * */
    public function action_nopic()
    {
        $this->display('stourtravel/config/nopic');
    }
    /*
     * 微博微信设置
     * */
    public function action_wx()
    {
        $this->display('stourtravel/config/wxwb');
    }
    /*
     * 签约付款
     * */
    public function action_payment()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('configinfo',$configinfo);
        $this->display('stourtravel/config/payment');

    }
    /*
    * 第三方登陆
    * */
    public function action_thirdpart()
    {

        $this->display('stourtravel/config/thirdpart');

    }
    /*
     * 水印设置
     * */
    public function action_watermark()
    {
        $config = Common::getConfig('watermark');
        $markinfo = $config->get('watermark');

        $markinfo['markimgurl'] = $GLOBALS['cfg_basehost'].'/data/mark/'.$markinfo['photo_markimg'];
        $this->assign('markinfo',$markinfo);
        $this->display('stourtravel/config/watermark');
    }
    //保存水印配置
    public function action_ajax_savewatermark()
    {
        $markinfo = array();
        $markurlArr = explode('/',Arr::get($_POST,'photo_markimg'));
        $markimg = $markurlArr[count($markurlArr)-1];
        $markinfo["watermark"] = array(
            'photo_markon'       => Arr::get($_POST,'photo_markon'),
            'photo_marktype'     => Arr::get($_POST,'photo_marktype'),
            'photo_waterpos'     => Arr::get($_POST,'photo_waterpos'),
            'photo_marktext'     => Arr::get($_POST,'photo_marktext'),
            'photo_fontsize'     => Arr::get($_POST,'photo_fontsize'),
            'photo_diaphaneity'  => Arr::get($_POST,'photo_diaphaneity'),
            'photo_fontcolor'    => Arr::get($_POST,'photo_fontcolor'),
            'photo_markimg'      => $markimg
        );
        $water = var_export($markinfo,true);
        $waterconfigfile = Kohana::find_file('config','watermark');

        $fp = fopen($waterconfigfile[0],'wb');
        flock($fp,3);
        fwrite($fp,"<"."?php\r\n");
        fwrite($fp,"return ");
        fwrite($fp,$water);
        fwrite($fp,"?".">");
        fclose($fp);
        echo json_encode(array('status'=>true));

    }

    /*
     * 统计代码
     * */
    public function action_tongji()
    {
        $this->display('stourtravel/config/tongjicode');
    }
    /*
    * robots设置
    * */
    public function action_robots()
    {
        $this->display('stourtravel/config/robots');
    }
   //读取robots
    public function action_ajax_getrobots()
    {
        //$file = BASEPATH.'\robots.txt';
		$file = realpath(BASEPATH.'/robots.txt');
        //echo $file;
        $filecontent = file_get_contents($file);
        $out = array('robots'=>$filecontent);
        echo json_encode($out);
    }
    public function action_ajax_saverobots()
    {
       // $file = BASEPATH.'\robots.txt';
	    $file = realpath(BASEPATH.'/robots.txt');
        $fp = fopen($file,"wb");
        flock($fp,3);
        //@flock($this->open,3);
        fwrite($fp,Arr::get($_POST,'robots'));
        fclose($fp);
        echo json_encode(array('status'=>true));

    }
    /*
     * 伪静态配置
     * */
    public function action_htaccess()
    {
        $this->display('stourtravel/config/htaccess');
    }
    //读取robots
    public function action_ajax_gethtaccess()
    {
       // $file = BASEPATH.'\.htaccess';
	    $file = realpath(BASEPATH.'/.htaccess');
        $filecontent = file_get_contents($file);
        $out = array('rules'=>$filecontent);
        echo json_encode($out);
    }
    public function action_ajax_savehtaccess()
    {
       // $file = BASEPATH.'\.htaccess';
	    $file = realpath(BASEPATH.'/.htaccess');
        $fp = fopen($file,"wb");
        flock($fp,3);
        fwrite($fp,Arr::get($_POST,'htaccess'));
        fclose($fp);
        echo json_encode(array('status'=>true));

    }
    /*
     * 公告设置
     * */
    public function action_gonggao()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('configinfo',$configinfo);
        $this->display('stourtravel/config/gonggao');
    }

    /*
    * 系统参数设置
    * */
    public function action_syspara()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $templetlist = ORM::factory('templet')->get_all();
        $this->assign('config',$configinfo);
        $this->assign('templetlist',$templetlist);

        $this->display('stourtravel/config/syspara');
    }

    /*
     * 支付接口设置页面
     * */
    public function action_payset()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);

        $this->assign('config',$configinfo);
        $this->display('stourtravel/config/payset');
    }

    /*
     * ucenter配置
     * */
    public function action_ucenter()
    {
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('config',$configinfo);
        $this->display('stourtravel/config/ucenter');

    }

    //保存ucenter配置
    public function action_ajax_save_ucenter()
    {

        $ucenterfile = BASEPATH.'/data/ucenter.php';

        $config=Arr::get($_POST,'cfg_uc_key').'|';
        $config.=Arr::get($_POST,'cfg_uc_appid').'|';
        $config.=Arr::get($_POST,'cfg_uc_host').'|';
        $config.=Arr::get($_POST,'cfg_uc_db').'|';
        $config.=Arr::get($_POST,'cfg_uc_user').'|';
        $config.=Arr::get($_POST,'cfg_uc_pwd').'|';
        $config.=Arr::get($_POST,'cfg_uc_charset').'|';
        $config.=Arr::get($_POST,'cfg_uc_dbprefix').'|';
        $config.=Arr::get($_POST,'cfg_uc_charset').'|';
        $config.=Arr::get($_POST,'cfg_uc_url').'|';
        $config.=Arr::get($_POST,'cfg_uc_ip').'|';
        $config.=Arr::get($_POST,'cfg_uc_open').'|';

        self::api_write_config($config,$ucenterfile);



    }
    private function api_write_config($config, $file)
    {
        $success = false;

        list($appauthkey, $appid, $ucdbhost, $ucdbname, $ucdbuser, $ucdbpw, $ucdbcharset, $uctablepre, $uccharset, $ucapi, $ucip,$ucopen) = explode('|', $config);



        $content = "<?php ";
        $content = self::api_insert_config($content, "/define\('UC_CONNECT',\s*'.*?'\);/i", "define('UC_CONNECT', 'mysql');");
        $content = self::api_insert_config($content, "/define\('UC_DBHOST',\s*'.*?'\);/i", "define('UC_DBHOST', '$ucdbhost');");
        $content = self::api_insert_config($content, "/define\('UC_DBUSER',\s*'.*?'\);/i", "define('UC_DBUSER', '$ucdbuser');");
        $content = self::api_insert_config($content, "/define\('UC_DBPW',\s*'.*?'\);/i", "define('UC_DBPW', '$ucdbpw');");
        $content = self::api_insert_config($content, "/define\('UC_DBNAME',\s*'.*?'\);/i", "define('UC_DBNAME', '$ucdbname');");
        $content = self::api_insert_config($content, "/define\('UC_DBCHARSET',\s*'.*?'\);/i", "define('UC_DBCHARSET', '$ucdbcharset');");
        $content = self::api_insert_config($content, "/define\('UC_DBTABLEPRE',\s*'.*?'\);/i", "define('UC_DBTABLEPRE', '`$ucdbname`.$uctablepre');");
        $content = self::api_insert_config($content, "/define\('UC_DBCONNECT',\s*'.*?'\);/i", "define('UC_DBCONNECT', '0');");
        $content = self::api_insert_config($content, "/define\('UC_KEY',\s*'.*?'\);/i", "define('UC_KEY', '$appauthkey');");
        $content = self::api_insert_config($content, "/define\('UC_API',\s*'.*?'\);/i", "define('UC_API', '$ucapi');");
        $content = self::api_insert_config($content, "/define\('UC_CHARSET',\s*'.*?'\);/i", "define('UC_CHARSET', '$uccharset');");
        $content = self::api_insert_config($content, "/define\('UC_IP',\s*'.*?'\);/i", "define('UC_IP', '$ucip');");
        $content = self::api_insert_config($content, "/define\('UC_APPID',\s*'?.*?'?\);/i", "define('UC_APPID', '$appid');");
        $content = self::api_insert_config($content, "/define\('UC_PPP',\s*'?.*?'?\);/i", "define('UC_PPP', '20');");
        $content = self::api_insert_config($content, "/define\('UC_OPEN',\s*'?.*?'?\);/i", "define('UC_OPEN', '$ucopen');");
        $content .= "\r\n".'?>';

        if(file_put_contents($file, $content))
        {
            $success = true;
        }

        return $success;
    }

    private function api_insert_config($s, $find, $replace)
    {
        if(preg_match($find, $s))
        {
            $s = preg_replace($find, $replace, $s);
        }else{
            // 插入到最后一行
            $s .= "\r\n".$replace;
        }

        return $s;
    }

    //测试邮件发送功能
    public function action_ajax_sendmail()
    {
      //include_once(PUBLICPATH.'/vendor/email.class.php');
      
      $maillto = Arr::get($_POST,'email');
      $title =Arr::get($_POST,'title');
      $content = Arr::get($_POST,'content');

      $configinfo = ORM::factory('sysconfig')->getConfig(0);


      if($configinfo['cfg_mail_smtp']==''){
      $configinfo['cfg_mail_smtp'] = "smtp.163.com";
      }
      if($configinfo['cfg_mail_user']==''){
        $configinfo['cfg_mail_user'] = "Stourweb@163.com";
        $configinfo['cfg_mail_pass'] = "kelly12345";
      }
      if($configinfo['cfg_mail_port']==''){
        $configinfo['cfg_mail_port'] = 25;
      }

      
      $smtpserver = $configinfo['cfg_mail_smtp'];//SMTP服务器
      $smtpserverport =$configinfo['cfg_mail_port'];//SMTP服务器端口
      $smtpemailto =$maillto;//发送给谁
      $smtpuser = $configinfo['cfg_mail_user'];//SMTP服务器的用户帐号
      $smtppass = $configinfo['cfg_mail_pass'];//SMTP服务器的用户密码
      //$mailsubject = iconv('UTF-8','GB2312',$title);//邮件主题
      //$mailbody = iconv('UTF-8','GB2312',$content);//邮件内容
      $mailtype = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件
      ##########################################
      //$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
      
      //$smtp->debug = false;//是否显示发送的调试信息
      //$status=$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
      
      
      
      if($smtpserverport==25){
        include_once(PUBLICPATH.'/vendor/email.class.php');
        $mailsubject = iconv('UTF-8','GB2312//IGNORE',$title);//邮件主题
        $mailbody = iconv('UTF-8','GB2312//IGNORE',$content);//邮件内容
        $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
        $smtp->debug = false;//是否显示发送的调试信息
        $status=$smtp->sendmail($smtpemailto, $smtpuser, $mailsubject, $mailbody, $mailtype);
      }else{
        include_once(PUBLICPATH.'/vendor/mysendmail.class.php');
        $mail = new MySendMail();
        $mail->setServer($smtpserver, $smtpuser, $smtppass, 465, true); //设置smtp服务器，到服务器的SSL连接
        $mail->setFrom($smtpuser); //设置发件人
        $mail->setReceiver($smtpemailto); //设置收件人，多个收件人，调用多次
        $mail->setMail($title, $content); //设置邮件主题、内容
        $status = $mail->sendMail(); //发送
      }

      echo json_encode(array('status'=>$status));
    }

     /*
     * 设置中心-订单提醒邮箱设置
     * */
    public function action_ordermail()
    {
        $this->display('stourtravel/config/ordermail');
    }

    public function action_authright()
    {
        include(Kohana::find_file('data','license'));
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('configinfo',$configinfo);
        $this->assign('serailnum',$SerialNumber);
        $this->display('stourtravel/config/authright');
    }

}