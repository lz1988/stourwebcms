<?php
/**
 * @version        $Id: index.php 1 13:41 2014年2月27日 netman
 * @package        Stourweb.Install
 * @copyright      Copyright (c) 2011 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

@set_time_limit(0);
//error_reporting(E_ALL);
//error_reporting(E_ALL || ~E_NOTICE);
//ini_set('display_errors',0);





error_reporting(E_ERROR);
$verMsg = ' V3.0';
$dfDbname = 'stourwebcms';
$dblang ='utf8';
$errmsg = '';
$insLockfile = dirname(__FILE__).'/install_lock.txt';

define('SLINEINC',dirname(__FILE__).'/../include');
define('SLINEDATA',dirname(__FILE__).'/../data');
define('SLINEROOT',preg_replace("#[\\\\\/]install#", '', dirname(__FILE__)));
header("Content-Type: text/html; charset=utf-8");
require_once('chromephp.class.php');


require_once(SLINEROOT.'/install/install.func.php');


foreach(Array('_GET','_POST','_COOKIE') as $_request)
{
    foreach($$_request as $_k => $_v) ${$_k} = RunMagicQuotes($_v);
}

require_once(SLINEINC.'/common.func.php');

if(file_exists($insLockfile))
{
    exit(" 思途CMS程序已运行安装，如果你确定要重新安装，请先从FTP中删除 install/install_lock.txt！");
}

if(empty($step))
{
    $step = 1;
}
/*------------------------
使用协议书
------------------------*/
if($step==1)
{
    include('./templets/step1.htm');
    exit();
}
/*------------------------
环境检测
------------------------*/
else if($step==2)
{
    $sys_php = phpversion(); //php版本
    $sys_os = PHP_OS;
    $sys_gd = gdversion();
	$sys_uploadsize = getServerFileUpload();
	$sys_diskspace = getDiskSpace(SLINEROOT);

    //目录检测
    $testdirs = array(
        '/data/*',
        '/newtravel/application/data/*',
		'/newtravel/application/cache/*',
		'/newtravel/application/logs/*',
		'/newtravel/application/config/*',
        '/uploads/*'
    );
	//函数检测
	$funccheck = array(
	    'mysql_connect',
        'curl_init',
        'fsockopen'
		);
		
	
	
    include('./templets/step2.htm');
    exit();
}
/*------------------------
设置参数(安装第三步)

------------------------*/
else if($step==3)
{
    

    include('./templets/step3.htm');
    exit();
}
//创建数据库
else if($step == 'createDataBase') //创建数据库
{
	$data = 'no';
	$conn = mysql_connect($dbhost,$dbuser,$dbpwd) ;
    $flag = mysql_query("CREATE DATABASE IF NOT EXISTS `".$dbname."`;",$conn);
	if($flag) $data='ok';
	echo $data;
	exit;
   
	
}
//创建common.inc.php
else if($step == 'createDataConfig') //数据库配置
{
  	$fp = fopen(dirname(__FILE__)."/common.inc.php","r");
    $configStr1 = fread($fp,filesize(dirname(__FILE__)."/common.inc.php"));
    fclose($fp);
	 //common.inc.php
    $configStr1 = str_replace("~dbhost~",$dbhost,$configStr1);
    $configStr1 = str_replace("~dbname~",$dbname,$configStr1);
    $configStr1 = str_replace("~dbuser~",$dbuser,$configStr1);
    $configStr1 = str_replace("~dbpwd~",$dbpwd,$configStr1);

    //写数据库文件
    @chmod(SLINEDATA,0777);
    $fp = fopen(SLINEDATA."/common.inc.php","w") ;
	$flag = 'no';
	if($fp)
	{
	   fwrite($fp,$configStr1);
       fclose($fp);	
	   $flag = 'ok';
	}
   //3.0后台配置文件
   
  	$fp = fopen(dirname(__FILE__)."/database.php","r");
    $configStr2 = fread($fp,filesize(dirname(__FILE__)."/database.php"));
    fclose($fp);
	 //database.php
    $configStr2 = str_replace("~dbhost~",$dbhost,$configStr2);
    $configStr2 = str_replace("~dbname~",$dbname,$configStr2);
    $configStr2 = str_replace("~dbuser~",$dbuser,$configStr2);
    $configStr2 = str_replace("~dbpwd~",$dbpwd,$configStr2);

    $fp = fopen(SLINEROOT."/newtravel/application/config/database.php","w") ;
	if($fp)
	{
	   fwrite($fp,$configStr2);
       fclose($fp);	
	  
	}

	echo $flag;
	exit;

}
else if($step == 'createDefaultConfig') //创建默认配置
{
	$fp = fopen(dirname(__FILE__)."/config.cache.inc.php","r");
    $configStr2 = fread($fp,filesize(dirname(__FILE__)."/config.cache.inc.php"));
    fclose($fp);

   
    //config.cache.inc.php
	if(!empty($_SERVER['REQUEST_URI']))
       $scriptName = $_SERVER['REQUEST_URI'];
    else
      $scriptName = $_SERVER['PHP_SELF'];
    $basepath = preg_replace("#\/install(.*)$#i", '', $scriptName);
    $cmspath = trim(preg_replace("#\/{1,}#", '/', $basepath));
    if($cmspath!='' && !preg_match("#^\/#", $cmspath)) $cmspath = '/'.$cmspath;
    $configStr2 = str_replace("~basepath~",$cmspath,$configStr2);

    $flag = 'no';

    //写默认配置文件
    $fp = fopen(SLINEDATA.'/config.cache.inc.php','w');
	if($fp)
	{
	  fwrite($fp,$configStr2);
      fclose($fp);
	   //备份文件
	  $fp = fopen(SLINEDATA.'/config.cache.bak.php','w');
	  fwrite($fp,$configStr2);
	  fclose($fp);  
	  $flag = 'ok';	
	}
	echo $flag;
	exit;
}

else if($step == 'creattable')//创建表
{	
	$conn = mysql_connect($dbhost,$dbuser,$dbpwd) ;
	
    mysql_select_db($dbname);

    mysql_query("SET NAMES '$dblang',character_set_client=binary,sql_mode='';",$conn);

      //创建数据表
  
    $query = '';
    $fp = fopen(dirname(__FILE__).'/sql-dftables.txt','r');
    while(!feof($fp))
    {
        $line = trim(fgets($fp,1024*1024));
        if(empty($line))
            continue;
        if(preg_match("/;$/", $line))
        {
            $query .= $line."\n";
            $rs = mysql_query($query,$conn);
            $error=mysql_error();
            if(!empty($error))
            {
                echo $error;
                exit;
            }
            $query='';
        } else
        {
            $query .= $line;
        }
    }
    fclose($fp);
	echo 'ok';
	exit;
}
else if($step == 'initbasedata')//初始基础数据
{
	$conn = mysql_connect($dbhost,$dbuser,$dbpwd) ;
	
    mysql_select_db($dbname);
	mysql_query("SET NAMES '$dblang',character_set_client=binary,sql_mode='';",$conn);
    //导入默认数据
    $query = '';
    $fp = fopen(dirname(__FILE__).'/sql-dfdata.txt','r');
    while(!feof($fp))
    {
        $line = rtrim(fgets($fp,1024*1024));
        if(empty($line))
            continue;
        if(preg_match("/;$/", $line))
        {
            $query .= $line."\n";
            $rs = mysql_query($query,$conn);
            $error=mysql_error();
            if(!empty($error))
            {
                echo 'error sql:'.$query.'\n';
                echo $error;
                exit;
            }
            $query='';
        } else
        {
            $query .= $line;
        }
    }
    fclose($fp);
	echo 'ok';
	exit;
}
else if($step == 'initdemodata')//初始演示数据
{
    if($usedata==1) {
		$conn = mysql_connect($dbhost,$dbuser,$dbpwd) ;
	
		mysql_select_db($dbname);
		mysql_query("SET NAMES '$dblang',character_set_client=binary,sql_mode='';",$conn);

        $query = '';
        $fp = fopen(dirname(__FILE__) . '/sql-moredata.txt', 'r');
        while (!feof($fp)) {
            $line = rtrim(fgets($fp, 1024 * 1024));
            if (empty($line))
                continue;
            if (preg_match("/;$/", $line)) {
                $query .= $line . "\n";
                $rs = mysql_query($query, $conn);
                $error = mysql_error();
                if (!empty($error)) {
                    echo 'error sql:' . $query . '\n';
                    echo $error;
                    exit;
                }
                $query = '';
            } else {
                $query .= $line;
            }
        }
        fclose($fp);
    }
	echo 'ok';
	exit;
}
else if($step == 'completedatabaseconfig')//完成数据库配置和安装
{
   $conn = mysql_connect($dbhost,$dbuser,$dbpwd) ;
	
    mysql_select_db($dbname);
	mysql_query("SET NAMES '$dblang',character_set_client=binary,sql_mode='';",$conn);

    $cquery = "Update `sline_sysconfig` set value='{$cmspath}' where varname='cfg_cmspath';";
    mysql_query($cquery,$conn);
	
	    //增加管理员帐号
    $adminquery = "INSERT INTO `sline_admin` (username,password,logintime,loginip,roleid) VALUES ('$adminuser', '".md5($adminpwd)."', '".time()."', '127.0.0.1','1');";
    mysql_query($adminquery,$conn);
	
	 //写入网站信息
	   if(!empty($_SERVER['REQUEST_URI']))
		$scriptName = $_SERVER['REQUEST_URI'];
		else
		$scriptName = $_SERVER['PHP_SELF'];
	
		$basepath = preg_replace("#\/install(.*)$#i", '', $scriptName);
	
		if(!empty($_SERVER['HTTP_HOST']))
			$baseurl = 'http://'.$_SERVER['HTTP_HOST'];
		else
			$baseurl = "http://".$_SERVER['SERVER_NAME'];
			
	 $rootDir  = dirname(dirname(dirname(__FILE__))).'\\';
     $webPrefix=substr($baseurl,strlen('http://')-1,strpos($baseurl,'.'));
	 $webroot = str_replace($rootDir,'',SLINEROOT);
     $webPrefix=str_replace('http://','',substr($baseurl,0,strpos($baseurl,'.')));
	 $sql = " INSERT INTO `sline_weblist` (webname,weburl,webid,webroot,webprefix) VALUES('主站','{$baseurl}','0','$webroot','$webPrefix')";
	 mysql_query($sql,$conn);
    
  
	 //创建视图
	crView($conn);
	echo 'ok';
	exit;	
}


/*------------------------
安装第4步
function _4_Setup()
------------------------*/
else if($step==4)
{
    //exit;
    include('./templets/step4.htm');
    exit(); 
  
}

/*------------------------
安装第5步(安装成功)
function _4_Setup()
------------------------*/
else if($step==5)
{
    include('./templets/step5.htm');
	 //锁定安装程序
	$fp = fopen($insLockfile,'w');
	fwrite($fp,'ok');
	fclose($fp);
    exit(); 
  
}



