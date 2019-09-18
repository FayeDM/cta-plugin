<?php
/**
 * Easy CTA Block
 *
 * @package easy_cta
 */

 /**
  * Class Easy_CTA
  */

 class Easy_CTA_Blocks {


		 /**
	  * Version
	  *
	  * @var version
	  */
	 private $version;

	 /**
	  * Constructor
	  * Simple constructor to help organize our post type activities.
	  *
	  * @param [type] $version [description].
	  */
	 public function __construct( $version ) {
		 $this->version = $version;
	 }

	/**
	 * Register our custom blocks.
	 */
	public function ecta_acf_init() {

		// check function exists.
		if ( function_exists( 'acf_register_block' ) ) {

			// register a standard CTA block.
			acf_register_block(
				[
					'name'            => 'cta',
					'title'           => __( 'CTA' ),
					'description'     => __( 'A custom cta block.' ),
					'render_callback' => 'ecta_acf_block_render_callback',
					'category'        => 'ecta-blocks',
					'icon'            => 'lightbulb',
					'keywords'        => [ 'cta', 'standard' ],
				]
			);

		}
	}

}



// TODO: Put this into loader

	function ecta_acf_block_render_callback( $block ) {

		$slug      = str_replace('acf/', '', $block['name']);
		$themeurl  = get_theme_file_path("/template-parts/blocks/block-{$slug}.php");
		$pluginurl = plugin_dir_path( dirname( __FILE__ ) ) . 'blocks/block-' . $slug . '.php';

		if( file_exists( $themeurl ) ) {
			include( $themeurl );
		} elseif( file_exists( $pluginurl ) ) {

			require "$pluginurl";
		}
	}


	// TODO: Put this into loader

	// Create a new block category.
	add_filter(
		'block_categories',
		function( $categories, $post ) {
			return array_merge(
				$categories,
				array(
					array(
						'slug'  => 'ecta-blocks',
						'title' => __( 'Easy CTA Blocks', 'ecta-blocks' ),
					),
				)
			);
		},
		10,
		2
	);
