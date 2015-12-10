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
<body>
   <div class="s-main">
       <div class="main-body">
           <div class="nav">
               <div class="w-set-tit bom-arrow">
                   <span data-rel="seo" class="on"><s></s>优化信息</span>
                   <span  data-rel="jieshao" ><s></s>页面介绍</span>
                   <span data-rel="picture"><s></s>图片管理</span>
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
                       <tr><td class="tit">拼音：</td><td><input type="text" name="pinyin" class="set-text-xh text_250" value="{$info['pinyin']}"/></td></tr>
                       <tr><td class="tit">优化标题：</td><td><input type="text" name="seotitle" class="set-text-xh text_250" value="{$info['seotitle']}" /></td></tr>
                       <tr><td class="tit">Tag词：</td><td><input type="text" name="tagword" class="set-text-xh text_250" value="{$info['tagword']}"/></td></tr>
                       <tr><td class="tit">关键词：</td><td><input type="text" name="keyword" class="set-text-xh text_250" value="{$info['keyword']}"/></td></tr>
                       <tr><td class="tit">页面描述：</td><td><textarea name="description" class="des">{$info['description']}</textarea></td></tr>
                   </table>
               </div>
               <div class="item-one" id="item_picture" style="display: none;">
                   <table>
                       <tr><td class="pic-td"><ul class="pic-sel" id="pic_head">
                                   {loop $pics $pic}
                                   <li class="img-li"><img class="fl" src="{$pic['litpic']}" width="100" height="100">
                                       <p class="p1">
                                           <input type="text" class="img-name" name="imagestitle[]" value="{$pic['desc']}" style="width:90px">
                                           <input type="hidden" class="img-path" name="images[]" value="{$pic['litpic']}">
                                       </p>
                                       <p class="p2">
                                           <span class="btn-ste" onclick="ListImageup.setHead(this,'{$pic['litpic']}','#pic_head')" style="{if $pic['litpic']==$info['litpic']}display:block;background:green{/if}">{if $pic['litpic']==$info['litpic']}已{/if}设为封面</span>
                                           <span class="btn-closed" onclick="ListImageup.delImg(this,'{$pic['litpic']}','#pic_head')">
                                           </span>
                                       </p>
                                   </li>
                                   {/loop}
                               </ul>

                           </td></tr>
                       <tr><td><div id="up_btn" class="uploadify" style="height: 27px; width: 80px;"><div id="up_btn-button" class="uploadify-button " style="text-indent: -9999px; height: 27px; line-height: 27px; width: 80px;"><span class="uploadify-button-text">SELECT FILES</span></div></div></td></tr>
                   </table>
               </div>
               <div class="item-one" id="item_template" style="display: none;">
                   <table>
                       <tr><td class="tit">显示模板：</td><td><a href="javascript:;" data-rel="" class="i-tpl {if empty($info['templetpath'])}on{/if}">标准</a>
                               {loop $templetlist $tpl}
                               <a href="javascript:;" data-rel="{$tpl['path']}" class="i-tpl {if $info['templetpath']==$tpl['path']}on{/if}">{$tpl['templetname']}</a>
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

    $(function() {
        $(document).on('click',".nav .bom-arrow span",function(){
             var name=$(this).attr('data-rel');
             $(this).siblings().removeClass('on');
             $(".nav-list .item-one").hide();

             $(this).addClass('on');
             $("#item_"+name).show();
        })

        $(document).on('click',".i-tpl",function(){
             $(".i-tpl").removeClass('on');
             $(this).addClass('on');
        })


        $('#up_btn-button').css('backgroundImage','url("'+PUBLICURL+'images/upload-ico.png'+'")');
       $('#up_btn').click(function(){
            ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
            function Insert(result,bool){
                var len=result.data.length;
                for(var i=0;i<len;i++){
                    var temp =result.data[i].split('$$');
                    ListImageup.genePic(temp[0],"#pic_head",'');
                }
            }
        });
        $(document).on('click','.confirm-btn',function(){
            var data={};
            data['pinyin']= $(".item-one input[name=pinyin]").val();
            data['jieshao']= jieshaoEditor.getContent();
            data['templetpath']=$(".i-tpl.on").attr("data-rel");
            data['seotitle']=$(".item-one input[name=seotitle]").val();
            data['tagword']=$(".item-one input[name=tagword]").val();
            data['keyword']=$(".item-one input[name=keyword]").val();
            data['description']=$(".item-one textarea[name=description]").val();

            var imageArr=[];
            $(".img-li").each(function(index,element){
                var title=$(this).find('.img-name').val();
                var url=$(this).find('.img-path').val();
                var str=url+'||'+title;
                imageArr.push(str);
            });
            data['piclist']=imageArr.join(',');
            data['litpic']=$(".headimg").val();
            ST.Util.responseDialog({id:id,data:data},true);

        })

    })
</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.2704&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
