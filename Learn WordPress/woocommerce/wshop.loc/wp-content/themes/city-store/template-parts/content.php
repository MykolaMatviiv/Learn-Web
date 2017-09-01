<?php
/**
 * The template for displaying content.
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
global $post;
$post_format = get_post_format();
$city_store_settings = city_store_get_theme_options(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
			<?php
					city_store_blog_post_format($post_format, $post->ID);

			 ?>
				<div class="post-content-wrap">
					<header class="entry-header">
						<?php $entry_format_meta_blog = $city_store_settings['city_store_entry_meta_blog']; ?>

						<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
						<?php if($entry_format_meta_blog == 'show-meta'){ ?>
							<div class="entry-meta">
								<span class="posted-on"><a title="<?php echo esc_attr( get_the_time() ); ?>" href="<?php the_permalink(); ?>">
								<?php the_time( get_option( 'date_format' ) ); ?> </a></span>
								<span class="author vcard"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>" title="<?php the_author(); ?>">
									<?php the_author(); ?> </a></span>
<!--									--><?php //if ( comments_open() ) { ?>
<!--                                --><?php //if ( comments_number() ) { ?>
                                <?php 		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {?>

                                    <span class="comments">
									<?php comments_popup_link(
//									        __( 'No Comments', 'city-store' ), __( '1 Comment', 'city-store' ), __( '% Comments', 'city-store' ), '', __( 'Comments Off', 'city-store' )
                                    sprintf(
                                        wp_kses(
                                        /* translators: %s: post title */
                                            __( ' Leave a Comment<span class="screen-reader-text"> on %s</span>', 'city-store' ),

                                            array(
                                                'span' => array(
                                                    'class' => array(),
                                                ),
                                            )
                                        ),
                                        get_the_title()
                                    )
                                    ); ?> </span>
								<?php } ?>
							</div><!-- end .entry-meta -->
							<div class="entry-meta">
								<span class="cat-links">
									<?php the_category(); ?>
								</span> <!-- end .cat-links -->
							</div><!-- end .entry-meta -->
						<?php } ?>
					</header><!-- end .entry-header -->
					<div class="entry-content">
						<?php $content_display = $city_store_settings['city_store_blog_content_layout'];
						if($content_display == 'fullcontent_display'):
							the_content();
						else:
							the_excerpt();
						endif; ?>
					</div> <!-- end .entry-content -->
					<?php
					$excerpt = get_the_excerpt();
					$content = get_the_content();
					 ?>

				</div>
				<footer class="entry-footer">
							<?php
							if(strlen($excerpt) < strlen($content)){ ?>
							<a class="more-link" title="<?php the_title_attribute('echo=0');?>" href="<?php the_permalink();?>">
							<?php esc_html_e('Read More', 'city-store'); ?>
							</a>
							<?php } ?>
						</footer> <!-- end .entry-footer -->
		</article><!-- end .post -->