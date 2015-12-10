var BOX = {
	lastId: 0,
	userFunc:{},
	isIE: document.all ? true : false,
	getEvent: function() {//ie/ff
		if (document.all) {
			return window.event;
		}
		func = getEvent.caller;
		while (func != null) {
			var arg0 = func.arguments[0];
			if (arg0) {
				if ((arg0.constructor == Event || arg0.constructor == MouseEvent) || (typeof (arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
					return arg0;
				}
			}
			func = func.caller;
		}
		return null;
	},
	getMousePos: function(ev) {
		if (!ev) {
			ev = this.getEvent();
		}
		if (ev.pageX || ev.pageY) {
			return {
				x: ev.pageX,
				y: ev.pageY
			};
		}
		if (document.documentElement && document.documentElement.scrollTop) {
			return {
				x: ev.clientX + document.documentElement.scrollLeft - document.documentElement.clientLeft,
				y: ev.clientY + document.documentElement.scrollTop - document.documentElement.clientTop
			};
		}
		else if (document.body) {
			return {
				x: ev.clientX + document.body.scrollLeft - document.body.clientLeft,
				y: ev.clientY + document.body.scrollTop - document.body.clientTop
			};
		}
	},
	getBox: function(obj, content, options){
		var config = {
			title: 'Box',
			width: 300,
			height: 100,
			top: '',
			innerHTML: '加载...',
			num: '',
			dataType: 'json',
			infoData: {},
			model: '',
			lastId: 0,
			ismove: false,
			moveable: null,
			isFade: false,
			isButton: true,
			userFunc:function(){}
		}
		var options = $.extend(config, options)
		    BOX.userFunc = options.userFunc;
			data = {url: '', type: '', html: ''},
			offset = '',
			errorHTML = '<div style="padding-top:50px;padding-bottom:50px;text-align:center;">加载失败...</div>',
			id = Math.floor(Math.random() * 1000000),
			windowHeight = document.documentElement.clientHeight || document.body.clientHeight || 0,
			windowWidth = document.documentElement.clientWidth || document.body.clientWidth || 0,
			scrollTop = document.body.scrollTop ||  document.documentElement.scrollTop;
		$('#ST' + BOX.lastId).remove();
		var tempContent = content.toLowerCase();
		if (tempContent.indexOf('id:') == 0) data.type = 'ID';
		else if (tempContent.indexOf('get:') == 0) data.type = 'GET';
		else if (tempContent.indexOf('post:') == 0) data.type = 'POST';
		else if (tempContent.indexOf('html:') == 0) data.type = 'HTML';
		else { content = 'html:' + content; data.type = 'HTML'; }
		content = content.substring(content.indexOf(":") + 1, content.length);
		
		var box = $('<div class="product" id="ST' + id + '"></div>').hide(),
			boxTitle = $('<h3>' + options.title + '<a href="javascript:;" id="close">X</a></h3>'),
			boxInner = $('<div class="product-con clearfix"></div>'),
			boxBottom = $('<div class="product-submit"><input type="button" class="btn" id="postBtn" name="btn" value="点击提交" /></div>');
		boxTitle.appendTo(box);
		boxInner.appendTo(box);
		options.isButton ? boxBottom.appendTo(box) : '';
		boxInner.css({height: options.height});

		
		switch (data.type) {
			case "ID":
				data.html = $('#' + content).html();
				break;
			case "GET":
			case "POST":
				data.html = '';
				data.url = content;
				break;
			case "HTML":
				data.html = content;
				break;
			default:
				data.html = options.innerHTML;
		}
		
		switch (data.type) {
			case "GET":
			case "POST":
				if(options.dataType == 'json'){
					$.getJSON( data.url, {num: options.num, model: options.model}, function(json){
						if(json.done){
							boxInner.html(json.info);
						}else{
							boxInner.html(errorHTML);
						}
					});
				}else if(options.dataType == 'html'){
					$.ajax({
						type: data.type,
						url:  data.url,
						data: options.infoData,
						dataType: 'html',
						cache: false,
						success: function (data) {

							boxInner.html(data);
						},
						error: function () {
							boxInner.html(errorHTML);
						}
					});
				}
				break;
			default:
				boxInner.html(data.html);
				break;
		}

		
		options.height == '' ? 0 : options.height;
		if(!obj){
			var oLeft = (windowWidth - options.width)/2,
				oTop = (windowHeight  - (options.height + 95))/2 + scrollTop;
			offset = {left: oLeft, top: oTop};
			
		}else{
			offset = $(obj).offset();
		}
		
		box.css({top: options.top ? options.top : offset.top, left: offset.left, width: options.width});
		BOX.isIE ? box.css('border', '1px solid #e8e8e8') : '';
		if(options.isFade){
			$('body').append('<div class="fade"></div>');
			$('.fade').css({width: windowWidth + 17, height: windowHeight + scrollTop});
            $('.fade').css({filter: 'alpha(opacity=30)'});
			$('.fade').fadeIn();
		}
		$('body').append(box);
		//$('body').attr('style', 'overflow:hidden');
		box.fadeIn();
		
		BOX.lastId = id;
		
		//moveable
		if(options.ismove){
			boxTitle.bind('mousedown', function(e){
				options.moveable = true;
				var Obj = box;
				var ev = e || window.event || ST.dom.getEvent();
				var mousePos = BOX.getMousePos(ev),
					tmpX = mousePos.x - Obj.offset().left,
					tmpY = BOX.isIE ? mousePos.y - scrollTop - Obj.offset().top : mousePos.y - Obj.offset().top,
					limitArea = { 
						maxLeft: 0, 
						maxRight: windowWidth + 17 - Obj.width() - 2, 
						maxTop: scrollTop, 
						maxBottom: windowHeight + scrollTop - Obj.height() - 2 
					};
				
				if (BOX.isIE && ev.button == 1 || !BOX.isIE && ev.button == 0) {
				}else {
					return false;
				}
				Obj.css({'cursor': 'move', 'opacity': 0.7});
				
				//FireFox 去除容器内拖拽图片问题
				if (ev.preventDefault) {
					ev.preventDefault();
					ev.stopPropagation();
				}
				
				document.onmousemove = function(e){
					if(options.moveable){
						var ev = e || window.event || BOX.getEvent();
						//IE 去除容器内拖拽图片问题
						if (BOX.isIE) //IE
						{
							ev.returnValue = false;
						}
		
						var movePos = BOX.getMousePos(ev);
						var moveLeft = Math.max(Math.min(movePos.x - tmpX, limitArea.maxRight), limitArea.maxLeft);
						var moveTop = Math.max(Math.min(movePos.y - tmpY, limitArea.maxBottom), limitArea.maxTop);
						Obj.css({left: moveLeft, top: moveTop});
					}
				};
				document.onmouseup = function(e) {
					if(options.moveable){
						if (BOX.isIE) {
							Obj[0].releaseCapture();
						}else {
							window.releaseEvents(Event.MOUSEMOVE);
						}
						Obj.css({'cursor': 'default', 'opacity': 1});
						options.moveable = false;
					}
				};
			});
		}
		//close
		$('#close').click(function(){
			
			$('body').attr('style', '');
			box.remove();
			$('.fade').remove();
			
		});
		
		//event
		options.isButton ? $('#postBtn').click(options.backEvent) : '';
	},
	getBoxClose: function(){
			$('body').attr('style', '');
			$('#ST' + BOX.lastId).remove();
			$('.fade').remove();
		 
	}
}