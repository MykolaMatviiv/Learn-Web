<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
$city_store_settings = city_store_get_theme_options();
/******************** City Store LAYOUT OPTIONS ******************************************/
	$wp_customize->add_section('city_store_layout_options', array(
		'title' => __('Layout Options', 'city-store'),
		'priority' => 102,
		'panel' => 'city_store_options_panel'
	));
	$wp_customize->add_setting( 'city_store_theme_options[city_store_entry_meta_blog]', array(
		'default' => $city_store_settings['city_store_entry_meta_blog'],
		'sanitize_callback' => 'city_store_sanitize_select',
		'type' => 'option',
	));
	$wp_customize->add_control( 'city_store_theme_options[city_store_entry_meta_blog]', array(
		'priority'=>45,
		'label' => __('Meta for blog page', 'city-store'),
		'section' => 'city_store_layout_options',
		'type'	=> 'select',
		'choices' => array(
		'show-meta' => __('Show Meta','city-store'),
		'hide-meta' => __('Hide Meta','city-store'),
	),
	));
	$wp_customize->add_setting('city_store_theme_options[city_store_design_layout]', array(
		'default'        => $city_store_settings['city_store_design_layout'],
		'sanitize_callback' => 'city_store_sanitize_select',
		'type'                  => 'option',
	));
	$wp_customize->add_control('city_store_theme_options[city_store_design_layout]', array(
	'priority'  =>50,
	'label'      => __('Design Layout', 'city-store'),
	'section'    => 'city_store_layout_options',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'wide-layout' => __('Full Width Layout','city-store'),
		'boxed-layout' => __('Boxed Layout','city-store'),
	),
));
?>