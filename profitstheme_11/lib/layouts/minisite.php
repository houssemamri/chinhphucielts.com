<?php
/*
* File name: minisite.php
* Created by: Adi Djohari of Get Profits Fast
* Website: http://www.getprofitsfast.com
* Modified by: Eko Augustra of Get Profits Fast
* Last modified: June 19, 2013
*
* This file contains all functions to build landing pages
*/

function pt_minisite_framework() {
	global $post, $design_options, $site_options, $pt_layout_setup, $option_key;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = pt_isset($value['value']); 
	}

	pt_remove_filter('the_content');
	pt_landing_page_open();
	
	pt_minisite_header( $pt_layout_setup['header'],  $pt_layout_setup['topnavpos'], $post->ID );
	pt_minisite_body( $post->ID );
	pt_minisite_footer( $post->ID, $pt_layout_setup['footer'] );
	pt_minisite_popup_optin( $post->ID );
	pt_document_close();
}

function pt_minisite_popup_optin( $post_id ) {

	$meta = get_post_meta( $post_id, 'pt_landing_meta_box', true );

	$ar_code = pt_isset($meta['lp-page-pop-code']);
	$name_field = pt_isset($meta['lp-page-pop-name']);
	$email_field = pt_isset($meta['lp-page-pop-email']);
	$disclaimer = pt_isset($meta['lp-page-pop-privacy']);
	$pop_width = pt_isset($meta['lp-page-pop-width']);
	$pop_height = pt_isset($meta['lp-page-pop-height']);
	$pop_text = pt_isset($meta['lp-page-pop-text']);
	$pop_image = pt_isset($meta['lp-page-pop-img']);
	$pop_headline = pt_isset($meta['lp-page-pop-headline']);
	$pop_headline_font = pt_isset($meta['lp-page-pop-headline-font']);
	$pop_headline_color = pt_isset($meta['lp-page-pop-headline-color']);
	$pop_headline_size = pt_isset($meta['lp-page-pop-headline-size']);
	$resp_code = pt_isset($meta['lp-page-pop-privacy']);
	$button_type = pt_isset($meta['lp-page-pop-btntype']);
	$button_pre = pt_isset($meta['lp-page-pop-btnpremade']);
	$button_txt = pt_isset($meta['lp-page-pop-btntxt']);
	$button_clr  = pt_isset($meta['lp-page-pop-btnclr']);
	$button_img  = pt_isset($meta['lp-page-pop-btn-img']);
	$pop_text_font = pt_isset($meta['lp-page-pop-text-font']);
	$pop_text_color = pt_isset($meta['lp-page-pop-text-color']);
	$pop_text_size = pt_isset($meta['lp-page-pop-text-size']);

	preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $ar_code ), $form);
	preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $ar_code ), $form2);
	preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $ar_code ), $hiddens);
	preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $ar_code ), $fields);

	$width = (int)$pop_width - 60;
	$height = (int)$pop_height - 40;

	$form_field = ( pt_isset($form[0][0]) != '' ) ? $form[0][0] : '<form action="' . pt_isset($form2[1]) . '" method="post">';
	$popup = "\n\n" . $form_field . "\n";
	
	$popup .= '
	<div id="popupOptin" style="width:' . $width . 'px;height:' . $height . 'px;font-family:' . $pop_text_font . ';font-size:' . $pop_text_size . 'px; color:' . $pop_text_color . '">
		<div class="poptopbar"><a id="popupOptinClose">x</a></div>
		<h1 style="font-family:' . $pop_headline_font . '; color:' . $pop_headline_color . '; font-size:' . $pop_headline_size . 'px">' . $pop_headline . '</h1>
	';
	if ( pt_isset($pop_image) != '' ) {
		 $popup .= '<div style="text-align:center"><img src="' . $pop_image . '" border="0" /></div>';
	}	

	$popup .= '<p style="text-align:center">' . stripslashes( $pop_text ) . '</p>' . "\n\n";
	$popup .= '<div class="popup_area">' . "\n";

	$arfields = pt_extract_fields( $fields, $name_field, $email_field, 'popup_optin_field' );
	
	if ( $arfields ) {
		foreach ( $arfields as $arfield ) {
			$popup .= $arfield . "\n";
		}
	}

	if ( $button_type == 'premade' ) {
		$popup .= '<div style="margin:10px 0;text-align:center"><input type="image" name="submit" src="' . PT_REL_IMAGES . '/buttons/' . $button_pre . '.png" /></div>' . "\n";
	} else if ( $button_type == 'text' ) {
		$popup .= '<div style="margin:10px 0;text-align:center"><input type="submit" name="submit" value="' . $button_txt . '" class="popup-button-' . $button_clr . '" /></div>' . "\n";
	} else if ( $button_type == 'upload' ) {
		$popup .= '<div style="margin:10px 0;text-align:center"><input type="image" name="submit" src="' . $button_img . '" /></div>' . "\n";
	}
	
	$disc_top = ($pop_height - 65) - 40;
	$popup .= '<div class="pop-disclaimer" style="left:0;top:' . $disc_top . 'px"><p class="popup_optin_disc">' . stripslashes($disclaimer) . '</p></div>' . "\n";
	$popup .= '</div>' . "\n";

	if ( pt_isset($hiddens[0]) ) {
		foreach ( $hiddens[0] as $hidden ) {
			$popup .= $hidden . "\n";
		}
	}

	$popup .= '</form>' . "\n";
	
	$popup .= '
	</div>
	<div id="backgroundPopup"></div>
	';

	if ( pt_isset($meta['lp-page-popup']) == 'true' ) {

		if ( pt_isset($meta['lp-page-popup-display']) == 'always' ) {
			echo $popup;
		} else if ( $meta['lp-page-popup-display'] == 'never' ) {
			if ( !isset($_COOKIE['pt_global_popup_' . $post_id]) ) {
				echo $popup;
			}
		} else if ( $meta['lp-page-popup-display'] == 'session' ) {
			if ( !isset($_COOKIE['pt_session_popup_' . $post_id]) ) {
				echo $popup;
			}
		}
	}
}

function pt_minisite_header_optin( $post_id ) {

	$meta = get_post_meta( $post_id, 'pt_landing_meta_box', true );

	$headline = pt_isset($meta['lp-header-optin-text']);
	$name_field = pt_isset($meta['lp-header-optin-name']);
	$email_field = pt_isset($meta['lp-header-optin-email']);
	$button_txt = pt_isset($meta['lp-header-optin-btntxt']);
	$disclaimer = pt_isset($meta['lp-header-optin-privacy']);
	$button_clr  = pt_isset($meta['lp-header-optin-btnclr']);
	$resp_code = pt_isset($meta['lp-header-optin-code']);
	$color1 = pt_isset($meta['lp-header-text-color']);
	$color2 = pt_isset($meta['lp-header-text-color-2']);
	
	preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $resp_code ), $form);
	preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $resp_code ), $form2);
	preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $resp_code ), $hiddens);
	preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $resp_code ), $fields);

	$form_field = ( pt_isset($form[0][0]) != '' ) ? $form[0][0] : '<form action="' . pt_isset($form2[1]) . '" method="post">';
	$header_optin = "\n\n" . $form_field . "\n";

	$header_optin .= '
	<div class="header_optin">
		<div class="header_optin_text" style="color:' . $color1 . ';"><strong>' . stripslashes( $headline ) . '</strong></div>
		<div class="header_optin_area">
	';

	$arfields = pt_extract_fields($fields, $name_field, $email_field, 'header_optin_field');
	
	if ( $arfields ) {
		foreach ( $arfields as $arfield ) {
			$header_optin .= $arfield . "\n";
		}
	}

	$header_optin .= '<div style="text-align:right;margin:5px 0;"><input type="submit" name="submit" value="' . $button_txt . '" class="header-button-' . $button_clr . '" /></div>' . "\n";
		
	$header_optin .= '<div class="header_optin_disc" style="color:' . $color2 . ';font-weight:400;">' . stripslashes( $disclaimer ) . '</div>' . "\n";
	$header_optin .= '</div>' . "\n";

	if ( pt_isset($hiddens[0]) ) {
		foreach ( $hiddens[0] as $hidden ) {
			$header_optin .= $hidden . "\n";
		}
	}

	$header_optin .= '
		</div>
	</form>
	';

	if ( pt_isset($meta['lp-header-optin']) == 'true' ) {
		echo $header_optin;
	}
}

function pt_minisite_header( $setup, $nav_pos, $post_id )
{
	$meta = get_post_meta($post_id, 'pt_landing_meta_box', true);
	pt_landing_page_before_header();
	
	if ( pt_isset($meta['lp-header-remove']) != 'true' ) {
		pt_landing_page_header();

	}		
	
	echo '<div id="wrapper">' . "\n";
}

function pt_minisite_body( $post_id )
{
	$meta = get_post_meta($post_id, 'pt_landing_meta_box', true);

	// Top block design for main content
	// Must be hidden via css if not used
	echo '
	<div id="top-content-body">
		<div class="top-left-corner"></div>
		<div class="top-right-corner"></div>
		<div class="clearfix"></div>
	</div>
	';
	
	echo '<div id="mainarea"><div style="clear:both"></div>' . "\n";	
		echo '<div id="saleswrapper">' . "\n\n";
			echo '<div id="copy">' . "\n\n";

			if ( pt_isset($meta['lp-top']) != 'clean' ) {
				// Top Column Section
				echo '<div class="sales-top">' . "\n\n";
					pt_landing_page_top_nav();
					pt_render_layout( $post_id, 'lp-pre' );
				echo '</div>' . "\n\n";
			}

			// Two Columns Section
			echo '<div class="sales-middle">' . "\n\n";

				// Left Column
				echo '<div class="sales-left">' . "\n\n";
					pt_render_layout( $post_id, 'lp-main' );
				echo '</div>' . "\n\n";

				// Right Column
				echo '<div class="sales-right">' . "\n\n";
					pt_render_layout( $post_id, 'lp-side' );
				echo '</div>' . "\n\n";

				echo '<div style="clear:both"></div>' . "\n\n";

			echo '</div>' . "\n\n";

			if ( pt_isset($meta['lp-bottom']) != 'clean' ) {
				// Bottom Column Section
				echo '<div class="sales-bottom">' . "\n\n";
					pt_render_layout( $post_id, 'lp-bottom' );
				echo '</div>' . "\n\n";
			}
			
		echo '
				</div>
			</div>
		</div>
		';

	echo '
	<div id="bot-content-body">
		<div class="bot-left-corner"></div>
		<div class="bot-right-corner"></div>
		<div class="clearfix"></div>
	</div>
	';

}

function pt_minisite_footer( $post_id, $setup )
{
	echo '</div>' . "\n\n";

	pt_landing_page_footer( $post_id );
}

function pt_minisite_content()
{
	global $post;
	if(have_posts()) : while (have_posts()) : the_post();

	echo '<div class="lp-main-content">';

		the_content();

	echo '</div>';

	endwhile; endif;

}

function pt_minisite_cufon() {
	global $post;
	
	$meta = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
	
	$fonts  = new PtFonts;
	$cufons = $fonts->getCufon();
	$cufon  = array();
	foreach ( $cufons as $value ) {
		$cufon[] = $value['family'];
	}

	$head = ( in_array(pt_isset($meta['lp-headline-font']), $cufon) ) ? true : false;
	$pre  = ( in_array(pt_isset($meta['lp-pre-headline-font']), $cufon) ) ? true : false;
	$sub  = ( in_array(pt_isset($meta['lp-sub-headline-font']), $cufon) ) ? true : false;

	$loadscript = '';
	$output     = '';
		
	if ( $head == true ) {
		$color = HexToRGB($meta['lp-headline-color']);

		if ( $meta['lp-headline-font'] != 'Hand Of Sean' || $meta['lp-headline-font'] != 'Delicious') {
			$loadscript .= '<script type="text/javascript" src="' . PT_REL_SCRIPTS . '/cufon/' . str_replace(" ", "_", $meta['lp-headline-font']) . '.font.js"></script>' . "\n";
		}

		$output .= '
		<script type="text/javascript">
			Cufon.replace("#mini-headline", {
				fontFamily: "' . $meta['lp-headline-font'] . '"
			});
		</script>
		';
	}

	if ( $pre == true ) {

		if ( $meta['lp-pre-headline-font'] != 'Hand Of Sean' || $meta['lp-pre-headline-font'] != 'Delicious' ) {
			if ( $meta['lp-pre-headline-font'] != $meta['lp-headline-font'] ) {
				$loadscript .= '<script type="text/javascript" src="' . PT_REL_SCRIPTS . '/cufon/' . str_replace(" ", "_", $meta['lp-pre-headline-font']) . '.font.js"></script>' . "\n";
			}
		}

		$output .= '
		<script type="text/javascript">
			Cufon.replace("#mini-pre-headline", {
				fontFamily: "' . $meta['lp-pre-headline-font'] . '"
			});
		</script>
		';
	}
	
	if ( $sub == true ) {

		if ( $meta['lp-sub-headline-font'] != 'Hand Of Sean' || $meta['lp-sub-headline-font'] != 'Delicious' ) {
			if ( $meta['lp-sub-headline-font'] != $meta['lp-headline-font'] ) {
				if ( $meta['lp-sub-headline-font'] != $meta['lp-pre-headline-font'] ) {
					$loadscript .= '<script type="text/javascript" src="' . PT_REL_SCRIPTS . '/cufon/' . str_replace(" ", "_", $meta['lp-sub-headline-font']) . '.font.js"></script>' . "\n";
				}
			}
		}

		$output .= '
		<script type="text/javascript">
		Cufon.replace("#mini-sub-headline", {
			fontFamily: "' . $meta['lp-sub-headline-font'] . '"
		});
		</script>
		';
	}


	echo $loadscript;
	echo $output;
}

if ( !function_exists('HexToRGB') ) :
function HexToRGB($hex) 
{
	$hex = preg_replace("/#/", "", $hex);
	$color = array();
		
	if (strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	} else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
		
	return $color;
}
endif;

function pt_minisite_headline( $post_id, $args ) 
{
	$text  = $args['lp-headline-text'];
	$color = $args['lp-headline-color'];
	$font  = $args['lp-headline-font'];
	$size  = $args['lp-headline-size'];

	$fonts  = new PtFonts;
	$cufons = $fonts->getCufon();
	$cufon  = array();
	foreach ( $cufons as $value ) {
		$cufon[] = $value['family'];
	}

	$family = ( !in_array($font, $cufon) ) ? ' font-family:' . stripslashes($font) . ';' : '' ;

	echo '<h1 id="mini-headline" style=\'text-align:center; color:' . $color . ';' . $family . ' font-size:' . $size . 'px; font-weight:bold;\'>' . $text . '</h1>' . "\n\n";
}

function pt_minisite_pre_headline( $post_id, $args ) 
{
	$text  = $args['lp-pre-headline-text'];
	$color = $args['lp-pre-headline-color'];
	$font  = $args['lp-pre-headline-font'];
	$size  = $args['lp-pre-headline-size'];

	$fonts  = new PtFonts;
	$cufons = $fonts->getCufon();
	$cufon  = array();
	foreach ( $cufons as $value ) {
		$cufon[] = $value['family'];
	}

	$family = ( !in_array($font, $cufon) ) ? ' font-family:' . stripslashes($font) . ';' : '' ;

	echo '<h2 id="mini-pre-headline" style=\'text-align:center; color:' . $color . ';' . $family . ' font-size:' . $size . 'px\'>' . $text . '</h2>' . "\n\n";
}

function pt_minisite_sub_headline( $post_id, $args ) 
{
	$text  = $args['lp-sub-headline-text'];
	$color = $args['lp-sub-headline-color'];
	$font  = $args['lp-sub-headline-font'];
	$size  = $args['lp-sub-headline-size'];

	$fonts  = new PtFonts;
	$cufons = $fonts->getCufon();
	$cufon  = array();
	foreach ( $cufons as $value ) {
		$cufon[] = $value['family'];
	}

	$family = ( !in_array($font, $cufon) ) ? ' font-family:' . stripslashes($font) . ';' : '' ;

	echo '<h3 id="mini-sub-headline" style=\'text-align:center; color:' . $color . ';' . $family . ' font-size:' . $size . 'px\'>' . $text . '</h3>' . "\n\n";
}

function pt_minisite_simple_video( $post_id, $args, $num='')
{
	$num = $num ? $num.'-' : '';
	echo '<div style="text-align:center">' . stripslashes($args['lp-svideo-'.$num.'code']) . '</div>';
}

function pt_minisite_video( $post_id, $args, $num='') {
	$num = $num ? $num.'-' : '';
	
	$video_player = $args['lp-video-'.$num.'player'];
	$video_url    = $args['lp-video-'.$num.'url'];
	$video_width  = $args['lp-video-'.$num.'width'];
	$video_height = $args['lp-video-'.$num.'height'];
	$video_auto   = ( $args['lp-video-'.$num.'auto'] == 'true' ) ? ' autoplay' : '';

	if ( $video_player == 'flow' ) {
		pt_flowplayer_video( $post_id, $args, $num);
	} else if ( $video_player == 'jw' ) {
		pt_jwplayer_video( $post_id, $args, $num);
	} else if ( $video_player == 'html5' ) {
		pt_html5_video( $post_id, $args, $num);
	}
}

function pt_html5_video( $post_id, $args, $num) {
	$video_mp4           = $args['lp-video-'.$num.'html5-mp4'];
	$video_ogg           = $args['lp-video-'.$num.'html5-ogg'];
	$video_webm          = $args['lp-video-'.$num.'html5-webm'];
	$video_width         = $args['lp-video-'.$num.'width'];
	$video_height        = $args['lp-video-'.$num.'height'];
	$video_auto          = $args['lp-video-'.$num.'auto'];
	$video_img           = $args['lp-video-'.$num.'img'];
	$video_ctrl          = $args['lp-video-'.$num.'control'];
	$video_ctrl_disable  = $args['lp-video-'.$num.'control-disable'];

	if ( $video_mp4 != '' || $video_ogg != '' || $video_webm != '' ) {

		$is_mobile  = pt_is_mobile();
		$useragent  = isset( $_SERVER['HTTP_USER_AGENT'] ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';
		$is_iphone  = ( stripos( $useragent, 'iphone' ) ) ? true : false;
		$is_ipad    = ( stripos( $useragent, 'ipad' ) ) ? true : false;
		$is_ipod    = ( stripos( $useragent, 'ipod' ) ) ? true : false;
		$is_iOS     = ( $is_iphone || $is_ipad || $is_ipod ) ? true : false;
		$is_android = ( stripos( $useragent, 'android' ) ) ? true : false;
	
		$ctrl_hide  = ( $video_ctrl != 'true' ) ? 'false' : 'true';
		$autoplay   = ( $video_auto == 'true' ) ? ' autoplay="autoplay" ' : '';
		$poster     = ( $video_img != '' ) ? ' poster="' . $video_img . '" ' : '';
		$controls   = ( $video_ctrl_disable = 'true' ) ? ' controls="controls" ' : '';
		$fl_auto    = ( $video_auto == 'true' ) ? 'true' : 'false';
		$btn_height = $video_height - 30;

		$flashvars  = "config=";
		$flashvars .= "{'playlist': [";
		$flashvars .= ( $video_img != '' ) ? "'" . htmlentities($video_img) . "',{'url':'" . htmlentities($video_mp4) . "','scaling':'scale','autoPlay':" . $fl_auto . ",'autoBuffering':true}" : "{'url':'" . htmlentities($video_mp4) . "','scaling':'scale','autoPlay':" . $fl_auto . ",'autoBuffering':true}";
		$flashvars .= ']},';
		$flashvars .= ( $video_ctrl_disable == 'true' ) ? "'plugins':{'controls':null}" : "'plugins':{'controls':{'autoHide':" . $ctrl_hide . "}}";
?>	
		<!-- HTML5 Video Start -->
		<div style="position:relative; width:<?php echo $video_width; ?>px; height:<?php echo $video_height; ?>px; margin:0 auto 0 auto; padding:10px 0 0 0">
		<video id="html5video"<?php echo $controls; ?><?php echo $autoplay; ?><?php echo $poster; ?>width="<?php echo $video_width; ?>" height="<?php echo $video_height; ?>" style="background:#000">
			<?php if ( $video_mp4 != '' ) { ?>
			<source src="<?php echo $video_mp4; ?>" type="video/mp4" />
			<?php } ?>
			<?php if ( !$is_android && !$is_iOS ) { ?>
			<?php if ( $video_webm != '' ) { ?>
			<source src="<?php echo $video_webm; ?>" type="video/webm" />
			<?php } ?>
			<?php if ( $video_ogg != '' ) { ?>
			<source src="<?php echo $video_ogg; ?>" type="video/ogg" />
			<?php } ?>
			<?php } ?>
			<?php if ( !$is_mobile ) { ?>
			<!-- Flash fallback for non-html5 browsers -->
			<object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.7.swf" width="<?php echo $video_width; ?>" height="<?php echo $video_height; ?>">
			<param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.7.swf" />
			<param name="allowFullScreen" value="true" />
			<param name="wmode" value="transparent" />
			<param name="flashVars" value="<?php echo $flashvars; ?>" />
			<?php } ?>	
			<?php if ( $video_img != '' ) { ?>
			<!-- Image fallback for non-html5 and non-flash browsers -->
			<img src="<?php echo $video_img; ?>" width="<?php echo $video_width; ?>" height="<?php echo $video_height; ?>" title="No video playback capabilities, please download the video below" />
			<?php } ?>
			<?php if ( !$is_mobile ) { ?>
			</object>
			<?php } ?>
		</video>
		</div>

		<?php if ( $args['lp-video-'.$num.'download'] == 'true' ) { ?>
		<p style="margin:0; padding:5px 0 10px 0; text-align:center"><small>
			<strong>Download video:</strong> <?php if ( $video_mp4 != '') { ?><a href="<?php echo $video_mp4; ?>">MP4 format</a><?php } ?> <?php if ( $video_ogg != '') { ?>| <a href="<?php echo $video_ogg; ?>">Ogg format</a><?php } ?> <?php if ( $video_webm != '') { ?>| <a href="<?php echo $video_webm; ?>">WebM format</a><?php } ?>
		</small>
		</p>
		<?php } ?>

		<script type="text/javascript">
		jQuery(document).ready(function(){
			<?php if ( $is_iOS ) { ?>
			jQuery("#html5video").removeAttr('poster');
			<?php } ?>

			<?php if ( $is_iOS || $is_android ) { ?>
			jQuery("#html5video")[0].load();
			<?php } ?>
		});
		</script>
		<!-- HTML5 Video End -->
<?php
	}
}

function pt_jwplayer_video( $post_id, $args, $num='') {
	$video_url           = $args['lp-video-'.$num.'url'];
	$video_width         = $args['lp-video-'.$num.'width'];
	$video_height        = $args['lp-video-'.$num.'height'];
	$video_auto          = $args['lp-video-'.$num.'auto'];
	$video_img           = $args['lp-video-'.$num.'img'];
	$video_ctrl          = $args['lp-video-'.$num.'control'];
	$video_ctrl_disable  = $args['lp-video-'.$num.'control-disable'];

	$jwplayerurl = get_option('jw_player_location');
	if ( function_exists( 'jwplayer_plugin_menu' ) ) {
		if ( defined('JWPLAYER_FILES_URL') ) {
			$jwplayerurl = JWPLAYER_FILES_URL . '/player/player.swf';
		} else {
			$jwplayerurl = get_option('jw_player_location');
		}
	}

	$autostart = ( $video_auto == 'true' ) ? 'true' : 'false';

	if ( !empty($video_url) ) {
		$videoext = substr($video_url, strripos($video_url, '.'), strlen($video_url));

		$jwplayerjs = str_replace( 'jwplayer.flash.swf', 'jwplayer.js', $jwplayerurl);
		$jwposter   = ( $video_img != '' ) ? ' poster="' . $video_img . '" ' : '';

		if ( !function_exists( 'jwplayer_plugin_menu' ) ) {
			echo '<script type="text/javascript" src="' . $jwplayerjs . '"></script>';
		}

		echo '
		<div style="width:' . $video_width . 'px;margin:0 auto; padding:20px 0;">
		<div id="jw-video-'.$num.'container" style="margin:0; padding:0" class="pt-video-shad">
		<div id="myElement-'.$num.'video">Loading the player ...</div>
		<script type="text/javascript">
		    jwplayer("myElement-'.$num.'video").setup({
		        file: "' . $video_url . '",
		        height: ' . $video_height . ',
		        width: ' . $video_width . ',';

				if ( $video_ctrl_disable == 'true' ) {
					echo '
						controlbar: "none",
					';
				} else {
					if ( $video_ctrl == 'true' ) {
						echo '
						controlbar: "over",
						';
					}
				}
		echo 'autostart: ' . $autostart . '
				});
		</script>
		</div>
		</div>
		';

		if ( $args['lp-video-'.$num.'download'] == 'true' ) {
			echo '<div style="margin:3px 0 15px 0;text-align:center"><small><strong><a href="' . $args['lp-video-'.$num.'url'] . '">Click here</a> to download the video</strong></small></div>';
		}
	}
}

function pt_flowplayer_video( $post_id, $args, $num='') {
	$video_url           = $args['lp-video-'.$num.'url'];
	$video_width         = $args['lp-video-'.$num.'width'];
	$video_height        = $args['lp-video-'.$num.'height'];
	$video_auto          = $args['lp-video-'.$num.'auto'];
	$video_img           = $args['lp-video-'.$num.'img'];
	$video_ctrl          = $args['lp-video-'.$num.'control'];
	$video_ctrl_disable  = $args['lp-video-'.$num.'control-disable'];

	if ( !empty($video_url) ) {
		$autoplay    = ($video_auto == 'true') ? 'true' : 'false';
		$ctrl_hide   = ($video_ctrl != 'true') ? 'false' : 'true';
		
		echo '<script type="text/javascript" src="http://releases.flowplayer.org/js/flowplayer-3.2.6.min.js"></script>' . "\n";
		echo '<script type="text/javascript" src="http://releases.flowplayer.org/js/flowplayer.ipad-3.2.2.js"></script>' . "\n";
		echo '<div style="position:relative; display:block; margin:0 auto; padding:20px 0; width:' . $video_width . 'px; height:' . $video_height . 'px;"><div id="player-'.$num.'fp" style="width:' . $video_width . 'px; height:' . $video_height . 'px;" class="pt-video-shad"></div></div>' . "\n\n"; 

		if ( $args['lp-video-'.$num.'download'] == 'true' ) {
			echo '<div style="margin-top:-15px;margin-bottom:15px;text-align:center"><small><strong><a href="' . $args['lp-video-'.$num.'url'] . '">Click here</a> to download the video</strong></small></div>';
		}
		
		echo '
		<script type="text/javascript">
			$f("player-'.$num.'fp", "http://releases.flowplayer.org/swf/flowplayer-3.2.15.swf", {
				
				playlist: [
		';

		if ( $video_img != '' ) {
			echo '
					{
						url: "' . $video_img . '", 
						scaling: "orig"
					},
			';
		}

		echo '
					
					{
						url: "' . $video_url . '",
						scaling: "scale",
						autoPlay: ' . $autoplay . ',
						autoBuffering: true
					}
				],

		';

		if ( $video_ctrl_disable == 'true' ) {
			echo '
				plugins: {
					controls: null
				}
			';
		} else {
			echo '
				plugins: {
					controls: { 
						autoHide: ' .$ctrl_hide . ' 
					}
				}
			';
		}

		echo '
			}).ipad();
		</script>
		';
	}
}

function pt_minisite_comments( $args ) {
	global $post;
	$facebook_com = '';
	$commsys = $args['lp-comments-type'];
	$commtxt = $args['lp-comments-text'];

	$appid = $args['lp-comments-fb-appid'];
	$fbcount = $args['lp-comments-fb-count'];
	$fbxid = $args['lp-comments-fb-xid'];


	if ( $commtxt != '' ) {
		echo '<div class="lp-comm-txt">' . $commtxt . '<img src="' . PT_REL_IMAGES . '/comm-arrow.gif" border="0" style="float:left" /></div>';
		echo '<div style="clear:left"></div>';
	}

	if ( $appid != '' ) {
		$width = $args['lp-page-width'];
		$right_width = $args['lp-page-right-width'];
		$left_width  = (($width - 20) - pt_isset($right_column, 0)) - 30;
		// $commwidth   = $left_width - 15;
		$commwidth = (($width - $right_width ) - ( $args['lp-page-padding'] * 2 )) - 30;

		$fbuid  = pt_isset($args['lp-comments-fb-notify']);

		$facebook_com = '
			<div style="margin:0 auto; padding:15px 0; width:' . $commwidth . 'px">
			<div id="fb-root"></div>
			<script type="text/javascript">
    			window.fbAsyncInit = function() {
    				FB.init({
    					appId: "' . $appid . '",
    					status: true,
    					cookie: true,
    					xfbml: true
    				});
    			};
    
    			(function() {
    				var e = document.createElement("script"); e.async = true;
    				e.src = document.location.protocol + "//connect.facebook.net/en_US/all.js";
    				document.getElementById("fb-root").appendChild(e);
    			}());
			</script>
			<iframe src="http://www.facebook.com/plugins/like.php?href=' . urlencode(get_permalink($post->ID)) . '&send=false&show_faces=false&action=like" scrolling="no" frameborder="0" style="width: 100%; height: 40px; overflow:hidden; border:none" allowTransparency="true" height="auto"></iframe>
			<fb:comments num_posts="' . $fbcount . '" width="' . $commwidth . '" href="' . get_permalink($post->ID) . '" colorscheme="light"></fb:comments>
			</div>
		';
	}

	if ( $commsys == 'fbcomm' ) {

		echo $facebook_com;

	} else if ( $commsys == 'allcomm' ) {
		if ( $args['lp-comments-sort'] == 'wpmain' ) {
?>
			<div class="landing-comments">
				<?php comments_template();?>
			</div>
<?php
			echo $facebook_com;

		} else {
			echo $facebook_com;
?>
			<div class="landing-comments">
				<?php comments_template();?>
			</div>
<?php
		} 
	} else {
?>
	<div class="landing-comments">
		<?php comments_template();?>
	</div>
<?php
	}
}

function pt_minisite_optin( $post_id, $args, $num = 1 )
{
	if ( $num == 2 ) {
		$style       = $args['lp-optin-2-style'];
		$resp        = $args['lp-optin-2-resp'];
		$ecover      = $args['lp-optin-2-ecover'];
		$substxt     = $args['lp-optin-2-text'];
		$namefield   = $args['lp-optin-2-name'];
		$emailfield  = $args['lp-optin-2-email'];
		$btntype     = $args['lp-optin-2-btntype'];
		$btnpremade  = $args['lp-optin-2-btnpremade'];
		$btnclr      = $args['lp-optin-2-btnclr'];
		$btntxt      = $args['lp-optin-2-btntxt'];
		$btnimg      = $args['lp-optin-2-btn-img'];
		$privacy     = $args['lp-optin-2-privacy'];
		
	} else {
		$style       = $args['lp-optin-style'];
		$resp        = $args['lp-optin-resp'];
		$ecover      = $args['lp-optin-ecover'];
		$substxt     = $args['lp-optin-text'];
		$namefield   = $args['lp-optin-name'];
		$emailfield  = $args['lp-optin-email'];
		$btntype     = $args['lp-optin-btntype'];
		$btnpremade  = $args['lp-optin-btnpremade'];
		$btnclr      = $args['lp-optin-btnclr'];
		$btntxt      = $args['lp-optin-btntxt'];
		$btnimg      = $args['lp-optin-btn-img'];
		$privacy     = $args['lp-optin-privacy'];
	}

	$right_width = $args['lp-page-right-width'];
	$button_txt = ($btntxt != '') ? $btntxt : 'Get Instant Access';

	preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $resp ), $form);
	preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $resp ), $form2);
	preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $resp ), $hiddens);
	preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $resp ), $fields);

	$formstyle   = explode( '-', $style );
	$formwidth   = $right_width - 20;
	$ecoverwidth = $formwidth - 40; 

	$optinform = "\n\n" . '<div class="squeezeimg" style="margin-left:auto;margin-right:auto;width:' . $formwidth . 'px;">' . "\n";

	if ( $ecover != '' ) $optinform .= '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative($ecover) . '&w=' . $ecoverwidth . '&h=&zc=1" border="0" />' . "\n";

	$optinform .= '</div>' . "\n\n";

	$optinform .= '<div class="squeezebox-' . $style . '" style="margin-left:auto;margin-right:auto;width:' . $formwidth . 'px;"><!-- Optin Box Start -->' . "\n";
    
	if ( $style != 'animated' && $style != 'static') {
    	$optinform .= '<div class="squeezearrow"></div>' . "\n";
	}
	
    $optinform .= '<div class="element-squeezebox"></div>' . "\n";
	
	if ( $style == 'animated' ) {
			$optinform .= '<div style="text-align:center"><img src="' . PT_REL_IMAGES . '/arrows/arrow1-red.gif" border="0" /></div>' . "\n";
	}

	if ( $style == 'static' ) {
			$optinform .= '<div style="text-align:center"><img src="' . PT_REL_IMAGES . '/arrows/arrow-static.gif" border="0" /></div>' . "\n";
	}

	if ( $substxt != '' ) {
		$optinform .= '<p style="text-align:center;padding:10px 15px;" class="inst-' . $formstyle[0] . '">' . stripslashes($substxt) . '</p>' . "\n";
	}

	if ( $formstyle[0] == 'gradient' ) {
		$optinform .= '<div style="text-align:center"><img src="' . PT_REL_IMAGES . '/arrows/arrow-' . $style . '.png" border="0" /></div>' . "\n";
	}
	
    
	$optinform .= '<div style="text-align:center">';
	$form_field = ( pt_isset($form[0][0]) != '' ) ? $form[0][0] : '<form action="' . pt_isset($form2[1]) . '" method="post">';
	$optinform .= "\n\n" . $form_field . "\n";
	
    
	$text_fields = pt_extract_fields($fields, $namefield, $emailfield, 'simplesqueeze');

	if ( $text_fields ) {
		foreach ( $text_fields as $text_field ) {
			$optinform .= $text_field . "\n";
		}
	}

	$optinform .= '</div>';

	$optinform .= '<div id="squeeze-btn-area">' . "\n";
	
	if ( $btntype == 'premade' ) {
		$optinform .= '<input type="image" name="submit" value="" src="' . PT_REL_IMAGES . '/buttons/' . $btnpremade . '.png" />' . "\n";
	} else if ( $btntype == 'blank' ) {
		$optinform .= '<input type="submit" name="submit" value="' . $button_txt . '" class="squeeze-submit-' . $btnclr . '" />' . "\n";
	} else if ( $btntype == 'upload' ) {
		$optinform .= '<input type="image" name="submit" value="" src="' . $btnimg . '" />' . "\n";
	}

	$optinform .= '</div>' . "\n";
	$optinform .= '<p style="padding:0 20px 10px 20px;color:#818181;line-height:16px;text-align:center;"><small>' . stripslashes($privacy) . '</small></p>' . "\n";

	if ( $hiddens[0] ) {
		foreach ( $hiddens[0] as $hidden ) {
			$optinform .= $hidden . "\n";
		}
	}

	$optinform .= '</form>' . "\n";
	$optinform .= '</div>' . "\n\n";

	echo $optinform;	
}

function pt_minisite_free_register( $post_id, $args, $num = 1 )
{
	$style       = $args['lp-register-style'];
	$substxt     = $args['lp-register-text'];
	$namefield   = $args['lp-register-name'];
	$emailfield  = $args['lp-register-email'];
	$btntype     = $args['lp-register-btntype'];
	$btnpremade  = $args['lp-register-btnpremade'];
	$btnclr      = $args['lp-register-btnclr'];
	$btntxt      = $args['lp-register-btntxt'];
	$btnimg      = $args['lp-register-btn-img'];
	$privacy     = $args['lp-register-privacy'];
	$disName     = $args['lp-register-disable-name'];

	$product_id  = $args['lp-register-product'];
	$successurl  = ( $args['lp-register-thanks'] != '' ) ? get_permalink( $args['lp-register-thanks'] ) : get_bloginfo('wpurl');

	$right_width = $args['lp-page-right-width'];
	$button_txt = ($btntxt != '') ? $btntxt : 'Get Instant Access';

	$formstyle   = explode( '-', $style );
	$formwidth   = $right_width - 20;
	$ecoverwidth = $formwidth - 40;

	$optinform = "\n\n" . '<div class="squeezeimg" style="margin-left:auto;margin-right:auto;width:' . $formwidth . 'px;">' . "\n";

	$optinform .= '</div>' . "\n\n";

	$optinform .= '<div class="squeezebox-' . $style . '" style="margin-left:auto;margin-right:auto;width:' . $formwidth . 'px;"><!-- Optin Box Start -->' . "\n";

	$optinform .= '<div class="squeezearrow"></div>' . "\n";
	
	if ( $style == 'animated' ) {
			$optinform .= '<div style="text-align:center"><img src="' . PT_REL_IMAGES . '/arrows/arrow1-red.gif" border="0" /></div>' . "\n";
	}

	if ( $style == 'static' ) {
			$optinform .= '<div style="text-align:center"><img src="' . PT_REL_IMAGES . '/arrows/arrow-static.gif" border="0" /></div>' . "\n";
	}

	if ( $substxt != '' ) {
		$optinform .= '<p style="text-align:center;padding:10px 15px;" class="inst-' . $formstyle[0] . '">' . stripslashes($substxt) . '</p>' . "\n";
	}

	if ( $formstyle[0] == 'gradient' ) {
		$optinform .= '<div style="text-align:center"><img src="' . PT_REL_IMAGES . '/arrows/arrow-' . $style . '.png" border="0" /></div>' . "\n";
	}
	
	$optinform .= '<div style="text-align:center">';
	$optinform .= "\n\n" . '<form name="pt-free-register" id="pt-free-register" method="post" action="' . get_bloginfo('wpurl') . '/?mode=register&type=quick">' . "\n";
	
	if ( $disName != 'true' ) {
		$optinform .= "\t" . '<input type="text" name="member_name" class="simplesqueeze" value="' . $namefield . '" onfocus="if(this.value == \'' . $namefield . '\'){ this.value = \'\';this.style.color = \'#212121\' }" onblur="if(this.value == \'\'){ this.value = \'' . $namefield . '\';this.style.color = \'#818181\' }" />' . "\n";
	}

	$optinform .= "\t" . '<input type="text" name="member_email" class="simplesqueeze" value="' . $emailfield . '" onfocus="if(this.value == \'' . $emailfield . '\'){ this.value = \'\';this.style.color = \'#212121\' }" onblur="if(this.value == \'\'){ this.value = \'' . $emailfield . '\';this.style.color = \'#818181\' }" />' . "\n";

	$optinform .= '</div>';

	$optinform .= '<div id="squeeze-btn-area">' . "\n";
	
	if ( $btntype == 'premade' ) {
		$optinform .= '<input type="image" name="submit" value="" src="' . PT_REL_IMAGES . '/buttons/' . $btnpremade . '.png" />' . "\n";
	} else if ( $btntype == 'blank' ) {
		$optinform .= '<input type="submit" name="submit" value="' . $button_txt . '" class="squeeze-submit-' . $btnclr . '" />' . "\n";
	} else if ( $btntype == 'upload' ) {
		$optinform .= '<input type="image" name="submit" value="" src="' . $btnimg . '" />' . "\n";
	}

	$optinform .= '</div>' . "\n";
	$optinform .= '<p style="padding:0 20px 10px 20px;color:#818181;line-height:16px;text-align:center;"><small>' . stripslashes($privacy) . '</small></p>' . "\n";
	$optinform .= '<input type="hidden" name="product_id" value="' . $product_id . '" />' . "\n";
	$optinform .= '<input type="hidden" name="success_url" value="' . base64_encode($successurl) . '" />' . "\n";
	$optinform .= '</form>' . "\n";
	$optinform .= '</div>' . "\n\n";

	echo $optinform;	
}

function pt_minisite_warning( $post_id, $args ) {
	echo '<div class="warning"> ' .stripslashes($args['lp-warning-text']) . '</div>';
}

function pt_minisite_fakevid( $post_id, $args ) {
	$fakevid = $args['lp-fake-video-img'];
	$warning = $args['lp-fake-video-text'];
	$video_width = $args['lp-page-right-width'] - 20;
	$video_height = floor(( $args['lp-page-right-width'] / 4 ) * 2.5);
	$play_left = floor(( $video_width / 2 ) - 48);
	$bar_width = $video_width - 10;
	$bar_top = $video_height - 40;
	$bar_left = floor(($video_width - $bar_width) / 2);
	echo '<div class="fake-video" style="width:' . $video_width . 'px; height:' . $video_height . 'px">';
	echo '<img src="' . get_bloginfo('template_directory') . '/thumb.php?src=' . pt_to_relative($fakevid) . '&w=' . $video_width . '&h=' . $video_height . '&zc=1" border="0" onclick="alert(\'' . addslashes( $warning ) . '\'); return false;" />' . "\n";
	echo '<div class="fake-play" style="left:' . $play_left . 'px"><img src="' . PT_REL_IMAGES . '/fake-play.png" border="0" onclick="alert(\'' . addslashes( $warning ) . '\'); return false;" /></div>';
	echo '<div class="fake-bar" style="top:' . $bar_top . 'px;left:' . $bar_left . 'px"><img src="' . get_bloginfo('template_directory') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/fake-player.png&w=' . $bar_width . '&h=&zc=1" border="0" onclick="alert(\'' . addslashes( $warning ) . '\'); return false;" /></div>';
	echo '</div>';
}

function pt_social_button( $post_id, $args ) {
	$fb    = $args['lp-social-fb'];
	$tw    = $args['lp-social-tw'];
	$align = $args['lp-social-align'];
	$cta   = $args['lp-social-txt'];
	$set   = $args['lp-social-set'];

	$url   = get_permalink($post_id);
	$title = get_the_title($post_id);

	$tinyurl = @file_get_contents("http://tinyurl.com/api-create.php?url=" . $url);

	$twurl   = ($tinyurl != '') ? $tinyurl : $url;
	
	echo '<div style="margin:0; padding;10px 0; text-align:' . $align . '">';
	if ( $cta != '' ) echo '<span id="social-cta" style="font-size:16px"><strong>' . $cta . '</strong></span><br />'; 
	if ( $fb == 'true' ) {
		echo '<a href="http://www.facebook.com/sharer.php?u=' . urlencode($url) . '&t=' . urlencode($title) . '" target="_blank"><img src="' . PT_REL_IMAGES . '/icons/facebook' . $set . '.png" border="0" /></a>&nbsp;';
	}

	if ( $tw == 'true' ) {
		$tweet = stripslashes($args['lp-social-tw-txt']);
		$tweet = str_replace("<%page_title%>", get_the_title($post_id), $tweet);
		$tweet = str_replace("<%page_url%>", get_permalink($post_id), $tweet);
		echo '<a href="http://twitter.com/home?status=' . urlencode($tweet) . '" target="_blank"><img src="' . PT_REL_IMAGES . '/icons/twitter' . $set . '.png" border="0" /></a>';
	}
	echo '</div>';
}

function pt_launch_funnel( $post_id, $args ) {
	
	global $pt_launch_pages, $pt_launch_mode, $pt_launch_nav;

	$lp = get_post_meta($post_id, 'pt_landing_meta_box', true);
		
	$width  = $lp['lp-page-right-width'] != '' ? $lp['lp-page-right-width'] : 300;
	$height = floor( ( $width / 4 ) * 2 );

	echo '<div id="landing-sidebar">';
	echo '<ul>';

	$order_x = explode("|", $pt_launch_pages['order']);

	for ($i = 0; $i < count($order_x); $i++ ) {

		$meta = get_post_meta($order_x[$i], 'pt_launch_data', true);
		
		$released = pt_is_nav_launch_released( $order_x[$i], $pt_launch_mode );

		if ( $pt_launch_nav == 'noupcoming' ) {

			if ( $released ) {
				echo '<li id="post-' . $order_x[$i] . '" class="widget prelaunch_vid">';

				$title = ( $meta['title'] != '' ) ? $meta['title'] : get_the_title($order_x[$i]);

				echo '<h4><a href="' . get_permalink($order_x[$i]) . '">' . $title . '</a></h4>';

				echo '<div style="text-align:center;padding-bottom:10px;border-bottom:1px solid #E5E5E5;">';

				$thumb = ( $meta['thumb'] != '' )? $meta['thumb'] : PT_REL_IMAGES . '/prelaunch-vid.png';			

				echo '<a href="' . get_permalink($order_x[$i]) . '"><img src="' . get_bloginfo('template_directory') . '/thumb.php?src=' . pt_to_relative($thumb) . '&w=' . $width . '&h=' . $height . '&zc=1" border="0" /></a>';
			
				echo '</div>';
				echo '</li>';
			}
		} else {
			echo '<li id="post-' . $order_x[$i] . '" class="widget prelaunch_vid">';

			$title = ( $meta['title'] != '' ) ? $meta['title'] : get_the_title($order_x[$i]);
			if ( $released ) { 
				echo '<h4><a href="' . get_permalink($order_x[$i]) . '">' . $title . '</a></h4>';
			} else {
				echo '<h4 style="color:#ccc">' . $title . '</h4>';
			}

			echo '<div style="text-align:center;padding-bottom:10px;border-bottom:1px solid #E5E5E5;">';

			if ( $meta['thumb'] == '' ) {
				$thumb = ( $released )? PT_REL_IMAGES . '/prelaunch-vid.png' : PT_REL_IMAGES . '/prelaunch-coming.png';			
			} else {
				$thumb = $meta['thumb']; 
			}

			if ( $released ) {
				echo '<a href="' . get_permalink($order_x[$i]) . '"><img src="' . get_bloginfo('template_directory') . '/thumb.php?src=' . pt_to_relative($thumb) . '&w=' . $width . '&h=' . $height . '&zc=1" border="0" /></a>';
			
			} else {
				echo '<img src="' . get_bloginfo('template_directory') . '/thumb.php?src=' . pt_to_relative($thumb) . '&w=' . $width . '&h=' . $height . '&zc=1" border="0" style="opacity:0.4;filter:alpha(opacity=40);cursor:pointer" />';
				echo '<p style="margin:0; padding:5px 0; text-align:center"><small>Coming Soon</small></p>';
			}
		
			echo '</div>';
			echo '</li>';
		}
	}
	echo '</ul>';
	echo '</div>';
}

function pt_is_nav_launch_released( $post_id, $launchmode ) {
	
	if ( $launchmode == 'onetime' ) {
		$meta = get_post_meta($post_id, 'pt_launch_data', true);
		$now  = time();
			
		$hour = (int) $meta['hour'];
		$minute = (int) $meta['minute'];
		$month = (int) $meta['month'];
		$day   = (int) $meta['day'];
		$year = (int)$meta['year'];

		$rel  = mktime($hour, $minute, 0, $month, $day, $year);

		if ( $now < $rel ) {
			return false;
		} else {
			return true;
		}
	} else if ( $launchmode == 'evergreen' ) {
		global $post;
		if ( !pt_is_first_nav_launch_page( $post_id ) ) {
			$sequence = pt_check_nav_evergreen_sequence( $post_id );
			$before_seq = $sequence - 1;

			if ( isset( $_COOKIE['pt-evergreen-' . $before_seq] ) ) {
				$last_sequence = $_COOKIE['pt-evergreen-last-visit'];
				if ( $last_sequence >= $sequence ) {
					return true;
				} else {
					if ( $post_id == $post->ID ) {
						return true;
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
		} else {
			return true;
		}
	}
}

function pt_check_nav_evergreen_sequence( $post_id ) 
{
	global $pt_launch_pages;

	$pages = explode("|", $pt_launch_pages['order']);
	$sequence = array_search( $post_id, $pages );

	return $sequence;
}

function pt_is_first_nav_launch_page( $post_id )
{
	global $pt_launch_pages;

	$pages = explode("|", $pt_launch_pages['order']);
	$this_page = array_search( $post_id, $pages );

	if ( $this_page == 0 ) {
		return true;
	} else {
		return false;
	}
}

function pt_sidebar_widgets() {
?>
	<div id="landing-sidebar">
	<ul>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('landing page') ) : ?>
                	
 	<?php endif;?>
        </ul>
	</div>
<?php
}

function pt_sidebar_widgets2() {
?>
	<div id="landing-sidebar">
	<ul>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('landing page 2') ) : ?>
                	
 	<?php endif;?>
        </ul>
	</div>
<?php
}

function pt_sidebar_widgets3() {
?>
	<div id="landing-sidebar">
	<ul>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('landing page 3') ) : ?>
                	
 	<?php endif;?>
        </ul>
	</div>
<?php
}

function pt_addtocart( $post_id, $args, $num='') {
	$num = $num ? $num.'-' : '';
	
	$button   = $args['lp-order-'.$num.'addbtn'];
	$size     = $args['lp-order-'.$num.'addsize'];
	$orderurl = $args['lp-order-'.$num.'addurl'];
	$target   = $args['lp-order-'.$num.'addurl-target'];
	$arrow    = $args['lp-order-'.$num.'addarrow'];
	$timer    = $args['lp-order-'.$num.'addtimed'] * 1000;
	$htmlcode = stripslashes($args['lp-order-'.$num.'addcode']);

	$css = ( $timer > 0 ) ? ' style="display:none"' : '';

	if ( $size == 'big' ) {
		$img_btn = PT_REL_IMAGES . '/buttons/' . $button;
	} else if ( $size == 'medium' ) {
		$img_btn = get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/buttons/' . $button . '&w=330';
	} else if ( $size == 'small' ) {
		$img_btn = get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/buttons/' . $button . '&w=260';
	}
?>
	<div id="lp-<?php echo $num; ?>addtocart"<?php echo $css; ?>>
	<?php if ( $arrow == 'true' ) { ?>
	<p style="text-align:center"><img src="<?php echo PT_REL_IMAGES; ?>/arrows/arrow6-red.png" border="0" /></p>
	<?php } ?>
	<?php if ( $htmlcode == '' ) {?>
	<p style="text-align:center"><a href="<?php echo $orderurl; ?>" target="<?php echo $target; ?>"><img src="<?php echo $img_btn; ?>" border="0" /></a></p>
	<?php } else { echo $htmlcode; } ?>
	</div>

	<?php if ( $timer > 0 ) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		setTimeout(function(){ jQuery('#lp-<?php echo $num; ?>addtocart').fadeIn(); }, <?php echo $timer; ?>);
	});
	</script>	
	<?php } ?>
<?php
}

function pt_single_image( $post_id, $args, $num='') {
	$num = $num ? $num.'-' : '';
	
	$img    = $args['lp-image-'.$num.'url'];
	$align  = $args['lp-image-'.$num.'align'];
	$link   = $args['lp-image-'.$num.'link'];
	$target = $args['lp-image-'.$num.'link-target'];

	if ( $img != '' ) {

		$linkopen  = ( $link != '' ) ? '<a href="' . $link . '" target="' . $target . '">' : '';
		$linkclose = ( $link != '' ) ? '</a>' : '';
		$image     = '<img src="' . $img . '" border="0" />';

		echo '<p style="text-align:' . $align . '">' . $linkopen . $image . $linkclose . '<p>';
	}
}

function pt_minisite_script( $post_id, $args ) {
	$script = trim(stripslashes(addslashes($args['lp-script-code'])));

	if ( $script != '' ) {
		ob_start();
		eval('?>' . $script . '<?php ');
		$output = ob_get_contents();
		ob_end_clean();
		echo $output;
	}
}

function pt_render_layout( $post_id, $meta_name ) {

	$meta  = get_post_meta( $post_id, 'pt_landing_meta_box', true);
	$data  = pt_isset($meta[$meta_name]);
	
	if ( $data != 'clean' ) {
		$elements = explode("|", $data);
		
		foreach ( $elements as $element ) {

			$content = explode("/", $element);

			switch ( $content[0] ) {

				case 'lp-headline':
					pt_minisite_headline( $post_id, $meta );
				break;

				case 'lp-pre-headline':
					pt_minisite_pre_headline( $post_id, $meta );
				break;

				case 'lp-sub-headline':
					pt_minisite_sub_headline( $post_id, $meta );
				break;

				case 'lp-comments':
					pt_minisite_comments( $meta );
				break;

				case 'lp-content':
					pt_minisite_content();
				break;

				case 'lp-video':
					pt_minisite_video( $post_id, $meta );
				break;

				case 'lp-svideo':
					pt_minisite_simple_video( $post_id, $meta );
				break;
				
				case 'lp-video-2':
					pt_minisite_video( $post_id, $meta, 2);
				break;

				case 'lp-svideo-2':
					pt_minisite_simple_video( $post_id, $meta, 2);
				break;

				case 'lp-optin':
					pt_minisite_optin( $post_id, $meta, 1 );
				break;

				case 'lp-optin-2':
					pt_minisite_optin( $post_id, $meta, 2 );
				break;

				case 'lp-warning':
					pt_minisite_warning( $post_id, $meta );
				break;

				case 'lp-fake-video':
					pt_minisite_fakevid( $post_id, $meta );
				break;

				case 'lp-social':
					pt_social_button( $post_id, $meta );
				break;
	
				case 'lp-sidebar':
					pt_sidebar_widgets();
				break;

				case 'lp-sidebar-2':
					pt_sidebar_widgets2();
				break;

				case 'lp-sidebar-3':
					pt_sidebar_widgets3();
				break;

				case 'lp-order':
					pt_addtocart( $post_id, $meta );
				break;

				case 'lp-image':
					pt_single_image( $post_id, $meta );
				break;
				
				case 'lp-order-2':
					pt_addtocart( $post_id, $meta, 2);
				break;

				case 'lp-image-2':
					pt_single_image( $post_id, $meta, 2);
				break;

				case 'lp-funnel':
					pt_launch_funnel( $post_id, $meta );
				break;

				case 'lp-register':
					pt_minisite_free_register( $post_id, $meta );
				break;

				case 'lp-script':
					pt_minisite_script( $post_id, $meta );
				break;
			}
		}
	}	
}

