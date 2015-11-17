<?php 


 function custom_controls(){

    class Custom_Textarea_Control extends WP_Customize_Control {
      public $type = 'textarea';
   
      public function render_content() {
          ?>
          <label>
          <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
          <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
          </label>
          <?php
      }
    }

   }
   
   add_action( 'customize_register' , 'custom_controls' );

   /**
 * Contains methods for customizing the theme customization screen.
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since MyTheme 1.0
 */
class mybstheme_customizer {
   /**
    * This hooks into 'customize_register' (available as of WP 3.4) and allows
    * you to add new sections and controls to the Theme Customize screen.
    * 
    * Note: To enable instant preview, we have to actually write a bit of custom
    * javascript. See live_preview() for more.
    *  
    * @see add_action('customize_register',$func)
    * @param \WP_Customize_Manager $wp_customize
    * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
    * @since MyTheme 1.0
    */
   public static function register ( $wp_customize ) {
      //1. Define a new section (if desired) to the Theme Customizer
      $wp_customize->add_section( 'mybstheme_section', 
         array(
            'title' => __( 'My BS Theme', 'mybstheme' ), //Visible title of section
            'priority' => 35, //Determines what order this appears in
            'capability' => 'edit_theme_options', //Capability needed to tweak
            'description' => __('My BS Theme Customizer.', 'mybstheme'), //Descriptive tooltip
         ) 
      );
      
      //2. Register new settings to the WP database...
      $wp_customize->add_setting( 'mybstheme_image', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => '#2BA6CB', //Default setting/value to save
            'type' => 'option', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );  


     $wp_customize->add_setting( 'mybstheme_welcomeTitle', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => 'My Theme', //Default setting/value to save
            'type' => 'option', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );   


     $wp_customize->add_setting( 'mybstheme_welcomeText', //No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
         array(
            'default' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English.', //Default setting/value to save
            'type' => 'option', //Is this an 'option' or a 'theme_mod'?
            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.
            'transport' => 'postMessage', //What triggers a refresh of the setting? 'refresh' or 'postMessage' (instant)?
         ) 
      );      
            
      //3. Finally, we define the control itself (which links a setting to a section and renders the HTML controls)...
      $wp_customize->add_control( new WP_Customize_Image_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'mybstheme_image_control', //Set a unique ID for the control
         array(
            'label' => __( 'Slider Image', 'mybstheme' ), //Admin-visible name of the control
            'section' => 'mybstheme_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'mybstheme_image', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );
      
      $wp_customize->add_control( new WP_Customize_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'mybstheme_welcomeTitle_control', //Set a unique ID for the control
         array(
            'label' => __( 'Slider Title', 'mybstheme' ), //Admin-visible name of the control
            'section' => 'mybstheme_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'mybstheme_welcomeTitle', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );


      $wp_customize->add_control( new Custom_Textarea_Control( //Instantiate the color control class
         $wp_customize, //Pass the $wp_customize object (required)
         'mybstheme_welcomeText_control', //Set a unique ID for the control
         array(
            'label' => __( 'Slider Text', 'mybstheme' ), //Admin-visible name of the control
            'section' => 'mybstheme_section', //ID of the section this control should render in (can be one of yours, or a WordPress default section)
            'settings' => 'mybstheme_welcomeText', //Which setting to load and manipulate (serialized is okay)
            'priority' => 10, //Determines the order this control appears in for the specified section
         ) 
      ) );

      //4. We can also change built-in settings by modifying properties. For instance, let's make some stuff use live preview JS...
      $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
      $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
     
   }


 

   /**
    * This will output the custom WordPress settings to the live theme's WP head.
    * 
    * Used by hook: 'wp_head'
    * 
    * @see add_action('wp_head',$func)
    * @since MyTheme 1.0
    */
   public static function header_output() {

      $slider_image = get_option('mybstheme_image');
      $header_styles = "";
      if ($slider_image) {
    
        $attachment_id = mybstheme_get_attachment_id_from_url($slider_image);
        $image480 = wp_get_attachment_image_src( $attachment_id, 'image_xs' );
        $image768 = wp_get_attachment_image_src( $attachment_id, 'image_sm' );
        $image1024 = wp_get_attachment_image_src( $attachment_id, 'image_md' );
        $image1920 = wp_get_attachment_image_src( $attachment_id, 'image_lg' );

        $header_styles .= 'background-image: url('. $image480[0] .');';
        
      }
      ?>
      <!--Customizer CSS--> 
      <style type="text/css">
          <?php if ($header_styles) {
            echo '.jumbotron { '. $header_styles .' }';
            echo '@media (min-width:768px) { .jumbotron { background-image: url(\''. $image768[0] .'\'); }}';
            echo '@media (min-width:1024px) { .jumbotron { background-image: url(\''. $image1024[0] .'\'); }}';
            echo '@media (min-width:1200px) { .jumbotron { background-image: url(\''. $image1920[0] .'\'); }}';
          } ?>
      </style> 
      <!--/Customizer CSS-->
      <?php
   }
   
   /**
    * This outputs the javascript needed to automate the live settings preview.
    * Also keep in mind that this function isn't necessary unless your settings 
    * are using 'transport'=>'postMessage' instead of the default 'transport'
    * => 'refresh'
    * 
    * Used by hook: 'customize_preview_init'
    * 
    * @see add_action('customize_preview_init',$func)
    * @since MyTheme 1.0
    */
   public static function live_preview() {
      wp_enqueue_script( 
           'mytheme-themecustomizer', // Give the script a unique ID
           get_template_directory_uri() . '/js/customizer.js', // Define the path to the JS file
           array(  'jquery', 'customize-preview' ), // Define dependencies
           '', // Define a version (optional) 
           true // Specify whether to put in footer (leave this true)
      );
   }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     * 
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since MyTheme 1.0
     */
    public static function generate_css( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true ) {
      $return = '';
      $mod = get_theme_mod($mod_name);
      if ( ! empty( $mod ) ) {
         $return = sprintf('%s { %s:%s; }',
            $selector,
            $style,
            $prefix.$mod.$postfix
         );
         if ( $echo ) {
            echo $return;
         }
      }
      return $return;
    }
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register' , array( 'mybstheme_customizer' , 'register' ) );


// Output custom CSS to live site
add_action( 'wp_head' , array( 'mybstheme_customizer' , 'header_output' ) );

// Enqueue live preview javascript in Theme Customizer admin screen
add_action( 'customize_preview_init' , array( 'mybstheme_customizer' , 'live_preview' ) );