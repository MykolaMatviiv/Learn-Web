<?php
/**
 * The template for displaying all single posts.
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
	}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<div id="primary">
	<?php }
	}?>
	<main id="main" class="site-main clearfix">
	<?php global $city_store_settings;
	if( have_posts() ) {
		while( have_posts() ) {
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
				<header class="entry-header">
					<?php
					$entry_format_meta_blog = $city_store_settings['city_store_entry_meta_blog'];
					if($entry_format_meta_blog == 'show-meta' ){?>
					<div class="entry-meta">
						<?php
						$format = get_post_format();
						if ( current_theme_supports( 'post-formats', $format ) ) {
							printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
								sprintf( ''),
								esc_url( get_post_format_link( $format ) ),
								esc_html(get_post_format_string( $format ))
							);
						} ?>
						<span class="author vcard"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" title="<?php the_author(); ?>"><i class="fa fa-user"></i>
						<?php the_author(); ?> </a></span> <span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>"><i class="fa fa-calendar"></i>
						<?php the_time( get_option( 'date_format' ) ); ?> </a></span>
<!--						--><?php //if ( comments_open() ) { ?>
						<?php if ( get_comments_number() ) { ?>
						<span class="comments"><i class="fa fa-comment"></i>
						<?php

						 comments_popup_link( __( 'No Comments', 'city-store' ), __( '1 Comment', 'city-store' ), __( '% Comments', 'city-store' ), '', __( 'Comments Off', 'city-store' ) ); ?> </span>
						<?php } ?>
					</div> <!-- end .entry-meta -->
					<?php } ?>
				</header> <!-- end .entry-header -->
				<?php
					$post_format = get_post_format();
					city_store_blog_post_format($post_format, $post->ID);
		} ?>
		<div class="entry-content clearfix">
		<?php city_store_single_content($post); ?>
			<?php
			wp_link_pages( array(
				'before'			=> '<div style="clear: both;"></div><div class="pagination clearfix">'.__( 'Pages:', 'city-store' ),
				'after'			=> '</div>',
				'link_before'	=> '<span>',
				'link_after'	=> '</span>',
				'pagelink'		=> '%',
				'echo'			=> 1
			) ); ?>
		</div> <!-- .entry-content -->
		<?php $disable_entry_format = $city_store_settings['city_store_entry_format_blog'];
			if($disable_entry_format =='show' || $disable_entry_format =='show-button' || $disable_entry_format =='hide-button'){ ?>
				<footer class="entry-footer">
					<?php if($disable_entry_format !='show-button'){ ?>
					<span class="cat-links">
					<?php esc_html_e('Category : ','city-store');  the_category(); ?>
					</span> <!-- end .cat-links -->
					<?php $tag_list = get_the_tag_list( '', __( ', ', 'city-store' ) );
						if(!empty($tag_list)){ ?>
						<span class="tag-links">
						<?php  echo esc_html__('Tag : ','city-store'). wp_kses_post($tag_list); ?>
						</span> <!-- end .tag-links -->
						<?php }
					} ?>
				</footer> <!-- .entry-meta -->
			<?php }
				if( is_attachment() ) { ?>
				<ul class="default-wp-page clearfix">
					<li class="previous"> <?php previous_image_link( false, __( '&larr; Previous', 'city-store' ) ); ?> </li>
					<li class="next">  <?php next_image_link( false, __( 'Next &rarr;', 'city-store' ) ); ?> </li>
				</ul>
				<?php } else { ?>
				<ul class="default-wp-page clearfix">
					<li class="previous"> <?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'city-store' ) . '</span> %title' ); ?> </li>
					<li class="next"> <?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'city-store' ) . '</span>' ); ?> </li>
				</ul>
					<?php }
				comments_template(); ?>
			</article>
		</section> <!-- .post -->
	<?php
		}
	else { ?>
	<h1 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'city-store' ); ?> </h1>
	<?php } ?>
	</main> <!-- #main -->
	<?php
	if( 'default' == $layout ) { //Settings from customizer
		if(($city_store_settings['city_store_sidebar_layout_options'] != 'nosidebar') && ($city_store_settings['city_store_sidebar_layout_options'] != 'fullwidth')): ?>
</div> <!-- #primary -->
<?php endif;
}else{ // for page/post
	if(($layout != 'no-sidebar') && ($layout != 'full-width')){
		echo '</div><!-- #primary -->';
	}
}
get_sidebar();
get_footer(); ?>