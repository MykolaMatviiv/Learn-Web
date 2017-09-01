<?php
if(!function_exists('city_store_get_option_defaults_values')):
	/******************** CITY STORE DEFAULT OPTION VALUES ******************************************/
	function city_store_get_option_defaults_values() {
		global $city_store_default_values;
		$city_store_default_values = array(
			'city_store_total_features'			=> '3',
			'city_store_disable_features'		=> 0,
			'city_store_design_layout' 			=> 'wide-layout',
			'city_store_sidebar_layout_options' => 'right',
			'city_store_header_display'			=> 'header_text',
			'city_store_categories'				=> array(),
			'city_store_excerpt_length'			=> '55',
			'city_store_search_text' 			=> __('Search', 'city-store'),
			'city_store_reset_all' 				=> 0,
			'city_store_search_text' 			=> __('Search &hellip;', 'city-store'),
			'city_store_blog_content_layout'	=> '',

			/* Slider Settings */
			'city_store_transition_effect' 		=> 'fade',
			'city_store_transition_delay' 		=> '4',
			'city_store_transition_duration' 	=> '1',
			'city_store_slider_no' 				=> '4',
			'city_store_footer_column_section' 	=>'4',
			/* Front page feature */
			'city_store_entry_format_blog' 		=> 'show',
			'city_store_entry_meta_blog' 		=> 'show-meta',
			/*Social Icons */
			'city_store_top_social_icons' 		=>0,
			'city_store_buttom_social_icons'	=>0,
			'city_store_social_facebook'		=> '',
			'city_store_social_twitter'			=> '',
			'city_store_social_pinterest'		=> '',
			'city_store_social_dribbble'		=> '',
			'city_store_social_instagram'		=> '',
			'city_store_social_flickr'			=> '',
			'city_store_social_googleplus'		=> '',
			'city_store_social_linkedin'		=>'',

			'city_store_featured_block_title' 	=> '',
			/*Contact Us */
			'city_store_contact_address' 		=> '',
			'city_store_contact_phone' 			=> '',
			'city_store_contact_skype' 			=> '',
			'city_store_contact_email' 			=> '',
			/*Product Cat Title*/
			'city_store_product_cat_title' 		   => __('Featured Categories','city-store'),
			'city_store_product_recent_prod_title' => __('Recent Products','city-store'),
			'city_store_product_recent_feat_title' => __('Featured Products','city-store'),
			'city_store_product_cat_lists' 		   => '',
			);
		return apply_filters( 'city_store_get_option_defaults_values', $city_store_default_values );
	}
endif;
?>