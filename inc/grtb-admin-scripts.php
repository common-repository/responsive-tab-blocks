<?php

/* Enqueues admin scripts. */
add_action( 'admin_enqueue_scripts', 'add_admin_grtb_style' );
function add_admin_grtb_style() {

  /* Gets the post type. */
  global $post_type;

  if( 'grtb_block' == $post_type ) {

 /* CSS for metaboxes. */
    wp_enqueue_style( 'grtb_dmb_styles', plugins_url('dmb/dmb.css', __FILE__));

    /* CSS for preview.s */
    wp_enqueue_style( 'grtb_styles', plugins_url('css/grtb_style.css', __FILE__));
    

     /* JS for metaboxes. */
    wp_enqueue_script( 'grtb_admin_js', plugins_url('dmb/dmb.js', __FILE__), array( 'jquery', 'thickbox', 'wp-color-picker' ));
    wp_enqueue_script( 'grtb_block_js', plugins_url('js/grtb.js', __FILE__), array( 'jquery' ));

    /* Localizes string for JS file. */
    wp_localize_script( 'grtb_admin_js', 'objectL10n', array(
      'untitled' => __( 'Untitled', 'great-resposive-tab-blocks' ),
      'noTabNotice' => __( 'Add at least <strong>1</strong> tab to preview this tab set.', 'great-resposive-tab-blocks' ),
      'previewAccuracy' => __( 'This is only a preview, shortcodes used in the fields will not be rendered and results may vary depending on your container\'s width.', 'great-resposive-tab-blocks' )
    ));
    wp_enqueue_style( 'grtb_styles' );
    
  }

}

?>