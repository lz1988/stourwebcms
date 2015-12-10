// JavaScript Document
(function($){
  $.AjaxSearch=function(options,obj,fCallback){
    
      var defaults={
		  pageSize:15,
		  ajaxUrl:'',
		  dopost:'',
		  selectedCss:'.selected',
		  unSelectedCss:'',
		  dataContain:'#linelist',
		  addWhere:false,
		  onChoose:function(){choose(obj)} 
	  }
	 
	  var opt = $.extend(defaults, options); 
	  
	  init();//初始化

      function init(){
		 
	   if(obj!=''){
		   if(opt.onChoose){ //是否调用外部选择方法
		      opt.onChoose(obj);
		   }
		   else{
		      choose(obj);
		   }
	    
	   }
	   else{
	   
	   }
	    doSearch();//直接查询
	  
	  }
	 
	
	
		  
	   function choose(obj){
		 
			
			changeCss(obj);
			
			//genChoose(obj);//生成选择信息
			
			//doSearch();//查询
			
		 
		 }
		//获取属性选择列表
		function getAttrList(){
		 
		   var attrlist='';
		   $(""+opt.selectedCss).each(function(){
			  
			  var datafield = $(this).attr('data-field');
			   //排除价格范围
			   if( datafield !='priceid' && datafield !='destid' && datafield != 'day'){
			      
			      attrlist=attrlist+$(this).attr('data-value')+',';
			   }
		   })
		  
		  if(!attrlist.isempty()){
			 attrlist=attrlist.substr(0,attrlist.length-1);
		  
		  }
				return attrlist;
			   
		 }
		 //获取价格范围
		 function getPriceId(){
		   var priceid='';
		   $(""+opt.selectedCss).each(function(){
			   //价格范围
			   if($(this).attr('data-field')=='priceid'){
			   
			      priceid=priceid+$(this).attr('data-value')+',';
			   }
		   })
		   if(!priceid.isempty()){
			 priceid=priceid.substr(0,priceid.length-1);
		  
		   }
			
		   return priceid;
		 
		 }
		 //获取目的地id
		 function getDestId(){
		   var destid='';
		   $(""+opt.selectedCss).each(function(){
			   if($(this).attr('data-field')=='destid'){
			   
			      destid=destid+$(this).attr('data-value')+',';
			   }
		   })
		   if(!destid.isempty()){
			 destid=destid.substr(0,destid.length-1);
		  
		   }
		   return destid
		 
		 }
		 //获取搜索名子
		 function getSearchKey(){
		   var searchkey=$("#searchkey").val();		   
		   var defkey=$("#searchkey").attr('datadef');
		   if(searchkey==defkey)
		     searchkey="";
		  return searchkey;
		 
		 }
		  //获取天数
		 function getDayInfo(){
		   var day='';
		   $(""+opt.selectedCss).each(function(){
			   if($(this).attr('data-field')=='day'){
			   
			      day=day+$(this).attr('data-value')+',';
			   }
		   })
		   if(!day.isempty()){
			 day=day.substr(0,day.length-1);
		  
		   }
		   return day
		 
		 }
		 //生成选择参数(暂时不用)
		function genChoose(obj){
			var str=null;
			var text=$(obj).text();
			var c=$(obj).attr('class');
			var id=$(obj).attr('id');
			var groupid=$(obj).attr('groupid');
			
			$('.search_value').each(function(){ //移除同组的数据
			   if($(this).attr('groupid')==groupid){
				  $(this).remove();
			   }
			
			})
			str='<i class="search_value" id="s_i_'+id+'" groupid='+groupid+'><span class="lef_txt">'+text+'</span><label class="search_value_close" tpid="'+id+'" onclick="$.AjaxSearch.removeSearchItem(this)"></label></i>';
			if($(obj).attr('id') != 'SortType')
			{
				$("#filterDiv").append(str);
			}
		   
		 
		 }
		 //清空一项条件
		 $.AjaxSearch.removeSearchItem=function(obj){ 
			   var tid=$(obj).attr('tpid');
				$('#s_i_'+tid).remove();
				$("#"+tid).parent().attr('class',opt.unSelectedCss);
				
				doSearch();
		 
		 
		 }
		 //清空所有条件
		$.AjaxSearch.removeAllItem=function(){
		   
			//$(".search_value").remove();
			
			$("."+opt.selectedCss).each(function(){
			   $(this).attr('class',opt.unSelectedCss);
			})
			$("#currentpage").val(1);
			
			$("#searchkey").val(0);
			
			doSearch();
		 
		 }
		 //外部接口函数
		$.AjaxSearch.doMySearch=function(){
		  
		  doSearch();
		 // alert('ok');
		}
		//改变CSS状态
		function changeCss(t){

		   /* if($(t).parent().attr('class')=='buxian')//是否是第一个
		 {
			 $(t).parent().parent().find('label').each(function(){
			  
			   if($(this).children('a').attr('class') == opt.selectedCss){
					 $(this).children('a').removeClass(opt.selectedCss);
					 $(this).children('input').removeAttr('checked');
			   }
		 
		     })
			 
		 }
		 else{ //如果不是第一个,则"不限"置为未选择状态
			 
		 
		   $(t).parent().parent().find('label').first().children('a').removeClass(opt.selectedCss);
		    
		 }
		 $(t).addClass(opt.selectedCss);
		 $(t).parent().children('input').attr('checked','true');*/
		   
		   $(t).parents('dd').first().find('a').removeClass('on');
		   $(t).addClass('on');

		
		}
		
		function doSearch(){
		  
			var attrlist=getAttrList();
			var priceid=getPriceId();
			var destid=getDestId();
			var day = getDayInfo();
			var searchkey=getSearchKey();
			
			var sorttype = $('#sorttype').val();
			var curpage=$("#currentpage").val();
			//var curpage = 1;
			orderby = typeof orderby == 'undefined' ? '' : 'shorttype' + orderby;
			var startdate = $("#startdate").val();
			var enddate = $("#enddate").val();
			startdate = typeof startdate == 'undefined' ? '' : startdate;
			enddate = typeof enddate == 'undefined' ? '' : enddate;
			var formdata="dopost="+opt.dopost+"&attrlist="+attrlist+"&priceid="+priceid+"&curpage="+curpage+"&dest_id="+destid+"&pagesize="+opt.pageSize+"&searchkey="+searchkey+"&sorttype="+sorttype+"&startdate="+startdate+"&enddate="+enddate+"&day="+day;
			var ajaxurl = siteUrl + opt.ajaxUrl;

		   $.ajax(
				{
				  type: "post",
				  data: formdata,
				  dataType:'json',
				  url:  ajaxurl,
				  beforeSend: function()
				  {
					 //creatDiv();
					 loading();
					 
				  },
				  success: function(data,textStatus)
				  {
					 //removeMaskDiv();
					 //当数据小于8时分页不显示.
					/* if(data.total<opt.pageSize){
					   $("#miniPager").hide();
					 }
					 else{
					   $("#miniPager").show();
					 }
					 if(curpage==1){
					   $("#prePage").attr('style','color:#ccc;cursor:default');
					   $("#prePage").unbind();
					 }
					 else{
					   $("#prePage").attr('class','on'); //上一页可点
					   $("#prePage").unbind('click');
					   $("#prePage").click(function(){
						  $(this).unbind();
						  changePage('pre');
					   
					   })
					   
					 }
					 if(curpage==data.totalpage){
					   $("#nextPage").attr('style','color:#ccc;cursor:default');
					   $("#nextPage").unbind();
					 }
					 else if(curpage<data.totalpage){
					   $("#nextPage").attr('class','on');
					   $("#nextPage").unbind('click');
					   $("#nextPage").click(function(){ //下一页可点.
						 $(this).unbind();
						 changePage('next');
					   })
					 }
					 $("#totalpage").val(data.totalpage);*/
					 fCallback(data);
					 
					// $(" .tuij_loadin").css('display','none');
					// var subtitle=getTextAttr();
					
					
				  },
				  error: function(a,b,c)
				  {
					 alert(a.status);
					// removeMaskDiv();
					// Hotel.Search.removeMaskDiv();
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
    function creatDiv(){
	
	var newdiv = document.createElement("div"); 
	newdiv.id = "newdiv"; 
	newdiv.style.position = "absolute"; 
	newdiv.style.zIndex = 9999; 
	
	newdiv.style.top = parseInt($(window).height() /2)+"px"; 
	//newdiv.style.top = topP;
	newdiv.style.left = parseInt($(window).width() /2)+"px"; 
	//newdiv.style.left = leftP;

	newdiv.style.background ="#1b4e6d"; 
	newdiv.style.border = "1px solid #ccc"; 
	newdiv.style.padding = "5px"; 
	newdiv.style.color="#fff";
	//newdiv.css="DivBackground";
	newdiv.innerHTML="正在查询中,请稍后...";
	//newdiv.className="DivBackground";
	//newdiv.style.display="block";
	//newdiv.hide();
	$(document.body).append(newdiv); 
	var newMask = document.createElement("div"); 
	newMask.id = "newMask"; 
	newMask.style.position = "absolute"; 
	newMask.style.zIndex = 8000; 
	
	newMask.style.width = document.body.scrollWidth+"px"; 
	newMask.style.height = document.body.scrollHeight+"px"; 
	newMask.style.top = "0px"; 
	newMask.style.left = "0px"; 
	newMask.style.background = "#000"; 
	newMask.style.filter = "alpha(opacity=60)"; 
	newMask.style.opacity = "0.40"; 
	//newMask.onclick=function(){ShowDiv.divCannel();};
	document.body.appendChild(newMask);
	//$("newdiv").hide();
	//$("#newdiv"+id).attr("class","DivBackground");
	//$("#newMask"+id).click("ShowDiv.divCannel()");
	//$("#newdiv"+id).css("DivBackground");
	$("#newdiv").show(300);
	
	
	}
	function removeMaskDiv(){
	  $("#newdiv").remove();
	  $("#newMask").remove();
	
	}
	  
  
 
  }


})(jQuery)
