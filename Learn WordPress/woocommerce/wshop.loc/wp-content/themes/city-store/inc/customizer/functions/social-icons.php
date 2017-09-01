<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
$city_store_settings = city_store_get_theme_options();
/******************** City Store SOCIAL ICONS ******************************************/
$wp_customize->add_section( 'city_store_social_icons', array(
	'title' => __('Social Icons','city-store'),
	'priority' => 400,
	'panel' =>'city_store_options_panel'
));
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_facebook]', array(
	'default' => $city_store_settings['city_store_social_facebook'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_facebook]', array(
	'priority' => 410,
	'label' => __( 'Facebook Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_twitter]', array(
	'default' => $city_store_settings['city_store_social_twitter'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_twitter]', array(
	'priority' => 420,
	'label' => __( 'Twitter Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_pinterest]', array(
	'default' => $city_store_settings['city_store_social_pinterest'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_pinterest]', array(
	'priority' => 430,
	'label' => __( 'Pinterest Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_dribbble]', array(
	'default' => $city_store_settings['city_store_social_dribbble'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_dribbble]', array(
	'priority' => 440,
	'label' => __( 'Dribbble Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_instagram]', array(
	'default' => $city_store_settings['city_store_social_instagram'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_instagram]', array(
	'priority' => 450,
	'label' => __( 'Instagram Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_flickr]', array(
	'default' => $city_store_settings['city_store_social_flickr'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_flickr]', array(
	'priority' => 460,
	'label' => __( 'Flickr Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_googleplus]', array(
	'default' => $city_store_settings['city_store_social_googleplus'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_googleplus]', array(
	'priority' => 470,
	'label' => __( 'Google Plus Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
$wp_customize->add_setting( 'city_store_theme_options[city_store_social_linkedin]', array(
	'default' => $city_store_settings['city_store_social_linkedin'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'edit_theme_options'
	)
);
$wp_customize->add_control( 'city_store_theme_options[city_store_social_linkedin]', array(
	'priority' => 480,
	'label' => __( 'Linkedin Link', 'city-store' ),
	'section' => 'city_store_social_icons',
	'type' => 'text',
	)
);
	?>