// JavaScript Document
$(function(){
  
   var day = $("#day").val();
   var priceid = $("#priceid").val();
   var attrid = $("#attrid").val();
   var sorttype = $("#sorttype").val();
   var pinyin = $("#pinyin").val();
   var destid = $("#destid").val();
   var keyword = $("#keyword").val();
   var startcity =$("#startcity").val();

    //目的地天数选中

    $.STOURWEB.search_item_selected("#destid_list","a",destid,'on');

   //线路天数选中
   
   $.STOURWEB.search_item_selected("#day_list","a",day,'on');
   
   //线路属性选中
   var attrArr = attrid.split('_');
   for(i=0;i<attrArr.length;i++)
   {
	 
	  $.STOURWEB.search_attr_selected(".attr_list","a",attrArr[i],'on'); 
   }
   //价格范围选中
   $.STOURWEB.search_item_selected("#price_list","a",priceid,'on');

    //出发地选中
    $.STOURWEB.search_item_selected("#startcity_list","a",startcity,'on');
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
   
   /*线路介绍查看
   $(".line_top_menu h1 s").click(function(){
	 $(".sm_txt").toggle();	
   })*/
    //查询事件(链接点击)
	/*$(".serach_menu a").click(function(){
	   var datafield = $(this).attr('data-field');
	   var datavalue = $(this).attr('data-value');
	   if(datafield != 'attrid'){
	     $("#"+datafield).val(datavalue);
	   }
	   else{
	     Line.setAttrValue(this);
	   }
	   
       Line.doSearch();
	})*/
	//排序筛选
	$(".list_nav a").click(function(){
	   
	   $(this).parent('span').siblings().find('a').removeClass('on');
	   $(this).addClass('on');
	   $("#sorttype").val($(this).attr('data-value'));
	   Line.doSearch();
	
	})
	//评分星级显示
	/* var FilesArray=['./raty/jquery.raty.min.js']
         Loader.loadFileList(FilesArray,function(){
			
			 $('.star').raty({
				size:20,
				path:siteUrl+'templets/smore/js/raty/img/',
				readOnly : true,
				hints: ['极差','不好','一般','很好','非常好'],
				score:function(){
				  return $(this).attr('data-score');
				} 
	  
			});
			
	 
        });*/
   
})