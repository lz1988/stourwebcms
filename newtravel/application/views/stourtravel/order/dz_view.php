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
            <dt class="wid_90">联系人：</dt>
            <dd>
                 {$info['contactname']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">性别：</dt>
            <dd>{$info['sex']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">目的地：</dt>
            <dd>{$info['dest']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">出发时间：</dt>
            <dd>{php echo Common::myDate('Y-m-d',$info['starttime']);}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">旅游天数：</dt>
            <dd>{$info['days']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">出发地：</dt>
            <dd>{$info['startplace']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">成人数量：</dt>
            <dd>{$info['adultnum']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">儿童数量：</dt>
            <dd>{$info['childnum']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">飞行等级：</dt>
            <dd>{$info['planerank']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">酒店等级：</dt>
            <dd>{$info['hotelrank']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">房型：</dt>
            <dd>{$info['room']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">用餐形式：</dt>
            <dd>{$info['food']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">合适联系时间：</dt>
            <dd>{$info['contacttime']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">联系电话：</dt>
            <dd>{$info['phone']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">email：</dt>
            <dd>{$info['email']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">地址：</dt>
            <dd>{$info['address']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">预订说明：</dt>
            <dd style="height: auto;margin-left:90px;">{$info['content']}</dd>
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
                <a class="default-btn wid_60" id="btn_save" href="javascript:;">保存</a>
                <input type="hidden" id="id" name="id" value="{$info['id']}">
                <input type="hidden" id="type" name="type" value="dz">
                <input type="hidden" id="typeid" name="typeid" value="0">
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
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.0302&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
