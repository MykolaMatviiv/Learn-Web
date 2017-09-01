<?php
/**
 * Woo Commerce Add Content Primary Div Function
*/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('metrostore_woocommerce_output_content_wrapper')) {
    function metrostore_woocommerce_output_content_wrapper(){ ?>
        <div class="main-container">
		    <div class="container">
		      	<div class="row">
		      		<div class="content-area col-main col-sm-9">
    <?php   }
}
add_action( 'woocommerce_before_main_content', 'metrostore_woocommerce_output_content_wrapper', 10 );


remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
if (!function_exists('metrostore_woocommerce_output_content_wrapper_end')) {
    function metrostore_woocommerce_output_content_wrapper_end(){ ?>
            		</div>
            		<?php get_sidebar('woocommerce'); ?>
            	</div><!-- row -->
        	</div><!-- container -->
        </div><!-- main-container -->
    <?php   }
}
add_action( 'woocommerce_after_main_content', 'metrostore_woocommerce_output_content_wrapper_end', 10 );

/**
 * WooCommerce Manage Product Div Structure
*/
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

if (!function_exists('metrostore_woocommerce_before_shop_loop_item')) {
    function metrostore_woocommerce_before_shop_loop_item(){ ?>
        	<div class="product-item">
                <div class="item-inner">

                	<div class="product-thumbnail">

                        <?php global $post, $product; if ( $product->is_on_sale() ) : 
                            echo apply_filters( 'woocommerce_sale_flash', '<div class="icon-sale-label sale-left">' . esc_html__( 'Sale', 'metrostore' ) . '</div>', $post, $product ); ?>
                        <?php endif; ?>
                        <?php
                            global $metrostore_label;
                            if ($metrostore_label != ''){
                                echo '<div class="icon-new-label new-right">'.esc_html__('New','metrostore').'</div>';
                            }
                        ?>
                   	  
                    	<div class="pr-img-area">
                    	    <figure>
                                <?php echo get_the_post_thumbnail( $product->get_id() , 'shop_catalog', array( 'class' => 'first-img' ) ); ?> 
                                <?php echo get_the_post_thumbnail( $product->get_id() , 'shop_catalog', array( 'class' => 'hover-img' ) ); ?> 
                                <?php //the_post_thumbnail( array('class'=>'hover-img') ); ?>
                                  <!-- <img class="first-img" src="<?php echo get_the_post_thumbnail(); ?>" alt=""> 
                                  <img class="hover-img" src="<?php echo get_the_post_thumbnail(); ?>" alt=""> -->
                    	       <?php //echo woocommerce_get_product_thumbnail(); ?>
                    	    </figure>
                            <div class="add-to-cart-mt">                	      
                    	       <?php woocommerce_template_loop_add_to_cart(); ?> 
                    	    </div>

                    	</div>
                	  
                    	<div class="pr-info-area">
                    	    <div class="pr-button">
                        	    <div class="mt-button add_to_wishlist">
                                    <?php if(function_exists( 'metrostore_wishlist_products' )) { metrostore_wishlist_products(); } ?> 
                                </div>
                        	    <div class="mt-button add_to_compare"> 
                                    <?php if(function_exists( 'add_compare_link' )) { add_compare_link(); } ?>                                   
                                </div>
                        	    <div class="mt-button quick-view"> 
                                    <?php if(function_exists( 'metrostore_quickview' )) { metrostore_quickview(); } ?>
                                </div>
                    	    </div>
                    	</div>
                	</div>

                    <div class="item-info">
                        <div class="info-inner">
                            <div class="item-title"> 
                                <h3>
                                    <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </div>

                            <div class="item-content">
                              <div class="rating">
                                <?php woocommerce_template_loop_rating(); ?>
                              </div>
                              <div class="item-price">
                                <?php woocommerce_template_loop_price(); ?>
                              </div>
                            </div>
                        </div>
                    </div>
    <?php  }
}
add_action( 'woocommerce_before_shop_loop_item', 'metrostore_woocommerce_before_shop_loop_item', 9 );


if (!function_exists('metrostore_woocommerce_after_shop_loop_item')) {
    function metrostore_woocommerce_after_shop_loop_item(){ ?>
        		</div>
            </div>
    <?php  }
}
add_action( 'woocommerce_after_shop_loop_item', 'metrostore_woocommerce_after_shop_loop_item', 11 );


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );


/**
 *
*/
if( !function_exists( 'metrostore_woocommerce_result_count' )){
    function metrostore_woocommerce_result_count(){
        echo '<div class="toolbar">';
    }
}

add_action( 'woocommerce_before_shop_loop','metrostore_woocommerce_result_count', 14 );

if( !function_exists( 'metrostore_woocommerce_catalog_ordering' )){
    function metrostore_woocommerce_catalog_ordering(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop','metrostore_woocommerce_catalog_ordering', 36);


/**
 * WooCommerce Breadcrumbs Section
*/
if( !function_exists( 'metrostore_woocommerce_breadcrumb' )){
    function metrostore_woocommerce_breadcrumb(){
      do_action( 'breadcrumb-woocommerce' );
    }
}
add_action( 'woocommerce_before_main_content','metrostore_woocommerce_breadcrumb', 9 );



/**
 * WooCommerce Number of row filter Function
*/
add_filter('loop_shop_columns', 'metrostore_loop_columns');
if (!function_exists('metrostore_loop_columns')) {
    function metrostore_loop_columns() {
        $xr = 3;
        return $xr;
    }
}

add_action( 'body_class', 'metrostore_woo_body_class');
if (!function_exists('metrostore_woo_body_class')) {
    function metrostore_woo_body_class( $class ) {
       $class[] = 'columns-'.metrostore_loop_columns();
       return $class;
    }
}

/**
 * WooCommerce display related product.
*/
if (!function_exists('metrostore_related_products_args')) {
  function metrostore_related_products_args( $args ) {
      $args['columns']   = 3;
      return $args;
  }
}
add_filter( 'woocommerce_output_related_products_args', 'metrostore_related_products_args' );

/**
 * WooCommerce display Upsell product.
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
if ( ! function_exists( 'metrostore_woocommerce_output_upsells' ) ) {
    function metrostore_woocommerce_output_upsells() {
        woocommerce_upsell_display( 3,3 ); 
    }
}
add_action( 'woocommerce_after_single_product_summary', 'metrostore_woocommerce_output_upsells', 15 );


/**
 * Tabs Category Products Ajax Function
*/
if ( ! function_exists( 'metrostore_tabs_ajax_action' ) ) {
    function metrostore_tabs_ajax_action() {
            $cat_slug     = $_POST['category_slug'];
            $product_num  = $_POST['product_num'];
            ob_start();
        ?>

        <div class="tab-pane active in" id="<?php echo esc_attr( $cat_slug ); ?>">
              <div class="new-arrivals-pro">
                <div class="slider-items-products">
                  <div id="tabs-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4">
                      
                      <?php 
                        $product_args = array(
                            'post_type' => 'product',
                            'tax_query' => array(
                                array(
                                    'taxonomy'  => 'product_cat',
                                    'field'     => 'slug', 
                                    'terms'     => $cat_slug                                                                 
                                )),
                            'posts_per_page' => $product_num
                        );
                        $query = new WP_Query($product_args);

                          if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                      ?>
                          <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                          
                      <?php } } wp_reset_postdata(); ?>
                    </div>
                  </div>
                </div>
              </div>
        </div>

        <?php
            $sv_html = ob_get_contents();
            ob_get_clean();
            echo $sv_html;
        die();
    }
}
add_action( 'wp_ajax_metrostore_tabs_ajax_action', 'metrostore_tabs_ajax_action' );
add_action( 'wp_ajax_nopriv_metrostore_tabs_ajax_action', 'metrostore_tabs_ajax_action' );


/**
 * Shopping cart button function area
*/
if ( ! function_exists( 'metrostore_cart_link' ) ) {
  function metrostore_cart_link() { ?>
        <a class="cart-contents" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'shopping cart', 'metrostore' ); ?>">
            <i class="fa fa-shopping-cart"></i>
            <span class="count">
                <?php esc_html_e( 'Shopping Cart', 'metrostore' ); ?> ( <?php echo WC()->cart->get_cart_contents_count(); ?> )
            </span>
        </a>
    <?php
  }
}

/**
 * Shopping cart button Ajax function area
*/
if ( ! function_exists( 'metrostore_cart_link_fragment' ) ) {
  function metrostore_cart_link_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
        metrostore_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
  }
}
add_filter( 'woocommerce_add_to_cart_fragments', 'metrostore_cart_link_fragment' );