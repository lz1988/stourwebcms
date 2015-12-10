<?php
  /* -----
 * @version        $Id: common.inc.php 3 17:11 2015-02-12 netman
 * @package        Stourweb.Libraries
 * @copyright      Copyright (c) 2011 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 --------- */// 


ini_set('display_errors','1' );
error_reporting(E_ERROR |E_CORE_ERROR | E_COMPILE_ERROR | !E_WARNING | E_PARSE | !E_NOTICE);
//error_reporting(E_ALL);
define('SLINEINC', str_replace("\\", '/', dirname(__FILE__) ) );
define('SLINEROOT', str_replace("\\", '/', substr(SLINEINC,0,-8) ) );
define('SLINEDATA', SLINEROOT.'/data');
define('SLINETEMPLATE', SLINEROOT.'/templets');
define('SLINEIISROOT',str_replace("\\", '/', dirname(dirname(dirname(__FILE__))) ));
define('DEBUG_LEVEL', TRUE); //

if (version_compare(PHP_VERSION, '5.3.0', '<'))  
{
    set_magic_quotes_runtime(0);
}


function _RunMagicQuotes(&$svar)
{
   
	if(!get_magic_quotes_gpc())
    {
        if( is_array($svar) )
        {
         
			foreach($svar as $_k => $_v) $svar[$_k] = _RunMagicQuotes($_v);
        }
        else
        {
          
			$svar=addslashes($svar); 

        }
    }
	
    return $svar;
}

if (!defined('SLINEREQUEST')) 
{
 
   

    //检查变量
    function CheckRequest(&$val)
    {
        if (is_array($val))
        {
            foreach ($val as $_k=>$_v)
            {
                CheckRequest($_k);
                CheckRequest($val[$_k]);
            }
        }
        else
        {
            if( strlen($val)>0 && preg_match('#^(cfg_|GLOBALS)#',$val) )
            {
                exit('not allow!');
            }
        }
    }
    CheckRequest($_REQUEST);
    foreach(Array('_GET','_POST') as $_request)
    {
       
		foreach($$_request as $_k => $_v) 
		{	
         
		  ${$_k} = _RunMagicQuotes($_v);
		}
    }
}

//系统相关变量检测
if(!isset($needFilter))
{
    $needFilter = false;
}
$registerGlobals = @ini_get("register_globals");
$isUrlOpen = @ini_get("allow_url_fopen");
$isSafeMode = @ini_get("safe_mode");
if( preg_match('/windows/i', @getenv('OS')) )
{
    $isSafeMode = false;
}

//Session存储路径
$sessSavePath = SLINEDATA."/sessions/";
if(is_writeable($sessSavePath) && is_readable($sessSavePath))
{  
    session_save_path($sessSavePath);
	
}

//系统配置文件
require_once(SLINEDATA."/config.cache.inc.php");

//数据库连接
require_once(SLINEDATA.'/common.inc.php');


if(PHP_VERSION > '5.1')
{
    $time51 = $cfg_cli_time * -1;
    @date_default_timezone_set('Etc/GMT'.$time51);
}
$cfg_isUrlOpen = @ini_get("allow_url_fopen");

//网站host

$cfg_domain_cookie=substr($_SERVER['HTTP_HOST'],strpos($_SERVER['HTTP_HOST'],'.'));
$cfg_basehost='http://'.$_SERVER['HTTP_HOST'];
//根目录
$cfg_basedir = preg_replace('#'.$cfg_cmspath.'\/include$#i', '', SLINEINC);


$cfg_mainsite = '';

//模板路径
$cfg_templets_dir = $cfg_cmspath.'/templets';
$cfg_templeturl = $cfg_mainsite.$cfg_templets_dir;
$cfg_templets_skin = empty($cfg_df_style)? $cfg_mainsite.$cfg_templets_dir."/smore" : $cfg_mainsite.$cfg_templets_dir."/$cfg_df_style";


$cfg_user_templet_dir = '/templets/smore/uploadtemplets';//自定义模板目录.
$cfg_site_user_templet_dir = '';//子站自定义模板目录

//cmsurl
$cfg_cmsurl = $cfg_mainsite.$cfg_cmspath;


$cfg_data_dir = $cfg_cmspath.'/data';
$cfg_dataurl = $cfg_mainsite.$cfg_data_dir;


$cfg_mediasurl = $cfg_medias_dir;



//大图
$cfg_image_dir = '/allimg';

//缩略图
$ddcfg_image_dir = '/litimg';

//广告图
$cfg_ad_dir="/adimg";

//行程
$cfg_doc_dir="/doc";

//子站默认皮肤
$cfg_childsite_style = 'sline';


//开发版本
$cfg_version = '思途CMS3.0';
$cfg_soft_lang = 'utf-8';
$cfg_soft_public = 'base';

$_sys_globals['curfile'] = '';
$_sys_globals['typeid'] = 0;
$_sys_globals['typename'] = '';
$_sys_globals['aid'] = 0;

if(!isset($cfg_NotPrintHead)) {
    header("Content-Type: text/html; charset={$cfg_soft_lang}");
}

//自动加载类库处理
function __autoload($classname)
{

    $classname = preg_replace("/[^0-9a-z_]/i", '', $classname);
    if( class_exists ( $classname ) )
    {
        return TRUE;
    }
	$classname=strtolower($classname);
	
    $classfile = $classname.'.php';
    $libclassfile = $classname.'.class.php';
        if ( is_file ( SLINEINC.'/'.$libclassfile ) )
        {
            require SLINEINC.'/'.$libclassfile;
        }
       
        else
        {
            if (DEBUG_LEVEL === TRUE)
            {
                echo '<pre>';
				echo $classname.'类找不到';
				echo '</pre>';
				exit ();
            }
            else
            {
                header ( "location:/404.php" );
                die ();
            }
        }
}
 
//数据库类
require_once(SLINEINC.'/slinesql.class.php');
//全局常用函数
require_once(SLINEINC.'/common.func.php');

//载入小助手配置,并对其进行默认初始化
if(file_exists(SLINEDATA.'/helper.inc.php'))
{
    require_once(SLINEDATA.'/helper.inc.php');
    // 若没有载入配置,则初始化一个默认小助手配置
   if (!isset($cfg_helper_autoload))
    {
        $cfg_helper_autoload = array('util', 'charset', 'string', 'time', 'cookie');
		
    }
      // 初始化小助手  
    helper($cfg_helper_autoload);

}
//会员信息
require_once(SLINEINC.'/member.class.php');
$keeptime = isset($keeptime) && is_numeric($keeptime) ? $keeptime : -1;
$User = new Member($keeptime);



//手机跳转
//判断是否是手机浏览
if($cfg_mobile_open == '1')
{
    if(!empty($computerversion))
    {
        PutCookie('computer',1,3600);
        $cookie = 1;
    }
    else
    {
        $cookie = GetCookie('computer');
        $cookie = $cookie ? $cookie : 0;
        if($cookie==0)
        {
            DropCookie('computer');
        }
    }
    if(Helper_Archive::isMobile() && $cookie == 0)
    {
        //兼容性修复
        $uri = $_SERVER["HTTP_X_REWRITE_URL"];
        if($uri==null)
        {
            $uri=$_SERVER["REQUEST_URI"];
        }
        $currentUrl = 'http://'.$_SERVER['HTTP_HOST'].$uri;
        $model = new Mobile();
        $url = $model->getMobileUrl($currentUrl);
        header("Location:$url");//跳转到手机页面
        exit();
    }
}


//站点信息配置表
$sys_child_webid = 0;
$sys_webprefix = Helper_Archive::getSysWebprefix();


if(file_exists(SLINEDATA.'/weblist.php'))
{
    require_once(SLINEDATA.'/weblist.php');
    if(!empty($weblist))
    {
        $url = $_SERVER['HTTP_HOST'];//当前域名
        $uarr = explode('.',$url);
        $prefix = $uarr[0]; //域名前辍
        if(!array_key_exists($prefix,$weblist) && $prefix!=$sys_webprefix)
        {
            if(!isset($GLOBALS['is404']))
            {
                head404();//如果域名不匹配,则跳转到404页面.
                exit;
            }

        }
        else if($prefix!=$sys_webprefix)
        {
            $sys_child_webid = $weblist[$prefix]['webid']; //当前站点id
            $sys_child_webname =$weblist[$prefix]['kindname'];//站点名称
            $sys_webprefix = $prefix;//当前站点域名前辍.
            $cfg_df_style = 'sline'; //子站模板皮肤
            $cfg_templets_skin = empty($cfg_df_style)? $cfg_mainsite.$cfg_templets_dir."/smore" : $cfg_mainsite.$cfg_templets_dir."/$cfg_df_style";
            //子站系统配置文件
            require_once(SLINEDATA."/config/config.".$prefix.".php");
            $cfg_base_url = GetWebURLByWebid(0);//主域名
        }
    }

}



