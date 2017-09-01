<?php
/**
 * Adds metrostore_blogs_widget widget.
**/
add_action('widgets_init', 'metrostore_blogs_widget');
function metrostore_blogs_widget() {
  register_widget('metrostore_blogs_widget_area');
}

class metrostore_blogs_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_blogs_widget_area', esc_html__('MS: Blogs Posts','metrostore'), array(
          'description' => esc_html__('A widget that shows wordpress default posts', 'metrostore')
      ));
  }
  
  private function widget_fields() {     

        $args = array(
          'type'       => 'post',
          'child_of'   => 0,
          'orderby'    => 'name',
          'order'      => 'ASC',
          'hide_empty' => 1,
          'taxonomy'   => 'category',
        );
        $categories = get_categories( $args );
        $posts_categories = array();
        foreach( $categories as $category ) {
            $posts_categories[$category->term_id] = $category->name;
        }

      $fields = array( 
          
          'metrostore_blog_title' => array(
              'metrostore_widgets_name' => 'metrostore_blog_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),

          'metrostore_default_posts_category' => array(
              'metrostore_widgets_name' => 'metrostore_default_posts_category',
              'metrostore_mulicheckbox_title' => esc_html__('Select Posts Category', 'metrostore'),
              'metrostore_widgets_field_type' => 'multicheckcategory',
              'metrostore_widgets_field_options' => $posts_categories
          ),
          'metrostore_posts_number' => array(
              'metrostore_widgets_name' => 'metrostore_posts_number',
              'metrostore_widgets_title' => esc_html__('Enter Number of Posts Show', 'metrostore'),
              'metrostore_widgets_field_type' => 'number',
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
      $title               = empty( $instance['metrostore_blog_title'] ) ? '' : $instance['metrostore_blog_title'];
      $blogs_category_list = empty( $instance['metrostore_default_posts_category'] ) ? '' : $instance['metrostore_default_posts_category'];
      $posts_number        = empty( $instance['metrostore_posts_number'] ) ? 5 : $instance['metrostore_posts_number'];      
      
      $blogs_cat_id = array();
      if(!empty($blogs_category_list)){
          $blogs_cat_id = array_keys($blogs_category_list);
      }

      $blogs_posts = new WP_Query( array(
        'post_type' => 'post',
        'cat'       => $blogs_cat_id,
        'posts_per_page' => $posts_number
      ));

      echo $before_widget; 
  ?>
  
<section id="latest-news" class="news">
    <div class="container">
      <div class="row">
        <div class="slider-items-products">
          <div id="latest-news-slider" class="product-flexslider hidden-buttons"> 
            <div class="page-header-wrapper">
              <div class="container">
                <div class="page-header text-center">
                  <?php if(!empty( $title )) { ?>
                      <h2><?php echo esc_html($title); ?></h2>
                  <?php } do_action( 'metrostore_title_design' ); ?>
                </div>
              </div>
            </div><!-- End page header-->
            <div class="slider-items slider-width-col6">
              <?php 
                  if( $blogs_posts->have_posts() ) : while( $blogs_posts->have_posts() ) : $blogs_posts->the_post();
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'metrostore-blog-image', true);
              ?>
                <div class="item">
                  <div class="post-wrapper">
                    <?php if( has_post_thumbnail() ){ ?>
                      <div class="thumbnail-content">
                          <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                            <figure>
                              <img class="img-responsive" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php the_title(); ?>"/>
                            </figure>
                          </a>
                      </div>
                    <?php } ?>
                    <div class="content-meta">
                      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                      <ul class="post-info">
                        <li><i class="fa fa-calendar"></i><?php the_time('F j, Y'); ?></li>
                        <li><i class="fa fa-comments"></i><?php comments_popup_link( esc_html__( '0 Comment', 'metrostore' ),  esc_html__( '1 Comment', 'metrostore' ), esc_html__( '% Comments', 'metrostore' ) ); ?></li>
                      </ul>
                      <p class="excerpt"><?php the_excerpt(); ?></p>
                      <a class="readMore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','metrostore'); ?> <i class="fa fa-angle-right"></i></a> </div>
                  </div>
                </div><!-- End Item -->
              <?php endwhile; endif; wp_reset_postdata(); ?> 
            </div>
          </div>
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