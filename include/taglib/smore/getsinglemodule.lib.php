<?php   if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 获取单个模块标签
 *
 * @version        $Id: getsinglemodule.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

require_once(SLINEINC.'/view.class.php');

function lib_getsinglemodule(&$ctag,&$refObj)
{
    global $dsql,$sys_webid;
    include(SLINEDATA."/webinfo.php");
    $attlist="name|index";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = '';

    $sql = "select body from #@__module_list where modulename='{$name}'";
    $row = $dsql->GetOne($sql);
    $innertext .= $row['body'];
    $out = '';


    if ($innertext == '') return ''; //如里为空则退出


    $pv = new View(0);
    $pv->SetTemplet($innertext, 'string');
    $out .= $pv->GetResult();

    return $out;
}

 ?>
