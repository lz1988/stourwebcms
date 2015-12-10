// JavaScript Document
 $(function(){
	  
	 
	
	 countTotal();
	 
	 //选择新的预订时间
	 
	 $(".add").click(function(){
	 
	    getCalendar();
	 })

     //使用积分
     if($("#jifenchoose").length>0){
         $("#jifenchoose").click(function(){
             var status = $(this).attr('checked');
             if(status=='checked'){
                 $("#usejifen").val(1);
             }
             else{
                 $("#usejifen").val(0);
             }
             countTotal();
         })
     }
	
	 
  	//表单验证

	 $("#dingfrm").validate({ 
			
			  
			 submitHandler:function(form){  
               // alert("submitted"); 
				combineData();//生成需要数据 
				var flag = ST.User.isLogin();
				
				if(flag == 0)
				{
				   ST.User.showLogin(function(){ 
				    var param=$("#dingfrm").serialize();
					bookSubmit(param,"?dopost=savebooking");
					BOX.getBoxClose();
					})	
				} 
				else
				{
				    var param=$("#dingfrm").serialize();

                    bookSubmit(param,"?dopost=savebooking");

				}
               // form.submit();  
				return false;
				
             } ,     
			  
			  rules: { 

				  dingnum: { 
				   required: true
				  }
				  /*linkman:{
				   required: true
				  },
				  linktel:{
				   required: true
				  }*/
				 
				}, 
				messages: { 
				  
				   dingnum:{
				    required:"请填写数量"
						
				   }/*,
				   linkman:{
				    required:"请填写联系人信息"
					
				   },
				   linktel:{
					required:"请填写联系电话"
				   }*/
				 
				}

				
	     });


})
  //计算总金额
  function countTotal()
  {


	  var total = 0;
	  var price_arr = $(".d_price");
	  price_arr.each(function(index,ele){
	      var text=$(ele).text();
		  var price=text.match(/[0-9]+/);
	      total+=window.parseFloat(price);
	  })
      var minusprice = $("#jifentprice").val();
      var usejifen = $("#usejifen").val();

      if(usejifen == 1){

          total = total-minusprice;
      }
	  $('.totalprice').html(total);
	  
	  
  }
  //删除预订时间
  function deltr(obj){
     
	 
	    $(obj).parents('.u_info_list').remove();
	
  
  }
  //重新输入间数
  function roomnumChange(obj)
  {
	    var price = $(obj).attr('rel');
		 var total = "&yen;" + $(obj).val()*price+"元";
		 
	    $(obj).parent().next('.d_price').html(total);
		countTotal();  
  }
  
  //重新选择
  function getCalendar()
  {
	         var hotelid = $("#productautoid").val();
			 var roomid = $("#suitid").val();
			 var hotelname = $("#productname").val();
			 var FilesArray=['./stbox/st-box.js','./stbox/st-box.css']
			  Loader.loadFileList(FilesArray,function(){
			   BOX.getBox('','POST:'+siteUrl+'/hotels/hotel.calender.php?roomid='+roomid+'&hotelid='+hotelid+'&bookpage=1',{dataType:'html',width:800,height:400,ismove:true,isFade:true,isButton:false,title:hotelname+'预订'})
		 });
	  
  }
  //分析处理数量
  function combineData()
  {
	 var udateArr =[];
	 var dnumArr = [];
	 var dpriceArr = [];
	
	 $(".u_info_list").each(function(){
	     var ddate = $(this).attr('data-dingdate');
		 var dnum = $(this).find('.d_num').val();
		 var dprice = $(this).attr('data-dingprice');//报价
		 udateArr.push(ddate);
		 dnumArr.push(dnum);
		 dpriceArr.push(dprice);
	 })
	 
	 var udate=udateArr.join('|');
	 var dnum = dnumArr.join('|');
	 var dprice = dpriceArr.join('|');
	 $("#udate").val(udate);
	 $("#dnum").val(dnum);
	 $("#dprice").val(dprice);
	 
	  
  }