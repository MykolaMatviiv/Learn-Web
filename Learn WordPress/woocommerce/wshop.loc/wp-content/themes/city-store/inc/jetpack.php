<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
/*********** City Store ADD THEME SUPPORT FOR INFINITE SCROLL **************************/
if (! function_exists('city_store_jetpack_setup')) {
	function city_store_jetpack_setup() {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'footer'    => 'page',
		) );
	}
	add_action( 'after_setup_theme', 'city_store_jetpack_setup' );
}