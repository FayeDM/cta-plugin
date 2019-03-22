<?php
/**
 * Easy CTA Block
 *
 * @package easy_cta
 */

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

/**
 * Register our custom blocks.
 */
function ecta_acf_init() {

	// check function exists.
	if ( function_exists( 'acf_register_block' ) ) {

		// register a standard CTA block.
		acf_register_block(
			array(
				'name'            => 'cta',
				'title'           => __( 'CTA' ),
				'description'     => __( 'A custom cta block.' ),
				'render_callback' => 'ecta_acf_bock_render_callback',
				'category'        => 'ecta-blocks',
				'icon'            => 'lightbulb',
				'keywords'        => array( 'cta', 'standard' ),
			)
		);

	}
}
add_action( 'acf/init', 'ecta_acf_init' );
