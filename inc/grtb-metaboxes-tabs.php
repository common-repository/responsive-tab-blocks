<?php

/* Hooks the metabox. */
add_action('admin_init', 'gt_grtb_add_tab_set', 1);
function gt_grtb_add_tab_set() {
	add_meta_box( 
		'grtb', 
		'<span class="dashicons dashicons-edit"></span> '.__('Tab set editor', 'great-resposive-tab-blocks' ), 
		'gt_grtb_tab_display', // Below
		'grtb_block', 
		'normal', 
		'high'
	);
}


/* Displays the metabox. */
function gt_grtb_tab_display() {

	global $post;
	
	$tabs = json_decode(get_post_meta( $post->ID, '_gt_tab_contents', true ));
	
	?>
	
	<div id="gt_unique_editor">
		<?php wp_editor( '', 'gt_editor', array('editor_height' => '300px' ) );  ?>
		<br/>
		<a class="gt_big_button_primary gt_ue_update" href="#">
			<?php _e('Update', 'great-resposive-tab-blocks' ) ?>
		</a>
		<a class="gt_big_button_secondary gt_ue_cancel" href="#">
			<?php _e('Cancel', 'great-resposive-tab-blocks' ) ?>
		</a>
	</div>
	
	<!-- Toolbar for tab metabox -->
	<div class="gt_toolbar">
		<div class="gt_toolbar_inner">
			<a class="gt_big_button_secondary gt_expand_rows" href="#"><span class="dashicons dashicons-editor-expand"></span> <?php _e('Expand all', 'great-resposive-tab-blocks' ) ?>&nbsp;</a>&nbsp;&nbsp;
			<a class="gt_big_button_secondary gt_collapse_rows" href="#"><span class="dashicons dashicons-editor-contract"></span> <?php _e('Collapse all', 'great-resposive-tab-blocks' ) ?>&nbsp;</a>&nbsp;&nbsp;
			
			<div class="gt_clearfix"></div>
		</div>
	</div>

	<?php if ( count($tabs)>0) {

		foreach ( $tabs as $tab ) {
		$tab=(array)$tab;
			?>
			<!-- START empty tab -->
		<div class="main-tab gt_main" >

		<!-- tab handle bar -->
		<div class="gt_handle closed">
			<a class="gt_big_button_secondary gt_move_row_up" href="#" title="Move up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
			<a class="gt_big_button_secondary gt_move_row_down" href="#" title="Move down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
			<div class="gt_handle_title"><?=strip_tags($tab['title']);?></div>
			<a class="gt_big_button_secondary gt_remove_row_btn" href="#" title="Remove"><span class="dashicons dashicons-no-alt"></span></a>
			<a class="gt_big_button_secondary gt_clone_row" href="#" title="Clone"><span class="dashicons dashicons-admin-page"></span><?php _e('Clone', 'great-resposive-tab-blocks' ); ?></a>	<a class="gt_big_button_secondary gt_add_block" href="#"><?php _e('Add New Block', 'great-resposive-tab-blocks' ) ?>&nbsp;</a>
			<div class="gt_clearfix"></div>
		</div>

	    <!-- START inner -->
	    <div class="gt_inner" style="display:none">
	        <div class="">
	            <div class="tab-content">
	                <div class="span6">
	                    <div class="gt_field_title">
	                    <?php _e('Tab Title', 'great-resposive-tab-blocks' ) ?>
	                    </div>
	                    <input name="title" class="gt_field gt_highlight_field gt_tab_title" type="text" value="<?=$tab['title'];?>" placeholder="<?php _e('Tab Title', 'great-resposive-tab-blocks' ) ?>" />
	                </div>
	            
		            <div class="span6">
		                <div class="gt_field_title">
		                    <?php _e('Tab Icon', 'great-resposive-tab-blocks' ) ?>
		                </div>
		                <input name="icon" class="gt_field gt_highlight_field tab_icon" type="hidden" value="<?=(isset($tab['icon']) && !empty($tab['icon']))?$tab['icon']:'';?>" placeholder="<?php _e('Tab Icon', 'great-resposive-tab-blocks' ) ?>" />
		                <input class="select_icon btn primary button" type="button" value="Select Icon">
		                <img src="<?=(isset($tab['icon']) && !empty($tab['icon']))?$tab['icon']:GRTB_URL.'/img/sample-icon.png';?>" />
		            </div>
	         

		         	
				        
		      
			
			<?php
			
			if(count($tab['blocks'])){
				foreach($tab['blocks'] as $block){
				$block=(array)$block;
					
					?>
					<div class="sub-tab gt_main" >

					                    <!-- member handle bar -->
					                    <div class="gt_handle closed">
					                        <a class="gt_big_button_secondary gt_move_row_up" href="#" title="Move up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
					                        <a class="gt_big_button_secondary gt_move_row_down" href="#" title="Move down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
					                        <div class="gt_handle_subtitle"><?=(isset($block['title']) && !empty($block['title']))?strip_tags($block['title']):'';?></div>
					                        <a class="gt_big_button_secondary gt_remove_row_btn" href="#" title="Remove"><span class="dashicons dashicons-no-alt"></span></a>
					                        <a class="gt_big_button_secondary gt_clone_row" href="#" title="Clone"><span class="dashicons dashicons-admin-page"></span><?php _e('Clone', 'great-resposive-tab-blocks' ); ?></a>
					                        <div class="gt_clearfix"></div>
					                    </div>

					                    <!-- START inner -->
					                    <div class="gt_inner"  style="display:none">
					                        <div class=" gt_grid_first gt_grid_last">
					        
					                                <div class="tab-content">
					                                    <div class="span6">
					                                        <div class="gt_field_title">
					                                        <?php _e('Block Title', 'great-resposive-tab-blocks' ) ?>
					                                        </div>
					                                        <input name="block_title" class="gt_field gt_highlight_field gt_block_title" type="text" value="<?=(isset($block['title']) && !empty($block['title']))?$block['title']:'';?>" placeholder="<?php _e('Block Title', 'great-resposive-tab-blocks' ) ?>" />
					                                    </div>
					                                </div>
					                                <div class="span6">
					                                    <div class="gt_field_title">
					                                        <?php _e('Block Icon', 'great-resposive-tab-blocks' ) ?>
					                                    </div>
					                                    <input name="block_icon" class="gt_field gt_highlight_field  block_icon" type="hidden" value="<?=(isset($block['icon']) && !empty($block['icon']))?$block['icon']:'';?>" placeholder="<?php _e('Tab Icon', 'great-resposive-tab-blocks' ) ?>" />
					                                    <input class="select_icon btn primary button " type="button" value="Select Icon">
					                                    <img src="<?=(isset($block['icon']) && !empty($block['icon']))?$block['icon']:GRTB_URL.'/img/sample-icon.png';?>" />
					                                </div>

					                                <div class="gt_clearfix">
						                                <div class="gt_field_title">
						                                        <?php _e('Read more URL', 'great-resposive-tab-blocks' ) ?><a class="gt_inline_tip gt_tooltip_large" data-tooltip="<?php _e('If contents is not exist then read more link will set directly under the block.', 'great-resposive-tab-blocks' ) ?>">[?]</a>
						                                </div>
						                                <input name="url" class="gt_field gt_highlight_field gt_tab_url" type="text" value="<?=(isset($block['url']) && !empty($block['url']))?$block['url']:'';?>" placeholder="<?php _e('Read more URL', 'great-resposive-tab-blocks' ) ?>" />
						                                
						                               

						                                <div class="gt_field_title">
						                                        <?php _e('Content', 'great-resposive-tab-blocks' ) ?>
						                                        <a class="gt_inline_tip gt_tooltip_large" data-tooltip="<?php _e('Edit your tab\'s content by clicking the button below. Once updated, it will show up here.', 'great-resposive-tab-blocks' ) ?>">[?]</a>
						                                </div>

					                                    <div class="gt_field gt_tab_content"><?=(isset($block['contents']) && !empty($block['contents']))?html_entity_decode($block['contents']):'';?></div>
					                                    <textarea class="biofield block_content" style="display:none;" name="content"><?=(isset($block['contents']) && !empty($block['contents']))? html_entity_decode($block['contents']):'';?></textarea>
					                                    <div class="gt_edit_tab_content gt_small_button_primary">
					                                        <span class="dashicons dashicons-edit"></span> <?php _e('Edit content', 'great-resposive-tab-blocks' ) ?>&nbsp;
					                                    </div>
					                                

					                            </div>
					     

					                        </div>

					                        
					                </div>

					            </div>
					<?php
				}
			}
			?>
			  </div>
		            <div class="gt_clearfix"></div>
		            <!-- Add row button -->
		                                
				       	</div>	
					</div>	
			    	<div class="gt_clearfix"></div>
					<!-- END empty row -->
			    </div>
			    <div class='eblock'></div>
			<?php
			
			
      
      		}
	}
	 ?>











	<!-- START empty tab -->
	<div class="main-tab gt_main gt_empty_row" style="display:none;">

		<!-- tab handle bar -->
		<div class="gt_handle">
			<a class="gt_big_button_secondary gt_move_row_up" href="#" title="Move up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
			<a class="gt_big_button_secondary gt_move_row_down" href="#" title="Move down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
			<div class="gt_handle_title"></div>
			<a class="gt_big_button_secondary gt_remove_row_btn" href="#" title="Remove"><span class="dashicons dashicons-no-alt"></span></a>
			<a class="gt_big_button_secondary gt_clone_row" href="#" title="Clone"><span class="dashicons dashicons-admin-page"></span><?php _e('Clone', 'great-resposive-tab-blocks' ); ?></a>

			<a class="gt_big_button_secondary gt_add_block" href="#">
	                                    <?php _e('Add New Block', 'great-resposive-tab-blocks' ) ?>&nbsp;
	                                </a>
			<div class="gt_clearfix"></div>
		</div>

	    <!-- START inner -->
	    <div class="gt_inner">
	        <div class="">
	            <div class="tab-content">
	                <div class="span6">
	                    <div class="gt_field_title">
	                    <?php _e('Tab Title', 'great-resposive-tab-blocks' ) ?>
	                    </div>
	                    <input name="title" class="gt_field gt_highlight_field gt_tab_title" type="text" value="" placeholder="<?php _e('Tab Title', 'great-resposive-tab-blocks' ) ?>" />
	                </div>
	            
		            <div class="span6">
		                <div class="gt_field_title">
		                    <?php _e('Tab Icon', 'great-resposive-tab-blocks' ) ?>
		                </div>
		                <input name="icon" class="gt_field gt_highlight_field tab_icon" type="hidden" value="" placeholder="<?php _e('Tab Icon', 'great-resposive-tab-blocks' ) ?>" />
		                <input class="select_icon btn primary button" type="button" value="Select Icon">
		                <img src="<?=GRTB_URL.'/img/sample-icon.png'?>" alt="icon" />
		            </div>
	         

		         	<div class='eblock'></div>
				        
		        </div>
	            <div class="gt_clearfix"></div>
	            <!-- Add row button -->
	                                
	       	</div>	
		</div>	
    	<div class="gt_clearfix"></div>
		<!-- END empty row -->
    </div>




<!--- INNER Tab--->
					            <div class="gt_empty_row_block" style="display:none">

					                    <!-- member handle bar -->
					                    <div class="gt_handle">
					                        <a class="gt_big_button_secondary gt_move_row_up" href="#" title="Move up"><span class="dashicons dashicons-arrow-up-alt2"></span></a>
					                        <a class="gt_big_button_secondary gt_move_row_down" href="#" title="Move down"><span class="dashicons dashicons-arrow-down-alt2"></span></a>
					                        <div class="gt_handle_subtitle"></div>
					                        <a class="gt_big_button_secondary gt_remove_row_btn" href="#" title="Remove"><span class="dashicons dashicons-no-alt"></span></a>
					                        <a class="gt_big_button_secondary gt_clone_row" href="#" title="Clone"><span class="dashicons dashicons-admin-page"></span><?php _e('Clone', 'great-resposive-tab-blocks' ); ?></a>
					                        <div class="gt_clearfix"></div>
					                    </div>

					                    <!-- START inner -->
					                    <div class="gt_inner">
					                        <div class=" gt_grid_first gt_grid_last">
					        
					                                <div class="tab-content">
					                                    <div class="span6">
					                                        <div class="gt_field_title">
					                                        <?php _e('Block Title', 'great-resposive-tab-blocks' ) ?>
					                                        </div>
					                                        <input name="block_title" class="gt_field gt_highlight_field gt_block_title" type="text" value="" placeholder="<?php _e('Block Title', 'great-resposive-tab-blocks' ) ?>" />
					                                    </div>
					                                </div>
					                                <div class="span6">
					                                    <div class="gt_field_title">
					                                        <?php _e('Block Icon', 'great-resposive-tab-blocks' ) ?>
					                                    </div>
					                                    <input name="block_icon" class="gt_field gt_highlight_field  block_icon" type="hidden" value="" placeholder="<?php _e('Tab Icon', 'great-resposive-tab-blocks' ) ?>" />
					                                    <input class="select_icon btn primary button " type="button" value="Select Icon">
					                                    <img src="<?=GRTB_URL.'/img/sample-icon.png'?>" alt="icon" />
					                                </div>

					                                <div class="gt_clearfix">
						                                <div class="gt_field_title">
						                                        <?php _e('Read more URL', 'great-resposive-tab-blocks' ) ?><a class="gt_inline_tip gt_tooltip_large" data-tooltip="<?php _e('If contents is not exist then read more link will set directly under the block.', 'great-resposive-tab-blocks' ) ?>">[?]</a>
						                                </div>
						                                <input name="url" class="gt_field gt_highlight_field gt_tab_url" type="text" value="" placeholder="<?php _e('Read more URL', 'great-resposive-tab-blocks' ) ?>" />
						                                
						                               

						                                <div class="gt_field_title">
						                                        <?php _e('Content', 'great-resposive-tab-blocks' ) ?>
						                                        <a class="gt_inline_tip gt_tooltip_large" data-tooltip="<?php _e('Edit your tab\'s content by clicking the button below. Once updated, it will show up here.', 'great-resposive-tab-blocks' ) ?>">[?]</a>
						                                </div>

					                                    <div class="gt_field gt_tab_content"><?php echo $member["_grtb_content"]; ?></div>
					                                    <textarea class="biofield block_content" style="display:none;" name="content"></textarea>
					                                    <div class="gt_edit_tab_content gt_small_button_primary">
					                                        <span class="dashicons dashicons-edit"></span> <?php _e('Edit content', 'great-resposive-tab-blocks' ) ?>&nbsp;
					                                    </div>
					                                

					                            </div>
					     

					                        </div>

					                        
					                </div>

					            </div>

					<!-- END empty row Block -->


	<div class="gt_clearfix"></div>

	<div class="gt_no_row_notice">
		<?php /* translators: Leave HTML tags */ _e('Create your tab set by <strong>adding tabs</strong> to it.<br/>Click the button below to get started.', 'great-resposive-tab-blocks' ) ?>
	</div>

	<!-- Add row button -->
	<a class="gt_big_button_primary gt_add_row" href="#">
		<span class="dashicons dashicons-plus"></span> 
		<?php _e('Add Tab', 'great-resposive-tab-blocks' ) ?>&nbsp;
	</a>
<input type="hidden" value="" id="tabs" name="tabs">
<?php wp_nonce_field( 'gt_meta_box_nonce', 'gt_meta_box_nonce' ); ?>
<?php }