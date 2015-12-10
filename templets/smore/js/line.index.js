// JavaScript Document
$(function(){
  //线路轮播广告
   var FilesArray2=['./slider/jquery.slides.min.js','./slider/jquery.slides.css']
   Loader.loadFileList(FilesArray2,function(){
	    
     if($('#slides img').length<2) //如果图片数量少于2，则返回
	 {
		 $('#slides').show();
	  	 return; 
     }
     $('#slides').slidesjs({width : 956,height : 275,play : {active:true,auto : true,interval : 2000,swap : true},navigation: {active: true, effect: "slide"   
    }});
   });
   //线路推荐滑动
   $.STOURWEB.hover_tag(".tjxl_tag_top", "", "active");
   $(".tjxl_tag_top a").hover(function(index){
	
	var cur = $(this).attr('data-id');
	var content = $(this).parent(".tjxl_tag_top").data(cur);
	var that = $(this);
	
	if(content){
		//console.log($(this).parent().parent().siblings(".tjxl_tag_con").html());
		$(this).parent().parent().siblings(".tjxl_tag_con").html(content);
	}else{
		$(this).parent().siblings(".tjxl_tag_con").html('<img src="../standard/images/loading.gif" style="display:block;width:28px;height:28px;margin:160px auto 157px auto;">');
		$.get("ajax.line.php", {dest_id:cur,inajax:1,dopost:'getLineByDestId'}, function(data) {
			
			that.parent().parent().siblings(".tjxl_tag_con").html(data);
			
			that.parent('.tjxl_tag_top').data(cur,data);
		});		
	}
},function(){});
   
   //目的地切换
   $(".dest_menu").find('li').click(function(){
        var nav = $(this).attr('data-value');
		$(".categorys").hide();
		$(".navname").text($(this).text());
		$("."+nav).show();
   
   })
   //选中第一个
   $(".dest_menu").find('li').first().trigger('click');
  
   //滑动导航指向效果
   $(".categorys div .item").hover(
                   function(e){
						  
						  $(this).siblings().removeClass("hover").find(".i-mc").hide();
                
						  //如果有更多元素
						  //if($(this).find(".i-mc a").length > 0){
							 $(this).addClass("hover");
							 $(this).find(".i-mc").show();
						  //}
						  
				  },
				  function(e){
														  
						$(this).removeClass("hover");
						$(this).find(".i-mc").hide();
				  }
			);
	 //边栏搜索选择参数
	 $(".side_st").find('li').click(function(){
	 
	     var field = $(this).attr('data-field');
		 var datavalue = $(this).attr('data-value');
         if(field == 'dest_id')
         {
             pinyin = $(this).attr('data-pinyin');
             datavalue = pinyin!='' ? pinyin : datavalue;
         }
		 $("#"+field).val(datavalue);
		
	 })
	    //边栏搜索按钮点击
	  $(".btn_search").click(function(){
	       var destid=$("#dest_id").val();
		   var day = $("#dayid").val();
		   var priceid = $("#priceid").val();

		   //var url = siteUrl+"lines/search.php?dest_id="+destid+"&day="+day+"&priceid="+priceid;
           var url = siteUrl+'lines/'+destid+'-'+day+'-'+priceid+'-0-0-0';
		   window.open(url,'_self');
	  })
	 //目的城市选择
		 var FilesArray=['./result/result.js','./result/result.css']
			Loader.loadFileList(FilesArray,function(){

			  $('#destname').Result({url:'../ajax/ajax.php',data:'getDest'});
		   });
	 //目的地搜索框
	 $('#destname').focusEffect();

	 //按目的地搜索
	   $(".mdd_btn").click(function(){
	       var keyword = $("#destname").val();
		   //var destid = Number(getDestId(destname));
           keyword = keyword == '请输入目的地或线路名称' ? 0 : keyword;
           keyword = keyword==''  ? 0 : keyword;

		   var url = siteUrl+"lines/0-0-0-0-"+encodeURIComponent(keyword)+'-0';
		   window.open(url,'_self');
		   


	   
	   })
		   
		   

    //目的地指向显示
    $("#mdd_choose").hover(function(){

        $(this).find('.dest_menu').show();

    },function(){$(this).find('.dest_menu').hide();});

    $("#mdd_choose").find('li').hover(
        function(){
            $(this).addClass('focus');

    },function(){
            $(this).removeClass('focus');
        }
    )

})

//获取目的地id
function getDestId(destname)
{
    var destid = 0;
    $.ajax({type:'POST',url:'/ajax/ajax.php',async:false,data:'dopost=getDestId&destname='+destname,success:function(data){

        destid=data;

    }})
    return destid;

}