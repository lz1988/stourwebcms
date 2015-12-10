<?php 
require_once (dirname(dirname(dirname(__FILE__)))."/stourtravel/config.php"); 

$headurl=$GLOBALS['cfg_cmsurl']."/stourtravel/";
if(!isset($dopost))
{
	$sql="select * from #@__plugin_autotitle";
	$arr=$dsql->getAll($sql);
	$out=array();
	foreach($arr as $row)
	{
		$out[$row['name']]=$row['value'];
		
	}
}
if($dopost=='save')
{
	 foreach($_POST as $k=>$v)
     {
		 $k = preg_replace("#^edit_#", "", $k);
		 $sql="UPDATE `#@__plugin_autotitle` SET `value`='$v' WHERE name='$k'";
		//echo $sql;
		$dsql->ExecuteNoneQuery($sql);
	 }
	 ReWriteCache();
	 echo 'ok';	
	 exit;

	
}
//更新配置函数
function ReWriteCache()
{
    global $dsql;
	 $configfile=SLINEDATA.'/autotitle.cache.inc.php';
	// echo $configfile;
   /* if(!is_writeable($configfile))
    {
        echo "配置文件'{$configfile}'不支持写入！";
        exit();
    }*/
	
    $fp = fopen($configfile,'w');
    flock($fp,3);
    fwrite($fp,"<"."?php\r\n");
	$sql="SELECT `name`,`value` FROM `#@__plugin_autotitle`  ORDER BY id ASC";
	
    $dsql->SetQuery($sql);
    $dsql->Execute();
    while($row = $dsql->GetArray())
    {

	     fwrite($fp,"\${$row['name']} = '".str_replace("'",'',$row['value'])."';\r\n");

    }
    fwrite($fp,"?".">");
    fclose($fp);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>智能标题优化设-应用插件</title>
<link href="../../stourtravel/css/Admin_STYLE.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../../stourtravel/js/msgbox.js" type="text/javascript"></script>
<script language="javascript" src="../../stourtravel/js/jquery1.3.2.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../stourtravel/css/msgbox.css" />
<style type="text/css">
#brg{ width:100%; height:200%; background:#333; position:absolute; top:0; left:0; filter:alpha(opacity=60); -moz-opacity:0.6; opacity: 0.6; position:absolute;  top:0; left:0; display:none; z-index:99;}
</style>
</head>
<body>
<div id="brg"></div>
<div id="breadnav">
 <span  class="title_top">当前位置：站点设置 </span>&raquo;
 <span  class="title_top"> <a href="/stourtravel/plugin_info.php">应用插件</a> </span>&raquo;
 <span class="onlink">智能标题优化设置</span>  
</div>

      			<table width="100%" cellpadding="0" cellspacing="0" class="edittable">
	  				
                    <tr class="tdbg">
                      	<td width="12%" class="bt">目的地SEO标题：
                      </td>
                      	<td width="56%" align="left">
                        	<input name="cfg_dest_title" type="text" class="txt" id="cfg_dest_title" value="<?php echo $out['cfg_dest_title']; ?>" size="80" maxlength="126" onMouseOver="this.className='txts'" onMouseOut="this.className='txt'" />
                        </td>
                      	<td width="32%" align="left" valign="bottom">
                      	<span class="notice" onMouseOver="this.className='notices'" onMouseOut="this.className='notice'">在目的地页面显示的标题,按分类名编写一段文字,分类名用大写XXX代替,如:XXX旅游报价_XXX酒店预订_XXX旅游租车_XXX旅游攻略.</span></td>
                    </tr>
                    <tr class="tdbg">
                      	<td height="60" class="bt">目的地描述：
                      </td>
                      	<td align="left">
                        	<textarea name="cfg_dest_desc" type="text" class="description" id="cfg_dest_desc"><?php echo $out['cfg_dest_desc']; ?></textarea>
                        </td>
                      	<td align="left" valign="bottom"><span class="notice">在目的地页面的页面描述,按分类名编写一段文字,分类名用大写XXX代替,如:XXX旅游介绍.</span></td>
                    </tr>
                    <tr class="tdbg">
                      	<td height="54" class="bt">线路类SEO标题：
                        </td>
                      	<td align="left">
                        	<input name="cfg_line_title" type="text" class="txt" id="cfg_line_title" value="<?php echo $out['cfg_line_title']; ?>" size="80" maxlength="126" onMouseOver="this.className='txts'" onMouseOut="this.className='txt'" />
                      	</td>
                      	<td align="left" valign="bottom"><span class="notice">分类名用大写XXX代替,如:XXX旅游线路报价</span></td>
                    </tr>
                    <tr class="tdbg">
                      	<td height="51" class="bt">线路类描述：
                        </td>
                      	<td align="left"><textarea name="cfg_line_desc" type="text" class="description" id="cfg_line_desc"><?php echo $out['cfg_line_desc'] ?></textarea></td>
                      	<td align="left" valign="bottom"><span class="notice">分类名用大写XXX代替,如:XXX旅游线路报价描述</span></td>
                    </tr>
                    <tr class="tdbg">
                      	<td height="49" class="bt">酒店类SEO标题:
                    </td>
                      	<td align="left"><input name="cfg_hotel_title" type="text" class="txt" id="cfg_hotel_title" value="<?php echo $out['cfg_hotel_title'] ?>" size="80" maxlength="126" onmouseover="this.className='txts'" onmouseout="this.className='txt'" /></td>
                      	<td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="54" class="bt">酒店类描述：</td>
                      <td align="left"><textarea name="cfg_hotel_desc" type="text" class="description" id="cfg_hotel_desc" ><?php echo $out['cfg_hotel_desc'] ?></textarea></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      	<td height="54" class="bt">租车类SEO标题:
                        </td>
                      	<td align="left">
                        	<input name="cfg_car_title" type="text" class="txt" id="cfg_car_title" value="<?php echo $out['cfg_car_title']; ?>" size="80" maxlength="126" onMouseOver="this.className='txts'" onMouseOut="this.className='txt'" />
                        </td>
                      	<td align="left" valign="bottom"><span class="notice">同上</span></td>
                   	</tr>
                    <tr class="tdbg">
                      	<td height="57" class="bt">租车类描述：：
                        </td>
                      	<td align="left"><textarea name="cfg_car_desc" type="text" class="description" id="cfg_car_desc" ><?php echo $out['cfg_car_desc']; ?></textarea></td>
                      	<td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="59" class="bt">文章类SEO标题:</td>
                      <td align="left"><input name="cfg_article_title" type="text" class="txt" id="cfg_article_title" value="<?php echo $out['cfg_article_title']; ?>" size="80" maxlength="126" onmouseover="this.className='txts'" onmouseout="this.className='txt'" /></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="55" class="bt">文章类描述：</td>
                      <td align="left"><textarea name="cfg_article_desc" type="text" class="description" id="cfg_article_desc"><?php echo $out['cfg_article_desc']; ?></textarea></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="57" class="bt">景点类SEO标题：</td>
                      <td align="left"><input name="cfg_spot_title" type="text" class="txt" id="cfg_spot_title" value="<?php echo $out['cfg_spot_title']; ?>" size="80" maxlength="126" onmouseover="this.className='txts'" onmouseout="this.className='txt'" /></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="47" class="bt">景点类描述：</td>
                      <td align="left"><textarea name="cfg_spot_desc" type="text" class="description" id="cfg_spot_desc"><?php echo $out['cfg_spot_desc'] ?></textarea></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="57" class="bt">相册类SEO标题：</td>
                      <td align="left"><input name="cfg_photo_title" type="text" class="txt" id="cfg_photo_title" value="<?php echo $out['cfg_photo_title']; ?>" size="80" maxlength="126" onmouseover="this.className='txts'" onmouseout="this.className='txt'" /></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td height="53" class="bt">相册类描述：</td>
                      <td align="left"><textarea name="cfg_photo_desc" type="text" class="description" id="cfg_photo_desc"><?php echo $out['cfg_photo_desc']; ?></textarea></td>
                      <td align="left" valign="bottom"><span class="notice">同上</span></td>
                    </tr>
                    <tr class="tdbg">
                      <td class="bt">&nbsp;</td>
                      <td align="left">&nbsp;</td>
                      <td align="left" valign="bottom">&nbsp;</td>
                    </tr>
               </table>    
       
   <table width="100%" cellpadding="0" cellspacing="0" class="con">
       <tr>
           <td align="center" colspan="3">
           		<input name="Submit" type="button" class="btn_sub" onMouseOver="this.className='btn_sub_1'" onMouseOut="this.className='btn_sub'" value="确定提交" id="lay" onclick="vote('save')">&nbsp;&nbsp;
              	
                 <input type="hidden" name="webid" id="webid" value="<?php echo $webid; ?>">
           </td>
       </tr>
   </table>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
      $("#lay").click(function(){
		  
      $("#brg").css("display","block");
	  //$(body).appendTo("#brg");
   //$("#testdiv").load("test.html");
   });
   });
function vote(type)
{
	var cfg_dest_title=$("#cfg_dest_title").val();//获取内容
	var cfg_dest_desc=$("#cfg_dest_desc").val();//获取内容
	var cfg_line_title=$("#cfg_line_title").val();//获取内容
	var cfg_line_desc=$("#cfg_line_desc").val();//获取内容
	var cfg_hotel_title=$("#cfg_hotel_title").val();//获取内容
	var cfg_hotel_desc=$("#cfg_hotel_desc").val();//获取内容
	var cfg_car_title=$("#cfg_car_title").val();//获取内容
	var cfg_car_desc=$("#cfg_car_desc").val();//获取内容
	
	var cfg_article_title=$("#cfg_article_title").val();//获取内容
	var cfg_article_desc=$("#cfg_article_desc").val();//获取内容
	var cfg_spot_title=$("#cfg_spot_title").val();//获取内容
	var cfg_spot_desc=$("#cfg_spot_desc").val();//获取内容
	var cfg_photo_title=$("#cfg_photo_title").val();//获取内容
	var cfg_photo_desc=$("#cfg_photo_desc").val();//获取内容

	var webid=$("#webid").val();
	var formdata="dopost="+type+"&edit_cfg_dest_title="+cfg_dest_title+"&edit_cfg_dest_desc="+cfg_dest_desc+"&edit_cfg_line_title="+cfg_line_title+"&edit_cfg_line_desc="+cfg_line_desc+"&edit_cfg_hotel_title="+cfg_hotel_title+"&edit_cfg_hotel_desc="+cfg_hotel_desc+"&edit_cfg_car_title="+cfg_car_title+"&edit_cfg_car_desc="+cfg_car_desc+"&edit_cfg_article_title="+cfg_article_title+"&edit_cfg_article_desc="+cfg_article_desc+"&edit_cfg_spot_title="+cfg_spot_title+"&edit_cfg_spot_desc="+cfg_spot_desc+"&edit_cfg_photo_title="+cfg_photo_title+"&edit_cfg_photo_desc="+cfg_photo_desc;

	 $.ajax(
		    {
			  type: "post",
			  data: formdata,
			  url: "index.php",
			  beforeSend: function(){
			   ZENG.msgbox.show('保存中,请稍后...',6,5000);
			  },
			  success: function(data)
			  {
				     if(data=='ok')
					 {
					   ZENG.msgbox.show('保存成功',4,2000);
					   $("#brg").css("display","none");
					 }
			   },
			   
			  error: function()
			  {
				  
				  alert("请求出错处理");
			  }
			  
		   }
		     );	
  	
}
</script>
