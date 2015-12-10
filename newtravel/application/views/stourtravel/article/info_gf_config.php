<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}

    {php echo Common::getCss('style.css,base.css'); }
</head>

<body  style="background-color: #fff">


	<div class="middle-con">
       <form name="frm" id="frm" action="{$action}">
        <div class="w-set-con">


            
            <div class="nr-list">
            	<h4 class="tit">{$info['title']}段落内容：</h4>
              <div class="txt">
                  {php Common::getEditor('content',$info['content'],700,300);}
              </div>
            </div>
            <div class="opn-btn">
            	<a class="save" href="javascript:;">保存</a>
            </div>
            <input type="hidden" name="articleid" id="articleid" value="{$info['id']}"/>
       </div>
           </form>
    </div>

  
  
	<script>
        $(function(){

            $(".save").click(function(){
                var url = "{php echo URL::site();}";
                var ajaxurl = url + "article/infoconfig/action/save/id/{$info['id']}";

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
