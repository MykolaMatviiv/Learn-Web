<?php
/*
Plugin Name: Popup Colorbox
Plugin URI: http://huge-it.com/colorbox
Description: Using this plugin users could view you website's photos with big sizes in beautiful popup and even more.
Version: 1.0.5
Author: Huge-IT
Author URI: http://huge-it.com
License: GPL
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action('admin_menu', 'huge_it_colorbox_options_panel');
register_activation_hook(__FILE__, 'hugeit_colorbox_activate');
define('HUGEIT_PLUGIN_DIR_1', WP_PLUGIN_DIR . "/" . plugin_basename(dirname(__FILE__)));

function huge_it_colorbox_options_panel()
{
    add_menu_page('Theme page title', 'Huge IT Colorbox', 'manage_options', 'huge_it_colorbox', 'huge_it_colorbox', plugins_url('images/huge_it_colorboxLogoHover-for_menu.png', __FILE__));
	$page_option = add_submenu_page('huge_it_colorbox', 'Colorbox', 'Colorbox', 'manage_options', 'huge_it_colorbox', 'huge_it_colorbox');
    add_submenu_page('huge_it_colorbox', 'Featured Plugins', 'Featured Plugins', 'manage_options', 'huge_it_featured_plugins_1', 'huge_it_featured_plugins');
	add_submenu_page('huge_it_colorbox', 'Licensing', 'Licensing', 'manage_options', 'huge_it_colorbox_Licensing', 'huge_it_colorbox_Licensing');
	
	add_action('admin_print_styles-' . $page_option, 'huge_it_colorbox_option_admin_script');
	add_action('admin_print_styles-' . $page_option, 'huge_it_colorbox_option_admin_script');

}

function huge_it_colorbox_Licensing(){

	?>
    <div style="width:95%">
    <p>
	This plugin is the non-commercial version of the Huge IT colorbox. If you want to customize to the styles and colors of your website,than you need to buy a license.
Purchasing a license will add possibility to customize the general options of the Huge IT colorbox. 

 </p>
<br /><br />
<a href="http://huge-it.com/colorbox/" class="button-primary" target="_blank">Purchase a License</a>
<br /><br /><br />
<p>After the purchasing the commercial version follow this steps:</p>
<ol>
	<li>Deactivate Huge IT colorbox Plugin</li>
	<li>Delete Huge IT colorbox Plugin</li>
	<li>Install the downloaded commercial version of the plugin</li>
</ol>
</div>
<?php
	}

function huge_it_colorbox_option_admin_script()
{
	wp_enqueue_script("jquery_old", "http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js", FALSE);

	wp_enqueue_script("simple_slider_js",  plugins_url("js/admin/simple-slider.js", __FILE__), FALSE);
	wp_enqueue_style("simple_slider_css", plugins_url("css/admin/simple-slider.css", __FILE__), FALSE);
	
	wp_enqueue_style("admin_css", plugins_url("css/admin/admin.style.css", __FILE__), FALSE);
	wp_enqueue_script("admin_js", plugins_url("js/admin/admin.js", __FILE__), FALSE);
	wp_enqueue_script('param_block2', plugins_url("js/admin/jscolor/jscolor.js", __FILE__));
}


function huge_it_colorbox()
{
		include_once("admin/controller/huge_it_colorbox.php");
		$controller = new Controller();
		$controller->invoke();
}
function huge_it_featured_plugins_1()
{
	switch ($_GET['task']) {
	default:
		include_once("admin/controller/huge_it_featured_plugins.php");
		break;
	}
}
function hugeit_colorbox_activate()
{
	include_once("admin/controller/install_base.php");
}
function huge_it_scripts_1() {

}
add_action( 'wp_enqueue_scripts', 'huge_it_scripts_1' );

function huge_colorbox_header()
{
	global $wpdb;
	$query="SELECT * FROM ".$wpdb->prefix."hugeit_colorbox";
    $rowspar = $wpdb->get_results($query);
    $paramssld = array();
    foreach ($rowspar as $rowpar) {
        $key = $rowpar->name;
        $value = $rowpar->value;
        $paramssld[$key] = $value;
    }
?>
<script>
	var colorbox_transition = '<?php echo $paramssld['colorbox_transition'];?>';
	var colorbox_speed = <?php echo $paramssld['colorbox_speed'];?>;
	var colorbox_fadeOut = <?php echo $paramssld['colorbox_fadeout'];?>;
	var colorbox_title = <?php echo $paramssld['colorbox_title'];?>;
	var colorbox_scalePhotos = <?php echo $paramssld['colorbox_scalephotos'];?>;
	var colorbox_scrolling = <?php echo $paramssld['colorbox_scrolling'];?>;
	var colorbox_opacity = <?php echo ($paramssld['colorbox_opacity']/100)+0.001;?>;
	var colorbox_open = <?php echo $paramssld['colorbox_open'];?>;
	var colorbox_returnFocus = <?php echo $paramssld['colorbox_returnfocus'];?>;
	var colorbox_trapFocus = <?php echo $paramssld['colorbox_trapfocus'];?>;
	var colorbox_fastIframe = <?php echo $paramssld['colorbox_fastiframe'];?>;
	var colorbox_preloading = <?php echo $paramssld['colorbox_preloading'];?>;
	var colorbox_overlayClose = <?php echo $paramssld['colorbox_overlayclose'];?>;
	var colorbox_escKey = <?php echo $paramssld['colorbox_esckey'];?>;
	var colorbox_arrowKey = <?php echo $paramssld['colorbox_arrowkey'];?>;
	var colorbox_loop = <?php echo $paramssld['colorbox_loop'];?>;
	var colorbox_closeButton = <?php echo $paramssld['colorbox_closebutton'];?>;
	var colorbox_previous = "<?php echo $paramssld['colorbox_previous'];?>";
	var colorbox_next = "<?php echo $paramssld['colorbox_next'];?>";
	var colorbox_close = "<?php echo $paramssld['colorbox_close'];?>";
	var colorbox_html = <?php echo $paramssld['colorbox_html'];?>;
	var colorbox_photo = <?php echo $paramssld['colorbox_photo'];?>;
	var colorbox_width = '<?php if($paramssld['colorbox_size_fix'] == 'false'){ echo '';} else { echo $paramssld['colorbox_width']; } ?>';
	var colorbox_height = '<?php if($paramssld['colorbox_size_fix'] == 'false'){ echo '';} else { echo $paramssld['colorbox_height']; } ?>';
	var colorbox_innerWidth = '<?php echo $paramssld['colorbox_innerwidth'];?>';
	var colorbox_innerHeight = '<?php echo $paramssld['colorbox_innerheight'];?>';
	var colorbox_initialWidth = '<?php echo $paramssld['colorbox_initialwidth'];?>';
	var colorbox_initialHeight = '<?php echo $paramssld['colorbox_initialheight'];?>';
	
        var maxwidth=jQuery(window).width();
        if(maxwidth><?php echo $paramssld['colorbox_maxwidth'];?>){maxwidth=<?php echo $paramssld['colorbox_maxwidth'];?>;}
        var colorbox_maxWidth = <?php if($paramssld['colorbox_size_fix'] == 'true'){ echo '"100%"';} else { echo 'maxwidth'; } ?>;
        var colorbox_maxHeight = <?php if($paramssld['colorbox_size_fix'] == 'true'){ echo '"100%"';} else { echo $paramssld['colorbox_maxheight']; } ?>;
	
        var colorbox_slideshow = <?php echo $paramssld['colorbox_slideshow'];?>;
	var colorbox_slideshowSpeed = <?php echo $paramssld['colorbox_slideshowspeed'];?>;
	var colorbox_slideshowAuto = <?php echo $paramssld['colorbox_slideshowauto'];?>;
	var colorbox_slideshowStart = "<?php echo $paramssld['colorbox_slideshowstart'];?>";
	var colorbox_slideshowStop = "<?php echo $paramssld['colorbox_slideshowstop'];?>";
	var colorbox_fixed = <?php echo $paramssld['colorbox_fixed'];?>;
	
	
	<?php
	$pos = $paramssld['slider_title_position'];
	switch($pos){ 
	case 1:
	?>
		var colorbox_top = '10%';
		var colorbox_bottom = false;
		var colorbox_left = '10%';
		var colorbox_right = false;
	<?php
	break;	
	case 1:
	?>
		var colorbox_top = '10%';
		var colorbox_bottom = false;
		var colorbox_left = '10%';
		var colorbox_right = false;
	<?php
	break;	
	case 2:
	?>
		var colorbox_top = '10%';
		var colorbox_bottom = false;
		var colorbox_left = false;
		var colorbox_right = false;
	<?php
	break;	
	case 3:
	?>
		var colorbox_top = '10%';
		var colorbox_bottom = false;
		var colorbox_left = false;
		var colorbox_right = '10%';
	<?php
	break;
	case 4:
	?>
		var colorbox_top = false;
		var colorbox_bottom = false;
		var colorbox_left = '10%';
		var colorbox_right = false;
	<?php
	break;	
	case 5:
	?>
		var colorbox_top = false;
		var colorbox_bottom = false;
		var colorbox_left = false;
		var colorbox_right = false;
	<?php
	break;	
	case 6:
	?>
		var colorbox_top = false;
		var colorbox_bottom = false;
		var colorbox_left = false;
		var colorbox_right = '10%';
	<?php
	break;	
	case 7:
	?>
		var colorbox_top = false;
		var colorbox_bottom = '10%';
		var colorbox_left = '10%';
		var colorbox_right = false;
	<?php
	break;	
	case 8:
	?>
		var colorbox_top = false;
		var colorbox_bottom = '10%';
		var colorbox_left = false;
		var colorbox_right = false;
	<?php
	break;	
	case 9:
	?>
		var colorbox_top = false;
		var colorbox_bottom = '10%';
		var colorbox_left = false;
		var colorbox_right = '10%';
	<?php
	break;	
	} ?>
	
	var colorbox_reposition = <?php echo $paramssld['colorbox_reposition'];?>;
	var colorbox_retinaImage = <?php echo $paramssld['colorbox_retinaimage'];?>;
	var colorbox_retinaUrl = <?php echo $paramssld['colorbox_retinaurl'];?>;
	var colorbox_retinaSuffix = "<?php echo $paramssld['colorbox_retinasuffix'];?>";
</script>
<?php	
	wp_enqueue_script(
		'custom-js-1',
		plugins_url( '/js/frontend/custom.js' , __FILE__ ),
		array( 'jquery' )
	);
	wp_enqueue_script(
		'colorbox-js',
		plugins_url( '/js/frontend/jquery.colorbox.js' , __FILE__ ),
		array( 'jquery' )
	);
	if($paramssld['colorbox_style'] != 6){
	wp_enqueue_style( 'style-name',plugins_url( '/css/frontend/colorbox-'.$paramssld['colorbox_style'].'.css' , __FILE__ ) );
	}
	else
	{
	?><style><?php
	include_once('/css/frontend/colorbox-'.$paramssld['colorbox_style'].'.css.php');
	?></style><?php
	}
}

add_action('wp_head', 'huge_colorbox_header');
function add_title_colorbox_link($link, $id = null) {
$id = intval( $id );
$_post = get_post( $id );
$post_title = esc_attr( $_post->post_title );
return str_replace('<a href', '<a title="'. $post_title .'" href', $link);
}
add_filter('wp_get_attachment_link', 'add_title_colorbox_link', 10, 2);
?>