// JavaScript Document
$(document).ready(function(){
	//图片滚动			
			$("#count1").dayuwscroll({
				parent_ele:'#wrapBox1',
				list_btn:'#tabT04',
				pre_btn:'#left1',
				next_btn:'#right1',
				path: 'left',
				auto:true,
				time:3000,
				num:3,
				gd_num:3,
				waite_time:1000
	        });
				
	
      $(".pictx").mouseenter(function(){
				$(this).children(".txt_nr").animate({bottom:'0'})
				})
			$(".pictx").mouseleave(function(){
				$(this).children(".txt_nr").animate({bottom:'-70px'})
				})
			

         
          
						
			
});

        