<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>邮箱设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    <style>
        .w-set-nr .multi-txt{
            width: 255px;
            height: 50px;
            border: 1px solid #dcdcdc;
            padding-left: 5px;
        }
       .w-set-nr .cfg-hint{
           margin-left:45px ;
       }
    </style>
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
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>邮箱发送设置</span> <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">

                  <p>
                  	<span class="fl wid_150">SMTP服务器：</span>
                    <input type="text" name="cfg_mail_smtp" id="cfg_mail_smtp" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:300px">示例(163的smtp服务器为smtp.163.com)</span></p>
                  <p>
                    <span class="fl wid_150">发送端口：</span>
                    <input type="text" name="cfg_mail_port" id="cfg_mail_port" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:300px">示例(普通端口25号,ssl安全连接端口465)</span>
                    <?php
                  if(!extension_loaded('openssl')){
                    echo '<span style="float: left;margin-left: 10px; width:300px; color:red;">*你的服务器只能支持普通端口连接!</span>';
                  }
                  
                  ?>
                    </p>
                  <p><span class="fl wid_150">邮箱帐号：</span><input type="text" name="cfg_mail_user" id="cfg_mail_user" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:200px"> (示例:Stourweb@163.com)</p>
                  <p><span class="fl wid_150">邮箱密码：</span><input type="text" name="cfg_mail_pass" id="cfg_mail_pass" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:100px"> (示例:123456)</p>
                  <p><span class="fl wid_150">开启注册验证：</span><input type="radio" name="cfg_mail_isregcode" value="0" id="cfg_mail_isregcode0"/>关&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="cfg_mail_isregcode1" name="cfg_mail_isregcode" value="1"/>开&nbsp;&nbsp;</p>
                  <p><span class="fl wid_150">注册验证信息：</span><textarea name="cfg_mail_regmsg" id="cfg_mail_regmsg" class="multi-txt"></textarea><span class="cfg-hint">{#CODE#}验证码，{#WEBNAME#}你的网站名称</span></p>


              </div>
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">
              <a class="normal-btn" href="javascript:;" id="testmail">发送测试邮件</a>
            </div>
            <img src="{$GLOBALS['cfg_public_url']}images/emailshili.jpg" alt="示例图片"/>
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
            var isopenssl = 1;
            <?php
            if(!extension_loaded('openssl')){

              echo 'isopenssl = 0;';
            }
            ?>

            var portnum = $("#cfg_mail_port").val();
            if(isopenssl==0){
              if(portnum!=25){
                ST.Util.showMsg('你的服务器只能支持普通端口连接，发送端口号请填“25”!','3',4000);
                return false;
              }
            }

            if(portnum!=25 && portnum!=465){
              ST.Util.showMsg('发送端口号请填"25"或"465"!','3',4000);
              return false;
            }
            
            var webid= 0
            Config.saveConfig(webid);
        });
        getConfig(0);

        //测试邮件发送
        $("#testmail").click(function(){
          var win = Ext.create("Ext.window.Window", {
            id: "myWin",
            title: "测试邮件发送",
            width: 500,
            height: 300,
            layout: "fit",
            items: [
                {
                    xtype: "form",
                    defaultType: 'textfield',
                    defaults: {
                        anchor: '100%',
                    },
                    fieldDefaults: {
                        labelWidth: 50,
                        flex: 1,
                        margin: 5
                    },
                    items: [
                        {
                            xtype: "container",
                            layout: "hbox",
                            items: [
                                { xtype: "textfield", id: "email", name: "email", fieldLabel: "收件箱", allowBlank: false },
                            ]
                        },
                        {
                            xtype: "container",
                            layout: "hbox",
                            items: [
                                { xtype: "textfield", id: "title", name: "title", fieldLabel: "标题", allowBlank: false },
                            ]
                        },
                        {
                            xtype: "container",
                            layout: "hbox",
                            items: [
                                { xtype: "textarea", id: "content", name: "content", fieldLabel: "内容", height: 150, allowBlank: false },
                            ]
                        }
                    ]
                }
            ],
            buttons: [
                { xtype: "button", text: "发送", handler: function () { 
                    //数据提交
                      var $dom = this.up("window");
                      var email = Ext.getCmp('email').getValue(); 
                      var title = Ext.getCmp('title').getValue(); 
                      var content = Ext.getCmp('content').getValue();
                      Ext.Ajax.request({
                         url   :  SITEURL+"config/ajax_sendmail",
                         method  :  "POST",
                         isUpload :  true,
                         params: {email: email,title: title, content: content},
                         datatype  :  "JSON",
                         success  :  function(response)
                         {
                             var data = $.parseJSON(response.responseText);
                             if(data.status)
                             {
                                 ST.Util.showMsg('发送成功!','4',2000);
                                 $dom.close();
                             }else{
                                 ST.Util.showMsg('发送失败!','1',2000);
                             }
                       }});
                      //数据提交
                } },
                { xtype: "button", text: "取消", handler: function () { this.up("window").close(); } }
            ]
          }).show();
          
        })
     });


       //获取配置
        function getConfig(webid)
        {

            Config.getConfig(webid,function(data){

                $("#cfg_mail_port").val(data.cfg_mail_port);
                $("#cfg_mail_smtp").val(data.cfg_mail_smtp);
                $("#cfg_mail_user").val(data.cfg_mail_user);
                $("#cfg_mail_pass").val(data.cfg_mail_pass);
                $("#cfg_mail_regmsg").val(data.cfg_mail_regmsg);
                if(!data.cfg_mail_isregcode)
                {
                    $("#cfg_mail_isregcode0").attr("checked",true)
                }
                else
                {
                    $("#cfg_mail_isregcode1").attr("checked",true)
                }

            })

        }



    </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
