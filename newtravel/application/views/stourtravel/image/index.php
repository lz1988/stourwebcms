<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>图片管理-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,image.css,base.css,base2.css,plist.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,jquery.buttonbox.js,choose.js"); }
</head>
<body>
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td" style="overflow:hidden;padding:8px 0 0 18px">
            <div class="picmanage_box" id="dirs">
                <div class="up_built_menu">
                    <a class="up_pic_btn upFile" data="1" href="#">上传图片</a>
                    <a class="cj_pic_box" id="create-group" href="#">创建相册</a>
                    <a class="cf_pic_box" id="img-config" href="#">图库配置</a>
                    <span class="dr_pic">导入历史图片</span>
                </div>
                <div class="picmanage_list_con" id="">
                    <ul id="content">
                        <li data="1">
                            <i></i>
                            <a class="pic" href="#">
                                <img src="<?php echo $pulic . 'images/default.gif'; ?>" alt="系统目录"/></a>

                            <div class="txt">
                                <input type="text" disabled="disabled" value="系统目录" data="1" class="pic_name"/>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="picmanage_box hide" id="images">
                <div class="up_built_menu">
                    <a class="up_pic_btn upFile" data="" href="#">上传图片</a>
                    <a class="gl_pic_box gl-images" href="#">批量管理</a>

                    <div class="pl_gl gl-images">
                        <span id="moveMore">批量移动</span>
                        <span id="delMore">批量删除</span>
                    </div>
                    <span class="reback" id="reback"><i></i>返回上一级</span>
                </div>
                <div class="picmanage_list_con">
                    <ul class="img-content">
                    </ul>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
$(function () {
    //文件夹管理
    var tpl = '<li data="{group_id}"><i></i>'
        + '<a class="pic"><img src="{url}" alt="{group_name}" /></a>'
        + '<div class="txt">'
        + '<input type="text" disabled="disabled" data="{group_name}" value="{group_name}" class="pic_name" />'
        + '<span class="del">删除</span>'
        + '<span class="edit">编辑</span>'
        + '</div>'
        + '</li>';
    tpl = tpl.replace(/\{(.*?)\}/g, "'+data[i][\"" + '$1' + "\"]+'");
    //初始化加载
    reloadDirs();
    function reloadDirs() {
        var html = '';
        $.post(SITEURL + 'image/group_manage', {'action': 'find'}, function (data) {
            for (var i in data) {
                html += eval("'" + tpl + "'");
            }
            var ul = $('#dirs').find('ul');
            ul.find('li:gt(0)').detach();
            ul.append(html);
        }, 'json');
    }

    //图片展示
    $('#dirs').find('.pic').live('click', function () {
        var pid = $(this).parents('li').attr('data');
        getImages(pid, 1);
        $('#images').siblings('.picmanage_box').addClass('hide');
        $('#images').removeClass('hide');
        $('#images').find('.upFile').attr('data',pid);
    });
    function getImages(pid, p) {
        var imgTpl = tpl;
        imgTpl = imgTpl.replace(/group_/g, '');
        if (p == 1) {
            $('#images').find('ul').html('');
        }
        $('#images').attr('data',pid+'_'+p);
        $.post(SITEURL + 'image/image_manage', {'pid': pid, 'page': p, 'action': 'find'}, function (data) {
            var html = '';
            if (data.length > 0) {
                for (var i in data) {
                    if(data[i]['name']==''){
                        data[i]['name']=data[i]['url'].match(/[a-z0-9]{32}/);
                    }
                    html += eval("'" + imgTpl + "'");
                }
            }else{
                $('#images').removeAttr('data');
            }
            $('#images').find('ul').append(html);
        }, 'json');
    }

    //获取焦点
    $('.edit').live('click', function () {
        $(this).parents('li').find('input:eq(0)').removeAttr('disabled').css('border-color', '#43aee4').focus();
    });
    //失去焦点
    $('.pic_name').live('blur', function () {
        var val = $(this).val();
        var attr = $(this).attr('data');
        if (val == '') {
            alert('分组名不能为空');
            return;
        }
        if (val != attr) {
            var category = $(this).parents('.picmanage_box').attr('id');
            var data = {'id': $(this).parents('li').attr('data'), 'name': val};
            category == 'dirs' ? group_manage('edit', data) : image_manage('edit', data);
        }
        $(this).css('border-color', '#fff').attr('disabled', 'disabled');
    });
    $('.del').live('click', function () {
        var category = $(this).parents('.picmanage_box').attr('id');
        var parentNode = $(this).parents('li');
        var data = {'id': parentNode.attr('data')};
        var info = category == 'dirs' ? '相册' : '图片';
        ST.Util.confirmBox('提示', '是否删除该' + info, function () {
            category == 'dirs' ? group_manage('delete', data) : image_manage('delete', data);
            parentNode.remove();
        });


    });
    //分组重名、删除
    function group_manage(action, data) {
        switch (action) {
            case 'edit':
                data.action = 'rename';
                $.post(SITEURL + 'image/group_manage', data);
                break;
            case 'delete':
                data.action = 'delete';
                $.post(SITEURL + 'image/group_manage', data);
                break;
        }
    }

    //创建分组
    function addGroup(reuslt, bool) {
        if (!bool)
            return;
        reuslt.data.action = 'add';
        if (!reuslt.data.group_name) {

        }
        $.ajax({
            url: SITEURL + 'image/group_manage',
            async: false,
            type: 'POST',
            dataType: 'json',
            data: reuslt.data,
            success: function (data) {
                if(data > 0){
                    ST.Util.showMsg("添加成功", 4);
                    reloadDirs();
                }else{
                   ST.Util.showMsg("添加失败", 5);
                }
            }
        });
    }

    $('#create-group').click(function () {
        ST.Util.showBox('创建相册', SITEURL + 'image/group_view', 340, 191, null, null, document, {loadWindow: window, loadCallback: addGroup});
    });
    //图片管理
    $('#images').find('.pic').live('click', function () {
        if( $('.pl_gl').css('display')=='none'){
            return;
        }
        var parent = $(this).parent();
        if (parent.hasClass('on')) {
            parent.removeClass('on');
        } else {
            parent.addClass('on');
        }
    });
    //图片重命名、删除
    function image_manage(action, data) {
        switch (action) {
            case 'edit':
                data.action = 'rename';
                $.post(SITEURL + 'image/image_manage', data);
                break;
            case 'delete':
                data.action = 'delete';
                $.post(SITEURL + 'image/image_manage', data);
                break;
        }
    }

    //返回上一级
    $('#reback').click(function () {
        reloadDirs();
        $('.pl_gl').css('display','none');
        $('#dirs').removeClass('hide').siblings().addClass('hide');
    });
    //批量处理显示
    $('.gl_pic_box').click(function () {
        if($('.pl_gl').css('display')!='none'){
            $('.pl_gl').css('display','none');
            $('.picmanage_list_con').removeClass('cursor').find('li').removeClass('on');
            return;
        }
        $('.pl_gl').show();
        $('.picmanage_list_con').addClass('cursor');
    });
    //批量删除
    $('#delMore').click(function () {
        var lis = $('#images .picmanage_list_con').find('li.on');
        if (lis.length < 1) {
            ST.Util.showMsg("没有选择要删除的图片！", 1);
            return;
        }
        ST.Util.confirmBox('提示', '是否删除所选图片', function () {
            var ids = new Array();
            lis.each(function () {
                ids.push($(this).attr('data'));
            });
            $.post(SITEURL + 'image/image_manage', {action: 'delete', id: ids.join(',')}, function (data) {
                if(data > 0 ){
                    ST.Util.showMsg("删除成功！", 4);
                    $('#images').find('li.on').remove();
                }else{
                    ST.Util.showMsg("删除失败！", 5);
                }

            }, 'json');
        });
    });
    //批量移动
    $('#moveMore').click(function () {
        var lis = $('#images .picmanage_list_con').find('li.on');
        if (lis.length < 1) {
            ST.Util.showMsg("没有选择要移动的图片！", 1);
            return;
        }
        var arr = new Array();
        lis.each(function () {
            arr.push($(this).attr('data'));
        });
        ST.Util.showBox('移动到相册', SITEURL + 'image/image_move/id/' + arr.join(','), 457, 340, null, null, document, {loadWindow: window, loadCallback: moveMore});
    });
    function moveMore(result, bool) {
        if (bool) {
            //重载
            ST.Util.showMsg("移动成功！", 1);
        } else {
            ST.Util.showMsg("移动失败！", 1);
        }
       $('#images').find('li.on').remove();
    }

    //导入图片
    $('.dr_pic').click(function () {
        ST.Util.showBox('导入选项', SITEURL + 'image/dir_import', 341, 136, null, null);
    });
    //上传图片
    $('.upFile').click(function () {
        ST.Util.showBox('上传图片', SITEURL + 'image/upload_view/groupid/'+$(this).attr('data'), 700, '', null, null,document,{loadWindow: window, loadCallback: uploadInfo});
        function uploadInfo(res,bool){
           var id=$('#images').find('.upFile').attr('data');
            if(id==res.id){
                getImages(id, 1);
            }
        }
        return;
    });
    //滚动加载
    $(window).scroll(function(){
        if(!$('#images').hasClass('hide') && $('#images').attr('data')){
            viewH =$(this).height();
            contentH =$('#images').height(),//内容高度
            scrollTop =$(this).scrollTop();//滚动高度
            if(contentH-viewH-scrollTop<100){
               var data=$('#images').attr('data').split('_');
                getImages(data[0], parseInt(data[1])+1);
            }
        }
    });
    //图库配置
    $('#img-config').click(function(){
        ST.Util.showBox('图库配置', SITEURL + 'image/config',330,'', null, null, document, {loadWindow: window, loadCallback: imgConfig});
        function imgConfig(res,bool){
            if (bool) {
                ST.Util.showMsg(res, 1);
            } else {
                ST.Util.showMsg(res, 1);
            }
        }
    });

})

</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.0606&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
