<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MetroStore
 */

get_header(); ?>

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

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );

							endwhile;

							
							the_posts_pagination( 
			            		array(
								    'prev_text' => esc_html__( 'Prev', 'metrostore' ),
								    'next_text' => esc_html__( 'Next', 'metrostore' ),
								)
				            );
				            
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif; ?>
					</div>
				</main><!-- #main -->
			</div><!-- #primary -->

			<?php get_sidebar(); ?>

		</div>
	</div>
</div>
<?php get_footer();
