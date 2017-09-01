<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
/******************** City Store SLIDER SETTINGS ******************************************/
$city_store_settings = city_store_get_theme_options();

$wp_customize->add_section( 'city_store_page_post_options', array(
	'title' => __('Slider Option','city-store'),
	'priority' => 1,
	'panel' =>'city_store_options_panel'
));
for ( $i=1; $i <= $city_store_settings['city_store_slider_no'] ; $i++ ) {
	$wp_customize->add_setting('city_store_theme_options[city_store_featured_page_slider_'. $i .']', array(
		'default' =>'',
		'sanitize_callback' =>'city_store_sanitize_page',
		'type' => 'option',
		'capability' => 'edit_theme_options'
	));
	$wp_customize->add_control( 'city_store_theme_options[city_store_featured_page_slider_'. $i .']', array(
		'priority' => 220 . $i,
		'label' => __(' Page Slider', 'city-store') . ' ' . $i ,
		'section' => 'city_store_page_post_options',
		'type' => 'dropdown-pages',
	));
}