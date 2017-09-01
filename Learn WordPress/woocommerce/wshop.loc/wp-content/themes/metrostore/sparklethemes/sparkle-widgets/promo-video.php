<?php
/**
 * Adds metrostore_promo_video_widget widget.
**/
add_action('widgets_init', 'metrostore_promo_video_widget');
function metrostore_promo_video_widget() {
  register_widget('metrostore_promo_video_widget_area');
}

class metrostore_promo_video_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_promo_video_widget_area', esc_html__('MS: Promo Video Area','metrostore'), array(
          'description' => esc_html__('A widget that promote your busincess.', 'metrostore')
      ));
  }
  
  private function widget_fields() {

      $fields = array( 
          
          'metrostore_promo_video_title' => array(
              'metrostore_widgets_name' => 'metrostore_promo_video_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),
          'metrostore_promo_video_short_desc' => array(
              'metrostore_widgets_name' => 'metrostore_promo_video_short_desc',
              'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
              'metrostore_widgets_field_type' => 'textarea',
              'metrostore_widgets_row'  => 4
          ),
          
          'metrostore_promo_video_url' => array(
              'metrostore_widgets_name' => 'metrostore_promo_video_url',
              'metrostore_widgets_title' => esc_html__('Enter Youtube Video Url', 'metrostore'),
              'metrostore_widgets_field_type' => 'url',
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
      $title      = empty( $instance['metrostore_promo_video_title'] ) ? '' : $instance['metrostore_promo_video_title']; 
      $short_desc = empty( $instance['metrostore_promo_video_short_desc'] ) ? '' : $instance['metrostore_promo_video_short_desc'];
      $video_url  = empty( $instance['metrostore_promo_video_url'] ) ? '' : $instance['metrostore_promo_video_url'];

      echo $before_widget; 
  ?>

<section class="video-bg"> 
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
          <a class="play-bnt"><i class="fa fa-play-circle"></i> </a>
        </div>
      </div>
    </div><!-- End page header-->
    <div class="wrap_video">
        <div class="effect_video">                    
          <?php if($video_url){ ?>
            <?php $vidarr = explode('?v=', $video_url); $vid_id = $vidarr[1]; ?>
            <div vid="<?php echo esc_attr($vid_id); ?>"  class="background-video"></div>
          <?php } ?>
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