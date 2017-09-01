<?php
/**
 * Main banner slider
*/
if ( ! function_exists( 'metrostore_slider_section' ) ) {
    function metrostore_slider_section() { 
            $slider_cat_id = intval( get_theme_mod( 'metrostore_slider_team_id' ));
            if( !empty( $slider_cat_id ) ) {
        ?>
            <div id="slider" class="ms-slider">
                <div class="flexslider">
                    <ul class="slides">
                        <?php                        
                            $slider_args = array(
                                'post_type' => 'post',
                                'tax_query' => array(
                                    array(
                                        'taxonomy'  => 'category',
                                        'field'     => 'id', 
                                        'terms'     => $slider_cat_id                                                                 
                                    )),
                                'posts_per_page' => 8
                            );

                            $slider_query = new WP_Query( $slider_args );
                            if( $slider_query->have_posts() ) { while( $slider_query->have_posts() ) { $slider_query->the_post();
                            $image_path = wp_get_attachment_image_src( get_post_thumbnail_id(), 'metrostore-banner-image', true );                           
                        ?>                  
                            <li><!-- Slider  list item-->
                                <img alt="<?php the_title(); ?>" src="<?php echo esc_url( $image_path[0] ); ?>" />
                                <div class="flex-caption">
                                    <div class="container">
                                        <div class="caption-adjust">
                                            <h1><?php the_title(); ?></h1>
                                            <p><?php the_content(); ?></p>                                      
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php } wp_reset_postdata();  } ?>
                    </ul>
                </div>
                <div class="arrow-pagin">
                    <div class="container">
                        <a href="#" class="prev-slide"></a>
                        <a href="#" class="next-slide"></a>
                    </div>
                </div>
            </div><!-- End Slider -->
        <?php
            } 
    }
}
add_action('metrostore_slider','metrostore_slider_section');

/**
 * Title
*/
if ( ! function_exists( 'metrostore_title_design' ) ) {
	function metrostore_title_design() {	 ?>	
		<div class="divider divider-icon divider-md">
			&#x268A;&#x268A; &#x2756; &#x268A;&#x268A;
		</div>
	<?php
	}
}
add_action( 'metrostore_title_design', 'metrostore_title_design' );

/**
 * Our Services Function Area
 */
if ( ! function_exists( 'metrostore_services_area' ) ) {
	function metrostore_services_area( $service_one_icon = null, $service_one = null ) {	 ?>	
	<?php if(!empty( $service_one_icon ) || !empty( $service_one ) ) { ?>
		<div class="col-md-3 col-sm-6"> 
			<div class="info-box-1 square-icon text-center">

				<?php if(!empty( $service_one_icon )) { ?>
					<span class="info-box-icon">
						<i class="<?php echo esc_attr($service_one_icon); ?>"></i>
					</span>
				<?php } ?>
        <?php 
          if(!empty( $service_one )){
            $services_page = get_post( $service_one );
        ?>
  				<div class="info-box-info">
  				  <h4><?php echo esc_attr($services_page->post_title); ?></h4>
  				  <div class="divider divider-sm"></div>
  				  <p><?php echo wp_trim_words($services_page->post_content, 20); ?></p>
  				</div>
        <?php } ?>
			</div> 
		</div>
	<?php }
	}
}

/**
 * Skills Percentage Function Area
*/
if ( ! function_exists( 'metrostore_skills_percentage' ) ) {
	function metrostore_skills_percentage( $skills ) { extract( $skills );	 ?>	
	   <?php if(!empty( $icon ) || !empty( $title ) || !empty( $short_desc ) || !empty( $color ) ) { ?>
		    <div class="col-xs-6 col-sm-3 infographic_main">
            <div class="bar">
          <div class="infrographic pie">
            <?php if(!empty( $icon )){ ?>
	            <div class="pie-item">
	              <input class="knob" data-width="120"
	               data-thickness=".15" data-bgcolor="rgba(200,200,200,0.4)" value="0"
	               data-val="<?php echo esc_attr($icon); ?>" data-readonly="true" data-fgcolor="<?php echo esc_attr($color); ?>"
	               readonly="readonly">
	            </div>
            <?php } ?>
            <div class="textP">
              <h3><?php echo esc_html($title); ?></h3>
            </div>
          </div>
          </div>
        </div>
	<?php }
	}
}


/*****************************************
 * WooCommerce Settings Function Area
*******************************************/

/**
 * Product Wishlist Button Function
**/
if (defined( 'YITH_WCWL' )) { 

    function metrostore_wishlist_products() {      
          global $product;
          $url = add_query_arg( 'add_to_wishlist', $product->get_id() );
          $id = $product->get_id();
          $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?> 

            <div class="add-to-wishlist-custom add-to-wishlist-<?php echo esc_attr( $id ); ?>">
                
                <div class="yith-wcwl-add-button show" style="display:block">
                    <a href="<?php echo esc_url( $url ); ?>" data-toggle="tooltip" data-placement="top" rel="nofollow" data-product-id="<?php echo esc_attr( $id ); ?>" data-product-type="simple" title="<?php esc_html__( 'Add to Wishlist', 'metrostore' ); ?>" class="add_to_wishlist">
                        <i class="fa fa-heart-o"></i>
                    </a>                    
                    <!-- <img src="<?php echo get_template_directory_uri() . '/images/loading.gif'; ?>" class="ajax-loading" alt="loading" width="16" height="16"> -->
                </div>                

                <div class="yith-wcwl-wishlistaddedbrowse hide" style="display:none;">
                    <a class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-heart"></i></a>
                </div>

                <div class="yith-wcwl-wishlistexistsbrowse hide" style="display:none">
                    <a  class="link-wishlist" href="<?php echo esc_url( $wishlist_url ); ?>"><i class="fa fa-heart"></i></a>
                </div>

                <div class="clear"></div>
                <div class="yith-wcwl-wishlistaddresponse"></div>

            </div>

         <?php
    }

/**
 * Wishlist Header Count Ajax Function
**/
    if ( ! function_exists( 'metrostore_wishlist' ) ) {
        function metrostore_wishlist() {
            if ( function_exists( 'YITH_WCWL' ) ) { 
                $wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
                    <div class="top-wishlist">
                    <a href="<?php echo esc_url( $wishlist_url ); ?>" title="Wishlist" data-toggle="tooltip">
                        <div class="count">                            
                            <i class="fa fa-heart"></i>
                            <span class="hidden-xs"><?php esc_html_e('Wishlist', 'metrostore'); ?></span>
                            <span class="badge bigcounter"><?php echo yith_wcwl_count_products() ; ?></span>
                        </div>
                    </a>
                    </div>
            <?php
            }
        }
     }
    add_action( 'wp_ajax_yith_wcwl_update_single_product_list', 'metrostore_wishlist' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_single_product_list', 'metrostore_wishlist' );
}

/**
 *  Add the Link to Compare Function
**/

if( defined( 'YITH_WOOCOMPARE' ) ){
    
    function add_compare_link( $product_id = false, $args = array() ) {
        extract( $args );

        if ( ! $product_id ) {
            global $product;
            $productid = $product->get_id();
            $product_id = isset( $productid ) ? $productid : 0;
        }
        
        $is_button = ! isset( $button_or_link ) || ! $button_or_link ? get_option( 'yith_woocompare_is_button' ) : $button_or_link;

        if ( ! isset( $button_text ) || $button_text == 'default' ) {
            $button_text = get_option( 'yith_woocompare_button_text', esc_html__( 'Compare', 'metrostore' ) );
            yit_wpml_register_string( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
            $button_text = yit_wpml_string_translate( 'Plugins', 'plugin_yit_compare_button_text', $button_text );
        }
        printf( '<a title="'. esc_html__( 'Add to Compare', 'metrostore' ) .'" href="%s" class="%s" data-product_id="%d" rel="nofollow"><i class="fa fa-signal"></i></a>', '#', 'compare', $product_id);
    }
    remove_action( 'woocommerce_after_shop_loop_item',  array( 'YITH_Woocompare_Frontend', 'add_compare_link' ), 20 );
}


/**
 *  Add the Link to Quick View Function
**/

if( defined( 'YITH_WCQV' ) ){
    function metrostore_quickview(){
        global $product;
        $quick_view = YITH_WCQV_Frontend();
        remove_action( 'woocommerce_after_shop_loop_item', array( $quick_view, 'yith_add_quick_view_button' ), 15 );
        $label = esc_html( get_option( 'yith-wcqv-button-label' ) );
        echo '<a title="'. esc_html__( 'Quick View', 'metrostore' ) .'" href="#" class="yith-wcqv-button" data-product_id="' . $product->get_id() . '"> 
            <i class="fa fa-search"></i> 
        </a>';
    }
}


/**
 * Metrostore Social Links
**/
if ( ! function_exists( 'metrostore_social_links' ) ) {
    function metrostore_social_links() { ?>
        <div class="f-social  wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="10">
            <ul class="list-inline">
                <?php if (esc_url(get_theme_mod('metrostore_social_facebook'))) :?>
                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_facebook'));?>" <?php if (esc_attr(get_theme_mod('metrostore_social_facebook_checkbox', 0)) == 1): echo "target=_blank"; endif;?>><span class="ion-social-facebook"></span></a> </li>
                <?php endif;?>
                <?php if (esc_url(get_theme_mod('metrostore_social_twitter'))) :?>
                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_twitter')); ?>" <?php if (esc_attr(get_theme_mod('metrostore_social_twitter_checkbox', 0)) == 1): echo "target=_blank"; endif;?>><span class="ion-social-twitter"></span></a> </li>
                <?php endif;?>

                <?php if (esc_url(get_theme_mod('metrostore_social_googleplus'))) :?>
                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_googleplus')); ?>" <?php if (esc_attr(get_theme_mod('metrostore_social_googleplus_checkbox', 0)) == 1): echo "target=_blank"; endif;?>><span class="ion-social-googleplus"></span></a> </li>
                <?php endif;?>

                <?php if (esc_url(get_theme_mod('metrostore_social_instagram'))) : ?>
                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_instagram')) ;?>" <?php if (esc_attr(get_theme_mod('metrostore_social_instagram_checkbox', 0)) == 1): echo "target=_blank"; endif;?>><span class="ion-social-instagram"></span></a> </li>
                <?php endif;?>

                <?php if (esc_url(get_theme_mod('metrostore_social_pinterest'))) : ?>
                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_pinterest')); ?>" <?php if (esc_attr(get_theme_mod('metrostore_social_pinterest_checkbox', 0)) == 1): echo "target=_blank"; endif;?>><span class="ion-social-pinterest"></span></a> </li>
                <?php endif;?>

                <?php if (esc_url(get_theme_mod('metrostore_social_youtube'))) : ?>
                    <li> <a href="<?php echo esc_url(get_theme_mod('metrostore_social_youtube')); ?>" <?php if (esc_attr(get_theme_mod('metrostore_social_youtube_checkbox', 0)) == 1): echo "target=_blank"; endif;?>><span class="ion-social-youtube"></span></a> </li>
                <?php endif;?>
            </ul>
        </div>
      <?php 
    }
}

/**
 * Metrostore WooCommerce Breadcrumbs Function
*/
add_filter( 'woocommerce_breadcrumb_defaults', 'metrostore_woocommerce_breadcrumbs' );
function metrostore_woocommerce_breadcrumbs() {
    return array(
        'delimiter'   => ' &#47; ',
        'wrap_before' => '<div class="woocommerce-breadcrumb" itemprop="breadcrumb">',
        'wrap_after'  => '</div>',
        'before'      => '',
        'after'       => '',
        'home'        => esc_html__( 'Home', 'metrostore'),
    );
}

/**
 * Metrostore Breadcrumbs Function Area
*/
if ( ! function_exists( 'metrostore_breadcrumb_woocommerce' ) ) {    
    function metrostore_breadcrumb_woocommerce() {
        $breadcrumb_options = get_theme_mod('metrostore_breadcrumb_options', 1);
        $breadcrumb_bg_image = get_theme_mod('metrostore_breadcrumbs_bg_image');
        if($breadcrumb_bg_image){
            $breadcrumb_bg_image = $breadcrumb_bg_image;
        }else{
          $breadcrumb_bg_image = get_template_directory_uri().'/assets/images/about.jpg';
        }
        if($breadcrumb_options == '1') { ?>
            <div class="page_header_wrap" style="background:url('<?php echo esc_url($breadcrumb_bg_image); ?>') no-repeat center; background-size: cover; background-attachment:fixed;">
                <div class="container">
                    <?php if( is_search() ) { ?>                    
                        <header class="entry-header">
                            <h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'metrostore' ), '<span style="background:#ff3366">' . get_search_query() . '</span>' ); ?><h1>
                        </header><!-- .page-header -->
                    <?php }elseif( is_404() ) { ?>                    
                        <header class="entry-header">
                            <h1 class="entry-title"><?php esc_html_e('404','metrostore'); ?><h1>
                        </header><!-- .page-header -->
                    <?php }else{ ?>
                        <header class="entry-header">                   
                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        </header><!-- .entry-header -->
                    <?php } ?>
                    <?php if( metrostore_is_woocommerce_activated() ){ woocommerce_breadcrumb(); } ?>
                </div>
            </div>
        <?php }
    }
}
add_action( 'breadcrumb-woocommerce', 'metrostore_breadcrumb_woocommerce' );

/**
 * The Excerpt [...] remove function
*/
function metrostore_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'metrostore_excerpt_more');

/**
 * MetroStore Comment Callback function
*/
if ( ! function_exists( 'metrostore_comment' ) ) {
  function metrostore_comment($comment, $args, $depth) { ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment-wrapper media" id="comment-<?php comment_ID(); ?>">
            <a href="javascript();" class="pull-left">
              <?php echo get_avatar($comment, $size ='100'); ?>
            </a>
            <?php if ($comment->comment_approved == '0') : ?>
                 <em><?php esc_html_e('Your comment is awaiting moderation.','metrostore') ?></em>                
            <?php endif; ?>
            <div class="media-body">
                <div>
                    <?php printf(__('<h4 class="media-heading">%s</h4>','metrostore'), get_comment_author_link()) ?>
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                      <?php printf(__('%1$s at %2$s','metrostore'), get_comment_date(),  get_comment_time()) ?>
                    </a>
                </div>
                  <?php comment_text() ?>
                <div class="fsprorow">
                    <div class="comment-left">
                        <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                </div>
            </div>
        </div>
  <?php
  }
}



/**
 * Page and Post Display Layout Metabox function
*/ 
add_action('add_meta_boxes', 'metrostore_metabox_section');
if ( ! function_exists( 'metrostore_metabox_section' ) ) {  
    function metrostore_metabox_section(){   
        add_meta_box('metrostore_display_layout', 
            esc_html__( 'Display Layout Options', 'metrostore' ), 
            'metrostore_display_layout_callback', 
            array('page','post'), 
            'normal', 
            'high'
        );        
    }
}

$metrostore_page_layouts =array(
    'leftsidebar' => array(
      'value'     => 'leftsidebar',
      'label'     => esc_html__( 'Left Sidebar', 'metrostore' ),
      'thumbnail' => get_template_directory_uri() . '/assets/images/left-sidebar.png',
    ),
    'rightsidebar' => array(
      'value'     => 'rightsidebar',
      'label'     => esc_html__( 'Right (Default)', 'metrostore' ),
      'thumbnail' => get_template_directory_uri() . '/assets/images/right-sidebar.png',
    ),
    'nosidebar' => array(
      'value'     => 'nosidebar',
      'label'     => esc_html__( 'Full width', 'metrostore' ),
      'thumbnail' => get_template_directory_uri() . '/assets/images/no-sidebar.png',
    )
);

/**
 * Function for Page layout meta box
*/
if ( ! function_exists( 'metrostore_display_layout_callback' ) ) {
    function metrostore_display_layout_callback(){
        global $post, $metrostore_page_layouts;
        wp_nonce_field( basename( __FILE__ ), 'metrostore_settings_nonce' );
    ?>
        <table class="form-table">
            <tr>
              <td>            
                <?php
                  $i = 0;  
                  foreach ($metrostore_page_layouts as $field) {  
                  $metrostore_page_metalayouts = get_post_meta( $post->ID, 'metrostore_page_layouts', true ); 
                ?>            
                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo intval($i); ?>" style="float:left; margin-right:30px;">
                    <label class="description">
                        <span>
                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
                        </span></br>
                        <input type="radio" name="metrostore_page_layouts" value="<?php echo esc_attr($field['value']); ?>" <?php checked( $field['value'], 
                            $metrostore_page_metalayouts ); if(empty($metrostore_page_metalayouts) && $field['value']=='rightsidebar'){ echo "checked='checked'";  } ?>/>
                         <?php echo esc_attr($field['label']); ?>
                    </label>
                  </div>
                <?php  $i++; }  ?>
              </td>
            </tr>            
        </table>
    <?php
    }
}

/**
 * Save the custom metabox data
*/ 
if ( ! function_exists( 'metrostore_save_page_settings' ) ) {
    function metrostore_save_page_settings( $post_id ) { 
        global $metrostore_page_layouts, $post; 
        if ( !isset( $_POST[ 'metrostore_settings_nonce' ] ) || !wp_verify_nonce( wp_unslash( $_POST[ 'metrostore_settings_nonce' ] ), basename( __FILE__ ) ) )
            return;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
            return;        
        if ('page' == $_POST['post_type']) {  
            if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
        } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
        }    
        foreach ($metrostore_page_layouts as $field) {  
            $old = get_post_meta( $post_id, 'metrostore_page_layouts', true); 
            $new = sanitize_text_field($_POST['metrostore_page_layouts']);
            if ($new && $new != $old) {  
                update_post_meta($post_id, 'metrostore_page_layouts', $new);  
            } elseif ('' == $new && $old) {  
                delete_post_meta($post_id,'metrostore_page_layouts', $old);  
            } 
         } 
    }
}
add_action('save_post', 'metrostore_save_page_settings');
