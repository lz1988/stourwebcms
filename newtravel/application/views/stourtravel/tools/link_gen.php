<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS3.0</title>
    {template 'stourtravel/public/public_js'}
    {php echo Common::getCss('style.css,base.css'); }
    {php echo Common::getScript("jquery.processbar.js"); }


</head>
<body style="background-color: #fff">
   <form id="frm" name="frm">
    <div class="out-box-con">
        <dl class="list_dl">
            <dt class="wid_90">栏目：</dt>
            <dd>
                <select name="channel" id="channel" class="bd_style wid_100" onchange="getLastTime(this.value)">

                    <option value="1" >线路</option>
                    <option value="2" >酒店</option>
                    <option value="3" >租车</option>
                    <option value="4" >文章</option>
                    <option value="5" >景点</option>
                    <option value="6" >相册</option>
                    <option value="8" >签证</option>
                    <option value="13" >团购</option>
                </select>
                <span id="lasttime" style="color: red"></span>
            </dd>
        </dl>
        <dl class="list_dl">
            <dt class="wid_90">类型：</dt>
            <dd>
                <select name="type" id="type" class="bd_style wid_100">
                    <option value="0"  selected="selected">全部生成</option>
                    <option value="1" >仅生成主目标词链接</option>
                    <option value="2" >仅生成目标性关键词链接</option>
                    <option value="3" >仅生成营销性关键词链接</option>
                </select>

            </dd>
        </dl>
        <dl class="list_dl" id="progressbar" style="display:none">
            <dt class="wid_90">状态：</dt>
            <dd>
                <span id="status">生成中,请不要离开此页面..</span><div id="progress" style="float:left"> </div>

            </dd>
        </dl>

        <dl class="list_dl">
            <dt class="wid_90">&nbsp;</dt>
            <dd>
                <a class="normal-btn" id="genbtn" href="javascript:;">生成</a>

            </dd>
        </dl>
    </div>
   </form>

   <script language="javascript">
       var total = 0;//全部数量
       var hasdo = 0;//已经完成数量
       var num = new Array();
       $(function(){
           $("#progress").progressBar({
               boxImage: '{$GLOBALS['cfg_public_url']}images/progressbar.gif',
               height:11,
               step:2,
               barImage: '{$GLOBALS['cfg_public_url']}images/progressbg_green.gif'});

           $("#genbtn").click(function(){
               total = hasdo = 0;
               var channel = ''; //要生成的智能链接的栏目
               var keywordtype = $("#type").val();//生成的类型
               channel = $("#channel").val();
               if(channel == 0)
               {
                   ST.Util.showMsg('请选择要生成智能链接的栏目',1,1000);
                   return;
               }
               $.ajax({
                   type:"post",
                   data:"channel="+channel,
                   dataType:'json',
                   url:SITEURL+"toollink/gettotal",
                   beforeSend:function(){
                       beginGen();
                       $("#progress").progressBar(0);

                   },
                   success:function(data){
                       total = 0;
                       total = data.total;
                       //console.log("total:"+total);
                       mutiDo(channel,keywordtype,0);//分段执行


                   }

               })





           })


       })

       //获取上次生成日期
       function getLastTime(channel)
       {
           $.ajax({
               type:"post",
               data:"channel="+channel,
               url: SITEURL+"toollink/getlasttime",
               dataType:"json",
               success:function(data){

                   if(data.lasttime!=null){
                       $("#lasttime").html('上次生成日期:'+data.lasttime);
                   }
                   else{
                       $("#lasttime").html('');
                   }
               }
           })
       }
       //写本次生成日期
       function writeTime(channel)
       {
           var data = {'channel':channel};
           $.post(SITEURL+'toollink/writetime',data,function(){},'post');
       }

       //获取生成链接的个数
       function get_gen_num(channel,type)
       {
           var params ={'channel':channel,'type':type};
           $.ajax({
               type:"post",
               data:params,
               url:SITEURL+"toollink/get_gen_num",
               dataType:"json",
               success:function(data){
                   $("#status").html('智能链接生成成功,本次共生成'+data.num+'个关键词链接!');

               }
           })
           /* $.post('link_info.php?dopost=get_gen_num',params,function(data){

            //console.log(data);


            },'post');*/
       }

       //分段执行
       function mutiDo(channel,keywordtype,offset)
       {
           $.ajax({
               type: "post",
               data:"channel="+channel+"&keywordtype="+keywordtype+"&offset="+offset,
               url: SITEURL+'toollink/mutido/',
               dataType:'json',

               success:function(data){
                   hasdo = hasdo + parseInt(data.offset);

                   $("#status").html('生成中,请不要离开此页面!');
                   if(data.offset)
                   {

                       var percent = Math.round( (hasdo / total) *100);
                       percent = percent > 100 ? 100 : percent
                       $("#progress").progressBar(percent);
                       if(percent == 100 )
                       {
                           get_gen_num(channel,keywordtype);
                           $("#genbtn").attr("disable","false");
                           $("#genbtn").css("color","white");
                           writeTime(channel);//写生成日期


                       }
                       else
                       {

                           mutiDo(channel,keywordtype,hasdo);

                       }


                   }
               }

           });

       }



       //进度条开始
       function beginGen()
       {


           $("#status").html('生成中,请不要离开此页面..');
           $("#progressbar").show();
           $("#genbtn").attr("disable","false");
           $("#genbtn").css("color","gray");
           $("#progress").progressBar(0);
           var j = 0;

       }
   </script>

</body>
</html>