<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>图片导入-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,image.css,base.css,base2.css,plist.css'); }
</head>
<body>
<div class="pic_photo_df" id="content">
    <dl>
        <dt>图片来源：</dt>
        <dd><input type="text" id="path" class="xc_text" value="<?php echo $uploads;?>"/></dd>
    </dl>
    <dl>
        <dt>导入相册：</dt>
        <dd>
            <select id="group">
                <?php foreach($dir as $v):?>
                <option value="<?php echo $v['group_id'];?>"><?php echo $v['group_name'];?></option>
                <?php endforeach;?>
            </select>
        </dd>
    </dl>
    <div class="btn">
        <a class="cancel_btn" href="#">取消</a>
        <a class="confirm_btn" id="confirm_btn" href="#">确定</a>
    </div>
</div>
<!--导入选项-->
</body>
<script type="text/javascript" charset="utf-8">
    $('.cancel_btn').live('click', function () {
        ST.Util.closeBox();
    });
    var group=$('#group').val();
    $('#group').change(function(){
        group=$(this).val();
    });
    $('#confirm_btn').click(function(){
        var pathDir=$('#path').val();
        $('#content').html('正在扫描指定目录,需耐心等待......');
        $.post(SITEURL+'image/dir_scan',{path:pathDir},function(data){
            $('#content').html('共扫描到'+data['count']+'个文件夹');
            if(data['count']>0){
                var i=0;
                while(i < data['count']){
                    var path=data['dirs'][i]['path'];
                    $('#content').html('<p>'+path+'---------'+(++i)+'/'+data['count']+'</p>');
                    $.ajax({
                        url:SITEURL+'image/target_dir',
                        async:false,
                        type:'POST',
                        data:{'path':path,'group':group}
                    });
                }
            }
            $('#content').append('<p>导入完成</p><div class="btn"><a class="cancel_btn" href="#">关闭</a></div>');
        },'json');
        return;
    });
</script>
</html>
