<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/func.php");//载入功能函数


//结伴第一步,返回主目的地信息

if($action=='step1_getdestlist')
{

    $sql = "select id,kindname from sline_destinations where pid=0 and isopen=1";
    $arr = $dsql->getAll($sql);
    $out = array();
    if(isset($arr))
    {
        $out['status'] = 1;
        $out['list'] = $arr;
    }
/*    $out = '<li class="im-item me" id="step1">';
    $out.= '<div class="fl"><img src="/templets/smore/images/dailogkefu.png" width="54" height="54" /></div>';
    $out.= '<div class="im-content">';
    $out.= '<div class="arrow-ico-l"></div>';
    $out.= '<div class="im-title">选择要去这个区域的目的地</div>';
    $out.= '<div class="mdd-box-con">';
    foreach($arr as $row)
    {
       $class = $row['id'] == $main_destid ? 'class="on"' : '';
       $out.="<span {$class}>{$row['kindname']}</span>";
    }
    $out.='</div>';
    $out.=' <div class="other-ds">';
    $out.='   <span>没有想去的？直接说您想去哪里</span>';
    $out.='                <input type="text" class="" value="'.$user_destname.'" />';
    $out.='                <a href="javascript:;" class="btn_confirm" value="'.$user_destname.'">确定</a>';
    $out.='            </div>';
    $out.='        </div>';
    $out.='    </li>';*/
    print_r(json_encode($out));
}
//返回子目的地
if($action=='step2_getsubdestlist')
{

    $sql = "select id,kindname from sline_destinations where pid='$pid' and isopen=1";
    $arr = $dsql->getAll($sql);
    $out = array();
    if(isset($arr))
    {
        $out['status'] = 1;
        $out['list'] = $arr;
    }
    print_r(json_encode($out));
}

//获取线路产品列表
if($action=='step5_getproductlist')
{
    $arr = array();
    if(!empty($destid))
    {

        $where=" where find_in_set($destid,kindlist) ";
        if(!empty($uday))$where.=" and lineday='$uday'";
        $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc';
        $sql = "select a.id,a.aid,a.webid,a.title,a.litpic as litpic,sellpoint from sline_line a left join #@__kindorderlist c on (c.classid=$destid and a.id=c.aid  and c.typeid=1) $where $orderby  limit 0,3";
        $arr = $dsql->getAll($sql);

    }
    else if(!empty($userplace))
    {
        $where=" where title like '%$userplace%'";
        if(!empty($uday))$where.=" and lineday='$uday'";
        $orderby="order by case when c.displayorder is null then 9999 end,c.displayorder asc,a.modtime desc,a.addtime desc";
        $sql = "select a.id,a.aid,a.webid,a.title,a.litpic as litpic,sellpoint from sline_line a left join #@__allorderlist c on (a.id=c.aid  and c.typeid=1) $where $orderby  limit 0,3";
        $arr = $dsql->getAll($sql);
    }



    if(!empty($arr))
    {
        foreach($arr as $key => $row)
        {
            $webroot=GetWebURLByWebid($row['webid']);
            $price = getLineRealPrice($row['aid'],$row['webid']);
            $price = $price ? $price : '电询';
            $arr[$key]['url'] =$webroot.'/lines/show_'.$row['aid'].'.html';
            $arr[$key]['title'] = $row['title'];
            $arr[$key]['price'] = $price;
            $arr[$key]['desc'] = $row['sellpoint'];


        }
        $out['status'] = 1;
        $out['list'] = $arr;
    }
    else
    {
        $out['status'] = 0;
    }
    print_r(json_encode($out));
}
//获取产品主题
if($action=='step6_getthemelist')
{

    $sql = "select id,attrname from sline_jieban_attr where pid!='0' and isopen=1";
    $arr = $dsql->getAll($sql);
    $out = array();
    if(isset($arr))
    {
        $out['status'] = 1;
        $out['list'] = $arr;
    }
    print_r(json_encode($out));
}
//获取短信状态
if($action == 'step8_getmsgstatus')
{
    @session_start();
    $token = md5(time());
    $_SESSION['csrf_token_jb'] = $token;
    if(!isset($_SESSION['last_access2'])||(time()-$_SESSION['last_access2'])>120)
    {
        $_SESSION['last_access2'] = time();

    }
    $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_msgcode');
    if($msgInfo['isopen']==1)
    {
        $msgopen = 1;

    }
    else
    {
        $msgopen = 0;
    }
    $islogin = 0;
    //判断用户是不是登陆状态
    if($User->IsLogin())$islogin = 1;

    echo json_encode(array('status'=>1,'msgopen'=>$msgopen,'islogin'=>$islogin,'token'=>$token));
}


//发送短信验证码
if($action == 'sendmsgcode')
{
    @session_start();
    $fromurl = $_SERVER['HTTP_REFERER'];
    $acturl = $GLOBALS['cfg_basehost'].'/jieban/xuqiu.php';
    //token值验证
    $token = $_SESSION['csrf_token_jb'];
    if(empty($token))exit;
    else
    {
        if($token!=$k)
        {
            exit();
        }
    }
    $ip = GetIP();
    if($fromurl!=$acturl)
    {
        exit;
    }
    else
    {
        $ip_list = $_SESSION['jipnum'];
        if(isset($ip_list[$ip]) && intval($ip_list[$ip])<=10)
        {
            $num = intval($ip_list[$ip])+1;
            $_SESSION['jipnum'][$ip] = $num;
        }
        else if(!isset($ip_list[$ip]))
        {
            $_SESSION['jipnum'][$ip] = 1;
        }
        else
        {
            exit();
        }
    }

    if(!empty($mobile))
    {
        $code = ULine::getRandCode(6);//验证码
        $content = "当前手机短信验证码为:{$code},请输入验证";
       /* $msgInfo = Helper_Archive::getDefineMsgInfo2('reg_msgcode');
        $content = $msgInfo['msg'];
        $content = str_replace('{#CODE#}',$code,$content);
        $content = str_replace('{#WEBNAME#}',$GLOBALS['cfg_webname'],$content);
        $content = str_replace('{#PHONE#}',$GLOBALS['cfg_phone'],$content);*/
        $flag = Helper_Archive::sendMsg($mobile,'',$content);

        if($flag->Success)//发送成功
        {
            $status = 'ok';
        }
        else
        {
            $status = 'send error';
        }

    }

    echo $status;
}
//发送短信验证码
if($action == 'sendmsgcode2')
{
        @session_start();
        //token值验证
        $token = $_SESSION['csrf_token_jb2'];
        if(empty($token))exit;
        else
        {
            if($token!=$k)
            {
                exit();
            }
        }

        $ip = GetIP();

        $ip_list = $_SESSION['jipnum'];
        if(isset($ip_list[$ip]) && intval($ip_list[$ip])>3)
        {
            exit('ip超限');
        }

    if(!empty($mobile))
    {
        $code = ULine::getRandCode(6);//验证码
        $content = "当前手机短信验证码为:{$code},请输入验证";

        $flag = Helper_Archive::sendMsg($mobile,'',$content);

        if($flag->Success)//发送成功
        {
            $status = 'ok';
            if(!isset($ip_list[$ip]))
            {
                $_SESSION['jipnum'][$ip] = 1;
            }
            else
            {
                $num = intval($ip_list[$ip])+1;
                $_SESSION['jipnum'][$ip] = $num;
            }


        }
        else{
            $status = 'false';
        }


    }

    echo $status;
}

//检测手机短信验证码
if($action == 'checkmsgcode')
{
    @session_start();
    $status = 0;
    $msgcode = $_SESSION['msgcode'];
    if($code==$msgcode)$status=1;
    echo json_encode(array('status'=>$status));
}
//检测一般验证码
if($action == 'checktxtcode')
{
    $status = 0;
    $txtcode = GetCkVdValue();
    if($code==$txtcode)$status=1;
    echo json_encode(array('status'=>$status));
}
//结伴信息保存
if($action == 'savejieban')
{
    @session_start();
    $status=1;
    if(!isset($_COOKIE['u_mobile']) && !isset($_COOKIE['u_nickname']))
    {
        exit;
    }
    if($User->IsLogin())
    {
        $memberid = $User->uid;
    }
    else
    {
        $memberid = Helper_Archive::autoReg($_COOKIE['u_mobile']);
    }

    $kindlist = $_COOKIE['u_destmain_id'].','.$_COOKIE['u_destchild_id'];
    Helper_Archive::loadModule('common');
    $jieban = new CommonModule('#@__jieban');
    $arr = array(
        'kindlist'=>$kindlist,
        'dest_mainid'=>$_COOKIE['u_destmain_id'],
        'dest_childid'=>$_COOKIE['u_destchild_id'],
        'day'=>$_COOKIE['u_day'],
        'attrid'=>$_COOKIE['u_themeid'],
        'childnum'=>$_COOKIE['u_childnum'],
        'adultnum'=>$_COOKIE['u_adultnum'],
        'vartime'=>$_COOKIE['u_vartime'],
        'lineid'=>$_COOKIE['u_lineid'],
        'memo'=>$_SESSION['u_memo'],
        'startdate'=>$_COOKIE['u_startdate'],
        'memberid'=>$memberid,
        'userdest'=>$_COOKIE['u_userplace'],
        'title'=>$_COOKIE['u_title'],
        'addtime'=>time()
    );
    $id = $jieban->add($arr);
    if($id)$status=1;
    echo json_encode(array('status'=>$status));

    exit;
}

//加入结伴
if($action == 'addjoin')
{
    $status = 0 ;
    //手机号码验证
    $preg = '/13[1-9]{1}\d{8}|15[1-9]\d{8}|1\d{10}/';
    if(!preg_match($preg,$mobile))
    {
        exit('wrong mobile');
    }
    $memberid = Helper_Archive::autoReg($mobile);
    $memberinfo = Helper_Archive::getMemberInfo($memberid);

    Helper_Archive::loadModule('common');
    $join = new CommonModule('#@__jieban_join');
    $arr = array(
        'jiebanid'=>$jiebanid,
        'linkman'=>$memberinfo['nickname'],
        'mobile'=>$mobile,
        'memberid'=>$memberid,
        'adultnum'=>$adultnum,
        'childnum'=>$childnum,
        'addtime'=>time()
    );
    $id = $join->add($arr);
    if($id)$status=1;
    echo json_encode(array('status'=>$status));


}

//保存session信息
if($action == 'savesession')
{
    @session_start();
    $_SESSION[$key] = $value;
}
if($action == 'getsession')
{
    @session_start();
    return $_SESSION[$key];
}

class ULine {

    public static function getMinTprice($lineid)
    {
        global $dsql;
       // $sql = "select min(jifentprice) as price from sline_line_suit where lineid='$lineid'";
	   $sql = "select min(b.adultprice) as price,a.id,a.lineid,b.suitid,b.adultprice from sline_line_suit a LEFT JOIN sline_line_suit_price b on(a.id = b.suitid)  where a.lineid='$lineid'";
        $row = $dsql->GetOne($sql);
        return $row['price'] ? $row['price'] : 0 ;

    }
   public static function getRandCode($num)
   {
        $out='';
        for ($i=1; $i<=$num; $i++)
        {
            $out.=mt_rand(0,9);
        }
        @session_start();
        $_SESSION['msgcode'] = $out; //设置session值
        //$_SESSION['msgcode'] = '123456';

        return $out;

    }

    public static function checkJoinMember($mobile)
    {

    }


}

