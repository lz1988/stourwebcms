<?php
$sub = Common::getConfig('menu_sub.spotticketkind');
foreach($sub as $row)
{

    $link = "<span class='kinditem' data-url='".$row['url']."' data-name='".$row['name']."'><s></s>".$row['name']."</span>";
    echo $link;
}

?>
<script>
    $(function(){
        var spotid = $("#spotid").val();
        $('.kinditem').click(function(){


            var url = $(this).attr('data-url')+'/spotid/'+spotid;
            var urlname = $(this).attr('data-name');
            ST.Util.addTab(urlname,url);
        })
    })


</script>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
