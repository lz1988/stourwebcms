<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    {php echo Common::getCss('style.css,base.css'); }
</head>

<body style="background-color: #fff">
       <form name="seofrm" id="seofrm">
         <div class="w-set-con" style="margin: 0">
          <div class="w-set-nr" style="padding:0">
              <div class="nr-list" style="width: 160px">
                  <h4 class="tit"><span class="fl">国家封面图：</span></h4>
                  <div class="txt">
                      <input id="file_upload_litpic" name="file_upload_litpic" type="button"/>
                  </div>
                  <div class="logolist">

                      <img src="" id="litpic_cover" width="80" height="60" style="margin: 3px;">
                      <a style="cursor:pointer;" onClick="delImage('litpic_cover','litpic')")>删除</a>

                  </div>
              </div>
              <div class="nr-list" style="width: 160px">
                  <h4 class="tit"><span class="fl">国家国旗：</span></h4>
                  <div class="txt">
                      <input id="file_upload_guoqi" name="file_upload" type="button"/>
                  </div>
                  <div class="logolist">

                      <img src="" id="litpic_guoqi" width="80" height="60" style="margin: 3px;">
                      <a style="cursor:pointer;" onClick="delImage('litpic_guoqi','countrypic')")>删除</a>

                  </div>
              </div>
              <div class="nr-list" style="width: 160px">
                  <h4 class="tit"><span class="fl">国家栏目页背景图：</span></h4>
                  <div class="txt">
                      <input id="file_upload_bg" name="file_upload" type="button"/>
                  </div>
                  <div class="logolist">

                      <img src="" id="litpic_bg" width="80" height="60" style="margin: 3px;">
                      <a style="cursor:pointer;" onClick="delImage('litpic_bg','bigpic')")>删除</a>

                  </div>
              </div>

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
              <div class="nr-list">
                  <h4 class="tit"><span class="fl">拼音：</span><div class="help-ico"></div></h4>
                  <div class="txt">
                      <input type="text" name="pinyin" id="pinyin" class=" w200 set-text-xh"  value="{$seoinfo['pinyin']}" />
                  </div>
              </div>


            <div class="opn-btn">
            	<a class="save" href="javascript:;"  id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
            </div>

          </div>
        </div>
           <input type="hidden" id="kindname" name="kindname"  value="{$seoinfo['kindname']}">
           <input type="hidden" id="countryid" name="countryid"  value="{$seoinfo['id']}">
           <input type="hidden" id="cfg_litpic_cover" name="cfg_litpic_cover"  value="{$seoinfo['litpic']}">
           <input type="hidden" id="cfg_litpic_guoqi" name="cfg_litpic_guoqi"  value="{$seoinfo['countrypic']}">
           <input type="hidden" id="cfg_litpic_bg" name="cfg_litpic_bg"  value="{$seoinfo['bigpic']}">

        </form>




    <script>
       $('#btn_save').click(function(){

           var ajaxurl = SITEURL+'visa/ajax_config_save';

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

       //图片上传
       $(function(){

           //图片显示
           var cfg_litpic_cover = $("#cfg_litpic_cover").val();
           var cfg_litpic_guoqi = $("#cfg_litpic_guoqi").val();
           var cfg_litpic_bg = $("#cfg_litpic_bg").val();
           if(cfg_litpic_cover!='')
           {
               $("#litpic_cover").attr('src',cfg_litpic_cover);
           }

           else
           {
               $("#litpic_cover").attr('src',SITEURL+'public/images/nopic.jpg');
           }
           if(cfg_litpic_guoqi!='')
           {
               $("#litpic_guoqi").attr('src',cfg_litpic_guoqi);
           }

           else
           {
               $("#litpic_guoqi").attr('src',SITEURL+'public/images/nopic.jpg');
           }
           if(cfg_litpic_bg!='')
           {
               $("#litpic_bg").attr('src',cfg_litpic_bg);
           }

           else
           {
               $("#litpic_bg").attr('src',SITEURL+'public/images/nopic.jpg');
           }



           //文件上传
           setTimeout(function(){
               //国家封面图片
               $('#file_upload_litpic').uploadify({
                   'formData'     : {
                       'webid':0,
                       'thumb':0,
                       uploadcookie:"<?php echo Cookie::get('username')?>"
                   },
                   'swf'      : PUBLICURL+'js/uploadify/uploadify.swf',
                   'uploader' : SITEURL+'uploader/uploadfile',
                   'buttonImage' : PUBLICURL+'images/upload-ico.png',
                   'fileSizeLimit' : '512KB',
                   'fileTypeDesc' : 'Image Files',
                   'fileTypeExts' : '*.gif; *.jpg; *.png',
                   'cancelImg' : PUBLICURL+'js/uploadify/uploadify-cancel.png',
                   'multi' : false,
                   'removeCompleted' : true,
                   'height':25,
                   'width':80,
                   'removeTimeout':0.2,
                   'wmode ':'transparent',

                   onUploadSuccess:function(file,data,response){


                       var obj = $.parseJSON(data);
                       //var obj = eval('('+data+')');
                       if(obj.bigpic!=''){
                           $('#litpic_cover')[0].src=obj.bigpic;
                           $('#cfg_litpic_cover').val(obj.bigpic);

                       }

                   }

               });
           },10)
           setTimeout(function(){
               //国旗
               $('#file_upload_guoqi').uploadify({
                   'formData'     : {
                       'webid':0,
                       'thumb':0,
                       uploadcookie:"<?php echo Cookie::get('username')?>"
                   },
                   'swf'      : PUBLICURL+'js/uploadify/uploadify.swf',
                   'uploader' : SITEURL+'uploader/uploadfile',
                   'buttonImage' : PUBLICURL+'images/upload-ico.png',
                   'fileSizeLimit' : '512KB',
                   'fileTypeDesc' : 'Image Files',
                   'fileTypeExts' : '*.gif; *.jpg; *.png',
                   'cancelImg' : PUBLICURL+'js/uploadify/uploadify-cancel.png',
                   'multi' : false,
                   'removeCompleted' : true,
                   'height':25,
                   'width':80,
                   'removeTimeout':0.2,
                   'wmode ':'transparent',

                   onUploadSuccess:function(file,data,response){


                       var obj = $.parseJSON(data);
                       //var obj = eval('('+data+')');
                       if(obj.bigpic!=''){
                           $('#litpic_guoqi')[0].src=obj.bigpic;
                           $('#cfg_litpic_guoqi').val(obj.bigpic);

                       }

                   }

               });
           },20)
           setTimeout(function(){
               //国家搜索页面顶部背景
               $('#file_upload_bg').uploadify({
                   'formData'     : {
                       'webid':0,
                       'thumb':0,
                       uploadcookie:"<?php echo Cookie::get('username')?>"
                   },
                   'swf'      : PUBLICURL+'js/uploadify/uploadify.swf',
                   'uploader' : SITEURL+'uploader/uploadfile',
                   'buttonImage' : PUBLICURL+'images/upload-ico.png',
                   'fileSizeLimit' : '512KB',
                   'fileTypeDesc' : 'Image Files',
                   'fileTypeExts' : '*.gif; *.jpg; *.png',
                   'cancelImg' : PUBLICURL+'js/uploadify/uploadify-cancel.png',
                   'multi' : false,
                   'removeCompleted' : true,
                   'height':25,
                   'width':80,
                   'removeTimeout':0.2,
                   'wmode ':'transparent',

                   onUploadSuccess:function(file,data,response){


                       var obj = $.parseJSON(data);
                       //var obj = eval('('+data+')');
                       if(obj.bigpic!=''){
                           $('#litpic_bg')[0].src=obj.bigpic;
                           $('#cfg_litpic_bg').val(obj.bigpic);

                       }

                   }

               });
           },30)

       })

       //删除图片
       function delImage(id,field)
       {
           var $image = $("#cfg_"+id).val();
           var countryid = $("#countryid").val();

           $.ajax({
               type:'POST',
               url:SITEURL+'visa/ajax_del_image',
               data:{countryid:countryid,field:field,image:$image},
               dataType:'json',
               success:function(data){
                    if(data.status==1){
                        $("#"+id).attr('src',SITEURL+'public/images/nopic.jpg');
                        $("#cfg_"+id).val('');
                    }
               }
           })

       }

     </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
