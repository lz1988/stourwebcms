<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,jqtransform.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,choose.js,DatePicker/WdatePicker.js,product_add.js,st_validate.js,jquery.colorpicker.js,jquery.jqtransform.js,imageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>
<script>
$(function(){
		//$('form').jqTransform({imgPath:'<?php echo $GLOBALS['cfg_public_url']; ?>images/img/'});
	});
	</script>
<body>
<!--顶部-->
{php Common::getEditor('jseditor','',700,300,'Sline','','print',true);}
<table class="content-tab">
<tr>
    <td width="119px" class="content-lt-td" valign="top">
        {template 'stourtravel/public/leftnav'}
        <!--右侧内容区-->
    </td>
    <td valign="top" class="content-rt-td" style="overflow:auto;">

            <div class="manage-nr">
                <div class="w-set-tit bom-arrow">
                    <span class="on" id="column_basic" onclick="Product.switchTab(this,'basic')"><s></s>基础信息</span>
                    <span id="column_image" onclick="Product.switchTab(this,'image')"><s></s>相册图片</span>
                    <span id="column_image" onclick="Product.switchTab(this,'seo')"><s></s>优化信息</span>
                    <span id="column_extend" onclick="Product.switchTab(this,'extend')"><s></s>扩展配置</span>
                    <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                </div>
                <form id="product_fm">
                <div class="product-add-div" id="content_basic">
                        <div class="add-class">
                            <dl>
                                <dt>相册名称：</dt>
                                <dd>
                                    <input type="text" name="title" data-required="true" value="{$info['title']}" class="set-text-xh text_700 mt-2">
                                    <input type="hidden" id="photoid" name="photoid" value="{$info['id']}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>站点：</dt>
                                <dd>
                                    <select name="webid">
                                       {loop $weblist $web}
                                            <option value="{$web['webid']}" {if $web['webid']==$info['webid']}selected="selected"{/if}>{$web['webname']}</option>
                                       {/loop}
                                    </select>
                                </dd>
                            </dl>
                            <dl>
                                <dt>目的地选择：</dt>
                                <dd>

                                    <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getDest(this,'.dest-sel',6)"  title="选择">选择</a>
                                    <div class="save-value-div mt-2 ml-10 dest-sel">
                                        {loop $info['kindlist_arr'] $k $v}
                                        <span><s onclick="$(this).parent('span').remove()"></s>{$v['kindname']}<input type="hidden" name="kindlist[]" value="{$v['id']}"></span>
                                        {/loop}
                                    </div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>相册分类：</dt>
                                <dd>
                                    <a href="javascript:;" class="choose-btn mt-4"onclick="Product.getAttrid(this,'.attr-sel',6)" title="选择">选择</a>
                                    <div class="save-value-div mt-2 ml-10 attr-sel">
                                        {loop $info['attrlist_arr'] $k $v}
                                        <span><s onclick="$(this).parent('span').remove()"></s>{$v['attrname']}<input type="hidden" name="attrlist[]" value="{$v['id']}"></span>
                                        {/loop}
                                    </div>

                                </dd>
                            </dl>
                            <dl>
                                <dt>相册编辑：</dt>
                                <dd>
                                    <input type="text" class="set-text-xh text_300 mt-2" name="author" value="{$info['author']}">
                                </dd>
                            </dl>
                            <dl>
                              <dt>前台隐藏：</dt>
                              <dd>
                                  <label>
                                    <input class="fl mt-8 mr-3" type="radio" name="ishidden"  {if $info['ishidden']==0}checked="checked"{/if} value="0">
                                    <span class="fl mr-20">显示</span>
                                  </label>
                                  <label>
                                    <input class="fl mt-8 mr-3" type="radio" name="ishidden"  {if $info['ishidden']==1}checked="checked"{/if} value="1">
                                    <span>隐藏</span>
                                  </label>
                              </dd>
                            </dl>
                            <dl>
                                <dt>相册介绍：</dt>
                                <dd style="line-height: 20px">
                                    {php Common::getEditor('content',$info['content'],800,200);}
                                </dd>
                            </dl>
                        </div>
                    </div>
                <div id="content_image" class="product-add-div content-hide">

                        <div class="up-pic">
                            <dl>
                                <dt>相册图片：</dt>
                                <dd>
                                    <div class="up-file-div">
                                        <div id="pic_btn" class="btn-file mt-4">上传图片</div>
                                    </div>
                                    <div class="up-list-div">
                                        <ul class="pic-sel">
                                        </ul>
                                        <input id="litpic" type="hidden" value="{$info['litpic']}"/>
                                        <input type="hidden" class="headimgindex" name="imgheadindex" value="">
                                    </div>
                                </dd>
                            </dl>

                        </div>
                    </div>
                <div id="content_seo" class="product-add-div content-hide" >
                        <div class="add-class">
                            <dl>
                                <dt>优化标题：</dt>
                                <dd>
                                    <input type="text" name="seotitle" id="seotitle" class="set-text-xh text_700 mt-2" value="{$info['seotitle']}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>Tag词：</dt>
                                <dd>
                                    <input type="text" id="tagword" name="tagword" class="set-text-xh text_700 mt-2 " value="{$info['tagword']}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>关键词：</dt>
                                <dd>
                                    <input type="text" name="keyword" id="keyword" class="set-text-xh text_700 mt-2" value="{$info['keyword']}">
                                </dd>
                            </dl>
                            <dl>
                                <dt>页面描述：</dt>
                                <dd style="height:auto">
                                    <textarea class="set-area wid_695" name="description" id="description" cols="" rows="">{$info['description']}</textarea>
                                </dd>
                            </dl>
                        </div>
                    </div>
                <div id="content_extend" class="product-add-div content-hide" >
                    {php Common::genExtendData(6,$extendinfo);}
                </div>
                </form>
                <div class="opn-btn">
                    <a class="normal-btn ml-20" id="save_btn" href="javascript:;">保存</a>
                    <!--<a class="save" href="javascript:;" onclick="nextStep()">下一步</a>-->
                </div>
            </div>

    </td>
</tr>


<!--左侧导航区-->

<!--右侧内容区-->

<script>
 $(document).ready(function(e) {


     $("#product_fm input").st_readyvalidate();


     $("#save_btn").click(function(e) {
         var validate=$("#product_fm input").st_govalidate({require:function(element,index){
             $(element).css("border","1px solid red");
             if(index==1)
             {
                 var switchDiv=$(element).parents(".product-add-div").first();
                 if(switchDiv.is(":hidden")&&!switchId)
                 {
                     var switchId=switchDiv.attr('id');
                     var columnId=switchId.replace('content','column');
                     $("#"+columnId).trigger('click');
                 }

             }
         }});
         if(validate==true)
         {
             ST.Util.showMsg('保存中',6,10000);
             Ext.Ajax.request({
                 url   :  SITEURL+"photo/ajax_photosave",
                 method  :  "POST",
                 isUpload :  true,
                 form  : "product_fm",
                 datatype  :  "JSON",
                 success  :  function(response, opts)
                 {
                     var text = response.responseText;
                     if(window.isNaN(text))
                     {
                         ZENG.msgbox._hide();
                         ST.Util.showMsg('保存失败',5);
                     }
                     else
                     {
                         $("#photoid").val(text);
                         ST.Util.showMsg('保存成功',4)
                     }
                 }});

         }
         else
         {
             ST.Util.showMsg("请将信息填写完整",1,1200);
         }
     });

     $('#pic_btn').click(function(){
         ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
         function Insert(result,bool){
             var len=result.data.length;
             for(var i=0;i<len;i++){
                 var temp =result.data[i].split('$$');
                 Imageup.genePic(temp[0],".up-list-div ul",".cover-div");
             }
         }
     })



 });



</script>
<script>
    {if $action=='edit'}
        var piclist = ST.Modify.getUploadFile({$info['piclist_arr']});
        $(".pic-sel").html(piclist);
        var litpic = $("#litpic").val();
        $(".img-li").find('img').each(function(i,item){

            if($(item).attr('src')==litpic){
                var obj = $(item).parent().find('.btn-ste')[0];
                Imageup.setHead(obj,i+1);
            }
        })
        window.image_index= $(".pic-sel").find('li').length;//已添加的图片数量
        {/if}
</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.1005&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
