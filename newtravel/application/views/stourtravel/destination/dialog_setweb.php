<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,listimageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    {php echo Common::getCss('base.css,style.css,destination_dialog_setweb.css'); }
</head>
<body >
   <div class="s-main">
       <div class="basic-con">
           <table>
               <tr><td class="tit" width="80">子站域名：</td><td><input type="text" class="set-text-xh text_250" name="weburl"/></td></tr>
               <tr><td></td><td><p>*开启子站功能,当前目的地站点下的所有数据将会在子站打开；<br/>*可自定义子站主机头如：http://chengdu.stourweb.com可改为<br/>http://cd.stourweb.com</p></td></tr>
           </table>
       </div>
       <div class="save-con">
           <a href="javascript:;" class="cancel-btn">放弃</a>&nbsp;&nbsp;<a href="javascript:;" class="confirm-btn">开启</a>
       </div>
   </div>
<script>
    var id="{$id}";
    var pinyin="{$pinyin}";
    $(function() {

        var domsiteurl = document.domain;
        var urlarr = domsiteurl.split('.');
        if(urlarr.length == 3){
            domsiteurl = urlarr[1]+'.'+urlarr[2];
        }
        domsiteurl = 'http://'+pinyin+'.'+domsiteurl;
        $("input[name=weburl]").val(domsiteurl);




        $(document).on('click','.confirm-btn',function(){
            var weburl=$("input[name=weburl]").val();
            ST.Util.responseDialog({id:id,weburl:weburl},true);
        })

        $(document).on('click','.cancel-btn',function(){
            ST.Util.closeDialog();
        })


    })
</script>

</body>
</html>
