<?php
/**
 * Creation and administration of Easy CTA.
 *
 * @package easy_cta
 */

/**
 * Class Easy_CTA
 */

class Easy_CTA {

	/**
	 * Loader
	 *
	 * @var loader
	 */
	protected $loader;

	/**
	 * Plugin Slug
	 *
	 * @var plugin_slug
	 */
	protected $plugin_slug;

	/**
	 * Version
	 *
	 * @var version
	 */
	protected $version;

	/**
	 * Class Easy_CTA
	 */
public function __construct() {

	$this->plugin_slug = 'easy-cta';
	$this->version = '0.1.0';

	$this->load_dependencies();
	$this->define_post_types();
	$this->define_blocks();
	$this->define_functions();

	}


/**
 * Load Plugin Dependencies
 * Manage additional classes and set up scaffolding that the main class will need to run properly.
 * @return null
 */

	private function load_dependencies() {

		// DOCUMENTATION EXAMPLE
		// https://codex.wordpress.org/Function_Reference/register_activation_hook
		// include_once dirname( __FILE__ ) . '/your_additional_file.php';
		// register_activation_hook( __FILE__, array( 'YourAdditionalClass', 'on_activate_function' ) );
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-post-types.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-functions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-blocks.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-functions.php';

		// Pull in our loader that abstracts away actions and filters.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-loader.php';
		$this->loader = new Easy_CTA_Loader();

	}

	/**
	 * Define Custom Post Types
	 * Create any custom post types needed by CTA area of the site.
	 * @return null
	 */
	private function define_post_types() {

		$types = new Easy_CTA_Post_Types( $this->get_version() );
		$this->loader->add_action('init', $types, 'add_post_types' );

	}

	/**
	 * Blocks
	 * Block functions needed for the CTA area of the site.
	 * @return null
	 */
	private function define_blocks() {

		$types = new Easy_CTA_Blocks( $this->get_version() );
		$this->loader->add_action('acf/init', $types, 'ecta_acf_init' );

	}

	/**
	 * Additional Functions
	 * Create any additional functions needed for the CTA area of the site.
	 * @return null
	 */
	private function define_functions() {

		$types = new Easy_CTA_Functions( $this->get_version() );
		$this->loader->add_action('get_footer', $types, 'ecta_color_selection' );
		$this->loader->add_action('get_footer', $types, 'ecta_bg_img' );
		$this->loader->add_action('wp_enqueue_scripts', $types, 'ecta_styles' );

	}


	/**
	 * Run Loader
	 * Run all actions and filters that have been added to the via the Loader class.
	 * @return null
	 */
	public function run() {
		$this->loader->run();
	}

	public function get_version() {
		return $this->version;
	}

}
