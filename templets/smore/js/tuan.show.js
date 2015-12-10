// JavaScript Document
$(document).ready(function(e) {
	
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
   
   
   //团购图片轮播
    var FilesArray2=['./slider/jquery.slides.min.js','./slider/jquery.slides.css']
   Loader.loadFileList(FilesArray2,function(){
	    
     if($('#slides img').length<2) //如果图片数量少于2，则返回
	 {
		 $('#slides').show();
	  	 return; 
     }
     $('#slides').slidesjs({width : 580,height : 385,play : {active:true,auto : true,interval : 2000,swap : true},navigation: {
      active: true,
        // [boolean] Generates next and previous buttons.
        // You can set to false and use your own buttons.
        // User defined buttons must have the following:
        // previous button: class="slidesjs-previous slidesjs-navigation"
        // next button: class="slidesjs-next slidesjs-navigation"
      effect: "slide"
        // [string] Can be either "slide" or "fade".
    }});
   });
   
});

