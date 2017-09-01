<?php
/**
 * MetroStore Theme Customizer.
 *
 * @package MetroStore
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
*/
function metrostore_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * Important Link
	*/
	$wp_customize->add_section( 'metrostore_implink_section', array(
	  'title'       => esc_html__( 'Important Links', 'metrostore' ),
	  'priority'      => 1
	) );

	    $wp_customize->add_setting( 'metrostore_imp_links', array(
	      'sanitize_callback' => 'metrostore_text_sanitize'
	    ));

	    $wp_customize->add_control( new Metrostore_theme_Info_Text( $wp_customize,'metrostore_imp_links', array(
	        'settings'    => 'metrostore_imp_links',
	        'section'   => 'metrostore_implink_section',
	        'description' => '<a class="implink" href="http://docs.sparklewpthemes.com/metrostore" target="_blank">'.esc_html__('Documentation', 'metrostore').'</a><a class="implink" href="http://demo.sparklewpthemes.com/metrostore/demos/" target="_blank">'.esc_html__('Live Demo', 'metrostore').'</a><a class="implink" href="https://sparklewpthemes.com/support" target="_blank">'.esc_html__('Support Forum', 'metrostore').'</a><a class="implink" href="https://www.facebook.com/sparklewpthemes" target="_blank">'.esc_html__('Like Us in Facebook', 'metrostore').'</a>',
	      )
	    ));

	    $wp_customize->add_setting( 'metrostore_rate_us', array(
	      'sanitize_callback' => 'metrostore_text_sanitize'
	    ));

	    $wp_customize->add_control( new Metrostore_theme_Info_Text( $wp_customize, 'metrostore_rate_us', array(
	          'settings'    => 'metrostore_rate_us',
	          'section'   => 'metrostore_implink_section',
	          'description' => sprintf(__( 'Please do rate our theme if you liked it %1$s', 'metrostore'), '<a class="implink" href="https://wordpress.org/support/theme/metrostore/reviews/?filter=5" target="_blank">'.esc_html__('Rate/Review','metrostore').'</a>' ),
	        )
	    ));

	    $wp_customize->add_setting( 'metrostore_setup_instruction', array(
	      'sanitize_callback' => 'metrostore_text_sanitize'
	    ));

	    $wp_customize->add_control( new Metrostore_theme_Info_Text( $wp_customize, 'metrostore_setup_instruction', array(
	        'settings'    => 'metrostore_setup_instruction',
	        'section'   => 'metrostore_implink_section',
	        'description' => __( '<span class="customize-text_editor_desc">
	        		<h2 class="customize-title">'.esc_html__('Metrostore Pro Features','metrostore').'</h2>                
                    <ul class="admin-pro-feature-list">   
                        <li><span>'.esc_html__('Next generation WooCommerce theme','metrostore').'</span></li>
                        <li><span>'.esc_html__('WordPress Live Customizer','metrostore').'</span></li>
                        <li><span>'.esc_html__('One Click Demo Import','metrostore').'</span></li>
                        <li><span>'.esc_html__('Unlimited theme colors ( Primary Colors)','metrostore').'</span></li>
                        <li><span>'.esc_html__('Unlimited sliders Inbuilt sliders or Slider Revolution','metrostore').'</span></li>
                        <li><span>'.esc_html__('Configure product page/ shop unlimited','metrostore').'</span></li>
                        <li><span>'.esc_html__('Advanced product search','metrostore').'</span></li>
                        <li><span>'.esc_html__('Smart header with 6 different layout','metrostore').'</span></li>
                        <li><span>'.esc_html__('Background configuration','metrostore').'</span></li>
                        <li><span>'.esc_html__('19+ Inbuilt custom widgets','metrostore').'</span></li>
                        <li><span>'.esc_html__('Highly configurable home page','metrostore').'</span></li>
                        <li><span>'.esc_html__('Three different horizontal category Ajax tabs','metrostore').'</span></li>
                        <li><span>'.esc_html__('Special offers/ deals sections','metrostore').'</span></li>
                        <li><span>'.esc_html__('Product list to display popular products','metrostore').'</span></li>
                        <li><span>'.esc_html__('Product lists in column','metrostore').'</span></li>
                        <li><span>'.esc_html__('Full width Promo Widget','metrostore').'</span></li>
                        <li><span>'.esc_html__('Breadcrumbs Settings','metrostore').'</span></li>
                        <li><span>'.esc_html__('Custom CSS Section','metrostore').'</span></li>
                        <li><span>'.esc_html__('Four different blog layouts','metrostore').'</span></li>
                        <li><span>'.esc_html__('Our team member section','metrostore').'</span></li>                        
                        <li><span>'.esc_html__('Testimonial section','metrostore').'</span></li>
                        <li><span>'.esc_html__('Multiple preloader options','metrostore').'</span></li>
                        <li><span>'.esc_html__('Responsive retina ready theme','metrostore').'</span></li>
                        <li><span>'.esc_html__('3 Page layouts (right sidebar, left sidebar, full width)','metrostore').'</span></li>
                        <li><span>'.esc_html__('Fully SEO optimized (schema)','metrostore').'</span></li>
                        <li><span>'.esc_html__('Fast loading','metrostore').'</span></li>
                        <li><span>'.esc_html__('A perfect theme to start your eCommerce store of any kind !!!','metrostore').'</span></li>
                    </ul>                    
                    <a href="'.esc_url('https://www.sparklewpthemes.com/wordpress-themes/metrostorepro').'" class="button button-primary buynow" target="_blank">'.esc_html__('Buy Now','metrostore').'</a>
                </span>', 'metrostore'),
	      )
	    ));

/**
 * General Settings Panel
*/
$wp_customize->add_panel('metrostore_general_settings', array(
   'capabitity' => 'edit_theme_options',
   'priority' => 2,
   'title' => esc_html__('General Settings', 'metrostore')
));

    $wp_customize->get_section('title_tagline')->panel = 'metrostore_general_settings';
    $wp_customize->get_section('title_tagline' )->priority = 1;

    $wp_customize->get_section('header_image')->panel = 'metrostore_general_settings';
    $wp_customize->get_section('header_image' )->priority = 2;

    $wp_customize->get_section('colors')->title = esc_html__( 'Themes Colors', 'metrostore' );
    $wp_customize->get_section('colors')->panel = 'metrostore_general_settings';
    $wp_customize->get_section('header_image' )->priority = 3;

    $wp_customize->get_section('background_image')->panel = 'metrostore_general_settings';
    $wp_customize->get_section('header_image' )->priority = 4;
	
	/**
	  * Web Page Layout Section
	*/
	$wp_customize->add_section( 'metrostore_web_page_layout', array(
		'title'   => esc_html__('WebLayout Options', 'metrostore'),
		'priority' => 5,
		'panel'   => 'metrostore_general_settings'
	));

		$wp_customize->add_setting('metrostore_webpage_layout_options', array(
		  'default' => 'fullwidth',
		  'sanitize_callback' => 'metrostore_weblayout_sanitize',
		));

		$wp_customize->add_control('metrostore_webpage_layout_options', array(
		  'type' => 'radio',
		  'label' => esc_html__('Web Layout Options', 'metrostore'),
		  'section' => 'metrostore_web_page_layout',
		  'settings' => 'metrostore_webpage_layout_options',
			  'choices' => array(
			    'boxed' => esc_html__('Boxed Layout', 'metrostore'),
			    'fullwidth' => esc_html__('Full Width Layout', 'metrostore')
			  )
		));


/**
 * Header Settings Area 
*/
$wp_customize->add_panel('metorstore_header_settings', array(
  'title' => esc_html__('Header Settings Area', 'metrostore'),
  'capability' => 'edit_theme_options',
  'priority' => 21,
));
	
	/**
	 * Top Header Quick Contact Information Options 
	*/
	$wp_customize->add_section( 'metrostore_header_quickinfo', array(
	  'capability'     => 'edit_theme_options',
	  'panel'		   => 'metorstore_header_settings',
	  'title'          => esc_html__( 'Quick Contact Info', 'metrostore' )
	) );

		$wp_customize->add_setting('metrostore_email_title', array(
		  'default' => '',
		  'sanitize_callback' => 'sanitize_email',  // done
		));

		$wp_customize->add_control('metrostore_email_title',array(
		  'type' => 'text',
		  'label' => esc_html__('Email Address', 'metrostore'),
		  'section' => 'metrostore_header_quickinfo',
		  'setting' => 'metrostore_email_title',
		));

		$wp_customize->add_setting('metrostore_phone_number', array(
		  'default' => '',
		  'sanitize_callback' => 'metrostore_text_sanitize',  // done
		));

		$wp_customize->add_control('metrostore_phone_number',array(
		  'type' => 'text',
		  'label' => esc_html__('Phone Number', 'metrostore'),
		  'section' => 'metrostore_header_quickinfo',
		  'setting' => 'metrostore_phone_number',
		));

		$wp_customize->add_setting('metrostore_map_address', array(
		  'default' => '',
		  'sanitize_callback' => 'metrostore_text_sanitize',  // done
		));

		$wp_customize->add_control('metrostore_map_address',array(
		  'type' => 'text',
		  'label' => esc_html__('Address', 'metrostore'),
		  'section' => 'metrostore_header_quickinfo',
		  'setting' => 'metrostore_map_address',
		));

		$wp_customize->add_setting('metrostore_start_open_time', array(
		  'default' => '',
		  'sanitize_callback' => 'metrostore_text_sanitize',  // done
		));

		$wp_customize->add_control('metrostore_start_open_time',array(
		  'type' => 'text',
		  'label' => esc_html__('Opening Time', 'metrostore'),
		  'section' => 'metrostore_header_quickinfo',
		  'setting' => 'metrostore_start_open_time',
		));

	/**
	  * Services settings Options
	*/
    $wp_customize->add_section('metrostore_header_service_area', array(
		'title'    => esc_html__('Header Services Area', 'metrostore'),
		'panel'    => 'metorstore_header_settings'
	));

		$wp_customize->add_setting('metrostore_first_icon_block_area', array(
			'default' => 'fa-truck',
			'sanitize_callback' => 'metrostore_text_sanitize',
			//'transport' => 'postMessage'
		));

		$wp_customize->add_control('metrostore_first_icon_block_area',array(
			'type' => 'text',
			'description' => sprintf( __( 'Use font awesome icon: Eg: %1$s. %2$sSee more here%3$s', 'metrostore' ), 'free-shipping','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),        
			'label' => esc_html__('First Services Icon', 'metrostore'),
			'section' => 'metrostore_header_service_area',
			'setting' => 'metrostore_first_icon_block_area',
		));

		$wp_customize->add_setting('metrostore_first_icon_title_area', array(
			'default' => '',
			'sanitize_callback' => 'metrostore_text_sanitize'
		));

		$wp_customize->add_control('metrostore_first_icon_title_area',array(
			'type' => 'text',
			'label' => esc_html__('First Services Title', 'metrostore'),
			'section' => 'metrostore_header_service_area',
			'setting' => 'metrostore_first_icon_title_area',
		));

		$wp_customize->add_setting('metrostore_first_icon_title_desc_area', array(
			'default' => '',
			'sanitize_callback' => 'metrostore_text_sanitize'
		));

		$wp_customize->add_control('metrostore_first_icon_title_desc_area',array(
			'type' => 'text',
			'label' => esc_html__('Services Very Short Description', 'metrostore'),
			'section' => 'metrostore_header_service_area',
			'setting' => 'metrostore_first_icon_title_desc_area',
		));


		$wp_customize->add_setting('metrostore_second_icon_block_area', array(
			'default' => 'fa-thumbs-up',
			'sanitize_callback' => 'metrostore_text_sanitize'
		));

		$wp_customize->add_control('metrostore_second_icon_block_area',array(
			'type' => 'text',
			'description' => sprintf( __( 'Use font awesome icon: Eg: %1$s. %2$sSee more here%3$s', 'metrostore' ), 'fa-user','<a href="'.esc_url('http://fontawesome.io/cheatsheet/').'" target="_blank">','</a>' ),        
			'label' => esc_html__('Second Services Icon', 'metrostore'),
			'section' => 'metrostore_header_service_area',
			'setting' => 'metrostore_second_icon_block_area',
		));

		$wp_customize->add_setting('metrostore_second_icon_title_area', array(
			'default' => '',
			'sanitize_callback' => 'metrostore_text_sanitize',
			//'transport' => 'postMessage'
		));

		$wp_customize->add_control('metrostore_second_icon_title_area',array(
			'type' => 'text',
			'label' => esc_html__('Second Services Title', 'metrostore'),
			'section' => 'metrostore_header_service_area',
			'setting' => 'metrostore_second_icon_title_area',
		));

		$wp_customize->add_setting('metrostore_second_icon_title_desc_area', array(
			'default' => '',
			'sanitize_callback' => 'metrostore_text_sanitize'
		));

		$wp_customize->add_control('metrostore_second_icon_title_desc_area',array(
			'type' => 'text',
			'label' => esc_html__('Services Very Short Description', 'metrostore'),
			'section' => 'metrostore_header_service_area',
			'setting' => 'metrostore_second_icon_title_desc_area',
		));

/**
 * Theme Color Settings Area 
*/
	$wp_customize->get_section( 'colors' )->title    = esc_html__( 'Theme Colors Settings', 'metrostore' );
	$wp_customize->get_section('colors' )->priority = 22;

/**
 * Breadcrumbs Settings Area 
*/
$wp_customize->add_section('metrostore_breadcrumbs_section', array(
  'title' => esc_html__('Breadcrumbs Settings', 'metrostore'),
  'priority' => 23,
));

	$wp_customize->add_setting('metrostore_breadcrumb_options', array(
		'default' => 1,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'metrostore_checkbox_sanitize' // done
	));

	$wp_customize->add_control('metrostore_breadcrumb_options', array(
		'type' => 'checkbox',
		'label' => esc_html__('Check to Enable the Breadcrumbs', 'metrostore'),
		'section' => 'metrostore_breadcrumbs_section',
		'settings' => 'metrostore_breadcrumb_options'
	));	

	$wp_customize->add_setting('metrostore_breadcrumbs_bg_image', array(
		'default' => '',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'metrostore_breadcrumbs_bg_image', array(
		 'label' => esc_html__('Upload Breadcrumbs Background Image', 'metrostore'),
		 'section' => 'metrostore_breadcrumbs_section',
		 'setting' => 'metrostore_breadcrumbs_bg_image'
	)));	

/**
 * Banner/Slider Settings Panel
*/
$wp_customize->add_section('metrostore_main_banner_area', array(
  'title' => esc_html__('Home Slider Settings', 'metrostore'),
  'priority' => 24,
));
	
	$wp_customize->add_setting('metrostore_home_slider_options', array(
	   'default' => 'enable',
	   'sanitize_callback' => 'metrostore_radio_enable_sanitize', // done
	));

	$wp_customize->add_control('metrostore_home_slider_options', array(
	   'type' => 'radio',
	   'label' => esc_html__('Enable/Disable HomePage Slider', 'metrostore'),
	   'section' => 'metrostore_main_banner_area',
	   'setting' => 'metrostore_home_slider_options',
	   'choices' => array(
	      'enable' => esc_html__('Enable', 'metrostore'),
	      'disable' => esc_html__('Disable', 'metrostore'),
	)));

	/* Main Slider Category */
	$wp_customize->add_setting( 'metrostore_slider_team_id', array(
	      'default' => '',
	      'sanitize_callback' => 'absint'
	) );

	$wp_customize->add_control( new Metrostore_Category_Dropdown( $wp_customize, 'metrostore_slider_team_id', array(
	    'label' => esc_html__( 'Select Slide Category', 'metrostore' ),
	    'section' => 'metrostore_main_banner_area',
	) ) );

		
/**
 * Footer Settings Area 
*/
	$wp_customize->add_panel('metorstore_settings', array(
	  'title' => esc_html__('Footer Settings Area', 'metrostore'),
	  'capability' => 'edit_theme_options',
	  'priority' => 25,
	));

	/**
	  * Copyright message settings Options
	*/
    $wp_customize->add_section('metrostore_copyright_message', array(
		'priority' => 1,
		'title'    => esc_html__('Write Copyright', 'metrostore'),
		'panel'    => 'metorstore_settings'
	));

		$wp_customize->add_setting('metrostore_footer_copyright_setting', array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'metrostore_text_sanitize'
      	));

      	$wp_customize->add_control('metrostore_footer_copyright_setting', array(
			'type' => 'textarea',
			'label' => esc_html__('Copyright Text', 'metrostore'),
			'section' => 'metrostore_copyright_message',
			'settings' => 'metrostore_footer_copyright_setting'
      	));


	/**
	  * Social Icon Link Options
	*/
    $wp_customize->add_section('metrostore_social_link_activate_settings', array(
		'priority' => 2,
		'title'    => esc_html__('Social Icon Settings', 'metrostore'),
		'panel'    => 'metorstore_settings'
	));		

		$metrostore_social_links = array(
			'metrostore_social_facebook' => array(
				'id' => 'metrostore_social_facebook',
				'title' => esc_html__('Facebook', 'metrostore'),
				'default' => ''
			),

			'metrostore_social_twitter' => array(
				'id' => 'metrostore_social_twitter',
				'title' => esc_html__('Twitter', 'metrostore'),
				'default' => ''
			),

			'metrostore_social_googleplus' => array(
				'id' => 'metrostore_social_googleplus',
				'title' => esc_html__('Google-Plus', 'metrostore'),
				'default' => ''
			),

			'metrostore_social_instagram' => array(
				'id' => 'metrostore_social_instagram',
				'title' => esc_html__('Instagram', 'metrostore'),
				'default' => ''
			),

			'metrostore_social_linkedin' => array(
				'id' => 'metrostore_social_linkedin',
				'title' => esc_html__('Linkedin', 'metrostore'),
				'default' => ''
			)
		);

		$i = 20;

		foreach($metrostore_social_links as $metrostore_social_link) {

			$wp_customize->add_setting($metrostore_social_link['id'], array(
				'default' => $metrostore_social_link['default'],
	         	'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'  // done
			));

			$wp_customize->add_control($metrostore_social_link['id'], array(
				'label' => $metrostore_social_link['title'],
				'section'=> 'metrostore_social_link_activate_settings',
				'settings'=> $metrostore_social_link['id'],
				'priority' => $i
			));

			$wp_customize->add_setting($metrostore_social_link['id'].'_checkbox', array(
				'default' => 0,
	         	'capability' => 'edit_theme_options',
				'sanitize_callback' => 'metrostore_checkbox_sanitize'  // done
			));

			$wp_customize->add_control($metrostore_social_link['id'].'_checkbox', array(
				'type' => 'checkbox',
				'label' => esc_html__('Check to show in new tab', 'metrostore'),
				'section'=> 'metrostore_social_link_activate_settings',
				'settings'=> $metrostore_social_link['id'].'_checkbox',
				'priority' => $i
			));

			$i++;
		}

	/**
	 * Text Sanitization
	*/
    function metrostore_text_sanitize( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    /**
	 * Web Layout Sanitization
	*/
    function metrostore_weblayout_sanitize($input) {
        $valid_keys = array(
           'boxed' => esc_html__('Boxed Layout', 'metrostore'),
		   'fullwidth' => esc_html__('Full Width Layout', 'metrostore')
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
        } else {
          return '';
        }
    }

    /**
	 * Enable/Disable Sanitization
	*/
    function metrostore_radio_enable_sanitize($input) {
        $valid_keys = array(
           'enable' => esc_html__('Enable', 'metrostore'),
	       'disable' => esc_html__('Disable', 'metrostore'),
        );
        if ( array_key_exists( $input, $valid_keys ) ) {
          return $input;
        } else {
          return '';
        }
    }

    /**
	 * Checkbox Sanitization
	*/
    function metrostore_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return 0;
      }
    }
    	
}
add_action( 'customize_register', 'metrostore_customize_register' );

/**
 * Custom Control for Customizer Category Dropdown
*/
if( class_exists( 'WP_Customize_control') ) {
    
    class Metrostore_Category_Dropdown extends WP_Customize_Control{
        private $cats = false;
        public function __construct($manager, $id, $args = array(), $options = array()){
            $this->cats = get_categories($options);
            parent::__construct( $manager, $id, $args );
        }

        public function render_content(){
            if(!empty($this->cats)){
                ?>
                    <label>
                      <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
                      <select <?php $this->link(); ?>>
                           <?php
                                foreach ( $this->cats as $cat )
                                {
                                    printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);
                                }
                           ?>
                      </select>
                    </label>
                <?php
            }
       }
    }

    /**
     * Important Link Information
    */
    class Metrostore_theme_Info_Text extends WP_Customize_Control{
        public function render_content(){  ?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if($this->description){ ?>
                <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
                </span>
            <?php }
        }
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function metrostore_customize_preview_js() {
	wp_enqueue_script( 'metrostore_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'metrostore_customize_preview_js' );
