<?php
class City_Store_lite_Discount_Customize_Section_Pro extends WP_Customize_Section {

  /**
   * The type of customize section being rendered.
   *
   * @since  1.0.0
   * @access public
   * @var    string
   */
  public $type = 'city_store_to_pro_discount';

  /**
   * Custom button text to output.
   *
   * @since  1.0.0
   * @access public
   * @var    string
   */
  public $pro_text = '';

  /**
   * Custom pro button URL.
   *
   * @since  1.0.0
   * @access public
   * @var    string
   */
  public $pro_url = '';

  /**
   * Add custom parameters to pass to the JS via JSON.
   *
   * @since  1.0.0
   * @access public
   * @return void
   */
  public function json() {
    $json = parent::json();

    $json['pro_text'] = $this->pro_text;
    $json['pro_url']  = esc_url( $this->pro_url );

    return $json;
  }

  /**
   * Outputs the Underscore.js template.
   *
   * @since  1.0.0
   * @access public
   * @return void
   */
  protected function render_template() { ?>

    <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand upgrade-to-city-store-pro">

      <h3 class="accordion-section-title">

        <# if ( data.pro_text && data.pro_url ) { #>
          <a class="city-store-lite-support" target="_blank" href="{{ data.pro_url }}"><span class="dashicons dashicons-star-filled"></span>{{ data.pro_text }}</a>
        <# } #>
      </h3>
    </li>
  <?php }
}