<!doctype html>
<html>
<head>

    <meta charset="utf-8">
<title>文章添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,choose.js,imageup.js"); }
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
                  <span data-id="tupian"><s></s>攻略附件</span>
                  <span data-id="youhua"><s></s>优化设置</span>
                  <span data-id="extend"><s></s>扩展设置</span>
                  <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
              </div>

               <!--基础信息开始-->
                  <div class="product-add-div">
                      <div class="add-class">
                          <dl>
                              <dt>站点：</dt>
                              <dd>

                                  <select name="webid">
                                      <option value="0" {if $info['webid']==0}selected="selected"{/if}>主站</option>
                                      {loop $weblist $k}
                                      <option value="{$k['webid']}" {if $info['webid']==$k['webid']}selected="selected"{/if} >{$k['webname']}</option>
                                      {/loop}

                                  </select>

                              </dd>
                          </dl>
                          <dl>
                              <dt>文章标题：</dt>
                              <dd>
                                  <input type="text" name="title" id="articlename" class="set-text-xh text_700 mt-2 w300"  value="{$info['title']}" />
                                  <div class="help-ico mt-9 ml-5">{php echo Common::getIco('help',40); }</div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>作者：</dt>
                              <dd>
                                  <input type="text" name="author" id="author" class="set-text-xh text_250 mt-2 w300" value="{$info['author']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>文章来源：</dt>
                              <dd>
                                  <input type="text" name="comefrom" id="comefrom" class="set-text-xh text_250 mt-2 w300" value="{$info['comefrom']}" />
                              </dd>
                          </dl>

                          <dl>
                              <dt class="w160">来源网址：</dt>
                              <dd>
                                  <input type="text" name="fromsite" id="fromsite" class="set-text-xh text_250 mt-2 w300" value="{$info['fromsite']}" />
                              </dd>
                          </dl>

                          <dl>
                              <dt>显示模版：</dt>
                              <dd>
                                  <div class="temp-chg" id="templet_list">
                                      <a {if $info['templet']==''}class="on"{/if}  href="javascript:void(0)"  data-value="" onclick="setTemplet(this)">标准1</a>
                                      <a {if $info['templet']=='moban2'}class="on"{/if}  href="javascript:void(0)"  data-value="moban2" onclick="setTemplet(this)">标准2</a>
                                      {loop $templetlist $r}
                                      <a {if $info['templet']==$r['path']}class="on"{/if}  href="javascript:void(0)" data-value="{$r['path']}" onclick="setTemplet(this)">{$r['templetname']}</a>
                                      {/loop}
                                      <input type="hidden" name="templet" id="templet" value="{$info['templet']}"/>
                                  </div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>封面图片：</dt>
                              <dd>
                                  <p>

                                      <label>
                                      	<input class="fl mt-8 mr-3" type="checkbox" name="allow"  {if $info['allow']=='usecontentpic'}checked="checked"{/if} value="usecontentpic">
                                        <span>使用文章内图片作封面</span>
                                      </label>


                                  </p>
                              </dd>
                          </dl>


                      </div>
                      <div class="add-class">
                          <dl>
                              <dt>目的地选择：</dt>
                              <dd>
                                  <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getDest(this,'.dest-sel',4)"  title="选择">选择</a>
                                  <div class="save-value-div mt-2 ml-10 dest-sel">
                                      {loop $info['kindlist_arr'] $k $v}
                                      <span><s onclick="$(this).parent('span').remove()"></s>{$v['kindname']}<input type="hidden" name="kindlist[]" value="{$v['id']}"></span>
                                      {/loop}

                                  </div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>文章属性：</dt>
                              <dd>

                                  <a href="javascript:;" class="choose-btn mt-4" onclick="Product.getAttrid(this,'.attr-sel',4)"  title="选择">选择</a>
                                  <div class="save-value-div mt-2 ml-10 attr-sel">
                                      {loop $info['attrlist_arr'] $k $v}
                                      <span><s onclick="$(this).parent('span').remove()"></s>{$v['attrname']}<input type="hidden" name="attrlist[]" value="{$v['id']}"></span>
                                      {/loop}
                                  </div>
                              </dd>
                          </dl>
                          <dl>
                              <dt>摘要：</dt>
                              <dd style="height:auto">
                                  <textarea class="set-area wid_695"  name="summary" id="" cols="" rows="">{$info['summary']}</textarea>
                              </dd>
                          </dl>

                          <dl id="gf_content"  {if $info['templet']=='moban2'}style="display:block"{else}style="display:none"{/if}>
                              <dt>文章内容: </dt>
                              <dd style="line-height: 20px">
                                  {php Common::getEditor('content',$info['content'],700,400,'raider');}
                              </dd>

                          </dl>
                          <dl id="bz_content" {if $info['templet']!='moban2'}style="display:block"{else}style="display:none"{/if} >
                              <dt>文章内容: </dt>
                              <dd style="line-height: 20px">
                                  {php Common::getEditor('bzcontent',$info['content'],700,400);}
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
                      </div>

                  </div>
              <!--/基础信息结束-->
              <div class="product-add-div" data-id="tupian">
                  <div class="up-pic">
                      <dl>
                          <dt>攻略图片：</dt>
                          <dd>
                              <div class="up-file-div">
                                  <div id="pic_btn" class="btn-file mt-4">上传图片</div>
                              </div>
                              <div class="up-list-div">
                                  <input type="hidden" class="headimgindex" name="imgheadindex" value=""/>
                                  <input type="hidden" name="litpic" id="litpic" value="{$info['litpic']}"/>
                                  <ul class="pic-sel">

                                  </ul>
                              </div>
                          </dd>
                      </dl>
                      <dl>
                        <dt>攻略附件:</dt>
                           <dd>
                               <div class="up-file-div">

                                   <div id="attach_btn" class="btn-file mt-4">上传附件</div>
                                   <input type="hidden" name="attachment" id="attachment" value="{$info['attachment']}">
                               </div>
                              <div id="doclist" class="doclist">
                                  {if !empty($info['attachment'])}
                                  <a href="{$cmsurl}{$info['attachment']}">查看附件</a>
                                  <a href="javascript:;" onclick="delAttach()">删除</a>
                                  {/if}
                              </div>
                           </dd>

                      </dl>


                  </div>
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
                              <dt>301重定向：</dt>
                              <dd>
                                  <input type="text" name="redirecturl" id="redirecturl"  class="set-text-xh text_700 mt-2 w300" value="{$info['redirecturl']}">
                              </dd>
                          </dl>
                          <dl>
                              <dt>访问量：</dt>
                              <dd>
                                  <input type="text" name="shownum" id="shownum"  class="set-text-xh text_700 mt-2 w50" value="{$info['shownum']}">
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
                  <div class="product-add-div" data-id="extend">
                      {php Common::genExtendData(4,$extendinfo);}
                  </div>


                  <div class="opn-btn">
                      <input type="hidden" name="productid" id="productid" value="{$info['id']}"/>
                      <input type="hidden" name="action" id="action" value="{$action}"/>
                      <a class="normal-btn ml-20" id="btn_save" href="javascript:;">保存</a>
                  </div>

          </div>
        </form>
    </td>
    </tr>
    </table>

	<script>
        //设置模板
        function setTemplet(obj)
        {
            var templet = $(obj).attr('data-value');
            $(obj).addClass('on').siblings().removeClass('on');
            $("#templet").val(templet);
            if(templet=='moban2'){
                $('#gf_content').show();
                $('#bz_content').hide();
            }else{
                $('#gf_content').hide();
                $('#bz_content').show();
            }

        }
	$(document).ready(function(){

        $("#nav").find('span').click(function(){

            Product.changeTab(this,'.product-add-div');//导航切换
        })
        $("#nav").find('span').first().trigger('click');


        var action = "{$action}";
        //上传图片

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
        //pdf附件
        setTimeout(function(){
            $('#attach_btn').uploadify({
                'swf': PUBLICURL + 'js/uploadify/uploadify.swf',
                'uploader': SITEURL + 'uploader/uploaddoc',
                'buttonImage' : PUBLICURL+'images/uploadfile.png',  //指定背景图
                'formData':{uploadcookie:"<?php echo Cookie::get('username')?>"},
                'fileTypeExts':'*.pdf',
                'auto': true,   //是否自动上传
                'removeTimeout':0.2,
                'height': 25,
                'width': 80,
                'onUploadSuccess': function (file, data, response) {


                    var info=$.parseJSON(data);
                    var html = '<a href="'+info.path+'" target="_blank">查看附件</a>&nbsp;';
                    $("#attachment").val(info.path);
                    if(action=='edit')
                        html+= '<a href="javascript:;" onclick="delAttach()">删除</a>'
                    $("#doclist").html(html);

                }
            });
        },10)



        //保存
        $("#btn_save").click(function(){

               var articlename = $("#articlename").val();

            //验证名称
             if(articlename==''){
                   $("#nav").find('span').first().trigger('click');
                   $("#articlename").focus();
                   ST.Util.showMsg('请填写文章名称',5,2000);
               }
               else
               {
                   Ext.Ajax.request({
                       url   :  SITEURL+"article/ajax_save",
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


        {if $action=='edit'}



            var litpic = $("#litpic").val();
            $(".img-li").find('img').each(function(i,item){

                        if($(item).attr('src')==litpic){
                            var obj = $(item).parent().find('.btn-ste')[0];
                            Imageup.setHead(obj,i+1);
                        }
            })



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






     });

     function showpic()
     {
         $("#updiv").show();
     }
     function unshowpic()
     {
         $("#updiv").hide();
     }

     function delAttach()
     {
                var articleid = '{$info['id']}';
                $.ajax({
                    type:'POST',
                    url:SITEURL+'/article/ajax_del_attach',
                    data:{articleid:articleid},
                    dataType:'json',
                    success:function(data){
                        if(data.status){
                            $("#doclist").html('');
                            ST.Util.showMsg('删除成功',4,1000);

                        };
                    }
                })
      }



    </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.1005&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
