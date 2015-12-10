<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

/**
 * 调用文章显示数据标签
 *
 * @version        $Id: getarclist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

function lib_getarcbyattr(&$ctag,&$refObj)
{
	
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,attrid|,offset|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	
     
   // 
    $where=" find_in_set($attrid,attrid)".lib_getsubattrid($attrid);
	


	$sql="select a.* from #@__article a where $where order by a.isding desc,a.displayorder asc,a.addtime desc limit {$offset},{$row}";
	
  
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
		$GLOBALS['autoindex']++;
		$webroot=GetWebURLByWebid($row['webid']);
		$sonid=$refObj->Fields['sonid'];
		
	//	$row['commnum']=GetArcCommNum($row['webid'],$row['aid']);
		
		
		if($row['webid'] == 0)
		{
			$row['url']=$GLOBALS['cfg_cmsurl']."/raiders/show_{$row['aid']}.html";	
		}
		else
		{
			$row['url']=GetWebURLByWebid($row['webid'])."/raider/show_{$row['aid']}.html";	
		}
			
		$row['lit240']=getPicByName($row['litpic'],'lit240');
		$row['lit160']=getPicByName($row['litpic'],'lit160');
		
		$row['litpic']=!empty($row['litpic'])?$GLOBALS['cfg_cmsurl'].$row['litpic']:$GLOBALS['cfg_cmsurl']."/templets/".$GLOBALS['cfg_df_style']."/images/".$GLOBALS['cfg_df_img'];
			
		if($row['allow'] == "usecontentpic" && !empty($row['litpic']))
		{
			$row['imgtitle']=$row['title'] . '<img src="' . $GLOBALS['cfg_templets_skin'] . '/images/gl_yt.gif" />';
		}
		else
		{
			$row['imgtitle']=$row['title'];
		}
		$row['title']=$row['title'];
		$row['attrname']=getAttrname2($row['attrid']);
		
        foreach($ctp->CTags as $tagid=>$ctag)
        {
                if($ctag->GetName()=='array')
                {
                        $ctp->Assign($tagid, $row);
                }
                else
                {
                    if(isset($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 
                }
        }
        $revalue .= $ctp->GetResult();
		
    }
    return $revalue;
}

function lib_getsubattrid($attrid)
{
	global $dsql;
	$sql1="select id from #@__article_attr where pid={$attrid}";
	$result=$dsql->getAll($sql1);
	foreach($result as $k=>$v)
	{
       $where.=" or find_in_set({$v['id']},attrid)";
	}

	return $where;

}

function getAttrname2($attrid)
{
   global $dsql;
   $name='其它';
   if(!empty($attrid))
   {
     $sql="select attrname from #@__article_attr where id in ($attrid)";
	
     $row=$dsql->GetOne($sql);
	 $name=$row['attrname'];
   }
   return $name;

}