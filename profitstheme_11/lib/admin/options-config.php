<?php

$themename = "Profits";
$shortname = "pt";

function pt_get_categories( $usecommand = true )
{
	$categories = @get_categories('orderby=name');
	$names  = array();
	$values = array();

	if ( $usecommand == true ) {
		$names[]   = 'Select a Category';
		$values[]  = '';
	}

	foreach($categories as $category){
		$names[]  = $category->name;
		$values[] = $category->cat_ID;
	}

	if ( count($values) < 1 ) {
		$categories = array( '' => 'No Categories' );
	} else {
		$categories = array_combine($values, $names);
	}

	return $categories;	
}

$feat_cat_opt = pt_get_categories();
$posts_cat = pt_get_categories( false );

$postopt = array();
$postval = array();
for($i=1;$i<=10;$i++){
	if($i == 1){
		$post = 'post';
	}else{
		$post = 'posts';
	}

	$postopt[]  = $i.' '.$post;
	$postval[] = $i;
}

$feat_num_opt = array_combine($postval, $postopt);

function pt_get_posts()
{
	$pages = get_posts('numberposts=999&orderby=name&post_status=publish');

	if ( count($pages) < 1 ) {
		$lists = array( '' => 'No Pages' );
	} else {

		$names  = array();
		$values = array();

		$names[]   = '-- Select a Post --';
		$values[]  = '';

		foreach ( $pages as $page ) {
		
			$names[]  = $page->post_title;
			$values[] = $page->ID;

		}

		$lists = array_combine($values, $names);
	}

	return $lists;
}

$pt_posts = pt_get_posts();

function pt_get_pages()
{
	$pages = get_posts('post_type=page&numberposts=999&orderby=name&post_status=publish');

	if ( count($pages) < 1 ) {
		$lists = array( '' => 'No Pages' );
	} else {
		
		$names  = array();
		$values = array();

		$names[]   = '-- Select a Page --';
		$values[]  = '';

		foreach ( $pages as $page ) {
		
			$names[]  = $page->post_title;
			$values[] = $page->ID;

		}

		$lists = array_combine($values, $names);
	}

	return $lists;
}

$pt_pages = pt_get_pages();

function pt_get_landing_pages()
{
	$pages = get_posts('post_type=page&numberposts=999&orderby=name&post_status=publish');

	if ( count($pages) < 1 ) {
		$lists = array( '' => 'No Pages' );
	} else {

		$names  = array();
		$values = array();

		foreach ( $pages as $page ) {
			$meta = get_post_meta( $page->ID, '_wp_page_template', true );

			if ( $meta == 'page-sales.php' ) {
				$names[]  = $page->post_title;
				$values[] = $page->ID;
			}
		}

		if ( count( $names > 0 ) && count( $values ) > 0 ) {
			$lists = array_combine($values, $names);
		} else {
			$lists = array( '' => 'No Pages' );
		}
	}

	return $lists;
}

$pt_landing_pages = pt_get_landing_pages();

function paypal_item_id()
{
	$limit = 7;
	srand ((double) microtime( )*1000000);
	$random = '';
	for ( $i = 0; $i < $limit; $i++ ) {
		$random .= rand(0,9);
	}
	
	return $random;
}

function pt_cb_secret_key()
{
	$length = 16;
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    	$string = '';    

    	for ($p = 0; $p < $length; $p++) {
       		$string .= $characters[mt_rand(0, strlen($characters)-1)];
    	}

	$string = strtoupper($string);

    	return $string;
}

function pt_get_products( $mode = '' )
{
	global $wpdb;

	$product_table = $wpdb->prefix . 'ptmembership_products';
	
	if ( $mode == 'free' ) {
		$products = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE payment_proccessor = 'free' ORDER BY product_id ASC" );
	} else {
		$products = $wpdb->get_results( "SELECT * FROM `$product_table` ORDER BY product_id ASC" );
	}

	if ( $products ) {
		$p_id = array();
		$p_name = array();
		foreach ( $products as $product ) {
			$p_id[] = $product->product_id;
			$p_name[] = $product->product_title;
		}
		$lists = array_combine($p_id, $p_name);
	} else {
		$lists = '';
	}

	return $lists;
}

function pt_get_members_pages()
{
	$protect = array();

	if ( pt_isset( $_GET['type'] ) && pt_isset( $_GET['type'] ) == 'posts' ) {
		$count = wp_count_posts();
		$total = $count->publish;
	} else {
		$count = wp_count_posts('page');
		$total = $count->publish;
	}

	$perpage = 15;
	
	$offset = ( pt_isset( $_GET['paged'] ) ) ? $_GET['paged'] - 1 : 0;
	$offset = ( $offset < 0 ) ? 0 : $offset;
	$offset = $offset * $perpage;

	if ( pt_isset( $_GET['type'] ) && pt_isset($_GET['type']) == 'posts' ) {
		$pages = get_posts('numberposts=' . $perpage . '&offset=' . $offset . '&orderby=date&order=DESC&post_status=publish');
	} else {
		$pages = get_posts('post_type=page&numberposts=' . $perpage . '&offset=' . $offset . '&orderby=date&order=DESC&post_status=publish');
	}

	$protect['pages'] = $pages;
	$protect['offset'] = (int) $offset;
	$protect['perpage'] = (int) $perpage;
	$protect['total'] = (int) $total;

	return $protect;
}

function pt_header_width()
{
	if ( get_option('pt_design_options') === FALSE || get_option('pt_design_options') == '' )
		return 953;

	$design_options = maybe_unserialize(get_option('pt_design_options'));

	foreach ( $design_options as $value ) {
		$$value['id'] = pt_isset($value['value']);
	}
	
	$pt_layouts['colpad'] = 0;
	
	$size['side1Width'] = $pt_layouts['side1'];
	$size['side2Width'] = $pt_layouts['side2'];

	switch ( $pt_layouts['layout'] ) {
		case '1-col-no-side':

			$size['contentRightMargin'] = 0;
			$size['side1RightMargin'] = 0;
			$size['side2RightMargin'] = 0;
			$size['side1Width'] = 0;
			$size['side2Width'] = 0;
		break;

		case '2-col-left-side':

			$size['contentRightMargin'] = $pt_layouts['colpad'];
			$size['side1RightMargin'] = $pt_layouts['colpad'];
			$size['side2RightMargin'] = 0;
			$size['side2Width'] = 0;
			break;

		case '2-col-right-side':

			$size['contentRightMargin'] = $pt_layouts['colpad'];
			$size['side1RightMargin'] = 0;
			$size['side2RightMargin'] = 0;
			$size['side2Width'] = 0;
		break;

		case '3-col-both-side':
	
			$size['contentRightMargin'] = $args['colpad'];
			$size['side1RightMargin'] = $pt_layouts['colpad'];
			$size['side2RightMargin'] = 0;
		break;

		case '3-col-right-side':

			$size['contentRightMargin'] = $pt_layouts['colpad'];
			$size['side1RightMargin'] = $pt_layouts['colpad'];
			$size['side2RightMargin'] = 0;
		break;

		case '3-col-left-side':

			$size['contentRightMargin'] = $pt_layouts['colpad'];
			$size['side1RightMargin'] = $pt_layouts['colpad'];
			$size['side2RightMargin'] = $pt_layouts['colpad'];
		break;
	}

	$header_width  = $pt_layouts['content'] + $size['side1Width'] + $size['side2Width'] + $size['side1RightMargin'] + $size['side2RightMargin'] + $size['contentRightMargin'] + 40;
	
	return $header_width;
}

$site_header_width = pt_header_width();

require_once( dirname( __FILE__ ) . '/options-site.php' );
require_once( dirname( __FILE__ ) . '/options-design.php' );
require_once( dirname( __FILE__ ) . '/options-launch.php' );
require_once( dirname( __FILE__ ) . '/options-membership.php' );
require_once( dirname( __FILE__ ) . '/options-misc.php' );

// install PT Options for the first time
if ( get_option('pt_site_options') == '' ) { 
	$pt_site = array();
	foreach ( $pt_site_options as $value ) {
		if( isset($value['id']) && isset($value['std']) ) {
			$pt_site[] = array( 'id' => $value['id'], 'value' => $value['std'] );
		}
	}
	update_option( 'pt_site_options', $pt_site );
	unset($pt_site);
}

if ( get_option('pt_design_options') == '' ) {
	$pt_design = array();
	foreach ( $pt_design_options as $value ) {
		if( isset($value['id']) && isset($value['std']) ) {
			$pt_design[] = array( 'id' => $value['id'], 'value' => $value['std'] );
		}
	}

	update_option( 'pt_design_options', $pt_design );
	unset($pt_design);
}

if ( get_option('pt_launch_options') == '' ) {
	$pt_launch = array();
	foreach ( $pt_launch_options as $value ) {
		if( isset($value['id']) && isset($value['std']) ) {
			$pt_launch[] = array( 'id' => $value['id'], 'value' => $value['std'] );
		}
	}

	update_option( 'pt_launch_options', $pt_launch );
	unset($pt_launch);
}

if ( get_option('pt_integrate_options') == '' ) {
	$pt_integrate = array();
	foreach ( $pt_integrate_options as $value ) {
		if( isset($value['id']) && isset($value['std']) ) {
			$pt_integrate[] = array( 'id' => $value['id'], 'value' => $value['std'] );
		}
	}

	update_option( 'pt_integrate_options', $pt_integrate );
	unset($pt_integrate);
}

if ( get_option('pt_generator_options') == '' ) {
	$pt_page = array();
	foreach ( $pt_generator_options as $value ) {
		if( $value['type'] != 'instantpage' ) {
			$pt_page[] = array( 'id' => $value['id'], 'value' => $value['std'] );
		}
	}

	update_option( 'pt_generator_options', $pt_page );
	unset($pt_page);
}

if ( !get_option('pt_version') ) {
	$pt_versions = array(
		'current' => $pt_version,
		'new' => $pt_version,
		'update' => false,
	);

	update_option( 'pt_version', $pt_versions );
}

$pt_version_db = get_option('pt_version');
if ( $pt_version_db['current'] != $pt_version ) {
	$pt_versions = array(
		'current' => $pt_version,
		'new' => $pt_version,
		'update' => false,
	);

	update_option( 'pt_version', $pt_versions );
}

$membersite          = false;
$site_options        = maybe_unserialize(get_option('pt_site_options'));
$design_options      = maybe_unserialize(get_option('pt_design_options'));
$launch_options      = maybe_unserialize(get_option('pt_launch_options'));
$page_options        = maybe_unserialize(get_option('pt_generator_options'));
$integrate_options   = maybe_unserialize(get_option('pt_integrate_options'));

//var_dump(unserialize($site_options));
//var_dump(unserialize($design_options));
$pt_all_options      = array_merge($site_options, $design_options);

foreach ( $pt_all_options as $value ) {
	$$value['id'] = pt_isset($value['value']);
}

foreach ( $launch_options as $value ) {
	$$value['id'] = pt_isset( $value['value']);
}

foreach ( $page_options as $value ) {
	$$value['id'] = pt_isset($value['value']);
}

foreach ( $integrate_options as $value ) {
	$$value['id'] = pt_isset($value['value']);
}

//array of function that might be conflict with pt
$pt_remove_filter = array(
	/*Sexy Bookmarks by Shareaholic Plugin*/
	array( 'filter' => 'the_content', 'function' => 'shrsb_position_menu' )
);