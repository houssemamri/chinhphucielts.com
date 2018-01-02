<?php

function pt_content( $blog_page = '' )
{
	global $post, $design_options, $site_options, $wp_query;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	$meta = get_post_meta($post->ID, 'pt_post_meta_box', true);

	echo '<div id="main-column">';

	if( is_home() && $pt_media_type != 'feature3' || $blog_page == 'yes' && $pt_media_type != 'feature3') {
		pt_media_box();
	} 

	if ( !is_404() ) {
	    
        $the_query = $wp_query;
        
        //die(var_dump($the_query));
		if ( is_home() || $blog_page == 'yes' ) {
			
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			//die(var_dump($paged));
			if ( $pt_blog_cats_enable == 'true' ) {
				$posts_args = array(
					'category__in' => $pt_blog_cats,
					'paged' => $paged,
				);
                // query_posts( $posts_args );
                
                // The Query
                $the_query = new WP_Query( $posts_args );
			} else {
				if ( $pt_media_type != 'disable' && $pt_media_type != 'video' ) { 
					// query_posts( pt_isset($query_string) . '&cat=-' . $pt_feat_cat . '&order=DESC&paged=' . $paged );
                    $the_query = new WP_Query( pt_isset($query_string) . '&cat=-' . $pt_feat_cat . '&order=DESC&paged=' . $paged );
				} else if ( $blog_page == 'yes' ) {
					// query_posts( pt_isset($query_string) . '&order=DESC&paged=' . $paged );
                    $the_query = new WP_Query( pt_isset($query_string) . '&order=DESC&paged=' . $paged );
				}			}
		}
		
        //die(var_dump($the_query->have_posts()));
		// if ( have_posts() ) : $i = 0;
		if ( $the_query->have_posts() ) : $i = 0;

			if ( is_archive() ) {

?>
	  		<?php if( is_tag() ) { ?>
				<h2 class="pagetitle">Tag: <strong><?php single_tag_title(); ?></strong></h2>
 	  		<?php } elseif ( is_day() ) { ?>
				<h2 class="pagetitle">Archive for <strong><?php the_time('F jS, Y'); ?></strong></h2>
 	  		<?php } elseif ( is_month() ) { ?>
				<h2 class="pagetitle">Archive for <strong><?php the_time('F, Y'); ?></strong></h2>
 	  		<?php } elseif ( is_year() ) { ?>
				<h2 class="pagetitle">Archive for <strong><?php the_time('Y'); ?></strong></h2>
 	  		<?php } elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) { ?>
				<h2 class="pagetitle">Archives</h2>
 	  		<?php } ?>

<?php
			} elseif( is_search() ) {
?>
				<h2 class="pagetitle">Search Results</h2>
<?php
			}
			
			while ( $the_query->have_posts() ) : $the_query->the_post(); $i++;
			
				if ( is_home() && $pt_post_columns == 'two' || is_archive() && $pt_post_columns == 'two' || $blog_page == 'yes' && $pt_post_columns == 'two' ) {
					$postclass = ' postwidth2';
				} else if ( is_home() && $pt_post_columns == 'three' || is_archive() && $pt_post_columns == 'three' || $blog_page == 'yes' && $pt_post_columns == 'three' ) {
					$postclass = ' postwidth3';
				} else {
					$postclass = '';
				}

?>
				<div class="post<?php echo $postclass; ?>" id="post-<?php the_ID(); ?>">

<?php
				if ( is_single() ) {
					if ( pt_isset($meta['show-banner-ad1']) == 'true' ) {
						if ( pt_isset($meta['post-ad1-type']) == 'rich' ) {
							pt_post_rich_ads( $post->ID, 1 );
						} else if ( pt_isset($meta['post-ad1-type']) == 'optin' ) {
							pt_post_optin( $post->ID, 1 );
						} else if ( pt_isset($meta['post-ad1-type']) == 'adcode' ) {
							pt_post_context_ads( $post->ID, 1, 'post-top-ad' );
						} else {
							pt_post_banner( $post->ID, 1, 'post-top-ad' );
						}
					}
				}
?>
        	        	<div class="entry">
<?php

				//die(var_dump(is_page()));
				
				if( !is_page() || $blog_page == 'yes'){
					//die('Im in');
					pt_thumb();
				}

				pt_post_title($blog_page);

				if ( !is_page() || $blog_page == 'yes') {
					pt_post_bylines();
				}

				if ( is_single() ) {
					if ( pt_isset($meta['show-banner-ad2']) == 'true' ) {
						if ( pt_isset($meta['post-ad2-type']) == 'rich' ) {
							pt_post_rich_ads( $post->ID, 2, 'body' );
						} else if ( pt_isset($meta['post-ad2-type']) == 'adcode' ) {
							pt_post_context_ads( $post->ID, 2, 'post-body-ad' );
						} else {
							pt_post_banner( $post->ID, 2, 'post-body-ad' );
						}
					}
				}


				pt_post_content($blog_page);


				if ( is_single() ) {
					if ( $meta['show-banner-ad2'] == 'true' ) {
						echo '<div style="clear:right"></div>';
					}
				}


				pt_post_tags();

?>
				</div>
<?php
				pt_post_metadata($blog_page	);
?>
				</div>
<?php
				
				if ( is_home() && $pt_post_columns == 'three' || is_archive() && $pt_post_columns == 'three' || $blog_page == 'yes' && $pt_post_columns == 'three' ) {
					if ($i == 3){
						$i = 0;
						echo '<div style="clear:both"></div>';
					}
				}else if ( is_home() && $pt_post_columns == 'two' || is_archive() && $pt_post_columns == 'two' || $blog_page == 'yes' && $pt_post_columns == 'two' ) {
					if ($i == 2){
						$i = 0;
						echo '<div style="clear:both"></div>';
					}
				}
				
				if ( is_single() ) {
					if ( pt_isset($meta['show-banner-ad3']) == 'true' ) {
						if ( pt_isset($meta['post-ad3-type']) == 'rich' ) {
							pt_post_rich_ads( $post->ID, 3 );
						} else if ( pt_isset($meta['post-ad3-type']) == 'optin' ) {
							pt_post_optin( $post->ID, 3 );
						} else if ( pt_isset($meta['post-ad3-type']) == 'adcode' ) {
							pt_post_context_ads( $post->ID, 3, 'post-bottom-ad' );
						} else {
							pt_post_banner( $post->ID, 3, 'post-bottom-ad' );
						}
					}

					if ( $pt_post_related == 'true' ) {
						pt_post_related( $post->ID );
					}

				} else if ( is_home() || is_archive() || $blog_page == 'yes' ) {
					$ads = get_post_meta( $post->ID, 'pt_post_meta_box', true );
					if ( pt_isset($pt_post_columns) == 'one' && pt_isset($ads['show-banner-ad3']) == 'true' && pt_isset($ads['post-ad3-loop']) == 'true' ) {
						if ( pt_isset($ads['post-ad3-type']) == 'rich' ) {
							pt_post_rich_ads( $post->ID, 3 );
						} else if ( pt_isset($ads['post-ad3-type']) == 'optin' ) {
							pt_post_optin( $post->ID, 3 );
						} else if ( pt_isset($ads['post-ad3-type']) == 'adcode' ) {
							pt_post_context_ads( $post->ID, 3, 'post-bottom-ad' );
						} else {
							pt_post_banner( $post->ID, 3, 'post-bottom-ad' );
						}
					}
				}

				if ( is_single() && $pt_posts_comments_disable == 'false' || is_page() && $pt_pages_comments_disable == 'false' && $blog_page != 'yes') {

					$comwidth = $pt_layouts['content'] - 20;
					$fbxid = $pt_fb_xid . '_' . $post->ID;

					$fbcom = '
					<div style="margin:15px auto; width:' . $comwidth . 'px">
						<div id="fb-root"></div>
						<script type="text/javascript">
    						window.fbAsyncInit = function() {
    							FB.init({
    								appId: "' . $pt_fb_appid . '",
    								status: true,
    								cookie: true,
    								xfbml: 1
    							});
    						};
    
    						(function() {
    							var e = document.createElement("script"); e.async = true;
    							e.src = document.location.protocol + "//connect.facebook.net/en_US/all.js";
    							document.getElementById("fb-root").appendChild(e);
    						}());
						</script>
						<iframe src="http://www.facebook.com/plugins/like.php?href=' . urlencode(get_permalink($post->ID)) . '&send=false&show_faces=false&action=like" scrolling="no" frameborder="0" style="height: 40px; width: 100%" allowTransparency="true"></iframe>
						<fb:comments num_posts="' . $pt_fb_comments_count . '" width="' . $comwidth . '" href="' . get_permalink($post->ID) . '" colorscheme="light"></fb:comments>
					</div>
					';

					if ( $post->comment_status == 'closed' ) {
						$fbcom = '';
					}

					if ( $pt_comments_type == 'wp' ) {
?>
						<div class="post-comments"><?php comments_template();?></div>
<?php
					} else if ( $pt_comments_type == 'fb' ) {
						if ( $pt_fb_appid != '' ) {
							echo $fbcom;
						}
					} else if ( $pt_comments_type == 'both' ) {
						if ( $pt_comments_sort == 'wpfirst' ) {
?>
						<div class="post-comments"><?php comments_template();?></div>
<?php
						echo $fbcom;
						} else {
						echo $fbcom;
?>
						<div class="post-comments"><?php comments_template();?></div>
<?php
						
						}
					}
				}

                // Reset Post Data
                wp_reset_postdata();
			endwhile;

			
			if( is_home() && $pt_post_columns != 'one' || $blog_page == 'yes' && $pt_post_columns != 'one' ) {
				echo '<div style="clear:both"></div>';
			}

			pt_pagination($blog_page);
?>
			<?php else : ?>

			<h2 class="pagetitle">No posts found. Try a different search?</h2>
			
<?php
			endif; 
		
	}else{
?>
		<div class="post">
               	<h2 class="pagetitle">Error 404 - Not Found</h2>
		</div>
<?php
	}

	echo '</div>';
}

function pt_post_title($blog_page = '' )
{
	if ( is_single() || (is_page() && $blog_page == '')) {
		if(!is_front_page()){
?>
		
		<h1 class="postitle"><?php the_title(); ?></h1>
		
<?php
		}
	} else {
?>
		<h2 class="postitle"><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php get_post_type() == 'post' ? the_title() : ''; ?></a></h2>
<?php
	}
}

function pt_post_bylines()
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( $pt_show_date_post != 'false' || $pt_show_author_post != 'false' || $pt_show_cat_post != 'false' ) {
?>
		<div class="post-bylines">
		Posted <?php if ( $pt_show_date_post == 'true' ) { ?>on <?php the_time('F jS, Y'); ?><?php }?> <?php if ( $pt_show_author_post == 'true' ) { ?>by <?php the_author_posts_link(); ?><?php }?> <?php if ($pt_show_cat_post == 'true' ) { ?>in <?php the_category(', '); ?><?php }?>	
 		</div>
<?php	
	}
}

function pt_post_metadata($blog_page = '' )
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	
	if ( is_page() && $blog_page == '') {
		if ( is_admin() ) {
			echo '<div class="postmetadata">';
			edit_post_link('Edit this entry.', '<p>', '</p>');
			echo '</div>';
		}
	} else {
		if ( $pt_posts_comments_disable == 'false' ) {
			if ( $pt_show_comnum_post == 'true' ) {
				echo '<div class="postmetadata">';
				comments_popup_link('No Comments', '1 Comment', '% Comments');
				echo '</div>';
			}
		}
	}
	
}

function pt_post_tags()
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	if ( !is_page() ) {
		if ( is_home() && $pt_tags_loop == 'true' ) {
			the_tags( '<p class="postags">Tagged As: ', ', ', '</p>' );
		} elseif ( is_archive() && $pt_tags_loop == 'true' ) {
			the_tags( '<p class="postags">Tagged As: ', ', ', '</p>' );
		} elseif ( is_single() && $pt_tags_single == 'true' ){
			the_tags( '<p class="postags">Tagged As: ', ', ', '</p>' );
		}
	}
}

function pt_post_related( $post_id )
{
	global $pt_post_related_title;

	$tags = wp_get_post_tags($post_id);
	if ($tags) {
  		$tag_ids = array();

		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

		$args = array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post_id),
			'showposts' => 5, 
			'caller_get_posts' => 1
		);
			
		$my_query = new wp_query( $args );
		if( $my_query->have_posts() ) {
			echo '<div class="relatedposts">';
			echo '<h3 class="relatedtitle">' . $pt_post_related_title . '</h3>';
			echo '<ul class="relatedlist">';
			while( $my_query->have_posts() ) : $my_query->the_post(); ?>
				<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
<?php
			endwhile;
			echo '</ul>';
			echo '</div>';
		}
		
		wp_reset_query();
	} 
}

function pt_post_content($blog_page = '' )
{
	global $post, $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value']; 
	}

	$meta = get_post_meta($post->ID, 'pt_post_meta_box', true);
	$excerpt_length = ( pt_isset($meta['excerpt-length']) != '' || pt_isset($meta['excerpt-length']) != 0 ) ? $meta['excerpt-length'] : $pt_excerpt_length;
    
	if ( is_home() || $blog_page == 'yes') {
		
		if ( $pt_post_excerpt == 'true' ) {
			ob_start(); the_excerpt(); echo pt_excerpt( ob_get_clean(), $excerpt_length );

?>
			<p><a href="<?php the_permalink() ?>" class="more-link"><?php echo $pt_read_more_text; ?></a></p>
<?php
		} else {
			the_content( $pt_read_more_text );
		}
	} elseif ( is_archive() ) {

		if ( $pt_archive_excerpt == 'true' ) {
			ob_start(); the_excerpt(); echo pt_excerpt( ob_get_clean() , $excerpt_length );
?>
			<p><a href="<?php the_permalink() ?>" class="more-link"><?php echo $pt_read_more_text; ?></a></p>
<?php
		} else {
			the_content( $pt_read_more_text );
		}

	} elseif ( is_single() ) {

		the_content();

	} elseif ( is_page() ) {
		$tmpl = get_post_meta( $post->ID, '_wp_page_template', true );

		if ( $tmpl == 'page-archives.php' ) {
?>
			<h3>Archives by Month:</h3>
			<ul>
			<?php wp_get_archives('type=monthly&limit=12'); ?>
			</ul>

			<h3>Archives by Subject:</h3>
			<ul>
			<?php wp_list_categories('title_li='); ?>
			</ul>
<?php
		} else {
			the_content();
		}

	} else {

		ob_start(); the_excerpt(); echo pt_excerpt(ob_get_clean());
?>
        <p><a href="<?php the_permalink() ?>" class="more-link"><?php echo $pt_read_more_text; ?></a></p>

<?php
	}
}

function pt_pagination($blog_page = '' )
{
	if ( !is_page() || $blog_page == 'yes') {
?>
		<div style="clear:both"></div>
		<div class="navigation">
        	<?php if (function_exists('pt_pagenavi')) pt_pagenavi('','',$blog_page); else { ?>
        		<div class="alignleft"><?php posts_nav_link('','','&laquo; Previous Entries') ?></div>
        		<div class="alignright"><?php posts_nav_link('','Next Entries &raquo;','') ?></div>
			<div class="clearfix"></div>
			<?php } ?>
        	</div> 
<?php
	}
}


