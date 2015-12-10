<?php 

require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once SLINEINC."/view.class.php";
require_once(dirname(__FILE__)."/photo.func.php");
$typeid=6; //相册栏目
$pv = new View($typeid);
Helper_Archive::loadModule('common');

if(!isset($id)) exit('Wrong Id');
$aid=RemoveXSS($id);//防止跨站攻击
updateVisit($aid,$typeid);

$row = getPhotoInfo($aid);
if(empty($row['id']))
{
	head404();
}

$photoid = $row['id'];
$destlist=getPhotoChildDest($dest_id);

if(is_array($row))
{
	
	$row['num']=getPhotoNum($aid);
	$row['subname']=$row['title'];
    $row['litpic']=!empty($row['litpic'])?$row['litpic']:getDefaultImage();
    
	//获取目的地
	$destlist=$destlist=getPhotoChildDest($row['kindlist'],true); 
    
	//SEO优化信息
    $row['seodescription']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
    $row['seokeyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
	$row['seotitle']=!empty($row['seotitle'])?$row['seotitle']:$row['title'];
	$row['commenthomeid']=$row['id'];
	
	//图片
	$picturelist=getPhotoPictures($row['id'],'lit240');  //列表

	 
	if(empty($imgid))  //大图
	 {

		$firstpic=$picturelist[0];
	 }
	 else
	 {
		 $firstpic=$dsql->GetOne("select * from #@__photo_picture where id=$imgid");
		 
		 $prevpic=$dsql->GetOne("select * from #@__photo_picture where pid='{$row['id']}' and id<'$imgid' order by id desc");

		 $nextpic=$dsql->GetOne("select * from #@__photo_picture where pid='{$row['id']}' and id>'$imgid' order by id asc");
	 }
	$imgid=$firstpic['id']; 
	
	$row['prepichtml']=$prevpic['id'];
	
	$row['nextpichtml']=!empty($nextpic)?"<div class=\"ad-next\" onclick=\"window.open('/photos/show_{$aid}_{$nextpic['id']}.html','_self')\" style=\"cursor: url({$GLOBALS['cfg_templets_skin']}/images/img_next.cur), auto; height: 100%;\"><div class=\"ad-next-image\" style=\"opacity: 0.7; display: none;\"></div></div>":'';
	$row['prevpichtml']=!empty($prevpic)?"<div class=\"ad-prev\" onclick=\"window.open('/photos/show_{$aid}_{$prevpic['id']}.html','_self')\" style=\"cursor: url({$GLOBALS['cfg_templets_skin']}/images/img_pre.cur), auto; height: 100%;\"><div class=\"ad-prev-image\" style=\"opacity: 0.7; display: none;\"></div></div>":'';
	
	
	$row['bigpic']=empty($firstpic['bigpic']) ? str_replace('litimg','allimg',$firstpic['litpic']) :$firstpic['bigpic'];  
	$row['pkname'] = get_par_value($row['kindlist'],$typeid);	
	
	//获取相邻相册
	$prephoto=getPhotoSibling($aid,0,0);
	$nextphoto=getPhotoSibling($aid,0,1,$prephoto['aid']);
	

	
    foreach($row as $k=>$v)
    {
	   $pv->Fields[$k] = $v;
    }
}

$typename=GetTypeName($typeid);//获取栏目名称.
$pv->Fields['typename'] = $typename;
$pv->Fields['tagword'] = $row['tagword'];
$pv->Fields['title']=!empty($row['seotitle'])?$row['seotitle']:$row['title'];

//获取上级开启了导航的目的地
getTopNavDest($row['kindlist']);

//$articletitle="第({$pv->Fields['imgthis']})张";

//$pv->Fields['title'].=$articletitle;
$templet = Helper_Archive::getUseTemplet('photo_show');//获取首页使用模板
$templet = !empty($templet) ? $templet : SLINETEMPLATE ."/".$cfg_df_style ."/" ."photos/" ."photo_show.htm";
$pv->SetTemplet($templet);
$pv->Display();
   

?>
