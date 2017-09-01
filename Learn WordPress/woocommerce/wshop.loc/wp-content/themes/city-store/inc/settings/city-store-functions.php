<?php
/**
 * Custom functions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */

/******************************** EXCERPT LENGTH *********************************/
if (! function_exists('city_store_excerpt_length')) {
	function city_store_excerpt_length($length) {
		$city_store_settings = city_store_get_theme_options();
		$city_store_excerpt_length = $city_store_settings['city_store_excerpt_length'];
		return absint($city_store_excerpt_length);// this will return 30 words in the excerpt
	}
	add_filter('excerpt_length', 'city_store_excerpt_length');
}

/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
if (! function_exists('city_store_continue_reading')) {
	function city_store_continue_reading() {
		 return '&hellip; ';
	}
	add_filter('excerpt_more', 'city_store_continue_reading');
}

/***************** USED CLASS FOR BODY TAGS ******************************/
if (! function_exists('city_store_body_class')) {
	function city_store_body_class($classes) {
		$city_store_settings = city_store_get_theme_options();
		$city_store_site_layout = $city_store_settings['city_store_design_layout'];

		if (is_page_template('page-templates/page-template-contact.php')) {
				$classes[] = 'contact';
		}
		if ($city_store_site_layout =='boxed-layout') {
			$classes[] = 'boxed-layout';
		}
		if ($city_store_site_layout =='small-boxed-layout') {
			$classes[] = 'boxed-layout-small';
		}
		$classes[] = 'small_image_blog';
		return $classes;
	}
	add_filter('body_class', 'city_store_body_class');
}

/********************** SCRIPTS FOR DONATE/ UPGRADE BUTTON ******************************/
if (! function_exists('city_store_customize_scripts')) {
	function city_store_customize_scripts() {
		
		// Load the html5 shiv.
		wp_enqueue_script( 'city-store-html5', get_template_directory_uri() . '/assets/js/html5.min.js', array(), '3.7.3' );
		wp_script_add_data( 'city-store-html5', 'conditional', 'lt IE 9' );
	}
	add_action( 'customize_controls_print_scripts', 'city_store_customize_scripts');
}

/**************************** SOCIAL MENU *********************************************/
if (! function_exists('city_store_social_links')) {
	function city_store_social_links() {

		$city_store_settings 	= city_store_get_theme_options();
		$facebook 				= $city_store_settings['city_store_social_facebook'];
		$twitter 				= $city_store_settings['city_store_social_twitter'];
		$pinterest				= $city_store_settings['city_store_social_pinterest'];
		$dribble 				= $city_store_settings['city_store_social_dribbble'];
		$instagram 				= $city_store_settings['city_store_social_instagram'];
		$flicker 				= $city_store_settings['city_store_social_flickr'];
		$gplus 					= $city_store_settings['city_store_social_googleplus'];
		$linkedin 				= $city_store_settings['city_store_social_linkedin'];

		if(!empty($facebook) || !empty($twitter) || !empty($pinterest) || !empty($dribble) || !empty($dribble) || !empty($instagram) || !empty($flicker) || !empty($gplus) || !empty($linkedin)) :
				?>
				<div class="social-links clearfix">
					<?php
					if( !empty($facebook) ):
						echo '<a target="_blank" href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a>';
					endif;
					if( !empty($twitter) ):
						echo '<a target="_blank" href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a>';
					endif;
					if( !empty($pinterest) ):
						echo '<a target="_blank" href="'.esc_url($pinterest).'"><i class="fa fa-pinterest-p"></i></a>';
					endif;
					if( !empty($dribble) ):
						echo '<a target="_blank" href="'.esc_url($dribble).'"><i class="fa fa-dribbble"></i></a>';
					endif;
					if( !empty($instagram) ):
						echo '<a target="_blank" href="'.esc_url($instagram).'"><i class="fa fa-instagram"></i></a>';
					endif;
					if( !empty($flicker) ):
						echo '<a target="_blank" href="'.esc_url($flicker).'"><i class="fa fa-flickr"></i></a>';
					endif;
					if( !empty($gplus) ):
						echo '<a target="_blank" href="'.esc_url($gplus).'"><i class="fa fa-google-plus-official"></i></a>';
					endif;
					if( !empty($linkedin) ):
						echo '<a target="_blank" href="'.esc_url($linkedin).'"><i class="fa fa-linkedin"></i></a>';
					endif;
						?>
				</div><!-- end .social-links -->
			<?php
		endif;
	}
	add_action ('city_store_social_links', 'city_store_social_links');
}

/*********************** City Store PAGE SLIDERS ***********************************/
if (! function_exists('city_store_page_sliders')) {
	function city_store_page_sliders() {
		global $city_store_excerpt_length;
		global $post;
		$city_store_settings 				= city_store_get_theme_options();
		$excerpt 							= get_the_excerpt();
		//$slider_custom_url 					= $city_store_settings['city_store_secondary_url'];
		$city_store_page_sliders_display 	= '';
		$city_store_total_page_no 			= 0;
		$city_store_list_page				= array();
		for( $i = 1; $i <= $city_store_settings['city_store_slider_no']; $i++ ){
			if( isset ( $city_store_settings['city_store_featured_page_slider_' . $i] ) && $city_store_settings['city_store_featured_page_slider_' . $i] > 0 ){
				$city_store_total_page_no++;
				$city_store_list_page	=	array_merge( $city_store_list_page, array( esc_attr($city_store_settings['city_store_featured_page_slider_' . $i] )) );
			}
		}
			if ( !empty( $city_store_list_page ) && $city_store_total_page_no > 0 ) {
				echo '<div class="main-slider clearfix"> <div class="layer-slider">';
						$get_featured_posts 		= new WP_Query(array( 'posts_per_page'=> $city_store_settings['city_store_slider_no'], 'post_type' => array('page'), 'post__in' => $city_store_list_page, 'orderby' => 'post__in', ));
						$i=0;
				while ($get_featured_posts->have_posts()):$get_featured_posts->the_post();
				$attachment_id = get_post_thumbnail_id();
				$image_attributes = wp_get_attachment_image_src($attachment_id,'city_store_slider_image');
							$i++;
							$title_attribute       	 	 = apply_filters('the_title', get_the_title($post->ID));
							$excerpt               	 	 = substr(get_the_excerpt(), 0 , 160);
							if (1 == $i) {$classes   	 = "slides show-display";} else { $classes = "slides hide-display";}
									?>
					<div class="<?php echo esc_attr($classes); ?>">
						<div class="image-slider clearfix" title="<?php the_title('', '', false); ?>" style="background-image:url(<?php echo esc_url($image_attributes[0]); ?>)">
							<article class="slider-content clearfix">
					<?php

						if ($title_attribute != '') {
							echo '<h2 class="slider-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title('', '', false).'" rel="bookmark">'.esc_html(get_the_title()).'</a></h2><!-- .slider-title -->';
						}

						if ($excerpt != '') {
							echo '<div class="slider-text">';
							echo '<p>'.esc_html($excerpt).' </p></div><!-- end .slider-text -->';
						}
						echo '<div class="slider-buttons">';
						echo '<a title='.'"'.esc_html(get_the_title()). '"'. ' '.'href="'.esc_url(get_permalink()).'"'.' class="btn-default">'.esc_html__('Read More', 'city-store').'</a>';
						echo '</div><!-- end .slider-buttons -->';
						echo '</article><!-- end .slider-content --> ';
					if ($image_attributes) {
						echo '</div><!-- end .image-slider -->';
					}
					echo '</div><!-- end .slides -->';
				endwhile;
				wp_reset_postdata();
				echo '</div>	  <!-- end .layer-slider -->
						<a class="slider-prev" id="prev2" href="#"><i class="fa fa-angle-left"></i></a> <a class="slider-next" id="next2" href="#"><i class="fa fa-angle-right"></i></a>
	  					<nav class="slider-button"> </nav> <!-- end .slider-button -->
					</div> <!-- end .main-slider -->';
			}

	}
}


/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
if (! function_exists('city_store_scripts')) {
	function city_store_scripts() {
		$city_store_settings = city_store_get_theme_options();
		wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/assets/css/bootstrap.min.css');
		wp_enqueue_style( 'city-store-style', get_stylesheet_uri() );
		wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
		wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js', array('jquery'), false, true);
		wp_enqueue_script('slick-jquery', get_template_directory_uri().'/assets/js/slick.min.js', array('jquery'), false, true);
		wp_enqueue_script('jquery_cycle_all', get_template_directory_uri().'/assets/js/jquery.cycle.all.min.js', array('jquery'), false, true);
		wp_enqueue_script('city-store-slider', get_template_directory_uri().'/assets/js/city-store-slider-setting.min.js', array('jquery_cycle_all'), false, true);
		wp_enqueue_script('city-store-main', get_template_directory_uri().'/assets/js/city-store.js', array('jquery'), false, true);
		wp_enqueue_script('jquery-sticky', get_template_directory_uri().'/assets/sticky/jquery.sticky.min.js', array('jquery'), false, true);
		wp_enqueue_script('jquery-sticky-settings', get_template_directory_uri().'/assets/sticky/sticky-settings.js', array('jquery'), false, true);

		wp_style_add_data('IE-9', 'conditional', 'lt IE 9');
		wp_enqueue_style('city-store-responsive', get_template_directory_uri().'/assets/css/responsive.css');
		wp_enqueue_style('slick-css', get_template_directory_uri().'/assets/css/slick.css');

		/********* Adding Multiple Fonts ********************/
		$city_store_googlefont = array();
		array_push( $city_store_googlefont, 'Lato:400,300,700,400italic');
		array_push( $city_store_googlefont, 'Playfair+Display');
		$city_store_googlefonts = implode("|", $city_store_googlefont);
		wp_register_style( 'city_store_google_fonts', '//fonts.googleapis.com/css?family='.$city_store_googlefonts);
		wp_enqueue_style( 'city_store_google_fonts' );
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'city_store_scripts' );
}

if (! function_exists('city_store_blog_post_format')) {
	function city_store_blog_post_format($post_format, $post_id) {

		if (is_single()){
			$single_post_format_class = 'single-post-format';
		} else {
			$single_post_format_class = '';
		}

		$city_store_settings = city_store_get_theme_options();

		if($post_format == 'video'){ ?>
			<div class="post-video <?php echo esc_attr($single_post_format_class);?>">
				<div class="post-video-holder">
					<?php
			            $content = trim(  get_post_field('post_content', $post_id) );
			            $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
			            if( $new_content){
			                echo do_shortcode( $matches[0][0] );
			            }
			            else{
			                echo esc_html( city_store_the_featured_video( $content ) );
			            }
			        ?>
				</div>
			</div>
		<?php
		}
		elseif($post_format == 'audio'){
			?>
				<div class="post-audio <?php echo esc_attr($single_post_format_class);?>">
					<div class="post-audio-holder">
						<?php
							$content = trim(  get_post_field('post_content', $post_id) );
				              $ori_url = explode( "\n", esc_html( $content ) );
				            $new_content =  preg_match_all("/\[[^\]]*\]/", $content, $matches);
				            if( $new_content){
				                echo do_shortcode( $matches[0][0] );
				            }
				            elseif (preg_match ( '#^<(script|iframe|embed|object)#i', $content )) {
				                $regex = '/https?\:\/\/[^\" ]+/i';
				                preg_match_all($regex, $ori_url[0], $matches);
				                $urls = ($matches[0]);
				                 print_r('<iframe src="'.$urls[0].'" width="100%" height="240" frameborder="no" scrolling="no"></iframe>');
				            } elseif (0 === strpos( $content, 'https://' )) {
				                $embed_url = wp_oembed_get( esc_url( $ori_url[0] ) );
				                print_r($embed_url);
				            }
						?>
					</div>
				</div>
			<?php
		}
		elseif ($post_format == 'gallery') {
			//Get the alt and title of the image
			if ( ! is_single() ) {
				$image_url = get_post_gallery_images( $post_id );
				$post_thumbnail_id = get_post_thumbnail_id( $post_id );
				$attachment =  get_post($post_thumbnail_id);

						if( $image_url ) {
				?>
						<div class="post-gallery">
							<?php foreach ( $image_url as $key => $images ) { ?>
								<div class="post-gallery-item">
									<div class="post-gallery-item-holder" style="background-image: url('<?php echo esc_url( $images); ?>');" alt= "<?php echo esc_attr( $attachment->post_excerpt );?>">
									</div>
								</div>
							<?php
							}
							?>
						</div>
					<?php
						}
			}
		}
		else
		{
					if( has_post_thumbnail()) { ?>
						<div class="post-image-content">
							<figure class="post-featured-image">
								<a href="<?php the_permalink();?>" title="<?php echo the_title_attribute('echo=0'); ?>">
								<?php the_post_thumbnail(); ?>
								</a>
							</figure><!-- end.post-featured-image  -->
						</div> <!-- end.post-image-content -->
		<?php
					}

		}
}
}

if (! function_exists('city_store_author_description')) {
	function city_store_author_description($author_id) {
		$author_name = get_the_author_meta( 'display_name' );
        $author_firstname = get_the_author_meta( 'first_name' );
        $author_lastname = get_the_author_meta( 'last_name' );
        $author_id = get_the_author_meta( 'ID' );
        $author_description = get_the_author_meta('description', $author_id);
        $author_image = get_avatar($author_id);
		?>
		 <div class="author-bio">
            <div class="row">
                <div class="col-md-2">
                    <div class="author-image">
                        <?php echo wp_kses_post($author_image); ?>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="author-desc">
                        <span class="author-name"><a href="<?php echo esc_url(get_author_posts_url( $author_id));?>"><?php if ( $author_firstname && $author_lastname ) { ?><?php echo esc_html($author_firstname). ' ' . esc_html( $author_lastname); ?><?php } else { echo esc_html($author_name);}?></a></span>
                        <?php if ($author_description) { ?>
                            <p><?php echo wp_kses_post($author_description); ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
