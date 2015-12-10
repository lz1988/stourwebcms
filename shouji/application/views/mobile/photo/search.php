<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>相册列表-{$webname}</title>
  {php echo Common::getCss('m_base.css,style.css'); }
  {php echo Common::getScript('jquery-min.js,st_m.js'); }
</head>
<body>
{template 'public/top'}
<div class="city_top clearfix">
    <a class="back" href="{$cmsurl}">返回</a>
    <a class="city_tit" href="javascript:;">{$kindname}-相册</a>
</div>
  
  <div class="m-main">
  	<div class="change-type">
      <div class="posfex">
        <ul id="des_w">
            <li id="des"><a href="javascript:;" >{$kindname}</a></li>
            <li class="no-line" id="des-by"><a href="javascript:;">{$attrname}</a></li>
        </ul>
      </div>
      
      <div id="des_con">
        <div class="change-type-c" id="des-c">
          <p><a href="{$cmsurl}photo/list/kindid/0/attrid/{$attrid}">不限</a></p>
            {loop $kindlist $row}
            <p {if $row['id']==$kindid}class="on"{/if}><a href="{$cmsurl}photo/list/kindid/{$row['id']}/attrid/{$attrid}">{$row['kindname']}</a></p>
            {/loop}
        </div>
        <div class="change-type-c" id="des-by-c">
          <p class="on"><a href="{$cmsurl}photo/list/kindid/{$kindid}/attrid/0">不限</a></p>
            {loop $attrlist $row}
            <p {if $row['id']==$attrid}class="on"{/if}><a href="{$cmsurl}photo/list/kindid/{$kindid}/attrid/{$row['id']}/order/{$order}">{$row['attrname']}</a></p>
            {/loop}
        </div>
      </div>
    </div>
		<div class="photo-box" id="photo_list" >

            <ul class="case-list">
               {loop $list  $row}
                 <li>
                     <a href="{$cmsurl}photo/show/id/{$row['id']}">
                         <img src="{$row['litpic']}" />
                         <p>{$row['title']}</p>
                     </a>
                 </li>
               {/loop}
              </ul>

    </div>
	</div>

<a href="javascript:;" class="load-more" data-page="1">点击载入更多</a>
  {template 'public/foot'}

    <input type="hidden" id="kindid" value="{$kindid}">
    <input type="hidden" id="attrid" value="{$attrid}">

</body>
<script type="text/javascript">



   

    $(function(){


        $('.load-more').click(function(){
            var page = parseInt($(this).attr('data-page'))+1;
            var kindid = $('#kindid').val();
            var attrid = $('#attrid').val();
            var url=SITEURL+'photo/list/kindid/'+kindid+"/attrid/"+attrid+"/page/"+page+"/action/ajax";
            $.ajax({
                type:'POST',
                data:"page="+page,
                url:url,
                dataType:'json',
                success:function(data){

                    var html = '';
                    var listnum = 0;
                    $.each(data,function(index,row){


                        html+='   <li class="case-list">';
                        html+='    <a href="'+SITEURL+'photo/show/id/'+row.id+'">';
                        html+='    <img src="'+row.litpic+'" alt="" />';
                        html+='    <p>'+row.title+'</p>';
                        html+='    </a>';
                        html+='</li>';
                        listnum++;

                    })
                    if(listnum>0){
                        $(".load-more").attr('data-page',page);
                        $(".case-list").append(html);


                    }

                }

            })

         });

        });
		







</script>
</html>