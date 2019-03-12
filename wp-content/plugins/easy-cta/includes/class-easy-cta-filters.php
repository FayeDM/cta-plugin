<?php
/**
 * Custom filters
 *
 */


add_filter('use_block_editor_for_post_type', function( $useBlockEditor, $postType ){

    if( $postType == 'ctas' )
        return false;
    return $useBlockEditor;

}, 10, 2);




// Need to wrap my head around how to call this correctly for the loader
