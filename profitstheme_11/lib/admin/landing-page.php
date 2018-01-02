<?php

$pt_fonts = new PtFonts;

$chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
$xid = '';
		
for ($i = 0; $i < 15; $i++) {
	$xid .= $chars[mt_rand(0, count($chars)-1)];
}

$custom_menu = pt_nav_menu( array('remove navigation') );
$footer_menu = pt_nav_menu( array('use blog setting', 'remove navigation') );

$pt_video_player = ( get_option('jw_player_location') != '' || function_exists( 'jwplayer_plugin_menu' ) || function_exists('jwp6_l') ) ? array( 'flow' => 'Flowplayer', 'jw' => 'JW Player', 'html5' => 'HTML5 (advanced users only)' ) : array( 'flow' => 'Flowplayer', 'html5' => 'HTML5 (advanced users only)' );
$pt_jw_info      = ( get_option('jw_player_location') != '' || function_exists( 'jwplayer_plugin_menu' ) || function_exists('jwp6_l') ) ? '' : '<br /><br />If you want to use <a href="http://www.longtailvideo.com/players/jw-flv-player" target="_blank">JW Player</a> as the video player, please download it first at <a href="http://www.longtailvideo.com/players/jw-flv-player" target="_blank">http://www.longtailvideo.com</a>, and integrate it with PT in <a href="' . admin_url('admin.php?page=pt_update_options') . '" target="_blank">Profits Theme -> Install/Update</a>. Or, you can simply install <a href="' . admin_url('plugin-install.php?tab=search&type=term&s=JW+Player+For+Wordpress&plugin-search-input=Search+Plugins') . '" target="_blank">JW Player Plugin for WordPress</a>.';

$pt_landing_meta_box = array(
	'landinglayout' => array(
		'name' => 'Customize Landing Page Layout',
		'std' => '',
		'desc' => 'Drag n Drop',
		'id' => 'landing_layout', 
		'type' => 'customlayout',
		'top' => array(
			'lp-headline' => array(
					'name' => 'Headline',
					'id' => 'lp-headline',
				),
			),
		'left' => array(
			'lp-content' => array(
					'name' => 'Main Content',
					'id' => 'lp-content',
					'settings-url' => 'false',
				),
			),
		'right' => array(
			'lp-optin' => array(
					'name' => 'Optin Form',
					'id' => 'lp-optin',
				),
			),
		'bottom' => 'clean',
		'inactive' => array(
			'lp-pre-headline' => array(
					'name' => 'Pre-Headline',
					'id' => 'lp-pre-headline',
				),
			'lp-sub-headline' => array(
					'name' => 'Sub-Headline',
					'id' => 'lp-sub-headline',
				),
			
			'lp-fake-video' => array(
					'name' => 'Fake Video',
					'id' => 'lp-fake-video',
				),
			'lp-warning' => array(
					'name' => 'Optin Warning Sign',
					'id' => 'lp-warning',
				),
			'lp-sidebar' => array(
					'name' => 'Sidebar Widgets',
					'id' => 'lp-sidebar',
				),
			'lp-comments' => array(
					'name' => 'Comments',
					'id' => 'lp-comments',
				),
			'lp-social' => array(
					'name' => 'Social Buttons',
					'id' => 'lp-social',
				),
			'lp-svideo' => array(
					'name' => 'Simple Video',
					'id' => 'lp-svideo',
				),
			'lp-video' => array(
					'name' => 'Advanced Video',
					'id' => 'lp-video',
				),
			'lp-svideo-2' => array(
					'name' => 'Simple Video 2',
					'id' => 'lp-svideo-2',
				),
			'lp-video-2' => array(
					'name' => 'Advanced Video 2',
					'id' => 'lp-video-2',
				),
			'lp-optin-2' => array(
					'name' => 'Optin Form 2',
					'id' => 'lp-optin-2',
				),
			'lp-image' => array(
					'name' => 'Single Image',
					'id' => 'lp-image',
				),
			'lp-order' => array(
					'name' => 'Add To Cart',
					'id' => 'lp-order',
				),
			'lp-image-2' => array(
					'name' => 'Single Image 2',
					'id' => 'lp-image-2',
				),
			'lp-order-2' => array(
					'name' => 'Add To Cart 2',
					'id' => 'lp-order-2',
				),
			'lp-funnel' => array(
					'name' => 'Launch Funnel',
					'id' => 'lp-funnel',
				),
			'lp-register' => array(
					'name' => 'Registration + Optin Form',
					'id' => 'lp-register',
				),
			'lp-script' => array(
					'name' => 'Script',
					'id' => 'lp-script',
				),
		),
		'group' => 'pt_landing_meta_box'		
	),

	'lp-pre' => array(
		'name' => 'Top Column',
		'std' => 'lp-headline/Headline',
		'id' => 'lp-pre',
		'type' => 'hidden',
		'group' => 'pt_landing_meta_box'
	),

	'lp-main' => array(
		'name' => 'Left Column',
		'std' => 'lp-content/Main Content',
		'id' => 'lp-main',
		'type' => 'hidden',
		'group' => 'pt_landing_meta_box'
	),

	'lp-side' => array(
		'name' => 'Side Column',
		'std' => 'lp-optin/Optin Form',
		'id' => 'lp-side',
		'type' => 'hidden',
		'group' => 'pt_landing_meta_box'
	),

	'lp-bottom' => array(
		'name' => 'Bottom Column',
		'std' => 'clean',
		'id' => 'lp-bottom',
		'type' => 'hidden',
		'group' => 'pt_landing_meta_box'
	),

	// Page Settings
	
	'lp-page-wrap-open' => array(
		'name' => 'Page Settings Wrap Open',
		'id' => 'lp-page-open',
		'type' => 'dialogopen',
		'title' => 'Page Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-width' => array(
		'name' => 'Landing Page Width', 
		'std' => '1000',  
		'desc' => 'Main width of your landing page.',
		'id' => 'lp-page-width',
		'type' => 'text',
		'suffix' => ' px',
		'width' => '60px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-right-width' => array(
		'name' => 'Right Column Width', 
		'std' => '300', 
		'desc' => 'You only need this setting if you decide to create a <em>two columns landing page</em>, which include a right column/sidebar.',
		'id' => 'lp-page-right-width',
		'type' => 'text',
		'suffix' => ' px',
		'width' => '60px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-padding' => array(
		'name' => 'Content Padding', 
		'std' => '25',  
		'desc' => 'White spaces around your landing page\'s content.',
		'id' => 'lp-page-padding',
		'type' => 'text',
		'suffix' => ' px',
		'width' => '60px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-custom' => array(
		'name' => 'Landing Page Template', 
		'std' => 'fancy-grey', 
		'desc' => 'Choose a cool template for your landing page.',
		'id' => 'lp-page-custom',
		'type' => 'templates',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-topnav' => array(
		'name' => 'Custom Top Navigation', 
		'std' => 'remove navigation', 
		'desc' => 'Custom menu to show on top navigation (after header). Go to \'Appearance > Menus\' to create/edit menus.',
		'options' => $custom_menu,
		'id' => 'lp-page-topnav',
		'type' => 'selectnav',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-footer-powered' => array(
		'name' => 'Remove "Powered by Profits Theme" text',
		'std' => 'false',
		'id' => 'lp-page-footer-powered',
		'type' => 'checkbox',
		'desc' => 'Remove "Powered by Profits Theme" text',
		'group' => 'pt_landing_meta_box',
	),

	'lp-page-footnav' => array(
		'name' => 'Custom Footer Navigation', 
		'std' => 'use default setting', 
		'desc' => 'Custom menu to show on footer. Go to \'Appearance > Menus\' to create/edit menus.',
		'options' => $footer_menu,
		'id' => 'lp-page-footnav',
		'type' => 'selectnav',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-footer-font' => array(
		'name' => 'Footer Font',
		'std' => 'Verdana, sans-serif',
		'id' => 'lp-page-footer-font',
		'type' => 'font',
		'options' => $pt_fonts->getFonts(),
		'desc' => 'Choose a custom font for the landing page footer.<br /><br /><em>* non web-safe font</em><br /><em>** cufon font</em><br /><em>*** google font</em>',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-page-footer-font-size' => array(
		'name' => 'Footer Font Size',
		'std' => '11',
		'id' => 'lp-page-footer-font-size',
		'type' => 'size',
		'desc' => 'Select the font size for the landing page footer.',
		'group' => 'pt_landing_meta_box',
	),

	'lp-page-upsell' => array(
		'name' => 'Enable One Time View', 
		'std' => 'no', 
		'desc' => 'If you choose "Yes," then each person can only view this page once. You can use this feature for an OTO/Upsell page.',
		'id' => 'lp-page-upsell',
		'options' => array(
				'yes' => 'Yes, make this page a one time view only',
				'no' => 'No, do NOT make this page a one time view only',
			),
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-upsell-redir' => array(
		'name' => 'One Time View Redirect Page', 
		'std' => '', 
		'desc' => 'Where you want to redirect the visitors if they try to view this page for the second time.',
		'id' => 'lp-page-upsell-redir',
		'options' => $pt_pages,
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-page-exit' => array(
		'name' => 'Enable Exit Redirect', 
		'std' => 'false', 
		'desc' => 'Enable Exit Redirect',
		'id' => 'lp-page-exit',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-page-exit-wrap' => array(
		'id' => 'lp-page-exit-wrap',
		'type' => 'divwrapopen',
	),
	
	'lp-page-exit-url' => array(
		'name' => 'Redirect URL', 
		'std' => 'http://',  
		'desc' => 'Type the full URL of the page where visitors will be redirected (must start with http://).',
		'id' => 'lp-page-exit-url',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
	),
	'lp-page-exit-message' => array(
		'name' => 'Alert Message', 
		'std' => 'Free Gift.'."\n\n".'Click "STAY on Page" to get it',  
		'desc' => 'This alert message will be displayed when the visitors close the browser tab or window.',
		'id' => 'lp-page-exit-message',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-page-exit-close' => array(
		'type' => 'divwrapclose',
	),
	
	'lp-page-popup' => array(
		'name' => 'Enable Pop Up Optin', 
		'std' => 'false', 
		'desc' => 'Enable Pop Up Optin',
		'id' => 'lp-page-popup',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-wrap' => array(
		'id' => 'lp-page-pop-wrap',
		'type' => 'divwrapopen',
	),

	'lp-page-pop-width' => array(
		'name' => 'Pop Up Width', 
		'std' => '384',  
		'desc' => 'The width of your Pop Up Optin.',
		'id' => 'lp-page-pop-width',
		'type' => 'text',
		'suffix' => ' px',
		'width' => '60px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-height' => array(
		'name' => 'Pop Up Height', 
		'std' => '408',  
		'desc' => 'The height of your Pop Up Optin.',
		'id' => 'lp-page-pop-height',
		'type' => 'text',
		'suffix' => ' px',
		'width' => '60px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-popup-display' => array(
		'name' => 'Pop Up Visibility', 
		'std' => 'session', 
		'desc' => 'This setting determines whether or not to show ads to returning visitors. Browser session -> If your visitor only closes the tab inside his browser, and then opens your site again -> this is NOT considered as a new browser session. He has to close his browser first, and then visits your site again before being counted as a new browser session.',
		'options' => array(
				'always' => 'Every Time Page Loads',
				'never' => 'First Time Visit Only',
				'session' => 'Once Per Browser Session',
			),
		'id' => 'lp-page-popup-display',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-code' => array(
		'name' => 'Paste Pop Up Autoresponder Code Here', 
		'std' => '',  
		'desc' => 'Please copy a raw autoresponder code from your email provider (e.g. Aweber, Getresponse, Mail Chimp, etc) and paste it here.',
		'id' => 'lp-page-pop-code',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-headline' => array(
		'name' => 'Pop Up Headline', 
		'std' => 'Free Gift!',  
		'desc' => 'Type any headline to get reader\'s attention to subscribe.',
		'id' => 'lp-page-pop-headline',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-headline-font' => array(
		'name' => 'Pop Up Headline Font',
		'std' => 'Impact, Charcoal, sans-serif',
		'id' => 'lp-page-pop-headline-font',
		'type' => 'font',
		'options' => $pt_fonts->getFonts(),
		'desc' => 'Choose a custom font for your pop up headline.<br /><br /><em>* non web-safe font</em>',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-headline-color' => array(
		'name' => 'Headline Color',
		'std' => '#cc0000',
		'id' => 'lp-page-pop-headline-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for your pop up headline by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-headline-size' => array(
		'name' => 'Headline Font Size',
		'std' => '36',
		'id' => 'lp-page-pop-headline-size',
		'type' => 'size',
		'desc' => 'Select the size of your pop up headline.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-img' => array(
		'name' => 'Pop Up Ecover/Image', 
		'std' => '',  
		'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button. It will be displayed under the headline.',
		'id' => 'lp-page-pop-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-text' => array(
		'name' => 'Pop Up Text', 
		'std' => 'Simply enter your information to get INSTANT ACCESS today...',  
		'desc' => 'Type any text you want to get reader\'s attention to subscribe.',
		'id' => 'lp-page-pop-text',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-text-font' => array(
		'name' => 'Pop Up Headline Font',
		'std' => 'Verdana, sans-serif',
		'id' => 'lp-page-pop-text-font',
		'type' => 'font',
		'options' => $pt_fonts->getFonts(),
		'desc' => 'Choose a custom font for your pop up headline.<br /><br /><em>* non web-safe font</em>',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-text-color' => array(
		'name' => 'Headline Color',
		'std' => '#212121',
		'id' => 'lp-page-pop-text-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for your pop up headline by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-text-size' => array(
		'name' => 'Headline Font Size',
		'std' => '14',
		'id' => 'lp-page-pop-text-size',
		'type' => 'size',
		'desc' => 'Select the size of your pop up headline.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-name' => array(
		'name' => 'Pop Up Name Field Text', 
		'std' => 'Enter your first name...',  
		'desc' => 'Name field label text.',
		'id' => 'lp-page-pop-name',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-email' => array(
		'name' => 'Pop Up Email Field Text', 
		'std' => 'Enter your email address...',  
		'desc' => 'Email field label text.',
		'id' => 'lp-page-pop-email',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-btntype' => array(
		'name' => 'Optin Button',
		'std' => 'premade',
		'desc' => 'Choose the optin form button you\'d like to use.',
		'options' => array(
			'premade' => 'Premade Optin Button', 
			'blank' => 'Custom Text Optin Button',
			'upload' => 'Custom Optin Button Image'
		),
		'id' => 'lp-page-pop-btntype',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-btnpremade' => array(
		'name' => 'Premade Optin Button',
		'std' => 'yellow-get_instant_access',
		'desc' => 'Choose a button from the Profits Theme\'s premade optin button.',
		'options' => array(
            'yellow-download_now' => 'Yellow Type #1 - Download Now',
			'yellow-get_access_now' => 'Yellow Type #1 - Get Access Now!',
			'yellow-get_instant_access' => 'Yellow Type #1 - Get Instant Access',
			'yellow-get_early' => 'Yellow Type #1 - Get On The Early Bird List',
			'yellow-send_video' => 'Yellow Type #1 - Send Me The Video',
			'yellow-sign_up' => 'Yellow Type #1 - Sign Up Now!',
			'yellow-subscribe' => 'Yellow Type #1 - Subscribe Now!',
			'yellow-free_access' => 'Yellow Type #1 - Yes, I want FREE Access',
			'yellow-early_bird' => 'Yellow Type #1 - Yes, Let Me In Early',
			'yellow-sign_me_up' => 'Yellow Type #1 - Yes, Sign Me Up!',
			'yellow-end' => '--',
			'orange-download_now' => 'Orange Type #1 - Download Now',
			'orange-get_access_now' => 'Orange Type #1 - Get Access Now!',
			'orange-get_instant_access' => 'Orange Type #1 - Get Instant Access',
			'orange-get_early' => 'Orange Type #1 - Get On The Early Bird List',
			'orange-send_video' => 'Orange Type #1 - Send Me The Video',
			'orange-sign_up' => 'Orange Type #1 - Sign Up Now!',
			'orange-subscribe' => 'Orange Type #1 - Subscribe Now!',
			'orange-free_access' => 'Orange Type #1 - Yes, I want FREE Access',
			'orange-early_bird' => 'Orange Type #1 - Yes, Let Me In Early',
			'orange-sign_me_up' => 'Orange Type #1 - Yes, Sign Me Up Now!',
			'orange-end' => '--',
			'red-download_now' => 'Red Type #1 - Download Now',
			'red-get_access_now' => 'Red Type #1 - Get Access Now!',
			'red-get_instant_access' => 'Red Type #1 - Get Instant Access',
			'red-get_early' => 'Red Type #1 - Get On The Early Bird List',
			'red-send_video' => 'Red Type #1 - Send Me The Video',
			'red-sign_up' => 'Red Type #1 - Sign Up Now!',
			'red-subscribe' => 'Red Type #1 - Subscribe Now!',
			'red-free_access' => 'Red Type #1 - Yes, I want FREE Access',
			'red-early_bird' => 'Red Type #1 - Yes, Let Me In Early',
			'red-sign_me_up' => 'Red Type #1 - Yes, Sign Me Up Now!',
			'red-end' => '--',
			'green-download_now' => 'Green Type #1 - Download Now',
			'green-get_access_now' => 'Green Type #1 - Get Access Now!',
			'green-get_instant_access' => 'Green Type #1 - Get Instant Access',
			'green-get_early' => 'Green Type #1 - Get On The Early Bird List',
			'green-send_video' => 'Green Type #1 - Send Me The Video',
			'green-sign_up' => 'Green Type #1 - Sign Up Now!',
			'green-subscribe' => 'Green Type #1 - Subscribe Now!',
			'green-free_access' => 'Green Type #1 - Yes, I want FREE Access',
			'green-early_bird' => 'Green Type #1 - Yes, Let Me In Early',
			'green-sign_me_up' => 'Green Type #1 - Yes, Sign Me Up Now!',
			'green-end' => '--',
			'blue-download_now' => 'Blue Type #1 - Download Now',
			'blue-get_access_now' => 'Blue Type #1 - Get Access Now!',
			'blue-get_instant_access' => 'Blue Type #1 - Get Instant Access',
			'blue-get_early' => 'Blue Type #1 - Get On The Early Bird List',
			'blue-send_video' => 'Blue Type #1 - Send Me The Video',
			'blue-sign_up' => 'Blue Type #1 - Sign Up Now!',
			'blue-subscribe' => 'Blue Type #1 - Subscribe Now!',
			'blue-free_access' => 'Blue Type #1 - Yes, I want FREE Access',
			'blue-early_bird' => 'Blue Type #1 - Yes, Let Me In Early',
			'blue-sign_me_up' => 'Blue Type #1 - Yes, Sign Me Up Now!',
            'new-start' => '--',
			'yellow/metro_1' => 'Yellow Type #2 - Download Now',
			'yellow/metro_2' => 'Yellow Type #2 - Yes, Let Me In Early',
			'yellow/metro_3' => 'Yellow Type #2 - Get Access Now!',
			'yellow/metro_4' => 'Yellow Type #2 - Get Instant Access',
			'yellow/metro_5' => 'Yellow Type #2 - Sign Up Now!',
			'yellow/metro_6' => 'Yellow Type #2 - Subscribe Now!',
            'yellow1-end' => '--',
            'red/metro_1' => 'Red Type #2 - Download Now',
			'red/metro_2' => 'Red Type #2 - Yes, Let Me In Early',
			'red/metro_3' => 'Red Type #2 - Get Access Now!',
			'red/metro_4' => 'Red Type #2 - Get Instant Access',
			'red/metro_5' => 'Red Type #2 - Sign Up Now!',
			'red/metro_6' => 'Red Type #2 - Subscribe Now!',
            'red1-end' => '--',
            'orange/metro_1' => 'Orange Type #2 - Download Now',
			'orange/metro_2' => 'Orange Type #2 - Yes, Let Me In Early',
			'orange/metro_3' => 'Orange Type #2 - Get Access Now!',
			'orange/metro_4' => 'Orange Type #2 - Get Instant Access',
			'orange/metro_5' => 'Orange Type #2 - Sign Up Now!',
			'orange/metro_6' => 'Orange Type #2 - Subscribe Now!',
            'orange1-end' => '--',
            'green/metro_1' => 'green Type #2 - Download Now',
			'green/metro_2' => 'Green Type #2 - Yes, Let Me In Early',
			'green/metro_3' => 'Green Type #2 - Get Access Now!',
			'green/metro_4' => 'Green Type #2 - Get Instant Access',
			'green/metro_5' => 'Green Type #2 - Sign Up Now!',
			'green/metro_6' => 'Green Type #2 - Subscribe Now!',
            'green1-end' => '--',
            'blue/metro_1' => 'blue Type #2 - Download Now',
			'blue/metro_2' => 'Blue Type #2 - Yes, Let Me In Early',
			'blue/metro_3' => 'Blue Type #2 - Get Access Now!',
			'blue/metro_4' => 'Blue Type #2 - Get Instant Access',
			'blue/metro_5' => 'Blue Type #2 - Sign Up Now!',
			'blue/metro_6' => 'Blue Type #2 - Subscribe Now!',
            'blue1-end' => '--',
            'yellow/grunge_1' => 'Yellow Type #3 - Download Now',
			'yellow/grunge_2' => 'Yellow Type #3 - Yes, Let Me In Early',
			'yellow/grunge_3' => 'Yellow Type #3 - Get Access Now!',
			'yellow/grunge_4' => 'Yellow Type #3 - Get Instant Access',
			'yellow/grunge_5' => 'Yellow Type #3 - Sign Up Now!',
			'yellow/grunge_6' => 'Yellow Type #3 - Subscribe Now!',
            'yellow2-end' => '--',
            'red/grunge_1' => 'Red Type #3 - Download Now',
			'red/grunge_2' => 'Red Type #3 - Yes, Let Me In Early',
			'red/grunge_3' => 'Red Type #3 - Get Access Now!',
			'red/grunge_4' => 'Red Type #3 - Get Instant Access',
			'red/grunge_5' => 'Red Type #3 - Sign Up Now!',
			'red/grunge_6' => 'Red Type #3 - Subscribe Now!',
            'red2-end' => '--',          
            'orange/grunge_1' => 'Orange Type #3 - Download Now',
			'orange/grunge_2' => 'Orange Type #3 - Yes, Let Me In Early',
			'orange/grunge_3' => 'Orange Type #3 - Get Access Now!',
			'orange/grunge_4' => 'Orange Type #3 - Get Instant Access',
			'orange/grunge_5' => 'Orange Type #3 - Sign Up Now!',
			'orange/grunge_6' => 'Orange Type #3 - Subscribe Now!',
            'orange2-end' => '--',           
            'green/grunge_1' => 'Green Type #3 - Download Now',
			'green/grunge_2' => 'Green Type #3 - Yes, Let Me In Early',
			'green/grunge_3' => 'Green Type #3 - Get Access Now!',
			'green/grunge_4' => 'Green Type #3 - Get Instant Access',
			'green/grunge_5' => 'Green Type #3 - Sign Up Now!',
			'green/grunge_6' => 'Green Type #3 - Subscribe Now!',
            'green2-end' => '--',           
            'blue/grunge_1' => 'Blue Type #3 - Download Now',
			'blue/grunge_2' => 'Blue Type #3 - Yes, Let Me In Early',
			'blue/grunge_3' => 'Blue Type #3 - Get Access Now!',
			'blue/grunge_4' => 'Blue Type #3 - Get Instant Access',
			'blue/grunge_5' => 'Blue Type #3 - Sign Up Now!',
			'blue/grunge_6' => 'Blue Type #3 - Subscribe Now!',
		),
		'id' => 'lp-page-pop-btnpremade',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-btnclr' => array(
		'name' => 'Optin Button Color',
		'std' => 'orange',
		'desc' => 'Choose the color of your optin form submit button.',
		'options' => array(
			'yellow' => 'Yellow - Type #1',
            'orange' => 'Orange - Type #1',
            'red' => 'Red - Type #1',
            'green' => 'Green - Type #1',
            'blue' => 'Blue - Type #1',
            'separator1' => '--',
            'yellow1' => 'Yellow - Type #2',
            'red1' => 'Red - Type #2',
            'orange1' => 'Orange - Type #2',
            'green1' => 'Green - Type #2',
            'blue1' => 'Blue - Type #2',
            'separator2' => '--',
            'yellow2' => 'Yellow - Type #3',
            'red2' => 'Red - Type #3',
            'orange2' => 'Orange - Type #3',
            'green2' => 'Green - Type #3',
            'blue2' => 'Blue - Type #3'
		),
		'id' => 'lp-page-pop-btnclr',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-btntxt' => array(
		'name' => 'Optin Button Text',
		'std' => 'Get Instant Access!',
		'id' => 'lp-page-pop-btntxt',
		'type' => 'text',
		'desc' => 'Type a text/label to display on your optin form submit button.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-btn-img' => array(
		'name' => 'Custom Optin Button Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your optin button image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-page-pop-btn-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-page-pop-privacy' => array(
		'name' => 'Short Privacy Policy',
		'std' => 'Your Privacy is SAFE!',
		'id' => 'lp-page-pop-privacy',
		'type' => 'textarea',
		'desc' => 'Type a short privacy policy that will be displayed below the optin form.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-page-pop-close' => array(
		'type' => 'divwrapclose',
	),

	'lp-page-wrap-close' => array(
		'name' => 'Page Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Header Settings

	'lp-header-wrap-open' => array(
		'name' => 'Header Settings Wrap Open',
		'id' => 'lp-header-open',
		'type' => 'dialogopen',
		'title' => 'Header Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-remove' => array(
		'name' => 'Header Remove', 
		'std' => 'true',
		'desc' => 'Remove Header',
		'id' => 'lp-header-remove', 
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),

	'lp-logo-remove' => array(
		'name' => 'Remove Site Logo/Title', 
		'std' => 'true',
		'desc' => 'Remove Site Logo/Title',
		'id' => 'lp-logo-remove', 
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-image' => array(
			'name' => array(
				'type' => 'Header Image',
				'upload' => 'Header Image URL',
				'align' => 'Custom Header Image Alignment',
			),
			'std' => array(
				'type' => '',
				'upload' => '',
				'align' => 'center',
			),
			'desc' => array(
				'type' => 'You can upload your own header image, or use the Profits Theme pre-made background.',
				'upload' => 'Type the full path URL to your header image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
				'align' => 'Choose where you want your header image displayed.',
			),
			'options' => array( 
				'type' => array(
					'no-hbackground' => 'Use Default Header Image',
					'custom-hbackground' => 'Use Custom Header Image'
				),
				'align' => array(
					'left top' => 'Left Top',
					'left center' => 'Left Center',
					'left bottom' => 'Left Bottom',
					'right top' => 'Right Top',
					'right center' => 'Right Center',
					'right bottom' => 'Right Bottom',
					'center top' => 'Center Top',
					'center center' => 'Center Center',
					'center bottom' => 'Center Bottom',
				),
			),
			'id' => 'lp-header-image',
			'type' => 'header',
			'group' => 'pt_landing_meta_box'
		),

	'lp-header-height' => array(
		'name' => 'Custom Header Height', 
		'std' => 135,
		'desc' => 'Landing page custom header height.',
		'id' => 'lp-header-height', 
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-header-optin' => array(
		'name' => 'Enable Header Optin', 
		'std' => 'false', 
		'desc' => 'Enable Header Optin',
		'id' => 'lp-header-optin',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-wrap' => array(
		'id' => 'lp-header-optin-wrap',
		'type' => 'divwrapopen',
	),

	'lp-header-optin-code' => array(
		'name' => 'Paste Header Optin Autoresponder Code Here', 
		'std' => '',  
		'desc' => 'Please copy a raw autoresponder code from your email provider (e.g. Aweber, Getresponse, Mail Chimp, etc) and paste it here.',
		'id' => 'lp-header-optin-code',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-text' => array(
		'name' => 'Header Optin Text', 
		'std' => 'Simply enter your information to get INSTANT ACCESS today...',  
		'desc' => 'Type any text you want to get reader\'s attention to subscribe.',
		'id' => 'lp-header-optin-text',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-header-text-color' => array(
		'name' => 'Header Optin Text Primary Color',
		'std' => '#cc0000',
		'id' => 'lp-header-text-color',
		'type' => 'color',
		'desc' => 'Pick a primary color for your header optin text by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-text-color-2' => array(
		'name' => 'Header Optin Text Secondary Color',
		'std' => '#212121',
		'id' => 'lp-header-text-color-2',
		'type' => 'color',
		'desc' => 'Pick a secondary color for your header optin text by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-name' => array(
		'name' => 'Name Field Text', 
		'std' => 'Enter your first name...',  
		'desc' => 'Name field label text.',
		'id' => 'lp-header-optin-name',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-email' => array(
		'name' => 'Email Field Text', 
		'std' => 'Enter your email address...',  
		'desc' => 'Email field label text.',
		'id' => 'lp-header-optin-email',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-btnclr' => array(
		'name' => 'Optin Button Color',
		'std' => 'orange',
		'desc' => 'Choose the color of your optin form submit button.',
		'options' => array(
			'yellow' => 'Yellow - Type #1',
            'orange' => 'Orange - Type #1',
            'red' => 'Red - Type #1',
            'green' => 'Green - Type #1',
            'blue' => 'Blue - Type #1',
            'separator1' => '--',
            'yellow1' => 'Yellow - Type #2',
            'red1' => 'Red - Type #2',
            'orange1' => 'Orange - Type #2',
            'green1' => 'Green - Type #2',
            'blue1' => 'Blue - Type #2',
            'separator2' => '--',
            'yellow2' => 'Yellow - Type #3',
            'red2' => 'Red - Type #3',
            'orange2' => 'Orange - Type #3',
            'green2' => 'Green - Type #3',
            'blue2' => 'Blue - Type #3'
		),
		'id' => 'lp-header-optin-btnclr',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-btntxt' => array(
		'name' => 'Optin Button Text',
		'std' => 'Get Instant Access!',
		'id' => 'lp-header-optin-btntxt',
		'type' => 'text',
		'desc' => 'Type a text/label to display on your optin form submit button.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-privacy' => array(
		'name' => 'Short Privacy Policy',
		'std' => 'Your Privacy is SAFE!',
		'id' => 'lp-header-optin-privacy',
		'type' => 'textarea',
		'desc' => 'Type a short privacy policy that will be displayed below the optin form.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-header-optin-close' => array(
		'type' => 'divwrapclose',
	),

	'lp-header-wrap-close' => array(
		'name' => 'Header Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Custom Design Settings

	'lp-custom-wrap-open' => array(
		'name' => 'Custom Design Settings Wrap Open',
		'id' => 'lp-custom-open',
		'type' => 'dialogopen',
		'title' => 'Custom Design Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background' => array(
		'name' => 'Show Custom Background Settings', 
		'std' => 'false', 
		'desc' => 'Show Custom Background Settings',
		'id' => 'lp-custom-background',
		'type' => 'activate',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background-wrap' => array(
		'id' => 'lp-custom-background-wrap',
		'type' => 'divwrapopen',
	),

	'lp-custom-background-color' => array(
		'name' => 'Page Background Color',
		'std' => '#FFFFFF',
		'id' => 'lp-custom-background-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for the landing page background by clicking on the color picker box below.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background-image' => array(
		'name' => 'Page Background Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your background Image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-custom-background-image',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background-repeat' => array(
		'name' => 'Page Background Image Tiling',
		'std' => 'no-repeat',
		'desc' => 'Select how you want your background image to display.',
		'options' => array(
			'no-repeat' => 'No Repeat', 
			'repeat' => 'Repeat', 
			'repeat-x' => 'Repeat X (horizontal)', 
			'repeat-y' => 'Repeat Y (vertical)'
		),
		'id' => 'lp-custom-background-repeat',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background-pos' => array(
		'name' => 'Page Background Position',
		'std' => 'left top',
		'desc' => 'Choose the position for the page background.',
		'options' => array(
			'left top' => 'Left Top',
			'left center' => 'Left Center',
			'left bottom' => 'Left Bottom', 
			'right top' => 'Right Top',
			'right center' => 'Right Center',
			'right bottom' => 'Right Bottom', 
			'center top' => 'Center Top',
			'center center' => 'Center Center',
			'center bottom' => 'Center Bottom',
		),
		'id' => 'lp-custom-background-pos',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background-attach' => array(
		'name' => 'Page Background Attachment',
		'std' => 'scroll',
		'desc' => 'Choose the attachment type for the page background.',
		'options' => array(
			'scroll' => 'Scroll', 
			'fixed' => 'Fixed',
		),
		'id' => 'lp-custom-background-attach',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-background-close' => array(
		'type' => 'divwrapclose',
	),

	'lp-custom-content-background' => array(
		'name' => 'Show Content Area Settings', 
		'std' => 'false', 
		'desc' => 'Show Content Area Settings',
		'id' => 'lp-custom-content-background',
		'type' => 'activate',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-background-wrap' => array(
		'id' => 'lp-custom-content-background-wrap',
		'type' => 'divwrapopen',
	),

	'lp-custom-content-background-color' => array(
		'name' => 'Content Area Background Color',
		'std' => '#FFFFFF',
		'id' => 'lp-custom-content-background-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for the content area background by clicking on the color picker box below.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-background-image' => array(
		'name' => 'Content Area Background Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your content area background Image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-custom-content-background-image',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-background-repeat' => array(
		'name' => 'Content Area Background Image Tiling',
		'std' => 'no-repeat',
		'desc' => 'Select how you want your content area background image to display.',
		'options' => array(
			'no-repeat' => 'No Repeat', 
			'repeat' => 'Repeat', 
			'repeat-x' => 'Repeat X (horizontal)', 
			'repeat-y' => 'Repeat Y (vertical)'
		),
		'id' => 'lp-custom-content-background-repeat',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-border' => array(
		'name' => 'Content Area Border',
		'std' => '',
		'desc' => 'Choose the type of border for the content area.',
		'options' => array(
			'' => 'No Border', 
			'solid' => 'Solid', 
			'dotted' => 'Dotted', 
			'dashed' => 'Dashed',
			'double' => 'Double'
		),
		'id' => 'lp-custom-content-border',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-border-width' => array(
		'name' => 'Content Area Border Width',
		'std' => '1',
		'desc' => 'Choose the width of border for the content area.',
		'options' => array(
			'1' => '1px', 
			'2' => '2px', 
			'3' => '3px', 
			'4' => '4px',
			'5' => '5px'
		),
		'id' => 'lp-custom-content-border-width',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-border-color' => array(
		'name' => 'Content Area Border Width',
		'std' => '#000000',
		'id' => 'lp-custom-content-border-color',
		'type' => 'color',
		'desc' => 'Choose the color of border for the content area.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-border-radius' => array(
		'name' => 'Content Area Border Radius', 
		'std' => 0,
		'desc' => 'To have a content area with rounder corners, type any digit(s) more than zero (this may not work in IE browser).',
		'id' => 'lp-custom-content-border-radius', 
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-content-background-close' => array(
		'type' => 'divwrapclose',
	),

	'lp-custom-footer-background' => array(
		'name' => 'Show Footer Design Settings', 
		'std' => 'false', 
		'desc' => 'Show Footer Design Settings',
		'id' => 'lp-custom-footer-background',
		'type' => 'activate',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-background-wrap' => array(
		'id' => 'lp-custom-footer-background-wrap',
		'type' => 'divwrapopen',
	),

	'lp-custom-footer-text-remove' => array(
		'name' => 'Remove footer text', 
		'std' => 'false',  
		'desc' => 'Remove all text and links on footer',
		'id' => 'lp-custom-footer-text-remove',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-background-transparent' => array(
		'name' => 'Transparent', 
		'std' => 'true',  
		'desc' => 'Do not use background on footer',
		'id' => 'lp-custom-footer-background-transparent',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-background-color' => array(
		'name' => 'Footer Background Color',
		'std' => '#FFFFFF',
		'id' => 'lp-custom-footer-background-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for the landing page footer background by clicking on the color picker box below.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-background-image' => array(
		'name' => 'Footer Background Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your footer background Image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-custom-footer-background-image',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-background-repeat' => array(
		'name' => 'Footer Background Image Tiling',
		'std' => 'no-repeat',
		'desc' => 'Select how you want your footer background image to display.',
		'options' => array(
			'no-repeat' => 'No Repeat', 
			'repeat' => 'Repeat', 
			'repeat-x' => 'Repeat X (horizontal)', 
			'repeat-y' => 'Repeat Y (vertical)'
		),
		'id' => 'lp-custom-footer-background-repeat',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-height' => array(
		'name' => 'Footer Height', 
		'std' => 60,
		'desc' => 'Landing page custom footer height.',
		'id' => 'lp-custom-footer-height', 
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box'
	),

	'lp-custom-footer-background-close' => array(
		'type' => 'divwrapclose',
	),
	
	'lp-custom-wrap-close' => array(
		'name' => 'Custom Design Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Headline
	
	'lp-headline-wrap-open' => array(
		'name' => 'Headline Settings Wrap Open',
		'id' => 'lp-headline-open',
		'type' => 'dialogopen',
		'title' => 'Headline Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-headline-text' => array(
		'name' => 'Headline Text',
		'std' => '',
		'id' => 'lp-headline-text',
		'type' => 'text',
		'desc' => 'Type a strong and powerful headline for your landing page.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-headline-color' => array(
		'name' => 'Headline Color',
		'std' => '#4d4d4d',
		'id' => 'lp-headline-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for your headline by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-headline-font' => array(
		'name' => 'Headline Font',
		'std' => 'Exo',
		'id' => 'lp-headline-font',
		'type' => 'font',
		'options' => $pt_fonts->getAllFonts(),
		'desc' => 'Choose a custom font for your headline.<br /><br /><em>* non web-safe font</em><br /><em>** cufon font</em><br /><em>*** google font</em>',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-headline-size' => array(
		'name' => 'Headline Font Size',
		'std' => '50',
		'id' => 'lp-headline-size',
		'type' => 'size',
		'desc' => 'Select the size of your headline.',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-headline-wrap-close' => array(
		'name' => 'Headline Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Pre-Headline
	
	'lp-pre-headline-wrap-open' => array(
		'name' => 'Pre-Headline Settings Wrap Open',
		'id' => 'lp-pre-headline-open',
		'type' => 'dialogopen',
		'title' => 'Pre-Headline Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-pre-headline-text' => array(
		'name' => 'Pre-Headline Text',
		'std' => '',
		'id' => 'lp-pre-headline-text',
		'type' => 'text',
		'desc' => 'Type a pre-headline for your landing page.',
		'group' => 'pt_landing_meta_box',
	),

	'lp-pre-headline-color' => array(
		'name' => 'Pre-Headline Color',
		'std' => '#212121',
		'id' => 'lp-pre-headline-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for your headline by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-pre-headline-font' => array(
		'name' => 'Pre-Headline Font',
		'std' => 'MgOpen Moderna',
		'id' => 'lp-pre-headline-font',
		'type' => 'font',
		'options' => $pt_fonts->getAllFonts(),
		'desc' => 'Choose a custom font for your pre-headline.<br /><br /><em>* non web-safe font</em><br /><em>** cufon font</em><br /><em>*** google font</em>',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-pre-headline-size' => array(
		'name' => 'Pre-Headline Font Size',
		'std' => '20',
		'id' => 'lp-pre-headline-size',
		'type' => 'size',
		'desc' => 'Select the size of your headline.',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-pre-headline-wrap-close' => array(
		'name' => 'Pre-Headline Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Sub-Headline

	'lp-sub-headline-wrap-open' => array(
		'name' => 'Sub-Headline Settings Wrap Open',
		'id' => 'lp-sub-headline-open',
		'type' => 'dialogopen',
		'title' => 'Sub-Headline Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-sub-headline-text' => array(
		'name' => 'Sub-Headline Text',
		'std' => '',
		'id' => 'lp-sub-headline-text',
		'type' => 'text',
		'desc' => 'Type a Sub-headline for your landing page.',
		'group' => 'pt_landing_meta_box',
	),

	'lp-sub-headline-color' => array(
		'name' => 'Sub-Headline Color',
		'std' => '#212121',
		'id' => 'lp-sub-headline-color',
		'type' => 'color',
		'desc' => 'Pick a custom color for your headline by clicking on the color picker box above.',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-sub-headline-font' => array(
		'name' => 'Sub-Headline Font',
		'std' => 'Georgia, "Times New Roman", Times, serif',
		'id' => 'lp-sub-headline-font',
		'type' => 'font',
		'options' => $pt_fonts->getAllFonts(),
		'desc' => 'Choose a custom font for your Sub-headline.<br /><br /><em>* non web-safe font</em><br /><em>** cufon font</em><br /><em>*** google font</em>',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-sub-headline-size' => array(
		'name' => 'Sub-Headline Font Size',
		'std' => '20',
		'id' => 'lp-sub-headline-size',
		'type' => 'size',
		'desc' => 'Select the size of your headline.',
		'group' => 'pt_landing_meta_box',
	),
	
	'lp-sub-headline-wrap-close' => array(
		'name' => 'Sub-Headline Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	
	// Optin Form
	
	'lp-optin-wrap-open' => array(
		'name' => 'Optin Settings Wrap Open',
		'id' => 'lp-optin-open',
		'type' => 'dialogopen',
		'title' => 'Optin Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-style' => array(
		'name' => 'Optin Form Style',
		'std' => 'metro-grey',
		'desc' => 'You can select a cool style for your optin form.',
		'options' => array(
                    'plain' => 'Plain & Simple',
                    'animated' => 'Plain & Simple (w/ Animated Red Arrow)',
                    'static' => 'Plain & Simple (w/ Static Red Arrow)',
                    'separator1' => '--',
                    'rounded-blue' => 'Rounded - Blue',
                    'rounded-green' => 'Rounded - Green',
                    'rounded-grey' => 'Rounded - Grey',
                    'rounded-pink' => 'Rounded - Pink',
                    'rounded-yellow' => 'Rounded - Yellow',  
                    'separator2' => '--',
                    'gradient-blue' => 'Gradient - Blue',
                    'gradient-green' => 'Gradient - Green',
                    'gradient-orange' => 'Gradient - Orange',
                    'gradient-red' => 'Gradient - Red',
                    'separator3' => '--',
                    'canvas-grey' => 'Canvas - Grey',
                    'canvas-yellow' => 'Canvas - Yellow',
                    'canvas-red' => 'Canvas - Red',
                    'canvas-orange' => 'Canvas - Orange',
                    'canvas-green' => 'Canvas - Green',
                    'canvas-blue' => 'Canvas - Blue',
                    'separator4' => '--',
                    'modern-grey' => 'Modern - Grey',
                    'modern-yellow' => 'Modern - Yellow',
                    'modern-red' => 'Modern - Red',
                    'modern-orange' => 'Modern - Orange',            
                    'modern-green' => 'Modern - Green',
                    'modern-blue' => 'Modern - Blue',
                    'separator5' => '--',
                    'metro-grey' => 'Metro - Grey',
                    'metro-yellow' => 'Metro - Yellow',
                    'metro-red' => 'Metro - Red',
                    'metro-orange' => 'Metro - Orange',
                    'metro-green' => 'Metro - Green',
                    'metro-blue' => 'Metro - Blue',
			),
		'id' => 'lp-optin-style',
		'type' => 'optstyle',
		'group' => 'pt_landing_meta_box'
		),

	'lp-optin-resp' => array(
		'name' => 'Paste Autoreponder Code Here',
		'std' => '<input type="text" name="name"><input type="text" name="email">',
		'id' => 'lp-optin-resp',
		'type' => 'textarea',
		'desc' => 'Please copy an autoresponder code from your email provider (e.g. Aweber, Getresponse, Mail Chimp, etc) and paste it here.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-ecover' => array(
		'name' => 'Ecover/Image URL (optional)', 
		'std' => '',  
		'desc' => 'Type the full path URL to your ecover/image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-optin-ecover', 
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-optin-text' => array(
		'name' => 'Subscribe Instruction',
		'std' => 'Simply enter your details on the form below to receive instant access...',
		'id' => 'lp-optin-text',
		'type' => 'textarea',
		'desc' => 'Type an instruction on how to subscribe to your mailing list.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-name' => array(
		'name' => 'Name Field Text',
		'std' => 'Enter your first name...',
		'id' => 'lp-optin-name',
		'type' => 'text',
		'desc' => 'Type a text/label to display on the name field.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-email' => array(
		'name' => 'Email Field Text',
		'std' => 'Enter your email address...',
		'id' => 'lp-optin-email',
		'type' => 'text',
		'desc' => 'Type a text/label to display on the email field.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-btntype' => array(
		'name' => 'Optin Button',
		'std' => 'premade',
		'desc' => 'Choose the optin form button you\'d like to use.',
		'options' => array(
			'premade' => 'Premade Optin Button', 
			'blank' => 'Custom Text Optin Button',
			'upload' => 'Custom Optin Button Image'
		),
		'id' => 'lp-optin-btntype',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-btnpremade' => array(
		'name' => 'Premade Optin Button',
		'std' => 'red/metro_4',
		'desc' => 'Choose a button from the Profits Theme\'s premade optin button.',
		'options' => array(
		    'yellow-download_now' => 'Yellow Type #1 - Download Now',
			'yellow-get_access_now' => 'Yellow Type #1 - Get Access Now!',
			'yellow-get_instant_access' => 'Yellow Type #1 - Get Instant Access',
			'yellow-get_early' => 'Yellow Type #1 - Get On The Early Bird List',
			'yellow-send_video' => 'Yellow Type #1 - Send Me The Video',
			'yellow-sign_up' => 'Yellow Type #1 - Sign Up Now!',
			'yellow-subscribe' => 'Yellow Type #1 - Subscribe Now!',
			'yellow-free_access' => 'Yellow Type #1 - Yes, I want FREE Access',
			'yellow-early_bird' => 'Yellow Type #1 - Yes, Let Me In Early',
			'yellow-sign_me_up' => 'Yellow Type #1 - Yes, Sign Me Up!',
			'yellow-end' => '--',
			'orange-download_now' => 'Orange Type #1 - Download Now',
			'orange-get_access_now' => 'Orange Type #1 - Get Access Now!',
			'orange-get_instant_access' => 'Orange Type #1 - Get Instant Access',
			'orange-get_early' => 'Orange Type #1 - Get On The Early Bird List',
			'orange-send_video' => 'Orange Type #1 - Send Me The Video',
			'orange-sign_up' => 'Orange Type #1 - Sign Up Now!',
			'orange-subscribe' => 'Orange Type #1 - Subscribe Now!',
			'orange-free_access' => 'Orange Type #1 - Yes, I want FREE Access',
			'orange-early_bird' => 'Orange Type #1 - Yes, Let Me In Early',
			'orange-sign_me_up' => 'Orange Type #1 - Yes, Sign Me Up Now!',
			'orange-end' => '--',
			'red-download_now' => 'Red Type #1 - Download Now',
			'red-get_access_now' => 'Red Type #1 - Get Access Now!',
			'red-get_instant_access' => 'Red Type #1 - Get Instant Access',
			'red-get_early' => 'Red Type #1 - Get On The Early Bird List',
			'red-send_video' => 'Red Type #1 - Send Me The Video',
			'red-sign_up' => 'Red Type #1 - Sign Up Now!',
			'red-subscribe' => 'Red Type #1 - Subscribe Now!',
			'red-free_access' => 'Red Type #1 - Yes, I want FREE Access',
			'red-early_bird' => 'Red Type #1 - Yes, Let Me In Early',
			'red-sign_me_up' => 'Red Type #1 - Yes, Sign Me Up Now!',
			'red-end' => '--',
			'green-download_now' => 'Green Type #1 - Download Now',
			'green-get_access_now' => 'Green Type #1 - Get Access Now!',
			'green-get_instant_access' => 'Green Type #1 - Get Instant Access',
			'green-get_early' => 'Green Type #1 - Get On The Early Bird List',
			'green-send_video' => 'Green Type #1 - Send Me The Video',
			'green-sign_up' => 'Green Type #1 - Sign Up Now!',
			'green-subscribe' => 'Green Type #1 - Subscribe Now!',
			'green-free_access' => 'Green Type #1 - Yes, I want FREE Access',
			'green-early_bird' => 'Green Type #1 - Yes, Let Me In Early',
			'green-sign_me_up' => 'Green Type #1 - Yes, Sign Me Up Now!',
			'green-end' => '--',
			'blue-download_now' => 'Blue Type #1 - Download Now',
			'blue-get_access_now' => 'Blue Type #1 - Get Access Now!',
			'blue-get_instant_access' => 'Blue Type #1 - Get Instant Access',
			'blue-get_early' => 'Blue Type #1 - Get On The Early Bird List',
			'blue-send_video' => 'Blue Type #1 - Send Me The Video',
			'blue-sign_up' => 'Blue Type #1 - Sign Up Now!',
			'blue-subscribe' => 'Blue Type #1 - Subscribe Now!',
			'blue-free_access' => 'Blue Type #1 - Yes, I want FREE Access',
			'blue-early_bird' => 'Blue Type #1 - Yes, Let Me In Early',
			'blue-sign_me_up' => 'Blue Type #1 - Yes, Sign Me Up Now!',
            'new-start' => '--',
			'yellow/metro_1' => 'Yellow Type #2 - Download Now',
			'yellow/metro_2' => 'Yellow Type #2 - Yes, Let Me In Early',
			'yellow/metro_3' => 'Yellow Type #2 - Get Access Now!',
			'yellow/metro_4' => 'Yellow Type #2 - Get Instant Access',
			'yellow/metro_5' => 'Yellow Type #2 - Sign Up Now!',
			'yellow/metro_6' => 'Yellow Type #2 - Subscribe Now!',
            'yellow1-end' => '--',
            'red/metro_1' => 'Red Type #2 - Download Now',
			'red/metro_2' => 'Red Type #2 - Yes, Let Me In Early',
			'red/metro_3' => 'Red Type #2 - Get Access Now!',
			'red/metro_4' => 'Red Type #2 - Get Instant Access',
			'red/metro_5' => 'Red Type #2 - Sign Up Now!',
			'red/metro_6' => 'Red Type #2 - Subscribe Now!',
            'red1-end' => '--',
            'orange/metro_1' => 'Orange Type #2 - Download Now',
			'orange/metro_2' => 'Orange Type #2 - Yes, Let Me In Early',
			'orange/metro_3' => 'Orange Type #2 - Get Access Now!',
			'orange/metro_4' => 'Orange Type #2 - Get Instant Access',
			'orange/metro_5' => 'Orange Type #2 - Sign Up Now!',
			'orange/metro_6' => 'Orange Type #2 - Subscribe Now!',
            'orange1-end' => '--',
            'green/metro_1' => 'green Type #2 - Download Now',
			'green/metro_2' => 'Green Type #2 - Yes, Let Me In Early',
			'green/metro_3' => 'Green Type #2 - Get Access Now!',
			'green/metro_4' => 'Green Type #2 - Get Instant Access',
			'green/metro_5' => 'Green Type #2 - Sign Up Now!',
			'green/metro_6' => 'Green Type #2 - Subscribe Now!',
            'green1-end' => '--',
            'blue/metro_1' => 'blue Type #2 - Download Now',
			'blue/metro_2' => 'Blue Type #2 - Yes, Let Me In Early',
			'blue/metro_3' => 'Blue Type #2 - Get Access Now!',
			'blue/metro_4' => 'Blue Type #2 - Get Instant Access',
			'blue/metro_5' => 'Blue Type #2 - Sign Up Now!',
			'blue/metro_6' => 'Blue Type #2 - Subscribe Now!',
            'blue1-end' => '--',
            'yellow/grunge_1' => 'Yellow Type #3 - Download Now',
			'yellow/grunge_2' => 'Yellow Type #3 - Yes, Let Me In Early',
			'yellow/grunge_3' => 'Yellow Type #3 - Get Access Now!',
			'yellow/grunge_4' => 'Yellow Type #3 - Get Instant Access',
			'yellow/grunge_5' => 'Yellow Type #3 - Sign Up Now!',
			'yellow/grunge_6' => 'Yellow Type #3 - Subscribe Now!',
            'yellow2-end' => '--',
            'red/grunge_1' => 'Red Type #3 - Download Now',
			'red/grunge_2' => 'Red Type #3 - Yes, Let Me In Early',
			'red/grunge_3' => 'Red Type #3 - Get Access Now!',
			'red/grunge_4' => 'Red Type #3 - Get Instant Access',
			'red/grunge_5' => 'Red Type #3 - Sign Up Now!',
			'red/grunge_6' => 'Red Type #3 - Subscribe Now!',
            'red2-end' => '--',          
            'orange/grunge_1' => 'Orange Type #3 - Download Now',
			'orange/grunge_2' => 'Orange Type #3 - Yes, Let Me In Early',
			'orange/grunge_3' => 'Orange Type #3 - Get Access Now!',
			'orange/grunge_4' => 'Orange Type #3 - Get Instant Access',
			'orange/grunge_5' => 'Orange Type #3 - Sign Up Now!',
			'orange/grunge_6' => 'Orange Type #3 - Subscribe Now!',
            'orange2-end' => '--',           
            'green/grunge_1' => 'Green Type #3 - Download Now',
			'green/grunge_2' => 'Green Type #3 - Yes, Let Me In Early',
			'green/grunge_3' => 'Green Type #3 - Get Access Now!',
			'green/grunge_4' => 'Green Type #3 - Get Instant Access',
			'green/grunge_5' => 'Green Type #3 - Sign Up Now!',
			'green/grunge_6' => 'Green Type #3 - Subscribe Now!',
            'green2-end' => '--',           
            'blue/grunge_1' => 'Blue Type #3 - Download Now',
			'blue/grunge_2' => 'Blue Type #3 - Yes, Let Me In Early',
			'blue/grunge_3' => 'Blue Type #3 - Get Access Now!',
			'blue/grunge_4' => 'Blue Type #3 - Get Instant Access',
			'blue/grunge_5' => 'Blue Type #3 - Sign Up Now!',
			'blue/grunge_6' => 'Blue Type #3 - Subscribe Now!',
		),
		'id' => 'lp-optin-btnpremade',
		'type' => 'select-template',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-btnclr' => array(
		'name' => 'Optin Button Color',
		'std' => 'yellow1',
		'desc' => 'Choose the color of your optin form submit button.',
		'options' => array(
               'yellow' => 'Yellow - Type #1',
            'orange' => 'Orange - Type #1',
            'red' => 'Red - Type #1',
            'green' => 'Green - Type #1',
            'blue' => 'Blue - Type #1',
            'separator1' => '--',
            'yellow1' => 'Yellow - Type #2',
            'red1' => 'Red - Type #2',
            'orange1' => 'Orange - Type #2',
            'green1' => 'Green - Type #2',
            'blue1' => 'Blue - Type #2',
            'separator2' => '--',
            'yellow2' => 'Yellow - Type #3',
            'red2' => 'Red - Type #3',
            'orange2' => 'Orange - Type #3',
            'green2' => 'Green - Type #3',
            'blue2' => 'Blue - Type #3'
		),
		'id' => 'lp-optin-btnclr',
		'type' => 'select-template',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-btntxt' => array(
		'name' => 'Optin Button Text',
		'std' => 'Get Instant Access!',
		'id' => 'lp-optin-btntxt',
		'type' => 'text',
		'desc' => 'Type a text/label to display on your optin form submit button.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-btn-img' => array(
		'name' => 'Custom Optin Button Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your optin button image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-optin-btn-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-optin-privacy' => array(
		'name' => 'Short Privacy Policy',
		'std' => 'Your Privacy is SAFE!',
		'id' => 'lp-optin-privacy',
		'type' => 'textarea',
		'desc' => 'Type a short privacy policy that will be displayed below the optin form.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-wrap-close' => array(
		'name' => 'Optin Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Optin Form 2
	
	'lp-optin-2-wrap-open' => array(
		'name' => 'Optin 2 Settings Wrap Open',
		'id' => 'lp-optin-2-open',
		'type' => 'dialogopen',
		'title' => 'Optin Form 2 Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-style' => array(
		'name' => 'Optin Form Style',
		'std' => 'metro-grey',
		'desc' => 'You can select a cool style for your optin form.',
		'options' => array(
				    'plain' => 'Plain & Simple',
                    'animated' => 'Plain & Simple (w/ Animated Red Arrow)',
                    'static' => 'Plain & Simple (w/ Static Red Arrow)',
                    'separator1' => '--',
                    'rounded-blue' => 'Rounded - Blue',
                    'rounded-green' => 'Rounded - Green',
                    'rounded-grey' => 'Rounded - Grey',
                    'rounded-pink' => 'Rounded - Pink',
                    'rounded-yellow' => 'Rounded - Yellow',  
                    'separator2' => '--',
                    'gradient-blue' => 'Gradient - Blue',
                    'gradient-green' => 'Gradient - Green',
                    'gradient-orange' => 'Gradient - Orange',
                    'gradient-red' => 'Gradient - Red',
                    'separator3' => '--',
                    'canvas-grey' => 'Canvas - Grey',
                    'canvas-yellow' => 'Canvas - Yellow',
                    'canvas-red' => 'Canvas - Red',
                    'canvas-orange' => 'Canvas - Orange',
                    'canvas-green' => 'Canvas - Green',
                    'canvas-blue' => 'Canvas - Blue',
                    'separator4' => '--',
                    'modern-grey' => 'Modern - Grey',
                    'modern-yellow' => 'Modern - Yellow',
                    'modern-red' => 'Modern - Red',
                    'modern-orange' => 'Modern - Orange',            
                    'modern-green' => 'Modern - Green',
                    'modern-blue' => 'Modern - Blue',
                    'separator5' => '--',
                    'metro-grey' => 'Metro - Grey',
                    'metro-yellow' => 'Metro - Yellow',
                    'metro-red' => 'Metro - Red',
                    'metro-orange' => 'Metro - Orange',
                    'metro-green' => 'Metro - Green',
                    'metro-blue' => 'Metro - Blue',
			),
		'id' => 'lp-optin-2-style',
		'type' => 'optstyle',
		'group' => 'pt_landing_meta_box'
		),
	'lp-optin-2-resp' => array(
		'name' => 'Paste Autoreponder Code Here',
		'std' => '<input type="text" name="name"><input type="text" name="email">',
		'id' => 'lp-optin-2-resp',
		'type' => 'textarea',
		'desc' => 'Please copy an autoresponder code from your email provider (e.g. Aweber, Getresponse, Mail Chimp, etc) and paste it here.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-ecover' => array(
		'name' => 'Ecover/Image URL (optional)', 
		'std' => '',  
		'desc' => 'Type the full path URL to your ecover/image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-optin-2-ecover', 
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-optin-2-text' => array(
		'name' => 'Subscribe Instruction',
		'std' => 'Simply enter your details on the form below to receive instant access...',
		'id' => 'lp-optin-2-text',
		'type' => 'textarea',
		'desc' => 'Type an instruction on how to subscribe to your mailing list.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-name' => array(
		'name' => 'Name Field Text',
		'std' => 'Enter your first name...',
		'id' => 'lp-optin-2-name',
		'type' => 'text',
		'desc' => 'Type a text/label to display on the name field.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-email' => array(
		'name' => 'Email Field Text',
		'std' => 'Enter your email address...',
		'id' => 'lp-optin-2-email',
		'type' => 'text',
		'desc' => 'Type a text/label to display on the email field.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-btntype' => array(
		'name' => 'Optin Button',
		'std' => 'premade',
		'desc' => 'Choose the optin form button you\'d like to use.',
		'options' => array(
			'premade' => 'Premade Optin Button', 
			'blank' => 'Custom Text Optin Button',
			'upload' => 'Custom Optin Button Image'
		),
		'id' => 'lp-optin-2-btntype',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-btnpremade' => array(
		'name' => 'Premade Optin Button',
		'std' => 'red/metro_4',
		'desc' => 'Choose a button from the Profits Theme\'s premade optin button.',
		'options' => array(
			'yellow-download_now' => 'Yellow Type #1 - Download Now',
			'yellow-get_access_now' => 'Yellow Type #1 - Get Access Now!',
			'yellow-get_instant_access' => 'Yellow Type #1 - Get Instant Access',
			'yellow-get_early' => 'Yellow Type #1 - Get On The Early Bird List',
			'yellow-send_video' => 'Yellow Type #1 - Send Me The Video',
			'yellow-sign_up' => 'Yellow Type #1 - Sign Up Now!',
			'yellow-subscribe' => 'Yellow Type #1 - Subscribe Now!',
			'yellow-free_access' => 'Yellow Type #1 - Yes, I want FREE Access',
			'yellow-early_bird' => 'Yellow Type #1 - Yes, Let Me In Early',
			'yellow-sign_me_up' => 'Yellow Type #1 - Yes, Sign Me Up!',
			'yellow-end' => '--',
			'orange-download_now' => 'Orange Type #1 - Download Now',
			'orange-get_access_now' => 'Orange Type #1 - Get Access Now!',
			'orange-get_instant_access' => 'Orange Type #1 - Get Instant Access',
			'orange-get_early' => 'Orange Type #1 - Get On The Early Bird List',
			'orange-send_video' => 'Orange Type #1 - Send Me The Video',
			'orange-sign_up' => 'Orange Type #1 - Sign Up Now!',
			'orange-subscribe' => 'Orange Type #1 - Subscribe Now!',
			'orange-free_access' => 'Orange Type #1 - Yes, I want FREE Access',
			'orange-early_bird' => 'Orange Type #1 - Yes, Let Me In Early',
			'orange-sign_me_up' => 'Orange Type #1 - Yes, Sign Me Up Now!',
			'orange-end' => '--',
			'red-download_now' => 'Red Type #1 - Download Now',
			'red-get_access_now' => 'Red Type #1 - Get Access Now!',
			'red-get_instant_access' => 'Red Type #1 - Get Instant Access',
			'red-get_early' => 'Red Type #1 - Get On The Early Bird List',
			'red-send_video' => 'Red Type #1 - Send Me The Video',
			'red-sign_up' => 'Red Type #1 - Sign Up Now!',
			'red-subscribe' => 'Red Type #1 - Subscribe Now!',
			'red-free_access' => 'Red Type #1 - Yes, I want FREE Access',
			'red-early_bird' => 'Red Type #1 - Yes, Let Me In Early',
			'red-sign_me_up' => 'Red Type #1 - Yes, Sign Me Up Now!',
			'red-end' => '--',
			'green-download_now' => 'Green Type #1 - Download Now',
			'green-get_access_now' => 'Green Type #1 - Get Access Now!',
			'green-get_instant_access' => 'Green Type #1 - Get Instant Access',
			'green-get_early' => 'Green Type #1 - Get On The Early Bird List',
			'green-send_video' => 'Green Type #1 - Send Me The Video',
			'green-sign_up' => 'Green Type #1 - Sign Up Now!',
			'green-subscribe' => 'Green Type #1 - Subscribe Now!',
			'green-free_access' => 'Green Type #1 - Yes, I want FREE Access',
			'green-early_bird' => 'Green Type #1 - Yes, Let Me In Early',
			'green-sign_me_up' => 'Green Type #1 - Yes, Sign Me Up Now!',
			'green-end' => '--',
			'blue-download_now' => 'Blue Type #1 - Download Now',
			'blue-get_access_now' => 'Blue Type #1 - Get Access Now!',
			'blue-get_instant_access' => 'Blue Type #1 - Get Instant Access',
			'blue-get_early' => 'Blue Type #1 - Get On The Early Bird List',
			'blue-send_video' => 'Blue Type #1 - Send Me The Video',
			'blue-sign_up' => 'Blue Type #1 - Sign Up Now!',
			'blue-subscribe' => 'Blue Type #1 - Subscribe Now!',
			'blue-free_access' => 'Blue Type #1 - Yes, I want FREE Access',
			'blue-early_bird' => 'Blue Type #1 - Yes, Let Me In Early',
			'blue-sign_me_up' => 'Blue Type #1 - Yes, Sign Me Up Now!',
            'new-start' => '--',
			'yellow/metro_1' => 'Yellow Type #2 - Download Now',
			'yellow/metro_2' => 'Yellow Type #2 - Yes, Let Me In Early',
			'yellow/metro_3' => 'Yellow Type #2 - Get Access Now!',
			'yellow/metro_4' => 'Yellow Type #2 - Get Instant Access',
			'yellow/metro_5' => 'Yellow Type #2 - Sign Up Now!',
			'yellow/metro_6' => 'Yellow Type #2 - Subscribe Now!',
            'yellow1-end' => '--',
            'red/metro_1' => 'Red Type #2 - Download Now',
			'red/metro_2' => 'Red Type #2 - Yes, Let Me In Early',
			'red/metro_3' => 'Red Type #2 - Get Access Now!',
			'red/metro_4' => 'Red Type #2 - Get Instant Access',
			'red/metro_5' => 'Red Type #2 - Sign Up Now!',
			'red/metro_6' => 'Red Type #2 - Subscribe Now!',
            'red1-end' => '--',
            'orange/metro_1' => 'Orange Type #2 - Download Now',
			'orange/metro_2' => 'Orange Type #2 - Yes, Let Me In Early',
			'orange/metro_3' => 'Orange Type #2 - Get Access Now!',
			'orange/metro_4' => 'Orange Type #2 - Get Instant Access',
			'orange/metro_5' => 'Orange Type #2 - Sign Up Now!',
			'orange/metro_6' => 'Orange Type #2 - Subscribe Now!',
            'orange1-end' => '--',
            'green/metro_1' => 'green Type #2 - Download Now',
			'green/metro_2' => 'Green Type #2 - Yes, Let Me In Early',
			'green/metro_3' => 'Green Type #2 - Get Access Now!',
			'green/metro_4' => 'Green Type #2 - Get Instant Access',
			'green/metro_5' => 'Green Type #2 - Sign Up Now!',
			'green/metro_6' => 'Green Type #2 - Subscribe Now!',
            'green1-end' => '--',
            'blue/metro_1' => 'blue Type #2 - Download Now',
			'blue/metro_2' => 'Blue Type #2 - Yes, Let Me In Early',
			'blue/metro_3' => 'Blue Type #2 - Get Access Now!',
			'blue/metro_4' => 'Blue Type #2 - Get Instant Access',
			'blue/metro_5' => 'Blue Type #2 - Sign Up Now!',
			'blue/metro_6' => 'Blue Type #2 - Subscribe Now!',
            'blue1-end' => '--',
            'yellow/grunge_1' => 'Yellow Type #3 - Download Now',
			'yellow/grunge_2' => 'Yellow Type #3 - Yes, Let Me In Early',
			'yellow/grunge_3' => 'Yellow Type #3 - Get Access Now!',
			'yellow/grunge_4' => 'Yellow Type #3 - Get Instant Access',
			'yellow/grunge_5' => 'Yellow Type #3 - Sign Up Now!',
			'yellow/grunge_6' => 'Yellow Type #3 - Subscribe Now!',
            'yellow2-end' => '--',
            'red/grunge_1' => 'Red Type #3 - Download Now',
			'red/grunge_2' => 'Red Type #3 - Yes, Let Me In Early',
			'red/grunge_3' => 'Red Type #3 - Get Access Now!',
			'red/grunge_4' => 'Red Type #3 - Get Instant Access',
			'red/grunge_5' => 'Red Type #3 - Sign Up Now!',
			'red/grunge_6' => 'Red Type #3 - Subscribe Now!',
            'red2-end' => '--',          
            'orange/grunge_1' => 'Orange Type #3 - Download Now',
			'orange/grunge_2' => 'Orange Type #3 - Yes, Let Me In Early',
			'orange/grunge_3' => 'Orange Type #3 - Get Access Now!',
			'orange/grunge_4' => 'Orange Type #3 - Get Instant Access',
			'orange/grunge_5' => 'Orange Type #3 - Sign Up Now!',
			'orange/grunge_6' => 'Orange Type #3 - Subscribe Now!',
            'orange2-end' => '--',           
            'green/grunge_1' => 'Green Type #3 - Download Now',
			'green/grunge_2' => 'Green Type #3 - Yes, Let Me In Early',
			'green/grunge_3' => 'Green Type #3 - Get Access Now!',
			'green/grunge_4' => 'Green Type #3 - Get Instant Access',
			'green/grunge_5' => 'Green Type #3 - Sign Up Now!',
			'green/grunge_6' => 'Green Type #3 - Subscribe Now!',
            'green2-end' => '--',           
            'blue/grunge_1' => 'Blue Type #3 - Download Now',
			'blue/grunge_2' => 'Blue Type #3 - Yes, Let Me In Early',
			'blue/grunge_3' => 'Blue Type #3 - Get Access Now!',
			'blue/grunge_4' => 'Blue Type #3 - Get Instant Access',
			'blue/grunge_5' => 'Blue Type #3 - Sign Up Now!',
			'blue/grunge_6' => 'Blue Type #3 - Subscribe Now!',
		),
		'id' => 'lp-optin-2-btnpremade',
		'type' => 'select-template',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-btnclr' => array(
		'name' => 'Optin Button Color',
		'std' => 'orange',
		'desc' => 'Choose the color of your optin form submit button.',
		'options' => array(
           'yellow' => 'Yellow - Type #1',
            'orange' => 'Orange - Type #1',
            'red' => 'Red - Type #1',
            'green' => 'Green - Type #1',
            'blue' => 'Blue - Type #1',
            'separator1' => '--',
            'yellow1' => 'Yellow - Type #2',
            'red1' => 'Red - Type #2',
            'orange1' => 'Orange - Type #2',
            'green1' => 'Green - Type #2',
            'blue1' => 'Blue - Type #2',
            'separator2' => '--',
            'yellow2' => 'Yellow - Type #3',
            'red2' => 'Red - Type #3',
            'orange2' => 'Orange - Type #3',
            'green2' => 'Green - Type #3',
            'blue2' => 'Blue - Type #3'
    ),
		'id' => 'lp-optin-2-btnclr',
		'type' => 'select-template',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-btntxt' => array(
		'name' => 'Optin Button Text',
		'std' => 'Get Instant Access!',
		'id' => 'lp-optin-2-btntxt',
		'type' => 'text',
		'desc' => 'Type a text/label to display on your optin form submit button.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-btn-img' => array(
		'name' => 'Custom Optin Button Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your optin button image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-optin-2-btn-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-optin-2-privacy' => array(
		'name' => 'Short Privacy Policy',
		'std' => 'Your Privacy is SAFE!',
		'id' => 'lp-optin-2-privacy',
		'type' => 'textarea',
		'desc' => 'Type a short privacy policy that will be displayed below the optin form.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-optin-2-wrap-close' => array(
		'name' => 'Optin Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Free Registration + Optin
	
	'lp-register-wrap-open' => array(
		'name' => 'Registration Settings Wrap Open',
		'id' => 'lp-register-open',
		'type' => 'dialogopen',
		'title' => 'Registration Form Settings',
		'group' => 'pt_landing_meta_box'
	),

	
	'lp-register-note' => array(
		'name' => 'Registration Settings Wrap Open',
		'id' => 'lp-register-note',
		'type' => 'note',
		'desc' => '<p><strong>Note:</strong> This is a simple registration form, but this element has the ability to register your visitors to your membership site, and also add them to your opt-in list at the same time.</p>',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-style' => array(
		'name' => 'Registration/Optin Form Style',
		'std' => 'metro-grey',
		'desc' => 'You can select a cool style for your registration/optin form.',
		'options' => array(
				'plain' => 'Plain & Simple',
                    'animated' => 'Plain & Simple (w/ Animated Red Arrow)',
                    'static' => 'Plain & Simple (w/ Static Red Arrow)',
                    'separator1' => '--',
                    'rounded-blue' => 'Rounded - Blue',
                    'rounded-green' => 'Rounded - Green',
                    'rounded-grey' => 'Rounded - Grey',
                    'rounded-pink' => 'Rounded - Pink',
                    'rounded-yellow' => 'Rounded - Yellow',  
                    'separator2' => '--',
                    'gradient-blue' => 'Gradient - Blue',
                    'gradient-green' => 'Gradient - Green',
                    'gradient-orange' => 'Gradient - Orange',
                    'gradient-red' => 'Gradient - Red',
                    'separator3' => '--',
                    'canvas-grey' => 'Canvas - Grey',
                    'canvas-yellow' => 'Canvas - Yellow',
                    'canvas-red' => 'Canvas - Red',
                    'canvas-orange' => 'Canvas - Orange',
                    'canvas-green' => 'Canvas - Green',
                    'canvas-blue' => 'Canvas - Blue',
                    'separator4' => '--',
                    'modern-grey' => 'Modern - Grey',
                    'modern-yellow' => 'Modern - Yellow',
                    'modern-red' => 'Modern - Red',
                    'modern-orange' => 'Modern - Orange',            
                    'modern-green' => 'Modern - Green',
                    'modern-blue' => 'Modern - Blue',
                    'separator5' => '--',
                    'metro-grey' => 'Metro - Grey',
                    'metro-yellow' => 'Metro - Yellow',
                    'metro-red' => 'Metro - Red',
                    'metro-orange' => 'Metro - Orange',
                    'metro-green' => 'Metro - Green',
                    'metro-blue' => 'Metro - Blue',
			),
		'id' => 'lp-register-style',
		'type' => 'optstyle',
		'group' => 'pt_landing_meta_box'
		),

	'lp-register-product' => array(
		'name' => 'Choose Product / Membership Level',
		'std' => '',
		'desc' => 'Select a product/membership level that you created in <a href="' . admin_url('admin.php?page=pt_integrate_options') . '" target="_blank">Profits Theme -> Membership -> Products / Levels</a>. To automatically add the new members to your autoresponder list, please make sure that the product you choose has been associated with your autoresponder account.',
		'options' => pt_get_products(),
		'id' => 'lp-register-product',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-thanks' => array(
		'name' => 'Successful Registration Page',
		'std' => '',
		'desc' => 'Where you want to redirect members after they\'re successfully registered.',
		'options' => $pt_pages,
		'id' => 'lp-register-thanks',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-text' => array(
		'name' => 'Register/Subscribe Instruction',
		'std' => 'Simply enter your details on the form below to receive instant access...',
		'id' => 'lp-register-text',
		'type' => 'textarea',
		'desc' => 'Type an instruction on how to register/subscribe to your free membership site and mailing list.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-disable-name' => array(
		'name' => 'Don\'t show name field',
		'std' => 'false',
		'id' => 'lp-register-disable-name',
		'type' => 'checkbox',
		'desc' => 'Don\'t show name field',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-name' => array(
		'name' => 'Name Field Text',
		'std' => 'Enter your first name...',
		'id' => 'lp-register-name',
		'type' => 'text',
		'desc' => 'Type a text/label to display on the name field.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-email' => array(
		'name' => 'Email Field Text',
		'std' => 'Enter your email address...',
		'id' => 'lp-register-email',
		'type' => 'text',
		'desc' => 'Type a text/label to display on the email field.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-btntype' => array(
		'name' => 'Optin Button',
		'std' => 'premade',
		'desc' => 'Choose the registration/optin button you\'d like to use.',
		'options' => array(
			'premade' => 'Premade Optin Button', 
			'blank' => 'Custom Text Optin Button',
			'upload' => 'Custom Optin Button Image'
		),
		'id' => 'lp-register-btntype',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-btnpremade' => array(
		'name' => 'Premade Registration/Optin Button',
		'std' => 'red/metro_4',
		'desc' => 'Choose a button from the Profits Theme\'s premade optin button.',
		'options' => array(
			'yellow-download_now' => 'Yellow Type #1 - Download Now',
			'yellow-get_access_now' => 'Yellow Type #1 - Get Access Now!',
			'yellow-get_instant_access' => 'Yellow Type #1 - Get Instant Access',
			'yellow-get_early' => 'Yellow Type #1 - Get On The Early Bird List',
			'yellow-send_video' => 'Yellow Type #1 - Send Me The Video',
			'yellow-sign_up' => 'Yellow Type #1 - Sign Up Now!',
			'yellow-subscribe' => 'Yellow Type #1 - Subscribe Now!',
			'yellow-free_access' => 'Yellow Type #1 - Yes, I want FREE Access',
			'yellow-early_bird' => 'Yellow Type #1 - Yes, Let Me In Early',
			'yellow-sign_me_up' => 'Yellow Type #1 - Yes, Sign Me Up!',
			'yellow-end' => '--',
			'orange-download_now' => 'Orange Type #1 - Download Now',
			'orange-get_access_now' => 'Orange Type #1 - Get Access Now!',
			'orange-get_instant_access' => 'Orange Type #1 - Get Instant Access',
			'orange-get_early' => 'Orange Type #1 - Get On The Early Bird List',
			'orange-send_video' => 'Orange Type #1 - Send Me The Video',
			'orange-sign_up' => 'Orange Type #1 - Sign Up Now!',
			'orange-subscribe' => 'Orange Type #1 - Subscribe Now!',
			'orange-free_access' => 'Orange Type #1 - Yes, I want FREE Access',
			'orange-early_bird' => 'Orange Type #1 - Yes, Let Me In Early',
			'orange-sign_me_up' => 'Orange Type #1 - Yes, Sign Me Up Now!',
			'orange-end' => '--',
			'red-download_now' => 'Red Type #1 - Download Now',
			'red-get_access_now' => 'Red Type #1 - Get Access Now!',
			'red-get_instant_access' => 'Red Type #1 - Get Instant Access',
			'red-get_early' => 'Red Type #1 - Get On The Early Bird List',
			'red-send_video' => 'Red Type #1 - Send Me The Video',
			'red-sign_up' => 'Red Type #1 - Sign Up Now!',
			'red-subscribe' => 'Red Type #1 - Subscribe Now!',
			'red-free_access' => 'Red Type #1 - Yes, I want FREE Access',
			'red-early_bird' => 'Red Type #1 - Yes, Let Me In Early',
			'red-sign_me_up' => 'Red Type #1 - Yes, Sign Me Up Now!',
			'red-end' => '--',
			'green-download_now' => 'Green Type #1 - Download Now',
			'green-get_access_now' => 'Green Type #1 - Get Access Now!',
			'green-get_instant_access' => 'Green Type #1 - Get Instant Access',
			'green-get_early' => 'Green Type #1 - Get On The Early Bird List',
			'green-send_video' => 'Green Type #1 - Send Me The Video',
			'green-sign_up' => 'Green Type #1 - Sign Up Now!',
			'green-subscribe' => 'Green Type #1 - Subscribe Now!',
			'green-free_access' => 'Green Type #1 - Yes, I want FREE Access',
			'green-early_bird' => 'Green Type #1 - Yes, Let Me In Early',
			'green-sign_me_up' => 'Green Type #1 - Yes, Sign Me Up Now!',
			'green-end' => '--',
			'blue-download_now' => 'Blue Type #1 - Download Now',
			'blue-get_access_now' => 'Blue Type #1 - Get Access Now!',
			'blue-get_instant_access' => 'Blue Type #1 - Get Instant Access',
			'blue-get_early' => 'Blue Type #1 - Get On The Early Bird List',
			'blue-send_video' => 'Blue Type #1 - Send Me The Video',
			'blue-sign_up' => 'Blue Type #1 - Sign Up Now!',
			'blue-subscribe' => 'Blue Type #1 - Subscribe Now!',
			'blue-free_access' => 'Blue Type #1 - Yes, I want FREE Access',
			'blue-early_bird' => 'Blue Type #1 - Yes, Let Me In Early',
			'blue-sign_me_up' => 'Blue Type #1 - Yes, Sign Me Up Now!',
            'new-start' => '--',
			'yellow/metro_1' => 'Yellow Type #2 - Download Now',
			'yellow/metro_2' => 'Yellow Type #2 - Yes, Let Me In Early',
			'yellow/metro_3' => 'Yellow Type #2 - Get Access Now!',
			'yellow/metro_4' => 'Yellow Type #2 - Get Instant Access',
			'yellow/metro_5' => 'Yellow Type #2 - Sign Up Now!',
			'yellow/metro_6' => 'Yellow Type #2 - Subscribe Now!',
            'yellow1-end' => '--',
            'red/metro_1' => 'Red Type #2 - Download Now',
			'red/metro_2' => 'Red Type #2 - Yes, Let Me In Early',
			'red/metro_3' => 'Red Type #2 - Get Access Now!',
			'red/metro_4' => 'Red Type #2 - Get Instant Access',
			'red/metro_5' => 'Red Type #2 - Sign Up Now!',
			'red/metro_6' => 'Red Type #2 - Subscribe Now!',
            'red1-end' => '--',
            'orange/metro_1' => 'Orange Type #2 - Download Now',
			'orange/metro_2' => 'Orange Type #2 - Yes, Let Me In Early',
			'orange/metro_3' => 'Orange Type #2 - Get Access Now!',
			'orange/metro_4' => 'Orange Type #2 - Get Instant Access',
			'orange/metro_5' => 'Orange Type #2 - Sign Up Now!',
			'orange/metro_6' => 'Orange Type #2 - Subscribe Now!',
            'orange1-end' => '--',
            'green/metro_1' => 'green Type #2 - Download Now',
			'green/metro_2' => 'Green Type #2 - Yes, Let Me In Early',
			'green/metro_3' => 'Green Type #2 - Get Access Now!',
			'green/metro_4' => 'Green Type #2 - Get Instant Access',
			'green/metro_5' => 'Green Type #2 - Sign Up Now!',
			'green/metro_6' => 'Green Type #2 - Subscribe Now!',
            'green1-end' => '--',
            'blue/metro_1' => 'blue Type #2 - Download Now',
			'blue/metro_2' => 'Blue Type #2 - Yes, Let Me In Early',
			'blue/metro_3' => 'Blue Type #2 - Get Access Now!',
			'blue/metro_4' => 'Blue Type #2 - Get Instant Access',
			'blue/metro_5' => 'Blue Type #2 - Sign Up Now!',
			'blue/metro_6' => 'Blue Type #2 - Subscribe Now!',
            'blue1-end' => '--',
            'yellow/grunge_1' => 'Yellow Type #3 - Download Now',
			'yellow/grunge_2' => 'Yellow Type #3 - Yes, Let Me In Early',
			'yellow/grunge_3' => 'Yellow Type #3 - Get Access Now!',
			'yellow/grunge_4' => 'Yellow Type #3 - Get Instant Access',
			'yellow/grunge_5' => 'Yellow Type #3 - Sign Up Now!',
			'yellow/grunge_6' => 'Yellow Type #3 - Subscribe Now!',
            'yellow2-end' => '--',
            'red/grunge_1' => 'Red Type #3 - Download Now',
			'red/grunge_2' => 'Red Type #3 - Yes, Let Me In Early',
			'red/grunge_3' => 'Red Type #3 - Get Access Now!',
			'red/grunge_4' => 'Red Type #3 - Get Instant Access',
			'red/grunge_5' => 'Red Type #3 - Sign Up Now!',
			'red/grunge_6' => 'Red Type #3 - Subscribe Now!',
            'red2-end' => '--',          
            'orange/grunge_1' => 'Orange Type #3 - Download Now',
			'orange/grunge_2' => 'Orange Type #3 - Yes, Let Me In Early',
			'orange/grunge_3' => 'Orange Type #3 - Get Access Now!',
			'orange/grunge_4' => 'Orange Type #3 - Get Instant Access',
			'orange/grunge_5' => 'Orange Type #3 - Sign Up Now!',
			'orange/grunge_6' => 'Orange Type #3 - Subscribe Now!',
            'orange2-end' => '--',           
            'green/grunge_1' => 'Green Type #3 - Download Now',
			'green/grunge_2' => 'Green Type #3 - Yes, Let Me In Early',
			'green/grunge_3' => 'Green Type #3 - Get Access Now!',
			'green/grunge_4' => 'Green Type #3 - Get Instant Access',
			'green/grunge_5' => 'Green Type #3 - Sign Up Now!',
			'green/grunge_6' => 'Green Type #3 - Subscribe Now!',
            'green2-end' => '--',           
            'blue/grunge_1' => 'Blue Type #3 - Download Now',
			'blue/grunge_2' => 'Blue Type #3 - Yes, Let Me In Early',
			'blue/grunge_3' => 'Blue Type #3 - Get Access Now!',
			'blue/grunge_4' => 'Blue Type #3 - Get Instant Access',
			'blue/grunge_5' => 'Blue Type #3 - Sign Up Now!',
			'blue/grunge_6' => 'Blue Type #3 - Subscribe Now!',
		),
		'id' => 'lp-register-btnpremade',
		'type' => 'select-template',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-btnclr' => array(
		'name' => 'Registration/Optin Button Color',
		'std' => 'orange',
		'desc' => 'Choose the color of your registration/optin form submit button.',
		'options' => array(
		'yellow' => 'Yellow - Type #1',
            'orange' => 'Orange - Type #1',
            'red' => 'Red - Type #1',
            'green' => 'Green - Type #1',
            'blue' => 'Blue - Type #1',
            'separator1' => '--',
            'yellow1' => 'Yellow - Type #2',
            'red1' => 'Red - Type #2',
            'orange1' => 'Orange - Type #2',
            'green1' => 'Green - Type #2',
            'blue1' => 'Blue - Type #2',
            'separator2' => '--',
            'yellow2' => 'Yellow - Type #3',
            'red2' => 'Red - Type #3',
            'orange2' => 'Orange - Type #3',
            'green2' => 'Green - Type #3',
            'blue2' => 'Blue - Type #3'
		),
		'id' => 'lp-register-btnclr',
		'type' => 'select-template',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-btntxt' => array(
		'name' => 'Registration/Optin Button Text',
		'std' => 'Get Instant Access!',
		'id' => 'lp-register-btntxt',
		'type' => 'text',
		'desc' => 'Type a text/label to display on your registration/optin form submit button.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-btn-img' => array(
		'name' => 'Custom Registration/Optin Button Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your registration/optin button image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-register-btn-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-register-privacy' => array(
		'name' => 'Short Privacy Policy',
		'std' => 'Your Privacy is SAFE!',
		'id' => 'lp-register-privacy',
		'type' => 'textarea',
		'desc' => 'Type a short privacy policy that will be displayed below the optin form.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-register-wrap-close' => array(
		'name' => 'Optin Settings Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Optin Warning
	
	'lp-warning-open' => array(
		'name' => 'Warning Wrap Open',
		'id' => 'lp-warning-open',
		'type' => 'dialogopen',
		'title' => 'Optin Warning Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-warning-text' => array(
		'name' => 'Warning Text',  
		'std' => 'Warning, you change this line to whatever you like to warn the visitors and subscribe immediately!',  
		'desc' => 'The warning text that will be displayed inside the warning sign.',
		'id' => 'lp-warning-text',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box',
		),

	'lp-warning-close' => array(
		'name' => 'Warning Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Social Buttons
	
	'lp-social-open' => array(
		'name' => 'Social Wrap Open',
		'id' => 'lp-social-open',
		'type' => 'dialogopen',
		'title' => 'Social Buttons Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-social-fb' => array(
		'name' => 'Facebook',  
		'std' => 'true',  
		'desc' => 'Add Facebook Share Button',
		'id' => 'lp-social-fb',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
	),

	
	'lp-social-tw' => array(
		'name' => 'Twitter',  
		'std' => 'true',  
		'desc' => 'Add Twitter Share Button',
		'id' => 'lp-social-tw',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
	),

	'lp-social-set' => array(
		'name' => 'Button Set',  
		'std' => 'set1',  
		'desc' => 'Select the type of the social buttons you want to display.',
		'id' => 'lp-social-set',
		'type' => 'socialset',
		'options' => array(
				'1' => 'Set 1',
				'2' => 'Set 2',
				'3' => 'Set 3',
			),
		'group' => 'pt_landing_meta_box',
	),


	'lp-social-tw-txt' => array(
		'name' => 'Custom Tweet',  
		'std' => 'Currently reading <%page_title%> - <%page_url%>',  
		'desc' => 'You can modify the tweet content (max. 140 characters). <br /><br /><strong>Custom Variables:</strong><br />Page Title - <em><%page_title%></em><br />Page URL - <em><%page_url%></em>',
		'id' => 'lp-social-tw-txt',
		'type' => 'twitter',
		'group' => 'pt_landing_meta_box',
	),

	'lp-social-align' => array(
		'name' => 'Button Alignment',  
		'std' => 'center',  
		'desc' => '',
		'id' => 'lp-social-align',
		'type' => 'select',
		'options' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			),
		'group' => 'pt_landing_meta_box',
	),

	'lp-social-txt' => array(
		'name' => 'Call To Action Text (optional)',  
		'std' => '',  
		'desc' => '',
		'id' => 'lp-social-txt',
		'type' => 'text',
		'group' => 'pt_landing_meta_box',
		),

	'lp-social-close' => array(
		'name' => 'Social Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),


	// Fake Video

	'lp-fake-video-open' => array(
		'name' => 'Fake Video Wrap Open',
		'id' => 'lp-fake-video-open',
		'type' => 'dialogopen',
		'title' => 'Fake Video Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-fake-video-img' => array(
		'name' => 'Fake Video Image URL', 
		'std' => '',
		'desc' => 'Type the full path URL to your Fake Video image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><strong>Note:</strong> A fake video player will be added automatically so can just upload any image.',
		'id' => 'lp-fake-video-img', 
		'type' => 'upload',
		'group' => 'pt_landing_meta_box',
		),

	'lp-fake-video-text' => array(
		'name' => 'Fake Video Warning Text',  
		'std' => 'AWESOME! You\'ll gonna love this FREE video. Just register below, and you\'ll get instant access!',  
		'desc' => 'The warning that will be shown if user trying to view or click your fake video.',
		'id' => 'lp-fake-video-text',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box',
		),

	'lp-fake-video-close' => array(
		'name' => 'Fake Video Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Embed Video

	'lp-svideo-open' => array(
		'name' => 'Simple Video Wrap Open',
		'id' => 'lp-svideo-open',
		'type' => 'dialogopen',
		'title' => 'Simple Video Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-svideo-code' => array(
		'name' => 'Embed Video',  
		'std' => '<iframe width="560" height="315" src="//www.youtube.com/embed/UkqLLwdKUCk?rel=0" frameborder="0" allowfullscreen></iframe>',  
		'desc' => 'Paste the video embed code from the site like Youtube, Vimeo, Viddler, Daily Motion, etc.',
		'id' => 'lp-svideo-code',
		'type' => 'embed',
		'group' => 'pt_landing_meta_box'
		),

	'lp-svideo-close' => array(
		'name' => 'Simple Video Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-svideo-2-open' => array(
		'name' => 'Simple Video 2 Wrap Open',
		'id' => 'lp-svideo-2-open',
		'type' => 'dialogopen',
		'title' => 'Simple Video 2 Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-svideo-2-code' => array(
		'name' => 'Embed Video',  
		'std' => '<iframe width="560" height="315" src="//www.youtube.com/embed/UkqLLwdKUCk?rel=0" frameborder="0" allowfullscreen></iframe>',  
		'desc' => 'Paste the video embed code from the site like Youtube, Vimeo, Viddler, Daily Motion, etc.',
		'id' => 'lp-svideo-2-code',
		'type' => 'embed',
		'group' => 'pt_landing_meta_box'
		),

	'lp-svideo-2-close' => array(
		'name' => 'Simple Video Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Sidebar Widgets

	'lp-sidebar-open' => array(
		'name' => 'Sidebar Wrap Open',
		'id' => 'lp-sidebar-open',
		'type' => 'dialogopen',
		'title' => 'Sidebar Widgets',
		'group' => 'pt_landing_meta_box'
	),

	'lp-sidebar-note' => array(  
		'desc' => 'You can shows widgets in landing page using this element. Drag any widgets to the "landing page" in <a href="' . admin_url('widgets.php') . '" target="_blank">Appearance -> Widgets</a> (open in new window).',
		'id' => 'lp-sidebar-note',
		'type' => 'note', 
		'group' => 'pt_landing_meta_box',
	),

	'lp-sidebar-close' => array(
		'name' => 'Sidebar Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Advanced Video 

	'lp-video-open' => array(
		'name' => 'Video Wrap Open',
		'id' => 'lp-video-open',
		'type' => 'dialogopen',
		'title' => 'Advanced Video Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-video-player' => array(
		'name' => 'Video Player',
		'std' => 'flow',
		'id' => 'lp-video-player',
		'type' => 'select',
		'options' => $pt_video_player,
		'desc' => 'Choose the video player you would like to use.<br /><br /><a href="http://flowplayer.org/" target="_blank">Flowplayer</a> is an open source web video player software, which created by <a href="http://flowplayer.org/company.html" target="_blank">Flowplayer Ltd</a>.' . $pt_jw_info,
		'group' => 'pt_landing_meta_box'
	),

	'lp-video-url' => array(
		'name' => 'Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your web video (must include http://). Supported formats: <em>FLV</em> and <em>H.264/MP4</em>.<br /><br />',
		'id' => 'lp-video-url',
		'type' => 'videourl',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-html5' => array(
		'id' => 'lp-video-html5',
		'type' => 'divwrapopen',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-html5-note' => array(
		'name' => 'HTML5 Video Note',  
		'desc' => '<p>The HTML5 video player will use one of the videos you provide below, depending in which browser your visitors open this landing page.</p>',
		'id' => 'lp-video-html5-note',
		'type' => 'note',
		'group' => 'pt_landing_meta_box',
		),


	'lp-video-html5-mp4' => array(
		'name' => 'MP4 Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your H.264/MP4 video (must include http://). This Mp4 video will be played in Safari, Chrome, and IE9, and also Iphone and Ipad (if compatible). You can convert your video to H.264/MP4 using <a href="http://handbrake.fr/downloads.php" target="_blank">Handbrake</a>.',
		'id' => 'lp-video-html5-mp4',
		'type' => 'text',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-html5-ogg' => array(
		'name' => 'Ogg Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your Ogg/Ogv video (must include http://). This Ogg video will be played in Firefox (3.5+), Chrome (3+), and Opera (10.54+). You can convert your video to Ogg/Ogv using a Firefox Add-on called <a href="http://firefogg.org" target="_blank">Firefogg</a>.',
		'id' => 'lp-video-html5-ogg',
		'type' => 'text',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-html5-webm' => array(
		'name' => 'WebM Video URL (optional)',
		'std' => '',  
		'desc' => 'Type the full path URL to your WebM video (must include http://). This WebM video will be played in Firefox (4+), Chrome (6+ or Chromium), and Opera (10.60+). You can convert your video to WebM using a Firefox Add-on called <a href="http://firefogg.org" target="_blank">Firefogg</a>.<br /><br />',
		'id' => 'lp-video-html5-webm',
		'type' => 'videourl',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-html5-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-img' => array(
		'name' => 'Video Splash Image URL',  
		'std' => '',  
		'desc' => 'Type the full path to your video splash image (must include http://), or you can upload a new one by clicking the "Upload Image" button. It will act as a splash image and will only be shown if you unchecked the \'Auto Play Video\' setting.',
		'id' => 'lp-video-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-width' => array(
		'name' => 'Video Width',  
		'std' => '640',  
		'desc' => 'Your preffered width for the video.',
		'id' => 'lp-video-width',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-height' => array(
		'name' => 'Video Height',
		'std' => '360',  
		'desc' => 'Your preffered height for the video.',
		'id' => 'lp-video-height',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-auto' => array(
		'name' => 'Auto Play Video',  
		'std' => 'true',  
		'desc' => 'Auto Play Video',
		'id' => 'lp-video-auto',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-control' => array(
		'name' => 'Auto Hide Video Control',  
		'std' => 'true',  
		'desc' => 'Auto Hide Video Control',
		'id' => 'lp-video-control',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-control-disable' => array(
		'name' => 'Disable Video Control',  
		'std' => 'false',  
		'desc' => 'Disable Video Control',
		'id' => 'lp-video-control-disable',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-download' => array(
		'name' => 'Allow Users To Download Video',  
		'std' => 'false',  
		'desc' => 'Allow Users To Download Video',
		'id' => 'lp-video-download',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),
	
	'lp-video-close' => array(
		'name' => 'Video Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),
	
	//2
	'lp-video-2-open' => array(
		'name' => 'Video 2 Wrap Open',
		'id' => 'lp-video-2-open',
		'type' => 'dialogopen',
		'title' => 'Advanced Video Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-video-2-player' => array(
		'name' => 'Video Player',
		'std' => 'flow',
		'id' => 'lp-video-2-player',
		'type' => 'select',
		'options' => $pt_video_player,
		'desc' => 'Choose the video player you would like to use.<br /><br /><a href="http://flowplayer.org/" target="_blank">Flowplayer</a> is an open source web video player software, which created by <a href="http://flowplayer.org/company.html" target="_blank">Flowplayer Ltd</a>.' . $pt_jw_info,
		'group' => 'pt_landing_meta_box'
	),

	'lp-video-2-url' => array(
		'name' => 'Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your web video (must include http://). Supported formats: <em>FLV</em> and <em>H.264/MP4</em>.<br /><br />',
		'id' => 'lp-video-2-url',
		'type' => 'videourl',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-html5' => array(
		'id' => 'lp-video-2-html5',
		'type' => 'divwrapopen',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-html5-note' => array(
		'name' => 'HTML5 Video Note',  
		'desc' => '<p>The HTML5 video player will use one of the videos you provide below, depending in which browser your visitors open this landing page.</p>',
		'id' => 'lp-video-2-html5-note',
		'type' => 'note',
		'group' => 'pt_landing_meta_box',
		),


	'lp-video-2-html5-mp4' => array(
		'name' => 'MP4 Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your H.264/MP4 video (must include http://). This Mp4 video will be played in Safari, Chrome, and IE9, and also Iphone and Ipad (if compatible). You can convert your video to H.264/MP4 using <a href="http://handbrake.fr/downloads.php" target="_blank">Handbrake</a>.',
		'id' => 'lp-video-2-html5-mp4',
		'type' => 'text',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-html5-ogg' => array(
		'name' => 'Ogg Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your Ogg/Ogv video (must include http://). This Ogg video will be played in Firefox (3.5+), Chrome (3+), and Opera (10.54+). You can convert your video to Ogg/Ogv using a Firefox Add-on called <a href="http://firefogg.org" target="_blank">Firefogg</a>.',
		'id' => 'lp-video-2-html5-ogg',
		'type' => 'text',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-html5-webm' => array(
		'name' => 'WebM Video URL (optional)',
		'std' => '',  
		'desc' => 'Type the full path URL to your WebM video (must include http://). This WebM video will be played in Firefox (4+), Chrome (6+ or Chromium), and Opera (10.60+). You can convert your video to WebM using a Firefox Add-on called <a href="http://firefogg.org" target="_blank">Firefogg</a>.<br /><br />',
		'id' => 'lp-video-2-html5-webm',
		'type' => 'videourl',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-html5-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-img' => array(
		'name' => 'Video Splash Image URL',  
		'std' => '',  
		'desc' => 'Type the full path to your video splash image (must include http://), or you can upload a new one by clicking the "Upload Image" button. It will act as a splash image and will only be shown if you unchecked the \'Auto Play Video\' setting.',
		'id' => 'lp-video-2-img',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-width' => array(
		'name' => 'Video Width',  
		'std' => '640',  
		'desc' => 'Your preffered width for the video.',
		'id' => 'lp-video-2-width',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-height' => array(
		'name' => 'Video Height',
		'std' => '360',  
		'desc' => 'Your preffered height for the video.',
		'id' => 'lp-video-2-height',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' px',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-auto' => array(
		'name' => 'Auto Play Video',  
		'std' => 'true',  
		'desc' => 'Auto Play Video',
		'id' => 'lp-video-2-auto',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-control' => array(
		'name' => 'Auto Hide Video Control',  
		'std' => 'true',  
		'desc' => 'Auto Hide Video Control',
		'id' => 'lp-video-2-control',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-control-disable' => array(
		'name' => 'Disable Video Control',  
		'std' => 'false',  
		'desc' => 'Disable Video Control',
		'id' => 'lp-video-2-control-disable',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),

	'lp-video-2-download' => array(
		'name' => 'Allow Users To Download Video',  
		'std' => 'false',  
		'desc' => 'Allow Users To Download Video',
		'id' => 'lp-video-2-download',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box',
		),
	
	'lp-video-2-close' => array(
		'name' => 'Video Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Main Content

	'lp-content-open' => array(
		'name' => 'Content Wrap Open',
		'id' => 'lp-content-open',
		'type' => 'dialogopen',
		'title' => 'Main Content Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-content-heading-font' => array(
		'name' => 'Content Headings Font',
		'std' => 'Open Sans',
		'id' => 'lp-content-heading-font',
		'type' => 'font',
		'options' => $pt_fonts->getFonts(),
		'desc' => 'Choose a font for all the headings (h1-h6) inside the main content.<br /><br /><em>* non web-safe font</em><br /><em>** cufon font</em><br /><em>*** google font</em>',
		'group' => 'pt_landing_meta_box'
	),

	'lp-content-font' => array(
		'name' => 'Text Font',
		'std' => 'Open Sans',
		'id' => 'lp-content-font',
		'type' => 'font',
		'options' => $pt_fonts->getFonts(),
		'desc' => 'Choose a font for your main content. <em>* non web-safe font</em>',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-content-size' => array(
		'name' => 'Text Font Size',
		'std' => '16',
		'id' => 'lp-content-size',
		'type' => 'size',
		'desc' => 'Select the font size for your main content.<br /><br /><strong>Note:</strong> Please use the default WP Post/Page Editor to edit the content of your landing page. Only use these settings if you need to change the landing page\'s font style.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-content-line-height' => array(
		'name' => 'Text Line-Height',
		'std' => '25',
		'id' => 'lp-content-line-height',
		'type' => 'text',
		'suffix' => ' px',
		'width' => '60px',
		'desc' => 'This specifies the height of an in-line text (including white spaces) in every paragraph.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-content-close' => array(
		'name' => 'Video Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Comments

	'lp-comments-open' => array(
		'name' => 'Comments Wrap Open',
		'id' => 'lp-comments-open',
		'type' => 'dialogopen',
		'title' => 'Comments Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-comments-type' => array(
		'name' => 'Comment Type',
		'std' => 'wpcomm',
		'id' => 'lp-comments-type',
		'type' => 'select',
		'options' => array(
				'wpcomm' => 'Wordpress Comments',
				'fbcomm' => 'Facebook Comments',
				'allcomm' => 'Both Facebook and Wordpress',
			),
		'desc' => 'Choose the type of comment system you would like to use.',
		'group' => 'pt_landing_meta_box'
	),

	'lp-comments-text' => array(
		'name' => 'Call To Action (optional)',
		'std' => '',  
		'desc' => 'Short sentence to ask visitors for their comments.',
		'id' => 'lp-comments-text',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
		),

	'lp-comments-sort' => array(
		'name' => 'First to Show',
		'std' => '',
		'id' => 'lp-comments-sort',
		'type' => 'select',
		'options' => array(
				'wpmain' => 'Wordpress First, then Facebook',
				'fbmain' => 'Facebook First, then Wordpress',
			),
		'desc' => 'Choose/arrange comment system you want to display first.',
		'group' => 'pt_landing_meta_box'
	),
	
	'lp-fb-wrap-open' => array(
		'id' => 'lp-fb-wrap-open',
		'type' => 'divwrapopen',
		'group' => 'pt_landing_meta_box'
	),

	'lp-comments-fb-appid' => array(
		'name' => 'Facebook Application ID',
		'std' => $pt_fb_appid,  
		'desc' => 'Create a new application at <a href="http://developers.facebook.com/setup/" target="_blank">http://developers.facebook.com/setup/</a> to obtain a Facebook App Id, and then paste it here.',
		'id' => 'lp-comments-fb-appid',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
		),

	'lp-comments-fb-count' => array(
		'name' => 'Facebook Comments Per Page',
		'std' => '10',  
		'desc' => 'How many facebook comments to show per page.',
		'id' => 'lp-comments-fb-count',
		'options' => array(
				'10' => '10 comments',
				'20' => '20 comments',
				'30' => '30 comments',
				'40' => '40 comments',
				'50' => '50 comments',
			),
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
		),

	'lp-comments-fb-xid' => array(
		'name' => 'Facebook XID',
		'std' => $xid,
		'desc' => '',
		'id' => 'lp-comments-fb-xid',
		'type' => 'hidden',
		'group' => 'pt_landing_meta_box'
		),

	'lp-fb-wrap-close' => array(
		'id' => 'lp-fb-wrap-close',
		'type' => 'divwrapclose',
		'group' => 'pt_landing_meta_box'
	),

	'lp-comments-close' => array(
		'name' => 'Comments Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	'lp-settings-script' => array(
		'name' => 'Dialog Script',
		'type' => 'dialogscript',
		'group' => 'pt_landing_meta_box'
	),

	// Add To Cart

	'lp-order-open' => array(
		'name' => 'Add To Cart Wrap Open',
		'id' => 'lp-order-open',
		'type' => 'dialogopen',
		'title' => 'Add To Cart Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-addbtn' => array(
		'name' => 'Choose Add To Cart Button',
		'std' => 'yellow_add-to-cart.png',
		'desc' => 'Select the \'Add To Cart\' button that you want to use.',
		'options' => array(
            'yellow_add-to-cart.png' => 'Button Type #1 - Yellow',
			'red_add-to-cart.png' => 'Button Type #1 - Red',
			'orange_add-to-cart2.png' => 'Button Type #2 - Orange',
			'red_add-to-cart2.png' => 'Button Type #2 - Red',
			'orange_add-to-cart3.png' => 'Button Type #3 - Orange',
			'red_add-to-cart3.png' => 'Button Type #3 - Red',
			'cart-orange.jpg' => 'Button Type #4 - Orange',
			'cart-red.jpg' => 'Button Type #4 - Red',
			'add_to_cart/metro_1.png' => 'Button Type #5 - Yellow',
            'add_to_cart/metro_2.png' => 'Button Type #5 - Red',
            'add_to_cart/metro_3.png' => 'Button Type #5 - Orange',
            'add_to_cart/metro_4.png' => 'Button Type #5 - Green',
            'add_to_cart/metro_5.png' => 'Button Type #5 - Blue',
            'add_to_cart/grunge_1.png' => 'Button Type #6 - Yellow',
            'add_to_cart/grunge_2.png' => 'Button Type #6 - Red',
            'add_to_cart/grunge_3.png' => 'Button Type #6 - Orange',
            'add_to_cart/grunge_4.png' => 'Button Type #6 - Green',
            'add_to_cart/grunge_5.png' => 'Button Type #6 - Blue',
            'add_to_cart/gloss_1.png' => 'Button Type #7 - Yellow',
            'add_to_cart/gloss_2.png' => 'Button Type #7 - Red',
            'add_to_cart/gloss_3.png' => 'Button Type #7 - Orange',
            'add_to_cart/gloss_4.png' => 'Button Type #7 - Green',
            'add_to_cart/gloss_5.png' => 'Button Type #7 - Blue',
			
		),
		'id' => 'lp-order-addbtn',
		'type' => 'addtocart',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-addsize' => array(
		'name' => 'Button Size',
		'std' => 'medium',
		'desc' => 'Select the size of the \'Add To Cart\' button.',
		'options' => array(
			'small' => 'Small',
			'medium' => 'Medium',
			'big' => 'Big',
		),
		'id' => 'lp-order-addsize',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-addurl' => array(
		'name' => 'Order Page URL',
		'std' => 'http://',  
		'desc' => 'Type the full URL to your order page (including http://).',
		'id' => 'lp-order-addurl',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
		),

	'lp-order-addurl-target' => array(
		'name' => 'Order Page URL Target',
		'std' => 'medium',
		'desc' => 'Where you want your order page to appear.',
		'options' => array(
			'_self' => 'Open In Current Window',
			'_blank' => 'Open In New Window',
		),
		'id' => 'lp-order-addurl-target',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-addarrow' => array(
		'name' => 'Display Big Red Arrow Above The Button',
		'std' => 'false',  
		'desc' => 'Display Big Red Arrow Above The Button',
		'id' => 'lp-order-addarrow',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
		),

	'lp-order-addcode' => array(
		'name' => 'Insert HTML Code:',
		'std' => '',  
		'desc' => 'You may also insert html code if you have custom \'Add To Cart\' button. If you use this field, then the settings above will be ignored.',
		'id' => 'lp-order-addcode',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
		),

	'lp-order-addtimed' => array(
		'name' => 'Button Timer',
		'std' => '0',
		'desc' => 'Use this field if you want your Add To Cart button to be shown after a certain amount of time. Type how long you want to hide the button before it show (in seconds); If you want the button to show immediately, just type \'0\' (zero).',
		'id' => 'lp-order-addtimed',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' second(s)',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-close' => array(
		'name' => 'Add To Cart Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),
	
	// Add To Cart 2

	'lp-order-2-open' => array(
		'name' => 'Add To Cart Wrap Open',
		'id' => 'lp-order-2-open',
		'type' => 'dialogopen',
		'title' => 'Add To Cart Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-2-addbtn' => array(
		'name' => 'Choose Add To Cart Button',
		'std' => 'yellow_add-to-cart.png',
		'desc' => 'Select the \'Add To Cart\' button that you want to use.',
		'options' => array(
            'yellow_add-to-cart.png' => 'Button Type #1 - Yellow',
			'red_add-to-cart.png' => 'Button Type #1 - Red',
			'orange_add-to-cart2.png' => 'Button Type #2 - Orange',
			'red_add-to-cart2.png' => 'Button Type #2 - Red',
			'orange_add-to-cart3.png' => 'Button Type #3 - Orange',
			'red_add-to-cart3.png' => 'Button Type #3 - Red',
			'cart-orange.jpg' => 'Button Type #4 - Orange',
			'cart-red.jpg' => 'Button Type #4 - Red',
			'add_to_cart/metro_1.png' => 'Button Type #5 - Yellow',
            'add_to_cart/metro_2.png' => 'Button Type #5 - Red',
            'add_to_cart/metro_3.png' => 'Button Type #5 - Orange',
            'add_to_cart/metro_4.png' => 'Button Type #5 - Green',
            'add_to_cart/metro_5.png' => 'Button Type #5 - Blue',
            'add_to_cart/grunge_1.png' => 'Button Type #6 - Yellow',
            'add_to_cart/grunge_2.png' => 'Button Type #6 - Red',
            'add_to_cart/grunge_3.png' => 'Button Type #6 - Orange',
            'add_to_cart/grunge_4.png' => 'Button Type #6 - Green',
            'add_to_cart/grunge_5.png' => 'Button Type #6 - Blue',
            'add_to_cart/gloss_1.png' => 'Button Type #7 - Yellow',
            'add_to_cart/gloss_2.png' => 'Button Type #7 - Red',
            'add_to_cart/gloss_3.png' => 'Button Type #7 - Orange',
            'add_to_cart/gloss_4.png' => 'Button Type #7 - Green',
            'add_to_cart/gloss_5.png' => 'Button Type #7 - Blue',
			
		),
		'id' => 'lp-order-2-addbtn',
		'type' => 'addtocart',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-2-addsize' => array(
		'name' => 'Button Size',
		'std' => 'medium',
		'desc' => 'Select the size of the \'Add To Cart\' button.',
		'options' => array(
			'small' => 'Small',
			'medium' => 'Medium',
			'big' => 'Big',
		),
		'id' => 'lp-order-2-addsize',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-2-addurl' => array(
		'name' => 'Order Page URL',
		'std' => 'http://',  
		'desc' => 'Type the full URL to your order page (including http://).',
		'id' => 'lp-order-2-addurl',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
		),

	'lp-order-2-addurl-target' => array(
		'name' => 'Order Page URL Target',
		'std' => 'medium',
		'desc' => 'Where you want your order page to appear.',
		'options' => array(
			'_self' => 'Open In Current Window',
			'_blank' => 'Open In New Window',
		),
		'id' => 'lp-order-2-addurl-target',
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-2-addarrow' => array(
		'name' => 'Display Big Red Arrow Above The Button',
		'std' => 'false',  
		'desc' => 'Display Big Red Arrow Above The Button',
		'id' => 'lp-order-2-addarrow',
		'type' => 'checkbox',
		'group' => 'pt_landing_meta_box'
		),

	'lp-order-2-addcode' => array(
		'name' => 'Insert HTML Code:',
		'std' => '',  
		'desc' => 'You may also insert html code if you have custom \'Add To Cart\' button. If you use this field, then the settings above will be ignored.',
		'id' => 'lp-order-2-addcode',
		'type' => 'textarea',
		'group' => 'pt_landing_meta_box'
		),

	'lp-order-2-addtimed' => array(
		'name' => 'Button Timer',
		'std' => '0',
		'desc' => 'Use this field if you want your Add To Cart button to be shown after a certain amount of time. Type how long you want to hide the button before it show (in seconds); If you want the button to show immediately, just type \'0\' (zero).',
		'id' => 'lp-order-2-addtimed',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' second(s)',
		'group' => 'pt_landing_meta_box'
	),

	'lp-order-2-close' => array(
		'name' => 'Add To Cart Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Single Image

	'lp-image-open' => array(
		'name' => 'Single Image Wrap Open',
		'id' => 'lp-image-open',
		'type' => 'dialogopen',
		'title' => 'Single Image Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-image-url' => array(
		'name' => 'Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-image-url',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-align' => array(
		'name' => 'Image Alignment', 
		'std' => 'left',  
		'desc' => 'Choose a position where you want your image appear.',
		'id' => 'lp-image-align',
		'options' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			),
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-link' => array(
		'name' => 'Add Link (optional)', 
		'std' => '',  
		'desc' => 'Type a url if you want a clickable image. Leave this blank if you don\'t want a clickable image.',
		'id' => 'lp-image-link',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-link-target' => array(
		'name' => 'Target Window (optional)', 
		'std' => '_self',  
		'desc' => 'Choose where you want the link to be opened',
		'id' => 'lp-image-link-target',
		'options' => array(
				'_self' => 'Open in current window',
				'_blank' => 'Open in new window',
			),
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-close' => array(
		'name' => 'Single Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),
	
	// Single Image 2

	'lp-image-2-open' => array(
		'name' => 'Single Image Wrap Open',
		'id' => 'lp-image-2-open',
		'type' => 'dialogopen',
		'title' => 'Single Image Settings',
		'group' => 'pt_landing_meta_box'
	),

	'lp-image-2-url' => array(
		'name' => 'Image URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
		'id' => 'lp-image-2-url',
		'type' => 'upload',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-2-align' => array(
		'name' => 'Image Alignment', 
		'std' => 'left',  
		'desc' => 'Choose a position where you want your image appear.',
		'id' => 'lp-image-2-align',
		'options' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			),
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-2-link' => array(
		'name' => 'Add Link (optional)', 
		'std' => '',  
		'desc' => 'Type a url if you want a clickable image. Leave this blank if you don\'t want a clickable image.',
		'id' => 'lp-image-2-link',
		'type' => 'text',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-2-link-target' => array(
		'name' => 'Target Window (optional)', 
		'std' => '_self',  
		'desc' => 'Choose where you want the link to be opened',
		'id' => 'lp-image-2-link-target',
		'options' => array(
				'_self' => 'Open in current window',
				'_blank' => 'Open in new window',
			),
		'type' => 'select',
		'group' => 'pt_landing_meta_box'
		),

	'lp-image-2-close' => array(
		'name' => 'Single Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Launch Funnel

	'lp-funnel-open' => array(
		'name' => 'Launch Funnel Open',
		'id' => 'lp-funnel-open',
		'type' => 'dialogopen',
		'title' => 'Launch Funnel',
		'group' => 'pt_landing_meta_box'
	),

	'lp-funnel-note' => array(  
		'desc' => 'You can set up your launch funnel in <a href="' . admin_url('admin.php?page=pt_launch_options') . '" target="_blank">Profits Theme -> Launch Options</a> (open in new window). Just please make sure you drag n drop this element into one of the columns. Otherwise, the funnel navigation cannot be displayed.',
		'id' => 'lp-funnel-note',
		'type' => 'note', 
		'group' => 'pt_landing_meta_box',
	),

	'lp-funnel-close' => array(
		'name' => 'Launch Funnel Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	// Script

	'lp-script-open' => array(
		'name' => 'Script Wrap Open',
		'id' => 'lp-script-open',
		'type' => 'dialogopen',
		'title' => 'Script',
		'group' => 'pt_landing_meta_box'
	),

	'lp-script-code' => array(
		'name' => 'Your Script',  
		'std' => '',  
		'desc' => 'You can add html, javascript, or php code using this element. Please use the php opening tag <span style="background:#E5E5E5">&nbsp;&lt;?php&nbsp;</span> and closing tag <span style="background:#E5E5E5">&nbsp;?&gt;&nbsp;</span> when adding a php code.<p><strong>Php example:</strong><br /><br /><em>&lt;?php<br /> // your php code here<br />?&gt;</em></p>',
		'id' => 'lp-script-code',
		'type' => 'textarea',
		'rows' => 9,
		'group' => 'pt_landing_meta_box'
		),

	'lp-script-close' => array(
		'name' => 'Script Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_landing_meta_box'
	),

	
);

function pt_nav_menu( $defaults ) {
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
	$custom_menu = $defaults;
	foreach ( $menus as $menu ) {
		$custom_menu [] = $menu->name;
	}

	return $custom_menu;
}
