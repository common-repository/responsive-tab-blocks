<?php

/* Enqueues front scripts. */
add_action( 'wp_enqueue_scripts', 'add_grtb_scripts', 99 );
function add_grtb_scripts() {

wp_enqueue_style( 'grtb', plugins_url('css/gt-default.css', __FILE__));

  /* Front end JS. */
  wp_enqueue_script( 'grtb', plugins_url('js/gt.js', __FILE__), array( 'jquery' ));

}

?>