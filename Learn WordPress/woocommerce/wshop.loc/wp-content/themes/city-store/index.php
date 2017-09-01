<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */

get_header();
	$city_store_settings = city_store_get_theme_options();
	$blog_layout_class = 'list-display';
	global $city_store_content_layout;
	if( $post ) {
		$layout = get_post_meta( $post->ID, 'city_store_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}
	if( 'default' == $layout ) { //Settings from customizer
		if(($city_store_settings['city_store_sidebar_layout_options'] != 'nosidebar') && ($city_store_settings['city_store_sidebar_layout_options'] != 'fullwidth')){ ?>
		<?php
			if (is_author()) {
				$objs = get_queried_object();
				if (! empty($objs)) {
					$author_id = $objs->ID;
				}
				city_store_author_description($author_id);
			}
		?>
			<div id="primary" class="<?php echo esc_attr($blog_layout_class);?>">
				<?php }
	}?>
				<main id="main" class="site-main clearfix">
					<?php
					if( have_posts() ) {
						while( have_posts() ) {
							the_post();
							get_template_part( 'template-parts/content', get_post_format() );
						}
					}
					else { ?>
					<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'city-store' ); ?> </h2>
					<?php } ?>
				</main> <!-- #main -->
				<?php get_template_part( 'pagination', 'none' );
				if( 'default' == $layout ) { //Settings from customizer
					if(($city_store_settings['city_store_sidebar_layout_options'] != 'nosidebar') && ($city_store_settings['city_store_sidebar_layout_options'] != 'fullwidth')): ?>
						</div> <!-- #primary -->
						<?php endif;
				}
get_sidebar();
get_footer(); ?>