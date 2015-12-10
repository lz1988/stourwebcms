<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 广告调用
 *
 * @version        $Id: myad.lib.php 1 9:29 2011.05.03 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 

 


function lib_myad(&$ctag, &$refObj)
{
    $attlist = "typeid|0,name|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $body = lib_GetMyad($refObj, $typeid, $name, '#@__advertise');
    
    return $body;
}
function lib_GetMyad(&$refObj, $typeid,$tagname,$tablename)
{
    global $dsql;
    $webid = $GLOBALS['sys_child_webid'];//webid赋值
    if($tagname=='') return '';
    if(trim($typeid)=='') $typeid=0;
    if( !empty($refObj->Fields['typeid']) && $typeid==0) $typeid = $refObj->Fields['typeid'];
    
    $typesql = $row = '';
    //if($typeid > 0) $typesql = " And typeid IN(0,".GetTopids($typeid).") ";
	
	$typesql="and typeid in (0,".$typeid.")";

	//$sql=" SELECT * FROM $tablename WHERE tagname LIKE '$tagname' $typesql ORDER BY id DESC ";
	//echo $sql;
    
    $row = $dsql->GetOne(" SELECT * FROM $tablename WHERE tagname LIKE '$tagname' $typesql  and webid='$webid' ORDER BY id DESC ");

	
	if(!is_array($row)) return '';

   /* $nowtime = time();
    if($nowtime<$row['starttime'] || $nowtime>$row['endtime'])
    {
        $body = $row['expirebody'];
    }
    else
    {
        $body = $row['normalbody'];
    }*/
    $body = $row['normalbody'];
    return $body;
}