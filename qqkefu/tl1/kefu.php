<?php

   require_once   dir(__FILE__).'../include/common.inc.php';

   
   
   $style="width:100px;position:fixed;{$pos}:{$posh};top:{$post};border-top: solid 1px #dadada;
overflow: hidden;text-align:center;z-index:9999";
   
    $allqq=$dsql->getAll("select * from #@__qq_kefu where pid!=0");

?>
<div style="<?php echo $style;   ?>">
<?php   foreach($allqq as $qq){    ?>
    <a style='border: solid 1px #dadada;
border-top: none;
cursor: pointer;
font-size: 12px;
font-weight: 700;
float: left;
overflow: hidden;
position: relative;
text-align: center;
text-decoration: none;
width: 92px;
z-index: 0;padding:3px' target="_blank" style="background-color:#fff" href="http://wpa.qq.com/msgrd?v=3&amp;uin=<?php echo $qq['qqnum'];   ?>&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $qq['qqnum'];    ?>:42" alt="

点击这里给我发消息" title="咨询1"></a>

<?php   } ?>
   
        <p style='background: #fafafa;
border: solid 1px #dadada;
border-top: none;
color: #06c;
font-size: 12px;
font-weight: 700;
float: left;
overflow: hidden;
padding: 5px 0;
text-align: center;
width: 98px;
'>咨询热线<br><em style='color: #f30;
font-family: Arial;
font-size: 14px;
font-weight: 700;'><?php  echo $phonenum;   ?></em></p>
</div>