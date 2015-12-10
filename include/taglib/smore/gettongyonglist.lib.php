<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 通用模块产品调用标签
 *
 * @version        $Id: gettongyongsuit.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 


function lib_gettongyonglist(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|10,pinyin|0,limit|0,type|byorder";
	$webid=0;
	
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
    if(empty($pinyin)) return '';

    $sql="select id as typeid,addtable from sline_model where pinyin='$pinyin'";
    $ar = $dsql->GetOne($sql);
    $sql = '';
    if(!empty($ar['typeid']))
    {
        $addtable = 'sline_'.$ar['addtable'];
        $typeid = $ar['typeid'];
        if($type == 'byorder')
        {
            $sql = "select a.id as realid,a.*,b.* from sline_model_archive a left join {$addtable} b on(a.id=b.productid)  left join sline_allorderlist c on(a.id=c.id and c.typeid=$typeid) where a.typeid=$typeid order by ifnull(c.displayorder,9999) asc,a.addtime desc limit {$limit},{$row} ";
        }
        else if($type == 'mdd')
        {
            $sonid=isset($definekind) ? $definekind : $refObj->Fields['kindid'];
            //这里增加子站的判断
            if($GLOBALS['sys_child_webid']!=0)
            {
                $dest_id = $GLOBALS['sys_child_webid'];
            }
            $sonid = $sonid ? $sonid : $dest_id;
            $sql = "select a.id as realid,a.*,b.* from sline_model_archive a left join {$addtable} b on(a.id=b.productid)  left join sline_allorderlist c on(a.id=c.id and c.typeid=$typeid) where a.typeid=$typeid and FIND_IN_SET($sonid,a.kindlist) order by ifnull(c.displayorder,9999) asc,a.addtime desc limit {$limit},{$row} ";

        }

    }

    if(empty($sql))return '';
	$innertext = trim($ctag->GetInnertext());
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$revalue='';

    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
        $row['url'] = $GLOBALS['cfg_basehost'].'/'.$pinyin.'/'.'show_'.$row['aid'].'.html';
        $row['price'] = TagTongYong::getProductMinPrice($row['realid']);

        foreach($ctp->CTags as $tagid=>$ctag)
        {
                if($ctag->GetName()=='array')
                {
                    $ctp->Assign($tagid, $row);
                }
                else
                {
                    if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]);
                    else $ctp->Assign($tagid,'');
                }
        }
      $revalue .= $ctp->GetResult();
    }

    return $revalue;
}
class TagTongYong{

    public static function getProductMinPrice($productid)
    {
        global $dsql;
        $sql = "select min(ourprice) as price from sline_model_suit where productid='$productid'";
        $row = $dsql->GetOne($sql);
        return $row['price'] ? $row['price'] : 0;
    }


}
