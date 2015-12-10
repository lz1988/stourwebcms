// JavaScript Document

$(function(){
    //线路内容，评论，咨询 菜单 切换
    var FilesArray=['./floatmenu/floatmenu.js','./floatmenu/floatmenu.css']
    Loader.loadFileList(FilesArray,function(){
    $.floatMenu({
    menuContain : '#tab2',
    tabItem : 'li',
    chooseClass : 'active',
    contentContain : '#tab_content',
    itemClass : '.tablelist'});
   });
   //预订人数增减
   $(".plus").click(function(e) {
				  var val=parseInt($(this).prev("input").val());
				  if(val>0)
				  $(this).prev("input").val(val-1);
	});
  $(".reduce").click(function(e) {
	  var val=parseInt($(this).next("input").val());
	  $(this).next("input").val(val+1);
  });
  //预订按钮
  $(".btn_book").click(function(){
      var datevalue = $("#date_list").val();//当前选择的日期
	  var price = $("#date_list").find("option:selected").attr("data-price"); //成人价格
	  var childprice = $("#date_list").find("option:selected").attr("data-childprice");//儿童价格
	  var suitid = $(".tc_class a.on").attr('data-suitid');
	  var lineid = $("#lineid").val();
	  var adultnum = $("#adultnum").val();
	  var childnum = $("#childnum").val();
      var oldnum = $("#oldnum").val();
	  if(datevalue == null || suitid==undefined){
	     alert('当前产品不可预订');
		 return false;
	  }
	  else{

		   var url = 'booking.php?usedate='+datevalue+"&lineid="+lineid+"&price="+price+"&childprice="+childprice+"&suitid="+suitid+"&oldnum="+oldnum;
		   url = url+"&adultnum="+adultnum+"&childnum="+childnum;
		   window.open(url);
	  }
  
  })
  //酒店轮播
  $(".ulSmallPic li").each(function(i){
	   
	   $(this).click(i,function(){
	      $(this).addClass('liSelected').siblings().removeClass('liSelected');
		  $(".ulBigPic li:eq("+i+")").addClass('liSelected').siblings().removeClass('liSelected');
	   })
      
  
  })
  $(".ulSmallPic li:eq(0)").trigger('click');
   
   

})

//日历点击预订
function setBeginTime(year,month,day,price,childprice,lineid,suitid)
{
	var lineid = $("#lineid").val();
	var datevalue=year+"-"+month+"-"+day;
	var url = 'booking.php?usedate='+datevalue+"&lineid="+lineid+"&suitid="+suitid+"&price="+price+"&childprice="+childprice;
	url = url+"&adultnum="+1+"&childnum=0";
    window.open(url);
	
}

