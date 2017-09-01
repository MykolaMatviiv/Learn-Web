<?php

if ( ! function_exists( 'metrostore_mobile_menu' ) ) {
	function metrostore_mobile_menu() { 
		 wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => 'mobile-menu', 'menu_class' => '', 'fallback_cb' => false ) ); 
	}
}
add_action( 'metrostore-mobile-menu', 'metrostore_mobile_menu', 5 );


/**
 * Header Section Skip Area
*/

if ( ! function_exists( 'metrostore_skip_links' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function metrostore_skip_links() { ?>
			<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'metrostore' ); ?></a>
		<?php
	}
}
add_action( 'metrostore_skip_links', 'metrostore_skip_links', 5 );


if ( ! function_exists( 'metrostore_header_before' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function metrostore_header_before() {
		?>
		<header id="masthead" class="site-header" role="banner">		
			<div class="header-container">
		<?php
	}
}
add_action( 'metrostore_header_before', 'metrostore_header_before', 10 );


if ( ! function_exists( 'metrostore_top_header' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function metrostore_top_header() {
		?>
			<div class="header-top">
			  <div class="container">
			    <div class="row">
			      
				    <div class="quickinfo_main pull-left hidden-xs">
        				<ul class="quickinfo">
        					<?php
        						$email_address    = get_theme_mod('metrostore_email_title');
        						$phone_number     = get_theme_mod('metrostore_phone_number');
        						$phonenumber      = preg_replace("/[^0-9]/","",$phone_number);
        						$map_address      = get_theme_mod('metrostore_map_address');
        						$shop_open_time   = get_theme_mod('metrostore_start_open_time');
        					
        					if(!empty( $email_address )) { ?>        							
        	                    <li>
        	                    	<a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>">
        	                    		<i class="fa fa-envelope"></i>
        	                    		<?php echo esc_attr( antispambot( $email_address ) ); ?>
        	                    	</a>
        	                    </li>
                            <?php }  ?>
                            
                            <?php if(!empty( $phone_number )) { ?>        							
        	                    <li>
        	                    	<i class="fa fa-phone"></i>
        	                    	<a href="tel:<?php echo esc_attr( $phonenumber ); ?>">
        	                    		<?php echo esc_attr( $phone_number ); ?>
        	                    	</a>
        	                    </li>
                            <?php }  ?>
                            
                            <?php if(!empty( $map_address )) { ?>        							
        	                    <li>        	                    	
    	                    		<i class="fa fa-map"></i>
    	                    		<?php echo esc_attr( $map_address ); ?>
        	                    </li>
                            <?php }  ?>
                            
                            <?php if(!empty( $shop_open_time )) { ?>        							
        	                    <li>
        	                    	<i class="fa fa-clock-o"></i>
        	                    	<?php echo esc_attr( $shop_open_time ); ?>
        	                    </li>
                            <?php }  ?>        	                    
        				</ul>
				        
				    </div>

				    <div class="headerlinkmenu pull-right">
				        <div class="links">
				          	<?php if(function_exists( 'metrostore_wishlist' )) {  ?>
					          	<div class="wishlist">
					          		<?php metrostore_wishlist(); ?>
					          	</div>
				          	<?php } ?>
				          	
				          	<?php if (is_user_logged_in()) { ?>	

					          	<div class="myaccount">
					          		<a title="My Account" href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
					          			<i class="fa fa-user"></i>
					          			<span class="hidden-xs"><?php esc_html_e('My Account', 'metrostore'); ?></span>
					          		</a>
					          	</div>

					          	<div class="login">
					          		<a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
					          			<i class="fa fa-lock"></i>
					          			<span class="hidden-xs"><?php esc_html_e('Log Out', 'metrostore'); ?></span>
					          		</a>
					          	</div>

				          	<?php } else{ ?>

					            <div class="login">
					          		<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
					          			<i class="fa fa-unlock-alt"></i>
					          			<span class="hidden-xs"><?php esc_html_e('Log In', 'metrostore'); ?></span>
					          		</a>
					          	</div>
					          
					          	<div class="login">
						          	<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">
							          	<i class="fa fa-user"></i>
							          	<span class="hidden-xs"><?php esc_html_e('Register', 'metrostore'); ?></span>
							        </a>
					          	</div>

				          	<?php } ?>
				    	</div>
			      	</div>

			    </div>
			  </div>
			</div><!-- End header-top -->
		<?php
	}
}
add_action( 'metrostore_header', 'metrostore_top_header', 15 );

if ( ! function_exists( 'metrostore_main_header' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function metrostore_main_header() {
		?>
			<div class="container logo_nav">
		        <div class="row">		          
		          <div class="col-md-3 col-sm-6 col-xs-12">
		            <div class="logo site-branding">
		            	<?php
		            		if ( function_exists( 'the_custom_logo' ) ) {
		            			the_custom_logo();
		            		}
		            	?>
		            	<h1 class="site-title">
		            		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		            			<?php bloginfo( 'name' ); ?>
		            		</a>
		            	</h1>
		            	<?php
		            		$description = get_bloginfo( 'description', 'display' );
		            		if ( $description || is_customize_preview() ) : 
		            	?>
		            		<p class="site-description"><?php echo $description; ?></p>
		            	<?php endif; ?>
		            </div><!-- .site-branding -->
		          </div>
		          
		          <!--support client-->
		          <div class="col-md-6 hidden-sm hidden-xs">
		            <div class="support-client">
		              <div class="row">
		                <div class="col-md-6">
		                  <div class="box-container fa <?php echo esc_attr( get_theme_mod( 'metrostore_first_icon_block_area') ); ?>">
		                    <div class="box-inner">
		                      <h2><?php echo esc_attr( get_theme_mod( 'metrostore_first_icon_title_area') ); ?></h2>
		                      <p><?php echo esc_html( get_theme_mod( 'metrostore_first_icon_title_desc_area') ); ?></p>
		                    </div>
		                  </div>
		                </div>
		                <div class="col-md-6 ">
		                  <div class="box-container fa <?php echo esc_attr( get_theme_mod( 'metrostore_second_icon_block_area') ); ?>">
		                    <div class="box-inner">
		                        <h2><?php echo esc_attr( get_theme_mod( 'metrostore_second_icon_title_area') ); ?></h2>
		                        <p><?php echo esc_html( get_theme_mod( 'metrostore_second_icon_title_desc_area') ); ?></p>
		                    </div>
		                  </div>
		                </div>
		              </div>
		            </div>
		          </div>
		          <!-- top cart -->
		          
		          <div class="col-md-3 col-sm-6 top-cart">
		            <div class="mm-toggle-wrap">
						<div class="mm-toggle">
							<i class="fa fa-align-justify"></i>
							<span class="mm-label"><?php esc_html_e('Menu','metrostore'); ?></span> 
						</div>
		            </div>
		            <?php if( metrostore_is_woocommerce_activated() ){ ?>
		            	<div class="top-cart-contain">
			              <div class="mini-cart">
			                <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle">
			                	<?php metrostore_cart_link(); ?>
			                </div>
			                <div>
			                    <div class="top-cart-content">
			                    	<div class="block-subtitle"><?php esc_html_e('Recently added item(s)','metrostore'); ?></div>
			                    	<?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
			                    </div>
			                </div>
			              </div>
		            	</div>
		            <?php } ?>
		          </div>
		        </div>
		    </div><!-- End Main Header -->
		<?php
	}
}
add_action( 'metrostore_header', 'metrostore_main_header', 20 );

if ( ! function_exists( 'metrostore_header_after' ) ) {
	/**
	 * Skip links
	 * @since  1.0.0
	 * @return void
	 */
	function metrostore_header_after() {
		?>
			</div>
		</header><!-- #masthead -->
		<?php
	}
}
add_action( 'metrostore_header_after', 'metrostore_header_after', 25 );



