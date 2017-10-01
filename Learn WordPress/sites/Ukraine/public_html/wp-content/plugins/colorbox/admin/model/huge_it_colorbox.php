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
}
