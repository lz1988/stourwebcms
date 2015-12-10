<?php

function getTuanInfo($aid)
{
	global $dsql,$sys_webid;
	$sql="select * from #@__tuan where webid='$sys_webid' and aid={$aid}";
	
	
	return $dsql->GetOne($sql); 
}
function getImgList($piclist)
{
	$piclist=trim($piclist);
    $pic = '';
	if(empty($piclist))
	{
	   global $cfg_df_img;
	   $pic="<img src='{$cfg_df_img}' width='580' height='385'/>";
	   return $pic;
	}
	$pic_arr=explode(',',$piclist);
	foreach($pic_arr as $v)
	{
		if(!empty($v))
		{
            $image = explode('||',$v);
			$pic.="<img src='{$image[0]}' width='580' height='385'/>";
		}
	}
	return $pic;
}
function getTuanUrl($val=null,$key=null,$exclude=null,$arr=array('attrid','status'),$url="/tuan/",$table="#@__tuan_attr")
{
    
	return Helper_Archive::getUrlStatic($val,$key,$exclude,$arr,$url,$table);
}
//获取attrid的选中状态，如果选中，则返回参数1，也就是$class
function getTuanAttrUrlCls($class,$attrid=null,$groupid=null,$table='#@__tuan_attr')
{
	 return Helper_Archive::getAttrUrlCls($class,$attrid,$groupid,$table);	
}
function getTuanChildDest($destid,$flag=false)
{
	global $dsql;
	
	if($flag)
	{
		$dest_arr=explode(',',$destid);
		sort($dest_arr);
		$destid=array_pop($dest_arr);
	}
	
	
	$destid=empty($destid)?0:$destid;
	$sql="select a.id,a.kindname from #@__destinations a left join #@__tuan_kindlist b on a.id=b.kindid where a.isopen=1 and a.pid='$destid' order by b.displayorder";
	$result=$dsql->getAll($sql);
	
	if(empty($result))
	{
		$sql2="select pid from #@__destinations where id=$destid";
		$re=$dsql->GetOne($sql2);
		$sql="select a.id,a.kindname from #@__destinations a left join #@__tuan_kindlist b on a.id=b.kindid where a.isopen=1 and a.pid={$re['pid']} order by b.displayorder";
		$result=$dsql->getAll($sql);
	}
	return $result;
}
function  getTuanMianbao($destid)
{
	 $result=Helper_Archive::getParentDestNav($destid);
	 foreach($result as $k=>$v)
	 {
		 $str.=' &gt; <a href="/tuan/index.php?dest_id='.$v['id'].'">'.$v['kindname'].'</a>';
	 }
	 return $str;      

}
function getTuanDestInfo($destid)
{
    global $dsql;
    $sql="select a.kindname as shortname,b.seotitle,b.description,b.keyword from #@__destinations as a inner join #@__tuan_kindlist b on a.id=b.kindid where a.id={$destid} and isopen='1'";

    $row=$dsql->GetOne($sql);



    if(empty($row['seotitle']))
    {
        $row['seotitle']=!empty($seotitle) ? $seotitle : $row['shortname'];
    }
    if(empty($row['description']))
    {
        $row['description']=	!empty($description) ? $description : '';
    }

    return $row;
}

	