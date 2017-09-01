<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
/******************** City Store CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'city_store_customize_register_options', 20 );
function city_store_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'city_store_options_panel', array(
		'priority' => 2,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options', 'city-store' ),
		'description' => '',
	) );
}
add_action( 'customize_register', 'city_store_customize_register_featuredcontent' );
function city_store_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'city_store_featuredcontent_panel', array(
		'priority' => 31,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Slider Options', 'city-store' ),
		'description' => '',
	) );
}

add_action( 'customize_register', 'city_store_customize_register_widgets' );
function city_store_customize_register_widgets( $wp_customize ) {
	$wp_customize->add_panel( 'widgets', array(
		'priority' => 33,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Widgets', 'city-store' ),
		'description' => '',
	) );
}

?>