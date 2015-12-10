// JavaScript Document
/*----
会员中心用(异步搜索)
*/
(function($){
  $.AjaxSearch=function(options,fCallback){
    
      var defaults={
		  pageSize:15,
		  ajaxUrl:'',
		  dopost:'',
		  dataContain:'#linelist',
		  conditionfield:[] 
	  }
	 
	  var opt = $.extend(defaults, options); 
	  
	  init();//初始化

      function init(){
		 
	    doSearch();//直接查询
	  
	  }

		 //外部接口函数
		$.AjaxSearch.doMySearch=function(){
		  
		  doSearch();
		
		}
		
		//获取条件字段值
		function getFieldStr()
		{
			var out = "";
			var obj = opt.conditionfield
			for(var i=0;i<obj.length;i++){
	
               var f_v = $("#"+obj[i]).val();//获取值
	           out=out+"&"+obj[i]+"=" + f_v;
	
            }
			return out;
			
		}
	
		
		function doSearch(){
		  
		
			var curpage=$("#currentpage").val();
			
			var fieldcondition = getFieldStr();
			
			var formdata="dopost="+opt.dopost+fieldcondition+"&curpage="+curpage+"&pagesize="+opt.pageSize;

			var ajaxurl = siteUrl + opt.ajaxUrl;

		    $.ajax(
				{
				  type: "post",
				  data: formdata,
				  dataType:'json',
				  url:  ajaxurl,
				  beforeSend: function()
				  {
					 loading();
				  },
				  success: function(data,textStatus)
				  {
					 fCallback(data);
				  },
				  error: function(a,b,c)
				  {
					 alert(a.status);
					
				  }
				  
			   }
				 );		
		
		
		}
		function loading(){
		   $(""+opt.dataContain).html("<div style='text-align:center;padding:10px;'><img src='/templets/smore/images/loading.gif'>正在加载...</div>");
		
		}
		
		//上一页,下一页
		$.AjaxSearch.changePage=function(op){ //切换页面
		  
			  var currpage=parseInt($("#currentpage").val());
			 
			  if(op=='pre')//上一页
			  {
				currpage=currpage-1;
			  }
			  else if(op=='next') //下一页
			  {
				  
				currpage=currpage+1;	
			  }
			  $("#currentpage").val(currpage);
			  
			  doSearch();
		
		 }
		 //点击数字翻页
		$.AjaxSearch.page=function(page){
			
		     $("#currentpage").val(page);
		
		     doSearch();
		
		}
   
  
 
  }


})(jQuery)
