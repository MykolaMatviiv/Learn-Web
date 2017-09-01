jQuery(window).load(function() {
    var upgrade_notice = '<a class="metrostorepro-pro" target="_blank" href="https://www.sparklewpthemes.com/wordpress-themes/metrostorepro">UPGRADE TO METROSTORE PRO</a>';
    upgrade_notice += '<a class="metrostorepro-pro" target="_blank" href="http://demo.sparklewpthemes.com/metrostorepro/demos/">METROSTORE PRO DEMO</a>';
    jQuery('#customize-info .preview-notice').append(upgrade_notice);
});

/**
 * Custom JS for image uploading
 * @package SparklewpThemes
 * @subpackage metrostore 
 */ 
 jQuery(document).ready(function($){
	var metrostore_upload;
	var metrostore_selector;
    function metrostore_add_file(event, selector) {
		var upload = $(".uploaded-file"), frame;
		var $el = $(this);
		metrostore_selector = selector;
		event.preventDefault();
		if ( metrostore_upload ) {
			metrostore_upload.open();
		} else {
			metrostore_upload = wp.media.frames.metrostore_upload =  wp.media({
				title: $el.data('choose'),
				button: {
					text: $el.data('update'),
					close: false
				}
			});

			metrostore_upload.on( 'select', function() {
				var attachment = metrostore_upload.state().get('selection').first();
				metrostore_upload.close();
                metrostore_selector.find('.upload').val(attachment.attributes.url);
				if ( attachment.attributes.type == 'image' ) {
					metrostore_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '"><a class="remove-image">Remove</a>').slideDown('fast');
				}
				metrostore_selector.find('.upload-button-wdgt').unbind().addClass('remove-file').removeClass('upload-button-wdgt').val(metrostore_img_remove.remove);
				metrostore_selector.find('.of-background-properties').slideDown();
				metrostore_selector.find('.remove-image, .remove-file').on('click', function() {
					metrostore_remove_file( $(this).parents('.section') );
				});
			});
		}
		metrostore_upload.open();
	}

	function metrostore_remove_file(selector) {
		selector.find('.remove-image').hide();
		selector.find('.upload').val('');
		selector.find('.of-background-properties').hide();
		selector.find('.screenshot').slideUp();
		selector.find('.remove-file').unbind().addClass('upload-button-wdgt').removeClass('remove-file').val(metrostore_img_remove.upload);
		if ( $('.section-upload .upload-notice').length > 0 ) {
			$('.upload-button-wdgt').remove();
		}
		selector.find('.upload-button-wdgt').on('click', function(event) {			
			metrostore_add_file(event, $(this).parents('.section'));            
		});
	}

	$('body').on('click','.remove-image, .remove-file', function() {
		metrostore_remove_file( $(this).parents('.section') );
    });

    $(document).on('click', '.upload-button-wdgt', function( event ) {
    	metrostore_add_file(event, $(this).parents('.section'));
    });

});