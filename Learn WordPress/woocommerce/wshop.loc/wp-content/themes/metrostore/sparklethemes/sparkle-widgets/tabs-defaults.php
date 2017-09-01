<?php
 /**
** Adds metrostore_tabs_default_widget widget.
**/
add_action('widgets_init', 'metrostore_tabs_default_widget');
function metrostore_tabs_default_widget() {
  register_widget('metrostore_tabs_default_widget_area');
}

class metrostore_tabs_default_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_tabs_default_widget_area', esc_html__('MS: Woo Defaults Tabs','metrostore'), array(
          'description' => esc_html__('widget that show woocommerce default latest, features, on sale, on sale products in tabs formats', 'metrostore')
      ));
  }
  
  private function widget_fields() {        

		$fields = array(

      // Latest Products Section
      'metrostore_start_group_latest_product' => array(
          'metrostore_widgets_name' => 'metrostore_start_group_latest_product',
          'metrostore_widgets_field_type' => 'group_start',
      ),

        'metrostore_latest_product' => array(
          'metrostore_widgets_name' => 'metrostore_latest_product',
          'metrostore_widgets_title' => esc_html__('Checked Display Latest Products', 'metrostore'),
          'metrostore_widgets_field_type' => 'checkbox'
        ),

        'metrostore_latest_product_title' => array(
          'metrostore_widgets_name' => 'metrostore_latest_product_title',
          'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
          'metrostore_widgets_field_type' => 'title',
        ),

      'metrostore_end_group_latest_product' => array(
          'metrostore_widgets_name' => 'metrostore_end_group_latest_product',
          'metrostore_widgets_field_type' => 'group_end',
      ),

      // Feature Products

      'metrostore_start_group_feature_product' => array(
          'metrostore_widgets_name' => 'metrostore_start_group_feature_product',
          'metrostore_widgets_field_type' => 'group_start',
      ),

        'metrostore_feature_product' => array(
          'metrostore_widgets_name' => 'metrostore_feature_product',
          'metrostore_widgets_title' => esc_html__('Checked Display Feature Products', 'metrostore'),
          'metrostore_widgets_field_type' => 'checkbox'
        ),

        'metrostore_feature_product_title' => array(
          'metrostore_widgets_name' => 'metrostore_feature_product_title',
          'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
          'metrostore_widgets_field_type' => 'title',
        ),

      'metrostore_end_group_features_product' => array(
          'metrostore_widgets_name' => 'metrostore_end_group_features_product',
          'metrostore_widgets_field_type' => 'group_end',
      ),


      // On Sale Products

      'metrostore_start_group_onsale_product' => array(
          'metrostore_widgets_name' => 'metrostore_start_group_onsale_product',
          'metrostore_widgets_field_type' => 'group_start',
      ),

        'metrostore_onsale_product' => array(
          'metrostore_widgets_name' => 'metrostore_onsale_product',
          'metrostore_widgets_title' => esc_html__('Checked Display On Sale Products', 'metrostore'),
          'metrostore_widgets_field_type' => 'checkbox'
        ),

        'metrostore_onsalse_product_title' => array(
          'metrostore_widgets_name' => 'metrostore_onsalse_product_title',
          'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
          'metrostore_widgets_field_type' => 'title',
        ),

      'metrostore_end_group_onsale_product' => array(
          'metrostore_widgets_name' => 'metrostore_end_group_onsale_product',
          'metrostore_widgets_field_type' => 'group_end',
      ),

      // UpSell Products

      'metrostore_start_group_upsale_product' => array(
          'metrostore_widgets_name' => 'metrostore_start_group_upsale_product',
          'metrostore_widgets_field_type' => 'group_start',
      ),

        'metrostore_upsale_product' => array(
          'metrostore_widgets_name' => 'metrostore_upsale_product',
          'metrostore_widgets_title' => esc_html__('Checked Display UpSale Products', 'metrostore'),
          'metrostore_widgets_field_type' => 'checkbox'
        ),

        'metrostore_upsalse_product_title' => array(
          'metrostore_widgets_name' => 'metrostore_upsalse_product_title',
          'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
          'metrostore_widgets_field_type' => 'title',
        ),

      'metrostore_end_group_upsale_product' => array(
          'metrostore_widgets_name' => 'metrostore_end_group_upsale_product',
          'metrostore_widgets_field_type' => 'group_end',
      ),



      'metrostore_deault_tabs_product_number' => array(
        'metrostore_widgets_name' => 'metrostore_deault_tabs_product_number',
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
      $latest_product        = empty( $instance['metrostore_latest_product'] ) ? '' : $instance['metrostore_latest_product'];
      $latest_product_title  = empty( $instance['metrostore_latest_product_title'] ) ? '' : $instance['metrostore_latest_product_title'];
      $feature_product       = empty( $instance['metrostore_feature_product'] ) ? '' : $instance['metrostore_feature_product'];
      $feature_product_title = empty( $instance['metrostore_feature_product_title'] ) ? '' : $instance['metrostore_feature_product_title'];
      $onsale_product        = empty( $instance['metrostore_onsale_product'] ) ? '' : $instance['metrostore_onsale_product'];
      $onsale_product_title  = empty( $instance['metrostore_onsalse_product_title'] ) ? '' : $instance['metrostore_onsalse_product_title'];
      $upsale_product        = empty( $instance['metrostore_upsale_product'] ) ? '' : $instance['metrostore_upsale_product'];
      $upsale_product_title  = empty( $instance['metrostore_upsalse_product_title'] ) ? '' :$instance['metrostore_upsalse_product_title'];
      $product_number        = empty( $instance['metrostore_deault_tabs_product_number'] ) ? 5 : $instance['metrostore_deault_tabs_product_number'];
      echo $before_widget; 
  ?>
<?php if($latest_product == 1 || $feature_product == 1 || $onsale_product == 1 || $upsale_product == 1) { ?>
<div class="main-container col1-layout">
    <div class="container">
      <div class="row"> 
        <div class="home-tab col-xs-12 wow fadeInUp">          
          <ul class="nav home-nav-tabs home-product-tabs">
            <?php if(!empty( $latest_product ) && $latest_product == 1) { ?>
              <li class="active">
                <a href="#new-arrivals" data-toggle="tab" aria-expanded="false">
                  <?php echo esc_html($latest_product_title); ?>
                </a>
              </li>
            <?php }  if(!empty( $feature_product ) && $feature_product == 1) { ?>
                <li> 
                  <a href="#best-sale" data-toggle="tab" aria-expanded="false">
                    <?php echo esc_html($feature_product_title); ?>
                  </a> 
                </li>
            <?php }  if(!empty( $onsale_product ) && $onsale_product == 1) { ?>
                <li> 
                  <a href="#top-sellers" data-toggle="tab" aria-expanded="false">
                    <?php echo esc_html($onsale_product_title); ?>
                  </a> 
                </li>
            <?php } if(!empty( $upsale_product ) && $upsale_product == 1) { ?>
                <li> 
                  <a href="#up-sellers" data-toggle="tab" aria-expanded="false">
                    <?php echo esc_html($upsale_product_title); ?>
                  </a> 
                </li>
            <?php } ?>
          </ul>          
          <div id="productTabContent" class="tab-content">
            <?php if(!empty( $latest_product ) && $latest_product == 1) { ?>
            <div class="tab-pane active in" id="new-arrivals">
              <div class="new-arrivals-pro">
                <div class="slider-items-products">
                  <div id="new-arrivals-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4">
                      <?php
                          $metrostore_label = esc_html__('New', 'metrostore');
                          $product_args = array(
                              'post_type' => 'product',                             
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
            <?php }  if(!empty( $feature_product ) && $feature_product == 1) { ?>
            <div class="tab-pane fade" id="best-sale">
              <div class="best-sale-pro">
                <div class="slider-items-products">
                  <div id="best-sale-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4 fadeInUp">                      
                      <?php
                          $metrostore_label = esc_html__('New', 'metrostore');
                          $feature_product = array(
                             'post_type'        => 'product',  
                             'meta_key'         => '_featured',  
                             'meta_value'       => 'yes',  
                             'posts_per_page'   => $product_number 
                          );
                          $query = new WP_Query($feature_product);
                          if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                      ?>
                          <?php woocommerce_get_template_part( 'content', 'product' ); ?>                          
                      <?php } } wp_reset_postdata(); ?>                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }  if(!empty( $onsale_product ) && $onsale_product == 1) { ?>
            <div class="tab-pane fade" id="top-sellers">
              <div class="top-sellers-pro">
                <div class="slider-items-products">
                  <div id="top-sellers-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4 fadeInUp">                      
                       <?php
                            $metrostore_label = esc_html__('New', 'metrostore');
                            $on_sale = array(
                                'post_type'      => 'product',
                                'posts_per_page' => $product_number,
                                'meta_query'     => array(
                                  'relation' => 'OR',
                                    array( // Simple products type
                                      'key'           => '_sale_price',
                                      'value'         => 0,
                                      'compare'       => '>',
                                      'type'          => 'numeric'
                                      ),
                                    array( // Variable products type
                                      'key'           => '_min_variation_sale_price',
                                      'value'         => 0,
                                      'compare'       => '>',
                                      'type'          => 'numeric'
                                      )
                                    )
                              );

                            $query = new WP_Query($on_sale);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>                            
                        <?php } } wp_reset_postdata(); ?> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } if(!empty( $upsale_product ) && $upsale_product == 1) { ?>
            <div class="tab-pane fade" id="up-sellers">
              <div class="top-sellers-pro">
                <div class="slider-items-products">
                  <div id="top-sellers-slider" class="product-flexslider hidden-buttons">
                    <div class="slider-items slider-width-col4 fadeInUp">                      
                       <?php
                            $metrostore_label = esc_html__('New', 'metrostore');
                            $upsell_product = array(
                              'post_type'         => 'product',
                              'meta_key'          => 'total_sales',
                              'orderby'           => 'meta_value_num',
                              'posts_per_page'    => $product_number
                            );
                            $query = new WP_Query($upsell_product);
                            if($query->have_posts()) { while($query->have_posts()) { $query->the_post();
                        ?>
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>                            
                        <?php } } wp_reset_postdata(); ?> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
</div><!-- end main container -->
<?php }       
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