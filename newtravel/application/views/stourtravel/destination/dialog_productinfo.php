<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,listimageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    {php echo Common::getCss('base.css,style.css,destination_dialog_basicinfo.css'); }
</head>
<body >
   <div class="s-main">
       <div class="main-body">
           <div class="nav">
               <div class="w-set-tit bom-arrow">
                   <span data-rel="seo" class="on"><s></s>优化信息</span>
                   <span  data-rel="jieshao" ><s></s>页面介绍</span>
                   <span data-rel="template"><s></s>模板设置</span>
               </div>
               <div class="clear-both"></div>
           </div>
           <div class="nav-list">
               <div class="item-one" id="item_jieshao" style="display: none;">
                   <table>

                       <tr><td class="tit">介绍：</td><td  class="u-editor">  {php Common::getEditor('jieshao',$info['jieshao'],500,180);}</td></tr>
                   </table>
               </div>
               <div class="item-one" id="item_seo">
                   <table>
                       <tr><td class="tit">显示条数：</td><td><input class="set-text-xh text_250" name="shownum" value="{$info['shownum']}"/></td></tr>
                       <tr><td class="tit">优化标题：</td><td><input class="set-text-xh text_250" name="seotitle" value="{$info['seotitle']}"/></td></tr>
                       <tr><td class="tit">Tag词：</td><td><input class="set-text-xh text_250" name="tagword" value="{$info['tagword']}"/></td></tr>
                       <tr><td class="tit">关键词：</td><td><input class="set-text-xh text_250" name="keyword" value="{$info['keyword']}"/></td></tr>

                       <tr><td class="tit">描述：</td><td><textarea class="des" name="description">{$info['description']}</textarea></td></tr>
                   </table>
               </div>
               <div class="item-one" id="item_template" style="display: none;">
                   <table>
                       <tr><td class="tit">模板：</td><td>
                               <a href="javascript:;" data-rel="" class="i-tpl {if empty($info['templetpath'])}on{/if}">标准</a>
                               {loop $templateList $tpl}
                               <a href="javascript:;" data-rel="{$tpl['path']}" class="i-tpl {if $info['templetpath']==$tpl['path']}on{/if}">{$tpl['path']}</a>
                               {/loop}

                           </td></tr>
                   </table>
               </div>

           </div>
       </div>


       <div class="save-con">
           <a href="javascript:;" class="confirm-btn">确定</a>
       </div>
   </div>
<script>
    var id="{$id}";
    var typeid="{$typeid}"
    $(function() {
        $(document).on('click',".i-tpl",function(){
            $(".i-tpl").removeClass('on');
            $(this).addClass('on');
        })
        $(document).on('click',".nav .bom-arrow span",function(){
            var name=$(this).attr('data-rel');
            $(this).siblings().removeClass('on');
            $(".nav-list .item-one").hide();

            $(this).addClass('on');
            $("#item_"+name).show();
        })

        $(document).on('click','.confirm-btn',function(){
            var data={};
            data['seotitle']=$(".main-body input[name=seotitle]").val();
            data['tagword']=$(".main-body input[name=tagword]").val();
            data['keyword']=$(".main-body input[name=keyword]").val();
            data['description']=$(".main-body textarea[name=description]").val();
            data['shownum']=$(".main-body input[name=shownum]").val();
            data['jieshao']=jieshaoEditor.getContent();
            data['templetpath']=$(".i-tpl.on").attr("data-rel");
            ST.Util.responseDialog({id:id,typeid:typeid,data:data},true);
        })
    })
</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.2804&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
