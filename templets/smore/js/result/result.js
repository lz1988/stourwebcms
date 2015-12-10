// JavaScript Document
(function($){
	$.fn.Result = function(options) {
		var defaults = {			
			showHeight : 150,
			showWidth : 150,
			url : 'ajax_public.php',
			data : 'getStart',
			minChars : 1,
			autoFill : false,
			maxItemsToShow : 10,
			extraParams : {},
			delay : 100,
			selectOnly : false,
			selectFirst : false
		};
		var options = $.extend(defaults,options);
		
		var rethis = null;
		
		var hasFocus = false;
		
		var _lastPressCode = null;
		
		var timeout = null;
		
		var prev = "";
		
		var _div = document.createElement("div");
		var $_div = $(_div);
		
		function _initialize(obj)
		{
			
			createResultDiv();
			$(obj)
			.keyup(function(e) {
				_lastPressCode = e.keyCode;
				switch(e.keyCode) {
					case 38: // up
						e.preventDefault();
						moveSelect(-1);
						getValue();
						break;
					case 40: // down
						e.preventDefault();
						moveSelect(1);
						getValue();
						break;
					case 9:  // tab
					case 13: // return
						if( _selectCurrent(obj) ){
							$(rethis).get(0).blur();
							e.preventDefault();
						}
						break;
					default:
						active = -1;
						
						if (timeout) clearTimeout(timeout);
						timeout = setTimeout(function(){_onChange(obj);}, options.delay);
						break;
				}
			})
			.focus(function(){
				hasFocus = true;
			})
			.blur(function() {
				hasFocus = false;
				_hideDiv();
			});
			
			_hideDivNow();
		};
		
		function createResultDiv()
		{
			$_div.hide().css({"position":"absolute",/*"height":options.showHeight,*/"z-index":"99"})
			$_div.addClass('result');
			$("body").append(_div);
		}
		
		function _onChange(obj) 
		{
			var v = $(obj).val();

			if (v == prev) return;
			prev = v;
			if (v.length >= options.minChars) {
				//$(rethis).addClass(options.loadingClass);
				getResult(v,obj);
			} else {
				//$(rethis).removeClass(options.loadingClass);
				$_div.hide();
			}
		};
		
		function _selectCurrent(obj) 
		{
			var li = $("li.over", _div)[0];
			if (!li)
			{
				var $li = $("li", _div);
				if (options.selectOnly) {
					if ($li.length == 1) li = $li[0];
				} 
				else if (options.selectFirst) 
				{
					li = $li[0];
				}
			}
			if (li) 
			{
				selectItem(li,obj);
				return true;
			} 
			else 
			{
				return false;
			}
		};
		
		function getValue() 
		{
			var li = $("li.over", _div)[0];
			if (!li) 
			{
				var $li = $("li", _div);
				if (options.selectOnly) 
				{
					if ($li.length == 1) li = $li[0];
				} 
				else if (options.selectFirst) 
				{
					li = $li[0];
				}
			}
			if (li) 
			{
				getVal(li,obj);
				return true;
			} 
			else 
			{
				return false;
			}
		};
		
		function getVal(li,obj) 
		{
			if (!li) 
			{
				li = document.createElement("li");
				li.extra = [];
				li.selectValue = "";
			}
			var v = $.trim(li.selectValue ? li.selectValue : li.innerHTML);
			v = v.replace('<b>','');
			v = v.replace('</b>','');
			
			$(obj).val(v);
			if (options.onItemSelect) setTimeout(function() { options.onItemSelect(li) }, 1);
		};
		
		function moveSelect(step) 
		{
			
			var lis = $("li", _div);
			if (!lis) return;
	
			active += step;
	
			if (active < 0) {
				active = 0;
			} else if (active >= lis.size()) {
				active = lis.size() - 1;
			}
			
			lis.removeClass("over");
	
			$(lis[active]).addClass("over");
	
		};
		
		function findPos(obj) 
		{
			var curleft = $(obj).offset().left;
			var curtop = $(obj).offset().top;
			var width = parseInt($(obj).width());
			var height = parseInt(curtop)+parseInt($(obj).height())+2;
			return {x:curleft,y:height,w:width};
		}
		
		function _showDiv(obj) {
			var pos = findPos(obj);
			var iWidths = (pos.w > 0) ? pos.w : options.showWidth;
			$_div.css({
				width: parseInt(iWidths) + "px",
				top: pos.y + "px",
				left: pos.x + "px"
			}).show();
		};
		
		function _hideDiv() 
		{
			if (timeout) clearTimeout(timeout);
			timeout = setTimeout(_hideDivNow, 200);
		};
	
		function _hideDivNow() {
			if (timeout) clearTimeout(timeout);
			//$(rethis).removeClass(options.loadingClass);
			if ($_div.is(":visible")) {
				$_div.hide();
			}
		};
		
		function receiveData(keyword, data,obj) 
		{
			if (data) 
			{
				//$(rethis).removeClass(options.loadingClass);
				_div.innerHTML = "";
				
				if( !hasFocus || data.length == 0 ) return _hideDivNow();
	
				/*if ($.browser.msie) 
				{
					$_div.append(document.createElement('iframe'));
				}*/
				_div.appendChild(createDom(data,obj));
				
				if( options.autoFill && ($(obj).val().toLowerCase() == keyword.toLowerCase()) ) autoFill(data[0][0]);
				_showDiv(obj);
			} 
			else 
			{
				_hideDivNow(obj);
			}
		};
		
		function parseData(data) 
		{
			if (!data) return null;
			var parsed = [];
			var rows = data.split(',');
			for (var i=0; i < rows.length; i++) {
				var row = $.trim(rows[i]);
				if (row) {
					parsed[parsed.length] = row.split('|');
				}
			}
			return parsed;
		};
	
		function createDom(data,obj) 
		{
			var ul = document.createElement("ul");
			var num = data.length;
			
			if( (options.maxItemsToShow > 0) && (options.maxItemsToShow < num) ) num = options.maxItemsToShow;
	
			for (var i=0; i < num; i++) 
			{
				var row = data[i];
				if (!row) continue;
				var li = document.createElement("li");
				// options.formatItem 外部定义显示样式
				if (options.formatItem) 
				{
					li.innerHTML = options.formatItem(row, i, num);
					li.selectValue = row[0];
				} 
				else 
				{
					li.innerHTML = row[0];
					li.selectValue = row[0];
				}
				var extra = null;
				if (row.length > 1) 
				{
					extra = [];
					for (var j=1; j < row.length; j++) 
					{
						extra[extra.length] = row[j];
					}
				}
				li.extra = extra;
				ul.appendChild(li);
				$(li).hover(function() { 
					//$("li", ul).removeClass("over"); 
					$(this).addClass("over"); 
					//active = $("li", ul).indexOf($(this).get(0)); 
				},function() { $(this).removeClass("over"); }
				).click(function(e) { e.preventDefault(); e.stopPropagation(); selectItem(this,obj) });
			}
			return ul;
		};
		
		function selectItem(li,obj) {
			if (!li) {
				li = document.createElement("li");
				li.extra = [];
				li.selectValue = "";
			}
			var v = $.trim(li.selectValue ? li.selectValue : li.innerHTML);
			v = v.replace('<b>','');
			v = v.replace('</b>','');
			$_div.html("");
			$(obj).val(v);
			_hideDivNow();
			// options.onItemSelect 外部定义选中后的事件
			if (options.onItemSelect) setTimeout(function() { options.onItemSelect(li) }, 1);
		};
	
		function getResult(keyword,obj) 
		{
			if( (typeof options.url == "string") && (options.url.length > 0) )
			{
				$.get(makeUrl(keyword), function(data) {
					data = parseData(data);
					receiveData(keyword, data,obj);
				});
			} 
			else 
			{
				//$(rethis).removeClass(options.loadingClass);
			}
		};
	
		function makeUrl(keyword) {
			var url = options.url + "?dopost="+options.data+"&keyword=" + escape(keyword);
			for (var i in options.extraParams) {
				url += "&" + i + "=" + escape(options.extraParams[i]);
			}
			return url;
		};
		
		function autoFill(sValue)
		{
			if( _lastPressCode != 8 )
			{
				$(rethis).val($input.val() + sValue.substring(prev.length));
				createSelection(prev.length, sValue.length);
			}
		};
		
		function createSelection(start, end)
		{
			var field = $(this).get(0);
			if( field.createTextRange )
			{
				var selRange = field.createTextRange();
				selRange.collapse(true);
				selRange.moveStart("character", start);
				selRange.moveEnd("character", end);
				selRange.select();
			} 
			else if( field.setSelectionRange )
			{
				field.setSelectionRange(start, end);
			} 
			else 
			{
				if( field.selectionStart )
				{
					field.selectionStart = start;
					field.selectionEnd = end;
				}
			}
			field.focus();
		};
		
		return this.each(function(){_initialize(this)});
	};
})(jQuery);