<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>团购列表-{$webname}</title>
 {php echo Common::getScript('jquery-min.js,st_m.js'); }
 {php echo Common::getCss('m_base.css,style.css'); }

</head>

<body>
  {template 'public/top'}
  <div class="city_top clearfix">
  	<a class="back" href="{$cmsurl}">返回</a>
    <a class="city_tit" href="javascript:;">{$kindname}-团购</a>
  </div>
  
  <div class="m-main">
		<section class="main-xl">
			<div class="change-type">
		  	<div class="posfex">
        	<ul id="des_w">
						<li id="des"><a href="javascript:;" >{$kindname}</a></li>
						<li class="no-line" id="des-by"><a href="javascript:;">{$attrname}</a></li>
					</ul>
        </div>

				<!--下拉列表-->
        <div id="des_con">
          <div class="change-type-c" id="des-c">

            <p ><a href="{$cmsurl}tuan/list/kindid/0/attrid/{$attrid}/order/{$order}">不限</a></p>
             {loop $kindlist $row}
              <p {if $row['id']==$kindid}class="on"{/if}><a href="{$cmsurl}tuan/list/kindid/{$row['id']}/attrid/{$attrid}/order/{$order}">{$row['kindname']}</a></p>
             {/loop}

          </div>
		 <div class="change-type-c" id="des-by-c">
            <p><a href="{$cmsurl}tuan/list/kindid/{$kindid}/attrid/0">不限</a></p>
            {loop $attrlist $row}
            <p {if $row['id']==$attrid}class="on"{/if}><a href="{$cmsurl}tuan/list/kindid/{$kindid}/attrid/{$row['id']}/order/{$order}">{$row['attrname']}</a></p>
            {/loop}

		</div>
        </div>
        
        <div class="df_px">
        	<span class="sp_1">默认排序</span>
          <span class="sp_2">
          	<em>价格</em>
            <a class="up" href="{$cmsurl}tuan/list/kindid/{$kindid}/attrid/0/order/asc"></a>
            <a class="down" href="{$cmsurl}tuan/list/kindid/{$kindid}/attrid/{$attrid}/order/desc"></a>
          </span>
        </div>
        
        <div class="fex">
            {loop $list $row}
                <div class="tuan_list">
                <a href="{$cmsurl}tuan/show/id/{$row['id']}">
                    <div class="tuan_img"><img src="{$row['litpic']}" width="100%" /></div>
                  <div class="tuan_con">
                    <div class="tuan_txt">
                        <h3>{$row['title']}</h3>
                      <p>{$row['sellpoint']}</p>
                    </div>
                    <div class="price">
                        <span class="sp_1">抢购价</span>
                        <span class="sp_2"><em>&yen;</em>{$row['price']}</span>
                    </div>
                  </div>
                </a>
               </div>
            {/loop}
        </div>
			   <div class="load_more"><img src="{$publicurl}/images/loading.gif" />正在载入中</div>
			   <a href="javascript:void();" class="load-more"  data-page="1"/>点击载入更多<a>

			</div>
		</section>
	</div>
  <input type="hidden" name="kindid" id="kindid" value="{$kindid}" />
  <input type="hidden" name="attrid" id="attrid" value="{$attrid}" />
  <input type="hidden" name="order" id="order" value="{$order}" />
  
{template 'public/foot'}
</body>
<script type="text/javascript">
    $('.load-more').click(function(){
        var docRec = $(this);
        var page = parseInt(docRec.attr('data-page'))+1;
        var kindid = $('#kindid').val();
        var attrid = $('#attrid').val();
        var order = $('#order').val();
        order = order ? order : 0;

        var url=SITEURL+'tuan/list/kindid/'+kindid+"/attrid/"+attrid+"/order/"+order+"/page/"+page+"/action/ajax";
        $.ajax({
            type:'POST',
            url:url,
            dataType:'json',
            success:function(data){
                var str = '';
                var listnum = 0;
                console.log(data);
                $.each(data,function(index,a){

                   str+='<div class="tuan_list">';
                   str+=' <a href="'+SITEURL+'tuan/show/id/'+ a.id+'">';
                   str+='  <div class="tuan_img"><img src="'+ a.litpic+'" width="100%" /></div>';
                   str+=' <div class="tuan_con">';
                   str+=    '<div class="tuan_txt">';
                   str+='     <h3>'+ a.title+'</h3>';
                   str+='     <p>'+ a.sellpoint+'</p>';
                   str+=' </div>';
                   str+=' <div class="price">';
                   str+='     <span class="sp_1">抢购价</span>';
                   str+=' <span class="sp_2"><em>&yen;</em>'+ a.price+'</span>';
                   str+=' </div>';
                   str+=' </div>';
                   str+=' </a>';
                   str+=' </div>';

                    listnum++;
                })
                docRec.attr('page',page);
                if(listnum==0){
                    docRec.html('已无更多团购信息');
                }
                $('.fex').append(str);
            }

        })

    });
</script>
</html>
