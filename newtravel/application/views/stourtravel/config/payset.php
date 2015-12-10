<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>支付设置</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript('config.js');}
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>
<style>
   .paylist{
       padding: 10px 0 0 10px;
       border-bottom: 1px #d8d8d8 solid;
       zoom: 1;
       overflow: hidden;
       margin-bottom: 10px;
   }
   .paylist li{
       float: left;
       padding: 0 10px;
       height: 25px;
       line-height: 25px;
       text-align: center;
       border: 1px #d8d8d8 solid;
       border-width: 1px 1px 0 1px;
       margin-right: 10px;
       cursor: pointer;
   }
   .paylist li label{
		 cursor:pointer}
   .paylist li input{
       vertical-align: middle;
       margin: 3px 3px 3px 4px;
			 cursor:pointer
   }
   .paylist li.active{
       border: 1px #d8d8d8 solid;
       border-width: 1px 1px 0 1px;
       background: #f6f6f6;
       font-weight: bold
   }
   .pay-container .tit{
       width:140px;
       color: #006498;
       height: 45px;
       line-height: 45px;
       font-size: 12px;
       font-weight: 500;
			 padding-right:10px
   }
   .pay-container .tit .tit-sp
   {
       float:left;
   }
   .pay-container .pay-one{
       padding: 10px 10px 10px 20px;
   }
   .pay-container .inputtext{
       width:400px;
   }
   .help-ico{
       margin-top: 7px;
       margin-left: 5px;

   }

</style>

<body>

	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td">

          {php if(strpos('tes','r')!==false) echo 'true';}
        <form id="configfrm">
         <div class="w-set-con">
        	<div class="w-set-tit bom-arrow"><span class="on"><s></s>支付设置</span><a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a></div>
          <div class="w-set-nr">
            <form id="configfrm">
              <div class="picture">

                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ml-10" style="display: table;" id="paytable" >
                      <tr>
                          <td colspan="2">
                              <ul class="paylist">
                                  <li class="active"><input  type="checkbox" name="alipay" value="1" {if strpos($config['cfg_pay_type'],'1')!==false} checked="checked"{/if}>支付宝</label></li>
                                  <li class=""><input  type="checkbox" name="bill" value="2" {if strpos($config['cfg_pay_type'],'2')!==false} checked="checked"{/if}>快钱</li>
                                  <li class=""><input  type="checkbox" name="huicao" value="3" {if strpos($config['cfg_pay_type'],'3')!==false} checked="checked"{/if}>汇潮</li>
                                  <li class=""><input  type="checkbox" name="chinabank" value="4" {if strpos($config['cfg_pay_type'],'4')!=false} checked="checked"{/if}>银联</li>
                                  <li class=""><input  type="checkbox" name="qianbao" value="5" {if strpos($config['cfg_pay_type'],'5')!==false} checked="checked"{/if}>钱包</li>
                                  <li class=""><input  type="checkbox" name="xianxia" value="6" {if strpos($config['cfg_pay_type'],'6')!==false} checked="checked"{/if}>线下支付</li>
                                  <li class=""><input  type="checkbox" name="paypal" value="7" {if strpos($config['cfg_pay_type'],'7')!==false} checked="checked"{/if}>贝宝支付</li>
                                  <li class=""><input  type="checkbox" name="weixinpay" value="8" {if strpos($config['cfg_pay_type'],'8')!==false} checked="checked"{/if}>微信支付</li>
                              </ul>
                          </td>
                      </tr>
                      </table>
                      <div class="pay-container" >
                          <div class="pay-one" id="pay_alipay">
                              <div class="pay-nav"></div>
                              <div class="pay-sg">
                                 <table>
                                     <tr><td class="tit">支付宝接口类型：</td><td class="alipay_multi">
                                  <input id="alipaytype0" type="checkbox" name="alipay_cash" value="11" {if in_array('11',explode(',',$config['cfg_pay_type']))!==false} checked="checked"{/if} ><label for="alipaytype0">即时到帐交易接口</label>
                                  <input id="alipaytype1" type="checkbox" name="alipay_double" value="12" {if in_array('12',explode(',',$config['cfg_pay_type']))!==false} checked="checked"{/if}><label for="alipaytype1">双功能</label>
                                  <input id="alipaytype2" type="checkbox" name="alipay_danbao" value="13" {if in_array('13',explode(',',$config['cfg_pay_type']))!==false} checked="checked"{/if}><label for="alipaytype2">纯担保交易</label>
                                  <input id="alipaytype3" type="checkbox" name="alipay_bank" value="14" {if in_array('14',explode(',',$config['cfg_pay_type']))!==false} checked="checked"{/if}><label for="alipaytype3">网银支付</label>

                                         </td></tr>
                                     <tr>
                                         <td class="tit"><span class="tit-sp">收款支付宝帐号：</span><div class="help-ico">{php echo Common::getIco('help',16); }</div></td>
                                         <td><input name="cfg_alipay_account" type="text" value="{$config['cfg_alipay_account']}" id="cfg_alipay_account" class="set-text inputtext"></td>
                                     </tr>
                                     <tr>
                                         <td class="tit"><span class="tit-sp">支付宝合作者身份ID：</span><div class="help-ico">{php echo Common::getIco('help',16); }</div></td>
                                         <td><input name="cfg_alipay_pid" type="text" value="{$config['cfg_alipay_pid']}" id="cfg_alipay_pid" class="set-text inputtext"></td>
                                     </tr>
                                     <tr>
                                         <td class="tit"><span class="tit-sp">支付宝安全校验码：</span><div class="help-ico">{php echo Common::getIco('help',17); }</div></td>
                                         <td><input name="cfg_alipay_key" type="text" value="{$config['cfg_alipay_key']}" id="cfg_alipay_key" class="set-text inputtext"></td>
                                     </tr>
                                 </table>
                              </div>
                          </div>
                          <div class="pay-one" id="pay_bill" style="display: none">
                              <div class="pay-sg">
                                  <table>
                                  <tr>
                                      <td class="tit"><span class="tit-sp">快钱网关商户号：</span><div class="help-ico">{php echo Common::getIco('help',18); }</div></td>
                                      <td><input name="cfg_bill_account" type="text" value="{$config['cfg_bill_account']}" id="cfg_bill_account" class="set-text inputtext"></td>
                                  </tr>
                                  <tr>
                                      <td class="tit"><span class="tit-sp">快钱商户证书密钥：</span><div class="help-ico">{php echo Common::getIco('help',19); }</div></td>
                                      <td><input name="cfg_bill_key" type="text" id="BillKey" value="{$config['cfg_bill_key']}" class="set-text inputtext" ></td>
                                  </tr>
                                 </table>
                              </div>

                          </div>
                          <div class="pay-one" id="pay_huicao" style="display: none">
                              <div class="pay-sg">
                                  <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">网关商户号:</span><div class="help-ico">{php echo Common::getIco('help',20); }</div></td>
                                          <td><input name="cfg_huicao_account" type="text" id="cfg_huicao_account" value="{$config['cfg_huicao_account']}" class="set-text inputtext" ></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">商户密钥:</span><div class="help-ico">{php echo Common::getIco('help',21); }</div></td>
                                          <td><input name="cfg_huicao_key" type="text" id="cfg_huicao_key" value="{$config['cfg_huicao_key']}" class="set-text inputtext"></td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="pay-one" id="pay_qianbao" style="display: none">
                              <div class="pay-sg">
                                  <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">商户号(merchno):</span><div class="help-ico">{php echo Common::getIco('help',22); }</div></td>
                                          <td><input name="cfg_qianbao_merchno" type="text" id="cfg_qianbao_merchno" value="{$config['cfg_qianbao_merchno']}" class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">密钥(key):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_qianbao_key" type="text" id="cfg_qianbao_key" value="{$config['cfg_qianbao_key']}"  class="set-text inputtext"></td>
                                      </tr>

                                  </table>
                              </div>
                          </div>
                          <div class="pay-one" id="pay_xianxia" style="display: none">
                              <div class="pay-sg">
                                  <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">线下支付配置:</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td> {php Common::getEditor('cfg_pay_xianxia',$config['cfg_pay_xianxia'],700,200);}</td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="pay-one" id="pay_paypal" style="display: none">
                              <div class="pay-sg">
                                  <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">帐号(business):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_paypal_key" type="text" id="cfg_paypal_key" value="{$config['cfg_paypal_key']}"  class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">币种(currency):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_paypal_currency" type="text" id="cfg_paypal_currency" value="{$config['cfg_paypal_currency']}"  class="set-text inputtext"></td>
                                      </tr>
                                  </table>
                              </div>
                          </div>
                          <div class="pay-one" id="pay_weixinpay" style="display: none">
                              <div class="pay-sg">
                                  <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">帐号标识(APPID):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_wxpay_appid" type="text" id="cfg_wxpay_appid" value="{$config['cfg_wxpay_appid']}"  class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">受理商ID(MCHID):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_wxpay_mchid" type="text" id="cfg_wxpay_mchid" value="{$config['cfg_wxpay_mchid']}"  class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">密钥(KEY):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_wxpay_key" type="text" id="cfg_wxpay_key" value="{$config['cfg_wxpay_key']}"  class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">开发者(APPSECRET):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_wxpay_appsecret" type="text" id="cfg_wxpay_appsecret" value="{$config['cfg_wxpay_appsecret']}"  class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit" colspan="2"><span class="tit-sp">请使用ftp上传证书到/shouji/public/thirdpay/weixinpay/WxPayPubHelper/cacert和/thirdpay/weixinpay/cert目录下</span><br><img src="{$GLOBALS['cfg_public_url']}images/wxpay.png" alt="示例图片"/></td>
                                      </tr>

                                  </table>
                              </div>
                          </div>
                          <div class="pay-one" id="pay_chinabank" style="display: none">
                              <div class="pay-nav"><table><tr><td class="tit">支付类型：</td><td><input type="radio" class="yinliantype" name="cfg_yinlian_type" {if $config['cfg_yinlian_type']==0}checked="checked"{/if} value="0"/>MD5版&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="cfg_yinlian_type" class="yinliantype" value="1"  {if $config['cfg_yinlian_type']==1}checked="checked"{/if}/>证书版</td></tr></table></div>
                              <div class="pay-sg">
                                  <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">商户Id(merId):</span><div class="help-ico">{php echo Common::getIco('help',22); }</div></td>
                                          <td><input name="cfg_yinlian_merid" type="text" id="cfg_yinlian_merid" value="{$config['cfg_yinlian_merid']}" class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">商户名(merAbbr):</span><div class="help-ico">{php echo Common::getIco('help',23); }</div></td>
                                          <td><input name="cfg_yinlian_mername" type="text" id="cfg_yinlian_mername" value="{$config['cfg_yinlian_mername']}"  class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">密文(security_key):</span><div class="help-ico">{php echo Common::getIco('help',24); }</div></td>
                                          <td><input name="cfg_yinlian_securitykey" type="text" id="cfg_yinlian_securitykey" value="{$config['cfg_yinlian_securitykey']}" class="set-text inputtext"></td>
                                      </tr>
                                 </table>
                             </div>
                             <div class="pay-sg">
                                 <table>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">商户号:</span><div class="help-ico">{php echo Common::getIco('help',24); }</div></td>
                                          <td><input name="cfg_yinlian_new_name" type="text" id="cfg_yinlian_new_name" value="{$config['cfg_yinlian_new_name']}" class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">密钥:</span><div class="help-ico">{php echo Common::getIco('help',24); }</div></td>
                                          <td><input name="cfg_yinlian_new_securitykey" type="text" id="cfg_yinlian_new_securitykey" value="{$config['cfg_yinlian_new_securitykey']}" class="set-text inputtext"></td>
                                      </tr>
                                      <tr>
                                          <td class="tit"><span class="tit-sp">证书:</span><div class="help-ico">{php echo Common::getIco('help',24); }</div></td>
                                          <td>
                                              <span class="tit-sp">请使用ftp上传证书到/thirdpay/yinlian/certs目录下,文件名称为zhengshu.pfx</span>
                                          </td>
                                      </tr>
                                 </table>
                             </div>


                           </div>


                      </div>


              </div>
            <div class="opn-btn">
            	<a class="normal-btn" href="javascript:;" id="btn_save">保存</a>
             <!-- <a class="cancel" href="#">取消</a>-->
                <input type="hidden" name="webid" id="webid" value="0">
                <input type="hidden" name="cfg_pay_type" id="cfg_pay_type" value="{$config['cfg_pay_type']}">
            </div>
            </form>

          </div>
        </div>
        </form>

  </td>
  </tr>
  </table>

  
  
	<script>

	$(document).ready(function(){




        //配置信息保存
        $("#btn_save").click(function(){

            var webid= 0;
            var paytype = '';
            $(".paylist input:checked,.alipay_multi input:checked").each(function(){
                var type = $(this).attr('name');
                if(checkPayitem(type)){
                    paytype = paytype+$(this).val()+',';
                }

            })
            if(paytype!='')
            {
                paytype = paytype.substr(0,paytype.length-1);
            }
            $("#cfg_pay_type").val(paytype);

            Config.saveConfig(webid);
        })

        //切换
        $(".paylist").find('li').click(function(e){
            if (e && e.stopPropagation)
            //因此它支持W3C的stopPropagation()方法
                e.stopPropagation();
            else
            //否则，我们需要使用IE的方式来取消事件冒泡
                window.event.cancelBubble = true;
            $(".paylist li").removeClass('active');
            $(this).addClass('active');
            var name=$(this).find('input:first').attr('name');
            var current_ele= $(".pay-container #pay_"+name);
            $(".pay-container .pay-one").hide();
            current_ele.show();
            if(current_ele.find('.pay-nav input:radio').length>1)
            {
                 var checked_radio=current_ele.find('.pay-nav input:radio:checked');
                var index= current_ele.find('.pay-nav input').index(checked_radio[0]);
                var current_tab=current_ele.find(".pay-sg:eq("+index+")");
                current_ele.find(".pay-sg").hide();
                current_tab.show();
            }

        })

        //切换同一支付的不同支付方式
        $(".pay-one .pay-nav input:radio").click(function(){
            var pele=$(this).parents('.pay-nav:first');
            var index= pele.find('input:radio').index(this);
            //pele.find('input:checkbox').eq(index).show();
            pele.siblings('.pay-sg').hide();
            pele.siblings('.pay-sg').eq(index).show();

        });


     });

       function checkPayitem($paytype)
       {
           var flag = true;


           switch($paytype){
              case "alipay":
                var v1 = $('#cfg_alipay_account').val();
                var  v2 = $('#cfg_alipay_pid').val();
                var v3 = $('#cfg_alipay_key').val();
                var v4 = $('#cfg_alipay_signtype').val();
                 if(v1==''||v2==''||v3==''||v4==''){
                     flag = false;
                 }
              break;
              case "huicao":
                var v1 =$('#cfg_huicao_account').val();
                var v2 =$('#cfg_huicao_key').val();
                if(v1==''||v2==''){
                    flag = false;
                 }
              break;
              case "bill":
                 var v1 =$('#cfg_bill_account').val();
                 var v2 =$('#cfg_bill_key').val();
                 if(v1==''||v2==''){
                     flag = false;
                 }
              break;
              case "chinabank":
               var yinlian_type=$(".yinliantype:checked").val();
                var v1 = $('#cfg_yinlian_merid').val();
                 var  v2 = $('#cfg_yinlian_mername').val();
                 var v3 = $('#cfg_yinlian_securitykey').val();

                 var v4= $("#cfg_yinlian_new_name").val();
                 var v5=$("#cfg_yinlian_new_securitykey").val();

                 if(yinlian_type==0){
                     if(v1==''||v2==''||v3=='')
                        flag = false;

                 }
                 else if(yinlian_type==1)
                 {
                     if(v4==''||v5=='')
                       flag=flase;
                 }

              break;
              case "qianbao":
                 var v1 =$('#cfg_qianbao_merchno').val();
                 var v2 =$('#cfg_qianbao_key').val();
                 if(v1==''||v2==''){
                     flag = false;
                 }
              break;
              case "paypal":
                var v1 =$('#cfg_paypal_key').val();
                var v2 =$('#cfg_paypal_currency').val();
                if(v1==''||v2==''){
                   flag = false;
                }
              break;
              case "weixinpay":
                var v1 =$('#cfg_wxpay_appid').val();

                if(v1==''){
                   flag = false;
                }
              break;
           }

           
            
           return flag;


       }


    setTimeout(function(){
        $('#pic_btn').uploadify({
            'swf': PUBLICURL + 'js/uploadify/uploadify.swf',
            'uploader': SITEURL + 'uploader/uploadnormal',
            'buttonImage' : PUBLICURL+'images/upload-ico.png',  //指定背景图
            'formData':{'dir':'thirdpay/yinlian/certs'},
            'fileTypeDesc' : 'Image Files',
            'fileTypeExts' : '*.gif; *.jpg; *.png',
            'auto': true,   //是否自动上传
            'height': 25,
            'width': 80,
            'removeTimeout':0.2,
            'removeCompleted' : true,
            'onUploadSuccess': function (file, data, response) {
                var fileinfo=$.parseJSON(data);

            }
        });
     },10);

    </script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
