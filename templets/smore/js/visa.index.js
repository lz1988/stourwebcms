
// JavaScript Document
$(function(){

//签证首页轮播图
  var FilesArray2=['./slider/jquery.slides.min.js','./slider/jquery.slides.css']
   Loader.loadFileList(FilesArray2,function(){
	    
     if($('#slides img').length<2) //如果图片数量少于2，则返回
	 {
		 $('#slides').show();
	  	 return; 
     }
     $('#slides').slidesjs({width : 580,height : 385,play : {active:true,auto : true,interval : 2000,swap : true},navigation: {
      active: true,
       
      effect: "slide"
       
    }});
   });
 //搜索列表选择
 $('.choose li').click(function(){
    var field = $(this).attr('data-field');
	var value = $(this).attr('data-value');
	$("#"+field).val(value);
 
 })
    //左边搜索按钮点击
	  $(".btn_search").click(function(){
	       var visatypeid=$("#visatype").val();
		   var cityid = $("#visacity").val();
		   var countryid = $("#visacountry").val();
		  // var url = siteUrl+"visa/search.php?visatypeid="+visatypeid+"&cityid="+cityid+"&countryid="+countryid;
           var url = siteUrl+"visa/"+countryid+'-'+cityid+'-'+visatypeid+'-0';
		   window.open(url,'_self');
	  })

})