<?php
require_once (dirname(__FILE__) . "/include/common.inc.php");
require_once SLINEINC."/httpdown.class.php";
$fpath = SLINEDATA."/last_time.inc";//记录更新时间文件。
include($fpath);
$time = time();//当前时间
$autotime = empty($cfg_auto_time) ? 3600 : $cfg_auto_time;//自动更新时间(秒)
$lasttime = empty($lasttime) ? 0 : $lasttime;//上次更新时间

if(($time-$lasttime)>=$autotime)//如果满足更新时间
{
	makeHtml();//进行自动更新
	writeupdateTime($time,$fpath);
	
}

//自动更新
function makeHtml()
{
    global $dsql;
	/*$storage = array(
	             '/',
				 '/lines/',
				 '/hotels/',
				 '/cars/',
				 '/raiders/',
				 '/spots/',
				 '/visa/',
				 '/tuan/',
				 '/destination/'
				 );

	$http = new HttpDown();//实例化下载类
	foreach($storage as $value)
	{
		$url = $GLOBALS['cfg_basehost'].$value.'index.php?genpage=1';
		$savepath = SLINEROOT.$value.'index.html';
		$http->OpenUrl($url);
        $http->SaveToBin($savepath);
		
	}*/
    include(PUBLICPATH.'/vendor/httpdown.class.php');

    //先生成主站html

    $storage = array(
        '/',
        '/lines/',
        '/hotels/',
        '/cars/',
        '/raiders/',
        '/spots/',
        '/visa/',
        '/tuan/',
        '/destination/'
    );

    $http = new HttpDown();//实例化下载类
    foreach($storage as $value)
    {
        $url = $GLOBALS['cfg_basehost'].$value.'index.php?genpage=1';
        $savepath = BASEPATH.$value.'index.html';
        $http->OpenUrl($url);
        $http->SaveToBin($savepath);

    }
    //生成子站首页静态
    $sql = "select id,weburl,webprefix from sline_destinations where iswebsite=1 and isopen=1";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $datapath=SLINEDATA.'/html/child/';
        if(!is_dir($datapath))mkdir($datapath,0777,true);

        $url = $row['weburl'].'/index.php?genpage=1';
        $savepath = SLINEDATA.'/html/child/'.$row['webprefix'].'_index.html';
        $http->OpenUrl($url);
        $http->SaveToBin($savepath);
    }
	
}

//写更新时间

function writeUpdateTime($time,$fpath)
{
	
	$file = fopen( $fpath, "w");
	fwrite( $file, "<?php\n");
	fwrite( $file,"\$lasttime=".$time.";\n");
	fwrite( $file, '?>' );
	fclose( $file );
}