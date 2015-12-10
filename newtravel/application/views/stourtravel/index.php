<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{$configinfo['cfg_webname']}-思途CMS4.1</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getScript('artDialog/lib/sea.js'); }
    {php echo Common::getCss('index.css,base.css'); }
    <style>
        .no-hidden {
            overflow: auto !important
        }
    </style>
</head>

<body>
<!--顶部-->
<div class="header" id="header">
    <div class="top-page">
        <div class="logo"><img class="fl" src="{$GLOBALS['cfg_public_url']}images/logo.png" alt="思途CMS3.0" title="思途CMS3.0"/></div>
        <div class="top-operate">
            <ul class="fl">
                <li class="web-home"><a href="../" target="_blank">网站首页</a></li>
                <li class="clear-style"><a href="javascript:;" id="clearbtn">清除缓存</a></li>
                <li class="create-txt"><a href="javascript:;" id="makehtml">生成html</a></li>
                <li class="manager">
                    <a href="http://www.stourweb.com/help" id="userbtn">帮助中心</a>

                    <div class="top-help-list">
                        <a class="ico_1" target="_blank" href="http://www.stourweb.com/peixun/yingxiao-19">使用帮助</a>
                        <a class="ico_2" target="_blank" href="javascript:;">视频教程</a>
                        <a class="ico_3" target="_blank" href="http://www.stourweb.com/Member/login">意见反馈</a>
                        <a class="ico_4" target="_blank" href="http://www.stourweb.com">思途官网</a>
                        <a class="ico_5" target="_blank" href="http://www.stourweb.com/cms/jieshao">关于系统</a>
                    </div>
                </li>
                <li class="drop-out"><a href="javascript:;" id="clickout">退出</a></li>
            </ul>
        </div>

        <div id="tabs"></div>

    </div>

</div>


<!--<div id="bg" style="position: absolute;left:0;top:0;background-color: #fff;width:100%;height:100%;z-index: 9999"></div>-->
<!--<iframe id="indexfrm" src="{$cmsurl}index/index_new" width="100%" height="100%" style="position: absolute;left:0;top:0;z-index:999;border:0"></iframe>-->

<script language="JavaScript">
window.currentTab = null;
/*Ext.require([
    'Ext.tab.*'
]);
var indexfrm = $("#indexfrm");
indexfrm.load(function () {
    $('#bg').hide();
    setTimeout(function(){$('#bg').hide();},200)
});*/

Ext.onReady(function () {


    //创建viewpost,代表整个屏幕
    window.gbl_viewport = Ext.create('Ext.container.Viewport', {
        layout: 'border',
        overflowX: 'hidden',
        items: [
            {
                region: 'north',
                contentEl: 'header',
                border: false,
                cls: 'no-hidden'
            }
        ]
    });


    $.get("index/ajax_clear_log",function(data,status){

    });

    window.mainTabId='';
    //tabpanel, 放置各种页面
    window.gbl_tabs = Ext.create('Ext.tab.Panel', {
        autoScroll: false,
        region: 'center',
        border: false,
        cls: 'gbl_tabs',
        renderTo: 'tabs',
        style:'border:0px',
        bodyStyle: 'border-color:white;border-width:0px;border-style:none;border:0px',
        tabBar: {
            style: "padding-right:90px;padding-bottom:3px;line-height:30px;border-width:0px;background:#43AEE4;",
            componentCls: 'gbl-tbar',
            height: 35,
            border: 0

        },
        items: [
            {
                title: '系统主页',
                html: "<iframe src='{$cmsurl}index/index2' width='100%' height='100%' frameborder='0px' ></iframe>",

                listeners: {

                    show: function (tab) {
                       // $("#indexfrm").show();
                        window.currentTab = 0;
                        window.mainTabId=tab.getId();

                    }
                }
            }


        ],
        listeners: {
            afterrender: function (tab, eOpts) {
                //实现右键菜单功能
                tab.tabBar.el.on('contextmenu', function (event, htmlele) {
                    var ele = tab.tabBar.getChildByElement(htmlele),
                        index = tab.tabBar.items.indexOf(ele);
                    tab.menuIndex = index;
                    var menu = Ext.create("Ext.menu.Menu", {
                        items: [
                            {text: '关闭所有', handler: tab.closeAll,icon:PUBLICURL+'/images/menu_closeall.png'},
                            {text: '关闭右侧页面', handler: tab.closeRight,icon:PUBLICURL+'/images/menu_closeright.png'},
                            {text: '关闭左侧页面', handler: tab.closeLeft,icon:PUBLICURL+'/images/menu_closeleft.png'},
                            {text: '刷新当前页面', handler: tab.refreshPage,icon:PUBLICURL+'/images/menu_refresh.png'}

                        ]
                    });
                    menu.showAt(event.getXY())
                    event.preventDefault();
                    window.barmenu=menu;
                });
            },
            tabchange:function( tabPanel, newCard, oldCard, eOpts ){

                   var newId=newCard.getId();

                   if(newId!=mainTabId)
                   {
                       $(".found_box").show();
                   }
                   else
                   {
                       $(".found_box").hide();
                   }
            }

        },
        closeAll: function () {    //关闭所有
            var tab = gbl_tabs;
            tab.items.each(function (item) {
                if (item.closable)
                    tab.remove(item);
            });
        },
        closeCurrent: function ()  //关闭当前
        {
            var tab = gbl_tabs;
            if (this.items.get(this.menuIndex).closable)
                tab.remove(this.items.get(this.menuIndex));
        },
        refreshPage: function () {
            var tab = gbl_tabs;
            var panel = tab.items.get(tab.menuIndex);
            var ifm = panel.getEl().down('iframe');
            ifm.dom.contentWindow.location.reload();

        },
        closeRight: function ()   //关闭右侧
        {
            var tab = gbl_tabs;
            var i = 0;
            tab.items.each(function (item) {
                if (i > tab.menuIndex)
                    if (item.closable)
                        tab.remove(item);
                i++;
            });
        },
        closeLeft: function ()  //关闭左侧
        {
            var tab = gbl_tabs;
            var i = 0;
            tab.items.each(function (item) {
                if (i < tab.menuIndex) {
                    if (item.closable)
                        tab.remove(item);
                }
                i++;
            });
        }
    });

    //将tab面板加入视窗
    gbl_viewport.add(gbl_tabs);

    //全局设置tab 标题的宽度
    Ext.tab.Tab.prototype.maxWidth = 250;

    //tab面板右上角按钮，以菜单形式显示tab列表
    /*window.gbl_history=Ext.create('Ext.button.Button',{
     text:'',
     width:30,
     renderTo:Ext.getBody(),
     style:'position:absolute;top:75px;right:10px;z-index:400',
     menu:{
     bodyStyle:"border-width:0px",
     listeners:{
     mouseleave:function()
     {
     this.hide();
     }
     }

     },
     listeners:{
     mouseover:function()
     {
     this.menu.removeAll();
     var menu=this.menu;
     gbl_tabs.items.each(function(item,index){
     menu.add(
     {
     text:item.title,
     handler:function()
     {
     gbl_tabs.setActiveTab(index);
     }
     });

     });
     // this.showMenu();
     }
     }
     })*/


    //清除缓存
    $("#clearbtn").click(function () {
        $.ajax(
            {
                type: "post",
                url: SITEURL + 'index/ajax_clearcache',
                beforeSend: function () {
                    ST.Util.showMsg('正在清除缓存,请稍后...', 6, 20000);
                },
                success: function (data) {
                    if (data == 'ok') {
                        ST.Util.showMsg('缓存清除成功', 4, 1000);
                    }
                },

                error: function () {

                    ST.Util.showMsg("请求出错,请联系管理员", 5, 1000);
                }

            }
        );

    })

    //生成HTML
    $("#makehtml").click(function () {
        $.ajax(
            {
                type: "post",
                url: SITEURL + 'index/ajax_makehtml',
                beforeSend: function () {
                    ST.Util.showMsg('正在生成HTML,请稍后...', 6, 20000);
                },
                success: function (data) {
                    if (data == 'ok') {
                        ST.Util.showMsg('生成HTML成功', 4, 1000);
                    }
                },
                error: function () {
                    ST.Util.showMsg("请求出错,请联系管理员", 5, 1000);
                }

            }
        );

    })
    //退出
    $('#clickout').click(function () {
        ST.Util.confirmBox('退出系统', '确定退出吗?', function () {
            $('#bg').show();
            window.location.href = SITEURL + 'login/loginout';

        })

    })
    //用户管理
    $("#userbtn").click(function () {
        ST.Util.addTab('用户管理', SITEURL + 'user/list/parentkey/application/itemid/7');
    })


})

//添加面板
window.addTab = function (title, url, issingle, options) {
    $("#indexfrm").hide();
    var id = null;
    if (issingle) {
        var _url = encodeURI(url);
        id = _url.replace(/(\/)|(\/)|(\?)|(\#)|(\%)|(\&)/ig, '_');
        var current_panel = window.gbl_tabs.down('#' + id);
        if (current_panel) {
            window.gbl_tabs.setActiveTab(current_panel);
            return;
        }
    }
    var item = {
        title: title,
        html: "<iframe src='" + url + "' frameborder='0' width='100%' height='100%' scrolling='auto'  border='0'/>",
        closable: true,
        id: id,
        listeners: {
            'close': function (o) {
                var len = $('.gbl_tabs').find('.x-tab').length;
                if (len == 1) {
                    $("#indexfrm").show();
                }
            },
            show: function (item) {
                window.currentTab = item;
                item.focus();
            }
        }
    };
    Ext.apply(item, options);
    var tab = window.gbl_tabs.add(item);
    window.gbl_tabs.setActiveTab(tab);

}

//加载artDialog

window.dialog = null;
window.d = null;
seajs.config({
    alias: {
        "jquery": "jquery-1.10.2.js"
    }
});
//定义全局dialog对象
seajs.use([PUBLICURL + 'js/artDialog/src/dialog-plus'], function (dialog) {
    window.dialog = dialog;

});
//弹出框

/*
  params为附加参数，可以是与dialog有关的所有参数，也可以是自定义参数
  其中自定义参数里有
  loadWindow: 表示回调函数的window
  loadCallback: 表示回调函数
  maxHeight:指定最高高度

 */
function floatBox(boxtitle, url, boxwidth, boxheight, closefunc, nofade,fromdocument,params) {
    boxwidth = boxwidth != '' ? boxwidth : 0;
    boxheight = boxheight != '' ? boxheight : 0;
    var func = $.isFunction(closefunc) ? closefunc : function () {
    };
    fromdocument = fromdocument ? fromdocument : null;//来源document

    var initParams={
        url: url,
        title: boxtitle,
        width: boxwidth,
        height: boxheight,
        loadDocument:fromdocument,
        onclose: function () {
            func();
        }
    }
    initParams= $.extend(initParams,params);

    var dlg = window.dialog(initParams);


    if(typeof(dlg.loadCallback)=='function'&&typeof(dlg.loadWindow)=='object')
    {
       dlg.finalResponse=function(arg,bool,isopen){
            dlg.loadCallback.call(dlg.loadWindow,arg,bool);
            if(!isopen)
              this.remove();
       }
    }

    window.d=dlg;
    if (boxwidth != 0) {
        d.width(boxwidth);
    }
    if (boxheight != 0) {
        d.height(boxheight);
    }
    if (nofade) {
        d.show()
    } else {
        d.showModal();
    }

}

//计算报价(报价查看时使用)
function calPrice(obj) {
    var trs = $(obj).parents('tr:first');


    var tprice = 0;
    trs.find('input:text').each(function (index, element) {
        var price = parseInt($(element).val());
        if (!isNaN(price))
            tprice += price;
    });
    trs.find(".tprice").html("<font color='#FF9900'>" + tprice + "</font>元");
}

//显示/隐藏indexfrm
function showIndex() {
    var len = $('.gbl_tabs').find('.x-tab').length;
    if (len == 1) {
        return false;
    }
    if (window.currentTab == 0) {
        window.gbl_tabs.setActiveTab(1);
    }

    $("#indexfrm").toggle();
}
function hideIndex() {
    var len = $('.gbl_tabs').find('.x-tab').length;
    if (len == 1) {
        return false;
    }
    $('#indexfrm').hide();
    if (window.currentTab == 0) {
        window.gbl_tabs.setActiveTab(1);
    }
    else {
        window.gbl_tabs.setActiveTab(window.currentTab);
    }

}

$(function () {
    $.hotkeys.add('f', function () {
        $('.found_menu_box').toggle();
    });
})
//帮助说明  b n vb
$(".manager").mouseenter(function () {

    $(".top-help-list").show();

})

$(".manager").mouseleave(function () {

    $(".top-help-list").hide();

})


</script>

{template 'stourtravel/public/found'}
</body>

</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.3102&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
