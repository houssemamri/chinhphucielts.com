<?php
$dirs   = explode("\\", dirname(__FILE__));
$slash  = '\\';

if ( count($dirs) <= 1 ) {
	$dirs   = explode("/", dirname(__FILE__));
	$slash  = '/';
}

$pos    = array_search('wp-content', $dirs);
$wppath = '';

for ( $i=0; $i<$pos;$i++ ) {
	$wppath .= $dirs[$i] . $slash;
}

if ( file_exists($wppath . 'wp-config.php') ) {
	require_once($wppath . 'wp-config.php');
	require_once('../../functions.php');
}

if ( isset($_POST) ) {
	$launch_data  = array(
			'title' => htmlspecialchars($_POST['title']),
			'thumb' => $_POST['thumb'],
			'month' => $_POST['month'],
			'day' => $_POST['day'],
			'year' => $_POST['year'],
			'hour' => $_POST['hour'],
			'minute' => $_POST['minute']
		);

	update_post_meta($_POST['post_id'], 'pt_launch_data', $launch_data);
}

