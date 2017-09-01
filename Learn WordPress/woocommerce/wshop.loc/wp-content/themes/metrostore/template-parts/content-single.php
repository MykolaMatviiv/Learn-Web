<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package MetroStore
 */

?>

<div class="entry-detail">
  <?php 
    if( has_post_thumbnail() ){
      $image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'full', true);
  ?>
    <div class="entry-photo">
      <figure><img src="<?php echo esc_url($image[0]); ?>" alt="Blog"></figure>
    </div>
  <?php } ?>
  <div class="entry-meta-data"> 
      <span class="author"> <i class="fa fa-user"></i> <?php the_author_posts_link(); ?></span> 
      <span class="cat"> <i class="fa fa-folder"></i>&nbsp; <?php the_category( ', ' ); ?> </span> 
      <span class="comment-count"> <i class="fa fa-comment"></i>&nbsp; <?php comments_popup_link( '0', '1', '%' ); ?> </span> 
      <span class="date"><i class="fa fa-calendar"></i>&nbsp; <?php echo esc_attr(get_the_date());?></span> 
  </div>
  <div class="content-text clearfix">
      <?php
        the_content();

        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'metrostore' ),
          'after'  => '</div>',
        ) );
      ?>
  </div>
</div>