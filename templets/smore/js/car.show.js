// JavaScript Document
// JavaScript Document
$(document).ready(function(e) {
	
	
    //套餐提示显示
	$(".dl_title").click(function(){
	$(this).parent().next().toggle();
	});	

	
	//团购内容，评论，咨询 菜单 切换
    var FilesArray=['./floatmenu/floatmenu.js','./floatmenu/floatmenu.css']
    Loader.loadFileList(FilesArray,function(){
    $.floatMenu({
    menuContain : '#tab2',
    tabItem : 'li',
    chooseClass : 'active',
    contentContain : '',
    itemClass : '.tablelist'});
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
   
   
   //图片切换 
   $(".thumbpic").css("cursor","pointer");
   $(".thumbpic").click(function(e) {
     $("#fpic").attr("src",$(this).attr("rel"));
});
   
   
});