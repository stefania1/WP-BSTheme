<?php


if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

function mybstheme_style() {
	wp_register_style('mybstheme_css', get_template_directory_uri() . '/css/bootstrap.css');
	wp_register_style('mybstheme_animate', get_template_directory_uri() . '../css/animate.css');
	wp_register_style('mybstheme_fontawesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
    wp_register_style('mybstheme_fontRoboto', 'http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,700,900', array(), null );
    wp_register_style('mybstheme_fontRaleway', 'http://fonts.googleapis.com/css?family=Raleway&subset=latin:400,300,200,100,500', array(), false, "all");
	wp_register_script( 'mybstheme-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'mybstheme_customjs', get_template_directory_uri() . '/js/custom.js', array('jquery') );

	wp_enqueue_style('mybstheme_fontRoboto');
	wp_enqueue_style('mybstheme_fontRaleway');
	wp_enqueue_style('mybstheme_animate');
	wp_enqueue_style('mybstheme_fontawesome');
	wp_enqueue_style('mybsthemee_css');
	wp_enqueue_style('mybstheme-script');
	wp_enqueue_style('mybstheme_customjs');
	
}

add_action( 'wp_enqueue_scripts', 'mybstheme_style' ); 

add_action( 'after_setup_theme', 'mybstheme_menu' );

function mybstheme_menu() {
  register_nav_menu( 'primary', 'Primary Menu' );
}

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

require_once 'inc/wp_bootstrap_nav.php';

add_image_size( 'image_lg', 1920, 1272, false );
add_image_size( 'image_md', 1200, 795, false );
add_image_size( 'image_sm', 991, 657, false );
add_image_size( 'image_xs', 768, 509, false );

function mybstheme_get_attachment_id_from_url( $attachment_url = '' ) {

   global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

require_once 'inc/customizer.php';

//function mybstheme_script() {

// wp_enqueue_script( 'mybstheme_customjs', get_template_directory_uri() . '/js/custom.js', array('jquery'),  '', true );
// wp_enqueue_script( 'mybstheme_bpjs', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js', array('jquery'),  '', true );
//}

//add_action( 'wp_enqueue_scripts', 'mybstheme_script' ); 

require_once 'inc/media.php';



require_once 'inc/testimonials.php';

function mybstheme_theme_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'mybstheme_theme_setup' );



function mybstheme_sidebars() {
    register_sidebar( array(
        'name' => __( 'Contact Left', 'mybstheme' ),
        'id' => 'contact-left',
        'before_widget' => '',
        'after_widget' => '',
        'description' => __( 'Widgets in this area will be shown on the left side of Contact.', 'mybstheme' ),
        'before_title' => '',
        'after_title' => '',
    ) );


     register_sidebar( array(
        'name' => __( 'Contact Right', 'mybstheme' ),
        'id' => 'contact-right',
           'before_widget' => '',
        'after_widget' => '',
        'description' => __( 'Widgets in this area will be shown on the right side of Contact.', 'mybstheme' ),
        'before_title' => '',
        'after_title' => '',
    ) );
}
add_action( 'widgets_init', 'mybstheme_sidebars' );