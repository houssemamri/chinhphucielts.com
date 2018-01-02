<?php

function pt_jvzoo_register_member( $email, $receipt, $item_number, $prod_title, $first_name, $last_name ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$user_name = sanitize_user($email, true);
	$user_id   = username_exists($user_name);

	$product_table = "{$wpdb->prefix}ptmembership_products";
	$product = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$product_table` WHERE `cb_vendor_name` = %s AND `payment_proccessor` = %s", $item_number, 'jvzoo'));

	if ( $product ) {
		if ( !$user_id ) {
			// If user not exist, then create a new account...
			$password  = wp_generate_password(8, false);
			$user_id = wp_create_user( $user_name, $password, $email );

			// if user already exist, then just upgrade their account...
			update_user_meta( $user_id, 'first_name', $first_name );
			update_user_meta( $user_id, 'last_name', $last_name );
			update_user_meta( $user_id, 'pt_level_' . $product->product_id, 'true' );

			$email      = $email;
			$username   = $email;
			$pass       = $password;
			$first_name = esc_attr($first_name);
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
					$api_key = trim($product->ar_mc_api);
					ptm_subscribe_to_mc( $api_key, $list_name, $first_name, $email, 'register' );
				break;
			}
		}

		$title     = $pt_member_email_title;
		$body      = $pt_member_email_body;
		$login_url = ( $pt_member_login_page != '' ) ? get_permalink($pt_member_login_page) : get_bloginfo('wpurl') . '/wp-login.php';

		$title = str_replace('[%product_title%]', $prod_title, $title);
		$title = str_replace('[%first_name%]', $first_name, $title);
		$title = str_replace('[%last_name%]', $last_name, $title);

		$body  = str_replace('[%product_title%]', $prod_title, $body);
		$body  = str_replace('[%receipt%]', $receipt, $body);
		$body  = str_replace('[%first_name%]', $first_name, $body);
		$body  = str_replace('[%last_name%]', $last_name, $body);
		$body  = str_replace('[%user_name%]', $username, $body);
		$body  = str_replace('[%password%]', $pass, $body);
		$body  = str_replace('[%login_url%]', $login_url, $body);

		// send email to user
		$headers = 'From: ' . $pt_member_email_from . ' <' . get_option('admin_email') . '>' . "\r\n\\";
		@wp_mail( $email, $title, $body, $headers );
		return true;
	} else {
		return false;
	}
}

function pt_jvzoo_reactivate_member( $email, $item_number ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$item_number  = (int) $cproditem;
	$publisher    = $ctranspublisher;

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$product = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$product_table` WHERE `cb_vendor_name` = %s AND `payment_proccessor` = %s", $item_number, 'jvzoo'));

	if ( $product ) {
		$user_info = get_userdatabylogin( $email );
		update_user_meta( $user_info->ID, 'pt_level_' . $product->product_id, 'true' );
	}
}

function pt_jvzoo_deactivate_member( $email, $item_number ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$product = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$product_table` WHERE `cb_vendor_name` = %s AND `payment_proccessor` = %s", $item_number, 'jvzoo'));

	if ( $product ) {
		$user_info = get_userdatabylogin($email);
		delete_user_meta($user_info->ID, 'pt_level_' . $product->product_id);
	}
}

add_action('init', 'pt_jvzoo_ipn');
function pt_jvzoo_ipn() {
	if ( isset( $_REQUEST['mode'] ) && $_REQUEST['mode'] == 'jvzoo' && isset( $_REQUEST['process'] ) && $_REQUEST['process'] == 'payment' ) {
		global $integrate_options;
		foreach ( $integrate_options as $value ) {
			$$value['id'] = $value['value'];
		}
		
		$vars = ( empty($_POST['cverify']) && !empty($_REQUEST['cverify']) ) ? $_REQUEST : $_POST;
		unset($vars['mode'], $vars['process'], $vars['wpsem-login']);
		
		$secret_key = trim($pt_jvzoo_secret_key);
		$pop = '';

		$ipnFields = array();
		foreach ( $vars as $key => $value ) {
			if ( $key == "cverify" ) {
				continue;
       		}
			$ipnFields[] = $key;
		}
		sort( $ipnFields );
		foreach ( $ipnFields as $field ) {
			// if Magic Quotes are enabled $vars[$field] will need to be
        	// un-escaped before being appended to $pop
        	$pop = $pop . $vars[$field] . "|";
		}

		$pop = $pop . $secret_key;
		
		if ( function_exists('mb_convert_encoding') )
			$xxpop = sha1(mb_convert_encoding($pop, "UTF-8"));
		else
			$xxpop = sha1($pop);
			
		$xxpop = strtoupper(substr($xxpop,0,8));
		if ( $vars['cverify'] == $xxpop ) {
			// Read POST data and validate the ZPN
			$full_name = trim(stripslashes($vars['ccustname']));
			$names = explode(" ", $full_name, 2);
			$first_name = ucwords(strtolower($names[0]));
			$last_name = ucwords(strtolower($names[1]));
			$email = sanitize_email($vars['ccustemail']);
	
			$receipt = $vars['ctransreceipt'];
			$item_number = trim($vars['cproditem']);
			$prod_title = $vars['cprodtitle'];
			
			switch ( $vars['ctransaction'] ) {
				case 'SALE': 
        			case 'TEST_SALE':
					pt_jvzoo_register_member($email, $receipt, $item_number, $prod_title, $first_name, $last_name);
					break;
					
				case 'BILL':
					// do nothing...
					break;
				
				case 'RFND':
				case 'CGBK':
				case 'INSF':
				case 'CANCEL-REBILL':
	 			case 'CANCEL-TEST-REBILL':
					pt_jvzoo_deactivate_member($email, $item_number);
					break;
					
				case 'UNCANCEL-REBILL': 
				case 'UNCANCEL-TEST-REBILL':
					// Reversing the cancellation of a recurring billing product...
					pt_jvzoo_reactivate_member($email, $item_number);
					break;
			}
			
		}
		exit;
	}
}