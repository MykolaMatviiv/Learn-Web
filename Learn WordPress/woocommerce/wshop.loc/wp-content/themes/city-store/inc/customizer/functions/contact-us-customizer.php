<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
/******************** City Store Contact us SETTINGS ******************************************/
$city_store_settings = city_store_get_theme_options();

 //Contact page

$wp_customize->add_section( 'city_store_contact_page', array(
    'title'       => __( 'Contact Us Page Options', 'city-store' ),
    'priority'    => 34,
) );

$wp_customize->add_setting('city_store_theme_options[city_store_contact_address]',
        array(
            'type'    => 'option',
            'default' => $city_store_settings['city_store_contact_address'],
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
            )
);
$wp_customize->add_control('city_store_theme_options[city_store_contact_address]',
        array(
            'type'    => 'text',
            'label'   => esc_html__( 'Add Address', 'city-store' ),
            'section' => 'city_store_contact_page',
            'settings'=> 'city_store_theme_options[city_store_contact_address]'
            )
);

$wp_customize->add_setting('city_store_theme_options[city_store_contact_phone]',
        array(
            'type'    => 'option',
            'default' => $city_store_settings['city_store_contact_phone'],
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
            )
);
$wp_customize->add_control('city_store_theme_options[city_store_contact_phone]',
        array(
            'type'    => 'text',
            'label'   => esc_html__( 'Add Phone Number', 'city-store' ),
            'section' => 'city_store_contact_page',
            'settings'=> 'city_store_theme_options[city_store_contact_phone]'
            )
);

$wp_customize->add_setting('city_store_theme_options[city_store_contact_skype]',
        array(
            'type'    => 'option',
            'default' => $city_store_settings['city_store_contact_skype'],
            'sanitize_callback' => 'esc_html',
            'default' => ''
            )
);
$wp_customize->add_control('city_store_theme_options[city_store_contact_skype]',
        array(
            'type'    => 'text',
            'label'   => esc_html__( 'Add Skype ID', 'city-store' ),
            'section' => 'city_store_contact_page',
            'settings'=> 'city_store_theme_options[city_store_contact_skype]'
            )
);


$wp_customize->add_setting('city_store_theme_options[city_store_contact_email]',
        array(
            'type'    => 'option',
            'default' => $city_store_settings['city_store_contact_email'],
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
            )
);
$wp_customize->add_control('city_store_theme_options[city_store_contact_email]',
        array(
            'type'    => 'text',
            'label'   => esc_html__( 'Add Email', 'city-store' ),
            'section' => 'city_store_contact_page',
            'settings'=> 'city_store_theme_options[city_store_contact_email]'
            )
);