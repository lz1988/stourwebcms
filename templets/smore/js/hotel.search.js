// JavaScript Document
$(function(){
  
   var rankid = $("#rankid").val();
   var priceid = $("#priceid").val();
   var attrid = $("#attrid").val();
   var sorttype = $("#sorttype").val();
   var destid = $("#destid").val();

   //目的地选中
    $.STOURWEB.search_item_selected("#destid_list","a",destid,'on');
   //星级选中
   
   $.STOURWEB.search_item_selected("#rank_list","a",rankid,'on');
   
   //酒店属性选中
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
   
   //酒店介绍查看
   $(".hotel_top_menu h1 s").click(function(){
						$(".sm_txt").toggle();	
	})
    //查询事件(链接点击)
	/*$(".serach_menu a").click(function(){
	   var datafield = $(this).attr('data-field');
	   var datavalue = $(this).attr('data-value');
	   if(datafield != 'attrid'){
	     $("#"+datafield).val(datavalue);
	   }
	   else{
	     Hotel.setAttrValue(this);
	   }
	   
       Hotel.doSearch();
	})*/
	//排序筛选
	$(".list_nav a").click(function(){
	   
	   $(this).parent('span').siblings().find('a').removeClass('on');
	   $(this).addClass('on');
	   $("#sorttype").val($(this).attr('data-value'));
	   Hotel.doSearch();
	
	})
	//评分星级显示
	/* var FilesArray=['./raty/jquery.raty.min.js']
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
			
	 
        });*/
    //酒店房型
	 $(".room_list").each(function(){
		        var hotelid=$(this).attr('data-id');
				$.ajax({
				  type:'POST',
				  url:siteUrl+'hotels/ajax.hotel.php',
				  data:'dopost=gethotelroom_show&hotelid='+hotelid,
				  success:function(data){
					 
					  $("#room_list_"+hotelid).html(data);
					  Hotel.roomClickEvent();//酒店房型展开式隐藏
					  Hotel.bookEvent();//预订功能
					  
				  }
				})
		  
		  })
    
	//去掉搜索框里最后一个dll的底边框 
	$(".serach_menu dl:last").addClass("bor_bot_0");


   
})