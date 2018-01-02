<?php

function pt_member_categories()
{
	global $post;

	$id = array();
	$title = array();

	$args = array(
		'showposts' => 999,
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-member-cat.php',
		'orderby' => 'title',
		'order' => 'ASC'
	);

	$myposts = get_posts( $args );

	if ( $myposts ) {
	
		foreach ( $myposts as $post ) {
	
			$id[] = $post->ID;
			$title[] = $post->post_title;

		}
	}

	if ( count($id) > 0 ) {

		$list = array_combine( $id, $title );

	} else {

		$list = '';
	}

	return $list;
}

$member_cat = pt_member_categories();

$pt_post_meta_box = array(
	'thumbnail' => array(
		'name' => 'Post Thumbnail URL', 
		'std' => '', 
		'desc' => 'Type the full path URL to your thumbnail image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'id' => 'post_thumb',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),
	
	'excerpt-length' => array(
		'std' => '', 
		'name' => 'Custom Post Excerpt Length',
		'id' => 'excerpt-length',
		'desc' => 'Characters limit for this post excerpt (this will override the global post excerpt length setting in <a href="' . admin_url('admin.php?page=pt_site_options') . '" target="_blank">Site Options -> Display</a>). Please enter digit only between 50 - 300.',
		'type' => 'text',
		'width' => '60px',
		'suffix' => ' characters',
		'group' => 'pt_post_meta_box'
		),

	'show-banner-ad1' => array(
		'name' => 'Enable Post Top Ad', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-banner-ad1', 
		'type' => 'activate',
		'group' => 'pt_post_meta_box'
		),

	'post-ad1-type' => array(
		'name' => 'Post Top Ad Type', 
		'std' => 'banner', 
		'desc' => 'Choose the type of ad you want to display.',
		'options' => array(
				'rich' => 'Rich Content Ad',
				'optin' => 'Optin Form',
				'adcode' => 'Adsense/Other Ads Code',
				'banner' => 'Your Own Banner',
			),
		'id' => 'post-ad1-type',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		'onchange' => 'showadfields1(this.options[this.options.selectedIndex].value)',
		),

	'post-adcode1-ad' => array(
		'std' => '', 
		'name' => 'Adsense/Other Ads Code For Post Top Ad',
		'id' => 'post-adcode1-ad',  
		'desc' => 'You can insert adsense or any type of advertising code on the top right side of post body. Basic Html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-banner1-wrap-open' => array(
		'name' => 'Post Banner Wrap Open',
		'id' => 'post-banner1-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Banner Ad',
		'group' => 'pt_post_meta_box'
	),

	'post-banner1-image' => array(
		'std' => '', 
		'name' => 'Post Top Banner Image URL',
		'id' => 'post-banner1-image',
		'desc' => 'Type the full path URL to your banner image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-banner1-url' => array(
		'std' => '', 
		'name' => 'Post Top Banner Destination',
		'id' => 'post-banner1-url',
		'desc' => 'Type the full path URL where this banner ad point to.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-banner1-target' => array(
		'name' => 'Post Top Banner Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open In New Window',
				'_self' => 'Open In Current Window',
			),
		'id' => 'post-banner1-target',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-banner1-wrap-close' => array(
		'name' => 'Post Banner Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'post-rich1-wrap-open' => array(
		'name' => 'Post Rich Ad Wrap Open',
		'id' => 'post-rich1-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Rich Ad',
		'group' => 'pt_post_meta_box'
	),
	
	'post-rich1-theme' => array(
		'name' => 'Rich Content Ad Color Scheme', 
		'std' => 'green', 
		'desc' => 'Choose a color scheme for your rich content ad.',
		'options' => array(
				'green' => 'Light Green',
				'blue' => 'Light Blue', 
				'pink' => 'Pink',
				'yellow' => 'Yellow',
				'grey' => 'Grey',
				'white1' => 'White - Black Border',
				'white2' => 'White - Red Border',
				'white3' => 'White - Blue Border',
				'white4' => 'White - Green Border',
				'white5' => 'White - Pink Border',
				'white6' => 'White - Yellow Border',
				'white7' => 'White - Grey Border',
			),
		'id' => 'post-rich1-theme',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-rich1-title' => array(
		'std' => '', 
		'name' => 'Rich Content Ad Title',
		'id' => 'post-rich1-title',
		'desc' => 'Title text for your rich content ad.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-image' => array(
		'std' => '', 
		'name' => 'Rich Content Ad Ecover/Image URL',
		'id' => 'post-rich1-image',
		'desc' => 'Type the full path URL to your ecover/image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-body' => array(
		'std' => '',
		'name' => 'Rich Content Ad Body',
		'id' => 'post-rich1-body',
		'desc' => 'The main content of your rich content ad. Basic html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-url' => array(
		'std' => 'http://', 
		'name' => 'Rich Content Ad URL',
		'id' => 'post-rich1-url',
		'desc' => 'Your rich content ad destination.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-target-url' => array(
		'name' => 'Rich Content Ad Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open in new window', 
				'_self' => 'Open in current window', 
			),
		'id' => 'post-rich1-target-url',
		'type' => 'select',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-text-url' => array(
		'std' => 'Click here for more >>', 
		'name' => 'Rich Content Ad Link Text',
		'id' => 'post-rich1-text-url',
		'desc' => 'Text link/anchor text for the URL above.',
		'type' => 'text2',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-target-url' => array(
		'name' => 'Rich Content Ad Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open in new window', 
				'_self' => 'Open in current window', 
			),
		'id' => 'post-rich1-target-url',
		'type' => 'select',
		'group' => 'pt_post_meta_box'
		),

	'post-rich1-wrap-close' => array(
		'name' => 'Post Rich Ad Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'post-optin1-wrap-open' => array(
		'name' => 'Post Optin Ad Wrap Open',
		'id' => 'post-optin1-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Optin Ad',
		'group' => 'pt_post_meta_box'
	),
	
	'post-optin1-theme' => array(
		'name' => 'Optin Form Color Scheme', 
		'std' => 'green', 
		'desc' => 'Choose a color scheme for your optin form.',
		'options' => array(
				'green' => 'Light Green',
				'blue' => 'Light Blue', 
				'pink' => 'Pink',
				'yellow' => 'Yellow',
				'grey' => 'Grey',
				'white1' => 'White - Black Border',
				'white2' => 'White - Red Border',
				'white3' => 'White - Blue Border',
				'white4' => 'White - Green Border',
				'white5' => 'White - Pink Border',
				'white6' => 'White - Yellow Border',
				'white7' => 'White - Grey Border',
			),
		'id' => 'post-optin1-theme',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-optin1-title' => array(
		'std' => 'Get FREE Stuff!', 
		'name' => 'Optin Form Title',
		'id' => 'post-optin1-title',
		'desc' => 'Title text for your optin form.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),
	
	'post-optin1-image' => array(
		'std' => '', 
		'name' => 'Optin Form Ecover/Image URL',
		'id' => 'post-optin1-image',
		'desc' => 'Type the full path URL to your ecover/image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-optin1-text' => array(
		'std' => 'Simply enter your information below to download our FREE stuff today!',
		'name' => 'Optin Form Text',
		'id' => 'post-optin1-text',
		'desc' => 'Type a short paragraph or call to action for your optin form. Basic html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-optin1-ar' => array(
		'std' => '',
		'name' => 'Paste Autoresponder Code Here',
		'id' => 'post-optin1-ar',
		'desc' => 'Paste raw autoresponder code from your email marketing provider here (e.g. Aweber, GetResponse, etc).',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-optin1-button-text' => array(
		'std' => 'Get Instant Access!', 
		'name' => 'Optin Form Button Text',
		'id' => 'post-optin1-button-text',
		'desc' => 'Text for your optin form button',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-optin1-privacy-text' => array(
		'std' => 'Your privacy is SAFE', 
		'name' => 'Optin Form Privacy Text',
		'id' => 'post-optin1-privacy-text',
		'desc' => 'Short privacy text that will display just below your optin form.',
		'type' => 'text2',
		'group' => 'pt_post_meta_box'
		),

	'post-optin1-wrap-close' => array(
		'name' => 'Post Optin Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'show-banner-ad2' => array(
		'name' => 'Enable Post Body Ad', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-banner-ad2', 
		'type' => 'activate',
		'group' => 'pt_post_meta_box'
		),
	
	'post-ad2-type' => array(
		'name' => 'Post Body Ad Type', 
		'std' => 'banner', 
		'desc' => 'Choose the type of ad you want to display.',
		'options' => array(
				'rich' => 'Rich Content Ad',
				'adcode' => 'Adsense/Other Ads Code',
				'banner' => 'Your Own Banner',
			),
		'id' => 'post-ad2-type',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		'onchange' => 'showadfields2(this.options[this.options.selectedIndex].value)',
		),

	'post-adcode2-ad' => array(
		'std' => '', 
		'name' => 'Adsense/Other Ads Code For Post Body Ad',
		'id' => 'post-adcode2-ad',  
		'desc' => 'You can insert adsense or any type of advertising code on the top right side of post body. Basic Html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-banner2-wrap-open' => array(
		'name' => 'Post Banner Wrap Open',
		'id' => 'post-banner2-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Banner Ad',
		'group' => 'pt_post_meta_box'
	),

	'post-banner2-image' => array(
		'std' => '', 
		'name' => 'Post Body Banner Image URL',
		'id' => 'post-banner2-image',
		'desc' => 'Type the full path URL to your banner image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-banner2-url' => array(
		'std' => '', 
		'name' => 'Post Body Banner Destination',
		'id' => 'post-banner2-url',
		'desc' => 'Type the full path URL where this banner ad point to.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-banner2-target' => array(
		'name' => 'Post Body Banner Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open In New Window',
				'_self' => 'Open In Current Window',
			),
		'id' => 'post-banner2-target',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-banner2-wrap-close' => array(
		'name' => 'Post Banner Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'post-rich2-wrap-open' => array(
		'name' => 'Post Rich Ad Wrap Open',
		'id' => 'post-rich2-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Rich Ad',
		'group' => 'pt_post_meta_box'
	),
	
	'post-rich2-theme' => array(
		'name' => 'Rich Content Ad Color Scheme', 
		'std' => 'green', 
		'desc' => 'Choose a color scheme for your rich content ad.',
		'options' => array(
				'green' => 'Light Green',
				'blue' => 'Light Blue', 
				'pink' => 'Pink',
				'yellow' => 'Yellow',
				'grey' => 'Grey',
				'white1' => 'White - Black Border',
				'white2' => 'White - Red Border',
				'white3' => 'White - Blue Border',
				'white4' => 'White - Green Border',
				'white5' => 'White - Pink Border',
				'white6' => 'White - Yellow Border',
				'white7' => 'White - Grey Border',
			),
		'id' => 'post-rich2-theme',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-rich2-title' => array(
		'std' => '', 
		'name' => 'Rich Content Ad Title',
		'id' => 'post-rich2-title',
		'desc' => 'Title text for your rich content ad.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-rich2-image' => array(
		'std' => '', 
		'name' => 'Rich Content Ad Ecover/Image URL',
		'id' => 'post-rich2-image',
		'desc' => 'Type the full path URL to your ecover/image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-rich2-body' => array(
		'std' => '',
		'name' => 'Rich Content Ad Body',
		'id' => 'post-rich2-body',
		'desc' => 'The main content of your rich content ad. Basic html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-rich2-url' => array(
		'std' => 'http://', 
		'name' => 'Rich Content Ad URL',
		'id' => 'post-rich2-url',
		'desc' => 'Your rich content ad destination.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-rich2-text-url' => array(
		'std' => 'Click here for more >>', 
		'name' => 'Rich Content Ad Link Text',
		'id' => 'post-rich2-text-url',
		'desc' => 'Text link/anchor text for the URL above.',
		'type' => 'text2',
		'group' => 'pt_post_meta_box'
		),

	'post-rich2-target-url' => array(
		'name' => 'Rich Content Ad Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open in new window', 
				'_self' => 'Open in current window', 
			),
		'id' => 'post-rich2-target-url',
		'type' => 'select',
		'group' => 'pt_post_meta_box'
		),

	'post-rich2-wrap-close' => array(
		'name' => 'Post Rich Ad Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'show-banner-ad3' => array(
		'name' => 'Enable Post Bottom Ad', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-banner-ad3', 
		'type' => 'activate',
		'group' => 'pt_post_meta_box'
		),

	'post-ad3-loop' => array(
		'name' => 'Post Bottom Ad Loop', 
		'std' => 'true',  
		'desc' => 'Also show the \'Post Bottom Ad\' on home and archive pages.',
		'id' => 'post-ad3-loop', 
		'type' => 'checkbox',
		'group' => 'pt_post_meta_box'
		),

	'post-ad3-type' => array(
		'name' => 'Post Bottom Ad Type', 
		'std' => 'banner', 
		'desc' => 'Choose the type of ad you want to display.',
		'options' => array(
				'rich' => 'Rich Content Ad',
				'optin' => 'Optin Form',
				'adcode' => 'Adsense/Other Ads Code',
				'banner' => 'Your Own Banner',
			),
		'id' => 'post-ad3-type',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		'onchange' => 'showadfields3(this.options[this.options.selectedIndex].value)',
		),

	'post-adcode3-ad' => array(
		'std' => '', 
		'name' => 'Adsense/Other Ads Code For Post Bottom Ad',
		'id' => 'post-adcode3-ad',
		'desc' => 'You can insert adsense or any type of advertising code on the bottom of post body. Basic Html is allowed.',
		'type' => 'textarea2',
		'group' => 'pt_post_meta_box'
		),

	'post-banner3-wrap-open' => array(
		'name' => 'Post Banner Wrap Open',
		'id' => 'post-banner3-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Banner Ad',
		'group' => 'pt_post_meta_box'
	),

	'post-banner3-image' => array(
		'std' => '', 
		'name' => 'Post Bottom Banner Image URL',
		'id' => 'post-banner3-image',
		'desc' => 'Type the full path URL to your banner image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-banner3-url' => array(
		'std' => '', 
		'name' => 'Post Bottom Banner Destination',
		'id' => 'post-banner3-url',
		'desc' => 'Type the full path URL where this banner ad point to.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-banner3-target' => array(
		'name' => 'Post Bottom Banner Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open In New Window',
				'_self' => 'Open In Current Window',
			),
		'id' => 'post-banner3-target',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-banner3-wrap-close' => array(
		'name' => 'Post Banner Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'post-rich3-wrap-open' => array(
		'name' => 'Post Rich Ad Wrap Open',
		'id' => 'post-rich3-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Rich Ad',
		'group' => 'pt_post_meta_box'
	),
	
	'post-rich3-theme' => array(
		'name' => 'Rich Content Ad Color Scheme', 
		'std' => 'green', 
		'desc' => 'Choose a color scheme for your rich content ad.',
		'options' => array(
				'green' => 'Light Green',
				'blue' => 'Light Blue', 
				'pink' => 'Pink',
				'yellow' => 'Yellow',
				'grey' => 'Grey',
				'white1' => 'White - Black Border',
				'white2' => 'White - Red Border',
				'white3' => 'White - Blue Border',
				'white4' => 'White - Green Border',
				'white5' => 'White - Pink Border',
				'white6' => 'White - Yellow Border',
				'white7' => 'White - Grey Border',
			),
		'id' => 'post-rich3-theme',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-rich3-title' => array(
		'std' => '', 
		'name' => 'Rich Content Ad Title',
		'id' => 'post-rich3-title',
		'desc' => 'Title text for your rich content ad.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-rich3-image' => array(
		'std' => '', 
		'name' => 'Rich Content Ad Ecover/Image URL',
		'id' => 'post-rich3-image',
		'desc' => 'Type the full path URL to your ecover/image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-rich3-body' => array(
		'std' => '',
		'name' => 'Rich Content Ad Body',
		'id' => 'post-rich3-body',
		'desc' => 'The main content of your rich content ad. Basic html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-rich3-url' => array(
		'std' => 'http://', 
		'name' => 'Rich Content Ad URL',
		'id' => 'post-rich3-url',
		'desc' => 'Your rich content ad destination.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-rich3-text-url' => array(
		'std' => 'Click here for more >>', 
		'name' => 'Rich Content Ad Link Text',
		'id' => 'post-rich3-text-url',
		'desc' => 'Text link/anchor text for the URL above.',
		'type' => 'text2',
		'group' => 'pt_post_meta_box'
		),

	'post-rich3-target-url' => array(
		'name' => 'Rich Content Ad Target Window', 
		'std' => '_blank', 
		'desc' => 'Choose whether you want the target site to open in current or new window.',
		'options' => array(
				'_blank' => 'Open in new window', 
				'_self' => 'Open in current window', 
			),
		'id' => 'post-rich3-target-url',
		'type' => 'select',
		'group' => 'pt_post_meta_box'
		),

	'post-rich3-wrap-close' => array(
		'name' => 'Post Rich Ad Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'post-optin3-wrap-open' => array(
		'name' => 'Post Optin Ad Wrap Open',
		'id' => 'post-optin3-wrap-open',
		'type' => 'dialogopen',
		'title' => 'Post Optin Ad',
		'group' => 'pt_post_meta_box'
	),
	
	'post-optin3-theme' => array(
		'name' => 'Optin Form Color Scheme', 
		'std' => 'green', 
		'desc' => 'Choose a color scheme for your optin form.',
		'options' => array(
				'green' => 'Light Green',
				'blue' => 'Light Blue', 
				'pink' => 'Pink',
				'yellow' => 'Yellow',
				'grey' => 'Grey',
				'white1' => 'White - Black Border',
				'white2' => 'White - Red Border',
				'white3' => 'White - Blue Border',
				'white4' => 'White - Green Border',
				'white5' => 'White - Pink Border',
				'white6' => 'White - Yellow Border',
				'white7' => 'White - Grey Border',
			),
		'id' => 'post-optin3-theme',
		'type' => 'select',
		'group' => 'pt_post_meta_box',
		),

	'post-optin3-title' => array(
		'std' => 'Get FREE Stuff!', 
		'name' => 'Optin Form Title',
		'id' => 'post-optin3-title',
		'desc' => 'Title text for your optin form.',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),
	
	'post-optin3-image' => array(
		'std' => '', 
		'name' => 'Optin Form Ecover/Image URL',
		'id' => 'post-optin3-image',
		'desc' => 'Type the full path URL to your ecover/image on the text field above (must start with http://), or you can upload a new one by clicking the "Upload Image" button above.',
		'type' => 'upload',
		'group' => 'pt_post_meta_box'
		),

	'post-optin3-text' => array(
		'std' => 'Simply enter your information below to download our FREE stuff today!',
		'name' => 'Optin Form Text',
		'id' => 'post-optin3-text',
		'desc' => 'Type a short paragraph or call to action for your optin form. Basic html is allowed.',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-optin3-ar' => array(
		'std' => '',
		'name' => 'Paste Autoresponder Code Here',
		'id' => 'post-optin3-ar',
		'desc' => 'Paste raw autoresponder code from your email marketing provider here (e.g. Aweber, GetResponse, etc).',
		'type' => 'textarea',
		'group' => 'pt_post_meta_box'
		),

	'post-optin3-button-text' => array(
		'std' => 'Get Instant Access!', 
		'name' => 'Optin Form Button Text',
		'id' => 'post-optin3-button-text',
		'desc' => 'Text for your optin form button',
		'type' => 'text',
		'group' => 'pt_post_meta_box'
		),

	'post-optin3-privacy-text' => array(
		'std' => 'Your privacy is SAFE', 
		'name' => 'Optin Form Privacy Text',
		'id' => 'post-optin3-privacy-text',
		'desc' => 'Short privacy text that will display just below your optin form.',
		'type' => 'text2',
		'group' => 'pt_post_meta_box'
		),

	'post-optin3-wrap-close' => array(
		'name' => 'Post Optin Wrap Close',
		'type' => 'dialogclose',
		'group' => 'pt_post_meta_box'
	),

	'post-script' => array(
		'name' => 'Post Meta Javascript', 
		'type' => 'postscript',
		'group' => 'pt_post_meta_box'
		),
	);

$pt_script_meta_box = array(
	
	'headerscr' => array(
		'name' => 'Custom Header Script', 
		'std' => '', 
		'desc' => 'You can insert additional code/scripts to this page header. The header script in \'Site Options->Scripts\' will still be appended to this page.',
		'id' => 'header_scr',
		'type' => 'textarea',
		'group' => 'pt_script_meta_box'
	),
	'footerscr' => array(
		'name' => 'Custom Footer Script', 
		'std' => '', 
		'desc' => 'You can insert additional code/scripts to this page footer. The footer script in \'Site Options->Scripts\' will still be appended to this page.',
		'id' => 'footer_scr', 
		'type' => 'textarea',
		'group' => 'pt_script_meta_box'
	),
);

$pt_seo_meta_box = array(
	'seotitle' => array(
		'name' => 'Title', 
		'std' => '',  
		'desc' => 'Most search engines use a maximum of 60 chars for the title.',
		'id' => 'seo_title', 
		'type' => 'text',
		'group' => 'pt_seo_meta_box'
	),
	'seodesc' => array(
		'name' => 'Description', 
		'std' => '',  
		'desc' => 'Most search engines use a maximum of 160 chars for the description.',
		'id' => 'seo_desc', 
		'type' => 'textarea',
		'group' => 'pt_seo_meta_box'
	),
	'seokeywords' => array(
		'name' => 'Keywords (comma separated)', 
		'std' => '',  
		'desc' => 'Some search engine ignored the meta keywords tag, but it doesn\'t hurt to put up relevant keywords.',
		'id' => 'seo_keywords', 
		'type' => 'text',
		'group' => 'pt_seo_meta_box'
	),
	'seonoindex' => array(
		'name' => 'Noindex', 
		'std' => 'false',  
		'desc' => 'Add a noindex meta tag to this post/page.',
		'id' => 'seo_noindex', 
		'type' => 'checkbox',
		'group' => 'pt_seo_meta_box'
	),
	'seonofollow' => array(
		'name' => 'Nofollow', 
		'std' => 'false',  
		'desc' => 'Add a nofollow meta tag to this post/page.',
		'id' => 'seo_nofollow', 
		'type' => 'checkbox',
		'group' => 'pt_seo_meta_box'
	),
	'seonoarchive' => array(
		'name' => 'Noarchive', 
		'std' => 'false',  
		'desc' => 'Add a noarchive meta tag to this post/page.',
		'id' => 'seo_noarchive', 
		'type' => 'checkbox',
		'group' => 'pt_seo_meta_box'
	),
	'seodisable' => array(
		'name' => 'Disable SEO', 
		'std' => 'false',  
		'desc' => 'Disable PT SEO for this post/page.',
		'id' => 'seo_disable', 
		'type' => 'checkbox',
		'group' => 'pt_seo_meta_box'
	),
);


$pt_member_meta_box = array(
	'member-title' => array(
		'name' => 'Custom Title (optional)', 
		'std' => '',  
		'desc' => 'You can show a custom membership page title instead of the WP Title.',
		'id' => 'member-title', 
		'type' => 'text',
		'group' => 'pt_member_meta_box'
	),

	'member-disable-comments' => array(
		'name' => 'Disable comments on this page', 
		'std' => 'false',  
		'desc' => 'Disable comments on this page',
		'id' => 'member-disable-comments',
		'type' => 'checkbox',
		'group' => 'pt_member_meta_box'
	),

	'member-page-icon' => array(
		'name' => 'Membership Page Icon', 
		'std' => '',  
		'desc' => 'You may choose a pre-made icon to represent the page.',
		'options' => array(
			'' => 'No Icon',
			'dashboard.png' => 'Dashboard Icon',
			'folder.png' => 'Empty Folder',
			'folder-sheets.png' => 'Filled Folder',
			'forbidden.png' => 'Forbidden Icon',
			'members-only.png' => 'Members Only Icon',
			'pad-lock.png' => 'Pad Lock Icon',
			'video-thumb.png' => 'Video Player',
		),
		'id' => 'member-page-icon', 
		'type' => 'select',
		'group' => 'pt_member_meta_box'
	),

	'show-member-sidebar' => array(
		'name' => 'Show Membership Sidebar Text Settings', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-member-sidebar', 
		'type' => 'activate',
		'group' => 'pt_member_meta_box'
	),

	'member-sidebar-open' => array(
		'id' => 'member-sidebar-open',
		'type' => 'divwrapopen',
		'group' => 'pt_member_meta_box'
	),

	'member-sidebar-title' => array(
		'name' => 'Membership Sidebar Title (optional)', 
		'std' => '',  
		'desc' => 'A sidebar title text that will be displayed on top of sidebar navigation.',
		'id' => 'member-sidebar-title', 
		'type' => 'text',
		'group' => 'pt_member_meta_box'
	),

	'member-sidebar-text' => array(
		'name' => 'Membership Sidebar Text (optional)', 
		'std' => '',  
		'desc' => 'A short paragraph about this membership page that will be displayed on top of sidebar navigation.',
		'id' => 'member-sidebar-text',
		'type' => 'textarea',
		'group' => 'pt_member_meta_box'
	),

	'member-sidebar-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_member_meta_box'
	),

	'show-member-video' => array(
		'name' => 'Show Membership Video Settings', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-member-video', 
		'type' => 'activate',
		'group' => 'pt_member_meta_box'

		),

	'member-video-open' => array(
		'id' => 'member-video-open',
		'type' => 'divwrapopen',
		'group' => 'pt_member_meta_box'
	),

	'member-video-player' => array(
		'name' => 'Video Player', 
		'std' => 'flow',  
		'desc' => 'Choose the video player you would like to use.<br /><br /><a href="http://flowplayer.org/" target="_blank">Flowplayer</a> is an open source web video player software, which created by <a href="http://flowplayer.org/company.html" target="_blank">Flowplayer Ltd</a>. You can download it for free at <a href="http://flowplayer.org/" target="_blank">http://flowplayer.org</a>.' . $pt_jw_info,
		'options' =>$pt_video_player,
		'id' => 'member-video-player', 
		'type' => 'select',
		'group' => 'pt_member_meta_box'
	),

	'member-video-url' => array(
		'name' => 'Video URL', 
		'std' => '',  
		'desc' => 'Type the full path URL to your web video (must include http://) for membership home, module and/or content page. Recommended video width is 640px',
		'id' => 'member-video-url', 
		'type' => 'text',
		'group' => 'pt_member_meta_box'
	),

	'member-video-html5' => array(
		'id' => 'member-video-html5',
		'type' => 'divwrapopen',
		'group' => 'pt_member_meta_box',
		),

	'member-video-html5-note' => array(
		'name' => 'HTML5 Video Note',  
		'desc' => '<p>The HTML5 video player will use one of the videos you provide below, depending in which browser your visitors open this landing page.</p>',
		'id' => 'member-video-html5-note',
		'type' => 'note',
		'group' => 'pt_member_meta_box',
		),


	'member-video-html5-mp4' => array(
		'name' => 'MP4 Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your H.264/MP4 video (must include http://). This Mp4 video will be played in Safari, Chrome, and IE9, and also Iphone and Ipad (if compatible). You can convert your video to H.264/MP4 using <a href="http://handbrake.fr/downloads.php" target="_blank">Handbrake</a>.',
		'id' => 'member-video-html5-mp4',
		'type' => 'text',
		'group' => 'pt_member_meta_box',
		),

	'member-video-html5-ogg' => array(
		'name' => 'Ogg Video URL',  
		'std' => '',  
		'desc' => 'Type the full path URL to your Ogg/Ogv video (must include http://). This Ogg video will be played in Firefox (3.5+), Chrome (3+), and Opera (10.54+). You can convert your video to Ogg/Ogv using a Firefox Add-on called <a href="http://firefogg.org" target="_blank">Firefogg</a>.',
		'id' => 'member-video-html5-ogg',
		'type' => 'text',
		'group' => 'pt_member_meta_box',
		),

	'member-video-html5-webm' => array(
		'name' => 'WebM Video URL (optional)',
		'std' => '',  
		'desc' => 'Type the full path URL to your WebM video (must include http://). This WebM video will be played in Firefox (4+), Chrome (6+ or Chromium), and Opera (10.60+). You can convert your video to WebM using a Firefox Add-on called <a href="http://firefogg.org" target="_blank">Firefogg</a>.<br /><br />',
		'id' => 'member-video-html5-webm',
		'type' => 'text',
		'group' => 'pt_member_meta_box',
		),

	'member-video-html5-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_member_meta_box',
		),

	'member-video-width' => array(
		'name' => 'Video Width', 
		'std' => '640',  
		'desc' => 'Your preffered width for the video.',
		'id' => 'member-video-width',
		'suffix' => ' px',
		'width' => '60px',
		'type' => 'text',
		'group' => 'pt_member_meta_box'
	),

	'member-video-height' => array(
		'name' => 'Video Height', 
		'std' => '480',  
		'desc' => 'Your preffered width for the video.',
		'id' => 'member-video-height',
		'suffix' => ' px',
		'width' => '60px',
		'type' => 'text',
		'group' => 'pt_member_meta_box'
	),

	'member-video-play' => array(
		'name' => 'Enable Auto Play', 
		'std' => 'false',  
		'desc' => 'Enable Auto Play',
		'id' => 'member-video-play', 
		'type' => 'checkbox',
		'group' => 'pt_member_meta_box'
	),

	'member-video-ctrl' => array(
		'name' => 'Auto Hide Video Control', 
		'std' => 'false',  
		'desc' => 'Auto Hide Video Control',
		'id' => 'member-video-ctrl', 
		'type' => 'checkbox',
		'group' => 'pt_member_meta_box'
	),

	'member-video-code' => array(
		'name' => 'Video Code (optional)', 
		'std' => '',  
		'desc' => 'You can paste video code here if you prefer to use external video player instead of the built-in Flowplayer. All the video settings above will be ignored.',
		'id' => 'member-video-code', 
		'type' => 'textarea',
		'group' => 'pt_member_meta_box'
	),

	'member-video-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_member_meta_box'
	),

	'show-member-home' => array(
		'name' => 'Show Membership Home Settings', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-member-home', 
		'type' => 'activate',
		'group' => 'pt_member_meta_box'
	),

	'member-home-open' => array(
		'id' => 'member-home-open',
		'type' => 'divwrapopen',
		'group' => 'pt_member_meta_box'
	),

	'member-home-feature' => array(
		'name' => 'Select Module Pages To Show on Member Home', 
		'std' => '',  
		'desc' => 'Hold \'ctrl\' while clicking to select multiple modules.',
		'options' => $member_cat,
		'id' => 'member-home-feature', 
		'type' => 'selectmulti',
		'group' => 'pt_member_meta_box'
	),

	'member-home-feature-sortby' => array(
		'name' => 'Sort Modules By:', 
		'std' => 'menu_order',  
		'desc' => 'Sort retrieved modules by this field.',
		'options' => array(
			'date' => 'Date',
			'ID' => 'ID',
			'menu_order' => 'Menu Order',
			'modified' => 'Modified',
			'title' => 'Title',
		),
		'id' => 'member-home-feature-sortby', 
		'type' => 'select',
		'group' => 'pt_member_meta_box'
	),

	'member-home-feature-sort' => array(
		'name' => 'Order Parameter', 
		'std' => 'ASC',  
		'desc' => 'Designates the ascending or descending order of the \'Sort Modules By\' setting.',
		'options' => array(
			'ASC' => 'Ascending',
			'DESC' => 'Descending',
		),
		'id' => 'member-home-feature-sort', 
		'type' => 'select',
		'group' => 'pt_member_meta_box'
	),
	
	'member-home-feature-limit' => array(
		'name' => 'Content Limit Per Modules', 
		'std' => '5',  
		'desc' => 'How many contents you want to show per module lists.',
		'id' => 'member-home-feature-limit', 
		'type' => 'text',
		'width' => '60px',
		'group' => 'pt_member_meta_box'
	),

	'member-home-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_member_meta_box'
	),

	'show-member-content' => array(
		'name' => 'Show Membership Content Settings', 
		'std' => '',  
		'desc' => '',
		'id' => 'show-member-content', 
		'type' => 'activate',
		'group' => 'pt_member_meta_box'
	),

	'member-content-open' => array(
		'id' => 'member-content-open',
		'type' => 'divwrapopen',
		'group' => 'pt_member_meta_box'
	),

	'member-content-download' => array(
		'name' => 'File Attachment(s)', 
		'std' => '',
		'desc' => 'You can add as many files as you want to this page download area by click the \'Add New Download\'.',
		'id' => 'member-content-download',
		'options' => array(
			'audio' => 'Audio',
			'mmap' => 'Mindmap',
			'pdf' => 'PDF',
			'text' => 'Text',
			'video' => 'Video',
			'zip' => 'Zip',
			'other' => 'Other'
		), 
		'type' => 'memberdownload',
		'group' => 'pt_member_meta_box'
	),

	'member-content-close' => array(
		'type' => 'divwrapclose',
		'group' => 'pt_member_meta_box'
	),

);
