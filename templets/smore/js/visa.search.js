// JavaScript Document
$(function(){
   
   var visatypeid = $("#visatypeid").val();
   var countryid = $("#countryid").val();
   var cityid = $("#cityid").val();
  
  //签证类型选中
   $.STOURWEB.search_item_selected("#visatype_list","a",visatypeid,'on');
   
   //签证国家选中
   $.STOURWEB.search_item_selected("#visacountry_list","a",countryid,'on');
   
   //签发城市选中
   $.STOURWEB.search_item_selected("#visacity_list","a",cityid,'on');
   
   //查询事件(链接点击)
	/*$(".serach_menu a").click(function(){
	   var datafield = $(this).attr('data-field');
	   var datavalue = $(this).attr('data-value');
	   $("#"+datafield).val(datavalue);
       doSearch();
	})*/
   
   
   
})
//执行搜索
function doSearch(){
	    
		  
		  var cityid=$("#cityid").val();
		  var countryid=$("#countryid").val();
		  var visatypeid=$("#visatypeid").val();
		  var url = siteUrl+"visa/search.php?cityid="+cityid+"&countryid="+countryid+"&visatypeid="+visatypeid;
		  window.open(url,'_self');
	   
	   }