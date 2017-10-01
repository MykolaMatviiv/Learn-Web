<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpdb;
$hugeit_colorbox = "CREATE TABLE IF NOT EXISTS " . $wpdb->prefix . "hugeit_colorbox (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` text NOT NULL,
	`title` text NOT NULL,
	`value` text NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
$wpdb->query( $hugeit_colorbox );
$sql_hugeit_colorbox = "INSERT INTO " . $wpdb->prefix . "hugeit_colorbox (`name`, `title`, `value`) VALUES	
('colorbox_size', 'Colorbox size', '17'),
('colorbox_width', 'Colorbox width', '500'),
('colorbox_transition', 'Colorbox Transition', 'elastic'),
('colorbox_speed', 'Colorbox speed', '800'),
('colorbox_href', 'Colorbox href', 'False'),
('colorbox_title', 'Colorbox Title', 'false'),
('colorbox_scalephotos', 'Colorbox scalePhotos', 'true'),
('colorbox_rel', 'Colorbox rel', 'false'),
('colorbox_scrolling', 'Colorbox Scrollin', 'false'),
('colorbox_opacity', 'Colorbox Opacity', '20'),
('colorbox_open', 'Colorbox Open', 'false'),
('colorbox_overlayclose', 'Colorbox overlayClose', 'true'),
('colorbox_esckey', 'Colorbox escKey', 'false'),
('colorbox_arrowkey', 'Colorbox arrowKey', 'false'),
('colorbox_loop', 'Colorbox loop', 'true'),
('colorbox_data', 'Colorbox data', 'false'),
('colorbox_classname', 'Colorbox className', 'false'),
('colorbox_fadeout', 'Colorbox fadeOut', '300'),
('colorbox_closebutton', 'Colorbox closeButton', 'false'),
('colorbox_current', 'Colorbox current', 'image'),
('colorbox_previous', 'Colorbox previous', 'previous'),
('colorbox_next', 'Colorbox next', 'next'),
('colorbox_close', 'Colorbox close', 'close'),
('colorbox_iframe', 'Colorbox iframe', 'false'),
('colorbox_inline', 'Colorbox inline', 'false'),
('colorbox_html', 'Colorbox html', 'false'),
('colorbox_photo', 'Colorbox photo', 'false'),
('colorbox_height', 'Colorbox height', '500'),
('colorbox_innerwidth', 'Colorbox innerWidth', 'false'),
('colorbox_innerheight', 'Colorbox innerHeight', 'false'),
('colorbox_initialwidth', 'Colorbox initialWidth', '300'),
('colorbox_initialheight', 'Colorbox initialHeight', '100'),
('colorbox_maxwidth', 'Colorbox maxWidth', '768'),
('colorbox_maxheight', 'Colorbox maxHeight', '500'),
('colorbox_slideshow', 'Colorbox slideshow', 'false'),
('colorbox_slideshowspeed', 'Colorbox slideshowSpeed', '2500'),
('colorbox_slideshowauto', 'Colorbox slideshowAuto', 'true'),
('colorbox_slideshowstart', 'Colorbox slideshowStart', 'start slideshow'),
('colorbox_slideshowstop', 'Colorbox slideshowStop', 'stop slideshow'),
('colorbox_fixed', 'Colorbox fixed', 'true'),
('colorbox_top', 'Colorbox top', 'false'),
('colorbox_bottom', 'Colorbox bottom', 'false'),
('colorbox_left', 'Colorbox left', 'false'),
('colorbox_right', 'Colorbox right', 'false'),
('colorbox_reposition', 'Colorbox reposition', 'false'),
('colorbox_retinaimage', 'Colorbox retinaImage', 'true'),
('colorbox_retinaurl', 'Colorbox retinaUrl', 'false'),
('colorbox_retinasuffix', 'Colorbox retinaSuffix', '@2x.$1'),
('colorbox_returnfocus', 'Colorbox returnFocus', 'true'),
('colorbox_trapfocus', 'Colorbox trapFocus', 'true'),
('colorbox_fastiframe', 'Colorbox fastIframe', 'true'),
('colorbox_preloading', 'Colorbox preloading', 'true'),
('slider_title_position', 'Slider title position', '5'),
('colorbox_size_fix', 'Colorbox size fix', 'false'),
('colorbox_style', 'Colorbox style', '1')";
if ( ! $wpdb->get_var( "select count(*) from " . $wpdb->prefix . "hugeit_colorbox" ) ) {
	$wpdb->query( $sql_hugeit_colorbox );
}   
