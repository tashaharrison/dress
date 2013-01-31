(function($) {
	$(document).ready(function(){
	var sticky_container = $('#region-sidebar-second');
	
	sticky_container.waypoint(function(direction) {
		sticky_container.toggleClass("sticky",direction==='down');
	});
	});
})(jQuery);
