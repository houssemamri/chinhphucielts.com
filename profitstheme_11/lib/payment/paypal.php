<?php

function paypal_register_member( $payer_email, $txn_id, $item_number, $item_name, $payer_firstname, $payer_lastname )
{
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . WPINC . '/registration.php' );
	require_once(ABSPATH . WPINC . '/pluggable.php' );

	$user_name = sanitize_user( $payer_email, true );
	$user_id   = username_exists( $user_name );

	$p_number  = $item_number;
	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_number = '$p_number'" );

	if ( count($products) > 0 ) {
		$product = $products[0];

		if ( !$user_id ) {

			// If user not exist, then create a new account...
			$password  = wp_generate_password(8, false);
			$user_id = wp_create_user( $user_name, $password, $payer_email );

			// if user already exist, then just upgrade their account...
			update_user_meta( $user_id, 'first_name', $payer_firstname );
			update_user_meta( $user_id, 'last_name', $payer_lastname );
			update_user_meta( $user_id, 'pt_level_' . $product->product_id, 'true' );

			$email      = $payer_email;
			$username   = $payer_email;
			$pass       = $password;
			$first_name = esc_attr($payer_firstname);
			
		} else {

			// if user already exist, then just upgrade their account...
			update_user_meta( $user_id, 'pt_level_' . $product->product_id, 'true' );

			$user_info  = get_userdata( $user_id );
			$email      = $user_info->user_email;
			$username   = $user_info->user_login;
			$pass       = '- your chosen password -';
			$first_name = $user_info->first_name;
		}

		$title     = $pt_member_email_title;
		$body      = $pt_member_email_body;
		$login_url = ( $pt_member_login_page != '' ) ? get_permalink($pt_member_login_page) : get_bloginfo('wpurl') . '/wp-login.php';

		$title = str_replace('[%product_title%]', $item_name, $title);
		$title = str_replace('[%first_name%]', $payer_firstname, $title);
		$title = str_replace('[%last_name%]', $payer_lastname, $title);

		$body = str_replace('[%product_title%]', $item_name, $body);
		$body = str_replace('[%receipt%]', $txn_id, $body);
		$body = str_replace('[%first_name%]', $payer_firstname, $body);
		$body = str_replace('[%last_name%]', $payer_lastname, $body);
		$body = str_replace('[%user_name%]', $username, $body);
		$body = str_replace('[%password%]', $pass, $body);
		$body = str_replace('[%login_url%]', $login_url, $body);

		// send email to user
		$headers = 'From: ' . $pt_member_email_from . ' <' . get_option('admin_email') . '>' . "\r\n\\";
		@wp_mail( $email, $title, $body, $headers );
		
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
	}
}

function paypal_reactivate_member( $payer_email, $item_number )
{
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . WPINC . '/registration.php' );
	require_once(ABSPATH . WPINC . '/pluggable.php' );

	$p_number  = (int) $item_number;
	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_number = $p_number" );

	if ( count($products) > 0 ) {
		$product = $products[0];
		$user_info = get_userdatabylogin( $payer_email );
		update_user_meta( $user_info->ID, 'pt_level_' . $product->product_id, 'true' );
	}
}

function paypal_deactivate_member( $payer_email, $item_number )
{
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . WPINC . '/registration.php' );
	require_once(ABSPATH . WPINC . '/pluggable.php' );

	$p_number  = (int) $item_number;
	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_number = $p_number" );

	if ( count($products) > 0 ) {
		$product = $products[0];
		$user_info = get_userdatabylogin( $payer_email );
		delete_user_meta( $user_info->ID, 'pt_level_' . $product->product_id );
	}
}

function paypal_is_member_active( $payer_email, $item_number )
{
	global $wpdb, $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	require_once(ABSPATH . WPINC . '/registration.php' );
	require_once(ABSPATH . WPINC . '/pluggable.php' );

	$p_number  = (int) $item_number;
	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_number = $p_number" );

	if ( count($products) < 1 ) 
		return false;

	$product = $products[0];

	// check if user exists
	$user_id = username_exists( $user_name );

	if ( !$user_id ) 
		return false;

	// check if membership for this product is active
	$user_info = get_userdatabylogin( $payer_email );
	$user_meta = get_user_meta( $user_info->ID, 'pt_level_' . $product->product_id, true );

	if ( $user_meta == 'true' )
		return true;

	return false;
}

function pt_paypal_ipn()
{
	ignore_user_abort(true);

	global $integrate_options;

	foreach ( $integrate_options as $value ) {
		$$value['id'] = $value['value'];
	}

	if ( isset( $_GET['mode'] ) && $_GET['mode'] == 'paypal' && isset( $_GET['process'] ) && $_GET['process'] == 'payment' ) {

        /**
         * Hot fix Paypal upgrade
         * 
         * =============================================================
         */
        // STEP 1: Read POST data
        
        // reading posted data from directly from $_POST causes serialization 
        // issues with array data in POST
        // reading raw POST data from input stream instead. 
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
          $keyval = explode ('=', $keyval);
          if (count($keyval) == 2)
             $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
           $get_magic_quotes_exists = true;
        } 
        foreach ($myPost as $key => $value) {        
           if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
                $value = urlencode(stripslashes($value)); 
           } else {
                $value = urlencode($value);
           }
           $req .= "&$key=$value";
        }        
         
        // STEP 2: Post IPN data back to paypal to validate
        
        $url = ( $pt_paypal_sandbox == 'true' ) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        
        // In wamp like environments that do not come bundled with root authority certificates,
        // please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
        // of the certificate as shown below.
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        if( !($res = curl_exec($ch)) ) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
         
        
        // STEP 3: Inspect IPN validation result and act accordingly
        
        if (strcmp ($res, "VERIFIED") == 0) {
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your Primary PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment
        
            // assign posted variables to local variables
            $item_name          = $_POST['item_name'];
            $item_number        = $_POST['item_number'];
            $payment_status     = $_POST['payment_status'];
            $payment_amount     = $_POST['mc_gross'];
            $payment_currency   = $_POST['mc_currency'];
            $txn_id             = $_POST['txn_id'];
            $receiver_email     = $_POST['receiver_email'];
            $payer_email        = $_POST['payer_email'];
            $payer_firstname    = $_POST['first_name'];
            $payer_lastname     = $_POST['last_name'];
            $txn_type           = $_POST['txn_type'];
            
            switch ( $txn_type ) {
                case 'subscr_signup':
                    if ( username_exists( trim($payer_email) ) ) {
                        if ( paypal_is_member_active() ) {
                            // do nothing because member already signed up and received an access to the product...
                            // This is happening because 'subscr_payment' beats 'subscr_signup'
                        } else {
                            paypal_register_member( $payer_email, $txn_id, $item_number, $item_name, $payer_firstname, $payer_lastname );
                        }
                    } else {
                        paypal_register_member( $payer_email, $txn_id, $item_number, $item_name, $payer_firstname, $payer_lastname );
                    }
                    break;
                case 'subscr_payment':
                    if ( username_exists( trim($payer_email) ) ) {
                        if ( paypal_is_member_active() ) {
                            // do nothing because member already signed up and received an access to the product...
                        } else {
                            paypal_reactivate_member( $payer_email, $item_number );
                        }
                    } else {
                        paypal_register_member( $payer_email, $txn_id, $item_number, $item_name, $payer_firstname, $payer_lastname );
                    }
                    break;
                case 'web_accept':
                    if ( $payment_status == 'Completed' ) {
                        paypal_register_member( $payer_email, $txn_id, $item_number, $item_name, $payer_firstname, $payer_lastname );
                    }
                    break;

                case 'subscr_cancel':
                    paypal_deactivate_member( $payer_email, $item_number );
                    break;

                case 'subscr_eot':
                    paypal_deactivate_member( $payer_email, $item_number );
                    break;
            }
                
            switch ( $payment_status ) {

                case 'Refunded':
                    paypal_deactivate_member( $payer_email, $item_number );
                    break;
                    
                case 'Reversed':
                    paypal_deactivate_member( $payer_email, $item_number );
                    break;
            }
            
        } else if (strcmp ($res, "INVALID") == 0) {
            // log for manual investigation
        }
        
		exit;
	}
}

add_action( 'init', 'pt_paypal_ipn' );