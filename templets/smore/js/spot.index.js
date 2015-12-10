// JavaScript Document
$(function(){
  //目的地搜索框
	 $('.mdd_box').focusEffect();
  //边栏搜索选择参数
	 $(".side_st").find('li').click(function(){
	 
	     var field = $(this).attr('data-field');
		 var datavalue = $(this).attr('data-value');
		 $("#"+field).val(datavalue);
		
	 }) 
   //边栏搜索按钮点击
	  $(".btn_search").click(function(){
	       var destid=$("#destid").val();
		   var attrid = $("#attrid").val();
		   var priceid = $("#priceid").val();

		   var url = siteUrl+"spots/search.php?dest_id="+destid+"&attrid="+attrid+"&priceid="+priceid;
		   window.open(url,'_self');
	  })
   //目的城市选择
		 var FilesArray=['./result/result.js','./result/result.css']
			Loader.loadFileList(FilesArray,function(){

			  $('#mdd_box').Result({url:'../ajax/ajax.php',data:'getDest'});
		   });
	//按目的地搜索
	   $(".mdd_btn").click(function(){
	       var keyword = $("#mdd_box").val();
           keyword = keyword=='请输入目的或景点名称' ? 0 : keyword;
		   //var destid = Number(getDestId(destname));
		  
		  /* if(destid && destid!=36){
		     var url = siteUrl+"spots/search.php?dest_id="+destid;
		     window.open(url,'_self');
		   
		   }
		   else{
		      $("#mdd_box").focus();
		   }*/
          //if(keyword!='')
          {
              var url = siteUrl+"spots/0-0-0-"+keyword+"-0";
              window.open(url,'_self');
          }
       /*   else
          {
              $("#mdd_box").focus();
          }*/
	   
	   })
		   
		   
     //获取目的地id
	  function getDestId(destname)
	  {
		  var destid = 0;
		  $.ajax({type:'POST',url:'/ajax/ajax.php',async:false,data:'dopost=getDestId&destname='+destname,success:function(data){
		     
			 destid=data;
		  
		  }})
		  return destid;
		  
	  }

})