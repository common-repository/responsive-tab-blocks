<?php 

/* Loads plugin's text domain. */
add_action( 'plugins_loaded', 'grtb_load_plugin_textdomain' );
function grtb_load_plugin_textdomain() {
  load_plugin_textdomain( 'great-resposive-tab-blocks', FALSE, GRTB_PATH . 'lang/' );
}

?>