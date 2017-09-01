<?php
 /**
** Adds metrostore_tabs_category_widget widget.
**/
add_action('widgets_init', 'metrostore_tabs_category_widget');
function metrostore_tabs_category_widget() {
  register_widget('metrostore_tabs_category_widget_area');
}

class metrostore_tabs_category_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_tabs_category_widget_area', esc_html__('MS: Woo Tabs Category','metrostore'), array(
          'description' => esc_html__('widget that show woocommerce category products in tabs formats', 'metrostore')
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

			'metrostore_woo_tabs_category' => array(
			  'metrostore_widgets_name' => 'metrostore_woo_tabs_category',
			  'metrostore_mulicheckbox_title' => esc_html__('Select Tabs Category', 'metrostore'),
			  'metrostore_widgets_field_type' => 'multicheckcategory',
			  'metrostore_widgets_field_options' => $woocommerce_categories
			),

      'metrostore_cat_product_category_number' => array(
        'metrostore_widgets_name' => 'metrostore_cat_product_category_number',
        'metrostore_widgets_title' => esc_html__('Enter Number of Products Show', 'metrostore'),
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
      $product_number = empty( $instance['metrostore_cat_product_category_number'] ) ? '' : $instance['metrostore_cat_product_category_number'];
      $tabs_category  = empty( $instance['metrostore_woo_tabs_category'] ) ? '' : $instance['metrostore_woo_tabs_category'];
      if(!empty( $tabs_category )) {
          $tabs_cat_id =  key( $tabs_category );
      }
      echo $before_widget; 
  ?>

<div class="main-container col1-layout">
    <div class="container">
      <div class="row">
        <div class="home-tab col-xs-12 wow fadeInUp">          
          <ul class="nav home-nav-tabs home-product-tabs metrotabs" data-id="<?php echo intval( $product_number ); ?>">
            <?php
                if(!empty($tabs_category)){
                    $count = 1;
                    foreach ($tabs_category as $key => $storecat_id) {                      
                        $term = get_term_by( 'id', $key, 'product_cat');
                    ?>
                        <li <?php if($count == 1){ ?> class="active"<?php } ?>><a data-slug="<?php echo esc_attr( $term->slug ); ?>" href="#<?php echo esc_attr( $term->slug ); ?>" data-toggle="tab" aria-expanded="false"><?php echo esc_attr( $term->name ); ?></a></li>
                    <?php $count++;
                    }
                }
            ?>
          </ul>
          <div id="productTabContent" class="tab-content">            
            <div class="metor-tabs">
              <div class="tab-pane active in" id="<?php echo esc_attr( $term->slug ); ?>">
                <div class="new-arrivals-pro">
                  <div class="slider-items-products">
                    <div id="tabs-slider" class="product-flexslider hidden-buttons">
                      <div class="slider-items slider-width-col4">                        
                        <?php 
                            $product_args = array(
                                'post_type' => 'product',
                                'tax_query' => array(
                                    array(
                                        'taxonomy'  => 'product_cat',
                                        'field'     => 'term_id', 
                                        'terms'     => $tabs_cat_id                                                                 
                                    )),
                                'posts_per_page' => $product_number
                            );
                            $query = new WP_Query($product_args);

                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                            
                        <?php } } wp_reset_postdata(); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>            
          </div>
        </div>
      </div>
    </div>
</div><!-- end main container --> 
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