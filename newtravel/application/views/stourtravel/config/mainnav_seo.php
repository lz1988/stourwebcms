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
       <form name="seofrm" id="seofrm">
         <div class="w-set-con" style="margin: 0">
          <div class="w-set-nr" style="padding:0">

          	<div class="nr-list">
               <h4 class="tit"><span class="fl">优化标题：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
              <div class="txt">
              	<input type="text" name="seotitle" id="seotitle" class="set-text-xh set-text-bz3" value="{$seoinfo['seotitle']}" />

              </div>
            </div>
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">关键词：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
                  <div class="txt">
                      <input type="text" id="keyword" name="keyword" class="set-text set-text-xh set-text-bz3" value="{$seoinfo['keyword']}" />

                  </div>
              </div>
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">Tag：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
                  <div class="txt">
                      <input type="text" id="tagword" name="tagword" class="set-text set-text-xh set-text-bz3" value="{$seoinfo['tagword']}" />

                  </div>
              </div>
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">描述：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
                  <div class="txt">
                      <textarea name="description" cols="3" style="width:500px;height: 60px; padding:3px;">{$seoinfo['description']}</textarea>

                  </div>
              </div>
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">介绍：</span><div class="help-ico"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/help-ico.png" alt="帮助" title="帮助"></div></h4>
                  <div class="txt">
                      {php Common::getEditor('jieshao',$seoinfo['jieshao'],500,200,'Line');}
                  </div>
              </div>


            <div class="opn-btn">
            	<a class="save" href="javascript:;"  id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
            </div>

          </div>
        </div>
           <input type="hidden" id="navid" name="navid" value="{$seoinfo['id']}">
        </form>




    <script>
       $('#btn_save').click(function(){

           var ajaxurl = '{php echo URL::site('config/ajax_saveseo');}';
          //ST.Util.showMsg('保存中,请稍后...',6,5000);
           Ext.Ajax.request({
               url: ajaxurl,
               method: 'POST',
               form : 'seofrm',
               success: function (response, options) {

                   var data = $.parseJSON(response.responseText);
                   if(data.status)
                   {

                       ST.Util.showMsg('保存成功',4);
                       //ST.Util.closeBox();//关闭当前窗口

                   }

               }

           });

       })
     </script>

</body>
</html>
