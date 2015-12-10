<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,jqtransform.css'); }
    {php echo Common::getCss('ext-theme-neptune-all-debug.css','js/extjs/resources/ext-theme-neptune/'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,st_validate.js,jquery.colorpicker.js,jquery.jqtransform.js,imageup.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>
<script>
$(function(){
		//$('form').jqTransform({imgPath:'../images/img/'});
	});
	</script>
<style>
    .content-hide{display:none}
    .content-jieshao-simple{float:left;padding-left: 30px}
	.product-add-div .add-class dl .save-value-div span img{
         vertical-align:middle;		
		}
    .editor-range{
        padding-left: 30px;
        padding-top:20px;
    }
</style>

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
        <div class="crumbs">
            <label>位置：</label>首页 &gt; 设置中心 &gt; 基础设置 &gt; <span>主站 - 水印设置</span>

            <div class="pro-search">
                <input type="text" value="关键词/产品编号" class="sty-txt1 set-text-xh wid_200"/>
                <input type="button" value="搜索" class="sty-btn1 default-btn wid_60"/>
            </div>
        </div>
        <div class="content-nr">
            <div class="manage-nr">
                <div class="w-set-tit bom-arrow">
                    <span class="on" id="column_basic" onclick="Product.switchTab(this,'basic')"><s></s>基础信息</span>
                    <?php
                      $columns=ORM::factory('line_content')->where("webid=$webid and isopen=1")->get_all();
                      foreach($columns as $col)
                      {
                         echo "<span id=\"column_".$col['columnname']."\" onclick=\"Product.switchTab(this,'".$col['columnname']."',switchBack)\"><s></s>".$col['chinesename']."</span>";
                      }
                    ?>

                </div>
                <form id="product_fm">
                <div id="content_basic" class="product-add-div content-show">
                    <div class="add-class">
                        <dl>
                            <dt>站点：</dt>
                            <dd>
                                    <select name="webid">
                                     <?php
                                       $weblist=ORM::factory('weblist')->get_all();
                                       foreach($weblist as $web)
                                       {
                                           echo "<option value='".$web['webid']."'>".$web['webname']."</option>";
                                       }
                                       ?>
                                    </select>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路名称：</dt>
                            <dd>
                                <input type="text" name="title" data-required="true" class="set-text-xh text_700 mt-2"/>
                                <div class="help-ico mt-9 ml-5"><img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/help-ico.png" alt="帮助"
                                                                     title="帮助"></div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路卖点：</dt>
                            <dd>
                                <input type="text" name="sellpoint"  class="set-text-xh text_700 mt-2"/>

                                <div class="help-ico mt-9 ml-5"><img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/help-ico.png" alt="帮助"
                                                                     title="帮助"></div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>供应商：</dt>
                            <dd>
                                <input type="button" class="btn-sum-xz mt-4" value="选择"/>

                                <div class="save-value-div mt-2 ml-10">
                                    <span><s></s>中国旅行社</span>
                                </div>
                            </dd>
                        </dl>
                    </div>

                    <div class="add-class">

                        <dl>
                            <dt>目的地选择：</dt>
                            <dd>
                                <input type="button" onclick="Product.getDest(this,'.dest-sel',1)" class="btn-sum-xz mt-4" value="选择"/>

                                <div class="save-value-div mt-2 ml-10 dest-sel">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>线路属性：</dt>
                            <dd>
                                <input type="button" class="btn-sum-xz mt-4" onclick="Product.getAttrid(this,'.attr-sel',1)" value="选择"/>

                                <div class="save-value-div mt-2 ml-10 attr-sel">
                                </div>
                            </dd>
                        </dl>
                        <dl>
                          <dt>前台隐藏：</dt>
                          <dd>
                              <label>
                                <input class="fl mt-8 mr-3" type="radio" name="ishidden"  checked="checked" value="0">
                                <span class="fl mr-20">显示</span>
                              </label>
                              <label>
                                <input class="fl mt-8 mr-3" type="radio" name="ishidden" value="1">
                                <span>隐藏</span>
                              </label>
                          </dd>
                        </dl>
                        <dl>
                            <dt>旅游天数：</dt>
                            <dd>
                                <input type="text" data-regrex="number" data-required="true" data-msg="必须为数字" id="travel_days" class="set-text-xh text_60 mt-2" name="lineday"/>
                                <span class="fl ml-10">*天</span>
                                <input type="text" data-regrex="number" data-msg="必须为数字" class="set-text-xh text_60 mt-2 ml-10" name="linenight"/>
                                <span class="fl ml-10">晚</span>
                            </dd>
                            </dd>
                        </dl>
                        <dl>
                            <dt>提前天数：</dt>
                            <dd>
                                <span class="fl">建议提前</span>
                                <input type="text" name="linebefore" data-regrex="number" data-msg="必须为数字" class="set-text-xh text_60 mt-2 ml-10"/>
                                <span class="fl ml-10">天报名</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>市场价：</dt>
                            <dd>
                                <input type="text" name="storeprice" class="set-text-xh text_60 mt-2"/><span class="fl ml-5">元</span>
                            </dd>
                        </dl>
                        <dl>
                            <dt>儿童标准：</dt>
                            <dd>
                                <input type="text" class="set-text-xh text_700 mt-2" name="childrule"/>

                                <div class="help-ico mt-9 ml-5"><img class="fl" src="<?php echo $GLOBALS['cfg_public_url']; ?>images/help-ico.png" alt="帮助"
                                                                     title="帮助"></div>
                            </dd>
                        </dl>
                    </div>

                    <div class="add-class">
                        <dl>
                            <dt>显示模版：</dt>
                            <dd>
                                <div class="temp-chg">
                                    <a class="on" href="javascript:void(0)">模版1</a>
                                    <a href="javascript:void(0)">模版2</a>
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>标题颜色：</dt>
                            <dd><input type="text" name="color" class="set-text-xh text_100 mt-2 title-color"/></dd>
                        </dl>
                        <dl>
                            <dt>图标设置：</dt>
                            <dd> <input type="button" class="btn-sum-xz mt-4" onclick="Product.getIcon(this,'.icon-sel')" value="选择"/><div class="save-value-div mt-2 ml-10 icon-sel">
                                </div></dd>
                        </dl>
                        <dl>
                            <dt>显示数据：</dt>
                            <dd>
                                <span class="fl">推荐次数</span>
                                <input type="text" name="yesjian" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10 mr-30"/>
                                <span class="fl">满意度</span>
                                <input type="text" name="satisfyscore" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10 mr-30"/>
                                <span class="fl">销量</span>
                                <input type="text" name="sellnum" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10"/>
                            </dd>
                        </dl>
                    </div>

                </div>
                
                <div id="content_jieshao" class="product-add-div content-hide">

                    <div class="ap-div-top">
                        <dl>
                            <dt>排版方式：</dt>
                            <dd>
                                <div class="temp-chg">
                                    <a class="on" href="javascript:void(0)" onclick="togStyle(this,1)">标准版</a>
                                    <a href="javascript:void(0)" onclick="togStyle(this,2)">简洁版</a>
                                    <input type="hidden" name="isstyle" id="line_isstyle" value="1"/>
                                </div>
                            </dd>
                        </dl>
                        <dl>
                            <dt>用餐情况：</dt>
                            <dd>
                            <div class="on-off">
                              <input type="radio" id="" onclick="togDiner(1)" name="showrepast" value="1" checked="checked">
                              <label>显示</label>
                              <input type="radio" id="" onclick="togDiner(0)" name="showrepast" value="0">
                              <label>隐藏</label>
                            </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="content-jieshao-simple" style="display: none">
                       <div><textarea name="jieshao" id="simple_jieshao"></textarea></div>
                    </div>
                    <div class="content-jieshao-detail">

                    </div>
                </div>
                <div id="content_biaozhun" class="product-add-div content-hide">
                     <div  class="editor-range">
                         <textarea id="biaozhun" name="biaozhun"></textarea>
                     </div>
                </div>
                <div id="content_beizu" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="beizu" name="beizu"></textarea>
                    </div>
                </div>
                <div id="content_payment" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="payment" name="payment"></textarea>
                    </div>
                </div>
                <div id="content_feeinclude" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="feeinclude" name="feeinclude"></textarea>
                    </div>
                </div>
                <div id="content_features" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="features" name="features"></textarea>
                    </div>
                </div>
                <div id="content_reserved1" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="reserved1" name="reserved1"></textarea>
                    </div>
                </div>
                <div id="content_reserved2" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="reserved2" name="reserved2"></textarea>
                    </div>
                </div>
                <div id="content_reserved3" class="product-add-div content-hide">
                    <div  class="editor-range">
                        <textarea id="reserved3" name="reserved3"></textarea>
                    </div>
                </div>
                <div id="content_attachment" class="product-add-div content-hide">

                    <div class="up-pic">
                        <dl>
                            <dt>线路相册：</dt>
                            <dd>
                                <div class="up-file-div">
                                    <div id="pic_btn" class="btn-file mt-4">上传图片</div>
                                </div>
                                <div class="up-list-div">
                                    <input type="hidden" class="headimgindex" name="imgheadindex" value="">
                                    <ul>
                                    </ul>
                                </div>
                            </dd>
                        </dl>

                        <dl>
                            <dt>文档附件：</dt>
                            <dd>
                                <div class="up-file-div">
                                    <button id="attach_btn"></button>
                                </div>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div id="content_seo" class="product-add-div content-hide">

                    <div class="add-class">
                        <dl>
                            <dt>优化标题：</dt>
                            <dd>
                                <input type="text" name="seotitle" class="set-text-xh text_700 mt-2">
                            </dd>
                        </dl>
                        <dl>
                            <dt>Tag词：</dt>
                            <dd>
                                <input type="button" class="btn-sum-xz mt-4" value="提取">
                                <input type="text" class="set-text-xh text_630 mt-2 ml-10">
                            </dd>
                        </dl>
                        <dl>
                            <dt>关键词：</dt>
                            <dd>
                                <input type="text" name="keyword" class="set-text-xh text_700 mt-2">
                            </dd>
                        </dl>
                        <dl>
                            <dt>页面描述：</dt>
                            <dd style="height:auto">
                                <textarea class="set-area wid_695" name="description" cols="" rows=""></textarea>
                            </dd>
                        </dl>
                        <dl>
                            <dt>克隆线路：</dt>
                            <dd>
                                <span class="fl">克隆条数</span>
                                <input type="text" class="set-text-xh text_60 ml-10 mt-2">
                                <input type="button" class="btn-sum-kl mt-4 ml-10" value="提取">
                            </dd>
                        </dl>
                    </div>


                </div>
                </form>
                <div class="opn-btn">
                    <a class="save ml-20" href="javascript:;">保存</a>
                    <a class="next" href="javascript:;">下一步</a>
                </div>
            </div>
        </div>
    </td>
</tr>


<!--左侧导航区-->

<!--右侧内容区-->

<script>
 $(document).ready(function(e) {

     //编辑器
     window.biaozhun=window.JSEDITOR('biaozhun');
     window.simple_jieshao=window.JSEDITOR('simple_jieshao');
     window.beizu=window.JSEDITOR('beizu');
     window.payment=window.JSEDITOR('payment');
     window.feeinclude=window.JSEDITOR('feeinclude');
     window.features=window.JSEDITOR('features');
     window.reserved1=window.JSEDITOR('reserved1');
     window.reserved2=window.JSEDITOR('reserved2');
     window.reserved3=window.JSEDITOR('reserved3');

     //颜色选择器
	  $(".title-color").colorpicker({
            ishex:true,
            success:function(o,color){
                $(o).val(color)
            },
            reset:function(o){

            }
        });
	
	  var validate_action={}
	
	
       $("#product_fm input,#product_fm textarea").st_readyvalidate(validate_action);
	  
	   $(".save").click(function(e) {
            var validate=$("#product_fm input,#product_fm textarea").st_govalidate({require:function(element,index){
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
				Ext.Ajax.request({
				 url   :  SITEURL+"line/ajax_linesave",
				 method  :  "POST",
				 isUpload :  true,
				 form  : "product_fm",
				 waitMsg  :  "保存中...",
				 datatype  :  "JSON",
				 success  :  function(response, opts) 
				 {
					  ST.Util.showMsg('保存中',6,2000);

				 }});
		 
			  }
			  else
			  {
				  ST.Util.showMsg("请将信息填写完整",1,1200);
			  }
    });
	  
});

//切换时的回调函数
function switchBack(columnname)
{
	if(columnname=='jieshao')
	{
		var days=$("#travel_days").val();
        if(days<=0)
        {
          ST.Util.showMsg("请先填写旅游天数",1,1500);
          $("#travel_days").css("border","1px solid red");
          $("#column_basic").trigger("click");
        }
        else
        {
            var html="";
            var day_content='<div class="add-class"><dl><dt>第{day}天：</dt><dd><input type="text" name="jieshaotitle[{day}]" class="set-text-xh text_700 mt-2"/></dd></dl><dl class="jieshao-diner"><dt>用餐情况：</dt><dd><span><input type="checkbox" name="breakfirsthas[{day}]" value="1"></span><label style="cursor: pointer;">早餐</label><span><input type="text" name="breakfirst[{day}]"/></span><span><input type="checkbox" name="lunchhas[{day}]" value="1"></span><label style="cursor: pointer;">午餐</label><span><input type="text" name="lunch[{day}]" value=""/></span><span><input type="checkbox" name="supperhas[{day}]" value="1"></span><label style="cursor: pointer;">晚餐</label><span><input type="text"name="supper[{day}]"/></span></dd></dl><dl><dt>住宿情况：</dt><dd><input type="text"class="set-text-xh text_250 mt-2" name="hotel[]"></dd></dl><dl><dt>交通工具：</dt><dd><span><input type="checkbox" name="transport[{day}][]" value="3"/></span><label style="cursor: pointer;">汽车</label><span><input type="checkbox" name="transport[{day}][]" value="4"></span><label style="cursor: pointer;">火车</label><span><input type="checkbox"value="2" name="transport[{day}][]"></span><label style="cursor: pointer;">飞机</label><span><input type="checkbox" name="transport[{day}][]" value="4"></span><label style="cursor: pointer;">轮船</label></dd></dl><div class="xc-con"><h4>行程内容：</h4><div><textarea name="txtjieshao[{day}]" style=" float:left; border:1px solid #ddd; width:700px; height:200px" id="line_content_{day}"></textarea></div><dl><dt>相关景点：</dt><dd><input type="button" class="btn-sum-xz mt-4" value="提取"><div class="save-value-div mt-2 ml-10"></div></dd></dl></div></div>'
            for(var i=1;i<=days;i++)
            {
                 html+=day_content.replace(/\{day\}/g,i);
            }
            $(".content-jieshao-detail").append(html);

            for(var i=1;i<=days;i++)
            {
                window['line_content_'+i]=window.JSEDITOR('line_content_'+i);
            }
        }
	}
}
function togDiner(num)
{
   if(num==1)
   {
     $(".jieshao-diner").show();
   }
   else
     $(".jieshao-diner").hide();
}
function togStyle(dom,num)
{
    $("#line_isstyle").val(num);
    $(dom).addClass('on');
    $(dom).siblings().removeClass('on');

    if(num==1)
    {
      $(".content-jieshao-detail").show();
      $(".content-jieshao-simple").hide();
    }
    else
    {
        $(".content-jieshao-detail").hide();
        $(".content-jieshao-simple").show();
    }
}

</script>

<script>
    setTimeout(function(){
        $('#pic_btn').uploadify({
            'swf': PUBLICURL + 'js/uploadify/uploadify.swf',
            'uploader': SITEURL + 'uploader/uploadfile',
            'buttonImage' : PUBLICURL+'images/upload-ico.png',  //指定背景图
            'formData':{webid:0,thumb:true},
            'auto': true,   //是否自动上传
            'height': 25,
            'width': 120,
            'onUploadSuccess': function (file, data, response) {
                var imageinfo=$.parseJSON(data);
                Imageup.genePic(imageinfo.litpic,".up-list-div ul",".cover-div");
            }
        });
    },10)


    setTimeout(function(){
        $('#attach_btn').uploadify({
            'swf': PUBLICURL + 'js/uploadify/uploadify.swf',
            'uploader': SITEURL + '/uploader/uploadfile',
            'buttonImage' : PUBLICURL+'images/upload-attach.png',  //指定背景图
            'formData':{webid:0,thumb:false},
            'auto': true,   //是否自动上传
            'height': 25,
            'width': 120,
            'onUploadSuccess': function (file, data, response) {
                // var imageinfo=$.parseJSON(data);
                // Imageup.genePic(imageinfo.litpic,".up-list-div ul",".cover-div");
            }
        });
    },20)



</script>
</body>
</html>
