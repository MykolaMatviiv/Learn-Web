$(function() {

	$('#my-menu').mmenu({
		extensions: [ /*'widescreen',*/ 'theme-black', 'effect-menu-slide', 'pagedim-black' ],
		navbar: {
			title: '<img src="img/logo-1.svg" alt="Салон краси S&Mitler">'
		},
		offCanvas: {
			position: 'right'
		}
	});

	var api = $('#my-menu').data('mmenu');
	api.bind('open:finish', function() {
		$('.hamburger').addClass('is-active');
	});
	api.bind('close:finish', function() {
		$('.hamburger').removeClass('is-active');
	})

});
