<?php
/**
 * The template for displaying 404 pages
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
get_header();
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

<div id="primary">
	<?php }
}?>
<main id="main" class="site-main clearfix">
	<article id="post-0" class="post error404 not-found">
		<?php if ( is_active_sidebar( 'city_store_404_page' ) ) :
			dynamic_sidebar( 'city_store_404_page' );
		else:?>
		<section class="error-404 not-found">
			<header class="page-header">
				<h2 class="page-title"> <?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'city-store' ); ?> </h2>
			</header> <!-- .page-header -->
			<div class="page-content">
				<p> <?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'city-store' ); ?> </p>
					<?php get_search_form(); ?>
			</div> <!-- .page-content -->
		</section> <!-- .error-404 -->
	<?php endif; ?>
	</article> <!-- #post-0 .post .error404 .not-found -->
</main> <!-- #main -->
<?php
if( 'default' == $layout ) { //Settings from customizer
	if(($city_store_settings['city_store_sidebar_layout_options'] != 'nosidebar') && ($city_store_settings['city_store_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}
get_sidebar();
get_footer(); ?>