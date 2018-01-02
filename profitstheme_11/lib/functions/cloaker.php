<?php

require_once('../../../../../wp-config.php');
require_once('../../functions.php');

$url = get_option('home');

$post_id = intval( $_GET['post_id'] );
$link_id = intval( $_GET['link_id'] );
$mypost  = get_post( $post_id, OBJECT );
$pattern = '@(<a[\s]+[^>]*href\s*=\s*)(?: "([^">]+)" | \'([^\'>]+)\' )([^<>]*>)(.*?)(</a>)@xsi';

if ( is_object( $mypost ) ) {
			
	$links = preg_match_all( $pattern, $mypost->post_content, $matches, PREG_SET_ORDER );

	if ( $links >= $link_id ) {		
		$url = empty( $matches[$link_id-1][3] ) ? $matches[$link_id-1][2] : $matches[$link_id-1][3];
		$url = str_replace( '&amp;', '&', $url );
		$url = ltrim( $url );
	}

}


header("HTTP/1.1 301 Moved Permanently");
header("Location: $url");
exit;

