<?php
require_once (dirname(dirname(dirname(__FILE__))) . "/stourtravel/config.php"); 

$headurl=$GLOBALS['cfg_cmsurl']."/stourtravel/";

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>首页自定义导航-插件管理</title>
<link href="<?php echo $headurl; ?>css/Admin_STYLE.css" rel="stylesheet" type="text/css">
<link href="<?php echo $headurl; ?>css/msgbox.css" rel="stylesheet"  type="text/css" />
<link href="<?php echo $headurl; ?>css/jbox.css" rel="stylesheet"  id="skin" type="text/css" />
<link href="sline_nav.css" rel="stylesheet" type="text/css">
<script language="javascript" src="<?php echo $headurl; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $headurl; ?>js/jquery.jBox.min.js"></script>
<script type="text/javascript" src="<?php echo $headurl; ?>js/jquery.jBox.js"></script>
<script language="javascript" src="<?php echo $headurl; ?>js/msgbox.js" type="text/javascript"></script>
<script language="javascript" src="plugin_nav.js" type="text/javascript"></script>


</head>
<style type="text/css">
 #popupcontent{ 
    position:absolute; 
    border:1px solid #000000; 
    line-height:17px; 
    background-color:#F7F7F4; 
    visibility:hidden; 
    cursor:default; 
    padding:2 5 2 5px; 
}
</style>
<body>
<div id="breadnav">
 <span  class="title_top">当前位置：站点设置 </span>&raquo;
 <span  class="title_top"> <a href="/stourtravel/plugin_info.php">应用插件</a> </span>&raquo;
 <span class="onlink">首页自定义导航设置</span>  
</div>
<form  method="post" id="kindform">

	   <?php
	      GetKindList($webid);
	   ?>
 
  <!--  <td align="center"><input name="Submit" type="button" onclick="AjaxSaveKind()" class="btn_sub" value="确定提交" onMouseOver="this.className='btn_sub_1'" onMouseOut="this.className='btn_sub'" />
&nbsp;&nbsp;
<input name="Submit2" type="reset" class="btn_sub" value="重新填写" onmouseover="this.className='btn_sub_1'" onmouseout="this.className='btn_sub'" /></td>-->
  </tr>
  </table>

  &nbsp;&nbsp;&nbsp;&nbsp;
</form>
<div id="popupcontent"></div> 

<?php
 //子站各栏目分类导航
function GetKindList($webid)
{
	  global $dsql,$sys_webid;
		
		 echo "<table width='100%' cellpadding='0' cellspacing='0' id='kindtable' class='tablelist'>";
	     echo " <tr class='tdbg'>";
	     echo " <td width='5%' align='center' style='padding-left:5px' class='header'>显示排序</td>";
	     echo " <td width='10%' height='27' align='left' class='header' >导航名</td>";
		
		 echo "<td width='25%' align='left' class='header'>链接地址</td>";
		 echo "<td width='10%' align='left' class='header'>文字颜色</td>";
		  echo "<td width='5%' align='left' class='header'>开启/关闭</td>";
		 echo "<td width='5%' align='left' class='header'>管理</td>";
	   
	     echo "</tr>";
		

	       $sql="select id,kindname,linkurl,color,displayorder,isopen from #@__plugin_nav where pid=0 and webid=$webid order by displayorder asc";

		 $dsql->SetQuery($sql);
         $dsql->Execute();
		  while($row = $dsql->GetArray())
         {
		  
		  
		   $kindname="<input type='text' name='kindname' value=\"{$row['kindname']}\" onblur=\"kind_savekind('{$row['id']}',this.value)\">";
		   
		   $kindurl="<input type='text' name='kindurl' style=\"width:360px;\" value=\"{$row['linkurl']}\" onblur=\"kind_saveurl('{$row['id']}',this.value)\">";
		  
		   $img= "<img style='cursor:pointer;padding-right:5px;' id='img{$row['id']}' onClick='ShowKindSon(this,{$row['id']})' src='img/explode.png' width=10 height=10 />"; 
		  
		   $displayorder=($row['displayorder']=='9999') ? '' : $row['displayorder'];
	       echo "<tr class='tdbg' onMouseOver=\"this.className='tdbgs'\" onMouseOut=\"this.className='tdbg'\">";
		   echo "<td width='5%' align='center' style='padding-left:5px'><span style=\"display:block;width:80px;height:23px;margin:auto;\"  class=\"name{$row['id']}\" onClick=\"kind_tdclick('{$row['id']}')\">{$displayorder}</span></td>";
           echo "<td width='10%' align='left'  height=30>";
		  
		   echo "<div>{$img}<span class='areaname'>{$kindname}</span></div></td>";
           
		    
			 echo "<td width='25%' align='left'>";
			  
		     echo "<span class='areaname'>{$kindurl}</span>";
			 			 
			 echo "</td>";
			
			 $color="<input name=\"color\" type=\"text\" id=\"color\" size=\"12\"  onclick=\"colordialog(event)\"  value=\" {$row['color']}\" onMouseOver=\"this.className='txts'\" onMouseOut=\"this.className='txt'\" class=\"txt\" onblur=\"kind_savecolor('{$row['id']}',this.value)\" />";
			 echo "<td width='10%' align='left'>{$color}</td>";
			 
			  echo "<td width='5%' align='center'>";
			 
			  $stropen=GetSymbolHtml($row['id'],$row['isopen']);
			  echo $stropen;
			  echo "</td>";

			 echo "<td width='10%' align='left' id='td{$cid}'>&nbsp;</td>";
             echo "</tr>";
		    
			}	
			
			/*echo "<tr class='tdbg'><td class='order'>&nbsp;</td><td colspan='4'><div style=''><div class='lastnode'> <input type='button' class='btn_sub'  onClick='javascript:addchild_child(this,{$getrow['id']})' value='自定义链接' onMouseOver=\"this.className='btn_sub_1'\" onMouseOut=\"this.className='btn_sub'\"></div></div></td></tr>";	  */ 
		    //echo "</td>";
            echo "</table>";

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

 ?>
 <script language=javascript>


function colordialogmouseout(obj){
    obj.style.borderColor="";
    obj.bgColor="";
}

function colordialogmouseover(obj){
    obj.style.borderColor="#0A66EE";
    obj.bgColor="#EEEEEE";
}
var baseText = null; 
var where = ""; // which link 
var xNum = 10; 
var yNum = 10; 
var w = 160; 
var h = 140; 
var xCoord,yCoord; 
function _test(evt) 
{ 
var src = evt.srcElement || evt.target; 
return src; 
} 

function checkwhere(e) { 
if (document.layers){ 
xCoord = e.x - xNum; 
yCoord = e.y + yNum; 
} 
else if (document.all){ 
xCoord = event.clientX - xNum; 
yCoord = event.clientY + yNum; 
} 
else if (document.getElementById){ 
xCoord = e.clientX - xNum; 
yCoord = e.clientY + yNum; 
} 

} 
document.onmousedown = checkwhere; 
function colordialogmousedown(color){ 
   ecolorPopup.value=color; 
    document.getElementById('popupcontent').blur(); 
//document.getElementById("neon_color").style.color = color; 
    document.getElementById("popupcontent").style.visibility = "hidden"; 
} 
function colordialog(event){ 
if(event.X) 
    { 
        var posX = event.x; 
    } 
    else 
    { 
        var posX = event.clientX; 
    } 
    if(event.Y) 
    { 
        var posY = event.y+10; 
    } 
    else 
    { 
        var posY = event.clientY+10; 
    } 
var popUp = document.getElementById("popupcontent"); 

var bottomedge = document.body.clientHeight.posY; 
        popUp.style.left = document.body.scrollLeft + posX - popUp.offsetWidth+"px"; 

    if (bottomedge < document.getElementById("popupcontent").offsetHeight) 
        popUp.style.top = document.body.scrollTop + posY- popUp.offsetHeight+"px"; 
    else 
        popUp.style.top = document.body.scrollTop + posY+"px"; 

    popUp.style.width = w + "px"; 
    popUp.style.height = h + "px"; 

    var e = _test(event); 
      e.onkeyup=colordialog; 
      ecolorPopup = e; 

    var ocbody; 
     
var oPopBody = popUp;
     
var colorlist=new Array(40); 
oPopBody.style.backgroundColor = "#f9f8f7"; 
oPopBody.style.border = "solid #999999 1px"; 
oPopBody.style.fontSize = "12px"; 

    colorlist[0]="#000000";    colorlist[1]="#993300";    colorlist[2]="#333300";    colorlist[3]="#003300";
    colorlist[4]="#003366";    colorlist[5]="#000080";    colorlist[6]="#333399";    colorlist[7]="#333333";

    colorlist[8]="#800000";    colorlist[9]="#FF6600";    colorlist[10]="#808000";colorlist[11]="#008000";
    colorlist[12]="#008080";colorlist[13]="#0000FF";colorlist[14]="#666699";colorlist[15]="#808080";

    colorlist[16]="#FF0000";colorlist[17]="#FF9900";colorlist[18]="#99CC00";colorlist[19]="#339966";
    colorlist[20]="#33CCCC";colorlist[21]="#3366FF";colorlist[22]="#800080";colorlist[23]="#999999";

    colorlist[24]="#FF00FF";colorlist[25]="#FFCC00";colorlist[26]="#FFFF00";colorlist[27]="#00FF00";
    colorlist[28]="#00FFFF";colorlist[29]="#00CCFF";colorlist[30]="#993366";colorlist[31]="#CCCCCC";

    colorlist[32]="#FF99CC";colorlist[33]="#FFCC99";colorlist[34]="#FFFF99";colorlist[35]="#CCFFCC";
    colorlist[36]="#CCFFFF";colorlist[37]="#99CCFF";colorlist[38]="#CC99FF";colorlist[39]="#FFFFFF";
   var currentcolor=e.value;

    ocbody = "";
    ocbody += "<table CELLPADDING=0 CELLSPACING=3>";
    ocbody += "<tr height=\"20\" width=\"20\"><td align=\"center\"><table style=\"border:1px solid #808080;\" width=\"12\" height=\"12\" bgcolor=\""+currentcolor+"\"><tr><td></td></tr></table></td><td bgcolor=\"eeeeee\" colspan=\"7\" style=\"font-size:12px;\" align=\"center\">当前颜色&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"#\" onclick=\"hidePopup()\">关闭</a></td></tr>";
    for(var i=0;i<colorlist.length;i++){
        if(i%8==0)
            ocbody += "<tr>";
        ocbody += "<td width=\"14\" height=\"16\"  style=\"border:1px solid;\" onMouseOut=\"colordialogmouseout(this);\" onMouseOver=\"colordialogmouseover(this);\" onMouseDown=\"colordialogmousedown('"+colorlist[i]+"')\" align=\"center\" valign=\"middle\"><table style=\"border:1px solid #808080;\" width=\"12\" height=\"12\" bgcolor=\""+colorlist[i]+"\"><tr><td></td></tr></table></td>";
        if(i%8==7)
            ocbody += "</tr>";
    }
    //ocbody += "<tr><td align=\"center\" height=\"22\" colspan=\"8\" onMouseOut=\"colordialogmouseout(this);\" onMouseOver=\"colordialogmouseover(this);\" style=\"border:1px solid;font-size:12px;cursor:default;\" onMouseDown=\"colordialogmore()\">其它颜色</td></tr>";
    ocbody += "</table>";

    oPopBody.innerHTML=ocbody;

    oPopBody.style.visibility = "visible"; 

} 
function hidePopup() 
{ 
    document.getElementById('popupcontent').blur(); 
    document.getElementById("popupcontent").style.visibility = "hidden"; 
    
} 


</script>
</body>







</html>
