<?php

class PtLaunch {
	/** 
	* Post Data
	*
	* @var object
	* @access protected
	*/
	protected $post;

	/** 
	* Launch Settings
	*
	* @var array
	* @access protected
	*/
	protected $options;
	
	/** 
	* Launch Type
	*
	* @var string
	* @access protected
	*/
	protected $type;

	/** 
	* Launch Pages
	*
	* @var array
	* @access protected
	*/
	protected $pages;

	/** 
	* Launch Pages Order
	*
	* @var array
	* @access protected
	*/
	protected $order;

	/** 
	* Subscription info
	*
	* @var Boolean
	* @access public
	* @see isSubscriber()
	*/
	public $subscribe = false;

	/**
 	* Check if visitor already subscribed to the launch funnel
 	*
 	* @since 1.1.3
 	*
 	* @uses $wpdb to query the database
 	* @param int $post_id. Post ID to retrieve categories.
 	* @param array $exclude. List of uncloneable elements that already used.
 	* @return string of elements list
 	*/
	function __construct( $post_id, $options )
	{
		foreach ( $options as $value ) {
			$this->options[$value['id']] = $value['value'];
		}

		$this->postID = $post_id;
		$this->type = $this->options['pt_launch_mode'];
		$this->pages = $this->options['pt_launch_pages']['pages'];
	
		$order = explode("|", $this->options['pt_launch_pages']['order'] );
		$this->order = $order;
	}

	/**
 	* Check if the current page is a launch page
 	*
 	* @since 1.1.3
 	* @return boolean
 	*/
	protected function isLaunchPage()
	{
		if ( !is_array( $this->pages ) ) return false;
		if ( !in_array( $this->postID, $this->pages) ) return false;
		
		return true;
	}

	/**
 	* Check if the current page is the entry page
 	*
 	* @since 1.1.3
 	* @return boolean
 	*/
	protected function isEntryPage()
	{
		if ( $this->postID != $this->options['pt_launch_entry'] ) return false;
		
		return true;
	}

	/**
 	* Check if visitor is already subscribe to the launch funnel
 	*
 	* @since 1.1.3
 	* @return boolean
 	*/
	protected function isSubscriber()
	{
		if ( !isset($_COOKIE['pt-subscribed']) ) return false;

		return true;
	}

	/**
 	* Check if the page is the first evergreen launch page in sequence
 	*
 	* @since 1.1.3
 	* @return boolean
 	*/
	protected function isEvergreenFirstPage()
	{
		$page = array_search( $this->postID, $this->order );
		if ( $page != 0 ) return false;
		
		return true;
	}

	/**
 	* Get launch type
 	*
 	* @since 1.1.3
 	* @return string
 	*/
	public function getLaunchType()
	{
		return $this->options['pt_launch_mode'];
	}

	/**
 	* Get entry or launch squeeze Page
 	*
 	* @since 1.1.3
 	* @return string
 	*/
	protected function getEntryPage()
	{
		return ( ($this->options['pt_launch_entry'] != '') ? get_permalink($this->options['pt_launch_entry']) : get_bloginfo('siteurl') );
	}

	/**
 	* Get number of order in the launch sequence
 	*
 	* @since 1.1.3
 	* @return int
 	*/
	protected function getLaunchOrder()
	{
		return ( array_search($this->postID, $this->order ) );
	}

	/**
 	* Get One Time/Real Launch Release Time
 	*
 	* @since 1.1.3
 	* @return int
	* @uses get_post_meta()
 	*/
	protected function getReleaseTime( $post_id )
	{
		$meta = get_post_meta( $post_id, 'pt_launch_data', true );
			
		$hour = (int) pt_isset($meta['hour']);
		$minute = (int) pt_isset($meta['minute']);
		$month = (int) pt_isset($meta['month']);
		$day = (int) pt_isset($meta['day']);
		$year = (int) pt_isset($meta['year']);

		$release_time = mktime($hour, $minute, 0, $month, $day, $year);

		return $release_time;
	}

	/**
 	* Get the latest released launch page if user set
	* launch type to normal/real/standard launch mode 
 	*
 	* @since 1.1.3
 	* @return int
 	*/
	protected function getCurrentRealLaunchPage()
	{
		for ( $i = 0; $i < count( $this->order ); $i++ ) {
			$current = 0;
			$now  = time();
			$rel = $this->getReleaseTime( $this->order[$i] );

			if ( $now < $rel ) {//if $this->order[$i] is not released yet
				/**
				* if release time for the first page is still on the way,
				* then just send the visitor to the coming soon page.
				*/ 
				if ( $i == 0 ) { 
					$current = $this->options['pt_launch_soon'];
					break;
				} else {
					$count = $i - 1;
					$current = $this->order[$count];
				}
				break;//out of loop
			}

			if ( $current == 0 ) {
				$current = $this->order[$i];
			}
		}

		return $current;
	}

	/**
 	* Get the latest released launch page if user set
	* launch type to evergreen launch mode 
 	*
 	* @since 1.1.3
 	* @return int
	* Revised 28 Aug 2011
 	*/
	protected function getCurrentEvergreenLaunchPage()
	{
		$current = $this->order[0];
		for ( $i = 1; $i < count($this->order); $i++ ) {
			
			if ( isset($_COOKIE['pt-evergreen-' . $i]) ) {//this is the last cookie created when subscriber visit the page
				$current = $this->order[$i];
			}else
				break;
		}
		
		return $current;
	}

	/**
 	* Get the latest released launch page
 	*
 	* @since 1.1.3
 	* @return int
 	*/
	protected function getCurrentLaunchPage()
	{
		return ( ($this->type == 'evergreen') ? $this->getCurrentEvergreenLaunchPage() : $this->getCurrentRealLaunchPage() ); 
	}

	/**
 	* Get previously released launch page ID
 	*
 	* @since 1.1.3
	* @return int
 	*/
	protected function getPreviousLaunchPage()
	{
		$page_key = array_search( $this->postID, $this->order );
		$previous_page_key = $page_key - 1;

		if ( $previous_page_key < 0 ) {
			$previous_page = $this->options['pt_launch_entry'];
		} else {
			$previous_page = $this->order[$previous_page_key];
		}

		return $previous_page;
	}

	/**
 	* Redirect subscribers to current launch page 
	* if they visit the squeeze page
 	*
 	* @since 1.1.3
	* @uses wp_redirect()
 	*/
	function redirectSubscriber()
	{
		if ( $this->isEntryPage() ) {
			if ( $this->isSubscriber() ) {
				wp_redirect( get_permalink($this->getCurrentLaunchPage()) );
				die;
			}
		}
	}

	/**
 	* Redirect non-subscriber to entry page if user set 
	* the 'Force Opt-in' option to true
 	*
 	* @since 1.1.3
	* @uses wp_redirect()
 	*/
	function redirectNonSubscriber()
	{
		if ( $this->isLaunchPage() && !$this->isSubscriber() ) {
			if ( $this->options['pt_launch_force'] == 'true' ) {
				wp_redirect( $this->getEntryPage() );
				die;
			}
		}
	}

	/**
 	* Set a launch 'subscribed' cookie if someone just opted-in
	* to the launch list so the next time they visit the squeeze page
	* or launch page, they don't need to subscribe again
 	*
 	* @since 1.1.3
	* @uses wp_redirect()
 	*/
	function setNewSubscriber()
	{
		if ( isset($_GET['set']) && $_GET['set'] == md5($this->postID) ) {
			if ( !$this->isSubscriber() ) {
				$expired = time() + (60 * 60 * 24 * 365);
				setcookie( "pt-subscribed", $this->postID, $expired, COOKIEPATH );
			}

			$redirect_ID = ( $this->type == 'evergreen' ) ? $this->postID : $this->getCurrentRealLaunchPage();
			wp_redirect(get_permalink($redirect_ID));
			die;
		}
	}

	/**
 	* If visitors try to open an unrelease one time/real launch page, 
	* then they will be brought to the previously released launch page
 	*
 	* @since 1.1.3
	* @uses wp_redirect()
	* Revised 28 Aug 2011
 	*/
	function unreleaseRealLaunchPageRedirect()
	{
		$now  = time();
		$rel = $this->getReleaseTime( $this->postID );
		
		if ( $now < $rel ) {
			$redirect_id = $this->getCurrentLaunchPage();
			wp_redirect(get_permalink($redirect_id));
			die;
		}
	}

	/**
 	* If visitors try to open an unrelease evergreen launch page, 
	* then they will be brought to the previously released launch page
 	*
 	* @since 1.1.3
	* @uses wp_redirect()
	* Revised 28 Aug 2011
 	*/
	function unreleaseEvergreenPageRedirect()
	{		
		if ( !$this->isEvergreenFirstPage() ) {
			$sequence = $this->getLaunchOrder();
			$previous_num = $sequence - 1;

			// if force optin is set to true
			if ( !isset( $_COOKIE['pt-evergreen-' . $previous_num] ) ) {
				wp_redirect(get_permalink($this->getCurrentLaunchPage()) );
				die;
			}
		}
	}

	/**
 	* If visitors try to open an unrelease launch page, 
	* then they will be brought to the previously released launch page
 	*
 	* @since 1.1.3
	* @uses wp_redirect()
 	*/
	function unreleaseLaunchPageRedirect()
	{
		if ( $this->getLaunchType() == 'evergreen') {
			$this->unreleaseEvergreenPageRedirect();
		} else {
			$this->unreleaseRealLaunchPageRedirect();
		}
	}

	/**
 	* Set evergreen launch page cookie
 	*
 	* @since 1.1.3
	* @return string
 	*/
	function evergreenCookie()
	{
		$output = '';
		if ( $this->isLaunchPage() && $this->getLaunchType() == 'evergreen' ) {
			$sequence = $this->getLaunchOrder();
			$output .= '<script type="text/javascript">' . "\n";

			if ( !isset( $_COOKIE['pt-evergreen-last-visit'] ) ) { 
				$output .= "SetCookie('pt-evergreen-last-visit', '" . $sequence . "', 365);\n";
			} else {
				if ( $_COOKIE['pt-evergreen-last-visit'] < $sequence ) {
					$output .= "SetCookie('pt-evergreen-last-visit', '', -1);\n";
					$output .= "SetCookie('pt-evergreen-last-visit', '" . $sequence . "', 365);\n";
				}
			}

			$output .= "SetCookie('pt-evergreen-" . $sequence . "', '" . time() . "', 365);\n";
			$output .= '</script>';
		}

		return $output;
	}

	/**
 	* Handle all launch pages
 	*
 	* @since 1.1.3
 	*/
	function buildLaunchPage()
	{
		// if this is the launch opt-in thank you page
		$this->setNewSubscriber();

		// if this is the launch entry page and check whether the visitor is already subscribed or not
		$this->redirectSubscriber();

		// check if this page is one of the launch pages in the sequence
		if ( $this->isLaunchPage() ) {
			// This will handle the non-subscriber (only if force opt-in set to true)
			$this->redirectNonSubscriber();

			// redirect if the launch page is unreleased
			$this->unreleaseLaunchPageRedirect();
		}
	}
}