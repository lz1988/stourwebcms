<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('base.css,attrid_dialog_setattrid.css'); }

</head>
<body >
   <div class="s-main">
       <div class="attr-list">
        {loop $attridList $list}
           {if !empty($list['children'])}
            <div class="con-row">
                <div class="con-tit">
                     {$list['attrname']}
                </div>
                <div class="con-list">
                    <ul>
                     {php $rowNum=6;$nextIndex=0}
                     {loop $list['children'] $key $row}
                        {if $key%$rowNum==0}
                          {php $nextIndex=$key+$rowNum-1;}
                          <li>
                        {/if}
                        <span class="item"><input type="checkbox" name="attrid" pid="{$list['id']}" pname="{$list['attrname']}" class="i-box" {if in_array($row['id'],$attrids)}checked="checked"{/if} value="{$row['id']}"/><label class="i-lb">{$row['attrname']}</label></span>
                        {if ($key==$nextIndex||$key==count($list['children'])-1) }
                         <div class="clear-both"></div></li>
                        {/if}
                     {/loop}
                     </ul>
                </div>
            </div>
           {/if}
        {/loop}
       </div>
       <div class="save-con">
           <a href="javascript:;" class="confirm-btn">确定</a>
       </div>
   </div>
<script>
     var id="{$id}";
     var selector="{$selector}"
     $(function(){

         window.setTimeout(function(){
             ST.Util.resizeDialog('.s-main');
         },0);

           $(document).on('click','.confirm-btn',function(){
                  var attrs=[];
                  var pids=[];



                  $('.item .i-box:checked').each(function(index,element){

                         var pid=$(element).attr('pid');
                         var pname=$(element).attr('pname');
                         if($.inArray(pid,pids)==-1)
                         {
                             attrs.push({id:pid,attrname:pname});
                             pids.push(pid);
                         }
                         var attrname=$(element).siblings('.i-lb:first').text();
                         var id=$(element).val();
                         attrs.push({id:id,attrname:attrname});
                  });

                 ST.Util.responseDialog({id:id,data:attrs,selector:selector},true);
           })






     })
</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201509.0102&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
