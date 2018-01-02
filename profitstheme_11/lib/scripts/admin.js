jQuery(document).ready(function() {
	jQuery('.image_upload_button').each(function(){

		var clickedObject = jQuery(this);
		var clickedID = jQuery(this).attr('id');
		var actionURL = jQuery(this).parent().find('.ajax_action_url').val();

		new AjaxUpload(clickedID, {
			action: actionURL,
			name: clickedID, // File upload name
			data: { // Additional data to send
					action: 'pt_ajax_post_action',
					type: 'upload',
					data: clickedID 
			      },
			autoSubmit: true, // Submit file after selection
			responseType: false,
			onChange: function(file, extension){},
			onSubmit: function(file, extension){
				clickedObject.text('Uploading'); // change button text, when user selects file	
				this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
				interval = window.setInterval(function(){
					var text = clickedObject.text();
					if (text.length < 13) {
						clickedObject.text(text + '.'); 
					} else { clickedObject.text('Uploading'); } 
				}, 200);
			},
			
			onComplete: function(file, response) {
				   
				window.clearInterval(interval);
				clickedObject.text('Upload Image');	
				this.enable(); // enable upload button
					
				// If there was an error
				if(response.search('Upload Error') > -1){
					var buildReturn = '<span class="upload-error">' + response + '</span>';
					jQuery(".upload-error").remove();
					clickedObject.parent().after(buildReturn);
				} else {
				
					jQuery(".upload-error").remove();
					clickedObject.next('span').fadeIn();
					clickedObject.parent().find('.uploaded_url').val(response);
				}
			}
		});

	});

	var optbtntype = jQuery('#pt_popup_btntype').val();

	if ( optbtntype == 'text' ) {
		jQuery('#pt_popup_btnpremade_select-field').hide();
		jQuery('#pt_popup_btncolor_select-field').show();
		jQuery('#pt_popup_btntxt_text-field').show();
		jQuery('#pt_popup_btnurl_upload-field').hide();
	} else if ( optbtntype == 'upload' ) {
		jQuery('#pt_popup_btnpremade_select-field').hide();
		jQuery('#pt_popup_btncolor_select-field').hide();
		jQuery('#pt_popup_btntxt_text-field').hide();
		jQuery('#pt_popup_btnurl_upload-field').show();
	} else {
		jQuery('#pt_popup_btnpremade_select-field').show();
		jQuery('#pt_popup_btncolor_select-field').hide();
		jQuery('#pt_popup_btntxt_text-field').hide();
		jQuery('#pt_popup_btnurl_upload-field').hide();
	}

	jQuery("#pt_popup_btntype").change(function() {
        	var btntype = jQuery("option:selected", this).val();
        	if ( btntype == 'premade' ) {
			jQuery('#pt_popup_btnpremade_select-field').show();
			jQuery('#pt_popup_btncolor_select-field').hide();
			jQuery('#pt_popup_btntxt_text-field').hide();
			jQuery('#pt_popup_btnurl_upload-field').hide();
		} else if ( btntype == 'text' ) {
			jQuery('#pt_popup_btnpremade_select-field').hide();
			jQuery('#pt_popup_btncolor_select-field').show();
			jQuery('#pt_popup_btntxt_text-field').show();
			jQuery('#pt_popup_btnurl_upload-field').hide();
		} else if ( btntype == 'upload' ) {
			jQuery('#pt_popup_btnpremade_select-field').hide();
			jQuery('#pt_popup_btncolor_select-field').hide();
			jQuery('#pt_popup_btntxt_text-field').hide();
			jQuery('#pt_popup_btnurl_upload-field').show();
		}
    	});

	var integration = jQuery('#pt_integrate_membership').val();

	if ( integration == 'pt' ) {
		jQuery('#membership-div-open').show();

	} else {
		jQuery('#membership-div-open').hide();
	}
	
	jQuery("#pt_integrate_membership").change(function() {
        	var integrate = jQuery("option:selected", this).val();
        	if ( integrate == 'pt' ) {
			jQuery('#membership-div-open').show();
		} else {
			jQuery('#membership-div-open').hide();
		}
    	});

	var mediabox = jQuery('#pt_media_type').val();

	if ( mediabox == 'disable' ) {
		jQuery("#pt_feat_title_text-field").hide();
		jQuery("#pt_feat_cat_select-field").hide();
		jQuery("#pt_feat_num_select-field").hide();
		jQuery("#pt_feat_video_textarea-field").hide();
	} else if ( mediabox == 'video' ) {
		jQuery("#pt_feat_title_text-field").hide();
		jQuery("#pt_feat_cat_select-field").hide();
		jQuery("#pt_feat_num_select-field").hide();
		jQuery("#pt_feat_video_textarea-field").show();
	} else if ( mediabox == 'feature1' ) {
		jQuery("#pt_feat_title_text-field").show();
		jQuery("#pt_feat_cat_select-field").show();
		jQuery("#pt_feat_num_select-field").show();
		jQuery("#pt_feat_video_textarea-field").hide();
	} else {
		jQuery("#pt_feat_title_text-field").hide();
		jQuery("#pt_feat_cat_select-field").show();
		jQuery("#pt_feat_num_select-field").show();
		jQuery("#pt_feat_video_textarea-field").hide();
	}

	jQuery('#pt_media_type').change(function(){
		if ( jQuery("option:selected", this).val() == 'disable' ) {
			jQuery("#pt_feat_title_text-field").hide();
			jQuery("#pt_feat_cat_select-field").hide();
			jQuery("#pt_feat_num_select-field").hide();
			jQuery("#pt_feat_video_textarea-field").hide();
		} else if ( jQuery("option:selected", this).val() == 'video' ) {
			jQuery("#pt_feat_title_text-field").hide();
			jQuery("#pt_feat_cat_select-field").hide();
			jQuery("#pt_feat_num_select-field").hide();
			jQuery("#pt_feat_video_textarea-field").show();
		} else if ( jQuery("option:selected", this).val() == 'feature1' ) {
			jQuery("#pt_feat_title_text-field").show();
			jQuery("#pt_feat_cat_select-field").show();
			jQuery("#pt_feat_num_select-field").show();
			jQuery("#pt_feat_video_textarea-field").hide();
		} else {
			jQuery("#pt_feat_title_text-field").hide();
			jQuery("#pt_feat_cat_select-field").show();
			jQuery("#pt_feat_num_select-field").show();
			jQuery("#pt_feat_video_textarea-field").hide();
		}
	});

	var sitecom = jQuery('#pt_comments_type').val();
	if ( sitecom == 'wp' ) { 
		jQuery("#pt_comments_sort_select-field").hide();
		jQuery("#pt_fb_comments_count_select-field").hide();
		jQuery("#pt_fb_appid_text-field").hide();
		jQuery("#pt_fb_uid_text-field").hide();
	} else if ( sitecom == 'both' ) {
		jQuery("#pt_comments_sort_select-field").show();
		jQuery("#pt_fb_comments_count_select-field").show();
		jQuery("#pt_fb_appid_text-field").show();
		jQuery("#pt_fb_uid_text-field").show();
	} else if ( sitecom == 'fb' ) {
		jQuery("#pt_comments_sort_select-field").hide();
		jQuery("#pt_fb_comments_count_select-field").show();
		jQuery("#pt_fb_appid_text-field").show();
		jQuery("#pt_fb_uid_text-field").show();
	}

	jQuery('#pt_comments_type').change(function(){
		if ( jQuery("option:selected", this).val() == 'wp' ) {
			jQuery("#pt_comments_sort_select-field").hide();
			jQuery("#pt_fb_comments_count_select-field").hide();
			jQuery("#pt_fb_appid_text-field").hide();
			jQuery("#pt_fb_uid_text-field").hide();
		} else if ( jQuery("option:selected", this).val() == 'both' ) {
			jQuery("#pt_comments_sort_select-field").show();
			jQuery("#pt_fb_comments_count_select-field").show();
			jQuery("#pt_fb_appid_text-field").show();
			jQuery("#pt_fb_uid_text-field").show();
		} else if ( jQuery("option:selected", this).val() == 'fb' ) {
			jQuery("#pt_comments_sort_select-field").hide();
			jQuery("#pt_fb_comments_count_select-field").show();
			jQuery("#pt_fb_appid_text-field").show();
			jQuery("#pt_fb_uid_text-field").show();
		}
	});

	if ( !jQuery('#pt_post_related').is(":checked") ) {
		jQuery("#pt_post_related_title_text-field").hide();
	}

	jQuery("#pt_post_related").click(function(){
		if ( this.checked == true ) {
			jQuery("#pt_post_related_title_text-field").show();
		} else {
			jQuery("#pt_post_related_title_text-field").hide();
		}
	});

	if ( jQuery('#pt_launch_mode').val() == 'evergreen' ) {
		jQuery('#pt_launch_soon_select-field').hide();
	} else {
		jQuery('#pt_launch_soon_select-field').show();
	}

	jQuery('#pt_launch_mode').change(function(){
		if ( jQuery("option:selected", this).val() == 'evergreen' ) {
			jQuery('#pt_launch_soon_select-field').hide();
		} else {
			jQuery('#pt_launch_soon_select-field').show();
		}
	});
});