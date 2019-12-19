<?php
/**
 * Custom Functions
 *
 */



/**
 * Get the theme colors formatted for use with color picker
 */
 function output_the_colors() {

 	// get the colors
     $color_palette = current( (array) get_theme_support( 'editor-color-palette' ) );

 	// bail if there aren't any colors found
 	if ( !$color_palette )
 		return;

 	// output begins
 	ob_start();

 	// output the names in a string
 	echo '[';
 		foreach ( $color_palette as $color ) {
 			echo "'" . $color['color'] . "', ";
 		}
 	echo ']';

     return ob_get_clean();

 }

 /**
  * Swap Chosen Color Hex into CSS
  *
  * @param id $cta_id1 id for the item
  * @param color $color1 variable used by the picker for text
  * @param color $color2 variable used by the picker for background
  */

   function ecta_color_selection( $cta_id1, $color1 = null, $color2 = null ) {
	   $css = '';

	   if ( ! empty( $color2 ) ) {

		$css = '#ectapost-' . $cta_id1 . ' .ecta__text { color: ' . $color1 . '; } #ectapost-' . $cta_id1 . ' .ecta--bgcolor { background-color: ' . $color2 . ' }';

		} else {

		   $css = '#ectapost-' . $cta_id1 . ' .ecta__text { color: ' . $color1 . '; }';

	   };


	wp_register_style( 'ecta-colors', false );
	wp_enqueue_style( 'ecta-colors' );
	wp_add_inline_style( 'ecta-colors', $css );

}

	add_action( 'get_footer', 'ecta_color_selection' );


	 /**
	  * Place BG Image into CSS
	  *
	  * @param id $cta_id2 id for the item
	  * @param image $bg_img variable used by the picker for text
	  */

	   function ecta_bg_img( $cta_id2, $bg_img = null ) {
		   $img_css = '';

		   if ( ! empty( $bg_img ) ) {

			$img_css = '#ectapost-' . $cta_id2 . ' .ecta--bgimage { background-image: url(' . $bg_img . '); }';

		   };


		wp_register_style( 'ecta-bg', false );
		wp_enqueue_style( 'ecta-bg' );
		wp_add_inline_style( 'ecta-bg', $img_css );

	}

		add_action( 'get_footer', 'ecta_bg_img' );

 /**
  * Add the theme colors into ACF's palette
  */
 add_action( 'acf/input/admin_footer', 'gutenberg_sections_register_acf_color_palette' );
 function gutenberg_sections_register_acf_color_palette() {

     $color_palette = output_the_colors();
     if ( !$color_palette )
         return;

     ?>
     <script type="text/javascript">
         (function( $ ) {
             acf.add_filter( 'color_picker_args', function( args, $field ){

                 // add the hexadecimal codes here for the colors you want to appear as swatches
                 args.palettes = <?php echo $color_palette; ?>

                 // return colors
                 return args;

             });
         })(jQuery);
     </script>
     <?php

 }



 /**
  * Proper way to enqueue scripts and styles
  */
 function ecta_styles() {
	 $plugin_url = plugin_dir_url( dirname(__FILE__) );
     wp_enqueue_style( 'ecta', $plugin_url . 'styles/ecta.css' );
 }
 add_action( 'wp_enqueue_scripts', 'ecta_styles' );

//NOTES DURING DEV

// Need to wrap my head around how to call this correctly for the loader


// Need to find a way to get ACF to pull the initial json from my plugin but only on activation IF the field groups don't already exists
