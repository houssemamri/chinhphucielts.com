<?php
function pt_site_framework( $blog_page = '' )
{
	global $design_options, $site_options, $option_key, $pt_layout_setup;
 
	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value'];
	}

	$blog_page = ( $blog_page == 'yes' ) ? 'yes' : '';

	pt_document_open();

	if ( $pt_layout_setup['header'] == 'fluid' ) {
		if ( $pt_layout_setup['topnavpos'] == 'beforeheader' ) {
			pt_before_header( $pt_layout_setup['header'] );
		}

		pt_header( $pt_layout_setup['header'] );

		if ( $pt_layout_setup['topnavpos'] == 'afterheader' ) {
			pt_before_header( $pt_layout_setup['header'] );
		}

		pt_after_header( $pt_layout_setup['header'] );
	}

	echo '<div id="wrapper">' . "\n";

	if ( $pt_layout_setup['header'] == 'fixed' ) {
		if ( $pt_layout_setup['topnavpos'] == 'beforeheader' ) {
			pt_before_header( $pt_layout_setup['header'] );
		}

		pt_header( $pt_layout_setup['header'] );

		if ( $pt_layout_setup['topnavpos'] == 'afterheader' ) {
			pt_before_header( $pt_layout_setup['header'] );
		}

		pt_after_header( $pt_layout_setup['header'] );
	}

	echo '<div id="mainarea"><div style="clear:both"></div>';

	if ( is_home() && $pt_media_type == 'feature3' || $blog_page == 'yes' && $pt_media_type == 'feature3' ) {
		pt_media_box();
	}

	switch( $pt_layouts['layout'] ){
		case '1-col-no-side':
			pt_content( $blog_page );
		break;

		case '2-col-left-side':
			pt_sidebar( 'sidebar1' );
			pt_content( $blog_page );
		break;

		case '2-col-right-side':
			pt_content( $blog_page );
			pt_sidebar( 'sidebar1' );
		break;

		case '3-col-both-side':
			pt_sidebar( 'sidebar1' );
			pt_content( $blog_page );
			pt_sidebar( 'sidebar2' );
		break;

		case '3-col-left-side':
			pt_sidebar( 'sidebar1' );
			pt_sidebar( 'sidebar2' );
			pt_content( $blog_page );
		break;

		case '3-col-right-side':
			pt_content( $blog_page );
			pt_sidebar( 'sidebar1' );
			pt_sidebar( 'sidebar2' );
		break;

		default:
			pt_content( $blog_page );
			pt_sidebar( 'sidebar1' );
		break;
	}
		
	echo '<div id="clr"></div>' . "\n";
	echo '</div>';

	if ( $pt_layout_setup['footer'] == 'fixed' ) {
		pt_bottom_widgets( $pt_layout_setup['footer'] );
		pt_footer( $pt_layout_setup['footer'] );
	}

	echo '</div>';

	if ( $pt_layout_setup['footer'] == 'fluid' ) {
		pt_bottom_widgets( $pt_layout_setup['footer'] );
			pt_footer( $pt_layout_setup['footer'] );
	}

	pt_document_close();

}