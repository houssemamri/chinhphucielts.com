<?php
$dirs   = explode("\\", dirname(__FILE__));
$slash  = '\\';

if ( count($dirs) <= 1 ) {
	$dirs   = explode("/", dirname(__FILE__));
	$slash  = '/';
}

$pos    = array_search('wp-content', $dirs);
$wppath = '';

for ( $i=0; $i<$pos;$i++ ) {
	$wppath .= $dirs[$i] . $slash;
}

if ( file_exists($wppath . 'wp-config.php') ) {
	require_once($wppath . 'wp-config.php');
} else {
	require_once('../../../../../../../../wp-config.php');
}
require_once(TEMPLATEPATH . '/functions.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Insert Buttons</title>
	<script type="text/javascript" src="<?php echo site_url('wp-includes/js/tinymce/tiny_mce_popup.js?ver='.time()); ?>"></script>

	<script type="text/javascript">
	tinyMCEPopup.requireLangPack();
	var ButtonsDialog = {
		init: function() {
			var ed = tinyMCEPopup.editor, f = document.forms[0], dom = ed.dom, n = ed.selection.getNode();
			tinyMCEPopup.resizeToInnerSize();
		},

		insert: function( ) {
			var ed = tinyMCEPopup.editor, f = document.forms[0], h, u;
			u = '<?php echo get_bloginfo('template_url')?>/lib/images/buttons/';
		
			h = '<img src="' + u;
		
			for (var i=0; i < f.gpfbuttons.length; i++) {
   				if (f.gpfbuttons[i].checked) {
					var v = f.gpfbuttons[i].value;
					h += v;
				}
			}

			h += '" />';
			
			ed.execCommand('mceInsertRawHTML', false, h);

			tinyMCEPopup.close();
		}
	};

	tinyMCEPopup.onInit.add(ButtonsDialog.init, ButtonsDialog);

	</script>

	<link href="css/actionbuttons.css" rel="stylesheet" type="text/css" />
</head>
<body id="actionbuttons" style="display: none">
	<form onSubmit="ButtonsDialog.insert();return false;">
		<div id="frmbody">
			<div class="title">Insert Buttons</div>
			<fieldset>
				<legend>Add To Cart</legend>
                <div style="padding:10px">
					<div class="floatbox">
						<div><label for="yellow_add-to-cart"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/yellow_add-to-cart.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="yellow_add-to-cart" value="yellow_add-to-cart.png" checked="checked" /></div>
					</div>

					<div class="floatbox">
						<div><label for="red_add-to-cart"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/red_add-to-cart.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="red_add-to-cart" value="red_add-to-cart.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="blue_add-to-cart"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/blue_add-to-cart.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="blue_add-to-cart" value="blue_add-to-cart.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="green_add-to-cart"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/green_add-to-cart.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="green_add-to-cart" value="green_add-to-cart" /></div>
					</div>


					<div class="floatbox">
						<div><label for="orange_add-to-cart2"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/orange_add-to-cart2.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="orange_add-to-cart2" value="orange_add-to-cart2.png" checked="checked" /></div>
					</div>

					<div class="floatbox">
						<div><label for="red_add-to-cart2"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/red_add-to-cart2.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="red_add-to-cart2" value="red_add-to-cart2.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="blue_add-to-cart2"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/blue_add-to-cart2.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="blue_add-to-cart2" value="blue_add-to-cart2.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="green_add-to-cart2"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/green_add-to-cart2.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="green_add-to-cart2" value="green_add-to-cart2" /></div>
					</div>


					<div class="floatbox">
						<div><label for="orange_add-to-cart3"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/orange_add-to-cart3.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="orange_add-to-cart3" value="orange_add-to-cart3.png" checked="checked" /></div>
					</div>

					<div class="floatbox">
						<div><label for="red_add-to-cart3"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/red_add-to-cart3.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="red_add-to-cart3" value="red_add-to-cart3.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="blue_add-to-cart3"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/blue_add-to-cart3.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="blue_add-to-cart3" value="blue_add-to-cart3.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="green_add-to-cart3"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/green_add-to-cart3.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="green_add-to-cart3" value="green_add-to-cart3" /></div>
					</div>


					<div class="floatbox">
						<div><label for="cart1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/cart-orange.jpg&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="cart1-orange" value="cart-orange.jpg" /></div>
					</div>

					<div class="floatbox">
						<div><label for="cart1-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/cart-red.jpg&w=145&h=&zc=1" border="0" style="cursor:pointer" /></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="cart1-red" value="cart-red.jpg" /></div>
					</div>

					<div class="floatbox">
						<div><label for="cart1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/cart-blue.jpg&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="cart1-blue" value="cart-blue.jpg" /></div>
					</div>

					<div class="floatbox">
						<div><label for="cart1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/cart-green.jpg&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="cart1-green" value="cart-green.jpg" /></div>
					</div>
                				
                   <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="metro_add-to-cart_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/add_to_cart/metro_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="metro_add-to-cart_<?php echo $i ?>" value="add_to_cart/metro_<?php echo $i ?>.png" checked="checked" /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="grunge_add-to-cart_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/add_to_cart/grunge_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="grunge_add-to-cart_<?php echo $i ?>" value="add_to_cart/grunge_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="gloss_add-to-cart_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/add_to_cart/gloss_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="gloss_add-to-cart_<?php echo $i ?>" value="add_to_cart/gloss_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
					<div class="clear"></div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Order Now</legend>
                <div style="padding:10px">
					<div class="floatbox">
						<div><label for="order-set1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set1-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set1-orange" value="order-set1-orange.png"/></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set1-red.gif"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set1-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set1-red.gif" value="order-set1-red.gif.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set1-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set1-blue" value="order-set1-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set1-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set1-green" value="order-set1-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set2-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set2-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set2-orange" value="order-set2-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set2-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set2-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set2-red" value="order-set2-red.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set2-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set2-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set2-blue" value="order-set2-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set2-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set2-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set2-green" value="order-set2-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set3-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set3-orange.png&w=195&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="cart2-orange" value="order-set3-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set3-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set3-blue.png&w=195&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set3-blue" value="order-set3-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="order-set3-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order-set3-green.png&w=195&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="order-set3-green" value="order-set3-green.png" /></div>
					</div>
				 <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="metro_order_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order/metro_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="metro_order_now_<?php echo $i ?>" value="order/metro_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="grunge_order_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order/grunge_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="grunge_order_now_<?php echo $i ?>" value="order/grunge_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="gloss_order_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/order/gloss_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="gloss_order_now_<?php echo $i ?>" value="order/gloss_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
					<div class="clear"></div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Buy Now</legend>
				<div style="padding:10px">
					<div class="floatbox">
						<div><label for="buy-set1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set1-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set1-orange" value="buy-set1-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set1-red.gif"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set1-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set1-red.gif" value="buy-set1-red.gif.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set1-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set1-blue" value="buy-set1-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set1-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set1-green" value="buy-set1-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set2-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set2-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set2-orange" value="buy-set2-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set2-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set2-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set2-red" value="buy-set2-red.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set2-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set2-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set2-blue" value="buy-set2-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set2-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set2-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set2-green" value="buy-set2-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set3-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set3-orange.png&w=195&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set3-orange" value="buy-set3-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set3-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set3-blue.png&w=195&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set3-blue" value="buy-set3-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="buy-set3-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy-set3-green.png&w=195&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="buy-set3-green" value="buy-set3-green.png" /></div>
					</div>
					<?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="metro_buy_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy/metro_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="metro_buy_now_<?php echo $i ?>" value="buy/metro_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="grunge_buy_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy/grunge_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="grunge_buy_now_<?php echo $i ?>" value="buy/grunge_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="gloss_buy_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/buy/gloss_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="gloss_buy_now_<?php echo $i ?>" value="buy/gloss_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
				<div class="clear"></div>
				</div>
			</fieldset>

			<fieldset>
				<legend>Misc. Buttons</legend>
				<div class="floatbox">
						<div><label for="instant-set1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/instant-set1-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="instant-set1-orange" value="instant-set1-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="instant-set1-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/instant-set1-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="instant-set1-red" value="instant-set1-red.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="instant-set1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/instant-set1-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="instant-set1-blue" value="instant-set1-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="instant-set1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/instant-set1-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="instant-set1-green" value="instant-set1-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="join-set1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/join-set1-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="join-set1-orange" value="join-set1-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="join-set1-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/join-set1-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="join-set1-red" value="join-set1-red.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="join-set1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/join-set1-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="join-set1-blue" value="join-set1-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="join-set1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/join-set1-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="join-set1-green" value="join-set1-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="trial-set1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/trial-set1-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="trial-set1-orange" value="trial-set1-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="trial-set1-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/trial-set1-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="trial-set1-red" value="trial-set1-red.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="trial-set1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/trial-set1-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="trial-set1-blue" value="trial-set1-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="trial-set1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/trial-set1-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="trial-set1-green" value="trial-set1-green.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="down-set1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/down-set1-orange.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="down-set1-orange" value="down-set1-orange.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="down-set1-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/down-set1-red.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="down-set1-red" value="down-set1-red.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="down-set1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/down-set1-blue.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="down-set1-blue" value="down-set1-blue.png" /></div>
					</div>

					<div class="floatbox">
						<div><label for="down-set1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/down-set1-green.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="down-set1-green" value="down-set1-green.png" /></div>
					</div>
				
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="metro_download_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/download/metro_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="metro_download_now_<?php echo $i ?>" value="download/metro_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="grunge_download_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/download/grunge_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="grunge_download_now_<?php echo $i ?>" value="download/grunge_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>                    
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="metro_join_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/join/metro_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="metro_join_now_<?php echo $i ?>" value="join/metro_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="grunge_join_now_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/join/grunge_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="grunge_join_now_<?php echo $i ?>" value="join/grunge_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>                  
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="metro_trial_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/trial/metro_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="metro_trial_<?php echo $i ?>" value="trial/metro_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>
                    <?php  for ($i = 1; $i <= 5; $i++){?> 
                    <div class="floatbox">
						<div><label for="grunge_trial_<?php echo $i ?>"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/buttons/trial/grunge_<?php echo $i ?>.png&w=145&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
						<div style="text-align:center"><input type="radio" name="gpfbuttons" id="grunge_trial_<?php echo $i ?>" value="trial/grunge_<?php echo $i ?>.png"  /></div>
					</div>
                    <?php } ?>					
					<div class="clear"></div>
				</div>
			</fieldset>
		</div>

		<div class="mceActionPanel">
			<input type="submit" id="insert" name="insert" value="{#insert}" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onClick="tinyMCEPopup.close();" />
		</div>
	</form>
</body>
</html>