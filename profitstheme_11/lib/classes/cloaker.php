<?php

class PtCloaker {
	
	var $linkID = 0;
	var $cloaker = '';
	var $prefix = '';
	var $urlPattern = '@(<a[\s]+[^>]*href\s*=\s*)(?: "([^">]+)" | \'([^\'>]+)\' )([^<>]*>)(.*?)(</a>)@xsi';

	function PtLinkCloaker()
	{
		global $pt_cloak_prefix, $pt_cloak_enable;

		$this->prefix = $pt_cloak_prefix != '' ? $pt_cloak_prefix : 'recommends';
		$this->cloaker = PT_FUNCTIONS . '/cloaker.php';
	
		if( $pt_cloak_enable == 'true' ) {
			add_filter( 'the_content', array( &$this, 'contentFilter' ), -200 ); 
			add_filter( 'mod_rewrite_rules', array( &$this, 'rewriteRules' ) );
		}
 	}

	function contentFilter( $post_content )
	{
		global $pt_uncloak_pages, $pt_uncloak_posts;

		if ( is_page() ) {
			if( $pt_uncloak_pages == 'true' ) 
				return $post_content;
		} else if ( $pt_uncloak_posts == 'true' ) {
				return $post_content;
		}	
	
		$this->linkID = 0;
		$post_content = preg_replace_callback( $this->urlPattern, array( &$this,'linkRewriteCallback' ), $post_content );

		return $post_content;
 	}

	function linkRewriteCallback( $matches )
	{
		global $post, $pt_cloak_excp_domains, $pt_cloak_nofollow;
	
		$this->linkID++;
	
		if ( $matches[2] != '' ) {
			$url = $matches[2];
		} else {
			$url = $matches[3];
		}

		$url = ltrim( $url );
	
		$parts = @parse_url( $url );
	
		if ( !$parts || !isset( $parts['scheme'] ) || !isset( $parts['host'] ) ) {
			return $matches[0];
		}
	
		$exceptions = array_filter( preg_split( '/[\s,\r\n]+/', $pt_cloak_excp_domains ) );
		if ( array_search( strtolower($parts['host'] ), $exceptions ) !== false ) return $matches[0];
		
		$url = $this->getCloakedLink( $matches[5], $post->ID, $this->linkID );
	
		$link = $matches[1] . '"' . $url . '"' . $matches[4] . $matches[5] . $matches[6];
	
		if ( $pt_cloak_nofollow == 'true' ) {
			$link = str_replace( '<a ','<a rel="nofollow" ', $link );
		}

		return $link;
 	}

	function getCloakedLink( $anchor_text = '', $post_id = null, $linkID = 0 )
	{
	
		$base = get_option( 'home' );
	
		if ( $base == '' ) {
			$base = get_option( 'siteurl' );
		}
	
		
		$url = trailingslashit( $base ) . $this->prefix . '/'; 

		if ( !empty( $anchor_text ) ){
			if ( !empty( $post_id ) ) {
				$url .= intval ( $post_id ) . '/';
				if ( !empty( $linkID ) ) {
					$url .= intval( $linkID ) . '/';
				}
			}

			$url .= $this->getTextLink( $anchor_text );
			
		}
	
		return $url;
 	}

	function getTextLink( $anchortext )
	{
		$anchortext = strip_tags( $anchortext );
		$anchortext = preg_replace( '/[^a-z0-9_]+/i', '_', $anchortext );
	
		if ( strlen( $anchortext ) < 1 ) { 
			$anchortext = 'link'; 
		}

		return $anchortext;
 	}

	function rewriteRules( $rules )
	{
		global $wp_rewrite;

		$cloaker = $this->cloaker;

		$pattern = '^' . $this->prefix . '/([0-9]+)/([0-9]+)/([^/]*)?$';
		$replacement = $cloaker . '?post_id=$1&link_id=$2&cloaked_url=$0';
	
		$myrules  = "\n# PT Cloaker BEGIN\n";
		$myrules .= "<IfModule mod_rewrite.c>\n";
		$myrules .= "RewriteEngine On\n";
		$myrules .= "RewriteRule $pattern $replacement [L]\n";
		$myrules .= "</IfModule>\n";
		$myrules .= "# PT Cloaker ENDS\n\n";
	
		$rules = $myrules . $rules;
	
		return $rules;
 	}

}

$cloak = new PtCloaker;
$cloak->PtLinkCloaker();