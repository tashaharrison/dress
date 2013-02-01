(function($) {
	$(document).ready(function(){
	var sticky_container = $('#block-menu-menu-travel-blog-categories');
	
	sticky_container.waypoint(function(direction) {
		sticky_container.toggleClass("sticky",direction==='down');
	});
	});
})(jQuery);
