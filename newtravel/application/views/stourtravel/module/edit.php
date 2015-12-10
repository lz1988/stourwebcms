<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('msgbox.css','js/msgbox/'); }
    {php echo Common::getCss('style.css,base.css'); }
</head>

<body>


	<div class="middle-con" style="background-color: #fff">
       <form name="frm" id="frm" action="{$action}">
        <div class="w-set-con">

           <div class="nr-list">
            	<h4 class="tit">模块名称：</h4>
              <div class="txt">
              	<input type="text" id="modulename" name="modulename" class="set-text" value="{$info['modulename']}" />
                <div class="help-ico">{$helpico}</div>
              </div>
            </div>
            
            <div class="nr-list">
            	<h4 class="tit">模块内容：</h4>
              <div class="txt">
                  <textarea name="body" id="body" rows="5" style="width:500px;height:300px;" >{$info['body']}</textarea>
              </div>
            </div>
            
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>

            </div>
            <input type="hidden" name="webid" id="webid" value="{$webid}"/>
            <input type="hidden" name="articleid" id="articleid" value="{$info['id']}"/>
       </div>
           </form>
    </div>

  
  
	<script>
        $(function(){

            $("#btn_save").click(function(){
                var url = "{$GLOBALS['cfg_cmspath']}";
                var ajaxurl = SITEURL + 'module/'+"{$action}";

                Ext.Ajax.request({
                    url: ajaxurl,
                    method: 'POST',
                    form : 'frm',
                    success: function (response, options) {

                        var data = $.parseJSON(response.responseText);
                        if(data.status)
                        {

                            ST.Util.showMsg('保存成功',4);
                           // ST.Util.closeBox();//关闭当前窗口


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
