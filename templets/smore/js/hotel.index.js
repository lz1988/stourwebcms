// JavaScript Document
$(function(){
   
   	    //酒店轮播广告
		 var FilesArray2=['./slider/jquery.slides.min.js','./slider/jquery.slides.css']
		 Loader.loadFileList(FilesArray2,function(){
			  
		   if($('#slides img').length<2) //如果图片数量少于2，则返回
		   {
			   $('#slides').show();
			   return; 
		   }
		   $('#slides').slidesjs({width : 800,height : 325,play : {active:true,auto : true,interval : 2000,swap : true},navigation: {active: true, effect: "slide"   
		  }});
		 });
		//入住日期选择
	    $("#startdate").click(function(){
            WdatePicker({onpicked:function(){},skin:'whyGreen',minDate:'%y-%M-%d'}) 
        })
		//目的城市选择
		 var FilesArray=['./result/result.js','./result/result.css']
			Loader.loadFileList(FilesArray,function(){

			  $('#destname').Result({url:'../ajax/ajax.php',data:'getDest'});
		   });
		//目的地框
		$('#destname').focusEffect();
		
		  //今天日期
		  var myDate = new Date();//今天
		  //var tomo = new   Date((myDate/1000+86400*1)*1000);
		  var Year = myDate.getFullYear();
		  var Month = myDate.getMonth()+1; 
		  var Day = myDate.getDate(); 
			
		  //var tYear = tomo.getFullYear();
		  //var tMonth = tomo.getMonth()+1; 
		 // var tDay = tomo.getDate(); 
			  
			  
		  var startdate=Year+"-"+Month+"-"+Day;
			  //var enddate=tYear+"-"+tMonth+"-"+tDay;
		  $("#startdate").val(startdate);
			 // $("#enddate").val(enddate);
        //筛选条件点击事件
		 $(".nr_ul").find('li').click(function(){
	 
	     var field = $(this).attr('data-field');
		 var datavalue = $(this).attr('data-value');
		 $("#"+field).val(datavalue);
		
	 })
	   //酒店推荐滑动
         //$.STOURWEB.hover_tag(".tjjd_tag_top", "", "current");
		 $(".tjjd_tag_top a").hover(function(index){
		  
		  var cur = $(this).attr('data-id');
		  var content = $(this).parents(".tjjd_tag_top").data(cur);
		  var that = $(this);
		  $(this).parent().addClass('current').siblings().removeClass('current');
		  
		  if(content){
			  
			  $(this).parent().parent().siblings(".tjjd_tag_con").html(content);
		  }else{
			  $(this).parent().siblings(".tjjd_tag_con").html('<img src="../smore/images/loading.gif" style="display:block;width:28px;height:28px;margin:160px auto 157px auto;">');
			  $.get("ajax.hotel.php", {dest_id:cur,inajax:1,dopost:'getHotelByDestId'}, function(data) {
				  
				  that.parent().parent().siblings(".tjjd_tag_con").html(data);
				  
				  that.parents('.tjjd_tag_top').data(cur,data);
			  });		
		  }
	  },function(){});
	  //选中第一个热门城市
	  $(".tjjd_tag_top a").first().trigger('mouseover');
	  
	  //酒店搜索
	  $(".btn_search").click(function(){
	       var destname=$("#destname").val();
		   var rankid = $("#rankid").val();
		   var priceid = $("#priceid").val();
		   getDestId(destname);
		   var destid = $("#dest_id").val();
           var keyword = $("#jd_name").val();//酒店名称
           keyword = keyword=='' ? 0 : keyword;
		   //var url = siteUrl+"hotels/search.php?dest_id="+destid+"&rankid="+rankid+"&priceid="+priceid+"&keyword="+keyword;
          var url = siteUrl+"hotels/"+destid+'-'+rankid+'-'+priceid+'-0-'+encodeURIComponent(keyword)+'-0';

		  window.open(url,'_self');
		   
	  
	  })
	   //获取目的地id
	  function getDestId(destname)
	  {
		  $.ajax({type:'POST',url:'ajax.hotel.php',async:false,data:'dopost=getDestId&destname='+destname,success:function(data){
		     
			  $("#dest_id").val(data);
		  
		  }})
		  
	  }
	  
   



})