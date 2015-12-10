<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>图片库配置-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,image.css,base.css,base2.css,plist.css'); }
</head>
<body>
<div class="pic_library">
    <div class="bt">是否开启远程上传？</div>
    <div class="library_con" id="remote_image">
        <div class="tabnav">
            <span data="0" class="<?php if(!$config[remote_image]){echo 'on';}?>">否</span>
            <span data="1" class="<?php if($config[remote_image]){echo 'on';}?>">是</span>
        </div>
        <div class="tabcon" style="<?php if(!$config[remote_image]){echo 'display:block';}?>">
            <table width="100%" border="0">
                <tr>
                    <th width="20%" scope="row">图片域名：</th>
                    <td width="80%"><input name="img_domain" type="text" class="xc_text" value="<?php echo $config['img_domain'];?>" /></td>
                </tr>
            </table>
        </div>
        <div class="tabcon" style="<?php if($config[remote_image]){echo 'display:block';}?>">
            <table width="100%" border="0">
                <tr>
                    <th width="20%" height="35" scope="row">FTP地址：</th>
                    <td width="80%"><input type="text" name="ftp_host" class="xc_text" value="<?php echo $config['ftp_host'];?>"/></td>
                </tr>
                <tr>
                    <th width="20%" height="35" scope="row">FTP端口：</th>
                    <td width="80%"><input type="text" name="ftp_port" class="xc_text" value="<?php echo $config['ftp_port'];?>"/></td>
                </tr>
                <tr>
                    <th width="20%" height="35" scope="row">FTP账号：</th>
                    <td width="80%"><input type="text" name="ftp_user" class="xc_text" value="<?php echo $config['ftp_user'];?>"/></td>
                </tr>
                <tr>
                    <th width="20%" height="35" scope="row">FTP密码：</th>
                    <td width="80%"><input type="text" name="ftp_pwd" class="xc_text" value="<?php echo $config['ftp_pwd'];?>"/></td>
                </tr>
                <tr>
                    <th width="20%" height="35" scope="row">图片目录：</th>
                    <td width="80%"><input type="text" name="remote_upload" class="xc_text" value="<?php echo $config['remote_upload'];?>" /></td>
                </tr>
                <tr>
                    <th width="20%" height="35" scope="row">图片域名：</th>
                    <td width="80%"><input type="text" name="img_domain"  class="xc_text" value="<?php echo $config['img_domain'];?>" /></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="btn">
        <a class="cancel_btn" href="#">取消</a>
        <a class="confirm_btn" href="#">确定</a>
    </div>
</div>
<!--图库配置-->
</body>
<script type="text/javascript" charset="utf-8">
    //取消
    $('.cancel_btn').live('click', function () {
        ST.Util.closeBox();
    });
    //切换
    $('#remote_image').find('span').click(function(){
        var index=$(this).index();
        $(this).addClass('on').siblings().removeClass('on');
        $('.tabcon').eq(index).css('display','block').siblings('.tabcon').css('display','none');
        ST.Util.resizeDialog('.pic_library');

    });
    //确定
    $('.confirm_btn').click(function () {
        var data={};
        var index=$('#remote_image').find('span.on').attr('data');
        var msg=false;
        $('.tabcon').eq(index).find('input').each(function(){
            var name=$(this).attr('name');
            var val=$(this).val();
            if(index==1 && val=='' && name!='remote_upload'){
                msg=$(this).parent().prev('th').text().replace('：','')+'不能为空';
                return false;
            }
            data[name]=val;
        });
        if(msg){
            ST.Util.showMsg(msg, 1);
            return;
        }
        data.remote_image=index;
        $.ajax({
            type: "POST",
            url: SITEURL + 'image/config/set/',
            data:data,
            async:false,
            success:function (data) {
                var bool=false;
                if (data == 'success') {
                    data='配置成功';
                    bool=true;
                }
                ST.Util.responseDialog(data,bool);
            }
        });
    });
</script>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.0601&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
