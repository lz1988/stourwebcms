<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,jqtransform.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,DatePicker/WdatePicker.js,product_add.js,choose.js,st_validate.js,jquery.colorpicker.js,jquery.jqtransform.js,imageup.js"); }
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
                    {loop $columns $column}
                    <span id="column_{$column['columnname']}" onclick="Product.switchTab(this,'{$column['columnname']}')"><s></s>{$column['chinesename']}</span>
                    {/loop}
                    <span id="column_seo" onclick="Product.switchTab(this,'seo')"><s></s>优化信息</span>
                    <span id="column_extend" onclick="Product.switchTab(this,'extend')"><s></s>扩展配置</span>
                    <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                </div>
                <form id="product_fm">
                <div class="product-add-div" id="content_basic">
                    <div class="add-class">
                        <dl>
                            <dt>团购名称：</dt>
                            <dd>
                                <input type="text" name="title" data-required="true" value="{$info['title']}" class="set-text-xh text_700 mt-2">
                                <input type="hidden" name="tuanid" id="tuanid" value="{$info['id']}">
                            </dd>
                        </dl>
                        <dl>
                            <dt>简短名称：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_700 mt-2" name="shortname" value="{$info['shortname']}">
                            </dd>
                        </dl>
                        <dl>
                            <dt>产品卖点：</dt>
                            <dd>
                                <textarea class="text-area text_700" name="sellpoint" cols="" rows="" style=" height:80px;width:400px">{$info['sellpoint']}</textarea>
                            </dd>
                        </dl>

                        <dl>
                            <dt>团购时间：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_150 mt-2 choosetime" data-required="true" name="starttime" value="<?php
                                if($info['starttime'])
                                echo date('Y-m-d',$info['starttime']);?>">
                                <span class="fl ml-10">至</span>
                                <input type="text" class="set-text-xh text_150 mt-2 ml-10 choosetime" data-required="true" name="endtime" value="<?php
                                if($info['endtime'])
                                echo date('Y-m-d',$info['endtime']);?>">
                            </dd>
                        </dl>
                        <dl>
                            <dt>团购券有效期：</dt>
                            <dd>
                                <input type="text" name="validdate" class="set-text-xh text_150 mt-2" value="{$info['validdate']}">
                            </dd>
                        </dl>
                       
                        <dl>
                            <dt>供应商：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getSupplier(this,'.supplier-sel')"  title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 supplier-sel">
                                    {if !empty($info['supplier_arr']['suppliername'])}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$info['supplier_arr']['suppliername']}<input type="hidden" name="supplierlist[]" value="{$info['supplier_arr']['id']}"></span>
                                    {/if}
                                </div>
                            </dd>
                        </dl>
                    </div>

                    <div class="add-class">
                        <dl>
                            <dt>目的地选择：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getDest(this,'.dest-sel',13)"  title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 dest-sel">
                                    {loop $info['kindlist_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$v['kindname']}<input type="hidden" name="kindlist[]" value="{$v['id']}"></span>
                                    {/loop}

                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>产品属性：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getAttrid(this,'.attr-sel',13)"  title="选择">选择</a>

                                <div class="save-value-div mt-2 ml-10 attr-sel">
                                    {loop $info['attrlist_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s>{$v['attrname']}<input type="hidden" name="attrlist[]" value="{$v['id']}"></span>
                                    {/loop}
                                </div>
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
                            <dt>图标设置：</dt>
                            <dd>
                                <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getIcon(this,'.icon-sel')"  title="选择">选择</a>
                                <div class="save-value-div mt-2 ml-10 icon-sel">

                                    {loop $info['iconlist_arr'] $k $v}
                                    <span><s onclick="$(this).parent('span').remove()"></s><img src="{$v['picurl']}"><input type="hidden" name="iconlist[]" value="{$v['id']}"></span>
                                    {/loop}

                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>原价：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="sellprice" value="{$info['sellprice']}">
                                <span class="fl ml-10">元</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>团购价：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="price" value="{$info['price']}">
                                <span class="fl ml-10">元</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>产品数量：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="totalnum" value="{$info['totalnum']}">
                            </dd>
                        </dl>
                        <dl>
                            <dt>满意度：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="satisfyscore" value="{$info['satisfyscore']}" data-regrex="number" data-msg="必须为数字"/>
                            </dd>
                        </dl>
                        <dl>
                            <dt>虚拟购买人数：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="virtualnum" value="{$info['virtualnum']}">
                            </dd>
                        </dl>
                        <dl>
                            <dt>购买送积分：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="jifenbook" value="{$info['jifenbook']}">
                                <span class="fl ml-10">分</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>积分抵现金：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="jifentprice" value="{$info['jifentprice']}">
                                <span class="fl ml-10">元</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>评论送积分：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_100 mt-2" name="jifencomment" value="{$info['jifencomment']}">
                                <span class="fl ml-10">分</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>支付方式：</dt>
                            <dd>
                                <div class="on-off">
                                    <label style="cursor:pointer">
                                      	<input class="fl mt-8 mr-3" type="radio" name="paytype" value="1" {if $info['paytype']=='1'}checked="checked"{/if} /><span class="fl mr-20">全款支付</span>
                                      </label>
                                      <label style="cursor:pointer">
                                      	<input class="fl mt-8 mr-3" type="radio" name="paytype" value="2" {if $info['paytype']=='2'}checked="checked"{/if} /><span class="fl mr-5">定金支付</span>
                                      </label>
                                      	<span class="fl" id="dingjin" style="{if $info['paytype'] == '2'}display:inline-block{else}display: none{/if}">
                                      		<input type="text"  name="dingjin" id="dingjintxt" value="{$info['dingjin']}" size="8" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-\.]+/,'');}).call(this)" onblur="this.v();">&nbsp;元
                                        </span>
                                      <label style="cursor:pointer">
                                      	<input class="fl mt-8 ml-20 mr-3" type="radio" name="paytype" value="3"  {if $info['paytype']=='3'}checked="checked"{/if} /><span class="fl mr-20">二次确认支付</span>
                                      </label>
                                    <script>
                                        $("input[name='paytype']").click(function(){
                                            if($(this).val() == 2)
                                            {
                                                $("#dingjin").show();
                                            }
                                            else
                                            {

                                                $("#dingjin").hide()
                                            }
                                        })

                                    </script>

                                </div>
                            </dd>
                        </dl>
                    </div>

                    <div class="add-class">

                        <dl>
                            <dt>显示模版：</dt>
                            <dd>
                                <div class="temp-chg" id="templet_list">
                                    <a {if $info['templet']==''}class="on"{/if}  href="javascript:void(0)"  data-value="" onclick="setTemplet(this)">标准</a>
                                    {loop $templetlist $r}
                                    <a {if $info['templet']==$r['path']}class="on"{/if}  href="javascript:void(0)" data-value="{$r['path']}" onclick="setTemplet(this)">{$r['templetname']}</a>
                                    {/loop}
                                    <input type="hidden" name="templet" id="templet" value="{$info['templet']}"/>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div id="content_content" class="product-add-div content-hide">
                    <div class="add-class">
                        <dl>
                            <dt>产品详细：</dt>
                            <dd>
                                {php Common::getEditor('content',$info['content'],800,500);}
                            </dd>
                        </dl>
                    </div>
                </div>
                <div id="content_tupian" class="product-add-div content-hide">

                        <div class="up-pic">
                            <dl>
                                <dt>团购相册：</dt>
                                <dd>
                                    <div class="up-file-div">
                                        <div id="pic_btn" class="btn-file mt-4">上传图片</div>
                                    </div>
                                    <div class="up-list-div">
                                        <ul class="pic-sel">
                                        </ul>
                                        <input id="litpic" type="hidden" value="{$info['litpic']}"/>
                                        <input type="hidden" class="headimgindex" name="imgheadindex" value="<?php  echo $head_index;  ?>">
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
                    {php $contentArr=Common::getExtendContent(13,$extendinfo);}
                    {php echo $contentArr['contentHtml'];}
                    <div class="product-add-div" data-id="extend" id="content_extend">

                        {php echo $contentArr['extendHtml'];}
                    </div>
                </form>
                <div class="opn-btn">
                    <a class="normal-btn ml-20" id="save_btn" href="javascript:;"> 保存</a>
                  <!--  <a class="save" href="javascript:;" onclick="nextStep()">下一步</a>-->
                </div>
            </div>
    </td>
</tr>


<!--左侧导航区-->

<!--右侧内容区-->

<script>
 $(document).ready(function(e) {
     window.content=window.JSEDITOR('txt_content');
     window.content.ready(function(){
          window.content.setHeight(200);
     })

     window.notice=window.JSEDITOR('txt_notice');
     window.notice.ready(function(){
             window.notice.setHeight(200);
         })

     $("#product_fm input").st_readyvalidate();

     /*日历选择*/
     $(".choosetime").click(function(){
         WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd'})
     })

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
                 url   :  SITEURL+"tuan/ajax_tuansave",
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

                         $("#tuanid").val(text);
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
                 Imageup.genePic(temp[0],".up-list-div ul");
             }
         }
     })


 });

 //设置模板
 function setTemplet(obj)
 {
     var templet = $(obj).attr('data-value');
     $(obj).addClass('on').siblings().removeClass('on');
     $("#templet").val(templet);

 }

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
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.2601&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
