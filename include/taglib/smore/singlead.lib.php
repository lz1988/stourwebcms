<?php   if(!defined('SLINEINC')) exit('Request Error!');
 /**
 * 单独广告调用
 *
 * @version        $Id: singlead.lib.php 1 9:29 2013.05.03 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2010, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
 
 
function lib_singlead(&$ctag, &$refObj)
{
    global $dsql,$sys_webid;

    $attlist = "typeid|0,name|,row|3";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    if($name=='') return '';
    $innertext = trim($ctag->GetInnertext());
    $revalue='';
    $webid = $GLOBALS['sys_child_webid'];//webid赋值
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);

	$sql="SELECT * FROM sline_advertise WHERE tagname = '$name' and webid='$webid' limit 1  ";
	$row = $dsql->GetOne($sql);
    //$row['picurl']=getUploadFileUrl($row['picurl']);
    if(is_array($row))
    {
        foreach($ctp->CTags as $tagid=>$ctag)
        {
            if($ctag->GetName()=='array')
            {
                $ctp->Assign($tagid, $row);
            }

            else
            {
                if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]);

            }

        }
        $revalue .= $ctp->GetResult();
    }






    return $revalue;
}
