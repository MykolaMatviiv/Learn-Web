<?php
/**
 * About page of metrostore Theme
 *
 * @package Sparkle Themes
 * @subpackage metrostore
 * @since 1.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'metrostore_About' ) ) :

class metrostore_About {

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
		add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
	}

	/**
	 * Add admin menu.
	 */
	public function admin_menu() {
		$theme = wp_get_theme( get_template() );

		$page = add_theme_page( esc_html__( 'About', 'metrostore' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'metrostore' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'metrostore-welcome', array( $this, 'welcome_screen' ) );
		add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
	}

	/**
	 * Enqueue styles.
	*/
	public function enqueue_styles() {
		global $metrostore_version;
		wp_enqueue_style( 'metrostore-about-theme', get_template_directory_uri() . '/sparklethemes/admin/about-theme/about.css', array(), $metrostore_version );
	}

	/**
	 * Add admin notice.
	*/
	public function admin_notice() {
		global $metrostore_version, $pagenow;
		// Let's bail on theme activation.
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			update_option( 'metrostore_admin_notice_welcome', 1 );

		// No option? Let run the notice wizard again..
		} elseif( ! get_option( 'metrostore_admin_notice_welcome' ) ) {
			add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
		}
	}

	/**
	 * Hide a notice if the GET variable is set.
	 */
	public static function hide_notices() {
		if ( isset( $_GET['metrostore-hide-notice'] ) && isset( $_GET['_metrostore_notice_nonce'] ) ) {
			if ( ! wp_verify_nonce( $_GET['_metrostore_notice_nonce'], 'metrostore_hide_notices_nonce' ) ) {
				wp_die( __( 'Action failed. Please refresh the page and retry.', 'metrostore' ) );
			}

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( __( 'Cheatin&#8217; huh?', 'metrostore' ) );
			}

			$hide_notice = sanitize_text_field( $_GET['metrostore-hide-notice'] );
			update_option( 'metrostore_admin_notice_' . $hide_notice, 1 );
		}
	}

	/**
	 * Show welcome notice.
	 */
	public function welcome_notice() {
		?>
		<div id="message" class="updated metrostore-message">
			<a class="metrostore-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'metrostore-hide-notice', 'welcome' ) ), 'metrostore_hide_notices_nonce', '_metrostore_notice_nonce' ) ); ?>"><?php esc_html_e( 'Dismiss', 'metrostore' ); ?></a>
			<p><?php printf( esc_html__( 'Welcome! Thank you for choosing metrostore! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'metrostore' ), '<a href="' . esc_url( admin_url( 'themes.php?page=metrostore-welcome' ) ) . '">', '</a>' ); ?></p>
			<p class="submit">
				<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=metrostore-welcome' ) ); ?>"><?php esc_html_e( 'Get started with metrostore', 'metrostore' ); ?></a>
			</p>
		</div>
		<?php
	}

	/**
	 * Intro text/links shown to all about pages.
	 *
	 * @access private
	 */
	private function intro() {
		global $metrostore_version;
		$theme = wp_get_theme( get_template() );

		// Drop minor version if 0
		//$major_version = substr( $metrostore_version, 0, 3 );
		?>
		<div class="metrostore-theme-info">
				<h1>
					<?php esc_html_e('About', 'metrostore'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $metrostore_version ); ?>
				</h1>

			<div class="welcome-description-wrap">
				<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

				<div class="metrostore-screenshot">
					<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.jpg'; ?>" />
				</div>
			</div>
		</div>

		<p class="metrostore-actions">
			<a href="<?php echo esc_url( 'https://www.sparklewpthemes.com/wordpress-themes/metrostore/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'metrostore' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'metrostore_pro_theme_url', 'http://demo.sparklewpthemes.com/metrostore/demos/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'metrostore' ); ?></a>			

			<a href="<?php echo esc_url( apply_filters( 'metrostore_pro_theme_url', 'https://wordpress.org/support/theme/metrostore/reviews/?filter=5' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'metrostore' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'metrostore_pro_theme_url', 'https://www.sparklewpthemes.com/wordpress-themes/metrostorepro' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'metrostore' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'metrostore_pro_theme_url', 'https://www.sparklewpthemes.com/wordpress-themes/metrostorepro' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'Buy Now', 'metrostore' ); ?></a>

			<a href="<?php echo esc_url( apply_filters( 'metrostore_pro_theme_url', 'http://demo.sparklewpthemes.com/metrostorepro/demos/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'Pro View Demo', 'metrostore' ); ?></a>
		</p>

		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'metrostore-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'metrostore-welcome' ), 'themes.php' ) ) ); ?>">
				<?php echo $theme->display( 'Name' ); ?>
			</a>
			
			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'metrostore-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Free Vs Pro', 'metrostore' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'more_themes' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'metrostore-welcome', 'tab' => 'more_themes' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'More Themes', 'metrostore' ); ?>
			</a>

			<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'metrostore-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
				<?php esc_html_e( 'Changelog', 'metrostore' ); ?>
			</a>
		</h2>
		<?php
	}

	/**
	 * Welcome screen page.
	 */
	public function welcome_screen() {
		$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

		// Look for a {$current_tab}_screen method.
		if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
			return $this->{ $current_tab . '_screen' }();
		}

		// Fallback to about screen.
		return $this->about_screen();
	}

	/**
	 * Output the about screen.
	 */
	public function about_screen() {
		$theme = wp_get_theme( get_template() );
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<div class="changelog point-releases">
				<div class="under-the-hood two-col">
					<div class="col">
						<h3><?php esc_html_e( 'Theme Customizer', 'metrostore' ); ?></h3>
						<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'metrostore' ) ?></p>
						<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'metrostore' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Documentation', 'metrostore' ); ?></h3>
						<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'metrostore' ) ?></p>
						<p><a href="<?php echo esc_url( 'http://docs.sparklewpthemes.com/metrostore/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Documentation', 'metrostore' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Got theme support question?', 'metrostore' ); ?></h3>
						<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'metrostore' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://www.sparklewpthemes.com/support/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support', 'metrostore' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Need more features?', 'metrostore' ); ?></h3>
						<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'metrostore' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://www.sparklewpthemes.com/wordpress-themes/metrostorepro/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View PRO version', 'metrostore' ); ?></a></p>
					</div>

					<div class="col">
						<h3><?php esc_html_e( 'Have you need customization?', 'metrostore' ); ?></h3>
						<p><?php esc_html_e( 'Please send message with your requirement.', 'metrostore' ) ?></p>
						<p><a href="<?php echo esc_url( 'https://www.sparklewpthemes.com/request-wordpress-customization-with-our-dedicated-support-team/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Customization', 'metrostore' ); ?></a></p>
					</div>

					<div class="col">
						<h3>
							<?php
							esc_html_e( 'Translate', 'metrostore' );
							echo ' ' . $theme->display( 'Name' );
							?>
						</h3>
						<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'metrostore' ) ?></p>
						<p>
							<a href="<?php echo esc_url( 'https://translate.wordpress.org/projects/wp-themes/metrostore' ); ?>" class="button button-secondary" target="_blank">
								<?php
								esc_html_e( 'Translate', 'metrostore' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</a>
						</p>
					</div>
				</div>
			</div>

			<div class="return-to-dashboard metrostore">
				<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
					<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
						<?php is_multisite() ? esc_html_e( 'Return to Updates', 'metrostore' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'metrostore' ); ?>
					</a> |
				<?php endif; ?>
				<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'metrostore' ) : esc_html_e( 'Go to Dashboard', 'metrostore' ); ?></a>
			</div>
		</div>
		<?php
	}

	/**
	 * Output the more themes screen
	 */
	public function more_themes_screen() {
?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>
			<div class="theme-browser rendered">
				<div class="themes wp-clearfix">
					<?php
						// Set the argument array with author name.
						$args = array(
							'author' => 'sparklewpthemes',
						);
						// Set the $request array.
						$request = array(
							'body' => array(
								'action'  => 'query_themes',
								'request' => serialize( (object)$args )
							)
						);
						$themes = $this->metrostore_get_themes( $request );
						$active_theme = wp_get_theme()->get( 'Name' );
						$counter = 1;

						// For currently active theme.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme == $theme->name ) { ?>

								<div id="<?php echo $theme->slug; ?>" class="theme active">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>
									<h3 class="theme-name" id="metrostore-name"><strong><?php _e( 'Active', 'metrostore' ); ?></strong>: <?php echo $theme->name; ?></h3>
									<div class="theme-actions">
										<a class="button button-primary customize load-customize hide-if-no-customize" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php _e( 'Customize', 'metrostore' ); ?></a>
									</div>
								</div><!-- .theme active -->
							<?php
							$counter++;
							break;
							}
						}

						// For all other themes.
						foreach ( $themes->themes as $theme ) {
							if( $active_theme != $theme->name ) {
								// Set the argument array with author name.
								$args = array(
									'slug' => $theme->slug,
								);
								// Set the $request array.
								$request = array(
									'body' => array(
										'action'  => 'theme_information',
										'request' => serialize( (object)$args )
									)
								);
								$theme_details = $this->metrostore_get_themes( $request );
							?>
								<div id="<?php echo $theme->slug; ?>" class="theme">
									<div class="theme-screenshot">
										<img src="<?php echo $theme->screenshot_url ?>"/>
									</div>

									<h3 class="theme-name"><?php echo $theme->name; ?></h3>

									<div class="theme-actions">
										<?php if( wp_get_theme( $theme->slug )->exists() ) { ?>											
											<!-- Activate Button -->
											<a  class="button button-secondary activate"
												href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" ><?php _e( 'Activate', 'metrostore' ) ?></a>
										<?php } else {
											// Set the install url for the theme.
											$install_url = add_query_arg( array(
													'action' => 'install-theme',
													'theme'  => $theme->slug,
												), self_admin_url( 'update.php' ) );
										?>
											<!-- Install Button -->
											<a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php _e( 'Install Now', 'metrostore' ); ?></a>
										<?php } ?>

										<a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'metrostore' ); ?></a>
									</div>
								</div><!-- .theme -->
								<?php
							}
						}


					?>
				</div>
			</div><!-- .mt-theme-holder -->
		</div><!-- .wrap.about-wrap -->
<?php
	}

	/** 
	 * Get all our themes by using API.
	 */
	private function metrostore_get_themes( $request ) {

		// Generate a cache key that would hold the response for this request:
		$key = 'metrostore_' . md5( serialize( $request ) );

		// Check transient. If it's there - use that, if not re fetch the theme
		if ( false === ( $themes = get_transient( $key ) ) ) {

			// Transient expired/does not exist. Send request to the API.
			$response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

			// Check for the error.
			if ( !is_wp_error( $response ) ) {

				$themes = unserialize( wp_remote_retrieve_body( $response ) );

				if ( !is_object( $themes ) && !is_array( $themes ) ) {

					// Response body does not contain an object/array
					return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
				}

				// Set transient for next time... keep it for 24 hours should be good
				set_transient( $key, $themes, 60 * 60 * 24 );
			}
			else {
				// Error object returned
				return $response;
			}
		}
		return $themes;
	}
	
	/**
	 * Output the changelog screen.
	 */
	public function changelog_screen() {
		global $wp_filesystem;

		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<h4><?php esc_html_e( 'View changelog below:', 'metrostore' ); ?></h4>

			<?php
				$changelog_file = apply_filters( 'metrostore_changelog_file', get_template_directory() . '/readme.txt' );

				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = $this->parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
		<?php
	}

	/**
	 * Parse changelog from readme file.
	 * @param  string $content
	 * @return string
	 */
	private function parse_changelog( $content ) {
		$matches   = null;
		$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
		$changelog = '';

		if ( preg_match( $regexp, $content, $matches ) ) {
			$changes = explode( '\r\n', trim( $matches[1] ) );

			$changelog .= '<pre class="changelog">';

			foreach ( $changes as $index => $line ) {
				$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
			}

			$changelog .= '</pre>';
		}

		return wp_kses_post( $changelog );
	}

	/**
	 * Output the free vs pro screen.
	 */
	public function free_vs_pro_screen() {
		?>
		<div class="wrap about-wrap">

			<?php $this->intro(); ?>

			<h4><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'metrostore' ); ?></h4>

			<table>
				<thead>
					<tr>
						<th class="table-feature-title"><h3><?php esc_html_e( 'Features', 'metrostore' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'metrostore', 'metrostore' ); ?></h3></th>
						<th><h3><?php esc_html_e( 'metrostore Pro', 'metrostore' ); ?></h3></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><h3><?php esc_html_e( 'Price', 'metrostore' ); ?></h3></td>
						<td><?php esc_html_e( 'Free', 'metrostore' ); ?></td>
						<td><?php esc_html_e( '$55', 'metrostore' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Import Demo Data', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Pre Loaders', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Header Layouts', 'metrostore' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'metrostore' ); ?></td>
						<td><?php esc_html_e( '6', 'metrostore' ); ?></td>
					</tr>				
										
					<tr>
						<td><h3><?php esc_html_e( 'Google Fonts', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><?php esc_html_e( '600+', 'metrostore' ); ?></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'Typography Options', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					<tr>
						<td><h3><?php esc_html_e( 'No. of Widgets', 'metrostore' ); ?></h3></td>
						<td><?php esc_html_e( '7', 'metrostore' ); ?></td>
						<td><?php esc_html_e( '19', 'metrostore' ); ?></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Unlimited Colors', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Blog Layouts', 'metrostore' ); ?></h3></td>
						<td><?php esc_html_e( '1', 'metrostore' ); ?></td>
						<td><?php esc_html_e( '4', 'metrostore' ); ?></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Team Member', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Testimonial', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Revolution Slider', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Footer Copyright', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>

					<tr>
						<td><h3><?php esc_html_e( 'Advance Breadcrumbs', 'metrostore' ); ?></h3></td>
						<td><span class="dashicons dashicons-no"></span></td>
						<td><span class="dashicons dashicons-yes"></span></td>
					</tr>
					
					<tr>
						<td></td>
						<td></td>
						<td class="btn-wrapper">
							<a href="<?php echo esc_url( apply_filters( 'metrostore_pro_theme_url', 'https://www.sparklewpthemes.com/wordpress-themes/metrostorepro/' ) ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Pro', 'metrostore' ); ?></a>
						</td>
					</tr>
				</tbody>
			</table>

		</div>
		<?php
	}
}

endif;

return new metrostore_About();