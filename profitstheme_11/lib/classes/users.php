<?php

class PtUsers {

	function setMemberAccess( $user )
	{
		global $wpdb, $integrate_options;

		foreach ( $integrate_options as $value ) {
			$$value['id'] = $value['value'];
		}

		echo '
    		<h3>Profits Theme Products/Subcriptions Access</h3>

    		<table class="form-table">
		';

		$product_table = $wpdb->prefix . 'ptmembership_products';
		$products = $wpdb->get_results( "SELECT * FROM `$product_table` ORDER BY product_id ASC" );

		foreach ( $products as $product ) {
			
			$keys = 'pt_level_' . $product->product_id;
			$name = $product->product_title;

			$meta_value = esc_attr(get_the_author_meta($keys, $user->ID));
			$checked = ($meta_value == 'true') ? ' checked="checked"' : '';

			echo '<tr>';
			echo '<th scope="row"><label for="' . $keys . '">' . $name . '</label></th>';
			echo '<td><input type="checkbox" name="' . $keys . '" id="' . $keys . '" value="true" ' . $checked . '/></td>';
			echo '</tr>';
		}

		echo '</table>';
	}

	function updateMemberAccess( $user_id ) 
	{
		global $wpdb;

		$product_table = $wpdb->prefix . 'ptmembership_products';
		$products = $wpdb->get_results( "SELECT product_id FROM `$product_table` ORDER BY product_id ASC" );

		foreach ( $products as $product ) {
			$meta_name  = 'pt_level_' . $product->product_id;
	    		update_usermeta( $user_id, $meta_name, ( isset($_REQUEST['pt_level_' . $product->product_id]) ? 'true' : 'false' ) );
		}
	}
}

$ptusers = new PtUsers;

if ( is_admin() ) {
	
	if ( current_user_can('add_users') ) {
		if ( $pt_integrate_membership != 'dap' && $pt_integrate_membership != 'wishlist' ) {
			add_action('show_user_profile', array(&$ptusers,'setMemberAccess'));
        		add_action('edit_user_profile', array(&$ptusers,'setMemberAccess'));
			add_action('personal_options_update', array(&$ptusers,'updateMemberAccess'));
        		add_action('edit_user_profile_update', array(&$ptusers,'updateMemberAccess'));
		}        	
	}
}
