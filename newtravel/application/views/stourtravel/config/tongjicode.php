<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>思途CMS3.0</title>
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
                 <tr>
                     <td><div class="web-set">
                             <dl>
                                 <dt>站点：</dt>
                                 <dd>
                                     <a href="javascript:;" class="on" data-webid="0">主站</a>
                                     {loop $weblist $k $v}
                                     <a href="javascript:;" data-webid="{$v['webid']}">{$v['webname']}</a>
                                     {/loop}

                                 </dd>
                             </dl>
                         </div>
                     </td>
                     <td>
                         <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                     </td>
                 </tr>
                 </table>
         </div>

        <form id="configfrm">
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>统计代码</span></div>
          <div class="w-set-nr">
            <div class="nr-list">
            	<h4 class="tit"><span class="fl">统计代码：</span><div class="help-ico">{php echo Common::getIco('help',5); }</div></h4>
              <div class="txt">
              	<textarea id="cfg_tongjicode" name="cfg_tongjicode"  cols="" rows="4" class="set-area"></textarea>
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

        getConfig(0); //主站配置

        //默认读取配置

		});


       //获取配置
        function getConfig(webid)
        {
            Config.getConfig(webid,function(data){

                $("#cfg_tongjicode").val(data.cfg_tongjicode);

            })


        }




	</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
