// JavaScript Document
$(document).ready(function(){
             //查询通用配置
			    var config={
					  pageSize:8,
					  ajaxUrl:'destination/ajax.line.php',
					  dopost:'getlinelist',
					  selectedCss:'.serach_menu .on',
					  dataContain:'#linelist',
					  unSelectedCss:''
					 
				  
				  };
			   function getLine(data){
				     
					 $("#linelist").html(data.list);
					 $("#totalnum").html(data.total);
					 $("#pageinfo").html(data.pageinfo);//分页信息
					
				
				}
			 //初始化
			  $.AjaxSearch(config,'',function(data){getLine(data)});//初始化

			  //查询事件(链接点击)
	          $(".serach_menu a").click(function(){
				 
				  $.AjaxSearch(config,this,function(data){getLine(data);});

              })
			  //排序筛选
			  $(".list_nav a").click(function(){
			     
				 $(this).parent('span').siblings().find('a').removeClass('on');
				 $(this).addClass('on');
				 $("#sorttype").val($(this).attr('data-value'));
				 $.AjaxSearch(config,this,function(data){getLine(data);});
			  
			  })


})