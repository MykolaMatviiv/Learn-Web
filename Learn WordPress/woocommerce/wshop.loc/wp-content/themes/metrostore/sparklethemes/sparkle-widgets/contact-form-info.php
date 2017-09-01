<?php
/**
 * Adds metrostore_contact_info_form_widget widget.
**/
add_action('widgets_init', 'metrostore_contact_info_form_widget');
function metrostore_contact_info_form_widget() {
  register_widget('metrostore_contact_info_form_widget_area');
}

class metrostore_contact_info_form_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_contact_info_form_widget_area', esc_html__('MS: Contact Form Area','metrostore'), array(
          'description' => esc_html__('A widget that display the quick contact form.', 'metrostore')
      ));
  }
  
  private function widget_fields() {       

      $fields = array( 
          
          'metrostore_contact_form_bg_image' => array(
              'metrostore_widgets_name' => 'metrostore_contact_form_bg_image',
              'metrostore_widgets_title' => esc_html__('Upload Background Image', 'metrostore'),
              'metrostore_widgets_field_type' => 'upload',
          ),

          'metrostore_contact_form_title' => array(
              'metrostore_widgets_name' => 'metrostore_contact_form_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),

          'metrostore_contact_form_short_desc' => array(
            'metrostore_widgets_name' => 'metrostore_contact_form_short_desc',
            'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
            'metrostore_widgets_field_type' => 'textarea',
            'metrostore_widgets_row'  => 4
          ),

          'metrostore_contact_form_shortcode' => array(
              'metrostore_widgets_name' => 'metrostore_contact_form_shortcode',
              'metrostore_widgets_title' => esc_html__('Enter Formo Shortcode', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          )
          
      );

      return $fields;
  }

  public function widget($args, $instance) {
      extract($args);
      extract($instance);
      
      /**
       * wp query for first block
      */  
      $title          = empty( $instance['metrostore_contact_form_title'] ) ? '' : $instance['metrostore_contact_form_title']; 
      $short_desc     = empty( $instance['metrostore_contact_form_short_desc'] ) ? '' : $instance['metrostore_contact_form_short_desc'];
      $form_shortcode = empty( $instance['metrostore_contact_form_shortcode'] ) ? '' : $instance['metrostore_contact_form_shortcode'];
      $bg_image       = empty( $instance['metrostore_contact_form_bg_image'] ) ? '' : $instance['metrostore_contact_form_bg_image'];      
      
      echo $before_widget; 
  ?>

<section id="contact" class="gray">

    <div class="contact-form" <?php if(!empty( $bg_image )) { ?>style="background-image:url(<?php echo esc_url($bg_image); ?>); background-size: cover;" <?php } ?>>
      <div class="masked">
        <div class="container"> 
          <div class="page-header-wrapper">
            <div class="container">
              <div class="page-header text-center">
                <?php if(!empty( $title )) { ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php } ?>
                <?php
                    do_action( 'metrostore_title_design' );
                    if(!empty( $short_desc )) {
                ?>
                  <p class="lead text-gray"><?php echo esc_html($short_desc); ?></p>
                <?php } ?>
              </div>
              <div class="sp-lab-box-padding">
                <?php echo do_shortcode( $form_shortcode ); ?>
              </div>
            </div>
          </div><!-- End page header-->
        </div>
      </div>
    </div>
    
</section>       

  <?php         
      echo $after_widget;
  }
 
  public function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $widget_fields = $this->widget_fields();
      foreach ($widget_fields as $widget_field) {
          extract($widget_field);
          $instance[$metrostore_widgets_name] = metrostore_widgets_updated_field_value($widget_field, $new_instance[$metrostore_widgets_name]);
      }
      return $instance;
  }

  public function form($instance) {
      $widget_fields = $this->widget_fields();
      foreach ($widget_fields as $widget_field) {
          extract($widget_field);
          $metrostore_widgets_field_value = !empty($instance[$metrostore_widgets_name]) ? $instance[$metrostore_widgets_name] : '';
          metrostore_widgets_show_widget_field($this, $widget_field, $metrostore_widgets_field_value);
      }
  }
}