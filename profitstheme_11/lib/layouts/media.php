<?php

function pt_media_box()
{
	global $design_options, $site_options;

	$options = array_merge( $design_options, $site_options );
	foreach ( $options as $value ) {
		$$value['id'] = $value['value'];
	}

	switch ( $pt_media_type ) {
		case 'feature1':
	
			pt_featured_post_normal( $pt_feat_cat, $pt_feat_num );
			break;

		case 'feature2':
	
			pt_featured_post_slideshow( $pt_feat_cat, $pt_feat_num );
			break;

		case 'feature3':
	
			pt_featured_post_wide_slideshow( $pt_feat_cat, $pt_feat_num );
			break;

		case 'video':
	
			pt_featured_video( $pt_feat_video );
			break;
	}
}

function pt_featured_post_normal( $cat, $num )
{
	global $pt_feat_title;

	if ( $cat > 0 ) { 

		query_posts( 'cat=' . $cat . '&showposts=' . $num );
		$i = 0;

		echo '<h3 class="featured">' . $pt_feat_title . '</h3>' . "\n";
		echo '<ul id="mycarousel" class="jcarousel-skin-pt">' . "\n";
		
			while ( have_posts() ) : the_post();

				echo '<li>' . "\n";
				echo '<div class="post">' . "\n";
                		echo '<div class="entry">' . "\n";

				pt_thumb(150, 150);

				pt_post_title();
				pt_post_bylines();

				pt_post_content();
				pt_post_tags();

				echo '</div>' . "\n";

				pt_post_metadata();

				echo '</div>'."\n\n";

				echo '</li>' . "\n";
			
			endwhile; 
			
		echo '</ul>';
		wp_reset_query();		

	}
}

function pt_featured_post_slideshow( $cat, $num )
{
	if ( $cat > 0 ) { 

 		$posts = get_posts( 'numberposts=' . $num . '&category=' . $cat );
		$i = 0; $e = 0;

		$image = pt_dimension();
		$width = $image['contentWidth'];
		$gallery_width = $width * $num;

		echo "\n\n";
		echo '<input type="hidden" name="imgWidth" value="'.$width.'">';
		echo '<div id="pt-slider">';
 		echo '<div id="mask-gallery">';
		echo '<ul id="gallery-item" style="width: ' . $gallery_width . 'px">';
		foreach ( $posts as $post ) {
			$slideclass = ( $i == 0 ) ? ' class="show"' : '';
			$height = ( $width * 55 ) / 100;
			
			echo '<li' . $slideclass . '><a href="' . get_permalink($post->ID) . '">';
			pt_thumb( $width, $height, false, false, '', '', $post->ID );
			echo '</a></li>';

			$i++;
		}
		echo '</ul><!-- gallery-item -->';
		echo '</div><!-- mask-gallery -->';

		echo '<div id="mask-excerpt">';
		echo '<ul id="gallery-excerpt">';
		foreach ( $posts as $post ) {
			$slideclass = ( $e == 0 ) ? ' class="show"' : '';

			$media_text = str_replace(']]>', ']]&gt;', $post->post_content); 
			$media_text = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $media_text );
			$media_text = strip_tags( $media_text );
			$media_text = pt_excerpt( $media_text, 130, false );
			echo '
			<li' . $slideclass . '>
				<h3><a href="' . get_permalink($post->ID) . '">' . $post->post_title . '</a></h3>
				<p>' . $media_text . '</p>
			</li>
			';
		
			$e++;
		}
		echo '</ul><!-- gallery-excerpt -->';
		echo '</div><!-- mask-excerpt -->';
		
		echo '</div><!-- pt-slider -->';
		echo '<div id="clr"></div>';

	}
}

function pt_featured_post_wide_slideshow( $cat, $num ){

	if ( $cat > 0 ) { 
		query_posts( 'cat=' . $cat . '&showposts=' . $num );
		$image = pt_dimension();
	
?>
	<div id="mediabox">
	 	<div id="slideshow">
    			<div id="slidesContainer">

				<?php while (have_posts()) : the_post(); ?>

      				<div class="slide">
        				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        				<p><a href="<?php the_permalink(); ?>"><?php pt_thumb($image['slideImgWidth'], $image['slideImgHeight'], false, false); ?></a><?php ob_start(); the_excerpt(); echo pt_excerpt(ob_get_clean(), 220, false); ?></p>
      				</div>
      		
				<?php endwhile; ?>
    			</div>
  		</div>
	</div>
	
<?php
		wp_reset_query();
	}
}

function pt_featured_video( $video_code )
{
	if(pt_isset($video_code)){//revised 2011-09-05
		echo '<div class="post">';
		echo '<div class="entry" style="padding-bottom:15px">';
		echo stripslashes( $video_code );
		echo '</div>';
		echo '</div>';	
	}
}