<?php
/**
 * The template for displaying comments.
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
	<h2 class="comments-title">
		<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'city-store' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'city-store'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
	</h2>
	<?php //city_store_comment_nav(); ?>
	<?php 
		$comment_args = array(
            'prev_text'          => esc_attr( 'Older comments', 'city-store' ),
            'next_text'          => esc_attr( 'Newer comments', 'city-store' ),
            'screen_reader_text' => ''
        );
		the_comments_navigation( $comment_args );
	?>
	<ol class="comment-list">
	<?php
		wp_list_comments( array(
			'style'       => 'ol',
			'short_ping'  => true,
			'avatar_size' => 56,
		) );
	?>
	</ol> <!-- .comment-list -->
	<?php //city_store_comment_nav();
	$comment_args = array(
            'prev_text'          => esc_attr( 'Older comments', 'city-store' ),
            'next_text'          => esc_attr( 'Newer comments', 'city-store' ),
            'screen_reader_text' => ''
        );
		the_comments_navigation( $comment_args );
	 ?>
	<?php endif; // have_comments() ?>
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
	<p class="no-comments">
	<?php esc_html_e( 'Comments are closed.', 'city-store' ); ?>
	</p>
	<?php endif; ?>
	<?php comment_form(); ?>
</div> <!-- .comments-area -->