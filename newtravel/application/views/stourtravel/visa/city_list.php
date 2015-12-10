<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>签发城市管理-思途CMS3.0</title>
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
                                <a href="javascript:;" class="add-btn-class ml-10" onclick="addcity()">添加</a>
                            </div>

                            <div class="table-div-b-m">
                                <form name="frm" id="frm">
                                    <table width="95%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <th scope="col" width="5%" height="40">排序</th>
                                            <th scope="col" width="90%" align="left" class="pl-30"><span class="fl">签发城市</span></th>
                                            <th scope="col" width="5%">管理</th>
                                        </tr>
                                    </table>

                                </form>
                            </div>

                            <div class="opn-btn">
                                <a class="normal-btn" href="javascript:;" onclick="save()">保存</a>
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
        $(".w-set-tit").find('span').eq(2).addClass('on');
        getList();

    })
    var delpic ="{php echo Common::getIco('del');}";
    function getList()
    {


        $.getJSON(SITEURL+"visa/ajax_visacity_list","",function(data){

            $("#frm tr:not(:eq(0))").remove();//先清除内容
            var trlist = data.trlist;


            $.each(trlist, function(i, trinfo){
                var tr = '';
                tr += "<tr>";
                tr += '<td height="40" align="center"><input type="text" class="tb-text wid_60 center"  name="displayorder[]" value="'+trinfo.displayorder+'" /></td>';
                tr += '<td class="pl-30"><input type="text"  name="kindname[]" class="tb-text wid_200 pl-5"  value="'+trinfo.kindname+'" /></td>';
                tr += '<td align="center" >'+'<a href="javascript:;" class="row-del-btn" onclick="del('+trinfo.id+',this)" title="删除"></a>'+'<input type="hidden" name="id[]" value="'+trinfo.id+'"/></td>';
                $("#frm tr:last").after(tr);
            });
        });
    }


    function save()
    {
        var webid=0;
        var ajaxurl = SITEURL+'visa/ajax_visacity_save';
        ST.Util.showMsg('保存中,请稍后...',6,5000);
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
    function addcity()
    {

        $.ajax({
            type:'POST',
            url:SITEURL+'visa/ajax_visacity_add',
            dataType:'json',
            success:function(data){
                if(data.status==1){
                    var tr = '';
                    tr += "<tr>";
                    tr += '<td height="40" align="center"><input type="text" class="tb-text wid_60 center"  name="displayorder[]" class="tb-text" value="9999" /></td>';
                    tr += '<td class="pl-30"><input type="text"  name="kindname[]" class="tb-text wid_200 pl-5" value="自定义" /></td>';
                    tr += '<td align="center" >'+'<a href="javascript:;" class="row-del-btn" onclick="del('+data.id+',this)" title="删除"></a>'+'<input type="hidden" name="id[]" value="'+data.id+'"/></td>';
                    $("#frm tr:last").after(tr);
                }
                else{
                    ST.Util.showMsg("{__('norightmsg')}",5,1000);
                }
            }
        })






    }

    //删除
    function del(id,obj)
    {
        ST.Util.confirmBox('删除签发城市','确定删除吗?',function(){
            if(id==0){
                $(obj).parents('tr').first().remove();
            }
            else
            {
                var boxurl = SITEURL+'visa/ajax_visacity_del';
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
