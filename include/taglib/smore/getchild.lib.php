<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 获取线路子级id标签代码
 *
 * @version        $Id: linechild.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 

function lib_linechild(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="typeid|0,row|5";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	$pid=isset($refObj->Fields['kindid'])?$refObj->Fields['kindid']:0; 
	$pname=isset($refObj->Fields['kindname'])?$refObj->Fields['kindname']:'';
	$pshownum=isset($refObj->Fields['shownum'])?$refObj->Fields['shownum']:5;
	$ppy = isset($refObj->Fields['pinyin'])?$refObj->Fields['pinyin']:'';
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$sql="select distinct a.kindname,a.kindname,a.id,a.pinyin,b.shownum from #@__destinations as a inner join  #@__line_kindlist as b on a.id=b.kindid where a.pid=$pid and a.isopen=1 order by b.displayorder asc limit 0,{$row}";
	
	$dsql->SetQuery($sql);
	$dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$kindnames=$ids=$shownumber=array();
	
    while($row = $dsql->GetArray())
    {
       if(ExistLine($row['id'],1))
		{
		  $ids[] = $row['id'];
		  $kindnames[]=$row['kindname'];//获取导航分类名称
		  $shownumber[]=!empty($row['shownum']) ? $row['shownum'] :8;
		  $pinyin[] = $row['pinyin'];
		 
		}
    }
	//这里增加一个当没有子级时判断,将直接读取父级列表.
	if(empty($ids[0]))
	{
	   $ids[]=$pid;	
	   $kindnames[]=$pname;
	   $shownumber[]=$pshownum;
	   $pinyin[]=$ppy;
	}
	
	for($i=0;isset($ids[$i]);$i++)
    {
      
		$pv = new View();
		$pv->Fields['kindname']=$kindnames[$i];
		$pv->Fields['kindid']=$ids[$i];
		$pv->Fields['pinyin']=$pinyin[$i];
		$pv->Fields['shownum']=$shownumber[$i];
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();
    }
	
  
    return $artlist;

}
//是否存在
function ExistLine($kindid,$typeid)
{  
    global $dsql;
	$flag=0;
	$table=array("1"=>"#@__line","2"=>"#@__hotel","3"=>"#@__car","4"=>"#@__article","5"=>"#@__spot","6"=>"#@__photo","10"=>"#@__leave");
	$tablename=$table[$typeid];
	$sql="select 1 from $tablename where FIND_IN_SET($kindid,kindlist) limit 1";
	$flag=$dsql->ExecuteNoneQuery2($sql);
	return $flag;
}
