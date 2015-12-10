<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>上传图片-思途CMS3.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('style.css,image.css,base.css,base2.css,plist.css'); }
    <script type="text/javascript" src="<?php echo $publicPath;?>js/image/plupload.full.min.js"></script>
    <script type="text/javascript" src="<?php echo $publicPath;?>js/image/zh_CN.js"></script>
</head>
<body>
<div class="photo_sc_box">
    <div class="photo_pic_tit">
        <span>上传到：</span>
        <select name="group" id="group">
            <?php foreach ($group as $v): ?>
                <option <?php if($v['group_id']==$id){ echo 'selected="selected"';}?> value="<?php echo $v['group_id']; ?>"><?php echo $v['group_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="photo_pic_con">
        <ul>
            <li class="add_photo_btn"><span id="add"></span></li>
        </ul>
    </div>
    <div class="upload_schedule">
        <span class="sp1">上传速度：</span>

        <div class="jd">
            <span id="percent"></span>
            <em><i id="current">0</i>/<i id="total">0</i></em>
        </div>
        <i id="bytes">0</i>K/秒
    </div>
    <div class="cz_btn">
        <a class="cancel_btn" href="#">取消</a>
        <a class="save_btn" id="uploadfiles" href="#">上传</a>
    </div>
</div>
</body>
<script type="text/javascript">
    var groupid=$('#group').val();
    $('#group').change(function(){
        groupid=$(this).val();
    });
    var uploader = new plupload.Uploader({
        browse_button: 'add',
        url: 'temp',
        flash_swf_url: '<?php echo $publicPath;?>js/image/Moxie.swf',
        silverlight_xap_url : '<?php echo $publicPath;?>js/image/Moxie.xap',
        filters: {
            max_file_size: '2mb',
            mime_types: [
                {title: "Image files", extensions: "jpg,gif,png,jpeg"},
            ]
        },
        init: {
            PostInit: function () {
                $('#uploadfiles').click(function(){
                    uploader.start();
                    return false;
                });
            },
            FilesAdded: function (up, files) {
                plupload.each(files, function (file) {
                    var tpl='<li id="{id}">'
                        +'<i class="closed"></i>'
                        +'<span>'
                        +'<img src="{imgsrc}"  width="86" height="86" />'
                        +'<em class="progress"></em>'
                        +'</span>'
                        +'<input type="text" class="text_name" />'
                        +' </li>';
                    tpl=tpl.replace("{id}",file.id);
                        previewImage(file, function (imgsrc) {
                            tpl=tpl.replace("{imgsrc}",imgsrc);
                            $('.add_photo_btn').before(tpl);
                        })
                });
                var total=$('#total').text();
                if(total>0){
                    $('#total').text(parseInt(total)+files.length);
                }else{
                    $('#total').text(files.length);
                }
                $('#percent').css('width','0%');
                $('#current').text(0);
            },
            BeforeUpload:function(uploader,file){

               uploader.settings.url = SITEURL+'image/upload/groupid/'+groupid+'/name/'+$("#"+file.id).find('.text_name').val();
            },
            UploadProgress: function (up, file) {
                $('#'+file.id).find('.progress').html('<s style=" width:'+file.percent+'%"></s><b>'+file.percent+'%</b>');
            },
            FileUploaded:function(uploader,file){
                $('#percent').css('width',(uploader.total.loaded/uploader.total.size).toFixed(2)*100+'%');
                $('#current').text(uploader.total.uploaded);
                $('#bytes').text(Math.ceil(uploader.total.bytesPerSec/1024));
                $('#'+file.id).find('.closed').remove();
            },
            Error: function (up, err) {
                console.log(err.message);
            },
            UploadComplete:function(uploader,files){
              $('.photo_pic_con').html('<div class="upload_success">上传成功'+files.length+'张照片</div>');
              $('.upload_schedule').css('display','none');
              $('.cz_btn').html('<a class="save_btn" id="cuccess" href="#">确定</a>');
            }
        }
    });
    function previewImage(file, callback) {
        if (!file || !/image\//.test(file.type)) return;
        if (file.type == 'image/gif') {
            var fr = new mOxie.FileReader();
            fr.onload = function () {
                callback(fr.result);
                fr.destroy();
                fr = null;
            }
            fr.readAsDataURL(file.getSource());
        } else {
            var preloader = new mOxie.Image();
            preloader.onload = function () {
                preloader.downsize(86, 86);
                var imgsrc = preloader.type == 'image/jpeg' ? preloader.getAsDataURL('image/jpeg', 80) : preloader.getAsDataURL(); //得到图片src,实
                callback && callback(imgsrc);
                preloader.destroy();
                preloader = null;
            };
            preloader.load(file.getSource());
        }
    }
    uploader.init();
    $('.photo_pic_con').find('.closed').live('click',function(){
        var parent=$(this).parents('li');
        uploader.removeFile(parent.attr('id'));
        parent.remove();
        $('#total').text($('#total').text()-1);
    });
    //取消
    $('.cancel_btn').live('click', function () {
        ST.Util.closeBox();
    });
    $('#cuccess').live('click',function(){
        //ST.Util.closeBox();
        ST.Util.responseDialog({id:groupid},true);
    });
</script>
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.1302&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
