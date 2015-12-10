// JavaScript Document
$(document).ready(function(e) {
	
	
   	
        var flag = ST.User.getUser();
	    if(flag !=0)
		{ 
			$(".login_cm").html("<a href='/member/'>"+flag['name']+"</a>")	  
		} 
				
				
	
	
});