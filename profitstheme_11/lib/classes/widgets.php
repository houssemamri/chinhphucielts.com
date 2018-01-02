<?php

/**
 * Optin Widget class
 *
 */

class Pt_Sidebar_Optin extends WP_Widget {

	function Pt_Sidebar_Optin() {
		$instance = array('description' => 'Use this widget to add an optin form on your sidebar.' );
		parent::WP_Widget(false, 'PT - Sidebar Optin', $instance);      
	}

	function widget($args, $instance) {  
		extract($args);
		
		$title    = pt_isset($instance['title']);
		$optinclr = pt_isset($instance['optinclr']);
		$resp     = pt_isset($instance['resp']);
		$text     = pt_isset($instance['text']);
		$ecover   = pt_isset($instance['ecover']);
		$nametxt  = pt_isset($instance['nametxt']);
		$emailtxt = pt_isset($instance['emailtxt']);
		$btnclr   = pt_isset($instance['btnclr']);
		$btntxt   = pt_isset($instance['btntxt']);
		$dsctxt   = pt_isset($instance['dsctxt']);

		preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $resp ), $form);
		preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $resp ), $form2);
		preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $resp ), $hiddens);
		preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $resp ), $fields);

        	echo '<li id="' . $args['widget_id'] . '" class="widget sidebar_optin ' . $optinclr . '" style="margin-bottom:10px">';

		if ( $title != '' ) echo '<h3>' . $title . '</h3>';
		if ( $ecover != '' ) echo '<div style="text-align:center;margin:10px 0;"><img src="' . $ecover . '" border="0" /></div>';
		if ( $text != '' ) echo '<p style="text-align:center">' . $text . '</p>';

		$form_field = ( $form[0][0] != '' ) ? $form[0][0] : '<form action="' . $form2[1] . '" method="post">';

		echo "\n\n" . $form_field . "\n";

		echo '<div class="sidebar_optin_area">' . "\n";
		$sidebar_fields = pt_extract_fields($fields, $nametxt, $emailtxt, 'sidebar_optin_field');

		if ( $sidebar_fields ) {
			foreach ( $sidebar_fields as $sidebar_field ) {
				echo $sidebar_field . "\n";
			}
		}

		echo '<div style="text-align:center"><input type="submit" name="submit" value="' . $btntxt . '" class="sidebar-button-' . $btnclr . '" /></div>' . "\n";
		
		echo '<p class="sidebar_optin_dsc">' . $dsctxt . '</p>' . "\n";
		echo '</div>' . "\n";

		if ( $hiddens[0] ) {
			foreach ( $hiddens[0] as $hidden ) {
				echo $hidden . "\n";
			}
		}
	
		echo '</form>' . "\n";
		echo '</li>';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form( $instance ) {    
		$title    = ( pt_isset($instance['title']) != '' ) ? esc_attr( $instance['title'] ) : 'Free Gift!';
		$optinclr = esc_attr( pt_isset($instance['optinclr']) );
		$resp     = esc_attr( pt_isset($instance['resp']) );
		$text     = ( pt_isset($instance['text']) != '' ) ? esc_attr( $instance['text'] ) : 'Simply enter your information below to get INSTANT ACCESS today:';
		$ecover   = esc_attr( pt_isset($instance['ecover']) );
		$nametxt  = ( pt_isset($instance['nametxt']) != '' ) ? esc_attr( $instance['nametxt'] ) : 'Enter your name...';
		$emailtxt = ( pt_isset($instance['emailtxt']) != '' ) ? esc_attr( $instance['emailtxt'] ) : 'Enter your email...';
		$btnclr   = esc_attr( pt_isset($instance['btnclr']) );
		$btntxt   = esc_attr( pt_isset($instance['btntxt']) );
		$dsctxt   = ( pt_isset($instance['dsctxt']) != '' ) ? esc_attr( $instance['dsctxt'] ) : 'Your privacy is SAFE with us and will never be sold, rented, or released to anyone - EVER!';

		echo '
		<p>
            	<label for="' . $this->get_field_id('optinclr') . '">Color Scheme:</label>
            	<select name="' . $this->get_field_name('optinclr') . '" id="' . $this->get_field_id('optinclr') . '" class="widefat">
		';

		$colors = array('' => 'White', 'optin-black' => 'Black', 'optin-blue' => 'Blue', 'optin-green' => 'Green', 'optin-grey' => 'Grey', 'optin-orange' => 'Orange', 'optin-pink' => 'Pink', 'optin-red' => 'Red', 'optin-yellow' => 'Yellow');
		foreach ( $colors as $color => $option ) {
			$selected = $optinclr == $color ? ' selected="selected"' : '';
			echo '<option value="' . $color . '"' . $selected . '>' . $option . '</option>';
		}
		
		echo '
		</select>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('title') . '">Headline:</label>
            	<input type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '" class="widefat" id="' . $this->get_field_id('title') . '" />
        	</p>

		<p>
            	<label for="' . $this->get_field_id('resp') . '">Paste Autoresponder Code Here:</label>
            	<textarea name="' . $this->get_field_name('resp') . '" class="widefat" id="' . $this->get_field_id('resp') . '">' . $resp . '</textarea>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('ecover') . '">Image/Ecover URL (optional):</label>
            	<input type="text" name="' . $this->get_field_name('ecover') . '" value="' . $ecover . '" class="widefat" id="' . $this->get_field_id('ecover') . '" />
        	</p>

		<p>
            	<label for="' . $this->get_field_id('text') . '">Text:</label>
            	<textarea name="' . $this->get_field_name('text') . '" class="widefat" id="' . $this->get_field_id('text') . '">' . $text . '</textarea>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('nametxt') . '">Field Name Text:</label>
            	<input type="text" name="' . $this->get_field_name('nametxt') . '" value="' . $nametxt . '" class="widefat" id="' . $this->get_field_id('nametxt') . '" />
        	</p>

		<p>
            	<label for="' . $this->get_field_id('emailtxt') . '">Field Email Text:</label>
            	<input type="text" name="' . $this->get_field_name('emailtxt') . '" value="' . $emailtxt . '" class="widefat" id="' . $this->get_field_id('emailtxt') . '" />
        	</p>

		<p>
            	<label for="' . $this->get_field_id('btnclr') . '">Button Color:</label>
            	<select name="' . $this->get_field_name('btnclr') . '" id="' . $this->get_field_id('btnclr') . '" class="widefat">
		';

		$colors = array('orange' => 'Orange', 'green' => 'Green', 'blue' => 'Blue', 'black' => 'Black', 'red' => 'Red' );
		foreach ( $colors as $color => $option ) {
			$selected = $btnclr == $color ? ' selected="selected"' : '';
			echo '<option value="' . $color . '"' . $selected . '>' . $option . '</option>';
		}
		
		echo '
		</select>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('btntxt') . '">Button Text:</label>
            	<input type="text" name="' . $this->get_field_name('btntxt') . '" value="' . $btntxt . '" class="widefat" id="' . $this->get_field_id('btntxt') . '" />
        	</p>

		<p>
            	<label for="' . $this->get_field_id('dsctxt') . '">Disclaimer Text:</label>
            	<textarea name="' . $this->get_field_name('dsctxt') . '" class="widefat" id="' . $this->get_field_id('dsctxt') . '">' . $dsctxt . '</textarea>
        	</p>
		';
	}
}

/**
 * Sidebar Ad Widget class
 *
 */

class Pt_Sidebar_Ad extends WP_Widget {

	function Pt_Sidebar_Ad() {
		$instance = array('description' => 'Use this widget to add any type of Ad on your sidebar.' );
		parent::WP_Widget(false, 'PT - Sidebar Ad Widget', $instance);      
	}

	function widget($args, $instance) {  
		extract($args);
		
		$title = pt_isset($instance['title']);
		$adcode = pt_isset($instance['adcode']);
		$image = pt_isset($instance['image']);
		$url = pt_isset($instance['url']);

        	echo '<li id="' . $args['widget_id'] . '" class="widget sidebar_ad">';

		if ( $title != '' ) echo '<h2>' . $title . '</h2>';
		if ( $adcode != '' ) {
			echo stripslashes( $adcode );
		} else {
			echo '<a href="' . $url . '" target="_blank"><img src="' . $image . '" alt="' . $title . '" /></a>';
		}
		
		echo '</li>';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form( $instance ) {    
		$title = esc_attr( pt_isset($instance['title']) );
		$adcode = esc_attr( pt_isset($instance['adcode']) );
		$image = esc_attr( pt_isset($instance['image']) );
		$url = esc_attr( pt_isset($instance['url']) );

		echo '
       	 	<p>
            	<label for="' . $this->get_field_id('title') . '">Title (optional):</label>
            	<input type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '" class="widefat" id="' . $this->get_field_id('title') . '" />
        	</p>
		<p>
            	<label for="' . $this->get_field_id('adcode') . '">HTML/Javascript Code:</label>
            	<textarea name="' . $this->get_field_name('adcode') . '" class="widefat" id="' . $this->get_field_id('adcode') . '">' . $adcode . '</textarea>
        	</p>
        	<p><strong>or</strong></p>
        	<p>
            	<label for="' . $this->get_field_id('image') . '">Banner Image Url:</label>
            	<input type="text" name="' . $this->get_field_name('image') . '" value="' . $image . '" class="widefat" id="' . $this->get_field_id('image') . '" />
        	</p>
        	<p>
            	<label for="' . $this->get_field_id('url') . '">Banner Destination URL:</label>
            	<input type="text" name="' . $this->get_field_name('url') . '" value="' . $url . '" class="widefat" id="' . $this->get_field_id('url') . '" />
        	</p>
        	';

	}
}

/**
 * Sidebar Tab Lists Widget class
 *
 */

class Pt_Tab_Lists extends WP_Widget {

	function Pt_Tab_Lists() {
		$instance = array('description' => 'Use this widget to list popular & recent posts, recent comments, and most used tags.' );
		parent::WP_Widget(false, 'PT - Tab Lists', $instance); 
	}

	function widget($args, $instance) {  
		extract($args);
		
		$title1  = pt_isset($instance['title1']);
		$title2  = pt_isset($instance['title2']);
		$title3  = pt_isset($instance['title3']);
		$title4  = pt_isset($instance['title4']);
		$tab1    = pt_isset($instance['tab1']);
		$tab2    = pt_isset($instance['tab2']);
		$tab3    = pt_isset($instance['tab3']);
		$tab4    = pt_isset($instance['tab4']);
		$listnum = pt_isset($instance['listnum']);

        	echo '<li id="' . $args['widget_id'] . '" class="widget tab-lists">';

		$titles = array($title1, $title2, $title3, $title4);
		$lists  = array($tab1, $tab2, $tab3, $tab4);

		echo '<div id="pt-tab-content-' .$args['widget_id'] . '">';
		pt_list_title( $titles, $lists, $args['widget_id'] );
		echo '</div>';

		echo '<div class="tab-lists-contents">';
		pt_tab_lists( $tab1, $listnum, 0, $args['widget_id'] );
		pt_tab_lists( $tab2, $listnum, 1, $args['widget_id'] );
		pt_tab_lists( $tab3, $listnum, 2, $args['widget_id'] );
		pt_tab_lists( $tab4, $listnum, 3, $args['widget_id'] );
		echo '</div>';

		echo '
			<script type="text/javascript">
			var pttabs = new ddtabcontent("pt-tab-content-' .$args['widget_id'] . '");
			pttabs.setpersist(false);
			pttabs.setselectedClassTarget("link");
			pttabs.init();

			jQuery(document).ready(function(){
				jQuery(".tab-titles li:first a").addClass("tab-selected");
				jQuery(".tab-titles li a").each(function(){
					jQuery(this).click(function(){
						jQuery(this).parent().parent().find("a").removeClass("tab-selected");
						jQuery(this).addClass("tab-selected");
					});
				});
			});
			</script>
		'; 
		echo '</li>';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form( $instance ) {    
		$title1  = esc_attr( pt_isset($instance['title1']) );
		$title2  = esc_attr( pt_isset($instance['title2']) );
		$title3  = esc_attr( pt_isset($instance['title3']) );
		$title4  = esc_attr( pt_isset($instance['title4']) );
		$tab1    = ( pt_isset($instance['tab1']) != '' ) ? esc_attr( $instance['tab1'] ) : 'popular';
		$tab2    = ( pt_isset($instance['tab2']) != '' ) ? esc_attr( $instance['tab2'] ) : 'recent';
		$tab3    = ( pt_isset($instance['tab3']) != '' ) ? esc_attr( $instance['tab3'] ) : 'comments';
		$tab4    = ( pt_isset($instance['tab4']) != '' ) ? esc_attr( $instance['tab4'] ) : 'tags';
		$listnum = ( pt_isset($instance['listnum']) != '' && pt_isset($instance['listnum']) != 0 ) ? esc_attr( $instance['listnum'] ) : 5;

		$types = array( 'hide' => 'Don\'t Show This Tab', 'popular' => 'Popular Posts', 'recent' => 'Latest Posts', 'comments' => 'Recent Comments', 'tags' => 'Tag Clouds' );

		echo '
       	 	<p>
            	<label for="' . $this->get_field_id('title1') . '">Tab Title #1 (optional):</label>
            	<input type="text" name="' . $this->get_field_name('title1') . '" value="' . $title1 . '" class="widefat" id="' . $this->get_field_id('title1') . '" />
        	</p>
		<p>
            	<label for="' . $this->get_field_id('tab1') . '">Tab Content #1:</label>
            	<select name="' . $this->get_field_name('tab1') . '" id="' . $this->get_field_id('tab1') . '" class="widefat">
		';

		foreach ( $types as $type => $option ) {
			$selected = $tab1 == $type ? ' selected="selected"' : '';
			echo '<option value="' . $type . '"' . $selected . '>' . $option . '</option>';
		}
		
		echo '
		</select>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('title2') . '">Tab Title #2 (optional):</label>
            	<input type="text" name="' . $this->get_field_name('title2') . '" value="' . $title2 . '" class="widefat" id="' . $this->get_field_id('title2') . '" />
        	</p>
		<p>
            	<label for="' . $this->get_field_id('tab2') . '">Tab Content #2:</label>
            	<select name="' . $this->get_field_name('tab2') . '" id="' . $this->get_field_id('tab2') . '" class="widefat">
		';

		foreach ( $types as $type => $option ) {
			$selected = $tab2 == $type ? ' selected="selected"' : '';
			echo '<option value="' . $type . '"' . $selected . '>' . $option . '</option>';
		}
		
		echo '
		</select>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('title3') . '">Tab Title #3 (optional):</label>
            	<input type="text" name="' . $this->get_field_name('title3') . '" value="' . $title3 . '" class="widefat" id="' . $this->get_field_id('title3') . '" />
        	</p>
		<p>
            	<label for="' . $this->get_field_id('tab3') . '">Tab Content #3:</label>
            	<select name="' . $this->get_field_name('tab3') . '" id="' . $this->get_field_id('tab3') . '" class="widefat">
		';

		foreach ( $types as $type => $option ) {
			$selected = $tab3 == $type ? ' selected="selected"' : '';
			echo '<option value="' . $type . '"' . $selected . '>' . $option . '</option>';
		}
		
		echo '
		</select>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('title4') . '">Tab Title #4 (optional):</label>
            	<input type="text" name="' . $this->get_field_name('title4') . '" value="' . $title4 . '" class="widefat" id="' . $this->get_field_id('title4') . '" />
        	</p>
		<p>
            	<label for="' . $this->get_field_id('tab4') . '">Tab Content #4:</label>
            	<select name="' . $this->get_field_name('tab4') . '" id="' . $this->get_field_id('tab4') . '" class="widefat">
		';

		foreach ( $types as $type => $option ) {
			$selected = $tab4 == $type ? ' selected="selected"' : '';
			echo '<option value="' . $type . '"' . $selected . '>' . $option . '</option>';
		}
		
		echo '
		</select>
        	</p>

		<p>
            	<label for="' . $this->get_field_id('listnum') . '">Number of posts/comments:</label>
            	<input type="text" name="' . $this->get_field_name('listnum') . '" value="' . $listnum . '" size="3" id="' . $this->get_field_id('listnum') . '" />
        	</p>
		';

	}
}

/**
 * Members Login Widget class
 *
 */

class Pt_Members_Login extends WP_Widget {

	function Pt_Members_Login() {
		$instance = array('description' => 'Use this widget to add a members login form to the blog sidebar.' );
		parent::WP_Widget(false, 'PT - Members Login Widget', $instance);      
	}

	function widget($args, $instance) {
		extract($args);
		
		$title = ( $instance['title'] != '' ) ? $instance['title'] : 'Members Login';

        	echo '<li id="' . $args['widget_id'] . '" class="widget members_login">';

		if ( !is_user_logged_in() ) {
			echo '<h2>' . $title . '</h2>';
		}

		if ( is_user_logged_in() ) {
			global $current_user;
			get_currentuserinfo();
			
			echo '<div class="members-widget-avatar">' . get_avatar($current_user->user_email, $size='62', $default='' ) . '</div>';
			echo '<span style="font-weight:bold">Welcome, ' . $current_user->user_firstname . ' ' . $current_user->user_lastname . '!</span>';
			echo '<p><a href="' . wp_logout_url( get_bloginfo('siteurl') ) . '">Logout</a></p>';
			echo '<div style="clear:left"></div>';
			
		} else {
			global $pt_integrate_membership, $pt_member_login_redirect;

			$wl = get_option('WishListMemberOptions');
			$wl_after_login = ( $wl['after_login'] != '' ) ? $wl['after_login'] : get_permalink($wl['after_login_internal']);
 
			$members_home   = ( $pt_member_login_redirect != '' ) ? get_permalink($pt_member_login_redirect) : get_bloginfo('siteurl');
			$redirect_url   = ( $pt_integrate_membership == 'wishlist' ) ? $wl_after_login : $members_home;
			$login_redirect = ( isset($_GET['redirect']) ) ? get_permalink( $_GET['redirect'] ) : $redirect_url;

			$args = array(
				'redirect' => $login_redirect
			);

			wp_login_form( $args );
		}
		
		echo '</li>';

	}

	function update($new_instance, $old_instance) {                
		return $new_instance;
	}

	function form( $instance ) {    
		$title = esc_attr( pt_isset($instance['title']) );

		echo '
       	 	<p>
            	<label for="' . $this->get_field_id('title') . '">Title (optional):</label>
            	<input type="text" name="' . $this->get_field_name('title') . '" value="' . $title . '" class="widefat" id="' . $this->get_field_id('title') . '" />
        	</p>
        	';

	}
}

/**
 * 125x125 Ads Widget class
 *
 */

function pt_ads_125_widget() {
	global $site_options;

	foreach ( $site_options as $value ) {
		$$value['id'] = $value['value']; 
	}


	$numbers = array();

	for ( $i = 1; $i < 9; $i++ ) {
		$pt_sidebar_ad_image = 'pt_sidebar_ad_image' . $i;
		if ( !empty( $$pt_sidebar_ad_image ) ) {
			$numbers[] = $i;
		}
	}
	
	$banner_img = array();
	$banner_dest = array();
 
	$counter = 0;

	if ( $pt_125ads_rotate == 'true' ) {
		shuffle( $numbers );
	}

	echo "\n\n" . '<li id="pt125Ads" class="widget ads125widgets">' . "\n\n";

	foreach ($numbers as $number) {	
		$counter++;
	
		$pt_sidebar_ad_image = 'pt_sidebar_ad_image' . $number;
		$pt_sidebar_ad_link = 'pt_sidebar_ad_link' . $number;
		$banner_img[$counter] = $$pt_sidebar_ad_image;
		$banner_dest[$counter] = $$pt_sidebar_ad_link;
	
	        echo "\t" . '<a href="' . $banner_dest[$counter] . '" target="' . $pt_sidebar_ad_target . '"><img src="' . $banner_img[$counter] . '" border="0" alt="Sidebar Ad" /></a>' . "\n";
	}

	echo '<div style="clear:left"></div>';
	echo '</li>' . "\n\n";
}


register_widget('Pt_Sidebar_Optin');
register_widget('Pt_Sidebar_Ad');
register_widget('Pt_Tab_Lists');
register_widget('Pt_Members_Login');
wp_register_sidebar_widget('pt_ads_125', 'PT - 125x125 Ads', 'pt_ads_125_widget');