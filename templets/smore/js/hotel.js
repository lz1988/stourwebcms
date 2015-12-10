// JavaScript Document
// JavaScript Document
var Hotel={
	
	   doSearch:function(){
	    
		  var attrid=$("#attrid").val();
		  var priceid=$("#priceid").val();
		  var destid=$("#destid").val();
		  var rankid = $("#rankid").val();
		  var sorttype = $("#sorttype").val();
          var pinyin = $("#pinyin").val();
		  var keyword = $("#keyword").val();
          pinyin = pinyin!='' ? pinyin : destid;
          pinyin = pinyin==0 ? 'all' : pinyin;
          keyword = keyword == '' ? '0' :keyword;

		  //var url = siteUrl+"hotels/search.php?dest_id="+destid+"&rankid="+rankid+"&priceid="+priceid+"&attrid="+attrid+"&sorttype="+sorttype;
          var url = siteUrl+"hotels/"+pinyin+'-'+rankid+'-'+priceid+'-'+sorttype+'-'+keyword+"-"+attrid;
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
	   
	   },
	   getHotelRoom:function(){
	   
	    var hotelid = $("#hotelid").val();
		
		$.ajax({
			type:'POST',
			url:'ajax.hotel.php',
			data:'dopost=gethotelroom_show&hotelid='+hotelid,
			success:function(data){
				
				$("#room_list").html(data);
			    Hotel.roomClickEvent();//酒店房型展开式隐藏
				Hotel.bookEvent();//预订功能
				
			}
			})
	
	  },
	  roomClickEvent:function(){
		
			  $(".h_title_a").unbind('click').click(function(){
				  $(this).parent().next().toggle();
			  });
			  
	  
	  },
	  bookEvent:function(){
	     $(".btn_hotel_book").unbind('click').click(function(){
		     var hotelid = $(this).attr('data-hotelid');
			 var roomid = $(this).attr('data-roomid');
			 var hotelname = $(this).attr('data-hotelname');
			 var FilesArray=['./stbox/st-box.js','./stbox/st-box.css']
			  Loader.loadFileList(FilesArray,function(){
			   BOX.getBox('','POST:'+siteUrl+'/hotels/hotel.calender.php?roomid='+roomid+'&hotelid='+hotelid,{dataType:'html',width:800,height:400,ismove:true,isFade:true,isButton:false,title:hotelname+'预订'})

		 });
		 
		 })
          //图片显示
          var FilesArray2=['./fancybox/jquery.fancybox-1.3.4.js','./fancybox/jquery.fancybox-1.3.4.css'];
          Loader.loadFileList(FilesArray2,function(){
              $("a[rel=group]").fancybox({
                  'transitionIn'	:	'elastic',
                  'transitionOut'	:	'elastic',
                  'speedIn'		:	600,
                  'speedOut'		:	200,
                  'cyclic'        :   true,
                  'overlayShow'	:	false,
                  'titlePosition' :'over',
                  'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
                      return '<span id="fancybox-title-over">图片：' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
                  }

              });

          });
	  
	  }


	
	};



//show页面
Hotel.Show={
    
	
	getHotelMap:function(){
	  
	  var hotelname=$("#hotelmap").attr('hotelname');
	  var address=$("#hotelmap").attr('address');
	  var url="hotel.map.php?hotelname=" + encodeURIComponent(hotelname) + "&address=" + encodeURIComponent(address);
	  $("#hotelmap").attr('src',url);
	},
	showRoomPic:function(roomid){
		$("#room_pic_"+roomid).toggle();
	},
	
	getDistance:function(city1,city2,obj){
		
	  
	   
	   var myGeocoder = new BMap.Geocoder();  
       var dis= myGeocoder.getPoint(city1, function(point1){  
           myGeocoder.getPoint(city2, function(point2){  
			  /* 
				* 在页面增加临时div,用来解决map初始化的问题,因为要用到Map类的getDistance方法， 
				* 而百度地图API的Map类的初始化必须要有一个容器 
				*/  
          var bufDiv = document.createElement("div");  
          document.body.appendChild(bufDiv);  
          bufDiv.setAttribute("id","mapContainer");  
          bufDiv.setAttribute("style","display:none");  
          
          var map=new BMap.Map('mapContainer');  
          map.centerAndZoom("内蒙古",12);  
          var distance=map.getDistance(point1,point2);  
          var distanceBuf = (distance/1000).toFixed(1).split(".");  
          var mileage = distanceBuf[0] +"."+distanceBuf[1];  
           var a=document.getElementById("mapContainer");  
           a.parentNode.removeChild(a);  
		   var dis="距离约"+mileage+"公里";
		   $(obj).html(dis);
		  
		   

		   });
		})
		  //alert(dis);
		//return dis;
	
	}
}