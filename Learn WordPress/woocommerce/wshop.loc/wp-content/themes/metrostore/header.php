<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MetroStore
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- mobile menu -->
<?php do_action( 'metrostore-mobile-menu' ); ?>

<div id="page" class="site">

	<?php 
		/**
		 * @see  metrostore_skip_links() - 5
		 */	
		do_action( 'metrostore_header_before' ); 
	
		/**
		 * @see  metrostore_top_header() - 15
		 * @see  metrostore_main_header() - 20
		 */
		do_action( 'metrostore_header' ); 
	
	 	do_action( 'metrostore_header_after' ); 
	?>

<nav class="mainnav">
    <div class="stick-logo">
    	<?php
        if ( function_exists( 'the_custom_logo' ) ) {
          the_custom_logo();
        }
      ?>
    </div>

    <div class="container">
      <div class="row">
        <div class="mtmegamenu">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
        </div>
      </div>
    </div>
</nav><!-- end nav -->

<?php
	if( is_front_page() ){
		$slider_options = esc_attr( get_theme_mod( 'metrostore_home_slider_options', 'enable' ) );
		if( !empty( $slider_options ) && $slider_options == 'enable' ){
			do_action( 'metrostore_slider' );
		}
	}	
?>

<div id="content" class="site-content">
