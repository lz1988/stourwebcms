<?php
/**
 * User: netman
 * Date: 14-4-17
 * Time: 下午1:39
 */

if(!file_exists(dirname(__FILE__).'/data/common.inc.php'))
{
    header('Location:install/index.php');
    exit();
}

require_once (dirname(__FILE__) . "/include/common.inc.php");

//判断是否是手机浏览
if($cfg_mobile_open == '1')
{
    if(Helper_Archive::isMobile())
    {
        header("Location:mobile/");//跳转到手机页面
        exit();
    }
}

$html = dirname(__FILE__).'/index.html';
if(file_exists($html))
{
    include($html);
    exit;
}
else
{
   header("Location:index.php");
   exit();
}

