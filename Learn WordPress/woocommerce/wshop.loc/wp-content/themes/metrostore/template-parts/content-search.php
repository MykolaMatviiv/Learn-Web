<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MetroStore
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-item entry'); ?>>
	<div class="row">

		<?php 
			if ( has_post_thumbnail() ) {
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'metrostore-blog-image', true);
		?>			   			

			<div class="col-sm-5">
				<div class="entry-thumb image-hover2"> 
				    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				    	<figure><img src="<?php echo esc_url( $image[0] ); ?>" alt=""/></figure>
				    </a> 
				</div>
			</div>

		<?php } ?>

		<div class="col-sm-<?php if ( has_post_thumbnail() ) { echo '7'; }else{ echo '12'; } ?>">
			
			<h3 class="entry-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>

			<div class="entry-meta-data"> 
				<span class="author"> <i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span> 
				<span class="cat"> <i class="fa fa-folder"></i>&nbsp; <?php the_category( ', ' ); ?> </span> 
				<span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; <?php comments_popup_link( '0', '1', '%' ); ?> </span> 
				<span class="date"><i class="fa fa-calendar"></i>&nbsp; <?php echo esc_attr(get_the_date());?></span> 
			</div>
			
			<div class="entry-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<div class="entry-more"> 
				<a href="<?php the_permalink(); ?>" class="button"><?php esc_html_e('Read more','metrostore'); ?>&nbsp; <i class="fa fa-angle-double-right"></i></a>
			</div>

		</div>
	</div>
</article>