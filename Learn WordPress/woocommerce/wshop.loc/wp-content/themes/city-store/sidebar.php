<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
	$city_store_settings = city_store_get_theme_options();
	global $city_store_content_layout;
	if( $post ) {
		$layout = get_post_meta( $post->ID, 'city_store_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}

if( 'default' == $layout ) { //Settings from customizer
	if(($city_store_settings['city_store_sidebar_layout_options'] != 'nosidebar') && ($city_store_settings['city_store_sidebar_layout_options'] != 'fullwidth')){ ?>

<div id="secondary">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="secondary">
  <?php }
	}?>
  <?php
	if( 'default' == $layout ) { //Settings from customizer
		if(($city_store_settings['city_store_sidebar_layout_options'] != 'nosidebar') && ($city_store_settings['city_store_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'city_store_main_sidebar' ); ?>
</div> <!-- #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'city_store_main_sidebar' );
			echo '</div><!-- #secondary -->';
		}
	}
?>