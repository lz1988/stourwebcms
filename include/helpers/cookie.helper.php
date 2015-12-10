<?php   if(!defined('SLINEINC')) exit('sline');
/**
 * Cookie处理
 *
 * @version        $Id: cookie.helper.php
 * @package        Stourweb.Helpers
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @license        http://www.stourweb.com
 */

/**
 *  设置Cookie记录
 *
 * @param     string  $key    键
 * @param     string  $value  值
 * @param     string  $kptime  保持时间
 * @param     string  $pa     保存路径
 * @return    void
 */
if ( ! function_exists('PutCookie'))
{
    function PutCookie($key, $value, $kptime=0, $pa="/")
    {
        global $cfg_cookie_encode,$cfg_domain_cookie;
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $cfg_domain_cookie : false;
        setcookie($key, $value, time()+$kptime, $pa,$domain);
        setcookie($key.'__ckMd5', substr(md5($cfg_cookie_encode.$value),0,16), time()+$kptime, $pa,$domain);
    }
}


/**
 *  清除Cookie记录
 *
 * @param     $key   键名
 * @return    void
 */
if ( ! function_exists('DropCookie'))
{
    function DropCookie($key)
    {
        global $cfg_domain_cookie;
		$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $cfg_domain_cookie : false;
        setcookie($key, '', time()-360000, "/",$domain);
        setcookie($key.'__ckMd5', '', time()-360000, "/",$domain);
    }
}

/**
 *  获取Cookie记录
 *
 * @param     $key   键名
 * @return    string
 */
if ( ! function_exists('GetCookie'))
{
    function GetCookie($key)
    {
        global $cfg_cookie_encode;
        if( !isset($_COOKIE[$key]) || !isset($_COOKIE[$key.'__ckMd5']) )
        {
            return '';
        }
        else
        {
            if($_COOKIE[$key.'__ckMd5']!=substr(md5($cfg_cookie_encode.$_COOKIE[$key]),0,16))
            {
                return '';
            }
            else
            {
                return $_COOKIE[$key];
            }
        }
    }
}


