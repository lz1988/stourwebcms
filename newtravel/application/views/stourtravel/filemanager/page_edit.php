<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }



</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90" style="text-align: left;">文件名称：</dt>
            <dd>
                 {$filename}
            </dd>
        </dl>
        <dl class="list_dl" style="height: 500px;">
            <dt class="wid_90" style="text-align: left;">文件内容:</dt>
            <dd><textarea style="width:800px;" rows="32" name="content">{$content}</textarea></dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" name="filename" value="{$filename}"/>
                <input type="hidden" name="issline" value="{$issline}"/>
            </dd>
        </dl>
    </div>
   </form>

<script language="JavaScript">



    $(function(){
        //保存
        $("#btn_save").click(function(){


            Ext.Ajax.request({
                url   :  SITEURL+"filemanager/ajax_page_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    var data = $.parseJSON(response.responseText);
                    if(data.status)
                    {


                        ST.Util.showMsg('保存成功!','4',2000);


                    }


                }
            });


        })








    })

</script>

</body>
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
