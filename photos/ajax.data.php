<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/photo.func.php");
//$dopost='getdata';
//$num=1;
if($dopost=='getdata')
{
	if($childid!=0)
	{
	   $where.=" and FIND_IN_SET($childid,kindlist)";	
	}
	if($attrid!=0)
	{
	   $where.=" and FIND_IN_SET($attrid,attrid)";	
	}
	
	$limit=($num-1)*6;
	
	$sql="select * from sline_photo where webid is not null {$where}  order by boutique desc,orderid asc limit {$limit},6";

	$res = $dsql->getAll($sql);

    $str = '';
    foreach($res AS $row)
    {
    	$row['shownum'] = empty($row['shownum']) ? mt_rand(21,49) : $row['shownum'];
		$row['litpic'] = !empty($row['headimg']) ?  $row['headimg'] : $GLOBALS['cfg_templets_skin'] . "/images/pic_tem.gif";
		$row['headimgid']=empty($row['headimgid']) ? 0 : $row['headimgid'];
		//$row['litpic']=$GLOBALS['cfg_templets_skin'] . "/images/pic_tem.gif";
		//$str.="<div><img src=\"{$row['litpic']}\" width=\"210\"/>{$row['photoname']}</div>";
		
	$str.="<div class=\"item\">";
        $str.="<div class=\"item_t\">";
        $str.="<div class=\"img\" id=\"aaa\">";
        $str.="<a href=\"/photos/show_{$row['aid']}_{$row['headimgid']}.html\"><img class=\"resizeme\" alt=\"{$row['title']}\" src=\"{$row['litpic']}\" width=\"210\" /></a><span class=\"price\"><h3>{$row['title']}</h3><span>关注：{$row['shownum']}</span></span></div>";
              
            
            
        $str.="<div class=\"title\"><span>{$row['title']}</span></div></div>";
          
        $str.="<div class=\"item_b clearfix\"><div class=\"items_likes fl\">";
            
        $str.="<a href=\"#\" class=\"like_btn\"><em class=\"bold\">{$row['shownum']}</em></a></div>";
            
        $str.="<div class=\"items_comment fr\"><a href=\"#\">评论</a><em class=\"bold\">(".getPinLunNum($row['aid'],$row['webid']).")</em></div>";
        $str.="<div class=\"commentary\">";
               $str.=getPinLun($row['aid'],$row['webid']);
                
              
            $str.="</div>";
          $str.="</div>";
         $str.="</div>";
	
    }
	echo $str;
}
if($dopost=='addfavorite')
{
	
	$sql="update #@__photo set favorite=favorite+1 where id=$photoid";
	$result=$dsql->ExecuteNoneQuery($sql);
	 if($result)
	   echo 'ok';
	 else 
	   echo 'no';  
	   
	
}