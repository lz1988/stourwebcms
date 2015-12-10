<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>系统升级-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }

</head>



<body>
<!--顶部-->
<table class="content-tab">
<tr>
    <td width="119px" class="content-lt-td" valign="top">
        {template 'stourtravel/public/leftnav'}
        <!--右侧内容区-->
    </td>
    <td valign="top" class="content-rt-td" style="overflow:auto;">
        <div class="crumbs">
            <label>位置：</label>
            首页
            &gt; 增值应用
            &gt; <span>系统升级</span>
        </div>
        <div class="content-nr">
            <div class="manage-nr">

                <div class="upgrade-cms">

                    <div class="u-check-box ml-10">
                        <div class="u-jc-ico"><img class="fl" id="simg" src="{$GLOBALS['cfg_public_url']}images/jc-ico.png" ></div>
                        <div class="u-jc-box">
                          <div class="u-jc-txt">
                              <p class="fl">当前版本： {$version}</p>
                            <a class="fr" href="http://www.stourweb.com/cms/banben" target="_blank">官方升级日志</a>
                          </div>
                          <div class="u-jc-con" id="status1">
                            <a class="bg-15b" href="javascript:;" onclick="checkUpgrade()">检测更新</a>
                            <span class="gx-sm"><s></s>请检查更新！</span>
                          </div>
                         <div class="u-jc-con" style=" display:none" id="status2">
                              <a class="bg-15b" href="javascript:;">正在检测</a>
                            <span class="gx-sm"><s></s>版本检测中，请稍等！</span>
                          </div>
                          <div class="u-jc-con" style=" display:none" id="status3">
                              <a class="bg-00c" href="javascript:;">暂无更新</a>
                            <span class="gx-sm"><s></s>您的系统已经是最新版本！</span>
                          </div>
                          <div class="u-jc-con" style="display:none" id="status4">
                              <a class="bg-ffb" href="javascript:;" onclick="doUpgrade()">一键升级</a>
                            <span class="gx-sm"><s></s>检测到更新，请及时升级！</span>
                          </div>
                        </div><!--检测更新、正在检测、暂无更新、一键升级-->
                        <div class="u-sj-box" style="display: none">
                            <div class="u-sj-txt">系统正在自动升级，请勿刷新或关闭该网页...</div>
                        </div>
                    </div>
                    <!--升级状态-->
                    <div class="upgrade-version" id="upgrade_doing">
                        <dl id="step1" style="display: none">
                            <dt><img class="fl" src="{$GLOBALS['cfg_public_url']}images/gx-jd-bg.png" ></dt>
                            <dd>
                                <s></s>
                                <div class="dd-con">
                                    <p class="tit">执行：关闭当前站点</p>
                                    <ul>
                                        <li>说明：升级过程中需要暂时关闭网站，以免因为升级导致网站数据丢失。</li>
                                        <li class="cor_15b">状态：<span id="step1_status">处理中...</span></li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl id="step2" style="display: none">
                            <dt><img class="fl" src="{$GLOBALS['cfg_public_url']}images/gx-jd-bg.png" ></dt>
                            <dd>
                                <s></s>
                                <div class="dd-con">
                                    <p class="tit">执行：自动备份数据库</p>
                                    <ul>
                                        <li>说明：为防止升级导致网站数据丢失，须备份数据库。</li>
                                        <li class="cor_15b">状态：<span id="step2_status">处理中...</span></li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl id="step3" style="display: none">
                            <dt><img class="fl" src="{$GLOBALS['cfg_public_url']}images/gx-jd-bg.png" ></dt>
                            <dd>
                                <s></s>
                                <div class="dd-con">
                                    <p class="tit">执行：远程下载升级文件</p>
                                    <ul>
                                        <li>说明：下载时间根据当前服务器网络情况而定，请耐心等待。</li>
                                        <li class="cor_15b">状态：<span id="step3_status">处理中...</span></li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl id="step4" style="display: none">
                            <dt><img class="fl" src="{$GLOBALS['cfg_public_url']}images/gx-jd-bg.png" ></dt>
                            <dd>
                                <s></s>
                                <div class="dd-con">
                                    <p class="tit">执行：安装升级包</p>
                                    <ul>
                                        <li>说明：升级系统文件，请勿关闭当前页面。</li>
                                        <li class="cor_15b">状态：<span id="step4_status">处理中...</span></li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl id="step5" style="display: none">
                            <dt><img class="fl" src="{$GLOBALS['cfg_public_url']}images/gx-jd-bg.png" ></dt>
                            <dd>
                                <s></s>
                                <div class="dd-con">
                                    <p class="tit">执行：打开站点</p>
                                    <ul>
                                        <li>说明：恢复网站运行状态。</li>
                                        <li class="cor_15b">状态：<span id="step5_status">处理中...</span></li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                        <dl id="step6" style="display: none">
                            <dt><img class="fl" src="{$GLOBALS['cfg_public_url']}images/gx-jd-bg.png" ></dt>
                            <dd>
                                <s></s>
                                <div class="dd-con">
                                    <p class="tit">执行：升级完成</p>
                                    <ul>
                                        <li>说明：请及时点击系统右上角，生成网站HTML按钮，将网站页面生成至最新版。</li>
                                        <li class="cor_15b">状态：OK</li>
                                    </ul>
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <!--升级包显示-->
                    <div class="upgrade-version" id="upgrade_list" style="display: none">




                   </div>


            </div>
        </div>
    </td>
</tr>


<!--左侧导航区-->

<!--右侧内容区-->

<script language="JavaScript">
    var public_url = "{$GLOBALS['cfg_public_url']}";




  //检测更新
    function checkUpgrade()
    {

        $.ajax({
            type:'POST',
            url:SITEURL+'app/ajax_check_update',
            dataType:'json',
            beforeSend:function(){



                boxShow('status2');
                $("#simg").attr("src",public_url+"images/circle.gif?t="+Math.random());
            },
            success:function(data){

                //未检测到更新
                if(data.releasenum == 0){
                   boxShow('status3');
                }
                else
                {
                    $("#upgrade_list").html(data.versionlist);//显示更新
                    $("#upgrade_list").show();
                    boxShow('status4');
                }


            }
        })
    }

    //检测状态box的隐藏与显示
    function boxShow(id)
    {
        $(".u-jc-box").find('.u-jc-con').hide();//隐藏全部
        $("#"+id).show();//检测状态显示
        $("#simg").attr('src',public_url+"images/jc-ico.png");
    }
    //开始升级
    function doUpgrade()
    {

        var weburl = window.location.host;

        $.ajax({
            type:'POST',
            url:SITEURL+'app/ajax_upgrade',
            data:{url:weburl},
            dataType:'json',
            success:function(data){
              if(data.status==0)
              {
                 //没有升级权限
                 showBindBox();
              }
              else
              {
                  checkDirRight();
              }


            }
        })
    }

    //显示绑定页面
   function showBindBox()
   {
       var url=SITEURL+"app/bind";
       ST.Util.showBox('绑定授权ID',url,560,166,function(){});

      /* var content = $("#bindinfo").html();
       parent.window.dialog({
           content: content,
           title:'绑定授权ID',
           id:'bindbox'
       }).show();*/
   }
    //检测目录是否可写
    function checkDirRight()
    {
        $.ajax({
            type:'POST',
            url:SITEURL+'app/ajax_checkdir',
            dataType:'json',
            success:function(data){

                if(data.status==0)
                {
                   ST.Util.showMsg("网站目录没有写权限,不能进行文件升级,请检查目录权限",5);
                }
                else
                {
                    doStep1();

                }


            }
        })

    }
    //升级第一步
    function doStep1()
    {
        $('.u-jc-box').hide();
        $('.u-sj-box').show();//升级框显示
        $("#upgrade_list").hide();//升级包隐藏
        $("#step1").show();
        $.ajax({
            url: SITEURL+"app/ajax_upgrade_step1",
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $("#step1_status").html("OK");

                    doStep2();
                }
            }});

    }
    //升级第2步
    function doStep2()
    {
        $("#step2").show();
        $.ajax({
            url: SITEURL+"app/ajax_upgrade_step2",
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $("#step2_status").html("OK");

                    doStep3();
                }
            }});

    }
    //升级第3步
    function doStep3()
    {
        $("#step3").show();
        $.ajax({
            url: SITEURL+"app/ajax_upgrade_step3",
            data:{weburl:window.location.host},
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $("#step3_status").html("OK");

                    doStep4();
                }
            }});

    }
    //升级第4步
    function doStep4()
    {
        $("#step4").show();
        $.ajax({
            url: SITEURL+"app/ajax_upgrade_step4",
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $("#step4_status").html("OK");

                    doStep5();
                }
            }});

    }
    //升级第5步
    function doStep5()
    {
        $("#step5").show();
        $.ajax({
            url: SITEURL+"app/ajax_upgrade_step4",
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $("#step5_status").html("OK");
                    $("#step6").show();


                }
            }});

    }

</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
