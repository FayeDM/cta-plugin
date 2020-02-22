<?php
/**
 * Custom Functions
 *
 */

 /**
  * Enque Out of the Box Ecta Styles
  */
 function ecta_styles() {
	 $plugin_url = plugin_dir_url( dirname(__FILE__) );
     wp_enqueue_style( 'ecta', $plugin_url . 'styles/ecta.css' );
 }
 add_action( 'wp_enqueue_scripts', 'ecta_styles' );
