<?php
 require_once dirname(dirname(__FILE__)).'./../include/common.inc.php';
 $group=$dsql->getAll("select * from #@__qq_kefu where pid=0");
?>
<style>
    *{margin:0;padding:0;list-style-type:none;}
    a,img{border:0;}
    body{font:12px/180% }


    .online_icon{overflow:hidden; }
    .online_icon a{ display: block;width: 30px;height: 107px;background: url(/qqkefu/tl3/images/qq_online_trigger.png) no-repeat;}
    .online_windows{ width:144px;}
    .online_w_top{ background:url(/qqkefu/tl3/images/online_bg.png) no-repeat -36px 0; height:10px;  _margin-bottom:-7px;}
    .online_w_c{ background:url(/qqkefu/tl3/images/online_bg.png) repeat-y 0 -185px; padding:0 5px;}
    .online_weibo{height:39px; line-height:35px; font-family:"微软雅黑";}
    .online_w_bottom{ background:url(/qqkefu/tl3/images/online_bg.png) repeat-y -36px -25px; height:39px; line-height:35px; font-family:"微软雅黑";}
    .online_content{ background:url(/qqkefu/tl3/images/online_bg.png) no-repeat -147px -185px; padding-top:11px;}
    .online_content a.qq_icon{ background:url(/qqkefu/tl3/images/online_bg.png) no-repeat -37px -130px; width:121px; height:25px; display:block; margin:0 auto; text-indent:30px; line-height:23px; cursor:pointer; }
    .online_content a.qq_icon:hover{ background-position:-159px -130px; color:#FFF;}
    .online_bar h2{ background:url(/qqkefu/tl3/images/online_bg.png) repeat-x 0 -156px; height:29px; line-height:27px; font-size:12px; color:#666; text-align:left; }
    .online_bar h2 a{ display:block; padding-left:14px; margin-left:6px; cursor:pointer;}
    .expand h2 a{ background:url(/qqkefu/tl3/images/online_bg.png) no-repeat -36px -69px;}
    .collapse h2 a{ background:url(/qqkefu/tl3/images/online_bg.png) no-repeat -36px -96px; color:#666; text-decoration:none;}
    .expand h2 a:hover,.collapse h2 a:hover{ text-decoration:none; color:#c81d04;}
    .online_content{ padding-bottom:5px; text-align:center; border-bottom:1px solid #d0d0d0;}
    .online_content ul li{ height:24px; line-height:24px; margin-bottom:4px; font-size:12px;}
    .online_content ul li a:hover{color:#c81d04; }
    #online_qq_layer { width:170px; height:455px; position:fixed; right:-140px; top:80px;z-index:9999;}
    #online_qq_tab {float:left; margin-top: 50px;}
    #onlineService {float:left; margin-left:-4px;}
    #onlineType1, #onlineType2, #onlineType3, #onlineType4, #onlineType5, #onlineType6 {display:none;}
    #onlineType1 {display:block;}

    .onlinezixun{
        padding:15px 0 8px;
        font-family:"微软雅黑";
        text-align:center;
        background:url(/qqkefu/tl3/images/point-bg.png) center top no-repeat}
    .onlinezixun h2{
        color:#1da63d;
        font-size:16px;
        font-weight:500;
        text-align:center;
        padding-left:10px;
        background:url(/qqkefu/tl3/images/telephone.png) no-repeat 25px 1px}
    .onlinezixun p{
        color:#666;
        padding-top:5px;
        font-size:14px;
        text-align:center}
    .asd{
        border-bottom:0}
    .online_w_bottom{
        text-align:center;}
    .online_w_bottom a{
        color:#333;
        display:block;
        padding-left:15px;
        text-decoration:none;
        background:url(/qqkefu/tl3/images/wb-ico.png) no-repeat 15px 5px}
</style>

<div id="online_qq_layer">
  <div id="online_qq_tab">
    <div class="online_icon"> <a href="javascript:void(0);"></a> </div>
  </div>
  <div id="onlineService">
    <div class="online_windows overz">
      <div class="online_w_top"> </div>

      <div class="online_w_c overz">
       <?php $n=1; foreach($group as $qq){ ?>
        <div class="online_bar collapse" id="onlineSort<?php echo $n; ?>">
          <h2><a onclick="childToggle('onlineType_<?php echo $n; ?>')"><?php echo $qq['qqname'] ?></a></h2>
          <div class="online_content overz" id="onlineType<?php echo $n; ?>" style="display: block;">
            <ul class="overz">

                 <?php
                   $qqarr=$dsql->getAll("select * from #@__qq_kefu where pid={$qq['id']}");
                   foreach($qqarr as $q){
                       echo '<li><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$q['qqnum'].'&site='.$GLOBALS['cfg_webname'].'&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:'.$q['qqnum'].':51" /></a></li>';
                   }
                 ?>


            </ul>
          </div>

        </div>

       <?php $n++; } ?>


        

        <?php if(!empty($GLOBALS['phonenum'])){ ?>
        <div class="onlinezixun">
          <h2>咨询电话</h2>
          <p><?php echo $GLOBALS['phonenum'] ?></p>
        </div>
        <?php } ?>

      <?php if(!empty($GLOBALS['cfg_weixin_logo'])){ ?>
        <div class="onlinezixun">
          <div class=""><img src="<?php echo $GLOBALS['cfg_weixin_logo'] ?>" width="104" /></div>
          <p style=" font-size:12px; padding-top:2px">扫描关注官方微信</p>
        </div>
      <?php } ?>

      </div>
        <div class="online_w_bottom">
      <?php if(!empty($GLOBALS['cfg_weibo_url'])){ ?>

      	<a href="<?php echo $GLOBALS['cfg_weibo_url']; ?>">关注官方微博</a></p>

      <?php } ?>
        </div>

    </div>

  </div>
</div>

<script>
    $.fn.myhoverDelay = function(fnOver, fnOut,timeIn,timeOut) {

        var timeIn = timeIn || 200,
            timeOut = timeOut || 200,
            fnOut = fnOut || fnOver;

        var inTimer = [],outTimer=[];

        return this.each(function(i) {
            $(this).mouseenter(function() {
                var that = this;
                clearTimeout(outTimer[i]);
                inTimer[i] = setTimeout(function() {
                    fnOver.apply(that);
                }, timeIn);
            }).mouseleave( function() {
                    var that = this;
                    clearTimeout(inTimer[i]);
                    outTimer[i] = setTimeout(function() {
                        fnOut.apply(that)
                    }, timeOut);
                });
        })
    }
    $(function(){
        $(".online_bar").find(".online_content").last().addClass("asd");
        $('#online_qq_layer').myhoverDelay(function(){
            $(this).animate({right:'0'},1000);
        },function(){
            $(this).animate({right:'-140px'},1000);
        });

        $(".online_bar").find('h2').click(function(){

            $(this).parents('.online_bar').first().find('.online_content').toggle();

        })
    });
</script>
<!-- 代码end -->
