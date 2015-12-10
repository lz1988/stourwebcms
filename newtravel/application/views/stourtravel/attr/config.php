<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>属性配置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>

<body style="background-color: #fff">
  <style>
   .list_title{
       line-height: 30px;
       float: left;
   }
   .lh30{line-height: 30px;}
   .red{color: red}
   .mt5{margin-top: 5px}
   .w300{width: 300px;}
  </style>

	<div class="middle-con" >
       <form name="frm" id="frm">
        <div class="w-set-con">

           <div class="nr-list">
               <span class="list_title">属性名称：</span>

               <span class="lh30 red">{$info['attrname']}</span>

            </div>
            <div class="nr-list">
                <span class="list_title">属性描述：</span>

                <span class="lh30" ><input type="text" name="description" class="set-text-xh w300" value="{$info['description']}"></span>

            </div>
            
            <div class="nr-list">
                <span class="list_title">属性图片：</span>

                  <div class="up-file-div lh30 mt5 fl">
                      <div id="file_upload" class="btn-file mt-4"><div id="file_upload-button" class="uploadify-button " style="text-indent: -9999px; height: 25px; line-height: 25px; width: 80px; cursor: pointer"><span class="uploadify-button-text">上传图片</span></div></div>
                      {if !empty($info['litpic'])}
                       <div id="img"><img id="litimg" src="{$info['litpic']}" width="100" height="80"   /></div>
                      {else}
                      <div id="img"><img id="litimg" src="{php echo Common::getDefaultImage();}" width="100" height="80" /></div>
                      {/if}
                  </div>

            </div>
            
            <div class="opn-btn">
            	<a class="normal-btn" id="save_btn" href="javascript:;">保存</a>

            </div>

            <input type="hidden" name="litpic" id="litpic" value="{$info['litpic']}">
            <input type="hidden" name="attrid" id="attrid" value="{$info['id']}"/>
            <input type="hidden" name="typeid" value="{$typeid}"/>
       </div>
           </form>
    </div>

  
  
	<script>
        $(function(){

            //上传图片
           $('#file_upload-button').css('backgroundImage','url("'+PUBLICURL+'images/upload-ico.png'+'")');
            $('#file_upload').click(function(){
                ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
                function Insert(result,bool){
                    if(result.data.length>0){
                        var len=result.data.length-1;
                        var temp =result.data[len].split('$$');
                        $('#litimg')[0].src=temp[0];
                        $("#litpic").val(temp[0]);
                    }
                }
            });


            $("#save_btn").click(function(){

                var ajaxurl = SITEURL + 'attrid/ajax_config_save';

                Ext.Ajax.request({
                    url: ajaxurl,
                    method: 'POST',
                    form : 'frm',
                    success: function (response, options) {

                        var data = $.parseJSON(response.responseText);
                        if(data.status)
                        {

                            ST.Util.showMsg('保存成功',4);
                            //ST.Util.closeBox();//关闭当前窗口
                            //parent.window.getNav();

                        }
                        else
                        {
                            ST.Util.showMsg('保存失败',5);
                        }

                    }

                });


            })
        })

	</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.2704&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
