<?php
require_once (dirname(dirname(dirname(__FILE__))) ."/stourtravel/config.php"); 

if($dopost=='GetKindSon')
{
      $td1=array();
      $td2=array();
      $td3=array();
      $td4=array();
	  $td5=array();
	  $td6=array();
      $ids=array();
      $output=array();
	 
	  $sql="select id,kindname,linkurl,color,displayorder,isopen from #@__plugin_nav where pid=$pid and webid=$sys_webid order by displayorder asc";
	  $dsql->SetQuery($sql);
      $dsql->Execute();

	   while($row=$dsql->GetArray())
       {
		   $cid=$row['id'];
		   $displayorder=($row['displayorder']=='9999') ? '' : $row['displayorder'];
		   $kindname="<input type='text' name='kindname' value=\"{$row['kindname']}\" onblur=\"kind_savekind('{$row['id']}',this.value)\">";
		   $kindurl="<input type='text' name='kindurl' style=\"width:360px;\" value=\"{$row['linkurl']}\" onblur=\"kind_saveurl('{$row['id']}',this.value)\">";
		   
		   $color="<input name=\"color\" type=\"text\" id=\"color\" size=\"12\"  onclick=\"colordialog(event)\" readonly=\"true\" value=\" {$row['color']}\" onMouseOver=\"this.className='txts'\" onMouseOut=\"this.className='txt'\" class=\"txt\" onblur=\"kind_savecolor('{$row['id']}',this.value)\" />";
		   $cell1="<span style=\"display:block;width:80px;height:23px;margin:auto;\" class=\"name{$row['id']}\" onClick=\"kind_tdclick('{$row['id']}')\">{$displayorder}</span>";
		   $cell2="<div style='padding-left:30px;'><span class='areaname'>{$kindname}</span></div>";
		   $cell3="<span class='areaname'>{$kindurl}</span>";
		   $cell4=$color;
		   $cell5=GetSymbolHtml($row['id'],$row['isopen']);
		   $cell6="<span><a href='#' onclick=\"javascript:DeleteKind(this,{$row['id']})\">删除</a></span>"; 
		   
		   array_push($td1,$cell1);
		   array_push($td2,$cell2);
		   array_push($td3,$cell3);
		   array_push($td4,$cell4);
		   array_push($td5,$cell5);
		   array_push($td6,$cell6);
		   array_push($ids,$row['id']);
	   
	}
		$cell1= "&nbsp;";
		$cell2= "<div style='padding-left:40px;'><div class='lastnode'> <input type='button' class='btn_sub'  onClick='javascript:addchild(this,{$pid})' value='自定义链接' onMouseOver=\"this.className='btn_sub_1'\" onMouseOut=\"this.className='btn_sub'\"></div></div>";
		$cell3= "&nbsp;";
		$cell5= "&nbsp;";
		$cell4= "&nbsp;";
		$cell6= "&nbsp;";
		   array_push($td1,$cell1);
		   array_push($td2,$cell2);
		   array_push($td3,$cell3);
		   array_push($td4,$cell4);
		   array_push($td5,$cell5);
		   array_push($td6,$cell6);
	
	   array_push($output,$td1,$td2,$td3,$td4,$td5,$td6,$ids);
	   $json_string=json_encode($output);
	   print_r($json_string);
   
}

//添加子链接

if($dopost=="AddNavChild")
{
   $output=array();
   $sql="insert into #@__plugin_nav (kindname,pid,linkurl,color,webid) values('自定义','{$pid}','','','$sys_webid')";

   if( $dsql->ExecuteNoneQuery($sql))
   {
      $id=$dsql->GetLastID();
	
	  $kindname="<input type='text' name='kindname' value=\"自定义\" onblur=\"kind_savekind('{$id}',this.value)\">";
	  $displayorder='';
	  $kindurl="<input type='text' name='kindurl' style=\"width:360px;\" value=\"\" onblur=\"kind_saveurl('{$id}',this.value)\">";
	   $color="<input name=\"color\" type=\"text\" id=\"color\" size=\"12\"  onclick=\"colordialog(event)\" readonly=\"true\" value=\" \" onMouseOver=\"this.className='txts'\" onMouseOut=\"this.className='txt'\" class=\"txt\" onblur=\"kind_savecolor('{$id}',this.value)\" />";
	  $cell1="<span  class=\"name{$id}\" onClick=\"kind_tdclick('{$id}')\">&nbsp;&nbsp;</span>";
	  $cell2="<div style='padding-left:30px;'><span class='areaname'>{$kindname}</span></div>";
      $cell3="<span class='areaname'>{$kindurl}</span>";
	  $cell4=$color;
	  $cell5=GetSymbolHtml($id,1);
      $cell6="<span><a href='#' onclick=\"javascript:DeleteKind(this,{$row['id']})\">删除</a></span>"; 
		  
	   array_push($output,$cell1,$cell2,$cell3,$cell4,$cell5,$id);
	  $json_string=json_encode($output);
	   print_r($json_string);
   }

}

if($dopost=='kind_saveorder') //保存排序
{
	
	  $updatesql="update #@__plugin_nav set displayorder='{$displayorder}' where id='{$kindid}'";
	  
	 echo $updatesql;
	  $dsql->ExecuteNoneQuery($updatesql);

}
//分类名称保存操作

if($dopost=='kind_savekind') 
{
	 
	  $updatesql="update #@__plugin_nav set kindname='{$kindname}' where id='{$kindid}'";
	  
	  $dsql->ExecuteNoneQuery($updatesql);

}

//URL链接保存操作

if($dopost=='kind_saveurl') 
{
	 if(!preg_match("/http:\/\//",$linkurl))
     {
	    $linkurl="http://".$linkurl;
     }
	  $updatesql="update #@__plugin_nav set linkurl='{$linkurl}' where id='{$kindid}'";
	  $dsql->ExecuteNoneQuery($updatesql);

}

//颜色链接保存操作

if($dopost=='kind_savecolor') 
{
	 
	  $color=trim($color);
	  $updatesql="update #@__plugin_nav set color='{$color}' where id='{$kindid}'";
	
	
	  
	  $dsql->ExecuteNoneQuery($updatesql);

}

//删除分类
if($dopost=="DeleteKind")
{
   $sql="delete from #@__plugin_nav where id='$id'";
   if(!$dsql->ExecuteNoneQuery($sql))
   {
	   echo "false";
	   exit();
   }	
   echo "ok";
}



//获取开启/关闭符号HTML
function GetSymbolHtml($kindid,$value)
{
	$openvalue=$value;
    $colorcode=($openvalue=='1') ? '#f60' : 'gray'; //颜色
	$symbol=($openvalue=='1') ? '&radic;' : '&times;'; //符号
	
     $contain="toggle_tog_kind_open{$kindid}";//容器


	$str="<div class=\"toggle\" id=\"{$contain}\">";
	$str.="<span  onClick=\"list_kind_toggle('{$contain}','{$kindid}','{$openvalue}')\" style=\"color:{$colorcode}\">{$symbol}</span></div>";
	return $str;
	
}
//分类开启与关闭操作
if($dopost == 'tog_kind_open')
{

	$updatesql="update #@__plugin_nav set isopen='$status' where id='$kindid'";
	
	if(!$dsql->ExecuteNoneQuery($updatesql))
	{
		echo 'no';
	}
	else
	{
		echo 'ok';
	}
}


?>