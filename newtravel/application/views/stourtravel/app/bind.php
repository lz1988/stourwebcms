<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }



</head>
<body style="background-color: #fff">
<!--<div id="bindinfo">
    <ul>
        <li class="h30"><span class="fl">授权ID:</span><input type="text" class="set-text-xh text_200 fl" name="licenseid" id="licenseid" value="{$licenseid}" ><span id="iderror" style="color:red;">授权ID错误,请联系思途售后客服人员!</span></li>
        <li class="h30"><span class="fl" style="width: 100%;line-height: 30px;">请填写购买思途CMS注册的官方帐号ID</span></li>
        <li class="h30"><span class="fl"><input type="button" id="bd_btn_bind" onclick="saveBind()" value="保存"></span></li>
    </ul>

</div-->

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
            url:SITEURL+"app/ajax_bind_license",
            success:function(data){

                if(data.status=='ok'){
                    $("#iderror").hide();
                    ST.Util.showMsg('绑定成功',4,1000);
                }
                else{

                    $("#iderror").show();
                }
            }
        })

    }

</script>

</body>
</html>