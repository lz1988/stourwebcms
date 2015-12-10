<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('base.css,friendlink_dialog_addlink.css'); }
    {php echo Common::getScript('jquery.validate.js');}

</head>
<body >
   <div class="s-main">
       <div class="content-in">
           <form id="_fm">
               <table>
                   <tr><td>网站名称：</td><td><input type="text" id="web_name" name="webname" class="set-text-xh text_250"/><label class="un-blank">*</label></td></tr>
                   <tr><td>URL地址：</td><td><input type="text" id="web_url" name="weburl" class="set-text-xh text_250"/><label class="un-blank">*</label></td></tr>
                   <tr><td>站点：</td><td><select name="webid" id="web_id"  class="set-select">
                               <option value="0">主站</option>
                               {loop $weblist $web}
                                  <option value="{$web['id']}">{$web['webname']}</option>
                               {/loop}
                           </select> </td></tr>
               </table>
           </form>
       </div>
       <div class="save-con">
           <a href="javascript:;" class="confirm-btn">确定</a>
       </div>
   </div>
<script>
     var id="{$id}"
     $(function(){

           $("#_fm").validate({
               rules:{
                   'webname':{
                       required:true
                   },
                   'weburl':{
                       required:true
                   }
               },
               messages:
               {
                   'webname':{
                       required:'必填'
                   },
                   'weburl':{
                       required:'必填'
                   }
               },
               submitHandler:function(form)
               {
                   var webname=$("#web_name").val();
                   var weburl=$("#web_url").val();
                   var webid=$("#web_id").val();
                   ST.Util.responseDialog({status:0,data:{sitename:webname,siteurl:weburl,webid:webid}},true);
               }

           });


           $(document).on('click','.confirm-btn',function(){
                  $("#_fm").submit();
           })






     })
</script>

</body>
</html>
