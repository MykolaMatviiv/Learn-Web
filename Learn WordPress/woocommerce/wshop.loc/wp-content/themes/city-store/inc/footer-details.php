<?php
/**
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
?>
<?php
/************************* City Store FOOTER DETAILS **************************************/
if (! function_exists('city_store_site_footer')) {
	function city_store_site_footer() {
		$city_store_settings = city_store_get_theme_options();
		if ( is_active_sidebar( 'city_store_footer_options' ) ) :
			dynamic_sidebar( 'city_store_footer_options' );
		else:
			echo '<div class="copyright">';
			echo esc_html__('Theme by ', 'city-store');
		 	echo '<a href="'.esc_url('https://yudleethemes.com/').'" target="_blank">'. ' ' .esc_html__('Alina Kakshapati', 'city-store').'</a>';
		 	 ?>
		</div>
		<?php endif;
	}
	add_action( 'city_store_sitegenerator_footer', 'city_store_site_footer');
}