<?php
/**
 * Adds metrostore_about_section_widget widget.
**/
add_action('widgets_init', 'metrostore_about_section_widget');
function metrostore_about_section_widget() {
  register_widget('metrostore_about_section_widget_area');
}

class metrostore_about_section_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_about_section_widget_area', esc_html__('MS: About Section','metrostore'), array(
          'description' => esc_html__('A widget that shows about info with services', 'metrostore')
      ));
  }
  
  private function widget_fields() {       

      $fields = array( 
          
          'metrostore_about_section_title' => array(
              'metrostore_widgets_name' => 'metrostore_about_section_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),

          'metrostore_about_section_short_desc' => array(
            'metrostore_widgets_name' => 'metrostore_about_section_short_desc',
            'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
            'metrostore_widgets_field_type' => 'textarea',
            'metrostore_widgets_row'  => 4
          ),

          'metrostore_start_group_about_section' => array(
              'metrostore_widgets_name' => 'metrostore_start_group_about_section',
              'metrostore_widgets_title' => 'Our Services Area',
              'metrostore_widgets_field_type' => 'group_start',
          ),

            'metrostore_services_area_one_icon' => array(
              'metrostore_widgets_name' => 'metrostore_services_area_one_icon',
              'metrostore_widgets_title' => esc_html__('Our Services Area Icon', 'metrostore'),
              'metrostore_widgets_field_type' => 'text',
              'metrostore_widgets_description' => esc_html__('Enter Font Awesome Icon Class', 'metrostore'),
            ),

            'metrostore_services_area_one' => array(
                'metrostore_widgets_name' => 'metrostore_services_area_one',
                'metrostore_widgets_title' => esc_html__('Select Services Page', 'metrostore'),
                'metrostore_widgets_field_type' => 'selectpage'
            ),

            // Two

            'metrostore_services_area_two_icon' => array(
              'metrostore_widgets_name' => 'metrostore_services_area_two_icon',
              'metrostore_widgets_title' => esc_html__('Our Services Area Icon', 'metrostore'),
              'metrostore_widgets_field_type' => 'text',
              'metrostore_widgets_description' => esc_html__('Enter Font Awesome Icon Class', 'metrostore'),
            ),

            'metrostore_services_area_two' => array(
                'metrostore_widgets_name' => 'metrostore_services_area_two',
                'metrostore_widgets_title' => esc_html__('Select Services Page', 'metrostore'),
                'metrostore_widgets_field_type' => 'selectpage'
            ),

            // Three

            'metrostore_services_area_three_icon' => array(
              'metrostore_widgets_name' => 'metrostore_services_area_three_icon',
              'metrostore_widgets_title' => esc_html__('Our Services Area Icon', 'metrostore'),
              'metrostore_widgets_field_type' => 'text',
              'metrostore_widgets_description' => esc_html__('Enter Font Awesome Icon Class', 'metrostore'),
            ),

            'metrostore_services_area_three' => array(
                'metrostore_widgets_name' => 'metrostore_services_area_three',
                'metrostore_widgets_title' => esc_html__('Select Services Page', 'metrostore'),
                'metrostore_widgets_field_type' => 'selectpage'
            ),

            // Four
            'metrostore_services_area_four_icon' => array(
              'metrostore_widgets_name' => 'metrostore_services_area_four_icon',
              'metrostore_widgets_title' => esc_html__('Our Services Area Icon', 'metrostore'),
              'metrostore_widgets_field_type' => 'text',
              'metrostore_widgets_description' => esc_html__('Enter Font Awesome Icon Class', 'metrostore'),
            ),

            'metrostore_services_area_four' => array(
                'metrostore_widgets_name' => 'metrostore_services_area_four',
                'metrostore_widgets_title' => esc_html__('Select Services Page', 'metrostore'),
                'metrostore_widgets_field_type' => 'selectpage'
            ),
            

          'metrostore_end_group_about_section' => array(
              'metrostore_widgets_name' => 'metrostore_end_group_about_section',
              'metrostore_widgets_field_type' => 'group_end',
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
      $title               = empty( $instance['metrostore_about_section_title'] ) ? '' : $instance['metrostore_about_section_title']; 
      $short_desc          = empty( $instance['metrostore_about_section_short_desc'] ) ? '' : $instance['metrostore_about_section_short_desc']; 
      $service_one_icon    = empty( $instance['metrostore_services_area_one_icon'] ) ? '' : $instance['metrostore_services_area_one_icon']; 
      $service_one         = empty( $instance['metrostore_services_area_one'] ) ? '' : $instance['metrostore_services_area_one'];     
      $service_two_icon    = empty( $instance['metrostore_services_area_two_icon'] ) ? '' : $instance['metrostore_services_area_two_icon']; 
      $service_two         = empty( $instance['metrostore_services_area_two'] ) ? '' : $instance['metrostore_services_area_two']; 
      $service_three_icon  = empty( $instance['metrostore_services_area_three_icon'] ) ? '' : $instance['metrostore_services_area_three_icon']; 
      $service_three       = empty( $instance['metrostore_services_area_three'] ) ? '' : $instance['metrostore_services_area_three']; 
      $service_four_icon   = empty( $instance['metrostore_services_area_four_icon'] ) ? '' : $instance['metrostore_services_area_four_icon']; 
      $service_four        = empty( $instance['metrostore_services_area_four'] ) ? '' : $instance['metrostore_services_area_four']; 
      
      echo $before_widget; 
  ?>

<section id="about-section">
    <div class="page-header-wrapper">
      <div class="container">
        <div class="page-header text-center">
          <?php if(!empty( $title )) { ?>
              <h2><?php echo esc_html($title); ?></h2>
          <?php } do_action( 'metrostore_title_design' );
              if(!empty( $short_desc )) {
          ?>
            <p class="lead text-gray"><?php echo esc_html($short_desc); ?></p>
          <?php } ?>
        </div>
      </div>
    </div><!-- End page header--> 
    
    <!-- Begin info box-1 -->
    <div class="info-box-1-wrapper">
      <div class="container">
        <div class="row">          
          <?php 
            // Services Area One
            metrostore_services_area($service_one_icon, $service_one);
            // Services Area Two
            metrostore_services_area($service_two_icon, $service_two);
            // Services Area Three
            metrostore_services_area($service_three_icon, $service_three);
            // Services Area Four
            metrostore_services_area($service_four_icon, $service_four); 
          ?>                    
        </div><!-- /.row --> 
      </div><!-- /.container --> 
    </div>
    <div class="about-bg"></div>
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