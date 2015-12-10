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

function lib_getarclist(&$ctag,&$refObj)

{
	
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,flag|,type|top,limit|0,haspic|,attrid|0,attrname|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $webid=empty($sys_webid)?0:$sys_webid;
	 
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$basefield ='a.id,a.aid,a.webid,a.title,a.seotitle,a.shownum,a.content,a.addtime,a.webid,a.attrid,a.litpic as litpic,a.kindlist,a.author';
   
   //是否有图片 
   $picwhere=!empty($haspic)?" and (a.litpic is not null and a.litpic!='') and a.ishidden=0 ":'';
   $picwhere2=!empty($haspic)?" where (a.litpic is not null and a.litpic!='') and a.ishidden=0 ":'';
	
	
	if($type=='mdd')
	{

	   if($flag=='recommend')
	   {
		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc';
	   }
	   else if($flag=='hot')
	   {
		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc';
	   }
	   else if($flag=='new')
	   {
		  $orderby='order by a.addtime desc'; 
		   
	   }
	   else if($flag=='imagehot')
	   {
		   
		  $orderby=" and a.litpic!='' order by case when c.displayorder is null then 9999 end,c.displayorder asc";
	   }
	   else
	   {
		  $orderby='order by case when c.displayorder is null then 9999 end,c.displayorder asc';
	   }
       $orderby.=",a.modtime desc,a.addtime desc";
       $sonid = isset($definekind) ? $definekind : $refObj->Fields['kindid'];
        //这里增加子站的判断
        if($GLOBALS['sys_child_webid']!=0)
        {
            $dest_id = $GLOBALS['sys_child_webid'];
        }
        $sonid = $sonid ? $sonid : $dest_id;

	   if(isset($sonid))
	   {

			$number=isset($refObj->Fields['shownumber']) ? $refObj->Fields['shownumber'] : $row;//如果模块设置了显示数量则使用.
		    
			$where=" FIND_IN_SET($sonid,a.kindlist) and a.ishidden=0 ";
			$where.=!empty($haspic)?" and a.litpic is not null":''; 
		  
			$sql="select {$basefield} from #@__article as a left join #@__kindorderlist as c on (c.classid=$sonid and a.id=c.aid and c.typeid=4)  where $where  {$orderby}  limit {$limit},{$number}";

			
			
	   }
	   else return '';
	}
    else if($type=='theme')
    {
        $themeid=$refObj->Fields['themeid'];
        if(empty($themeid))return '';
        $sql="select a.* from #@__article a where FIND_IN_SET($themeid,a.themelist) $picwhere order by a.modtime desc,a.addtime desc limit {$limit},{$row}";

    }
    else if($type=='pinlun')
    {
        $sql = "select a.*,b.id as plid,b.memberid,b.content as plcontent,b.addtime as pltime from #@__article a inner join #@__comment b on (a.id = b.articleid)  order by b.addtime desc limit {$limit},{$row}";
    }

	else if($flag=='specical')
	{
	   
	   $sql="select {$basefield} from #@__article a where ishidden=0 and isindex =1  $picwhere   order by modtime desc,addtime desc limit {$limit},{$row}";
	}
	else if($flag=='recommend')
	{
	   $sql="select {$basefield},b.isjian,b.isding as isding,b.displayorder from #@__article a left join #@__allorderlist b on (a.id=b.aid and b.typeid=4) $picwhere2   order by  case when  b.displayorder is null then 9999 end,b.displayorder asc,a.modtime desc,a.addtime desc limit {$limit},{$row}";

	 
	}
	else if($flag=='kindrecommend')
	{
		$kid=$refObj->Fields['kid'];
	    $sql="select {$basefield} from #@__article a where a.ishidden=0 and FIND_IN_SET($kid,a.kindlist) $picwhere order by a.displayorder asc, a.modtime desc,a.addtime desc limit {$limit},{$row}";
	}
	else if($flag=='isindex')
	{
	   $sql="select {$basefield} from #@__article a where a.isindex=1 $picwhere  order by a.modtime desc,a.addtime desc limit {$limit},{$row}";
	}
	else if($flag=='new')
	{
	   $sql="select {$basefield} from #@__article a $picwhere2  order by a.modtime desc,a.addtime desc limit {$limit},{$row}";
	  
	}
	else if($flag=='hot')
	{
	   $sql="select {$basefield} from #@__article a where a.webid IS NOT NULL $picwhere order by a.shownum desc,a.modtime desc,a.addtime desc limit {$limit},{$row}";
	}
	else if($flag=='photo') //幻灯显示
	{
	   	$sql="select {$basefield} from #@__article a where webid IS NOT NULL and a.litpic !='' $picwhere order by a.modtime desc,a.addtime desc limit {$limit},{$row}";
		
	}
	
	else if($flag=='jieban')
	{
		$getsql="select id from #@__article_attr where aid=0 and webid=0";
		$arr=$dsql->GetOne($getsql);
		$jiebanid=$arr['id'];//获取id
		
		
		$sql="select {$basefield},b.isding,b.displayorder,b.isjian from #@__article a left join #@__attrorderlist b on a.aid=b.aid and a.webid=b.webid where FIND_IN_SET($jiebanid,a.attrid) $picwhere order by b.displayorder asc, a.modtime desc,a.addtime desc limit {$limit},{$row}";
		
	}
	else if($flag=='relative')
	{
        $kindlist=$refObj->Fields['kindlist'];
        $maxkindid=array_remove_value($kindlist);//最后一级.
        $destid = $GLOBALS['dest_id'];
        if(empty($destid))
        {
            $maxkindid=array_remove_value($kindlist);//最后一级.
            $maxkindid = empty($maxkindid) ? 0 : $maxkindid;
        }
        else
        {
            $maxkindid = $destid;
        }
        $where=" FIND_IN_SET($maxkindid,a.kindlist) ";
        //排序顺序：置顶+tag关联》排序+ tag关联》最新更新+tag关联
        $sql="select a.* from #@__article a left join #@__kindorderlist b on (a.id=b.aid and b.typeid=4 and b.classid='$maxkindid') where  {$where} order by ifnull(b.displayorder,9999) asc,a.modtime desc,a.addtime desc limit {$limit},{$row} ";
		
	
	}

	else if($flag=='attr')
	{
		$attrid=$refObj->Fields['attrid'];
		$sql="select a.* from #@__article a where FIND_IN_SET($attrid,a.attrid) and a.ishidden=0 order by a.modtime desc,a.addtime desc limit {$limit},{$row}";
	}
	else if($flag=='byattr') //通过属性id调用文章
	{
		if(!empty($attrid))
		{
		   $where=" (find_in_set($attrid,a.attrid)".loc_getsubattrid($attrid).')';
	       $sql="select a.* from #@__article a left join #@__attrorderlist b on a.aid=b.aid and a.webid=b.webid where $where $picwhere order by b.displayorder asc, a.modtime desc,a.modtime desc limit {$limit},{$row}";
		}
		else if(!empty($attrname))
		 {
			 $temp_one=$dsql->GetOne("select id from #@__article_attr where attrname='$attrname'");
			 if(empty($temp_one))
			    return;
		     else
			    $sql="select a.* from #@__article a  where FIND_IN_SET({$temp_one['id']},a.attrid) and a.ishidden=0 order by  a.modtime desc,a.modtime desc limit {$limit},{$row}";
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
		$webroot=GetWebURLByWebid($row['webid']);
		$sonid=$refObj->Fields['sonid'];
        $row['url']=$webroot."/raiders/show_{$row['aid']}.html";
		$row['haspic']=empty($row['litpic'])?0:1;

        $litpic = getUploadFileUrl($row['litpic']);
        $row['lit240']=getUploadFileUrl(str_replace('litimg','lit240',$row['litpic']));
        $row['lit160']=getUploadFileUrl(str_replace('litimg','lit160',$row['litpic']));
        $row['litpic']=$litpic;
		if($row['allow'] == "usecontentpic" && !empty($row['litpic']))
		{
			$row['imgtitle']=$row['title'] . '<img src="' . $GLOBALS['cfg_templets_skin'] . '/images/gl_yt.gif" />';
		}
		else
		{
			$row['imgtitle']=$row['title'];
		}
		$row['title']=$row['title'];
		$row['attrname']=getAttrname($row['attrid']);
		$row['attrnamearr']=getAttrname($row['attrid'],true);
		$row['destname']=Helper_Archive::getBelongDestName($row['kindlist']);//所属目的地
		$row['destid']=array_remove_value($row['kindlist']);
		$row['pinyin']=Helper_Archive::getDestPinyin($row['destid']);
		//最新评论及评论数量
		$row['commentnum']=Helper_Archive::getCommentNum($row['id'],4);
		if($type=='pinlun'){

			$userinfo=$GLOBALS['User']->getInfoByMid($row['memberid']);
			$row['commentlitpic']=getUploadFileUrl($userinfo['litpic']);
			$row['commentnickname']=empty($userinfo['nickname'])?'匿名':$userinfo['nickname'];
			$row['commentid']=$row['plid'];
			$row['commentcontent']=$row['plcontent'];
			$row['commentaddtime']=$row['pltime'];

		}

		
        //攻略首页读取评论
        if($type == 'pinlun')
        {
            $row['pinlun'] = getArticlePinLun($row['id']);
        }
		
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
function getAttrname($attrid,$isarr=false)
{
   global $dsql;
   
   //如果需要的是数组
   if($isarr)
   {
	 $sql="select id,attrname from #@__article_attr where id in ($attrid)";
     $result=$dsql->getAll($sql);
	  foreach($result as $v)
	  {
		$newresult[$v['id']]=$v['attrname'];
	  }
	  return $newresult;      
   }
   
   //如果需要的不是数组
   $name='其它';
   if(!empty($attrid))
   {
     $sql="select attrname from #@__article_attr where id in ($attrid)";
     $row=$dsql->GetOne($sql);
	 $name=$row['attrname'];
   }
   return $name;

}

function loc_getsubattrid($attrid)
{
	global $dsql;
	$sql1="select id from #@__article_attr where pid={$attrid}";
	$result=$dsql->getAll($sql1);
	foreach($result as $k=>$v)
	{
       $where.=" or find_in_set({$v['id']},a.attrid)";
	}

	return $where;

}
//读取文章评论(HTML)
function getArticlePinLun($id)
{
    global $dsql;
    $sql = "select * from #@__comment where articleid = '$id' and typeid='4' order by addtime desc limit 2";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $membername = getMemberName2($row['memberid']);
        $out.='<div class="more-dz">
                    	<p class="p1"><span>'.$membername.'</span>'.MyDate('Y-m-d H:i:s',$row['addtime']).'</p>
											<p class="p2">回复：'.$row['content'].'</p>
                    </div>';
    }
    return $out;

}

//获取会员名
function getMemberName2($mid)
{
    Helper_Archive::loadModule('common');
    $model = new CommonModule('#@__member');
    $membername = $model->getField('nickname',"mid='$mid'");
    return $membername ? $membername : '游客';

}

