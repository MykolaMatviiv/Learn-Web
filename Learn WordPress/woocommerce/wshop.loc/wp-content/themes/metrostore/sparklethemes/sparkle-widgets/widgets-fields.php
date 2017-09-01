<?php
/**
** MetroStore Field Functional Area
* @package MetroStore
**/

function metrostore_widgets_show_widget_field($instance = '', $widget_field = '', $metrostore_field_value = '') {
   
    /**
     * Category list in array
    **/
    $metrostore_category_list[0] = array(
        'value' => 0,
        'label' => esc_html__('Select Categories','metrostore')
    );
    $metrostore_posts = get_categories();
    foreach ($metrostore_posts as $metrostore_post) :
        $metrostore_category_list[$metrostore_post->term_id] = array(
            'value' => $metrostore_post->term_id,
            'label' => $metrostore_post->name
        );
    endforeach;
    
    
    /**
     * Default Page List in array
    */
    $metrostore_pagelist[0] = array(
        'value' => 0,
        'label' => esc_html__('Select Pages','metrostore')
    );
    $arg = array('posts_per_page' => -1);
    $metrostore_pages = get_pages($arg);
    foreach ($metrostore_pages as $metrostore_page) :
        $metrostore_pagelist[$metrostore_page->ID] = array(
            'value' => $metrostore_page->ID,
            'label' => $metrostore_page->post_title
        );
    endforeach;


    extract($widget_field);

    switch ($metrostore_widgets_field_type) {

        /**
         * Standard text field area
        **/
        case 'text' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" type="text" value="<?php echo esc_attr($metrostore_field_value) ; ?>" />

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard title field area
        **/   
        case 'title' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" type="text" value="<?php echo esc_attr($metrostore_field_value) ; ?>" />
                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'group_start' :
            ?>
            <div class="metrostore-main-group" id="ap-font-awesome-list <?php echo $instance->get_field_id( $metrostore_widgets_name ); ?>">
                <div class="metrostore-main-group-heading" style="font-size: 15px;  font-weight: bold;  padding-top: 12px;"><?php echo $metrostore_widgets_title ; ?><span class="toogle-arrow"></span></div>
                <div class="metrostore-main-group-wrap">
            <?php
            break;

            case 'group_end':
            ?></div>
            </div><?php
            break;

        /**
         * Standard url field area
        **/
        case 'url' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" type="text" value="<?php echo $metrostore_field_value; ?>" />

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard textarea field area
        **/
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label>
                <textarea class="widefat" rows="<?php echo $metrostore_widgets_row; ?>" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>"><?php echo $metrostore_field_value; ?></textarea>
            </p>
            <?php
            break;
        
        /**
         * Standard checkbox field area
        **/
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $metrostore_field_value); ?>/>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?></label>

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard radio field area
        **/
        case 'radio' :
            ?>
            <p>
                <?php
                echo $metrostore_widgets_title;
                echo '<br />';
                foreach ($metrostore_widgets_field_options as $metrostore_option_name => $metrostore_option_title) {
                    ?>
                    <input id="<?php echo $instance->get_field_id($metrostore_option_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" type="radio" value="<?php echo $metrostore_option_name; ?>" <?php checked($metrostore_option_name, $metrostore_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($metrostore_option_name); ?>"><?php echo $metrostore_option_title; ?></label>
                    <br />
                <?php } ?>
                <?php if (isset($metrostore_widgets_description)) { ?>
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard select field area
        **/
        case 'select' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label>
                <select name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" class="widefat">
                    <?php foreach ($metrostore_widgets_field_options as $metrostore_option_name => $metrostore_option_title) { ?>
                        <option value="<?php echo $metrostore_option_name; ?>" id="<?php echo $instance->get_field_id($metrostore_option_name); ?>" <?php selected($metrostore_option_name, $metrostore_field_value); ?>><?php echo $metrostore_option_title; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;
        
        /**
         * Standard select pages field area
        **/
        case 'selectpage' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" class="widefat">
                    <?php foreach ($metrostore_pagelist as $metrostore_page) { ?>
                        <option value="<?php echo $metrostore_page['value']; ?>" id="<?php echo $instance->get_field_id($metrostore_page['label']); ?>" <?php selected($metrostore_page['value'], $metrostore_field_value); ?>><?php echo $metrostore_page['label']; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard number field area
        **/        
        case 'number' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label><br />
                <input name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" type="number" step="4" min="4" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" value="<?php echo $metrostore_field_value; ?>" class="widefat" />

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard Select category field area
        **/
        case 'select_category' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>"><?php echo $metrostore_widgets_title; ?> :</label>
                <select name="<?php echo $instance->get_field_name($metrostore_widgets_name); ?>" id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" class="widefat">
                    <?php foreach ($metrostore_category_list as $metrostore_single_post) { ?>
                        <option value="<?php echo $metrostore_single_post['value']; ?>" id="<?php echo $instance->get_field_id($metrostore_single_post['label']); ?>" <?php selected($metrostore_single_post['value'], $metrostore_field_value); ?>><?php echo $metrostore_single_post['label']; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($metrostore_widgets_description)) { ?>
                    <br />
                    <small><?php echo $metrostore_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        /**
         * Standard multi checkboxes category field area
        **/
        case 'multicheckcategory' :
            
            if( isset( $metrostore_mulicheckbox_title ) ) { ?>
                <label><?php echo esc_attr( $metrostore_mulicheckbox_title ); ?> :</label>
            <?php }
            echo '<div class="metrostore-multiplecat">';
                foreach ( $metrostore_widgets_field_options as $metrostore_option_name => $metrostore_option_title) {
                    if( isset( $metrostore_field_value[$metrostore_option_name] ) ) {
                        $metrostore_field_value[$metrostore_option_name] = 1;
                    }else{
                        $metrostore_field_value[$metrostore_option_name] = 0;
                    }                
                ?>
                    <p>
                        <input id="<?php echo $instance->get_field_id($metrostore_widgets_name); ?>" name="<?php echo $instance->get_field_name($metrostore_widgets_name).'['.$metrostore_option_name.']'; ?>" type="checkbox" value="1" <?php checked('1', $metrostore_field_value[$metrostore_option_name]); ?>/>
                        <label for="<?php echo $instance->get_field_id($metrostore_option_name); ?>"><?php echo $metrostore_option_title; ?></label>
                    </p>
                <?php
                    }
            echo '</div>';
                if (isset($metrostore_widgets_description)) {
            ?>
                    <small><em><?php echo $metrostore_widgets_description; ?></em></small>
            <?php
                }            
        	break;

        /**
         * Standard upload category field area
        **/
        case 'upload' :
            $output = '';
            $id = $instance->get_field_id($metrostore_widgets_name);
            $class = '';
            $int = '';
            $value = $metrostore_field_value;
            $name = $instance->get_field_name($metrostore_widgets_name);

            if ($value) {
                $class = 'has-file';
            }
            $output .= '<div class="sub-option section widget-upload">';
            $output .= '<label for="'.$instance->get_field_id($metrostore_widgets_name).'">'.$metrostore_widgets_title.'</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . esc_html__('No file chosen', 'metrostore') . '" />' . "\n";
            
            if (function_exists('wp_enqueue_media')) {
                if (( $value == '')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button-wdgt button" type="button" value="' . esc_html__('Upload', 'metrostore') . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . esc_html__('Remove', 'metrostore') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'metrostore') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";
            if ($value != '') {
                $remove = '<a class="remove-image">Remove</a>';
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $value . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }
                    $output .= '';
                    $title = esc_html__('View File', 'metrostore');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;
    }
}

function metrostore_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    if ($metrostore_widgets_field_type == 'number') {

        return absint($new_field_value);

    } elseif ($metrostore_widgets_field_type == 'textarea') {
        
        if (!isset($metrostore_widgets_allowed_tags)) {

            $metrostore_widgets_allowed_tags = '<p><strong><em><a>';

        }

        return wp_kses_data($new_field_value, $metrostore_widgets_allowed_tags);
    } 
    elseif ($metrostore_widgets_field_type == 'url') {

        return esc_url_raw($new_field_value);

    }
    elseif ($metrostore_widgets_field_type == 'title') {

        return wp_kses_post($new_field_value);
    }
    elseif ($metrostore_widgets_field_type == 'multicheckcategory') {

        return wp_kses_post($new_field_value);
    }
    else {

        return wp_kses_data($new_field_value);

    }
}


if( metrostore_is_woocommerce_activated() ){
    /**
     * Load category collection widget area file.
     */
    require metrostore_file_directory('sparklethemes/sparkle-widgets/category-collection.php');

    /**
     * Load tabs category products widget area file.
     */
    require metrostore_file_directory('sparklethemes/sparkle-widgets/tabs-category.php');

    /**
     * Load default tabs widget area file.
     */
    require metrostore_file_directory('sparklethemes/sparkle-widgets/tabs-defaults.php');

    /**
     * Load products widget area file.
     */
    require metrostore_file_directory('sparklethemes/sparkle-widgets/products-area.php');
}

/**
 * Load Blogs Posts widget area file.
 */
require metrostore_file_directory('sparklethemes/sparkle-widgets/blogs-widget.php');

/**
 * Load Promo Video widget area file.
 */
require metrostore_file_directory('sparklethemes/sparkle-widgets/promo-video.php');

/**
 * Load quick contact information widget area file.
 */
require metrostore_file_directory('sparklethemes/sparkle-widgets/quick-contact-info.php');

/**
 * Load contact form information widget area file.
 */
require metrostore_file_directory('sparklethemes/sparkle-widgets/contact-form-info.php');

/**
 * Load about section widget area file.
 */
require metrostore_file_directory('sparklethemes/sparkle-widgets/about-section.php');

/**
 * Load skills section widget area file.
 */
require metrostore_file_directory('sparklethemes/sparkle-widgets/skills-section.php');