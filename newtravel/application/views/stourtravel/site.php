<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>站点管理-思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
</head>

<body>
<table class="content-tab">
<tr>
<td width="119px" class="content-lt-td"  valign="top">

    <!--左侧导航区-->
    {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
</td>
<td valign="top" class="content-rt-td">

    <!--右侧内容区-->

        <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>站点管理</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">
                      
            <div class="table-div-b-m">
                <form name="navfrm" id="navfrm">
                    <table width="95%" border="0" cellspacing="0" cellpadding="0" id="sitelist">
                        <tr>
                          <th scope="col" width="5%" height="40" align="center">网站webid</th>
                          <th scope="col" width="30%" align="left" class="pl-30">子站名</th>
                          <th scope="col" width="30%" align="left">访问域名</th>
                          <th scope="col" width="30%" align="center">模板管理</th>
                          <th scope="col" width="5%">站点状态</th>
                        </tr>

                    </table>
                 </form>
            </div>
            
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" onclick="saveSite()">保存</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
 </td>
 </tr>
</table>
<input type="hidden" name="webid" id="webid" value="0"/>
</body>
<script>

   
    $(function(){


        getSiteList();

        
    })

    //添加模版管理页面
    function addmenu(webid,webname){
        var url = 'sitetemplet/index/site/'+webid+'/parentkey/templet/itemid/1';
        var urlname = webname+'模板';
        ST.Util.addTab(urlname,url);
    }

    //获取站点
    function getSiteList()
    {
        var webid=$("#webid").val();

        $.getJSON(SITEURL+"site/ajax_get","",function(data){

            $("#sitelist tr:not(:eq(0))").remove();//先清除内容
            var trlist = data.trlist;
            $.each(trlist, function(i, tr){
                $("#sitelist tr:last").after(tr);
            });
        });
    }
    //站点保存
    function saveSite()
    {
        var webid=$("#webid").val();
        var ajaxurl = SITEURL+'site/ajax_save';
        ST.Util.showMsg('保存中,请稍后...',6,5000);
        Ext.Ajax.request({
            url: ajaxurl,
            method: 'POST',
            form : 'navfrm',
            success: function (response, options) {

                var data = $.parseJSON(response.responseText);
                if(data.status)
                {
                    ST.Util.showMsg('保存成功',4);
                }

            }

        });

    }



    //删除
    function del(id,obj)
    {
        ST.Util.confirmBox('关闭站点','确定关闭这个站点?',function(){
            var boxurl = SITEURL+'site/ajax_del';
            $.getJSON(boxurl,"id="+id,function(data){

                if(data.status == true){
                    $(obj).parents('tr').first().remove();
                    ST.Util.showMsg('关闭成功',4);
                }
                else{
                    ST.Util.showMsg('关闭失败',5);
                }

            });
        })
    }


</script>
</html>
