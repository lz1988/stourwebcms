<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {php echo Common::getScript('jquery-1.8.3.min.js,common.js,msgbox/msgbox.js,extjs/ext-all.js'); }
    {php echo Common::getCss('msgbox.css','js/msgbox/'); }
    {php echo Common::getCss('style.css,base.css'); }
</head>

<body>
       <form name="addfrm" id="addfrm">
         <div class="w-set-con" style="margin: 0">
          <div class="w-set-nr" style="padding:0">

          	<div class="nr-list">
               <h4 class="tit"><span class="fl">导航名称：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
              <div class="txt">
              	<input type="text" name="shortname" id="shortname" class="set-text-xh set-text-bz3" value="" />

              </div>
            </div>
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">导航Title：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
                  <div class="txt">
                      <input type="text" id="linktitle" name="linktitle" class="set-text set-text-xh set-text-bz3" value="{$seoinfo['keyword']}" />

                  </div>
              </div>
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">导航Url：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
                  <div class="txt">
                      <input type="text" id="linkurl" name="linkurl" class="set-text set-text-xh set-text-bz3" value="{$seoinfo['tagword']}" />

                  </div>
              </div>



            <div class="opn-btn">
            	<a class="save" href="javascript:;"  id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
            </div>

          </div>
        </div>
           <input type="hidden" id="webid" name="webid" value="{$webid}">
        </form>




    <script>
       $('#btn_save').click(function(){

           var ajaxurl = '{php echo URL::site('config/ajax_addnavsave');}';
          //ST.Util.showMsg('保存中,请稍后...',6,5000);
           Ext.Ajax.request({
               url: ajaxurl,
               method: 'POST',
               form : 'addfrm',
               success: function (response, options) {

                   var data = $.parseJSON(response.responseText);
                   if(data.status)
                   {

                       ST.Util.showMsg('保存成功',4);
                       ST.Util.closeBox();//关闭当前窗口
                       //parent.window.getNav();

                   }
                   else
                   {
                       ST.Util.showMsg('保存失败',5);
                   }

               }

           });

       })
     </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
