<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>客服电话设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}

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
                        <div class="w-set-con">
                            <div class="w-set-tit bom-arrow">
                                {template 'stourtravel/kefu/kind_top'}
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                            </div>
                            <div class="w-set-nr">

                                <div class="nr-list ml-10">
                                    <h4 class="tit"><span class="fl">第三方客服代码：</span><div class="help-ico">{php echo Common::getIco('help',5); }</div></h4>
                                    <div class="txt">
                                        <textarea id="cfg_html_kefu" name="cfg_html_kefu"  cols="" rows="4" class="set-area"></textarea>
                                    </div>
                                </div>
                                <div class="opn-btn">
                                    <a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
                                    <!-- <a class="cancel" href="#">取消</a>-->
                                    <input type="hidden" name="webid" id="webid" value="0">
                                </div>

                            </div>
                        </div>
                    </form>

        </td>
    </tr>
</table>



<script>

    $(document).ready(function(){



        //选中分类
        $(".w-set-tit").find('span').eq(2).addClass('on');
        //配置信息保存
        $("#btn_save").click(function(){

            var webid= 0
            Config.saveConfig(webid);
        })


        getConfig(0);


    });


    //获取配置
    function getConfig(webid)
    {

        Config.getConfig(webid,function(data){
            $("#cfg_html_kefu").val(data.cfg_html_kefu);

        })

    }



</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
