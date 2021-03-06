<?php
/**
 * Theme Customizer Functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
/********************* City Store CUSTOMIZER SANITIZE FUNCTIONS *******************************/
function city_store_checkbox_integer( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}
function city_store_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}
function city_store_numeric_value( $input ) {
	if(is_numeric($input)){
	return $input;
	}
}
function city_store_sanitize_custom_css( $input ) {
	if ( $input != '' ) {
		$input = str_replace( '<=', '&lt;=', $input );
		$input = wp_kses_split( $input, array(), array() );
		$input = str_replace( '&gt;', '>', $input );
		$input = strip_tags( $input );
		return $input;
	}
	else {
		return '';
	}
}
function city_store_sanitize_page( $input ) {
	if(  get_post( $input ) ){
		return $input;
	}
	else {
		return '';
	}
}
function city_store_reset_alls( $input ) {
	if ( $input == 1 ) {
		delete_option( 'city_store_theme_options');
	}
	else {
		return '';
	}
}

if(!function_exists('city_store_sanitize_checkbox')):
    function city_store_sanitize_checkbox( $input ) {
        return $input;
    }
endif;

