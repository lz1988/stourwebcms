<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>订单查看--思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }


</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">产品名称：</dt>
            <dd>
                 {$info['title']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">定金：</dt>
            <dd>{$info['dingjin']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">客户姓名：</dt>
            <dd>{$info['username']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd>{$info['phone']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">下单时间：</dt>
            <dd>{$info['addtime']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd><input name="status" type="radio" class="checkbox" value="0" {if $info['status']==0}checked="checked"{/if}  />未处理
                <input name="status" type="radio" class="checkbox" value="1" {if $info['status']==1}checked="checked"{/if}  />处理中
                <input name="status" type="radio" class="checkbox" value="2" {if $info['status']==2}checked="checked"{/if}  />交易成功
                <input name="status" type="radio" class="checkbox" value="3" {if $info['status']==3}checked="checked"{/if}  />取消订单
                <input name="status" type="radio" class="checkbox" value="4" {if $info['status']==4}checked="checked"{/if}  />已退款
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="id" name="id" value="{$info['id']}">
                <input type="hidden" id="type" name="type" value="xy">
            </dd>
        </dl>
    </div>
   </form>

<script language="JavaScript">



    $(function(){
        //保存
        $("#btn_save").click(function(){

            Ext.Ajax.request({
                url   :  SITEURL+"order/ajax_save",
                method  :  "POST",
                isUpload :  true,
                form  : "frm",
                success  :  function(response, opts)
                {

                    try{
                        var data = $.parseJSON(response.responseText);
                    }
                    catch(e){
                        ST.Util.showMsg("{__('norightmsg')}",5,1000);
                    }
                    if(data.status)
                    {
                        ST.Util.showMsg('保存成功!','4',2000);


                    }


                }});

        })


    })

</script>

</body>
</html>