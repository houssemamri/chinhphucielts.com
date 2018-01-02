<?php

$pt_design_options   = array();

$pt_design_options[] = array(
				'name' => 'Skins Tab open',
				'id' => 'skins',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'Site Skins',
				'type' => 'biglabel'
			);

$pt_design_options[] = array(
				'name' => 'Skin Chooser Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Choose Site Skins',
				'std' => array(
					'skins' => 'flat',
					'colors' => 'default.css',
				),
				'desc' => '',
				'id' => $shortname . '_theme',
				'type' => 'skinsmanager'
			);

$pt_design_options[] = array(
				'name' => 'Skin Chooser close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Skins Tab close',
				'type' => 'tabclose'
			);



$pt_design_options[] = array(
				'name' => 'Layout Tab open',
				'id' => 'interface',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'Site Layout',
				'type' => 'biglabel'
			);


$pt_design_options[] = array(
				'name' => 'Site Layout Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => array (
					'layout' => 'Site Layout',
					'content' => 'Main Content Column Width',
					'side1' => 'Sidebar 1 Column Width',
					'side2' => 'Sidebar 2 Column Width',
					//'colpad' => 'Space Between Columns',
				),
				'std' => array (
					'layout' => '2-col-right-side',
					'content' => '700',
					'side1' => '290',
					'side2' => '195',
					//'colpad' => '15',
				),
				'desc' => array (
					'content' => 'Enter a number between 200 and 980 pixels for the width of content/posts column.',
					'side1' => 'Enter a number between 80 and 480 pixels for the width of sidebar 1 column.',
					'side2' => 'Enter a number between 80 and 480 pixels for the width of sidebar 2 column.',
					//'colpad' => 'Enter a number between 10 and 20 pixels for gap between columns.',
				),
				'id' => $shortname . '_layouts',
				'type' => 'layout'
			);

$pt_design_options[] = array(
				'name' => 'Site Layout close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Home Page Layout Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Post Columns on Home Page',
				'std' => 'one',
				'desc' => 'You can display posts on home page in 1 column or 2 columns.',
				'options' => array(
					'one' => '1 Column', 
					'two' => '2 Columns',
					'three' => '3 Columns', 
				),
				'id' => $shortname . '_post_columns',
				'type' => 'select'
			);

$pt_design_options[] = array(
				'name' => 'Widgetized Footerbar Columns',
				'std' => 'three',
				'desc' => 'Choose between 3 or 4 columns for the widgetized footerbar.',
				'options' => array(
					'three' => '3 Columns',
					'four' => '4 Columns', 
				),
				'id' => $shortname . '_footerbar_columns',
				'type' => 'select'
			);

$pt_design_options[] = array(
				'name' => 'Do not display the widgetized footerbar',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_footerbar_hide',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Home Page Layout Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Site Background Open',
				'type' => 'blockopen'
			);
			
$pt_design_options[] = array(
				'name' => array(
					'type' => 'Background Type',
					'color' => 'Background Color',
					'upload' => 'Background Image URL',
					'repeat' => 'Background Image Repeat',
					'pos' => 'Background Image Position',
					'attach' => 'Background Image Attachment',
				),

				'std' => array(
					'type' => '',
					'color' => '#FFFFFF',
					'upload' => '',
					'repeat' => 'no-repeat',
					'pos' => 'left top',
					'attach' => 'scroll',
				),

				'desc' => array(
					'type' => 'You can upload your own background image, or use the Profits Theme pre-made background.',
					'color' => 'Pick a custom color for site background by clicking on the color picker box on the left.',
					'upload' => 'Type the full path URL to your background Image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
					'repeat' => 'Select how you want your background image to display.',
					'pos' => 'Select the position for your background image.',
					'attach' => 'Select the attachment type for your background image.',
				),

				'options' => array(
					'type' => array(
						'' => 'Use Default Background', 
						'custom-background' => 'Use Custom Background'
					),

					'repeat' => array(
						'no-repeat' => 'No Repeat', 
						'repeat' => 'Repeat', 
						'repeat-x' => 'Repeat X (horizontal)', 
						'repeat-y' => 'Repeat Y (vertical)'
					),

					'pos' => array(
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

					'attach' => array(
						'scroll' => 'Scroll', 
						'fixed' => 'Fixed'
					),
				),

				'id' => $shortname . '_background',
				'type' => 'background',
			);

$pt_design_options[] = array(
				'name' => 'Site Background close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Layout Tab close',
				'type' => 'tabclose'
			);

$pt_design_options[] = array(
				'name' => 'Header Tab open',
				'id' => 'head',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'Header Styling',
				'type' => 'biglabel'
			);

$pt_design_options[] = array(
				'name' => 'Custom Site Logo Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Check this box to use a <b>Text Site Title</b> instead of an Image Logo. Setup in <a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php">WP -> Settings -> General</a>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_text_logo',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Logo URL',
				'std' => get_bloginfo('template_url') . '/images/logo.png',
				'desc' => 'Type the full path URL to your logo on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button. Use a transparent PNG image for best results.',
				'id' => $shortname . '_custom_logo',
				'type' => 'upload'
			);

$pt_design_options[] = array(
				'name' => 'Custom Header Height',
				'std' => '',
				'desc' => 'Specify the height of your header.<br /><br />Hint: The current header\'s height is already good.',
				'suffix' => 'px',
				'width' => '60',
				'id' => $shortname . '_header_height',
				'type' => 'text'
			);

$pt_design_options[] = array(
				'name' => 'Custom Site Logo Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Header Background Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => array(
					'type' => 'Header Image Type',
					'upload' => 'Custom Header Image URL',
					'align' => 'Custom Header Image Position',
				),
				'std' => array(
					'type' => '',
					'upload' => '',
					'align' => 'center',
				),
				'desc' => array(
					'type' => 'You can upload your own header image, or use the Profits Theme pre-made header.',
					'upload' => 'Type the full path URL to your header image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br />Recommended width for your header is <strong>' . $site_header_width . ' pixels</strong>.',
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
				'id' => $shortname . '_header_background',
				'type' => 'header',
			);

$pt_design_options[] = array(
				'name' => 'Header Right Side (will overlap if Profits Theme or Custom header image above is selected)',
				'std' => 'blank',
				'desc' => 'Choose what to show on the right side of the header.',
				'options' => array(
					'blank' => 'Leave it blank', 
					'ads' => 'Show Top Ads 468x60', 
					'rss' => 'Show Big RSS Button', 
					'search' => 'Show Search Form',
				),
				'id' => $shortname . '_header_right',
				'type' => 'select'
			);

$pt_design_options[] = array(
				'name' => 'Header Background Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Custom Text Logo Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom Site Title font styling. Use default style instead',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_logo_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Site Title Font Style',
				'std' => array(
					'color' => '#FFFFFF', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '30'
					),
				'desc' => 'Select the typography for your site title.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_site_name',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Site Description Font Style',
				'std' => array(
					'color' => '#FFFFFF', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'italic', 
					'size' => '16'
					),
				'desc' => 'Select the typography for your site description.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_site_desc',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Custom Text Logo Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Header Tab close',
				'type' => 'tabclose'
			);

$pt_design_options[] = array(
				'name' => 'Navigation Tab open',
				'id' => 'navi',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'Navigation Styling',
				'type' => 'biglabel'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation 1 Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom link font for Top Navigation #1',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tnav1_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation #1 Link Style',
				'std' => array(
					'color' => '#FFFFFF', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '12'
					),
				'desc' => 'Select the typography for Top Navigation #1 (link text).<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_tnav1_link',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation #1 Link Hover Style',
				'std' => array(
					'color' => '#FFFFFF', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '12'
					),
				'desc' => 'Select the typography for Top Navigation #1 (hover text).<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_tnav1_link_hover',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Top Nav1 Note',
				'desc' => '<a href="' . PT_REL_IMAGES . '/topnav1.gif" class="thickbox">Click Here</a> To View Top Navigation #1',
				'type' => 'note'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation 1 Text Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation 2 Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom link font for Top Navigation #2',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tnav2_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation #2 Link Style',
				'std' => array(
					'color' => '#666666', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'bold', 
					'size' => '13'
					),
				'desc' => 'Select the typography for Top Navigation #2 (link text).<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_tnav2_link',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation #2 Link Hover Style',
				'std' => array(
					'color' => '#666666', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'bold', 
					'size' => '13'
					),
				'desc' => 'Select the typography for Top Navigation #2 (hover text).<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_tnav2_link_hover',
				'type' => 'typo'
			);


$pt_design_options[] = array(
				'name' => 'Top Nav2 Note',
				'desc' => '<a href="' . PT_REL_IMAGES . '/topnav2.gif" class="thickbox">Click Here</a> To View Top Navigation #2',
				'type' => 'note'
			);

$pt_design_options[] = array(
				'name' => 'Top Navigation 2 Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Navigation Tab close',
				'type' => 'tabclose'
			);

$pt_design_options[] = array(
				'name' => 'Typograhy Tab open',
				'id' => 'typo',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'General Typography',
				'type' => 'biglabel'
			);

$pt_design_options[] = array(
				'name' => 'General Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable general text and link color options. Use default style instead',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_general_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'General Text Font',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '15'
					),
				'desc' => 'Select the general font style for your site.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_general_text',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Link Color',
				'std' => '#0000FF',
				'desc' => 'Pick a custom color for links or add a hex color code.',
				'id' => $shortname . '_link_color',
				'type' => 'color'
			);

$pt_design_options[] = array(
				'name' => 'Link Hover Color',
				'std' => '#0000FF',
				'desc' => 'Pick a custom color for links hover or add a hex color code.',
				'id' => $shortname . '_link_hover_color',
				'type' => 'color'
			);


$pt_design_options[] = array(
				'name' => 'General Text Close',
				'type' => 'blockclose'
			);


$pt_design_options[] = array(
				'name' => 'Post Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom post typograhy. Use default style instead',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_post_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Custom Post Title Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '24'
					),
				'desc' => 'Select the typograhy for your post title.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_post_title',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Custom Post Text Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '15'
					),
				'desc' => 'Select the typograhy for your post text.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_post_text',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Custom Post Bylines and Meta Font',
				'std' => array(
					'color' => '#666', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '12'
					),
				'desc' => 'Select the typograhy for your post bylines and metadata.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_post_meta',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'PostText Close',
				'type' => 'blockclose'
			);


$pt_design_options[] = array(
				'name' => 'Sidebar Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom sidebar typograhy. Use default style instead',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_sidebar_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Custom Sidebar Title Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '16'
					),
				'desc' => 'Select the typograhy for your sidebar title.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_sidebar_title',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Custom Sidebar Text Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '13'
					),
				'desc' => 'Select the typograhy for your sidebar text.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_sidebar_text',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Sidebar Text Close',
				'type' => 'blockclose'
			);


$pt_design_options[] = array(
				'name' => 'Footerbar Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom footerbar typograhy. Use default style instead',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_footerbar_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Custom Footerbar Title Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '16'
					),
				'desc' => 'Select the typograhy for your footerbar title.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_footerbar_title',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Custom Footerbar Text Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '13'
					),
				'desc' => 'Select the typograhy for your footerbar text.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_footerbar_text',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Footerbar Text Close',
				'type' => 'blockclose'
			);


$pt_design_options[] = array(
				'name' => 'Footer Text Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Disable custom footer typograhy. Use default style instead',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_footer_font_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Custom Footer Text Font Styling',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '12'
					),
				'desc' => 'Select the typograhy for your footer text.<br /><br /><em>* non web-safe font</em>',
				'id' => $shortname . '_footer_text',
				'type' => 'typo'
			);

$pt_design_options[] = array(
				'name' => 'Footer Text Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Typograhy Tab close',
				'type' => 'tabclose'
			);

$pt_design_options[] = array(
				'name' => 'Thumbnails Tab open',
				'id' => 'thumb',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'Thumbnails',
				'type' => 'biglabel'
			);

$pt_design_options[] = array(
				'name' => 'Thumbnails Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'If no image is specified in the \'thumbnail\' custom field then the first uploaded post image will be used',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_auto_thumb',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Thumbnail Position',
				'std' => 'left',
				'desc' => 'Choose where you want the thumbnail appear.',
				'options' => array(
					'left' => 'Left',
					'right' => 'Right'
				),
				'id' => $shortname . '_thumb_pos',
				'type' => 'select'
			);

$pt_design_options[] = array(
				'name' => 'Post Thumbnail Size', 
				'std' => array( 'val1' => '120', 'val2' => '120'),
				'desc' => 'Enter an integer value between 80 and 250 pixels for post thumbnail on home page and archive.',
				'meta' => array( 'meta1' => 'Width', 'meta2' => 'Height' ),
				'id' => $shortname . '_thumb_size',
				'type' => 'doubletext'
			);

$pt_design_options[] = array(
				'name' => 'Single Post Thumbnail Size', 
				'std' => array( 'val1' => '200', 'val2' => '200'),
				'desc' => 'Enter an integer value between 120 and 300 pixels for single post thumbnail.',
				'meta' => array( 'meta1' => 'Width', 'meta2' => 'Height' ),
				'id' => $shortname . '_single_thumb_size',
				'type' => 'doubletext'
			);
	
$pt_design_options[] = array(
				'name' => 'Disable thumbnail display in single posts',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_single_thumb_disable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Thumbnails Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Thumbnails Tab close',
				'type' => 'tabclose'
			);

// Membership Options
$pt_design_options[] = array(
				'name' => 'Membership Tab open',
				'id' => 'membership',
				'type' => 'tabopen'
			);

$pt_design_options[] = array(
				'name' => 'Membership Site Design',
				'type' => 'biglabel'
			);

$pt_design_options[] = array(
				'name' => 'Membership Open',
				'type' => 'blockopen'
			);

/*
$pt_design_options[] = array(
				'name' => array(
					'skins' => 'Membership Site Skin',
					'colors' => 'Membership Site Color',
				),
				'std' => array(
					'skins' => 'default',
					'colors' => 'default.css',
				),
				'desc' => array(
					'skins' => 'Choose a great and professional skin for your membership site.',
					'colors' => 'Choose a cool color for your membership site.',
				),
				'id' => $shortname . '_member_theme',
				'type' => 'theme'
			);
*/

$pt_design_options[] = array(
				'name' => 'Choose Site Skins',
				'std' => array(
					'skins' => 'flat',
					'colors' => 'default.css',
				),
				'desc' => '',
				'id' => $shortname . '_member_theme',
				'type' => 'skinsmanager'
			);

$pt_design_options[] = array(
				'name' => 'Membership Sidebar Position',
				'std' => 'right',
				'desc' => 'Choose where you want the sidebar navigation to appear.',
				'options' => array(
					'left' => 'Left',
					'right' => 'Right',
				),
				'id' => $shortname . '_member_sidebar_pos',
				'type' => 'select'
			);

$pt_design_options[] = array(
				'name' => 'Membership Sidebar Menu Text',
				'std' =>  'Members Navigation',
				'desc' => 'Type the text you want to appear as the title of the membership sidebar menu.',
				'id' => $shortname . '_member_sidebar_text',
				'type' => 'text'
			);

$pt_design_options[] = array(
				'name' => 'Membership Columns Width', 
				'std' => array( 'val1' => '700', 'val2' => '300'),
				'desc' => 'Enter digits to define the membership main content and sidebar width.',
				'meta' => array( 'meta1' => 'Main Content', 'meta2' => 'Sidebar' ),
				'id' => $shortname . '_member_columns_width',
				'type' => 'doubletext'
			);

$pt_design_options[] = array(
				'name' => 'Membership Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Membership Open',
				'type' => 'blockopen'
			);

$pt_design_options[] = array(
				'name' => 'Use <strong>Text Site Title</strong> instead of an image logo. Setup in <a href="' . admin_url('options-general.php') . '" target="_blank">WP -> Settings -> General</a>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_membership_text_logo',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Display Image Logo on Membership Header',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_site_logo_enable',
				'type' => 'checkbox'
			);

$pt_design_options[] = array(
				'name' => 'Membership Logo/Image URL',
				'std' => get_bloginfo('template_url') . '/images/logo.png',
				'desc' => 'Type the full path URL to your logo on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button. Use a transparent PNG image for best results.',
				'id' => $shortname . '_membership_custom_logo',
				'type' => 'upload'
			);

$pt_design_options[] = array(
				'name' => array(
					'type' => 'Membership Header Image',
					'upload' => 'Custom Header Image URL',
					'align' => 'Custom Header Image Alignment',
				),
				'std' => array(
					'type' => '',
					'upload' => '',
					'align' => 'center',
				),
				'desc' => array(
					'type' => 'You can upload your own header image, or use the Profits Theme pre-made background.',
					'upload' => 'Type the full path URL to your header image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br />Recommended width for your header is <strong>940 pixels</strong>.',
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
				'id' => $shortname . '_member_header_background',
				'type' => 'header',
			);

$pt_design_options[] = array(
				'name' => 'Membership Header Height',
				'std' => '100',
				'desc' => 'Specify the height of the membership site header.',
				'suffix' => 'px',
				'width' => '60',
				'id' => $shortname . '_member_header_height',
				'type' => 'text'
			);

$pt_design_options[] = array(
				'name' => 'Membership Close',
				'type' => 'blockclose'
			);

$pt_design_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_design_options[] = array(
				'name' => 'Membership Tab close',
				'type' => 'tabclose'
			);

$pt_design_options[] = array(
				'name' => 'Design Action',
				'std' => 'save',
				'id' => 'action',
				'type' => 'hidden'
			);