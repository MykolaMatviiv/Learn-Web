<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package MetroStore
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function metrostore_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	//Web Layout
	if( get_theme_mod( 'metrostore_webpage_layout_options', 'fullwidth' ) == 'boxed') {
		$classes[] = 'boxed';
	}


	$classes[] = 'woocommerce';

	return $classes;
}
add_filter( 'body_class', 'metrostore_body_classes' );
