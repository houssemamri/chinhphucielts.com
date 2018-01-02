<?php
// Excerpts
function pt_excerpt($excerpt, $substr = 0, $paragraph = true )
{
	$string = strip_tags(str_replace('[...]', '...', $excerpt));
	if ($substr > 0) {
		$string = substr($string, 0, $substr);
		$string .= '... ';
	}
	
	if ( $paragraph ) {
		$string = '<p>' . $string . '</p>';
	}

	return $string;
}

function pt_page_menu()
{
	$exclude = '';
	echo '<ul id="nav1">';
	wp_list_pages('sort_order=desc&title_li=');
	echo '<li><a href="#" ></a></li>';
	echo '</ul>';
}

function pt_category_menu()
{
	$exclude = '';
	echo '<ul id="nav2">';
	wp_list_categories('show_count=0&title_li=');
	echo '<li><a href="#" ></a></li>';
	echo '</ul>';
}

function pt_page_menu2() {
	$exclude = '';
	echo '<ul id="nav3">';
	wp_list_pages('sort_order=desc&title_li=&depth=1');
	echo '</ul>';
}


// Dynamic Thumbnails
function pt_thumb($w = '', $h = '', $link = true, $block = true, $rel = '', $imgrel = '', $post_id = '' )
{
	global $post, $design_options;

	foreach ( $design_options as $value ) {
		$$value['id'] = $value['value'];
	}
        	
	$id   = ( $post_id != '' ) ? $post_id : $post->ID;
	$key  = 'pt_post_meta_box';
	$post = ( $post_id != '' ) ? get_post($post_id) : $post;
	
	$output = '';
	
	$meta  = get_post_meta($id, $key, true);
	$thumb = pt_isset($meta['post_thumb']);
 
	if ($thumb == '' && $pt_auto_thumb == 'true' ) { 
		
		$get_img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = pt_isset($matches[1][0]);
		
		if (!empty($first_img))
			$thumb = $first_img;
	} 
	
	$url = '';$title = '';
	if ($w == '' && $h == '') {
		if (is_single() && $pt_single_thumb_disable == 'false' ) {
			$url   = $thumb;
			$title = get_the_title($id);

			$width  = $pt_single_thumb_size['val1'];
			$height = $pt_single_thumb_size['val2'];
		}else{
			$url   = get_permalink($id);
			$title = get_the_title($id);

			$width  = $pt_thumb_size['val1'];
			$height = $pt_thumb_size['val2'];
		}
	}else{
		$width  = $w;
		$height = $h;
	}

	$rel = $rel == '' ? '' : ' rel="' . $rel . '"';
	$imgrel = $imgrel == '' ? '' : ' rel="' . $imgrel . '"'; 
	

	if ($thumb != '') {
		if ( $block == true ) {
			$output .= '<div class="thumb-' . $pt_thumb_pos . '">';
		}

		if ( $link == true ) {
			$output .= '<a href="' . $url . '" title="' . $title . '"' . $rel . '>';
		}

		$output .= '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative($thumb) . '&w=' . $width . '&h=' . $height . '&zc=1" border="0"' . $imgrel . ' />';
		
		if ( $link == true ) {
			$output .= '</a>';
		}
 
		if ( $block == true ) {
			$output .= '</div>';
		}

		if ( is_single() && $pt_single_thumb_disable == 'true' ) {
			$output = '';
		}
	}

	echo $output;
}

// Get Image Dimension
function pt_dimension()
{
	global $site_options, $design_options;

	$options = array_merge( $site_options, $design_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value'];
	}

	$options = array(
		'layout' => $pt_layouts['layout'],
		'content' => $pt_layouts['content'],
		'side1' => $pt_layouts['side1'],
		'side2' => $pt_layouts['side2'],
		'colpad' => 0,
		//'colpad' => $pt_layouts['colpad'],
		'footerbar_columns' => $pt_footerbar_columns,
		'header_height' => $pt_header_height,
		'area_padding_width' => 40,
		'wrap_padding_width' => 0,
		'default_header_height' => 165,
		'post_padding_width' => 0,
		//just declare array index
		'post_columns' => NULL,
		'header_height' => NULL,
		'member_header_height' => NULL,
	);

	$size = new PtCss;
	$size->setSize( $options );
	$dimension = $size->getSize();

	return $dimension;

}

// Get Autoresponder Text Fields
function pt_extract_fields($code, $namevalue, $emailvalue, $class = '')
{

	$fieldclass = (!empty($class)) ? 'class="' . $class .'"' : '';
	$fields = array();
	
	if ( count($code[0]) == 1 ) {
		// Email only optin form
		$field     = str_replace("'", "\"", $code[0][0]);
		$emailpos1 = strpos($field, "name=");
		$arfilter  = substr_replace($field, "", 0, $emailpos1);
		
		$emailpos2 = strpos($arfilter, " ");
		$emailpos2  = ( $emailpos2 != '' ) ? $emailpos2 : strpos($arfilter, ">");
		$namevar1  = substr_replace($arfilter, "", $emailpos2, 1000);
	
		if ( $namevar1 != '' ) {
			$fields[]  = '<input type="text" ' . $namevar1 . ' ' . $fieldclass . ' value="' . $emailvalue . '" onfocus="if(this.value == \'' . $emailvalue . '\'){ this.value = \'\';this.style.color = \'#212121\' }" onblur="if(this.value == \'\'){ this.value = \'' . $emailvalue . '\';this.style.color = \'#818181\' }" />';
		}

	} else {
		
		// Get name field from ar
		$field1    = str_replace("'", "\"", pt_isset($code[0][0]));
		$namepos1  = strpos($field1, "name=");
		$arfilter1 = substr_replace($field1, "", 0, $namepos1);
		
		$namepos2  = strpos($arfilter1, " ");
		$namepos2  = ( $namepos2 != '' ) ? $namepos2 : strpos($arfilter1, ">");
		$namevar1  = substr_replace($arfilter1, "", $namepos2, 1000);

		$match = false;

		if ( $namevar1 != '' ) {
			$match = stristr( $namevar1, 'mail' );
			$textvalue =  ( $match ) ? $emailvalue : $namevalue;
			$fields[]  = '<input type="text" ' . $namevar1 . ' ' . $fieldclass . ' value="' . $textvalue . '" onfocus="if(this.value == \'' . $textvalue . '\'){ this.value = \'\';this.style.color = \'#212121\' }" onblur="if(this.value == \'\'){ this.value = \'' . $textvalue . '\';this.style.color = \'#818181\' }" />';
		}

		// Get email field from ar
		$field2    = str_replace("'", "\"", pt_isset($code[0][1]));
		$emailpos1 = strpos($field2, "name=");
		$arfilter2 = substr_replace($field2, "", 0, $emailpos1);
		
		$emailpos2 = strpos($arfilter2, " ");
		$emailpos2  = ( $emailpos2 != '' ) ? $emailpos2 : strpos($arfilter2, ">");
		$namevar2  = substr_replace($arfilter2, "", $emailpos2, 1000);

		if ( $namevar2 != '' ) {
			$textvalue =  ( $match ) ? $namevalue : $emailvalue;
			$fields[]  = '<input type="text" ' . $namevar2 . ' ' . $fieldclass . ' value="' . $textvalue . '" onfocus="if(this.value == \'' . $textvalue . '\'){ this.value = \'\';this.style.color = \'#212121\' }" onblur="if(this.value == \'\'){ this.value = \'' . $textvalue . '\';this.style.color = \'#818181\' }" />';
		}

		if ( $match ) arsort($fields);
	}

	return $fields;
}

function pt_is_blog_page()
{
	$blog_page = false;
	if ( is_page() ) {
		global $post;
		$tmpl = get_post_meta($post->ID, '_wp_page_template', true);
		if ( $tmpl == 'page-blog.php' ) {
			$blog_page = true;
		}
		
	}

	return $blog_page;
}

// Get Post Ads
function pt_post_banner( $post_id, $num, $class ) {

	$meta   = get_post_meta($post_id, 'pt_post_meta_box', true);
	$url    = 'post-banner' . $num . '-url';
	$window = 'post-banner' . $num . '-target';
	$image  = 'post-banner' . $num . '-image';

	echo '<div class="' . $class . '"><a href="' . $meta[$url] . '" target="' . $meta[$window] . '"><img src="' . $meta[$image] . '" border="0" /></a></div>';
}

function pt_post_context_ads( $post_id, $num, $class ) {

	$meta   = get_post_meta($post_id, 'pt_post_meta_box', true);
	$code   = 'post-adcode' . $num . '-ad';

	echo '<div class="' . $class . '">' . stripslashes($meta[$code]) . '</div>';
}

function pt_post_rich_ads( $post_id, $num, $pos = '') {

	$meta   = get_post_meta($post_id, 'pt_post_meta_box', true);
	$theme  = 'post-rich' . $num . '-theme';
	$title  = 'post-rich' . $num . '-title';
	$body   = 'post-rich' . $num . '-body';
	$url    = 'post-rich' . $num . '-url';
	$anchor = 'post-rich' . $num . '-text-url';
	$window = 'post-rich' . $num . '-target-url';

	$img = $meta['post-rich' . $num . '-image'] != '' ? '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative($meta['post-rich' . $num . '-image']) . '&w=100&h=&zc=1" border="0" style="float:left;margin-right:10px" />' : '';
	$pos = ($pos == 'body') ? 'rich-ad-body' : '';

	echo'
		<div class="rich-ad-' . $meta[$theme] . ' ' . $pos . '">' . $img . '
			<div class="rich-ad-title">' . $meta[$title] . '</div>
			<p style="text-align:left">' . stripslashes($meta[$body]) . '</p>
			<span><a href="' . $meta[$url] . '" target="' . $meta[$window] . '">' . $meta[$anchor] . '</a></span>
			<div style="clear:left"></div>
		</div>
	';
}

function pt_post_optin( $post_id, $num ) {

	$meta   = get_post_meta($post_id, 'pt_post_meta_box', true);
	$theme  = 'post-optin' . $num . '-theme';
	$arcode = 'post-optin' . $num . '-ar';
	$title  = 'post-optin' . $num . '-title';
	$text   = 'post-optin' . $num . '-text';
	$btntxt = 'post-optin' . $num . '-button-text';
	$legal  = 'post-optin' . $num . '-privacy-text';

	$img = $meta['post-optin' . $num . '-image'] != '' ? '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative($meta['post-optin' . $num . '-image']) . '&w=80&h=&zc=1" border="0" style="float:left;margin-right:10px" />' : '';
	$pos = (pt_isset($pos) == 'body') ? 'rich-ad-body' : '';

	if ( $arcode != '' ) {

		preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $meta[$arcode] ), $form);
		preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $meta[$arcode] ), $form2);
		preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $meta[$arcode] ), $hiddens);
		preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $meta[$arcode] ), $fields);

		$form_field = ( pt_isset($form[0][0]) != '' ) ? $form[0][0] : '<form action="' . pt_isset($form2[1]) . '" method="post">';

		echo "\n\n" . $form_field . "\n";

		echo '
			<div class="rich-ad-' . $meta[$theme] . '">' . $img . '
			<div class="rich-ad-title">' . $meta[$title] . '</div>
			<p style="text-align:left">' . stripslashes($meta[$text]) . '</p>
		';
						
		$arfields = pt_extract_fields($fields, 'First name', 'Email address', 'optin-ad-field');
								
		if ( $arfields ) {
			foreach ( $arfields as $arfield ) {
				echo $arfield . "\n";
			}
		}

		if ( $hiddens[0] ) {
			foreach ( $hiddens[0] as $hidden ) {
				echo $hidden . "\n";
			}
		}				
						
		echo '
			<input type="submit" name="cmdSubmit" value="' . $meta[$btntxt] . '" class="optin-ad-btn-' . $meta[$theme] . '" />
			<p style="text-align:center;color:#808080"><small>' . $meta[$legal] . '</small></p>
			<div style="clear:left"></div>
			</div>
		</form>
		';
	}	
}

// Get Tab Titles
function pt_list_title( $titles, $lists, $wid ) 
{
	$title = array();

	echo  "\n\n" . '<ul class="tab-titles">' . "\n";

	if ( $titles[0] != '' ) {
		if ( $lists[0] != 'hide' ) {
			$title[] = $titles[0]; 
		} else {
			$title[] = '';
		}
	} else {
		if ( $lists[0] == 'popular' ) {
			$title[] = 'Popular';
		} else if ( $lists[0] == 'recent' ) {
			$title[] = 'Latest';
		} else if ( $lists[0] == 'comments' ) {
			$title[] = 'Comments';
		} else if ( $lists[0] == 'tags' ) {
			$title[] = 'Tags';
		} else if ( $lists[0] == 'hide' ) {
			$title[] = '';
		}
	}

	if ( $titles[1] != '' ) {
		if ( $lists[1] != 'hide' ) {
			$title[] = $titles[1]; 
		} else {
			$title[] = '';
		}
	} else {
		if ( $lists[1] == 'popular' ) {
			$title[] = 'Popular';
		} else if ( $lists[1] == 'recent' ) {
			$title[] = 'Latest';
		} else if ( $lists[1] == 'comments' ) {
			$title[] = 'Comments';
		} else if ( $lists[1] == 'tags' ) {
			$title[] = 'Tags';
		} else if ( $lists[1] == 'hide' ) {
			$title[] = '';
		}
	}

	if ( $titles[2] != '' ) {
		if ( $lists[2] != 'hide' ) {
			$title[] = $titles[2]; 
		} else {
			$title[] = '';
		}
	} else {
		if ( $lists[2] == 'popular' ) {
			$title[] = 'Popular';
		} else if ( $lists[2] == 'recent' ) {
			$title[] = 'Latest';
		} else if ( $lists[2] == 'comments' ) {
			$title[] = 'Comments';
		} else if ( $lists[2] == 'tags' ) {
			$title[] = 'Tags';
		} else if ( $lists[2] == 'hide' ) {
			$title[] = '';
		}
	}

	if ( $titles[3] != '' ) {
		if ( $lists[3] != 'hide' ) {
			$title[] = $titles[3]; 
		} else {
			$title[] = '';
		}
	} else {
		if ( $lists[3] == 'popular' ) {
			$title[] = 'Popular';
		} else if ( $lists[3] == 'recent' ) {
			$title[] = 'Latest';
		} else if ( $lists[3] == 'comments' ) {
			$title[] = 'Comments';
		} else if ( $lists[3] == 'tags' ) {
			$title[] = 'Tags';
		} else if ( $lists[3] == 'hide' ) {
			$title[] = '';
		}
	}

	$i = 0;
	foreach ( $title as $label ) {
		$selected = ( $i == 0 ) ? ' class="selected "' : '';
		if ( $label != '' ) {
			echo '<li class="tab-label-' . $i . '"><a href="#" rel="' . $wid . '-' . $i . '"' . $selected . '>' . $label . '</a></li>' . "\n";	
		}
		$i++;
	}
	
	echo '</ul>' . "\n";
	echo '<div style="clear:both"></div>' . "\n\n";
}

function pt_tab_lists( $type, $num, $pos, $wid )
{
	$tabpos = $pos + 1;
	$posts = ($num != '' OR $num != 0) ? $num : 5;
	switch ( $type ) {
		case 'popular':
			pt_popular_lists( $posts, $pos, $wid );
		break;

		case 'recent':
			pt_latest_lists( $posts, $pos, $wid );
		break;

		case 'comments':
			pt_comments_lists( $posts, $pos, $wid );
		break;

		case 'tags':
			echo '<div id="' . $wid . '-' . $pos . '" class="tab-contents">';
			wp_tag_cloud( 'smallest=12&largest=20' );
			echo '</div>';
		break;
	}
}

function pt_popular_lists( $posts = 5, $pos, $wid )
{
	$popular = new WP_Query('orderby=comment_count&posts_per_page=' . $posts );

	echo '<div id="' . $wid . '-' . $pos . '">';
	if( $popular->have_posts() ) : 
	echo '<ul class="tab-contents">';
	while ( $popular->have_posts() ) : $popular->the_post();
	echo '<li>';
	pt_thumb( 35, 35, true, false, '', '', get_the_ID() );
?>
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><strong><?php the_title(); ?></strong></a>
	<div class="tab-date"><?php the_time('F jS, Y'); ?></div>
<?php
	echo '<div style="clear:left"></div>';
	echo '</li>';
	endwhile;
	echo '</ul>';
	endif;
	echo '</div>';
	wp_reset_query();
}

function pt_latest_lists( $posts = 5, $pos, $wid  )
{
	$latest = new WP_Query('orderby=post_date&order=DESC&posts_per_page=' . $posts );
	echo '<div id="' . $wid . '-' . $pos . '">';
	if( $latest->have_posts() ) : 
	echo '<ul class="tab-contents">';
	while ( $latest->have_posts() ) : $latest->the_post();
	echo '<li>';
	pt_thumb( 35, 35, true, false, '', '', get_the_ID() );
?>
	
	<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><strong><?php the_title(); ?></strong></a>
	<div class="tab-date"><?php the_time('F jS, Y'); ?></div>
<?php
	echo '<div style="clear:left"></div>';
	echo '</li>';
	endwhile;
	echo '</ul>';
	endif;
	echo '</div>';
	wp_reset_query();
}


function pt_comments_lists( $posts = 5, $pos, $wid  )
{
	global $wpdb;

	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author,
	comment_author_email, comment_date_gmt, comment_approved, comment_type,comment_author_url,
	SUBSTRING(comment_content,1,50) AS com_excerpt FROM $wpdb->comments
	LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
	WHERE comment_approved = '1' AND comment_type = '' AND post_password = ''
	ORDER BY comment_date_gmt DESC LIMIT " . $posts;
	
	$comments = $wpdb->get_results($sql);
	echo '<div id="' . $wid . '-' . $pos . '">';
	echo '<ul class="tab-contents">';
	foreach ($comments as $comment) {
	?>
	<li>
		<?php echo get_avatar( $comment, 35 ); ?>
	
		<a href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="on <?php echo $comment->post_title; ?>">
		<strong><?php echo strip_tags($comment->comment_author); ?>:</strong> <?php echo strip_tags($comment->com_excerpt); ?>...
		</a>
		<div style="clear:left"></div>
	</li>
	<?php 
	}
	echo '</ul>';
	echo '</div>';
}

// detect mobile browsers
function pt_is_mobile()
{
	$mobile = 0;

	$useragent = isset( $_SERVER['HTTP_USER_AGENT'] ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';
	$httpaccept = isset( $_SERVER['HTTP_ACCEPT'] ) ? strtolower( $_SERVER['HTTP_ACCEPT'] ) : '';

   	$iphone     = ( stripos( $useragent, 'iphone' ) ) ? $mobile++ : $mobile;
   	$ipod       = ( stripos( $useragent, 'ipod' ) ) ? $mobile++ : $mobile;
   	$ipad       = ( stripos( $useragent, 'ipad' ) ) ? $mobile++ : $mobile;
   	$android    = ( stripos( $useragent, 'android' ) ) ? $mobile++ : $mobile;
   	$webos      = ( stripos( $useragent, 'webos' ) ) ? $mobile++ : $mobile;
	$blackberry = ( stripos( $useragent, 'blackberry' ) ) ? $mobile++ : $mobile;

	if ( $mobile > 0 ) {
		return true;
	} else
		return false;
}

// Pop Up Optin
function pt_popup_optin()
{
	global $post, $site_options;

	foreach ( $site_options as $value ) {
		$$value['id'] = $value['value']; 
	}

	$resp_code = '';

	$ar_code = $pt_popup_ar;
	$name_field = $pt_popup_name;
	$email_field = $pt_popup_email;
	$disclaimer = $pt_popup_disc;
	$pop_width = $pt_popup_width;
	$pop_height = $pt_popup_height;
	$pop_text = $pt_popup_text;
	$pop_image = pt_isset($pt_popup_image);
	$pop_headline = $pt_popup_headline;
	$resp_code = $pt_popup_ar;
	$button_type = $pt_popup_btntype;
	$button_pre = $pt_popup_btnpremade;
	$button_txt = $pt_popup_btntxt;
	$button_clr  = $pt_popup_btncolor;
	$button_img  = $pt_popup_btnurl;

	preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $ar_code ), $form);
	preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $ar_code ), $form2);
	preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $ar_code ), $hiddens);
	preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $ar_code ), $fields);

	$width = (int)$pop_width - 60;
	$height = (int)$pop_height - 40;

	$form_field = ( $form[0][0] != '' ) ? $form[0][0] : '<form action="' . $form2[1] . '" method="post">';
	
	$popup  = '';

	$popup .= '
	<div id="popupOptin" style="width:' . $width . 'px;height:' . $height . 'px;">
		<div class="poptopbar"><a id="popupOptinClose">x</a></div>
		<h1>' . $pop_headline . '</h1>
	';

	$popup .= "\n\n" . $form_field . "\n";

	if ( pt_isset($pt_popup_image) != '' ) {
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

	if ( $hiddens[0] ) {
		foreach ( $hiddens[0] as $hidden ) {
			$popup .= $hidden . "\n";
		}
	}
	
	$popup .= '</form>' . "\n";
	
	$popup .= '
	</div>
	<div id="backgroundPopup"></div>
	';

	if ( $pt_enable_popup == 'true' ) {

		if( is_single() && $pt_popup_display == 'all' ) {
			if ( $pt_popup_visibility == 'always' ) {
				echo $popup;
			} else if ( $pt_popup_visibility == 'never' && !isset($_COOKIE['pt_global_popup']) ) {
				echo $popup;
			} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE['pt_session_popup']) ) {
				echo $popup;
			}

		} else if( is_page() && $pt_popup_display == 'all') {
			$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );
			$page_arr = array( 'page-sales.php', 'page-sales.php', 'page-member.php', 'page-member-account.php', 'page-member-cat.php', 'page-member-content.php', 'page-member-error.php', 'page-member-login.php');
			if ( !in_array($tmpl, $page_arr) ) {
				
				$cookiename = 'pt_global_popup';
				$cookiename2 = 'pt_session_popup';

				if ( $pt_popup_visibility == 'always' ) {
					echo $popup;
				} else if ( $pt_popup_visibility == 'never' && !isset($_COOKIE[$cookiename]) ) {
					echo $popup;
				} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE[$cookiename2]) ) {
					echo $popup;
				} 
			}

		} else if ( is_home() && $pt_popup_display == 'home' || is_home() && $pt_popup_display == 'all' ) {
			if ( $pt_popup_visibility == 'always' ) {
				echo $popup;
			} else if ( $pt_popup_visibility == 'never' && !isset($_COOKIE['pt_global_popup']) ) {
				echo $popup;
			} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE['pt_session_popup']) ) {
				echo $popup;
			}
		} else if ( is_front_page() && $pt_popup_display == 'home' || is_front_page() && $pt_popup_display == 'all' ) {
			$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );

			if ( $tmpl != 'page-sales.php' ) {
				if ( $pt_popup_visibility == 'always' ) {
					echo $popup;
				} else if ( $pt_popup_visibility == 'never' && !isset($_COOKIE['pt_global_popup']) ) {
					echo $popup;
				} else if ( $pt_popup_visibility == 'session' && !isset($_COOKIE['pt_session_popup']) ) {
					echo $popup;
				}
			}
		}
	}
}


// Header Optin
function pt_header_optin(){
	global $post, $site_options;

	foreach ( $site_options as $value ) {
		$$value['id'] = $value['value']; 
	}

	$ar_code = $pt_headeroptin_ar;
	$headline = $pt_headeroptin_headline;
	$name_field = $pt_headeroptin_name;
	$email_field = $pt_headeroptin_email;
	$button_txt = $pt_headeroptin_btntxt;
	$disclaimer = $pt_headeroptin_disc;
	$button_clr  = $pt_headeroptin_btncolor;
	$resp_code = $pt_headeroptin_ar;

	preg_match_all('/<form\s[^>]*method=[\'"]?(post|get)[^>]*>/i', stripslashes( $ar_code ), $form);
	preg_match('/<form\s[^>]*action=[\'"]([^\'"]+)[\'"]/i', stripslashes( $ar_code ), $form2);
	preg_match_all('/<input\s[^>]*type=[\'"]?hidden[^>]*>/i', stripslashes( $ar_code ), $hiddens);
	preg_match_all('/<input\s[^>]*type=([\'"])?(text|email)[^>]*>/i', stripslashes( $ar_code ), $fields);

	$form_field = ( $form[0][0] != '' ) ? $form[0][0] : '<form action="' . $form2[1] . '" method="post">';

	$header_optin  = '';
	$header_optin .= "\n\n" . $form_field . "\n";
	$header_optin .= '
	<div class="header_optin">
		<div class="header_optin_text">' . stripslashes( $headline ) . '</div>
		<div class="header_optin_area">
	';

	$arfields = pt_extract_fields($fields, $name_field, $email_field, 'header_optin_field');
	
	if ( $arfields ) {
		foreach ( $arfields as $arfield ) {
			$header_optin .= $arfield . "\n";
		}
	}
	
	$header_optin .= '<div style="text-align:right;margin:5px 0;"><input type="submit" name="submit" value="' . $button_txt . '" class="header-button-' . $button_clr . '" /></div>' . "\n";
		
	$header_optin .= '<div class="header_optin_disc">' . stripslashes( $disclaimer ) . '</div>' . "\n";
	$header_optin .= '</div>' . "\n";

	if ( $hiddens[0] ) {
		foreach ( $hiddens[0] as $hidden ) {
			$header_optin .= $hidden . "\n";
		}
	}

	$header_optin .= '
		</div>
	</form>
	';

	if ( $pt_enable_headeroptin == 'true' ) {
		
		if( is_single() && $pt_headeroptin_display == 'all' ) {
			echo $header_optin;
		} else if( is_page() && $pt_headeroptin_display == 'all') {
			$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );

			if( $tmpl != 'page-sales.php' ) { 
				echo $header_optin;
			}

		} else if( is_page() && $pt_headeroptin_display == 'home') {
			$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );

			if( $tmpl != 'page-sales.php' ) { 
				echo $header_optin; 
			}

		} else if( is_home() && $pt_headeroptin_display == 'home' || is_home() && $pt_headeroptin_display == 'all' ) {
			echo $header_optin;
		} else if( is_front_page() && $pt_headeroptin_display == 'home' || is_front_page() && $pt_headeroptin_display == 'all' ) {
			echo $header_optin;
		}
	}
}

if ( $pt_enable_popup == 'true' ) {
	$tmpl = '';
	
	if( !empty($post->ID) )
		$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );
		
	if ( $tmpl != 'page-sales.php' ) {
		add_action( 'wp_footer', 'pt_popup_optin' );
	}
}