<?php
$configfile = 'menu_sub.'.$menu;
$sub = Common::getConfig($configfile);
foreach($sub as $row)
{
    if(strpos($row['name'],'属性') !== false)
    {
        $attclass = 'isattr';
    }
    else
    {
        $attclass = '';
    }

    $link = "<span class='kinditem ".$attclass."' data-url='".$row['url']."' data-name='".$row['name']."'><s></s>".$row['name']."</span>";
    echo $link;
}

?>
<script>
    $('.kinditem').click(function(){

        var url = $(this).attr('data-url');
        var urlname = $(this).attr('data-name');
        ST.Util.addTab(urlname,url);
    })

</script>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
