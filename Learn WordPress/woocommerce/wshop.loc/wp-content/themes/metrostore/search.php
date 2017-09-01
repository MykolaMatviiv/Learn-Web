<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package MetroStore
 */

get_header(); ?>

<?php do_action( 'breadcrumb-woocommerce' ); ?>

<section class="blog_post">
    <div class="container"> 
    	<div class="row">

        	<div class="content-area center_column col-xs-12 col-sm-9" id="center_column">
				<main id="main" class="site-main" role="main">
					<div class="blog-posts">
						<?php
							if ( have_posts() ) : 

								/* Start the Loop */
								while ( have_posts() ) : the_post();

									/**
									 * Run the loop for the search to output the results.
									 * If you want to overload this in a child theme then include a file
									 * called content-search.php and that will be used instead.
									 */
									get_template_part( 'template-parts/content', 'search' );

								endwhile;

								the_posts_pagination( 
				            		array(
									    'prev_text' => esc_html__( 'Prev', 'metrostore' ),
									    'next_text' => esc_html__( 'Next', 'metrostore' ),
									)
					            );				           

							else :

								get_template_part( 'template-parts/content', 'none' );

							endif; 
						?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer();
