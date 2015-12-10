<!doctype html>
<html>
<head>

    <meta charset="utf-8">
<title>保险订单添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css,insurance.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,product_add.js,imageup.js,DatePicker/WdatePicker.js,st_validate.js,jquery.validate.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }

    <style>
        .tourer-container .tourer-tb
        {
            display:inline-table;
            float:left;
            margin-right: 20px;
            margin-bottom: 10px;
            line-height: 25px;
        }
        .tourer-container{
            padding:10px;
        }
        .tourer-nav{
            padding:10px;
        }
        .tourer-cpy,.tourer-del{
            color:green;
        }
        .no-blk{
            color:red;
        }





    </style>
</head>

<body>
	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td ">

          <form method="post" name="product_frm" id="product_frm">
          <div class="manage-nr">
              <div class="w-set-tit bom-arrow" id="nav">
                  <span class="on"><s></s>基础信息</span>
                  <span data-id="insured"><s></s>被保人列表</span>
                  <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
              </div>

               <!--基础信息开始-->
                  <div class="product-add-div">
                      <div class="add-class">

                          <dl>
                              <dt style="width: 120px">保险名称：</dt>
                              <dd>
                                  {$info['productname']}
                                  <input type="hidden" name="productcasecode" value="{$info['productcode']}"/>
                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">起保时间：</dt>
                              <dd>
                                  <input type="text" name="begindate" id="begindate" onclick="WdatePicker({minDate:'%y-%M-{%d+1}'})" class="set-text-xh text_150 mt-2 " value="{$info['begindate']}" /><label class="no-blk">*</label>
                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">终保时间：</dt>
                              <dd>
                                  <input type="text" name="enddate" id="enddate" onclick="WdatePicker({minDate:'#F{$dp.$D(\'begindate\')}'})" class="set-text-xh text_150 mt-2 " value="{$info['enddate']}" /><label class="no-blk">*</label>
                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">出行目的地：</dt>
                              <dd>
                                  <input type="text" name="destination" id="destination" class="set-text-xh text_150 mt-2 w300" value="{$info['destination']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt  style="width: 120px">出行目的地代码：</dt>
                              <dd>
                                  <input type="text" name="trippurposeid" id="trippurposeid" class="set-text-xh text_250 mt-2 w300" value="{$info['trippurposeid']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">签证办理城市：</dt>
                              <dd>
                                  <input type="text" name="visacity" id="visacity" class="set-text-xh text_250 mt-2 w300" value="{$info['visacity']}" />
                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">结算价：</dt>
                              <dd>
                                  <input type="text" name="singleprice" id="singleprice" class="set-text-xh text_250 mt-2 w300" value="{$info['price']}" /><label class="no-blk">*</label>
                              </dd>
                          </dl>
                          {if !empty($info['bookordersn'])}
                          <dl>
                              <dt  style="width: 120px">客户支付价格：</dt>
                              <dd>{$info['payprice']}</dd>
                          </dl>
                          {/if}
                          <dl>
                              <dt style="width: 120px">被保人数量：</dt>
                              <dd>{$info['insurednum']}</dd>
                          </dl>

                        {if !empty($info['bookordersn'])}
                          <dl>
                              <dt style="width: 120px">会员账号：</dt>
                              <dd>
                                  {$info['memberaccount']}

                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">所属线路订单：</dt>
                              <dd>
                                  {$info['bookordersn']}
                              </dd>
                          </dl>
                          <dl>
                              <dt style="width: 120px">所属线路名称：</dt>
                              <dd>
                                  {$info['linetitle']}
                              </dd>
                          </dl>


                        {/if}

                      </div>
                  </div>

              <!--/基础信息结束-->
              <div class="product-add-div" data-id="insured">
                  <div class="add-class">
                      <div class="tourer-nav"><span>当前人数:&nbsp;<label id="tourer_num">0</label>人</span> &nbsp;&nbsp;&nbsp;<span><a href="javascript:;"  class="tourer-add">添加</a> </span></div>
                      <div class="tourer-container">
                          {loop $tourers $tourer}
                          <div class="wrp">
                          <table class="n-tb">
                              <tr><td class="tit">姓名：</td><td class="con-td"> <input type="text" class="txt" name="tourer[name][]" value="{$tourer['name']}"/><input type="hidden" class="tourer-id" name="tourer[id][]" value="{$tourer['id']}" /><label class="no-blk">*</label></td>
                                  <td class="tit">姓名拼音：</td><td class="con-td"><input type="text" name="tourer[pinyin][]" value="{$tourer['pinyin']}" class="txt"/></td></tr>
                              <tr><td class="tit">证件类型：</td><td class="con-td"><select name="tourer[cardtype][]" class="txt">;
                                          <option value="1" {if $tourer['cardtype']==1}selected="selected"{/if}>身份证</option>
                                          <option value="2" {if $tourer['cardtype']==2}selected="selected"{/if}>军官证</option>
                                          <option value="3" {if $tourer['cardtype']==3}selected="selected"{/if}>护照</option>
                                          <option value="4" {if $tourer['cardtype']==4}selected="selected"{/if}>港澳通行证</option>
                                          <option value="5" {if $tourer['cardtype']==5}selected="selected"{/if}>驾照</option>
                                          <option value="7" {if $tourer['cardtype']==7}selected="selected"{/if}>台胞证</option>
                                          <option value="8" {if $tourer['cardtype']==8}selected="selected"{/if}>出生证</option>
                                          <option value="99" {if $tourer['cardtype']==99}selected="selected"{/if}>其他</option>
                                      </select><label class="no-blk">*</label>
                                </td><td class="tit">证件号：</td><td class="con-td"><input type="text" name="tourer[cardcode][]" class="txt" value="{$tourer['cardcode']}" /><label class="no-blk">*</label></td></tr>
                              <tr>
                                  <td class="tit">性别：</td><td class="con-td"><select name="tourer[sex][]" class="txt"><option value="1" {if $tourer['sex']==1}selected="selected"{/if}>男</option><option value="0" {if $tourer['sex']==0}selected="selected"{/if}>女</option></select><label class="no-blk">*</label></td>
                                  <td class="tit">移动电话：</td><td class="con-td"><input type="text" name="tourer[mobile][]" value="{$tourer['mobile']}" class="txt"/></td>
                              </tr>
                              <tr>
                                  <td class="tit">出生日期：</td><td class="con-td"><input type="text" name="tourer[birthday][]" onclick="WdatePicker()" value="{$tourer['birthday']}" class="txt"/><label class="no-blk">*</label></td>
                                  <td class="tit">航班号：</td><td class="con-td"><input type="text" name="tourer[fltno][]" value="{$tourer['fltno']}" class="txt"></td>
                              </tr>
                              <tr><td class="tit">职业名称：</td><td class="con-td"><input type="text" name="tourer[job][]" value="{$tourer['job']}" class="txt"/></td>
							  <td class="tit">职业等级：</td><td class="con-td"><input type="text" name="tourer[joblevel][]" value="{$tourer['joblevel']}" class="txt"></td></tr>
                              <tr><td class="tit">职业代码：</td><td class="con-td"><input type="text" name="tourer[jobcode][]" value="{$tourer['jobcode']}" class="txt"/></td>
                                  <td class="tit">所在地区：</td><td class="con-td"><input type="text" name="tourer[city][]" value="{$tourer['city']}" class="txt"/></td>
                              </tr>
                              <tr><td class="tit">与投保人关系：</td><td colspan="3"><select name="tourer[insurantrelation][]">
                                          <option value="1" {if $tourer['insurantrelation']==1}selected="selected"{/if}>本人</option>
                                          <option value="2" {if $tourer['insurantrelation']==2}selected="selected"{/if}>配偶</option>
                                          <option value="3" {if $tourer['insurantrelation']==3}selected="selected"{/if}>子女</option>
                                          <option value="4" {if $tourer['insurantrelation']==4}selected="selected"{/if}>空</option>
                                          <option value="5" {if $tourer['insurantrelation']==5}selected="selected"{/if}>父母</option>
                                          <option value="6" {if $tourer['insurantrelation']==6}selected="selected"{/if}>其他</option>
                                      </select><label class="no-blk">*</label></td></tr>
                              <tr>
                                  <td class="tit">购买份数：</td><td class="con-td"><select name="tourer[count][]" >
                                          <option value="0" {if $tourer['count']==0}selected="selected"{/if}>0</option>
                                          <option value="1" {if $tourer['count']==1}selected="selected"{/if}>1</option>
                                          <option value="2" {if $tourer['count']==2}selected="selected"{/if}>2</option>
                                          <option value="3" {if $tourer['count']==3}selected="selected"{/if}>3</option>
                                          <option value="4" {if $tourer['count']==4}selected="selected"{/if}>4</option>
                                      </select><label class="no-blk">*</label>
                                  </td><td colspan="2" class="btn-td"><a href="javascript:;" class="cp tourer-cpy">复制</a> <a href="javascript:;" class="del tourer-del">删除</a></td></tr>
                          </table>
                          </div>

                         {/loop}

                      </div>
                  </div>
              </div>
              <div class="opn-btn">
                      <input type="hidden" name="productid" id="productid" value="{$info['id']}"/>
                      <a class="normal-btn ml-20" id="btn_save" href="javascript:;">保存</a>
                     <a class="normal-btn ml-20" id="btn_gopay" href="javascript:;">支付</a>
                  <a  href="" target="_blank" id="pay_url" style="color:black;display: none">支付页面</a>

              </div>

          </div>
        </form>
    </td>
    </tr>
    </table>

	<script>

        $(document).ready(function() {

            $("#nav").find('span').click(function () {

                Product.changeTab(this, '.product-add-div');//导航切换
            })
            $("#nav").find('span').first().trigger('click');
            $(document).on('click','.tourer-cpy', function (){
                copyTourer(this);
            });
            $(document).on('click','.tourer-del',function()
            {
                var pEle=$(this).parents('.wrp:first');
                var id=pEle.find('.tourer-id').val();
                delTourer(id,pEle);
            });
            $("#btn_gopay").click(function() {
                var id = $("#productid").val();
                if (!id) {
                    ST.Util.showMsg('请先保存', '5', 1000);
                    return;
                }
                var len=$(".wrp").length;
                if(len==0)
                {
                    ST.Util.showMsg('被保人数量不能为0',5);
                    return;
                }

                ST.Util.confirmBox('提示', '确认是否已经保存更改？', function () {
                    ST.Util.showMsg('提交订单中', 6, 7000);
                    var url = SITEURL + "insurance/ajax_trypay/id/" + id;
                    var payUrl = '';
                    $.ajax({
                        type: 'POST',
                        url: url,


                        dataType: 'json',
                        success: function (data) {
                            ST.Util.hideMsgBox();
                            if (!data.status) {
                                ST.Util.showMsg(data.msg, 5, 2000);
                            }
                            else {
                                var price = $("#singleprice").val();


                                ST.Util.messagBox('支付', '<table style="width: 200px"><tr height="50px"><td align="center">你需支付金额：<label style="color:#EC6000">' + price + '元</label></td></tr><tr height="50px"><td align="center"><a class="save ml-20" href="' + data['payUrl'] + '" target="_blank" style="color:green; background: #008ed8;color:#fff;padding:4px 14px;fond-size:11px">立即支付</a><td></tr></table>')
                                //payUrl=data['payUrl'];


                            }
                        }
                    });
                });


                });


            $(".tourer-add").click(function(){
                addTourer()
            });
            showNum();

            //验证表单
            $("#product_frm").validate({
                    rules: {
                        begindate: {
                            required: true
                        },
                        enddate: {
                            required: true
                        },
                        singleprice:"required",
                        'tourer[name][]':"required",
                        'tourer[cardcode][]':"required",
                        'tourer[birthday][]':"required",
                        'tourer[count][]':{required:true,digits:true}

                    },
                    messages: {
                        begindate:{
                            required:''
                        },
                        enddate:{
                            required:''
                        },
                        singleprice:{
                            required:''
                        },
                        'tourer[name][]':"",
                        'tourer[cardcode][]':"",
                        'tourer[birthday][]':"",
                        'tourer[count][]':{required:"",digits:''}



                    },
                    submitHandler: function (form) {

                        Ext.Ajax.request({
                            url: SITEURL + "insurance/ajax_booking_save",
                            method: "POST",
                            isUpload: true,
                            form: "product_frm",
                            datatype: "JSON",
                            success: function (response, opts) {

                                var data = $.parseJSON(response.responseText);
                                if (data.status) {
                                    if (data.productid != null) {
                                        $("#productid").val(data.productid);
                                    }
                                    ST.Util.showMsg('保存成功!', 4, 2000);
                                }
                                else {
                                    ST.Util.showMsg('保存失败', 5, 2000);
                                }
                            }
                        });
                        return false;//阻止常规提交
                    }
                });
            $("#btn_save").click(function() {
                $("#product_frm").submit();
            });




        });



        function geneTourerId(callback)
        {
            var url=SITEURL+"insurance/ajax_gene_tourerid";
            $.ajax({
                type: 'POST',
                url: url,
                dataType: 'json',
                success:function(data)
                {
                    if(data.status)
                    {
                        callback(data.id);
                    }
                    else
                        ST.Util.showMsg(data.msg,5)

                }
            });
        }
        function copyTourer(btn)
        {
            var pele= $(btn).parents(".wrp:first");
            var dataArr=[];
            pele.find("input,select").each(function(index,ele){
                dataArr.push($(ele).val());

            });
            addTourer(dataArr);



        }
        function addTourer(dataArr)
        {
         var html='<div class="wrp"><table class="n-tb">';
         html+='<tr><td class="tit">姓名：</td><td class="con-td"> <input type="text" class="txt" name="tourer[name][]" value=""/><input type="hidden" class="tourer-id" name="tourer[id][]" value="" /><label class="no-blk">*</label></td>';
         html+='<td class="tit">姓名拼音：</td><td class="con-td"><input type="text" name="tourer[pinyin][]" value="" class="txt"/></td></tr>';
         html+='<tr><td class="tit">证件类型：</td><td class="con-td"><select name="tourer[cardtype][]" class="txt">';
         html+='<option value="1">身份证</option>';
         html+='<option value="2">军官证</option>';
         html+='<option value="3">护照</option>';
         html+='<option value="4">港澳通行证</option>';
         html+='<option value="5">驾照</option>';
         html+='<option value="7">台胞证</option>';
         html+='<option value="8">出生证</option>';
         html+='<option value="99" >其他</option>';
         html+='</select><label class="no-blk">*</label>';
         html+='</td><td class="tit">证件号：</td><td class="con-td"><input type="text" name="tourer[cardcode][]" class="txt" value="" /><label class="no-blk">*</label></td></tr>';
         html+='<tr><td class="tit">性别：</td><td class="con-td"><select name="tourer[sex][]" class="txt"><option value="1" >男</option><option value="0" >女</option></select><label class="no-blk">*</label></td>';
         html+='<td class="tit">移动电话：</td><td class="con-td"><input type="text" name="tourer[mobile][]" value="" class="txt"/></td></tr>';
         html+='<tr><td class="tit">出生日期：</td><td class="con-td"><input type="text" name="tourer[birthday][]" onclick="WdatePicker()"  class="txt"/><label class="no-blk">*</label></td>';
         html+='<td class="tit">航班号：</td><td class="con-td"><input type="text" name="tourer[fltno][]" value="" class="txt"></td></tr>';
         html+='<tr><td class="tit">职业名称：</td><td class="con-td"><input type="text" name="tourer[job][]"  class="txt"/></td>' ;
         html+='<td class="tit">职业等级：</td><td class="con-td"><input type="text" name="tourer[joblevel][]" class="txt"></td></tr>';
         html+='<tr><td class="tit">职业代码：</td><td class="con-td"><input type="text" name="tourer[jobcode][]" class="txt"/></td> ' +
         '<td class="tit">所在地区：</td><td class="con-td"><input type="text" name="tourer[city][]"  class="txt"/></td></tr>';
         html+='<tr><td class="tit">与投保人关系：</td><td colspan="3"><select name="tourer[insurantrelation][]">';
         html+='<option value="1" >本人</option>';
         html+='<option value="2">配偶</option>';
         html+='<option value="3">子女</option>';
         html+='<option value="4">空</option>'
         html+='<option value="5">父母</option>';
         html+='<option value="6" selected="selected">其他</option>';
         html+='</select><label class="no-blk">*</label></td></tr>';
         html+='<tr> <td class="tit">购买份数：</td><td class="con-td"><select name="tourer[count][]" > <option value="0">0</option> <option value="1" selected="selected">1</option> ';
         html+='<option value="2">2</option> <option value="3">3</option><option value="4">4</option>';
         html+='</select><label class="no-blk">*</label>';
         html+='</td><td colspan="2" class="btn-td"><a href="javascript:;" class="cp tourer-cpy">复制</a> <a href="javascript:;" class="del tourer-del">删除</a></td></tr> </table> </div>';

            var newEle=$(html);
            geneTourerId(function(id){
                $(".tourer-container").append(newEle);
                if(dataArr)
                {
                    newEle.find("input,select").each(function(index,ele){
                        $(ele).val(dataArr[index]);
                    });


                }
                newEle.find(".tourer-id").val(id);
                showNum();

            });
        }
        function delTourer(id,pEle)
        {
            ST.Util.confirmBox('提示','确认删除？',function(){
                var url=SITEURL+"insurance/ajax_del_tourerid";
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    data:{id:id},
                    success:function(data)
                    {
                        if(data.status)
                        {
                            pEle.remove();
                        }
                        else
                            ST.Util.showMsg(data.msg,5);
                        showNum();
                    }
                });

            });

        }
        function showNum()
        {
            $("#tourer_num").text($(".wrp").length);
        }
    </script>

</body>
</html>
