<!doctype html>
<html>
<head>
    <meta charset="utf-8">
<title>广告添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,imageup.js"); }
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
                  <span class="on"><s></s>{$position}</span>
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
                              <dt>广告类型：</dt>
                              <dd>
                                  <select name="adtype" id="adtype" onchange="getAdPosition(this.value)">
                                        <option value="0">请选择广告类型</option>
                                  </select>

                              </dd>
                          </dl>

                          <dl>
                              <dt>广告位置：</dt>
                              <dd>
                                  <select name="adposition" id="adposition" onchange="setWhPara(this)">

                                  </select>
                                  <span class="whinfo" style="color: red"></span>

                              </dd>
                          </dl>
                          <dl>
                              <dt>广告图片：</dt>
                              <dd>


                                  <div class="up-file-div" id="updiv">
                                      <div id="pic_btn" class="uploadify" style="height: 25px; width: 80px; cursor: pointer"><div id="pic_btn-button" class="uploadify-button " style="text-indent: -9999px; height: 25px; line-height: 25px; width: 80px;"><span class="uploadify-button-text">SELECT FILES</span></div></div>
                                  </div>
                                  <div class="up-list-div">

                                      <ul class="pic-sel">
                                          <li class="img-li h100" style="height: 100px;">
                                              {if !empty($info['picurl'])}
                                              <img class="fl" id="articlepic" src="{$info['picurl']}" width="100" height="100"><p class="p1"><span class="btn-closed" onclick="Imageup.delImg(this,'{$info['litpic']}',1)"></span></p></li>
                                          {else}
                                          <img id="articlepic" src="{php echo Common::getDefaultImage();}" width="100" height="100">
                                          {/if}
                                          <input type="hidden" name="litpic" id="litpic" value="{$info['picurl']}"/>
                                          <input type="hidden" name="adwidth" id="adwidth" value="">
                                          <input type="hidden" name="adheight" id="adheight" value="">
                                      </ul>
                                  </div>


                              </dd>
                          </dl>
                          <dl>
                              <dt>链接主题：</dt>
                              <dd>
                                  <input type="text" name="linktext" id="linktext" class="set-text-xh text_250 mt-2 w300" value="{$info['linktext']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt>链接地址：</dt>
                              <dd>
                                  <input type="text" name="linkurl" id="linkurl" class="set-text-xh text_250 mt-2 w300" value="{$info['linkurl']}" />
                              </dd>
                          </dl>




                      </div>




                  </div>
              <!--/基础信息结束-->




                  <div class="opn-btn">
                      <input type="hidden" name="id" id="id" value="{$info['id']}"/>
                      <input type="hidden" name="action" id="action" value="{$action}"/>
                      <input type="hidden" name="tagname" id="tagname" value=""/>
                      <a class="normal-btn ml5" id="btn_save" href="javascript:;">保存</a>

                  </div>

          </div>
        </form>
    </td>
    </tr>
    </table>

	<script>
        window.TYPEMENU = [
            {'id':'1','name':'首页广告'},
            {'id':'2','name':'栏目广告'},
            {'id':'3','name':'自定义广告'}
        ]
        var adtype = "{$info['adtype']}";
        var adposition = "{$info['adposition']}";
        var action = "{$action}";
	$(document).ready(function(){

        $.each(window.TYPEMENU,function(i,row){
            var is_selected=row.id==adtype?"selected='selected'":'';
            var html="<option value='"+row.id+"' "+is_selected+">"+row.name+"</option>";
            $("#adtype").append(html);
        })
        adtype = adtype!='' ? adtype : 0;
        getAdPosition(adtype);//获取广告位置列表



        //上传图片
        $('#pic_btn-button').css('backgroundImage','url("'+PUBLICURL+'images/upload-ico.png'+'")');
        $('#pic_btn').click(function(){
            ST.Util.showBox('上传图片', SITEURL + 'image/insert_view/iswater/0', 430,340, null, null, document, {loadWindow: window, loadCallback: Insert});
            function Insert(result,bool){
                if(result.data.length>0){
                    var len=result.data.length-1;
                    var temp =result.data[len].split('$$');
                    $("#litpic").val(temp[0]);
                    $("#articlepic").attr('src',temp[0]);
                }
            }
        });

        //保存
        $("#btn_save").click(function(){


                  var linkurl = $("#linkurl").val();
                  if(linkurl==''){
                        ST.Util.showMsg('请将信息完善后再提交',5,1000);
                        return false;
                  }

                   Ext.Ajax.request({
                       url   :  SITEURL+"advertise/ajax_save",
                       method  :  "POST",
                       form  : "product_frm",
                       datatype  :  "JSON",
                       success  :  function(response, opts)
                       {
                          try{
                              var data = $.parseJSON(response.responseText);
                          }
                          catch(e){
                              ST.Util.showMsg("{__('norightmsg')}",5,1000);
                          }

                           if(data.status)
                           {
                               if(data.productid!=null){
                                   $("#productid").val(data.productid);
                               }
                               ST.Util.showMsg('保存成功!','4',2000);
                               setTimeout(function(){
                                   parent.window.gbl_tabs.remove(parent.window.currentTab)},2000);



                           }


                       }});


        })


     });

        //获取广告位置
        function getAdPosition(adtype)
        {
            $.ajax({
                type:'POST',
                url:SITEURL+'advertise/ajax_getadpostion/',
                data:{adtype:adtype},
                dataType:'json',
                success:function(data){
                     if(data){
                         $("#adposition").empty();
                         $("#adposition").append('<option value="0">请选择广告位置</option>');
                         $.each(data,function(i,row){
                             var is_selected = '';

                             if(row.position == adposition){

                                 is_selected = "selected='selected'";
                                 $("#adwidth").val(row.width);
                                 $("#adheight").val(row.height);
                                 $("#tagname").val(row.tagname);
                             }

                             var html="<option value='"+row.position+"' "+is_selected+"adwidth="+row.width+" adheight="+row.height+" tagname="+row.tagname+">"+row.position+"</option>";
                             $("#adposition").append(html);
                         })

                     }
                }
            })
        }
        //设置宽度和高度
        function setWhPara(obj)
        {
           var width = $(obj).find("option:selected").attr('adwidth');
           var height =$(obj).find("option:selected").attr('adheight');
           var tagname =$(obj).find("option:selected").attr('tagname');
           $("#adwidth").val(width);
           $("#adheight").val(height);
           $("#tagname").val(tagname);
           if(width!='' || height!=''){
               width = width==0 ? '不限' : width;
               height = height==0 ? '不限' :height;
               $('.whinfo').html('宽度:'+width+' 高度:'+height);
           }
        }


    </script>

</body>
</html>
