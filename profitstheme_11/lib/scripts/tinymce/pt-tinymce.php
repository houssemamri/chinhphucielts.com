<?php 
function pt_tinymce_buttons() 
{
   	// Don't bother doing this stuff if the current user lacks permissions
   	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     	return;
 
   	// Add only in Rich Editor mode
   	if ( get_user_option('rich_editing') == 'true') {
     		add_filter( 'mce_external_plugins', 'pt_tinymce_plugins' );
     		add_filter( 'mce_buttons_3', 'pt_register_buttons' );
		add_filter( 'mce_css', 'pt_tinymce_css' );
   	}
}
add_action('init', 'pt_tinymce_buttons');

function pt_register_buttons( $buttons ) 
{
   	array_push( $buttons, "gpfbox", "actionbuttons", "separator", "gpfsalestoolspt", "gpfsalestoolspt2", "gpfsalestoolspt3", "gpfsalestoolspt_2", "gpfsalestoolspt2_2", "gpfsalestoolspt3_2", "gpfsalestoolspt4", "gpfsalestoolspt5", "gpfsalestoolspt6", "gpfsalestoolspt4_2", "gpfsalestoolspt5_2", "gpfsalestoolspt6_2", "gpfsalestoolspt8",  "gpfsalestoolspt9",  "gpfsalestoolspt10", "gpfsalestoolspt7", "separator", "gpfsalestoolspt98", "gpfsalestoolspt99", "backcolor");
   	return $buttons;
}

function pt_tinymce_plugins( $plugin_array ) 
{
	$plugin_path = PT_REL_SCRIPTS . '/tinymce/plugins';

	$plugin_array['gpfbox']         = $plugin_path . '/boxes/editor_plugin_src.js';
	$plugin_array['actionbuttons']  = $plugin_path . '/buttons/editor_plugin_src.js';
    $plugin_array['gpfsalestoolspt'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt2'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt3'] = $plugin_path . '/salestools/editor_plugin_src.js';
    $plugin_array['gpfsalestoolspt_2'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt2_2'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt3'] = $plugin_path . '/salestools/editor_plugin_src.js';
    
	$plugin_array['gpfsalestoolspt4'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt5'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt6'] = $plugin_path . '/salestools/editor_plugin_src.js';
    $plugin_array['gpfsalestoolspt4_2'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt5_2'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt6_2'] = $plugin_path . '/salestools/editor_plugin_src.js';
    
    $plugin_array['gpfsalestoolspt8'] = $plugin_path . '/salestools/editor_plugin_src.js';
    $plugin_array['gpfsalestoolspt9'] = $plugin_path . '/salestools/editor_plugin_src.js';
    $plugin_array['gpfsalestoolspt10'] = $plugin_path . '/salestools/editor_plugin_src.js';
    $plugin_array['gpfsalestoolspt7'] = $plugin_path . '/salestools/editor_plugin_src.js';
	
	$plugin_array['gpfsalestoolspt98'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt97'] = $plugin_path . '/salestools/editor_plugin_src.js';
	$plugin_array['gpfsalestoolspt99'] = $plugin_path . '/salestools/editor_plugin_src.js';

   	return $plugin_array;
}

function pt_tinymce_css( $css ) 
{
	$css = PT_REL_SCRIPTS . '/tinymce/css/pt-mce.css';
	return $css;
}
