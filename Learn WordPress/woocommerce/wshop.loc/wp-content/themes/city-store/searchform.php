<?php
/**
 * Displays the searchform
 *
 * @package Alina Kakshapati
 * @subpackage City Store
 * @since City Store 1.0
 */
?>
<form class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
	<?php
		$city_store_settings = city_store_get_theme_options();
		$city_store_search_form = $city_store_settings['city_store_search_text'];
		if($city_store_search_form !='Search &hellip;'): ?>
	<input type="search" name="s" class="search-field" placeholder="<?php echo esc_attr($city_store_search_form); ?>" autocomplete="off">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<?php else: ?>
	<input type="search" name="s" class="search-field" placeholder="<?php esc_attr_e( 'Search &hellip;', 'city-store' ); ?>" autocomplete="off">
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
	<?php endif; ?>
</form> <!-- end .search-form -->