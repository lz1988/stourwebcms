// JavaScript Document
$(document).ready(function(e) {
	
	//签证内容，评论，咨询 菜单 切换
    var FilesArray=['./floatmenu/floatmenu.js','./floatmenu/floatmenu.css']
    Loader.loadFileList(FilesArray,function(){
    $.floatMenu({
    menuContain : '#tab2',
    tabItem : 'li',
    chooseClass : 'active',
    contentContain : '.jieshao',
    itemClass : '.tablelist'});
   });

   
});

