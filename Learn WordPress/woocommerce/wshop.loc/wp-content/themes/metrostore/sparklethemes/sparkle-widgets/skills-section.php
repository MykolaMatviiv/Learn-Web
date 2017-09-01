<?php
/**
 * Adds metrostore_skills_section_widget widget.
**/
add_action('widgets_init', 'metrostore_skills_section_widget');
function metrostore_skills_section_widget() {
  register_widget('metrostore_skills_section_widget_area');
}

class metrostore_skills_section_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_skills_section_widget_area', esc_html__('MS: Skills Section','metrostore'), array(
          'description' => esc_html__('A widget that shows your skills.', 'metrostore')
      ));
  }
  
  private function widget_fields() {       

      $fields = array( 
          
          'metrostore_skills_section_title' => array(
              'metrostore_widgets_name' => 'metrostore_skills_section_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),

          'metrostore_skills_section_short_desc' => array(
            'metrostore_widgets_name' => 'metrostore_skills_section_short_desc',
            'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
            'metrostore_widgets_field_type' => 'textarea',
            'metrostore_widgets_row'  => 4
          ),

          'metrostore_start_group_skills_section' => array(
              'metrostore_widgets_name' => 'metrostore_start_group_skills_section',
              'metrostore_widgets_title' => 'Our Skills Area',
              'metrostore_widgets_field_type' => 'group_start',
          ),
            
            'metrostore_skills_area_one_title' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_one_title',
              'metrostore_widgets_title' => esc_html__('Enter Skills Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'text'
            ),
            'metrostore_skills_area_one_icon' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_one_icon',
              'metrostore_widgets_title' => esc_html__('Enter Your Skills Percentage Number', 'metrostore'),
              'metrostore_widgets_field_type' => 'number',
            ),

            // Two

            'metrostore_skills_area_two_title' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_two_title',
              'metrostore_widgets_title' => esc_html__('Enter Skills Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'text'
            ),
            'metrostore_skills_area_two_icon' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_two_icon',
              'metrostore_widgets_title' => esc_html__('Enter Your Skills Percentage Number', 'metrostore'),
              'metrostore_widgets_field_type' => 'number',
            ),

            // Three
            'metrostore_skills_area_three_title' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_three_title',
              'metrostore_widgets_title' => esc_html__('Enter Skills Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'text'
            ),
            'metrostore_skills_area_three_icon' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_three_icon',
              'metrostore_widgets_title' => esc_html__('Enter Your Skills Percentage Number', 'metrostore'),
              'metrostore_widgets_field_type' => 'number',
            ),
            // Four
            'metrostore_skills_area_four_title' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_four_title',
              'metrostore_widgets_title' => esc_html__('Enter Skills Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'text'
            ),
            'metrostore_skills_area_four_icon' => array(
              'metrostore_widgets_name' => 'metrostore_skills_area_four_icon',
              'metrostore_widgets_title' => esc_html__('Enter Your Skills Percentage Number', 'metrostore'),
              'metrostore_widgets_field_type' => 'number',
            ),
          'metrostore_end_group_skills_section' => array(
              'metrostore_widgets_name' => 'metrostore_end_group_skills_section',
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
      $title      = empty( $instance['metrostore_skills_section_title'] ) ? '' : $instance['metrostore_skills_section_title']; 
      $short_desc = empty( $instance['metrostore_skills_section_short_desc'] ) ? '' : $instance['metrostore_skills_section_short_desc'];
      
      // Our Skills Area
      $skills_one = array ( 'icon'  => empty( $instance['metrostore_skills_area_one_icon'] ) ? '' : $instance['metrostore_skills_area_one_icon'], 
                            'title' => empty( $instance['metrostore_skills_area_one_title'] ) ? '' : $instance['metrostore_skills_area_one_title'], 
                            'color' => '#ff3366' 
      );
   
      $skills_two = array ( 'icon'  => empty( $instance['metrostore_skills_area_two_icon'] ) ? '' : $instance['metrostore_skills_area_two_icon'], 
                            'title' => empty( $instance['metrostore_skills_area_two_title'] ) ? '' : $instance['metrostore_skills_area_two_title'], 
                            'color' => '#27ae61' 
      );

      $skills_three = array ( 'icon'  => empty( $instance['metrostore_skills_area_three_icon'] ) ? '' : $instance['metrostore_skills_area_three_icon'], 
                              'title' => empty( $instance['metrostore_skills_area_three_title'] ) ? '' : $instance['metrostore_skills_area_three_title'], 
                              'color' => '#fed136' 
      );

      $skills_four = array ( 'icon'  => empty( $instance['metrostore_skills_area_four_icon'] ) ? '' : $instance['metrostore_skills_area_four_icon'], 
                             'title' => empty( $instance['metrostore_skills_area_four_title'] ) ? '' : $instance['metrostore_skills_area_four_title'], 
                             'color' => '#337ab7' 
      );

      echo $before_widget; 
  ?>
  
<section id="counter-up-chart">
  <div class="container">
    <div class="row"> 
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
      </div><!-- End page header-->
        <?php 
          // Skills Area One
          metrostore_skills_percentage( $skills_one );
          // Skills Area Two
          metrostore_skills_percentage( $skills_two );
          // Skills Area Three
          metrostore_skills_percentage( $skills_three );
          // Skills Area Four
          metrostore_skills_percentage( $skills_four ); 
        ?>
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