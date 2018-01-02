<?php

//////////////////////////////////
// Page Generator Options
//////////////////////////////////

$pt_generator_options   = array();

$pt_generator_options[] = array(
				'name' => 'Generator Tab Open',
				'id' => 'generator',
				'type' => 'tabopen'
			);

$pt_generator_options[] = array(
				'name' => 'Page Generator',
				'type' => 'biglabel'
			);

$pt_generator_options[] = array(
				'name' => 'Page Generator Open',
				'type' => 'blockopen'
			);

$pt_generator_options[] = array(
				'name' => 'PG Note',
				'std' => '',
				'desc' => 'The <b>FASTEST</b> and <b>EASIEST</b> way to create your landing page(s) and membership page(s) is to select the page(s) you want to create below, and then click the "Generate Page(s)" button at the bottom of this page.<br><br>You can follow the traditional way of creating a page by going to pages >> add new, but that is not as fast and easy as using the Page Generator on this page.',
				'id' => $shortname . '_page_generator_note',
				'type' => 'note'
			);
			
$pt_generator_options[] = array(
				'name' => 'Squeeze Pages',
				'type' => 'generatortitle',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new text squeeze page (1 column).</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_squeeze1',
				'title' => 'Text Squeeze Page 1 (single column)',
				'file' => 'squeeze1.txt',
				'type' => 'instantpage',
				'headline' => '"FREE [Report/Audio/Video] Reveals How To Get [insert benefit here]"',
				'layout' => 'squeeze-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new text squeeze page (2 columns).</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_squeeze2',
				'title' => 'Text Squeeze Page 2 (double columns)',
				'file' => 'squeeze2.txt',
				'type' => 'instantpage',
				'headline' => '"FREE [Report/Audio/Video] Reveals How To Get [insert benefit here]"',
				'layout' => 'squeeze-page-double',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new video squeeze page (1 column).</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_squeeze3',
				'title' => 'Video Squeeze Page 1 (single column)',
				'file' => 'squeeze3.txt',
				'type' => 'instantpage',
				'headline' => '"FREE [Report/Audio/Video] Reveals How To Get [insert benefit here]"',
				'layout' => 'vsqueeze-page-single',
			);


$pt_generator_options[] = array(
				'name' => 'Generate <b>a new video squeeze page (2 columns).</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_squeeze4',
				'title' => 'Video Squeeze Page 2 (double columns)',
				'file' => 'squeeze4.txt',
				'type' => 'instantpage',
				'headline' => '"FREE [Report/Audio/Video] Reveals How To Get [insert benefit here]"',
				'layout' => 'vsqueeze-page-double',
			);

$pt_generator_options[] = array(
				'name' => 'Sales Pages',
				'type' => 'generatortitle'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new sales page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_sales_page',
				'title' => 'Sales Letter Page',
				'file' => 'salesletter.txt',
				'type' => 'instantpage',
				'headline' => '"Proven Formula Guarantees To Get [insert benefit here] In [X Days] Or Your Money Back..."',
				'layout' => 'sales-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Product Launch Pages',
				'type' => 'generatortitle'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new product launch page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_product_launch',
				'title' => 'Product Launch',
				'file' => 'product-launch.txt',
				'type' => 'instantpage',
				'headline' => '"Watch The Video Below To Learn How You Can Get [insert benefit here]"',
				'layout' => 'product-launch-page',
			);

$pt_generator_options[] = array(
				'name' => 'Membership Pages',
				'type' => 'generatortitle'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new free members sign up page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_members_signup',
				'title' => 'Free Members Sign Up',
				'file' => 'squeeze2.txt',
				'type' => 'instantpage',
				'headline' => '"FREE [Report/Audio/Video] Reveals How To Get [insert benefit here]"',
				'layout' => 'squeeze-page-signup',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member area home page/welcome page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_home',
				'title' => 'Membership Home',
				'file' => 'member-home.txt',
				'type' => 'instantpage',
				'headline' => 'Welcome To [Product Name] Dashboard',
				'layout' => 'member-home',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member module page</b> (which contains links to individual content pages for that module).',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_cat',
				'title' => 'Membership Module',
				'file' => 'member-cat.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-cat',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member content page </b> (which contains your content).',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_content',
				'title' => 'Membership Content',
				'file' => 'member-content.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-content',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member account page.</b>.',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_account',
				'title' => 'Your Account',
				'file' => 'blank.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-account',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member login page (for Free Members, Zaxaa, Clickbank, PayPal, JVZoo, Wishlist).</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_login-1',
				'title' => 'Members Login (for Free Members, Clickbank, PayPal, Wishlist)',
				'file' => 'blank.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-login-1',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member login page (for Digital Access Pass).</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_login-2',
				'title' => 'Members Login (for Digital Access Pass)',
				'file' => 'dap-login.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-login-2',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member access error page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_error',
				'title' => 'Members Access Error',
				'file' => 'member-error.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-error',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member "content unavailable" error page. </b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_drip',
				'title' => 'Content Unavailable',
				'file' => 'blank.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-drip',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member "content expired" error page. </b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_expired',
				'title' => 'Content Expired',
				'file' => 'blank.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-expired',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new member logout page. </b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_member_logout',
				'title' => 'Logout',
				'file' => 'blank.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'member-logout',
				'group' => 'membership'
			);

$pt_generator_options[] = array(
				'name' => 'Legal Pages',
				'type' => 'generatortitle'
			);

$pt_generator_options[] = array(
				'name' => 'Privacy',
				'std' => 'false',
				'desc' => '<strong>Note:</strong> Make sure you already filled in your business information before generating legal pages. Click the "Business Information" tab above to do so.',
				'id' => $shortname . '_legal_generator notes',
				'type' => 'note',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new privacy policy page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_privacy_policy',
				'title' => 'Privacy Policy',
				'file' => 'privacy.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new disclaimer page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_disclaimer',
				'title' => 'Disclaimer',
				'file' => 'disclaimer.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new terms of service page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_tos',
				'title' => 'Terms Of Service',
				'file' => 'tos.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);


$pt_generator_options[] = array(
				'name' => 'Other Pages',
				'type' => 'generatortitle'
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new optin confirmation page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_squeeze_confirm',
				'title' => 'Optin Confirmation Page',
				'file' => 'squeeze-confirm.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new thanks for confirming email page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_squeeze_download',
				'title' => 'Thanks For Confirming Email Page',
				'file' => 'squeeze-thankyou.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new download page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_prod_dl',
				'title' => 'Download Page',
				'file' => 'downloadpage.txt',
				'type' => 'instantpage',
				'headline' => 'Download Area',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new affiliate tools page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_aff',
				'title' => 'Affiliate Tools',
				'file' => 'aff.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new contact us page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_contact_us',
				'title' => 'Contact Us',
				'file' => 'contact.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new FAQ page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_faq',
				'title' => 'Frequently Asked Questions',
				'file' => 'faq.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'general-page-single',
			);

$pt_generator_options[] = array(
				'name' => 'Generate <b>a new one time offer/upsell/downsell page.</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_oto',
				'title' => 'One Time Offer',
				'file' => 'oto.txt',
				'type' => 'instantpage',
				'headline' => '',
				'layout' => 'sales-page-single-oto',
			);

$pt_generator_options[] = array(
				'name' => 'Page Generator Close',
				'type' => 'blockclose'
			);

$pt_generator_options[] = array(
				'name' => 'Generate Page(s)',
				'type' => 'submit'
			);

$pt_generator_options[] = array(
				'name' => 'Generator Tab Close',
				'type' => 'tabclose'
			);

$pt_generator_options[] = array(
				'name' => 'Business Tab Open',
				'id' => 'business',
				'type' => 'tabopen'
			);

$pt_generator_options[] = array(
				'name' => 'Page Generator Open',
				'type' => 'blockopen'
			);

$pt_generator_options[] = array(
				'name' => 'Business Name',
				'std' => 'My Business Name',
				'desc' => 'Your business or company name. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_name',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Company\'s Registration Number (Optional)',
				'std' => '',
				'desc' => 'Your company\'s registration number. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_regnum',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Company\'s Place of Registration (Optional)',
				'std' => '',
				'desc' => 'Your company\'s place of registration. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_regplace',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Company\'s Address',
				'std' => '',
				'desc' => 'Your business address. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_address',
				'type' => 'textarea'
			);

$pt_generator_options[] = array(
				'name' => 'City',
				'std' => '',
				'desc' => 'Your city. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_city',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'State',
				'std' => '',
				'desc' => 'Your state. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_state',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Country',
				'std' => '',
				'desc' => 'Your country. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_country',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Zip Code',
				'std' => '',
				'desc' => 'Your zip code. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_zipcode',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Email Address',
				'std' => 'info@' . $_SERVER['HTTP_HOST'],
				'desc' => 'Your business email address. Needed when you\'re about to generate legal pages, such as Tos, Disclaimer or Privacy Policy.',
				'id' => $shortname . '_business_email',
				'type' => 'text'
			);

$pt_generator_options[] = array(
				'name' => 'Page Generator Info Note',
				'type' => 'note',
				'desc' => '<strong>Important:</strong> <em>Please note that you cannot save your business information and generate some pages at the same time. If you make some changes to your business information above, please make sure that you UNCHECK everything in the "Page Generator" tab before clicking the "Save Changes" button.</em>'
			);

$pt_generator_options[] = array(
				'name' => 'Page Generator Close',
				'type' => 'blockclose'
			);

$pt_generator_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_generator_options[] = array(
				'name' => 'Business Tab Close',
				'type' => 'tabclose'
			);

$pt_generator_options[] = array(
				'name' => 'Generator Action',
				'std' => 'save',
				'id' => 'action',
				'type' => 'hidden'
			);


//////////////////////////////////
// Update Options
//////////////////////////////////


$pt_update_options[] = array();

$pt_update_options[] = array(
				'name' => 'Update Tab Open',
				'id' => 'update',
				'type' => 'tabopen'
			);

$pt_update_options[] = array(
				'name' => 'Install Tools',
				'type' => 'biglabel'
			);

$pt_update_options[] = array(
				'name' => 'Update Profits Theme',
				'type' => 'updatefield',
				'id' => $shortname . '_update',
			);

$pt_update_options[] = array(
				'name' => 'Update Tab Close',
				'type' => 'tabclose'
			);

//////////////////////////////////
// Manage Options
//////////////////////////////////

$pt_settings_options   = array();

$pt_settings_options[] = array(
				'name' => 'Settings Tab Open',
				'id' => 'settings',
				'type' => 'tabopen'
			);

$pt_settings_options[] = array(
				'name' => 'Export/Import/Reset Tools',
				'type' => 'biglabel'
			);



$pt_settings_options[] = array(
				'name' => 'Settings Open',
				'type' => 'blockopen'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_export_options',
				'type' => 'formopen',
			);

$pt_settings_options[] = array(
				'name' => 'Export Profits Theme Options',
				'std' => 'all',
				'desc' => 'Choose the type of options that you want to export/backup to a DAT file.',
				'options' => array(
					'site' => 'Site Options',
					'design' => 'Design Options',
				),
				'id' => $shortname . '_export_type',
				'type' => 'select'
			);

$pt_settings_options[] = array(
				'name' => 'Export Options',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'export',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'export',
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Settings close',
				'type' => 'blockclose'
			);

$pt_settings_options[] = array(
				'name' => 'Settings Open',
				'type' => 'blockopen'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_import_site_options',
				'type' => 'formopen',
			);

$pt_settings_options[] = array(
				'name' => 'Import Site Options',
				'std' => '',
				'desc' => 'Import Site Options from a DAT file.<br /><br /><strong>Warning:</strong> This will override your current settings.',
				'id' => $shortname . '_import_site',
				'type' => 'import'
			);

$pt_settings_options[] = array(
				'name' => 'Import Site Options',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'import',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'importsite'
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_import_design_options',
				'type' => 'formopen',
			);

$pt_settings_options[] = array(
				'name' => 'Import Design Options',
				'std' => '',
				'desc' => 'Import Design Options from a DAT file.<br /><br /><strong>Warning:</strong> This will override your current settings.',
				'id' => $shortname . '_import_design',
				'type' => 'import'
			);

$pt_settings_options[] = array(
				'name' => 'Import Design Options',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'import',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'importdesign'
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Settings close',
				'type' => 'blockclose'
			);

$pt_settings_options[] = array(
				'name' => 'Settings Open',
				'type' => 'blockopen'
			);

$pt_settings_options[] = array(
				'name' => 'Reset Site Options To Default',
				'type' => 'fieldtitle'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_reset_site',
				'type' => 'formopen',
				'msg' => 'This will erase all changes that you already made to site options, including your autoresponders. Are you sure want to continue?'
			);

$pt_settings_options[] = array(
				'name' => 'Reset Site Options',
				'type' => 'submit',
			);

$pt_settings_options[] = array(
				'name' => 'resetsite',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'resetsite',
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Reset Design Options To Default',
				'type' => 'fieldtitle'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_reset_design',
				'type' => 'formopen',
				'msg' => 'This will erase all changes that you already made to design options. Are you sure want to continue?'
			);

$pt_settings_options[] = array(
				'name' => 'Reset Design Options',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'resetdesign',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'resetdesign',
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_reset_all',
				'type' => 'formopen',
				'msg' => 'This will erase all changes that you already made to profits theme options, including your autoresponders. Are you sure want to continue?'
			);

$pt_settings_options[] = array(
				'name' => 'Reset All Options (site & design) To Default',
				'type' => 'fieldtitle'
			);

$pt_settings_options[] = array(
				'name' => 'Reset All Options',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'reset',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'reset',
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_reset_protection',
				'type' => 'formopen',
				'msg' => 'This will remove all membership protection posts & pages . Are you sure want to continue?'
			);

$pt_settings_options[] = array(
				'name' => 'Reset Membership Protection In Posts & Pages',
				'type' => 'fieldtitle'
			);

$pt_settings_options[] = array(
				'name' => 'Reset Protection',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'resetprotection',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'resetprotection',
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Form Open',
				'id' => $shortname . '_reset_license',
				'type' => 'formopen',
				'msg' => 'This will erase your license, and disable Profits Theme. Are you sure want to continue?'
			);

$pt_settings_options[] = array(
				'name' => 'Reset License & Disable Profits Theme',
				'type' => 'fieldtitle'
			);

$pt_settings_options[] = array(
				'name' => 'Reset License',
				'type' => 'submit'
			);

$pt_settings_options[] = array(
				'name' => 'resetlicense',
				'id' => 'action',
				'type' => 'hidden',
				'std' => 'resetlicense',
			);

$pt_settings_options[] = array(
				'name' => 'Form Close',
				'type' => 'formclose'
			);

$pt_settings_options[] = array(
				'name' => 'Settings Close',
				'type' => 'blockclose'
			);

$pt_settings_options[] = array(
				'name' => 'Settings Tab Close',
				'type' => 'tabclose'
			);

//////////////////////////////////
// Register Options
//////////////////////////////////

$pt_register_options   = array();

$pt_register_options[] = array(
				'name' => 'Registration Tab Open',
				'id' => 'registration',
				'type' => 'tabopen'
			);

$pt_register_options[] = array(
				'name' => 'Activate Profits Theme',
				'type' => 'biglabel'
			);

$pt_register_options[] = array(
				'name' => 'Register Open',
				'type' => 'blockopen'
			);

/*
$pt_register_options[] = array(
				'name' => 'Email Address',
				'std' => '',
				'desc' => 'Your email address in which you have used when you bought Profits Theme.',
				'id' => $shortname . '_email_address',
				'type' => 'text'
			);
*/

$pt_register_options[] = array(
				'name' => 'Your License Key',
				'std' => '',
				'desc' => 'Enter your license key to activate Profits Theme. If you don\'t have an license key, you can obtain it by <a href="http://profitstheme.com" target="_blank">clicking here</a>',
				'id' => $shortname . '_api_key',
				'type' => 'text'
			);

$pt_register_options[] = array(
				'name' => 'Register Close',
				'type' => 'blockclose'
			);

$pt_register_options[] = array(
				'name' => 'Activate Now!',
				'type' => 'submit'
			);

$pt_register_options[] = array(
				'name' => 'Register Tab Close',
				'type' => 'tabclose'
			);

$pt_register_options[] = array(
				'name' => 'Register Action',
				'std' => 'activate',
				'id' => 'action',
				'type' => 'hidden'
			);