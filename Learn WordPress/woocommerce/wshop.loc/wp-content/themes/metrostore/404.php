<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package MetroStore
 */

get_header(); ?>

<?php do_action( 'breadcrumb-woocommerce' ); ?>

<div class="main-container col1-layout">
	<div class="container">
		<div class="row">

			<div id="primary" class="col-sm-12">
				<main id="main" class="site-main" role="main">

					<section class="error-404 not-found">
						<h2><?php esc_html_e('404','metrostore'); ?></h2>
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'metrostore' ); ?></h1>
						</header><!-- .page-header -->

						<div class="backtohome">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" type="button" class="btn-home">
								<span><?php esc_html_e('Back To Home','metrostore'); ?></span>
							</a>
						</div>

					</section><!-- .error-404 -->

				</main><!-- #main -->
			</div><!-- #primary -->			
		</div>
	</div>
</div>

<?php get_footer();