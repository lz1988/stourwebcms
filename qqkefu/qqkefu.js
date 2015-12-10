// JavaScript Document
$(document).ready(function() {

    $.ajax(
		    {
			  type: "post",
			  data:'',
			  dataType:'html', 
			  url: "http://" + window.location.host +"/qqkefu/index.php?webid=0",
			  success: function(data)
			     {
					
				    $('body').append(data);
			     },
			 error: function(a,b,c)
			  {	  
				  //alert(a.status);
			  }  
		    }
		);	
	
	
	
});