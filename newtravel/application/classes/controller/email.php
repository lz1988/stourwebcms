<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Email extends Stourweb_Controller{
    /*
     * 短信平台
     * */
    public function before()
    {
        parent::before();

        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);
        Common::getUserRight('email','smodify');
        $configinfo = ORM::factory('sysconfig')->getConfig(0);
        $this->assign('configinfo',$configinfo);

    }

    //短信平台首页
    public function action_index()
    {
        $arr = ORM::factory('email_msg')->get_all();
        foreach($arr as $row)
        {
            $this->assign($row['msgtype'],$row['msg']);
            $this->assign($row['msgtype'].'_open',$row['isopen']);
        }
        $this->display('stourtravel/email/index');
    }
    public function action_dialog_test()
    {
        $this->display('stourtravel/email/dialog_test');
    }
    public function action_ajax_sendmail()
    {
        //include_once(PUBLICPATH.'/vendor/email.class.php');

        $maillto = Arr::get($_POST, 'email');
        $title = Arr::get($_POST, 'title');
        $content = Arr::get($_POST, 'content');

        $configinfo = ORM::factory('sysconfig')->getConfig(0);

        if ($configinfo['cfg_mail_smtp'] == '') {
            $configinfo['cfg_mail_smtp'] = "smtp.163.com";
        }
        if ($configinfo['cfg_mail_user'] == '') {
            $configinfo['cfg_mail_user'] = "Stourweb@163.com";
            $configinfo['cfg_mail_pass'] = "kelly12345";
        }
        if ($configinfo['cfg_mail_port'] == '') {
            $configinfo['cfg_mail_port'] = 25;
        }


        $smtpserver = $configinfo['cfg_mail_smtp'];//SMTP服务器
        $smtpserverport = $configinfo['cfg_mail_port'];//SMTP服务器端口
        $smtpemailto = $maillto;//发送给谁
        $smtpuser = $configinfo['cfg_mail_user'];//SMTP服务器的用户帐号
        $smtppass = $configinfo['cfg_mail_pass'];//SMTP服务器的用户密码
        //$mailsubject = iconv('UTF-8','GB2312',$title);//邮件主题
        //$mailbody = iconv('UTF-8','GB2312',$content);//邮件内容
        $mailtype = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件
        ##########################################
        //$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.

        //$smtp->debug = false;//是否显示发送的调试信息
        //$status=$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);


        if ($smtpserverport == 25) {
            include_once(PUBLICPATH . '/vendor/email.class.php');
            $mailsubject = iconv('UTF-8', 'GB2312//IGNORE', $title);//邮件主题
            $mailbody = iconv('UTF-8', 'GB2312//IGNORE', $content);//邮件内容
            $smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp->debug = false;//是否显示发送的调试信息
            $status = $smtp->sendmail($smtpemailto, $smtpuser, $mailsubject, $mailbody, $mailtype);
        } else {
            include_once(PUBLICPATH . '/vendor/mysendmail.class.php');
            $mail = new MySendMail();
            $mail->setServer($smtpserver, $smtpuser, $smtppass, 465, true); //设置smtp服务器，到服务器的SSL连接
            $mail->setFrom($smtpuser); //设置发件人
            $mail->setReceiver($smtpemailto); //设置收件人，多个收件人，调用多次
            $mail->setMail($title, $content); //设置邮件主题、内容
            $status = $mail->sendMail(); //发送
        }

        echo json_encode(array('status' => $status));
    }

    public function action_savemsg()
    {
        $msgtype = Arr::get($_POST,'msgtype');
        if($msgtype!='reg')
        {
            for($i=1;$i<=4;$i++)
            {
                $_open = 'isopen'.$i;
                $_msg = 'msg'.$i;
                $open = Arr::get($_POST,$_open);
                $msg = Arr::get($_POST,$_msg);
              //  $sql = "update sline_sms_msg set isopen='{$open}',msg='$msg' where msgtype='$msgtype".$i."'";
               // DB::query(Database::UPDATE,$sql)->execute();
                $model=ORM::factory('email_msg')->where('msgtype','=',$msgtype.$i)->find();
                $model->msgtype=$msgtype.$i;
                $model->isopen=$open;
                $model->msg=$msg;
                $model->save();
            }
        }
        else
        {
            $reg_open = Arr::get($_POST,'reg_open');
            $reg_msgcode_open = Arr::get($_POST,'reg_msgcode_open');
            $reg_content = Arr::get($_POST,'reg_content');
            $reg_msgcode_content = Arr::get($_POST,'reg_msgcode_content');
            $reg_findpwd_open = Arr::get($_POST,'reg_findpwd_open');
            $reg_findpwd_content = Arr::get($_POST,'reg_findpwd_content');


            $model=ORM::factory('email_msg')->where('msgtype','=','reg')->find();
            $model->isopen=$reg_open;
            $model->msgtype='reg';
            $model->msg=$reg_content;
            $model->save();

            $model2=ORM::factory('email_msg')->where('msgtype','=','reg_msgcode')->find();
            $model2->isopen=$reg_msgcode_open;
            $model2->msgtype='reg_msgcode';
            $model2->msg=$reg_msgcode_content;
            $model2->save();

            $model3=ORM::factory('email_msg')->where('msgtype','=','reg_findpwd')->find();
            $model3->msgtype='reg_findpwd';
            $model3->isopen=$reg_findpwd_open;
            $model3->msg=$reg_findpwd_content;
            $model3->save();

        }
        echo json_encode(array('status'=>true));
    }

    //购买短信
}