<?php
/**
 * Displays the header content
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php
$city_store_settings = city_store_get_theme_options(); ?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<!-- Masthead ============================================= -->
<header id="masthead" class="site-header">
		<div class="top-header">
			<div class="container clearfix">
					<?php
					if($city_store_settings['city_store_top_social_icons'] == 0): ?>
						<div class="header-social-block">
								<?php do_action('city_store_social_links'); ?>
						</div><!-- end .header-social-block -->
						<div id="search-toggle" class="header-search"></div>
						<div id="search-box" class="clearfix">
							<?php get_search_form();?>
						</div>  <!-- end #search-box -->
					<?php if(function_exists('city_store_wcmenucart')):
                        $is_cart = is_cart();
                        echo wp_kses_post(city_store_wcmenucart($is_cart));
					endif; ?>
				</div>
		</div> <!-- end .container -->

				<?php endif; ?>
		<div class="nav-wrapper">

				<div id="sticky_header">
					<div class="container clearfix">
						<div class="city-store-site-branding">
						 	<?php do_action('city_store_site_branding'); ?>
						</div>
						<div class="menu-toggle">
							<div class="line-one"></div>
				  			<div class="line-two"></div>
				  			<div class="line-three"></div>
					  	</div>
					  	<!-- end .menu-toggle -->
					  	<h3 class="nav-site-title">
					  		<?php if (has_custom_logo()) {the_custom_logo();} else { ?>
								<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>"><?php bloginfo('name');?></a>
							<?php } ?>
						</h3>
					<!-- end .nav-site-title -->
						<!-- Main Nav ============================================= -->
						<?php
							if (has_nav_menu('primary')) { ?>
						<?php $args = array(
							'theme_location' => 'primary',
							'container'      => '',
							'items_wrap'     => '<ul class="menu">%3$s</ul>',
							); ?>
						<nav id="site-navigation" class="main-navigation clearfix">
							<?php wp_nav_menu($args);//extract the content from apperance-> nav menu ?>
						</nav> <!-- end #site-navigation -->
						<?php } else {// extract the content from page menu only ?>
						<nav id="site-navigation" class="main-navigation clearfix">
							<?php	wp_page_menu(array('menu_class' => 'menu')); ?>
						</nav> <!-- end #site-navigation -->
						<?php }
				echo '</div> <!-- end .container -->
				</div> <!-- end #sticky_header -->';?>
		</div> <!-- end .top-header -->
		<!-- Main Header============================================= -->

		<?php
		if (! is_front_page()) {
			do_action('city_store_header_image');
		}
		city_store_slider_value();

			if(is_front_page() || is_page_template('page-templates/home-template.php' )) {
						city_store_page_sliders();
			}

		 ?>

</header> <!-- end #masthead -->
<!-- Main Page Start ============================================= -->
<div id="content">

<?php
if( !is_page_template('page-templates/home-template.php')){?>
	<div class="container clearfix">
		<?php if(!is_home()){ ?>
			<div class="page-header">
				<h2 class="page-title"><?php echo wp_kses_post(get_the_archive_title()); ?></h2>
				<!-- .page-title -->
			</div>
			<!-- .page-header -->
		<?php }
} ?>
