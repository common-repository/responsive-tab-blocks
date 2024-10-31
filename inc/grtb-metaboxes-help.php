<?php 

/* Hooks the metabox. */
add_action('admin_init', 'dmb_grtb_add_help', 1);
function dmb_grtb_add_help() {
	add_meta_box( 
		'grtb_help', 
		'<span class="dashicons dashicons-editor-code"></span> '.__('Shortcode', 'great-resposive-tab-blocks' ), 
		'dmb_grtb_help_display', // Below
		'grtb_block', 
		'side', 
		'high'
	);
}


/* Displays the metabox. */
function dmb_grtb_help_display() { ?>

	<div class="dmb_side_block">
		<p>
			<?php 
				global $post;
				$slug = '';
				$slug = $post->post_name;
				$shortcode = '<span style="display:inline-block;border:solid 2px lightgray; background:white; padding:0 8px; font-size:13px; line-height:25px; vertical-align:middle;">[grtb name="'.$slug.'"]</span>';
				$shortcode_unpublished = "<span style='display:inline-block;color:#849d3a'>" . /* translators: Leave HTML tags */ __("<strong>Publish</strong> your tab set before you can see your shortcode.", 'great-resposive-tab-blocks' ) . "</span>";
				echo ($slug != '') ? $shortcode : $shortcode_unpublished;
			?>
		</p>
		<p>
			<?php /* translators: Leave HTML tags */ _e('To display your tab set on your site, copy-paste the <strong>[Shortcode]</strong> above in your post/page.', 'great-resposive-tab-blocks' ) ?>
		</p>	
	</div>

	
<?php } 


add_action('admin_init', 'dmb_grtb_add_help_contact', 1);
function dmb_grtb_add_help_contact() {
	add_meta_box( 
		'dmb_grtb_add_help_contact', 
		'<span class="dashicons dashicons-editor-code"></span> '.__('Need Help ?', 'great-resposive-tab-blocks' ), 
		'dmb_grtb_add_help_contact_display', // Below
		'grtb_block', 
		'side', 
		'high'
	);
}
function dmb_grtb_add_help_contact_display(){
    ?>
    	<div class="dmb_side_block">
	        <h5><?php echo __('If you having any truble or looking to modify feature then contact us.', 'great-resposive-tab-blocks' );?></h5>
	        <a href="mailto:parbat@gatetouch.com" class="btn button button-primary"><?php echo __('Contact Me', 'great-resposive-tab-blocks' );?></a>
	</div>
    <?php
}
?>