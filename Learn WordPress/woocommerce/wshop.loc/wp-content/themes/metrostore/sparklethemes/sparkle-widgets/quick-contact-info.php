<?php
/**
 * Adds metrostore_quick_contact_info_widget widget.
**/
add_action('widgets_init', 'metrostore_quick_contact_info_widget');
function metrostore_quick_contact_info_widget() {
  register_widget('metrostore_quick_contact_info_widget_area');
}

class metrostore_quick_contact_info_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_quick_contact_info_widget_area', esc_html__('MS: Quick Contact Info','metrostore'), array(
          'description' => esc_html__('A widget that shows your contact information', 'metrostore')
      ));
  }
  
  private function widget_fields() {        

      $fields = array( 
          
          'metrostore_quick_contact_info_title' => array(
              'metrostore_widgets_name' => 'metrostore_quick_contact_info_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),

          'metrostore_quick_contact_info_short_desc' => array(
            'metrostore_widgets_name' => 'metrostore_quick_contact_info_short_desc',
            'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
            'metrostore_widgets_field_type' => 'textarea',
            'metrostore_widgets_row'  => 4
          ),

          'metrostore_start_group_quick_info' => array(
              'metrostore_widgets_name' => 'metrostore_start_group_quick_info',
              'metrostore_widgets_title' => 'Contact Informations',
              'metrostore_widgets_field_type' => 'group_start',
          ),
            'metrostore_quick_contact_info_address' => array(
              'metrostore_widgets_name' => 'metrostore_quick_contact_info_address',
              'metrostore_widgets_title' => esc_html__('Enter Your Address', 'metrostore'),
              'metrostore_widgets_field_type' => 'title'
            ),

            'metrostore_quick_contact_info_email' => array(
              'metrostore_widgets_name' => 'metrostore_quick_contact_info_email',
              'metrostore_widgets_title' => esc_html__('Enter Your Email Address', 'metrostore'),
              'metrostore_widgets_field_type' => 'text',
            ),

            'metrostore_quick_contact_info_phone' => array(
              'metrostore_widgets_name' => 'metrostore_quick_contact_info_phone',
              'metrostore_widgets_title' => esc_html__('Enter Your Phone Number', 'metrostore'),
              'metrostore_widgets_field_type' => 'text',
            ),

          'metrostore_end_group_quick_info' => array(
              'metrostore_widgets_name' => 'metrostore_end_group_quick_info',
              'metrostore_widgets_field_type' => 'group_end',
          ),                            
      );

      return $fields;
  }

  public function widget($args, $instance) {
      extract($args);
      extract($instance);      
      /**
       * wp query for first block
      */  
      $title         = empty( $instance['metrostore_quick_contact_info_title'] ) ? '' : $instance['metrostore_quick_contact_info_title']; 
      $short_desc    = empty( $instance['metrostore_quick_contact_info_short_desc'] ) ? '' : $instance['metrostore_quick_contact_info_short_desc'];
      $address_info  = empty( $instance['metrostore_quick_contact_info_address'] ) ? '' : $instance['metrostore_quick_contact_info_address'];
      $email_address = empty( $instance['metrostore_quick_contact_info_email'] ) ? '' : $instance['metrostore_quick_contact_info_email'];
      $phone_number  = empty( $instance['metrostore_quick_contact_info_phone'] ) ? '' : $instance['metrostore_quick_contact_info_phone'];
          
      echo $before_widget; 
  ?>  
<section id="contact" class="gray">    
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
        </div>
      </div> <!-- End page header-->      
      <div class="row">
        <div class="col-sm-4 adress-element"> <i class="fa fa-home fa-2x"></i>
          <h3><?php esc_html_e('Our Address','metrostore'); ?></h3>
          <span class="font-l"><?php echo esc_attr($address_info); ?></span> 
        </div>
        <div class="col-sm-4 adress-element"> <i class="fa fa-comment fa-2x"></i>
          <h3><?php esc_html_e('Our mail','metrostore'); ?></h3>
          <span class="font-l"><a href="mailto:<?php echo esc_attr( antispambot( $email_address ) ); ?>"><?php echo esc_attr( antispambot( $email_address ) ); ?></a></span> 
        </div>
        <div class="col-sm-4 adress-element"> <i class="fa fa-phone fa-2x"></i>
          <h3><?php esc_html_e('Our phone','metrostore'); ?></h3>
          <span class="font-l"><?php echo esc_attr($phone_number); ?></span> 
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