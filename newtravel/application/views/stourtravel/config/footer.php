<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>网页底部</title>
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
         <div class="cfg-head-top">
             <table class="cfg-head-tb">
                <tr><td>
                        {template 'stourtravel/public/weblist'}
                     </td>
                     <td>
                         <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                     </td>
                 </tr>
                </table>
         </div>

        <form id="configfrm">
		
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>网页底部</span></div>
          <div class="w-set-nr">

          	<div class="nr-list">

              <div class="txt">
                  {php Common::getEditor('cfg_footer',$configinfo['cfg_footer'],700,300);}
            </div>
            </div>
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
            </div>

          </div>
        </div>
        </form>
      </div>

  </td>
  </tr>
  </table>
    <input type="hidden" id="webid" value="0">
  
  
	<script>

	$(document).ready(function(){


          //子站切换点击
        $(".web-set").find('a').click(function(){
            var webid = $(this).attr('data-webid');
            $("#webid").val($(this).attr('data-webid'));
            $("#webname").html($(this).html());
            $(this).addClass('on').siblings().removeClass('on');
            getConfig(webid);//重新读取配置


        })

        //配置信息保存
        $("#btn_save").click(function(){
            var webid= $("#webid").val();
            Config.saveConfig(webid);
        })

        //setTimeout(getConfig,500);//延迟500毫秒调用数据显示,防止编辑器没有加载完成返回错误.
    });


       //获取配置
        function getConfig(webid)
        {
            Config.getConfig(webid,function(data){
                cfg_footerEditor.setContent(data.cfg_footer);

            })


        }






	</script>

</body>
</html>
