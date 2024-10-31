/**
 * Team Members Admin JS
 */

;(function($){
var _this;
var custom_uploader;
 $(document).on("click",'.select_icon',function(e) {
   _this=$(this);
   e.preventDefault();
    //If the uploader object has already been created, reopen the dialog
    if (custom_uploader) {
        custom_uploader.open();
        return;
    }

    //Extend the wp.media object
    custom_uploader = wp.media.frames.file_frame = wp.media({
        title: 'Choose Image',
        button: {
            text: 'Choose Image'
        },
library: {
            type: 'image'
        },
        multiple: false
    });
 custom_uploader.open();
    //When a file is selected, grab the URL and set it as the text field's value
    
//Open the uploader dialog
   custom_uploader.on('select', function() {
custom_uploader.close();
        attachment = custom_uploader.state().get('selection').first().toJSON();
if(_this.parent().find(".block_icon").length>0)
        _this.parent().find(".block_icon").val(attachment.url);
else
        _this.parent().find(".tab_icon").val(attachment.url);

        _this.parent().find("img").attr("src",attachment.url);
       

    
 });
});





$(document).ready(function (){

  /* Spencer Tipping jQuery's clone method fix (for select fields). */
  (function (original) {
    jQuery.fn.clone = function () {
      var result           = original.apply(this, arguments),
          my_textareas     = this.find('textarea').add(this.filter('textarea')),
          result_textareas = result.find('textarea').add(result.filter('textarea')),
          my_selects       = this.find('select').add(this.filter('select')),
          result_selects   = result.find('select').add(result.filter('select'));
  
      for (var i = 0, l = my_textareas.length; i < l; ++i) $(result_textareas[i]).val($(my_textareas[i]).val());
      for (var i = 0, l = my_selects.length;   i < l; ++i) result_selects[i].selectedIndex = my_selects[i].selectedIndex;
  
      return result;
    };
  }) (jQuery.fn.clone);


  /* Defines folder slug. */
  var pluginFolderSlug = 'responsive-tabs';


  /* Color conversions. */
  var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
  function gt_rgb2hex(rgb) {
    if (rgb) {
      rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
      return "#" + gt_hex(rgb[1]) + gt_hex(rgb[2]) + gt_hex(rgb[3]);
    } else {
      return;
    }
  }
  function gt_hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
  } 


  /* Inits color pickers. */
  $('.gt_color_picker').wpColorPicker();
  

  /* Processes tab's content fields. */
  /* Initial single input update. */
  $('.gt_main').not('.gt_empty_row').each(function(i, obj){

    $(this).find('.gt_tab_content').each(function(i, obj){
      if ($.trim($(this).text()) == ''){
        $(this).hide();
      } else {
        $(this).show();
      }
      $(this).html($.parseHTML($(this).html()));
    });

  });


  /* Shows/hides no row notice. */
  function refreshRowCountRelatedUI(){
    /* Shows notice when tab set has no tabs. */
    if($('.main-tab.gt_main').not('.gt_empty_row').length > 0){
      $( '.gt_no_row_notice' ).hide();
    } else {
      $( '.gt_no_row_notice' ).show();
    }
  }
  refreshRowCountRelatedUI();

  var total_tabs=$('.main-tab.gt_main').length;
  var total_blocks=$('.sub-tab').length;
  /* Adds a member to the team. */
  $( '.gt_add_row' ).on('click', function(e) {
  
     e.preventDefault();
     
    /* Clones/cleans/displays the empty row. */
    var row = $( '.gt_empty_row' ).clone(true);
    row.removeClass( 'gt_empty_row' ).addClass('gt_main').show();
    
    total_blocks++;
    total_tabs++;
    row.find("input").each(function(){
	    // Update the 'rules[0]' part of the name attribute to contain the latest count 
	    $(this).attr('name',"grtb["+total_tabs+"]["+$(this).attr('name')+"]");
	}); 

    var row1 = $('.gt_empty_row_block').clone(true);
    row1.removeClass( 'gt_empty_row_block' ).addClass('gt_main sub-tab').show();
    row1.find("input,textarea").each(function(){
	    // Update the 'rules[0]' part of the name attribute to contain the latest count 
	    $(this).attr('name',"grtb["+total_tabs+"]["+total_blocks+"]["+$(this).attr('name')+"]");
	});
	 
    row1.insertBefore(row.find('.eblock') );
    
    row.insertBefore( $('.gt_empty_row') );

    row.find('.gt_block_title').focus();

    /* Inits color picker. */
    row.find('.gt_color_picker_ready').removeClass('.gt_color_picker_ready').addClass('.gt_color_picker').wpColorPicker().css({'padding':'3px'});
    
    /* Defaults handle title. */
    row.find('.gt_handle_title').html(objectL10n.untitled);
    
    /* Hides empty member description. */
    row.find('.gt_tab_content').hide();

    refreshRowCountRelatedUI();
    return false;

  });



  /* Adds a member to the team. */
  $( '.gt_add_block' ).on('click', function(e) {
    
     e.preventDefault();
    /* Clones/cleans/displays the empty row. */
    
    var row = $('.gt_empty_row_block').clone(true);
    row.removeClass( 'gt_empty_row_block' ).addClass('gt_main sub-tab').show();
    
    total_blocks++;
    
    row.find("input,textarea").each(function(){
	    // Update the 'rules[0]' part of the name attribute to contain the latest count 
	    $(this).attr('name',"grtb["+total_tabs+"]['blocks']["+total_blocks+"]["+$(this).attr('name')+"]");
	});
	 
	 
    row.insertBefore($(this).parent().parent().find('.eblock') );

    row.find('.gt_block_title').focus();

    
    /* Defaults handle title. */
    row.find('.gt_handle_title').html(objectL10n.untitled);
    
    /* Hides empty member description. */
    row.find('.gt_tab_content').hide();

    refreshRowCountRelatedUI();
    return false;

  });


  /* Removes a row. */
  $('.gt_remove_row_btn').click(function(e) {

    $(this).closest('.gt_main').remove();

    refreshRowCountRelatedUI();
    return false;

  });


  /* Expands/collapses row. */
  $('.gt_handle').click(function(e) {
    
    if($(event.target).attr("class")=="gt_big_button_secondary gt_add_block"){
    	return false;
    }
    $(this).siblings('.gt_inner').slideToggle(50);
    
    ($(this).hasClass('closed')) 
      ? $(this).removeClass('closed') 
      : $(this).addClass('closed');

    return false;

  });
  $('.gt_collapse_rows').trigger("click");

  /* Collapses all rows. */
  $('.gt_collapse_rows').click(function(e) {

    $('.gt_handle').each(function(i, obj){
      if(!$(this).closest('.gt_empty_row').length){ // Makes sure not to collapse empty row.
        if($(this).hasClass('closed')){
          
        } else {
          
          $(this).siblings('.gt_inner').slideToggle(50);
          $(this).addClass('closed');

        }
      }
    });

    return false;

  });


  /* Expands all rows. */
  $('.gt_expand_rows').click(function(e) {

    $('.gt_handle').each(function(i, obj){
      if($(this).hasClass('closed')){
        
        $(this).siblings('.gt_inner').slideToggle(50);
        $(this).removeClass('closed');

      }
    });

    return false;

  });


  /* Shifts a row down (clones and deletes). */
  $('.gt_move_row_down').click(function(e) {

    if($(this).closest('.gt_main').next().hasClass('gt_main')){ // If there's a next row.
      /* Clones the row. */
      var movingRow = $(this).closest('.gt_main').clone(true);
      /* Inserts it after next row. */
      movingRow.insertAfter($(this).closest('.gt_main').next());
      /* Removes original row. */
      $(this).closest('.gt_main').remove();
    }

    return false;

  });


  /* Shifts a row up (clones and deletes). */
  $('.gt_move_row_up').click(function(e) {

    if($(this).closest('.gt_main').prev().hasClass('gt_main')){ // If there's a previous row.
      /* Clones the row. */
      var movingRow = $(this).closest('.gt_main').clone(true);
      /* Inserts it before previous row. */
      movingRow.insertBefore($(this).closest('.gt_main').prev());
      /* Removes original row. */
      $(this).closest('.gt_main').remove();
    }

    return false;

  });


  /* Duplicates a row. */
  $('.gt_clone_row').click(function(e) {

    /* Clones the row. */
    var clone = $(this).closest('.gt_main').clone(true);
    /* Inserts it after original row. */
    clone.insertAfter($(this).closest('.gt_main'));
    /* Adds 'copy' to title. */
    clone.find('.gt_handle_title').html(clone.find('.gt_tab_title').val() + ' (copy)');
    clone.find('.gt_tab_title').focus();

if(clone.find('.gt_tab_title').length>0)
    updateHandleTitle(clone.find('.gt_tab_title'), true);
    else
    updateHandleTitle(clone.find('.gt_block_title'), true);
    refreshRowCountRelatedUI(); 
    return false;

  });


 

  $("#post").on("submit",function(event) {   
	    var object = [];        
	    $('.main-tab').not('.gt_empty_row').each(function() {
	    	var blocs=[];
	    	$(this).find('.sub-tab').not('.gt_empty_row_block').each(function() {
	    		
	    	        
		    	var ck = {
		            'title': $(this).find(".gt_block_title").val(),
		            'icon': $(this).find(".block_icon").val(),
		            'contents': $(this).find(".block_content").val(),
		            'url': $(this).find(".gt_tab_url").val()
		        };
	            blocs.push(ck);
	        });  
	    	
	        var champion = {
	            'title': $(this).find(".gt_tab_title").val(),
	            'icon': $(this).find(".tab_icon").val(),
	            'blocks': blocs
	        };
	        
	               
	        object.push(champion);
	    });
	    object = JSON.stringify(object);
	    $('#tabs').val(object); //Sending object to hidden input   
	});

  /* Updates handle bar title. */
  function updateHandleTitle(titleField, wasCloned) {

    if (!wasCloned) { wasCloned = false }

    /* Gets current title. */
    var titleField = titleField;
    if(titleField.parents('.sub-tab.gt_main').find('.gt_handle_subtitle').length>0)
      var handleTitle = titleField.parents('.sub-tab.gt_main').find('.gt_handle_subtitle');
    else
     var handleTitle = titleField.parents('.main-tab.gt_main').find('.gt_handle_title');
     
    cloneCopyText = '';
    (wasCloned) ? cloneCopyText = ' copy' : cloneCopyText = '';
    
    /* Updates handle title. */
    (titleField.val() != '')
      ? handleTitle.html(titleField.val() + cloneCopyText)
      : handleTitle.html(objectL10n.untitled + cloneCopyText);

  }
  
 

  /* Watches member firstname/lastname and updates handle. */
  $('.gt_tab_title,.gt_block_title').live("keyup", function(e) { updateHandleTitle($(this)); });
 



  

  /* Unique editor. */
  var lastEditedBio = '';
  /* Opens the UE to edit bios. */
  $('.gt_edit_tab_content').click(function(e){

e.preventDefault();
    lastEditedBio = $(this).parent().find('.gt_tab_content');
    var currentContent = lastEditedBio.html();

    if ($("#wp-gt_editor-wrap").hasClass("tmce-active")){
      tinyMCE.editors[0].setContent(currentContent);
    } else {
      $('#gt_editor').val($.trim(currentContent));
    }
    $('#gt_unique_editor').fadeIn(100);
    if (tinyMCE.activeEditor !== null) { tinyMCE.activeEditor.focus(); } 

return false;
    
  });


  /* Saves the UE data. */
  $('.gt_ue_update').click(function(){

    if ($("#wp-gt_editor-wrap").hasClass("tmce-active")){
      var gt_ue_content = tinyMCE.activeEditor.getContent();
    } else {
      var gt_ue_content = $('#gt_editor').val();
    }
    
    /* Hides bio block if empty. */
    (!gt_ue_content) ? lastEditedBio.hide() : lastEditedBio.show();

    /* Adds bio content if there is. */
    lastEditedBio.html($.parseHTML(gt_ue_content));
    lastEditedBio.siblings('.biofield').val(gt_ue_content);

    /* Closes and empties UE. */
    $('#gt_unique_editor').fadeOut(100);
    if (tinymce.activeEditor !== null) { tinymce.activeEditor.setContent(''); }

    return false;

  });


  /* Cancels the UE updates. */
  $('.gt_ue_cancel').click(function(){
    $('#gt_unique_editor').fadeOut(100);
  });
  
 
});
})(jQuery);