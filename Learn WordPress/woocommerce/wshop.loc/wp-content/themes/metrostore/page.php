<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
			<?php  
				if ($metrostore_page_layout == 'leftsidebar'){ 
					get_sidebar('left'); 
				} 
			?>
			<div id="primary" class="content-area col-xs-12 col-sm-<?php echo intval( $metrostore_col ); ?>">
				<main id="main" class="site-main" role="main">

					<?php
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

						endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php  
				if ($metrostore_page_layout == 'rightsidebar') {
					get_sidebar(); 
				}
			?>
			
		</div>
	</div>
</div>
<?php get_footer();