<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

/**
 * 属性分类调用标签与attrgrouplist配合使用.
 *
 * @version        $Id: getattrbygroup.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 

function lib_getattrbygroup(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|80,typeid|,groupname|,groupid|,filterid|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    
	$attrtable=array('1'=>'#@__line_attr','2'=>'#@__hotel_attr','3'=>'#@__car_attr','4'=>'#@__article_attr','5'=>'#@__spot_attr','6'=>'#@__photo_attr','11'=>'#@__jieban_attr','13'=>'#@__tuan_attr');
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$typeid = empty($typeid) ? $refObj->Fields['typeid'] : $typeid;
	$tablename=isset($attrtable[$typeid]) ? $attrtable[$typeid] : '#@__model_attr';
    $w = !empty($filterid) ? " and id not in($filterid)" : '';//排除不要的项
    $w.= $typeid>13 ? " and typeid=$typeid" : '';//如果是扩展模块,则增加typeid判断
	if(!empty($groupname)) //通过组名获取
	{
	 $sql="select id from {$tablename} where  attrname='$groupname' $w";
	 $ar=$dsql->GetOne($sql);
	 if(is_array($ar))
	 $pid=$ar['id'];

	}
	else //与attrgrouplist搭配使用
	{
	   $pid =empty($groupid)?$refObj->Fields['attrid']:$groupid;	
	}
	if(empty($pid))return;
	//$sql="select id,attrname from {$tablename} where pid='$pid' and isopen=1 {$w} order by id asc limit 0,{$row}";
	// 增加了属性判断是否开启
	$sql="select id,attrname,isopen from {$tablename} where pid='$pid' {$w} and isopen=1 order by id asc limit 0,{$row}";
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
           
				$row['title']=$row['attrname'];
				$row['attrid'] = $row['id'];
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
				$GLOBALS['autoindex']++;
	      
    }
    return $revalue;
}



