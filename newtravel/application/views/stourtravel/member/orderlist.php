<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>客户订单查询</title>
    <style>
        .jl-list-table{
            float:left;
            width:980px;
            position:absolute;
            left:50%;
            margin:0 0 0 -512px}
        .jl-list-table table{
            background:#fff;
            border-left:1px solid #ddd;
            border-top:1px solid #ddd}
        .jl-list-table td,.jl-list-table th{
            color:#666;
            height:40px;
            border-right:1px solid #ddd;
            border-bottom:1px solid #ddd}
        .jl-list-table td.msg-con{
            padding-left:10px}
        .jl-list-table h3{
            float:left;
            width:1002px;
            height:40px;
            background:#fff;
            border:1px solid #ddd;
            border-bottom:0}
        .jl-list-table h3 span{
            float:left;
            height:40px;
            line-height:40px;
            font-family:"微软雅黑";

            padding-left:10px}
        .jl-list-table h3 s{
            float:right;
            color:#666;
            width:40px;
            height:40px;
            line-height:40px;
            cursor:pointer;
            text-align:center;
            font-size:16px;
            font-weight:500}
        .jl-list-box{
            float:left;
            width:980px;
            border:10px solid #fafafa}
    </style>
</head>

<body>
<div class="jl-list-table">
    <div class="jl-list-box">

        <table width="980" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th width="10%" height="40" scope="col">订单号</th>
                <th width="45%" height="40" scope="col">产品名称</th>
                <th width="10%" height="40" scope="col">申请日期</th>
                <th width="10%" height="40" scope="col">使用日期</th>
                <th width="5%" height="40" scope="col">数量</th>
                <th width="10%" height="40" scope="col">价格(成人)</th>
                <th width="10%" height="40" scope="col">订单状态</th>
            </tr>
            {loop $orderlist $data}
            <tr>
                <td align="center">{$data['ordersn']}</td>
                <td class="msg-con">{$data['productname']}</td>
                <td align="center">{php echo Common::myDate('Y-m-d H:i:s',$data['addtime']);}</td>
                <td align="center">{$data['usedate']}</td>
                <td align="center">{$data['dingnum']}</td>
                <td align="center">{$data['price']}</td>

                <td align="center">
                    {if $data['status']==0}
                         未处理
                    {/if}
                    {if $data['status']==1}
                        处理中
                    {/if}
                    {if $data['status']==2}
                       交易成功
                    {/if}
                    {if $data['status']==3}
                       取消订单
                    {/if}

                </td>
            </tr>
            {/loop}

        </table>
    </div>
</div>
</body>
</html>
