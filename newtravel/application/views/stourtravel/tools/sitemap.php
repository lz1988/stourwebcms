<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('ZeroClipboard.js');}

</head>
<body>
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden">
            <div class="list-top-set">
                <div class="list-web-pad"></div>
                <div class="list-web-ct">
                    <table class="list-head-tb">
                        <tr>
                            <td class="head-td-lt">

                            </td>
                            <td class="head-td-rt">
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="sitemapbox">
                <p class="header">XML格式sitemap</p>

                <ul class="desc">
                    <li>生成状态:<span class="gentxt">{$xmlinfo['text']}</span></li>
                    <li>生成日期:<span class="gentxt">{$xmlinfo['time']}</span></li>
                    <li>生成数量:<span class="gentxt">{$xmlinfo['number']}</span></li>
                </ul>


                <ul>
                    <li><a class="txtbtn" onclick="genXmlMap()">生成XML</a></li>
                    <li><a class="linkbtn" id="xml_sitemap_btn" target="_blank" href="javascript:;" data-ok="{$isxml}" data-url="{$GLOBALS['cfg_basehost']}/Sitemap.xml">查看SiteMap</a></li>
                    <li><a class="linkbtn cpybtn" id="xmlbtn" href="javascript:;" data-value="Sitemap.xml">复制链接地址</a></li>
                </ul>

                <p>
                    建议:创建、提交并更新站点地图有助于确保搜索引擎了解您网站上的重要网页和信息。
                </p>

            </div>

            <div class="sitemapbox">
                <p class="header">HTML格式sitemap</p>

                <ul class="desc">
                    <li>生成状态:<span class="gentxt">{$htmlinfo['text']}</span></li>
                    <li>生成日期:<span class="gentxt">{$htmlinfo['time']}</span></li>
                    <li>生成数量:<span class="gentxt">{$htmlinfo['number']}</span></li>
                </ul>


                <ul>
                    <li><a class="txtbtn" onclick="genHtmlMap()">生成HTML</a></li>
                    <li><a class="linkbtn" target="_blank" id="html_sitemap_btn"  href="javascript:;" data-ok="{$ishtml}" data-url="{$GLOBALS['cfg_basehost']}/Sitemap.html">查看地图</a></li>
                    <li id="clip_container"><a class="linkbtn" id="htmlbtn" href="javascript:;" data-value="Sitemap.html">复制链接地址</a></li>
                </ul>

                <p>
                    建议:创建、提交并更新站点地图有助于确保搜索引擎了解您网站上的重要网页和信息。
                </p>

            </div>








        </td>
    </tr>
</table>



<script language="JavaScript">
    $("#xml_sitemap_btn,#html_sitemap_btn").click(function(){
        var jqueryObj=$(this);
        var isok=jqueryObj.attr('data-ok');
        var url=jqueryObj.attr('data-url');
        if(isok==0)
        {
            ST.Util.showMsg('请先生成',4,1000);
            return;
        }
        window.open(url,'_blank');
    });



    $(function(){
        initObj('xmlbtn');
        initObj('htmlbtn');
        initObj('errbtn');





    })

    ZeroClipboard.setMoviePath(SITEURL+'public/js/ZeroClipboard.swf');

    function initObj(id)
    {
        var url = "{$GLOBALS['cfg_basehost']}";
        var v =url +'/'+ $('#'+id).attr('data-value');

        var clip = new ZeroClipboard.Client(); // 新建一个对象
        clip.setHandCursor( true );
        clip.setText(v); // 设置要复制的文本。
        clip.addEventListener( "mouseUp", function(client) {
            ST.Util.showMsg('复制成功',4,1000);
        });
        clip.glue(id);


    }
    function copyToClipBoardtxt(linkurl)
    {
        var clip = new ZeroClipboard.Client(); // 新建一个对象
        clip.setHandCursor( true );
        clip.setText('Sitemap.xml'); // 设置要复制的文本。
        clip.addEventListener( "mouseUp", function(client) {
            alert("复制成功！");
        });
        clip.glue("clip_button");



    }

    //生成Xml地图
    function genXmlMap()
    {


        $.ajax(
            {
                type: "post",
                dataType:"json",
                url: SITEURL+"sitemap/ajax_xmlmap",
                beforeSend: function(){
                    ST.Util.showMsg('网站xml地图正在生成中,请稍后...',6,20000);
                },
                success: function(data)
                {

                    if(data.status=='1')
                    {
                        ST.Util.hideMsgBox();
                        ST.Util.showMsg('生成成功',4,2000);
                        $("#xml_sitemap_btn").attr("data-ok",1);


                    }
                }

            }
        );



    }
    //生成html地图
    function genHtmlMap()
    {


        $.ajax(
            {
                type: "post",
                dataType:"json",
                url: SITEURL+"sitemap/ajax_htmlmap",
                beforeSend: function(){
                    ST.Util.showMsg('网站html地图正在生成中,请稍后...',6,20000);
                },
                success: function(data)
                {

                    if(data.status=='1')
                    {
                        ST.Util.hideMsgBox();
                        ST.Util.showMsg('生成成功',4,2000);
                        $("#html_sitemap_btn").attr("data-ok",1);

                    }
                }

            }
        );



    }
    //生成404地图
    function gen404Map()
    {


        $.ajax(
            {
                type: "post",
                dataType:"json",
                url: SITEURL+"sitemap/ajax_404map",
                beforeSend: function(){
                    ST.Util.showMsg('死链地图正在生成中,请稍后...',6,2000000);
                },
                success: function(data)
                {

                    if(data.status=='1')
                    {
                        ST.Util.hideMsgBox();
                        ST.Util.showMsg('生成成功',4,2000);

                    }
                }

            }
        );



    }

</script>

</body>
</html>