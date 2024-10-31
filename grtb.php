<?php
/**
 * Plugin Name: Responsive tab blocks 
 * Plugin URI: https://gatetouch.com/
 * Description: A responsive & clean way to display your content. Create new tabs nd blocks as per your need in no-time custom type and copy-paste the shortcode into any post/page.

 * Version: 1.0.0
 * Author: 9Code
 * Author URI: https://9code.info
 * Text Domain: great-resposive-tab-blocks
 * Domain Path: /lang
 * License: GPL2
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/* Defines plugin's root folder. */
define( 'GRTB_PATH', plugin_dir_path( __FILE__ ) );

/* Define Plugin URL to  */
define( 'GRTB_URL', plugins_url('/inc', __FILE__ ) );


define( "GRTB_LICENSE", true );

/* General. */
require_once('inc/grtb-text-domain.php');


/* Scripts. */
require_once('inc/grtb-front-scripts.php');
require_once('inc/grtb-admin-scripts.php');


/* Tabs. */
require_once('inc/grtb-post-type.php');


/* Shortcode. */
require_once('inc/grtb-shortcode-column.php');
require_once('inc/grtb-shortcode.php');


/* Registers metaboxes. */
require_once('inc/grtb-metaboxes-tabs.php');
require_once('inc/grtb-metaboxes-settings.php');
require_once('inc/grtb-metaboxes-help.php');


/* Saves metaboxes. */
require_once('inc/grtb-save-metaboxes.php');

?>