<?php

function pt_add_admin() 
{
	global $pt_site_options, $pt_design_options, $pt_generator_options, $pt_launch_options, $pt_register_options,
	$pt_integrate_options, $pt_settings_options, $pt_update_options, $option_key, $wpdb, $pt_pages, $pt_posts;

	if ( pt_isset($_GET['page']) == 'pt_site_options' ) {
		$options =  $pt_site_options;
	} else if ( pt_isset($_GET['page']) == 'pt_design_options') {
		$options = $pt_design_options;
	} else if ( pt_isset($_GET['page']) == 'pt_launch_options') {
		$options = $pt_launch_options;
	} else if ( pt_isset($_GET['page']) == 'pt_integrate_options') {
		$options = $pt_integrate_options;
	} else if ( pt_isset($_GET['page']) == 'pt_page_generator') {
		$options = $pt_generator_options;
	} else if ( pt_isset($_GET['page']) == 'pt_settings_options') {
		$options = $pt_settings_options;
	}
	
	//if (pt_isset($_GET['page'])) {
	if ( pt_isset($_GET['page']) && strstr($_GET['page'],'pt_') ) {
		if ( !current_user_can('manage_options') ) {
			wp_die(__('Easy there, tiger. You don&#8217;t have admin privileges to access theme options.', 'profitstheme'));
		}

		// save options values
		if ( 'save' == pt_isset($_REQUEST['action']) ) {
			$pt_options = array();

			foreach ( $options as $value ) {
				if( is_array( pt_isset($value['std']) ) ){
					$optkey = array();
					$optstored = array();
					foreach ( $value['std'] as $key => $stored) {
						$optkey[] = $key;
						$optstored [] = $_REQUEST[$value['id'] . '_' . $key]; 
					}
	
					$allvalues = array_combine( $optkey, $optstored );
					$pt_options[] = array( 'id' => $value['id'], 'value' => $allvalues );
				
				} else if ( $value['type'] == 'instantpage' ) {

					if ( isset( $_REQUEST[$value['id']] ) ) {
						$group = ( isset($value['group']) ) ? $value['group'] : '';
						add_new_page( $value['title'], $value['file'], $value['layout'], $value['headline'], $group );
						$instant_page = true;
						$gen_type = $value['layout'];
					}

				} else if ( $value['type'] == 'checkbox' ) {

					if( isset( $_REQUEST[$value['id']]) ) {
						$pt_options[] = array( 'id' => $value['id'], 'value' => $_REQUEST[$value['id']] );
					} else {
						$pt_options[] = array( 'id' => $value['id'], 'value' => 'false' );
					}

				} else if ( $value['type'] == 'folder' ) {

					if ( isset( $_REQUEST[$value['id']] ) ) {
						$downloadpath = ABSPATH . '/wp-content/uploads/' . $_REQUEST[$value['id']];
						if ( !is_dir( $downloadpath ) ) {
							mkdir(str_replace('//', '/', $downloadpath), 0755, true);
						}

						if ( is_dir( $downloadpath ) && is_writeable( $downloadpath ) ) {
							$myFile = $downloadpath . '/.htaccess';
							$fh = fopen($myFile, 'w') or wp_die('can\'t open file');
							$stringData  = '<IfModule mod_rewrite.c>' . "\n";
							$stringData .= 'RewriteEngine On' . "\n";
							$stringData .= 'RewriteCond %{REQUEST_FILENAME} (.*)(\.gif|\.jpg|\.jpeg|\.png|\.pdf|\.flv|\.mp4|\.mp3|\.swf|\.mpg|\.mpeg|\.mov|\.avi|\.wmv|\.wav|\.zip|\.rar|\.7z|\.exe|\.txt|\.ppt|\.doc|\.docx|\.xls|\.xlsx)$' . "\n";
							if ( $value['id'] == 'pt_member_folder' ) {
								$stringData .= 'RewriteRule ^(.*) ' . trailingslashit(get_bloginfo('wpurl')) . '?mode=download&file=$1&type=paid [NC]' . "\n";
							} else {
								$stringData .= 'RewriteRule ^(.*) ' . trailingslashit(get_bloginfo('wpurl')) . '?mode=download&file=$1 [NC]' . "\n";
							}
							$stringData .= '</IfModule>' . "\n";

							fwrite($fh, $stringData);
							fclose($fh);

							$pt_options[] = array( 'id' => $value['id'], 'value' => $_REQUEST[$value['id']] );

						}
					}

				} else if ( $value['type'] == 'productform' ) {
							
					if ( isset( $_REQUEST[$value['id'] . '_payment_processor'] ) ) {
						if( isset( $_REQUEST[$value['id'] . '_product_id'] ) ) {
							pt_query_product( $value['id'], true, $_REQUEST[$value['id'] . '_product_id'] );
						} else {
							pt_query_product( $value['id'] );
						}
					}
				} else if ( $value['type'] == 'protectpages' ) {
					if ( isset( $_REQUEST[$value['id'] . '_product_id'] ) ) {
						for ( $i = 0; $i < count($_REQUEST[$value['id'] . '_page_id']); $i++ ) {
							if ( isset($_REQUEST[$value['id'] . '_page_id'][$i]) ) {
								
								$page_id = $_REQUEST[$value['id'] . '_page_id'][$i];

								$protect = get_post_meta( $page_id, 'pt_protect_content', true );
								if ( is_array( $protect ) ) {
									array_push( $protect, $_REQUEST[$value['id'] . '_product_id'] );
								} else {
									$protect = array($_REQUEST[$value['id'] . '_product_id']);
								}

								update_post_meta( $page_id, 'pt_protect_content', $protect );
							}
						}

						for ( $i = 0; $i < count($_REQUEST[$value['id'] . '_drip_start']); $i++ ) {
							$drip_data = array(
								'drip_start' => $_REQUEST[$value['id'] . '_drip_start'][$i],
								'drip_end' => $_REQUEST[$value['id'] . '_drip_end'][$i],
							);

							update_post_meta( $_REQUEST[$value['id'] . '_page_id_info'][$i], 'pt_drip_data', $drip_data );
						}

						$pages = pt_get_members_pages();

						if ( $pages['pages'] ) {
							foreach ( $pages['pages'] as $page ) {
								$protect = get_post_meta( $page->ID, 'pt_protect_content', true );
								if ( isset( $_REQUEST[$value['id'] . '_page_id'] ) ) {
									if ( !is_array( $protect) ) $protect = array( $protect );

									if ( !in_array( $page->ID, $_REQUEST[$value['id'] . '_page_id'] ) ) {
										$protect = array_diff($protect, array($_REQUEST[$value['id'] . '_product_id']));
										update_post_meta( $page->ID, 'pt_protect_content', $protect );
									}
								} else {
									if ( is_array( $protect ) ) {
										$protect = array_diff($protect, array($_REQUEST[$value['id'] . '_product_id']));
										update_post_meta( $page->ID, 'pt_protect_content', $protect );
									} else {							
										delete_post_meta( $page->ID, 'pt_protect_content' );
									}
								}
							}
						}

					}
				} else {

					if ( isset( $_REQUEST[pt_isset($value['id'])] ) ) {
						$pt_options[] = array( 'id' => $value['id'], 'value' => $_REQUEST[$value['id']] );
					}
				}
			}

			if ( pt_isset($_GET['page']) == 'pt_site_options' ) {
				update_option( 'pt_site_options', maybe_serialize( $pt_options ) );
				pt_write_css();
				wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&saved=true'));

			} else if ( pt_isset($_GET['page']) == 'pt_design_options' ) {
				update_option( 'pt_design_options', maybe_serialize( $pt_options ) );
				pt_write_css();
				wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&saved=true'));

			} else if ( pt_isset($_GET['page']) == 'pt_launch_options' ) {
				update_option( 'pt_launch_options', maybe_serialize( $pt_options ) );
				wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&saved=true'));

			}  else if ( pt_isset($_GET['page']) == 'pt_integrate_options' ) {
				update_option( 'pt_integrate_options', maybe_serialize( $pt_options ) );

				if ( isset( $_GET['level'] ) ) {
					if ( isset( $_GET['paged'] ) ) {
						wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&type=' . $_GET['type'] . '&level=' . $_GET['level'] . '&paged=' . $_GET['paged'] . '&saved=true'));
					} else {
						wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&type=' . $_GET['type'] . '&level=' . $_GET['level'] . '&saved=true'));
					}
				} else {
					wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&saved=true'));
				}
				
			} else if( pt_isset($_GET['page']) == 'pt_page_generator' ) {
				update_option( 'pt_generator_options', maybe_serialize( $pt_options ) );

				if ( isset( $instant_page ) ) {
					if ( $gen_type == 'review-page-single' ) {
						wp_redirect(admin_url('edit.php?post_status=draft&post_type=post'));
					} else {
						wp_redirect(admin_url('edit.php?post_status=draft&post_type=page'));
					}

				} else {
					wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&saved=true'));
				}
			}

			die;

		} else if ( 'resetlicense' == pt_isset($_REQUEST['action']) ) {
			delete_option('pt_api_key');
			delete_option($option_key);

			$dom_enc = md5(base64_encode($_SERVER['HTTP_HOST']));
			$old_option = 'pt_' . $dom_enc;
			delete_option($old_option);
			wp_redirect(admin_url("admin.php?page=pt_register_options"));
			die;

		} else if ( 'resetsite' == pt_isset($_REQUEST['action']) ) {
			$site_reset = array();
			foreach ( $pt_site_options as $value ) {
				if( isset($value['id']) && isset($value['std']) ) {
					$site_reset[] = array( 'id' => $value['id'], 'value' => $value['std'] );
				}
			}
			update_option( 'pt_site_options', $site_reset );
			pt_write_css();

			wp_redirect(admin_url("admin.php?page=" . pt_isset($_GET['page']) . "&reset=true&type=site"));
			die;

		}  else if ( 'resetdesign' == pt_isset($_REQUEST['action']) ) {
			$design_reset = array();
			foreach ( $pt_design_options as $value ) {
				if( isset($value['id']) && isset($value['std']) ) {
					$design_reset[] = array( 'id' => $value['id'], 'value' => $value['std'] );
				}
			}
			update_option('pt_design_options', $design_reset);
			pt_write_css();

			wp_redirect(admin_url("admin.php?page=" . pt_isset($_GET['page']) . "&reset=true&type=design"));
			die;

		} else if ( 'reset' == pt_isset($_REQUEST['action']) ) {
			$site_reset = array();
			foreach ( $pt_site_options as $value ) {
				if( isset($value['id']) && isset($value['std']) ) {
					$site_reset[] = array( 'id' => $value['id'], 'value' => $value['std'] );
				}
			}
			update_option('pt_site_options', $site_reset);
			
			$design_reset = array();
			foreach ( $pt_design_options as $value ) {
				if( isset($value['id']) && isset($value['std']) ) {
					$design_reset[] = array( 'id' => $value['id'], 'value' => $value['std'] );
				}
			}
			update_option('pt_design_options', $design_reset);
			pt_write_css();
			wp_redirect(admin_url("admin.php?page=" . pt_isset($_GET['page']) . "&reset=true&type=all"));
			die;
		
		} else if ( 'resetprotection' == pt_isset($_REQUEST['action']) ) {
	
			foreach ( $pt_posts as $post_id => $post_title ) {
				delete_post_meta( $post_id, 'pt_protect_content' );
			}

			foreach ( $pt_pages as $post_id => $post_title ) {
				delete_post_meta( $post_id, 'pt_protect_content' );
			}

			wp_redirect(admin_url("admin.php?page=" . pt_isset($_GET['page']) . "&reset=true&type=protection"));
			die;

		} else if ( 'export' == pt_isset($_REQUEST['action']) ) {
			global $site_options, $design_options;
			$options = $_REQUEST['pt_export_type'] == 'site' ? $site_options : $design_options;
			header( 'Content-disposition: attachment; filename=pt_' . $_REQUEST['pt_export_type'] . '_options.dat' );
			header( 'Content-type: text/dat' );
			echo maybe_serialize($options);
			exit;
		} else if ( 'importsite' == pt_isset($_REQUEST['action']) ) {
			$data = @file_get_contents($_FILES['pt_import_site']['tmp_name']);
			update_option( 'pt_site_options', $data);
			pt_write_css();
			wp_redirect(admin_url("admin.php?page=" . pt_isset($_GET['page']) . "&imported=true"));
			exit;
		} else if ( 'importdesign' == pt_isset($_REQUEST['action']) ) {
			$data = @file_get_contents($_FILES['pt_import_design']['tmp_name']);
			update_option( 'pt_design_options', $data);
			pt_write_css();
			wp_redirect(admin_url("admin.php?page=" . pt_isset($_GET['page']) . "&imported=true"));
			exit;
		} else if ( 'install_update' == pt_isset($_REQUEST['action']) ) {
			require_once( ABSPATH . 'wp-admin/includes/class-wp-upgrader.php' );
			global $wp_filesystem;
			$get_version = get_option('pt_version');
			$temp_dir    = ABSPATH . 'wp-content/uploads';
			$temp_dir    = str_replace('//', '/', $temp_dir);
			$error   = false;
			$use_ftp = false;

			$update_success = false;
			$skins_success  = false;
			$lp_success     = false;

			if ( isset( $_POST['pt_ftp_host'] ) ) {
				$ftp_cred['hostname'] = $_POST['pt_ftp_host'];
				$ftp_cred['username'] = $_POST['pt_ftp_user'];
				$ftp_cred['password'] = $_POST['pt_ftp_pass'];
				$ftp_cred['connection_type'] = 'ftpext';
				
				if ( !WP_Filesystem( $ftp_cred ) ) {
					$error = true;
					add_action('admin_notices', create_function( '', 'echo \'<div class="error fade"><p><strong>ERROR:</strong> We were unable to connect to your FTP server with the info you provided.</p></div>\';') );
				}

				$use_ftp = true;
			}

			if ( !$error ) {

				if ( $use_ftp ) {

					$ftp_temp_dir  = $wp_filesystem->find_folder($temp_dir);
					if ( !is_dir( $temp_dir ) ) {
						$wp_filesystem->mkdir( trailingslashit($ftp_temp_dir), 0777 );
					}

					if ( !is_writeable( $temp_dir ) ) {
						$wp_filesystem->chmod( trailingslashit($ftp_temp_dir), 0777 );
					}
				} else {
					require_once( ABSPATH . 'wp-admin/includes/class-pclzip.php' );
				}

				if ( $get_version['update'] == true ) {
					$theme_dir = TEMPLATEPATH;

					if ( $use_ftp ) {

						$ftp_theme_dir = $wp_filesystem->find_folder($theme_dir);

						if ( !is_dir( $theme_dir ) ) {
							$wp_filesystem->mkdir( trailingslashit($ftp_theme_dir), 0777 );
						}

						if ( !is_writeable( $theme_dir ) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_theme_dir), 0777 );
						}
					}
					
					$pt_temp = download_url($_POST['pt_update_url']);
			
					if ( is_wp_error($pt_temp) ) {
						wp_die($pt_temp);
					}

					if ( $use_ftp ) {
						$ftp_theme_dir = $wp_filesystem->find_folder($theme_dir);
						$unzip_pt = unzip_file($pt_temp, trailingslashit($ftp_theme_dir));
						if ( is_wp_error($unzip_pt) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_theme_dir), 0755 );
							wp_die($unzip_pt);
						}
						
						$update_success = true;

					} else {
						$unzip_pt = new PclZip( $pt_temp );
						$extract = $unzip_pt->extract(PCLZIP_OPT_PATH, trailingslashit($theme_dir));
						if ( $extract[0]['status'] == 'path_creation_fail' ) {
							add_action('admin_notices', create_function('', 'echo \'<div class="error fade"><p><strong>ERROR:</strong> Unable to extract update package to themes directory.</p></div>\';') );
							$update_success = false;
						} else {
							$update_success = true;
						}

					}

					@unlink($pt_temp);

					if ( $update_success ) {
						$pt_versions = array(
							'current' => $_POST['pt_new_version'],
							'new' => $_POST['pt_new_version'],
							'update' => false,
							'url' => ''
						);

						update_option( 'pt_version', $pt_versions );
					}
					
					if ( $use_ftp ) {
						$ftp_theme_dir = $wp_filesystem->find_folder($theme_dir);
						$wp_filesystem->chmod( trailingslashit($ftp_theme_dir), 0755 );
					}
					
				}

				if ( !empty($_FILES['install_skins']['name']) ) {
					$skins_dir   = TEMPLATEPATH . '/lib/skins';

					if ( $use_ftp ) {
						
						$ftp_skins_dir = $wp_filesystem->find_folder($skins_dir);

						if ( !is_dir( $skins_dir ) ) {
							$wp_filesystem->mkdir( trailingslashit($ftp_skins_dir), 0777 );
						}

						if ( !is_writeable( $skins_dir ) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_skins_dir), 0777 );
						}
					}

					$file_upload = new File_Upload_Upgrader('install_skins', 'package');
					
					if ( $use_ftp ) {
						$ftp_skins_dir = $wp_filesystem->find_folder($skins_dir);
						$unzip_skins = unzip_file($file_upload->package, trailingslashit($ftp_skins_dir));

						if ( is_wp_error($unzip_skins) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_skins_dir), 0755 );
							wp_die($unzip_skins);
						}

						$skins_success = true;

					} else {
						$unzip_skins = new PclZip( $file_upload->package );
						$extract = $unzip_skins->extract(PCLZIP_OPT_PATH, trailingslashit($skins_dir));
						if ( $extract[0]['status'] == 'path_creation_fail' ) {
							add_action('admin_notices', create_function('', 'echo \'<div class="error fade"><p><strong>ERROR:</strong> Unable to extract skins package to Profits Theme directory.</p></div>\';') );
							$skins_success = false;
						} else {
							$skins_success = true;
						}
					}

					@unlink($file_upload->package);
					
					if ( $use_ftp ) {
						$ftp_skins_dir = $wp_filesystem->find_folder($skins_dir);
						$wp_filesystem->chmod( trailingslashit($ftp_skins_dir), 0755 );
					}

					
				}

				if ( !empty($_FILES['install_minisites']['name']) ) {
					$lp_dir   = TEMPLATEPATH . '/lib/skins/minisite';

					if ( $use_ftp ) {
						
						$ftp_lp_dir = $wp_filesystem->find_folder($lp_dir);

						if ( !is_dir( $lp_dir ) ) {
							$wp_filesystem->mkdir( trailingslashit($ftp_lp_dir), 0777 );
						}

						if ( !is_writeable( $lp_dir ) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_lp_dir), 0777 );
						}
					}

					$file_upload = new File_Upload_Upgrader('install_minisites', 'package');
					
					if ( $use_ftp ) {
						$ftp_lp_dir = $wp_filesystem->find_folder($lp_dir);
						$unzip_lp = unzip_file($file_upload->package, trailingslashit($ftp_lp_dir));
						
						if ( is_wp_error($unzip_lp) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_lp_dir), 0755 );
							wp_die($unzip_lp);
						}

						$lp_success = true;
					} else {
						$unzip_lp = new PclZip( $file_upload->package );
						$extract = $unzip_lp->extract(PCLZIP_OPT_PATH, trailingslashit($lp_dir));
						if ( $extract[0]['status'] == 'path_creation_fail' ) {
							add_action('admin_notices', create_function('', 'echo \'<div class="error fade"><p><strong>ERROR:</strong> Unable to extract landing page skins package to Profits Theme directory.</p></div>\';') );
							$lp_success = false;
						} else {
							$lp_success = true;
						}
					}

					@unlink($file_upload->package);
					
					if ( $use_ftp ) {
						$ftp_lp_dir = $wp_filesystem->find_folder($lp_dir);
						$wp_filesystem->chmod( trailingslashit($ftp_lp_dir), 0755 );
					}
				}

				if ( !empty($_FILES['install_jwplayer']['name']) ) {
					$jw_dir   = TEMPLATEPATH . '/lib/scripts/jwplayer';

					if ( $use_ftp ) {
						
						$ftp_jw_dir = $wp_filesystem->find_folder($jw_dir);

						if ( !is_dir( $jw_dir ) ) {
							$wp_filesystem->mkdir( trailingslashit($ftp_jw_dir), 0777 );
						}

						if ( !is_writeable( $lp_dir ) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_jw_dir), 0777 );
						}
					}

					$file_upload = new File_Upload_Upgrader('install_jwplayer', 'package');
					
					if ( $use_ftp ) {
						$ftp_jw_dir = $wp_filesystem->find_folder($jw_dir);
						$unzip_jw = unzip_file($file_upload->package, trailingslashit($ftp_jw_dir));
						
						if ( is_wp_error($unzip_jw) ) {
							$wp_filesystem->chmod( trailingslashit($ftp_jw_dir), 0755 );
							wp_die($unzip_jw);
						}

						$jw_success = true;
					} else {
						$unzip_jw = new PclZip( $file_upload->package );
						$extract = $unzip_jw->extract(PCLZIP_OPT_PATH, trailingslashit($jw_dir));
						if ( $extract[0]['status'] == 'path_creation_fail' ) {
							add_action('admin_notices', create_function('', 'echo \'<div class="error fade"><p><strong>ERROR:</strong> Unable to extract JW Player package to Profits Theme scripts directory.</p></div>\';') );
							$jw_success = false;
						} else {
							$jw_success = true;
						}
					}

					@unlink($file_upload->package);
					
					if ( $jw_success ) {
						// Find JW Player installation
						if ( is_dir( $jw_dir) ) {
    							if ( $jw_path = opendir( $jw_dir ) ) { 
        							while ( ( $jw_file = readdir( $jw_path ) ) !== false ) {
									if ( $jw_file != "." && $jw_file != ".." ) {
		                						$jws[] = $jw_file;
									}
        							}    
    							}
						}

						if ( pt_isset($jws) ) {
							
							if ( is_dir( $jw_dir . '/' . $jws[0] ) ) {
								$new_jw_path = get_bloginfo('template_url') . '/lib/scripts/jwplayer/' . $jws[0] . '/jwplayer.flash.swf';
								$jw_abspath  = PT_SCRIPTS . '/jwplayer/' . $jws[0] . '/jwplayer.flash.swf';
							} else {
								$new_jw_path = get_bloginfo('template_url') . '/lib/scripts/jwplayer/jwplayer.flash.swf';
								$jw_abspath  = PT_SCRIPTS . '/jwplayer/jwplayer.flash.swf';
							}

							if ( file_exists ( $jw_abspath ) ) {
								update_option('jw_player_location', $new_jw_path);
							} else {
								add_action('admin_notices', create_function('', 'echo \'<div class="error fade"><p><strong>ERROR:</strong> Unable to integrate JW Player with Profits Theme.</p></div>\';') );
								$jw_success = false;
							}
						}
					}

					
					
					if ( $use_ftp ) {
						$ftp_jw_dir = $wp_filesystem->find_folder($jw_dir);
						$wp_filesystem->chmod( trailingslashit($ftp_jw_dir), 0755 );
					}
				}

				if ( $update_success ) {
					if ( $skins_success || $lp_success || $jw_success ) {
						add_action('admin_notices', create_function('', 'echo "<div class=\'updated fade\'><p><strong>Profits Theme updated.</strong></p></div>";') );
					} else {
						wp_redirect(admin_url('admin.php?page=pt_update_options&updated=true'));
						exit;
					}
				}

				if ( $skins_success ) {
					add_action('admin_notices', create_function('', 'echo "<div class=\'updated fade\'><p><strong>Site skin(s) installed.</strong></p></div>";') );
				}

				if ( pt_isset($jw_success) ) {
					add_action('admin_notices', create_function('', 'echo "<div class=\'updated fade\'><p><strong>JW Player has been integrated.</strong></p></div>";') );
				}

				if ( $lp_success ) {
					add_action('admin_notices', create_function('', 'echo "<div class=\'updated fade\'><p><strong>Landing Page skin(s) installed.</strong></p></div>";') );
				}
			}
			
		} else if ( 'pt_check_update' == pt_isset($_REQUEST['action']) ) {
			// check for PT update
			$pt_api_key = $_POST['pt_api_key'];

			$request = new PtApiRequest( 'http://ptapi.getprofitsfast.com/' . $pt_api_key . '/getupdate', 'GET' );
			$request->setAcceptType('application/json');
			$request->execute();

			$result = proccesAPI($request->getResponseBody(), 'version');
			$get_version = get_option('pt_version');

			if ( isset($result['version']) ) {
				if ( $get_version['current'] < $result['version'] ) {
				// Add new version
					$pt_versions = array(
						'current' => $get_version['current'],
						'new' => $result['version'],
						'update' => true,
						'url' => $result['url']
					);

					update_option( 'pt_version', $pt_versions );
				} else {
					add_action( 'admin_notices', 'pt_no_update_avail' );
				}
			} else {
				add_action( 'admin_notices', 'pt_no_update_avail' );
			}


			function pt_no_update_avail()
			{
				echo '<div class="updated fade"><p><strong>Currently no update available for Profits Theme. Please try again later.</strong></p></div>';
			}

		} else if ( 'editor' == pt_isset($_REQUEST['action']) ) {
			if ( $_POST['newcontent'] != '' ) {
				$newcontent  = stripslashes( $_POST['newcontent'] );
				$custom_file = $_POST['filename'];

				if ( file_exists( $custom_file ) ) {
					$file_open = @fopen($custom_file, 'w+'); // Open the file

					if ( $file_open !== FALSE ) {
						@fwrite($file_open, $newcontent);
					} else {
						wp_redirect(admin_url('admin.php?page=pt_custom_editor&updated=false'));
						die;
					}
						
					@fclose($file_open);
					
					if ( isset( $_POST['enablecustom'] ) ) {
						update_option('pt_enable_custom', 'true');
					} else {
						update_option('pt_enable_custom', 'false');
					}

					wp_redirect(admin_url('admin.php?page=pt_custom_editor&updated=true'));
					die;
				} else {
					wp_redirect(admin_url('admin.php?page=pt_custom_editor&updated=nofile'));
					die;
				}
			}
		}
	}

	if ( pt_isset($_GET['page']) == 'pt_integrate_options' ) {
			if ( isset($_GET['action']) && $_GET['action'] == 'delete' ) {

				$remove_error = 0;
				$product_id = (int) $_GET['product_id'];
					
				// remove protection in posts				
				foreach ( $pt_posts as $post_id => $post_title ) {
					$meta = get_post_meta( $post_id, 'pt_protect_content', true );
					if ( is_array( $meta ) ) {
						if ( in_array( $product_id, $meta ) ) {
							if ( count( $meta ) <= 1 ) {
								delete_post_meta( $post_id, 'pt_protect_content' );
							} else {
								$protect = array_diff($meta, array($product_id));
								update_post_meta( $post_id, 'pt_protect_content', $protect );
							}
						}
					}
				}

				// remove protection in pages			
				foreach ( $pt_pages as $post_id => $post_title ) {
					$meta = get_post_meta( $post_id, 'pt_protect_content', true );
					if ( is_array( $meta ) ) {
						if ( in_array( $product_id, $meta ) ) {	
							if ( count( $meta ) <= 1 ) {
								delete_post_meta( $post_id, 'pt_protect_content' );
							} else {
								$protect = array_diff($meta, array($product_id));
								update_post_meta( $post_id, 'pt_protect_content', $protect );
							}
						}
					}
				}
				
				if ( $remove_error == 1 ) {
					add_action('admin_notice', 'pt_delete_product_error');
				}

				function pt_delete_product_error()
				{
					echo '<div class="error fade"><p><strong>Error: </strong>Cannot remove product. Please remove all posts and pages protection from this product first.</p></div>';
				}

				if ( $remove_error == 0 ) {
					$product_table = $wpdb->prefix . 'ptmembership_products';
					$wpdb->query("DELETE FROM $product_table WHERE product_id = $product_id");
					wp_redirect(admin_url('admin.php?page=' . pt_isset($_GET['page']) . '&deleted=true'));
					die;
				}
			}
		}
	pt_admin_menu();

}

function pt_site_options()
{

	global $pt_site_options;

	$header = pt_admin_header();
	echo $header;
	
    	if ( pt_isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Site options saved.</strong></p></div>';
	if ( isset( $_REQUEST['activation'] ) && $_REQUEST['activation'] == 'true' ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>' . __('Activation Success! You can now enjoy Profits Theme.','thematic') . '</strong></p></div>';

	
	$tabsnames = array(
			'general' => 'General',
			'display' => 'Display',
			'media' => 'Media Box',
			'seo' => 'SEO',
			'scripts' => 'Scripts',
			'ads' => 'Ads',
			'optin' => 'Pop Up Optin',
			'optin2' => 'Header Optin'
		);

	$opt = new PtOptions();
	$opt->setOptions( $pt_site_options, 'gpftabs', $tabsnames, 'siteopt' );
	echo $opt->getOptions();
	
}

function pt_design_options()
{

	global $pt_design_options;

	$header = pt_admin_header();
	echo $header;

	if ( pt_isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Design options saved.</strong></p></div>';
	
    	$tabsnames = array(
			'skins' => 'Site Skins',
			'interface' => 'Layout',
			'head' => 'Header',
			'navi' => 'Nav Style (optional)',
			'typo' => 'Typography (optional)',
			'thumb' => 'Thumbs (optional)',
			'membership' => 'Membership Design',
		);

	$opt = new PtOptions();
	$opt->setOptions( $pt_design_options, 'gpftabs', $tabsnames, 'designopt' );

	echo $opt->getOptions();
}

function pt_launch_options()
{
	global $pt_launch_options;

	$header = pt_admin_header();
	echo $header;

	if ( pt_isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>' . __('Launch Settings Saved','profitstheme') . '</strong></p></div>';
			
    	$tabsnames = array(
			'launch' => 'Product Launch Options',
		);

	$opt = new PtOptions();
	$opt->setOptions( $pt_launch_options, 'gpftabs', $tabsnames, 'launchopt', true);

	echo $opt->getOptions();
}

function pt_page_generator()
{

	global $pt_generator_options;

	$header = pt_admin_header();
	echo $header;
 
	if ( pt_isset($_REQUEST['saved']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Business information saved.</strong></p></div>';
			
    	$tabsnames = array(
			'generator' => 'Page Generator',
			'business' => 'Business Information',
		);

	$opt = new PtOptions();
	$opt->setOptions( $pt_generator_options, 'gpftabs', $tabsnames, 'pagegenopt');

	echo $opt->getOptions();
}

function pt_custom_editor()
{
	$header = pt_admin_header();
	echo $header;

	if ( isset($_REQUEST['updated']) && $_REQUEST['updated'] == 'true' ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>File has been saved.</strong></p></div>';
	if ( isset( $_REQUEST['updated'] ) && $_REQUEST['updated'] == 'false' ) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>Error: File cannot be saved.</strong></p></div>';
	if ( isset( $_REQUEST['updated'] ) && $_REQUEST['updated'] == 'nofile' ) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>Error: The file you are trying to save does not exist.</strong></p></div>';

	require_once('custom-editor.php');
}

function pt_integrate_options()
{

	global $themename, $shortname, $pt_integrate_options;

	$header = pt_admin_header();
	echo $header;

	if ( pt_isset($_REQUEST['added']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>A new product / membership level has been added.</strong></p></div>';
	if ( pt_isset($_REQUEST['deleted']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Product / Membership Level deleted.</strong></p></div>';
    if ( pt_isset($_REQUEST['cbitemerror']) ) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>Error: Please enter your Clickbank Product Item Number.</strong></p></div>';
	if ( pt_isset($_REQUEST['cbvendorerror']) ) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>Error: Please enter your Clickbank ID.</strong></p></div>';
	if ( pt_isset($_REQUEST['aweber']) == 'true') echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Your aweber account has been connected with Profits Theme</strong></p></div>';
	if ( pt_isset($_REQUEST['aweber']) == 'false') echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>Can\'t connect your aweber account with Profits Theme</strong></p></div>';
	$pt_data_integrate_options = maybe_unserialize(get_option('pt_integrate_options'));
	foreach ( $pt_data_integrate_options as $row) {
		if ($row['id'] == 'pt_aweber_key' || $row['id'] == 'pt_aweber_secret')
			$$row['id'] = $row['value'];
	}
	
	if (pt_isset($pt_aweber_key) &&  pt_isset($pt_aweber_secret)){
		if (!get_option('pt_aweber_token', false)) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong><a href="'.admin_url('admin.php?page=pt_integrate_options&connect=aweber').'">Click here</a> to connect your aweber account with Profits Theme</strong></p></div>';
	}

	$tabsnames = array(
		'integrate' => 'General Settings',
		'productlevel' => 'Products / Levels',
		'contentsprotect' => 'Protect Posts / Pages',
		'filedownload' => 'Protect Folder',
		'payments' => 'Payment Integration',
		'aweber' => 'Autoresponder Integration'
	);
	
	$opt = new PtOptions();
	$opt->setOptions( $pt_integrate_options, 'gpftabs', $tabsnames, 'integrateopt', false );

	echo $opt->getOptions();
}

function pt_settings_options()
{

	global $themename, $shortname, $pt_settings_options;

	$header = pt_admin_header();
	echo $header;

	if ( pt_isset($_REQUEST['install']) && pt_isset($_REQUEST['install']) == 'skin' ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>A new site skin has been installed.</strong></p></div>';
    	if ( pt_isset($_REQUEST['install']) && pt_isset($_REQUEST['install']) == 'headers' ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Headers Graphics has been installed.</strong></p></div>';
	if ( pt_isset($_REQUEST['reset']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>' . ucwords(pt_isset($_GET['type'])) . __(' Options Reset.','profitstheme') . '</strong></p></div>';
	if ( pt_isset($_REQUEST['imported']) && pt_isset($_REQUEST['imported']) == 'true' ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>' . __('Import Options Success.','profitstheme') . '</strong></p></div>';
		
    	$tabsnames = array(
			'settings' => 'Manage Options',
		);

	$opt = new PtOptions();
	$opt->setOptions( $pt_settings_options, 'gpftabs', $tabsnames, 'settingsopt', true );

	echo $opt->getOptions();
}

function pt_update_options()
{
	global $themename, $shortname, $pt_update_options;

	if ( pt_isset($_REQUEST['updated']) ) echo '<div id="message" class="updated fade" style="width:94%;margin-bottom:10px;"><p><strong>Profits Theme updated.</strong></p></div>';

	$header = pt_admin_header();
	echo $header;

	$tabsnames = array(
		'update' => 'Update PT',
	);

	$opt = new PtOptions();
	$opt->setOptions( $pt_update_options, 'gpftabs', $tabsnames, 'updateopt', true );

	echo $opt->getOptions();
}

function pt_register_options()
{

	global $themename, $shortname, $pt_register_options;

	$header = pt_admin_header();
	echo $header;

	if ( isset( $_REQUEST['activation'] ) && $_REQUEST['activation'] == 'false' ) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>' . __('Activation Failed!','profitstheme') . '</strong></p></div>';
	if ( isset( $_REQUEST['activation'] ) && $_REQUEST['activation'] == 'error' ) echo '<div id="message" class="error fade" style="width:94%;margin-bottom:10px;"><p><strong>' . __('Activation Error. Please contact your host administrator to enable cURL Library in your web server.','profitstheme') . '</strong></p></div>';
		
    	$tabsnames = array(
			'registration' => 'Profits Theme Registration',
		);

	$opt = new PtOptions();
	$opt->setOptions( $pt_register_options, 'gpftabs', $tabsnames, 'registeropt', true );

	echo $opt->getOptions();
}

add_action('admin_menu', 'pt_add_admin');