// JavaScript Document
var ST={};

 ST.Browser={
	ie:/msie/.test(window.navigator.userAgent.toLowerCase()),
	moz:/gecko/.test(window.navigator.userAgent.toLowerCase()),
	opera:/opera/.test(window.navigator.userAgent.toLowerCase()),
	safari:/safari/.test(window.navigator.userAgent.toLowerCase())
 };

ST.log=function(msg){
  console.log(msg);

}
 
 ST.Util = {
		    isEmptyObject: function(obj) {  
                for (var prop in obj) {  
                    return false;  
                }  
                return true;  
            },  
            toArray: function(arrLike) {  
                return Array.prototype.slice(arrLike);  
            },  
            // browsers..  
            isIE: function() {  
                return !-[1,];


            },
			
			openWin:function(url){
				
                window.open(url);

			},
			getNextDate:function(date1)
			{
				
				var arrDate=date1.split("-");
			
			    objDate1=new Date(arrDate[0],arrDate[1]-1,arrDate[2]);
				
                var tomo = new   Date((objDate1/1000+86400*1)*1000);
                var tYear = tomo.getFullYear();
                var tMonth = tomo.getMonth()+1; 
                var tDay = tomo.getDate(); 
				var outDate= tYear+"-"+tMonth+"-"+tDay;
				return outDate;
			},
			
		    dateDiff: function(sDate1,sDate2){  
	
            var arrDate,arrdate2,objDate1,objDate2,intDays;
			arrDate=sDate1.split("-");
			
			objDate1=new Date(arrDate[0],arrDate[1]-1,arrDate[2]);
			
			var arrDate2=sDate2.split("-");
			//objDate2=new Date(arrDate[1] + '-'+arrDate[2]+'-'+arrDate[0]);
			objDate2=new Date(arrDate2[0],arrDate2[1]-1,arrDate2[2]);
		   
			intDays=Number(Math.abs(objDate1-objDate2)/1000/60/60/24);

			return intDays; 
            }, 
		    copyUrl:function(){
				
			  var clipBoardContent="";
              clipBoardContent+=document.location.href;
              window.clipboardData.setData("Text",clipBoardContent);
              alert("复制成功，请粘贴到你的QQ/MSN上推荐给你的好友");
			
			},
			addFavourite:function(sTitle){
				   try{
                    window.external.addFavorite(window.location.href, sTitle);
                   }

                  catch (e){
					  try{
						 window.sidebar.addPanel(sTitle, window.location.href, "");
						}
					  catch (e)
					   {
						 alert("加入收藏失败，请使用Ctrl+D进行添加");
					   }

                 }
			},
			createFade:function(){
			  $('body').append('<div class="fade"></div>');
			  //$('.fade').css({width: windowWidth + 17, height: windowHeight + scrollTop});
			  $('.fade').fadeIn();
			
			},
			closeFade:function(){
			  $('.fade').remove(); 
			}
		  }

ST.jsRoot='/templets/smore/js/';

var classcodes =[];
window.Loader={
    /*加载一批文件，_files:文件路径数组,可包括js,css,less文件,succes:加载成功回调函数*/
    loadFileList:function(_files,succes){
        var FileArray=[];
        if(typeof _files==="object"){
            FileArray=_files;
        }else{
            /*如果文件列表是字符串，则用,切分成数组*/
            if(typeof _files==="string"){
                FileArray=_files.split(",");
            }
        }
        if(FileArray!=null && FileArray.length>0){
            var LoadedCount=0;
            for(var i=0;i< FileArray.length;i++){
				var sUrl = ST.jsRoot+FileArray[i];
                loadFile(sUrl,function(){
                    LoadedCount++;
                    if(LoadedCount==FileArray.length){
                        succes();
                    }
                })
            }
        }
        /*加载JS文件,url:文件路径,success:加载成功回调函数*/
        function loadFile(url, success) {
            if (!fileIsExt(classcodes,url)) {
                var ThisType=getFileType(url);
                var fileObj=null;
                if(ThisType==".js"){
                    fileObj=document.createElement('script');
                    fileObj.src = url;
                }else if(ThisType==".css"){
                    fileObj=document.createElement('link');
                    fileObj.href = url;
                    fileObj.type = "text/css";
                    fileObj.rel="stylesheet";
                }else if(ThisType==".less"){
                    fileObj=document.createElement('link');
                    fileObj.href = url;
                    fileObj.type = "text/css";
                    fileObj.rel="stylesheet/less";
                }
                success = success || function(){};
                fileObj.onload = fileObj.onreadystatechange = function() {
                    if (!this.readyState || 'loaded' === this.readyState || 'complete' === this.readyState) {
                        success();
                        classcodes.push(url)
                    }
                }
                document.getElementsByTagName('head')[0].appendChild(fileObj);
            }else{
                success();
            }
        }
        /*获取文件类型,后缀名，小写*/
        function getFileType(url){
            if(url!=null && url.length>0){
                return url.substr(url.lastIndexOf(".")).toLowerCase();
            }
            return "";
        }
        /*文件是否已加载*/
        function fileIsExt(FileArray,_url){
            if(FileArray!=null && FileArray.length>0){
                var len =FileArray.length;
                for (var i = 0; i < len; i++) {
                    if (FileArray[i] ==_url) {
                       return true;
                    }
                }
            }
            return false;
        }
    }
}

  
  
 
$.STOURWEB = {
	hover_tag : function(control, show, class1) {
		$(control + "> a").hover(function() {
			var c = $(control + "> a").index($(this));

			$(this).addClass(class1).siblings().removeClass(class1);
			$(show + "> div").eq(c).show().siblings().hide();
		})
	},
	click_tag : function(control, show, class1) {
		$(control + "> a").click(function() {
			var c = $(control + "> a").index($(this));

			$(this).addClass(class1).siblings().removeClass(class1);
			$(show + "> div").eq(c).show().siblings().hide();
		})
	},
	//指向li
	hover_tag_li : function(control, show, class1) {
		var time = null;
		$(control + " li").hover(function() {
			if($(this).hasClass('more')){
				clearTimeout(time);
				var c = $(control + " li").index($(this));
				$(this).addClass(class1).siblings().removeClass(class1);
				$(show).show();
				$(show + " .hide_box").eq(c).show().siblings().hide();
			}
		},function(){
			if($(this).hasClass('more')){
				time = setTimeout(function(){
			        $(control + " li").removeClass(class1);
					$(show + " .hide_box").hide();
		    		$(show).hide();
		    	},200);
	    	}
		});
		$(show).hover(function(){
		    clearTimeout(time);
		    $(this).show();
		    },function(){
		    time = setTimeout(function(){
		        $(show + " .hide_box").hide();
		        $(control + " li").removeClass(class1);
	    		$(show).hide();
		    },200);
		});

	},
	hover_show : function(control, hideBox) {
		$(control).hoverDelay(function() {
			$(this).find(hideBox).show();
		}, function() {
			$(this).find(hideBox).hide();
		},0,100)
	},
	hover_class : function(control, class1) {
		$(control).hover(function() {
			$(this).addClass(class1)
		}, function() {
			$(this).removeClass(class1)
		})
	},
	hover_class_show : function(control, hoverBox, class1, hideBox) {
		$(control).hover(function() {
			$(this).find(hoverBox).addClass(class1);
			$(this).find(hideBox).show();
		}, function() {
			$(this).find(hoverBox).removelass(class1);
			$(this).find(hideBox).hide();
		})
	},
	hover_load : function(control, hover, class1) {
		$(control).on("mouseenter", hover, function() {
			$(this).addClass(class1);
		})
		$(control).on("mouseleave", hover, function() {
			$(this).removeClass(class1);
		})
	},
	search_item_selected:function(contain,tag,realvalue,class1){
			  
			 $(contain).find(tag).each(function(){

				var datavalue = $(this).attr('data-value');
				$(this).removeClass(class1);
				if(datavalue == realvalue) {
					$(this).addClass(class1)
				}
			
			})
		  
	},
	search_attr_selected:function(contain,tag,realvalue,class1){
	     $(contain).each(function(){
			   $(this).find(tag).each(function(){
			        var datavalue = $(this).attr('data-value');
					
					if(datavalue == realvalue && realvalue!=0) {
						$(this).parent().prev().find('a').removeClass(class1);
						$(this).addClass(class1)
					}
			   
			   })
		        
		 
		 })
	
	}
	
}
// 输入框焦点事件
$.fn.focusEffect = function() {
	var $input = this;
	
	$input.focus(function() {
		
		if ($(this).val() == '' || $(this).val() == $(this).attr('datadef')) {
			$(this).val('');
			$(this).css({
				color : '#333'
			})
		}
	});
	$input.blur(function() {
		//alert($(this).attr('id'));
		if ($(this).val() == '') {
			
			$(this).val($(this).attr('datadef'));
			$(this).css({
				color : '#aaa'
			})
		}
	})
}
//hover延迟插件

$.fn.hoverDelay = function(fnOver, fnOut,timeIn,timeOut) {

			var timeIn = timeIn || 200,
				timeOut = timeOut || 200,
				fnOut = fnOut || fnOver;

			var inTimer = [],outTimer=[];
			
		return this.each(function(i) {
			$(this).mouseenter(function() {
					var that = this;
					clearTimeout(outTimer[i]);
					inTimer[i] = setTimeout(function() {
						fnOver.apply(that);
					}, timeIn);
			  }).mouseleave( function() {
					var that = this;
					clearTimeout(inTimer[i]);
					outTimer[i] = setTimeout(function() {
						fnOut.apply(that)
					}, timeOut);
			 });
	})
}
//用户公共函数
 ST.User={
	getUser:function(){ 
		 var url=siteUrl+'ajax/ajax_login.php?dopost=getUser';
		 var user;
	      $.ajax({type:'POST',dataType:'json',url:url,async:false,success:function(data){
	            if(data['status']==0)
				  user=0;
                else 
				   user=data;
	       }});
		    return user;
	      },
    isLogin:function(){
	   
	 var flag=0;
	 
	 var url=siteUrl+'ajax/ajax_login.php?dopost=checkLogin';
	 $.ajax({type:'POST',url:url,async:false,success:function(data){
	 
	      flag=data;
	   }
	
	 });
	 
	 return flag;

	},
	//ajax登陆
	ajaxLogin:function(){
	   var flag=0;
	   var uname=$("#loginname").val();
	   var pwd=$("#password").val();
	   var url=siteUrl+'ajax/ajax_login.php?dopost=ajaxLogin&uname='+uname+"&pwd="+pwd;
	   $.ajax({type:'POST',url:url,async:false,dataType:'json',success:function(data){
		   
		      if(!data.status){
		      alert('用户名或者密码错误');
			  
		   }else{
			   
			  BOX.userFunc();//成功调用函数.
			 // flag=1;
		   }
	 
	   }
	   });
	   return flag;
	
	},
	//ajax注册
	ajaxReg:function(){
	    
		var mobile=$("#mobile").val();
		var flag=0;
		if((/^1[3|4|5|8][0-9]\d{8}$/.test(mobile))){
			
		 var url=siteUrl+'ajax/ajax_login.php?dopost=ajaxReg&mobile='+mobile;
		
	     $.ajax({type:'POST',url:url,async:false,dataType:'json',success:function(data){
			  
			   if(data.status=='hasReg'){
			      alert("此手机号码已经注册,可以直接登陆!");
				  flag=0;
			   }else{
			      //flag=data.status;
				  BOX.userFunc();//成功调用函数.
				 	
			   }
			   
			 }})
	

		}
		else{
		  alert('请填写正确的手机号码');
		  return false;
		}
	
		return flag;
	
	},
	showLogin:function(fcallback){
	    var FilesArray=['./stbox/st-box.js','./stbox/st-box.css']
        Loader.loadFileList(FilesArray,function(){
	     BOX.getBox('','POST:'+siteUrl+'ajax/ajax_login.php?dopost=getloginbox',{dataType:'html',width:700,height:300,ismove:true,isFade:true,isButton:false,title:'用户登陆',userFunc:fcallback})
   });
	
	
	}
  
  
  }

  
function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function in_array(needle, haystack) {
	if(typeof needle == 'string' || typeof needle == 'number') {
		for(var i in haystack) {
			if(haystack[i] == needle) {
					return true;
			}
		}
	}
	return false;
}

function trim(str) {
	return (str + '').replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}

function strlen(str) {
	return (ST.Browser.ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length : str.length;
}

function mb_strlen(str) {
	var len = 0;
	for(var i = 0; i < str.length; i++) {
		len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
	}
	return len;
}

function mb_cutstr(str, maxlen, dot) {
	var len = 0;
	var ret = '';
	var dot = !dot ? '...' : dot;
	maxlen = maxlen - dot.length;
	for(var i = 0; i < str.length; i++) {
		len += str.charCodeAt(i) < 0 || str.charCodeAt(i) > 255 ? (charset == 'utf-8' ? 3 : 2) : 1;
		if(len > maxlen) {
			ret += dot;
			break;
		}
		ret += str.substr(i, 1);
	}
	return ret;
}

function preg_replace(search, replace, str, regswitch) {
	var regswitch = !regswitch ? 'ig' : regswitch;
	var len = search.length;
	for(var i = 0; i < len; i++) {
		re = new RegExp(search[i], regswitch);
		str = str.replace(re, typeof replace == 'string' ? replace : (replace[i] ? replace[i] : replace[0]));
	}
	return str;
}

function htmlspecialchars(str) {
	return preg_replace(['&', '<', '>', '"'], ['&amp;', '&lt;', '&gt;', '&quot;'], str);
}
function nav_on(name){
	$('#nav_'+name).addClass('header-nav-item-selected');
}
 
  //JS数组删除元素方法

   Array.prototype.remove = function(val)
  {
            var index = this.indexOf(val);
            if (index > -1)
			{
                this.splice(index, 1);
            }
  };
  String.prototype.isempty=function(){
      if(this==''){
		  return true
	  }
	  else{
		  return false;
	  }
  
  }
  
