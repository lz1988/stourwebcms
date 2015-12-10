// JavaScript Document
$(function(){
   //小图看大图
 
   $(".thumb img").css("cursor","pointer");
   $(".thumb img").click(function() {
	 var src = $(this).attr("src").replace('lit160','litimg');
     var title=$(this).attr('alt');
     $("#litpic").attr("src",src);
     $("#litpic").attr('alt',title)
    $("#litpic").attr('title',title)
});

	
   //fancybox图片显示
   var FilesArray2=['./fancybox/jquery.fancybox-1.3.4.js','./fancybox/jquery.fancybox-1.3.4.css'];
   Loader.loadFileList(FilesArray2,function(){
	   
	    $("a[rel=group]:gt(0)").hide();
	    $("a[rel=group]").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		 'cyclic'       :true,
		'overlayShow'	:	false,
		'titlePosition':'over',
		'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">图片：' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
		
	    }); 
   });
   //菜单

   if($("#tab2").length>0){
	   var FilesArray=['./floatmenu/floatmenu.js','./floatmenu/floatmenu.css']
       Loader.loadFileList(FilesArray,function(){
		  $.floatMenu({
		  menuContain : '#tab2',
		  tabItem : 'li',
		  chooseClass : 'active',
		  contentContain : '#tab_content',
		  itemClass : '.tablelist'});
		 });
		//获取门票列表
       var spotid = $("#spotid").val();
   
		$.ajax({
			type:'POST',
			url:'ajax.spot.php',
			data:'dopost=getpiaolist&spotid='+spotid,
			success:function(data){
				$("#piao_list").html(data);
               /* var FilesArray=['./powerfloat/jquery-powerFloat.js','./powerfloat/powerFloat.css']
                Loader.loadFileList(FilesArray,function(){
                    $(".btn_ding").powerFloat({
                        eventType:"click",
                        target: $("#calendar"),
                        showCall: function() { }

                    });

                });

                //预订按钮点击
                $(".btn_ding").click(function(){
                    var spotid = $('#spotid').val();
                    var ticketid = $(this).attr('data-ticketid');
                    getCalendar(ticketid,spotid);

                })*/
				$(".dl_title").unbind('click').click(function(){
				  $(this).parent().next().toggle();





				  });	
			 }
			})
   
   }
  

})

//获取日历报价
function getCalendar(suitid,spotid)
{
    showCalendar('calendar',suitid,function(){},soptid);
}

//日历跳转
function setBeginTime(year,month,day,price,childprice,aid,suitid)
{
    var spotid = $('#spotid').val();
    var url = siteUrl+'/spots/booking.php?usedate='+year+'-'+month+'-'+day+'&spotid='+spotid+'&ticketid='+suitid;
    window.open(url);

}