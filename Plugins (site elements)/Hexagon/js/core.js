
jQuery(document).ready(function() {
	
	
});	

$(window).on("load resize",function(e){
  var viewport = $('meta[name="viewport"]');

	if (window.innerWidth <= 768 && window.innerWidth > 460) {
	    viewport.attr("content", "width=768, initial-scale=0.5"); 
	} else if (window.innerWidth <= 460) {
		viewport.attr("content", "width=480, initial-scale=0.5"); 
	} else {
		viewport.attr("content", "width=device-width, initial-scale=1"); 
	}
});