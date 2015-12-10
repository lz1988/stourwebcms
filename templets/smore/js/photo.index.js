// JavaScript Document

function item_masonry(){ 
	$('.item img').load(function(){ 
		$('.infinite_scroll').masonry({ 
			itemSelector: '.masonry_brick',
			columnWidth:290,
			gutterWidth:10								
		});		
	});
		
	$('.infinite_scroll').masonry({ 
		itemSelector: '.masonry_brick',
		columnWidth:290,
		gutterWidth:10						
	});	
}

$(document).ready(function(e) {

	function item_callback(){ 
		
		$('.item').mouseover(function(){
			$(this).css('box-shadow', '0 1px 5px rgba(35,25,25,0.5)');
			$('.btns',this).show();
		}).mouseout(function(){
			$(this).css('box-shadow', '0 1px 3px rgba(34,25,25,0.2)');
			$('.btns',this).hide();		 	
		});
		
		item_masonry();	

	}
	 
	
	//延迟加载图片
	$(".lazy_load").each(function(index, element) {
        var rel=$(element).attr("rel");
		$(element).attr("src",rel);
    });
     item_callback(); 

	
	 //搜索
  
	 
	
});