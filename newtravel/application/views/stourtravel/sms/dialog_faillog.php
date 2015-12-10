<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getScript("DatePicker/WdatePicker.js"); }
    {php echo Common::getCss('base.css,sms_dialog.css'); }
</head>
<body >
   <div class="s-main">
        <div class="search-con">
            <input type="text" class="time-txt" name="querydate" id="querydate" onclick="WdatePicker({maxDate:'%y-%M-%d'})"/><span>至今天</span><a href="javascript:;" id="search_btn" class="normal-btn">查询</a>
        </div>
        <div class="s-list">
            <table class="tb-list" id="buy_list" border="1px" bordercolor="#dcdcdc" cellspacing="0px" style="border-collapse:collapse">
                <tr>
                    <th width="20%" height="40" scope="col">时间</th>
                    <th width="38%" height="40" scope="col" align="left">内容</th>
                    <th width="22" scope="col">错误原因</th>
                    <th width="10%" height="40" scope="col">手机号码</th>
                    <th width="10%" height="40" scope="col">操作状态</th>
                </tr>
            </table>
        </div>
   </div>

<script>
    $(document).ready(function(){
        $("#search_btn").click(function(){
              var date=$("#querydate").val();
              var url=SITEURL+'sms/ajax_query/querytype/faillog/querydate/'+date;

            ST.Util.showMsg('加载中',6,6000)
            $.ajax({
                type: 'GET',
                url: url ,
                dataType:'json',
                success: function(data)
                {
                    ST.Util.hideMsgBox();
                    $("#buy_list .item").remove();
                    var html='';
                    for(var i in data)
                    {
                       var row=data[i];
                       html+='<tr class="item"> <td align="center">'+row['SendTime']+'</td>'+
                            '<td class="msg-con">'+row['SendSMSContent']+'</td>'+
                            '<td class="msg-con">'+row['Memo']+'</td>'+
                            '<td align="center">'+row['SendTelNo']+'</td>'+
                            '<td align="center">'+row['SendStatus']+'</td></tr>';
                    }
                    $("#buy_list").append(html);
                }
            });
        });
    });
</script>
</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.2103&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
