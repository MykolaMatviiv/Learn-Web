<?php
/**
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
/**************** City Store REGISTER WIDGETS ***************************************/
if (! function_exists('city_store_widgets_init')) {
	add_action('widgets_init', 'city_store_widgets_init');
	function city_store_widgets_init() {

		register_sidebar(array(
				'name' => __('Main Sidebar', 'city-store'),
				'id' => 'city_store_main_sidebar',
				'description' => __('Shows widgets at Main Sidebar.', 'city-store'),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h2 class="widget-title">',
				'after_title' => '</h2>',
			));
		global $city_store_settings;
		$city_store_settings = wp_parse_args( get_option( 'city_store_theme_options', array() ), city_store_get_option_defaults_values() );
		for($i =1; $i<= $city_store_settings['city_store_footer_column_section']; $i++){
		register_sidebar(array(
				'name' => __('Footer Widget ', 'city-store') . $i,
				'id' => 'city_store_footer_'.$i,
				'description' => __('Shows widgets at Footer Widget ', 'city-store').$i,
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			));
		}
	}
}

if (in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ):
	if (! function_exists('city_store_woocommerce_sidebar')) {
		add_action('widgets_init', 'city_store_woocommerce_sidebar');
		function city_store_woocommerce_sidebar() {
			register_sidebar(array(
					'name' => __('WooCommerce Sidebar', 'city-store'),
					'id' => 'city_store_woocommerce_sidebar',
					'description' => __('Add WooCommerce Widgets Only', 'city-store'),
					'before_widget' => '<div id="A%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h2 class="widget-title">',
					'after_title' => '</h2>',
				));
		}
	}
endif;