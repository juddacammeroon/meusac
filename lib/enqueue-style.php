<?php
if( ! function_exists( 'reverie_enqueue_style' ) ) {
	function reverie_enqueue_style()
	{
		// foundation stylesheet
		wp_enqueue_style('asap', 'https://fonts.googleapis.com/css?family=Asap:400,700');
		wp_register_style( 'reverie-stylesheet', get_stylesheet_directory_uri() . '/dist/styles/main.css', array(), '' );
		wp_enqueue_style( 'reverie-stylesheet' );
		wp_enqueue_style('temp-stylesheet', get_stylesheet_directory_uri().'/custom.css');
		
	}
}
add_action( 'wp_enqueue_scripts', 'reverie_enqueue_style' );
