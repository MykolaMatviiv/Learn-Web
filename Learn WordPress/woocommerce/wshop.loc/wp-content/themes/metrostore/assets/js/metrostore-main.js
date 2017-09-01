jQuery(document).ready(function($) {
    $('span.onsale').removeClass('onsale').addClass('icon-sale-label sale-left');
});

jQuery(document).ready(function($) {
    "use strict";

    /**
     * Ajax Tabs 
    */ 
    jQuery('.home-tab .metrotabs a').on('click', function(e)  {
        var current_tab = jQuery(this);
        var tabcurrentAttrValue = jQuery(this).attr('data-slug');
        var product_num = jQuery(this).parents('ul').attr('data-id');
        jQuery.ajax({
            url : metrostore_ajax_script.ajaxurl,                
            data:{
                    action : 'metrostore_tabs_ajax_action',
                    category_slug:tabcurrentAttrValue,
                    product_num  : product_num
                },
            type:'post',
             success: function(res){
                     var tabContent = current_tab.parents(".metrotabs").parent().find(".metor-tabs");
                     tabContent.html(res);
                     tabContent.find(".slider-items").metroCrawsel({items: 4});
                }
        });
    });

    /**
     * Main Banner Flexslider
    */
    try {
        var msSlider = $('.flexslider');
        msSlider.flexslider({
            animation: "fade"
        });
    } catch(err) {

    }

    /**
     * ScrollUp
    */
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 1000) {
            jQuery('.scrollup').fadeIn();
        } else {
            jQuery('.scrollup').fadeOut();
        }
    });

    jQuery('.scrollup').click(function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 2000);
        return false;
    });

    /** 
     * Youtube video BG 
    */
    var vid_id = $('.background-video').attr('vid');
    if(vid_id != '') {
        $('.background-video').YTPlayer({
          videoId: vid_id
        });
    }

    /* Wishlist count ajax update */
    jQuery( document ).ready( function($){
        $('body').on( 'added_to_wishlist', function(){
            $('.top-wishlist .count').load( yith_wcwl_l10n.ajax_url + ' .top-wishlist span', {action: 'yith_wcwl_update_single_product_list'} );
        });
    });

    /**
     * Widget Sticky sidebar
    */
    $('.content-area').theiaStickySidebar({
        additionalMarginTop: 30
    });

    $('.widget-area').theiaStickySidebar({
        additionalMarginTop: 30
    });

    /**
     * Mobile menu
    */
    jQuery("#mobile-menu").mobileMenu();

    // Ajax tabs slider function
    (function ( $ ) { 
        $.fn.metroCrawsel = function( options ) {
            var settings = jQuery.extend({
                items: 4,
            }, options );
            return this.owlCarousel({
                items: settings.items,
                itemsDesktop: [1024, 4],
                itemsDesktopSmall: [900, 3],
                itemsTablet: [640, 2],
                itemsMobile: [390, 1],
                navigation: !0,
                navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
                slideSpeed: 500,
                pagination: !1,
                autoPlay: false
            }); 
        };
    }( jQuery )),

    jQuery("#tabs-slider .slider-items").metroCrawsel({items: 4}),
    

    jQuery("#product-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [640, 2],
        itemsMobile: [390, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1,
        autoPlay: false
    }),

    /******************************************
    Best sale slider
    ******************************************/
    jQuery("#best-sale-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [640, 2],
        itemsMobile: [390, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1,
        autoPlay: true
    }),
        
    /******************************************
    New arrivals slider
    ******************************************/
    jQuery("#new-arrivals-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [640, 2],
        itemsMobile: [390, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1,
        autoPlay: true
    }),
        
    /**
     * Top sellers slider
    */
    jQuery("#top-sellers-slider .slider-items").owlCarousel({
        items: 4,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [640, 2],
        itemsMobile: [390, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1,
        autoPlay: true
    }),
            
    /**
     * Latest news slider
    */
    jQuery("#latest-news-slider .slider-items").owlCarousel({
        autoplay: !0,
        items: 3,
        itemsDesktop: [1024, 4],
        itemsDesktopSmall: [900, 3],
        itemsTablet: [640, 2],
        itemsMobile: [480, 1],
        navigation: !0,
        navigationText: ['<a class="flex-prev"></a>', '<a class="flex-next"></a>'],
        slideSpeed: 500,
        pagination: !1
    })

});