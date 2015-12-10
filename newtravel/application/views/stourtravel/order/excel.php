<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('base.css,order.css,jqtransform.css'); }
    {php echo Common::getScript('jquery.jqtransform.js,hdate/hdate.js');}
    {php echo Common::getCss('hdate.css','js/hdate'); }

    <script language="javascript">

    </script>
</head>

<body style="background-color: #fff">
<div class="derive_box">
    <div class="derive_con">
        <form>
            <table class="derive_tb">
                <tr>
                    <th colspan="2">选择导出时间：</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="sel_item">
                            <input type="radio"  name="time" value="1" checked="checked">
                            <label>今日</label>
                        </span>
                       <span  class="sel_item">
                            <input type="radio"  name="time" value="2">
                            <label>昨日</label>
                        </span>
                        <span  class="sel_item">
                            <input type="radio"  name="time" value="3">
                            <label>最近7天</label>
                       </span>
                       <span  class="sel_item">
                            <input type="radio"  name="time" value="5">
                            <label>最近30天</label>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td><span><input type="radio"  name="time" value="6" ><label>自定义时间段：</label></span></td>
                    <td>
                        <input type="text" value="" id="starttime" class="time_box" onclick="calendar.show({ id: this })" />
                       <span class="derive_arrow_rig"></span>
                       <input type="text" id="endtime" class="time_box" onclick="calendar.show({ id: this })" />
                   </td>
                </tr>
                <tr><th>其他：</th></tr>
                <tr><td><label>订单状态：</label><select id="orderstatus"><option value="">所有</option>
                           {loop $statusnames $key $status}
                               <option value="{$key}">{$status}</option>
                           {/loop}
                        </select></td></tr>
            </table>

            <div class="now_derive_box"><a class="derive_btn btn_excel" href="javascript:;">立即导出</a></div>
        </form>
    </div>
</div>
</body>
<script>
    var typeid = '{$typeid}';
    $(function(){
       $(".btn_excel").click(function(){
           var timetype = $("input[name='time']:checked").val();
           var status=$("#orderstatus").val();

           var starttime = endtime = 0;
           if(timetype==6){
               var starttime = $('#starttime').val();
               var endtime = $("#endtime").val();
               if(starttime==''||endtime==''){
                   ST.Util.showMsg('请选择时间段',5,1000);
                   return false;
               }
           }
           var url = SITEURL+'order/genexcel/typeid/'+typeid+'/timetype/'+timetype+'?starttime='+starttime+'&endtime='+endtime+'&status='+status;

           window.open(url);
       })

    })
</script>
</html><script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.0801&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
