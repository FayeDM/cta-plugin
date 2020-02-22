<?php
/**
 * Creation and administration of Easy CTA.
 *
 */

class Easy_CTA {

	protected $loader;

	protected $plugin_slug;

	protected $version;

	public function __construct() {

		$this->plugin_slug = 'easy-cta';
		$this->version = '0.1.0';

		$this->load_dependencies();
		$this->define_post_types();

	}


/**
 * Load Plugin Dependencies
 * Manage additional classes and set up scaffolding that the main class will need to run properly.
 * @return null
 */

	private function load_dependencies() {
		// Resources post type and associated taxonomies.

		// DOCUMENTATION EXAMPLE
		// https://codex.wordpress.org/Function_Reference/register_activation_hook
		// include_once dirname( __FILE__ ) . '/your_additional_file.php';
		// register_activation_hook( __FILE__, array( 'YourAdditionalClass', 'on_activate_function' ) );

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-post-types.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-functions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-blocks.php';

		// Pull in our loader that abstracts away actions and filters.
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-easy-cta-loader.php';
		$this->loader = new Easy_CTA_Loader();


	}

	/**
	 * Define Custom Post Types
	 * Create any custom post types needed by the Fintech area of the site.
	 * @return null
	 */
	private function define_post_types() {

		$types = new Easy_CTA_Post_Types( $this->get_version() );
		$this->loader->add_action('init', $types, 'add_post_types' );

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
