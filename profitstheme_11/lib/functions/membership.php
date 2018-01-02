<?php

add_filter('the_content', 'ptm_drip_content_filter');
add_filter('the_content', 'ptm_expired_content_filter');
		
function ptm_protect_contents() {
	global $post;

	if ( !is_singular() )
		return;

	$protected = ptm_is_protected( $post->ID );
	
	if ( !$protected )
		return;

	if ( is_singular() ) {
		global $integrate_options;

		foreach ( $integrate_options as $value ) {
			$$value['id'] = $value['value'];
		}

		$protect = get_post_meta( $post->ID, 'pt_protect_content', true );
			
		if ( !is_user_logged_in() ) {
			if ( $post->ID != $pt_member_login_page ) {
				$login_page = ( $pt_member_login_page != '' ) ? get_permalink( $pt_member_login_page ) : get_bloginfo('wpurl') . '/wp-login.php';
						
				wp_redirect( $login_page );
				exit;
			}
		}
		
		global $current_user;
		get_currentuserinfo();
			
		$granted = ptm_is_access_granted( $current_user->ID, $protect );
			
		if ( !$granted ) {
				
			$access_error_page = ( $pt_member_error_page != '' ) ? get_permalink( $pt_member_error_page ) : get_bloginfo('siteurl');
			wp_redirect( $access_error_page );
			exit;
		}

		$drip = ptm_get_drip_status();

		if ( !$drip['view'] ) {
			$drip_error_page = ( $pt_member_drip_error_page != '' ) ? get_permalink( $pt_member_drip_error_page ) : get_bloginfo('siteurl');
			ptm_redirect( $drip_error_page, 'available=' . str_replace(' ', '_', $drip['available']) );
			exit;
		}

		if ( $drip['expire'] ) {
			$drip_error_page = ( $pt_member_expire_error_page != '' ) ? get_permalink( $pt_member_expire_error_page ) : get_bloginfo('siteurl');
			ptm_redirect( $drip_error_page, 'expire=true');
			exit;
		}
	}
}

function ptm_redirect( $url, $query = '') {
	$permalink = get_option('permalink_structure');
	
	if ( $query != '' ) {
		$query_str = ( $permalink == '' ) ? '&' . $query : '?' . $query;
		wp_redirect( $url . $query_str );
	} else {
		wp_redirect( $url );
	}
}

function ptm_get_drip_status() {
	global $post, $current_user;
	get_currentuserinfo();

	$protected = ptm_is_protected( $post->ID );

	$meta = get_post_meta( $post->ID, 'pt_drip_data', true );
	
	$user_age    = floor((strtotime("now") - strtotime( $current_user->user_registered )) / (60 * 60 * 24));
	$user_age    = $user_age + 1;

	$start_day   = $meta['drip_start'];
	$end_day     = $meta['drip_end'];
		
	$view      = ($user_age >= $start_day) ? true : false;
	$expire    = ($user_age >= $end_day) ? true : false;

	$in_days = $start_day - $user_age;
	$count_days = ($in_days > 1 ) ? $in_days . ' days' : $in_days . ' day';
		
	return array( 'view' => $view, 'expire' => $expire, 'age' => $user_age, 'available' => $count_days );
}

function ptm_drip_content_filter($content) {
	if (isset($_GET['available'])){
		$available = '<div class="success-msg" style="margin:10px 0;"><p><strong>This content will be available in ' . str_replace('_', ' ', $_GET['available']) . '. Please check again later.</strong></p></div>';
		$content  .= $available;
	}
	
	return $content;
}

function ptm_expired_content_filter( $content) {
	if(isset($_GET['expire'])){
		$available = '<div class="error-msg" style="margin:10px 0;"><p><strong>Content Expired: You no longer can view the content of this page.</strong></p></div>';
		$content  .= $available;
	}

	return $content;
}

function ptm_is_access_granted( $user_id, $levels ) {
	$user_levels = ptm_get_access_levels( $user_id );
	arsort($user_levels);

	$granted = false;
	
	if ( $user_levels ) {
		foreach( $user_levels as $user_level ) {
			if ( in_array ( $user_level, $levels ) ) {
				$granted = true;
				break;
			}
		}
	}

	return $granted;
}

function ptm_get_access_levels( $user_id ) {
	global $wpdb;

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT product_id FROM `$product_table` ORDER BY product_id ASC" );

	$levels = array();
	
	foreach ( $products as $product ) {
		$level = ptm_has_valid_access( $user_id, $product->product_id );
		if ( $level ) {
			$levels[] = $product->product_id;
		}
	}

	return $levels;
}

function ptm_has_valid_access( $user_id, $level ) {
	$level = get_user_meta( $user_id, 'pt_level_' . $level, true);
	$access = false;

	if ( $level == 'true' ) {
		$access = true;	
	} else {
		$access = false;
	}

	return $access;
}

function ptm_is_protected( $post_id ) {
	$products = ptm_get_product_id();

	$i = 0;

	if ( !is_array( $products ) )
		return false;

	if ( count( $products ) < 1 )
		return false;

	foreach ( $products as $product ) {
		$protect = get_post_meta( $post_id, 'pt_protect_content', true );
			
		if ( is_array($protect) && count($protect) > 0 ) {
			if ( count( $protect ) == 1 && $protect[0] != '' ) {
				$i = 1;
				break;
			} else if ( count( $protect ) > 1 ) {
				$i = 1;
				break;
			}
		}
	}

	if ( $i == 1 )
		return true;
	else
		return false;
}

function ptm_get_product_id() {
	global $wpdb;

	$product_table = $wpdb->prefix . 'ptmembership_products';
	$products = $wpdb->get_results( "SELECT product_id FROM `$product_table` ORDER BY product_id ASC" );
	
	if ( $products ) {
		$p_id = array();
		foreach ( $products as $product ) {
			$p_id[] = $product->product_id;
		}
		
		$lists = $p_id;
	} else {
		$lists = '';
	}

	return $lists;
}


function ptm_redirect_to_paypal() 
{
	global $wpdb, $pt_paypal_email, $pt_paypal_sandbox;

	if ( isset( $_GET['mode'] ) && $_GET['mode'] == 'paypal' && isset( $_GET['itemID'] ) ) {
		$itemID = $_GET['itemID'];

		$product_table = $wpdb->prefix . 'ptmembership_products';
		$product = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_id = '" . $_GET['itemID'] . "'" );
		$paypal  = $product[0];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>Please Wait...</title>

<style type="text/css">
body {
	margin:0;
	padding:0;
	background:#F5F5F5;
}

</style>
</head>

<body>
<div style="width:480px;margin:40px auto;padding:10px 20px;border:1px solid #ccc;background:#FFF;">
<p style="text-align:center;"><strong>Please Wait...</strong></p>
<p style="text-align:center;">You are being transferred to Paypal SECURE PAYMENT PAGE</p>
<p style="text-align:center;"><img src="<?php echo get_bloginfo('template_url'); ?>/images/horizontal_solution_PPeCheck.gif" border="0" /></p>
<p style="text-align:center;color:#808080;"><small>Remember to click <b>RETURN TO MERCHANT</b> after checkout to complete your order.</small></p>
</div>
<?php
$actionurl = ( $pt_paypal_sandbox == 'true' ) ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';
$cmd = ( $paypal->pypl_payment_type == 'single' ) ? '_xclick' : '_xclick-subscriptions';
$bn  = ( $paypal->pypl_payment_type == 'single' ) ? 'ProfitsTheme_BuyNow_WPS_US' : 'ProfitsTheme_Subscribe_WPS_US';

echo '<form action="' . $actionurl . '" method="post" id="paymentform">';
echo '<input type="hidden" name="cmd" value="' . $cmd . '">';
echo '<input type="hidden" name="business" value="' . $pt_paypal_email . '">';
echo '<input type="hidden" name="item_name" value="' . $paypal->product_title . '">';
echo '<input type="hidden" name="item_number" value="' . $paypal->product_number . '">';

if ( $paypal->pypl_payment_type == 'subscription' ) {

	if ( $paypal->pypl_trial_duration > 0 ) {
		$trial_price = ( $paypal->pypl_trial_price == '0.00' && $paypal->pypl_trial_duration > 0 ) ? 0 : $paypal->pypl_trial_price;

		echo '<input type="hidden" name="a1" value="' . $trial_price . '">';
		echo '<input type="hidden" name="p1" value="' . $paypal->pypl_trial_duration . '">';
		echo '<input type="hidden" name="t1" value="' . $paypal->pypl_trial_duration_mode . '">';
	} 
	
	echo '<input type="hidden" name="a3" value="' . $paypal->product_price . '">';
	echo '<input type="hidden" name="p3" value="' . $paypal->pypl_subs_duration . '">';
	echo '<input type="hidden" name="t3" value="' . $paypal->pypl_subs_duration_mode . '">';
	echo '<input type="hidden" name="sra" value="1">';
	echo '<input type="hidden" name="src" value="1">';

	if ( $paypal->pypl_recur_times != 0 ) {
		echo '<input type="hidden" name="srt" value="' . $paypal->pypl_recur_times . '">';
	}
	
} else {
	echo '<input type="hidden" name="amount" value="' . $paypal->product_price . '">';
}

echo '<input type="hidden" name="no_shipping" value="1">';
echo '<input type="hidden" name="return" value="' . get_permalink( $paypal->pypl_return_page ) . '">';
echo '<input type="hidden" name="cancel_return" value="' . get_permalink( $paypal->pypl_cancel_page ) . '">';
echo '<input type="hidden" name="no_note" value="1">';
echo '<input type="hidden" name="shipping" value="0.00">';
echo '<input type="hidden" name="currency_code" value="' . $paypal->pypl_currency . '">';
echo '<input type="hidden" name="lc" value="US">';
echo '<input type="hidden" name="bn" value="' . $bn . '">';
echo '<input type="hidden" name="rm" value="2">';

echo '<input type="hidden" name="notify_url" value="' . trailingslashit(get_bloginfo('wpurl')) . '?mode=paypal&process=payment">';
echo '</form>';
?>

<script type="text/javascript">
	setTimeout('redir()', 2000);
  	function redir(){
        	document.getElementById('paymentform').submit();
      	}
</script>

</body>
</html>

<?php
		exit;
	}
}

function ptm_free_register() {
	if ( isset( $_GET['mode'] ) && $_GET['mode'] == 'register' && isset( $_GET['type'] ) && $_GET['type'] == 'quick' ) {
		if ( isset( $_POST ) ) {
			
			global $wpdb, $integrate_options;

			foreach ( $integrate_options as $value ) {
				$$value['id'] = $value['value'];
			}

			require_once(ABSPATH . WPINC . '/pluggable.php' );

			$product_id   = $_POST['product_id'];
			$return_url   = base64_decode($_POST['success_url']);

			if ( isset($_POST['member_name']) ) {
				$first_name   = $_POST['member_name'];
				$ar_name      = $first_name;
			} else {
				$f_name       = explode("@", $_POST['member_email']);
				$first_name   = $f_name[0];
				$ar_name      = '-';
			}

			$user_name    = sanitize_user( $_POST['member_email'] );
			$user_id      = username_exists( $user_name );

			// validate email
			if( !filter_var($_POST['member_email'], FILTER_VALIDATE_EMAIL) ) {
  				echo "<script>alert('You have entered an invalid email address.');\nhistory.back(-1);\n</script>";
				exit;
			}

			$product_table = $wpdb->prefix . 'ptmembership_products';
			$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_id = '" . $product_id . "'" );
			$product_name = ( count($products) > 0 ) ? $products[0]->product_title : '';

			if ( $products[0]->ar_enable == 'yes' ) {

				$list_name = trim($products[0]->ar_list_name);
				$ar_account = $products[0]->ar_account;

				switch ( $ar_account ) {
					case 'aw':
						ptm_subscribe_to_aw( $list_name, $ar_name, $_POST['member_email'] );
					break;

					case 'gr':
						$api_key = trim($products[0]->ar_gr_api);
						ptm_subscribe_to_gr( $api_key, $list_name, $ar_name, $_POST['member_email'], 'register' );
					break;
					
					case 'mc':
						$apikey = trim($products[0]->ar_mc_api);
						ptm_subscribe_to_mc( $apikey, $list_name, $ar_name, $_POST['member_email'], 'register' );
					break;
				}
			}

			if ( !$user_id ) {

				$password  = wp_generate_password(8, false);
				$user_id   = wp_create_user( $user_name, $password, $_POST['member_email'] );

				update_user_meta( $user_id, 'first_name', $first_name );
				update_user_meta( $user_id, 'pt_level_' . $product_id, 'true' );
				
				$email    = $_POST['member_email'];
				$username = $user_name;
				$pass     = $password;


			} else {

				$user_info = get_userdata($user_id);

				$meta = get_user_meta( $user_id, 'pt_level_' . $product_id, 'true' );
				
				if ( !$meta ) {
					update_user_meta( $user_id, 'pt_level_' . $product_id, 'true' );

					$email     = $user_info->user_email;
					$username  = $user_info->user_login;
					$pass      = '- your chosen password -';
				} else {
					echo "<script>alert('Email already registered. Please use another email address.');\nhistory.back(-1);\n</script>";
					exit;
				}
			}

			$login_url = ( $pt_member_login_page != '' ) ? get_permalink($pt_member_login_page) : get_bloginfo('wpurl') . '/wp-login.php';

			$title = $pt_member_email_title;
			$body  = $pt_member_email_body;

			$title = str_replace('[%product_title%]', $product_name, $title);
			$title = str_replace('[%first_name%]', $first_name, $title);
			$title = str_replace('[%last_name%]', '', $title);

			$body  = str_replace('[%product_title%]', $product_name, $body);
			$body  = str_replace('[%receipt%]', '', $body);
			$body  = str_replace('[%first_name%]', $first_name, $body);
			$body  = str_replace('[%last_name%]', '', $body);
			$body  = str_replace('[%user_name%]', $username, $body);
			$body  = str_replace('[%password%]', $pass, $body);
			$body = str_replace('[%login_url%]', $login_url, $body);

			// send email to user
			$headers = 'From: ' . $pt_member_email_from . ' <' . get_option('admin_email') . '>' . "\r\nContent-Type: text/plain; charset=utf-8";
			@wp_mail( $email, $title, $body, $headers );

			wp_redirect( $return_url);
			exit;
		}
	}
}

function ptm_subscribe_to_aw( $list, $first_name, $email )
{
	require_once PT_LIB.'/api/aweber/aweber_api.php';
			
	$pt_integrate_options = maybe_unserialize(get_option('pt_integrate_options'));
	foreach ( $pt_integrate_options as $row) {
		if ($row['id'] == 'pt_aweber_key' || $row['id'] == 'pt_aweber_secret')
			$$row['id'] = $row['value'];
	}
	
	$xconfig = array('aw_key' => $pt_aweber_key,
					'aw_secret' => $pt_aweber_secret);
					
	$token = get_option('pt_aweber_token');
	
	$aweber = new AWeberAPI(trim($xconfig['aw_key']), trim($xconfig['aw_secret']));
	
	$account = $aweber->getAccount($token['accessToken'], $token['accessTokenSecret']);
	$list = $account->loadFromUrl("/accounts/{$token['accountID']}/lists/{$list}");

    // create a subscriber
    $params = array(
        'email' => $email,
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'ad_tracking' => 'profitstheme',
        'misc_notes' => 'Profits Theme',
        'name' => pt_isset($first_name, 'Unknown')
    );

    $subscribers = $list->subscribers;
    try {
    	$subscribers->create($params);
    	return true;
    }catch(AWeberAPIException $exc) {
       	return false;
    }
}

function ptm_subscribe_to_mc( $apikey, $listID, $first_name, $email, $mode = 'register' )
{
	require_once(TEMPLATEPATH . '/lib/api/MCAPI.class.php' );
					
	$api = new MCAPI($apikey);

	$merge_vars = array(
			'FNAME' => $first_name,
			'OPTIN_TIME' => date("Y-M-D H:i:s")
		);

	// subscribe user to mail chimp
	$retval = $api->listSubscribe( $listID, $email, $merge_vars );

	if ( $api->errorCode ) {
		if ( $mode == 'register' ) {
			echo "<script>alert('" . $api->errorMessage .  ".');\nhistory.back(-1);\n</script>";
			exit;
		}
	}
}

function ptm_subscribe_to_gr( $api_key, $list_name, $first_name, $email, $mode = 'register' )
{
	require_once(TEMPLATEPATH . '/lib/api/jsonRPCClient.php' );

	$api_url = 'http://api2.getresponse.com';
	$client = new jsonRPCClient($api_url);
	$result = NULL;
	
	$first_name = trim($first_name);
	
	if($first_name == ''){
		$temp = explode('@', $email);
		$first_name = $temp[0]; 
	}
	
	try {
    		$result = $client->get_campaigns(
        			$api_key,
        			array (
            				'name' => array ( 'EQUALS' => $list_name )
        			)
    		);
	} catch (Exception $e) {
		if ( $mode == 'register' ) {
	    		echo "<script>alert('" . $e->getMessage() . "');\nhistory.back(-1);\n</script>";
			exit;
		} else {
			return false;
		}
	}

	$keys = array_keys($result);
	$CAMPAIGN_ID = array_pop($keys);

	try {
	    	$result = $client->add_contact(
        		$api_key,
        		array (
            			'campaign'  => $CAMPAIGN_ID,
            			'name'      => $first_name,
            			'email'     => $email,
            			'cycle_day' => '0',
        		)
    		);
					
	} catch (Exception $e) {
    	if ( $mode == 'register' ) {
	    		echo "<script>alert('" . pt_errorHandling($e->getMessage()) . "');\nhistory.back(-1);\n</script>";
			exit;
		} else {
			return false;
		}
	}

}

function pt_errorHandling($message){
	$message = str_replace('Request have return error: ', '', $message);
	$message = substr($message, 0, strpos($message, ';'));
	
	return $message;
}

function ptm_update_user()
{
	if ( isset($_GET['mode']) && $_GET['mode'] == 'membership' && isset($_GET['process']) && $_GET['process'] == 'update_user' ) {
		if ( isset( $_POST ) ) {
			$userdata['ID'] = $_POST['user_id'];
			$userdata['user_email'] = $_POST['user_email'];
			$userdata['first_name'] = $_POST['first_name'];
			$userdata['last_name'] = $_POST['last_name'];

			if ( $userdata['user_email'] == '' ) {
				echo "<script>alert('Please type your email address.');\nhistory.back(-1);</script>";
				exit;
			}

			if ( $_POST['pass1'] != '' ) {
				if ( $_POST['pass1'] != $_POST['pass2'] ) {
					echo "<script>alert('Password mismatch.');\nhistory.back(-1);</script>";
					exit;
				}

				$userdata['user_pass'] = $_POST['pass1'];
			}
	
			$chk_email = ptm_check_email( $userdata['user_email'] );

			if ( !$chk_email ) {
				echo "<script>alert('Please enter a valid email address.');\nhistory.back(-1);</script>";
				exit;
			}
			

			$update_user = wp_update_user($userdata);

			if ( is_wp_error($update_user) ) {
				wp_die($update_user);
				
			}

			$query_string = ( get_option('permalink_structure') == '' ) ? '&updated=true' : '?updated=true';
			wp_redirect( $_POST['redirect_url'] . $query_string );
		
		}
		exit;
	}
}

function ptm_check_email( $email )
{
	if ( !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$" , $email)) {
  		return false;
 	}
 
	return true;
}

function ptm_login_style()
{
	global $pt_membership_custom_logo;

	$logo   = $pt_membership_custom_logo;
	$width  = 1;
	$height = 75;
	
	if ( $logo != '' ) {
		$l_size = str_replace( get_bloginfo('wpurl'), ABSPATH, $logo );
		if ( file_exists($l_size) ) { 
			$size   = getimagesize($l_size);
			$width  = $size[0] + 15;
			$height = $size[1];
		}
	}

echo "
<style type='text/css'>
div#login h1 a { background:url('{$logo}') no-repeat top left; width:{$width}px; height:{$height}px; display:block; margin-left:auto; margin-right:auto; }
</style>
";

}

function ptm_login_header_url( $url = '' )
{
	// $url = get_bloginfo('siteurl');
    $url = get_option('url');

	return $url;	
}

function ptm_login_header_title( $title = '' )
{
	$title = 'Powered by Profits Theme';

	return $title;	
}

function ptm_filter_posts( $content )
{
	global $wpdb, $pt_protect_tease, $current_user;
	get_currentuserinfo();
	
	if ( is_admin() ) return $content;

	if ( is_single() || is_page() ) return $content;
	
	if ( $pt_protect_tease == 'true' ) return $content;

	$posts = $wpdb->get_results( "SELECT ID FROM {$wpdb->posts} WHERE post_status = 'publish'" );
	
	if ( count($posts) <= 0 ) return $content;

	$ex_posts = array();
	foreach ( $posts as $post ) {
		$protected = ptm_is_protected( $post->ID );

		if ( $protected ) {
			$protect = get_post_meta( $post->ID, 'pt_protect_content', true );
			$granted = ptm_is_access_granted( $current_user->ID, $protect );			
			if ( !$granted ) {
				$ex_posts[] = $post->ID;
			}
		}		
	}

	$content->query_vars['post__not_in'] = $ex_posts;
}

function ptm_filter_content_teaser( $post_content )
{
	global $post, $pt_post_excerpt, $pt_archive_excerpt, $pt_read_more_text, $current_user;
	get_currentuserinfo();

	if ( is_page() || is_single() ) return $post_content;
	
	if ( is_home() && $pt_post_excerpt == 'true' || is_archive() && $pt_archive_excerpt == 'true' ) {
		return $post_content;
	}

	$protected = ptm_is_protected( $post->ID );

	if ( !$protected ) return $post_content;

	$protect = get_post_meta( $post->ID, 'pt_protect_content', true );
	$granted = ptm_is_access_granted( $current_user->ID, $protect );

	if ( $granted ) return $post_content;
		
	$post_content  = pt_excerpt( $post_content, 280 );
	$post_content .= '<p><a href="' . get_permalink($post->ID) . '" class="more-link">' . $pt_read_more_text . '</a></p>';

	return $post_content;
}

function ptm_login_redirection( $username = FALSE )
{
	global $pt_member_login_redirect;

	remove_all_filters ("login_redirect");
	if ( $username && is_object ($user = new WP_User ($username)) && ($user_id = $user->ID) && (!$user->has_cap ("edit_posts"))) {
		if (!$_REQUEST["redirect_to"] || $_REQUEST["redirect_to"] === "wp-admin/" || $_REQUEST["redirect_to"] === admin_url ()) {
			$login_url = ( $pt_member_login_redirect != '' ) ? get_permalink($pt_member_login_redirect) : get_bloginfo('siteurl');

			wp_redirect($login_url);
			die;
		}
	}
}

function ptm_logout_redirection()
{
	global $pt_member_logout_redirect, $current_user;

	remove_all_filters ("login_redirect");
	if ( !current_user_can('edit_posts') ) {
		if ( $pt_member_logout_redirect != '' ) {
			wp_redirect(get_permalink($pt_member_logout_redirect));
			die;
		}
	}

}

if ( $pt_integrate_membership != 'dap' && $pt_integrate_membership != 'wishlist' ) {

	// Membership Hooks Start
	add_action( 'template_redirect', 'ptm_protect_contents', 10 );

	add_filter( 'pre_get_posts', 'ptm_filter_posts', 100 );
	add_filter( 'the_content', 'ptm_filter_content_teaser', 100 );

	add_action( 'init', 'ptm_redirect_to_paypal' );
	add_action( 'init', 'ptm_free_register' );
	add_action( 'init', 'ptm_update_user' );

	add_action( 'wp_login', 'ptm_login_redirection' );
	add_action( 'wp_logout', 'ptm_logout_redirection' );
}

add_filter( 'login_headerurl', 'ptm_login_header_url' );
add_filter( 'login_headertitle', 'ptm_login_header_title' );
add_action( 'login_head', 'ptm_login_style' );
