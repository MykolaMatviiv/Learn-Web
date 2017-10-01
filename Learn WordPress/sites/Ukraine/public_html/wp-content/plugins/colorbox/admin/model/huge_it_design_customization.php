<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Model {
	public function getcolorboxList()
	{
		global $wpdb;
		$query = "SELECT *  from " . $wpdb->prefix . "hugeit_colorbox";
		$rows = $wpdb->get_results($query);
		$hugeit_colorbox_values = array();
		foreach ($rows as $row) {
			$key = $row->name;
			$value = $row->value;
			$hugeit_colorbox_values[$key] = $value;
		}
		return $hugeit_colorbox_values;
	}
	public function getcolorboxSave()
	{
		global $wpdb;
		if (isset($_POST['params'])) {
		  $params = $_POST['params'];
		  foreach ($params as $key => $value) {
			if($value == ''){$value = 0; }
			$wpdb->update($wpdb->prefix . 'hugeit_colorbox',
				array('value' => $value),
				array('name' => $key),
				array('%s')
			);
		}
		?>
		<div class="updated"><p><strong><?php _e('Item Saved'); ?></strong></p></div>
		<?php
		}
	}
}
