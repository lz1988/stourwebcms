<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/6/1 0001
 * Time: 14:20
 */
Helper_Archive::loadModule('common');
function page($count,$pageno,$pagesize,$url,$disnum=5,$url1)  //分页函数
{
    $title_arr=array(
        'firstpage'=>'<<',
        'prepage'=>'上一页',
        'lastpage'=>'&gt;&gt;',
        'nextpage'=>'下一页'
    );
    $str='';
    if($count==0)
        return '';

    $page=ceil($count/$pagesize);
    $str.='<div class="page">
		';

    //前一页按钮
    if($pageno<=1)
        $str.='';//'<span class="pageOff">'.$title_arr['firstpage'].'</span> <span class="pageOff">'.$title_arr['prepage'].'</span> ';
    else
    {
        $pre_pageno=$pageno-1;
        $nurl=str_replace('{page}',$pre_pageno,$url);
        $str.="<a class='pagePrev' href='$nurl'>".$title_arr['prepage']."</a> ";
    }


    //计算页起始页和结束页
    if($page>=$disnum)
    {
        $pre_num=ceil(($disnum-1)/2);
        $next_num=floor(($disnum-1)/2);
        if($pre_num>=$pageno)
        {
            $start_index=1;
            $end_index=$disnum;
        }
        else
        {
            $start_index=$pageno-$pre_num;
            $end_index=$pageno+$next_num;
        }
        if($end_index>=$page)
        {
            $start_index=$page-$disnum;
            $end_index=$page;
        }
    }
    else
    {
        $start_index=1;
        $end_index=$page;
    }

    //前置省略页面
    if($start_index>1)
        $str.='<span class="pageOff">...</span> ';


    $start_index=$start_index<1?1:$start_index;
    //实现
    for($i=$start_index;$i<=$end_index;$i++)
    {
        if($pageno==$i)
        {
            $str.="<span class='pageCurrent'>$i</span> ";
        }
        else
        {
            $burl=$i==1?$url1:str_replace('{page}',$i,$url);;
            $str.="<a class='pageOff' href='$burl'>{$i}</a> ";
        }
    }

    //后置省略页面
    if($end_index<$page)
        $str.='<span class="pageOff">...</span> ';


    //下一页按钮
    if($pageno==$page)
    {
        $str.='';//'<span class="pageOff">'.$title_arr['lastpage'].'</span> <span class="pageOff">'.$title_arr['nextpage'].'</span> ';
    }
    else
    {
        $next_pageno=($pageno+1)<=$page?$pageno+1:$page;
        $nurl=str_replace('{page}',$next_pageno,$url);
        $lasturl=str_replace('{page}',$page,$url);
        $str.="<a href=\"{$nurl}\" class=\"pageNext\">".$title_arr['nextpage']."</a>";
    }
    //$str.="(总计<span class='pageColor1'>{$page}</span>页<span class='pageColor2'>{$count}</span>条记录)</div>";
    return $str;
}
function get_productname($typeid,$id)
{
    global $dsql;
    $channeltable=array(
        1=>'line',
        2=>'hotel',
        3=>'car',
        4=>'article',
        5=>'spot',
        6=>'photo',
        8=>'tuan',
        13=>'tuan'
    );
    $tablename = 'sline_'.$channeltable[$typeid];
    $fields=array(
        '1'=>array('field'=>'title','link'=>'lines'),
        '2'=>array('field'=>'title','link'=>'hotels'),
        '3'=>array('field'=>'title','link'=>'cars'),
        '4'=>array('field'=>'title','link'=>'article'),
        '5'=>array('field'=>'title','link'=>'spots'),
        '6'=>array('field'=>'title','link'=>'photos'),
        '8'=>array('field'=>'title','link'=>'visa'),
        '13'=>array('field'=>'title','link'=>'tuan')

    );


    $field = $fields[$typeid]['field'];
    $link =$fields[$typeid]['link'];

    if($typeid>13) //通用模块
    {
        $itemModel = new CommonModule('sline_model');
        $module_info =$itemModel->getOne('id='.$typeid);
        $tablename = "sline_model_archive";
        $field = 'title';
        $link = $module_info['pinyin'];
    }
    $sql = "select aid,{$field} as title from {$tablename} where id='$id'";

    $row=$dsql->GetOne($sql);
    return $row['title'];
}