<?php

function pt_membership_framework( $member_page )
{
	global $post, $design_options, $site_options, $option_key,
	$pt_layout_setup, $pt_integrate_membership;
 
	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value'];
	}

	if ( file_exists( PT_SKINS . '/' . $pt_member_theme['skins'] . '/layout.php' ) ) {
		require_once( PT_SKINS . '/' . $pt_member_theme['skins'] . '/layout.php' );
	}
	
	pt_remove_filter('the_content');
	pt_membership_open();

	if ( $pt_layout_setup['header'] == 'fluid' ) {
		if ( $pt_layout_setup['topnavpos'] == 'beforeheader' ) {
			pt_membership_before_header( $pt_layout_setup['header'] );
		}

		pt_membership_header( $pt_layout_setup['header'] );

		if ( $pt_layout_setup['topnavpos'] == 'afterheader' ) {
			pt_membership_before_header( $pt_layout_setup['header'] );
		}

		pt_membership_after_header( $pt_layout_setup['header'], $member_page );
	}

	echo '<div id="wrapper">' . "\n";

	if ( $pt_layout_setup['header'] == 'fixed' ) {
		if ( $pt_layout_setup['topnavpos'] == 'beforeheader' ) {
			pt_membership_before_header( $pt_layout_setup['header'] );
		}

		pt_membership_header( $pt_layout_setup['header'] );

		if ( $pt_layout_setup['topnavpos'] == 'afterheader' ) {
			pt_membership_before_header( $pt_layout_setup['header'] );
		}

		pt_membership_after_header( $pt_layout_setup['header'], $member_page );
	}

	echo '<div id="mainarea"><div style="clear:both"></div>';

	if ( $pt_member_sidebar_pos == 'right' ) {
		if ( $member_page == 'login' ) {
			pt_membership_login();
		} else if ( $member_page == 'account' ) {
			pt_membership_account();
		} else {
			pt_membership_content( $member_page );
		}
		pt_sidebar( 'membership', $member_page );
	} else {
		pt_sidebar( 'membership', $member_page );	
		if ( $member_page == 'login' ) {
			pt_membership_login();
		} else if ( $member_page == 'account' ) {
			pt_membership_account();
		} else {
			pt_membership_content( $member_page );
		}
	}

	echo '<div id="clr"></div>' . "\n";
	echo '</div>';
		
	if ( $pt_layout_setup['footer'] == 'fixed' ) {
		pt_footer( $pt_layout_setup['footer'] );
	}

	echo '</div>';

	if ( $pt_layout_setup['footer'] == 'fluid' ) {
		pt_footer( $pt_layout_setup['footer'] );
	}

	pt_document_close();

}

function pt_membership_user() {
	global $current_user, $pt_integrate_membership, $pt_member_login_page, $pt_member_logout_redirect;

	if ( $pt_integrate_membership != 'dap' ) {
		if ( is_user_logged_in() ) {

			$logout     = ( $pt_member_logout_redirect != '' ) ? $pt_member_logout_redirect : get_bloginfo('wpurl');
			$logout_url = ( $pt_integrate_membership == 'pt' ) ? get_permalink( $logout ) . '?msg=You_have_been_logged_out' : '';
			echo '<div class="member-info">';
			echo '<div class="member-avatar">' . get_avatar($current_user->user_email, $size='62', $default='' ) . '</div>';
			echo '<strong>Hi, ' . $current_user->user_firstname . ' ' . $current_user->user_lastname . '!</strong>';

			echo '<p><a href="' . wp_logout_url( $logout_url) . '">Logout</a></p>';
			echo '<div style="clear:both"></div>';
			echo '</div>';
		}
	} 
}

function pt_membership_menu( $post_id, $post_parent, $member_page ) 
{	
	global $pt_integrate_membership, $current_user, $pt_member_sidebar_text;

	$thisID = $post_id;
	
	if ( $thisID != 0 ) {
		$menu_label = trim($pt_member_sidebar_text);

		echo '<ul id="member-menu">';
		echo '<li class="member-menu-head">' . $menu_label . '</li>';
	
		if ( $member_page == 'content' ) {
			if ( $thisID != $post_parent ) {	
				query_posts( 'posts_per_page=999&post_type=page&orderby=menu_order&order=ASC&post_parent=' . $post_parent );
			} else {
				query_posts( 'posts_per_page=999&post_type=page&orderby=menu_order&order=ASC&post_parent=' . $thisID );
			}
		} else {
			query_posts( 'posts_per_page=999&post_type=page&orderby=menu_order&order=ASC&post_parent=' . $thisID );
		}

		if ( have_posts() ) : while ( have_posts() ) : the_post();

			$this_title = get_the_title();
			if ( $this_title != '' ) {
				$t_meta = get_post_meta( get_the_ID(), 'pt_member_meta_box', true );
				echo '<li><a href="' . get_permalink() . '">' . $this_title . '</a></li>';
			
			}

		endwhile; endif;
		wp_reset_query();
		if ( $member_page != 'home' ) {
			echo '<li ><a href="' . get_permalink( $post_parent ) . '"><strong>Back to ' . get_the_title( $post_parent ) . '</strong></a></li>';
		}
		echo '</ul>';
	} else {
		if ( $pt_integrate_membership == 'dap' ) {

			if ( class_exists( 'Dap_Session' ) ) {
				if ( Dap_Session::isLoggedIn() ) {
					echo '<div class="member-sidebar-text">';
					echo '<h3>Please Wait...</h3>';
					echo '<p>The content is not yet available for you. We\'ll let you know if the content is ready.</p>'; 
					echo '</div>';
				} else {
					echo '<div class="member-sidebar-text">';
					echo '<h3>Members Only Content</h3>';
					echo '<p>Please login if you\'re already a member.</p>'; 
					echo '</div>';
				}
			}
		} 

			
	}
}

function pt_membership_sidebar_text( $post_id ) {

	$meta = get_post_meta( $post_id, 'pt_member_meta_box', true );
	
	if ( pt_isset($meta['member-sidebar-text']) != '' || pt_isset($meta['member-sidebar-title']) != '' ) {
		echo '<div class="member-sidebar-text">';
		if ( $meta['member-sidebar-title'] != '' ) { echo '<h3>' . $meta['member-sidebar-title'] . '</h3>'; }
		if ( $meta['member-sidebar-text'] != '' ) {

			pt_membership_thumbnail( $post_id, 'sidebar' );
			echo '<p>' . $meta['member-sidebar-text'] . '</p>'; 
		}
		echo '</div>';
	} else {
		echo '<p style="margin-top:0;margin-bottom:0;padding-top:0;padding-bottom:0">&nbsp;</p>';
	}

}

function pt_membership_login()
{
	global $post, $pt_integrate_membership, $pt_member_login_redirect;

	$meta = get_post_meta( $post->ID, 'pt_member_meta_box', true );
	$member_title = pt_isset($meta['member-title']) != '' ? pt_isset($meta['member-title']) : get_the_title( $post->ID );

	$ulabel = 'Username';

	$wl = get_option('WishListMemberOptions');
	$wl_after_login = ( $wl['after_login'] != '' ) ? $wl['after_login'] : get_permalink($wl['after_login_internal']);
 
	$members_home   = ( $pt_member_login_redirect != '' ) ? get_permalink($pt_member_login_redirect) : get_bloginfo('siteurl');
	$redirect_url   = ( $pt_integrate_membership == 'wishlist' ) ? $wl_after_login : $members_home;
	$login_redirect = ( isset($_GET['redirect']) ) ? get_permalink( $_GET['redirect'] ) : $redirect_url;

	$args = array(
			'redirect' => $login_redirect,
			'label_username' => $ulabel,
		);

	echo '<div id="main-column">';
	if ( have_posts() ) {
		$i = 0;
		while ( have_posts() ) : the_post(); $i++;
?>
			<div class="post" id="post-<?php the_ID(); ?>" style="border:none">

        	        	<div class="entry">
<?php								
				echo '<h2 class="postitle">' . $member_title . '</h2>';

				if ( isset( $_GET['msg'] ) ) { echo '<div class="member-register-success"><p>' . str_replace("_", " ", $_GET['msg']) . '</p></div>'; }
				if ( isset( $_GET['errormsg'] ) ) { echo '<div class="member-register-error"><p>' . str_replace("_", " ", $_GET['errormsg']) . '</p></div>'; } 				
				
				pt_post_content();

				if ( !is_user_logged_in() ) {
					wp_login_form( $args );

					echo '<div style="clear:both;height:30px"></div>';
					echo '<a href="' . wp_lostpassword_url( get_permalink() ) . '" title="Lost Password">Forgot Your Password?</a>';
				} else {
					echo 'You are already logged in. <a href="' . $redirect_url . '">Click here</a> to continue to Members Page.';
				}

				echo '</div>';				
			echo '</div>'."\n\n";
		
		endwhile;
			
	}

	echo '<div style="height:50px"></div>';
	echo '</div>';
}

function pt_membership_account()
{
	global $current_user, $post, $pt_integrate_membership;

	$member_title = $meta['member-title'] != '' ? $meta['member-title'] : get_the_title( $post->ID );

	echo '<div id="main-column">';
	if ( have_posts() ) {
		$i = 0;
		while ( have_posts() ) : the_post(); $i++;
?>
			<div class="post" id="post-<?php the_ID(); ?>" style="border:none">

        	        	<div class="entry">
<?php								
				echo '<h2 class="postitle">' . $member_title . '</h2>';

				if ( isset( $_GET['msg'] ) ) { echo '<div class="member-register-success"><p>' . str_replace("_", " ", $_GET['msg']) . '</p></div>'; }
				if ( isset( $_GET['errormsg'] ) ) { echo '<div class="member-register-error"><p>' . str_replace("_", " ", $_GET['errormsg']) . '</p></div>'; }

 				pt_post_content();

				if ( is_user_logged_in() ) {
					echo '
					<form name="pt-update-user" id="pt-update-user" method="post" action="' . get_bloginfo('wpurl') . '/?mode=membership&process=update_user">
					<table class="pt-form-table">
					<tr>
						<th><label for="user_login">Username</label></th>
						<td><input type="text" name="user_login" id="user_login" value="' . $current_user->user_login . '" disabled="disabled" class="pt-regular-text" /> <span class="pt-description">Username cannot be changed.</span></td>
					</tr>
					<tr>
						<th><label for="user_email">Email</label></th>
						<td><input type="text" name="user_email" id="user_email" value="' . $current_user->user_email . '" class="pt-regular-text" /></td>
					</tr>
					<tr>
						<th><label for="first_name">First Name</label></th>
						<td><input type="text" name="first_name" id="first_name" value="' . $current_user->first_name . '" class="pt-regular-text" /></td>
					</tr>
					<tr>
						<th><label for="last_name">Last Name</label></th>
						<td><input type="text" name="last_name" id="last_name" value="' . $current_user->last_name . '" class="pt-regular-text" /></td>
					</tr>
					</table>
				
					<h4 style="margin-top:10px">Change Password</h4>
					<p class="pt-description">If you would like to change the password type a new one. Otherwise leave these blank.</p>
					<table class="pt-form-table">
					<tr>
						<th><label for="user_login">New Password</label></th>
						<td><input type="password" name="pass1" id="pass1" class="pt-regular-text" /> </td>
					</tr>
					<tr>
						<th><label for="user_email">Retype Password</label></th>
						<td><input type="password" name="pass2" id="pass2" class="pt-regular-text" /></td>
					</tr>
					<tr>
						<td colspan="2" style="padding:15px 0"><input type="submit" name="submit" id="submit" value="Update Account" class="button-primary" /></td>
					</tr>
					</table>

					<input type="hidden" name="user_id" id="user_id" value="' . $current_user->ID . '" />
					<input type="hidden" name="redirect_url" id="redirect_url" value="' . get_permalink($post->ID) . '" />
					</form>
					';

				} else {
					echo 'You have to login first to be able to view this page.';
				}

				echo '</div>';				
			echo '</div>'."\n\n";
		
		endwhile;
			
	}

	echo '<div style="height:50px"></div>';
	echo '</div>';
}

function pt_membership_content( $member_page )
{
	global $post, $design_options, $site_options, $current_user, $pt_integrate_membership;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	$meta = get_post_meta($post->ID, 'pt_member_meta_box', true);
	$member_title = $meta['member-title'] != '' ? $meta['member-title'] : get_the_title( $post->ID );

	echo '<div id="main-column">';
	if ( have_posts() ) {
		$i = 0;
		while ( have_posts() ) : the_post(); $i++;
?>
			<div class="post" id="post-<?php the_ID(); ?>">

        	        	<div class="entry">
<?php								
				echo '<h2 class="postitle">' . $member_title . '</h2>';

				pt_membership_video( $post->ID );
				pt_post_content();

				echo '</div>';

				
				pt_post_metadata();

			echo '</div>'."\n\n";
		
		endwhile;
	}

	if ( $member_page == 'home' ) {
		
		if ( is_array($meta['member-home-feature']) ) {		
			$member_cats = get_posts( array(
				'post__in' => $meta['member-home-feature'],
				'post_type' => 'page',
				'orderby' => $meta['member-home-feature-sortby'],
				'order' => $meta['member-home-feature-sort'],
				'numberposts' => 9999
			));
			
			foreach ( $member_cats as $cats ) {				
				if ( in_array($cats->ID, $meta['member-home-feature']) ) :
					echo '<div class="post">';
					echo '<div class="entry">';
					echo '<h3 class="postitle">' . $cats->post_title . ' (<a href="' . get_permalink($cats->ID) . '">view all</a>)</h3>';
					query_posts( 'posts_per_page=' . $meta['member-home-feature-limit'] . '&post_type=page&post_status=publish&orderby=menu_order&order=ASC&post_parent=' . $cats->ID );
					if ( have_posts() ) :
						echo '<ul>';
						while ( have_posts() ) : the_post();
					
							$hl_meta = get_post_meta ( get_the_ID(), 'pt_member_meta_box', true );
							$hl_title = $hl_meta['member-title'] != '' ? $hl_meta['member-title'] : get_the_title();
							echo '<li><a href="' . get_permalink() . '">' . $hl_title . '</a>';
									
						endwhile;
						echo '</ul>';
					endif;
					wp_reset_query();
					echo '</div>';
					echo '</div>'; 
				endif;
			}
		}

	} else if ( $member_page == 'category' ) {
		if ( $post->ID > 0 ) {
		    	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts( 'posts_per_page=10&post_type=page&post_status=publish&orderby=menu_order&order=ASC&post_parent=' . $post->ID . '&paged=' . $paged );
			if ( have_posts() ) : while ( have_posts() ) : the_post();
			
				if ( get_the_title() != '' ) {
					$set = get_post_meta( get_the_ID(), 'pt_member_meta_box', true );

					echo '<div class="post">';
					echo '<div class="entry">';
	
					pt_membership_thumbnail( get_the_ID(), 'list' );
					$cat_title = $set['member-title'] != '' ? $set['member-title'] : get_the_title();

					echo '<h3 class="postitle" style="margin-top:0;padding-top:0;font-size:18px"><a href="' . get_permalink() . '">' . $cat_title . '</a></h3>';
							
					
					if ( $set['member-disable-comments'] == 'false' ) { echo '<div class="post-bylines">' . comments_popup_link('No Comments', '1 Comment', '% Comments') . '</div>'; }

					echo '<br style="clear:both" />';
					echo '</div>';
					echo '</div>';
						
				}

			endwhile; 
			pt_pagination();
			endif;
			wp_reset_query();
		}

	} else if ( $member_page == 'content' ) {
		pt_membership_downloads( $post->ID );
	}

	if ( $meta['member-disable-comments'] == 'false' ) {
		
		if ( $member_page != 'login' ) {
			if ( $post->ID > 0 ) {
?>
				<div class="post-comments"><?php comments_template();?></div>
<?php
			}
		}
	} 

	echo '<div style="height:120px"></div>';
	echo '</div>';
	
}

function pt_membership_downloads( $post_id ) 
{
	$meta   = get_post_meta($post_id, 'pt_member_meta_box', true);
	$files  = $meta['member-content-download'];
	if ( count($files) > 0 ) {
		
		echo '<div class="member-downloads">';
		echo '<div class="downloads-icon"></div>';

		$i = 0;
		foreach ( $files as $file ) {
			if ( $i%2 ) {
				$align = '-right';
			} else {
				$align = '-left';
			}

			echo '<div class="download-item' . $align . '">';
			echo '<a href="' . $file['url'] . '" class="member-' . $file['type'] . '" rel="nofollow">' . $file['text'] . '</a>';
			echo '</div>';

			$i++;
		}
		echo '<div style="clear:both"></div>';
		echo '</div>';
	}
}

function pt_membership_thumbnail( $post_id, $type = 'list' ) {

	$meta   = get_post_meta($post_id, 'pt_member_meta_box', true);
	$thumb  = $meta['member-page-icon'];

	if ( $thumb != '' ) {
		if ( $type == 'list' ) {
			echo '<a href="' . get_permalink($post_id) . '" title="' . get_the_title($post_id) . '">';
			echo '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/icons/' . $thumb . '&w=80&zc=1" border="0" style="float:left;margin-right:15px;border:none;" />';
			echo '</a>';
		} else if ( $type == 'sidebar' ) {
			echo '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/icons/' . $thumb . '&w=60&zc=1" border="0" style="float:left;margin-top:10px;margin-right:15px;border:none;" />';
		}
	}
}

function pt_membership_video( $post_id )
{
	$meta = get_post_meta( $post_id, 'pt_member_meta_box', true );

	$video_player = $meta['member-video-player'];
	$video_code   = $meta['member-video-code'];

	if ( $video_code != '' ) {
		echo '<div style="text-align:center; margin:0 auto; padding:10px 0;">' . stripslashes( $video_code ) . '</div>';
	} else {
		if ( $video_player == 'flow' ) {
			pt_membership_flowplayer_video( $post_id );
		} else if ( $video_player == 'jw' ) {
			pt_membership_jwplayer_video( $post_id );
		} else if ( $video_player == 'html5' ) {
			pt_membership_html5_video( $post_id );
		}
	}

}

function pt_membership_jwplayer_video( $post_id ) 
{
	$meta         = get_post_meta( $post_id, 'pt_member_meta_box', true );
	
	$video_url    = $meta['member-video-url'];
	$video_width  = $meta['member-video-width'];
	$video_height = $meta['member-video-height'];
	$video_auto   = $meta['member-video-play'];
	$video_ctrl   = $meta['member-video-ctrl'];

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
		<div id="jw-video-container" style="margin:0; padding:0" class="pt-video-shad">
		<div id="myElement">Loading the player ...</div>
		<script type="text/javascript">
		    jwplayer("myElement").setup({
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

		if ( $args['lp-video-download'] == 'true' ) {
			echo '<div style="margin:3px 0 15px 0;text-align:center"><small><strong><a href="' . $args['lp-video-url'] . '">Click here</a> to download the video</strong></small></div>';
		}
	}
}

function pt_membership_flowplayer_video( $post_id )
{
	$meta         = get_post_meta( $post_id, 'pt_member_meta_box', true );
	
	$video_url    = $meta['member-video-url'];
	$video_width  = $meta['member-video-width'];
	$video_height = $meta['member-video-height'];
	$video_auto   = $meta['member-video-play'];
	$video_ctrl   = $meta['member-video-ctrl'];

	$autoplay     = ($video_auto == 'true') ? 'true' : 'false';
	$ctrl_hide    = ($video_ctrl != 'true') ? 'false' : 'true';	

	if ( $video_url != '') {
		echo '<script type="text/javascript" src="http://releases.flowplayer.org/js/flowplayer-3.2.12.min.js"></script>' . "\n";
		echo '<script type="text/javascript" src="http://releases.flowplayer.org/js/flowplayer.ipad-3.2.12.js"></script>' . "\n";
		echo '<div style="position:relative; display:block; margin:0 auto; padding:20px 0; width:' . $video_width . 'px; height:' . $video_height . 'px;" id="player"></div>' . "\n\n"; 

		if ( pt_isset($args['lp-video-download']) == 'true' ) {
			echo '<div style="margin-top:-15px;margin-bottom:15px;text-align:center"><small><strong><a href="' . $args['lp-video-url'] . '">Click here</a> to download the video</strong></small></div>';
		}
		
		echo '
		<script type="text/javascript">
			$f("player", "http://releases.flowplayer.org/swf/flowplayer-3.2.16.swf", {
				
				playlist: [
					
					{
						url: "' . $video_url . '",
						scaling: "scale",
						autoPlay: ' . $autoplay . ',
						autoBuffering: true
					}
				],

				plugins: {
					controls: { 
						autoHide: ' .$ctrl_hide . ' 
					}
				}
			}).ipad();
		</script>
		';
	}
}

function pt_membership_html5_video( $post_id )
{
	$args         = get_post_meta( $post_id, 'pt_member_meta_box', true );

	$video_mp4           = $args['member-video-html5-mp4'];
	$video_ogg           = $args['member-video-html5-ogg'];
	$video_webm          = $args['member-video-html5-webm'];
	$video_width         = $args['member-video-width'];
	$video_height        = $args['member-video-height'];
	$video_auto          = $args['member-video-play'];

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
		$controls   = ( $video_ctrl_disable = 'true' ) ? ' controls="controls" ' : '';
		$fl_auto    = ( $video_auto == 'true' ) ? 'true' : 'false';
		$btn_height = $video_height - 30;

		$flashvars  = "config=";
		$flashvars .= "{'playlist': [";
		$flashvars .= ( $video_img != '' ) ? "'" . htmlentities($video_img) . "',{'url':'" . htmlentities($video_mp4) . "','scaling':'scale','autoPlay':" . $fl_auto . ",'autoBuffering':true}" : "{'url':'" . htmlentities($video_mp4) . "','scaling':'scale','autoPlay':" . $fl_auto . ",'autoBuffering':true}";
		$flashvars .= ']},';
		//$flashvars .= ( $video_ctrl_disable == 'true' ) ? "'plugins':{'controls':null}" : "'plugins':{'controls':{'autoHide':" . $ctrl_hide . "}}";
?>	
		<!-- HTML5 Video Start -->
		<div style="position:relative; width:<?php echo $video_width; ?>px; height:<?php echo $video_height; ?>px; margin:10px auto 0 auto; padding:0">
		<video id="html5video"<?php echo $controls; ?><?php echo $autoplay; ?>width="<?php echo $video_width; ?>" height="<?php echo $video_height; ?>" style="background:#000" >
			<?php if ( $video_mp4 != '' ) { ?>
			<source src="<?php echo $video_mp4; ?>" type="video/mp4" />
			<?php } ?>
			<?php if ( !$is_android && !$is_iOS ) { ?>
			<?php if ( $video_webm != '' ) { ?>
			<source src="<?php echo $video_webm; ?>" type="video/webm; codecs=vp8,vorbis" />
			<?php } ?>
			<?php if ( $video_ogg != '' ) { ?>
			<source src="<?php echo $video_ogg; ?>" type="video/ogg; codecs=theora,vorbis" />
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

		<script type="text/javascript">
		jQuery(document).ready(function(){

			<?php if ( $is_iOS || $is_android ) { ?>
			jQuery("#html5video")[0].load();
			<?php } ?>

			jQuery("#html5video").click(function(){
				if ( jQuery(this)[0].paused ) {
					jQuery(this)[0].play();
				} else {
					jQuery(this)[0].pause();
				}
			});
		});
		</script>
		<!-- HTML5 Video End -->
<?php
	}
}