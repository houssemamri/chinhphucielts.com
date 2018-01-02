<?php

function pt_sanitize( &$value, $default = null ) {
	if ( !isset($value) ) $value = $default;
	return trim(stripslashes($value));
}

function cb_register_member( $ccustemail, $ctransreceipt, $cproditem, $ctranspublisher, $cprodtitle, $ccustfirstname, $ccustlastname ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$user_name = sanitize_user($ccustemail, true);
	$user_id   = username_exists($user_name);

	$item_number  = (int) $cproditem;
	$publisher    = $ctranspublisher;

	$product_table = "{$wpdb->prefix}ptmembership_products";
	$product = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$product_table` WHERE cb_item_number = %d AND cb_vendor_name = %s", $item_number, $publisher));
	
	if ( $product ) {
		if ( !$user_id ) {
			// If user not exist, then create a new account...
			$password  = wp_generate_password(8, false);
			$user_id = wp_create_user( $user_name, $password, $ccustemail );

			// if user already exist, then just upgrade their account...
			update_user_meta( $user_id, 'first_name', $ccustfirstname );
			update_user_meta( $user_id, 'last_name', $ccustlastname );
			update_user_meta( $user_id, 'pt_level_' . $product->product_id, 'true' );

			$email      = $ccustemail;
			$username   = $ccustemail;
			$pass       = $password;
			$first_name = esc_attr($ccustfirstname);

		} else {

			// if user already exist, then just upgrade their account...
			update_user_meta( $user_id, 'pt_level_' . $product->product_id, 'true' );

			$user_info  = get_userdata($user_id);
			$email      = $user_info->user_email;
			$username   = $user_info->user_login;
			$pass       = '- your chosen password -';
			$first_name = $user_info->first_name;
		}

		if ( $product->ar_enable == 'yes' ) {

			$list_name = trim($product->ar_list_name);
			$ar_account = $product->ar_account;

			switch ( $ar_account ) {
				case 'aw':
					ptm_subscribe_to_aw( $list_name, $first_name, $email );
				break;

				case 'gr':
					$api_key = trim($product->ar_gr_api);
					ptm_subscribe_to_gr( $api_key, $list_name, $first_name, $email, 'register' );
				break;
					
				case 'mc':
					$apikey = trim($product->ar_mc_api);
					ptm_subscribe_to_mc( $apikey, $list_name, $first_name, $email, 'register' );
				break;
			}
		}

		$title     = $pt_member_email_title;
		$body      = $pt_member_email_body;
		$login_url = ( $pt_member_login_page != '' ) ? get_permalink($pt_member_login_page) : get_bloginfo('wpurl') . '/wp-login.php';

		$title = str_replace('[%product_title%]', $cprodtitle, $title);
		$title = str_replace('[%first_name%]', $ccustfirstname, $title);
		$title = str_replace('[%last_name%]', $ccustlastname, $title);

		$body  = str_replace('[%product_title%]', $cprodtitle, $body);
		$body  = str_replace('[%receipt%]', $ctransreceipt, $body);
		$body  = str_replace('[%first_name%]', $ccustfirstname, $body);
		$body  = str_replace('[%last_name%]', $ccustlastname, $body);
		$body  = str_replace('[%user_name%]', $username, $body);
		$body  = str_replace('[%password%]', $pass, $body);
		$body  = str_replace('[%login_url%]', $login_url, $body);

		// send email to user
		$headers = 'From: ' . $pt_member_email_from . ' <' . get_option('admin_email') . '>' . "\r\n\\";
		@wp_mail( $email, $title, $body, $headers );
	}
}

function cb_reactivate_member( $ccustemail, $cproditem, $ctranspublisher ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$item_number  = (int) $cproditem;
	$publisher    = $ctranspublisher;

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE cb_item_number = $item_number AND cb_vendor_name = '" . $publisher . "'" );

	if ( count($products) > 0 ) {
		$product = $products[0];
		$user_info = get_userdatabylogin( $ccustemail );
		update_user_meta( $user_info->ID, 'pt_level_' . $product->product_id, 'true' );
	}
}

function cb_deactivate_member( $ccustemail, $cproditem, $ctranspublisher )
{
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$item_number  = (int) $cproditem;
	$publisher    = $ctranspublisher;

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE cb_item_number = $item_number AND cb_vendor_name = '" . $publisher . "'" );

	if ( count($products) > 0 ) {
		$product = $products[0];
		$user_info = get_userdatabylogin( $ccustemail );
		delete_user_meta( $user_info->ID, 'pt_level_' . $product->product_id );
	}
}

function pt_clickbank_ipn() {
	//ignore_user_abort(true);
	if ( isset( $_REQUEST['mode'] ) && $_REQUEST['mode'] == 'clickbank' && isset( $_REQUEST['process'] ) && $_REQUEST['process'] == 'payment' ) {
		global $integrate_options;

		foreach ( $integrate_options as $value ) {
			$$value['id'] = $value['value'];
		}
	
		$secretKey = trim($pt_cb_secret_key);
		$pop = '';

		$ipnFields = array();

		foreach ( $_POST as $key => $value ) {
			if ( $key == "cverify" ) {
				continue;
       			}
        
			$ipnFields[] = $key;
		}
		
		sort( $ipnFields );
		foreach ( $ipnFields as $field ) {
			// if Magic Quotes are enabled $_POST[$field] will need to be
        		// un-escaped before being appended to $pop
        		$pop = $pop . $_POST[$field] . "|";
		}

		$pop = $pop . $secretKey;
		$xxpop = sha1(mb_convert_encoding($pop, "UTF-8"));
		$xxpop = strtoupper(substr($xxpop,0,8));
		
		$ccustfullname = $_POST['ccustfullname'];
		$ccustfirstname = ucwords(strtolower(pt_sanitize($_POST['ccustfirstname'])));
		$ccustlastname = ucwords(strtolower(pt_sanitize($_POST['ccustlastname'])));
		$ccustemail = sanitize_email($_POST['ccustemail']);
		$ccustcc = $_POST['ccustcc'];
		$ccuststate = $_POST['ccuststate'];
		$ctransreceipt = $_POST['ctransreceipt'];
		$cproditem = $_POST['cproditem'];
		$ctransaction = $_POST['ctransaction'];
		$ctransaffiliate = $_POST['ctransaffiliate'];
		// $ctranspublisher = $_POST['ctranspublisher'];
		$ctranspublisher = ( isset($_POST['ctranspublisher']) && $_POST['ctranspublisher'] != '' ) ? $_POST['ctranspublisher'] : $_POST['ctransvendor'];
		$cprodtype = $_POST['cprodtype'];
		$cprodtitle = pt_sanitize($_POST['cprodtitle']);
		$ctranspaymentmethod = $_POST['ctranspaymentmethod'];
		$ctransamount = $_POST['ctransamount'];
		$caffitid = $_POST['caffitid'];
		$cvendthru = $_POST['cvendthru'];
		$cbpop = $_POST['cverify'];

        // if ( $xxpop != '' && $cbpop != '' ) { // Revised by Aan -- adding verification of secret key (security issue), July 20, 2012
		//if ( $xxpop != '' && $cbpop != '' && $xxpop == $cbpop ) {
			
		if($cbpop != ''){

			//Include additional wordpress functions
			switch ( $ctransaction ) {
				case 'SALE':
				case 'TEST_SALE':
					//$body_error = site_url()."\r\n";
					//foreach ($_POST as $key=>$value){
					//	$body_error .= $key.' : '.$value."\r\n";
					//}
					//@wp_mail( 'profitstheme@yahoo.co.uk', 'Clickbank SUCCESS', "TEST_SALE \r\n".$body_error, 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>' . "\r\nContent-Type: text/plain; charset=utf-8" );
					cb_register_member( $ccustemail, $ctransreceipt, $cproditem, $ctranspublisher, $cprodtitle, $ccustfirstname, $ccustlastname );
					break;
	
				case 'BILL':
				case 'TEST_BILL':
					// Do nothing. Just keep member to access the product...
					break;
				
				case 'CANCEL-REBILL':
				case 'TEST_CNCL':
					cb_deactivate_member($ccustemail, $cproditem, $ctranspublisher);
					break;

				case 'TEST':
					@wp_mail( get_option('admin_email'), 'Clickbank IPN Test', "Clickbank Instant Notification Test Success\r\n", 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>' . "\r\nContent-Type: text/plain; charset=utf-8" );
					break;
					
				case 'UNCANCEL-REBILL':
					cb_reactivate_member($ccustemail, $cproditem, $ctranspublisher);
					break;
					
				case 'RFND':
				case 'INSF':
				case 'CGBK':
				case 'TEST_RFND':
					cb_deactivate_member($ccustemail, $cproditem, $ctranspublisher);
					break;
			}
		}else{
			$body_error = site_url()."\r\n";
			foreach ($_POST as $key=>$value){
				$body_error .= $key.' : '.$value."\r\n";
			}
			
			@wp_mail( 'profitstheme@yahoo.co.uk', 'Clickbank Error Report', "DATA: \r\n".$body_error, 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>' . "\r\nContent-Type: text/plain; charset=utf-8" );
		}

		
		exit;
	}
}

add_action( 'init', 'pt_clickbank_ipn' );