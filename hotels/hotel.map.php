<?php

require_once(dirname(__FILE__)."/../include/common.inc.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>酒店地图</title>
<script type="text/javascript" src="/templets/smore/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script> 
<script type="text/javascript" src="/templets/smore/js/map/ul.map.js"></script>
</head>
<body> 
</div>

<!--默认提示-->

    <div id="divWaiting" style="position:absolute;z-index:999;top:125px;left:369px;">

    <img src="http://img.17u.cn/hotel/images/www_17u_cn/wait.gif" ></img>

    </div>   

    <div id="myMap" style="width:950px;height:250px;"></div>

    <script type="text/javascript">
       map.initMap('<?php echo $hotelname; ?>','<?php echo $address; ?>');
       
    </script>


</body>

</html>

