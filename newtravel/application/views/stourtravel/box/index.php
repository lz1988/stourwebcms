
{if $type=='weblist'}
<!--站点选择弹出框-->
<div class="change-box-more" id="weblist_detail">
    <div class="level web_list">
        <a href="javascript:;" class="cur" onclick="CHOOSE.changeWeb(this,-1,'全部','{$resultid}')">全部</a>
        <a href="javascript:;" onclick="CHOOSE.changeWeb(this,0,'主站','{$resultid}')">主站</a>
        {loop $weblist $v}
         <a href="javascript:;" onclick="CHOOSE.changeWeb(this,{$v['webid']},'{$v['webname']}','{$resultid}')" >{$v['webname']}</a>
        {/loop}
    </div>
</div>
{/if}

{if $type=='startplace'}
<!--出发地选择弹出框-->
<div class="change-box-more" id="startplace_detail">
    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeStartPlace(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $startplace $v}
         <a href="javascript:;" data-level="1" onclick="CHOOSE.changeStartPlace(this,{$v['id']},'{$v['cityname']}','{$resultid}',0)" >{$v['cityname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='destlist'}
<!--目的地选择弹出框-->
<div class="change-box-more" id="destlist_detail">
    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeDestId(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $destlist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeDestId(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='attrlist'}
<!--属性选择弹出框-->
<div class="change-box-more" id="attrlist_detail">
    <input type="hidden" id="typeid" value="{$typeid}">
    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeAttrId(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $attrlist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeAttrId(this,{$v['id']},'{$v['attrname']}','{$resultid}',0)" >{$v['attrname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='carkind'}
<!--车型弹出框-->
<div class="change-box-more" id="carkindlist_detail">

    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeCarKind(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $carkindlist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeCarKind(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='carbrand'}
<!--车型弹出框-->
<div class="change-box-more" id="carbrandlist_detail">

    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeCarBrand(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $carbrandlist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeCarBrand(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='visatype'}
<!--签证类型弹出框-->
<div class="change-box-more" id="visakind_detail">

    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeVisaKind(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $visakindlist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeVisaKind(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='visacity'}
<!--签发城市弹出框-->
<div class="change-box-more" id="visacity_detail">

    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeVisaCity(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $visacitylist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeVisaCity(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        {/loop}
    </div>

</div>
{/if}

{if $type=='helpkind'}
<!--帮助分类弹出框-->
<div class="change-box-more" id="visacity_detail">

    <div class="level">

        <a href="javascript:;" class="cur" data-level="1" onclick="CHOOSE.changeHelpKind(this,0,'全部','{$resultid}',1)">全部</a>
        {loop $helpkindlist $v}
        <a href="javascript:;" data-level="1" onclick="CHOOSE.changeHelpKind(this,{$v['id']},'{$v['kindname']}','{$resultid}',0)" >{$v['kindname']}</a>
        {/loop}
    </div>

</div>
{/if}



