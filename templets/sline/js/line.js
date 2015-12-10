// JavaScript Document
var Line={
	   doSearch:function(){
	      //var destid = $("#dest_id").val();
		  //var attrid = $("#attrid").val();
		  //var priceid = $("#priceid").val();
		 // var day = $("#day").val();
		  var attrid=$("#attrid").val();
		  var priceid=$("#priceid").val();
		  var destid=$("#destid").val();
		  var day = $("#day").val();
		  var sorttype = $("#sorttype").val();
          var keyword = $("#keyword").val();
          var pinyin = $("#pinyin").val();
          var startcity = $("#startcity").val();
          keyword = keyword == '请输入目的地或线路名称' ? 0 : keyword;
          keyword = keyword==''  ? 0 : keyword;
          pinyin = pinyin=='' ? destid : pinyin;
          pinyin = pinyin==0 ? 'all' : pinyin;


          var url = childUrl+"lines/"+pinyin+"-0-0-"+day+"-"+priceid+"-"+sorttype+"-"+keyword+'-'+startcity+'-'+attrid;
		  //var url = siteUrl+"lines/search.php?dest_id="+destid+"&day="+day+"&priceid="+priceid+"&attrid="+attrid+"&sorttype="+sorttype;
		  window.open(url,'_self');
	   
	   },
	   setAttrValue:function(obj){
	      $(obj).parents('dd').first().find('a').removeClass('on');
		  $(obj).addClass('on');
		  var attrid = '';
		  $('.attr_list').each(function(){
		    
			  $(this).find('.on').each(function(){
			    
		      attrid += $(this).attr('data-value')+',';
		  })
		  
		  })
		  attrid=attrid.substring(0,attrid.length-1);
		  $("#attrid").val(attrid);
	   
	   }
	
	
	}
//预订

Line.Booking={
	
   checkLogin:function(){

		//如果没有登陆显示登陆窗口
        var flag=ST.User.isLogin();
		
		if(flag==0){
		
		   this.showLogin();

		}else{
		
		   this.submitForm();
		}
		
		
   
   },
   submitForm:function(){
	   
	   document.dingfrm.submit();
	    
   },
   ajaxLogin:function(){

	 
	   if(ST.User.ajaxLogin()){
		   
	      this.submitForm();
	   
	   }
   },
   ajaxReg:function(){
      if(ST.User.ajaxReg()){
	     this.submitForm();
	  }
   
   },
    showLogin:function(){
	    var FilesArray=['./stbox/st-box.js','./stbox/st-box.css']
        Loader.loadFileList(FilesArray,function(){
	     BOX.getBox('','POST:'+siteUrl+'/ajax/ajax_login.php?dopost=getloginbox&type=Hotel',{dataType:'html',width:630,height:300,ismove:true,isFade:true,isButton:false,title:'用户登陆'})
   });
	
	
	}
   
   
 


}

