<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>慧择接口设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
    <style>
        .no-blk{
            color:red;
        }
        .contact-ins{
            position: fixed;
            right: 10px;
            top:80px;
            display: inline;
        }
    </style>
</head>

<body>
<table class="content-tab">
    <tr>
        <td width="119px" class="content-lt-td" valign="top">
            {template 'stourtravel/public/leftnav'}
            <!--右侧内容区-->
        </td>
        <td valign="top" class="content-rt-td">


                    <form id="configfrm">
                        <div class="w-set-con">
                            <div class="w-set-tit bom-arrow"><span class="on" data-id="huizhe_con"><s></s>慧择接口</span><span data-id="buyer_con"><s></s>投保人</span> <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
                            <div class="w-set-nr" id="huizhe_con">

                                <div class="picture ml-10">


                                    <p><span class="fl wid_150">合作者ID：</span>
                                        <input type="text" name="cfg_huizhe_partnerid" id="cfg_huizhe_partnerid"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>

                                    <p><span class="fl wid_150">站点SID：</span><input type="text" name="cfg_huizhe_key"
                                                                                    id="cfg_huizhe_key"
                                                                                    class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>

                                    <p><span class="fl wid_150">子账户ID：</span><input type="text"
                                                                                    name="cfg_huizhe_sonpartnerid"
                                                                                    id="cfg_huizhe_sonpartnerid"
                                                                                    class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>
                                    <p><span class="fl wid_150">联系人姓名：</span><input type="text"
                                                                                    name="cfg_huizhe_member_name"
                                                                                    id="cfg_huizhe_member_name"
                                                                                    class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>
                                    <p><span class="fl wid_150">联系电话：</span><input type="text"
                                                                                    name="cfg_huizhe_member_mobile"
                                                                                    id="cfg_huizhe_member_mobile"
                                                                                    class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>
                                    <p><span class="fl wid_150">邮箱：</span><input type="text"
                                                                                   name="cfg_huizhe_member_email"
                                                                                   id="cfg_huizhe_member_email"
                                                                                   class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>
                                    <p><span class="fl wid_150">联系地址：</span><input type="text"
                                                                                   name="cfg_huizhe_member_address"
                                                                                   id="cfg_huizhe_member_address"
                                                                                   class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>
                                    <p><span class="fl wid_150">所属旅行社：</span><input type="text"
                                                                                   name="cfg_huizhe_member_company"
                                                                                   id="cfg_huizhe_member_company"
                                                                                   class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;
                                    </p>




                                </div>
                                <div class="opn-btn">
                                    <a class="normal-btn btn_save" href="javascript:;" id="btn_save">保存</a>
                                    <a class="normal-btn" href="javascript:;" id="btn_get">从缓存更新保险产品</a>
                                    <a class="normal-btn" href="javascript:;" id="btn_base_get">完全更新保险产品</a>
                                    <!-- <a class="cancel" href="#">取消</a>-->
                                    <input type="hidden" name="webid" id="webid" value="0">
                                </div>


                            </div>
                            <div class="w-set-nr" id="buyer_con" style="display: none;">

                                <div class="picture ml-10">
                                    <p><span class="fl wid_150">投保人姓名：</span>
                                        <input type="text" name="cfg_insurance_buyer_name" id="cfg_insurance_buyer_name"
                                               class="set-text-xh text_250 ml-5"><label class="no-blk">*</label>&nbsp;&nbsp;</p>

                                    <p><span class="fl wid_150">投保人拼音：</span>
                                        <input type="text" name="cfg_insurance_buyer_pinyin" id="cfg_insurance_buyer_pinyin"
                                               class="set-text-xh text_250 ml-5">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">证件类型：</span>
                                        <select name="cfg_insurance_buyer_cardtype" id="cfg_insurance_buyer_cardtype">
                                            <option value="1">身份证</option>
                                            <option value="2">军官证</option>
                                            <option value="3">护照</option>
                                            <option value="4">港澳通行证</option>
                                            <option value="5">驾照</option>
                                            <option value="7">台胞证</option>
                                            <option value="8">出生证</option>
                                            <option value="99">其他</option>
                                        </select>
                                        <label class="no-blk">*</label>&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">证件号：</span>
                                        <input type="text" name="cfg_insurance_buyer_cardcode" id="cfg_insurance_buyer_cardcode"
                                               class="set-text-xh text_250 ml-5 "><label class="no-blk">*</label>&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">性别：</span>
                                       <select id="cfg_insurance_buyer_sex" name="cfg_insurance_buyer_sex"><option value="1">男</option>
                                       <option value="0">女</option>
                                       </select><label class="no-blk">*</label>&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">出生日期：</span>
                                        <input type="text" name="cfg_insurance_buyer_birthday" id="cfg_insurance_buyer_birthday"
                                               class="set-text-xh text_250 ml-5 "><label class="no-blk">*</label>&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">联系地址：</span>
                                        <input type="text" name="cfg_insurance_buyer_address" id="cfg_insurance_buyer_address"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">住址邮编：</span>
                                        <input type="text" name="cfg_insurance_buyer_postcode" id="cfg_insurance_buyer_postcode"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">固定电话：</span>
                                        <input type="text" name="cfg_insurance_buyer_phone" id="cfg_insurance_buyer_phone"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">移动电话：</span>
                                        <input type="text" name="cfg_insurance_buyer_mobile" id="cfg_insurance_buyer_mobile"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">传真：</span>
                                        <input type="text" name="cfg_insurance_buyer_fax" id="cfg_insurance_buyer_fax"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">邮编：</span>
                                        <input type="text" name="cfg_insurance_buyer_email" id="cfg_insurance_buyer_email"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">家庭住址：</span>
                                        <input type="text" name="cfg_insurance_buyer_homeaddress" id="cfg_insurance_buyer_homeaddress"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">职业代码：</span>
                                        <input type="text" name="cfg_insurance_buyer_jobcode" id="cfg_insurance_buyer_jobcode"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">职业等级：</span>
                                        <input type="text" name="cfg_insurance_buyer_joblevel" id="cfg_insurance_buyer_joblevel"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                    <p><span class="fl wid_150">职业名称：</span>
                                        <input type="text" name="cfg_insurance_buyer_job" id="cfg_insurance_buyer_job"
                                               class="set-text-xh text_250 ml-5 ">&nbsp;&nbsp;</p>
                                </div>
                                <div class="opn-btn">
                                    <a class="normal-btn btn_save" href="javascript:;">保存</a>
                                </div>
                            </div>

                        </div>
                    </form>
                    <div id="ins_list">
                    </div>

        </td>
    </tr>
</table>
<div class="contact-ins">
    <img src="{$GLOBALS['cfg_public_url']}images/in_03.png">
</div>

<script>

    $(document).ready(function () {

        //配置信息保存
        $(".btn_save").click(function () {
            var webid = 0
            Config.saveConfig(webid);
        })
        $(".bom-arrow span").click(function()
        {
            var data_id=$(this).attr('data-id');
            $(".w-set-nr").hide();
            $(".bom-arrow span").removeClass("on");
            $(this).addClass("on");
            $("#"+data_id).show();

        });

        $("#btn_get").click(updateInsurance);
        $("#btn_base_get").click(function(){
            updateInsurance(1)
        });

        getConfig(0);
        // displayInsurance();
    });


    //获取配置
    function getConfig(webid) {

        Config.getConfig(webid, function (data) {
            $("#configfrm input,#configfrm select").each(function (index, ele) {
                var name = $(ele).attr("name");
                if (data[name])
                    $(ele).val(data[name]);
            });

        })

    }
    function updateInsurance(usebase) {
        var params={};
        if(usebase==1)
        {
            params['usebase']=1;
        }
        var url = SITEURL + "insurance/ajax_huizhe_update";
        ST.Util.showMsg('更新中',6,100000);
        $.ajax({
            type: 'POST',
            url: url,
            data:params,
            dataType: 'json',
            success: function (data) {
                ST.Util.hideMsgBox();
                if (data.status) {
                    ST.Util.showMsg(data.msg, 4)
                }
                else
                    ST.Util.showMsg(data.msg, 5)

            }
        });
    }


</script>

</body>
</html>
