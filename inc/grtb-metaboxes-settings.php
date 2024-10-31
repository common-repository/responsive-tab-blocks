<?php 

/* Defines force block visibility select options. */
function grtb_show_blocks() {
	$options = array ( 
		__('No', 'great-resposive-tab-blocks' ) => 0,
		__('Yes', 'great-resposive-tab-blocks' ) => 1
	);
	return $options;
}

/* Defines force tab style select options. */
function grtb_tab_style() {
	$options = array ( 
		__('Style 1', 'great-resposive-tab-blocks' ) => 1,
		__('Style 2', 'great-resposive-tab-blocks' ) => 2
	);
	return $options;
}

/* Defines tab background select options. */
function grtb_tab_background_options() {
	$options = array ( 
		__('Transparent', 'great-resposive-tab-blocks' ) => 'transparent',
		__('Light grey', 'great-resposive-tab-blocks' ) => 'whitesmoke'
	);
	return $options;
}

/* Hooks the metabox. */
add_action('admin_init', 'grtb_add_settings', 1);
function grtb_add_settings() {
	add_meta_box( 
		'grtb_settings', 
		'<span class="dashicons dashicons-admin-generic"></span> '.__('Settings', 'great-resposive-tab-blocks'), 
		'grtb_settings_display', 
		'grtb_block', 
		'side', 
		'high'
	);
}




/* Displays the metabox. */
function grtb_settings_display() { 
	
	global $post;

	/* Retrieves select options. */
	$grtb_show_blocks = grtb_show_blocks();
	$grtb_tab_style = grtb_tab_style();
	$tabs_tbg = grtb_tab_background_options();

	/* Processes retrieved fields. */
	$settings = array();

	$settings['_grtb_tabs_bg_color'] = get_post_meta( $post->ID, '_grtb_tabs_bg_color', true );

$settings['tabs_style'] = get_post_meta( $post->ID, '_gt_tabs_style', true );
$settings['blocksperline'] = get_post_meta( $post->ID, '_gt_blocksperline', true );
$settings['blockrow'] = get_post_meta( $post->ID, '_gt_displayinrow', true );
$settings['tabs_blocks'] = get_post_meta( $post->ID, '_gt_show_blocks', true );




	$settings['_grtb_breakpoint'] = get_post_meta( $post->ID, '_gt_breakpoint', true );

	$settings['_grtb_tbg'] = get_post_meta( $post->ID, '_gt_tbg', true );

	/* Checks if forcing original fonts. */
	$settings['_grtb_original_font'] = get_post_meta( $post->ID, '_grtb_original_font', true );
	(($settings['_grtb_original_font'] == 'no' || $settings['_grtb_original_font'] != true) ? $settings['_grtb_original_font'] = 'no' : $settings['_grtb_original_font'] = 'yes');


$settings['_grtb_original_font'] = get_post_meta( $post->ID, '_grtb_original_font', true );
	(($settings['_grtb_original_font'] == 'no' || $settings['_grtb_original_font'] != true) ? $settings['_grtb_original_font'] = 'no' : $settings['_grtb_original_font'] = 'yes');

	?>

	<div class="dmb_settings_box">


		<div class="dmb_grid dmb_grid_50 dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('Show Block', 'great-resposive-tab-blocks' ) ?>
			</div>
			<select class="dmb_side_select" name="tabs_blocks">
			    <?php foreach ( $grtb_show_blocks as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"<?php selected( (isset($settings['tabs_blocks'])) ? $settings['tabs_blocks'] : '1', $value ); ?>><?php echo $label; ?></option>
				<?php } ?>
			
			</select>
		</div>		

<!-- tab style option -->
		<div class="dmb_grid dmb_grid_50 dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('Tab Style', 'great-resposive-tab-blocks' ) ?>
			</div>
			<select class="dmb_side_select" name="tabs_style">
			    <?php foreach ( $grtb_tab_style as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"<?php selected( (isset($settings['tabs_style'])) ? $settings['tabs_style'] : '1', $value ); ?>><?php echo $label; ?></option>
				<?php } ?>
				
				
			</select>
		</div>

<!-- block row columns option -->
		<div class="dmb_grid dmb_grid_50 dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('No of Blocks per Column', 'great-resposive-tab-blocks' ) ?>
			</div>
			<select class="dmb_side_select" name="blocksperline">

<option value="2" <?=(isset($settings['blocksperline']) && $settings['blocksperline']==2) ? "selected='selected'" : ''; ?>>2</option>
<option value="3" <?=(isset($settings['blocksperline']) && $settings['blocksperline']==3) ? "selected='selected'" : ''; ?>>3</option>
<option value="4" <?=(isset($settings['blocksperline']) && $settings['blocksperline']==4) ? "selected='selected'" : ''; ?>>4</option>
<option value="5" <?=(isset($settings['blocksperline']) && $settings['blocksperline']==5) ? "selected='selected'" : ''; ?>>5</option>
<option value="6" <?=(isset($settings['blocksperline']) && $settings['blocksperline']==6) ? "selected='selected'" : ''; ?>>6</option>

			</select>
		</div>





		<div class="dmb_grid dmb_grid_50 dmb_grid_first">
			<div class="dmb_field_title">
				<?php _e('Max. mobile width', 'great-resposive-tab-blocks' ) ?>
				<a class="dmb_inline_tip dmb_tooltip_medium" data-tooltip="<?php _e('When the window\'s width goes below this number, the tab set will switch to accordion mode.', 'great-resposive-tab-blocks' ) ?>">[?]</a>
			</div>
			<input name="tabs_breakpoint" class="dmb_field dmb_breakpoint" type="text" value="<?php echo (!empty($settings['_grtb_breakpoint'])) ? $settings['_grtb_breakpoint'] : '600'; ?>" placeholder="<?php _e('e.g. 600', 'great-resposive-tab-blocks' ) ?>" />
		</div>

		

		<!-- Tab background option -->
		<div class="dmb_grid dmb_grid_100 dmb_grid_first dmb_grid_last">
			<div class="dmb_field_title">
				<?php _e('Inactive tabs background', 'great-resposive-tab-blocks' ) ?>
			</div>
			<select class="dmb_side_select" name="tabs_tbgs">
				<?php foreach ( $tabs_tbg as $label => $value ) { ?>
					<option value="<?php echo $value; ?>"<?php selected( (isset($settings['_grtb_tbg'])) ? $settings['_grtb_tbg'] : 'transparent', $value ); ?>><?php echo $label; ?></option>
				<?php } ?>
			</select>
		</div>

		

		<div class="dmb_clearfix"></div>

	</div>

<?php } ?>