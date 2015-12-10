<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }



</head>
<body style="background-color: #fff">


<div class="sj-outbox">

    <ul class="write-in">
        <li class="li_1"><p><span class="fl">请填写授权ID</span><input type="text" class="set-text-xh text_200 fl" name="licenseid" id="licenseid" value="{$licenseid}" /></p></li>
        <li class="li_2" id="iderror"><p>授权ID错误,请联系思途售后客服人员!</p></li>
        <li class="li_3"><p>您在思途CMS官方网站购买系统时的帐号所对应的ID。</p></li>
        <li class="li_4"><a href="javascript:;" onclick="saveBind()" >确定</a></li>
    </ul>
</div>
<script language="JavaScript">
    function saveBind()
    {

        var licenseid = $("#licenseid").val();
        var weburl = window.location.host;

        var frmdata ={licenseid:licenseid,weburl:weburl} ;
        $.ajax({
            type:"post",
            data: frmdata,
            dataType: 'json',
            url:SITEURL+"upgrade/ajax_bind_license",
            success:function(data){

                if(data.status==1){
                    $("#iderror").hide();
                    ST.Util.showMsg(data.msg,4,1000);
                }
                else{

                    $("#iderror").show();
                    ST.Util.showMsg(data.msg,5,1000);
                }
            }
        })

    }

</script>

</body>
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
