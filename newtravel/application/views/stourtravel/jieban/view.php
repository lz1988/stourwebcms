<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>结伴查看--思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }


</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">标题：</dt>
            <dd>
                {$info['title']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">目的地：</dt>
            <dd>
                {$info['destlist']}
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">出发日期：</dt>
            <dd>{$info['startdate']}&nbsp;&nbsp;&nbsp;可机动时间:{$info['vartime']}天</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">人数：</dt>
            <dd>成人:{$info['adultnum']}&nbsp;&nbsp;&nbsp;小孩:{$info['childnum']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">主题：</dt>
            <dd>{$info['attrname']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">意向线路：</dt>
            <dd>{$info['lineinfo']}</dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">行程说明：</dt>
            <dd style="height: auto;">{$info['memo']}</dd>
        </dl>


        <dl class="list_dl">
            <dt class="wid_90">发起人昵称：</dt>
            <dd>{$info['membername']}</dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">发起人电话：</dt>
            <dd><span style="color: red">{$info['membermobile']}</span></dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">加入人数：</dt>
            <dd>{$info['joinnum']}人</dd>
        </dl>
        {if isset($info['joinlist'])}
         {loop $info['joinlist'] $r}
        <dl class="list_dl">
            <dt class="wid_90">加入会员{$n}：</dt>
            <dd style="height: auto">
                <ul>
                    <li>姓名:{$r['linkman']}</li>
                    <li>手机:<span style="color: red">{$r['mobile']}</span></li>
                    <li>成人数量:<span style="color: red">{$r['adultnum']}</span> &nbsp;&nbsp;小孩数量:<span style="color: red">{$r['childnum']}</span></li>

                </ul>

            </dd>
        </dl>
        {/loop}
        {/if}
        <dl class="list_dl">
            <dt class="wid_90">约伴状态：</dt>
            <dd>
              <input name="status" type="radio" class="checkbox" value="0" {if $info['status']==0}checked="checked"{/if}  />关闭
              <input name="status" type="radio" class="checkbox" value="1" {if $info['status']==1}checked="checked"{/if}  />开启
              <input name="status" type="radio" class="checkbox" value="2" {if $info['status']==2}checked="checked"{/if}  />已成团出发

            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <input type="hidden" id="id" name="id" value="{$info['id']}">
                <input type="hidden" id="typeid" name="typeid" value="{$typeid}">
            </dd>
        </dl>
    </div>
   </form>


</body>
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201508.2002&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
