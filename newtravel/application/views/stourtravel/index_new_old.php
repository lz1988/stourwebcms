<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途3.0后台首页</title>
    {php echo Common::getScript('jquery-1.8.3.min.js,common.js,jquery.hotkeys.js,msgbox/msgbox.js'); }
    {php echo Common::getCss('msgbox.css','js/msgbox/'); }
    {php echo Common::getCss('index.css,base.css');}

</head>

<body>

<div class="head-top">
    <h1>思途CMS 3.0</h1>
    <div class="top-operate">
        <ul class="fl">
            <li class="web-home"><a href="../../" target="_blank"><img src="{$GLOBALS['cfg_public_url']}images/top-operate-01.png" alt="网站首页" title="网站首页"></a></li>
            <li class="clear-style"><a href="javascript:;" id="clearbtn"><img src="{$GLOBALS['cfg_public_url']}images/top-operate-02.png" alt="清除缓存" title="清除缓存"></a></li>
            <li class="create-txt"><a href="javascript:;" id="makehtml"><img src="{$GLOBALS['cfg_public_url']}images/top-operate-03.png" alt="生成HTML" title="生成HTML"></a></li>
            <li class="manager">
                <a href="javascript:;" id="userbtn"><img src="{$GLOBALS['cfg_public_url']}images/top-operate-04.png" alt="帮助" title="帮助"></a>
                <div class="top-help-list">
                    <a class="ico_1" target="_blank" href="http://www.stourweb.com/peixun/yingxiao-19">使用帮助</a>
                    <a class="ico_2" target="_blank" href="javascript:;">视频教程</a>
                    <a class="ico_3" target="_blank" href="http://www.stourweb.com/Member/login">意见反馈</a>
                    <a class="ico_4" target="_blank" href="http://www.stourweb.com">思途官网</a>
                    <a class="ico_5" target="_blank" href="http://www.stourweb.com/cms/jieshao">关于系统</a>
                </div>
            </li>
            <li class="drop-out"><a href="javascript:;" id="clickout"><img src="{$GLOBALS['cfg_public_url']}images/top-operate-05.png" alt="退出" title="退出"></a></li>

        </ul>
    </div>
</div><!--首页顶部-->

<div class="gn-ts-cum">

    <p id="info1" style="display: none">欢迎使用思途CMS！您已获取官方正版授权,受法律保护!</p>
    <p id="info2" style="display: none">您还未获得思途CMS的正版授权，盗版使用会面临刑法处罚，请<a href="http://www.stourweb.com/cms/accredit" target="_blank">联系我们</a></p>

    <p id="newversion" style="display: none">系统有新版本发布，建议升级！<a href="javascript:;" onclick="ST.Util.addTab('系统升级','{$cmsurl}/app/upgrade/parentkey/application/itemid/1')">立即升级</a></p>
    <a class="back-ico" href="javascript:;" onclick="parent.window.hideIndex()">返回</a>
</div>

<div class="best_news" style="display: none">
	<p class="tit">最新版本&nbsp;&nbsp;<span id="new_pubdate"></span>&nbsp;&nbsp;星期四&nbsp;&nbsp;改进</p>
  <div class="news_con" onClick="window.open('http://www.stourweb.com/cms/banben')">
  	<ul id="new_desc">

    </ul>
  </div>
</div>

<div class="ma-wid_1000">
    <div class="main-nr-top">
        <ul>
            <li data-listid="test1">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_01.png" /><span>产品系统</span>
                </p>
            </li>
            <li data-listid="test2">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_02.png" /><span>软文系统</span>
                </p>
            </li>
            <li data-listid="test3">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_03.png" /><span>订单管理</span>
                </p>
            </li>
            <li data-listid="test9">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_09.png" /><span>会员管理</span>
                </p>
            </li>
            <li data-listid="test7"  >
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_07.png" /><span>营销策略</span>
                </p>
            </li>
            <li data-listid="test6" class="mr_0">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_06.png" /><span>模板管理</span>
                </p>
            </li>



        </ul>
    </div>
</div>

<div class="hide-con-box">
    <div class="ma-wid_1000">
        <div class="list-box" id="test1">
            {loop $menu['product'] $v}
             <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
            {loop $addmodule $v}
            <a href="javascript:;" data-url="tongyong/index/typeid/{$v['id']}/parentkey/product/itemid/{$v['id']}"><img src="{$GLOBALS['cfg_public_url']}images/tongyong.png" /><span>{$v['modulename']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test2">
            {loop $menu['article'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test3">
            {loop $menu['order'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
            {loop $addmodule $v}

            <a href="javascript:;" data-url="order/index/parentkey/order/itemid/{$v['id']}/typeid/{$v['id']}"><img src="{$GLOBALS['cfg_public_url']}images/chindren-ico-jp.png" /><span>{$v['modulename']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test9">
            {loop $menu['member'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test6">
            {loop $menu['templet'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test7">
            {loop $menu['sale'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>

    </div>
</div>

<div class="ma-wid_1000">
    <div class="main-nr-top">
        <ul>
            <li data-listid="test5">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_05.png" /><span>分类设置</span>
                </p>
            </li>
            <li data-listid="test4">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_04.png" /><span>站点设置</span>
                </p>
            </li>
            <li data-listid="test8">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_08.png" /><span>系统配置</span>
                </p>
            </li>
            <li data-listid="test11">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_11.png" /><span>优化应用</span>
                </p>
            </li>
            <li data-listid="test10">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_10.png" /><span>增值应用</span>
                </p>
            </li>
            <li class="mr_0" data-listid="question">
                <p>
                    <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-cms-ico_12.png" /><span>问题反馈</span>
                </p>
            </li>
        </ul>
    </div>
</div>

<div class="hide-con-box">
    <div class="ma-wid_1000">
        <div class="list-box" id="test5">
            {loop $menu['kind'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test4">
            {loop $menu['basic'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test8">
            {loop $menu['system'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test11">
            {loop $menu['tool'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>
        <div class="list-box" id="test10">
            {loop $menu['application'] $v}
            <a href="javascript:;" data-url="{$v['url']}"><img src="{$GLOBALS['cfg_public_url']}images/{$v['ico']}" /><span>{$v['name']}</span></a>
            {/loop}
        </div>

    </div>
</div>

<div class="ma-wid_1000">
    <div class="st-sm-con">
        <dl>
            <dt>
                <img class="fl" src="{$GLOBALS['cfg_public_url']}images/st-logo.png" />
                <a href="http://www.stourweb.com/peixun/yingxiao-6" target="_blank">SEO优化</a>
                <a href="http://www.stourweb.com/peixun/yingxiao-8" target="_blank">整合营销</a>
                <a href="http://www.stourweb.com/peixun/yingxiao-7" target="_blank">社会化</a>
                <a href="http://www.stourweb.com/peixun/yingxiao-60" target="_blank">行业</a>
                <a href="http://www.stourweb.com/peixun/yingxiao-67" target="_blank">经营管理</a>
            </dt>

             <dd id="article_list"></dd>

        </dl>
        <div class="about-st">
            <h3>关于思途</h3>
            <ul>
                <li>
                    <span>版权所有：</span>
                    <p>成都梦旅程网络科技有限公司</p>
                </li>
                <li>
                    <span>开发团队：</span>
                    <p>Netman、Nabo、Snake、wang、豆子、孜龍、许强、邓顺元</p>
                </li>
                <li>
                    <span>优化团队：</span>
                    <p>讨口子、镀金尐鋤頭、泉水叮咚、华生、浩然 、雪樱、小芳、思琦</p>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="ma-wid_1000">
    <div class="index_foot">
        <p>成都梦旅程网络科技有限公司（荣誉产品）思途旅游CMS系统 2007 - 2014 © www.Stourweb.com</p>
    </div>
</div>
<script language="JavaScript">
		
    var SITEURL = '{php echo URL::site();}';
    $(function(){
        $(".main-nr-top ul li").click(function(){

            var listid = $(this).data("listid");
            if(listid !='question'){
                $(this).addClass("current").siblings().removeClass("current");
                $(this).parents(".ma-wid_1000").next(".hide-con-box").show().siblings(".hide-con-box").hide();
                $(this).parents(".ma-wid_1000").siblings('.ma-wid_1000').find('.current').removeClass('current');

                $("#"+listid).show().siblings().hide();
            }
            else{
                window.open('http://www.stourweb.com/Member/Login');
            }


            //alert(listid)

        })
          //点击
            $('.list-box').find('a').click(function(){
                var title = $(this).find('span').html();
                var url = $(this).attr('data-url');
                ST.Util.addTab(title,url);
            })

         //异步获取文章


        //事件
        //清除缓存
        $("#clearbtn").click(function(){
            $.ajax(
                {
                    type: "post",
                    url: SITEURL+'index/ajax_clearcache',
                    beforeSend: function(){
                        ST.Util.showMsg('正在清除缓存,请稍后...',6,20000);
                    },
                    success: function(data)
                    {
                        if(data=='ok')
                        {
                            ST.Util.showMsg('缓存清除成功',4,1000);
                        }
                    },

                    error: function()
                    {

                        ST.Util.showMsg("请求出错,请联系管理员",5,1000);
                    }

                }
            );

        })

        //生成HTML
        $("#makehtml").click(function(){
            $.ajax(
                {
                    type: "post",
                    url: SITEURL+'index/ajax_makehtml',
                    beforeSend: function(){
                        ST.Util.showMsg('正在生成HTML,请稍后...',6,20000);
                    },
                    success: function(data)
                    {
                        if(data=='ok')
                        {
                            ST.Util.showMsg('生成HTML成功',4,1000);
                        }
                    },
                    error: function()
                    {
                        ST.Util.showMsg("请求出错,请联系管理员",5,1000);
                    }

                }
            );

        })
        //退出
        $('#clickout').click(function(){
                $(window.parent.document).find("#bg").show();
                window.location.href=SITEURL+'login/loginout';
								

        })
        //用户管理
        $("#userbtn").click(function(){
            ST.Util.addTab('用户管理',SITEURL+'user/list/parentkey/application/itemid/7');
        })

        getLastArticle();

        //帮助说明  b n vb
        $(".manager").mouseenter(function(){

            $(".top-help-list").show();

        })

        $(".manager").mouseleave(function(){

            $(".top-help-list").hide();

        })

        //新版检测
        $.ajax({
            url: SITEURL+"app/ajax_check_update",
            dataType: 'json',
            success: function(data){

                if(data.newinfo.desc){
                    $("#new_desc").html(data.newinfo.desc);
                    $("#new_pubdate").html(data.newinfo.pubdate);
                    $(".best_news").show();
                }

                if(data.releasenum!='')
                {
                    $("#newversion").show();

                }
                else
                {
                     checkRightV();
                }
            }});



    })

    //异步获取文章
    function getLastArticle()
    {
        $.ajax({
            type:'POST',
            url:SITEURL+'index/ajax_get_last_article',
            dataType:'json',
            success:function(data){
                var list = '';
                $.each(data,function(i,row){
                    list+='<a href="http://www.stourweb.com'+row.url+'" target="_blank">'+row.title+'</a>';
                });
                $("#article_list").html(list)

            }
        })
    }

    //检测正版授权
    function checkRightV()
    {
        $.ajax({
            url: SITEURL+"app/ajax_check_right",
            dataType: 'json',
            success: function(data){

                if(data.status==1){
                    $('#info1').show();
                }
                else{
                    $('#info2').show();
                }
            }});

    }
		
		//判断非IE内核提示语
		if($.browser.msie && $.browser.version<10){
				//alert("请使用非IE内核浏览器管理后台，这样才能有更好的体验，比如：火狐，谷歌");
		}
		
		
		//滚动显示更新内容
    
        function AutoScroll(obj) {

            $(obj).find("ul:first").animate({
                marginTop: "-30px"
            }, 1000, function() {
                $(this).css({ marginTop: "0px" }).find("li:first").appendTo(this);
            });
        }
        $(document).ready(function() {
            var myar = setInterval('AutoScroll(".news_con")', 2000)
            $(".news_con").hover(function() { clearInterval(myar); }, function() { myar = setInterval('AutoScroll(".news_con")', 2000) }); //当鼠标放上去的时候，滚动停止，鼠标离开的时候滚动开始
        });
		
</script>

</body>
</html>
