<?php

function pt_force_download_file()
{
	global $wpdb, $pt_member_login_page, $pt_member_folder, $pt_member_free_folder;

	if ( isset($_GET['mode']) && $_GET['mode'] == 'download' && isset($_GET['file']) && $_GET['file'] != '' ) {
		if ( is_user_logged_in() ) {
			global $current_user;
			get_currentuserinfo();

			set_time_limit(0);

			$product_table = $wpdb->prefix . 'ptmembership_products';
	
			if ( ( isset( $_GET['type'] ) && $_GET['type'] == 'paid' ) ) {
				$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE payment_proccessor != 'free' ORDER BY product_id ASC" );

				$allow = false;
				if ( $products && count($products) > 0 ) {
					foreach ( $products as $product ) {
						$product_id = $product->product_id;
						$level = get_user_meta( $current_user->ID, 'pt_level_' . $product_id, true);
						if ( $level == 'true' ) {
							$allow = true;
							break;
						}
						
					}
				}

				if ( $allow == false ) {
					echo "<script>alert('You are not allowed to download this file.');\nhistory.back(-1);</script>";
					exit;
				}
			}

			$folder = ( isset( $_GET['type'] ) && $_GET['type'] == 'paid' ) ? $pt_member_folder : $pt_member_free_folder;
	
			$filepath = ABSPATH . '/wp-content/uploads/' . $folder . '/' . $_GET['file'];
	
			output_file( $filepath, $_GET['file'] );
		} else {

			$querystr   = ( get_option( 'permalink_structure' ) != '' ) ? '?errormsg=Please_Login_To_Access_This_Page' : '&errormsg=Please_Login_To_Access_This_File';
			$login_page = ( $pt_member_login_page != '' ) ? get_permalink( $pt_member_login_page ) . $querystr : get_bloginfo('wpurl') . '/wp-login.php';
			wp_redirect( $login_page  );
			exit;
		}
	}
}

add_action( 'init', 'pt_force_download_file' );

function output_file( $file, $name, $mime_type='' )
{
 	if( !is_readable($file) ) die('File not found or inaccessible!');
 
 	$size = filesize($file);
 	$name = rawurldecode($name);
 
 	/* Figure out the MIME type (if not specified) */
 	$known_mime_types = array(
 		"pdf" => "application/pdf",
		"exe" => "application/octet-stream",
		"zip" => "application/zip",
		"rar" => "application/rar",
		"doc" => "application/msword",
		"docx"=> "application/msword",
		"xls" => "application/vnd.ms-excel",
		"xlsx"=> "application/vnd.ms-excel",
		"ppt" => "application/vnd.ms-powerpoint",
		"swf" => "application/x-shockwave-flash",
		"mmap"=> "application/mmap",
		"mp3" => "audio/mpeg",
		"wav" => "audio/x-wav",
		"gif" => "image/gif",
		"png" => "image/png",
		"jpeg"=> "image/jpg",
		"jpg" => "image/jpg",
		"txt" => "text/plain",
		"flv" => "video/x-flv",
		"mp4" => "video/mpeg",
		"mpeg"=> "video/mpeg",
		"mpg" => "video/mpeg",
		"mov" => "video/quicktime",
		"avi" => "video/x-msvideo",
		"wmv" => "video/x-ms-wmv",
		
 	);
 	$file_extension = '';
 	if ( $mime_type == '' ) {
		$file_extension = strtolower(substr(strrchr($file,"."),1));
	 	if(array_key_exists($file_extension, $known_mime_types)){
			$mime_type = $known_mime_types[$file_extension];
	 	} else {
			$mime_type = "application/force-download";
	 	}
 	}
 
 	@ob_end_clean(); //turn off output buffering to decrease cpu usage
 
 	$inline = array('flv', 'mp4', 'mov', 'mp3');
 	
	if ( in_array($file_extension, $inline) ) {
		$disposition = $mime_type;
	} else {
		$disposition = 'attachment';
	}

 	// required for IE, otherwise Content-Disposition may be ignored
 	if(ini_get('zlib.output_compression'))
  		ini_set('zlib.output_compression', 'Off');
 
 	header('Content-Type: ' . $mime_type);
 	header('Content-Disposition: ' . $disposition . '; filename="'.$name.'"');
 	header("Content-Transfer-Encoding: binary");
 	header('Accept-Ranges: bytes');
 
 	/* The three lines below basically make the download non-cacheable */
 	header("Cache-control: private");
 	header('Pragma: private');
 	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
 
 	// multipart-download and download resuming support
 	if(isset($_SERVER['HTTP_RANGE'])) {
		list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
		list($range) = explode(",",$range,2);
		list($range, $range_end) = explode("-", $range);
		$range=intval($range);
		if(!$range_end) {
			$range_end=$size-1;
		} else {
			$range_end=intval($range_end);
		}
 
		$new_length = $range_end-$range+1;
		header("HTTP/1.1 206 Partial Content");
		header("Content-Length: $new_length");
		header("Content-Range: bytes $range-$range_end/$size");
 	} else {
		$new_length=$size;
		header("Content-Length: ".$size);
 	}
 
 	/* output the file itself */
 	$chunksize = 1*(1024*1024); //you may want to change this
 	$bytes_send = 0;
 	if ($file = fopen($file, 'r')) {
		if(isset($_SERVER['HTTP_RANGE']))
			fseek($file, $range);
 
		while( !feof($file) && (!connection_aborted()) && ($bytes_send<$new_length) ) {
			$buffer = fread($file, $chunksize);
			print($buffer); //echo($buffer); // is also possible
			flush();
			$bytes_send += strlen($buffer);
		}
 		fclose($file);
 	} else die('Error - can not open file.');
 
	die();
}
 