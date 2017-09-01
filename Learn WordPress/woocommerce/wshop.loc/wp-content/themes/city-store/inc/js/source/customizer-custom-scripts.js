/******************* City Store CUSTOMIZER CUSTOM SCRIPTS ******************************/
(function($) {
	$('.preview-notice').prepend('<span id="city_store_upgrade"><a target="_blank" class="button btn-upgrade" href="' + city_store_upgrade_links.upgrade_link + '">' + city_store_upgrade_links.upgrade_text + '</a></span>');
	jQuery('#customize-info .btn-upgrade, .misc_links').click(function(event) {
		event.stopPropagation();
	});
})(jQuery);