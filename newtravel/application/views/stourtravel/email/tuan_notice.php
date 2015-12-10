
<div class="info-one">
    <form id="tuanfrm">
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">订单未处理</div>
                <div class="box-con">
                    <textarea name="msg1">{$tuan_order_msg1}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs">
                    <span><input type="radio" name="isopen1" value="1" {if $tuan_order_msg1_open==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="isopen1" value="0" {if $tuan_order_msg1_open==0}checked="checked"{/if}/><label>关闭</label></span>
                </div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#EMAIL#}">邮箱</a>
                    <a href="javascript:;" class="short-cut" data="{#PRODUCTNAME#}">产品名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PRICE#}">单价</a>
                    <a href="javascript:;" class="short-cut" data="{#NUMBER#}">预订数量</a>
                    <a href="javascript:;" class="short-cut" data="{#TOTALPRICE#}">总价</a>
                    <a href="javascript:;" class="short-cut" data="{#ORDERSN#}">订单号</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">订单处理中</div>
                <div class="box-con">
                    <textarea name="msg2">{$tuan_order_msg2}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs">
                    <span><input type="radio" name="isopen2" value="1" {if $tuan_order_msg2_open==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="isopen2" value="0" {if $tuan_order_msg2_open==0}checked="checked"{/if}/><label>关闭</label></span></div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#EMAIL#}">邮箱</a>
                    <a href="javascript:;" class="short-cut" data="{#PRODUCTNAME#}">产品名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PRICE#}">单价</a>
                    <a href="javascript:;" class="short-cut" data="{#NUMBER#}">预订数量</a>
                    <a href="javascript:;" class="short-cut" data="{#TOTALPRICE#}">总价</a>
                    <a href="javascript:;" class="short-cut" data="{#ORDERSN#}">订单号</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">订单付款成功</div>
                <div class="box-con">
                    <textarea name="msg3">{$tuan_order_msg3}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs"><span><input type="radio" name="isopen3" value="1" {if $tuan_order_msg3_open==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="isopen3" value="0" {if $tuan_order_msg3_open==0}checked="checked"{/if}/><label>关闭</label></span>
                </div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#EMAIL#}">邮箱</a>
                    <a href="javascript:;" class="short-cut" data="{#PRODUCTNAME#}">产品名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PRICE#}">单价</a>
                    <a href="javascript:;" class="short-cut" data="{#NUMBER#}">预订数量</a>
                    <a href="javascript:;" class="short-cut" data="{#TOTALPRICE#}">总价</a>
                    <a href="javascript:;" class="short-cut" data="{#ORDERSN#}">订单号</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">订单取消</div>
                <div class="box-con">
                    <textarea name="msg4">{$tuan_order_msg4}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs"><span><input type="radio" name="isopen4" value="1" {if $tuan_order_msg4_open==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="isopen4" value="0" {if $tuan_order_msg4_open==0}checked="checked"{/if}/><label>关闭</label></span>
                </div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#EMAIL#}">邮箱</a>
                    <a href="javascript:;" class="short-cut" data="{#PRODUCTNAME#}">产品名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PRICE#}">单价</a>
                    <a href="javascript:;" class="short-cut" data="{#NUMBER#}">预订数量</a>
                    <a href="javascript:;" class="short-cut" data="{#TOTALPRICE#}">总价</a>
                    <a href="javascript:;" class="short-cut" data="{#ORDERSN#}">订单号</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-save">
            <a class="normal-btn" href="javascript:;" id="tuan_btn_saveg">保存</a>
            <input type="hidden" name="msgtype" value="tuan_order_msg">
        </div>
    </form>
</div>
<script language="javascript">
    $(function(){
        $("#tuan_btn_saveg").click(function(){
            $.ajax({
                url:SITEURL+'email/savemsg',
                data: $('#tuanfrm').serialize(),
                type: "POST",
                dataType:'json',
                success:function(data){
                    if(data.status){
                        ST.Util.showMsg('保存成功',4);
                    }
                }
            })
            return false;
        })
    })
</script>