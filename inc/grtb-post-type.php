<?php 

/* Registers the tabs post type. */
add_action( 'init', 'register_grtb_type' );
function register_grtb_type() {
	
  /* Defines labels. */
  $labels = array(
		'name'               => __( 'gTabs', 'great-resposive-tab-blocks' ),
		'singular_name'      => __( 'gTabs', 'great-resposive-tab-blocks' ),
		'menu_name'          => __( 'gTabs', 'great-resposive-tab-blocks' ),
		'name_admin_bar'     => __( 'gTabs', 'great-resposive-tab-blocks' ),
		'add_new'            => __( 'Add New', 'great-resposive-tab-blocks' ),
		'add_new_item'       => __( 'Add New Tab', 'great-resposive-tab-blocks' ),
		'new_item'           => __( 'New Tab', 'great-resposive-tab-blocks' ),
		'edit_item'          => __( 'Edit Tab', 'great-resposive-tab-blocks' ),
		'view_item'          => __( 'View Tab', 'great-resposive-tab-blocks' ),
		'all_items'          => __( 'All Tabs', 'great-resposive-tab-blocks' ),
		'search_items'       => __( 'Search tabs', 'great-resposive-tab-blocks' ),
		'not_found'          => __( 'No tabs found.', 'great-resposive-tab-blocks' ),
		'not_found_in_trash' => __( 'No tabs found in Trash.', 'great-resposive-tab-blocks' )
	);

  /* Defines permissions. */
	$args = array(
		'labels'             => $labels,
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
    'show_in_admin_bar'  => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title' ),
    'menu_icon'          => 'dashicons-plus'
	);

  /* Registers post type. */
	register_post_type( 'grtb_block', $args );  

}


/* Customizes tab sets update messages. */
add_filter( 'post_updated_messages', 'grtb_block_updated_messages' );
function grtb_block_updated_messages( $messages ) {
	$post             = get_post();
	$post_type        = get_post_type( $post );
  $post_type_object = get_post_type_object( $post_type );
  
  /* Defines update messages. */
	$messages['grtb'] = array(
		1  => __( 'Tab and Blocks updated.', 'great-resposive-tab-blocks' ),
		4  => __( 'Tab and Blocks updated.', 'great-resposive-tab-blocks' ),
		6  => __( 'Tab and Blocks published.', 'great-resposive-tab-blocks' ),
		7  => __( 'Tab and Blocks saved.', 'great-resposive-tab-blocks' ),
		10 => __( 'Tab and Blocks draft updated.', 'great-resposive-tab-blocks' )
	);

	return $messages;

}

?>