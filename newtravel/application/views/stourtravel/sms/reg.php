
    <div id="cfg_member" class="info-one">
        <form id="regfrm">
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">短信注册通知</div>
                <div class="box-con">
                    <textarea name="reg_content" id="reg_content">{$reg}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs"><span><input type="radio" name="reg_open" value="1" {if $reg_open==1}checked="checked"{/if} /><label>开启</label></span><span><input type="radio" name="reg_open" value="0" {if $reg_open==0}checked="checked"{/if}/><label>关闭</label></span></div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PHONE#}">联系电话</a>
                    <a href="javascript:;" class="short-cut" data="{#LOGINNAME#}">登录名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PASSWORD#}">密码</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">注册短信验证码</div>
                <div class="box-con">
                    <textarea name="reg_msgcode_content" id="reg_msgcode_content">{$reg_msgcode}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs"><span><input type="radio" name="reg_msgcode_open" value="1" {if $reg_msgcode_open==1}checked="checked"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="reg_msgcode_open" value="0" {if $reg_msgcode_open==0}checked="checked"{/if}/><label>关闭</label></span></div>
                <div class="tool-bn">
                    <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PHONE#}">联系电话</a>
                    <a href="javascript:;" class="short-cut" data="{#CODE#}">验证码</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-one">
            <div class="set-one-box">
                <div class="box-tit">找回密码验证码</div>
                <div class="box-con">
                    <textarea name="reg_findpwd_content">{$reg_findpwd}</textarea>
                </div>
            </div>
            <div class="set-one-tool">
                <div class="tool-cs"><span><input type="radio" name="reg_findpwd_open" value="1" {if $reg_findpwd_open==1}checked="checkd"{/if}/><label>开启</label></span>
                    <span><input type="radio" name="reg_findpwd_open" value="0" {if $reg_findpwd_open==0}checked="checkd"{/if}/><label>关闭</label></span>
                </div>
                <div class="tool-bn">
                   <a href="javascript:;" class="short-cut" data="{#WEBNAME#}">网站名称</a>
                    <a href="javascript:;" class="short-cut" data="{#PHONE#}">联系电话</a>
                    <a href="javascript:;" class="short-cut" data="{#CODE#}">验证码</a>
                    <div class="clear-both"></div>
                </div>
            </div>
        </div>
        <div class="set-save">
            <a href="javascript:;" class="normal-btn" id="reg_btn_saveg">保存</a>
            <input type="hidden" name="msgtype" value="reg"/>
        </div>
        </form>
    </div>
    <script language="javascript">
        $(function(){
            $("#reg_btn_saveg").click(function(){
                $.ajax({
                    url:SITEURL+'sms/savemsg',
                    data: $('#regfrm').serialize(),
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