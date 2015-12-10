// JavaScript Document
$(function(){
   
  
   var priceid = $("#priceid").val();
   var attrid = $("#attrid").val();
   var sorttype = $("#sorttype").val();
   var destid = $("#destid").val();


    //目的地选中
    $.STOURWEB.search_item_selected("#destid_list","a",destid,'on');
   //景点属性选中
   var attrArr = attrid.split('_');
   for(i=0;i<attrArr.length;i++)
   {
	 
	  $.STOURWEB.search_attr_selected(".attr_list","a",attrArr[i],'on'); 
   }
   //价格范围选中
   $.STOURWEB.search_item_selected("#price_list","a",priceid,'on');
    //排序状态选中
   $(".list_nav a").each(function(){
      var datavalue = $(this).attr('data-value');
	  if(datavalue == sorttype){
	  
	    $(this).addClass('on');
	  }
	  else{
	    $(this).removeClass('on');
	  }
   
   })
    //查询事件(链接点击)
	/*$(".serach_menu a").click(function(){
	   var datafield = $(this).attr('data-field');
	   var datavalue = $(this).attr('data-value');
	   if(datafield != 'attrid'){
	     $("#"+datafield).val(datavalue);
	   }
	   else{
	     setAttrValue(this);
	   }
	   
         doSearch();
	})*/
	//排序筛选
	$(".list_nav a").click(function(){
	   
	   $(this).parent('span').siblings().find('a').removeClass('on');
	   $(this).addClass('on');
	   $("#sorttype").val($(this).attr('data-value'));
	   doSearch();
	
	})
   
     //景点介绍查看
   $(".hotel_top_menu h1 s").click(function(){
						$(".sm_txt").toggle();	
	})
	//评分星级显示
	 var FilesArray=['./raty/jquery.raty.min.js']
         Loader.loadFileList(FilesArray,function(){
			
			 $('.star').raty({
				size:6,
				path:siteUrl+'templets/smore/js/raty/img/',
				readOnly : true,
				width:75,
				hints: ['极差','不好','一般','很好','非常好'],
				score:function(){
				  return $(this).attr('data-score');
				}
				
				 
	  
			});
			
	 
        });
	
    //景点门票
	 $(".spot_ticket_list").each(function(){
		        var spotid=$(this).attr('data-id');
				var that = $(this);
				$.ajax({
				  type:'POST',
				  url:'ajax.spot.php',
				  data:'dopost=getpiaolist&spotid='+spotid,
				  success:function(data){
					  
					  if(data!='')
					  {
						    $("#ticket_list_"+spotid).html(data);
							$(".dl_title").unbind('click').click(function(){
							$(this).parent().next().toggle();
							});	
					  }
					  //没有门票数据时隐藏线条.
					  else{
						 
						that.parents('.list_ticket').first().find('.base_describe').css('border','none'); 
					  }
					 
					  
				  }
				})
		  
		  })
		$(".serach_menu dl:last").addClass("bor_bot_0");  
		  

})

//执行搜索
function doSearch(){
	    
		  var attrid=$("#attrid").val();
		  var priceid=$("#priceid").val();
		  var destid=$("#destid").val();
		  var sorttype = $("#sorttype").val();
          var keyword = $("#keyword").val();
          var pinyin = $("#pinyin").val();
          pinyin = pinyin != '' ? pinyin : destid;
          pinyin = pinyin==0 ? 'all' : pinyin;
		  keyword = keyword!='' ? keyword : 0;
		  //var url = siteUrl+"spots/search.php?dest_id="+destid+"&priceid="+priceid+"&attrid="+attrid+"&sorttype="+sorttype;
          var url = siteUrl+"spots/"+pinyin+'-'+priceid+'-'+sorttype+'-'+keyword+'-'+attrid;
		  window.open(url,'_self');
	   
	   }
//属性选择
function setAttrValue(obj){
	      $(obj).parents('dd').first().find('a').removeClass('on');
		  $(obj).addClass('on');
		  var attrid = '';
		  $('.attr_list').each(function(){
		    
			  $(this).find('.on').each(function(){
			    
		      attrid += $(this).attr('data-value')+',';
		  })
		  
		  })
		  attrid=attrid.substring(0,attrid.length-1);
		  $("#attrid").val(attrid);
	   
	   }