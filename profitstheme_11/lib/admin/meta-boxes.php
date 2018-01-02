<?php
function pt_add_post_meta_box()
{
 	global $pt_post_meta_box;
	pt_meta_machine( $pt_post_meta_box );
}

function pt_add_script_meta_box() 
{
 	global $pt_script_meta_box;
	pt_meta_machine( $pt_script_meta_box );
}

function pt_add_landing_meta_box()
{
 	global $pt_landing_meta_box;
	pt_landing_machine( $pt_landing_meta_box );
}

function pt_add_seo_meta_box()
{
 	global $pt_seo_meta_box;
	pt_meta_machine( $pt_seo_meta_box );
}

function pt_add_member_meta_box()
{
 	global $pt_member_meta_box;
	pt_meta_machine( $pt_member_meta_box );
}

function pt_create_meta_box()
{

  	if ( function_exists( 'add_meta_box' ) ) {
    	add_meta_box( 'pt-post-meta-box', 'PT Custom Fields (optional)', 'pt_add_post_meta_box', 'post', 'normal', 'high' );
		add_meta_box( 'pt-seo-meta-box', 'PT - SEO Custom Fields (optional)', 'pt_add_seo_meta_box', 'post', 'normal', 'high' );
		add_meta_box( 'pt-landing-meta-box', 'PT - Landing Page Layout Settings (only used when creating a sales/squeeze/product launch/landing page)', 'pt_add_landing_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'pt-member-meta-box', 'PT - Membership Site Template Settings (optional)', 'pt_add_member_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'pt-seo-meta-box', 'PT SEO Custom Fields (optional)', 'pt_add_seo_meta_box', 'page', 'normal', 'high' );
		add_meta_box( 'pt-script-meta-box', 'PT - Custom Scripts (optional)', 'pt_add_script_meta_box', 'page', 'normal', 'high' );
	}
}

function pt_save_post_meta( $post_id )
{
	global $pt_post_meta_box;
	pt_meta_save( $post_id, $pt_post_meta_box );
}

function pt_save_script_meta( $post_id )
{  	
	global $pt_script_meta_box;
	pt_meta_save( $post_id, $pt_script_meta_box );
}

function pt_save_seo_meta( $post_id )
{  	
	global $pt_seo_meta_box;
	pt_meta_save( $post_id, $pt_seo_meta_box );
}

function pt_save_landing_meta( $post_id )
{  	
	global $pt_landing_meta_box;
	
	//die(var_dump($pt_landing_meta_box));
	pt_meta_save( $post_id, $pt_landing_meta_box );
}

function pt_save_member_meta( $post_id )
{  	
	global $pt_member_meta_box;
	pt_meta_save( $post_id, $pt_member_meta_box );
}

function pt_meta_save( $post_id, $pt_meta_box_data )
{
	//echo '<pre>';
	//print_r($_POST);
	//die();
	if ( !wp_verify_nonce( pt_isset($_POST['pt_meta_nonce']), plugin_basename(__FILE__) ) ) { 
		return $post_id; 
	}
		
	if ( 'page' == pt_isset($_POST['post_type'])  ) {
  		if ( !current_user_can( 'edit_page', $post_id ) ) return $post_id;
	} else {
  		if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
	}
	
	$meta = array();
	foreach ( $pt_meta_box_data as $meta_box ) {
		
		if(pt_isset($meta_box['id'])){
			if ( is_array( pt_isset($meta_box['std']) ) ){
				//die(var_dump($meta_box));
				$optkey = array();
				$optstored = array();
				foreach ( $meta_box['std'] as $key => $stored) {
					$optkey[] = $key;
					$optstored [] = pt_isset($_POST[ $meta_box['id'] . '_' . $key ]); 
				}
		
				$data = array_combine( $optkey, $optstored );
				$meta[$meta_box['id']] = $data;
	
			} else if ( pt_isset($meta_box['type']) == 'memberdownload' ) {
			
				$ftype = pt_isset($_POST[$meta_box['id'] . '_type']);
				$ffile = pt_isset($_POST[$meta_box['id'] . '_file']);
				$ftext = pt_isset($_POST[$meta_box['id'] . '_text']);
	
				$data = array();
				for ( $i = 0; $i < count($ffile); $i ++ ) {
					if ( !empty($ffile[$i]) && !empty($ftext[$i])) {
						$data[] = array(
								'type' => $ftype[$i],
								'url' => $ffile[$i],
								'text' => $ftext[$i],
						);
					}
				}
	
				$meta[$meta_box['id']] = $data;
				
			} else if ( pt_isset($meta_box['type']) == 'checkbox' || pt_isset($meta_box['type']) == 'checkbox2' || pt_isset($meta_box['type']) == 'activate') {
				$data = (pt_isset($_POST[$meta_box['id']])) ? $_POST[$meta_box['id']] : 'false';
				$meta[$meta_box['id']] = $data;
			} else {
				$data = pt_isset($_POST[$meta_box['id']]);
				$meta[$meta_box['id']] = $data;
			}
		}

		if ( get_post_meta( $post_id, pt_isset($meta_box['group']) ) == "" ) { 
			add_post_meta( $post_id, $meta_box['group'], $meta, true );
		} else {
			update_post_meta( $post_id, $meta_box['group'], $meta );
		}
	}
}

function pt_save_landing_columns( $post_id )
{ 
	global $wpdb;

	if ( !wp_verify_nonce( pt_isset($_POST['pt_meta_nonce']), plugin_basename(__FILE__) ) ) { 
		return $post_id; 
	}
    
	if ( 'page' == pt_isset($_POST['post_type'])  ) {
      		if ( !current_user_can( 'edit_page', $post_id ) ) return $post_id;

		// Delete all existing data first
		$wpdb->query( "DELETE FROM `{$wpdb->prefix}pt_elements_data` WHERE post_id = $post_id" );

		// Save top column
		pt_save_element_data($post_id, pt_isset($_POST['lp-pre']), 'top');

		// Save left column
		pt_save_element_data($post_id, pt_isset($_POST['lp-main']), 'left');

		// Save right column
		pt_save_element_data($post_id, pt_isset($_POST['lp-side']), 'right');

		// Save bottom column
		pt_save_element_data($post_id, pt_isset($_POST['lp-bottom']), 'bottom');
    	} else {
      		if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
    	}
}

function pt_landing_machine( $pt_meta_box )
{
	global $wpdb, $post;

	echo '<input type="hidden" name="pt_meta_nonce" id="pt_meta_nonce" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	foreach ( $pt_meta_box as $meta_box ) {
		$meta_box_value = '';
		if ( isset($meta_box['group']) ) {
			$group  = $meta_box['group'];
			$id     = pt_isset($meta_box['id']);
			$value = maybe_unserialize(get_post_meta($post->ID, $group, true));
			
			$meta_box_value = pt_isset($value[$id]); 
		}

		if ($meta_box_value == '') $meta_box_value = pt_isset($meta_box['std']);

		switch ( $meta_box['type'] ) { 

			case 'dialogscript':

				echo "
					<script type=\"text/javascript\">

					function displayPageSettings(fromID, toID) 
					{
						jQuery.colorbox({
					            opacity: '0.6',
					            width: 840,
					            height : '80%',
					            href: fromID,
					            inline: true,
					            overflow: true,
					            onComplete: function(){
					            	jQuery(fromID).show();
								},
								onClosed: function(){
									jQuery(fromID).hide();
								}
						});
					}

					function closePageSettings(fromID, toID)
					{		
						jQuery.colorbox.close();
						jQuery(fromID).hide();
					}
					</script>
				";
		
			break;

			case 'dialogopen':
				
				echo '<div id="' . pt_isset($meta_box['id']) . '" title="' . $meta_box['title'] . '" style="display:none">';
				echo '<div class="post-meta-box last-meta-box"><div class="updated below-h2" style="margin:10px 0"><p><strong>Important:</strong> Once you\'re done entering/updating the settings in this lightbox popup, simply click anywhere outside this lightbox or click the &quot;x&quot; on the top right of this lightbox. Your settings will be automatically saved. However, you still need to click the WordPress &quot;Save/Update&quot; button on the top right of this page in order to save whole page content.</p></div></div>';
				if (pt_isset($meta_box['id']) == 'lp-content-open'){
					echo '<div class="post-meta-box last-meta-box"><div class="updated below-h2" style="margin:10px 0"><p>For this "Main Content" element, you simply create your content inside the WordPress editor on the top of this page.</p></div></div>';
				}
				break;

			case 'dialogclose':
				
				echo '</div>';
				break;

			case 'dialogbtn':
				echo '<div style="text-align:right;margin:10px;"><input type="button" name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" value="' . pt_isset($meta_box['name']) . '" class="button-primary" onclick="closePageSettings(\'#' . $meta_box['frombox'] . '\', \'#' . $meta_box['tobox'] . '\')" /></div>';
				break;

			case 'customlayout':

				$layout_data = get_post_meta($post->ID, 'pt_landing_meta_box', true);

				$lp_top    = ( $layout_data != '' ) ? 'clean' : 'lp-headline/Headline';
				$lp_left   = ( $layout_data != '' ) ? 'clean' : 'lp-content/Main Content';
				$lp_right  = ( $layout_data != '' ) ? 'clean' : 'lp-optin/Optin Form';
				$lp_bottom = 'clean';
				
				$ex_elements = array();

				$post_id = (int) $post->ID;
				$tops = pt_get_elements_col( $post_id, 'top' );
				if ( $tops ) {
					$lp_top = array();
					foreach ( $tops as $top ) {
						$ex_elements[] = "{$top->element_id}/{$top->title}";
						$lp_top[] = "{$top->element_id}/{$top->title}";
					}

					$lp_top = implode("|", $lp_top);
				}

				$lefts = pt_get_elements_col( $post_id, 'left' );
				if ( $lefts ) {
					$lp_left = array();
					foreach ( $lefts as $left ) {
						$ex_elements[] = "{$left->element_id}/{$left->title}";
						$lp_left[] = "{$left->element_id}/{$left->title}";
					}

					$lp_left = implode("|", $lp_left);
				}

				$rights = pt_get_elements_col( $post_id, 'right' );
				if ( $rights ) {
					$lp_right = array();
					foreach ( $rights as $right ) {
						$ex_elements[] = "{$right->element_id}/{$right->title}";
						$lp_right[] = "{$right->element_id}/{$right->title}";
					}

					$lp_right = implode("|", $lp_right);
				}

				$bottoms = pt_get_elements_col( $post_id, 'bottom' );
				if ( $bottoms ) {
					$lp_bottom = array();
					foreach ( $bottoms as $bottom ) {
						$ex_elements[] = "{$bottom->element_id}/{$bottom->title}";
						$lp_bottom[] = "{$bottom->element_id}/{$bottom->title}";
					}

					$lp_bottom = implode("|", $lp_bottom);
				}
				
				$lp_elms = pt_get_elements( $post_id, $ex_elements );
				
				echo' 		
				<div class="post-meta-box4" style="position:relative">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
					<p>If you only require a <em>one column landing page</em>, then just drag n drop all the elements you need into the "Top Column"</p>
					<div id="custom-landing-page">
						<div class="landing-page-layout">
							<div id="page-settings" class="landing-page-pre">
								<div class="elements-head"><strong>General Settings</strong> (These elements cannot be dragged):</div>
								<ul>
									<li class="unsortable-item"><a href="#" onclick="displayPageSettings(\'#lp-page-open\', \'#lp-page-box\');return false;">Page Settings</a><div id="lp-page-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#lp-page-open\', \'#lp-page-box\');return false;" title="Close this box">X</a></div></div></li>
									<li class="unsortable-item"><a href="#" onclick="displayPageSettings(\'#lp-header-open\', \'#lp-header-box\');return false;">Header Settings</a><div id="lp-header-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#lp-header-open\', \'#lp-header-box\');return false;" title="Close this box">X</a></div></div></li>
									<li class="unsortable-item custom-box" style="display:none"><a href="#" onclick="displayPageSettings(\'#lp-custom-open\', \'#lp-custom-box\');return false;">Custom Design Settings</a><div id="lp-custom-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#lp-custom-open\', \'#lp-custom-box\');return false;" title="Close this box">X</a></div></div></li>
								</ul>Drag n drop the landing page element(s) that you want from the box below to the above column(s), or vice versa:
							</div>
							
							<div id="pre-column" class="landing-page-pre">
								<div class="elements-head"><strong>Top Column</strong> (Drop elements here):</div>
				';
								
								echo '<ul class="sortable-list">';
								if ( !empty( $lp_top ) && $lp_top != 'clean' ) {
									$new_elements = array();
									$elements = explode("|", $lp_top);
									for ( $i = 0; $i<count($elements); $i++ ) {
										$element = explode("/", $elements[$i]);
										$new_elements[pt_isset($element[0])] = array(
												'name' => pt_isset($element[1]),
												'id' => $element[0],
										);							
									}
								} else {
									$new_elements = $lp_top;
								}
								
								if ( $lp_top != 'clean' ) {
									foreach ( $new_elements as $elm ) {
										if ( $elm['id'] != '' && $elm['name'] != '') {
											echo '<li id="' . $elm['id'] . '/' . $elm['name'] . '" class="sortable-item"><a href="#" onclick="displayPageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;">' . $elm['name'] . '</a><div id="' . $elm['id'] . '-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;" title="Close this box">X</a></div></div></li>';
										}
									}
								}

								echo '</ul>';
				
				echo '
							</div>
							
							<div id="main-column" class="landing-page-main">
							<div class="elements-head"><strong>Left Column</strong> (Drop elements here):</div>
				';

								echo '<ul class="sortable-list">';
								if ( !empty( $lp_left ) && $lp_left != 'clean' ) {
									$new_elements = array();
									$elements = explode("|", $lp_left);
									for ( $i = 0; $i<count($elements); $i++ ) {
										$element = explode("/", $elements[$i]);
										$new_elements[pt_isset($element[0])] = array(
													'name' => pt_isset($element[1]),
													'id' => $element[0],
											);
												
									}
								} else {
									$new_elements = $lp_left;
								}

								if ( $lp_left != 'clean' ) {
									foreach ( $new_elements as $elm ) {
										if ( $elm['id'] != '' && $elm['name'] != '') {
											echo '<li id="' . $elm['id'] . '/' . $elm['name'] . '" class="sortable-item"><a href="#" onclick="displayPageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;">' . $elm['name'] . '</a><div id="' . $elm['id'] . '-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;" title="Close this box">X</a></div></div></li>';
										}
									}
								}

								echo '</ul>';
				
				echo '
							</div>
							<div id="side-column" class="landing-page-sidebar">
							<div class="elements-head"><strong>Right Column</strong> (Drop elements here):</div>
				';

								echo '<ul class="sortable-list">';
								if ( !empty( $lp_right ) ) {
									$new_elements = array();
									$elements = explode("|", $lp_right);
									for ( $i = 0; $i<count($elements); $i++ ) {
										$element = explode("/", $elements[$i]);
										$new_elements[pt_isset($element[0])] = array(
													'name' => pt_isset($element[1]),
													'id' => $element[0],
											);
												
									}
								} else {
									$new_elements = $lp_right;
								}

								if ( $lp_right != 'clean' ) {
									foreach ( $new_elements as $elm ) {
										if ( $elm['id'] != '' && $elm['name'] != '') {
											echo '<li id="' . $elm['id'] . '/' . $elm['name'] . '" class="sortable-item"><a href="#" onclick="displayPageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;">' . $elm['name'] . '</a><div id="' . $elm['id'] . '-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;" title="Close this box">X</a></div></div></li>';
										}
									}
								}
								echo '</ul>';
				echo '
							</div>
							<div class="landing-clear"></div>

							<div id="bot-column" class="landing-page-bot">
								<div class="elements-head"><strong>Bottom Column</strong> (Drop elements here):</div>
				';
								
								echo '<ul class="sortable-list">';
								if ( !empty( $lp_bottom ) && $lp_bottom != 'clean' ) {
									$new_elements = array();
									$elements = explode("|", $lp_bottom);
									for ( $i = 0; $i<count($elements); $i++ ) {
										$element = explode("/", $elements[$i]);
										$new_elements[pt_isset($element[0])] = array(
												'name' => pt_isset($element[1]),
												'id' => $element[0],
										);							
									}
								} else {
									$new_elements = $lp_bottom;
								}
								
								if ( $lp_bottom != 'clean' && $new_elements != 'clean' ) {
									foreach ( $new_elements as $elm ) {
										if ( $elm['id'] != '' && $elm['name'] != '') {
											echo '<li id="' . $elm['id'] . '/' . $elm['name'] . '" class="sortable-item"><a href="#" onclick="displayPageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;">' . $elm['name'] . '</a><div id="' . $elm['id'] . '-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;" title="Close this box">X</a></div></div></li>';
										}
									}
								}

								echo '</ul>';
				
				echo '
							</div>
						</div>
						<h4><label>Add Elements</label></h4>
						<p>Drag n drop the landing page element(s) that you want from the box below to the above column(s), or vice versa:</p>
						<div id="elms-column" class="landing-page-elements">
							
				';
							echo '<ul class="sortable-list">';
							if ( !empty( $lp_elms ) ) {
								$new_elements = array();
								$elements = explode("|", $lp_elms);
								for ( $i = 0; $i<count($elements); $i++ ) {
									$element = explode("/", $elements[$i]);
									$new_elements[pt_isset($element[0])] = array(
										'name' => pt_isset($element[1]),
										'id' => $element[0],
									);
												
								}
							} else if (empty($lp_elms)) {
								$new_elements = $meta_box['inactive'];
							}

							if ( $lp_elms != 'clean' ) {
								foreach ( $new_elements as $elm ) {
									if ( $elm['id'] != '' && $elm['name'] != '') {
										echo '<li id="' . $elm['id'] . '/' . $elm['name'] . '" class="sortable-item"><a href="#" onclick="displayPageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;">' . $elm['name'] . '</a><div id="' . $elm['id'] . '-box" class="lpboxsettings"><div class="lpboxclose"><a href="#" onclick="closePageSettings(\'#' . $elm['id'] . '-open\', \'#' . $elm['id'] . '-box\');return false;" title="Close this box">X</a></div></div></li>';
									}
								}
							}

							echo '</ul>';
	
				echo '	
						</div>
						<div style="clear:both"></div>
					</div>
				</div>
				';
				
				echo "
				<script type=\"text/javascript\">

				jQuery(document).ready(function(){

					// Get items
					function getItems(exampleNr)
					{
						var columns = [];

						jQuery(exampleNr + ' ul.sortable-list').each(function(){
							columns.push(jQuery(this).sortable('toArray').join('|'));				
						});

						return columns;
					}

					jQuery('#custom-landing-page .sortable-list').sortable({
						connectWith: '#custom-landing-page .sortable-list',
						placeholder: 'placeholder',
						update: function(){
							var precol  = getItems('#pre-column');
							var maincol = getItems('#main-column');
							var sidecol = getItems('#side-column');
							var botcol  = getItems('#bot-column');
 
							if ( precol != '' ) {
								jQuery('#lp-pre').attr('value', precol);
							} else {
								jQuery('#lp-pre').attr('value', 'clean');
							}
	
							if ( maincol != '' ) {
								jQuery('#lp-main').attr('value', maincol);
							} else {
								jQuery('#lp-main').attr('value', 'clean');
							}

							if ( sidecol != '' ) {
								jQuery('#lp-side').attr('value', sidecol);
							} else {
								jQuery('#lp-side').attr('value', 'clean');
							}

							if ( botcol != '' ) {
								jQuery('#lp-bottom').attr('value', botcol);
							} else {
								jQuery('#lp-bottom').attr('value', 'clean');
							}
						}			
					});
				});

				</script>
				
				";

				unset($new_elements);
				unset($ex_elements);

				break;

			case 'hidden':

				echo "\n" . '<input type="hidden" name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" value="' . $meta_box_value . '" />'. "\n\n";
				break;

			case 'font':
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_font-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				$meta_value = stripslashes($meta_box_value);
				foreach ( $meta_box['options'] as $font ) {
					if ( $meta_value == $font['family'] ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo "<option value='" . $font['family'] . "'" . $selected . ">" . $font['name'];
					if ( isset($font['websafe']) && $font['websafe'] == false ) {
						echo ' *';
					} else if ( isset($font['cufon']) && $font['cufon'] == true ) {
						echo ' **';
					} else if ( isset($font['google']) && $font['google'] == true ) {
						echo ' ***';
					}

					echo '</option>';
				}

				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'size':

				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_size-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				for ( $i = 9; $i < 71; $i++ ) {
					if ( $meta_box_value == $i ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $i . '"' . $selected . '>' . $i . 'px</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'color':

				echo '
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_color-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']) . '" class="color {hash:true}" id="' . pt_isset($meta_box['id']) . '" value="' . htmlspecialchars($meta_box_value) . '" size="30" style="cursor:pointer" />
					<div id="' . pt_isset($meta_box['id']) . '_color_picker2" style="clear:left"></div>
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
				';

				break;

			case 'select':

				$onchange = (isset($meta_box['onchange'])) ? ' onchange="' . $meta_box['onchange'] . '"' : ''; 
					
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_select-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px;"' . $onchange . '>
				';
				
				foreach ( $meta_box['options'] as $value => $option ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'select-template':

				$onchange = (isset($meta_box['onchange'])) ? ' onchange="' . $meta_box['onchange'] . '"' : ''; 
					
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_select-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px;"' . $onchange . '>
				';
				
				foreach ( $meta_box['options'] as $value => $option ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'</select>';
				
			echo '<p style="text-align:center" id="'.$meta_box['id'].'tmpl_prev_text"><strong>Preview:</strong></p>
			<div id="'.$meta_box['id'].'tmpl-preview" style="width:240px;margin:0 auto 10px auto;"></div>
				<p>' . pt_isset($meta_box['desc']) . '</p>
				<script type="text/javascript">
				jQuery(document).ready(function(){
					var buttons = new Array();
					buttons["yellow"] = "yellow-circle";
					buttons["orange"] = "orange-circle";
					buttons["red"] = "red-circle";
					buttons["green"] = "green-circle";
					buttons["blue"] = "blue-circle";
					buttons["yellow1"] = "yellow/metro_blank";
					buttons["orange1"] = "orange/metro_blank";
					buttons["red1"] = "red/metro_blank";
					buttons["green1"] = "green/metro_blank";
					buttons["blue1"] = "blue/metro_blank";
					buttons["yellow2"] = "yellow/grunge_blank";
					buttons["orange2"] = "orange/grunge_blank";
					buttons["red2"] = "red/grunge_blank";
					buttons["green2"] = "green/grunge_blank";
					buttons["blue2"] = "blue/grunge_blank";
					
					var tmpl = "'.$meta_box_value.'";
					
					jQuery("#'.$meta_box['id'].'tmpl_prev_text").show();
					jQuery("#'.$meta_box['id'].'tmpl-preview").show();
					
					if (typeof buttons["'.$meta_box_value.'"] !== "undefined"){
						tmpl = buttons["'.$meta_box_value.'"];
					}
					
					jQuery("#'.$meta_box['id'].'tmpl-preview").html("<img src=\"' . get_bloginfo('template_url') . '/lib/images/buttons/" + tmpl + ".png\" />");

					jQuery("#'.$meta_box['id'].'").change(function() {
        					var tmpl = jQuery("option:selected", this).val();
							
							if (typeof buttons[tmpl] !== "undefined"){
								tmpl = buttons[tmpl];
							}
							
							jQuery("#'.$meta_box['id'].'tmpl_prev_text").show();
							jQuery("#'.$meta_box['id'].'tmpl-preview").show();
        					jQuery("#'.$meta_box['id'].'tmpl-preview").html("<img src=\"' . get_bloginfo('template_url') . '/lib/images/buttons/" + tmpl + ".png\" />");
					});
				});
				</script>
				</div>';
				
				
				break;
				
			case 'checkbox':
				
				if ( $meta_box_value == 'true' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				echo' 		
				<div class="post-meta-box4" id="' . pt_isset($meta_box['id']) . '_checkbox-field">
        				<input type="checkbox" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" value="true"' . $checked . '/> <label for="' . pt_isset($meta_box['id']).'"><span style="color:#666;font-family:georgia">' . pt_isset($meta_box['desc']) . '</span></label>
      				</div>
    				';
				break;

			case 'checkbox2':
				
				if ( $meta_box_value == 'true' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				echo' 		
				<div class="post-meta-box" style="line-height:20px" id="' . pt_isset($meta_box['id']) . '_checkbox-field">
        				<input type="checkbox" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" value="true"' . $checked . '/> <label for="' . pt_isset($meta_box['id']).'"><span style="color:#666;font-family:georgia">' . pt_isset($meta_box['desc']) . '</span></label>
      				</div>
    				';
				break;

			case 'activate':
				
				if ( $meta_box_value == 'true' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				echo' 		
				<div class="post-meta-box">
					<h4><label for="' . pt_isset($meta_box['id']) . '"><input type="checkbox" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" value="true"' . $checked . '/> ' . pt_isset($meta_box['name']) . '</label></h4>
      				</div>
    				';
				break;

			case 'text':

				$width  = isset( $meta_box['width'] ) ? ' style="width:' . $meta_box['width'] . ';"' : '';
				$suffix = isset( $meta_box['suffix'] ) ? $meta_box['suffix'] : '';

				$mode = isset( $meta_box['mode'] ) ? ' ' . $meta_box['mode'] : '';
				echo'
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_text-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" class="widefat" value="' . htmlspecialchars($meta_box_value) . '" size="55"' . $width . $mode . ' />' . $suffix . '
        				
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';
				break;

			case 'text2':

				$width  = isset( $meta_box['width'] ) ? ' style="width:' . $meta_box['width'] . ';"' : '';
				$suffix = isset( $meta_box['suffix'] ) ? $meta_box['suffix'] : '';

				$mode = isset( $meta_box['mode'] ) ? ' ' . $meta_box['mode'] : '';
				echo'
				<div class="post-meta-box4" id="' . pt_isset($meta_box['id']) . '_text-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" class="widefat" value="' . htmlspecialchars($meta_box_value) . '" size="55"' . $width . $mode . ' />' . $suffix . '
        				
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';
				break;

			case 'upload':

				$id = pt_isset($meta_box['id']);
				echo '
				<div class="post-meta-box" id="' . $id . '_upload-field">
        				<h4><label for="' . $id . '">' . pt_isset($meta_box['name']) . '</label></h4>
	        			<input type="text" name="' . $id . '" id="' . $id . '" value="' . htmlspecialchars($meta_box_value) . '" size="55" style="margin-top:10px;height:25px" class="uploaded_url" /> <span id="' . $id . '_upload-btn" class="image_upload_button button">Upload Image</span>
					<input type="hidden" name="' . $id . '_action" value="' . admin_url("admin-ajax.php") . '" class="ajax_action_url" />
					<p style="clear:left">' . pt_isset($meta_box['desc']) . '</p>
      				</div>
				';
				break;

			case 'textarea':

				$rows = ( isset($meta_box['rows']) ) ? $meta_box['rows'] : 4;
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="' . $rows . '">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'textarea2':

				echo' 		
				<div class="post-meta-box4" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="4">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			
			case 'embed':

				$lp           = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
				$width        = ( pt_isset($lp['lp-page-width']) > 0 ) ? $lp['lp-page-width'] : 820;
				$right_column = ( pt_isset($lp['lp-page-right-width']) > 0 ) ? $lp['lp-page-right-width'] : 300;
				$padding      = ( pt_isset($lp['lp-page-padding']) > 0 ) ? $lp['lp-page-padding'] : 25;

				$top_width_min    = ($width - ( $padding * 2 )) - 50;
				$top_width_max    = $width - ( $padding * 2 );
				$left_width_min   = (($width - $right_column) - ( $padding * 2 )) - 50;
				$left_width_max   = (($width - $right_column) - ( $padding * 2 )) - 25;

				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="4">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
        				<p>' . pt_isset($meta_box['desc']) . '<br /><br /><strong>Note:</strong> Maximum video width for <strong>Top Column is between <em>' . $top_width_min . ' px</em> and <em>' . $top_width_max . ' px</em></strong>, and maximum video width for <strong>Left Column is between <em>' . $left_width_min . ' px</em> and <em>' . $left_width_max . ' px</em></strong>.</p>
      				</div>
    				';

				break;

			case 'videourl':

				$lp           = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
				$width        = ( pt_isset($lp['lp-page-width']) > 0 ) ? $lp['lp-page-width'] : 820;
				$right_column = ( pt_isset($lp['lp-page-right-width']) > 0 ) ? $lp['lp-page-right-width'] : 300;
				$padding      = ( pt_isset($lp['lp-page-padding']) > 0 ) ? $lp['lp-page-padding'] : 25;

				$top_width_min    = ($width - ( $padding * 2 )) - 50;
				$top_width_max    = $width - ( $padding * 2 );
				$left_width_min   = (($width - $right_column) - ( $padding * 2 )) - 50;
				$left_width_max   = (($width - $right_column) - ( $padding * 2 )) - 25;

				echo'
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_text-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" class="widefat" value="' . htmlspecialchars($meta_box_value) . '" size="55" />
        				
					<p>' . pt_isset($meta_box['desc']) . ' Maximum video width for <strong>Top Column is between <em>' . $top_width_min . ' px</em> and <em>' . $top_width_max . ' px</em></strong>, and maximum video width for <strong>Left Column is between <em>' . $left_width_min . ' px</em> and <em>' . $left_width_max . ' px</em></strong>.</p>
      				</div>
    				';
				break;
			
			case 'twitter':

				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="3">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
					<div class="counter" style="text-align:right;font-weight:600;color:#808080"></div>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>';

				break;

			case 'selectnav':

				echo' 		
				<div class="post-meta-box">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				foreach ( $meta_box['options'] as $value ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}
					echo '<option value="' . $value . '"' . $selected . '>' . ucwords($value) . '</option>';
				}
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'templates':
					
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_templates-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				$minisite_path = TEMPLATEPATH . '/lib/skins/minisite';

				if ( is_dir($minisite_path) ) {
					if ( $minisite_dir = opendir($minisite_path) ) {
						while ( ( $minisite_content = readdir($minisite_dir) ) !== false ) {
            						if ( $minisite_content != "." && $minisite_content != ".." && $minisite_content != 'index.html' && $minisite_content != 'custom' && $minisite_content != 'index.php' ) {
								$minisites[] = $minisite_content;
            						}
						}
					}
				}
				
				asort($minisites);
				
				$minisites_num = count($minisites);

				for ( $i = 0; $i < $minisites_num; $i++ ) {

					$colors_path = TEMPLATEPATH . '/lib/skins/minisite/' . $minisites[$i];

					if ( is_dir($colors_path) ) {
						if ( $colors_dir = opendir($colors_path) ) {
							while ( ( $colors_content = readdir($colors_dir) ) !== false ) {
            							if ( $colors_content != "." && $colors_content != ".." && $colors_content != 'index.html' ) {
									if ( preg_match('/.css/', $colors_content, $matches) ) {
										$colors[] = $colors_content;
									}
            							}
							}
						}
					}

					$colors_num = count($colors);

					for ( $j = 0; $j < $colors_num; $j++ ) {
						if ( $meta_box_value == pt_isset($minisites[$i]) . '-' . str_replace(".css", "", pt_isset($colors[$j])) ) {
							$selected = ' selected="selected"';
						} else {
							$selected = '';
						}

						echo '<option value="' . $minisites[$i] . '-' . str_replace(".css", "", $colors[$j]) . '"' . $selected . '>' . ucwords(str_replace("_", " ", $minisites[$i])) . ' - ' . ucwords(str_replace(".css", "", $colors[$j])) . '</option>';
					}

					$colors = '';
				}

				$custom_selected = ( $meta_box_value == 'custom' ) ? ' selected="selected"' : '';
				echo'
					<option value="custom"' . $custom_selected . '>Custom Design</option>
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>

					<p style="text-align:center" id="tmpl_prev_text"><strong>Template Preview:</strong></p>
					<div id="tmpl-preview" style="width:400px;margin:0 auto 10px auto;"></div>
      				</div>
				';

				$scr = explode("-", $meta_box_value);
				echo '
				<script type="text/javascript">
				jQuery(document).ready(function(){
					tmpl = jQuery("#' . $id . '").val();
					if ( tmpl != "custom" ) {
						jQuery("#tmpl_prev_text").show();
						jQuery("#tmpl-preview").show();
						jQuery(".custom-box").hide();
						jQuery("#tmpl-preview").html("<img src=\"' . get_bloginfo('template_url') . '/lib/skins/minisite/' . $scr[0] . '/' . $meta_box_value . '.png\" style=\"border:1px solid #ccc;\" />");
					} else {
						jQuery("#tmpl_prev_text").hide();
						jQuery("#tmpl-preview").hide();
						jQuery(".custom-box").show();
					}

					jQuery("#' . $id . '").change(function() {
        					var tmpl = jQuery("option:selected", this).val();
						if ( tmpl != "custom" ) {
							var scr = tmpl.split("-");
							jQuery("#tmpl_prev_text").show();
							jQuery("#tmpl-preview").show();
							jQuery(".custom-box").hide();
        						jQuery("#tmpl-preview").html("<img src=\"' . get_bloginfo('template_url') . '/lib/skins/minisite/" + scr[0] + "/" + tmpl + ".png\" style=\"border:1px solid #ccc;\" />");
							
    						} else {
							jQuery("#tmpl_prev_text").hide();
							jQuery("#tmpl-preview").hide();
							jQuery(".custom-box").show();
						}
					});
				});
				</script>
    				';

				break;

			case 'addtocart':
					
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_addtocart-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				foreach ( $meta_box['options'] as $value => $option ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
					<p style="text-align:center"><strong>Button Preview:</strong></p>
					<div id="addbtn-preview-' . pt_isset($meta_box['id']) . '" style="text-align:center;margin-bottom:10px;"></div>
					
      				</div>

				<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery("#addbtn-preview-' . pt_isset($meta_box['id']) . '").html("<img src=\"' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/buttons/' . $meta_box_value . '&w=180\" />");

					jQuery("#' . pt_isset($meta_box['id']) . '").change(function() {
        					var addbtn = jQuery("option:selected", this).val();
        					jQuery("#addbtn-preview-' . pt_isset($meta_box['id']) . '").html("<img src=\"' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(PT_REL_IMAGES) . '/buttons/" + addbtn + "&w=180\" />");
    					});
				});
				</script>
    				';

				break;

			case 'socialset':
					
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_social-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				foreach ( $meta_box['options'] as $value => $option ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
					<p style="text-align:center"><strong>Button Set Preview:</strong></p>
					<div id="set-preview" style="text-align:center;margin-bottom:10px"><img src="' . PT_REL_IMAGES . '/previews/icons/set' . $meta_box_value . '.png" border="0" /></div>
      				</div>

				<script type="text/javascript">
				jQuery(document).ready(function(){

					jQuery("#' . pt_isset($meta_box['id']) . '").change(function() {
        					var tmpl = jQuery("option:selected", this).val();
        					jQuery("#set-preview").html("<img src=\"' . PT_REL_IMAGES . '/previews/icons/set" + tmpl + ".png\" border=\"0\" />");
    					});
				});
				</script>
    				';

				break;

			case 'optstyle':

				echo' 		
				<div class="post-meta-box">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				foreach ( $meta_box['options'] as $value => $option ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
					<div id="optinform-' . pt_isset($meta_box['id']) . '" style="width:180px;margin:0 auto;"><img src="' . PT_REL_IMAGES . '/previews/optins/' . $meta_box_value . '.gif" ></div>
      				</div>
				
				<script type="text/javascript">
					jQuery(document).ready(function() {
    						jQuery("#' . pt_isset($meta_box['id']) . '").change(function() {
        						var src = jQuery("option:selected", this).val();
        						jQuery("#optinform-' . pt_isset($meta_box['id']) . '").html( src ? "<img src=\'' . PT_REL_IMAGES . '/previews/optins/" + src + ".gif\' >" : "" );
    						});
					});

				</script>	
				';

				break;

			case 'header':

				$id = pt_isset($meta_box['id']);
				$title = pt_isset($meta_box['name']);
				$options = $meta_box['options'];
				$desc = pt_isset($meta_box['desc']);

				$hbgdisplay1  = ' style="display:none"';
				$hbgdisplay1b = ' style="display:none"';
				$hbgdisplay2  = ' style="display:none"';

				if ( $meta_box_value['type'] == 'no-hbackground' ) {
					$hbgdisplay1  = ' style="display:none"';
					$hbgdisplay1b = ' style="display:none"';
					$hbgdisplay2  = ' style="display:none"';
				}
			
				if ( $meta_box_value['type'] == 'custom-hbackground' ) {
					$hbgdisplay1  = '';
					$hbgdisplay1b = '';
					$hbgdisplay2  = ' style="display:none"';
				}

				echo' 		
				<div class="post-meta-box">
        				<h4><label for="' . $id . '_type">' . $title['type'] . '</label></h4>
        				<select name="' . $id . '_type" id="' . $id . '_type" style="width:350px" onchange="pt_hbgreveal(this.options[this.options.selectedIndex].value)">
				';
				
				foreach ( $options['type'] as $value => $option ) {
					if ( $meta_box_value['type'] == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . $desc['type'] . '</p>
      				</div>

				<div class="post-meta-box" id="pt_hbgupload"' . $hbgdisplay1 . '>
        				<h4><label for="' . $id . '_upload">' . $title['upload'] . '</label></h4>
					<input type="text" name="' . $id . '_upload" id="' . $id . '_upload" value="' . htmlspecialchars($meta_box_value['upload']) . '" size="55" style="margin-top:10px;height:25px" class="uploaded_url" /> <span id="' . $id . '_upload-btn" class="image_upload_button button">Upload Image</span>
					<input type="hidden" name="' . $id . '_action" value="' . admin_url("admin-ajax.php") . '" class="ajax_action_url" />
					<p style="clear:left">' . $desc['upload'] . '</p>
      				</div>
				';

				echo' 		
				<div class="post-meta-box" id="pt_hbgalign"' . $hbgdisplay1b . '>
        				<h4><label for="' . $id . '_align">' . $title['align'] . '</label></h4>
        				<select name="' . $id . '_align" id="' . $id . '_align" style="width:350px"' . $onchange . '>
				';
				
				foreach ( $options['align'] as $value => $option ) {
					if ( $meta_box_value['align'] == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . $desc['align'] . '</p>
      				</div>


				<script type="text/javascript">
					function pt_hbgreveal(bgtype)
					{
						if (bgtype == "no-hbackground") {		
							jQuery("#pt_hbgupload").hide();
							jQuery("#pt_hbgalign").hide();
							
						} else if (bgtype == "custom-hbackground") { 
							jQuery("#pt_hbgupload").show();
							jQuery("#pt_hbgalign").show();
						} else {
							jQuery("#pt_hbgupload").hide();
							jQuery("#pt_hbgalign").hide();
						}
					}
				</script>
				';

				break;

			case 'divwrapopen' :

				echo '<div id="'. pt_isset($meta_box['id']) . '">';
				break;
	
			case 'divwrapclose' :

				echo '</div>';
				break;

			case 'note' :

				echo'
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_note-field">
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';
				break;
		}
	}
}

function pt_meta_machine( $pt_meta_box )
{
	global $wpdb, $post;

	echo '<input type="hidden" name="pt_meta_nonce" id="pt_meta_nonce" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	foreach ( $pt_meta_box as $meta_box ) {

		$meta_box_value = '';
		if ( isset($meta_box['group']) ) {
			$group  = $meta_box['group'];
			$id     = pt_isset($meta_box['id']);
			$value = maybe_unserialize(get_post_meta($post->ID, $group, true));
			
			$meta_box_value = pt_isset($value[$id]); 
		}

		if ($meta_box_value == '') $meta_box_value = pt_isset($meta_box['std']);

		switch ( $meta_box['type'] ) {

			case 'dialogopen':
				
				echo '<div id="' . pt_isset($meta_box['id']) . '" title="' . $meta_box['title'] . '" style="display:none">';
				break;

			case 'dialogclose':
				
				echo '</div>';
				break;

			case 'dialogbtn':
				echo '<div style="text-align:right;margin:10px;"><input type="button" name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" value="' . pt_isset($meta_box['name']) . '" class="button-primary" onclick="closePageSettings(\'#' . $meta_box['frombox'] . '\', \'#' . $meta_box['tobox'] . '\')" /></div>';
				break;

			case 'hidden':

				echo "\n" . '<input type="hidden" name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" value="' . $meta_box_value . '" />'. "\n\n";
				break;

			case 'font':
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_font-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				$meta_value = stripslashes($meta_box_value);
				foreach ( $meta_box['options'] as $font ) {
					if ( $meta_value == $font['family'] ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo "<option value='" . $font['family'] . "'" . $selected . ">" . $font['name'];
					if ( isset($font['websafe']) && $font['websafe'] == false ) {
						echo ' *';
					} else if ( isset($font['cufon']) && $font['cufon'] == true ) {
						echo ' **';
					}

					echo '</option>';
				}

				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'size':

				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_size-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				
				for ( $i = 9; $i < 71; $i++ ) {
					if ( $meta_box_value == $i ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $i . '"' . $selected . '>' . $i . 'px</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'color':

				echo '
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_color-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']) . '" class="color {hash:true}" id="' . pt_isset($meta_box['id']) . '" value="' . htmlspecialchars($meta_box_value) . '" size="30" style="cursor:pointer" />
					<div id="' . pt_isset($meta_box['id']) . '_color_picker2" style="clear:left"></div>
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
				';

				break;

			case 'select':

				$onchange = (isset($meta_box['onchange'])) ? ' onchange="' . $meta_box['onchange'] . '"' : ''; 
					
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_select-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px;"' . $onchange . '>
				';
				
				foreach ( $meta_box['options'] as $value => $option ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}

					echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
				}
				
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;
				
			case 'memberdownload':
				echo '
					<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_download-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
					<div class="dl-files">
				';

				if ( is_array($meta_box_value) && count($meta_box_value) > 0 ) {
					foreach ( $meta_box_value as $file ) {
						echo'
							
							<div>
							Type: <select name="' . pt_isset($meta_box['id']) . '_type[]" id="' . pt_isset($meta_box['id']) . '_type" style="width:100px;">
						';
				
						foreach ( $meta_box['options'] as $value => $option ) {
							if ( $file['type'] == $value ) {
								$selected = ' selected="selected"';
							} else {
								$selected = '';
							}

							echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
						}
				
						echo'
							</select>
        						File URL: <input type="text" name="' . pt_isset($meta_box['id']).'_file[]" id="' . pt_isset($meta_box['id']) . '_file" class="widefat" value="' . htmlspecialchars($file['url']) . '" size="55" style="width:150px" />
							Text Link: <input type="text" name="' . pt_isset($meta_box['id']).'_text[]" id="' . pt_isset($meta_box['id']) . '_text" class="widefat" value="' . htmlspecialchars($file['text']) . '" size="55" style="width:150px" /> <a href="#" class="button" onclick="jQuery(this).parent().remove(); return false;">Remove</a>
        						</div>
    				
    						';
					}
				} else {
					echo'
						<div>
						Type: <select name="' . pt_isset($meta_box['id']) . '_type[]" id="' . pt_isset($meta_box['id']) . '_type" style="width:100px;">
					';
				
					foreach ( $meta_box['options'] as $value => $option ) {
						if ( pt_isset($file['type']) == $value ) {
							$selected = ' selected="selected"';
						} else {
							$selected = '';
						}

						echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
					}
				
					echo'
						</select>
        					File URL: <input type="text" name="' . pt_isset($meta_box['id']).'_file[]" id="' . pt_isset($meta_box['id']) . '_file" class="widefat" value="" size="55" style="width:150px" />
						Text Link: <input type="text" name="' . pt_isset($meta_box['id']).'_text[]" id="' . pt_isset($meta_box['id']) . '_text" class="widefat" value="Download Item" size="55" style="width:150px" /> <a href="#" class="button" onclick="jQuery(this).parent().remove(); return false;">Remove</a>
        					</div>
						     				
    					';
				}

				echo '
					</div>
					<div style="margin:20px 0;"><span class="button add-download">Add New Download</span></div>
					<p>' . pt_isset($meta_box['desc']) . '</p>

				</div>
				';

				break;

			case 'selectmulti':
	
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_select-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '[]" id="' . pt_isset($meta_box['id']) . '" style="width:350px;height:100px;" multiple>
				';
				
				$i = 0;

				if ( $meta_box['options'] && is_array( $meta_box['options'] ) ) {
					foreach ( $meta_box['options'] as $value => $option ) {
						if ( is_array( $meta_box_value ) ) {
							$selected = ( in_array($value, $meta_box_value) ) ? ' selected="selected"' : '';
						} else {
							$selected = ( $meta_box_value == $value) ? ' selected="selected"' : '';
						}

						echo '<option value="' . $value . '"' . $selected . '>' . $option . '</option>';
						$i++;
					}
				}
	
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'checkbox':
				
				if ( $meta_box_value == 'true' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				echo' 		
				<div class="post-meta-box4" id="' . pt_isset($meta_box['id']) . '_checkbox-field">
        				<input type="checkbox" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" value="true"' . $checked . '/> <label for="' . pt_isset($meta_box['id']).'"><span style="color:#666;font-family:georgia">' . pt_isset($meta_box['desc']) . '</span></label>
      				</div>
    				';
				break;

			case 'checkbox2':
				
				if ( $meta_box_value == 'true' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				echo' 		
				<div class="post-meta-box" style="line-height:20px" id="' . pt_isset($meta_box['id']) . '_checkbox-field">
        				<input type="checkbox" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" value="true"' . $checked . '/> <label for="' . pt_isset($meta_box['id']).'"><span style="color:#666;font-family:georgia">' . pt_isset($meta_box['desc']) . '</span></label>
      				</div>
    				';
				break;

			case 'activate':
				
				if ( $meta_box_value == 'true' ) {
					$checked = ' checked="checked"';
				} else {
					$checked = '';
				}

				echo' 		
				<div class="post-meta-box">
					<h4><label for="' . pt_isset($meta_box['id']) . '"><input type="checkbox" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" value="true"' . $checked . '/> ' . pt_isset($meta_box['name']) . '</label></h4>
      				</div>
    				';
				break;

			case 'postscript':

				$show[] = (pt_isset($value['show-banner-ad1']) == 'true') ? 'jQuery("#post-ad1-type_select-field").show();' . "\n" : 'jQuery("#post-ad1-type_select-field").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad1']) == 'true' && pt_isset($value['post-ad1-type']) == 'banner') ? 'jQuery("#post-banner1-wrap-open").show();' . "\n" : 'jQuery("#post-banner1-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad1']) == 'true' && pt_isset($value['post-ad1-type']) == 'rich') ? 'jQuery("#post-rich1-wrap-open").show();' . "\n" : 'jQuery("#post-rich1-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad1']) == 'true' && pt_isset($value['post-ad1-type']) == 'optin') ? 'jQuery("#post-optin1-wrap-open").show();' . "\n" : 'jQuery("#post-optin1-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad1']) == 'true' && pt_isset($value['post-ad1-type']) == 'adcode') ? 'jQuery("#post-adcode1-ad_textarea-field").show();' . "\n" : 'jQuery("#post-adcode1-ad_textarea-field").hide();' . "\n";

				$show[] = (pt_isset($value['show-banner-ad2']) == 'true') ? 'jQuery("#post-ad2-type_select-field").show();' . "\n" : 'jQuery("#post-ad2-type_select-field").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad2']) == 'true' && pt_isset($value['post-ad2-type']) == 'banner') ? 'jQuery("#post-banner2-wrap-open").show();' . "\n" : 'jQuery("#post-banner2-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad2']) == 'true' && pt_isset($value['post-ad2-type']) == 'rich') ? 'jQuery("#post-rich2-wrap-open").show();' . "\n" : 'jQuery("#post-rich2-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad2']) == 'true' && pt_isset($value['post-ad2-type']) == 'adcode') ? 'jQuery("#post-adcode2-ad_textarea-field").show();' . "\n" : 'jQuery("#post-adcode2-ad_textarea-field").hide();' . "\n";
			
				$show[] = (pt_isset($value['show-banner-ad3']) == 'true') ? 'jQuery("#post-ad3-type_select-field").show();' . "\n" : 'jQuery("#post-ad3-type_select-field").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad3']) == 'true' && pt_isset($value['post-ad3-type']) == 'banner') ? 'jQuery("#post-banner3-wrap-open").show();' . "\n" : 'jQuery("#post-banner3-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad3']) == 'true' && pt_isset($value['post-ad3-type']) == 'rich') ? 'jQuery("#post-rich3-wrap-open").show();' . "\n" : 'jQuery("#post-rich3-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad3']) == 'true' && pt_isset($value['post-ad3-type']) == 'optin') ? 'jQuery("#post-optin3-wrap-open").show();' . "\n" : 'jQuery("#post-optin3-wrap-open").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad3']) == 'true' && pt_isset($value['post-ad3-type']) == 'adcode') ? 'jQuery("#post-adcode3-ad_textarea-field").show();' . "\n" : 'jQuery("#post-adcode3-ad_textarea-field").hide();' . "\n";
				$show[] = (pt_isset($value['show-banner-ad3']) == 'true') ? 'jQuery("#post-ad3-loop_checkbox-field").show();' . "\n" : 'jQuery("#post-ad3-loop_checkbox-field").hide();' . "\n";
				
				$show[] = (pt_isset($value['show-rating']) == 'true') ? 'jQuery("#rating-wrap-open").show();' . "\n" : 'jQuery("#rating-wrap-open").hide();' . "\n";
				echo '<script type="text/javascript">' . "\n";
				
				echo implode("\n", $show);

				echo '

				jQuery("#show-banner-ad1").click(function(){
					if ( this.checked == true ) {
						jQuery("#post-ad1-type_select-field").show();

						if ( jQuery("select#post-ad1-type").val() == "rich" ) {

							jQuery("#post-adcode1-ad_textarea-field").hide();
							jQuery("#post-rich1-wrap-open").show();
							jQuery("#post-optin1-wrap-open").hide();
							jQuery("#post-banner1-wrap-open").hide();

						} else if ( jQuery("select#post-ad1-type").val() == "optin" ) {

							jQuery("#post-adcode1-ad_textarea-field").hide();
							jQuery("#post-rich1-wrap-open").hide();
							jQuery("#post-optin1-wrap-open").show();
							jQuery("#post-banner1-wrap-open").hide();

						} else if ( jQuery("select#post-ad1-type").val() == "adcode" ) {

							jQuery("#post-adcode1-ad_textarea-field").show();
							jQuery("#post-rich1-wrap-open").hide();
							jQuery("#post-optin1-wrap-open").hide();
							jQuery("#post-banner1-wrap-open").hide();

						} else {
							jQuery("#post-adcode1-ad_textarea-field").hide();
							jQuery("#post-rich1-wrap-open").hide();
							jQuery("#post-optin1-wrap-open").hide();
							jQuery("#post-banner1-wrap-open").show();

						}
					} else {
						jQuery("#post-adcode1-ad_textarea-field").hide();
						jQuery("#post-rich1-wrap-open").hide();
						jQuery("#post-optin1-wrap-open").hide();
						jQuery("#post-banner1-wrap-open").hide();
						jQuery("#post-ad1-type_select-field").hide();
					}				
				});

				jQuery("#show-banner-ad2").click(function(){
					if ( this.checked == true ) {
						jQuery("#post-ad2-type_select-field").show();

						if ( jQuery("select#post-ad2-type").val() == "rich" ) {

							jQuery("#post-adcode2-ad_textarea-field").hide();
							jQuery("#post-rich2-wrap-open").show();
							jQuery("#post-banner2-wrap-open").hide();

						} else if ( jQuery("select#post-ad2-type").val() == "adcode" ) {

							jQuery("#post-adcode2-ad_textarea-field").show();
							jQuery("#post-rich2-wrap-open").hide();
							jQuery("#post-banner2-wrap-open").hide();

						} else {
							jQuery("#post-adcode2-ad_textarea-field").hide();
							jQuery("#post-rich2-wrap-open").hide();
							jQuery("#post-banner2-wrap-open").show();

						}
					} else {
						jQuery("#post-adcode2-ad_textarea-field").hide();
						jQuery("#post-rich2-wrap-open").hide();
						jQuery("#post-banner2-wrap-open").hide();
						jQuery("#post-ad2-type_select-field").hide();
					}				
				});

				jQuery("#show-banner-ad3").click(function(){
					if ( this.checked == true ) {
						jQuery("#post-ad3-type_select-field").show();

						if ( jQuery("select#post-ad3-type").val() == "rich" ) {
							jQuery("#post-adcode3-ad_textarea-field").hide();
							jQuery("#post-rich3-wrap-open").show();
							jQuery("#post-optin3-wrap-open").hide();
							jQuery("#post-banner3-wrap-open").hide();

						} else if ( jQuery("select#post-ad3-type").val() == "optin" ) {

							jQuery("#post-adcode3-ad_textarea-field").hide();
							jQuery("#post-rich3-wrap-open").hide();
							jQuery("#post-optin3-wrap-open").show();
							jQuery("#post-banner3-wrap-open").hide();

						} else if ( jQuery("select#post-ad3-type").val() == "adcode" ) {

							jQuery("#post-adcode3-ad_textarea-field").show();
							jQuery("#post-rich3-wrap-open").hide();
							jQuery("#post-optin3-wrap-open").hide();
							jQuery("#post-banner3-wrap-open").hide();

						} else {
							jQuery("#post-adcode3-ad_textarea-field").hide();
							jQuery("#post-rich3-wrap-open").hide();
							jQuery("#post-optin3-wrap-open").hide();
							jQuery("#post-banner3-wrap-open").show();

						}
						jQuery("#post-ad3-loop_checkbox-field").show();

					} else {
						jQuery("#post-adcode3-ad_textarea-field").hide();
						jQuery("#post-rich3-wrap-open").hide();
						jQuery("#post-optin3-wrap-open").hide();
						jQuery("#post-banner3-wrap-open").hide();
						jQuery("#post-ad3-loop_checkbox-field").hide();
						jQuery("#post-ad3-type_select-field").hide();
					}
				});

				jQuery("#show-rating").click(function(){
					if ( this.checked == true ) {
						jQuery("#rating-wrap-open").show();
					} else {
						jQuery("#rating-wrap-open").hide();
					}				
				});

				function showadfields1( adtype ) {
					if ( adtype == "rich" ) {
						jQuery("#post-adcode1-ad_textarea-field").hide();
						jQuery("#post-rich1-wrap-open").show();
						jQuery("#post-optin1-wrap-open").hide();
						jQuery("#post-banner1-wrap-open").hide();

					} else if ( adtype == "optin" ) {
						jQuery("#post-adcode1-ad_textarea-field").hide();
						jQuery("#post-rich1-wrap-open").hide();
						jQuery("#post-optin1-wrap-open").show();
						jQuery("#post-banner1-wrap-open").hide();

					} else if ( adtype == "adcode" ) {
						jQuery("#post-adcode1-ad_textarea-field").show();
						jQuery("#post-rich1-wrap-open").hide();
						jQuery("#post-optin1-wrap-open").hide();
						jQuery("#post-banner1-wrap-open").hide();

					} else {
						jQuery("#post-adcode1-ad_textarea-field").hide();
						jQuery("#post-rich1-wrap-open").hide();
						jQuery("#post-optin1-wrap-open").hide();
						jQuery("#post-banner1-wrap-open").show();

					}
				}

				function showadfields2( adtype ) {
					if ( adtype == "rich" ) {
						jQuery("#post-adcode2-ad_textarea-field").hide();
						jQuery("#post-rich2-wrap-open").show();
						jQuery("#post-banner2-wrap-open").hide();
					} else if ( adtype == "adcode" ) {
						jQuery("#post-adcode2-ad_textarea-field").show();
						jQuery("#post-rich2-wrap-open").hide();
						jQuery("#post-banner2-wrap-open").hide();
					} else {
						jQuery("#post-adcode2-ad_textarea-field").hide();
						jQuery("#post-rich2-wrap-open").hide();
						jQuery("#post-banner2-wrap-open").show();

					}
				}

				function showadfields3( adtype ) {
					if ( adtype == "rich" ) {
						jQuery("#post-adcode3-ad_textarea-field").hide();
						jQuery("#post-rich3-wrap-open").show();
						jQuery("#post-optin3-wrap-open").hide();
						jQuery("#post-banner3-wrap-open").hide();

					} else if ( adtype == "optin" ) {
						jQuery("#post-adcode3-ad_textarea-field").hide();
						jQuery("#post-rich3-wrap-open").hide();
						jQuery("#post-optin3-wrap-open").show();
						jQuery("#post-banner3-wrap-open").hide();

					} else if ( adtype == "adcode" ) {
						jQuery("#post-adcode3-ad_textarea-field").show();
						jQuery("#post-rich3-wrap-open").hide();
						jQuery("#post-optin3-wrap-open").hide();
						jQuery("#post-banner3-wrap-open").hide();

					} else {
						jQuery("#post-banner-ad3_textarea-field").hide();
						jQuery("#post-rich3-wrap-open").hide();
						jQuery("#post-optin3-wrap-open").hide();
						jQuery("#post-banner3-wrap-open").show();

					}
				}

				';

				echo '</script>';
			break;

			case 'text':

				$width  = isset( $meta_box['width'] ) ? ' style="width:' . $meta_box['width'] . ';"' : '';
				$suffix = isset( $meta_box['suffix'] ) ? $meta_box['suffix'] : '';

				$mode = isset( $meta_box['mode'] ) ? ' ' . $meta_box['mode'] : '';
				echo'
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_text-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" class="widefat" value="' . htmlspecialchars($meta_box_value) . '" size="55"' . $width . $mode . ' />' . $suffix . '
        				
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';
				break;

			case 'text2':

				$width  = isset( $meta_box['width'] ) ? ' style="width:' . $meta_box['width'] . ';"' : '';
				$suffix = isset( $meta_box['suffix'] ) ? $meta_box['suffix'] : '';

				$mode = isset( $meta_box['mode'] ) ? ' ' . $meta_box['mode'] : '';
				echo'
				<div class="post-meta-box4" id="' . pt_isset($meta_box['id']) . '_text-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" class="widefat" value="' . htmlspecialchars($meta_box_value) . '" size="55"' . $width . $mode . ' />' . $suffix . '
        				
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';
				break;

			case 'upload':

				$id = pt_isset($meta_box['id']);
				echo '
				<div class="post-meta-box" id="' . $id . '_upload-field">
        				<h4><label for="' . $id . '">' . pt_isset($meta_box['name']) . '</label></h4>
	        			<input type="text" name="' . $id . '" id="' . $id . '" value="' . htmlspecialchars($meta_box_value) . '" size="55" style="margin-top:10px;height:25px" class="uploaded_url" /> <span id="' . $id . '_upload-btn" class="image_upload_button button">Upload Image</span>
					<input type="hidden" name="' . $id . '_action" value="' . admin_url("admin-ajax.php") . '" class="ajax_action_url" />
					<p style="clear:left">' . pt_isset($meta_box['desc']) . '</p>
      				</div>
				';
				break;

			case 'textarea':

				$rows = ( isset($meta_box['rows']) ) ? $meta_box['rows'] : 4;
				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="' . $rows . '">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'textarea2':

				echo' 		
				<div class="post-meta-box4" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="4">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			
			case 'embed':

				$lp           = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
				$width        = ( $lp['lp-page-width'] > 0 ) ? $lp['lp-page-width'] : 820;
				$right_column = ( $lp['lp-page-right-width'] > 0 ) ? $lp['lp-page-right-width'] : 300;
				$padding      = ( $lp['lp-page-padding'] > 0 ) ? $lp['lp-page-padding'] : 25;

				$top_width_min    = ($width - ( $padding * 2 )) - 50;
				$top_width_max    = $width - ( $padding * 2 );
				$left_width_min   = (($width - $right_column) - ( $padding * 2 )) - 50;
				$left_width_max   = (($width - $right_column) - ( $padding * 2 )) - 25;

				echo' 		
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_textarea-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<textarea name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" class="widefat" cols="50" rows="4">' . trim(stripslashes(addslashes($meta_box_value))) . '</textarea>
        				<p>' . pt_isset($meta_box['desc']) . '<br /><br /><strong>Note:</strong> Maximum video width for <strong>Top Column is between <em>' . $top_width_min . ' px</em> and <em>' . $top_width_max . ' px</em></strong>, and maximum video width for <strong>Left Column is between <em>' . $left_width_min . ' px</em> and <em>' . $left_width_max . ' px</em></strong>.</p>
      				</div>
    				';

				break;

			case 'videourl':

				$lp           = get_post_meta( $post->ID, 'pt_landing_meta_box', true );
				$width        = ( $lp['lp-page-width'] > 0 ) ? $lp['lp-page-width'] : 820;
				$right_column = ( $lp['lp-page-right-width'] > 0 ) ? $lp['lp-page-right-width'] : 300;
				$padding      = ( $lp['lp-page-padding'] > 0 ) ? $lp['lp-page-padding'] : 25;

				$top_width_min    = ($width - ( $padding * 2 )) - 50;
				$top_width_max    = $width - ( $padding * 2 );
				$left_width_min   = (($width - $right_column) - ( $padding * 2 )) - 50;
				$left_width_max   = (($width - $right_column) - ( $padding * 2 )) - 25;

				echo'
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_text-field">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<input type="text" name="' . pt_isset($meta_box['id']).'" id="' . pt_isset($meta_box['id']) . '" class="widefat" value="' . htmlspecialchars($meta_box_value) . '" size="55" />
        				
					<p>' . pt_isset($meta_box['desc']) . ' Maximum video width for <strong>Top Column is between <em>' . $top_width_min . ' px</em> and <em>' . $top_width_max . ' px</em></strong>, and maximum video width for <strong>Left Column is between <em>' . $left_width_min . ' px</em> and <em>' . $left_width_max . ' px</em></strong>.</p>
      				</div>
    				';
				break;
			
			case 'selectnav':

				echo' 		
				<div class="post-meta-box">
        				<h4><label for="' . pt_isset($meta_box['id']) . '">' . pt_isset($meta_box['name']) . '</label></h4>
        				<select name="' . pt_isset($meta_box['id']) . '" id="' . pt_isset($meta_box['id']) . '" style="width:350px">
				';
				foreach ( $meta_box['options'] as $value ) {
					if ( $meta_box_value == $value ) {
						$selected = ' selected="selected"';
					} else {
						$selected = '';
					}
					echo '<option value="' . $value . '"' . $selected . '>' . ucwords($value) . '</option>';
				}
				echo'
					</select>
        				<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';

				break;

			case 'divwrapopen' :

					echo '<div id="'. pt_isset($meta_box['id']) . '">';
				break;
	
			case 'divwrapclose' :

					echo '</div>';
				break;

			case 'note' :

				echo'
				<div class="post-meta-box" id="' . pt_isset($meta_box['id']) . '_note-field">
					<p>' . pt_isset($meta_box['desc']) . '</p>
      				</div>
    				';
				break;
			
		}
  	}
}

add_action( 'admin_menu', 'pt_create_meta_box' );
add_action( 'save_post', 'pt_save_post_meta' );
add_action( 'save_post', 'pt_save_script_meta' );
add_action( 'save_post', 'pt_save_seo_meta' );
add_action( 'save_post', 'pt_save_landing_meta' );
add_action( 'save_post', 'pt_save_landing_columns' );
add_action( 'save_post', 'pt_save_member_meta' );