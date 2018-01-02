<?php

class PtCss {

	function setSize( $args )
	{
		$layout  = $args['layout'];

		$this->size = array();

		$this->size['contentWidth'] = $args['content'];
		$this->size['side1Width']   = $args['side1'];
		$this->size['side2Width']   = $args['side2'];
		
		$args['colpad'] = 0;

		switch ( $layout ) {
			case '1-col-no-side':

				$this->size['contentRightMargin'] = 0;
				$this->size['side1RightMargin'] = 0;
				$this->size['side2RightMargin'] = 0;
				$this->size['side1Width'] = 0;
				$this->size['side2Width'] = 0;
				break;

			case '2-col-left-side':

				$this->size['contentRightMargin'] = $args['colpad'];
				$this->size['side1RightMargin'] = $args['colpad'];
				$this->size['side2RightMargin'] = 0;
				$this->size['side2Width'] = 0;
				break;

			case '2-col-right-side':

				$this->size['contentRightMargin'] = $args['colpad'];
				$this->size['side1RightMargin'] = 0;
				$this->size['side2RightMargin'] = 0;
				$this->size['side2Width'] = 0;
				break;

			case '3-col-both-side':

				$this->size['contentRightMargin'] = $args['colpad'];
				$this->size['side1RightMargin'] = $args['colpad'];
				$this->size['side2RightMargin'] = 0;
				break;

			case '3-col-right-side':

				$this->size['contentRightMargin'] = $args['colpad'];
				$this->size['side1RightMargin'] = $args['colpad'];
				$this->size['side2RightMargin'] = 0;
				break;

			case '3-col-left-side':

				$this->size['contentRightMargin'] = $args['colpad'];
				$this->size['side1RightMargin'] = $args['colpad'];
				$this->size['side2RightMargin'] = $args['colpad'];
				break;
		}

		
		
		$this->size['headerHeight'] = ( $args['header_height'] != '' && $args['header_height'] > 0 ) ? $args['header_height'] : $args['default_header_height'];
		$this->size['headerPadTop'] = floor( $this->size['headerHeight'] / 4 );
		$this->size['memberheaderHeight'] = ( $args['member_header_height'] != '' && $args['member_header_height'] > 0 ) ? $args['member_header_height'] : $args['default_header_height'];

		$this->size['bodyWidth'] = $this->size['contentWidth'] + $this->size['side1Width'] + $this->size['side2Width'] + $this->size['side1RightMargin'] + $this->size['side2RightMargin'] + $this->size['contentRightMargin'] + $args['area_padding_width'] + $args['wrap_padding_width'];
		$this->size['mainWidth'] = $this->size['bodyWidth'] - $args['wrap_padding_width'];
		$this->size['mediaBoxwidth'] = $this->size['mainWidth'] - $args['area_padding_width'];

		if ( $args['footerbar_columns'] == 'four' ) {
			$footcol = 4;
		} else {
			$footcol = 3;
		}

		$botWidgetPad = 20 * 2;
		$totalBotWidgetPad = $botWidgetPad * $footcol;

		$this->size['botWidgetWidth'] = floor( ( $this->size['mainWidth'] - $totalBotWidgetPad ) / $footcol );
		
		$this->size['rssHeight'] = ( $this->size['headerHeight'] <= 128 ) ? ( 128 - 71 ) : ( $this->size['headerHeight'] - 71 );
		$this->size['rssTop']  = @( $this->size['headerHeight'] - $this->size['rssHeight'] );
		$this->size['rssLeft'] = $this->size['mainWidth'] - 128;

		$this->size['searchTop']  = @( ( $this->size['headerHeight'] - 35 ) / 2 );
		$this->size['searchLeft'] = $this->size['mainWidth'] - 181;

		$this->size['adTop']  = @( ( $this->size['headerHeight'] - 60 ) / 2 );
		$this->size['adLeft'] = $this->size['mainWidth'] - 468;
		
		$this->size['headerOptinHeight'] = $this->size['headerHeight'] - 10;
		$this->size['optLeft'] = $this->size['mainWidth'] - 275;

		$this->size['galleryHeight'] = ( $this->size['contentWidth'] * 55) / 100; 
		$this->size['preSlideWidth'] = ( $this->size['mediaBoxwidth'] >= 640 ) ? 640 : $this->size['mediaBoxwidth'];
		$this->size['slideWidth'] = $this->size['preSlideWidth'] - (40 * 2);
		$this->size['slideContainerWidth'] = $this->size['slideWidth'] - 40;
		$this->size['slideHeight'] = @( $this->size['slideContainerWidth'] * 55) / 100;

		$this->size['slideImgWidth']  = floor( ( $this->size['slideContainerWidth'] * 35 ) / 100 );
		$this->size['slideImgHeight'] = floor( ( $this->size['slideImgWidth'] * 65 ) / 100 );

		if ( $args['post_columns'] == 'three' ) {
			$this->size['postWidth'] = ( @( $this->size['contentWidth'] / 3 ) - ( $args['colpad'] / 2 ) ) - ( $args['post_padding_width'] * 2 ) - 60; 
		} else {
			$this->size['postWidth'] = ( @( $this->size['contentWidth'] / 2 ) - ( $args['colpad'] / 2 ) ) - ( $args['post_padding_width'] * 2 ) - 70; 
		}

		$this->size['postMarginRight'] = floor( $args['colpad'] / 1.5 );

		$this->size['squeezewrap'] = $this->size['mainWidth'] - $args['area_padding_width'];
	
		if ( $this->size['squeezewrap'] > 740 ) {
			$this->size['squeezewrapwidth'] = 'width:740px;';
		} else {
			$this->size['squeezewrapwidth'] = '';
		}

		$this->size['squeezesidebarwidth'] = 300;
		$this->size['squeezecontentwidth'] = ( ( $this->size['mainWidth'] - $this->size['squeezesidebarwidth'] ) - $args['area_padding_width'] ) - 15;

		$this->size['fakesidebarwidth'] = 360;
		$this->size['fakeblogmainwidth'] = ( ( $this->size['mainWidth'] - $this->size['fakesidebarwidth'] ) - $args['area_padding_width'] ) - 15;
	
	}	

	function getSize()
	{
		return $this->size;
	}

	function setCustomCss()
	{
		$site_options   = maybe_unserialize(get_option('pt_site_options'));
		$design_options = maybe_unserialize(get_option('pt_design_options'));

		$options = array_merge( $site_options, $design_options );

		foreach ( $options as $value ) {
			$$value['id'] = $value['value'];
		}

		$wrap_padding_width = 0;
		$area_padding_width = ( $pt_theme['skins'] == 'default' OR $pt_theme['skins'] == 'march_2011' ) ? 0 : 40;

		$options = array(
			'layout' => $pt_layouts['layout'],
			'content' => $pt_layouts['content'],
			'side1' => $pt_layouts['side1'],
			'side2' => $pt_layouts['side2'],
			'post_columns' => $pt_post_columns,
			'footerbar_columns' => $pt_footerbar_columns,
			'header_height' => $pt_header_height,
			'member_header_height' => $pt_member_header_height,
			'area_padding_width' => $area_padding_width,
			'wrap_padding_width' => $wrap_padding_width,
			'default_header_height' => 165,
			'post_padding_width' => 0,
		);

		$this->setSize( $options );
		$s = $this->getSize();

		$this->css  = 'body{ ';

		if ( $pt_general_font_disable == 'false' ) {
			$body = new PtCss;
			$body->setFontStyle( $pt_general_text );
			$this->css .= $body->getFontStyle();
		}

		$this->css .= ' }' . "\n";

		if ( $pt_background['type']  == 'custom-background' ) {
			$this->css  .= 'body.sitebody { ';

			if ( $pt_background['upload'] != '' ) {
				$bg_image = ' url(' . $pt_background['upload'] . ') ' . $pt_background['repeat'] . ' ' . $pt_background['attach'] . ' ' . $pt_background['pos'];
			} else {
				$bg_image = '';
			}

			$this->css .= 'background:'. $pt_background['color'] . $bg_image . ';';

			$this->css .= ' }' . "\n";
		}

		$this->css .= '
		/* Formatting */
		h1, h2, h3, h4, h5 { padding: 10px 0; }
		a{ ';
		if ( $pt_general_font_disable == 'false' ) {
			$this->css .= 'color:' . $pt_link_color . ';'; 
		}
		$this->css .= 'text-decoration: underline; }';
		$this->css .= 'a:hover{ ';
		if ( $pt_general_font_disable == 'false' ) {
			$this->css .= 'color:' . $pt_link_hover_color . ';'; 
		}
		$this->css .= 'text-decoration: none; }';
		$this->css .= '
		blockquote p { padding: 5px 0; }

		/* thumbnail */
		.thumb-left{ float:left;margin:0 15px 10px 0;clear:left; }
		.thumb-right{ float:right;margin:0 0 10px 15px;clear:right;}

		/* Container */
		#wrapper{ width:' . $s['mainWidth'] . 'px; }
		#before-header-bg{}
		#before-header{ margin:0 auto;width:' . $s['mainWidth'] . 'px; }
		';

		$this->css .= '#header-bg{ height:' . $s['headerHeight'] . 'px; }' . "\n";
		$this->css .= '#header{ position:relative;margin:0 auto;width:' . $s['mainWidth'] . 'px;height:' . $s['headerHeight'] . 'px; }';

		$this->css .= '
		#after-header-bg{}
		#after-header{ margin:0 auto; width:' . $s['mainWidth'] . 'px; }
		#mediabox{ margin-bottom:20px;width:' . pt_isset($s['mediaBoxWidth']) . 'px; }
		#mainarea{}
		#bottom-widget{ margin:0 auto;width:' . $s['mainWidth'] . 'px;}

		/* Columns */
		#main-column{ margin:0 ' . $s['contentRightMargin'] . 'px 0 0;width:' . $s['contentWidth'] . 'px;padding:0;}
		#sidebar1-column{ width:' . $s['side1Width'] . 'px;margin:0 ' . $s['side1RightMargin'] . 'px 0 ' . $s['side1RightMargin'] . 'px;padding:0; overflow:hidden; }
		#sidebar2-column{ width:' . $s['side2Width'] . 'px;margin:0 ' . $s['side2RightMargin'] . 'px 0 ' . $s['side1RightMargin'] . 'px;padding:0; overflow:hidden; }
		#bottom-left{ width:' . $s['botWidgetWidth'] . 'px; }
		#bottom-center{ width:' . $s['botWidgetWidth'] . 'px; }
		#bottom-right{ width:' . $s['botWidgetWidth'] . 'px; }
		#bottom-right2{ width:' . $s['botWidgetWidth'] . 'px; }

		/* Header */
		';

		$this->css .= '#header-image{';
		switch ( $pt_header_background['type'] ) {
			/*
			case 'pre-made-hbackground':
				$premade = explode( '|', $pt_header_background['premade'] );
				$this->css .= 'background:url(../images/headers/' . $premade[3] . '/' . $premade[0] . ') ' . $premade[1] . ' ' . $premade[2] . ';';
				break;
			*/
			case 'custom-hbackground':
				$this->css .= 'background:url(' . $pt_header_background['upload'] . ') no-repeat ' . $pt_header_background['align'] . ';';
				break;
		}

		$this->css .= 'height:' . $s['headerHeight'] . 'px; display:block; }' . "\n";
		$this->css .= '#header #logo{ padding-top:' . $s['headerPadTop'] . 'px; z-index: 50; }' . "\n";
		
		$this->css .= '#header-member-image{';
		switch ( $pt_member_header_background['type'] ) {
			/*
			case 'pre-made-hbackground':
				$premade = explode( '|', $pt_member_header_background['premade'] );
				$this->css .= 'background:url(../images/headers/' . $premade[0] . ') ' . $premade[1] . ' ' . $premade[2] . ';';
				break;
			*/
			case 'custom-hbackground':
				$this->css .= 'background:url(' . $pt_member_header_background['upload'] . ') no-repeat ' . $pt_member_header_background['align'] . ';';
				break;
		}

		$this->css .= 'height:' . $s['memberheaderHeight'] . 'px; display:block; }' . "\n";

		$this->css .= '#header #logo h1 a, #header #logo h1 a:hover { ';
		if ( $pt_logo_font_disable == 'false' ) {
			$site_name = new PtCss;
			$site_name->setFontStyle( $pt_site_name );
			$this->css .= $site_name->getFontStyle();
		}
		$this->css .= 'text-decoration:none; }' . "\n";

		$this->css .= '#header #logo .description { ';
		if ( $pt_logo_font_disable == 'false' ) {
			$site_desc = new PtCss;
			$site_desc->setFontStyle( $pt_site_desc );
			$this->css .= $site_desc->getFontStyle();
		}
		$this->css .= 'text-decoration:none; }' . "\n";

		$this->css .= '
		/* Header RSS */
		#header .header_rss{ position:absolute;top:' . $s['rssTop'] . 'px;left:' . $s['rssLeft'] . 'px;width:128px;height:' . $s['rssHeight'] . 'px;overflow:hidden; }
		
		/* Header Search */
		#header .header_search{ position:absolute;top:' . $s['searchTop'] . 'px;left:' . $s['searchLeft'] . 'px;height:35px;width:181px; }
		
		/* Header Ads */
		#header .header_ads{ position:absolute;top:' . $s['adTop'] . 'px;left:' . $s['adLeft'] . 'px;height:60px;width:468px; }

		/* Header Optin */
		#header .header_optin{ position:absolute;top:0;left:' . $s['optLeft'] . 'px;height:' . $s['headerOptinHeight'] . 'px;width:255px;padding:5px 10px; }
		';

		$this->css .= '#header .header_optin{';
		$headopt = new PtCss;
		$headopt->setFontStyle( $pt_headeroptin_text_font );
		$this->css .= $headopt->getFontStyle();
		$this->css .= ' }' . "\n";

		$this->css .= '#header .header_optin .header_optin_text{';
		$headopt2 = new PtCss;
		$headopt2->setFontStyle( $pt_headeroptin_headline_font );
		$this->css .= $headopt2->getFontStyle();
		$this->css .= ' }' . "\n";

		$this->css .= '/* Before Header Navigation */ ' . "\n" . '#nav1 a{ ';
		if ( $pt_tnav1_font_disable == 'false' ) {
			$tnav1 = new PtCss;
			$tnav1->setFontStyle( $pt_tnav1_link );
			$this->css .= $tnav1->getFontStyle();
		}
		$this->css .= ' }' . "\n";
		
		$this->css .= '#nav1 a:hover{ ';
		if ( $pt_tnav1_font_disable == 'false' ) {
			$tnav1_hover = new PtCss;
			$tnav1_hover->setFontStyle( $pt_tnav1_link_hover );
			$this->css .=  $tnav1_hover->getFontStyle();
		}
		$this->css .= ' }' . "\n";

		$this->css .= '/* After Header Navigation */' . "\n" . '#nav2 a{ ';

		if ( $pt_tnav2_font_disable == 'false' ) {
			$tnav2 = new PtCss;
			$tnav2->setFontStyle( $pt_tnav2_link );
			$this->css .= $tnav2->getFontStyle();
		}

		$this->css .= ' }' . "\n";

		$this->css .= '#nav2 a:hover{ ';
		if ( $pt_tnav2_font_disable == 'false' ) {
			$tnav2_hover = new PtCss;
			$tnav2_hover->setFontStyle( $pt_tnav2_link_hover );
			$this->css .= $tnav2_hover->getFontStyle();
		}
		$this->css .= ' }' . "\n";

		$this->css .= '
		/* Gallery */
		#gallery{ position:relative;width:' . $s['contentWidth'] . 'px;height:' . $s['galleryHeight'] . 'px;margin-bottom:15px; }
		#gallery a { float:left;position:absolute; }
		#gallery a img { border:none; }
		#gallery a.show { z-index:500; }
		#gallery .caption { z-index:600;background:#000;color:#ffffff;height:90px;width:' . $s['contentWidth'] . 'px;position:absolute;bottom:0; }
		#gallery .caption .content { margin:5px; }
		#gallery .caption .content h3 { margin:0;padding:0 20px;color:#FFF; }
		#gallery .caption .content h3 a { text-decoration:none;color:#FFF; }
		#gallery .caption .content h3 a:hover { text-decoration:underline;color:#FFF; }
		#gallery .caption .content p { margin:0;padding:0 20px;color:#FFF; }

		/* Slideshow */
		#slideshow { margin:0 auto;width:' . $s['preSlideWidth'] . 'px;height:263px;position:relative; }
		#slideshow #slidesContainer { margin:0 auto;width:' . $s['slideWidth'] . 'px;height:263px;overflow:auto;position:relative; }
		#slideshow #slidesContainer .slide { margin:0 auto;width:' . $s['slideContainerWidth'] . 'px;height:263px; }
		.control{ display:block;width:39px;height:263px;text-indent:-10000px;position:absolute;cursor: pointer; }
		#leftControl{ top:0;left:0; }
		#rightControl{ top:0;right:0; }
		.slide h3, .slide p { margin:10px; }
		.slide img { float:right;margin:0 0 0 10px; }
		#slideIndex{ left: 60px;bottom: 10px;position: absolute;}
		';

		$this->css .= '.slide h3{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= ' }' . "\n";

		$this->css .= '.slide h3 a{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= ' }' . "\n";
	
		$this->css .= '.slide h3 a:hover{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= ' }' . "\n";

		$add_line_height  = floor( ( $pt_post_text['size'] / 100 ) * 60 );
		$post_line_height = $pt_post_text['size'] + $add_line_height;

		$this->css .= '.slide p { ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_text = new PtCss;
			$post_text->setFontStyle( $pt_post_text );
			$this->css .= $post_text->getFontStyle();
		}
		$this->css .= 'line-height:' . $post_line_height . 'px;';
		$this->css .= ' }' . "\n";

		$jcarousel_height = ( $pt_tags_loop == 'true') ? '300' : '260';
		if ( $pt_theme['skins'] == 'march_2011' ) {
			$post_width = $s['postWidth'] - 40;
		} else {
			$post_width = $s['postWidth'];
		}

		$this->css .= '
		/* Loop Slider */
		.loopfeatured{}
		.container{ width:' . $s['contentWidth'] . 'px;height:' . pt_isset($pt_normal_featured_height) . 'px;overflow:hidden;position:relative;cursor:pointer; }
		.slides{ position:absolute;top:0;left:0;list-style:none;padding:0;margin:0; }
		.slides li{ position:absolute;top:40px;width:' . $s['contentWidth'] . 'px;display:none;padding:0;margin:0; }
		#loopedSlider,#newsSlider{ margin:0 auto;width:' . $s['contentWidth'] . 'px;position:relative;clear:both; }
		.slides li{ padding-bottom:20px; }

		/* Carousel */
		.jcarousel-skin-pt .jcarousel-container { border: none; }
		.jcarousel-skin-pt .jcarousel-direction-rtl { direction: rtl; }
		.jcarousel-skin-pt .jcarousel-container-horizontal { width:' . $s['contentWidth'] . 'px; padding: 0; }
		.jcarousel-skin-pt .jcarousel-container-vertical { width:' . $s['contentWidth'] . 'px; height: ' . $jcarousel_height . 'px; padding: 0; }
		.jcarousel-skin-pt .jcarousel-clip-horizontal { width:' . $s['contentWidth'] . 'px;height:' . $jcarousel_height . 'px; }
		.jcarousel-skin-pt .jcarousel-clip-vertical { width:' . $s['contentWidth'] . 'px; height: ' . $jcarousel_height . 'px; }
		.jcarousel-skin-pt .jcarousel-item { width:' . $s['contentWidth'] . 'px;height: ' . $jcarousel_height . 'px; }

		/* Post */
		.post {padding:20px;}
		.postwidth1{}
		.postwidth2{ width:' . $post_width . 'px;float:left;overflow:hidden;}
		.postwidth3{ width:' . $post_width . 'px;float:left;margin-right:' . $s['postMarginRight'] . 'px; overflow:hidden;}
		';

		$this->css .= '.entry{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_text = new PtCss;
			$post_text->setFontStyle( $pt_post_text );
			$this->css .= $post_text->getFontStyle();
			$this->css .= 'line-height:'.$post_line_height.'px;';
		}
		$this->css .= ' }';

		$this->css .= '.entry h1.postitle{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= ' }';

		$this->css .= '.entry h1.postitle a{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= 'text-decoration:none';
		$this->css .= ' }';

		$this->css .= '.entry h1.postitle a:hover{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= 'text-decoration:underline';
		$this->css .= ' }';

		$this->css .= '.entry h2.postitle{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= ' }';

		$this->css .= '.entry h2.postitle a{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= 'text-decoration:none';
		$this->css .= ' }';

		$this->css .= '.entry h2.postitle a:hover{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_title = new PtCss;
			$post_title->setFontStyle( $pt_post_title );
			$this->css .= $post_title->getFontStyle();
		}
		$this->css .= 'text-decoration:underline';
		$this->css .= ' }';

		$this->css .= '.entry .post-bylines { ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_bylines = new PtCss;
			$post_bylines->setFontStyle( $pt_post_meta );
			$this->css .= $post_bylines->getFontStyle();
		}
		$this->css .= ' }';

		$this->css .= '.postags { ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_meta = new PtCss;
			$post_meta->setFontStyle( $pt_post_meta );
			$this->css .= $post_meta->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '.postmetadata{ ';
		if ( $pt_post_font_disable == 'false' ) {
			$post_meta = new PtCss;
			$post_meta->setFontStyle( $pt_post_meta );
			$this->css .= $post_meta->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '
		/* Sidebar */
		#sidebar{}
		#sidebar ul { margin:0;padding:0;}
		';

		$this->css .= '#sidebar ul li {';
		if ( $pt_sidebar_font_disable == 'false' ) {
			$sidebar_text = new PtCss;
			$sidebar_text->setFontStyle( $pt_sidebar_text );
			$this->css .= $sidebar_text->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '#sidebar ul li h2 { ';
		if ( $pt_sidebar_font_disable == 'false' ) {
			$sidebar_title = new PtCss;
			$sidebar_title->setFontStyle( $pt_sidebar_title );
			$this->css .= $sidebar_title->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '#sidebar ul li ul li a { ';
		if ( $pt_sidebar_font_disable == 'false' ) {
			$sidebar_text = new PtCss;
			$sidebar_text->setFontStyle( $pt_sidebar_text );
			$this->css .= $sidebar_text->getFontStyle();
		}	
		$this->css .= 'text-decoration:none';
		$this->css .= ' }';

		$this->css .= '#sidebar ul li ul li a:hover { ';
		if ( $pt_sidebar_font_disable == 'false' ) {
			$sidebar_text = new PtCss;
			$sidebar_text->setFontStyle( $pt_sidebar_text );
			$this->css .= $sidebar_text->getFontStyle();
		}	
		$this->css .= 'text-decoration:underline';
		$this->css .= ' }';

		$this->css .= '#membership-column {';
		if ( $pt_sidebar_font_disable == 'false' ) {
			$member_menu_text = new PtCss;
			$member_menu_text->setFontStyle( $pt_sidebar_text );
			$this->css .= $member_menu_text->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '
		/* Bottom Widget */
		#bot-widget{}
		#bot-widget ul {}
		';

		$this->css .= '#bot-widget ul li { ';
		if ( $pt_footerbar_font_disable == 'false' ) {
			$footerbar_text = new PtCss;
			$footerbar_text->setFontStyle( $pt_footerbar_text );
			$this->css .= $footerbar_text->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '#bot-widget ul li h2 { ';
		if ( $pt_footerbar_font_disable == 'false' ) {
			$footerbar_title = new PtCss;
			$footerbar_title->setFontStyle( $pt_footerbar_title );
			$this->css .= $footerbar_title->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '#bot-widget ul li ul li a { ';
		if ( $pt_footerbar_font_disable == 'false' ) {
			$footerbar_text = new PtCss;
			$footerbar_text->setFontStyle( $pt_footerbar_text );
			$this->css .= $footerbar_text->getFontStyle();
		}	
		$this->css .= 'text-decoration:none';
		$this->css .= ' }';

		$this->css .= '#bot-widget ul li ul li a:hover { ';
		if ( $pt_footerbar_font_disable == 'false' ) {
			$footerbar_text = new PtCss;
			$footerbar_text->setFontStyle( $pt_footerbar_text );
			$this->css .= $footerbar_text->getFontStyle();
		}	
		$this->css .= 'text-decoration:underline';
		$this->css .= ' }';

		$this->css .= '
		#bot-widget ul li ul li ul{ list-style:circle; margin:5px 15px 0 15px;padding:0; }
		#bot-widget ul li ul li ul li{ margin:0;padding:2px 0; }
		';

		$this->css .= '
		/* Footer */
		#footer{ margin:0 auto; width:' . $s['mainWidth'] . 'px;';
		if ( $pt_footer_font_disable == 'false' ) {
			$footer_text = new PtCss;
			$footer_text->setFontStyle( $pt_footer_text );
			$this->css .= $footer_text->getFontStyle();
		}	
		$this->css .= ' }';

		$this->css .= '#footer a{ ';
		#footer{ margin:0 auto; width:' . $s['mainWidth'] . 'px;';
		if ( $pt_footer_font_disable == 'false' ) {
			$footer_text = new PtCss;
			$footer_text->setFontStyle( $pt_footer_text );
			$this->css .= $footer_text->getFontStyle();
		}	
		$this->css .= 'text-decoration:underline';
		$this->css .= ' }';

		$this->css .= '#footer a:hover{ ';
		#footer{ margin:0 auto; width:' . $s['mainWidth'] . 'px;';
		if ( $pt_footer_font_disable == 'false' ) {
			$footer_text = new PtCss;
			$footer_text->setFontStyle( $pt_footer_text );
			$this->css .= $footer_text->getFontStyle();
		}
		$this->css .= 'text-decoration:none';
		$this->css .= ' }';

		$this->css .= '#popupOptin{';
		$popopt = new PtCss;
		$popopt->setFontStyle( $pt_popup_text_font );
		$this->css .= $popopt->getFontStyle();
		$this->css .= ' }' . "\n";

		$this->css .= '#popupOptin h1{';
		$popopt2 = new PtCss;
		$popopt2->setFontStyle( $pt_popup_headline_font );
		$this->css .= $popopt2->getFontStyle();
		$this->css .= ' }' . "\n";

		$this->css .= '
		#squeezewrap ul{ list-style:disc;margin:10px 0;padding:0 0 0 30px; }
		#squeezewrap ul li{ margin:0;padding:10px 0; }
		';
		
		$this->css .= '#squeezesidebar{ float:right;width:' . $s['squeezesidebarwidth'] . 'px;';
		$this->css .= '}';

		$this->css .= '
		
		
		';

	}

	function setFontStyle( $stored )
	{
		$this->_fontStyle .= 'color:' . $stored['color'] . ';font-family:' . stripslashes( $stored['face'] ) . ' !important;font-size:' . $stored['size'] . 'px !important;';

		switch ( $stored['style'] ) {
			case 'italic':
				$this->_fontStyle .= 'font-style:italic;';
				$this->_fontStyle .= 'font-weight:normal;';
				break;
			case 'bold/italic':
				$this->_fontStyle .= 'font-style:italic;';
				$this->_fontStyle .= 'font-weight:bold;';
				break;
			case 'bold':
				$this->_fontStyle .= 'font-style:normal;';
				$this->_fontStyle .= 'font-weight:bold;';
				break;
			case 'normal':
				$this->_fontStyle .= 'font-style:normal;';
				$this->_fontStyle .= 'font-weight:normal;';
				break;
		}
	}

	function getFontStyle()
	{
		return $this->_fontStyle;
	}
}

function pt_write_css()
{
	if ( is_writable( PT_CSS . '/custom.css' ) ) {
		$style = new PtCss;
		$style->setCustomCss();
		$css = @fopen( PT_CSS . '/custom.css', 'w' );
		@fwrite( $css, $style->css );
		@fclose( $css );
	}
}
