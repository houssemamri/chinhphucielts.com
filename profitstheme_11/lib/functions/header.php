<?php
add_action('wp_head', 'pt_head');
function pt_head()
{
	global $post, $pt_media_type, $pt_post_columns, $pt_theme, $pt_member_theme, $membersite;

	$load_site_skin = true;

	if ( is_page() ) {
		// check template meta
		$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );
		if ( $tmpl == 'page-sales.php' ) {
			$load_site_skin = false;
		}
	}

	if ( $load_site_skin ) {
		if ( $membersite == 'true' ) {
			echo '<link rel="stylesheet" type="text/css" href="' . PT_REL_SKINS . '/' . $pt_member_theme['skins'] . '/' . $pt_member_theme['colors'] . '" media="screen" />'."\n";
		} else {
			echo '<link rel="stylesheet" type="text/css" href="' . PT_REL_SKINS . '/' . $pt_theme['skins'] . '/' . $pt_theme['colors'] . '" media="screen" />'."\n";
		}
	}

	echo '<link rel="stylesheet" type="text/css" href="' . PT_REL_CSS . '/custom.css" media="screen" />'."\n";

	if ( pt_is_blog_page() || is_home() || is_category() ) {

		$width = pt_dimension();
		if ( $pt_media_type == 'feature3' ) {
?>			
			<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS; ?>/jquery.slide.js"></script>
			<script type="text/javascript">
				jQuery().ready(function() {
					jQuery('#slideshow').slide({slideWidth:<?php echo $width['slideWidth']; ?>, autoplay: true, duration: 5000, showSlideIndex: true});
				});
			</script>
	
<?php
		} else if ( $pt_media_type == 'feature2' ) {
?>	
			<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS; ?>/jquery.scrollTo.js"></script>
			<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS; ?>/jquery.gallery.js"></script>
<?php
		} else if ( $pt_media_type == 'feature1' ) {
?>	
			<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS; ?>/jquery.jcarousel.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function() {
    					jQuery('#mycarousel').jcarousel({
        					wrap: 'last',
						auto: 7,
						scroll: 1
    					});
				});
			</script>
<?php
		}
	}
?>

<!--[if IE 6]>
<script type="text/javascript" src="<?php echo PT_REL_SCRIPTS;  ?>/pngfix.js"></script>
<![endif]-->

<?php
}

if ( !is_admin() ) add_action( 'init', 'pt_script_init', 5 );
function pt_script_init()
{
	global $pt_media_type, $pt_enable_popup;

	//wp_enqueue_script('jquery');

	if ( $pt_enable_popup == 'true' ) {
		wp_enqueue_script('popup', PT_REL_SCRIPTS . '/popup.js', array('jquery'));
	}

	wp_enqueue_script('tabcontent', PT_REL_SCRIPTS . '/tabcontent.js', array('jquery'));
	
	add_thickbox();
}


remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head');