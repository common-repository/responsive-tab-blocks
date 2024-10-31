<?php
// Create the Responsive Tabs shortcode
function grtb_block_f($atts) {
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));

    global $post;


    $args = array('post_type' => 'grtb_block', 'name' => $name);
    $custom_posts = get_posts($args);
    $output = '';
    
    foreach($custom_posts as $post) : setup_postdata($post);

	$entries = json_decode(get_post_meta( $post->ID, '_gt_tab_contents', true ));
	$style=intval(get_post_meta( $post->ID, '_gt_tabs_style', true ));
	$gt_breakpoint = get_post_meta( $post->ID, '_gt_breakpoint', true );
	$tabs_tbgs = get_post_meta( $post->ID, '_gt_tbg', true );
	
	if($style>1)
	{
	       require(GRTB_PATH."/inc/css/gt-style.php");
	}
  
    
	    $gt_opt=(object)array(
		"blocksperline"=>intval(get_post_meta( $post->ID, '_gt_blocksperline', true )),
		"displayinrow"=>intval(get_post_meta( $post->ID, '_gt_displayinrow', true )),
		"showcontents"=>intval(get_post_meta( $post->ID, '_gt_showcontents', true )),
		"showblocks"=>intval(get_post_meta( $post->ID, '_gt_show_blocks', true )),
		
		);
	    
	    (get_post_meta( $post->ID, '_gt_tbg', true )) ? $gt_tbg = get_post_meta( $post->ID, '_gt_tbg', true ) : $gt_tbg = 'transparent';
	
	    /* Checks if forcing original fonts. */
	    $original_font = get_post_meta( $post->ID, '_gt_original_font', true );
	    ($original_font && $original_font != 'no' ? $ori_f = 'gt_tab_ori' : $ori_f = '');
	
	    
	    //$gt_color = get_post_meta( $post->ID, '_gt_tabs_bg_color', true );
	
	    
	
	    /* Outputing the options in invisible divs */
	    $output .= '<div class="gt '.$ori_f.' gt_'.$name.'" style="background-color:'.$tabs_tbgs.'">';
	    $output .= '<div class="gt_slug" style="display:none">'.$name.'</div>';
	    $output .= '<div class="gt_inactive_tab_background" style="display:none">'.$gt_tbg.'</div>';
	    $output .= '<div class="gt_breakpoint" style="display:none">'.(empty($gt_breakpoint)?724:$gt_breakpoint).'</div>';
	    $output .= '<div class="gt_color" style="display:none">'.$gt_color.'</div>';
	
	
	$blocks_op='';
    $output .= '
        <div class="gt_menu style'.intval($style).'">
            <ul>
                <li class="mobile_toggle">&zwnj;<div class="data"></div><span><span></span></span></li>';
                foreach ($entries as $key => $tabs) {
                    if ($key == 0){
                    $output .= '<li class="current">';
                    $output .= '<a style="" class="active '.$name.'-tab-link-'.$key.'" href="#" data-tab="#'.$name.'-tab-'.$key.'"><span>';

		    (!empty($tabs->icon)) ?
                            $output .= "<img src='".$tabs->icon."' class='tab-ico'/></span>" :
                                $output .= '&nbsp;</span>';
                    (!empty($tabs->title)) ?
                            $output .= $tabs->title :
                                $output .= '&nbsp;';

                    $output .= '</a>';
                    $output .= '</li>';
                    } else {
                    $output .= '<li>';
                    $output .= '<a href="#" data-tab="#'.$name.'-tab-'.$key.'" class="'.$name.'-tab-link-'.$key.'"><span>';
                    (!empty($tabs->icon)) ?
                            $output .= "<img src='".$tabs->icon."' class='tab-ico' alt='".$tabs->title."'/></span>" :
                                $output .= '&nbsp;</span>';
                    (!empty($tabs->title)) ?
                            $output .= $tabs->title:
                                $output .= '&nbsp;';

                    $output .= '</a>';
                    $output .= '</li>';
                    
                    
                    
                    
                    }
                    
                    if ($key == 0)
                    	$blocks_op.='<div style="" id="'.$name.'-tab-'.$key.'" class="gt_content active">';
                    else
                    	$blocks_op.='<div style="" id="'.$name.'-tab-'.$key.'" class="gt_content">';
                    
                    
                    
                    


			$tot=$last_row=0;
			$totR=count($tabs->blocks)-$gt_opt->blocksperline;
			foreach($tabs->blocks as $block){
			          
			   if($gt_opt->showblocks==1 && !empty((html_entity_decode(wpautop($block->title))))){
			        if($tot==0)
			        	$blocks_op.="<ul>";
			                 	
				$tot++;
				
				if($totR<$tot)
				 $last_row=1;
				
				
			            $blocks_op.= '<li style="" id="'.$name.'-tab-'.$key.$tot.'" class="gtblock bwidth'.$gt_opt->blocksperline.' '.(($last_row)?'bottom-last':'').' '.((($tot%$gt_opt->blocksperline)==0 || $tot==count($tabs->blocks))?'right-last':'').' '.((!empty($block->contents))?'econtent':'').' '.(($tot==1 && !empty($block->contents))?"active":"").'""><div>';
			            $blocks_op .=(!empty($block->icon))?"<img src='".$block->icon."' class='block-ico'  alt='".$block->title."'/>" :'&nbsp;';
	                                
			            $blocks_op.=(html_entity_decode(wpautop($block->title)));
			                
				    if(empty($block->contents))
			            	$blocks_op.= '<div><a href="" class="read-more">More</a></div></div>';
			            else
			            	$blocks_op.= '<div class="contents">'.do_shortcode(html_entity_decode($block->contents)).'</div>';
			            
			            $blocks_op.= '</li>';
			            
			        
			        	
			        
			   }elseif(!empty($block->contents)){
			   	if($gt_opt->showblocks!=1){
			   		$blocks_op .=(!empty($block->icon))?"<h3><img src='".$block->icon."' class='block-ico'  alt='".$block->title."'/>" :'<h3>';
	                       
			   		$blocks_op.= (html_entity_decode(wpautop($block->title))).'</h3>';
			   	}	
			   	$blocks_op.= '<div class="contents">'.do_shortcode(html_entity_decode($block->contents)).'</div>';
			   }
			  
			        
	                }
	                if($tot>0){
	                    $blocks_op.='</ul>';
	                    
	                    
	                    
	                   // if(!empty($block->contents)){
	                    	$blocks_op.='<div class="gt-active-content" style="display:none"><div class="data"></div><div class="nav"><span class="left-arrow"><</span><span class="right-arrow">></span></div></div>';
	                   // }
	                
	               }
	               $blocks_op.='</div>';
	                    
	    }
	    $output .= '</div>';
	
   
    $output .=$blocks_op;

  endforeach; 
  
  wp_reset_postdata();
  return $output;

}

add_shortcode("grtb", "grtb_block_f");

?>