<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    <style>
        .empower_con{
            float:left;
            color:#728597;
            width:100%;
            margin-left: 10px;}
        .empower_con .ec_tit{
            float:left;
            width:100%;
            height:30px;
            line-height:30px;
            padding:10px 0}
        .empower_con .ec_list{
            float:left;
            width:100%;
            margin:5px 0}
        .empower_con .ec_list dt{
            float:left;
            width:100%;
            height:30px;
            line-height:30px}
        .empower_con .ec_list dd{
            float:left;
            width:100%;}
        .empower_con .ec_list dd p{
            float:left;
            height:32px;
            line-height:32px;
            margin-left:20px}
        .empower_success,
        .empower_fail{
            float:left;
            width:100%;
            padding:50px 0}
        .empower_success .tit,
        .empower_fail .tit{
            float:left;
            color:#3892d3;
            width:100%;
            height:40px;
            font-size:20px;
            text-align:center}
        .empower_success .con,
        .empower_fail .con{
            float:left;
            color:#8e8e8e;
            width:100%;
            line-height:20px;
            font-size:12px;
            text-align:center}
        .empower_fail .btn{
            float:left;
            width:100%;
            padding:20px 0;
            text-align:center}
        .empower_fail .btn a{
            display:inline-block;
            color:#8e8e8e;
            width:98px;
            height:28px;
            line-height:28px;
            margin:0 5px;
            text-align:center;
            background:#fff;
            border-radius:3px;
            border:1px solid #e5e5e5}
    </style>
</head>

<body>
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td"  valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td">

            <form id="configfrm">
                <div class="w-set-tit bom-arrow"><span class="on"><s></s>思途CMS授权绑定</span> <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
                <div class="empower_con">


                    <dl class="ec_list">
                        <dt>思途帐号：</dt>
                        <dd>
                            <input type="text" name="cfg_sms_username" value="{$configinfo['cfg_sms_username']}"  class="set-text text_300" />
                            <p>注：在www.stourweb.com购买系统使用的帐号；    还没有帐号？<a href="http://www.stourweb.com/member/">立即注册</a></p>
                        </dd>
                    </dl>
                    <dl class="ec_list">
                        <dt>思途密码：</dt>
                        <dd>
                            <input type="password" name="cfg_sms_password" value="{$configinfo['cfg_sms_password']}"  class="set-text text_300" />
                            <p>注：在www.stourweb.com登录时使用的密码，若修改后，请务必修改此处密码，密码错误会影响系统功能使用，如短信功能；</p>
                        </dd>
                    </dl>
                    <dl class="ec_list">
                        <dt>思途ID：</dt>
                        <dd>
                            <input type="text" name="cfg_licenseid" id="cfg_licenseid" value="{$serailnum}" class="set-text text_300" />
                            <p>注：在www.stourweb.com会员中心的用户ID，即是系统的授权ID，请正确填写，否则会影响系统功能的使用，如升级功能；</p>
                        </dd>
                    </dl>
                    <div class="opn-btn">
                        <a class="save" href="javascript:;">保存</a>
                    </div>

                </div>
            </form>

        </td>
    </tr>
</table>



<script>
    $('.save').click(function(){
        var url = SITEURL+"config/ajax_saveconfig";
        var frmdata = $("#configfrm").serialize();
        var frmdata = frmdata+"&webid=0";
        $.ajax({
            type:'POST',
            url:url,
            dataType:'json',
            data:frmdata,
            success:function(data){

                if(data.status==true)
                {

                    //ST.Util.showMsg('保存成功',4);
                    saveBind();
                }




            }
        })
    })
    function saveBind()
    {

        var licenseid = $("#cfg_licenseid").val();
        var weburl = window.location.host;
        var frmdata ={licenseid:licenseid,weburl:weburl} ;
        $.ajax({
            type:"post",
            data: frmdata,
            dataType: 'json',
            url:SITEURL+"upgrade/ajax_bind_license",
            success:function(data){

                if(data.status==1){

                    ST.Util.showMsg(data.msg,4,1000);
                }
                else{


                    ST.Util.showMsg(data.msg,5,2000);
                }
            }
        })

    }
</script>

</body>
</html>
