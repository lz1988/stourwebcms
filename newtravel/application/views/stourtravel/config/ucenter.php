<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ucenter设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}

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
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>ucenter配置</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">



                  <p>
                  	<span class="fl wid_150">是否启用</span>
                      <input type="radio" name="cfg_uc_open" value="1" {if $config['cfg_uc_open']==1}checked{/if}>
                      <label>开启</label>
                      <input type="radio" name="cfg_uc_open" value="0" {if $config['cfg_uc_open']==0}checked{/if}>
                      <label>关闭</label>
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter Api地址：</span>
                     <input type="text" name="cfg_uc_url" id="cfg_uc_url" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_url']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter Ip地址：</span>
                      <input type="text" name="cfg_uc_ip" id="cfg_uc_ip" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_ip']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter 数据库主机名：</span>
                      <input type="text" name="cfg_uc_host" id="cfg_uc_host" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_host']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter 数据库用户名：</span>
                      <input type="text" name="cfg_uc_user" id="cfg_uc_user" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_user']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter 数据库密码：</span>
                      <input type="password" name="cfg_uc_pwd" id="cfg_uc_pwd" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_pwd']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter 数据库名称：</span>
                      <input type="text" name="cfg_uc_db" id="cfg_uc_db" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_db']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">Ucenter 数据表前辍：</span>
                      <input type="text" name="cfg_uc_dbprefix" id="cfg_uc_dbprefix" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_dbprefix']}" >
                  </p>

                  <p>
                      <span class="fl wid_150">Ucenter 数据库字符集：</span>
                      <select name="cfg_uc_charset" id="cfg_uc_charset">
                          <option value="UTF-8">UTF-8</option>
                          <option value="GBK">GBK</option>
                      </select>
                  </p>
                  <p>
                      <span class="fl wid_150">应用id(App id)：</span>
                      <input type="text" name="cfg_uc_appid" id="cfg_uc_appid" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_appid']}" >
                  </p>
                  <p>
                      <span class="fl wid_150">ucenter通信密钥：</span>
                      <input type="text" name="cfg_uc_key" id="cfg_uc_key" class="set-text-xh text_250 ml-5 mr-30" value="{$config['cfg_uc_key']}" >
                  </p>

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

            var webid= 0
            Config.saveConfig(webid);
            var url = SITEURL+"config/ajax_save_ucenter";
            var frmdata = $("#configfrm").serialize();
            $.ajax({
                type:'POST',
                url:url,
                dataType:'json',
                data:frmdata,
                success:function(data){


                }
            })
        })


     });


    </script>

</body>
</html>
