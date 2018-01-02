<?php

$pt_site_options   = array();

$pt_site_options[] = array(
				'name' => 'General Tab open',
				'id' => 'general',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'General Settings',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Favicon Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Custom Favicon',
				'std' => get_bloginfo('template_url') . '/images/favicon.ico',
				'desc' => 'Type the full path URL to your favicon (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
				'id' => $shortname . '_custom_favicon',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Favicon Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Blog Categories Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Check This Box To Show Only Selected Categories On Home Page',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_blog_cats_enable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Select Blog Categories',
				'std' => '',
				'desc' => 'Select categories that you want to show on your site home page. PT will exclude categories that are not selected.',
				'options' => $posts_cat,
				'id' => $shortname . '_blog_cats',
				'type' => 'multiselect'
			);

$pt_site_options[] = array(
				'name' => 'Blog Categories Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'RSS Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Custom RSS URL',
				'std' => '',
				'desc' => 'If you\'d prefer to use a service like Feedburner, you can enter the URL of your feed here. Otherwise, just leave it blank.',
				'id' => $shortname . '_custom_rss',
				'type' => 'text',
			);

$pt_site_options[] = array(
				'name' => 'RSS Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Link Cloaker Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Check This Box To Enable Link Cloaking',
				'std' => 'false',
				'desc' => 'If you enable this, then all links from posts and/or pages will be cloaked except links from the exception domains.',
				'id' => $shortname . '_cloak_enable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Link Cloaking Prefix',
				'std' =>  'recommends',
				'desc' => 'Your cloaked links will be look like this :<br /><br /><span style="line-height:20px;background:#F5F5F5;">' . get_bloginfo('wpurl') . '/6/2/LINK_PREFIX/ANCHOR_TEXT</span>',
				'id' => $shortname . '_cloak_prefix',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Link Cloaking Note',
				'desc' => '<span><strong>Note:</strong> You must NOT use \'default\' permalink in <a href="' . get_bloginfo('wpurl') . '/wp-admin/options-permalink.php">Settings->Permalinks</a>. Otherwise, the cloaked links won\'t work.</span>',
				'type' => 'note'
			);

$pt_site_options[] = array(
				'name' => 'Exception Domains',
				'std' =>  $_SERVER['HTTP_HOST'],
				'desc' => 'One domain per line. Links to these domains will never be cloaked.<br /><br />Please note that <em>www.domain.com</em> and <em>domain.com</em> are treated as separate domains.',
				'id' => $shortname . '_cloak_excp_domains',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Do NOT cloak links in posts',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_uncloak_posts',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Do NOT cloak links in pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_uncloak_pages',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add nofollow attribute to all cloaked links',
				'std' => 'true',
				'desc' => 'This will prevent search engines from counting outgoing links as backlinks (for SEO purposes).',
				'id' => $shortname . '_cloak_nofollow',
				'type' => 'checkbox'
			);


$pt_site_options[] = array(
				'name' => 'Link Cloaker Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Footer Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Copyright Text',
				'std' => '&copy; ' . date("Y") . ' <a href="[%blogurl%]">[%blogname%]</a>.',
				'desc' => 'Copyright text to display on the footer.<br /><br /><b>Blog URL Syntax:</b> [%blogurl%]<br /><b>Blog Name Syntax:</b> [%blogname%]<br /><br /><b>e.g.</b> &copy; ' . date("Y") . ' &lt;a href="[%blogurl%]"&gt;[%blogname%]&lt;/a&gt;.',
				'id' => $shortname . '_foot_copyright',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Profits Theme Affiliate Link',
				'std' => '',
				'desc' => 'This will be shown on the footer as:<br /><em>Powered By <u>Profits Theme</u> From Get Profits Fast</em><br /><br />(the word "Profits Theme" is going to be hyperlinked with your affiliate link)',
				'id' => $shortname . '_afflink',
				'type' => 'text',
				'note' => '<a href="http://www.getprofitsfast.com/affiliate" target="_blank">Get your Profits Theme affiliate link here</a> so that you make extra money (we provide LIFETIME commissions <br/>for multiple products). After you\'ve gotten your Profits Theme affiliate link, paste it below:'
			);

$pt_site_options[] = array(
				'name' => 'Profits Theme Link Target',
				'std' => '_blank',
				'desc' => 'Choose whether you want the link to PT sites to be opened in new window or not.',
				'options' => array(
					'_blank' => 'Open Link In New Window',
					'_self' => 'Open Link In Current Window',
				),
				'id' => $shortname . '_backlink_target',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Check this box to remove link back to our site (meaning you don\'t want to earn affiliate commissions)',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_remove_backlink',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Footer Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'General Tab close',
				'type' => 'tabclose'
			);

// DISPLAY OPTIONS HERE

$pt_site_options[] = array(
				'name' => 'Display Tab open',
				'id' => 'display',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Interface Display Options',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Remove/Collapse Top Navigation #1 (affect both membership and blog pages)',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tnav1_collapse',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Remove/Collapse Top Navigation #2 (affect both membership and blog pages)',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_tnav2_collapse',
				'type' => 'checkbox'
			);


$pt_site_options[] = array(
				'name' => 'Don\'t show navigation on footer',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_footnav_remove',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Header Display Options',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Don\'t display both image and text logo on header',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_header_logo_disable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Don\'t display site tagline when I use a text logo',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_desc_disable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Post Content Options',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Show post excerpts on <b>home</b> page',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_post_excerpt',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Show post excerpts on <b>archive</b> page',
				'std' => true,
				'desc' => '',
				'id' => $shortname . '_archive_excerpt',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Show "Related Posts" on <b>single posts</b>.',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_post_related',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Related Post Title',
				'std' => 'Related Posts',
				'desc' => '',
				'id' => $shortname . '_post_related_title',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Post Tagging Options',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Show post tags on <b>home and archive</b> pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tags_loop',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Show post tags on <b>single</b> entry pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tags_single',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Post Byline and Metadata Options',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Show author name in <b>post</b> byline',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_show_author_post',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Show published-on date in <b>post</b> byline',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_show_date_post',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Show category in <b>post</b> byline',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_show_cat_post',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Show number of comments in <b>post</b> metadata',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_show_comnum_post',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Comments Type',
				'std' => 'wp',
				'desc' => 'Choose the comments system you want to use for your site.',
				'id' => $shortname . '_comments_type',
				'options' => array(
					'wp' => 'Wordpress',
					'fb' => 'Facebook',
					'both' => 'Both Wordpress and Facebook',
					),
				'type' => 'select',
			);

$pt_site_options[] = array(
				'name' => 'First To Show?',
				'std' => 'wpfirst',
				'desc' => 'Choose/arrange comment system you want to display first.',
				'id' => $shortname . '_comments_sort',
				'options' => array(
					'wpfirst' => 'Wordpress First, then Facebook',
					'fbfirst' => 'Facebook First, then Wordpress',
					),
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Facebook Comments Per Page',
				'std' => '10',
				'desc' => 'How many facebook comments to show per page.',
				'id' => $shortname . '_fb_comments_count',
				'options' => array(
					'10' => '10 Comments',
					'20' => '20 Comments',
					'30' => '30 Comments',
					'40' => '40 Comments',
					'50' => '50 Comments',
					),
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Facebook Application ID',
				'std' => '',
				'desc' => 'Create a new application at <a href="http://developers.facebook.com/setup/" target="_blank">http://developers.facebook.com/setup/</a> to obtain a Facebook App Id, and then paste it here.',
				'id' => $shortname . '_fb_appid',
				'type' => 'text'
			);

$gchars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
$gxid = '';
		
for ($i = 0; $i < 15; $i++) {
	$gxid .= $gchars[mt_rand(0, count($gchars)-1)];
}

$pt_site_options[] = array(
				'name' => 'Facebook XID',
				'std' => $gxid,
				'id' => $shortname . '_fb_xid',
				'type' => 'hidden'
			);

$pt_site_options[] = array(
				'name' => 'Additional Comments Options',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Do not show date on <b>comments</b> (This setting will be ignored on facebook comments)',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_comments_date_disable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Disable comments on all <b>posts</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_posts_comments_disable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Disable comments on all <b>pages</b>',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_pages_comments_disable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Posts Excerpt Length',
				'std' => '260',
				'desc' => 'Characters limit for posts excerpt in home or archive page.',
				'id' => $shortname . '_excerpt_length',
				'type' => 'text',
				'width' => '60',
				'suffix' => ' characters'
			);

$pt_site_options[] = array(
				'name' => 'Read More Text',
				'std' => 'Read More',
				'desc' => 'This is the clickthrough link text on home and archive pages that point to the single page.',
				'id' => $shortname . '_read_more_text',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Display Settings close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'Display Tab close',
				'type' => 'tabclose'
			);

$pt_site_options[] = array(
				'name' => 'Media Tab open',
				'id' => 'media',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'Media Box Settings',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Media Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Media Box Type',
				'std' => 'disable',
				'desc' => 'Select what you want to show on the media box.',
				'options' => array(
					'disable' => 'Disable Media Box', 
					'feature1' => 'Featured Posts Normal', 
					'feature2' => 'Featured Posts Slideshow', 
					'feature3' => 'Featured Posts Wide Slideshow', 
					'video' => 'Featured Video'
				),
				'id' => $shortname . '_media_type',
				'type' => 'select',
			);

$pt_site_options[] = array(
				'name' => 'Featured Title',
				'std' => 'Featured Posts',
				'desc' => 'Main title for the "Featured Posts Normal" section.',
				'id' => $shortname . '_feat_title',
				'type' => 'text',
			);

$pt_site_options[] = array(
				'name' => 'Featured Category',
				'std' => '',
				'desc' => 'Choose a category you want to show as the featured post.',
				'options' => $feat_cat_opt,
				'id' => $shortname . '_feat_cat',
				'type' => 'select',
			);

$pt_site_options[] = array(
				'name' => 'Featured Post Number',
				'std' => '4',
				'desc' => 'Choose how many posts you want to show as the featured post.',
				'options' => $feat_num_opt,
				'id' => $shortname . '_feat_num',
				'type' => 'select',
			);

$pt_site_options[] = array(
				'name' => 'Featured Video Embed Code',
				'std' => '',
				'desc' => 'Paste the video embed code here. The video width <b>must be equal or less than %VIDEOWIDTH% pixels</b> to fit your site.',
				'id' => $shortname . '_feat_video',
				'type' => 'textarea',
			);

$pt_site_options[] = array(
				'name' => 'Media Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'Media Tab close',
				'type' => 'tabclose'
			);


// SEO OPTIONS START HERE

$pt_site_options[] = array(
				'name' => 'SEO Tab open',
				'id' => 'seo',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'SEO Settings',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'SEO Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Check this box to disable PT SEO Options',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_seo_disable',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Home Title',
				'std' => '',
				'desc' => 'Custom home page title.',
				'id' => $shortname . '_home_title',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Home Description',
				'std' => '',
				'desc' => 'Custom home page description.',
				'id' => $shortname . '_home_desc',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Home Keywords',
				'std' => '',
				'desc' => 'Custom home page keywords. Seperated by Commas.',
				'id' => $shortname . '_home_kwords',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Use Canonical URLs',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_seo_canonical',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Automatically do 301 (permanent) redirects for permalink changes',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_seo_301redir',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'SEO Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'SEO Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Post Title',
				'std' => '<%post_title%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%post_title%&gt; - <em>The title of the post</em><br />&lt;%category_title%&gt; - <em>The title of the category</em><br />&lt;%author_login%&gt; - <em>The author\'s login</em><br />&lt;%author_nicename%&gt; - <em>The author\'s nicename</em><br />&lt;%author_firstname%&gt; - <em>The author\'s first name</em><br />&lt;%author_lastname%&gt; - <em>The author\'s last name</em></p>',
				'id' => $shortname . '_post_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Page Title',
				'std' => '<%page_title%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%page_title%&gt; - <em>The title of the page</em><br />&lt;%author_login%&gt; - <em>The author\'s login</em><br />&lt;%author_nicename%&gt; - <em>The author\'s nicename</em><br />&lt;%author_firstname%&gt; - <em>The author\'s first name</em><br />&lt;%author_lastname%&gt; - <em>The author\'s last name</em></p>',
				'id' => $shortname . '_page_title_format',
				'type' => 'text'
			);


$pt_site_options[] = array(
				'name' => 'Author Pages Title',
				'std' => '<%author_nicename%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%author_login%&gt; - <em>The author\'s login</em><br />&lt;%author_nicename%&gt; - <em>The author\'s nicename</em><br />&lt;%author_firstname%&gt; - <em>The author\'s first name</em><br />&lt;%author_lastname%&gt; - <em>The author\'s last name</em></p>',
				'id' => $shortname . '_author_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Category Title',
				'std' => '<%category_title%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%category_title%&gt; - <em>The title of the category</em></p>',
				'id' => $shortname . '_cat_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Archive Title',
				'std' => '<%date%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%date%&gt; - <em>The original archive title given by WP</em></p>',
				'id' => $shortname . '_archive_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Tag Title',
				'std' => '<%tag%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%tag%&gt; - <em>The name of the tag</em></p>',
				'id' => $shortname . '_tag_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Search Title',
				'std' => '<%keyword%> | <%site_title%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%keyword%&gt; - <em>What was searched for</em></p>',
				'id' => $shortname . '_search_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => '404 Title',
				'std' => 'Nothing found for <%request_words%>',
				'desc' => '<p style="line-height:21px"><strong>The following macros are supported:</strong> &lt;%site_title%&gt; - <em>Your site title</em><br />&lt;%site_desc%&gt; - <em>Your site description</em><br />&lt;%request_url%&gt; - <em>The original URL path, like "/url-that-does-not-exist/"</em><br />&lt;%request_words%&gt; - <em>The URL path in human readable form, like "Url That Does Not Exist"</em></p>',
				'id' => $shortname . '_404_title_format',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'SEO Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'SEO Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Noindex Tag',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Noindex Tag Note',
				'desc' => 'Adding a <em>noindex</em> robot meta tag will prevent search engines from indexing your page. This is useful when you are trying to NOT index duplicate pages.',
				'type' => 'note',
			);

$pt_site_options[] = array(
				'name' => 'Add noindex meta tag for sub-pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_subpages_noindex',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noindex meta tag for category pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_cat_noindex',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noindex meta tag for tag pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tag_noindex',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noindex meta tag for author pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_author_noindex',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noindex for archive pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_archive_noindex',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Nofollow Tag',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Nofollow Tag Note',
				'desc' => 'Adding a <em>nofollow</em> robot meta tag will prevent search engines from counting outgoing links as backlinks (for SEO purposes).',
				'type' => 'note',
			);

$pt_site_options[] = array(
				'name' => 'Add nofollow meta tag for sub-pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_true_nofollow',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add nofollow meta tag for category pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_cat_nofollow',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add nofollow meta tag for tag pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_tag_nofollow',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add nofollow meta tag for author pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_author_nofollow',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add nofollow meta tag for archive pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_archive_nofollow',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Noarchive Tag',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Noarchive Tag Note',
				'desc' => 'Adding a <em>norachive</em> robot meta tag will prevent search engines and internet archive services from saving cached versions of pages on your site.',
				'type' => 'note',
			);

$pt_site_options[] = array(
				'name' => 'Add noarchive meta tag for sub-pages',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_subpages_noarchive',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noarchive meta tag for category pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_cat_noarchive',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noarchive meta tag for tag pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_tag_noarchive',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noarchive meta tag for author pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_author_noarchive',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noarchive meta tag for archive pages',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_archive_noarchive',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Directory Meta Tags',
				'type' => 'fieldtitle'
			);

$pt_site_options[] = array(
				'name' => 'Directory Tag Note',
				'desc' => 'If your site is listed on Open Directory Project (DMOZ), some search engines (i.e Google) will be taken site description from DMOZ instead of your own description meta tag. Adding <em>noodp</em> will prevent search engines from using your DMOZ\'s site description. The <em>noydir</em> tag is pretty much the same, except that it only affects the Yahoo! Directory.',
				'type' => 'note',
			);

$pt_site_options[] = array(
				'name' => 'Add noodp to your site',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_noodp',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Add noydir to your site',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_noydir',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'SEO Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'SEO Tab close',
				'type' => 'tabclose'
			);


// ADDITIONAL SCRIPTS & CODES OPTIONS HERE

$pt_site_options[] = array(
				'name' => 'Scripts Tab open',
				'id' => 'scripts',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'Additional Scripts and Codes',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Scripts Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Additional Header Scripts & Codes',
				'std' => '',
				'desc' => 'Enter additional Scripts and/or codes for your site\'s header. You can enter whatever you want here, additional meta tags, google analytics, yahoo, msn verification links, even references to stylesheets. ',
				'id' => $shortname . '_header_script',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Scripts & Codes Note',
				'std' => '',
				'desc' => 'Please use the php opening tag <span style="background:#E5E5E5">&nbsp;&lt;?php&nbsp;</span> and closing tag <span style="background:#E5E5E5">&nbsp;?&gt;&nbsp;</span> when adding a php code.',
				'id' => $shortname . '_header_script_note',
				'type' => 'note'
			);

$pt_site_options[] = array(
				'name' => 'Additional Footer Scripts & Codes',
				'std' => '',
				'desc' => 'Enter additional Scripts and/or codes for your site\'s footer. You can enter whatever you want here, additional meta tags, google analytics, yahoo, msn verification links, even references to stylesheets. ',
				'id' => $shortname . '_footer_script',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Scripts & Codes Note',
				'std' => '',
				'desc' => 'Please use the php opening tag <span style="background:#E5E5E5">&nbsp;&lt;?php&nbsp;</span> and closing tag <span style="background:#E5E5E5">&nbsp;?&gt;&nbsp;</span> when adding a php code.',
				'id' => $shortname . '_footer_script_note',
				'type' => 'note'
			);

$pt_site_options[] = array(
				'name' => 'Scripts Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'Scripts Tab close',
				'type' => 'tabclose'
			);

// ADS SETTINGS HERE

$pt_site_options[] = array(
				'name' => 'Ads Tab open',
				'id' => 'ads',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'Top Ad (468 x 60)',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Top Ad Image URL (468 x 60)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 468px x 60px</em>',
				'id' => $shortname . '_top_ad_image',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Top Ad Destination (468 x 60)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_top_ad_link',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Top Ad Target (468 x 60)',
				'std' => '_blank',
				'desc' => 'Select whether you want the ad to appear in new window or not.',
				'options' => array(
					'_blank' => '_blank (new window)',
					'_self' => '_self',
				),
				'id' => $shortname . '_top_ad_target',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Top Adsense Code (468 x 60)',
				'std' => '',
				'desc' => 'You can choose to show adsense ads instead of a banner. Enter your adsense code here.',
				'id' => $shortname . '_top_adsense',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ads (125 x 125)',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ads Note',
				'std' => '',
				'desc' => '<strong>Note:</strong> To properly display the 125x125 Sidebar ads and maintain its position, you need to insert the <strong><em>PT - 125 x 125 Ads</em></strong> widget on <a href="' . get_bloginfo( 'wpurl' ) . '/wp-admin/widgets.php">Appearance -> Widgets</a>.</em>',
				'type' => 'note'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #1 (125 x 125)',
				'std' => get_bloginfo('template_url') . '/images/125x125.gif',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image1',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #1 (125 x 125)',
				'std' => get_bloginfo('wpurl'),
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link1',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #2 (125 x 125)',
				'std' => get_bloginfo('template_url') . '/images/125x125.gif',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image2',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #2 (125 x 125)',
				'std' => get_bloginfo('wpurl'),
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link2',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #3 (125 x 125)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image3',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #3 (125 x 125)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link3',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #4 (125 x 125)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image4',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #4 (125 x 125)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link4',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #5 (125 x 125)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image5',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #5 (125 x 125)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link5',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #6 (125 x 125)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image6',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #6 (125 x 125)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link6',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #7 (125 x 125)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image7',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #7 (125 x 125)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link7',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Image #8 (125 x 125)',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.<br /><br /><em>Size: 125px x 125px</em>',
				'id' => $shortname . '_sidebar_ad_image8',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ad Destination #8 (125 x 125)',
				'std' => '',
				'desc' => 'Enter the URL where this banner ad points to.',
				'id' => $shortname . '_sidebar_ad_link8',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Ads Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Sidebar Ads Target (125 x 125)',
				'std' => '_blank',
				'desc' => 'Select whether you want the ads to appear in new window or not. This setting will be apply for all 125x125 banners.',
				'options' => array(
					'_blank' => '_blank (new window)',
					'_self' => '_self',
				),
				'id' => $shortname . '_sidebar_ad_target',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Check this to randomly rotate the 125x125 banner ads.',
				'std' => 'true',
				'desc' => '',
				'id' => $shortname . '_125ads_rotate',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Ads Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'Ads Tab close',
				'type' => 'tabclose'
			);

// POP UP OPTIN FORM OPTIONS START HERE

$pt_site_options[] = array(
				'name' => 'Optin Tab open',
				'id' => 'optin',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'Pop Up Optin',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Optin Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Check this box to Enable Pop-Up Optin Form',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_enable_popup',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Pop Up Width',
				'std' => '384',
				'desc' => 'The width of your Pop-Up Optin.',
				'id' => $shortname . '_popup_width',
				'type' => 'text',
				'width' => '60',
				'suffix' => 'px'
			);

$pt_site_options[] = array(
				'name' => 'Pop Up Height',
				'std' => '408',
				'desc' => 'The height of your Pop-Up Optin.',
				'id' => $shortname . '_popup_height',
				'type' => 'text',
				'width' => '60',
				'suffix' => 'px'
			);

$pt_site_options[] = array(
				'name' => 'Pop Up Visibility',
				'std' => 'session',
				'desc' => 'This setting determines whether or not to show ads to returning visitors. Browser session -> If your visitor only closes the tab inside his browser, and then opens your site again -> this is NOT considered as a new browser session. He has to close his browser first, and then visits your site again before being counted as a new browser session.',
				'options' => array(
					'always' => 'Every Time Page Loads',
					'never' => 'First Time Visit Only',
					'session' => 'Once Per Browser Session'
				),
				'id' => $shortname . '_popup_visibility',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Show Pop Up On',
				'std' => 'home',
				'desc' => 'Select where you want to display your Pop-Up Optin.<br /><br /><strong>Please note</strong> that this Pop Up will NOT be shown on pages if you use \'Sales Page\' or \'Squeeze Page\' template.',
				'options' => array(
					'all' => 'Home, Posts & Pages',
					'home' => 'Home / Front Page Only',
				),
				'id' => $shortname . '_popup_display',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Paste Autoresponder Code Here',
				'std' => '',
				'desc' => 'Please copy a raw autoresponder code from your email provider (e.g. Aweber, Getresponse, Mail Chimp, etc) and paste it here.',
				'id' => $shortname . '_popup_ar',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Headline',
				'std' => 'Free Gift!',
				'desc' => 'Type any headline to get reader\'s attention to subscribe.',
				'id' => $shortname . '_popup_headline',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Ecover/Image URL',
				'std' => '',
				'desc' => 'Type the full path URL to your banner on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button. It will be displayed under the headline.',
				'id' => $shortname . '_popup_image',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Pop Up Text',
				'std' => 'Simply enter your information to get INSTANT ACCESS today...',
				'desc' => 'Type any text you want to get reader\'s attention to subscribe.',
				'id' => $shortname . '_popup_text',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Name Field Text',
				'std' => 'Enter your first name...',
				'desc' => 'Name field label text. If you\'re not using a name field, leave this blank.',
				'id' => $shortname . '_popup_name',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Email Field Text',
				'std' => 'Enter your email address...',
				'desc' => 'Email field label text.',
				'id' => $shortname . '_popup_email',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Optin Button Type',
				'std' => 'premade',
				'desc' => 'Choose the type of optin button you\'d like to use.',
				'options' => array(
					'premade' => 'Premade Optin Button',
					'text' => 'Custom Text Optin Button',
					'upload' => 'Your Own Optin Button',
				),
				'id' => $shortname . '_popup_btntype',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Premade Optin Button',
				'std' => '',
				'desc' => 'Choose a button for your pop up optin form.',
				'options' => array(
					'yellow-download_now' => 'Yellow - Download Now',
					'yellow-get_access_now' => 'Yellow - Get Access Now!',
					'yellow-get_instant_access' => 'Yellow - Get Instant Access',
					'yellow-get_early' => 'Yellow - Get On The Early Bird List',
					'yellow-send_video' => 'Yellow - Send Me The Video',
					'yellow-sign_up' => 'Yellow - Sign Up Now!',
					'yellow-subscribe' => 'Yellow - Subscribe Now!',
					'yellow-free_access' => 'Yellow - Yes, I want FREE Access',
					'yellow-early_bird' => 'Yellow - Yes, Let Me In Early',
					'yellow-sign_me_up' => 'Yellow - Yes, Sign Me Up!',
					'yellow-end' => '--',
					'orange-download_now' => 'Orange - Download Now',
					'orange-get_access_now' => 'Orange - Get Access Now!',
					'orange-get_instant_access' => 'Orange - Get Instant Access',
					'orange-get_early' => 'Orange - Get On The Early Bird List',
					'orange-send_video' => 'Orange - Send Me The Video',
					'orange-sign_up' => 'Orange - Sign Up Now!',
					'orange-sign_up' => 'Orange - Subscribe Now!',
					'orange-free_access' => 'Orange - Yes, I want FREE Access',
					'orange-early_bird' => 'Orange - Yes, Let Me In Early',
					'orange-sign_me_up' => 'Orange - Yes, Sign Me Up Now!',
					'orange-end' => '--',
					'red-download_now' => 'Red - Download Now',
					'red-get_access_now' => 'Red - Get Access Now!',
					'red-get_instant_access' => 'Red - Get Instant Access',
					'red-get_early' => 'Red - Get On The Early Bird List',
					'red-send_video' => 'Red - Send Me The Video',
					'red-sign_up' => 'Red - Sign Up Now!',
					'red-sign_up' => 'Red - Subscribe Now!',
					'red-free_access' => 'Red - Yes, I want FREE Access',
					'red-early_bird' => 'Red - Yes, Let Me In Early',
					'red-sign_me_up' => 'Red - Yes, Sign Me Up Now!',
					'red-end' => '--',
					'green-download_now' => 'Green - Download Now',
					'green-get_access_now' => 'Green - Get Access Now!',
					'green-get_instant_access' => 'Green - Get Instant Access',
					'green-get_early' => 'Green - Get On The Early Bird List',
					'green-send_video' => 'Green - Send Me The Video',
					'green-sign_up' => 'Green - Sign Up Now!',
					'green-sign_up' => 'Green - Subscribe Now!',
					'green-free_access' => 'Green - Yes, I want FREE Access',
					'green-early_bird' => 'Green - Yes, Let Me In Early',
					'green-sign_me_up' => 'Green - Yes, Sign Me Up Now!',
					'blue-end' => '--',
					'blue-download_now' => 'Blue - Download Now',
					'blue-get_access_now' => 'Blue - Get Access Now!',
					'blue-get_instant_access' => 'Blue - Get Instant Access',
					'blue-get_early' => 'Blue - Get On The Early Bird List',
					'blue-send_video' => 'Blue - Send Me The Video',
					'blue-sign_up' => 'Blue - Sign Up Now!',
					'blue-sign_up' => 'Blue - Subscribe Now!',
					'blue-free_access' => 'Blue - Yes, I want FREE Access',
					'blue-early_bird' => 'Blue - Yes, Let Me In Early',
					'blue-sign_me_up' => 'Blue - Yes, Sign Me Up Now!',
				),
				'id' => $shortname . '_popup_btnpremade',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Optin Button Color',
				'std' => 'yellow',
				'desc' => 'Choose a color for your subscribe button',
				'options' => array(
					'yellow' => 'Yellow',
					'orange' => 'Orange',
					'red' => 'Red',
					'green' => 'Green',
					'blue' => 'Blue',
				),
				'id' => $shortname . '_popup_btncolor',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Optin Button Text',
				'std' => 'Get FREE Access!',
				'desc' => 'Text for the submit button.',
				'id' => $shortname . '_popup_btntxt',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Your Optin Button URL',
				'std' => '',
				'desc' => 'Type the full path URL to your optin button image on the text field (must start with http://), or you can upload a new one by clicking the "Upload Image" button.',
				'id' => $shortname . '_popup_btnurl',
				'type' => 'upload'
			);

$pt_site_options[] = array(
				'name' => 'Short Privacy Policy',
				'std' => 'We will NEVER sell/rent/give away your information. Your privacy is SAFE.',
				'desc' => 'You can add a short privacy policy under the optin form.',
				'id' => $shortname . '_popup_disc',
				'type' => 'textarea'
			);


$pt_site_options[] = array(
				'name' => 'Optin Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Optin Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Headline Font Styling',
				'id' => $shortname . '_popup_headline_font',
				'std' => array(
					'color' => '#cc0000', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'bold', 
					'size' => '30'
				),
				'desc' => 'Select typography for the pop up optin Headline.<br /><br /><em>* non web-safe font</em>',
				'type' => 'typo'
			);

$pt_site_options[] = array(
				'name' => 'Text Font Styling',
				'id' => $shortname . '_popup_text_font',
				'std' => array(
					'color' => '#212121', 
					'face' => 'Verdana, sans-serif', 
					'style' => 'normal', 
					'size' => '11'
				),
				'desc' => 'Select typography for the pop up optin text.<br /><br /><em>* non web-safe font</em>',
				'type' => 'typo'
			);

$pt_site_options[] = array(
				'name' => 'Optin Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'Optin Tab close',
				'type' => 'tabclose'
			);

// Header OPTIN FORM OPTIONS START HERE

$pt_site_options[] = array(
				'name' => 'Header Optin Tab open',
				'id' => 'optin2',
				'type' => 'tabopen'
			);

$pt_site_options[] = array(
				'name' => 'Header Optin',
				'type' => 'biglabel'
			);

$pt_site_options[] = array(
				'name' => 'Header Optin Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Check this box to Enable Header Optin Form',
				'std' => 'false',
				'desc' => '',
				'id' => $shortname . '_enable_headeroptin',
				'type' => 'checkbox'
			);

$pt_site_options[] = array(
				'name' => 'Header Optin Display Options',
				'std' => 'home',
				'desc' => 'Select where you want to display your Header Optin.',
				'options' => array(
					'all' => 'Home, Posts & Pages',
					'home' => 'Home / Front Page Only',
				),
				'id' => $shortname . '_headeroptin_display',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Paste Autoresponder Code Here',
				'std' => '',
				'desc' => 'Please copy a raw autoresponder code from your email provider (e.g. Aweber, Getresponse, Mail Chimp, etc) and paste it here.',
				'id' => $shortname . '_headeroptin_ar',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Headline',
				'std' => 'Free Report - Reveal The Biggest Secrets Of [TOPICHERE]...',
				'desc' => 'Type any text you want to get reader\'s attention to subscribe.',
				'id' => $shortname . '_headeroptin_headline',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Name Field Text',
				'std' => 'Enter your first name...',
				'desc' => 'Name field label text. If you\'re not using a name field, leave this blank.',
				'id' => $shortname . '_headeroptin_name',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Email Field Text',
				'std' => 'Enter your email address...',
				'desc' => 'Email field label text.',
				'id' => $shortname . '_headeroptin_email',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Subscribe Button Text',
				'std' => 'Get FREE Access!',
				'desc' => 'Text for the submit button.',
				'id' => $shortname . '_headeroptin_btntxt',
				'type' => 'text'
			);

$pt_site_options[] = array(
				'name' => 'Subscribe Button Color',
				'std' => 'orange',
				'desc' => 'Choose a color for your subscribe button',
				'options' => array(
					'orange' => 'Orange',
					'green' => 'Green',
					'blue' => 'Blue',
					'red' => 'Red',
					'black' => 'Black',
				),
				'id' => $shortname . '_headeroptin_btncolor',
				'type' => 'select'
			);

$pt_site_options[] = array(
				'name' => 'Short Privacy Policy',
				'std' => 'Your privacy is SAFE with us',
				'desc' => 'You can add a short privacy policy under the optin form.',
				'id' => $shortname . '_headeroptin_disc',
				'type' => 'textarea'
			);

$pt_site_options[] = array(
				'name' => 'Header Optin Close',
				'type' => 'blockclose'
			);


$pt_site_options[] = array(
				'name' => 'Header Optin Open',
				'type' => 'blockopen'
			);

$pt_site_options[] = array(
				'name' => 'Headline Font Styling',
				'id' => $shortname . '_headeroptin_headline_font',
				'std' => array(
					'color' => '#cc0000', 
					'face' => 'Georgia, "Times New Roman", Times, serif', 
					'style' => 'normal', 
					'size' => '15'
				),
				'desc' => 'Select typography for the header optin Headline.<br /><br /><em>* non web-safe font</em>',
				'type' => 'typo'
			);

$pt_site_options[] = array(
				'name' => 'Text Font Styling',
				'id' => $shortname . '_headeroptin_text_font',
				'std' => array(
					'color' => '#FFF', 
					'face' => 'Verdana, sans-serif', 
					'style' => 'bold', 
					'size' => '9'
				),
				'desc' => 'Select typography for the header optin text.<br /><br /><em>* non web-safe font</em>',
				'type' => 'typo'
			);

$pt_site_options[] = array(
				'name' => 'Header Optin Close',
				'type' => 'blockclose'
			);

$pt_site_options[] = array(
				'name' => 'Save Changes',
				'type' => 'submit'
			);

$pt_site_options[] = array(
				'name' => 'Site Action',
				'std' => 'save',
				'id' => 'action',
				'type' => 'hidden'
			);

$pt_site_options[] = array(
				'name' => 'Header Optin Tab close',
				'type' => 'tabclose'
			);