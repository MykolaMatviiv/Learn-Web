<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MetroStore
 */

get_header(); 

	$metrostore_page_layout = esc_attr( get_post_meta($post->ID, 'metrostore_page_layouts', true) );
	if(!$metrostore_page_layout){
		$metrostore_page_layout = 'rightsidebar';
	}
	if(!empty($metrostore_page_layout) && $metrostore_page_layout == 'rightsidebar' || $metrostore_page_layout == 'leftsidebar' ) {
		$metrostore_col = 9;
	}else if(!empty($metrostore_page_layout) && $metrostore_page_layout == 'nosidebar' ){
		$metrostore_col = 12;
	}
?>

<?php do_action( 'breadcrumb-woocommerce' ); ?>

<div class="main-container col1-layout">
	<div class="container">
		<div class="row">

			<?php  if ($metrostore_page_layout == 'leftsidebar') : ?>
				<?php get_sidebar('left'); ?>
			<?php endif; ?>

			<div id="primary" class="col-sm-<?php echo intval( $metrostore_col ); ?>">
				<main id="main" class="site-main" role="main">

				<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						//the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
				?>

				</main><!-- #main -->
			</div><!-- #primary -->

			<?php  if ($metrostore_page_layout == 'rightsidebar') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

		</div>
	</div>
</div>

<?php get_footer();
