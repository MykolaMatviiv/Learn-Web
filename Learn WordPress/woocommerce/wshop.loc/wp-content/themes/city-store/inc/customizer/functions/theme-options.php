<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
$city_store_settings = city_store_get_theme_options();
/********************  City Store THEME OPTIONS ******************************************/
//Support section
    $wp_customize->add_section( 'city_store_theme_support', array(
        'title' => __( 'Support','city-store' ),
        'priority' => 1, // Mixed with top-level-section hierarchy.
    ) );

    $wp_customize->add_setting('city_store_options[support_links]',
        array(
            'type' => 'option',
            'default' => '',
            'sanitize_callback' => 'esc_url',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control(new City_Store_Support_Control($wp_customize,'support_links',array(
                'label' => 'Support',
                'section' => 'city_store_theme_support',
                'settings' => 'city_store_options[support_links]',
                'type' => 'city-store-support',
            )
        )
    );
							/*
							Product Cat
							*/
	$product_categories = get_terms( 'product_cat' );
	$count = count($product_categories);
    if ( $count > 0 && !is_wp_error( $product_categories )){
        $select_categories= array();
        	$select_categories[''] = __('Select','city-store');
        foreach($product_categories as $product_category){
             $select_categories[$product_category->term_id] = $product_category->name;
        }
    }
    else{
        $select_categories = array(''=>__('Select','city-store'));
    }
	$wp_customize->add_section('city_store_product_categories', array(
	'title' => __('Product Categories', 'city-store'),
	'priority' => 11,
	'panel' => 'city_store_options_panel'
	));
	$wp_customize->add_setting('city_store_theme_options[city_store_product_cat_title]', array(
		'capability' => 'edit_theme_options',
		'default' => $city_store_settings['city_store_product_cat_title'],
		'sanitize_callback' => 'esc_html',
		'type' => 'option',
	));
	$wp_customize->add_control('city_store_theme_options[city_store_product_cat_title]', array(
		'label' => __('Section Title', 'city-store'),
		'priority' => 1,
		'section' => 'city_store_product_categories',
		'type' => 'text',
			));

	$wp_customize->add_setting('city_store_theme_options[city_store_product_cat_lists]', array(
		'capability' => 'edit_theme_options',
		'default' => '',
		'sanitize_callback' => 'city_store_sanitize_checkbox',
		'type' => 'option',
	));
	$wp_customize->add_control(
	    new city_store_Customize_Control_Multiple_Select(
	        $wp_customize,
	        'city_store_theme_options[city_store_product_cat_lists]',
	        array(
			'label' => __('Select Category', 'city-store'),
			'section' => 'city_store_product_categories',
			'type' => 'multiple-select',
			'choices' => $select_categories,
			)
	));
								/*
							Recent Product
							*/
	$wp_customize->add_section('city_store_product_recent_prod', array(
	'title' => __('Recent Products', 'city-store'),
	'priority' => 12,
	'panel' => 'city_store_options_panel'
	));
	$wp_customize->add_setting('city_store_theme_options[city_store_product_recent_prod_title]', array(
		'capability' => 'edit_theme_options',
		'default' => $city_store_settings['city_store_product_recent_prod_title'],
		'sanitize_callback' => 'esc_html',
		'type' => 'option',
	));
	$wp_customize->add_control('city_store_theme_options[city_store_product_recent_prod_title]', array(
		'label' => __('Section Title', 'city-store'),
		'priority' => 1,
		'section' => 'city_store_product_recent_prod',
		'type' => 'text',
			));
							/*
							Featured Product
							*/
	$wp_customize->add_section('city_store_product_feat_prod', array(
	'title' => __('Featured Products', 'city-store'),
	'priority' => 13,
	'panel' => 'city_store_options_panel'
	));
	$wp_customize->add_setting('city_store_theme_options[city_store_product_recent_feat_title]', array(
		'capability' => 'edit_theme_options',
		'default' => $city_store_settings['city_store_product_recent_feat_title'],
		'sanitize_callback' => 'esc_html',
		'type' => 'option',
	));
	$wp_customize->add_control('city_store_theme_options[city_store_product_recent_feat_title]', array(
		'label' => __('Section Title', 'city-store'),
		'priority' => 1,
		'section' => 'city_store_product_feat_prod',
		'type' => 'text',
			));

	$wp_customize->add_section('city_store_custom_header', array(
		'title' => __('General Options', 'city-store'),
		'priority' => 101,
		'panel' => 'city_store_options_panel'
	));
	$wp_customize->add_setting( 'city_store_theme_options[city_store_top_social_icons]', array(
		'default' => $city_store_settings['city_store_top_social_icons'],
		'sanitize_callback' => 'city_store_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'city_store_theme_options[city_store_top_social_icons]', array(
		'priority'=>40,
		'label' => __('Hide Social Icons on Top', 'city-store'),
		'section' => 'city_store_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'city_store_theme_options[city_store_buttom_social_icons]', array(
		'default' => $city_store_settings['city_store_buttom_social_icons'],
		'sanitize_callback' => 'city_store_checkbox_integer',
		'type' => 'option',
	));
	$wp_customize->add_control( 'city_store_theme_options[city_store_buttom_social_icons]', array(
		'priority'=>40,
		'label' => __('Hide Social Icons on Bottom', 'city-store'),
		'section' => 'city_store_custom_header',
		'type' => 'checkbox',
	));
	$wp_customize->add_setting( 'city_store_theme_options[city_store_reset_all]', array(
		'default' => $city_store_settings['city_store_reset_all'],
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'city_store_reset_alls',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control( 'city_store_theme_options[city_store_reset_all]', array(
		'priority'=>50,
		'label' => __('Reset all default settings. (Refresh it to view the effect)', 'city-store'),
		'section' => 'city_store_custom_header',
		'type' => 'checkbox',
	));
?>