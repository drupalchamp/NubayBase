(function ($) {

Drupal.behaviors.simple = {
  attach: function (context) {
	
   $(".view-logo-carousel .view-content").smoothDivScroll({ 
		autoScrollingMode: "always", 
		//autoScrollingDirection: "endlessLoopRight", 
		autoScrollingStep: 1, 
		autoScrollingInterval: 25 
	});

	// Logo parade event handlers
	$(".view-logo-carousel .view-content").bind("mouseover", function() {
		$(this).smoothDivScroll("stopAutoScrolling");
	}).bind("mouseout", function() {
		$(this).smoothDivScroll("startAutoScrolling");
	});

 } 
};
})(jQuery);


