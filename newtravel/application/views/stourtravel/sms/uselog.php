<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>短信使用查询</title>
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
            font-size:18px;
            font-weight:500;
            padding-left:10px}
        .jl-list-table h3 s{
            float:right;
            color:#666;
            width:40px;
            height:40px;
            line-height:40px;
            cursor:pointer;
            text-align:center;
            font-size:20px;
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
                <th width="20%" height="40" scope="col">时间</th>
                <th width="60%" height="40" scope="col" align="left">内容</th>
                <th width="10%" height="40" scope="col">手机号码</th>
                <th width="10%" height="40" scope="col">操作状态</th>
            </tr>
            {loop $datalist $data}
            <tr>
                <td align="center">{$data['SendTime']}</td>
                <td class="msg-con">{$data['SendSMSContent']}</td>
                <td align="center">{$data['SendTelNo']}</td>
                <td align="center">{$data['SendStatus']}</td>
            </tr>
            {/loop}

        </table>
    </div>
</div>
</body>
</html>
