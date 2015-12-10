<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 内容详细页调用标签
 *
 * @version        $Id: detailcontent.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


function lib_detailcontent(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|10,typeid|";
	$webid=0;
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
    $tables = array(
        '1'=>'sline_line_content',
        '2'=>'sline_hotel_content',
        '3'=>'sline_car_content',
        '5'=>'sline_spot_content',
        '8'=>'sline_visa_content',
        '13'=>'sline_tuan_content'
    );
    $extend_tables = array(
        '1'=>'sline_line_extend_field',
        '2'=>'sline_hotel_extend_field',
        '3'=>'sline_car_extend_field',
        '5'=>'sline_spot_extend_field',
        '8'=>'sline_visa_extend_field',
        '13'=>'sline_tuan_extend_field'
    );
    $table = $tables[$typeid];
    $extend_tables = $extend_tables[$typeid];
    if(empty($table))return'';
    $sql="select columnname,chinesename,isrealfield from {$table}  where webid=0 and isopen=1 order by displayorder asc";
	$innertext = trim($ctag->GetInnertext());
    $arr = $dsql->getAll($sql);

    //扩展表数据
    $productid = $refObj->Fields['id'];
    $sql = "select * from $extend_tables where productid='$productid'";
    $extend_row = $dsql->GetOne($sql);


    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$revalue='';

    foreach($arr as $row)
    {

        $GLOBALS['autoindex']++;

        $row['productid'] = $refObj->Fields['id'];//产品id
        $content = '';

        if(isset($refObj->Fields[$row['columnname']]))
        {
            $content = $refObj->Fields[$row['columnname']];
        }
        else if(isset($extend_row[$row['columnname']]))
        {
            $content = $extend_row[$row['columnname']];
        }

        $row['content'] = $row['isrealfield']==0&&empty($content) ? $row['productid'] : $content;

       // if(empty($row['content'])) continue;
        $row['content']=detailcontent_filter($typeid,$row['columnname'],$row['content']);
        if($row['content']===false)
            continue;
        foreach($ctp->CTags as $tagid=>$ctag)
        {
                if($ctag->GetName()=='array')
                {
                    $ctp->Assign($tagid, $row);
                }
                else
                {
                    if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]);
                    else
                        $ctp->Assign($tagid,'');
                }
        }
      $revalue .= $ctp->GetResult();
    }

    return $revalue;
}
function detailcontent_filter($typeid,$columnname,$content)
{
    if($columnname=='payment' && $typeid==1)
    {
        $content=empty($content)?$GLOBALS['cfg_payment']:$content;
    }
    if(empty($content))
        return false;
    return $content;
}
