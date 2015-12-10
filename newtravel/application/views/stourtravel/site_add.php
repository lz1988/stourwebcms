<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加站点-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
</head>

<body style="background-color: #fff">


	<div class="middle-con">
       <form name="frm" id="frm" action="{$action}">
        <div class="w-set-con">

           <div class="nr-list">
            	<h4 class="tit"><span class="fl">网站域名：</span> <div class="help-ico">{php echo Common::getIco('help',30); }</div></h4>
              <div class="txt">
              	<input type="text" id="prefix" name="prefix" class="set-text" style="width: 60%" value="" />{$domain}

              </div>
            </div>
            <div class="nr-list">
                <h4 class="tit"><span class="fl">网站名称：</span><div class="help-ico">{php echo Common::getIco('help',31); }</div></h4>
                <div class="txt">
                    <input type="text" id="webname" name="webname" class="set-text" style="width: 96%" value="" />

                </div>
            </div>
            

            
            <div class="opn-btn">
            	<a class="save" href="#">保存</a>

            </div>

       </div>
           </form>
    </div>

  
  
	<script>
        $(function(){

            $(".save").click(function(){

                var ajaxurl = SITEURL + 'site/'+"{$action}";

                Ext.Ajax.request({
                    url: ajaxurl,
                    method: 'POST',
                    form : 'frm',
                    success: function (response, options) {

                        var data = $.parseJSON(response.responseText);
                        if(data.status=='1')
                        {

                            ST.Util.showMsg('保存成功',4);
                            ST.Util.closeBox();//关闭当前窗口
                            //parent.window.getNav();

                        }
                        else if(data.status=='repeat')
                        {
                            ST.Util.showMsg('子站域名重复,请检查',5);
                        }
                        else
                        {
                            ST.Util.showMsg('子站添加失败',5);
                        }

                    }

                });


            })
        })

	</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
