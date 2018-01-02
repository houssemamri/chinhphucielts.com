<?php
/**
 * Profits Theme's theme options framework. This class render almost all the elements  
 * needed by the theme options.
 *
 * @package Profits
 * @subpackage Classes
 */

class PtFields {

	function setTextField( $args, $stored )
	{
		$fieldWidth  = (isset($args['width']) && pt_isset($args['width']) > 0) ? ' style="width:' . pt_isset($args['width']) . 'px;"' : '';
		$fieldPrefix = (isset($args['prefix']) && $args['prefix'] != '') ? '<small>' . $args['prefix'] . '</small>' : '';
		$fieldSuffix = (isset($args['suffix']) && $args['suffix'] != '') ? $args['suffix'] : '';
		$mode = (isset($args['mode'])) ? $args['mode'] : '';

		$this->_textField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_text-field">' . "\n";
		$this->_textField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_textField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		
		if ( pt_isset($args['note']) != '' ) {
			$this->_textField .= "\t\t\t\t\t" . '<div style="text-align:left">' . pt_isset($args['note'])  . '</div>' . "\n";
		}

		$this->_textField .= "\t\t\t\t\t" . $fieldPrefix . '<input type="text" name="' . $args['id'] . '" id="' . $args['id'] . '" class="field_txt"';
		$this->_textField .= ' value="' . $stored . '"' . $fieldWidth . $mode . ' /> ' . $fieldSuffix . "\n";
		$this->_textField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_textField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_textField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_textField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getTextField()
	{
		return $this->_textField;
	}

	function setProductFormField( $args )
	{
		if ( isset($_GET['action']) && $_GET['action'] == 'edit' ) {
			global $wpdb;
			
			$product_table = $wpdb->prefix . 'ptmembership_products';
			$product = $wpdb->get_results( "SELECT * FROM `$product_table` WHERE product_id = '" . $_GET['product_id'] . "'" );
		}

		$p_id = ( isset($product) ) ? $product[0]->product_id : '';
		$p_name = ( isset($product) ) ? $product[0]->product_title : '';
		$p_type = ( isset($product) ) ? $product[0]->payment_proccessor: '';
		$p_number  = ( isset($product) ) ? $product[0]->product_number : paypal_item_id();
		$cb_item   = ( isset($product) ) ? $product[0]->cb_item_number : '';
		$cb_vendor = ( isset($product) && $p_type == 'cb' ) ? $product[0]->cb_vendor_name : '';
		$p_price   = ( isset($product) && $product[0]->product_price > 0 ) ? $product[0]->product_price : '0.00';

		$zx_item = ( isset($product) && $p_type == 'zaxaa' ) ? $product[0]->cb_vendor_name : '';
		$jvz_item = ( isset($product) && $p_type == 'jvzoo' ) ? $product[0]->cb_vendor_name : '';
		
		$pypl_payment_type   = (isset($product)) ? $product[0]->pypl_payment_type : '';
		$pypl_subs_duration  = (isset($product) && $product[0]->pypl_subs_duration > 0 ) ? $product[0]->pypl_subs_duration : '';
		$pypl_subs_dur_mode  = (isset($product)) ? $product[0]->pypl_subs_duration_mode : '';
		$pypl_recur_times    = (isset($product) && $product[0]->pypl_recur_times > 0 ) ? $product[0]->pypl_recur_times : '';
		$pypl_trial_price    = (isset($product) && $product[0]->pypl_trial_price > 0 ) ? $product[0]->pypl_trial_price : '0.00';
		$pypl_trial_duration = (isset($product) && $product[0]->pypl_trial_duration > 0 ) ? $product[0]->pypl_trial_duration : '';
		$pypl_trial_dur_mode = (isset($product)) ? $product[0]->pypl_trial_duration_mode : '';
		$pypl_currency       = (isset($product)) ? $product[0]->pypl_currency : '';
		$pypl_return_page    = (isset($product)) ? $product[0]->pypl_return_page : '';
		$pypl_cancel_page    = (isset($product)) ? $product[0]->pypl_cancel_page : '';

		$ar_enable           = (isset($product)) ? $product[0]->ar_enable : 'no';
		$ar_account          = (isset($product)) ? $product[0]->ar_account : '';
		$ar_list_name        = (isset($product)) ? $product[0]->ar_list_name : '';
		$ar_gr_api_key       = (isset($product)) ? $product[0]->ar_gr_api : '';
		$ar_mc_api_key       = (isset($product)) ? $product[0]->ar_mc_api : '';

		$title = (!isset($product)) ? 'Add New Product / Membership Level' : 'Edit Product / Membership Level';
		$this->_productFormField  = "\t\t" . '<a name="edit_product"></a>' . "\n";
		$this->_productFormField .= "\t\t" . '<div class="biglabel">' . $title . '</div>' . "\n";
		$this->_productFormField .= "\t\t" . '<div class="block">' . "\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pname-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_product_title">Product / Level Name</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_product_title" id="' . $args['id'] . '_product_title" class="field_txt" value="' . $p_name . '" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter a name for your product or membership level.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		if ( $p_type != '' ) {
			if ( $p_type == 'cb' ) {
				$free_selected = '';
				$cb_selected = ' selected="selected"';
				$pypl_selected = '';
				$zaxaa_selected = '';
				$jvzoo_selected = '';
			} else if ( $p_type == 'pypl' ) {
				$free_selected = '';
				$cb_selected = '';
				$pypl_selected = ' selected="selected"';
				$zaxaa_selected = '';
				$jvzoo_selected = '';
			} else if ( $p_type == 'jvzoo' ) {
				$free_selected = '';
				$cb_selected = '';
				$pypl_selected = '';
				$zaxaa_selected = '';
				$jvzoo_selected = ' selected="selected"';
			} else if ( $p_type == 'zaxaa' ) {
				$free_selected = '';
				$cb_selected = '';
				$pypl_selected = '';
				$zaxaa_selected = ' selected="selected"';
				$jvzoo_selected = '';
			} else {
				$free_selected = '';
				$cb_selected = '';
				$pypl_selected = '';
				$zaxaa_selected = '';
				$jvzoo_selected = '';
			}
		} else {
			$free_selected = '';
			$cb_selected = '';
			$pypl_selected = '';
			$zaxaa_selected = ' selected="selected"';
			$jvzoo_selected = '';
		}

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_payment-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_payment_processor">Payment Processor</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<p>** We highly recommend you use <a href="https://www.zaxaa.com" target="_blank">Zaxaa</a> for your payment processor because:</p><p>- Zaxaa is the world\'s EASIEST & FASTEST Online Selling Automation platform. You\'ll be up and running very, very quickly.</p>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_payment_processor" id="' . $args['id'] . '_payment_processor" class="field_select" size="1">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="free"' . $free_selected . '>Free</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="zaxaa"' . $zaxaa_selected . '>Zaxaa</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="cb"' . $cb_selected . '>Clickbank</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="pypl"' . $pypl_selected . '>Paypal</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="jvzoo"' . $jvzoo_selected . '>JVZoo</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Choose the payment processor you want to use, or select free if you want to create a free membership site.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div id="cb_fields">' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_cbitem-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<div id="message" class="updated fade" style="margin:0px;"><p>Please ensure your Product Title in Clicbank <b>ONLY</b> contains alphabets/ numbers/ spaces, and does NOT contain any kind of symbols.</p></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right"></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";
		
		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_cbitem-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_cb_item">Clickbank Product Item Number</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_cb_item" id="' . $args['id'] . '_cb_item" class="field_txt" value="' . $cb_item . '" style="width:100px" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter the item number of your product. Check your CB account to find out, and please enter only digits.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_cbid-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_cbid">Your Clickbank ID</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_cbid" id="' . $args['id'] . '_cbid" class="field_txt" value="' . $cb_vendor . '" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter your Clickbank ID here.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";
		
		$this->_productFormField .= "\t\t\t" . '<div id="zx_fields">' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_zxitem-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_zx_item">Zaxaa Product Number/SKU</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_zx_item" id="' . $args['id'] . '_zx_item" class="field_txt" value="' . $zx_item . '" style="width:100px" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Edit the corresponding product in your Zaxaa account, and copy the product number or SKU (under "General Settings" tab), then paste it here.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_zpn-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_zpn">ZPN URL</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" id="' . $args['id'] . '_zpn" class="field_txt" value="' . trailingslashit(get_bloginfo('url')) . '?mode=zaxaa&process=payment" readonly />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Edit the corresponding product in your Zaxaa account, and enable the "Third Party Integration" feature, then enter this URL into the "ZPN URL" field.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";
		
		$this->_productFormField .= "\t\t\t" . '<div id="jvz_fields">' . "\n\n";
		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_jvzitem-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_jvz_item">JVZoo Product ID#</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_jvz_item" id="' . $args['id'] . '_jvz_item" class="field_txt" value="' . $jvz_item . '" style="width:100px" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Edit the corresponding product in your JVZoo account, and look up at the URL in your address bar. The numbers at the end of the URL is the JVZoo Product ID.<br /><br /><em>E.g. https://www.jvzoo.com/products/edit/<strong>12345</strong></em><br /><br />In this example, "12345" is the Product ID</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_jvzipn-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_jvzipn">JVZIPN URL</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" id="' . $args['id'] . '_jvzipn" class="field_txt" value="' . trailingslashit(get_bloginfo('url')) . '?mode=jvzoo&process=payment" readonly />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Edit the corresponding product in your JVZoo account, and enable the "External Program Integration" feature, choose "Method #1", then enter this into the "JVZIPN URL" field.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div id="pypl_fields">' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_price-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_product_price">Price</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_product_price" id="' . $args['id'] . '_product_price" class="field_txt" value="' . $p_price .'" style="width:100px" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter only digits (and period, if necessary). Do NOT enter commas or currency sign.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_currency-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_currency">Paypal Currency</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pypl_currency" id="' . $args['id'] . '_pypl_currency" class="field_select" size="1">' . "\n";
		
		foreach ( $args['options']['item_currency'] as $value => $opt ) {

			$selected = ( $pypl_currency == $value ) ? ' selected="selected"' : ''; 

			$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Choose your currency.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		if ( $pypl_payment_type == 'single' ) {
			$single_selected = ' selected="selected"';
			$subs_selected = '';
		} else if ( $pypl_payment_type == 'subscription' ) {
			$single_selected = '';
			$subs_selected = ' selected="selected"';
		} else {
			$single_selected = '';
			$subs_selected = '';
		}

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_payment-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_payment">Paypal\'s Payment Type</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pypl_payment" id="' . $args['id'] . '_pypl_payment" class="field_select" size="1">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="single"' . $single_selected . '>One-Time Payment</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="subscription"' . $subs_selected . '>Recurring Billing</option>' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Choose the type of payment for this product.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div id="pypl_subs_fields">' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_subs_dur-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_subs_dur">Subscription Duration</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_pypl_subs_dur" id="' . $args['id'] . '_pypl_subs_dur" class="field_txt" value="' . $pypl_subs_duration . '" style="width:100px" /> ' . "\n";
		
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pypl_subs_dur_mode" id="' . $args['id'] . '_pypl_subs_dur_mode" class="field_select" size="1" style="width:100px">' . "\n";
		
		$duration_mode = array( 'D' => 'Day(s)', 'W' => 'Week(s)', 'M' => 'Month(s)', 'Y' => 'Year(s)' );
		foreach ( $duration_mode as $value => $opt ) {

			$selected = ( $pypl_subs_dur_mode == $value ) ? ' selected="selected"' : ''; 

			$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter subscription period for this product.<br /><strong>Day(s)</strong> - Allowable range is 1 to 90<br /><strong>Week(s)</strong> - Allowable range is 1 to 52<br /><strong>Month(s)</strong> - Allowable range is 1 to 24<br /><strong>Year(s)</strong> - Allowable range is 1 to 5</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_recur-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_recurr">Recurring Times</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_pypl_recurr" id="' . $args['id'] . '_pypl_recurr" class="field_txt" value="' . $pypl_recur_times . '" style="width:100px" /> Times' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">This is the number of payments which will occur at the regular rate unless the subscription is cancelled. Leave this blank if you don\'t want to specify the number of payments.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_trial-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_trial">Trial Price</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_pypl_trial" id="' . $args['id'] . '_pypl_trial" class="field_txt" value="' . $pypl_trial_price . '" style="width:100px" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter only digits (and period, if necessary). Do NOT enter commas or currency sign. Use 0 for free trial or leave this field blank to not use trial.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_trial_dur-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_trial_dur">Trial Duration</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_pypl_trial_dur" id="' . $args['id'] . '_pypl_trial_dur" class="field_txt" value="' . $pypl_trial_duration . '" style="width:100px" /> ' . "\n";

		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pypl_trial_dur_mode" id="' . $args['id'] . '_pypl_trial_dur_mode" class="field_select" size="1" style="width:100px">' . "\n";

		$duration_mode = array( 'D' => 'Day(s)', 'W' => 'Week(s)', 'M' => 'Month(s)', 'Y' => 'Year(s)' );
		foreach ( $duration_mode as $value => $opt ) {

			$selected = ( $pypl_trial_dur_mode == $value ) ? ' selected="selected"' : ''; 

			$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Enter the trial period for this product/Funnel. <br /><strong>Day(s)</strong> - Allowable range is 1 to 90<br /><strong>Week(s)</strong> - Allowable range is 1 to 52<br /><strong>Month(s)</strong> - Allowable range is 1 to 24<br /><strong>Year(s)</strong> - Allowable range is 1 to 5</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_return-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_return">Return Page</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pypl_return" id="' . $args['id'] . '_pypl_return" class="field_select" size="1">' . "\n";
		
		foreach ( $args['options']['item_pages'] as $value => $opt ) {

			$selected = ( $pypl_return_page == $value ) ? ' selected="selected"' : '';

			$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">A page to which the payer\'s browser is redirected if payment is success.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_pypl_cancel-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_pypl_cancel">Cancel Page</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pypl_cancel" id="' . $args['id'] . '_pypl_cancel" class="field_select" size="1">' . "\n";
		
		foreach ( $args['options']['item_pages'] as $value => $opt ) {

			$selected = ( $pypl_cancel_page == $value ) ? ' selected="selected"' : '';

			$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">A page to which the payer\'s browser is redirected if payment is cancelled.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		// Autoresponder Fields Start

		$checked = ( $ar_enable == 'yes' ) ? ' checked="checked"' : '';

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_ar_chkbox-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left chkbox">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="checkbox" name="' . $args['id'] . '_ar_enable" id="' . $args['id'] . '_ar_enable" value="true"' . $checked . ' />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right chkboxname"><label for="' . $args['id'] . '_ar_enable"><span >Enable Autoresponder Integration</span></label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div id="autoresponders_all">' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<p><strong>Note:</strong> If you enable this option means each time you have a new member, then he/she will also be added to your autoresponder list automatically.</p>' . "\n";
		
		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_ar_lists-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_ar_lists">Select Autoresponder</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_ar_lists" id="' . $args['id'] . '_ar_lists" class="field_select" size="1">' . "\n";
		
		foreach ( $args['options']['ar_lists'] as $value => $opt ) {

			$selected = ( $ar_account == $value ) ? ' selected="selected"' : '';

			$this->_productFormField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_productFormField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">Choose your autoresponder account that you want to integrate.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_list_name-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_list_name"><span id="mailist">Campaign Name</span></label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_list_name" id="' . $args['id'] . '_list_name" class="field_txt" value="' . $ar_list_name . '" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right"><span id="mailist_desc">Enter the list email address that you want to integrate with Profits Theme ( e.g. <em>listname@aweber.com</em> ).</span></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";
		
		$this->_productFormField .= "\t\t\t" . '<div id="autoresponders_aw">' . "\n\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";
		
		$this->_productFormField .= "\t\t\t" . '<div id="autoresponders_gr">' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_gr_api_key-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_gr_api_key">Get Response API Key</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_gr_api_key" id="' . $args['id'] . '_gr_api_key" class="field_txt" value="' . $ar_gr_api_key . '" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">To be able to integrate PT and GetResponse, you need to enable the API Key to "ON" and paste the API Key here. You can obtain it <a href="http://www.getresponse.com/my_api_key.html" target="_blank">here</a>.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";
		$this->_productFormField .= "\t\t\t" . '<div id="autoresponders_mc">' . "\n\n";
		$this->_productFormField .= "\t\t\t" . '<div class="updated fade" style="margin:8px 0;"><p><strong>To find out your list id, you need to:</strong></p><ol><li>Login to your mail chimp account and navigate to <strong><em>Lists</em></strong></li><li>Click one of your lists that you want to integrate, and click "settings" from the top left menu</li><li>Scroll down to see your list id.</li></ol></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_mc_api_key-field">' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_mc_api_key">Mail Chimp API Key</label></div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_productFormField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '_mc_api_key" id="' . $args['id'] . '_mc_api_key" class="field_txt" value="' . $ar_mc_api_key . '" />' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="field-right">To be able to integrate PT and Mail Chimp, you need to enter your API Key here. You can obtain it from <a href="http://admin.mailchimp.com/account/api" target="_blank">your API dashboard</a>.</div>' . "\n";
		$this->_productFormField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_productFormField .= "\t\t\t" . '</div>' . "\n\n";

		// Autoresponder Fields End

		$this->_productFormField .= "\t\t" . '</div>' . "\n";
		$this->_productFormField .= "\t\t" . '</div>' . "\n";

		$this->_productFormField .= "\t\t\t" . '<input type="hidden" name="' . $args['id'] . '_number" value="' . $p_number . '" />' . "\n\n";

		if ( isset($product) ) {
			$this->_productFormField .= "\t\t\t" . '<input type="hidden" name="' . $args['id'] . '_product_id" value="' . $_GET['product_id'] . '" />' . "\n\n";
		}

		$this->_productFormField .= "
		<script type=\"text/javascript\">
			jQuery(document).ready(function(){
				
				jQuery('body').delegate('#pt_aweber_get_list', 'click', function(){
					var button = jQuery(this);
					button.val('Loading...');
					button.attr('disabled', true);
					
					if (jQuery('#wpsem_box_aweber').length > 0){
						jQuery('#wpsem_box_aweber').fadeIn('fast');
						button.attr('disabled', false);
						button.val('Get List');
					}else{
						var data = {
							action: 'pt_autoresponder_get_list',
						};
						jQuery.post(ajaxurl, data, function(response) {
							//process response here
							jQuery('#autoresponders_aw').append(response);
							button.attr('disabled', false);
							button.val('Get List');
						});
					}
				});
				
				jQuery('body').delegate('.pt-select-list', 'click', function(e){
					e.preventDefault();
					var list = jQuery(this).attr('id');
					jQuery('#pt_add_product_list_name').val(list);
				});

				if ( !jQuery('#" . $args['id'] . "_ar_enable').is(\":checked\") ) {
					jQuery('#autoresponders_all').hide();
				}

				jQuery('#" . $args['id'] . "_ar_enable').click(function(){
					if ( this.checked == true ) {
						jQuery('#autoresponders_all').show();
					} else {
						jQuery('#autoresponders_all').hide();
					}				
				});

				var ar = jQuery('#" . $args['id'] . "_ar_lists').val();

				if ( ar == 'gr' ) {
					jQuery('#mailist_desc').html('Enter the campaign / list name that you want to integrate with Profits Theme. <p>Ex: <span style=\"background:#E5E5E5\"><em>&nbsp;mylistcampaign&nbsp;</em></span></p>');
					jQuery('#mailist').html('Campaign Name');
					jQuery('#autoresponders_aw').hide();
					jQuery('#autoresponders_gr').show();
					jQuery('#autoresponders_mc').hide();
				} else if ( ar == 'mc' ) {
					jQuery('#mailist_desc').html('Enter the list id that you want to integrate with Profits Theme. <p>Ex: <span style=\"background:#E5E5E5\"><em>&nbsp;ab123cd456&nbsp;</em></span></p>');
					jQuery('#mailist').html('List ID');
					jQuery('#autoresponders_aw').hide();
					jQuery('#autoresponders_gr').hide();
					jQuery('#autoresponders_mc').show();
				} else {
					jQuery('#mailist_desc').html('<input type=\"button\" id=\"pt_aweber_get_list\" class=\"button secondary\" value=\"Get List\">');
					jQuery('#mailist').html('Aweber List ID');
					jQuery('#pt_add_product_list_name').attr('readonly', 'readonly');
					jQuery('#autoresponders_aw').show();
					jQuery('#autoresponders_gr').hide();
					jQuery('#autoresponders_mc').hide();
				}

				jQuery('#" . $args['id'] . "_ar_lists').change(function(){
					var ar = jQuery('option:selected', this).val();
					jQuery('#pt_add_product_list_name').attr('readonly', false);
					if ( ar == 'gr' ) {
						jQuery('#mailist_desc').html('Enter the campaign / list name that you want to integrate with Profits Theme. <p>Ex: <span style=\"background:#E5E5E5\"><em>&nbsp;mylistcampaign&nbsp;</em></span></p>');
						jQuery('#mailist').html('Campaign Name');
						jQuery('#autoresponders_aw').hide();
						jQuery('#autoresponders_gr').show();
						jQuery('#autoresponders_mc').hide();
					} else if ( ar == 'mc' ) {
						jQuery('#mailist_desc').html('Enter the list id that you want to integrate with Profits Theme. <p>Ex: <span style=\"background:#E5E5E5\"><em>&nbsp;ab123cd456&nbsp;</em></span></p>');
						jQuery('#mailist').html('List ID');
						jQuery('#autoresponders_aw').hide();
						jQuery('#autoresponders_gr').hide();
						jQuery('#autoresponders_mc').show();
					} else {
						jQuery('#mailist_desc').html('<input type=\"button\" id=\"pt_aweber_get_list\" class=\"button secondary\" value=\"Get List\">');
						jQuery('#mailist').html('Aweber List ID');
						jQuery('#autoresponders_aw').show();
						jQuery('#autoresponders_gr').hide();
						jQuery('#autoresponders_mc').hide();
						jQuery('#pt_add_product_list_name').attr('readonly', 'readonly');
					}
					
					jQuery('#pt_add_product_list_name').val('');
				});

				var processor = jQuery('#" . $args['id'] . "_payment_processor').val();

				if ( processor == 'pypl' ) {
					jQuery('#" . $args['id'] . "_price-field').show();
					jQuery('#pypl_fields').show();
					jQuery('#cb_fields').hide();
					jQuery('#jvz_fields').hide();
					jQuery('#zx_fields').hide();
				} else if ( processor == 'cb' ) {
					jQuery('#" . $args['id'] . "_price-field').show();
					jQuery('#pypl_fields').hide();
					jQuery('#cb_fields').show();
					jQuery('#jvz_fields').hide();
					jQuery('#zx_fields').hide();
				} else if ( processor == 'jvzoo' ) {
					jQuery('#" . $args['id'] . "_price-field').show();
					jQuery('#jvz_fields').show();
					jQuery('#zx_fields').hide();
					jQuery('#pypl_fields').hide();
					jQuery('#cb_fields').hide();
				} else if ( processor == 'zaxaa' ) {
					jQuery('#" . $args['id'] . "_price-field').show();
					jQuery('#jvz_fields').hide();
					jQuery('#zx_fields').show();
					jQuery('#pypl_fields').hide();
					jQuery('#cb_fields').hide();
				} else {
					jQuery('#" . $args['id'] . "_price-field').hide();
					jQuery('#pypl_fields').hide();
					jQuery('#cb_fields').hide();
					jQuery('#jvz_fields').hide();
					jQuery('#zx_fields').hide();
				}

				jQuery('#" . $args['id'] . "_payment_processor').change(function(){
					var processor = jQuery('option:selected', this).val();
					if ( processor == 'pypl' ) {
						jQuery('#" . $args['id'] . "_price-field').show();
						jQuery('#pypl_fields').show();
						jQuery('#cb_fields').hide();
						jQuery('#jvz_fields').hide();
						jQuery('#zx_fields').hide();
					} else if ( processor == 'cb' ) {
						jQuery('#" . $args['id'] . "_price-field').show();
						jQuery('#pypl_fields').hide();
						jQuery('#cb_fields').show();
						jQuery('#jvz_fields').hide();
						jQuery('#zx_fields').hide();
					} else if ( processor == 'jvzoo' ) {
						jQuery('#" . $args['id'] . "_price-field').show();
						jQuery('#jvz_fields').show();
						jQuery('#zx_fields').hide();
						jQuery('#pypl_fields').hide();
						jQuery('#cb_fields').hide();
					} else if ( processor == 'zaxaa' ) {
						jQuery('#" . $args['id'] . "_price-field').show();
						jQuery('#jvz_fields').hide();
						jQuery('#zx_fields').show();
						jQuery('#pypl_fields').hide();
						jQuery('#cb_fields').hide();
					} else {
						jQuery('#" . $args['id'] . "_price-field').hide();
						jQuery('#pypl_fields').hide();
						jQuery('#cb_fields').hide();
						jQuery('#jvz_fields').hide();
						jQuery('#zx_fields').hide();
					}
				});

				var pptype = jQuery('#" . $args['id'] . "_pypl_payment').val();

				if ( pptype == 'subscription' ) {
					jQuery('#pypl_subs_fields').show();
				} else {
					jQuery('#pypl_subs_fields').hide();
				}

				jQuery('#" . $args['id'] . "_pypl_payment').change(function(){
					var pptype = jQuery('option:selected', this).val();
					if ( pptype == 'subscription' ) {
						jQuery('#pypl_subs_fields').show();
					} else {
						jQuery('#pypl_subs_fields').hide();
					}
				});
			});
		</script> 
		";

	}

	function getProductFormField()
	{
		return $this->_productFormField;
	}

	function setProductTableField( $args )
	{
		global $wpdb;

		$product_table = $wpdb->prefix . 'ptmembership_products';
		$products = $wpdb->get_results( "SELECT * FROM `$product_table` ORDER BY product_id DESC" );

		$this->_productTableField  = "\t\t\t" . '<table class="widefat" id="pt_products_table">' . "\n\n";
		$this->_productTableField .= '
			<thead>
				<tr>
					<th scope="col" class="manage-column column-title">Product / Level Name</th>
					<th scope="col">Payment</th>
					<th scope="col">Order URL</th>
					<th scope="col">Action</th>
				</tr>
			</thead>

			<tfoot>
				<tr>
					<th scope="col" class="manage-column column-title">Product / Level Name</th>
					<th scope="col">Payment</th>
					<th scope="col">Order URL</th>
					<th scope="col">Action</th>
				</tr>
			</tfoot>
		';

		$this->_productTableField .= "\t\t\t" . '<tbody>' . "\n\n";

		if ( count($products) > 0 ) {
			$i = 0;
			foreach ( $products as $product ) {
				$tr_class = ( $i%2 ) ? '' : 'alternate ';
				$i++;

				if ( $product->payment_proccessor == 'cb' ) {
					$payment_processor = 'Clickbank';
					$payment_link = '<input type="text" class="widefat" value="http://' . $product->cb_item_number . '.' . $product->cb_vendor_name . '.pay.clickbank.net/" onfocus="this.select()" />';
				} else if ( $product->payment_proccessor == 'pypl' ) {
					$payment_processor = 'Paypal';
					$payment_link = '<input type="text" class="widefat" value="' . trailingslashit(get_bloginfo('wpurl')) . '?mode=paypal&itemID=' . $product->product_id . '"  onfocus="this.select()" />';
					
				} else if ( $product->payment_proccessor == 'zaxaa' ) {
					$payment_processor = 'Zaxaa';
					$payment_link = 'Payment/Order URL can be obtained from <a href="https://www.zaxaa.com" target="_blank">Zaxaa</a>';
					
				} else if ( $product->payment_proccessor == 'jvzoo' ) {
					$payment_processor = 'JVZoo';
					$payment_link = 'Payment/Order URL can be obtained from <a href="https://www.jvzoo.com" target="_blank">JVZoo</a>';
					
				} else {
					$payment_processor = 'Free';
					$payment_link = '<a href="http://www.getprofitsfast.com/member/profits-theme/?page_id=747" target="_blank">Click here to learn how to create a free sign up page.</a>';
				}

				$this->_productTableField .= "\t\t\t\t" . '<tr id="product-' . $product->product_id . '" class="' . $tr_class . 'iedit">' . "\n";
				$this->_productTableField .= "\t\t\t\t\t" . '<td class="post-title page-title column-title"><strong><a href="' . admin_url('admin.php?page=pt_integrate_options') . '&action=edit&product_id=' . $product->product_id . '#edit_product">' . $product->product_title . '</a></strong></td>' . "\n";
				$this->_productTableField .= "\t\t\t\t\t" . '<td>' . $payment_processor . '</td>' . "\n";
				$this->_productTableField .= "\t\t\t\t\t" . '<td>' . $payment_link . '</td>' . "\n";
				$this->_productTableField .= "\t\t\t\t\t" . '<td><a href="' . admin_url('admin.php?page=pt_integrate_options') . '&action=edit&product_id=' . $product->product_id . '#edit_product">Edit</a> | <a href="' . admin_url('admin.php?page=pt_integrate_options') . '&action=delete&product_id=' . $product->product_id . '">Delete</a></td>' . "\n";
				$this->_productTableField .= "\t\t\t\t" . '</tr>' . "\n";

				unset($product);
			}
		} else {

			$this->_productTableField .= "\t\t\t\t" . '<tr id="product-' . pt_isset($product->product_id) . '" class="' . pt_isset($tr_class) . 'iedit">' . "\n";
			$this->_productTableField .= "\t\t\t\t\t" . '<td class="post-title page-title column-title" colspan="4">No Product Found. You can add a new product in the form below.</td>' . "\n";
			$this->_productTableField .= "\t\t\t\t" . '</tr>' . "\n";
		}

		$this->_productTableField .= "\t\t\t" . '</tbody>' . "\n\n";

		$this->_productTableField .= "\t\t\t" . '</table>' . "\n\n";

	}

	function getProductTableField()
	{
		return $this->_productTableField;
	}

	function setProtectLevelField( $args, $stored )
	{
		$this->_protectField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_protect-level-field">' . "\n";
		$this->_protectField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_protectField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_protectField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '" id="' . $args['id'] . '" class="field_select" size="1">' . "\n";
		$this->_protectField .= "\t\t\t\t\t\t" . '<option value="">-- Select Product / Level --</option>'."\n";
		
		if ( is_array($args['options']) && count( $args['options'] ) > 0 ) {
			foreach ( $args['options'] as $pid => $pname ) {
				$selected = ( isset($_GET['level']) && $_GET['level'] == $pid ) ? ' selected="selected"' : '';
				$this->_protectField .= "\t\t\t\t\t\t" . '<option value="' . $pid . '"' . $selected . '>' . $pname . '</option>'."\n";

				unset($pid, $pname);
			}
		}

		$this->_protectField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_protectField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_protectField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_protectField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_protectField .= "\t\t\t" . '</div>' . "\n\n";

		$this->_protectField .= "
			<script type=\"text/javascript\">
			jQuery(document).ready(function(){
				jQuery('#" . $args['id'] . "').change(function(){
					var level = jQuery(\"option:selected\", this).val();
					if ( level != '' ) {
						window.location.href = '" . admin_url('admin.php?page=pt_integrate_options') . "&type=posts&level=' + level;
					}
				});
			});
			</script>
		";
	}

	function getProtectLevelField()
	{
		return $this->_protectField;
	}

	function setProtectPagesField( $args, $stored )
	{

		$this->_protectPagesField = '';

		if ( isset($_GET['level']) ) {
			$postlink = ( isset( $_GET['type'] ) && $_GET['type'] == 'posts' ) ? 'Posts' : '<a href="' . admin_url('admin.php?page=pt_integrate_options&type=posts&level=' . $_GET['level'] ) . '">Posts</a>';
			$pagelink = ( isset( $_GET['type'] ) && $_GET['type'] == 'pages' ) ? 'Pages' : '<a href="' . admin_url('admin.php?page=pt_integrate_options&type=pages&level=' . $_GET['level'] ) . '">Pages</a>';

			$this->_protectPagesField .= "\t\t\t" . '<p style="text-align:left">' . $postlink . ' | ' . $pagelink . '</p>' . "\n\n";
			$this->_protectPagesField .= "\t\t\t" . '<table class="widefat" id="pt_pages_table">' . "\n\n";
			$this->_protectPagesField .= '
				<thead>
					<tr>
						<th scope="col" class="manage-column column-cb check-column"><input type="checkbox" /></th>
						<th scope="col" class="manage-column column-title">Title</th>
						<th scope="col" class="manage-column column-author sortable desc">Drip Start (in # of days)</th>
						<th scope="col" class="manage-column column-author sortable desc">Drip End (in # of days)</th>
					</tr>
				</thead>

				<tfoot>
					<tr>
						<th scope="col" class="manage-column column-cb check-column"><input type="checkbox" /></th>
						<th scope="col" class="manage-column column-title">Title</th>
						<th scope="col" class="manage-column column-author sortable desc">Drip Start (in # of days)</th>
						<th scope="col" class="manage-column column-author sortable desc">Drip End (in # of days)</th>
					</tr>
				</tfoot>
			';

			$this->_protectPagesField .= "\t\t\t" . '<tbody>' . "\n\n";
			
			$i = 0;
			foreach ( $args['options']['pages'] as $page ) {
				$tr_class = ( $i%2 ) ? '' : 'alternate ';
				$i++;

				$meta = get_post_meta($page->ID, 'pt_protect_content', true);
				$drip = get_post_meta($page->ID, 'pt_drip_data', true);

				$start_day = ( $drip ) ? $drip['drip_start'] : 1;
				$end_day = ( $drip ) ? $drip['drip_end'] : 9999;
				
				
				if ( $meta ) {
					$checked = ( in_array( $_GET['level'], $meta ) ) ? ' checked="checked"' : '';
				} else {
					$checked = '';
				}	

				$this->_protectPagesField .= '
				<tr class="' . $tr_class . '">
					<th scope="row" class="check-column"><input type="checkbox" name="' . $args['id'] . '_page_id[]" value="' . $page->ID . '"' . $checked . '/><input type="hidden" name="' . $args['id'] . '_page_id_info[]" value="' . $page->ID . '" /></th>
					<td class="post-title page-title column-title"><strong><a href="' . admin_url('post.php?post=' . $page->ID . '&action=edit') . '" target="_blank">' . get_the_title($page->ID) . '</a></strong></td>
					<td><input type="text" name="' . $args['id'] . '_drip_start[]" id="' . $args['id'] . '_drip_start" class="field_txt" value="' . $start_day . '" style="width:60px" /></td>
					<td><input type="text" name="' . $args['id'] . '_drip_end[]" id="' . $args['id'] . '_drip_end" class="field_txt" value="' . $end_day . '" style="width:60px" /></td>
				</tr>
				';

				unset($page, $meta, $drip);
			}

			$this->_protectPagesField .= "\t\t\t" . '</tbody>' . "\n";
			$this->_protectPagesField .= "\t\t\t" . '</table>' . "\n\n";

			

			$totalpages  = ceil( $args['options']['total'] / $args['options']['perpage'] );
			$currentpage = ( $args['options']['offset'] / $args['options']['perpage'] ) + 1;
			
			$page_args = array(
						'base' => add_query_arg('paged','%#%'),
						'format' => '',
						'total' => $totalpages,
						'current' => $currentpage,
						'show_all' => false,
						'prev_next' => true,
						'prev_text' => __('&laquo; Previous'),
						'next_text' => __('Next &raquo;'),
						'end_size' => 1,
						'mid_size' => 2,
						'type' => 'plain',
						'add_args' => false, // array of query args to add
						'add_fragment' => ''
					);
			
			$this->setPaginationlinks( $page_args );
			$page_links  = $this->getPaginationLinks();
			
			if ( $page_links ) {
				$this->_protectPagesField .= '<div style="text-align:right"><span style="color:#808080">' . $args['options']['total'] . ' items </span>' . $page_links . '</div>';
			}

			$this->_protectPagesField .= "\t\t\t" . '<input type="hidden" name="' . $args['id'] . '_product_id" value="' . $_GET['level'] . '" />' . "\n\n";
			$this->_protectPagesField .= "\t\t\t" . '<p><strong>Note:</strong> In the "Drip Start" field, \'1\' means immediately available.</p>' . "\n\n";
		}
	}

	function getProtectPagesField()
	{
		return $this->_protectPagesField;
	}

	function setPaginationLinks( $args )
	{
		// Who knows what else people pass in $args
		$total = (int) $args['total'];
		if ( $total < 2 )
			return;
		$current  = (int) $args['current'];
		$end_size = ( 0 < (int) $args['end_size'] ) ? (int) $args['end_size'] : 1; // Out of bounds?  Make it the default.
		$mid_size = ( 0 <= (int) $args['mid_size'] ) ? (int) $args['mid_size'] : 2;
		$add_args = is_array( $args['add_args'] ) ? $args['add_args'] : false;

		$this->r = '';

		$page_links = array();
		$n = 0;
		$dots = false;

		if ( $args['prev_next'] && $current && 1 < $current ) {
			$link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base'] );
			$link = str_replace('%#%', $current - 1, $link);
			if ( $add_args )
				$link = add_query_arg( $add_args, $link );
			$link .= $args['add_fragment'];
			$page_links[] = "<a class='prev page-numbers' href='" . $link . "'>$prev_text</a>";
		}

		for ( $n = 1; $n <= $args['total']; $n++ ) {
			$n_display = $n;

			if ( $n == $args['current'] ) {
				$page_links[] = "<span class='page-numbers current'>$n_display</span>";
				$dots = true;
			} else {
				if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) {
					$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
					$link = str_replace( '%#%', $n, $link );
					if ( $add_args )
						$link = add_query_arg( $add_args, $link );
					$link .= $args['add_fragment'];
					$page_links[] = "<a class='page-numbers' href='" . $link . "'>$n_display</a>";
					$dots = true;
				} else if ( $dots && !$args['show_all'] ) {
					$page_links[] = "<span class='page-numbers dots'>...</span>";
					$dots = false;
				}
			}
		}

		if ( $prev_next && $current && ( $current < $total || -1 == $total ) ) {
			$link = str_replace('%_%', $args['format'], $args['base'] );
			$link = str_replace('%#%', $current + 1, $link);
			if ( $add_args )
				$link = add_query_arg( $add_args, $link );
			$link .= $args['add_fragment'];
			$page_links[] = "<a class='next page-numbers' href='" . $link . "'>$next_text</a>";
		}

		switch ( $argst['type'] ) {	
			case 'array' :
				$this->r = $page_links;
				break;
			case 'list' :
				$this->r .= "<ul class='page-numbers'>\n\t<li>";
				$this->r .= join("</li>\n\t<li>", $page_links);
				$this->r .= "</li>\n</ul>\n";
				break;
			default :
				$this->r = join("\n", $page_links);
				break;
		}
	}

	function getPaginationLinks()
	{
		return pt_isset($this->r);
	}

	function setNoteField( $name, $desc )
	{
		$this->_noteField  = "\t\t\t" . '<div class="fieldsection">' . "\n";
		$this->_noteField .= "\t\t\t\t" . '<div class="field-full">' . $desc . '</div>' . "\n";
		$this->_noteField .= "\t\t\t" . '</div>' . "\n\n";

	}

	function getNoteField()
	{
		return $this->_noteField;
	}

	function setDoubleTextField( $args, $stored )
	{
		
		$this->_doubleTextField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_dtext-field">' . "\n";
		$this->_doubleTextField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '_' . strtolower( pt_isset($args['meta'][0]) ) . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_doubleTextField .= "\t\t\t\t" . '<div class="field-left">' . "\n";

		for ($i = 1; $i < 3 ; $i++) {
			$value = $stored['val' . $i] != '' ? $stored['val' . $i] : $args['std']['val' . $i];
			$value = stripslashes( $value );

			$this->_doubleTextField .= "\t\t\t\t\t" . $args['meta']['meta' . $i] . ' <input type="text" name="' . $args['id'] . '_' . 'val' . $i . '" id="' . $args['id'] . '_' . 'val' . $i . '" ';
			$this->_doubleTextField .= 'class="field_txt" style="width:60px" value="' . $value . '" />&nbsp;' . "\n"; 
		}

		$this->_doubleTextField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_doubleTextField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_doubleTextField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_doubleTextField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getDoubleTextField()
	{
		return $this->_doubleTextField;
	}
	
	function setTextareaField( $args, $stored )
	{
		global $pt_layouts;

		if ( pt_isset($args['width']) != '' && pt_isset($args['height']) != '' ) {
			$areasize = ' style="width:' . pt_isset($args['width']) . 'px;height:' . pt_isset($args['height']) . 'px;"';
		} else {
			$areasize = '';
		}

		$mode = (isset($args['mode'])) ? $args['mode'] : '';
		$stored = ( isset($args['mode']) && $args['mode'] == 'readonly' ) ? $args['std'] : $stored;

		$desc = str_replace('%VIDEOWIDTH%', $pt_layouts['content'], pt_isset($args['desc']));

		$this->_textareaField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_textarea-field">' . "\n";
		$this->_textareaField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_textareaField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_textareaField .= "\t\t\t\t\t" . '<textarea name="' . $args['id'] . '" id="' . $args['id'] . '" class="field_txtarea"' . $areasize . $mode . '>' . trim(stripslashes(addslashes($stored))) . '</textarea>' . "\n";
		$this->_textareaField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_textareaField .= "\t\t\t\t" . '<div class="field-right">' . $desc . '</div>' . "\n";
		$this->_textareaField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_textareaField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getTextareaField()
	{
		return $this->_textareaField;
	}

	function setCheckboxField( $args, $stored )
	{
		$value   = (!empty($stored)) ? $stored : $args['std'];
		$checked = ($value == 'true') ? ' checked="checked"' : '';
		$style   = (pt_isset($args['desc']) == '') ? ' style="width:700px"' : '';

		$this->_checkboxField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_chkbox-field">' . "\n";
		$this->_checkboxField .= "\t\t\t\t" . '<div class="field-left chkbox">' . "\n";
		$this->_checkboxField .= "\t\t\t\t\t" . '<input type="checkbox" name="' . $args['id'] . '" id="' . $args['id'] . '" value="true"' . $checked . ' />' . "\n";
		$this->_checkboxField .= "\t\t\t\t" . '</div>' . "\n";

		$this->_checkboxField .= "\t\t\t\t" . '<div class="field-right chkboxname"' . $style . '><label for="' . $args['id'] . '"><span >' . $args['name'] . '</span></label></div>' . "\n";
		if ( pt_isset($args['desc']) != '' ) {
			$this->_checkboxField .= "\t\t\t\t" . '<div class="field-right chkboxdesc">' . pt_isset($args['desc']) . '</div>' . "\n";
		}
		$this->_checkboxField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_checkboxField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getCheckboxField()
	{
		return $this->_checkboxField;
	}

	function setUploadField( $args, $stored )
	{

		$this->_uploadField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_upload-field">' . "\n";
		$this->_uploadField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_uploadField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_uploadField .= "\t\t\t\t\t" . '<input type="text" name="' . $args['id'] . '" id="' . $args['id'] . '" class="field_txt uploaded_url" value="' . $stored . '" /><br /><br /><span id="' . $args['id'] . '_upload-btn" class="image_upload_button button">Upload Image</span>' . "\n";	
		$this->_uploadField .= "\t\t\t\t" . '<input type="hidden" name="' . $args['id'] . '_action" value="' . admin_url("admin-ajax.php") . '" class="ajax_action_url" /></div>' . "\n";
		$this->_uploadField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_uploadField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_uploadField .= "\n\n\t\t\t" . '</div>' . "\n\n";

	}

	function getUploadField()
	{
		return $this->_uploadField;
	}

	function setSelectField( $args, $stored )
	{
		$change = (pt_isset($args['onchange']) != '') ? pt_isset($args['onchange']) : '';

		$this->_selectField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_select-field">' . "\n";
		$this->_selectField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_selectField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_selectField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '" id="' . $args['id'] . '" class="field_select" size="1"' . pt_isset($change) . '>' . "\n";
		
		foreach ( $args['options'] as $value => $opt ) {

			$selected = '';
				
			if ( $stored != '' ) {
				if ( $stored == $value ) { 
					$selected = ' selected="selected"';
				}
			} else {
				if ( $args['std'] == $value ) {
					$selected = ' selected="selected"';
				}
			}

			$this->_selectField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
		}

		$this->_selectField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_selectField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_selectField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_selectField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_selectField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getSelectField()
	{
		return $this->_selectField;
	}

	function setMultiSelectField( $args, $stored )
	{
		$change = (pt_isset($args['onchange']) != '') ? pt_isset($args['onchange']) : '';

		$this->_multiSelectField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_select-field">' . "\n";
		$this->_multiSelectField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_multiSelectField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		
		$this->_multiSelectField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '[]" id="' . $args['id'] . '" class="field_select" size="1"' . pt_isset($change) . ' multiple style="height:150px">' . "\n";
		
		$values = ( $stored != '' ) ? $stored : $args['std'];

		if ( is_array ( $args['options'] ) && count( $args['options'] ) > 0 ) {
			foreach ( $args['options'] as $value => $opt ) {
				
				if ( is_array( $values ) ) {
					$selected = ( in_array($value, $values) ) ? ' selected="selected"' : '';
				} else {
					$selected = ( $values == $value) ? ' selected="selected"' : '';
				}

				$this->_multiSelectField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
			}
		}

		$this->_multiSelectField .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_multiSelectField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_multiSelectField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_multiSelectField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_multiSelectField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getMultiSelectField()
	{
		return $this->_multiSelectField;
	}

	function setLaunchPagesField( $args, $stored )
	{
		$values = ( $stored['pages'] != '' ) ? $stored['pages'] : $args['std']['pages'];
		$order_x = '';
 
		if ( $values != '' ) {
			$order  = ( $stored['order'] != '' ) ? $stored['order'] : $args['std']['order'];
		} else {
			$order = '';
		}

		$this->_launchPagesField = '';

		if ( $order != '' ) {
			$order_x = explode("|", $order);
			if ( count($order_x) == count($values) ) {
				if ( $values != '' ) {
					$n = 0;
					for ( $l = 0; $l < count($values) ; $l++ ) {
						if ( in_array( $values[$l], $order_x ) ) {					
							$n += 1;
						} else {
							$n -= 1;
						} 
					}

					if ( count($values) == $n ) {
						$sortable = $order_x;
					} else {
						$sortable = $values;
					}
				}
			} else {
				$sortable = $values;
			}
		} else {
			$sortable = $values;
		}

		if ( is_array( $sortable ) && count( $sortable ) > 0 && $values != '' ) {
			$this->_launchPagesField .= '<div class="updated fade" id="launch_note"><p><strong>Current Server Date and Time:</strong> ' . date("F d, Y @ H:i") . '. The time are in 24 hours format so please make sure you set the \'Release Date\' correctly.</p></div>';
			$this->_launchPagesField .= '
				<div id="' . $args['id'] . '_list">
					<div class="fieldtitle">Launch Sequence</div>';
			$this->_launchPagesField .= '<div class="updated fade" id="launch_note"><p><strong>IMPORTANT:</strong> You <strong>CAN\'T</strong> include the Launch Gateway Squeeze Page (that you specified above) inside your Launch Sequence below.</p></div><br>';
			$this->_launchPagesField .= '<ul class="sortable-list">';
			$i = 0;
			foreach ( $sortable as $value ) {

				$lmeta = get_post_meta( $value, 'pt_launch_data', true );

				$l_title = ( pt_isset($lmeta['title']) != '' ) ? $lmeta['title'] : get_the_title($value);
				$video_thumb = ( pt_isset($lmeta['thumb']) != '' ) ? $lmeta['thumb'] : '';
				$l_month = ( pt_isset($lmeta['month']) != '' ) ? $lmeta['month'] : date("m");
				$l_day   = ( pt_isset($lmeta['day']) != '' ) ? $lmeta['day'] : date("d");
				$l_year  = ( pt_isset($lmeta['year']) != '' ) ? $lmeta['year'] : date("Y");
				$l_hour  = ( pt_isset($lmeta['hour']) != '' ) ? $lmeta['hour'] : date("H");
				$l_min   = ( pt_isset($lmeta['minute']) != '' ) ? $lmeta['minute'] : date("i");
		
				$this->_launchPagesField .= "\t\t\t" . '<li id="' . $value . '" class="sortable-item"><strong>' . get_the_title( $value ) . '</strong> ( <a href="#" class="edit_rating" onClick="jQuery(\'#launch_settings_' . $i . '\').toggle();return false;">Settings</a> )' . "\n\n";
				$this->_launchPagesField .= "\t\t\t\t" . '<div style="padding:5px 20px;text-align:left;display:none;margin:0 auto;width:580px;" id="launch_settings_' . $i . '">' . "\n\n";
			
				$this->_launchPagesField .= "\t\t\t\t" . '<table border="0">';

				$this->_launchPagesField .= "\t\t\t\t\t" . '<tr>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td><strong>Page</strong> </td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td><a href="' . get_permalink($value) . '" target="_blank">view page</a> | <a href="' . admin_url('post.php?post=' . $value . '&action=edit') . '" target="_blank">edit page</a></td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</tr>' . "\n";

				$this->_launchPagesField .= "\t\t\t\t\t" . '<tr>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td><strong>Title</strong> </td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td><input type="text" name="launch_title_' . $i . '" id="launch_title_' . $i . '" class="field_txt" value="' . $l_title . '"/></td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</tr>' . "\n";

				$this->_launchPagesField .= "\t\t\t\t\t" . '<tr>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td><strong>Video Image</strong> </td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<div id="launch_thumb_upload_' . $i . '">' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<input type="text" name="launch_thumb_' . $i . '" id="launch_thumb_' . $i . '" class="field_txt uploaded_url" value="' . $video_thumb . '"/> <span id="launch_thumb_upload_btn_' . $i . '" class="image_upload_button button">Upload Image</span>' . "\n";	
				$this->_launchPagesField .= "\t\t\t\t\t" . '<input type="hidden" name="launch_thumb_action" value="' . admin_url("admin-ajax.php") . '" class="ajax_action_url" />' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</div>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</tr>' . "\n";

				$this->_launchPagesField .= "\t\t\t\t\t" . '<tr id="launch_date_' . $i . '">' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '<td><strong>Release Date</strong> </td>' . "\n";

				$this->_launchPagesField .= "\t\t\t\t\t" . '<td>' . "\n";
		
				$months = array( 1 => 'january', 2 => 'february', 3 => 'march', 4 => 'april', 5 => 'may', 6 => 'june', 7 => 'july', 8 => 'august', 9 => 'september', 10 => 'october', 11 => 'november', 12 => 'desember');
				
				$this->_launchPagesField .= "\t\t\t\t\t" . '<select name="launch_time_month_' . $i . '" id="launch_time_month_' . $i . '" class="field_select" size="1" style="width:150px">' . "\n";
	
				foreach ( $months as $month => $option ) {
					$selected = ( $l_month == $month ) ? ' selected="selected"' : '';
					$this->_launchPagesField .= "\t\t\t\t\t\t" . '<option value="' . $month . '"' . $selected . '>' . ucwords($option) . '</option>'."\n";
				}

				$this->_launchPagesField .= "\t\t\t\t\t" . '</select>' . "\n";

				$this->_launchPagesField .= "\t\t\t\t" . '<input type="text" name="launch_time_day_' . $i . '" id="launch_time_day_' . $i . '" class="field_txt" value="' . $l_day . '" style="width:60px" />, <input type="text" name="launch_time_year_' . $i . '" id="launch_time_year_' . $i . '" class="field_txt" value="' . $l_year . '" style="width:80px" /> @ <input type="text" name="launch_time_hour_' . $i . '" id="launch_time_hour_' . $i . '" class="field_txt" value="' . $l_hour . '" style="width:50px" /> : <input type="text" name="launch_time_minute_' . $i . '" id="launch_time_minute_' . $i . '" class="field_txt" value="' . $l_min . '" style="width:50px" />' . "\n";
				$this->_launchPagesField .= "\t\t\t\t" . '<input type="hidden" name="launch_post_id_' . $i . '" id="launch_post_id_' . $i . '" class="field_txt" value="' . $value . '" />' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</td>' . "\n";
				$this->_launchPagesField .= "\t\t\t\t\t" . '</tr>' . "\n";

				$this->_launchPagesField .= "\t\t\t\t\t" . '<tr><td colspan="2" style="padding:10px 0;text-align:right"><img id="spin_loader_' . $i . '" style="display:none" src="' . get_bloginfo('wpurl') . '/wp-admin/images/wpspin_light.gif" border="0" /> <input type="button" name="launch_save_' . $i . '" id="launch_save_' . $i . '" value="Save Settings" class="button-primary" /></td></tr>' . "\n\n";

				$this->_launchPagesField .= "\t\t\t\t\t" . '</table>' . "\n";
				
				$this->_launchPagesField .= "\t\t\t\t" . '</div>' . "\n\n";
				$this->_launchPagesField .= "
				<script type=\"text/javascript\">
					jQuery(document).ready(function(){
						var launch_type = jQuery('#pt_launch_mode').val();
						if ( launch_type == 'evergreen' ) {
							jQuery('#launch_date_" . $i . "').hide();
						} else {
							jQuery('#launch_date_" . $i . "').show();
						}

						jQuery('#pt_launch_mode').change(function(){
							var launch_type = jQuery(\"option:selected\", this).val();
							if ( launch_type == 'evergreen' ) {
								jQuery('#launch_date_" . $i . "').hide();
							} else {
								jQuery('#launch_date_" . $i . "').show();
							}
						});

						
						jQuery('#launch_save_" . $i ."').click(function(){
							var title" . $i . " = jQuery('input#launch_title_" . $i . "').val();
							var thumb" . $i . " = jQuery('input#launch_thumb_" . $i . "').val();
							var month" . $i . " = jQuery('select#launch_time_month_" . $i . "').val();
							var day" . $i . " = jQuery('input#launch_time_day_" . $i . "').val();
							var year" . $i . " = jQuery('input#launch_time_year_" . $i . "').val();
							var hour" . $i . " = jQuery('input#launch_time_hour_" . $i . "').val();
							var minute" . $i . " = jQuery('input#launch_time_minute_" . $i . "').val();
							var postid" . $i . " = jQuery('input#launch_post_id_" . $i . "').val();

							var launchdata" . $i . " = 'title=' + title" . $i . " + '&thumb=' + thumb" . $i . " + '&month=' + month" . $i . " + '&day=' + day" . $i . " + '&year=' + year" . $i . " + '&hour=' + hour" . $i . " + '&minute=' + minute" . $i . " + '&post_id=' + postid" . $i . ";

							jQuery('#spin_loader_" . $i . "').show();

							jQuery.ajax({
								type: 'POST',
      								url: '" . get_bloginfo('template_url') . "/lib/admin/save-launch.php',
      								data: launchdata" . $i . ",
      								success: function() {
									jQuery('#spin_loader_" . $i . "').hide();
									alert('Launch Settings Saved.');
								}
							});
							
						});
					});
				</script>
				";
				
				$this->_launchPagesField .= '</li>' . "\n\n";
				
				$i++;
			}

			$this->_launchPagesField .= '
					</ul>
					<div style="text-align:center;color:#808080">(Drag n drop to arrange the order)</div>
				</div>
			';
		}
		
		$order = ( $order == '' && $values != '' ) ? implode('|', $values) : $order;

		
		$this->_launchPagesField .= "\t\t\t" . '<input name="' . $args['id'] . '_order" id="' . $args['id'] . '_order" type="hidden" value="' . $order . '" />' . "\n";

		

		$this->_launchPagesField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_launch-field">' . "\n";
		$this->_launchPagesField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_launchPagesField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		
		$this->_launchPagesField .= "\t\t\t\t\t" . '<select name="' . $args['id'] . '_pages[]" id="' . $args['id'] . '_pages" class="field_select" size="1"' . pt_isset($change) . ' multiple style="height:150px">' . "\n";
		
		if ( is_array( $args['options'] ) && count( $args['options'] ) > 0 ) {
			foreach ( $args['options'] as $value => $opt ) {
			
				if ( is_array( $values ) ) {
					$selected = ( in_array($value, $values) ) ? ' selected="selected"' : '';
				} else {
					$selected = ( $values == $value) ? ' selected="selected"' : '';
				}
			
				if ( $value != '' ) {
					$this->_launchPagesField .= "\t\t\t\t\t\t" . '<option value="' . $value . '"' . $selected . '>' . $opt . '</option>'."\n";
				}
			}
		}

		$this->_launchPagesField .= "\t\t\t\t\t" . '</select>' . "\n";
		
		$this->_launchPagesField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_launchPagesField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_launchPagesField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";

		$this->_launchPagesField .= "\t\t" . '<p class="submit">' . "\n";
		$this->_launchPagesField .= "\t\t\t" . '<input name="save" type="submit" value="Add/Remove Launch Page(s)" />' . "\n";
		$this->_launchPagesField .= "\t\t" . '</p>' . "\n\n";
		
		
		if ( $order != '' ) {
			$order_x == explode("|", $order);
			
			$this->_launchPagesField .= "\t\t\t" . '<div class="fieldsection" id="launch_thanks_text-field">' . "\n";
			$this->_launchPagesField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="launch_thank_you">Your Thank You Page URL</label></div>' . "\n";
			

			//$this->_launchPagesField .= "\t\t" . ($sortable === $order_x)?'TRUE':'FALSE' . "\n\n";
			if ( $sortable === $order_x ) { 			
				$p_struc = get_option('permalink_structure');
				
				$query_var = ( $p_struc == '' ) ? '&set=' . md5($order_x[0]) : '?set=' . md5($order_x[0]);
				$this->_launchPagesField .= "\t\t\t\t" . '<div class="field-full">Please set the URL for your launch sequence #1 to the URL below:<br /><br /><span style="color:#cc0000;background:#FFFFCC"><strong>' . get_permalink($order_x[0]) . $query_var . '</strong></span><p><strong>Important:</strong> If you change the order of your launch pages, then the Thank You Page URL will also change.</div>' . "\n";	
			} else {
				
				$this->_launchPagesField .= "\t\t\t\t" . '<div class="field-full">In order to make the launch funnel works, you need to set the Thank You Page in your autoresponder account with the RIGHT Thank You Page URL. Please arrange the order of your launch pages, and when you satisfied with the order, please click the "Save Changes" button.</p></div>' . "\n";
			}

			$this->_launchPagesField .= "\t\t\t" . '</div>' . "\n\n";
		}

		$this->_launchPagesField .= "\t\t\t" . '</div>' . "\n\n";

		

		$this->_launchPagesField .= '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".sortable-list").sortable({
						placeholder: "placeholder",
						update: function(){
							jQuery("#' . $args['id'] . '_order").attr("value", getLists("#' . $args['id'] . '_list"));
						}
					});

					jQuery("#pt_launch_mode").change(function(){
						var launch_type = jQuery("option:selected", this).val();
						if ( launch_type == "evergreen" ) {
							jQuery("#launch_note").hide();
						} else {
							jQuery("#launch_note").show();
						}
					});

					function getLists(ratingID)
					{
						var columns = [];

						jQuery(ratingID + " ul.sortable-list").each(function(){
							columns.push(jQuery(this).sortable("toArray").join("|").replace(/ /gi, "_"));				
						});
			
						return columns;
					}

				});

			</script>
		';
	}

	function getLaunchPagesField()
	{
		return $this->_launchPagesField;
	}

	function setSkinUploadField( $args )
	{
		$this->_skinUploadField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_text-field">' . "\n";
		$this->_skinUploadField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_skinUploadField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		
		if ( pt_isset($args['note']) != '' ) {
			$this->_skinUploadField .= "\t\t\t\t\t" . '<div style="text-align:left">' . pt_isset($args['note'])  . '</div>' . "\n";
		}

		$this->_skinUploadField .= "\t\t\t\t\t" . '<input type="file" name="' . $args['id'] . '" id="' . $args['id'] . '" /> ' . "\n";
		$this->_skinUploadField .= "\t\t\t\t" . ' <input name="save" type="submit" value="Install Skin" class="button" /></div>' . "\n";
		$this->_skinUploadField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_skinUploadField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_skinUploadField .= "\t\t\t" . '</div>' . "\n\n";
	}

	function getSkinUploadField()
	{
		return $this->_skinUploadField;
	}

	function setHeadersUploadField( $args )
	{
		$this->_headersUploadField  = "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_text-field">' . "\n";
		$this->_headersUploadField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_headersUploadField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		
		if ( pt_isset($args['note']) != '' ) {
			$this->_skinUploadField .= "\t\t\t\t\t" . '<div style="text-align:left">' . pt_isset($args['note'])  . '</div>' . "\n";
		}

		$this->_headersUploadField .= "\t\t\t\t\t" . '<input type="file" name="' . $args['id'] . '" id="' . $args['id'] . '" /> ' . "\n";
		$this->_headersUploadField .= "\t\t\t\t" . ' <input name="save" type="submit" value="Install Headers" class="button" /></div>' . "\n";
		$this->_headersUploadField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_headersUploadField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_headersUploadField .= "\t\t\t" . '</div>' . "\n\n";

		// echo '<pre>' . print_r(get_option('pt_headers'), true) . '</pre>';
	}

	function getHeadersUploadField()
	{
		return $this->_headersUploadField;
	}

	function setTypographyField( $args, $stored )
	{

		$picker_id = $args['id'] . '_picker';
		$color_id  = $args['id'] . '_color';
		$face_id   = $args['id'] . '_face';
		$style_id  = $args['id'] . '_style';
		$size_id   = $args['id'] . '_size';

		$color_val = $stored['color'] != '' ? $stored['color'] : $args['std']['color'];
		$face_val  = $stored['face'] != '' ? $stored['face'] : $args['std']['face'];
		$style_val = $stored['style'] != '' ? $stored['style'] : $args['std']['style'];
		$size_val  = $stored['size'] != '' ? $stored['size'] : $args['std']['size'];

		$styles = array( 'normal' => 'Normal', 'bold' => 'Bold', 'italic' => 'Italic', 'bold/italic' => 'Bold Italic' );

		$this->setFontField( $face_id, $face_val );

		$this->_typographyField  = '<div class="fieldsection" id="' . $args['id'] . '_typo-field">' . "\n";
		$this->_typographyField .= '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_typographyField .= '<div class="field-left">' . "\n";
		$this->_typographyField .= '<input type="text" name="' . $color_id . '" id="' . $color_id . '" ';
		$this->_typographyField .= 'class="field_txt color {hash:true}" style="width:90px; cursor: pointer" value="' . $color_val . '" />&nbsp;' ."\n\n";
	
		$this->_typographyField .= $this->getFontField();

		$this->_typographyField .= '<select name="' . $style_id . '" id="' . $style_id . '" class="field_select" ';
		$this->_typographyField .= 'size="1" style="width:100px">' . "\n";

		foreach ( $styles as $style => $opt ) {
			$selected = $style_val == $style ? ' selected="selected"' : '';
			$this ->_typographyField .= '<option value="' . $style . '"' . $selected . '>' . $opt . '</option>' ."\n";
		}
			
		$this->_typographyField .= '</select>&nbsp;' . "\n\n";

		$this->_typographyField .= '<select name="' . $size_id . '" id="' . $size_id . '" class="field_select" ';
		$this->_typographyField .= 'size="1" style="width:70px">' . "\n";
	
		for($i=9;$i<71;$i++){
			$selected = $size_val == $i ? ' selected="selected"' : '';
			$this->_typographyField .= '<option value="' . $i . '"' . $selected . '>'.$i.'px</option>' ."\n";
		}		
			
		$this->_typographyField .= '</select>' . "\n\n";

		$this->_typographyField .= '</div>' ."\n";
		$this->_typographyField .= '<div class="field-right">' . pt_isset($args['desc']) . '</div>' ."\n";
		$this->_typographyField .= '<div class="clr"></div>' ."\n";
		$this->_typographyField .= '</div>' ."\n\n";

	}

	function getTypographyField()
	{
		return $this->_typographyField;
	}

	function setColorField( $args, $stored )
	{
		$this->_colorField  = '<div class="fieldsection" id="' . $args['id'] . '_color-field">';
		$this->_colorField .= '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>';
		$this->_colorField .= '<div class="field-left">';
		$this->_colorField .= '<input type="text" name="' . $args['id'] . '" id="' . $args['id'] . '" class="field_txt color {hash:true}" style="cursor:pointer;width:150px"';
		$this->_colorField .= 'value="' . $stored . '" />';
		$this->_colorField .= '</div>';
		$this->_colorField .= '<div class="field-right">' . pt_isset($args['desc']) . '</div>';
		$this->_colorField .= '<div class="clr"></div>';
		$this->_colorField .= '</div>';

	}

	function getColorField(){
		return $this->_colorField;
	}
	

	function setSkinsManagerField( $args, $stored, $formId ) 
	{
		$skin_value = pt_isset($stored['skins']) ? $stored['skins'] : $args['std']['skins'];
		$color_value = pt_isset($stored['skins']) ? $stored['colors'] : $args['std']['colors'];
		$skin_path = TEMPLATEPATH . '/lib/skins';

		$skins = array();
		if ( is_dir($skin_path) ) {
			if ( $skin_dir = opendir($skin_path) ) {
				while ( ( $skin_contents = readdir($skin_dir) ) !== false ) {
            				if ( $skin_contents != "." && $skin_contents != ".." && $skin_contents != 'index.html' && $skin_contents != 'index.php' && $skin_contents != 'minisite' ) {
						$skins[] = $skin_contents;
            				}
				}
			}
		}

		$skins_num = count($skins);

		asort($skins);
		
		$skins = array_values($skins);
		$this->_skinsManagerField = '';
		for ($i = 0; $i < $skins_num ; $i++) {
			$skin_file = $skin_path . '/' . $skins[$i] . '/info.css';
			if ( file_exists ( $skin_file ) ) {
				$skin_info = array( 
					'Name' => 'Skin Name', 
					'URI' => 'Skin URI', 
					'Description' => 'Description', 
					'Author' => 'Author', 
					'AuthorURI' => 'Author URI',
					'Version' => 'Version', 
				);

				$lborder = ( $i%3 ) ? ' skin_border' : '';
				$selected = ( $skins[$i] == $skin_value ) ? ' skin_selected' : '';

				$skin_data = get_file_data($skin_file, $skin_info, 'theme' );
				$this->_skinsManagerField .= '<div class="skin_block' . $lborder . $selected . '">' . "\n";
				$this->_skinsManagerField .= '<div class="skin_shot pt-shake">';

				$skin_shot = $skin_path . '/' . $skins[$i] . '/screenshot.png';

				if ( file_exists ( $skin_shot ) ) {
					$this->_skinsManagerField .= '<img src="' . get_bloginfo('template_url') . '/thumb.php?src=' . pt_to_relative(get_bloginfo('template_url') . '/lib/skins/' . $skins[$i] . '/screenshot.png').'&w=208&h=140&zc=1" border="0" />' . "\n";
				}

				$this->_skinsManagerField .= '</div>' . "\n";
				$this->_skinsManagerField .= '<p><strong>' . $skin_data['Name'] . ' ' . $skin_data['Version'] . ' by <a href="' . $skin_data['AuthorURI'] . '" target="_blank">' . $skin_data['Author'] . '</a></strong></p>' . "\n";
				$this->_skinsManagerField .= '<p style="color:#808080"><em>' . $skin_data['Description'] . '</em></p>' . "\n";
				
				$hidebtn = ( $skins[$i] == $skin_value ) ? ' skin_btn_hide' : '';

				$this->_skinsManagerField .= '<span class="button ' . $args['id'] . '_select_skin_' . $i . $hidebtn . '">Select Skin</span>' . "\n";
				
				$color_hide = ( $skins[$i] != $skin_value ) ? ' skin_color_hide' : '';

				$this->_skinsManagerField .= '<p><select name="' . $args['id'] . '_color_' . $i . '" id="' . $args['id'] . '_color_' . $i . '" class="widefat' . $color_hide .'">';
				$this->_skinsManagerField .= '<option value="">[Please Select a Skin Color]</option>' . "\n\n";

				$schemes_path = TEMPLATEPATH . '/lib/skins/' . $skins[$i];
				$schemes = array();

				if ( is_dir( $schemes_path) ) {
    					if ( $schemes_dir = opendir( $schemes_path ) ) { 
        					while ( ( $schemes_file = readdir( $schemes_dir ) ) !== false ) {
            						if ( stristr( $schemes_file, ".css" ) !== false ) {
								if ( $schemes_file != 'info.css' ) {
	                						$schemes[] = $schemes_file;
								}
            						}
        					}    
    					}
				}
			
				$schemes_num = count($schemes);
					
				for ($y=0; $y < $schemes_num; $y++) {

					if ( $skin_value == $skins[$i] ) {
						if ( $schemes[$y] == $color_value ) {
							$selected = ' selected';
						} else {
							$selected = '';
						}
					} else {
						$selected = '';
					} 

					$this->_skinsManagerField .= '<option value="' . $schemes[$y] . '"' . $selected . '>' . str_replace( '.css', '', ucwords($schemes[$y]) ) . '</option>';
				}
				$this->_skinsManagerField .= '</select></p>';

				$this->_skinsManagerField .= '</div>';

				$this->_skinsManagerField .= "
				<script type=\"text/javascript\">
				jQuery(document).ready(function(){
					jQuery('." . $args['id'] . "_select_skin_" . $i . "').click(function(){
						jQuery(this).parent().parent().find('.skin_selected').find('.button').removeClass('skin_btn_hide');
						jQuery(this).parent().parent().find('.skin_selected').find('select').addClass('skin_color_hide');
						jQuery(this).parent().parent().find('.skin_selected').removeClass('skin_selected');
						jQuery(this).parent().addClass('skin_selected');
						jQuery(this).parent().find('select').removeClass('skin_color_hide');
						jQuery(this).addClass('skin_btn_hide');
						jQuery('#" . $args['id'] . "_skins').attr('value', '" . $skins[$i] . "');
					});

					jQuery('#" . $args['id'] . "_color_" . $i . "').change(function(){
						var skin_color = jQuery('option:selected', this).val();
						jQuery( '#" . $args['id'] . "_colors').attr('value', skin_color);
					});
				});
				</script>
				";
			}
		}

		$this->_skinsManagerField .= '<div style="clear:left"></div>' . "\n";
		$this->_skinsManagerField .= '<input type="hidden" name="' . $args['id'] . '_skins" id="' . $args['id'] . '_skins" value="' . $skin_value . '" />' . "\n";
		$this->_skinsManagerField .= '<input type="hidden" name="' . $args['id'] . '_colors" id="' . $args['id'] . '_colors" value="' . $color_value . '" />' . "\n";
	}

	function getSkinsManagerField(){
		return $this->_skinsManagerField;
	}

	function setLayoutField( $args, $stored )
	{
		$layout_val  = $stored['layout'] != '' ? $stored['layout'] : $args['std']['layout'];
		$content_val = $stored['content'] != '' ? $stored['content'] : $args['std']['content'];
		$side1_val   = $stored['side1'] != '' ? $stored['side1'] : $args['std']['side1'];
		$side2_val   = $stored['side2'] != '' ? $stored['side2'] : $args['std']['side2'];
		//$colpad_val  = $stored['colpad'] != '' ? $stored['colpad'] : $args['std']['colpad'];

		$selected1 = '';
		$selected2 = '';
		$selected3 = '';
		$selected4 = '';
		$selected5 = '';
		$selected6 = '';

		if ( $layout_val ==  '1-col-no-side' ) {
			$selected1 = ' layout_selected';
		} elseif ( $layout_val ==  '2-col-left-side' ) {
			$selected2 = ' layout_selected';
		} elseif ( $layout_val ==  '2-col-right-side' ) {
			$selected3 = ' layout_selected';
		} elseif ( $layout_val ==  '3-col-both-side' ) {
			$selected4 = ' layout_selected';
		} elseif ( $layout_val ==  '3-col-left-side' ) {
			$selected5 = ' layout_selected';
		} elseif ( $layout_val ==  '3-col-right-side' ) {
			$selected6 = ' layout_selected';
		}

		$this->_layoutField  = "\t\t\t" . '<div class="fieldsection">' . "\n";
		$this->_layoutField .= "\t\t\t\t" . '<div class="fieldtitle">' . $args['name'][ 'layout' ] . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t" . '<div class="field-full">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="layout_block" style="width:116px;height:124px;margin-bottom:10px;text-align:center;float:left;">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<img src="' . PT_REL_IMAGES . '/admin/1-column-no-widgets.gif" border="0" id="1-col-no-side" class="select_layout' . $selected1 . '" />' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="layout_block" style="width:116px;height:124px;margin-bottom:10px;text-align:center;float:left;">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<img src="' . PT_REL_IMAGES . '/admin/2-columns-left-sidebar.gif" border="0" id="2-col-left-side" class="select_layout' . $selected2 . '" />' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="layout_block" style="width:116px;height:124px;margin-bottom:10px;text-align:center;float:left;">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<img src="' . PT_REL_IMAGES . '/admin/2-columns-right-sidebar.gif" border="0" id="2-col-right-side" class="select_layout' . $selected3 . '" />' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="layout_block" style="width:116px;height:124px;margin-bottom:10px;text-align:center;float:left;">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<img src="' . PT_REL_IMAGES . '/admin/3-columns-a.gif" border="0" id="3-col-both-side" class="select_layout' . $selected4 . '" />' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="layout_block" style="width:116px;height:124px;margin-bottom:10px;text-align:center;float:left;">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<img src="' . PT_REL_IMAGES . '/admin/3-columns-b.gif" border="0" id="3-col-left-side" class="select_layout' . $selected5 . '" />' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="layout_block" style="width:116px;height:124px;margin-bottom:10px;text-align:center;float:left;">' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<img src="' . PT_REL_IMAGES . '/admin/3-columns-c.gif" border="0" id="3-col-right-side" class="select_layout' . $selected6 . '" />' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_layoutField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_layoutField .= "\t\t\t" . '</div>' . "\n\n";
		$this->_layoutField .= "\t\t\t" . '<input type="hidden" name="' . $args['id'] .'_layout" id="' . $args['id'] .'_layout" value="' . $layout_val. '" />' . "\n";

		$setting = array( 'id' => $args['id'] . '_content', 'name' => $args['name']['content'], 'desc' => pt_isset($args['desc']['content']), 'suffix' => 'px', 'width' => 100 ); 
		$this->setTextField( $setting, $content_val );
		$this->_layoutField .= $this->getTextField();

		$setting = array( 'id' => $args['id'] . '_side1', 'name' => $args['name']['side1'], 'desc' => pt_isset($args['desc']['side1']), 'suffix' => 'px', 'width' => 100 ); 
		$this->setTextField( $setting, $side1_val );
		$this->_layoutField .= $this->getTextField();

		$setting = array( 'id' => $args['id'] . '_side2', 'name' => $args['name']['side2'], 'desc' => pt_isset($args['desc']['side2']), 'suffix' => 'px', 'width' => 100 ); 
		$this->setTextField( $setting, $side2_val );
		$this->_layoutField .= $this->getTextField();

//		$setting = array( 'id' => $args['id'] . '_colpad', 'name' => $args['name']['colpad'], 'desc' => pt_isset($args['desc']['colpad']), 'suffix' => 'px', 'width' => 60 );
//		$this->setTextField( $setting, $colpad_val);
//		$this->_layoutField .= $this->getTextField();

		$this->_layoutField .= "
		<script type='text/javascript'>
		jQuery(document).ready(function(){
			var layout = '" . $layout_val . "';

			if ( layout == '1-col-no-side' ) {
				jQuery('#" . $args['id'] . "_side1_text-field').hide();
				jQuery('#" . $args['id'] . "_side2_text-field').hide();
			} else if ( layout == '2-col-left-side' || layout == '2-col-right-side') {
				jQuery('#" . $args['id'] . "_side1_text-field').show();
				jQuery('#" . $args['id'] . "_side2_text-field').hide();
			} else {
				jQuery('#" . $args['id'] . "_side1_text-field').show();
				jQuery('#" . $args['id'] . "_side2_text-field').show();
			}

			jQuery('.select_layout').each(function(){
				jQuery(this).mouseover(function(){
					jQuery(this).addClass('layout_over');
				}).mouseout(function(){
					jQuery(this).removeClass('layout_over');
				});

				jQuery(this).click(function(){
					var layout = jQuery(this).attr('id');
					jQuery(this).parent().parent().find('.layout_block').find('.layout_selected').removeClass('layout_selected');
					jQuery(this).addClass('layout_selected');

					jQuery('#" . $args['id'] ."_layout').attr('value', layout);

					if ( layout == '1-col-no-side' ) {
						jQuery('#" . $args['id'] . "_side1_text-field').hide();
						jQuery('#" . $args['id'] . "_side2_text-field').hide();
					} else if ( layout == '2-col-left-side' || layout == '2-col-right-side') {
						jQuery('#" . $args['id'] . "_side1_text-field').show();
						jQuery('#" . $args['id'] . "_side2_text-field').hide();
					} else {
						jQuery('#" . $args['id'] . "_side1_text-field').show();
						jQuery('#" . $args['id'] . "_side2_text-field').show();
					}
				});
			});
		});
		</script>
		";

	}

	function getLayoutField()
	{
		return $this->_layoutField;
	}

	function setBackgroundField( $args, $stored )
	{
		// current values
		$type_val    = $stored['type'] != '' ? $stored['type'] : $args['std']['type'];
		$color_val   = $stored['color'] != '' ? $stored['color'] : $args['std']['color'];
		$upload_val  = $stored['upload'] != '' ? $stored['upload'] : $args['std']['upload'];
		$repeat_val  = $stored['repeat'] != '' ? $stored['repeat'] : $args['std']['repeat'];
		$pos_val     = $stored['pos'] != '' ? $stored['pos'] : $args['std']['pos'];
		$attach_val  = $stored['attach'] != '' ? $stored['attach'] : $args['std']['attach'];
		
		$setting = array( 'id' => $args['id'] . '_type', 'name' => $args['name']['type'], 'desc' => pt_isset($args['desc']['type']), 'options' => $args['options']['type'], 'std' => $args['std']['type'] );
		$this->setSelectField( $setting, $stored['type'] );
		$this->_backgroundField = $this->getSelectField();
		
		$setting = array( 'id' => $args['id'] . '_color', 'name' => $args['name']['color'], 'desc' => pt_isset($args['desc']['color']), 'std' => $args['std']['color'] );
		$this->setColorField( $setting, $color_val );
		$this->_backgroundField .= $this->getColorField();

		$setting = array( 'id' => $args['id'] . '_upload', 'name' => $args['name']['upload'], 'desc' => pt_isset($args['desc']['upload']), 'std' => $args['std']['upload'] );
		$this->setUploadField( $setting, $upload_val );
		$this->_backgroundField .= $this->getUploadField();

		$setting = array( 'id' => $args['id'] . '_repeat', 'name' => $args['name']['repeat'], 'desc' => pt_isset($args['desc']['repeat']), 'options' => $args['options']['repeat'], 'std' => $args['std']['repeat'] );
		$this->setSelectField( $setting, $stored['repeat'] );
		$this->_backgroundField .= $this->getSelectField();

		$setting = array( 'id' => $args['id'] . '_pos', 'name' => $args['name']['pos'], 'desc' => pt_isset($args['desc']['pos']), 'options' => $args['options']['pos'], 'std' => $args['std']['pos'] );
		$this->setSelectField( $setting, $stored['pos'] );
		$this->_backgroundField .= $this->getSelectField();

		$setting = array( 'id' => $args['id'] . '_attach', 'name' => $args['name']['attach'], 'desc' => pt_isset($args['desc']['attach']), 'options' => $args['options']['attach'], 'std' => $args['std']['attach'] );
		$this->setSelectField( $setting, $stored['attach'] );
		$this->_backgroundField .= $this->getSelectField();

		$this->_backgroundField .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
		';

		if ( $type_val == 'custom-background' ) {
			$this->_backgroundField .= '
				jQuery("#' . $args['id'] . '_color_color-field").show();
				jQuery("#' . $args['id'] . '_upload_upload-field").show();
				jQuery("#' . $args['id'] . '_repeat_select-field").show();
				jQuery("#' . $args['id'] . '_pos_select-field").show();
				jQuery("#' . $args['id'] . '_attach_select-field").show();
			';
		} else {
			$this->_backgroundField .= '
				jQuery("#' . $args['id'] . '_color_color-field").hide();
				jQuery("#' . $args['id'] . '_upload_upload-field").hide();
				jQuery("#' . $args['id'] . '_repeat_select-field").hide();
				jQuery("#' . $args['id'] . '_pos_select-field").hide();
				jQuery("#' . $args['id'] . '_attach_select-field").hide();
			';
		}

		$this->_backgroundField .= '
				jQuery("#pt_background_type").change(function(){
					if ( jQuery("option:selected", this).val() == "custom-background" ) {
						jQuery("#' . $args['id'] . '_color_color-field").show();
						jQuery("#' . $args['id'] . '_upload_upload-field").show();
						jQuery("#' . $args['id'] . '_repeat_select-field").show();
						jQuery("#' . $args['id'] . '_pos_select-field").show();
						jQuery("#' . $args['id'] . '_attach_select-field").show();
					} else {
						jQuery("#' . $args['id'] . '_color_color-field").hide();
						jQuery("#' . $args['id'] . '_upload_upload-field").hide();
						jQuery("#' . $args['id'] . '_repeat_select-field").hide();
						jQuery("#' . $args['id'] . '_pos_select-field").hide();
						jQuery("#' . $args['id'] . '_attach_select-field").hide();
					} 
				});
			});	
			</script>
		';
	}

	function getBackgroundField()
	{
		return $this->_backgroundField;
	}

	function setHeaderBgField( $args, $stored )
	{

		// current values
		$type_val    = $stored['type'] != '' ? $stored['type'] : $args['std']['type'];
		$upload_val  = $stored['upload'] != '' ? $stored['upload'] : $args['std']['upload'];
		$align_val   = $stored['align'] != '' ? $stored['align'] : $args['std']['align'];

		$setting = array( 'id' => $args['id'] . '_type', 'name' => $args['name']['type'], 'desc' => pt_isset($args['desc']['type']), 'options' => $args['options']['type'], 'std' => $args['std']['type'] );
		$this->setSelectField( $setting, $stored['type']);
		$this->_headerBgField = $this->getSelectField();

		$setting = array( 'id' => $args['id'] . '_upload', 'name' => $args['name']['upload'], 'desc' => pt_isset($args['desc']['upload']), 'std' => $args['std']['upload'] );
		$this->setUploadField( $setting, $upload_val );
		$this->_headerBgField .= $this->getUploadField();
		
		$setting = array( 'id' => $args['id'] . '_align', 'name' => $args['name']['align'], 'desc' => pt_isset($args['desc']['align']), 'options' => $args['options']['align'], 'std' => $args['std']['align'] );
		$this->setSelectField( $setting, $stored['align'] );
		$this->_headerBgField .= $this->getSelectField();

		$this->_headerBgField .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
		';

		if ( $type_val == 'custom-hbackground' ) {
			$this->_headerBgField .= '
				jQuery("#' . $args['id'] . '_upload_upload-field").show();
				jQuery("#' . $args['id'] . '_align_select-field").show();
			';
		} else {
			$this->_headerBgField .= '
				jQuery("#' . $args['id'] . '_upload_upload-field").hide();
				jQuery("#' . $args['id'] . '_align_select-field").hide();
			';
		}

		$this->_headerBgField .= '
				jQuery("#' . $args['id'] . '_type").change(function(){
					if ( jQuery("option:selected", this).val() == "custom-hbackground" ) {
						jQuery("#' . $args['id'] . '_upload_upload-field").show();
						jQuery("#' . $args['id'] . '_align_select-field").show();
					} else {
						jQuery("#' . $args['id'] . '_upload_upload-field").hide();
						jQuery("#' . $args['id'] . '_align_select-field").hide();
					} 
				});
			});	
			</script>
		';
	}
	
	function getHeaderBgField()
	{
		return $this->_headerBgField;
	}

	function setSelectHeader( $id, $name, $desc, $values, $std, $stored )
	{
		$this->_selectHeader  = "\t\t\t" . '<div class="fieldsection" id="' . $id . '_select-field">' . "\n";
		$this->_selectHeader .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $id . '">' . $name . '</label></div>' . "\n";
		$this->_selectHeader .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_selectHeader .= "\t\t\t\t\t" . '<select name="' . $id . '" id="' . $id . '" class="field_select" size="1">' . "\n";

		$headers_path = TEMPLATEPATH . '/lib/images/headers';

		if ( is_dir($headers_path) ) {
			if ( $headers_dir = opendir($headers_path) ) {
				while ( ( $headers_folders = readdir($headers_dir) ) !== false ) {
            				if ( $headers_folders != "." && $headers_folders != ".." && $headers_folders != 'index.html' ) {
						$folders[] = $headers_folders;
            				}
				}
			}
		}

		$folders_num = count($folders);

		for ( $f = 0; $f < $folders_num; $f++ ) {
			$this->_selectHeader  .= "\t\t\t\t\t\t" . '<optgroup label="' . ucwords(str_replace("_", " ", $folders[$f])) . '">' . "\n";
			
			$content_path = TEMPLATEPATH . '/lib/images/headers/' . $folders[$f];

			if ( is_dir($content_path) ) {
				if ( $content_dir = opendir($content_path) ) {
					while ( ( $headers_content = readdir($content_dir) ) !== false ) {
            					if ( $headers_content != "." && $headers_content != ".." && $headers_content != 'index.html' ) {
							$headers[] = $headers_content;
            					}
					}
				}
			}

			$headers_num = count($headers);

			for ( $i = 0; $i < $headers_num; $i++ ) {
				$selected = '';
				
				if ( $stored != '' ) {
					if ( $stored == $headers[$i] . '|no-repeat|right top|' . $folders[$f] ) { 
						$selected = ' selected="selected"';
					} 
				} else {
					if ( $std == $headers[$i] . '|no-repeat|right top|' . $folders[$f] ) {
						$selected = ' selected="selected"'; 
					}
				}

				$this->_selectHeader .= "\t\t\t\t\t\t\t" . '<option value="' . $headers[$i] . '|no-repeat|right top|' . $folders[$f] . '"' . $selected . ' style="padding-left:20px">' . ucwords(str_replace("_", " ", str_replace(".png", "", str_replace("-", " ", $headers[$i])))) . '</option>'."\n";
			}

			$headers = '';

			$this->_selectHeader  .= "\t\t\t\t\t\t" . '</optgroup>' . "\n";
		}
	
		$this->_selectHeader .= "\t\t\t\t\t" . '</select>' . "\n";
		$this->_selectHeader .= "\t\t\t\t" . '</div>' . "\n";
		$this->_selectHeader .= "\t\t\t\t" . '<div class="field-right">' . $desc . '</div>' . "\n";
		$this->_selectHeader .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";			
		$this->_selectHeader .= "\t\t\t" . '</div>' . "\n\n";
		$this->_selectHeader .= "\t\t\t" . '<div id="headerpreview"></div>' . "\n\n";
		
		$this->_selectHeader .= '
			<script type="text/javascript">
				jQuery(document).ready(function() {
    					jQuery("#' . $id . '").change(function() {
        					var src = jQuery("option:selected", this).val();
						var img = src.split("|");
        					jQuery("#headerpreview").html( img[0] ? "<img src=\'' . PT_REL_IMAGES . '/headers/" + img[3] + "/" + img[0] + "\' style=\'width:720px;border:1px solid #ccc;\'>" : "" );
    					});
				});

			</script>	
		';	
		
	}

	function getSelectHeader()
	{
		return $this->_selectHeader;
	}

	function setImportField( $args )
	{
		$this->_importField  = "\t\t\t" . '<div class="fieldsection">' . "\n";
		$this->_importField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="' . $args['id'] . '">' . $args['name'] . '</label></div>' . "\n";
		$this->_importField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_importField .= "\t\t\t\t\t" . '<input id="' . $args['id'] . '_attachment" name="' . $args['id'] . '" type="file" class="field_txt" />' . "\n";
		$this->_importField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_importField .= "\t\t\t\t" . '<div class="field-right">' . pt_isset($args['desc']) . '</div>' . "\n";
		$this->_importField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_importField .= "\n\n\t\t\t" . '</div>' . "\n\n";
		
	}

	function getImportField()
	{
		return $this->_importField;
	}

	function setUpdateField( $args )
	{
		$get_version = get_option( 'pt_version' );
		$this->_updateField = '';

		$this->_updateField .= "\t\t" . '<form method="post" name="pt_install_update" id="pt_install_update" enctype="multipart/form-data">' . "\n";
		
		$this->_updateField .= "\t\t" . '<div class="block">' . "\n";
		// Install skins tool
		$this->_updateField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_skins-upload-field">' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="install_skins">Install Site/Membership Skins</label></div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="field-left">' . "\n";		
		$this->_updateField .= "\t\t\t\t\t" . '<input type="file" name="install_skins" id="install_skins" /> ' . "\n";
		$this->_updateField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="field-right">If you have site/membership skin(s) for Profits Theme in a .zip format, you may install it by uploading it here.</div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_updateField .= "\t\t\t" . '</div>' . "\n";

		// Install minisites tool
		
		$this->_updateField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_minisites-upload-field">' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="install_minisites">Install Landing Page Skins</label></div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_updateField .= "\t\t\t\t\t" . '<input type="file" name="install_minisites" id="install_minisites" /> ' . "\n";
		$this->_updateField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="field-right">If you have minisite skin(s) for Profits Theme in a .zip format, you may install it by uploading it here.</div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";

		// Install JW Player
		
		$this->_updateField .= "\t\t\t" . '<div class="fieldsection" id="' . $args['id'] . '_jwplayer-upload-field">' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="fieldtitle"><label for="install_minisites">Install JW Player</label></div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="field-left">' . "\n";
		$this->_updateField .= "\t\t\t\t\t" . '<input type="file" name="install_jwplayer" id="install_jwplayer" /> ' . "\n";
		$this->_updateField .= "\t\t\t\t" . '</div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="field-right">If you have <a href="http://www.longtailvideo.com/players/jw-flv-player" target="_blank">JW Video Player</a> in a .zip format, you may integrate it with Profits Theme by uploading it here.</div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<div class="clr"></div>' . "\n";
		$this->_updateField .= "\t\t\t\t" . '<p class="field-full">You can also install and activate <a href="' . admin_url('plugin-install.php?tab=search&type=term&s=JW+Player+For+Wordpress&plugin-search-input=Search+Plugins') . '" target="_blank">JW Player plugin for Wordpress</a> to integrate PT with JW Player instead of uploading it via the field above.</p>' . "\n";
		$this->_updateField .= "\t\t\t" . '</div>' . "\n";	
		$this->_updateField .= "\t\t" . '</div>' . "\n\n";
		$this->_updateField .= "\t\t" . '<input name="action" type="hidden" value="install_update" />' . "\n";
		$this->_updateField .= "\t\t" . '<p class="submit"><input name="save" type="submit" value="Install/Update" class="button" /></p>' . "\n";
		$this->_updateField .= "\t\t" . '</form>' . "\n"; 

	}

	function getUpdateField()
	{
		return $this->_updateField;
	}

	function setFontField( $id, $value )
	{
	
		$newFonts = new PtFonts();
		$fonts    = $newFonts->getFonts();

		$selected = '';

		$select_val = stripslashes( $value );
		
		$this->_fontField = '<select name="' . $id . '" id="' . $id . '" class="field_select" size="1" style="width:100px">' . "\n";
		foreach ( $fonts as $font ) {
			if ( $select_val != '' ){
	                    	if ( $select_val == $font['family'] ) { 
					$selected = ' selected="selected"';
				} else {
					$selected = '';
				} 
        		}

			$this->_fontField .= '<option value=\''. $font['family'] .'\'' . $selected . '>' . $font['name'];
			if ( pt_isset($font['websafe']) == false ) {
				$this->_fontField .= ' *';
			}
			$this->_fontField .= '</option>' . "\n";
			
		}

		$this->_fontField .= '</select>' . "\n\n";

	}

	function getFontField()
	{
		return $this->_fontField;
	}

	protected function setValue( $std, $option )
	{
		$this->_value = $option != '' ? stripslashes($option) : stripslashes($std);
	}

	protected function getValue()
	{
		return $this->_value;
	}
}