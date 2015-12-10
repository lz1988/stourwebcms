// JavaScript Document
Visa = {
	
		  search_item_selected:function(contain,tag,realvalue,class1){
			  
			 $(contain).find(tag).each(function(){
				var datavalue = $(this).attr('data-value');
				$(this).removeClass(class1);
				if(datavalue == realvalue) {
					$(this).addClass(class1)
				}
			
			})
		  
		  }
	
	 }
