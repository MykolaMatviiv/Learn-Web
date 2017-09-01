<?php
/**
 * Display all City Store functions and definitions
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'city_store_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function city_store_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=790;
	}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on City Store, use a find and replace
	 * to change 'city-store' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'city-store', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'city-store' ),
	) );

	/*
	* Enable support for custom logo.
	*
	*/
	add_theme_support( 'custom-logo', array(
		'flex-width' => true,
		'flex-height' => true,
	) );

	//Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'city_store_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_editor_style( get_template_directory(). '/assets/css/editor-style.css' );

	/**
	* Making the theme WooCommerce compatible
	*/

	add_theme_support( 'woocommerce' );
    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // city_store_setup
add_action( 'after_setup_theme', 'city_store_setup' );

/***************************************************************************************/
function city_store_content_width() {
	if ( is_page_template( 'page-templates/gallery-template.php' ) || is_attachment() ) {
		global $content_width;
		$content_width = 1170;
	}
}
add_action( 'template_redirect', 'city_store_content_width' );

/***************************************************************************************/
if(!function_exists('city_store_get_theme_options')):
	function city_store_get_theme_options() {
	    return wp_parse_args(  get_option( 'city_store_theme_options', array() ), city_store_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/city-store-default-values.php';
require( get_template_directory() . '/inc/settings/city-store-functions.php' );
require( get_template_directory() . '/inc/settings/city-store-common-functions.php' );
require( get_template_directory() . '/inc/settings/city-store-tgmp.php' );
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/footer-details.php';

//TGMPA plugin
require get_template_directory() . '/plugin-activation.php';

/************************ City Store Widgets  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';

/************************ City Store Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';

function city_store_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '#site-title a',
			'container_inclusive' => false,
			'render_callback' => 'city_store_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '#site-description',
			'container_inclusive' => false,
			'render_callback' => 'city_store_customize_partial_blogdescription',
		) );
	}
	require get_template_directory() . '/inc/customizer/functions/customizer-control.php';
	require get_template_directory() . '/inc/customizer/functions/contact-us-customizer.php';
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/social-icons.php';
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;

}
require get_template_directory() . '/inc/customizer/functions/class-pro-discount.php';

/**
* Render the site title for the selective refresh partial.
* @see city_store_customize_register()
* @return void
*/
function city_store_customize_partial_blogname() {
bloginfo( 'name' );
}

/**
* Render the site tagline for the selective refresh partial.
* @see city_store_customize_register()
* @return void
*/
function city_store_customize_partial_blogdescription() {
bloginfo( 'description' );
}

add_action( 'customize_register', 'city_store_customize_register' );
/**
* Enqueue script for custom customize control.
*/
function theme_slug_custom_customize_enqueue() {
    wp_enqueue_style( 'city-store-customizer-style', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/css/customizer-control.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'theme_slug_custom_customize_enqueue' );


/******************* City Store Header Display *************************/
function city_store_header_display(){
	?>
	<div id="site-branding">
		<?php if ( has_custom_logo() ) {

			the_custom_logo();

			echo '<p id="site-description">';
			  bloginfo('description');
			 echo '</p>';

		 } else { ?>
			<h1 id="site-title">
				<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>

			</h1>  <!-- end .site-title -->
			<p id ="site-description"> <?php bloginfo('description');?> </p> <!-- end #site-description -->
		<?php } ?>
	</div> <!-- end #site-branding -->
	<?php
}
add_action('city_store_site_branding','city_store_header_display');

if ( ! function_exists( 'city_store_the_custom_logo' ) ) :
 	/**
 	 * Displays the optional custom logo.
 	 * Does nothing if the custom logo is not available.
 	 */
 	function city_store_the_custom_logo() {
 	    if ( function_exists( 'the_custom_logo' ) ) {
 	        the_custom_logo();
 	    }
 	}
 	endif;

/* Header Image */
function city_store_header_image_display(){
	$city_store_header_image = get_header_image();
	$city_store_settings = city_store_get_theme_options();
	if(!empty($city_store_header_image) ){
		 ?>
		<a href="<?php echo esc_url(home_url('/'));?>"><img src="<?php echo esc_url($city_store_header_image);?>" class="header-image" width="<?php echo esc_attr(get_custom_header()->width);?>" height="<?php echo esc_attr(get_custom_header()->height);?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"> </a>
	<?php
	}
}
add_action('city_store_header_image','city_store_header_image_display');

if ( ! function_exists('city_store_wcmenucart') && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {


        function city_store_wcmenucart($data) {

            ob_start();
                global $woocommerce;
                $viewing_cart = __('View your shopping cart', 'city-store');
                $start_shopping = __('Start shopping', 'city-store');
                $cart_url = $woocommerce->cart->get_cart_url();
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                $cart_contents_count = $woocommerce->cart->cart_contents_count;
                $cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'city-store'), $cart_contents_count);
                $cart_total = $woocommerce->cart->get_cart_total();
                $cartdetail = $data;

            $display_cart = do_shortcode('[woocommerce_cart]');

                // Uncomment the line below to hide nav menu cart item when there are no items in the cart
                $menu_item = '<nav id="city-store-woocart-navigation" class="main-navigation clearfix">';
                if ( $cart_contents_count > 0 ) {

                    $menu_item .= '<ul class="menu">';
                    if ($cart_contents_count == 0) {
                        $menu_item .= '<li class="dropdown woo-dropdown-cart"><a class="wcmenucart-contents dropdown-toggle" href="'. esc_url($shop_page_url) .'" title="'. esc_attr($start_shopping) .'">';
                    } else {
                        $menu_item .= '<li class="dropdown woo-dropdown-cart"><a class="wcmenucart-contents dropdown-toggle" href="'. esc_url($cart_url) .'" title="'. esc_attr($viewing_cart) .'">';
                    }

                    $menu_item .= '<i class="fa fa-shopping-cart"></i> ';

                    $menu_item .= $cart_contents;
                    // $menu_item .= $cart_contents.' - '. $cart_total;
                    if(!$cartdetail) {
                        $menu_item .= ' <span class="caret"></span></a>';
                        $menu_item .= '<ul role="menu" class="dropdown-menu dropdown-cart">';
                        $menu_item .= '<li class="menu-item">' . $display_cart . '</li>';
                        $menu_item .= '</ul></li></ul>';
                    }
                    // Uncomment the line below to hide nav menu cart item when there are no items in the cart
                }
                    $menu_item .= '</nav>';
                    echo $menu_item;


            $social = ob_get_clean();
            return $social;

        }

        // add_filter('wp_nav_menu_items','city_store_wcmenucart', 10, 2);
    }


    add_filter('add_to_cart_fragments', 'city_store_woocommerce_header_add_to_cart_fragment');

    function city_store_woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    $data = '';
    ob_start();


    $fragments['#city-store-woocart-navigation'] = city_store_wcmenucart($data);

    return $fragments;

    }

function woocommerce_content() {

        $loop = 4;
    if ( is_singular( 'product' ) ) {

        while ( have_posts() ) : the_post();

            wc_get_template_part( 'content', 'single-product' );

        endwhile;

    } else { ?>

        <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

            <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

        <?php endif; ?>

        <?php do_action( 'woocommerce_archive_description' ); ?>

        <?php if ( have_posts() ) : ?>

            <?php do_action( 'woocommerce_before_shop_loop' ); ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>

            <?php while ( have_posts() ) : the_post(); ?>
                <?php echo (($loop%4==0)?'<div class="row">':''); ?>
                <?php wc_get_template_part( 'content', 'product' ); ?>
                <?php echo (($loop%4==3)?'</div>':''); ?>
            <?php $loop++; endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php do_action( 'woocommerce_after_shop_loop' ); ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php do_action( 'woocommerce_no_products_found' ); ?>

        <?php endif;

    }
}