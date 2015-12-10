<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用同级或者下级分类标签
 *
 * @version        $Id: getnav.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
/* >>smore>>
*/
 

function lib_getnav(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|15,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$typeid=isset($refObj->Fields['typeid'])?$refObj->Fields['typeid']:1;
	$channel=array("1"=>"lines","2"=>"hotels","3"=>"cars","4"=>"raiders","5" =>"spots","6"=>"photos");
	if(!isset($flag)) return;
	$kindid=isset($refObj->Fields['kindid']) ? $refObj->Fields['kindid'] : 0 ;
	$kindtable=$tablename[$typeid];
	if($flag=='next')//下一级分类
	{
       $sql="select id,kindname as title,ishot,pinyin from #@__destinations where pid=$kindid and isopen=1 order by displayorder asc ";
	}
	else if($flag=='same')//同一级分类
	{
	   $psql="select pid from #@__destinations where id=$kindid and isopen=1 order by displayorder asc";
	   $row=$dsql->GetOne($psql);
	   if(is_array($row))
	   {
	     $sql="select id,kindname as title,ishot,pinyin from #@__destinations where pid={$row['pid']} and isopen=1 order by displayorder asc";
	   }
	   else
	   {
		 return '';   
	   }
	}
	else if($flag == 'line')
	{
		$sql="select id,kindname as title,ishot,pinyin from #@__destinations where pid=$kindid and isopen=1 order by displayorder asc ";
	}
	//echo $sql;

    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
		$id=intval($row['id'])<10 ? "0".$row['id'] : $row['id'];
		$py = $row['pinyin'];
		$img = $row['ishot'] == '1' ? '<img src="' . $GLOBALS['cfg_templets_skin'] . '/images/nav_left_hot.gif" />' : '';
		if($flag == 'line')
		{
			$row['title'] = $row['title'] . $img;
			$row['url']=$GLOBALS['cfg_cmsurl'] . "/{$py}/lines/";
		}
		else
		{
			$row['title'] = $row['title'] . $img;
			$row['url']=$GLOBALS['cfg_cmsurl'] . "/{$py}/";
		}
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