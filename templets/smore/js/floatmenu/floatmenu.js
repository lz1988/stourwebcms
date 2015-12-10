(function($){
	$.floatMenu = function(options) {
		var defaults = {			
			menuContain : '#tab_nav',
			tabItem : 'a',
			chooseClass : 'current',
			contentContain : '.sectionBox',
			itemClass : '.section'
			
		};
		var options = $.extend(defaults,options);
		var $menucontain = $(''+options.menuContain);
		
		_init();
		function _init(){
		   if($menucontain.length>0){
				var toTopHeight = $menucontain.offset().top;
				
				$(window).scroll(function() {
				
						if( $(document).scrollTop() > toTopHeight){
							$menucontain.addClass("fxd");
							
							
							
						}else{
							
							$menucontain.removeClass("fxd");
							
							
							
						}
						//console.log(options.contentContain+' '+options.itemClass);
						h($(options.contentContain+' '+options.itemClass));//鼠标滚动定位
					
				});
				// 滚动定位
				function h(id){
					var arr = [];
					id.each(function(i){
						arr.push(id.eq(i).offset().top-70);
						
					});


					for(var i = 0;i<arr.length;i++){
						if($(document).scrollTop() > arr[i]){
							tab1(i,options.chooseClass);
						}
					}
				}
				function tab1(index,clas){
					
					//console.log(index);
					$(options.menuContain+' '+options.tabItem).removeClass(clas).eq(index).addClass(clas);
				}
			
				$(options.menuContain+' '+options.tabItem).click(function(e){
					e.preventDefault();
					var index = ($(options.menuContain+' '+options.tabItem)).index($(this));
					
					
					var goTo = $(options.contentContain+' '+options.itemClass).eq(index).offset().top-65;
					
					$("html, body").animate({
						scrollTop: goTo
					}, 500);
				});
			}
		
		}
	}


})(jQuery);