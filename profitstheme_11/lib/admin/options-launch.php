<?php

$pt_launch_options   = array();

$pt_launch_options[] = array(
				'name' => 'Launch Tab open',
				'id' => 'launch',
				'type' => 'tabopen'
			);

$pt_launch_options[] = array(
				'name' => 'Product Launch Settings',
				'type' => 'biglabel'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Open',
				'type' => 'blockopen'
			);

$pt_launch_options[] = array(
				'name' => 'Product Launch Note',
				'std' => '',
				'desc' => '<a href="http://www.getprofitsfast.com/member/profits-theme/?page_id=722" target="_blank">Click here</a> to learn more about setting up a product launch.',
				'id' => $shortname . '_launch_note',
				'type' => 'note'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Mode',
				'std' => 'onetime',
				'desc' => 'Choose the launch type for your product.',
				'options' => array(
					'onetime' => 'Standard Launch',
					'evergreen' => 'Evergreen Launch',
				),
				'id' => $shortname . '_launch_mode',
				'type' => 'select'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Gateway Squeeze Page ',
				'std' => '',
				'desc' => 'If you enabled the "Force Opt-In," all the non-subscribers that tries to view your launch contents will be redirected here.',
				'options' => $pt_pages,
				'id' => $shortname . '_launch_entry',
				'type' => 'select'
			);

$pt_launch_options[] = array(
				'name' => 'Coming Soon Page ',
				'std' => '',
				'desc' => 'This page will be replaced your launch pages, including the launch gateway page if the first launch page hasn\'t been released.',
				'options' => $pt_pages,
				'id' => $shortname . '_launch_soon',
				'type' => 'select'
			);

$pt_launch_options[] = array(
				'name' => 'Enable Force Opt-In',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_launch_force',
				'type' => 'checkbox'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Funnel Navigation Settings',
				'std' => 'showall',
				'desc' => 'Choose the behaviour of the launch funnel navigation.',
				'options' => array(
					'showall' => 'Show Upcoming Pages',
					'noupcoming' => 'Don\'t Show Upcoming Pages',
				),
				'id' => $shortname . '_launch_nav',
				'type' => 'select'
			);

$pt_launch_options[] = array(
				'name' => 'Add/Remove Launch Page(s)',
				'std' => array(
						'pages' => '',
						'order' => '',
					),
				'desc' => 'Choose the pages you want to add in the launch sequence. This also includes your sales page.',
				'options' => $pt_landing_pages,
				'id' => $shortname . '_launch_pages',
				'type' => 'addlaunchpages'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Close',
				'type' => 'blockclose'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Tab close',
				'type' => 'tabclose'
			);

$pt_launch_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_launch_options[] = array(
				'name' => 'Launch Action',
				'std' => 'save',
				'id' => 'action',
				'type' => 'hidden'
			);

