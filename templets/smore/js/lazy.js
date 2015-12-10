(function($) {
	$.fn.lazyload = function(options) {
		var configs = {
			container: "window",
			threshold: 0,
			recover: false
		};
		$.extend(configs, options);
		var elements = this;
		var $container = null;
		if (configs.container == "window") {
			$container = $(window);
		} else {
			$container = $("#" + configs.container);
		}
		
		$container.bind('scroll',
		function(e) {
			loadAboveTheFoldImages(elements, configs);
		});
		loadAboveTheFoldImages(elements, configs);
		return this;
	};
	function aboveTheFold(element, options) {
		var fold = $(window).height() + $(window).scrollTop();
		return fold >= $(element).offset().top - (options['threshold']);
	};
	function loadOriginalImage(element) {
		
		$(element).attr('src', $(element).attr('data-original')).removeAttr('data-original');
	};
	function loadAboveTheFoldImages(elements, options) {
		
		elements.each(function() {
			if (aboveTheFold(this, options) && ($(this).attr('data-original'))) {
				loadOriginalImage(this);
				if (options['recover'] == true) {
					$(this).removeAttr("width");
					$(this).removeAttr("height");
				}
			}
		});
	};
})(jQuery);

