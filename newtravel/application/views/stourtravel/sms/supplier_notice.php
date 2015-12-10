<div class="info-one">
    <form id="supplier_configfrm">
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">生成订单</div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs">
                    <span><input type="radio" name="cfg_supplier_msg_open" value="1" {if $config['cfg_supplier_msg_open']==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="cfg_supplier_msg_open" value="0" {if  $config['cfg_supplier_msg_open']==0}checked="checked"{/if}/><label>关闭</label></span>
                </div>
            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">发送给供应商</div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs">
                    <span><input type="radio" name="cfg_supplier_send_open" value="1" {if $config['cfg_supplier_send_open']==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="cfg_supplier_send_open" value="0" {if $config['cfg_supplier_send_open']==0}checked="checked"{/if}/><label>关闭</label></span>
                </div>

            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">本站管理员手机</div>
                <div class="box-con">
                    <input name="cfg_webmaster_phone" value="{$config['cfg_webmaster_phone']}"/>
                </div>
            </div>

        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">内容</div>
                <div class="box-con">
                    <textarea name="cfg_supplier_msg">{$config['cfg_supplier_msg']}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs">
                </div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#LINKNAME#}">预订人</a>
                    <a href="javascript:;" class="short-cut" data="{#PHONE#}">联系电话</a>
                    <a href="javascript:;" class="short-cut" data="{#PRODUCTNAME#}">产品名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PRICE#}">单价</a>
                    <a href="javascript:;" class="short-cut" data="{#NUMBER#}">预订数量</a>
                    <a href="javascript:;" class="short-cut" data="{#TOTALPRICE#}">总价</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-save">
            <a href="javascript:;" class="normal-btn" id="supplier_btn_saveg">保存</a>
        </div>
    </form>
</div>
<script language="javascript">
    $(function(){

        //配置信息保存
        $("#supplier_btn_saveg").click(function(){
            var url = SITEURL+"config/ajax_saveconfig";
            var frmdata = $("#supplier_configfrm").serialize();
            var frmdata = frmdata+"&webid=0";
            console.log()
            $.ajax({
                type:'POST',
                url:url,
                dataType:'json',
                data:frmdata,
                success:function(data){
                    if(data.status==true)
                    {
                        ST.Util.showMsg('保存成功',4);
                    }
                }
            })


        });
    })
</script>


