<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>邮箱设置</title>
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
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>订单邮箱提醒</span>  <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

              <div class="picture ml-10">
                  <p>
                  	<span class="fl wid_150">默认邮箱：</span>
                    <input type="text" name="cfg_Email139" id="cfg_Email139" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:300px">示例(Ding@163.com)</span></p>
                  <p>
                    <span class="fl wid_150">线路订单邮件：</span>
                    <input type="text" name="cfg_lineEmail" id="cfg_lineEmail" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:300px">示例(Ding@163.com)</span></p>
                  <p><span class="fl wid_150">酒店订单邮件：</span><input type="text" name="cfg_hotelEmail" id="cfg_hotelEmail" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:200px"> 示例(Ding@163.com)</p>
                  <p><span class="fl wid_150">租车订单邮件：</span><input type="text" name="cfg_carEmail" id="cfg_carEmail" class="set-text-xh text_250 ml-5 mr-30" >&nbsp;&nbsp;<span style="float: left;margin-left: 10px; width:200px"> 示例(Ding@163.com)</p>

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
        });
        getConfig(0);
     });


       //获取配置
        function getConfig(webid)
        {

            Config.getConfig(webid,function(data){

                $("#cfg_Email139").val(data.cfg_Email139);
                $("#cfg_lineEmail").val(data.cfg_lineEmail);
                $("#cfg_hotelEmail").val(data.cfg_hotelEmail);
                $("#cfg_carEmail").val(data.cfg_carEmail);

            })

        }



    </script>

</body>
</html>
