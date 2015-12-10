<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

/**
 * 调用相册显示数据标签
 *
 * @version        $Id: getphotolist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */


function lib_getphotolist(&$ctag,&$refObj)
{
    global $dsql,$cfg_indexphoto;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|10,flag|,type|top,limit|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
	$basefield = 'a.aid,a.title,a.seotitle,a.litpic,a.content,a.title as littitle,a.alt,a.author,a.shownum,a.webid,a.headimgid';
    $revalue = '';
   //加目的地页面显示条件
	$destwhere=(isset($refObj->Fields['kindid'])) ? "and FIND_IN_SET({$refObj->Fields['kindid']},kindlist) " : ''; //用于聚合页面
	if($type=='mdd')
	{  
	   if(isset($refObj->Fields['kindid']))
	   {
	        $sonid=$refObj->Fields['kindid'];
			$number=isset($refObj->Fields['shownumber']) ? $refObj->Fields['shownumber'] : $row;//如果模块设置了显示数量则使用.
			$sql="select {$basefield} from #@__photo as a left join #@__kindorderlist as c on (c.classid=$sonid and a.id=c.aid and c.typeid=6) where  FIND_IN_SET($sonid,a.kindlist) order by c.isding desc,case when c.displayorder is null then 9999 end,c.displayorder asc,a.addtime desc limit {$limit},{$number}";
				
	   }
	   else return '';
	} 
	//目的地热门相册
	else if($type=='sonhot')
	{  
	   if(isset($refObj->Fields['kindid']))
	   {
	        $sonid=$refObj->Fields['kindid'];
			$sql="select {$basefield} from #@__photo a where FIND_IN_SET($sonid,kindlist)  order by shownum desc limit {$limit},{$row}";	
	   }
	   else return '';
	}
	//属性相册
	else if($type=='attr')
	{  
	   if(isset($attrid))
	   {
			$sql="select {$basefield} from #@__photo a where FIND_IN_SET({$attrid},attrid)  order by displayorder asc,shownum desc limit {$limit},{$row}";	
	   }
	   else return '';
	} 
	//同目的地相册
	else if($type=='relative')
	{  
	  
	    $kindlist=$refObj->Fields['kindlist'];
		$maxkindid=array_remove_value($kindlist);//最后一级.
		$where=" FIND_IN_SET($maxkindid,kindlist) ";
	 
		$sql="select {$basefield} from #@__photo a where {$where} order by modtime desc,addtime desc limit {$limit},{$row}";
	  
	} 
	else if($type=='sonj')
	{  
	   if(isset($refObj->Fields['sonid']))
	   {
	        $sonid=$refObj->Fields['sonid'];
			$sql="select aid,title,seoname,headimg,content,title as littitle,alt,author,shownum,webid,headimgid from #@__photo  where webid!='' {$destwhere} and   photokind={$sonid} order by modtime desc,addtime desc limit {$limit},{$row}";
			
	   }
	   else return '';
	} 
	//推荐相册
	else if($flag=='recommend')
	 {
		
		 $sql="select {$basefield} ,b.isjian,b.isding ,b.displayorder from #@__photo a left join #@__allorderlist b on(a.id=b.aid and b.typeid=6) order by case when b.displayorder is null then 9999 end,b.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";
		 }
		
		//置顶相册
		else if($flag=='isding')
		{
		   $sql="select {$basefield} from #@__photo where webid=$sys_webid  and isding=1 order by addtime desc limit {$limit},{$row}";
		}
		else if($flag=='roll')
		{
			//首页相册显示方式
		  if($GLOBALS['cfg_indexphoto']=="0")
		  {
			  $sql="select {$basefield} from #@__photo where webid=$sys_webid order by modtime desc,addtime desc";
		   }
		   else  if($GLOBALS['cfg_indexphoto']=="-1")
		  {
			  $sql="select id,pictname as photoname,litpic as headimg,pid as aid  from #@__photo_picture where webid=$sys_webid order by modtime desc";
		   }
		   else 
		   {
				$sql="select id,pictname as photoname,litpic as headimg,pid as aid  from #@__photo_picture where webid=$sys_webid  and pid={$GLOBALS['cfg_indexphoto']} order by modtime desc";
		   }
										
		
	}
	else return '';
    
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
		$weburl=GetWebURLByWebid($row['webid']);
	  
		$row['url']=$weburl."/photos/show_{$row['aid']}.html";
		$row['title']=!empty($row['seotitle'])?$row['seotitle']:$row['photoname'];
		$row['litpic']=!empty($row['litpic'])?$row['litpic']:getDefaultImage();
		$row['lit240']=getPicByName($row['litpic'],'lit240');
		$row['lit160']=getPicByName($row['litpic'],'lit160');
		$row['alt']=!empty($row['alt']) ? $row['alt'] : $row['photoname'];
		/*if($row['littitle']!="")
		{
		  $row['imgtitle']="title='".$row['littitle']."'";
		}*/
        //$row['headimg']=!empty($row['headimg'])?$row['headimg']:"sdfsf";
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