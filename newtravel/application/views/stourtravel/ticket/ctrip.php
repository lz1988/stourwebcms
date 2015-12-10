<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ctrip接口设置</title>
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
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>携程接口配置</span> <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">



              <p>
                  	<span class="fl wid_150">联盟ID：</span>
                    <input type="text" name="cfg_ctrip_allianceid" id="cfg_ctrip_allianceid" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;</p>
                    <p><span class="fl wid_150">站点SID：</span><input type="text" name="cfg_ctrip_sid" id="cfg_ctrip_sid" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;</p>
                  <p><span class="fl wid_150">站点密钥：</span><input type="text" name="cfg_ctrip_key" id="cfg_ctrip_key" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;</p>
               <!--   <p><span class="fl wid_150">默认出发城市：</span><input type="text" name="cfg_ctrip_default_startcity" id="cfg_ctrip_default_startcity" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;</p>
                  <p><span class="fl wid_150">默认目的城市：</span><input type="text" name="cfg_ctrip_default_endcity" id="cfg_ctrip_default_endcity" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;</p>-->
              </div>
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
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




        //配置信息保存
        $("#btn_save").click(function(){

            var webid= 0
            Config.saveConfig(webid);
            saveJson();
        })


        getConfig(0);


     });


       //获取配置
        function getConfig(webid)
        {

            Config.getConfig(webid,function(data){


                $("#cfg_ctrip_allianceid").val(data.cfg_ctrip_allianceid);
                $("#cfg_ctrip_sid").val(data.cfg_ctrip_sid);
                $("#cfg_ctrip_key").val(data.cfg_ctrip_key);
                /*$("#cfg_ctrip_default_startcity").val(data.cfg_ctrip_default_startcity);
                $("#cfg_ctrip_default_endcity").val(data.cfg_ctrip_default_endcity);*/

            })

        }
        //保存json
        function saveJson()
        {
            $alid = $("#cfg_ctrip_allianceid").val();
            $sid = $("#cfg_ctrip_sid").val();
            $key = $("#cfg_ctrip_key").val();
            $.ajax({
                type:'POST',
                url:SITEURL+'ticket/ajax_write_sid',
                data:{alid:$alid,sid:$sid,key:$key},
                success:function(data){
                    console.log(data);
                }

            })

        }



    </script>

</body>
</html>
