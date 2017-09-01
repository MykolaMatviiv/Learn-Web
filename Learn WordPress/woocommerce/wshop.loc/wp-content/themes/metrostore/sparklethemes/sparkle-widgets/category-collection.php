<?php
 /**
** Adds metrostore_category_collection_widget widget.
**/
add_action('widgets_init', 'metrostore_category_collection_widget');
function metrostore_category_collection_widget() {
  register_widget('metrostore_category_collection_widget_area');
}

class metrostore_category_collection_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  */
  public function __construct() {
      parent::__construct(
          'metrostore_category_collection_widget_area', esc_html__('MS: Woo Category Collection','metrostore'), array(
          'description' => esc_html__('widget that show woocommerce category collection with feature image', 'metrostore')
      ));
  }
  
  private function widget_fields() {

        $taxonomy     = 'product_cat';
        $empty        = 1;
        $orderby      = 'name';  
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no  
        $title        = '';  
        $empty        = 0;
        $args = array(
          'taxonomy'     => $taxonomy,
          'orderby'      => $orderby,
          'show_count'   => $show_count,
          'pad_counts'   => $pad_counts,
          'hierarchical' => $hierarchical,
          'title_li'     => $title,
          'hide_empty'   => $empty
        );

        $woocommerce_categories = array();
        $woocommerce_categories_obj = get_categories($args);
        foreach ($woocommerce_categories_obj as $category) {
          $woocommerce_categories[$category->term_id] = $category->name;
        }

		$fields = array( 
		  
			'metrostore_cat_collection_title' => array(
			  'metrostore_widgets_name' => 'metrostore_cat_collection_title',
			  'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
			  'metrostore_widgets_field_type' => 'title',
			),

			'metrostore_cat_collection_short_desc' => array(
			  'metrostore_widgets_name' => 'metrostore_cat_collection_short_desc',
			  'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
			  'metrostore_widgets_field_type' => 'textarea',
        'metrostore_widgets_row'  => 4
			),
			
			'metrostore_woo_category_collection' => array(
			  'metrostore_widgets_name' => 'metrostore_woo_category_collection',
			  'metrostore_mulicheckbox_title' => esc_html__('Select Lists Collection Category', 'metrostore'),
			  'metrostore_widgets_field_type' => 'multicheckcategory',
			  'metrostore_widgets_field_options' => $woocommerce_categories
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
      $title                  = empty( $instance['metrostore_cat_collection_title'] ) ? '' : $instance['metrostore_cat_collection_title']; 
      $short_desc             = empty( $instance['metrostore_cat_collection_short_desc'] ) ? '' : $instance['metrostore_cat_collection_short_desc'];
      $category_collection_id = empty( $instance['metrostore_woo_category_collection'] ) ? '' : $instance['metrostore_woo_category_collection'];

      echo $before_widget; 
  ?>

<section class="collestion-area">
    <div class="container">
      <div class="page-header text-center">
        <?php if(!empty( $title )) { ?>
            <h2><?php echo esc_html( $title ); ?></h2>
        <?php } ?>
        <?php do_action( 'metrostore_title_design' );
            if(!empty( $short_desc )) {
        ?>
          <p class="lead text-gray"><?php echo esc_html($short_desc); ?></p>
        <?php } ?>
      </div>
      <div class="collection-content">
        <div class="row">
          <?php
            $count = 1; 
            if(!empty($category_collection_id)){                
                foreach ($category_collection_id as $key => $store_cat_id) {          
                    $thumbnail_id = get_woocommerce_term_meta( $key, 'thumbnail_id', true );
                    $images = wp_get_attachment_url( $thumbnail_id );
                    $image  = wp_get_attachment_image_src($thumbnail_id, 'metrostore-cat-image', true);
                    $term   = get_term_by( 'id', $key, 'product_cat');
                if ( $term && ! is_wp_error( $term ) ) {
                    $term_link = get_term_link($term);
                    $term_name = $term->name;
                }else{
                    $term_link = '#';
                    $term_name = esc_html__('Category','metrostore');
                }                
            $no_img = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=270%C3%97355&w=270&h=355';
          ?>
          <div class="col-md-3 col-sm-4 col-xs-6 single-collection-main">
              <div class="single-collection">                
                <a href="<?php echo esc_url($term_link); ?>">
                  <?php  
                      if ( $images ) {
                        echo '<img alt="" class="img-thumbnail" src="' . esc_url($image[0]) . '" />';
                      } else{
                        echo '<img alt="" class="img-thumbnail" src="' . esc_url($no_img) . '" />';
                      }
                  ?>
                </a>
                <div class="collections-link">
                  <a href="<?php echo esc_url( $term_link ); ?>">
                      <?php echo esc_attr( $term_name ); ?>
                  </a>
                </div>
              </div>
          </div>
          <?php $count++; } } ?>

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