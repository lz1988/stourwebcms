<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>评论列表-{$webname}</title>
    {php echo Common::getScript('jquery-min.js'); }
    {php echo Common::getCss('m_base.css,style.css'); }
</head>

<body class="bg_f0f">
  {template 'public/top'}
	<div class="city_top clearfix">
  	<a class="back" href="javascript:window.history.back(-1)">返回</a>
    <a class="city_tit" href="javascript:;">点评记录</a>
  </div>
  
  <div class="m-main">
  	<div class="kh_dp">
    	<ul>
      	<li><img src="{$publicurl}images/kh-dp-bg.png" width="50" /></li>
        <li>
        	<span>{$tuan['score']}</span><em>满意度</em>
        </li>
        <li>
        	<span>{$tuan['commentnum']}</span><em>人点评</em>
        </li>
      </ul>
    </div>
    <div class="dp_box">
    	<h3>客户点评</h3>
        <div id="pl_list">
       {loop $pinlunlist $row}
        <dl>
      	<dt>
        	<span class="name"><img class="fl" src="{$row['memberico']}" width="30" height="30" /><em class="fl">{$row['membername']}</em></span>
          <span class="myd">满意度：<em>{$row['membercore']}</em></span>
        </dt>
        <dd>
        	{$row['content']}
        </dd>
       </dl>
       {/loop}


        </div>
        <input class="load-more" type="button" value="点击载入更多"  data-page="1" />
        <input type="hidden" id="articleid" value="{$info['id']}" />
        <input type="hidden" id="typeid" value="{$typeid}" />

    </div>
	</div>
  
  {template 'public/foot'}
    <script type="text/javascript">
        $('.load-more').click(function(){
            var docRec = $(this);
            var page = parseInt(docRec.attr('data-page'))+1;
            var typeid = $('#typeid').val();
            var id = $('#articleid').val();


            var url=SITEURL+'page/pinlun/id/'+id+"/page/"+page+"/action/ajax/typeid/"+typeid;
            $.ajax({
                type:'POST',
                url:url,
                dataType:'json',
                success:function(data){
                    var str = '';
                    var listnum = 0;

                    $.each(data,function(index,a){

                        str+='<dl>';
                        str+='  <dt>';
                        str+='<span class="name"><img class="fl" src="'+ a.memberico+'" width="30" height="30" /><em class="fl">'+ a.membername+'</em></span>';
                        str+='<span class="myd">满意度：<em>'+ a.membercore+'</em></span>';
                        str+='</dt>';
                        str+='    <dd>';
                        str+=a.content;
                        str+='</dd>';
                        str+='</dl>';

                        listnum++;
                    })
                    docRec.attr('data-page',page);
                    if(listnum==0){
                        docRec.attr('value','已无更多评论信息');
                    }
                    $('#pl_list').append(str);
                }

            })

        });
    </script>

</body>
</html>
