// JavaScript Document
$(function(){

    //酒店内容，评论，咨询 菜单 切换
    var FilesArray=['./floatmenu/floatmenu.js','./floatmenu/floatmenu.css']
    Loader.loadFileList(FilesArray,function(){
    $.floatMenu({
    menuContain : '#tab2',
    tabItem : 'li',
    chooseClass : 'active',
    contentContain : '#tab_content',
    itemClass : '.tablelist'});
   });
	//读取地图
//	Hotel.Show.getHotelMap();
	 //读取房型
	Hotel.getHotelRoom();
	   //图片显示
   var FilesArray2=['./fancybox/jquery.fancybox-1.3.4.js','./fancybox/jquery.fancybox-1.3.4.css'];
   Loader.loadFileList(FilesArray2,function(){
	    $("a[rel=group]").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'cyclic'        :   true,
		'overlayShow'	:	false,
		'titlePosition' :'over',
		'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
     return '<span id="fancybox-title-over">图片：' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
    }
		
	    }); 

   });

})