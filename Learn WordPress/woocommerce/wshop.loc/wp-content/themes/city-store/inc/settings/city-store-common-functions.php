<?php
/**
 * Custom functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */

/******************** Remove div and replace with ul**************************************/
if (! function_exists('city_store_wp_page_menu')) {
	add_filter('wp_page_menu', 'city_store_wp_page_menu');
	function city_store_wp_page_menu($page_markup) {
		preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
		$divclass   = $matches[1];
		$replace    = array('<div class="'.$divclass.'">', '</div>');
		$new_markup = str_replace($replace, '', $page_markup);
		$new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
		return $new_markup;
	}
}
/***************Pass slider effect  parameters from php files to jquery file ********************/
if (! function_exists('city_store_slider_value')) {
	function city_store_slider_value() {
		$city_store_settings = city_store_get_theme_options();
		$city_store_transition_effect   = esc_attr($city_store_settings['city_store_transition_effect']);
		$city_store_transition_delay    = absint($city_store_settings['city_store_transition_delay'])*1000;
		$city_store_transition_duration = absint($city_store_settings['city_store_transition_duration'])*1000;
		wp_localize_script(
			'city-store-slider',
			'city_store_slider_value',
			array(
				'transition_effect'   => $city_store_transition_effect,
				'transition_delay'    => $city_store_transition_delay,
				'transition_duration' => $city_store_transition_duration,
			)
		);
	}
}
/********************* Used wp_page_menu filter hook *********************************************/
if (! function_exists('city_store_wp_page_menu_filter')) {
	function city_store_wp_page_menu_filter($text) {
		$replace = array(
			'current_page_item' => 'current-menu-item',
		);
		$text = str_replace(array_keys($replace), $replace, $text);
		return $text;
	}
	add_filter('wp_page_menu', 'city_store_wp_page_menu_filter');
}

/**************************************************************************************/
if (! function_exists('city_store_get_featured_posts')) {
	function city_store_get_featured_posts() {
		return apply_filters( 'city_store_get_featured_posts', array() );
	}
}
/************ Return bool if there are featured Posts ********************************/
if (! function_exists('city_store_has_featured_posts')) {
	function city_store_has_featured_posts() {
		return ! is_paged() && (bool) city_store_get_featured_posts();
	}
}

/**************************** Display Header Title ***********************************/
add_filter( 'get_the_archive_title', function ( $title ) {
	$format = get_post_format();
	$city_store_settings = city_store_get_theme_options();
    if( is_archive() ) {
			if ( is_category() ) :
				$city_store_header_title = esc_html__( 'Category: ', 'city-store' ). ucfirst(single_cat_title( '', FALSE ));
			elseif ( is_tag() ) :
				if($city_store_settings['city_store_blog_layout'] != 'photography_layout' ):
					$city_store_header_title = esc_html__( 'Tag: ', 'city-store' ). ucfirst(single_tag_title( '', FALSE ));
				endif;

			elseif ( is_author() ) :
				the_post();
				$city_store_header_title = esc_html__('Author: ', 'city-store'). ucfirst(get_the_author());
			elseif ( is_day() ) :
				$city_store_header_title = esc_html__('Day: ', 'city-store'). get_the_date();
			elseif ( is_month() ) :
				$city_store_header_title = esc_html__('Month: ', 'city-store'). get_the_date('F Y' );
			elseif ( is_year() ) :
				$city_store_header_title = esc_html__('Year: ', 'city-store'). get_the_date('Y' );
			elseif ( $format == 'audio' ) :
				$city_store_header_title = esc_html__( 'Audios', 'city-store' );
			elseif ( $format =='aside' ) :
				$city_store_header_title = esc_html__( 'Asides', 'city-store');
			elseif ( $format =='image' ) :
				$city_store_header_title = esc_html__( 'Images', 'city-store' );
			elseif ( $format =='gallery' ) :
				$city_store_header_title = esc_html__( 'Galleries', 'city-store' );
			elseif ( $format =='video' ) :
				$city_store_header_title = esc_html__( 'Videos', 'city-store' );
			elseif ( $format =='status' ) :
				$city_store_header_title = esc_html__( 'Status', 'city-store' );
			elseif ( $format =='quote' ) :
				$city_store_header_title = esc_html__( 'Quotes', 'city-store' );
			elseif ( $format =='link' ) :
				$city_store_header_title = esc_html__( 'links', 'city-store' );
			elseif ( $format =='chat' ) :
				$city_store_header_title = esc_html__( 'Chats', 'city-store' );
			elseif ( class_exists('WooCommerce') && (is_shop() || is_product_category()) ):
	  			$city_store_header_title = woocommerce_page_title( false );
	  		elseif ( class_exists('bbPress') && is_bbpress()) :
	  			$city_store_header_title = esc_html(get_the_title());
			else :
				$city_store_header_title = esc_html__( 'Archive:', 'city-store' );
			endif;
		} elseif (is_home()){
			$city_store_header_title = esc_html(get_the_title(get_option( 'page_for_posts' )) );
		} elseif (is_404()) {
			$city_store_header_title = __('Page NOT Found', 'city-store');
		} elseif (is_search()) {
			$search_query = get_search_query();
			$city_store_header_title = sprintf( 'Search Results for: '.ucfirst($search_query).'', 'city-store' );
			 	} elseif (is_page_template()) {
			$city_store_header_title = get_the_title();
		} else {
			$city_store_header_title = get_the_title();
		}
		return $city_store_header_title;

});
/********************* Custom Header setup ************************************/
if (! function_exists('city_store_custom_header_setup')) {
	function city_store_custom_header_setup() {
		$args = array(
			'default-text-color'     => '',
			'default-image'          => '',
			'height'                 => apply_filters( 'city_store_header_image_height', 400 ),
			'width'                  => apply_filters( 'city_store_header_image_width', 2500 ),
			'random-default'         => false,
			'max-width'              => 2500,
			'flex-height'            => true,
			'flex-width'             => true,
			'random-default'         => false,
			'header-text'			 => false,
			'uploads'				 => true,
			'wp-head-callback'       => '',
			'default-image'			 => '',
		);
		add_theme_support( 'custom-header', $args );
	}
	add_action( 'after_setup_theme', 'city_store_custom_header_setup' );
}

if ( ! function_exists( 'city_store_the_featured_video' ) ) {
    function city_store_the_featured_video( $content ) {

        $ori_url = explode( "\n", esc_html( $content ) );
        $url = esc_url( $ori_url[0] );

        $w = get_option( 'embed_size_w' );
        if ( !is_single() )
            $url = str_replace( '448', $w, $url );

        if ( 0 === strpos( $url, 'https://' ) ) {
            $embed_url = wp_oembed_get( esc_url( $url ) );
            print_r($embed_url);
            $content = trim( str_replace( $url, '', esc_html( $content ) ) );
        }
        elseif ( preg_match ( '#^<(script|iframe|embed|object)#i', $url ) ) {
            $h = get_option( 'embed_size_h' );
            echo esc_url( $url );
            if ( !empty( $h ) ) {

                if ( $w === $h ) $h = ceil( $w * 0.75 );
                $url = preg_replace(
                    array( '#height="[0-9]+?"#i', '#height=[0-9]+?#i' ),
                    array( sprintf( 'height="%d"', $h ), sprintf( 'height=%d', $h ) ),
                    $url
                    );
                echo esc_url( $url );
            }

            $content = trim( str_replace( $url, '', $content ) );
        }
    }
}

if (! function_exists('city_store_single_content')) {
    function city_store_single_content($post) {
        $content = trim(  get_post_field('post_content', $post->ID) );
        /*$new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
        if ( has_post_format('gallery')) {
            echo wp_kses_post($post->post_content);
        }
        else {*/
            the_content();
        /*}*/
    }
}