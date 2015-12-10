<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>系统参数</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,jqtransform.css'); }
    {php echo Common::getScript('config.js,jquery.jqtransform.js,jquery.colorpicker.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>

<body>
	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td">


        <form id="configfrm">
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>系统参数</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">
              <div class="water-mark ml-10">


                      <div class="rowElem">
                          <label>网站开关：</label>
                          <input type="radio" name="cfg_web_open" value="1" {if $config['cfg_web_open']==1}checked{/if}>
                          <label>开启</label>
                          <input type="radio" name="cfg_web_open" value="0" {if $config['cfg_web_open']==0}checked{/if}>
                          <label>关闭</label>
                      </div>


                      <div class="rowElem" style="margin-top: 30px;">
                          <label>手机站点：</label>

                              <input type="radio"  name="cfg_mobile_open" value="1" {if $config['cfg_mobile_open']=='1'}checked{/if}>
                              <label>开启</label>


                              <input type="radio"  name="cfg_mobile_open" value="0" {if $config['cfg_mobile_open']=='0'}checked{/if}>
                              <label>关闭</label>

                      </div>

                  <div class="rowElem" style="margin-top: 30px;">
                      <label>前台出发地：</label>

                      <input type="radio"  name="cfg_startcity_open" value="1" {if $config['cfg_startcity_open']=='1'}checked{/if}>
                      <label>开启</label>


                      <input type="radio"  name="cfg_startcity_open" value="0" {if $config['cfg_startcity_open']=='0'}checked{/if}>
                      <label>关闭</label>

                  </div>
                  <div class="rowElem" style="margin-top: 30px;">
                      <label>自定义导航：</label>

                      <input type="radio"  name="cfg_usernav_open" value="1" {if $config['cfg_usernav_open']=='1'}checked{/if}>
                      <label>开启</label>


                      <input type="radio"  name="cfg_usernav_open" value="0" {if $config['cfg_usernav_open']=='0'}checked{/if}>
                      <label>关闭</label>

                  </div>

                  <div class="rowElem" style="margin-top: 30px;">
                      <label>模板皮肤：</label>

                      <input type="radio"  name="cfg_df_style" value="smore" {if $config['cfg_df_style']=='smore'}checked{/if}>
                      <label>标准</label>
                      {loop $templetlist $templet}
                      <input type="radio"  name="cfg_df_style" value="{$templet['tempname']}" {if $config['cfg_df_style']==$templet['tempname']}checked{/if}>
                       <label>{$templet['tempname']}</label>
                      {/loop}


                  </div>
                  <div class="rowElem" style="margin-top: 30px;">
                      <label>默认首页效果：</label>

                      <input type="radio"  name="cfg_index_templet" value="index_1.htm" {if $config['cfg_index_templet']=='index_1.htm'}checked{/if}>
                      <label>效果一</label>
                      <input type="radio"  name="cfg_index_templet" value="index_2.htm" {if $config['cfg_index_templet']=='index_2.htm'}checked{/if}>
                      <label>效果二</label>
                      <input type="radio"  name="cfg_index_templet" value="index_3.htm" {if $config['cfg_index_templet']=='index_3.htm'}checked{/if}>
                      <label>效果三</label>



                  </div>



                  <div class="writing" style="margin-top: 20px;">
                      <p><span class="fl">自动更新时间：</span><input type="text" name="cfg_auto_time" id="cfg_auto_time" class="set-text-xh set-text-bz1" value="{$config['cfg_auto_time']}" /></p>

                  </div>




              </div>

            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">


            </div>


          </div>
        </div>
        </form>
  </td>
  </tr>
  </table>

  
  
	<script>

	$(document).ready(function(){



        //配置信息保存
        $("#btn_save").click(function(){

            //var webid= $("#webid").val();
            Config.saveConfig(0);


        });



    })












    </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.0501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
