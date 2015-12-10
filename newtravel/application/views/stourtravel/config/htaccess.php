<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>伪静态配置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
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
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>伪静态设置</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">

            <div class="nr-list">
            	<h4 class="tit"><span class="fl">伪静态设置：</span><div class="help-ico">{php echo Common::getIco('help',5); }</div></h4>
              <div class="txt">
              	<textarea id="htaccess" name="htaccess"   cols="6" rows="20" class="set-area" style="height: 700px"></textarea>
              </div>
            </div>


            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
            </div>

          </div>
        </div>
        </form>
  </td>
  </tr>
  </table>
    <input type="hidden" id="webid" value="0">
  
  
	<script>

	$(document).ready(function(){



        //配置信息保存
        $("#btn_save").click(function(){
           saveConfig();
        })

        getConfig();

        //默认读取配置

		});


       //获取配置
        function getConfig()
        {
            var url = SITEURL+"config/ajax_gethtaccess";

            $.ajax({
                type:'POST',
                url:url,
                dataType:'json',
                success:function(data){

                  $("#htaccess").html(data.rules);


                }
            })


        }
        //保存配置
        function saveConfig()
        {
            var url = SITEURL+"config/ajax_savehtaccess";
            var frmdata = $("#configfrm").serialize();
            $.ajax({
                type:'POST',
                url:url,
                data:frmdata,
                dataType:'json',
                success:function(data){

                    if(data.status==true)
                    {
                        ST.Util.showMsg('保存成功',4);
                    }

                }
            })
        }




	</script>

</body>
</html>
