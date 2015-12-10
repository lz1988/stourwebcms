// JavaScript Document
$(document).ready(function(e) {
     $(".search_item a").click(function(e) {
        var url="";
		var itm=$(this).parents(".search_item").first().attr("rel");
        var val=$(this).attr("data");
		
	    $(".search_item").each(function(index, element) {
			var cur_data=$(element).attr("data");
			var cur_rel=$(element).attr("rel");
			if(cur_data&&cur_data!=0&&cur_rel!=itm)
			{
				url+="&"+cur_rel+"="+cur_data;
			}
	
		});
		
		if(val&&val!=0)
		{
			url+="&"+itm+"="+val;
		}
		url=url.length==0?"/photos/index.php":"/photos/index.php?"+url.slice(1);
		window.open(url,"_self");
    });
});