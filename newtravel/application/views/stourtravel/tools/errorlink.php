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
                <p class="header">404死链地图</p>

                <ul class="desc">
                    <li>生成状态:<span class="gentxt">{$errinfo['text']}</span></li>
                    <li>生成日期:<span class="gentxt">{$errinfo['time']}</span></li>
                    <li>生成数量:<span class="gentxt">{$errinfo['number']}</span></li>
                </ul>


                <ul>
                    <li><a class="txtbtn" onclick="gen404Map()">生成死链</a></li>
                    <li><a class="linkbtn" target="_blank" href="{$cfg_basehost}/404Sitemap.txt">查看死链</a></li>
                    <li><a class="linkbtn cpybtn" id="errbtn" href="javascript:;" data-value="404Sitemap.txt">复制链接地址</a></li>
                </ul>

                <p>
                    建议:建议复制这些地址提交到百度站长工具的 死链工具 可以达到阻止百度抓取这些错误信息的作用，提高在百度中的排名。
                </p>

            </div>






        </td>
    </tr>
</table>



<script language="JavaScript">
    ZeroClipboard.setMoviePath(SITEURL+'public/js/ZeroClipboard.swf');

    $(function(){

        initObj('errbtn');


    })

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
                    console.log(data.status);
                    if(data.status=='1')
                    {
                        ST.Util.hideMsgBox();
                        ST.Util.showMsg('生成成功',4,2000);

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
                    console.log(data.status);
                    if(data.status=='1')
                    {
                        ST.Util.hideMsgBox();
                        ST.Util.showMsg('生成成功',4,2000);

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