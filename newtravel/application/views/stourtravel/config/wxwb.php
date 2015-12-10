<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>微信微博设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>

<body>
	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td">



        <form id="configfrm">
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>微博微信</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">

                  <div style="width: 100%;height:26px;line-height: 26px">
                      <div style="float: left;width:90px;">微信二维码：</div>
                      <div style="float: left"><input id="file_upload" name="file_upload" type="button"/></div>
                      <div style="float:left;padding-left:10px;"><span onMouseOver="this.className='notices'" onMouseOut="this.className='notice'" class="notice">(推荐大小为124*125)</span></div>

                  </div>
                  <div class="logolist" style="width:100%;padding-left:90px;">

                      <img src="" id="wximg" style="margin: 3px;">
                      <a style="cursor:pointer;" onClick="del()">删除</a>

                  </div>


                  <p><span class="fl">微博地址：</span><input type="text" name="cfg_weibo_url" id="cfg_weibo_url" class="set-text-xh set-text-bz3" ></p>


              </div>
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">
                <input type="hidden" name="cfg_weixin_logo" id="cfg_weixin_logo" value=""/>
            </div>

          </div>
        </div>
        </form>
  </td>
  </tr>
  </table>

  
  
	<script>

	$(document).ready(function(){




        //配置信息保存
        $("#btn_save").click(function(){

            var webid= 0
            Config.saveConfig(webid);
        })

        //文件上传
        var webid=0;
        setTimeout(function(){
            $('#file_upload').uploadify({
                'formData'     : {
                    'webid':webid,
                    'isAd':true,
                    uploadcookie:"<?php echo Cookie::get('username')?>"
                },
                'swf'      : PUBLICURL+'js/uploadify/uploadify.swf',
                'uploader' : SITEURL+'uploader/uploadfile',
                'buttonImage' : PUBLICURL+'images/upload-ico.png',
                'fileSizeLimit' : '512KB',
                'fileTypeDesc' : 'Image Files',
                'fileTypeExts' : '*.gif; *.jpg; *.png',
                'cancelImg' : PUBLICURL+'js/uploadify/uploadify-cancel.png',
                'multi' : false,
                'removeCompleted' : true,
                'height':25,
                'width':80,
                'wmode ':'transparent',
                'removeTimeout':0.2,

                onUploadSuccess:function(file,data,response){


                    var obj = $.parseJSON(data);
                    //var obj = eval('('+data+')');
                    if(obj.bigpic!=''){
                        $('#wximg')[0].src=obj.bigpic;
                        $('#cfg_weixin_logo').val(obj.bigpic);
                        $(".logolist").show();

                    }

                }

            });
        },10)

        getConfig(0);


     });


       //获取配置
        function getConfig(webid)
        {

            Config.getConfig(webid,function(data){


                $("#cfg_weibo_url").val(data.cfg_weibo_url);

                if(data.cfg_weixin_logo!='')
                {
                    $("#wximg").attr('src',data.cfg_weixin_logo);
                    $("#cfg_weixin_logo").val(data.cfg_weixin_logo);
                }
                else
                {
                    $(".logolist").hide();
                  //  $("#wximg").attr('src',SITEURL+'public/images/nopic.jpg');
                }





            })


        }
        //删除图片
        function del()
        {
            var adfile=$("#cfg_weixin_logo").val();
            var webid = 0
            if(adfile=='')
            {
                ST.Util.showMsg('还没有上传图片',1,1000);
            }
            else
            {
                $.ajax({
                    type: "post",
                    data: {picturepath:adfile,webid:webid},
                    url: SITEURL+"uploader/delpicture",
                    success: function(data,textStatus)
                    {

                        if(data=='ok')
                        {
                            $(".logolist").hide();
                            $("#cfg_weixin_logo").val('');


                        }
                    }

                });
            }

        }
        //获取logo显示位置
        function getLogoDisplay(webid,displayids)
        {
            $.ajax({
                type: "post",
                data: {logodisplay:displayids,webid:webid},
                url: SITEURL+"config/ajax_getlogodisplay",
                success: function(data,textStatus)
                {
                    $("#display_set").html(data)

                }

            });
        }






    </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
