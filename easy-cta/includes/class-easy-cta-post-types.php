<?php

class Easy_CTA_Post_Types {

	private $version;

/**
 * Constructor
 * Simple constructor to help organize our post type activities.
 * @param [type] $version [description]
 */
	public function __construct( $version ) {
		$this->version = $version;
	}

 /**
  * Register Custom Post Types
  * Creation of the Resources post type for Haas.
  * @return null
  */
  public function add_post_types()
	{
		register_post_type(
			'ctas',
			[
				'labels'              => [
					'name' => __( 'Calls to Action' ),
					'singular_name' => __( 'CTA' ),
				],
				'exclude_from_search' => false,
				'publicly_queryable'  => true,
				'show_ui'             => true,
				'menu_icon'           => 'dashicons-megaphone',
				'public'              => true,
				'show_in_menu'        => true,
				'show_in_nav_menus'   => true,
				'query_var'           => true,
				'has_archive'         => false,
				'show_in_rest'        => false,
				/* The rewrite handles the URL structure. */
				'rewrite'             => [
					'slug'       => 'ctas',
					'with_front' => false,
					'pages'      => true,
					'feeds'      => false,
					'ep_mask'    => EP_PERMALINK,
				],
				'supports'            => [
					'title',
					'editor',
				],
			]
		); // end register
	}
}
