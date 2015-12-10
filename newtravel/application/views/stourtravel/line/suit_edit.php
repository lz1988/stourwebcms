<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>酒店房型添加/修改</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css,base2.css'); }
    {php echo Common::getScript("uploadify/jquery.uploadify.min.js,DatePicker/WdatePicker.js,product_add.js,imageup.js,jquery.validate.js"); }
    {php echo Common::getCss('uploadify.css','js/uploadify/'); }
</head>

<body>

	<table class="content-tab">
    <tr>
    <td width="119px" class="content-lt-td"  valign="top">
     {template 'stourtravel/public/leftnav'}
    <!--右侧内容区-->
    </td>
     <td valign="top" class="content-rt-td">

          <form method="post" name="product_frm" id="product_frm" autocomplete="off">
          <div class="manage-nr">
              <div class="w-set-con">
              <div class="w-set-tit bom-arrow" id="nav">
                  <span class="on"><s></s>线路套餐</span>
                  <a href="javascript:;" class="refresh-btn" onclick="window.location.reload()">刷新</a>
              </div>
                  </div>

               <!--基础信息开始-->
              <div class="product-add-div">
              <div class="add-class">
                  <dl>
                      <dt>当前线路：</dt>
                      <dd>
                          {$lineinfo['title']}
                          <input type="hidden" name="lineid" id="lineid" value="{$lineinfo['id']}"/>
                          <input type="hidden" name="suitid" id="suitid" value="{$info['id']}">
                      </dd>
                  </dl>
                  <dl>
                      <dt>套餐名称：</dt>
                      <dd>
                          <input type="text" name="suitname" id="suitname"  class="set-text-xh text_700 mt-2" value="{$info['suitname']}" />
                      </dd>
                  </dl>
                  <dl>
                      <dt>套餐说明：</dt>
                      <dd style="height: 200px;line-height: 20px">

                          {php Common::getEditor('description',$info['description'],700,120,'Line');}
                      </dd>
                  </dl>


              </div>

              <div class="add-class">
                  <dl>
                      <dt>预订送积分：</dt>
                      <dd>
                          <input type="text" name="jifenbook" id="jifenbook" class="set-text-xh text_100 mt-2" value="{$info['jifenbook']}" />
                          <span class="fl ml-5">分</span>
                      </dd>
                  </dl>
                  <dl>
                      <dt>积分抵现金：</dt>
                      <dd>
                          <input type="text" name="jifentprice" id="jifentprice" value="{$info['jifentprice']}" class="set-text-xh text_100 mt-2 "  />
                          <span class="fl ml-5">元</span>
                      </dd>
                  </dl>
                  <dl>
                      <dt>评论送积分：</dt>
                      <dd>
                          <input type="text" name="jifencomment" id="jifencomment" class="set-text-xh text_100 mt-2" value="{$info['jifencomment']}"  />
                          <span class="fl ml-5">分</span>
                      </dd>
                  </dl>

                  <dl>
                      <dt>支付方式：</dt>
                      <dd>

                              <div class="on-off">
                                  <input type="radio" name="paytype" value="1" {if $info['paytype']=='1'}checked="checked"{/if} />全款支付 &nbsp;
                                  <input type="radio" name="paytype" value="2" {if $info['paytype']=='2'}checked="checked"{/if} />定金支付 &nbsp;
                                  <span id="dingjin" style="{if $info['paytype'] == '2'}display:inline-block{else}display: none{/if}"><input type="text"  name="dingjin" id="dingjintxt" value="{$info['dingjin']}" size="8" onkeyup="(this.v=function(){this.value=this.value.replace(/[^0-9-\.]+/,'');}).call(this)" onblur="this.v();">&nbsp;元</span>
                                  <input type="radio" name="paytype" value="3"  {if $info['paytype']=='3'}checked="checked"{/if} />二次确认支付 &nbsp;
                                  <script>
                                      $("input[name='paytype']").click(function(){
                                          if($(this).val() == 2)
                                          {
                                              $("#dingjin").show();
                                          }
                                          else
                                          {

                                              $("#dingjin").hide()
                                          }
                                      })

                                  </script>

                              </div>

                      </dd>
                  </dl>

              </div>

              <div class="add-class">
                  <dl>
                      <dt>日期范围：</dt>
                      <dd>
                          <input type="text" class="set-text-xh text_100 mt-2 choosetime" name="starttime" />
                          <span class="fl ml-5">~</span>
                          <input type="text" class="set-text-xh text_100 mt-2 ml-5 choosetime" name="endtime" />
                      </dd>
                  </dl>
                  <dl>
                      <dt>适用人群：</dt>
                      <dd class="prop-group">
                          <input type="checkbox" name="propgroup[]" value="2" id="adultgroup" checked="checked">成人
                          &nbsp;
                          <input type="checkbox" name="propgroup[]" value="1" id="childgroup">儿童
                          &nbsp;
                          <input type="checkbox" name="propgroup[]" value="3" id="oldgroup">老人
                          &nbsp;

                      </dd>
                  </dl>
                  <dl>
                      <dt>套餐价格：</dt>
                      <dd>
                        <table class="group-tb">
                         <tr class="group_2">
                          <td width="80">成人价格:</td>
                          <td>
                          <span class="fl">成本</span>
                          <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="adultbasicprice" onkeyup="calPrice(this)" value="" autocomplete="off" />
                          <span class="fl ml-10">+利润</span>
                          <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="adultprofit" onkeyup="calPrice(this)" value="" autocomplete="off" />
                          <span class="fl ml-10">售价：<b style=" color:#f60" class="tprice"></b></span>
                          </td>
                         </tr>
                         <tr class="group_1" style="display:none">
                            <td width="80">儿童价格:</td>
                            <td>
                                <span class="fl">成本</span>
                                <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="childbasicprice" onkeyup="calPrice(this)" value="{$info['childbasicprice']}"  autocomplete="off"/>
                                <span class="fl ml-10">+利润</span>
                                <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="childprofit" onkeyup="calPrice(this)" value="{$info['childprofit']}" autocomplete="off"
 />
                                <span class="fl ml-10">售价：<b style=" color:#f60" class="tprice"></b></span>
                            </td>
                           </tr>
                         <tr class="group_3" style="display:none">
                            <td width="80">老人价格:</td>
                            <td>
                                <span class="fl">成本</span>
                                <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="oldbasicprice" autocomplete="off" onkeyup="calPrice(this)" value="{$info['oldbasicprice']}" />
                                <span class="fl ml-10">+利润</span>
                                <input type="text" class="set-text-xh text_60 mt-2 ml-10" name="oldprofit" autocomplete="off" onkeyup="calPrice(this)" value="{$info['oldprofit']}" />
                                <span class="fl ml-10">售价：<b style=" color:#f60" class="tprice"></b></span>
                            </td>
                           </tr>
                        </table>
                      </dd>
                  </dl>
                  <dl>
                      <dt>价格描述：</dt>
                      <dd>
                          <input type="text" class="set-text-xh text_700 mt-2" style="width: 300px"  name="description" />
                      </dd>
                  </dl>
                  <dl>
                      <dt>单房差：</dt>
                      <dd>
                          <input type="text" class="set-text-xh text_700 mt-2" style="width: 100px"  name="roombalance" />
                      </dd>
                  </dl>
                  <dl>
                      <dt>库存：</dt>
                      <dd>
                          <input type="text" class="set-text-xh text_100 mt-2" name="number" value="-1" /> <span style="color:gray;padding-left:10px">-1表示不限</span>
                      </dd>
                  </dl>
                  <dl>
                      <dt>报价规则：</dt>
                      <dd>
                          <input type="radio" name="pricerule" class="pricerule" checked="checked" value="all"/>全部&nbsp;&nbsp;
                          <input type="radio" name="pricerule" class="pricerule" value="week"/>按星期&nbsp;&nbsp;
                          <input type="radio" name="pricerule" class="pricerule" value="month"/>按号数


                      </dd>
                  </dl>
                  <dl>
                      <dt></dt>
                      <dd style="height: auto;">
                          <table class="day_cs" id="week_cs">
                              <tr height="30px"><td ><a href="javascript:;" val='1'>周一</a></td><td val='2'><a href="javascript:;" val='2'>周二</a></td><td val='3'><a href="javascript:;" val='3'>周三</a></td><td val='4'><a href="javascript:;" val='4'>周四</a></td>
                                  <td val='5'><a href="javascript:;" val='5'>周五</a></td><td val='6'><a href="javascript:;" val='6'>周六</a></td><td val='7'><a href="javascript:;" val='7'>周日</a></td></tr>
                          </table>

                          <table class="day_cs" id="month_cs">
                              <tr><td><a href="javascript:;">1</a></td><td><a href="javascript:;">2</a></td><td><a href="javascript:;">3</a></td><td><a href="javascript:;">4</a></td><td><a href="javascript:;">5</a></td>
                                  <td><a href="javascript:;">6</a></td><td><a href="javascript:;">7</a></td><td><a href="javascript:;">8</a></td><td><a href="javascript:;">9</a></td><td><a href="javascript:;">10</a></td></tr>
                              <tr><td><a href="javascript:;">11</a></td><td><a href="javascript:;">12</a></td><td><a href="javascript:;">13</a></td><td><a href="javascript:;">14</a></td>
                              <td><a href="javascript:;">15</a></td><td><a href="javascript:;">16</a></td><td><a href="javascript:;">17</a></td><td><a href="javascript:;">18</a></td>
                              <td><a href="javascript:;">19</a></td><td><a href="javascript:;">20</a></td></tr>
                              <tr><td><a href="javascript:;">21</a></td><td><a href="javascript:;">22</a></td><td><a href="javascript:;">23</a></td><td><a href="javascript:;">24</a></td>
                              <td><a href="javascript:;">25</a></td><td><a href="javascript:;">26</a></td><td><a href="javascript:;">27</a></td><td><a href="javascript:;">28</a></td>
                              <td><a href="javascript:;">29</a></td><td><a href="javascript:;">30</a></td></tr>
                              <tr><td><a href="javascript:;">31</a></td><td colspan="9"></td></tr>
                          </table>
                      </dd>
                  </dl>


              </div>

              </div>
              <!--/基础信息结束-->



                  <div class="opn-btn" style="padding-left: 10px; " id="hidevalue">
                      <input type="hidden" name="action" id="action" value="{$action}"/>
                      <input type="hidden" name="lineid" id="lineid" value="{$lineinfo['id']}">
                      <a class="normal-btn" id="btn_save" href="javascript:;">保存</a>
                      <a class="normal-btn" id="btn_view_more" style="{if $action=='add'}display:none{/if}"   href="javascript:;" onclick="showMore()">查看报价</a>

                  </div>

          </div>
        </form>

    </td>
    </tr>
    </table>
  
	<script>

	$(document).ready(function(){

        var action = "{$action}";
        var group = "{$info['propgroup']}";
        var groupArr = group.split(',');

        if($.inArray('1',groupArr)!=-1){
            $('.group_1').show();
            $('#childgroup').attr('checked','checked');
        }
        if($.inArray('3',groupArr)!=-1){
            $('.group_3').show();
            $('#oldgroup').attr('checked','checked');
        }



        //保存
        $("#btn_save").click(function(){
                var suitname = $("#suitname").val();
                if(suitname==''){
                    ST.Util.showMsg('请输入套餐名称',5,1000);
                    return false;
                }
                Ext.Ajax.request({
                       url   :  SITEURL+"line/ajax_suitsave",
                       method  :  "POST",
                       isUpload :  true,
                       form  : "product_frm",
                       success  :  function(response, opts)
                       {
                           //console.log(response);
                           var data = response.responseText;
                           if(data!='no')
                           {
                               $("#suitid").val(data);
                               ST.Util.showMsg('保存成功!','4',2000);
                               $("#btn_view_more").show();

                           }
                       }});
        })

        //如果是修改页面


        //日历选择
        $(".choosetime").click(function(){
            WdatePicker({skin:'whyGreen',dateFmt:'yyyy-MM-dd',minDate:'%y-%M-%d'})
        })

        //隐藏报价方式
        $("#week_cs").hide();
        $(".day_cs").hide();

        $("#week_cs td a").click(function(e) {
            var v=$(this).attr('val');
            if($(this).hasClass('active'))
            {
                $("#weekval_"+v).remove();
            }
            else
            {
                $("#hidevalue").append("<input type='hidden' id='weekval_"+v+"' name='weekval[]' value='"+v+"'/>");
            }
            $(this).toggleClass('active');
        });

        $("#month_cs td a").click(function(e) {

            var v=$(this).text();
            v=$.trim(v);
            v=window.parseInt(v);
            if($(this).hasClass('active'))
            {
                $("#monthval_"+v).remove();
            }
            else
            {
                $("#hidevalue").append("<input type='hidden' id='monthval_"+v+"' name='monthval[]' value='"+v+"'/>");
            }
            $(this).toggleClass('active');
        });


        $(".pricerule").click(function(e) {
            if($(this).val()=='week')
            {
                $(".day_cs").hide();
                $("#week_cs").show();
            }
            else if($(this).val()=='month')
            {
                $(".day_cs").hide();
                $("#month_cs").show();
            }
            else
            {
                $("#week_cs").hide();
                $(".day_cs").hide();
            }
        });


        $(".prop-group input:checkbox").click(
            function(e)
            {
				$(".group-tb tr").hide();
                $(".prop-group input:checked").each(function(index, element) {
                      var gp=$(element).val();
					  $(".group_"+gp).show();
                });
            }
        );


     });

    //查看日历报价
    function showMore()
    {
        var suitid = $("#suitid").val();
        var productid = $("#lineid").val();

        var width = $(window).width()-100;
        var height = $(window).height()-100
       // var url = "calendar.php?suitid="+suitid+"&carid="+carid;
        var url = SITEURL+'calendar/index/suitid/'+suitid+'/typeid/1/productid/'+productid;
        ST.Util.showBox('查看报价',url,width,height);
       // parent.window.showJbox('查看报价',url,width,height);

    }
    //计算价格
    function calPrice(obj)
    {
        var dd=$(obj).parents('td:first');

        var tprice=0;
        dd.find('input:text').each(function(index, element) {
            var price=parseInt($(element).val());
            if(!isNaN(price))
                tprice+=price;
        });
        dd.find(".tprice").html("¥"+tprice);
    }



    </script>


</body>
</html>
