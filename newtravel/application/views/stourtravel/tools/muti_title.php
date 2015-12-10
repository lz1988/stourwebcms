<!doctype html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="admin/public/css/common.css"/>
    <meta charset="utf-8">
    <title>帮助 添加/修改</title>
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
            <div class="list-top-set">
                <div class="list-web-pad"></div>
                <div class="list-web-ct">
                    <table class="list-head-tb">
                        <tr>
                            <td class="head-td-lt">

                            </td>
                            <td class="head-td-rt">
                                <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </tr>
                    </table>
                </div>
            </div>

                <form id="seofrm">
                  <div class="content-nr">
                    <div class="manage-nr">

                        <div class="titleset-box">
                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>目的地SEO标题格式设置</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" name="cfg_dest_title" class="set-text-xh wid_460" value="{$info['cfg_dest_title']}" /></td>
                                        <td width="310">在目的地页面显示的标题,按分类名编写一段文字,分类名用大写XXX代替,如:XXX旅游报价_XXX酒店预订_XXX旅游租车_XXX旅游攻略.</td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_dest_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_dest_desc']}</textarea></td>
                                        <td width="310">在目的地页面的页面描述,按分类名编写一段文字,分类名用大写XXX代替,如:XXX旅游介绍</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>线路类SEO标题格式设置</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" name="cfg_line_title" class="set-text-xh wid_460" value="{$info['cfg_line_title']}" /></td>
                                        <td width="310">分类名用大写XXX代替,如:XXX旅游线路报价</td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_line_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_line_desc']}</textarea></td>
                                        <td width="310">分类名用大写XXX代替,如:XXX旅游线路报价描述</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>酒店类SEO标题格式设置</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" class="set-text-xh wid_460" name="cfg_hotel_title" value="{$info['cfg_hotel_title']}" /></td>
                                        <td width="310"></td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_hotel_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_hotel_desc']}</textarea></td>
                                        <td width="310"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>租车类SEO标题格式设置</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" name="cfg_car_title" class="set-text-xh wid_460" value="{$info['cfg_car_title']}" /></td>
                                        <td width="310"></td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_car_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_car_desc']}</textarea></td>
                                        <td width="310"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>文章类SEO标题格式设置</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" name="cfg_article_title" class="set-text-xh wid_460" value="{$info['cfg_article_title']}" /></td>
                                        <td width="310"></td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_article_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_article_desc']}</textarea></td>
                                        <td width="310"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>景点类SEO标题格式设置</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" name="cfg_spot_title" class="set-text-xh wid_460" value="{$info['cfg_spot_title']}"/></td>
                                        <td width="310"></td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_spot_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_spot_desc']}</textarea></td>
                                        <td width="310"></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="tit-list-box">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <th height="40" colspan="3" align="left" scope="row"><h3>相册类SEO标题</h3></th>
                                    </tr>
                                    <tr>
                                        <th width="80" height="40" align="right" scope="row">优化标题：</th>
                                        <td width="480"><input type="text" name="cfg_photo_title" class="set-text-xh wid_460" value="{$info['cfg_photo_title']}" /></td>
                                        <td width="310"></td>
                                    </tr>
                                    <tr>
                                        <th height="120" align="right" valign="top" scope="row"><span class="fr pt-5">优化描述：</span></th>
                                        <td width="480"><textarea name="cfg_photo_desc" cols="" rows="" class="dft-area pl-5">{$info['cfg_photo_desc']}</textarea></td>
                                        <td width="310"></td>
                                    </tr>
                                </table>
                            </div>



                        </div>

                    </div>
                    <div class="opn-btn">
                        <a class="normal-btn" href="javascript:;" id="btn_save">保存</a>

                    </div>

                </div>
                </form>
        </td>
    </tr>
</table>

<script>

   $(function(){
       //配置信息保存
       $("#btn_save").click(function(){
           var frmdata = $("#seofrm").serialize();
           $.ajax({
               type:'POST',
               data:frmdata,
               url:SITEURL+'app/ajax_mutititle_save',

               success:function(data){
                   if(data=='ok'){
                       ST.Util.showMsg('保存成功!','4',2000);
                   }
               }
           })

       })

   })


</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201510.1004&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
