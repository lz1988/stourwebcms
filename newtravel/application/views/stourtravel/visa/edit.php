<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="admin/public/css/common.css"/>
    <meta charset="utf-8">
<title>签证添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,choose.js,product_add.js,imageup.js,st_validate.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>

<body>
	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td ">
          <form method="post" name="product_frm" id="product_frm">
          <div class="manage-nr">
              <div class="w-set-tit bom-arrow" id="nav">
                  <span class="on"><s></s>基础信息</span>


                  {loop $columns $column}
                  <span data-id="{$column['columnname']}"><s></s>{$column['chinesename']}</span>
                  {/loop}

                  <span data-id="youhua"><s></s>优化设置</span>
                  <span data-id="extend"><s></s>扩展设置</span>
                  <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
              </div>

               <!--基础信息开始-->
                  <div class="product-add-div">
                      <div class="add-class">

                          <dl>
                              <dt>签证名称：</dt>
                              <dd>
                                  <input type="text" name="title" id="title" class="set-text-xh text_700 mt-2 w300"  value="{$info['title']}" />
                                  <div class="help-ico mt-9 ml-5">{php echo Common::getIco('help',40); }</div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>签证卖点：</dt>
                              <dd>
                                  <input type="text" name="sellpoint" value="{$info['sellpoint']}"  class="set-text-xh text_700 mt-2"/>

                                  <div class="help-ico mt-9 ml-5">{php echo Common::getIco('help',12);}</div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>签证类型：</dt>
                              <dd>
                                  <select name="visatype">
                                      <option value="0">请选择</option>
                                      {loop $visatypelist $k}
                                       <option value="{$k['id']}" {if $info['visatype']==$k['id']}selected="selected"{/if} >{$k['kindname']}</option>
                                      {/loop}

                                  </select>

                              </dd>
                          </dl>
                          <dl>
                              <dt>所属区域：</dt>
                              <dd>
                                  <select name="areaid" onchange="getNation(this.options[this.options.selectedIndex].value)">
                                      <option value="0">请选择</option>
                                      {loop $arealist $k}
                                       <option value="{$k['id']}" {if $info['areaid']==$k['id']}selected="selected"{/if} >{$k['kindname']}</option>
                                      {/loop}
                                  </select>

                                  <select name="nationid" id="nationid">
                                      <option value="0">请选择</option>
                                      {loop $nationlist $k}
                                       <option value="{$k['id']}" {if $info['nationid']==$k['id']}selected="selected"{/if} >{$k['kindname']}</option>
                                      {/loop}
                                  </select>

                              </dd>
                          </dl>
                          <dl>
                              <dt>签发城市：</dt>
                              <dd>
                                  <select name="cityid">
                                      <option value="0">请选择</option>
                                      {loop $citylist $k}
                                      <option value="{$k['id']}" {if $info['cityid']==$k['id']}selected="selected"{/if} >{$k['kindname']}</option>
                                      {/loop}
                                  </select>

                              </dd>
                          </dl>
                          <dl>
                              <dt>办理时间：</dt>
                              <dd>
                                  <input type="text" name="handleday" id="handleday" class="set-text-xh text_250 mt-2 w300" value="{$info['handleday']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>有效时间：</dt>
                              <dd>
                                  <input type="text" name="validday" id="validday" class="set-text-xh text_250 mt-2 w300" value="{$info['validday']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt class="w160">面签：</dt>
                              <dd>
                                  <label style="cursor:pointer"><input class="fl mt-8 mr-3" type="radio" name="needinterview" value="0" {if $info['needinterview']==0} checked="checked"{/if}/><span class="fl mr-20">不需要</span></label>
                                  <label style="cursor:pointer"><input class="fl mt-8 mr-3" type="radio" name="needinterview" value="1" {if $info['needinterview']==1} checked="checked"{/if}/><span class="fl mr-20">需要</span></label>
                                  <label style="cursor:pointer"><input class="fl mt-8 mr-3" type="radio" name="needinterview" value="2" {if $info['needinterview']==2} checked="checked"{/if}/><span class="fl ">领馆决定</span></label>

                              </dd>
                          </dl>
                          <dl>
                              <dt class="w160">邀请函：</dt>
                              <dd>
                                  <label style="cursor:pointer"><input class="fl mt-8 mr-3" type="radio" name="needletter" value="0" {if $info['needletter']==0} checked="checked"{/if}/><span class="fl mr-20">不需要</span></label>
                                  <label style="cursor:pointer"><input class="fl mt-8 mr-3" type="radio" name="needletter" value="1" {if $info['needletter']==1} checked="checked"{/if}/><span class="fl mr-20">需要</span></label>
                                  <label style="cursor:pointer"><input class="fl mt-8 mr-3" type="radio" name="needletter" value="2" {if $info['needletter']==2} checked="checked"{/if}/><span class="fl mr-20">领馆决定</span></label>
                              </dd>
                          </dl>
                          <dl>
                              <dt>本站报价：</dt>
                              <dd>
                                  <input type="text" name="price" id="price" class="set-text-xh text_250 mt-2 w50" value="{$info['price']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>市场报价：</dt>
                              <dd>
                                  <input type="text" name="marketprice" id="marketprice" class="set-text-xh text_250 mt-2 w50" value="{$info['marketprice']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>受理范围：</dt>
                              <dd>
                                  <input type="text" name="handlerange" id="handlerange" class="set-text-xh text_250 mt-2 w300" value="{$info['handlerange']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>停留时间：</dt>
                              <dd>
                                  <input type="text" name="partday" id="partday" class="set-text-xh text_250 mt-2 w300" value="{$info['partday']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>受理时间：</dt>
                              <dd>
                                  <input type="text" name="acceptday" id="acceptday" class="set-text-xh text_250 mt-2 w300" value="{$info['acceptday']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>受理人群：</dt>
                              <dd>
                                  <input type="text" name="handlepeople" id="handlepeople" class="set-text-xh text_250 mt-2 w300" value="{$info['handlepeople']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>所属领管：</dt>
                              <dd>
                                  <input type="text" name="belongconsulate" id="belongconsulate" class="set-text-xh text_250 mt-2 w300" value="{$info['belongconsulate']}" />
                              </dd>
                          </dl>

                          <dl>
                              <dt>供应商：</dt>
                              <dd>
                                  <input type="button" class="btn-sum-xz mt-4" value="选择" onclick="Product.getSupplier(this,'.supplier-sel')" />
                                  <div class="save-value-div mt-2 ml-10 supplier-sel">
                                      {if !empty($info['supplier_arr']['suppliername'])}
                                      <span><s onclick="$(this).parent('span').remove()"></s>{$info['supplier_arr']['suppliername']}<input type="hidden" name="supplierlist[]" value="{$info['supplier_arr']['id']}"></span>
                                      {/if}
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

                      <div class="add-class">
                          <dl>
                              <dt>预订送积分：</dt>
                              <dd>
                                  <input type="text" name="jifenbook" id="jifenbook" class="set-text-xh text_100 mt-2" value="{$info['jifenbook']}" />
                                  <span class="fl ml-5">分</span>
                              </dd>
                          </dl>
                          <dl>
                              <dt>积分抵现金：</dt>
                              <dd>
                                  <input type="text" name="jifentprice" id="jifentprice" value="{$info['jifentprice']}" class="set-text-xh text_100 mt-2" />
                                  <span class="fl ml-5">元</span>
                              </dd>
                          </dl>
                          <dl>
                              <dt>评论送积分：</dt>
                              <dd>
                                  <input type="text" name="jifencomment" id="jifencomment" class="set-text-xh text_100 mt-2" value="{$info['jifencomment']}" />
                                  <span class="fl ml-5">分</span>
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
                              <dt>图标设置：</dt>
                              <dd>
                                  <input type="button" class="btn-sum-xz mt-4" onclick="Product.getIcon(this,'.icon-sel')" value="选择"/>
                                  <div class="save-value-div mt-2 ml-10 icon-sel">
                                      {loop $info['iconlist_arr'] $k $v}
                                      <span><s onclick="$(this).parent('span').remove()"></s><img src="{$v['picurl']}"><input type="hidden" name="iconlist[]" value="{$v['id']}"></span>';
                                      {/loop}
                                  </div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>显示数据：</dt>
                              <dd>
                                  <span class="fl">推荐次数</span>
                                  <input type="text" name="recommendnum" id="yesjian" data-regrex="number" data-msg="*必须为数字"  class="set-text-xh text_60 mt-2 ml-10 mr-30 w50" value="{$info['recommendnum']}" />
                                  <span class="fl">满意度</span>
                                  <input type="text" name="satisfyscore" id="satisfyscore" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10 mr-30 w50" value="{$info['satisfyscore']}"  />
                                  <span class="fl">销量</span>
                                  <input type="text" name="bookcount" id="bookcount" data-regrex="number" data-msg="*必须为数字" class="set-text-xh text_60 mt-2 ml-10 w50" value="{$info['bookcount']}" />
                              </dd>
                          </dl>
                      </div>

                  </div>
              <!--/基础信息结束-->
                  <!--图片开始-->
                  <div class="product-add-div" data-id="tupian">
                      <div class="up-pic">
                          <dl>
                              <dt>签证图片：</dt>
                              <dd>
                                  <div class="up-file-div">
                                      <div id="pic_btn" class="btn-file mt-4">上传图片</div>
                                  </div>
                                  <div class="up-list-div">

                                      <ul class="pic-sel">
                                          <li class="img-li h100" style="height: 100px;">
                                             {if !empty($info['litpic'])}
                                              <img class="fl" id="visapic" src="{$info['litpic']}" width="100" height="100"><p class="p1"><span class="btn-closed" onclick="Imageup.delImg(this,'{$info['litpic']}',1)"></span></p></li>
                                             {else}
                                               <img id="visapic" src="{php echo Common::getDefaultImage();}" width="100" height="100">
                                             {/if}
                                          <input type="hidden" name="litpic" id="litpic" value="{$info['litpic']}"/>
                                      </ul>
                                  </div>
                              </dd>
                          </dl>


                      </div>
                  </div>
                  <!--图片结束-->
                  <div class="product-add-div" data-id="content">
                      {php Common::getEditor('content',$info['content'],700,400);}
                  </div>
                  <div class="product-add-div" data-id="material">
                      <ul class="subTitNav">
                          <li data-id="material-1" class="yes">在职人员</li>
                          <li data-id="material-2" class="">自由职业者</li>
                          <li data-id="material-3" class="">退休人员</li>
                          <li data-id="material-4" class="">在校学生</li>
                          <li data-id="material-5" class="">学龄前儿童</li>
                      </ul>
                      <div id="material-1">{php Common::getEditor('material',$info['material'],700,200);}</div>
                      <div id="material-2" style="display: none">{php Common::getEditor('material2',$info['material2'],700,200);}</div>
                      <div id="material-3" style="display: none">{php Common::getEditor('material3',$info['material3'],700,200);}</div>
                      <div id="material-4" style="display: none">{php Common::getEditor('material4',$info['material4'],700,200);}</div>
                      <div id="material-5" style="display: none">{php Common::getEditor('material5',$info['material5'],700,200);}</div>

                  </div>
                  <div class="product-add-div" data-id="booknotice">
                      {php Common::getEditor('booknotice',$info['booknotice'],700,200);}
                  </div>
                  <div class="product-add-div" data-id="circuit">
                      {php Common::getEditor('circuit',$info['circuit'],700,200);}
                  </div>
                  <div class="product-add-div" data-id="friendtip">
                   {php Common::getEditor('friendtip',$info['friendtip'],700,200);}
                  </div>
                  <div class="product-add-div" data-id="youhua">
                      <div class="add-class">
                          <dl>
                              <dt>优化标题：</dt>
                              <dd>
                                  <input type="text" name="seotitle" id="seotitle" class="set-text-xh text_700 mt-2 w500" value="{$info['seotitle']}" >
                              </dd>
                          </dl>
                          <dl>
                              <dt>Tag词：</dt>
                              <dd>

                                  <input type="text" id="tagword" name="tagword" class="set-text-xh text_700 mt-2" value="{$info['tagword']}" >
                              </dd>
                          </dl>
                          <dl>
                              <dt>关键词：</dt>
                              <dd>
                                  <input type="text" name="keyword" id="keyword" name="keyword" class="set-text-xh text_700 mt-2 w300" value="{$info['keyword']}">
                              </dd>
                          </dl>
                          <dl>
                              <dt>页面描述：</dt>
                              <dd style="height:auto">
                                  <textarea class="set-area wid_695"  name="description" id="description" cols="" rows="">{$info['description']}</textarea>
                              </dd>
                          </dl>

                      </div>
                  </div>
              {php $contentArr=Common::getExtendContent(8,$extendinfo);}
              {php echo $contentArr['contentHtml'];}
              <div class="product-add-div" data-id="extend" id="content_extend">
                  {php echo $contentArr['extendHtml'];}
              </div>


                  <div class="opn-btn">
                      <input type="hidden" name="productid" id="productid" value="{$info['id']}"/>
                      <input type="hidden" name="action" id="action" value="{$action}"/>
                      <a class="save ml-20" id="btn_save" href="javascript:;">保存</a>

                  </div>

          </div>
        </form>
    </td>
    </tr>
    </table>

	<script>

	$(document).ready(function(){

        $("#nav").find('span').click(function(){

            Product.changeTab(this,'.product-add-div');//导航切换

        })
        $("#nav").find('span').first().trigger('click');


        var action = "{$action}";

        $('.subnav li').click(function(){

            hideAll();
            $(this).attr('class','selected');
            var id=$(this).attr('data-id');

            $("#"+id).show();

        })

        //所需资料切换
        $(".subTitNav").find('li').click(function(){

            var id = $(this).attr('data-id');
            $(this).addClass('yes').siblings().removeClass('yes');
            $("#"+id).show().siblings('div').hide();

        })


        $('#pic_btn').click(function(){
            ST.Util.showBox('上传图片', SITEURL + 'image/insert_view', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
            function Insert(result,bool){
                if(result.data.length>0){
                    var len=result.data.length-1;
                    var temp =result.data[len].split('$$');
                    $("#litpic").val(temp[0]);
                    $("#visapic").attr('src',temp[0]);
                }
            }
        })


        $("#product_frm input").st_readyvalidate();
        //保存
        $("#btn_save").click(function(){

               var visaname = $("#title").val();

            //验证酒店名称
             if(visaname==''){
                   $("#nav").find('span').first().trigger('click');
                   $("#title").focus();
                   ST.Util.showMsg('请填写签证名称',5,2000);
               }
               else
               {
                   Ext.Ajax.request({
                       url   :  SITEURL+"visa/ajax_save",
                       method  :  "POST",
                       isUpload :  true,
                       form  : "product_frm",
                       datatype  :  "JSON",
                       success  :  function(response, opts)
                       {

                           var data = $.parseJSON(response.responseText);
                           if(data.status)
                           {
                               if(data.productid!=null){
                                   $("#productid").val(data.productid);
                               }
                               ST.Util.showMsg('保存成功!','4',2000);
                           }


                       }});
               }

        })


        //如果是修改页面



            var litpic = $("#litpic").val();
            $(".img-li").find('img').each(function(i,item){

                        if($(item).attr('src')==litpic){
                            var obj = $(item).parent().find('.btn-ste')[0];
                            Imageup.setHead(obj,i+1);
                        }
            })






     });

            function hideAll()
            {
                $('.subnav li').each(function(){
                    $(this).attr('class','');
                    var id=$(this).attr('data-id');
                    $("#"+id).hide();
                })

            }
            function getNation(id)
            {
                $.ajax(
                    {
                        type: "post",
                        data: {pid:id},
                        url: SITEURL+"visa/ajax_getnation/",
                        dataType:'json',
                        success: function(data,textStatus)
                        {
                            $("#nationid").empty();
                            $("#nationid").append("<option value='0'>请选择</option>");
                            $.each(data,function(i,v){
                                $("#nationid").append("<option value='"+ v.id+"'>"+ v.kindname+"</option>");

                            })

                        },
                        error: function()
                        {

                            ST.Util.showMsg("请求出错,请联系管理员",5,1000);
                        }

                    }
                );
            }
            //设置模板
            function setTemplet(obj)
            {
                var templet = $(obj).attr('data-value');
                $(obj).addClass('on').siblings().removeClass('on');
                $("#templet").val(templet);

            }

    </script>
    <style>
        .subTitNav{
            width:700px;
            padding:10px 0 0 10px;
            border-bottom:1px #d8d8d8 solid;
            zoom:1;
            overflow:hidden;
            margin-bottom:10px;
        }
        .subTitNav li{
            float:left;
            padding:0 10px;
            height:25px;
            line-height:25px;
            text-align:center;
            border:1px #d8d8d8 solid;
            border-width:1px 1px 0 1px;
            margin-right:10px;
            cursor:pointer;
        }
        .subTitNav li.yes{
            border:1px #d8d8d8 solid;
            border-width:1px 1px 0 1px;
            background:#f6f6f6;
            font-weight:bold; }
    </style>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.2402&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
