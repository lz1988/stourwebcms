<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>思途CMS4.0</title>
    {template 'stourtravel/public/public_min_js'}
    {php echo Common::getCss('base.css,destination_dialog_setdest.css'); }

</head>
<body >
   <div class="s-main">
       <div class="s-search">
            <div class="txt-wp">
                <input type="text" name="keyword" class="s-txt"/><a href="javascript:;" class="s-btn"></a>
            </div>
       </div>
       <div class="s-chosen">
            <div class="chosen-tit">已选目的地：</div>
            <div class="chosen-con">
                {loop $destList $v}
                  <span class="chosen-one" id="chosen_item_{$v['id']}" data-rel="{$v['id']}" pid="{$v['pid']}"><label class="lb-tit">{$v['kindname']}</label><a href="javascript:;" class="del">x</a></span>
                {/loop}
                <div class="clear-both"></div>
            </div>
       </div>
       <div class="s-list">
           <div class="con-one">
               <a href="javascript:;" class="all-btn">全部</a>
               <div class="clear-both"></div>
           </div>

       </div>
       <div class="save-con">
           <a href="javascript:;" class="confirm-btn">确定</a>
       </div>
   </div>
<script>
    var id="{$id}";
    var typeid="{$typeid}";
    var selector="{$selector}";
    $(function(){
         $(document).on('click','.lb-num',function(){
              var step=$(this).parents('.con-one:first').attr('step');
              var pid=$(this).attr('data-rel');
              var nextStep=parseInt(step)+1;
              getNextDests(pid,nextStep);
         })
         $(document).on('click','.con-one .all-btn',function(){
             getNextDests(0,1);
         });
        $(document).on('click','.s-search .s-btn',function(){
             var keyword=$(".s-search .s-txt").val();
             keyword= $.trim(keyword);
             getNextDests(0,1,keyword);

        })
        $(document).on('click','.s-chosen .chosen-con .chosen-one .del',function(){
             var parentEle=$(this).parents('.chosen-one:first');
             var id=parentEle.attr('data-rel');
             unchooseOne(id);

        });
        $(document).on('click','.con-one .lb-box',function(){
             var id=$(this).val();
             if($(this).is(':checked'))
             {
                 chooseOne(id);
             }
             else
             {
                 unchooseOne(id);
             }
        });
        $(document).on('click','.confirm-btn',function(){
             var dests=getSelectedDest();
             ST.Util.responseDialog({id:id,typeid:typeid,data:dests,selector:selector},true);
        });
         getNextDests(0,1);

    })

    function getNextDests(pid,step,keyword)
    {
        var url=SITEURL+'destination/ajax_getDestsetList';
        var rowNum=4;
        $.ajax({
            type: "post",
            url: url,
            dataType:'json',
            data:{pid:pid,keyword:keyword},
            success: function(data, textStatus){
                 var oldStep=parseInt(step);
                 $(".s-list .con-one").each(function(index,element){
                      var oneStep=$(element).attr('step');
                      oneStep=parseInt(oneStep);
                      if(oneStep>=oldStep)
                         $(element).remove();
                 });
                 if(typeof(data)=='object') {
                     var html = "<div class='con-one' step='" + step + "'><ul>";
                     var lastIndex=0;
                     var totalCount=data['nextlist'].length;
                     for(var i in data['nextlist'])
                     {
                         if(i%rowNum==0)
                         {
                             html+="<li>";
                             lastIndex=parseInt(rowNum)+parseInt(i)-1;
                         }
                         var row=data['nextlist'][i];
                         var num=row['childnum'];
                         var cls=num.length>1?'num-len2':'num-len1';
                         var labelCls=row['kindname'].length>5?'lb_5':'';
                         var numTag=num&&num>0?'<a class="lb-num '+cls+'" href="javascript:;" data-rel="'+row['id']+'">'+row['childnum']+'</a>':'';
                         var checkStr=isSelected(row['id'])?'checked="checked"':'';
                         html+=' <span class="dest-item" id="item_'+row['id']+'" pid="'+pid+'" ><input type="checkbox" name="dest" '+checkStr+' class="lb-box" value="'+row['id']+'"/><label class="lb-tit '+labelCls+'" >';
                         html+=row['kindname']+'</label>'+numTag+'<div class="clear-both"></div></span>';
                         if(i==lastIndex||i==totalCount-1)
                         {
                             html+="<div class='clear-both'></div></li>"
                         }

                     }
                     html+='</ul></div>';
                     $('.s-list').append(html);
                 }
                ST.Util.resizeDialog('.s-main');

            },
            error: function(){

            }
        });

    }
    function getSelectedDest()
    {
        var dests=[];
        $(".s-chosen .chosen-one").each(function(){
             var id=$(this).attr('data-rel');
             var kindname=$(this).find('.lb-tit').text();
             dests.push({id:id,kindname:kindname});
        });
       return dests;
    }
    function isSelected(id)
    {
        var dests=getSelectedDest();
        for(var i in dests)
        {
            if(dests[i]['id']==id)
              return true;
        }
        return false;
    }
    function checkUp(pid)
    {
        var item=$("#item_"+pid);
        if(item.length>0)
        {
            var ppid=item.attr('pid');
            chooseOne(pid);

        }
        return;
    }
    function chooseOne(id)
    {

        var pid=$("#item_"+id).attr('pid');
        checkUp(pid);
        var kindname=$("#item_"+id).find('.lb-tit').text();
        if($("#chosen_item_"+id).length==0) {
            var tagHtml = '<span class="chosen-one" id="chosen_item_' + id + '" data-rel="' + id + '" pid="'+pid+'"><label class="lb-tit">' + kindname + '</label><a href="javascript:;" class="del">x</a></span>';
            $(tagHtml).insertBefore('.chosen-con .clear-both');
        }
        $("#item_"+id).find('input').attr('checked',true);
        ST.Util.resizeDialog('.s-main');

    }
    function unchooseOne(id)
    {
        $("#chosen_item_"+id).remove();
        $("#item_"+id).find('input:checked').attr("checked",false);
        $(".chosen-con .chosen-one").each(function(index,element){
              var pid=$(element).attr('pid');
              var childId=$(element).attr('data-rel');
              if(pid==id)
                unchooseOne(childId);
        });
        ST.Util.resizeDialog('.s-main');
    }





</script>

</body>
</html>
<script type="text/javascript" src="http://update.souxw.com/service/api_V3.ashx?action=releasefeedback&ProductName=%E6%80%9D%E9%80%94CMS4.1&Version=4.1.201507.1501&DomainName=&ServerIP=unknown&SerialNumber=15109625" ></script>
