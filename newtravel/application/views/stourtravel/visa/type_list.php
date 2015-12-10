<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>签证类型管理-思途CMS3.0</title>
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




                    <div class="w-set-con">
                        <div class="w-set-tit bom-arrow">
                            {template 'stourtravel/visa/kind_top'}
                            <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
                        </div>
                        <div class="w-set-nr">

                            <div class="add_menu-btn">
                                <a href="javascript:;" class="add-btn-class ml-10" onclick="addType()">添加</a>
                            </div>

                            <div class="table-div-b-m">
                                <form name="frm" id="frm">
                                    <table width="95%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th scope="col" width="5%" height="40">排序</th>
                                            <th scope="col" width="90%" align="left"><span class="fl">签证类型</span></th>
                                            <th scope="col" width="5%">管理</th>
                                        </tr>
                                    </table>

                                </form>
                            </div>

                            <div class="opn-btn">
                                <a class="normal-btn" href="javascript:;" onclick="saveType()">保存</a>
                            </div>
                        </div>
                    </div>

        </td>
    </tr>
</table>

</body>
<script>
    $(function(){
        //选中分类
        $(".w-set-tit").find('span').eq(0).addClass('on');
        getList();

    })
    var delpic ="{php echo Common::getIco('del');}";
    function getList()
    {


        $.getJSON(SITEURL+"visa/ajax_visatype_list","",function(data){


            $("#frm tr:not(:eq(0))").remove();//先清除内容
            var trlist = data.trlist;


            $.each(trlist, function(i, trinfo){
                var tr = '';
                tr += "<tr>";
                tr += '<td height="40" align="center"><input type="text" class="tb-text wid_60 center"  name="displayorder[]" value="'+trinfo.displayorder+'" /></td>';
                tr += '<td><input type="text"  name="kindname[]" class="tb-text wid_200 pl-5"  value="'+trinfo.kindname+'" /></td>';
                tr += '<td align="center" >'+'<a href="javascript:;" class="row-del-btn" onclick="delType('+trinfo.id+',this)" title="删除"></a>'+'<input type="hidden" name="id[]" value="'+trinfo.id+'"/></td>';
                $("#frm tr:last").after(tr);
            });

        });
    }


    function saveType()
    {
        var webid=0;
        var ajaxurl = SITEURL+'visa/ajax_visatype_save';
        Ext.Ajax.request({
            url: ajaxurl,
            params: { webid: webid},
            method: 'POST',
            form : 'frm',
            success: function (response, options) {
                var data = $.parseJSON(response.responseText);
                if(data.status)
                {
                    ST.Util.showMsg('保存成功',4);
                }


            }

        });

    }

    //添加
    function addType()
    {

        var tr = '';
        tr += "<tr>";
        tr += '<td height="40" align="center"><input type="text" class="tb-text wid_60 center"  name="newdisplayorder[]" class="tb-text" value="9999" /></td>';
        tr += '<td><input type="text"  name="newname[]" class="tb-text wid_200 pl-5" value="自定义" /></td>';
        tr += '<td align="center" >'+'<a href="javascript:;" class="row-del-btn" onclick="del(0,this)" title="删除"></a>'+'<input type="hidden" name="id[]" value="0"/></td>';
        $("#frm tr:last").after(tr);



    }

    //删除
    function delType(id,obj)
    {
        ST.Util.confirmBox('提示','确定删除吗?',function(){
            if(id==0){
                $(obj).parents('tr').first().remove();
            }
            else
            {
                var boxurl = SITEURL+'visa/ajax_visatype_del';
                $.getJSON(boxurl,"id="+id,function(data){

                    if(data.status == true){
                        $(obj).parents('tr').first().remove();
                        ST.Util.showMsg('删除成功',4);
                    }
                    else{
                        ST.Util.showMsg('删除失败',5);
                    }

                });
            }

        })
    }

</script>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
