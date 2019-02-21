<?php
/**
 * Plugin Name:     Easy CTA
 * Plugin URI:      
 * Description:     Easy and customizable CTAs.
 * Author:          Faye Polson
 * Author URI:      
 * Text Domain:     easy-cta
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Easy_CTA
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once ( plugin_dir_path( __FILE__ ) . 'includes/class-easy-cta.php' );

function run_easy_cta() {

	$easy_cta = new Easy_CTA();
	$easy_cta->run();

}

run_easy_cta();