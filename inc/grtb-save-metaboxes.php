<?php 

/* Saves metaboxes */
add_action('save_post', 'grtb_meta_box_save');
function grtb_meta_box_save($post_id) {


	if ( ! isset( $_POST['gt_meta_box_nonce'] ) ||
	! wp_verify_nonce( $_POST['gt_meta_box_nonce'], 'gt_meta_box_nonce' ) )
		return;

	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;

	if (!current_user_can('edit_post', $post_id))
		return;

	$new_plans = array();

	/* Settings. */
	$old_tabs_settings = array();

	$old_tabs_settings['_gt_breakpoint'] = get_post_meta( $post_id, '_gt_breakpoint', true );
	$old_tabs_settings['_gt_tabs_style'] = get_post_meta( $post_id, '_gt_tabs_style', true );
	$old_tabs_settings['_gt_tbg'] = get_post_meta( $post_id, '_gt_tbg', true );

	$old_tabs_settings['_gt_blocksperline'] = get_post_meta( $post_id, '_gt_blocksperline', true );
	$old_tabs_settings['_gt_displayinrow'] = get_post_meta( $post_id, '_gt_displayinrow', true );
	$old_tabs_settings['_gt_showcontents'] = get_post_meta( $post_id, '_gt_showcontents', true );
$old_tabs_settings['_gt_show_blocks'] = get_post_meta( $post_id, '_gt_show_blocks', true );
	
	



	$data=json_decode(stripslashes ($_POST['tabs']), JSON_UNESCAPED_SLASHES);
	
	$update=[];
	foreach($data as $d){
	
			

		    if( isset($d['title']) && $d['title'] != ''){
		
			$item=[];
			$item['title']=(isset($d['title']) && !empty($d['title'])) ?stripslashes( wp_kses_post($d['title'])):'';
			$item['icon']=(isset($d['icon']) && !empty($d['icon'])) ?filter_var(balanceTags($d['icon']),FILTER_SANITIZE_URL):'';
			
			
			$blocks=[];
			foreach($d['blocks'] as $b){
				$block=[];
				$block["title"]=(isset($b['title']) && !empty($b['title'])) ?stripslashes( wp_kses_post($b['title'])):'';
				$block["icon"]=(isset($b['icon']) && !empty($b['icon'])) ?filter_var(balanceTags($b['icon']),FILTER_SANITIZE_URL):'';
				$block["contents"]=(isset($b['contents']) && !empty($b['contents'])) ? htmlentities (balanceTags($b['contents'])):'';
				$block["url"]=(isset($b['url']) && !empty($b['url'])) ?filter_var(balanceTags($b['url']),FILTER_SANITIZE_URL):'';
				$blocks[]=$block;
			}
			$item["blocks"]=$blocks;
		
		      	$update[]=$item;
		    }

	
	}
	//echo "<pre>";
	//print_r($update);exit;

	/* Settings. */
		(isset($_POST['tabs_style']) && $_POST['tabs_style']) ? $new_tabs_settings['_gt_tabs_style'] = stripslashes( strip_tags( sanitize_text_field( $_POST['tabs_style'] ) ) ) : $new_tabs_settings['_gt_tabs_style'] = '';
	
	(isset($_POST['blocksperline']) && $_POST['blocksperline']) ? $new_tabs_settings['_gt_blocksperline'] = stripslashes( strip_tags( sanitize_text_field( $_POST['blocksperline'] ) ) ) : $new_tabs_settings['_gt_blocksperline'] = '';
	(isset($_POST['blockrow']) && $_POST['blockrow']) ? $new_tabs_settings['_gt_displayinrow'] = stripslashes( strip_tags( sanitize_text_field( $_POST['blockrow'] ) ) ) : $new_tabs_settings['_gt_displayinrow'] = '';
	
	(isset($_POST['tabs_blocks']) && $_POST['tabs_blocks']) ? $new_tabs_settings['_gt_show_blocks'] = stripslashes( strip_tags( sanitize_text_field( $_POST['tabs_blocks'] ) ) ) : $new_tabs_settings['_gt_show_blocks'] = '';
	

	(isset($_POST['tabs_breakpoint']) && $_POST['tabs_breakpoint']) ? $new_tabs_settings['_gt_breakpoint'] = stripslashes( strip_tags( sanitize_text_field( absint( $_POST['tabs_breakpoint'] ) ) ) ) : $new_tabs_settings['_gt_breakpoint'] = '';
	
	(isset($_POST['tabs_tbgs']) && $_POST['tabs_tbgs']) ? $new_tabs_settings['_gt_tbg'] = stripslashes( strip_tags( sanitize_text_field( $_POST['tabs_tbgs'] ) ) ) : $new_tabs_settings['_gt_tbg'] = '';




  /* Updates tab set. */
	if ( count($update)>0 )
		update_post_meta( $post_id, '_gt_tab_contents', json_encode($update));
	elseif ( empty($update) && $old_plans )
		delete_post_meta( $post_id, '_gt_tab_contents');
		
	 if ( !empty( $new_tabs_settings['_gt_tabs_style'] ) && $new_tabs_settings['_gt_tabs_style'] != $old_tabs_settings['_gt_tabs_style'] )
		update_post_meta( $post_id, '_gt_tabs_style', $new_tabs_settings['_gt_tabs_style'] );

	 if ( !empty( $new_tabs_settings['_gt_blocksperline'] ) && $new_tabs_settings['_gt_blocksperline'] != $old_tabs_settings['_gt_blocksperline'] )
		update_post_meta( $post_id, '_gt_blocksperline', $new_tabs_settings['_gt_blocksperline'] );

	 if ( !empty( $new_tabs_settings['_gt_displayinrow'] ) && $new_tabs_settings['_gt_displayinrow'] != $old_tabs_settings['_gt_displayinrow'] )
		update_post_meta( $post_id, '_gt_displayinrow', $new_tabs_settings['_gt_displayinrow'] );

	 if ( !empty( $new_tabs_settings['_gt_showcontents'] ) && $new_tabs_settings['_gt_showcontents'] != $old_tabs_settings['_gt_showcontents'] )
		update_post_meta( $post_id, '_gt_showcontents', $new_tabs_settings['_gt_showcontents'] );

if ( !empty( $new_tabs_settings['_gt_show_blocks'] ) && $new_tabs_settings['_gt_show_blocks'] != $old_tabs_settings['_gt_show_blocks'] )
		update_post_meta( $post_id, '_gt_show_blocks', $new_tabs_settings['_gt_show_blocks'] );



	if ( !empty( $new_tabs_settings['_gt_breakpoint'] ) && $new_tabs_settings['_gt_breakpoint'] != $old_tabs_settings['_gt_breakpoint'] )
		update_post_meta( $post_id, '_gt_breakpoint', $new_tabs_settings['_gt_breakpoint'] );

	
	if ( !empty( $new_tabs_settings['_gt_tbg'] ) && $new_tabs_settings['_gt_tbg'] != $old_tabs_settings['_gt_tbg'] )
		update_post_meta( $post_id, '_gt_tbg', $new_tabs_settings['_gt_tbg'] );

}