<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>附加扩展字段到列表页</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript("jquery.validate.js"); }


</head>
<body style="background-color: #fff">
<form id="frm" name="frm">
    <p style="color: red;margin-bottom:10px;line-height: 30px;">说明:新增内容项在前台详细页显示会从扩展字段里调取,如果这里没有需要字段请先从扩展字段里添加.</p>
    <div class="out-box-con">
        {loop $fieldlist $row}
            <input type="checkbox" id="{$n}" data-description="{$row['description']}" value="{$row['fieldname']}"><label for="{$n}">{$row['description']}</label> &nbsp;&nbsp;
        {/loop}
        <dl class="list_dl">
            <dt class="wid_90" style="width: 360px;">&nbsp;</dt>
            <dd>
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">确定</a>
            </dd>
        </dl>
    </div>
    <input type="hidden" id="typeid" value="{$typeid}"/>
</form>

<script language="JavaScript">




    $(function(){
        //保存
        $("#btn_save").click(function(){
            var fieldlist = '';
            var description = '';
            var typeid = $("#typeid").val();
            if($('input:checked').length<1){
                ST.Util.showMsg('请选择内容项',5,1000);
                return false;
            }else{
                $('input:checked').each(function(i,obj){
                        fieldlist+=$(obj).val()+',';
                        description+=$(obj).attr('data-description');
                })
            }
            $.ajax({
                type:'POST',
                url:SITEURL+'box/ajax_content_additem',
                data:{typeid:typeid,fieldlist:fieldlist,description:description},
                dataType:'json',
                success:function(data){
                    if(data.status==1){
                        ST.Util.showMsg('添加成功!',4,1000);
                        ST.Util.closeBox();
                    }
                }
            })



        })
    })

</script>

</body>
</html>