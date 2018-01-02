<?php

class PtSeo {

	var $title = '';

	function PtSeoTitle( $post_title )
	{
		global $post, $site_options;

		foreach ( $site_options as $value ) {
			$$value['id'] = $value['value']; 
		}

		if ( is_home() || is_front_page() ) {
			$category_title = $this->getCategoryName( $post->ID );
			$authordata = get_userdata($post->post_author);

			if( $pt_home_title != '' ) {

				$hometitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_home_title );
				$hometitle = str_replace('<%site_desc%>', get_bloginfo('description'), $hometitle );
				$hometitle = str_replace('<%post_title%>', '', $hometitle );
				$hometitle = str_replace('<%page_title%>', '', $hometitle );
				$hometitle = str_replace('<%category_title%>', $category_title, $hometitle );
				$hometitle = str_replace('<%date%>', '', $hometitle );
				$hometitle = str_replace('<%tag%>', '', $hometitle );
				$hometitle = str_replace('<%keyword%>', '', $hometitle );
				$hometitle = str_replace('<%request_words%>', '', $hometitle );
				$hometitle = str_replace('<%author_nicename%>', $authordata->user_nicename, $hometitle );
				$hometitle = str_replace('<%author_firstname%>', $authordata->first_name, $hometitle );
				$hometitle = str_replace('<%author_lastname%>', $authordata->last_name, $hometitle );
				$hometitle = str_replace('<%author_login%>', $authordata->user_login, $hometitle );

			} else {
	
				$page_title = '';

				if ( get_option('show_on_front') == 'page' && is_front_page() ) {
					global $post;
										
					$meta    = get_post_meta( get_option('page_on_front'), 'pt_seo_meta_box', true);
					$disable = pt_isset($meta['seo_disable'], 'false');
				
					$page_title = ( $disable != 'true' && $meta['seo_title'] != '' ) ? strip_tags(stripslashes($meta['seo_title'])) : $post->post_title;

				} else if ( get_option('show_on_front') == 'page' && is_home() ) {
					global $post;

					$meta    = get_post_meta( get_option('page_for_posts'), 'pt_seo_meta_box', true);
					$disable = $meta['seo_disable'];
				
					$page_title = ( $disable != 'true' && $meta['seo_title'] != '' ) ? strip_tags(stripslashes($meta['seo_title'])) : $post->post_title;
				}

				if ( $page_title != '' ) {
					$format = $pt_page_title_format;
				} else {
					$format = get_bloginfo('name') . ' | ' . get_bloginfo('description');
				}

				$hometitle = str_replace('<%site_title%>', get_bloginfo('name'), $format );
				$hometitle = str_replace('<%site_desc%>', get_bloginfo('description'), $hometitle );
				$hometitle = str_replace('<%post_title%>', $page_title, $hometitle );
				$hometitle = str_replace('<%page_title%>', $page_title, $hometitle );
				$hometitle = str_replace('<%category_title%>', $category_title, $hometitle );
				$hometitle = str_replace('<%date%>', '', $hometitle );
				$hometitle = str_replace('<%tag%>', '', $hometitle );
				$hometitle = str_replace('<%keyword%>', '', $hometitle );
				$hometitle = str_replace('<%request_words%>', '', $hometitle );
				$hometitle = str_replace('<%author_nicename%>', $authordata->user_nicename, $hometitle );
				$hometitle = str_replace('<%author_firstname%>', $authordata->first_name, $hometitle );
				$hometitle = str_replace('<%author_lastname%>', $authordata->last_name, $hometitle );
				$hometitle = str_replace('<%author_login%>', $authordata->user_login, $hometitle );

			}

			$this->title = $hometitle;

		} else if ( is_single() || is_page() ) {
			
			$meta  = get_post_meta($post->ID, 'pt_seo_meta_box', true);
			$title = pt_isset($meta['seo_title']);
			$authordata = get_userdata($post->post_author);

			if ( pt_isset($meta['seo_disable']) == 'true' ) return $post_title;

			if ( is_page() ) {
				$posttitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_page_title_format);
			} else {
				$posttitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_post_title_format);
			}

			$posttitle = str_replace('<%site_desc%>', get_bloginfo('description'), $posttitle );	

			if( $title != '' ) {
				$posttitle = str_replace('<%post_title%>', $title, $posttitle );
				$posttitle = str_replace('<%page_title%>', $title, $posttitle );
			} else {
				$posttitle = str_replace('<%post_title%>', $post->post_title, $posttitle );
				$posttitle = str_replace('<%page_title%>', $post->post_title, $posttitle );
			}

			$category_title = $this->getCategoryName( $post->ID );

			$posttitle = str_replace('<%category_title%>', $category_title, $posttitle );
			$posttitle = str_replace('<%date%>', '', $posttitle );
			$posttitle = str_replace('<%tag%>', '', $posttitle );
			$posttitle = str_replace('<%keyword%>', '', $posttitle );
			$posttitle = str_replace('<%request_words%>', '', $posttitle );
			$posttitle = str_replace('<%author_nicename%>', $authordata->user_nicename, $posttitle );
			$posttitle = str_replace('<%author_firstname%>', $authordata->first_name, $posttitle );
			$posttitle = str_replace('<%author_lastname%>', $authordata->last_name, $posttitle );
			$posttitle = str_replace('<%author_login%>', $authordata->user_login, $posttitle );

			$this->title = $posttitle;

		} else if ( is_category() ) {
			
			$cattitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_cat_title_format);
			$cattitle = str_replace('<%site_desc%>', get_bloginfo('description'), $cattitle );
			$cattitle = str_replace('<%post_title%>', '', $cattitle );
			$cattitle = str_replace('<%page_title%>', '', $cattitle );
		
			$category_title = $this->getCategoryName( $post->ID );

			$cattitle = str_replace('<%category_title%>', $category_title, $cattitle );
			$cattitle = str_replace('<%date%>', '', $cattitle );
			$cattitle = str_replace('<%tag%>', '', $cattitle );
			$cattitle = str_replace('<%keyword%>', '', $cattitle );
			$cattitle = str_replace('<%request_words%>', '', $cattitle );
			$cattitle = str_replace('<%author_nicename%>', '', $cattitle );
			$cattitle = str_replace('<%author_firstname%>', '', $cattitle );
			$cattitle = str_replace('<%author_lastname%>', '', $cattitle );
			$cattitle = str_replace('<%author_login%>', '', $cattitle );
			
			$this->title = $cattitle;

		} else if ( is_tag() ) {

			global $wp_query;
			$tag = $this->getTag( $wp_query );

			$tagtitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_tag_title_format);
			$tagtitle = str_replace('<%site_desc%>', get_bloginfo('description'), $tagtitle );
			$tagtitle = str_replace('<%post_title%>', '', $tagtitle );
			$tagtitle = str_replace('<%page_title%>', $this->request_as_words($_SERVER['REQUEST_URI']), $tagtitle );
	
			$category_title = $this->getCategoryName( $post->ID );

			$tagtitle = str_replace('<%category_title%>', $category_title, $tagtitle );
			$tagtitle = str_replace('<%date%>', '', $tagtitle );
			$tagtitle = str_replace('<%tag%>', $tag, $tagtitle );
			$tagtitle = str_replace('<%keyword%>', '', $tagtitle );
			$tagtitle = str_replace('<%request_words%>', '', $tagtitle );
			$tagtitle = str_replace('<%author_nicename%>', '', $tagtitle );
			$tagtitle = str_replace('<%author_firstname%>', '', $tagtitle );
			$tagtitle = str_replace('<%author_lastname%>', '', $tagtitle );
			$tagtitle = str_replace('<%author_login%>', '', $tagtitle );

			$this->title = $tagtitle;

		} else if ( is_search() ) {

			$searchtitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_search_title_format);
			$searchtitle = str_replace('<%site_desc%>', get_bloginfo('description'), $searchtitle );
			$searchtitle = str_replace('<%post_title%>', '', $searchtitle );
			$searchtitle = str_replace('<%page_title%>', '', $searchtitle );
			$searchtitle = str_replace('<%category_title%>', '', $searchtitle );
			$searchtitle = str_replace('<%date%>', '', $searchtitle );
			$searchtitle = str_replace('<%tag%>', '', $searchtitle );

			$keyword = attribute_escape( get_search_query() );

			$searchtitle = str_replace('<%keyword%>', $keyword, $searchtitle );
			$searchtitle = str_replace('<%request_words%>', '', $searchtitle );
			$searchtitle = str_replace('<%author_nicename%>', '', $searchtitle );
			$searchtitle = str_replace('<%author_firstname%>', '', $searchtitle );
			$searchtitle = str_replace('<%author_lastname%>', '', $searchtitle );
			$searchtitle = str_replace('<%author_login%>', '', $searchtitle );

			$this->title = $searchtitle;

		} else if ( is_404() ) {

			$notfoundtitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_404_title_format);
			$notfoundtitle = str_replace('<%site_desc%>', get_bloginfo('description'), $notfoundtitle );
			$notfoundtitle = str_replace('<%post_title%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%page_title%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%category_title%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%date%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%tag%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%keyword%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%request_url%>', $_SERVER['REQUEST_URI'], $notfoundtitle );
			$notfoundtitle = str_replace('<%request_words%>', $this->request_as_words( $_SERVER['REQUEST_URI'] ), $notfoundtitle );
			$notfoundtitle = str_replace('<%author_nicename%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%author_firstname%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%author_lastname%>', '', $notfoundtitle );
			$notfoundtitle = str_replace('<%author_login%>', '', $notfoundtitle );

			$this->title = $notfoundtitle;

		} else if ( is_archive() ) {
			
			if ( is_month() ) {
				$date_title = single_month_title(' ', false) . ' Archives';
			} else if ( is_year() ) {
				$date_title = get_query_var('year') . ' Archives';
			} else {
				$date_title = 'Archives';
			}

			$archivetitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_archive_title_format );
			$archivetitle = str_replace('<%site_desc%>', get_bloginfo('description'), $archivetitle );
			$archivetitle = str_replace('<%post_title%>', '', $archivetitle );
			$archivetitle = str_replace('<%page_title%>', '', $archivetitle );
			$archivetitle = str_replace('<%category_title%>', '', $archivetitle );
			$archivetitle = str_replace('<%date%>', $date_title, $archivetitle );
			$archivetitle = str_replace('<%tag%>', '', $archivetitle );
			$archivetitle = str_replace('<%keyword%>', '', $archivetitle );
			$archivetitle = str_replace('<%request_words%>', '', $archivetitle );
			$archivetitle = str_replace('<%author_nicename%>', '', $archivetitle );
			$archivetitle = str_replace('<%author_firstname%>', '', $archivetitle );
			$archivetitle = str_replace('<%author_lastname%>', '', $archivetitle );
			$archivetitle = str_replace('<%author_login%>', '', $archivetitle );

			$this->title = $archivetitle;

		} else if ( is_author() ) {
	
			$authordata = get_userdata($post->post_author);

			$authortitle = str_replace('<%site_title%>', get_bloginfo('name'), $pt_author_title_format);
			$authortitle = str_replace('<%site_desc%>', get_bloginfo('description'), $authortitle );
			$authortitle = str_replace('<%post_title%>', '', $authortitle );
			$authortitle = str_replace('<%page_title%>', '', $authortitle );
			$authortitle = str_replace('<%category_title%>', '', $authortitle );
			$authortitle = str_replace('<%date%>', wp_title('', false) , $authortitle );
			$authortitle = str_replace('<%tag%>', '', $authortitle );
			$authortitle = str_replace('<%keyword%>', '', $authortitle );
			$authortitle = str_replace('<%request_words%>', '', $authortitle );
			$authortitle = str_replace('<%author_nicename%>', $authordata->user_nicename, $authortitle );
			$authortitle = str_replace('<%author_firstname%>', $authordata->first_name, $authortitle );
			$authortitle = str_replace('<%author_lastname%>', $authordata->last_name, $authortitle );
			$authortitle = str_replace('<%author_login%>', $authordata->user_login, $authortitle );

			$this->title = $authortitle;
		}

		return strip_tags(stripslashes($this->title));
	}

	function PtMeta() 
	{
		global $wp_query, $site_options;

		foreach ( $site_options as $value ) {
			$$value['id'] = $value['value']; 
		}

		$this->meta  = '' . "\n";

		$robots = array();

		if ( is_home() || is_front_page() ) {

			// Meta Desc & Keywords For Home & Front Page

			$desc = get_bloginfo('description');
			$key = '';

			$page_desc = ( $pt_home_desc != '' ) ? strip_tags(stripslashes($pt_home_desc)) : $desc;
			$page_keywords = ( $pt_home_kwords != '' ) ? strip_tags(stripslashes($pt_home_kwords)) : $key;

			if ( get_option('show_on_front') == 'page' && is_front_page() ) {

				$meta    = get_post_meta( get_option('page_on_front'), 'pt_seo_meta_box', true);
				$disable = pt_isset($meta['seo_disable']);
				
				$page_desc = ( $disable != 'true' && pt_isset($meta['seo_desc']) != '' && $pt_home_desc == '' ) ? strip_tags(stripslashes(pt_isset($meta['seo_desc']))) : $page_desc;
				$page_keywords  = ( $disable != 'true' && pt_isset($meta['seo_keywords']) != '' && $pt_home_kwords == '' ) ? strip_tags(stripslashes(pt_isset($meta['seo_keywords']))) : $page_keywords;

			} else if ( get_option('show_on_front') == 'page' && is_home() ) {

				$meta    = get_post_meta( get_option('page_for_posts'), 'pt_seo_meta_box', true);
				$disable = pt_isset($meta['seo_disable']);
				
				$page_desc = ( $disable != 'true' && pt_isset($meta['seo_desc']) != '' ) ? strip_tags(stripslashes(pt_isset($meta['seo_desc']))) : $page_desc;
				$page_keywords  = ( $disable != 'true' && pt_isset($meta['seo_keywords']) != '' ) ? strip_tags(stripslashes(pt_isset($meta['seo_keywords']))) : $page_keywords;

			}

			$robots[] = 'index';
			$robots[] = 'follow';
			
		} else if ( is_page() || is_single() ) {

			global $post;

			$meta    = get_post_meta( $post->ID, 'pt_seo_meta_box', true);
			$disable = pt_isset($meta['seo_disable']);

			if ( $disable == 'false' ) {
				// Meta Desc & Keywords For Posts & Pages

				$desc = strip_tags(stripslashes($meta['seo_desc']));
				$key = strip_tags(stripslashes($meta['seo_keywords']));

				$auto_desc = ( $post->post_excerpt != '' ) ? $post->post_excerpt : $post->post_content;
				$auto_desc = str_replace(']]>', ']]&gt;', $auto_desc); 
				$auto_desc = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $auto_desc );

				$desc_min  = 5;
				$desc_max  = 150;
				if ( $desc_max < strlen($auto_desc) ) {
					while($auto_desc[$desc_max] != ' ' && $desc_max > $desc_min) {
						$desc_max--;
					}
				}

				$page_desc = ( $desc != '' ) ? $desc : str_replace( '... ', '', pt_excerpt( $auto_desc, $desc_max, false ) );
				if ( $key == '' ) {
					$key = '';
					$tags = get_the_tags();
                    $keys = array();
					if ( $tags ) {
						foreach ( $tags as $tag ) {
							$keys[] = $tag->name;
						}
					}

					if ( count($keys) > 0 ) {
						$key = implode(',', $keys);
					}
				}

				$page_keywords = $key;

				// Meta Robots For Posts & Pages

				$noindex = ( $meta !== FALSE ) ? $meta['seo_noindex'] : 'true';
				$nofollow = ( $meta !== FALSE ) ? $meta['seo_nofollow'] : 'true';
				$noarchive = ( $meta !== FALSE ) ? $meta['seo_noarchive'] : 'false';
			
				$robots[] = ( $noindex == 'true' ) ? 'noindex' : 'index' ;
				$robots[] = ( $nofollow == 'true' ) ? 'nofollow' : 'follow';

				if ( $noarchive == 'true' ) {
					$robots[] = 'noarchive';
				}
			}

		} else if ( is_category() ) {

			$robots[] = ( $pt_cat_noindex == 'true' ) ? 'noindex' : 'index' ;
			$robots[] = ( $pt_cat_nofollow == 'true' ) ? 'nofollow' : 'follow';

			if ( $pt_cat_noarchive == 'true' ) {
				$robots[] = 'noarchive';
			}

		} else if ( is_tag() ) {

			$robots[] = ( $pt_tag_noindex == 'true' ) ? 'noindex' : 'index' ;
			$robots[] = ( $pt_tag_nofollow == 'true' ) ? 'nofollow' : 'follow';

			if ( $pt_tag_noarchive == 'true' ) {
				$robots[] = 'noarchive';
			}

		} else if ( is_author() ) {

			$robots[] = ( $pt_author_noindex == 'true' ) ? 'noindex' : 'index' ;
			$robots[] = ( $pt_author_nofollow == 'true' ) ? 'nofollow' : 'follow';

			if ( $pt_author_noarchive == 'true' ) {
				$robots[] = 'noarchive';
			}

		} else if ( is_archive() ) {

			$robots[] = ( $pt_archive_noindex == 'true' ) ? 'noindex' : 'index' ;
			$robots[] = ( $pt_archive_nofollow == 'true' ) ? 'nofollow' : 'follow';

			if ( $pt_archive_noarchive == 'true' ) {
				$robots[] = 'noarchive';
			}
		}

		if ( $pt_noodp == 'true' ) {
			$robots[] = 'noodp';
		}
		
		if ( $pt_noydir == 'true' ) {
			$robots[] = 'noydir';
		}

		if ( get_query_var('paged') > 1 ) {
			if ( $pt_subpages_noindex == 'true' ) {
				$subnoindex = false;
				for( $i = 0; $i < count($robots); $i++ ) {
   					if ( $robots[$i] == 'index' ) {
   						$robots[$i] = 'noindex';
						$subnoindex = true;
   					}
				}

				if ( !$subnoindex ) $robots[] = 'noindex';
			}

			if ( $pt_true_nofollow == 'true' ) {
				$subnofollow = false;
				for( $i = 0; $i < count($robots); $i++ ) {
   					if ( $robots[$i] == 'follow' ) {
   						$robots[$i] = 'nofollow';
						$subnofollow = true;
   					}
				}

				if ( !$subnofollow ) $robots[] = 'nofollow';
			}

			if ( $pt_subpages_noarchive == 'true' ) {
				$robots[] = 'noarchive';
			}

		}

		if ( is_category() || is_tax() || is_tag() ) {
			$page_desc = $wp_query->queried_object->description;
		}

		if ( !empty( $page_desc ) ) {
			$remove = array("\n", "\r\n", "\r");
			$page_desc = strip_tags( $page_desc );
			$page_desc = trim( stripslashes( str_replace($remove, '', $page_desc) ) );

			$this->meta .= '<meta name="description" content="' . wptexturize( $page_desc ) . '" />' . "\n";
		}

		if ( !empty( $page_keywords ) ) {
			$this->meta .= '<meta name="keywords" content="' . trim( wptexturize( $page_keywords ) ) . '" />' . "\n";
		}

		if ( count($robots) > 0 ) {
			$this->meta .= '<meta name="robots" content="' . implode(',', $robots) . '" />' . "\n\n";
		}

		if ( get_option( 'blog_public' ) != 0 ) echo $this->meta;
	}

	function PtLinks()
	{
		global $post, $site_options;

		foreach ( $site_options as $value ) {
				$$value['id'] = $value['value']; 
		}

		$url = '';
		
		if ( $pt_seo_canonical == 'true' ) {
			if ( is_single() || is_page() ) {
 			
				$url = (is_page() && get_option('show_on_front') == 'page' && get_option('page_on_front') == $post->ID) ? trailingslashit(get_permalink()) : get_permalink();
			
			} else if ( is_author() ) {

				$author = get_userdata(get_query_var('author'));
				$url = get_author_link(false, $author->ID, $author->user_nicename);

			} else if ( is_category() ) {

				$url = get_category_link(get_query_var('cat')); 

			} else if ( is_tag() ) { 

				$tag = get_term_by('slug', get_query_var('tag'), 'post_tag');
				if (!empty($tag->term_id)) {
					$url = get_tag_link($tag->term_id);
				}

			} else if ( is_day() ) {

				$url = get_day_link(get_query_var('year'), get_query_var('monthnum'), get_query_var('day'));

			} else if ( is_month() ) {

				$url = get_month_link(get_query_var('year'), get_query_var('monthnum'));

			} else if ( is_year() ) {

				$url = get_year_link(get_query_var('year'));

			} else if ( is_home() ) {

				$url = (get_option('show_on_front') == 'page') ? trailingslashit(get_permalink(get_option('page_for_posts'))) : trailingslashit(get_option('home'));
 
			}

			$this->canonical = '<link rel="canonical" href="' . $url . '" />' . "\n";

			echo $this->canonical;

		}

	}

	function PtAddHeader()
	{
		global $post, $site_options;

		foreach ( $site_options as $value ) {
			$$value['id'] = $value['value']; 
		}
		
		$header_script = trim(stripslashes($pt_header_script));

		$meta = get_post_meta( $post->ID, 'pt_script_meta_box', true );
		if( is_page() && pt_isset($meta['header_scr']) != '' ) {
			$header_script .= trim(stripslashes(addslashes($meta['header_scr'])));
		}

		ob_start();
		eval('?>' . $header_script . '<?php ');
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	function PtAddFooter()
	{
		global $post, $site_options;

		foreach ( $site_options as $value ) {
			$$value['id'] = $value['value']; 
		}

		$footer_script = trim(stripslashes($pt_footer_script));

		$meta = get_post_meta( $post->ID, 'pt_script_meta_box', true );
		if( is_page() && pt_isset($meta['footer_scr']) != '' ) {
			$footer_script .= trim(stripslashes(addslashes($meta['footer_scr'])));
		}

		ob_start();
		eval('?>' . $footer_script . '<?php ');
		$output = ob_get_contents();
		ob_end_clean();

		echo $output;
	}

	function PtRedirect()
	{
		if( is_404() ) {

		 	$slug = basename( $_SERVER['REQUEST_URI'] );			 
			
			$exts = array('/', '.php', '.html', '.htm');
			
			foreach ( $exts as $ext ) { 
				$slug = str_replace( $ext, '', $slug ); 
				$slug = trim( $slug );
			} 

		 	if ( $ID = $this->checkPostExistance( $slug ) ) {

		 		wp_redirect( get_permalink( $ID ), 301 );

			}
		}
	}

	function PtRss()
	{
		global $post, $site_options;

		foreach ( $site_options as $value ) {
				$$value['id'] = $value['value']; 
		}

		if( $pt_custom_rss == '' ) {
			$this->rss = get_bloginfo('rss2_url');
		} else {
			$this->rss = $pt_custom_rss;
		} 

		return $this->rss;
	}

	function checkPostExistance( $slug ) {

	 	global $wpdb;

	 	if ( $ID = $wpdb->get_var( "SELECT ID FROM " . $wpdb->posts . " WHERE post_name = '" . $slug . "' AND post_status = 'publish'" ) ) {
			return $ID;
		} else {
			return false;
		}

	}

	function getCategoryName( $post_id ) 
	{
		$categories = get_the_category($post_id);
		$category = '';
		if (count($categories) > 0) {
			$category = $categories[0]->cat_name;
		}

		return $category;
	}

	function getTag( $query ) 
	{
		$tag = $query->query_vars['tag'];

		return ucwords($tag);
	}

	function request_as_words($request) 
	{
		$request = htmlspecialchars($request);
		$request = str_replace('.html', ' ', $request);
		$request = str_replace('.htm', ' ', $request);
		$request = str_replace('.', ' ', $request);
		$request = str_replace('/', ' ', $request);
		$request_a = explode(' ', $request);
		$request_new = array();
		foreach ($request_a as $token) {
			$request_new[] = ucwords(trim($token));
		}
		$request = implode(' ', $request_new);
		return $request;
	}
}

function pt_seo_title()
{
	global $pt_seo_disable;

	if ( $pt_seo_disable == 'false' ) {
		wp_title('');
	} else {
		if ( class_exists( 'WPSEO_Frontend' ) ) {
			wp_title('');
		} else {
			wp_title( '|', true, 'right' ); bloginfo( 'name' );
		}
	}
}


function pt_seo_header()
{
	$seo = new PtSeo;
	$seo->PtMeta();
	$seo->PtLinks();
}

$seo = new PtSeo;

if ( $pt_seo_disable == 'false' ) {

	if ( $pt_seo_301redir == 'true' ) {
		add_action( 'template_redirect', array($seo, 'PtRedirect') );
	}

	add_filter( 'wp_title', array($seo, 'PtSeoTitle') );
	add_action( 'wp_head', 'pt_seo_header' );
}

add_action( 'wp_head', array($seo, 'PtAddHeader') );
add_action( 'wp_footer', array($seo, 'PtAddFooter') );