<?php
/**
 * Profits Theme's html document framework.
 *
 * @package Profits Theme
 * @subpackage Functions
 */

/**
* Create a new html header for site loops, posts, pages, and archives.
*
* @since 1.0.0
*/

function pt_document_open() {

global $post, $site_options, $membersite;

foreach ( $site_options as $value ) {
	$$value['id'] = pt_isset($value['value']); 
}

pt_popup_cookies();
$seo = new PtSeo;

$membersite = false;

$xmlns = ( $pt_comments_type == 'fb' || $pt_comments_type == 'both') ? 'xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/"' : '';		

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> <?php echo $xmlns; ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php pt_seo_title(); ?></title>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo $seo->PtRss(); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>
<?php 
if( is_page() || is_single() ) {
	if ( $pt_comments_type == 'fb' || $pt_comments_type == 'both' ) {
	$ogmeta  = get_post_meta($post->ID, 'pt_post_meta_box', true);
	$ogthumb = pt_isset($ogmeta['post_thumb']);
	$ogdesc  = pt_excerpt($post->post_content, 160, false );

	$remove = array("\n", "\r\n", "\r");
?>
<meta property="og:title" content="<?php echo trim(wptexturize($post->post_title));?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
<meta property="og:image" content="<?php echo $ogthumb; ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="fb:app_id" content="<?php echo $pt_fb_appid; ?>" />
<meta property="og:description" content="<?php echo trim(wptexturize(str_replace($remove, '', $ogdesc))); ?>" />

<?php 
	}
} 

if ( get_option( 'pt_enable_custom' ) == 'true' ) {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_url') . '/custom/custom-site.css" media="screen" />';
}

if ( $pt_custom_favicon ) {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . $pt_custom_favicon . '" />';
}
?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Exo:300,400,500,600,700,800|Ubuntu+Condensed|Open+Sans:400,300,600,700,800|Roboto:400,300,500,700,900|Handlee' rel='stylesheet' type='text/css'>
</head>

<body class="sitebody">
<?php
}

/**
* Create a new html header for landing pages.
*
* @since 1.0.0
*/

function pt_landing_page_open() {

pt_check_oto();

global $post, $site_options, $launch_options;

foreach ( $site_options as $value ) {
	$$value['id'] = pt_isset($value['value']); 
}

// Product Launch...
$launch = new PtLaunch($post->ID, $launch_options);
$launch->buildLaunchPage();

$evergreen = $launch->evergreenCookie();

$lp               = get_post_meta($post->ID, 'pt_landing_meta_box', true);
$width            = pt_isset($lp['lp-page-width']);
$right_column     = pt_isset($lp['lp-page-right-width']);
$padding          = pt_isset($lp['lp-page-padding']);
$pagebg           = pt_isset($lp['lp-page-bg']);
$header           = pt_isset($lp['lp-header-image']);
$header_height    = pt_isset($lp['lp-header-height']);
$header_pad_top   = floor( $header_height / 4 );
$commsys          = pt_isset($lp['lp-comments-type']);
$fbappid          = pt_isset($lp['lp-comments-fb-appid']);
$fbuid            = pt_isset($lp['lp-comments-fb-notify']);
$header_remove    = pt_isset($lp['lp-header-remove']);
$template         = pt_isset($lp['lp-page-custom']);
$font_face        = pt_isset($lp['lp-content-font']);
$font_size        = pt_isset($lp['lp-content-size']);
$line_height      = pt_isset($lp['lp-content-line-height']);
$head_font        = pt_isset($lp['lp-content-heading-font']);
$head_opt_left    = pt_isset($lp['lp-page-width']) - 280;
$footer_font      = pt_isset($lp['lp-page-footer-font']);
$footer_font_size = pt_isset($lp['lp-page-footer-font-size']);

pt_minisite_popup_cookies();
$seo = new PtSeo;

$cssoutput = '';

$cssoutput .= 'body{ ';
$cssoutput .= 'margin:0;padding:0; ';

if ( $template == 'custom' ) {
	$background_image = ( $lp['lp-custom-background-image'] != '' ) ? ' url(' . $lp['lp-custom-background-image'] . ') ' . $lp['lp-custom-background-repeat'] . ' ' . $lp['lp-custom-background-attach'] . ' ' . $lp['lp-custom-background-pos'] : '';
	$cssoutput .= 'background: ' . $lp['lp-custom-background-color'] . $background_image . '; ';
}

$cssoutput .= '}' . "\n";

$cssoutput .= '#before-header { width:' . $width . 'px; }' . "\n";
$cssoutput .= '#header { width:' . $width . 'px; }' . "\n";
$cssoutput .= '#wrapper { width:' . $width . 'px; }' . "\n";
$cssoutput .= '#lp-header-image{';
switch ( $header['type'] ) {
	
	case 'custom-hbackground':
		$cssoutput .= 'background:url(' . $header['upload'] . ') no-repeat ' . $header['align'] . ';';
	break;
}

$cssoutput .= ' }' . "\n";

$cssoutput .= '#header-bg{ height:' . $header_height . 'px; }' . "\n";
$cssoutput .= '#header{ height:' . $header_height . 'px; }' . "\n";
$cssoutput .= '#lp-header-image{ height:' . $header_height . 'px; }' . "\n";
$cssoutput .= '#header #logo{ padding-top:' . $header_pad_top . 'px; }' . "\n";
$cssoutput .= '#header .header_optin{ position:absolute; top:0; left:' . $head_opt_left . 'px; }' . "\n";
$cssoutput .= '#footer { width:' . $width . 'px; }' . "\n";

$left_column = (($width - $right_column) - ( $padding * 2 )) - 20;

$cssoutput .= '.sales-left { width:' . $left_column . 'px;float:left; display:inline;  }' . "\n";
$cssoutput .= '.sales-right { width:' . $right_column . 'px;float:right; display:inline; }' . "\n";

$cssoutput .= '#copy { padding-left:' . $padding . 'px; padding-right:' . $padding . 'px; font-family: ' . stripslashes($font_face) . '; font-size: ' . $font_size . 'px; }' . "\n";
$cssoutput .= '#copy h1, h2, h3, h4, h5, h6 { font-family:' . stripslashes($head_font) . '; }' . "\n";
$cssoutput .= '#copy p, #copy ul li, #copy ol li { line-height: ' . $line_height . 'px; }' . "\n";
$cssoutput .= '#copy p.jboxcommhead { line-height:1; }' . "\n";
$cssoutput .= '#copy ul.greenarrow li, #copy ul.redarrow li, #copy ul.bluearrow li, #copy ul.greencheck li, #copy ul.redcheck li, #copy ul.bluecheck li, #copy ul.redbullet li { line-height: ' . $line_height . 'px; }' . "\n";

$cssoutput .= '#footer{ font-family: ' . $footer_font . '; font-size: ' . $footer_font_size . 'px; height:35px; line-height:35px; padding:0; text-align:center; }' . "\n";
$cssoutput .= '#footer a, #footer a:hover { font-family: ' . $footer_font . '; font-size: ' . $footer_font_size . 'px; }' . "\n";
$cssoutput .= '.footinfo{ position:relative; height:25px; line-height:25px; width:190px; margin:0 auto; padding:0; }' . "\n";

$cssoutput .= '#lp-top-menu { font-size:14px; color: #555555; }' . "\n";
$cssoutput .= '#lp-top-menu a { text-decoration:none; font-weight:500; font-size:14px; padding:10px 20px; }' . "\n";
$cssoutput .= '#lp-top-menu a:hover { text-decoration:none; opacity:0.8; }' . "\n";
$cssoutput .= 'h3#comments, #respond h3  { text-transform:uppercase; font-size:16px; font-family:' . stripslashes($font_face) . '; }' . "\n";

// css styling for custom design start...
if ( $template == 'custom' ) {
	$content_image_bg = ( $lp['lp-custom-content-background-image'] != '' ) ? ' url(' . $lp['lp-custom-content-background-image'] . ') ' . $lp['lp-custom-content-background-repeat'] : '';
	$cssoutput .= '#saleswrapper { background:' . $lp['lp-custom-content-background-color'] . $content_image_bg . '; }' . "\n";

	if ( $lp['lp-custom-content-border'] != '' ) {
		$cssoutput .= '#saleswrapper { border:' . $lp['lp-custom-content-border-width'] . 'px ' . $lp['lp-custom-content-border'] . ' ' . $lp['lp-custom-content-border-color'] . '; }' . "\n";
		if ( $lp['lp-custom-content-border-radius'] > 0 ) {
			$cssoutput .= '#saleswrapper { border-radius:' . $lp['lp-custom-content-border-radius'] . 'px;-moz-border-radius:' . $lp['lp-custom-content-border-radius'] . 'px;-webkit-border-radius:' . $lp['lp-custom-content-border-radius'] . 'px; }' . "\n";
		}
	}

	if ( $lp['lp-custom-footer-text-remove'] == 'true' ) {
		$cssoutput .= '.footinfo{ display:none; }' . "\n";
		$cssoutput .= '#footer{ text-indent:-9999px; }' . "\n";
	}

	if ( $lp['lp-custom-footer-background-transparent'] != 'true' ) {
		$footer_image_bg = ( pt_isset($lp['lp-custom-footer-background-image']) != '' ) ? ' url(' . pt_isset($lp['lp-custom-footer-background-image']) . ') ' . pt_isset($lp['lp-custom-footer-background-repeat']) : '';
		$cssoutput .= '#footer { height:' . pt_isset($lp['lp-custom-footer-height']) . 'px; background:' . pt_isset($lp['lp-custom-footer-background-color']) . $footer_image_bg . ' !important; }' . "\n";
	}
}

pt_minisite_popup_cookies();
$xmlns    = ( $commsys == 'fbcomm' || $commsys == 'allcomm') ? 'xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/"' : '';
$ogdesc   = pt_excerpt($post->post_content, 160, false );
$remove   = array("\n", "\r\n", "\r");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); echo $xmlns; ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php pt_seo_title(); ?></title>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<?php if ( $commsys == 'fbcomm' || $commsys == 'allcomm' ) { ?>
<meta property='fb:app_id' content='<?php echo $fbappid;?>' />
<meta property="og:title" content="<?php echo trim(wptexturize($post->post_title));?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:image" content="" />
<meta property="fb:app_id" content="<?php echo $fbappid;?>" />
<meta property="og:description" content="<?php echo trim(wptexturize(str_replace($remove, '', $ogdesc))); ?>" />
<?php } ?>
		
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/lib/css/minisites.css" type="text/css" media="screen" />

<?php 
// Load Custom Minisite Skin
$custom = explode("-", $lp['lp-page-custom']);
$skin   = pt_isset($custom[0]);
$scheme = pt_isset($custom[1]) . '.css';

if ( $template == 'custom' ) {
echo '<link rel="stylesheet" href="' . get_bloginfo('template_url') . '/lib/skins/minisite/custom/custom.css" type="text/css" media="screen" />';
} else {
echo '<link rel="stylesheet" href="' . get_bloginfo('template_url') . '/lib/skins/minisite/' . $skin . '/' . $scheme . '" type="text/css" media="screen" />';
}
?>

<script type="text/javascript">
function SetCookie(cookieName, cookieValue, nDays)
{
 	var today = new Date();
 	var expire = new Date();
 	if (nDays==null || nDays==0) nDays=1;
 	expire.setTime(today.getTime() + 3600000*24*nDays);
 	document.cookie=cookieName + "=" + escape(cookieValue) + "; expires=" + expire.toGMTString() + "; path=<?php echo COOKIEPATH; ?>";
}
</script>

<?php if ( pt_isset($lp['lp-page-upsell']) == 'yes' && !isset($_COOKIE['oto-' . $post->ID]) ) { ?>
<script type="text/javascript">
SetCookie('oto-<?php echo $post->ID; ?>', '<?php echo md5($post->ID); ?>', 365);
</script>
<?php } ?>
<?php echo $evergreen; ?>
<style type="text/css">
<?php echo $cssoutput; ?>
</style>
<?php if ( $pt_enable_popup == 'false' && pt_isset($lp['lp-page-popup']) == 'true' ) { ?>
<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS ?>/popup.js"></script>
<?php } ?>

<?php if (pt_isset($lp['lp-page-exit'], false) == 'true'){
	add_action('wp_footer', 'pt_onuserexit');	
}
?>

<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS ?>/cufon/cufon.js"></script>
<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS ?>/cufon/Hand_Of_Sean.font.js"></script>
<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS ?>/cufon/Delicious.font.js"></script>

<!--[if gte IE 9]>
	<script type="text/javascript">
		Cufon.set('engine', 'canvas');
	</script>
<![endif]-->

<?php pt_minisite_cufon(); ?>

<script type="text/javascript">
Cufon.replace(".lp-comm-txt", {
	fontFamily: "Hand Of Sean"
});
Cufon.replace("#social-cta", {
	fontFamily: "Delicious"
});
</script>


<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#nav4 > *:first-child').css('border', 'none');
});
</script>
<?php
if ( $pt_custom_favicon ) {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . $pt_custom_favicon . '" />';
}
?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Exo:300,400,500,600,700,800|Ubuntu+Condensed|Open+Sans:400,300,600,700,800|Roboto:400,300,500,700,900|Handlee' rel='stylesheet' type='text/css'>
</head>

<body>
<?php
}

/**
* Create a new html header for membership pages.
*
* @since 1.0.0
*/

function pt_membership_open() {
global $post, $site_options, $design_options, $membersite, $pt_integrate_membership;

$options = array_merge( $design_options, $site_options );
foreach ( $options as $value ) {
	$$value['id'] = $value['value']; 
}

$membersite = true;
$seo = new PtSeo;

$cssoutput = '';

$m_width = ( $pt_member_columns_width['val1'] != '' ) ? $pt_member_columns_width['val1'] : 640;
$s_width = ( $pt_member_columns_width['val2'] != '' ) ? $pt_member_columns_width['val2'] : 234;
$total_width = $m_width + $s_width + 66;

$cssoutput .= '#before-header{ width:' . $total_width . 'px; margin:0 auto; padding:0; }' . "\n";
$cssoutput .= '#header{ width:' . $total_width . 'px; }' . "\n";
$cssoutput .= '#after-header{ width:' . $total_width . 'px; }' . "\n";
$cssoutput .= '#wrapper{ width:' . $total_width . 'px; }' . "\n";
$cssoutput .= '#footer{ width:' . $total_width . 'px; }' . "\n";

if ( $pt_member_sidebar_pos == 'right' ) {
	$cssoutput .= '#main-column { margin:0; width:' . $m_width . 'px; padding:0; float:left; }' . "\n";
	$cssoutput .= '#membership-column { width:' . $s_width . 'pxpx; margin:0 0 0 25px; padding:0; float:left; }' . "\n";
} else {
	$cssoutput .= '#main-column { margin:0 0 0 25px; width:' . $m_width . 'px; padding:0; float:left; }';
	$cssoutput .= '#membership-column { width:' . $s_width . 'px; margin:0; padding:0; float:left; }' . "\n";
}

$headerheight = ( $pt_member_header_height != '' || $pt_member_header_height > 0 ) ? $pt_member_header_height : 165; 
$headerpad    = floor( $headerheight / 4 );
  
$cssoutput .= '#header-bg { height: ' . $headerheight . 'px; }' . "\n";
$cssoutput .= '#header { height: ' . $headerheight . 'px; }' . "\n";
$cssoutput .= '#header #logo{ padding-top:' . $headerpad . 'px; z-index: 50; }' . "\n";
$cssoutput .= '.post{ padding-bottom: 10px; }' . "\n";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?> >

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php pt_seo_title(); ?></title>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo $seo->PtRss(); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/lib/css/membership.css" type="text/css" media="screen" />

<style type="text/css">
<?php echo $cssoutput; ?>
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#member-menu > *:last-child').addClass('last-menu');
		jQuery('#member-menu > *:last-child').find('a').addClass('last-nav');

		<?php if ( $pt_integrate_membership == 'dap' ) { ?>
		jQuery("input[name=email]").addClass('dap-field');
		jQuery("input[name=password]").addClass('dap-field');
		jQuery("input[name=Login]").addClass('dap-button');
		<?php } ?>
	});
</script>
<?php
if ( $pt_custom_favicon ) {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . $pt_custom_favicon . '" />';
}
?>
<link href='http://fonts.googleapis.com/css?family=Ubuntu:400,500,700|Exo:300,400,500,600,700,800|Ubuntu+Condensed|Open+Sans:400,300,600,700,800|Roboto:400,300,500,700,900|Handlee' rel='stylesheet' type='text/css'>
</head>

<body>
<?php
}

/**
* Close all html documents.
*
* @since 1.0.0
*/
function pt_document_close() {
wp_footer();

echo "\n\n".'</body>'."\n";
echo '</html>';

}

function pt_before_header( $header_setup )
{
	global $post, $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( $pt_tnav1_collapse == 'true' ) {
		$shownav = false;
	} else {
		$shownav = true;
	}

	if ( $shownav == true ) {
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '<div id="before-header-bg">' . "\n";
		}

		echo "\n\n\t" . '<div id="before-header">' . "\n";
			
		wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav1', 'fallback_cb' => '', 'theme_location' => 'primary-menu' ));

		echo "\n\n\t" . '</div>' . "\n";

		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '</div>' . "\n";
		}
	}
}

function pt_after_header( $header_setup )
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( $pt_tnav2_collapse == 'true' ) {
		$shownav = false;
	} else {
		$shownav = true;
	}
	
	if ( $shownav == true ) {
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '<div id="after-header-bg">' . "\n";
		}

		echo "\n\n\t" . '<div id="after-header">' . "\n";

		wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => '', 'theme_location' => 'secondary-menu' ));

		echo "\n\n\t" . '</div>' . "\n";
	
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '</div>' . "\n";
		}
	}
}

function pt_header( $header_setup )
{

	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
			$$value['id'] = $value['value']; 
	}

	if ( $header_setup == 'fluid' ) {
		echo '<div id="header-bg">' . "\n";
	}

	echo '<div id="header">' . "\n";
	echo "\t" . '<div id="header-image">' . "\n";
	echo "\t\t" . '<div id="logo">' . "\n";
 
 	if(function_exists('show_media_header')){ show_media_header(); }
	if ( $pt_header_logo_disable == 'false' ) {
			
		if ( $pt_text_logo == 'true' ) {	
			echo "\t\t\t" . '<h1><a href="' . get_option('home') . '" title="' . get_bloginfo('description') . '">' . get_bloginfo('name') . '</a></h1>' . "\n";
						
			if ( $pt_desc_disable == 'false' ) {
				echo "\t\t\t" . '<div class="description">' . get_bloginfo('description') . '</div>' . "\n";
			}
		} else {
			
			echo "\t\t\t" . '<h1><a href="' . get_option('home') . '" title="' . get_bloginfo('description') . '">';
			if ( $pt_custom_logo != '' ) {
				echo '<img src="' . $pt_custom_logo . '" border="0" />';
			}

			echo '</a></h1>' . "\n";
		}
	}

	echo "\t\t" . '</div>' . "\n";
	echo "\t" . '</div>' . "\n";

	if ( $pt_enable_headeroptin == 'true' ) {
		pt_header_optin();
	} else {
		if ( $pt_header_right == 'rss' ) {
			$rss = new PtSeo;
			echo '<div class="header_rss"><a href="' . $rss->PtRss() . '"><img src="' . get_bloginfo('template_directory') . '/lib/images/feed-icon-orange-128.png" border="0" /></a></div>';
		} elseif ( $pt_header_right == 'search' ) {			
			echo '<div class="header_search">';
			echo '<form method="get" id="searchform" action="#">';
			echo '<input type="text" class="field" name="s" id="s"  value="Enter keywords..." onfocus="if (this.value == \'Enter keywords...\') {this.value = \'\';}" onblur="if (this.value == \'\') {this.value = \'Enter keywords...\';}" />';
        		echo '<input class="submit btn" type="submit" value="" />';
			echo '</form>';
			echo '</div>';
		} elseif ( $pt_header_right == 'ads' ) {			
			echo '<div class="header_ads">';
			if ( $pt_top_adsense != '' ) {
				echo stripslashes( $pt_top_adsense );
			} else {
				if ( $pt_top_ad_image != '' ) {
					echo '<a href="' . $pt_top_ad_link . '" target="' . $pt_top_ad_target . '"><img src="' . $pt_top_ad_image . '" border="0" /></a>';
				}
			}
			echo '</div>';
		}
	}

	echo '</div>' . "\n";

	if ( $header_setup == 'fluid' ) {
		echo '</div>' . "\n";
	}
}

function pt_landing_page_before_header()
{

	echo "\n\n" . '<div id="before-header-bg">' . "\n";
	echo "\n\n\t" . '<div id="before-header"></div>' . "\n";
	echo "\n\n" . '</div>' . "\n";	
}

function pt_landing_page_top_nav()
{
	global $post;

	$lp = get_post_meta($post->ID, 'pt_landing_meta_box', true);

	if ( $lp['lp-page-topnav'] != 'remove navigation' ) {
		echo '<div id="lp-top-menu" style="margin:0;padding:30px 0">';

		$lp_top_nav = wp_nav_menu(array( 'menu' => $lp['lp-page-topnav'], 'container' => 'ul', 'menu_class' => '', 'menu_id' => 'nav4', 'fallback_cb' => 'pt_membership_no_menu', 'depth' => 1, 'echo' => 0, 'after' => '' ));		
		$lp_top_nav = strip_tags( $lp_top_nav, '<a>');
		if ( $lp_top_nav != '' ) { echo ''; }
		echo $lp_top_nav;

		echo '</div>';
	}
}

function pt_landing_page_header()
{
	global $post, $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}


	echo '<div id="header-bg">' . "\n";

	echo '<div id="header">' . "\n";
	echo "\t" . '<div id="lp-header-image">' . "\n";
	echo "\t\t" . '<div id="logo">' . "\n";
 
	if ( $pt_header_logo_disable == 'false' ) {
		$showlogo = true;
		$lp = get_post_meta( $post->ID, 'pt_landing_meta_box', true );					
		if ( $lp['lp-logo-remove'] == 'true' ) {
			$showlogo = false;
		} else {
			$showlogo = true;
		}
 
		if ( $showlogo == true ) {
			if ( $pt_text_logo == 'true' ) {	
				echo "\t\t\t" . '<h1><a href="' . get_option('home') . '" title="' . get_bloginfo('description') . '">' . get_bloginfo('name') . '</a></h1>' . "\n";
						
				if ( $pt_desc_disable == 'false' ) {
					echo "\t\t\t" . '<div class="description">' . get_bloginfo('description') . '</div>' . "\n";
				}
			} else {
				echo "\t\t\t" . '<h1><a href="' . get_option('home') . '" title="' . get_bloginfo('description') . '">';
				if ( $pt_custom_logo != '' ) {
					echo '<img src="' . $pt_custom_logo . '" border="0" />';
				}
				echo '</a></h1>' . "\n";
			}
		}
	}

	echo "\t\t" . '</div>' . "\n";
	echo "\t" . '</div>' . "\n";

	pt_minisite_header_optin( $post->ID );

	echo '</div>' . "\n";
	echo '</div>' . "\n";

}

function pt_membership_before_header( $header_setup )
{
	global $post, $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( $pt_tnav1_collapse == 'true' ) {
		$shownav = false;
	} else {
		$shownav = true;
	}

	if ( $shownav == true ) {
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '<div id="before-header-bg">' . "\n";
		}
	
		echo "\n\n\t" . '<div id="before-header">' . "\n";
	
		echo "\n\n\t" . '</div>' . "\n";
	
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '</div>' . "\n";
		}
	}
}

function pt_membership_after_header( $header_setup, $member_page )
{
	global $design_options, $site_options, $pt_integrate_membership;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}
	
	if ( $pt_tnav2_collapse == 'true' ) {
		$shownav = false;
	} else {
		$shownav = true;
	}
	
	if ( $shownav == true ) {
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '<div id="after-header-bg">' . "\n";
		}
	
		echo "\n\n\t" . '<div id="after-header">' . "\n";
	
		if ( $pt_integrate_membership == 'dap' ) {
			if ( class_exists( 'Dap_Session' ) ) {
				if ( Dap_Session::isLoggedIn() ) {
					wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => '', 'theme_location' => 'member-menu' ));
				} else {
					wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => '', 'theme_location' => 'non-member-menu' ));
				}
			} else {				
				wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => '', 'theme_location' => 'member-menu' ));
			}
				
		} else {
			if ( $pt_integrate_membership == 'wp' ) {
				wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => '', 'theme_location' => 'member-menu' ));
			} else {
				if ( is_user_logged_in() ) {
					wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => 'pt_membership_no_menu', 'theme_location' => 'member-menu' ));
				} else {
					wp_nav_menu(array( 'container' => '', 'menu_class' => '', 'menu_id' => 'nav2', 'fallback_cb' => 'pt_membership_no_menu', 'theme_location' => 'non-member-menu' ));
				}	
			}
		}
		
	
		echo "\n\n\t" . '</div>' . "\n";
		
		if ( $header_setup == 'fluid' ) {
			echo "\n\n" . '</div>' . "\n";
		}
	}
}

function pt_membership_no_menu()
{

}

function pt_membership_header( $header_setup )
{

	global $design_options, $site_options, $pt_member_login_redirect;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
			$$value['id'] = $value['value']; 
	}

	if ( $header_setup == 'fluid' ) {
		echo '<div id="header-bg">' . "\n";
	}

	echo '<div id="header">' . "\n";
	echo "\t" . '<div id="header-member-image">' . "\n";
	echo "\t\t" . '<div id="logo">' . "\n";
 
	$head_link = ( $pt_member_login_redirect != '' ) ? get_permalink($pt_member_login_redirect) : get_option('home');
	
	if ( $pt_membership_text_logo == 'true' && $pt_site_logo_enable != 'true' ) {	
		echo "\t\t\t" . '<h1><a href="' . $head_link . '" title="' . get_bloginfo('description') . '">' . get_bloginfo('name') . '</a></h1>' . "\n";
							
		if ( $pt_desc_disable == 'false' ) {
			echo "\t\t\t" . '<div class="description">' . get_bloginfo('description') . '</div>' . "\n";
		}
	} else if ( $pt_site_logo_enable == 'true' ) {
		echo "\t\t\t" . '<h1><a href="' . $head_link . '" title="' . get_bloginfo('description') . '">';
		if ( $pt_membership_custom_logo != '' ) {
			echo '<img src="' . $pt_membership_custom_logo . '" border="0" />';
		}
		echo '</a></h1>' . "\n";
	}

	echo "\t\t" . '</div>' . "\n";
	echo "\t" . '</div>' . "\n";

	echo '</div>' . "\n";

	if ( $header_setup == 'fluid' ) {
		echo '</div>' . "\n";
	}
}

function pt_bottom_widgets( $footer_setup )
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	$showfooterbar = false;
	if ( $pt_footerbar_hide == 'false' ) {
		$showfooterbar = true;
	}
			
	if ( $showfooterbar == true ) {
		if ( $footer_setup == 'fluid' ) {
			echo '<div id="bottom-widget-bg">';
		}
?>
		<div id="bottom-widget">
			<div id="bottom-left">
				<div id="bot-widget">
				<ul>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('botwidget1') ) :
           	 	// do nothing
           	 	endif; // end of botwidget1 ?>
		        </ul>
			</div>
		</div>

		<div id="bottom-center">
			<div id="bot-widget">
			<ul>
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('botwidget2') ) :
           	 	// do nothing
           	 	endif; // end of botwidget2 ?>
        		</ul>
			</div>
		</div>
	
		<div id="bottom-right">
			<div id="bot-widget">
				<ul>
           	 	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('botwidget3') ) :
           	 	// do nothing
           	 	endif; // end of botwidget3 ?>
	       		</ul>
			</div>
		</div>

		<?php if ( $pt_footerbar_columns == 'four' ) { ?>
			<div id="bottom-right2">
				<div id="bot-widget">
				<ul>
            	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('botwidget4') ) :
           	 	// do nothing
           	 	endif;// end of botwidget4 ?>
	          	</ul>
				</div>
			</div>
		<?php } ?>
			<div id="clr"></div>
		</div>
<?php
		if ( $footer_setup == 'fluid' ) {
			echo '</div>';
		}
	}	
}

function pt_footer( $footer_setup )
{
	global $post, $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( $footer_setup == 'fluid' ) {
		echo '<div id="footer-bg">';
	}

	echo '<div id="footer">';
			
	if ( $pt_footnav_remove == 'false' ) {
		wp_nav_menu(array( 'container' => 'ul', 'menu_class' => '', 'menu_id' => 'nav3', 'fallback_cb' => 'pt_membership_no_menu', 'theme_location' => 'tertiary-menu', 'depth' => 1 ));
	}
	

	$showlinkback = false;
	if ( $pt_remove_backlink == 'false' ) {
		$showlinkback = true;
	}
	
	echo '<div class="footinfo">';
	pt_footer_copyright( $pt_foot_copyright ); 
	if ( $showlinkback == true ) {
		$afflink = $pt_afflink != '' ? $pt_afflink : 'http://profitstheme.com';
		echo 'Powered By <a href="' . $afflink . '" target="' . $pt_backlink_target . '">Profits Theme</a>';
	}
	echo '</div>';
			
	echo '</div>';

	if ( $footer_setup == 'fluid' ) {
		echo '</div>';
	}
}

function pt_landing_page_footer( $post_id )
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}


	echo '<div id="footer-bg">';

	echo '<div id="footer">';
			
	$lp = get_post_meta( $post_id, 'pt_landing_meta_box', true );

	if ( $lp['lp-page-footnav'] == 'use blog setting' ) {
		if ( $pt_footnav_remove == 'false' ) {
			$lp_footer_nav = wp_nav_menu(array( 'container' => 'ul', 'menu_class' => '', 'menu_id' => 'nav3', 'fallback_cb' => 'pt_membership_no_menu', 'theme_location' => 'tertiary-menu', 'depth' => 1, 'echo' => 0, 'after' => ' | ' ));
		}
		
	} else if ( $lp['lp-page-footnav'] != 'remove navigation' ) {
		$lp_footer_nav = wp_nav_menu(array( 'menu' => $lp['lp-page-footnav'], 'container' => 'ul', 'menu_class' => '', 'menu_id' => 'nav3', 'fallback_cb' => 'pt_membership_no_menu', 'depth' => 1, 'echo' => 0, 'after' => ' | ' ));
	}

	$lp_footer_nav = strip_tags($lp_footer_nav, '<a>');
	echo $lp_footer_nav;

	pt_footer_copyright( $pt_foot_copyright );
	
	$showlinkback = false;
	if ( $pt_remove_backlink == 'false' ) {
		$showlinkback = true;
	}

	if ( $showlinkback == true && pt_isset($lp['lp-page-footer-powered']) == 'false' ) {
		$afflink = $pt_afflink != '' ? $pt_afflink : 'http://profitstheme.com';
		echo '<div class="footinfo">Powered By <a href="' . $afflink . '" target="' . $pt_backlink_target . '">Profits Theme</a></div>';
	}
	echo '<div style="clear:both"></div>';
	echo '</div>';
	echo '</div>';
}

function pt_footer_copyright( $option )
{
	$footerCopyright = stripslashes( $option );

	$blogurl   = get_bloginfo( 'url' );
	$blogname  = get_bloginfo( 'name' );

	if ( $footerCopyright != '' ) {
		$footerCopyright = str_replace( '[%blogurl%]', $blogurl, $footerCopyright );
		$footerCopyright = str_replace( '[%blogname%]', $blogname, $footerCopyright );
	} else {
		$footerCopyright = '&copy; 2013 <a href="' . $blogurl . '">' . $blogname . '</a>';
	}

	echo $footerCopyright . ' ';
}

function pt_popup_cookies() 
{
	global $post, $site_options;

	foreach ( $site_options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( $pt_enable_popup == 'true' ) {
		if ( is_single() && $pt_popup_display == 'all' ) {
			if ( $pt_popup_visibility == 'never' && !isset($_COOKIE['pt_global_popup']) ) {
				$expire = time() + 3600 * 24 * 30 * 12;
				setcookie( "pt_global_popup", md5( "pt_global_popup" ), $expire, COOKIEPATH ); 	
			} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE['pt_session_popup']) ) {
				setcookie( "pt_session_popup", md5( "pt_global_popup" ), 0, COOKIEPATH ); 	
			}

		} else if ( is_page() && $pt_popup_display == 'all') {
			$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( $tmpl == 'page-sales.php' ) {
				$cookiename = 'pt_custom_popup_' . $post->ID;
				$cookiename2 = 'pt_custom_session_popup_' . $post->ID;

			} else {

				$cookiename = 'pt_global_popup';
				$cookiename2 = 'pt_session_popup';

				if ( $pt_popup_visibility == 'never' && !isset($_COOKIE[$cookiename]) ) {
					$expire = time() + 3600 * 24 * 30 * 12;
					setcookie( $cookiename , md5( $cookiename ), $expire, COOKIEPATH ); 	
				} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE[$cookiename2]) ) {
					setcookie( $cookiename2 , md5( $cookiename2 ), 0, COOKIEPATH ); 	
				}
			}

		} else if ( is_home() && $pt_popup_display == 'home' || is_home() && $pt_popup_display == 'all' ) {
			if ( $pt_popup_visibility == 'never' && !isset($_COOKIE['pt_global_popup']) ) {
				$expire = time() + 3600 * 24 * 30 * 12;
				setcookie( "pt_global_popup" , md5( "pt_global_popup" ), $expire, COOKIEPATH ); 	
			} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE['pt_session_popup']) ) {
				setcookie( "pt_session_popup" , md5( "pt_global_popup" ), 0, COOKIEPATH ); 	
			}

		} else if ( is_front_page() && $pt_popup_display == 'home' || is_front_page() && $pt_popup_display == 'all' ) {
			$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( $tmpl != 'page-sales.php' ) {
				if ( $pt_popup_visibility == 'never' && !isset($_COOKIE['pt_global_popup']) ) {
					$expire = time() + 3600 * 24 * 30 * 12;
					setcookie( "pt_global_popup" , md5( "pt_global_popup" ), $expire, COOKIEPATH ); 	
				} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE['pt_session_popup']) ) {
					setcookie( "pt_session_popup" , md5( "pt_global_popup" ), 0, COOKIEPATH ); 	
				}
			}

		} 
	}
	
}

function pt_minisite_popup_cookies()
{
	global $post;
	
	$meta = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
	if ( $meta['lp-page-popup'] == 'true' ) {
		if ( $meta['lp-page-popup-display'] == 'never' && !isset($_COOKIE['pt_global_popup_' . $post->ID]) ) {
			$expire = time() + 3600 * 24 * 30 * 12;
			setcookie( "pt_global_popup_" . $post->ID, md5( "pt_global_popup_" . $post->ID ), $expire, COOKIEPATH ); 	
		} else if ( $meta['lp-page-popup-display'] == 'session' && !isset($_COOKIE['pt_session_popup_' . $post->ID]) ) {
			setcookie( "pt_session_popup_" . $post->ID, md5( "pt_global_popup_" . $post->ID ), 0, COOKIEPATH ); 	
		}
	}
	
}

function pt_check_oto()
{
	global $post, $wpdb;

	$meta = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
	if ( $meta['lp-page-upsell'] == 'yes' ) {

		if ( isset($_COOKIE['oto-' . $post->ID]) ) {
			$redir_page = ( $meta['lp-page-upsell-redir'] != '' ) ? get_permalink( $meta['lp-page-upsell-redir'] ) : '/';
			header('Location:' . $redir_page );
			exit; 
		}
	}
}

function pt_remove_filter($filter){
	global $pt_remove_filter;
	
	foreach ( $pt_remove_filter as $value ) {
		if($value['filter'] == $filter){
			remove_filter($filter, $value['function']);
		}
	}
}

//Created by Eko 4 Jan 2012
function pt_convert_line_break($str){
	return str_replace("\n","\\n", str_replace(array("\n\r", "\r\n", "\r"),"\n", $str));
}

function pt_onuserexit(){
	global $post;
	$lp = get_post_meta($post->ID, 'pt_landing_meta_box', true);
	?>
	<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS; ?>/onUserExit.js"></script>
	<script type="text/javascript">
		function pt_ExitPage(pageURL) {
			if (pageURL != 'false'){
				if ( jQuery.browser.mozilla && parseInt(jQuery.browser.version) >= 2 ) {
					jQuery('body').html('');
					jQuery('body').css({
						'background': 'none',
						'width': '100%',
						'height': '100%',
						'overflow': 'hidden'
					});
					
					setTimeout(function(e){
						alert('<?php echo pt_convert_line_break(addslashes(pt_isset($lp['lp-page-exit-message'], ''))); ?>');
						window.location.href = pageURL;
					}, 100);
					
				}else{
					var exitPage = '<div id="pt-exit-page" style="background:#FFFFFF; width:100%; height:100%; display:block; margin-top:0px; margin-left:0px;" align="center">';
					exitPage += '<iframe src="' + pageURL + '" width="100%" height="100%" align="middle" frameborder="0"></iframe>';
					exitPage += '</div>';
			
					jQuery('body').html('');
					jQuery('body').css({
						'margin': '0',
						'width': '100%',
						'height': '100%',
						'overflow': 'hidden'
					});
					jQuery('body').append(exitPage);
			
					jQuery('#pt-exit-page').css({
						'position': 'fixed',
						'z-index': '99999',
						'width':'100%',
						'height':'100%',
						'top': '0',
						'left': '0',
						'display':'block'
					});
				}
			}
		}
		
		jQuery(document).ready(function() {
		  	jQuery().onUserExit({
				execute: function() {
					pt_ExitPage('<?php echo pt_isset($lp['lp-page-exit-url'], 'false'); ?>');
			},
				instruction: "<?php echo pt_convert_line_break(addslashes(pt_isset($lp['lp-page-exit-message'], ''))); ?>"
			});
		});
	</script>
	<?php
}
