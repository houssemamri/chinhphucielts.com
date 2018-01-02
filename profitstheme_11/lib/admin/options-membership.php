<?php

//////////////////////////////////
// Membership Integration Options
//////////////////////////////////

$reg_email_body  = 'Hi [%first_name%],

Welcome to [%product_title%].
Your account has now been activated.

You may now access your content by
logging in to your account at:

[%login_url%]
Username: [%user_name%]
Password: [%password%]

If you have any questions or concerns,
feel free to contact our support ticket:
YOUR_SUPPORT_TICKET_URL

YOUR_NAME';

$pp_currency = array(   
			'USD' => 'USD', 'GBP' => 'GBP', 'AUD' => 'AUD', 'EUR' => 'EUR',
			'BRL' => 'BRL', 'CAD' => 'CAD', 'CZK' => 'CZK', 'DKK' => 'DKK',
			'ILS' => 'ILS', 'JPY' => 'JPY', 'MYR' => 'MYR', 'HKD' => 'HKD',
			'HUF' => 'HUF', 'MXN' => 'MXN', 'NOK' => 'NOK', 'NZD' => 'NZD',
			'PHP' => 'PHP', 'SGD' => 'SGD', 'SEK' => 'SEK', 'CHF' => 'CHF',
			'TWD' => 'TWD', 'THB' => 'THB'
		);

$pt_integrate_options   = array();

$pt_integrate_options[] = array(
				'name' => 'Integration Tab open',
				'id' => 'integrate',
				'type' => 'tabopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Integration Settings',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Membership Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Choose Membership Plugin',
				'std' => 'pt',
				'desc' => 'You can use Profits Theme built-in membership plugin, or integrate with other plugins (with <em>Wishlist</em> and <em>DAP</em> only).',
				'options' => array(
					'pt' => 'Profits Theme',
					'dap' => 'Digital Access Pass',
					'wishlist' => 'Wishlist Member',
				),
				'id' => $shortname . '_integrate_membership',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'Membership Close',
				'type' => 'blockclose'
			);


$pt_integrate_options[] = array(
				'id' => 'membership-div-open',
				'type' => 'divwrapopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Membership Pages Setup',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Members Pages Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Login Page',
				'std' => '',
				'desc' => 'Please specify the login page for members.',
				'options' => $pt_pages,
				'id' => $shortname . '_member_login_page',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'After Login / Welcome Page',
				'std' => '',
				'desc' => 'Where you want to redirect members right after they\'re logged in (e.g. membership home or dashboard).',
				'options' => $pt_pages,
				'id' => $shortname . '_member_login_redirect',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'Logout Page',
				'std' => '',
				'desc' => 'Where you want to redirect members after they\'re logged out.',
				'options' => $pt_pages,
				'id' => $shortname . '_member_logout_redirect',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'Access Error Page',
				'std' => '',
				'desc' => 'Where you want to redirect members if they have insufficient access to certain products/levels.',
				'options' => $pt_pages,
				'id' => $shortname . '_member_error_page',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'Content Unavailable Error Page',
				'std' => '',
				'desc' => 'Where you want to redirect members if the content they\'re trying to access is unavailable.',
				'options' => $pt_pages,
				'id' => $shortname . '_member_drip_error_page',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'Content Expired Error Page',
				'std' => '',
				'desc' => 'Where you want to redirect members if the content they\'re trying to access is expired.',
				'options' => $pt_pages,
				'id' => $shortname . '_member_expire_error_page',
				'type' => 'select'
			);

$pt_integrate_options[] = array(
				'name' => 'Members Pages Close',
				'type' => 'blockclose'
			);

$pt_integrate_options[] = array(
				'name' => 'Thank You Email Setup',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Thank You Email Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Thank You Email Note',
				'desc' => '<strong>Note:</strong> The Thank You email below will be sent after someone has successfully signed up for your membership site. You can edit the thank you email settings below:',
				'id' => $shortname . '_member_email_note',
				'type' => 'note'
			);

$pt_integrate_options[] = array(
				'name' => 'From Name/Sender',
				'std' => get_bloginfo('name'),
				'desc' => 'Type the name whom you want to display in the "From Name" field of the \'Thank You\' email so your customers can recognize where the email is coming from.',
				'id' => $shortname . '_member_email_from',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Thank You Email Subject',
				'std' => 'Thank You For Ordering [%product_title%]',
				'desc' => 'Email subject for the thank you email.<br /><br /><strong>The following macros are supported:</strong>[%product_title%] - Product Title<br />[%first_name%] - Cust. First Name<br />[%last_name%] - Cust. Last Name',
				'id' => $shortname . '_member_email_title',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Thank You Email Body',
				'std' => $reg_email_body,
				'desc' => 'Email body for the thank you email (please edit the ALL CAPS text and the URL to your login page).<br /><br /><strong>The following macros are supported:</strong>[%product_title%] - Product Title<br />[%receipt%] - Receipt Number<br />[%login_url%] - Members Login URL<br />[%first_name%] - Cust. First Name<br />[%last_name%] - Cust. Last Name<br />[%user_name%] - New Username<br />[%password%] - New Password',
				'id' => $shortname . '_member_email_body',
				'type' => 'textarea',
				'width' => 400,
				'height' => 320,
			);

$pt_integrate_options[] = array(
				'name' => 'Thank You Email Close',
				'type' => 'blockclose'
			);

$pt_integrate_options[] = array(
				'type' => 'divwrapclose'
			);

$pt_integrate_options[] = array(
				'name' => 'Integration Tab close',
				'type' => 'tabclose'
			);

// MANAGE PRODUCTS START HERE

$pt_integrate_options[] = array(
				'name' => 'Products Tab open',
				'id' => 'productlevel',
				'type' => 'tabopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Manage Products / Membership Levels',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Show Products',
				'id' => $shortname . '_show_products',
				'type' => 'showproducts'
			);

$pt_integrate_options[] = array(
				'name' => 'Add New Product',
				'std' => '',
				'desc' => '',
				'options' => array(
						'item_currency' => $pp_currency,
						'item_pages' => $pt_pages,
						'ar_lists' => array(
							'aw' => 'Aweber',
							'gr' => 'GetResponse',
							'mc' => 'Mail Chimp',
						),
					),
				'id' => $shortname . '_add_product',
				'type' => 'productform'
			);

$pt_integrate_options[] = array(
				'name' => 'Products Tab Close',
				'type' => 'tabclose'
			);

// CONTENTS PROTECTION START HERE

$pt_integrate_options[] = array(
				'name' => 'Contents Tab open',
				'id' => 'contentsprotect',
				'type' => 'tabopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Contents Protection',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Contents Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Select Product / Level',
				'std' => '',
				'desc' => 'Choose a product / membership level first, then select pages that you want to protect from public viewing.',
				'id' => $shortname . '_protect_level',
				'options' => pt_get_products(),
				'type' => 'protectlevel'
			);

$pt_integrate_options[] = array(
				'name' => 'Enable <em>Non-Members</em> to view the <strong>Title and/or Excerpt</em></strong> of protected contents.',
				'std' => '',
				'id' => $shortname . '_protect_tease',
				'type' => 'checkbox'
			);

$pt_integrate_options[] = array(
				'name' => 'Contents Close',
				'type' => 'blockclose'
			);

$pt_integrate_options[] = array(
				'name' => 'Contents Protection',
				'std' => '',
				'desc' => '',
				'options' => pt_get_members_pages(),
				'id' => $shortname . '_protect_pages',
				'type' => 'protectpages'
			);

$pt_integrate_options[] = array(
				'name' => 'Contents Tab Close',
				'type' => 'tabclose'
			);

// DOWNLOAD PROTECTIONS START HERE

$pt_integrate_options[] = array(
				'name' => 'Download Tab open',
				'id' => 'filedownload',
				'type' => 'tabopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Protected Directories',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Download Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Directory Name For Free Products',
				'std' => 'free-downloads',
				'desc' => 'Specify a directory name for your free products that you want to protect (must be inside the /wp-content/uploads/" folder). If the folder you specify does not exist, then PT will create it.',
				'prefix' => '<span class="normal-font">'.get_bloginfo('wpurl') . '/wp-content/uploads/</span>',
				'suffix' => '<span>/</span>',
				'id' => $shortname . '_member_free_folder',
				'width' => '100',
				'type' => 'folder'
			);

$pt_integrate_options[] = array(
				'name' => 'Directory Name For Paid Products',
				'std' => 'downloads',
				'desc' => 'Specify a directory name for your paid products that you want to protect (must be inside the /wp-content/uploads/" folder). If the directory you specify does not exist, then PT will create it.',
				'prefix' => '<span class="normal-font">'.get_bloginfo('wpurl') . '/wp-content/uploads/</span>',
				'suffix' => '<span>/</span>',
				'id' => $shortname . '_member_folder',
				'width' => '100',
				'type' => 'folder'
			);

$pt_integrate_options[] = array(
				'name' => 'Download Close',
				'type' => 'blockclose'
			);

$pt_integrate_options[] = array(
				'name' => 'Download Tab Close',
				'type' => 'tabclose'
			);

// PAYMENT INTEGRATION START HERE

$pt_integrate_options[] = array(
				'name' => 'Payment Tab open',
				'id' => 'payments',
				'type' => 'tabopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Zaxaa Setup',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Zaxaa Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Zaxaa API Signature',
				'std' => '',
				'desc' => 'Enter your Zaxaa API signature here.<br /><br />To obtain your Zaxaa API Signature, simply <a href="https://www.zaxaa.com/settings/account" target="_blank">click here</a> (you may need to login), and click the <code>API Signature</code> button.',
				'id' => $shortname . '_zaxaa_api',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Zaxaa Close',
				'type' => 'blockclose'
			);
			
$pt_integrate_options[] = array(
				'name' => 'Clickbank Setup',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Clickbank Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Clickbank Secret Key',
				'std' => pt_cb_secret_key(),
				'desc' => '<strong><u>Integrating CB Secret Key:</u></strong><br /><strong>Step 1:</strong> Login to your Clickbank account and go to <em>Account Settings -> My Site -> Advanced Tools</em> and click "Edit".<br /><br /><strong>Step 2: </strong>Paste the value from this field into the "Secret Key" field in your Clickbank account.',
				'id' => $shortname . '_cb_secret_key',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Clickbank IPN URL',
				'std' => trailingslashit(get_bloginfo('url')) . '?mode=clickbank&process=payment',
				'desc' => ' Copy the Clickbank IPN URL from the field, then login to your Clickbank account and go to <em>Account Settings -> My Site -> Advanced Tools</em>. Paste the URL on the <em>Instant Notification URL</em> field and select <em>Version 2.1</em>.',
				'id' => $shortname . '_cb_ipn_url',
				'type' => 'textarea',
				'mode' => 'readonly',
			);

$pt_integrate_options[] = array(
				'name' => 'Clickbank Close',
				'type' => 'blockclose'
			);

$pt_integrate_options[] = array(
				'name' => 'Paypal Setup',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Paypal Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Paypal Email Address',
				'std' => '',
				'desc' => 'Your Paypal account PRIMARY email address.',
				'id' => $shortname . '_paypal_email',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Enable Paypal Sandbox Mode',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_paypal_sandbox',
				'type' => 'checkbox'
			);

$pt_integrate_options[] = array(
				'name' => 'Paypal Close',
				'type' => 'blockclose'
			);
			
$pt_integrate_options[] = array(
				'name' => 'JVZoo Setup',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'JVZoo Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'JVZIPN Secret Key',
				'std' => pt_cb_secret_key(),
				'desc' => '<strong><u>Integrating JVZoo Secret Key:</u></strong><br /><strong>Step 1:</strong> Login to your JVZoo account and go to <em>My Account -> Personal Information -> JVZIPN Secret Key</em> and click on the edit link.<br /><br /><strong>Step 2: </strong>Paste the value from this field into the "JVZIPN Secret Key" field in your JVZoo account.',
				'id' => $shortname . '_jvzoo_secret_key',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'JVZoo Close',
				'type' => 'blockclose'
			);
			
$pt_integrate_options[] = array(
				'name' => 'Payment Tab Close',
				'type' => 'tabclose'
			);

// AWEBER INTEGRATION START HERE

$pt_integrate_options[] = array(
				'name' => 'Aweber Tab open',
				'id' => 'aweber',
				'type' => 'tabopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Aweber Integration',
				'type' => 'biglabel'
			);

$pt_integrate_options[] = array(
				'name' => 'Aweber Open',
				'type' => 'blockopen'
			);

$pt_integrate_options[] = array(
				'name' => 'Aweber Note',
				'desc' => 'Please <a href="http://www.getprofitsfast.com/member/profits-theme/?page_id=1259" target="_blank">click here</a> to learn how to integrate Aweber.',
				'id' => $shortname . '_aweber_note',
				'type' => 'note'
			);
			
$pt_integrate_options[] = array(
				'name' => 'Consumer Key',
				'std' => '',
				'desc' => 'Please enter your Aweber\'s application Consumer Key.',
				'id' => $shortname . '_aweber_key',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Consumer Secret',
				'std' => '',
				'desc' => 'Please enter your Aweber\'s application Consumer Secret.',
				'id' => $shortname . '_aweber_secret',
				'type' => 'text'
			);

$pt_integrate_options[] = array(
				'name' => 'Aweber Note',
				'desc' => '<a href="'.admin_url('admin.php?page=pt_integrate_options&disconnect=aweber').'">Click here</a> to disconnect your aweber account with Profits Theme.',
				'id' => $shortname . '_aweber_note',
				'type' => 'note'
			);
			
$pt_integrate_options[] = array(
				'name' => 'Aweber Close',
				'type' => 'blockclose'
			);
			
$pt_integrate_options[] = array(
				'name' => 'Aweber Tab Close',
				'type' => 'tabclose'
			);

$pt_integrate_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_integrate_options[] = array(
				'name' => 'Integration Action',
				'std' => 'save',
				'id' => 'action',
				'type' => 'hidden'
			);