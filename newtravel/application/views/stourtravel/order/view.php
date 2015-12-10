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
                 {$info['productname']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">出发日期：</dt>
            <dd>{$info['usedate']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">人数{if $typeid==1}(成人){/if}：</dt>
            <dd>{$info['dingnum']}</dd>
        </dl>
        {if $info['insurance']}
        <dl class="list_dl">
            <dt class="wid_90">保险：</dt>
            <dd>{$info['insurance']['payprice']}</dd>
        </dl>

        {/if}
		 <dl class="list_dl">
            <dt class="wid_90">积分抵现：</dt>
            <dd>{$info['jifentprice']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">价格{if $typeid==1}(成人){/if}：</dt>
            <dd><input type="text" class="set-text-xh text_200 mt-4" name="price" id="price" value="{$info['price']}" ></dd>
        </dl>

        {if $typeid==1}
            <dl class="list_dl">
                <dt class="wid_90">小孩数量：</dt>
                <dd>{$info['childnum']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">小孩价格：</dt>
                <dd><input type="text" class="set-text-xh text_200 mt-4" name="childprice" id="childprice" value="{$info['childprice']}" ></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">老人数量：</dt>
                <dd>{$info['oldnum']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">老人价格：</dt>
                <dd><input type="text" class="set-text-xh text_200 mt-4" name="oldprice" id="oldprice" value="{$info['oldprice']}" ></dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">单房差：</dt>
                <dd>{$info['roombalance']}</dd>
            </dl>
            <dl class="list_dl">
                <dt class="wid_90">单房差数量：</dt>
                <dd>{$info['roombalancenum']}</dd>
            </dl>
        {/if}

        <dl class="list_dl">
            <dt class="wid_90">客户姓名：</dt>
            <dd>{$info['linkman']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd>{$info['linktel']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">联系邮箱：</dt>
            <dd>{$info['linkemail']}</dd>
        </dl>
        {if isset($tourer)}
         {loop $tourer $r}
        <dl class="list_dl">
            <dt class="wid_90">游客{$n}：</dt>
            <dd style="height: auto">
                <ul>
                    <li>姓名:{$r['tourername']}</li>
                    <li>性别:{$r['sex']}</li>
                    <li>手机:{$r['mobile']}</li>
                    <li>证件:{$r['cardtype']}</li>
                    <li>证件号码:{$r['cardnumber']}</li>
                </ul>

            </dd>
        </dl>
        {/loop}
        {/if}
        <dl class="list_dl">
            <dt class="wid_90">预订说明：</dt>
            <dd style="height: auto"><textarea name="remark" style="width:400px;height:150px;border:1px solid #dcdcdc">{$info['remark']}</textarea></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">订单状态：</dt>
            <dd>

                {loop $statusnames $v}
                   <input name="status" type="radio" class="checkbox" value="{$v['status']}" {if $info['status']==$v['status']}checked="checked"{/if}  />{$v['name']}
                {/loop}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="id" name="id" value="{$info['id']}">
                <input type="hidden" id="typeid" name="typeid" value="{$typeid}">
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
                        return false;
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
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201510.1010&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
