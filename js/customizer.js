/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '#site-title a' ).html( newval );
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );


		//Update the site description in real time...
	wp.customize( 'mybstheme_image', function( value ) {
		value.bind( function( newval ) {
			$( '.jumbotron' ).css('background-image','url('+ newval +')');
		} );
	} );

		wp.customize( 'mybstheme_welcomeTitle', function( value ) {
		value.bind( function( newval ) {
			$( '.jumbotron .slider_title' ).text(newval);
		} );
	} );

	wp.customize( 'mybstheme_welcomeText', function( value ) {
		value.bind( function( newval ) {
			$( '.jumbotron .slider_text' ).text(newval);
		} );
	} );

	
} )( jQuery );