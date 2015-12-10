
<?php
   
   $style="position:fixed;{$pos}:{$posh};top:{$post};z-index:9999";
   $allqq=$dsql->getAll("select * from #@__qq_kefu where pid=0");
  // array_unshift($allqq,array('id'=>0,'groupname'=>$defaultgroupname));
   
 
  
?>

<style>
.fl{
	float:left}
.fr{
	float:right}	
body{
	width:100%;
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif}	
h1,h2,h3,h4,h5{
	font-size:14px}
a{
	color:#464646;
	text-decoration:none}
a:hover{
	color:#f60}
a,input,textarea{ outline:none; resize:none;}
input,textarea{ padding-left:3px;}
s{ text-decoration:none}
strong{ font-weight:400}
.color_f60{
	color:#f60}	
table {
	border-collapse: collapse;
	border-spacing: 0}
li{
	list-style:none}	
img{
	border:none}

.kefu_top{
	width:233px;
	height:130px}
.kefu_left{
	width:25px;
	height:66px;
	position:absolute;
	left:-30px;
	top:0;
	cursor:pointer;
	background:url(/qqkefu/tl2/images/12_left.png) left no-repeat}
.kefu_con{
	float:left;
	width:133px;
	height:auto;
	display:inline;
	margin-left:72px;
	position:relative;
	background:#f2f2f2;
	border-left:5px solid #6f9d1f;
	border-right:5px solid #6f9d1f;
	border-bottom:5px solid #6f9d1f}
.kefu_con dl{
	float:left;
	width:114px;
	margin:0 8px;}
.kefu_con dl dt{
	color:#333;
	height:30px;
	line-height:30px;
	font-weight:bold}
.kefu_con dl dd{
	float:left;
	width:110px;
	height:24px;
	line-height:24px;
	padding:5px 0 8px;
	display:inline;
	background:url(../images/kefu_bg.gif) bottom repeat-x}
.kefu_con dl dd a{
	color:#6a931e}
.kefu_con dl dd img{
	float:left;
	margin-right:10px}
.phone_num{
	float:left;
	width:133px;
	padding:10px 0;
	text-align:center}
.phone_num p{
	color:#de3a60;
	font-family:"微软雅黑";
	font-size:16px;
	font-weight:bold;}

</style>

<script type="text/javascript">
	$(document).ready(function(){
			$(".kefu_left").click(function(){
				$(".kefu_div").hide();
				$(".close").show();
				$(".close").attr("style","<?php echo $style;    ?>");
				$(".close").css("cursor","pointer");		
			});	
			$(".close").click(function(){
				$(".kefu_div").show();
				$(".close").hide();
			});	
		});
	
</script>

    <div class="close" style=" display:none; float:right; cursor:pointer"><img src="/qqkefu/tl2/images/12_close.png" /></div>  
	<div class="kefu_div" style='<?php  echo $style;  ?>'>
  	<div class="kefu_top"><img src="/qqkefu/tl2/images/12.png" /></div>
  	<div class="kefu_con">
  		<div class="kefu_left"></div>

		<?php foreach($allqq as $v){
			
			$qqarr=$dsql->getAll("select * from #@__qq_kefu where pid={$v['id']}");
			
			?>
      <dl>
      	<dt><?php echo $v['qqname'];  ?></dt>
       <?php   foreach($qqarr as $qq)  {   ?>

        <dd><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq['qqnum'];    ?>&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $qq['qqnum'];    ?>:52" alt="点击这里给我发消息" title="点击这里给我发消息"/><?php echo $qq['qqname'];    ?></a></dd>
        
		<?php } ?>
      </dl>

      <?php }  ?>
      <div class="phone_num">
      	<span><img src="/qqkefu/tl2/images/lianxidh.png" /></span>
        <p><?php  echo $phonenum;   ?></p>
      </div>
    </div>
  </div>
