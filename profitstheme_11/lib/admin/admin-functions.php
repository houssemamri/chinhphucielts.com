<?php

function pt_create_membership_table()
{
	global $wpdb;

	$product_table = $wpdb->prefix . 'ptmembership_products';

	if ( $wpdb->get_var("SHOW TABLES LIKE '$product_table'") != $product_table ) {
		$create_table = "CREATE TABLE `$product_table` (
			`product_id` int(11) NOT NULL auto_increment,
			`old_id` int(11) NOT NULL,
			`product_number` varchar(20) NOT NULL,
			`product_title` varchar(100) NOT NULL,
			`payment_proccessor` varchar(100) NOT NULL,
			`product_price` decimal(11,2) NOT NULL DEFAULT '0.00',
			`cb_item_number` int(11) NOT NULL DEFAULT '0',
			`cb_vendor_name` varchar(100) NOT NULL,
			`pypl_payment_type` varchar(50) NOT NULL,
			`pypl_subs_duration` int(11) NOT NULL DEFAULT '0',
			`pypl_subs_duration_mode` varchar(20) NOT NULL,
			`pypl_recur_times` int(11) NOT NULL DEFAULT '0',
			`pypl_trial_price` decimal(11,2) NOT NULL DEFAULT '0.00',
			`pypl_trial_duration` int(11) NOT NULL DEFAULT '0',
			`pypl_trial_duration_mode` varchar(20) NOT NULL,
			`pypl_currency` varchar(32) NOT NULL,
			`pypl_return_page` varchar(10) NOT NULL,
			`pypl_cancel_page` varchar(10) NOT NULL,
			`ar_enable` varchar(10) NOT NULL,
			`ar_account` varchar(100) NOT NULL,
			`ar_list_name` varchar(100) NOT NULL,
			`ar_gr_api` varchar(255) NOT NULL,
			`ar_mc_api` varchar(255) NOT NULL,
			`product_added` int(11) NOT NULL DEFAULT '0',
			PRIMARY KEY (`product_id`)
		) COLLATE utf8_general_ci;";
		$wpdb->query($create_table);
	}
}

function pt_create_elements_table()
{
	global $wpdb;

	$elements_table = $wpdb->prefix . 'pt_elements';
	
	if (get_option('pt_update_130') == 'updated'){
		return;
	}else{
		$sql = "DROP TABLE IF EXISTS $elements_table";
		$e = $wpdb->query($sql);
		
		if ($wpdb->query($sql)){
			update_option('pt_update_130', 'updated');
		}
	}

	if ( $wpdb->get_var("SHOW TABLES LIKE '$elements_table'") != $elements_table ) {
		// Create Table
		$create_table = "CREATE TABLE `$elements_table` (
			`id` int(8) NOT NULL auto_increment,
			`element_id` varchar(50) NOT NULL,
			`title` varchar(100) NOT NULL,
			`clone` int(2) NOT NULL,
			PRIMARY KEY (`id`)
		) COLLATE utf8_general_ci;";
		$wpdb->query($create_table);

		// Insert Each Elements Data
		$data = array(
			'lp-headline' => array( 'lp-headline', 'Headline', 1 ),
			'lp-content' => array( 'lp-content', 'Main Content', 0 ),
			'lp-optin' => array( 'lp-optin', 'Optin Form', 1 ),
			'lp-optin-2' => array( 'lp-optin-2', 'Optin Form 2', 1 ),
			'lp-pre-headline' => array( 'lp-pre-headline', 'Pre-Headline', 1 ),
			'lp-sub-headline' => array( 'lp-sub-headline', 'Sub-Headline', 1 ),
			'lp-fake-video' => array( 'lp-fake-video', 'Fake Video', 1 ),
			'lp-warning' => array( 'lp-warning', 'Optin Warning Sign', 1 ),
			'lp-sidebar' => array( 'lp-sidebar', 'Sidebar Widgets', 0 ),
			'lp-comments' => array( 'lp-comments', 'Comments', 0 ),
			'lp-social' => array( 'lp-social', 'Social Buttons', 1 ),
			'lp-svideo' => array( 'lp-svideo', 'Simple Video', 1 ),
			'lp-video' => array( 'lp-video', 'Advanced Video', 1 ),
			'lp-svideo-2' => array( 'lp-svideo-2', 'Simple Video 2', 1 ),
			'lp-video-2' => array( 'lp-video-2', 'Advanced Video 2', 1 ),
			'lp-image' => array( 'lp-image', 'Single Image', 1 ),
			'lp-image-2' => array( 'lp-image-2', 'Single Image 2', 1 ),
			'lp-order' => array( 'lp-order', 'Add To Cart', 1 ),
			'lp-order-2' => array( 'lp-order-2', 'Add To Cart 2', 1 ),
			'lp-funnel' => array( 'lp-funnel', 'Launch Funnel', 1 ),
			'lp-register' => array( 'lp-register', 'Registration + Optin Form', 1 ),
			'lp-script' => array( 'lp-script', 'Script', 1 )
		);

		foreach ( $data as $value ) {
			$wpdb->query("INSERT INTO `$elements_table` ( `element_id`, `title`, `clone` ) VALUES ( '" . $value[0] . "', '" . $value[1] . "', '" . $value[2] . "')");
		}

		unset($data);
	}

	$elements_data_table = $wpdb->prefix . 'pt_elements_data';

	if ( $wpdb->get_var("SHOW TABLES LIKE '$elements_data_table'") != $elements_data_table ) {
		// Create Table
		$create_table = "CREATE TABLE `$elements_data_table` (
			`id` int(8) NOT NULL auto_increment,
			`post_id` int(11) NOT NULL,
			`element_id` varchar(50) NOT NULL,
			`element_num` int(8) NOT NULL,
			`column` varchar(20) NOT NULL,
			`pos` int(5) NOT NULL,
			`data` longtext NOT NULL,
			PRIMARY KEY (`id`)
		) COLLATE utf8_general_ci;";
		$wpdb->query($create_table);
	}
}

function pt_import_elements()
{
	if ( get_option('pt_elements_imported') === FALSE ) {
		$pages = get_posts('post_type=page&numberposts=9999&orderby=name');
		
		if ( $pages ) {
			foreach ( $pages as $page ) {
				$tmpl = get_post_meta($page->ID, '_wp_page_template', true );

				if ( $tmpl == 'page-sales.php' ) {
		
					// import top columns
					pt_import_element_data($page->ID, 'lp-pre', 'top');

					// import left columns
					pt_import_element_data($page->ID, 'lp-main', 'left');

					// import right columns
					pt_import_element_data($page->ID, 'lp-side', 'right');

					// import bottom columns
					pt_import_element_data($page->ID, 'lp-bottom', 'bottom');
				}
			}
		}

		update_option('pt_elements_imported', 1);
	}
}

function pt_save_element_data($post_id, $column, $position)
{
	global $wpdb;

	$elements_data_table = "{$wpdb->prefix}pt_elements_data";

	if ( $column != 'clean' && $column != '' ) {
		$column = explode("|", $column);
		for ( $i = 0; $i < count($column); $i++ ) {
			$col = explode("/", $column[$i]);
	
			$element_id = $col[0];
			$element_num = 1;
			$pos = $i;
			$data = ''; // Just leave this blank in version 1.1.3

			// insert into table
			$wpdb->query("INSERT INTO `$elements_data_table` ( `post_id`, `element_id`, `element_num`, `column`, `pos`, `data` ) VALUES ( $post_id, '$element_id', '$element_num', '$position', '$pos', '$data')");
							
			$data = '';
		}
	}
}

function pt_import_element_data($post_id, $column, $position)
{
	global $wpdb;

	$elements_data_table = $wpdb->prefix . 'pt_elements_data';

	$meta = get_post_meta($post_id, 'pt_landing_meta_box', true);
	$column = $meta[$column];

	if ( $column != 'clean' && $column != '' ) {
		$column = explode("|", $column);
		for ( $i = 0; $i < count($column); $i++ ) {
			$col = explode("/", $column[$i]);
	
			$element_id = $col[0];
			$element_num = 1;
			$pos = $i;
			$data = ''; // Just leave this blank in version 1.1.3

			// insert into table
			$wpdb->query("INSERT INTO `$elements_data_table` ( `post_id`, `element_id`, `element_num`, `column`, `pos`, `data` ) VALUES ( $post_id, '$element_id', '$element_num', '$position', '$pos', '$data')");
							
			$data = '';
		}
	}
}

function pt_extract_element_data($meta, $element_id)
{
	if ( !is_array( $meta ) ) return $meta;

	$assocKeys = array();
	foreach ( $meta as $key => $value ) {
		if ( !stristr( $key, $element_id ) ) {
			$assocKeys[$key] = true;
		} 
	}

	return array_diff_key($meta, $assocKeys);
}

function pt_get_elements_col( $post_id, $col )
{
	global $wpdb;
	$elements = $wpdb->get_results( $wpdb->prepare("
			SELECT ed.*, e.title, e.clone
			FROM {$wpdb->prefix}pt_elements_data ed
			LEFT JOIN {$wpdb->prefix}pt_elements e
			ON ed.element_id = e.element_id
			WHERE ed.post_id = %d AND ed.column = %s
			ORDER BY ed.pos ASC", $post_id, $col) );

	if ( !$elements ) return false;
	
	return $elements;
}

/**
 * Retrieve all elements that can inserted to landing page columns.
 *
 * @since 1.1.3
 *
 * @uses $wpdb to query the database
 * @param int $post_id. Post ID to retrieve categories.
 * @param array $exclude. List of uncloneable elements that already used.
 * @return string of elements list
 */
function pt_get_elements( $post_id, $exclude )
{
	global $wpdb;

	$elements = $wpdb->get_results( "SELECT * FROM `{$wpdb->prefix}pt_elements` ORDER BY title ASC" );

	$elms = array();				

	if ( !$elements ) return;
	
	foreach( $elements as $element ) {
		$elms[] = "{$element->element_id}/{$element->title}";
	}

	// remove some elements that needs to be excluded
	// Check for post meta first... if return empty, then override the $exclude
	if ( get_post_meta($post_id, 'pt_landing_meta_box', true) == '' ) {
		$exclude = array( 'lp-headline/Headline', 'lp-optin/Optin Form', 'lp-content/Main Content' );
	}
		
	if ( count($exclude) > 0 ) {
		$elms = array_diff($elms, $exclude);
	}

	$elms = implode("|", $elms);

	return $elms;
}

function pt_query_product( $id, $edit = false, $product_id = 0 )
{
	global $wpdb, $current_user;
	get_currentuserinfo();

	$product_table = $wpdb->prefix . 'ptmembership_products';

	$p_name    = $_REQUEST[$id . '_product_title'];
	$p_type    = $_REQUEST[$id . '_payment_processor'];
	$p_number  = $_REQUEST[$id . '_number'];
	$cb_item   = (isset($_REQUEST[$id . '_cb_item'])) ? $_REQUEST[$id . '_cb_item'] : '';
	$cb_vendor = ( isset($_REQUEST[$id . '_cbid']) ) ? $_REQUEST[$id . '_cbid'] : '';
	
	$zx_item   = ( isset($_REQUEST[$id . '_zx_item']) ) ? $_REQUEST[$id . '_zx_item'] : '';
	$jvz_item   = ( isset($_REQUEST[$id . '_jvz_item']) ) ? $_REQUEST[$id . '_jvz_item'] : '';
	
	$p_price   = (isset($_REQUEST[$id . '_product_price'])) ? $_REQUEST[$id . '_product_price'] : '';
	$pypl_payment_type   = (isset($_REQUEST[$id . '_pypl_payment'])) ? $_REQUEST[$id . '_pypl_payment'] : '';
	$pypl_subs_duration  = (isset($_REQUEST[$id . '_pypl_subs_dur'])) ? $_REQUEST[$id . '_pypl_subs_dur'] : 0;
	$pypl_subs_dur_mode  = (isset($_REQUEST[$id . '_pypl_subs_dur_mode'])) ? $_REQUEST[$id . '_pypl_subs_dur_mode'] : 'D';
	$pypl_recur_times    = (isset($_REQUEST[$id . '_pypl_recurr'])) ? $_REQUEST[$id . '_pypl_recurr'] : 0;
	$pypl_trial_price    = (isset($_REQUEST[$id . '_pypl_trial'])) ? $_REQUEST[$id . '_pypl_trial'] : '0.00';
	$pypl_trial_duration = (isset($_REQUEST[$id . '_pypl_trial_dur'])) ? $_REQUEST[$id . '_pypl_trial_dur'] : 0;
	$pypl_trial_dur_mode = (isset($_REQUEST[$id . '_pypl_trial_dur_mode'])) ? $_REQUEST[$id . '_pypl_trial_dur_mode'] : 'D';
	$pypl_currency       = (isset($_REQUEST[$id . '_pypl_currency'])) ? $_REQUEST[$id . '_pypl_currency'] : '';
	$pypl_return_page    = (isset($_REQUEST[$id . '_pypl_return']) && $_REQUEST[$id . '_pypl_return'] != '' ) ? $_REQUEST[$id . '_pypl_return'] : '';
	$pypl_cancel_page    = (isset($_REQUEST[$id . '_pypl_cancel'])  && $_REQUEST[$id . '_pypl_return'] != '' ) ? $_REQUEST[$id . '_pypl_cancel'] : '';
	$ar_enable           = (isset($_REQUEST[$id . '_ar_enable'])) ? 'yes' : 'no';
	$ar_account          = (isset($_REQUEST[$id . '_ar_lists'])) ? $_REQUEST[$id . '_ar_lists'] : '';
	$ar_list_name        = (isset($_REQUEST[$id . '_list_name']) && $_REQUEST[$id . '_list_name'] != '' ) ? trim($_REQUEST[$id . '_list_name']) : '';
	$ar_gr_api_key       = (isset($_REQUEST[$id . '_gr_api_key'])  && $_REQUEST[$id . '_gr_api_key'] != '' ) ? trim($_REQUEST[$id . '_gr_api_key']) : '';
	$ar_mc_api_key       = (isset($_REQUEST[$id . '_mc_api_key'])  && $_REQUEST[$id . '_mc_api_key'] != '' ) ? trim($_REQUEST[$id . '_mc_api_key']) : '';

	$p_added  = time();

	if ( $p_name != '' ) {

		if ( $p_type == 'cb') {
			if ( $cb_item == '' ) {
				$page_redir = ( $edit == true ) ? 'admin.php?page=' . pt_isset($_GET['page']) . '&action=edit&product_id=' . $product_id . '&cbitemerror=true' : 'admin.php?page=' . pt_isset($_GET['page']) . '&cbitemerror=true';
				wp_redirect(admin_url($page_redir));
				die;
			}

			if ( $cb_vendor == '' ) {
				$page_redir = ( $edit == true ) ? 'admin.php?page=' . pt_isset($_GET['page']) . '&action=edit&product_id=' . $product_id . '&cbvendorerror=true' : 'admin.php?page=' . pt_isset($_GET['page']) . '&cbvendorerror=true';
				wp_redirect(admin_url($page_redir));
				die;
			}
		}
				
		$data = array(
				'product_number' => $p_number,
				'product_title' => $p_name,
				'payment_proccessor' => $p_type,
				'product_price' => $p_price,
				'cb_item_number' => $cb_item,
				'cb_vendor_name' => (( $p_type == 'zaxaa' ) ? $zx_item : (( $p_type == 'jvzoo' ) ? $jvz_item : $cb_vendor)),
				'pypl_payment_type' => $pypl_payment_type,
				'pypl_subs_duration' => $pypl_subs_duration,
				'pypl_subs_duration_mode' => $pypl_subs_dur_mode,
				'pypl_recur_times' => $pypl_recur_times,
				'pypl_trial_price' => $pypl_trial_price,
				'pypl_trial_duration' => $pypl_trial_duration,
				'pypl_trial_duration_mode' => $pypl_trial_dur_mode,
				'pypl_currency' => $pypl_currency,
				'pypl_return_page' => $pypl_return_page,
				'pypl_cancel_page' => $pypl_cancel_page,
				'ar_enable' => $ar_enable,
				'ar_account' => $ar_account,
				'ar_list_name' => $ar_list_name,
				'ar_gr_api' => $ar_gr_api_key,
				'ar_mc_api' => $ar_mc_api_key,
				'product_added' => $p_added
			);

		$format = array( '%s', '%s', '%s', '%s', '%d', '%s', '%s', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' );

		if ( $edit == true ) {
			$wpdb->update( $product_table, $data, array( 'product_id' => $product_id ), $format, array( '%d' ) );
		} else {
			$wpdb->insert( $product_table, $data, $format );
			// Give access level for the product creator a.k.a admin in charge
			update_user_meta( $current_user->ID, 'pt_level_' . $wpdb->insert_id, 'true' );
		}
	}
}

function proccesAPI($data, $type = 'validation')
{
	$data   = json_decode($data);
	$data   = (array) $data;

	$output = (array) $data[$type];
		
	return $output;
}

function add_new_page( $title, $file, $layout, $headline, $group = '' ) 
{
	global $wpdb, $pt_landing_meta_box, $pt_member_meta_box, $page_options;

	foreach ( $page_options as $value ) {
		$$value['id'] = pt_isset($value['value']); 
	}

	// Access and read the content template
	$contentpath = TEMPLATEPATH . '/lib/admin/contents/' . $file;
	$content = @file_get_contents( $contentpath );

	// Create post object
  	$newpage = array();

	if ( $layout == 'review-page-single' ) {
		$newpage['post_type'] = 'post';
		$newpage['post_title'] = $title;
	} else {
		$newpage['post_type'] = 'page';
		$newpage['post_title'] = $title . ' ' . date("Y-m-d H:i:s");
	}  	

  	$newpage['post_content'] = $content;
	$newpage['post_content'] = str_replace('<%YOURSITEURL%>', '<a href="' . get_bloginfo('siteurl') . '">' . get_bloginfo('siteurl') . '</a>', $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%IMGDIR%>', PT_REL_IMAGES, $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%BUSINESS_NAME%>', $pt_business_name, $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%ADDR%>', $pt_business_address . ', ' . $pt_business_zipcode . ' ' . $pt_business_city . ', ' . $pt_business_state . ', ' . $pt_business_country, $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%EMAIL_ADDR%>', '<a href="mailto:' . $pt_business_email . '">' . $pt_business_email . '</a>', $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%DATE%>', date("F d, Y"), $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%COUNTRY%>', $pt_business_country, $newpage['post_content']);
	$newpage['post_content'] = str_replace('<%COMPANY_REG%>', $pt_business_regnum . ', place of registration: ' . $pt_business_regplace, $newpage['post_content']);

	$newpage['post_name'] = $title;
  	$newpage['post_status'] = 'draft';
  	$newpage['post_author'] = 1;

	wp_insert_post( $newpage );	

	// Get post id of our newly created page
	$posts = $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_title LIKE '%" . $newpage['post_title'] . "%'");

	foreach ( $posts as $post ) {

		if ( $group == '' ) {
			update_post_meta( $post->ID, '_wp_page_template', 'page-sales.php' );

			$meta = array();
			foreach ( $pt_landing_meta_box as $meta_box ) {
	
				if ( is_array( pt_isset($meta_box['std']) ) ){
					$optkey = array();
					$optstored = array();
			
					foreach ( $meta_box['std'] as $key => $stored) {
						$optkey[] = $key;
						$optstored [] = $meta_box['std'][$key];
					}
	
					$data = array_combine( $optkey, $optstored );
					$meta[$meta_box['id']] = $data;

				} else {
					if ( $layout == 'sales-page-single' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-headline/Headline|lp-svideo/Simple Video|lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-optin/Optin Form|' . $meta_box['std'];
						}

					} else if ( $layout == 'sales-page-single-oto' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-optin/Optin Form|' . $meta_box['std'];
						}

					} else if ( $layout == 'squeeze-page-single' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-headline/Headline|lp-content/Main Content|lp-optin/Optin Form';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = $meta_box['std'];
						}
					} else if ( $layout == 'squeeze-page-double' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'lp-headline/Headline|lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'lp-optin/Optin Form';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = $meta_box['std'];
						}
					} else if ( $layout == 'squeeze-page-signup' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-headline/Headline';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'lp-svideo/Simple Video|lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'lp-register/Registration + Optin Form';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-video/Advanced Video|lp-pre-headline/Pre-Headline|lp-sub-headline/Sub-Headline|lp-fake-video/Fake Video|lp-warning/Optin Warning Sign|lp-sidebar/Sidebar Widgets|lp-comments/Comments|lp-social/Social Buttons|lp-optin/Optin Form|lp-optin-2/Optin Form 2|lp-order/Add To Cart|lp-image/Single Image|lp-funnel/Launch Funnel|lp-script/Script';
						}
					} else if ( $layout == 'vsqueeze-page-single' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-headline/Headline|lp-svideo/Simple Video|lp-content/Main Content|lp-optin/Optin Form';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-video/Advanced Video|lp-pre-headline/Pre-Headline|lp-sub-headline/Sub-Headline|lp-fake-video/Fake Video|lp-warning/Optin Warning Sign|lp-sidebar/Sidebar Widgets|lp-comments/Comments|lp-social/Social Buttons|lp-optin-2/Optin Form 2|lp-order/Add To Cart|lp-image/Single Image|lp-funnel/Launch Funnel|lp-register/Registration + Optin Form|lp-script/Script';
						}
					} else if ( $layout == 'vsqueeze-page-double' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-headline/Headline';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'lp-svideo/Simple Video|lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'lp-optin/Optin Form';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-video/Advanced Video|lp-pre-headline/Pre-Headline|lp-sub-headline/Sub-Headline|lp-fake-video/Fake Video|lp-warning/Optin Warning Sign|lp-sidebar/Sidebar Widgets|lp-comments/Comments|lp-social/Social Buttons|lp-optin-2/Optin Form 2|lp-order/Add To Cart|lp-image/Single Image|lp-funnel/Launch Funnel|lp-register/Registration + Optin Form|lp-script/Script';
						}
					} else if ( $layout == 'product-launch-page' ) {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-headline/Headline';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'lp-svideo/Simple Video|lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'lp-funnel/Launch Funnel';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-video/Advanced Video|lp-pre-headline/Pre-Headline|lp-sub-headline/Sub-Headline|lp-fake-video/Fake Video|lp-warning/Optin Warning Sign|lp-sidebar/Sidebar Widgets|lp-comments/Comments|lp-social/Social Buttons|lp-optin/Optin Form|lp-optin-2/Optin Form 2|lp-order/Add To Cart|lp-image/Single Image|lp-funnel/Launch Funnel|lp-script/Script';
						}
					} else {
						if ( pt_isset($meta_box['id']) == 'lp-pre' ) {
							$meta_box['std'] = 'lp-content/Main Content';
							pt_save_element_data($post->ID, $meta_box['std'], 'top');
						} else if ( $meta_box['id'] == 'lp-main' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'left');
						} else if ( $meta_box['id'] == 'lp-side' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'right');
						} else if ( $meta_box['id'] == 'lp-bottom' ) {
							$meta_box['std'] = 'clean';
							pt_save_element_data($post->ID, $meta_box['std'], 'bottom');
						} else if ( $meta_box['id'] == 'lp-elements' ) {
							$meta_box['std'] = 'lp-headline/Headline|lp-optin/Optin Form|' . $meta_box['std'];
						}
					}

					if ( pt_isset($meta_box['id']) == 'lp-headline-text' ) {
						$meta_box['std'] = $headline;
					}

					$data = pt_isset($meta_box['std']);
					$meta[pt_isset($meta_box['id'])] = $data;
				}
	
				if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
					add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    				} else {
					update_post_meta( $post->ID, $meta_box['group'], $meta );
    				}

				// save columns to database
			}
		} else {
			if ( $layout == 'member-home' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {
							case 'member-title':
								$meta_box['std'] = $headline;
								break;
	
							case 'member-page-icon':
								$meta_box['std'] = 'dashboard.png';
								break;

							case 'show-member-sidebar':
								$meta_box['std'] = 'true';
								break;

							case 'member-sidebar-title':
								$meta_box['std'] = 'Members Dashboard';
								break;

							case 'member-sidebar-text':
								$meta_box['std'] = 'Welcome to [product name]. Use the navigation below to explore our members only area.';
								break;
						}

						$data = pt_isset($meta_box['std']);
						$meta[pt_isset($meta_box['id'])] = $data;
					}

					if ( get_post_meta( $post->ID, $meta_box['group'] ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}
			} else if ( $layout == 'member-cat' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-cat.php' );

				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {
	
							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;
						}

						$data = pt_isset($meta_box['std']);
						$meta[pt_isset($meta_box['id'])] = $data;
					}

					if ( get_post_meta( $post->ID, $meta_box['group'] ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}
			} else if ( $layout == 'member-content' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-content.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else if ( pt_isset($meta_box['type']) == 'memberdownload' ) {

						$data = array();

						$meta[pt_isset($meta_box['id'])] = $data;
			
					} else {

						switch ( pt_isset($meta_box['id']) ) {
	
							case 'member-page-icon':
								$meta_box['std'] = 'folder-sheets.png';
								break;

							case 'show-member-content':
								$meta_box['std'] = 'true';
								break;
						}

						$data = pt_isset($meta_box['std']);
						$meta[pt_isset($meta_box['id'])] = $data;
					}

					if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}

			} else if ( $layout == 'member-login-1' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-login.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {

							case 'member-title':
								$meta_box['std'] = 'Members Login';
								break;

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;

							case 'member-page-icon':
								$meta_box['std'] = 'members-only.png';
								break;

							case 'show-member-sidebar':
								$meta_box['std'] = 'true';
								break;

							case 'member-sidebar-title':
								$meta_box['std'] = 'Members Only Access';
								break;

							case 'member-sidebar-text':
								$meta_box['std'] = 'This is a member\'s only access page. If you\'re already a member, please login.';
								break;
						}

						$data = pt_isset($meta_box['std']);
						$meta[pt_isset($meta_box['id'])] = $data;
					}

					if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}

			} else if ( $layout == 'member-login-2' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-error.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {

							case 'member-title':
								$meta_box['std'] = 'Members Login';
								break;

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;

							case 'member-page-icon':
								$meta_box['std'] = 'members-only.png';
								break;

							case 'show-member-sidebar':
								$meta_box['std'] = 'true';
								break;

							case 'member-sidebar-title':
								$meta_box['std'] = 'Members Only Access';
								break;

							case 'member-sidebar-text':
								$meta_box['std'] = 'This is a member\'s only access page. If you\'re already a member, please login.';
								break;
						}

						$data = pt_isset($meta_box['std']);
						$meta[pt_isset($meta_box['id'])] = $data;
					}

					if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}

			} else if ( $layout == 'member-error' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-error.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {

							case 'member-title':
								$meta_box['std'] = 'Oops...';
								break;

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;

							case 'member-page-icon':
								$meta_box['std'] = 'forbidden.png';
								break;

							case 'show-member-sidebar':
								$meta_box['std'] = 'true';
								break;

							case 'member-sidebar-title':
								$meta_box['std'] = 'Insufficient Access';
								break;

							case 'member-sidebar-text':
								$meta_box['std'] = 'You can\'t see this page because it\'s either you don\'t have enough access level, or the content isn\'t ready yet.';
								break;
						}

						$data = $meta_box['std'];
						$meta[$meta_box['id']] = $data;
					}

					if ( get_post_meta( $post->ID, $meta_box['group'] ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}

			} else if ( $layout == 'member-account' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-account.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;

							case 'member-page-icon':
								$meta_box['std'] = 'members-only.png';
								break;
						}

						$data = $meta_box['std'];
						$meta[$meta_box['id']] = $data;
					}

					if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}

			} else if ( $layout == 'member-drip' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-error.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {
							case 'member-title':
								$meta_box['std'] = 'Content Not Available Yet';
								break;

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;

							case 'member-page-icon':
								$meta_box['std'] = 'pad-lock.png';
								break;

							case 'show-member-sidebar':
								$meta_box['std'] = 'true';
								break;

							case 'member-sidebar-title':
								$meta_box['std'] = 'Content Unavailable';
								break;

							case 'member-sidebar-text':
								$meta_box['std'] = 'The content you are trying to see is still locked. You can visit this page later.';
								break;
						}

						$data = $meta_box['std'];
						$meta[$meta_box['id']] = $data;
					}

					if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}

			} else if ( $layout == 'member-expired' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-error.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;

							case 'member-page-icon':
								$meta_box['std'] = 'pad-lock.png';
								break;

							case 'show-member-sidebar':
								$meta_box['std'] = 'true';
								break;

							case 'member-sidebar-title':
								$meta_box['std'] = 'Content Expired';
								break;

							case 'member-sidebar-text':
								$meta_box['std'] = 'The content you are trying to see is expired.';
								break;
						}

						$data = $meta_box['std'];
						$meta[$meta_box['id']] = $data;
					}

					if ( get_post_meta( $post->ID, pt_isset($meta_box['group']) ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}
			} else if ( $layout == 'member-logout' ) {
				update_post_meta( $post->ID, '_wp_page_template', 'page-member-error.php' );
				$meta = array();
				foreach ( $pt_member_meta_box as $meta_box ) {
					if ( is_array( pt_isset($meta_box['std']) ) ){
						$optkey = array();
						$optstored = array();
			
						foreach ( $meta_box['std'] as $key => $stored) {
							$optkey[] = $key;
							$optstored [] = $meta_box['std'][$key];
						}
	
						$data = array_combine( $optkey, $optstored );
						$meta[pt_isset($meta_box['id'])] = $data;

					} else {

						switch ( pt_isset($meta_box['id']) ) {
							
							case 'member-title':
								$meta_box['std'] = 'You\'ve been logged out';
								break;

							case 'member-disable-comments':
								$meta_box['std'] = 'true';
								break;
						}

						$data = $meta_box['std'];
						$meta[$meta_box['id']] = $data;
					}

					if ( get_post_meta( $post->ID, $meta_box['group'] ) == "" ) { 
						add_post_meta( $post->ID, $meta_box['group'], $meta, true );
    					} else {
						update_post_meta( $post->ID, $meta_box['group'], $meta );
    					}
				}
			}
		}
	}	
}

/**
 * WordPress User Query class.
 *
 * copied class from wp-includes/user.php in case PT user still using WP below 3.1
 */

if ( !class_exists( 'WP_User_Query' ) ) {
	class WP_User_Query {

		var $results;
		var $total_users = 0;

		// SQL clauses
		var $query_fields;
		var $query_from;
		var $query_where;
		var $query_orderby;
		var $query_limit;

		function WP_User_Query( $query = null ) {
			if ( !empty( $query ) ) {
				$this->query_vars = wp_parse_args( $query, array(
					'blog_id' => $GLOBALS['blog_id'],
					'role' => '',
					'meta_key' => '',
					'meta_value' => '',
					'meta_compare' => '',
					'include' => array(),
					'exclude' => array(),
					'search' => '',
					'orderby' => 'login',
					'order' => 'ASC',
					'offset' => '', 'number' => '',
					'count_total' => true,
					'fields' => 'all',
					'who' => ''
				) );

				$this->prepare_query();
				$this->query();
			}
		}

		function prepare_query() {
			global $wpdb;

			$qv = &$this->query_vars;

			if ( is_array( pt_isset($qv['fields']) ) ) {
				$qv['fields'] = array_unique( $qv['fields'] );

				$this->query_fields = array();
				foreach ( $qv['fields'] as $field )
					$this->query_fields[] = $wpdb->users . '.' . esc_sql( $field );
				$this->query_fields = implode( ',', $this->query_fields );
			} elseif ( 'all' == $qv['fields'] ) {
				$this->query_fields = "$wpdb->users.*";
			} else {
				$this->query_fields = "$wpdb->users.ID";
			}

			$this->query_from = "FROM $wpdb->users";
			$this->query_where = "WHERE 1=1";

			// sorting
			if ( in_array( pt_isset($qv['orderby']), array('nicename', 'email', 'url', 'registered') ) ) {
				$orderby = 'user_' . $qv['orderby'];
			} elseif ( in_array( $qv['orderby'], array('user_nicename', 'user_email', 'user_url', 'user_registered') ) ) {
				$orderby = $qv['orderby'];
			} elseif ( 'name' == $qv['orderby'] || 'display_name' == $qv['orderby'] ) {
				$orderby = 'display_name';
			} elseif ( 'post_count' == $qv['orderby'] ) {
				// todo: avoid the JOIN
				$where = get_posts_by_author_sql('post');
				$this->query_from .= " LEFT OUTER JOIN (
					SELECT post_author, COUNT(*) as post_count
					FROM wp_posts
					$where
					GROUP BY post_author
				) p ON ({$wpdb->users}.ID = p.post_author)
				";
				$orderby = 'post_count';
			} elseif ( 'ID' == $qv['orderby'] || 'id' == $qv['orderby'] ) {
				$orderby = 'ID';
			} else {
				$orderby = 'user_login';
			}

			$qv['order'] = strtoupper( pt_isset($qv['order']) );
			if ( 'ASC' == $qv['order'] )
				$order = 'ASC';
			else
				$order = 'DESC';
			$this->query_orderby = "ORDER BY $orderby $order";

			// limit
			if ( pt_isset($qv['number']) ) {
				if ( pt_isset($qv['offset']) )
					$this->query_limit = $wpdb->prepare("LIMIT %d, %d", $qv['offset'], $qv['number']);
				else
					$this->query_limit = $wpdb->prepare("LIMIT %d", $qv['number']);
			}

			$search = trim( pt_isset($qv['search']) );
			if ( $search ) {
				$leading_wild = ( ltrim($search, '*') != $search );
				$trailing_wild = ( rtrim($search, '*') != $search );
				if ( $leading_wild && $trailing_wild )
					$wild = 'both';
				elseif ( $leading_wild )
					$wild = 'leading';
				elseif ( $trailing_wild )
					$wild = 'trailing';
				else
					$wild = false;
				if ( $wild )
					$search = trim($search, '*');

				if ( false !== strpos( $search, '@') )
					$search_columns = array('user_email');
				elseif ( is_numeric($search) )
					$search_columns = array('user_login', 'ID');
				elseif ( preg_match('|^https?://|', $search) )
					$search_columns = array('user_url');
				else
					$search_columns = array('user_login', 'user_nicename');

				$this->query_where .= $this->get_search_sql( $search, $search_columns, $wild );
			}

			$blog_id = absint( pt_isset($qv['blog_id']) );

			if ( 'authors' == pt_isset($qv['who']) && $blog_id ) {
				$qv['meta_key'] = $wpdb->get_blog_prefix( $blog_id ) . 'user_level';
				$qv['meta_value'] = '_wp_zero_value'; // Hack to pass '0'
				$qv['meta_compare'] = '!=';
				$qv['blog_id'] = $blog_id = 0; // Prevent extra meta query
			}

			_parse_meta_query( $qv );

			$role = trim( pt_isset($qv['role']) );

			if ( $blog_id && ( $role || is_multisite() ) ) {
				$cap_meta_query = array();
				$cap_meta_query['key'] = $wpdb->get_blog_prefix( $blog_id ) . 'capabilities';

				if ( $role ) {
					$cap_meta_query['value'] = '"' . $role . '"';
					$cap_meta_query['compare'] = 'like';
				}

				$qv['meta_query'][] = $cap_meta_query;
			}

			if ( !empty( $qv['meta_query'] ) ) {
				$clauses = call_user_func_array( '_get_meta_sql', array( $qv['meta_query'], 'user', $wpdb->users, 'ID', &$this ) );
				$this->query_from .= $clauses['join'];
				$this->query_where .= $clauses['where'];
			}

			if ( !empty( $qv['include'] ) ) {
				$ids = implode( ',', wp_parse_id_list( $qv['include'] ) );
				$this->query_where .= " AND $wpdb->users.ID IN ($ids)";
			} elseif ( !empty($qv['exclude']) ) {
				$ids = implode( ',', wp_parse_id_list( $qv['exclude'] ) );
				$this->query_where .= " AND $wpdb->users.ID NOT IN ($ids)";
			}

			do_action_ref_array( 'pre_user_query', array( &$this ) );
		}

	
		function query() {
			global $wpdb;

			if ( is_array( $this->query_vars['fields'] ) || 'all' == $this->query_vars['fields'] ) {
				$this->results = $wpdb->get_results("SELECT $this->query_fields $this->query_from $this->query_where $this->query_orderby $this->query_limit");
			} else {
				$this->results = $wpdb->get_col("SELECT $this->query_fields $this->query_from $this->query_where $this->query_orderby $this->query_limit");
			}

			if ( $this->query_vars['count_total'] )
				$this->total_users = $wpdb->get_var("SELECT COUNT(*) $this->query_from $this->query_where");

			if ( !$this->results )
				return;

			if ( 'all_with_meta' == $this->query_vars['fields'] ) {
				cache_users( $this->results );

				$r = array();
				foreach ( $this->results as $userid )
					$r[ $userid ] = new WP_User( $userid, '', $this->query_vars['blog_id'] );

				$this->results = $r;
			}
		}

		function get_search_sql( $string, $cols, $wild = false ) {
			$string = esc_sql( $string );

			$searches = array();
			$leading_wild = ( 'leading' == $wild || 'both' == $wild ) ? '%' : '';
			$trailing_wild = ( 'trailing' == $wild || 'both' == $wild ) ? '%' : '';
			foreach ( $cols as $col ) {
				if ( 'ID' == $col )
					$searches[] = "$col = '$string'";
				else
					$searches[] = "$col LIKE '$leading_wild" . like_escape($string) . "$trailing_wild'";
			}	

			return ' AND (' . implode(' OR ', $searches) . ')';
		}

	
		function get_results() {
			return $this->results;
		}

	
		function get_total() {
			return $this->total_users;
		}
	}
}


if ( !function_exists('get_users') ) {
	function get_users( $args = array() ) {

		$args = wp_parse_args( $args );
		$args['count_total'] = false;

		$user_search = new WP_User_Query($args);

		return (array) $user_search->get_results();
	}
}

function pt_membership_upgrade()
{
	global $wpdb, $integrate_options;

	if ( get_option('pt_membership_upgrade') == 'true' ) {

		foreach ( $integrate_options as $value ) {
			$$value['id'] = pt_isset($value['value']);
		}

		// import cb products
		$u = 0;
		$product_table = $wpdb->prefix . 'ptmembership_products';
		if ( $pt_integrate_membership == 'cb' ) {
			for ( $i = 1; $i < 11; $i++ ) {
				$product = ${'pt_cb_payment_' . $i};
				if ( $product != 'http://ITEM.VENDOR.pay.clickbank.net/' ) {
					$product  = str_replace("http://", "", $product);
					$cbdata   = explode(".", $product);
					$cbitem   = $cbdata[0];
					$cbvendor = $cbdata[1];

					$data = array(
						'old_id' => $i,
						'product_title' => 'CB Product Funnel ' . $i,
						'payment_proccessor' => 'cb',
						'cb_item_number' => $cbitem,
						'cb_vendor_name' => $cbvendor,
						'product_added' => time()
					);

					$format = array( '%d', '%s', '%s', '%d', '%s', '%d' );

					$wpdb->insert( $product_table, $data, $format );
					$new_id = $wpdb->insert_id;

					// import users
					$members = get_users(array('meta_key' => 'cb_level_' . $i, 'meta_value' => 'true'));

					if ( $members ) {
						foreach ( $members as $member ) {
							update_user_meta( $member->ID, 'pt_level_' . $new_id, 'true' );
						}
					}

					$u++;
				}
			}
		} else if ( $pt_integrate_membership == 'pypl' ) {
			for ( $i = 1; $i < 11; $i++ ) {
				$product = ${'pt_paypal_item_' . $i};
				if ( pt_isset($product['item_name']) != 'Product/Funnel #' . $i . ' Name' ) {

					$data = array(
						'old_id' => $i,
						'product_number' => pt_isset($product['item_number']),
						'product_title' => pt_isset($product['item_name']),
						'payment_proccessor' => 'pypl',
						'product_price' => ( pt_isset($product['item_price']) > 0 ) ? $product['item_price'] : '0.00',
						'pypl_payment_type' => ( pt_isset($product['item_payment']) == 'recurr' ) ? 'subscription' : 'single',
						'pypl_subs_duration' => pt_isset($product['item_duration']),
						'pypl_subs_duration_mode' => 'D',
						'pypl_recur_times' => pt_isset($product['item_recurring']),
						'pypl_trial_price' => ( pt_isset($product['item_trial_price']) > 0 ) ? $product['item_trial_price'] : '0.00',
						'pypl_trial_duration' => pt_isset($product['item_trial_duration']),
						'pypl_trial_duration_mode' => 'D',
						'pypl_currency' => pt_isset($product['item_currency']),
						'pypl_return_page' => pt_isset($product['item_thanks_page']),
						'pypl_cancel_page' => pt_isset($product['item_cancel_page']),
						'product_added' => time()
					);

					$format = array( '%d', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%d', '%s', '%d', '%s', '%s', '%s', '%s', '%d' );

					$wpdb->insert( $product_table, $data, $format );
					$new_id = $wpdb->insert_id;

					// import users
					$members = get_users(array('meta_key' => 'cb_level_' . $i, 'meta_value' => 'true'));

					if ( $members ) {
						foreach ( $members as $member ) {
							update_user_meta( $member->ID, 'pt_level_' . $new_id, 'true' );
						}
					}

					$u++;
				}
			}
		}

		if ( $u > 0 ) {			
			// import pages protection
			$pages = get_posts('post_type=page&numberposts=999&orderby=name&post_status=publish');
			if ( $pages ) {
				foreach ( $pages as $page ) {
					$meta = get_post_meta( $page->ID, 'pt_member_meta_box', true );
					if ( pt_isset($meta['member-clickbank-protect']) == 'yes' ) {
						for ( $i = 1; $i < 11; $i++ ) {
							$protect = pt_isset($meta['member-clickbank-levels']);
							if ( is_array( $protect ) ) {
								if ( in_array( 'cb_level_' . $i, $protect ) ) {
									$get_new_id = $wpdb->get_results( "SELECT product_id FROM $product_table WHERE old_id = $i" );
									if ( $get_new_id ) {
										$protect_data[] = $get_new_id[0]->product_id;
									}	
								}
							}
						}

						$drip_data = array(
							'drip_start' => pt_isset($meta['member-clickbank-start-drip']),
							'drip_end' => pt_isset($meta['member-clickbank-end-drip']),
						);

						update_post_meta( $page->ID, 'pt_protect_content', $protect_data );
						update_post_meta( $page->ID, 'pt_drip_data', $drip_data );
					}
				}
			}
		}

		update_option( 'pt_membership_upgrade', 'false' );
	}
}

function pt_oto_id()
{
	$chars = range(0, 9);
	$oid = '';
		
	for ($i = 0; $i < 9; $i++) {
		$oid .= $chars[mt_rand(0, count($chars)-1)];
	}
	
	$oto_id = $oid;

	return $oto_id;
}

function pt_dump($dump) 
{
	echo '<pre>' . print_r($dump, true) . '</pre>';
}

add_action('wp_ajax_pt_autoresponder_get_list', 'pt_autoresponder_get_list_callback');
function pt_autoresponder_get_list_callback(){
	echo pt_get_aweber_lists();
	die();
}

function pt_get_aweber_lists() {
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

	try {
		$account = $aweber->getAccount($token['accessToken'], $token['accessTokenSecret']);
	} catch ( AWeberAPIException $exc ) {
		return 'failed';
	}

	$lists = '<div class="wpsem-autoresponder-list-box" id="wpsem_box_aweber">';
	if ( $account ) {
		$i = 0;
		$lists .= '<div class="fieldsection" id="pt_add_product_list_name-field">
				<div class="fieldtitle"><label for="pt_add_product_list_name"><span id="mailist">Pick a list</span></label></div>
				<div class="field-left">';
		foreach ( $account->lists as $offset => $list ) { 
			$lists .= '<div class="pt-select-list" id="'.$list->id.'">' . $list->name . '</div>';
		}
		$lists .= '</div>
				<div class="field-right"></div>
				<div class="clr"></div>
			</div>';
	} else {
		$lists .= 'not found';
	}
	
	$lists .= '</div>';
	
	return $lists;
}