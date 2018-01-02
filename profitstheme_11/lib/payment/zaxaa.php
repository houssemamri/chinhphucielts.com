<?php
function zaxaa_register_member( $email, $receipt, $sku, $prod_title, $first_name, $last_name ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$user_name = sanitize_user($email, true);
	$user_id   = username_exists($user_name);

	$product_table = "{$wpdb->prefix}ptmembership_products";
	$product = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$product_table` WHERE `cb_vendor_name` = %s AND `payment_proccessor` = %s", $sku, 'zaxaa'));

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
					ptm_subscribe_to_gr( $api_key, $list_name, $first_name, $email, 'background' );
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
	}
}

function zaxaa_deactivate_member( $email, $sku ) {
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . 'wp-includes/user.php');
	require_once(ABSPATH . 'wp-includes/pluggable.php');

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$product = $wpdb->get_row($wpdb->prepare("SELECT * FROM `$product_table` WHERE `cb_vendor_name` = %s AND `payment_proccessor` = %s", $sku, 'zaxaa'));

	if ( $product ) {
		$user_info = get_userdatabylogin($email);
		delete_user_meta($user_info->ID, 'pt_level_' . $product->product_id);
	}
}

add_action('init', 'pt_zaxaa_ipn');
function pt_zaxaa_ipn() {
	if ( isset( $_REQUEST['mode'] ) && $_REQUEST['mode'] == 'zaxaa' && isset( $_REQUEST['process'] ) && $_REQUEST['process'] == 'payment' ) {
		global $integrate_options;
		foreach ( $integrate_options as $value ) {
			$$value['id'] = $value['value'];
		}
	
		$api_key = trim($pt_zaxaa_api);
		
		if ( !empty($_POST['trans_type']) ) {
			
			// Read POST data and validate the ZPN
			$transType = $_POST['trans_type'];
			$transReceipt = $_POST['trans_receipt'];
			$transAmount = number_format($_POST['trans_amount'], 2);
			$sellerID = $_POST['seller_id'];
			$hashKey = $_POST['hash_key'];
	
			$myHashKey = strtoupper(md5($sellerID . $api_key . $transReceipt . $transAmount));
			
			$body_error = '';
			//foreach ($_POST as $key=>$value){
			//	$body_error .= $key.' : '.serialize($value)."\r\n";
			//}
			
			//$body_error .= $myHashKey;
			//@wp_mail( 'profitstheme@yahoo.co.uk', 'Zaxaa Error Report', "DATA: \r\n".$body_error, 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>' . "\r\nContent-Type: text/plain; charset=utf-8" );
				
			if ( $myHashKey == $hashKey ) {
				$receipt = $transReceipt;
				$email = sanitize_email($_POST['cust_email']);
				$first_name = esc_attr($_POST['cust_firstname']);
				$last_name = esc_attr($_POST['cust_lastname']);
				
				$products = $_POST['products'];
				switch ( $transType ) {
					case 'FIRST_BILL':
					case 'SALE':
						// New payment for one-time product(s)
						foreach ( $products as $product ) {
							$prod_title = trim(stripslashes($product['prod_name']));
							$sku = $product['prod_number'];
							zaxaa_register_member($email, $receipt, $sku, $prod_title, $first_name, $last_name);
						}
						break;
						
					case 'REBILL':
						// do nothing...
						break;
					
					case 'REFUND':	
					case 'CANCELED':
						// Subscription is canceled
						foreach ( $products as $product ) {
							$sku = $product['prod_number'];
							zaxaa_deactivate_member($email, $sku);
						}
						break;
				}
			}else{
				foreach ($_POST as $key=>$value){
					$body_error .= $key.' : '.serialize($value)."\r\n";
				}
				
				$body_error .= $myHashKey;
				@wp_mail( 'profitstheme@yahoo.co.uk', 'Zaxaa Error Report', "DATA: \r\n".$body_error, 'From: ' . get_bloginfo('name') . ' <' . get_option('admin_email') . '>' . "\r\nContent-Type: text/plain; charset=utf-8" );
				
			}
		}
		exit;
	}
}