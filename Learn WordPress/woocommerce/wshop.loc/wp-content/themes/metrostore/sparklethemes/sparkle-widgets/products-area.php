<?php
/**
 * Adds metrostore_product_widget widget.
**/
add_action('widgets_init', 'metrostore_product_widget');
function metrostore_product_widget() {
  register_widget('metrostore_product_widget_area');
}

class metrostore_product_widget_area extends WP_Widget {

  /**
   * Register widget with WordPress.
  **/
  public function __construct() {
      parent::__construct(
          'metrostore_product_widget_area', esc_html__('MS: Woo Products Area','metrostore'), array(
          'description' => esc_html__('A widget that shows woocommerce all type product (Latest, Feature, On Sale, Up Sale) and selected category products', 'metrostore')
      ));
  }
  
  private function widget_fields() {      

      $prod_type = array(
      	  'latest_product'  => esc_html__('Latest Product', 'metrostore'),
          'category'        => esc_html__('Category', 'metrostore'),          
          'upsell_product'  => esc_html__('UpSell Product', 'metrostore'),
          'feature_product' => esc_html__('Feature Product', 'metrostore'),
          'on_sale'         => esc_html__('OnSale Product', 'metrostore'),
      );

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
        $woocommerce_categories[''] = esc_html__('Select Product Category','metrostore');
        foreach ($woocommerce_categories_obj as $category) {
          $woocommerce_categories[$category->term_id] = $category->name;
        }


      $fields = array(           
          'metrostore_product_title' => array(
              'metrostore_widgets_name' => 'metrostore_product_title',
              'metrostore_widgets_title' => esc_html__('Title', 'metrostore'),
              'metrostore_widgets_field_type' => 'title',
          ),
          'metrostore_product_short_desc' => array(
              'metrostore_widgets_name' => 'metrostore_product_short_desc',
              'metrostore_widgets_title' => esc_html__('Very Short Description', 'metrostore'),
              'metrostore_widgets_field_type' => 'textarea',
              'metrostore_widgets_row'  => 4
          ),
          'metrostore_product_type' => array(
              'metrostore_widgets_name' => 'metrostore_product_type',
              'metrostore_widgets_title' => esc_html__('Select Product Type', 'metrostore'),
              'metrostore_widgets_field_type' => 'select',
              'metrostore_widgets_field_options' => $prod_type
          ),
          'metrostore_woo_category' => array(
              'metrostore_widgets_name' => 'metrostore_woo_category',
              'metrostore_widgets_title' => esc_html__('Select Category', 'metrostore'),
              'metrostore_widgets_field_type' => 'select',
              'metrostore_widgets_field_options' => $woocommerce_categories
          ),
          'metrostore_product_number' => array(
              'metrostore_widgets_name' => 'metrostore_product_number',
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
      $title            = empty( $instance['metrostore_product_title'] ) ? '' : $instance['metrostore_product_title']; 
      $short_desc       = empty( $instance['metrostore_product_short_desc'] ) ? '' : $instance['metrostore_product_short_desc'];
      $product_type     = empty( $instance['metrostore_product_type'] ) ? '' : $instance['metrostore_product_type'];
      $product_category = empty( $instance['metrostore_woo_category'] ) ? '' : $instance['metrostore_woo_category'];
      $product_number   = empty( $instance['metrostore_product_number'] ) ? '' : $instance['metrostore_product_number'];

      $product_args       =   '';
      global $metrostore_label;
      if($product_type == 'category'){
          $product_args = array(
              'post_type' => 'product',
              'tax_query' => array(
                  array('taxonomy'  => 'product_cat',
                   'field'     => 'term_id', 
                   'terms'     => $product_category                                                                 
                  )
              ),
              'posts_per_page' => $product_number
          );
      }
      elseif($product_type == 'latest_product'){
          $metrostore_label = esc_html__('New', 'metrostore');
          $product_args = array(
              'post_type' => 'product',
              'tax_query' => array(
                  array('taxonomy'  => 'product_cat',
                   'field'     => 'id', 
                   'terms'     => $product_category                                                                 
                  )
              ),
              'posts_per_page' => $product_number
          );
      }

      elseif($product_type == 'upsell_product'){
          $product_args = array(
              'post_type'         => 'product',
              'meta_key'          => 'total_sales',
              'orderby'           => 'meta_value_num',
              'posts_per_page'    => $product_number
          );
      }

      elseif($product_type == 'feature_product'){
          $product_args = array(
              'post_type'        => 'product',  
              'tax_query' => array(
                    'relation' => 'AND',      
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                    'operator' => 'IN'
                ),
                array(
                  'taxonomy'  => 'product_cat',
                  'field'     => 'term_id', 
                  'terms'     => $product_category                                                                 
                )
              ), 
              'posts_per_page'   => $product_number   
          );
      }

      elseif($product_type == 'on_sale'){
          $product_args = array(
          'post_type'      => 'product',
          'posts_per_page'   => $product_number,
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
          ));
      }
      
      echo $before_widget; 
  ?>
  
    <section class="product-area">
      <div class="container">
        <div class="page-header text-center">
          <?php if(!empty( $title )) { ?>
              <h2><?php echo esc_html($title); ?></h2>
          <?php } ?>
          <?php
           do_action( 'metrostore_title_design' );
              if(!empty( $short_desc )) {
          ?>
            <p class="lead text-gray"><?php echo esc_html( $short_desc ); ?></p>
          <?php } ?>
        </div>
        
        <div class="container">
          <div class="row"> 
            <div class="home-tab col-xs-12">          
              <div class="tab-content">            
                <div class="tab-pane active">
                  <div class="new-arrivals-pro">
                    <div class="slider-items-products">
                      <div id="product-slider" class="product-flexslider hidden-buttons">
                        <div class="slider-items slider-width-col4">
                          <?php
                              $query = new WP_Query($product_args);

                              if( $query->have_posts() ) { while( $query->have_posts() ) { $query->the_post();
                          ?>
                              <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                              
                          <?php } } wp_reset_postdata(); unset( $GLOBALS['metrostore_label'] );  ?>                      
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