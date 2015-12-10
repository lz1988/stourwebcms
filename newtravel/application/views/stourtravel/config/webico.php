<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>网站favico</title>
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
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>网站头像</span> <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">

                  <div style="width: 100%;height:26px;line-height: 26px">
                      <div style="float: left;width:70px;">网站头像：</div>
                      <div style="float: left"><input id="file_upload" name="file_upload" type="button"/></div>
                      <div style="float:left;padding-left:10px;"><span onMouseOver="this.className='notices'" onMouseOut="this.className='notice'" class="notice">(推荐大小为32*32，格式为ico)</span></div>

                  </div>
                  <div class="logolist" style="width:100%;padding-left:70px;">

                      <img src="{$GLOBALS['cfg_basehost']}/favicon.ico" id="adimg" style="margin: 3px;">
                     <!-- <a style="cursor:pointer;" onClick="delad()")>删除</a>-->

                  </div>

              </div>




            <div class="opn-btn">
            	<!--<a class="save ml-10" href="javascript:;" id="btn_save">保存</a>-->
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">

            </div>

          </div>
        </div>
        </form>

  </td>
  </tr>
  </table>

  
  
	<script>

	$(document).ready(function(){


          //子站切换点击
        $(".web-set").find('a').click(function(){
            var webid = $(this).attr('data-webid');
            $("#webid").val($(this).attr('data-webid'));
            $("#webname").html($(this).html());
            $(this).addClass('on').siblings().removeClass('on');



        })




        //文件上传
        var webid=$("#webid").val();
        setTimeout(function(){
            $('#file_upload').uploadify({
                'formData'     : {
                    'webid':webid,
                    'thumb':1,
                    uploadcookie:"<?php echo Cookie::get('username')?>"
                },
                'swf'      : PUBLICURL+'js/uploadify/uploadify.swf',
                'uploader' : SITEURL+'uploader/uploadico',
                'buttonImage' : PUBLICURL+'images/upload-ico.png',
                'fileSizeLimit' : '512KB',
                'fileTypeDesc' : 'Image Files',
                'fileTypeExts' : '*.ico',
                'cancelImg' : PUBLICURL+'js/uploadify/uploadify-cancel.png',
                'multi' : false,
                'removeCompleted' : true,
                'height':25,
                'width':80,
                'removeTimeout':0.2,
                'wmode ':'transparent',

                onUploadSuccess:function(file,data,response){


                    var obj = $.parseJSON(data);
                    //var obj = eval('('+data+')');
                    if(obj.bigpic!=''){
                        $('#adimg')[0].src=obj.bigpic;
                        $('#cfg_logo').val(obj.bigpic);

                    }

                }

            });
        },10)





     });



        //删除图片
        function delad()
        {
            var adfile=$("#cfg_logo").val();
            var webid = $("#webid").val();
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
                            $("#adimg")[0].src=SITEURL+'public/images/pic_tem.gif';//"{sline:global.cfg_templets_skin/}/images/pic_tem.gif";
                            $("#cfg_logo").val('');

                        }
                    }

                });
            }

        }





    </script>

</body>
</html>
