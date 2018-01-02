<?php

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {

	pt_add_requirement();

	if ( get_option('pt_site_options') === FALSE && get_option('pt_design_options') === FALSE ) {
		pt_write_css();
	}

	// Redirect to PT site options
	// stored user registration info
	$unique_opt = unique_option();
	if ( get_option('pt_api_key') && get_option( $unique_opt)) {
		header( 'Location: '.admin_url().'admin.php?page=pt_page_generator' ) ;
	} else {
		header( 'Location: '.admin_url().'admin.php?page=pt_register_options' ) ;
	}
	die;
}

if ( get_option('pt_api_key') != '' && get_option($option_key) != '' && get_option( 'pt_membership_upgrade' ) == '' ) {
	update_option( 'pt_membership_upgrade', 'true' );
	pt_membership_upgrade();
}


// check for jw player if exist

$jw_dir   = TEMPLATEPATH . '/lib/scripts/jwplayer';

if ( is_dir( $jw_dir) ) {
    	if ( $jw_path = opendir( $jw_dir ) ) { 
        	while ( ( $jw_file = readdir( $jw_path ) ) !== false ) {
			if ( $jw_file != "." && $jw_file != ".." ) {
		                $jws[] = $jw_file;
			}
        	}    
    	}
}else{
	delete_option('jw_player_location');
}

if ( pt_isset($jws) ) {					
	if ( is_dir( $jw_dir . '/' . $jws[0] ) ) {
		$new_jw_path = get_bloginfo('template_url') . '/lib/scripts/jwplayer/' . $jws[0] . '/jwplayer.flash.swf';
		$jw_abspath  = PT_SCRIPTS . '/jwplayer/' . $jws[0] . '/jwplayer.flash.swf';
	} else {
		$new_jw_path = get_bloginfo('template_url') . '/lib/scripts/jwplayer/jwplayer.flash.swf';
		$jw_abspath  = PT_SCRIPTS . '/jwplayer/jwplayer.flash.swf';
	}

	if ( file_exists ( $jw_abspath ) ) {
		update_option('jw_player_location', $new_jw_path);
	}
}