<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>积分兑换设置</title>
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
        <!--面包屑-->

      <div>
        <form id="configfrm">
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>积分设置</span> <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">



                  <p><span class="fl">登陆送积分：</span><input type="text" name="cfg_login_jifen" id="cfg_login_jifen" class="set-text-xh w70" value=""></p>
                  <p><span class="fl">注册送积分：</span><input type="text" name="cfg_reg_jifen" id="cfg_reg_jifen" class="set-text-xh w70" value=""></p>
                  <p><span class="fl">积分抵现金：</span>1元人民币 = <input type="text" name="cfg_exchange_jifen" id="cfg_exchange_jifen" class="w70" style="height: 24px;line-height: 24px;padding-left: 5px;border: 1px solid #dcdcdc;" value=""> 积分</p>


              </div>
            <div class="opn-btn">
            	<a class="normal-btn ml-10" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">

            </div>

          </div>
        </div>
        </form>
      </div>
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


                $("#cfg_login_jifen").val(data.cfg_login_jifen);
                $("#cfg_reg_jifen").val(data.cfg_reg_jifen);
                $("#cfg_exchange_jifen").val(data.cfg_exchange_jifen);


            })


        }


    </script>

</body>
</html>
