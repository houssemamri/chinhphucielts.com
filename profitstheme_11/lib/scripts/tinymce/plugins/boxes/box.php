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
	<title>Insert Johnson Box</title>
	<script type="text/javascript" src="<?php echo site_url('wp-includes/js/tinymce/tiny_mce_popup.js?ver='.time()); ?>"></script>
	<script type="text/javascript" src="../box.js?ver=<?php echo time(); ?>"></script>

	<link href="css/box.css" rel="stylesheet" type="text/css" />
</head>
<body id="johnsonbox" style="display: none">
	<form onSubmit="GpfBoxDialog.insert();return false;">
		<div id="frmbody">
			<fieldset>
			<legend>Boxes</legend>
            <!-- recent design -->
            <div class="jbox">
				<div><label for="greybox"><img src="img/box1-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox" value="greybox" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox"><img src="img/box1-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox" value="bluebox" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox"><img src="img/box1-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox" value="greenbox" checked="checked" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox"><img src="img/box1-orange.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox" value="orangebox" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox"><img src="img/box1-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox" value="redbox" /></div>
			</div>
			<div class="jbox">
				<div><label for="greybox2"><img src="img/box2-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox2" value="greybox2" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox2"><img src="img/box2-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox2" value="bluebox2" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox2"><img src="img/box2-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox2" value="greenbox2" /></div>
			</div>
			<div class="jbox">
				<div><label for="yellowbox2"><img src="img/box2-yellow.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="yellowbox2" value="yellowbox2" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox2"><img src="img/box2-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox2" value="redbox2" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox3"><img src="img/box3-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox3" value="greybox3" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox3"><img src="img/box3-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox3" value="bluebox3" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox3"><img src="img/box3-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox3" value="greenbox3" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox3"><img src="img/box3-orange.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox3" value="orangebox3" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox3"><img src="img/box3-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox3" value="redbox3" /></div>
			</div>
			<div class="jbox">
				<div><label for="greybox4"><img src="img/box4-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox4" value="greybox4" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox4"><img src="img/box4-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox4" value="bluebox4" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox4"><img src="img/box4-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox4" value="greenbox4" /></div>
			</div>
			<div class="jbox">
				<div><label for="yellowbox4"><img src="img/box4-yellow.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="yellowbox4" value="yellowbox4" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox4"><img src="img/box4-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox4" value="redbox4" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox5"><img src="img/box5-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox5" value="greybox5" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox5"><img src="img/box5-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox5" value="bluebox5" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox5"><img src="img/box5-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox5" value="greenbox5" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox5"><img src="img/box5-orange.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox5" value="orangebox5" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox5"><img src="img/box5-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox5" value="redbox5" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox6"><img src="img/box6-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox6" value="greybox6" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox6"><img src="img/box6-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox6" value="bluebox6" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox6"><img src="img/box6-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox6" value="greenbox6" /></div>
			</div>
			<div class="jbox">
				<div><label for="yellowbox6"><img src="img/box6-yellow.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="yellowbox6" value="yellowbox6" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox6"><img src="img/box6-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox6" value="redbox6" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox7"><img src="img/box7-grey.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox7" value="greybox7" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox7"><img src="img/box7-blue.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox7" value="bluebox7" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox7"><img src="img/box7-green.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox7" value="greenbox7" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox7"><img src="img/box7-orange.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox7" value="orangebox7" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox7"><img src="img/box7-red.gif" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox7" value="redbox7" /></div>
			</div>
            <!-- new design -->
			<div class="jbox">
				<div><label for="greybox8"><div class="greybox8 box-sizing"><div class="element-box"></div></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox8" value="greybox8" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox8"><div class="bluebox8 box-sizing"><div class="element-box"></div></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox8" value="bluebox8" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox8"><div class="greenbox8 box-sizing"><div class="element-box"></div></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox8" value="greenbox8" checked="checked" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox8"><div class="orangebox8 box-sizing"><div class="element-box"></div></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox8" value="orangebox8" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox8"><div class="redbox8 box-sizing"><div class="element-box"></div></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox8" value="redbox8" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="greybox9"><div class="greybox9 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox9" value="greybox9" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox9"><div class="bluebox9 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox9" value="bluebox9" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox9"><div class="greenbox9 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox9" value="greenbox9" /></div>
			</div>
			<div class="jbox">
				<div><label for="yellowbox9"><div class="yellowbox9 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="yellowbox9" value="yellowbox9" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox9"><div class="redbox9 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox9" value="redbox9" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox10"><div class="greybox10 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox10" value="greybox10" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox10"><div class="bluebox10 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox10" value="bluebox10" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox10"><div class="greenbox10 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox10" value="greenbox10" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox10"><div class="orangebox10 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox10" value="orangebox10" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox10"><div class="redbox10 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox10" value="redbox10" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="greybox11"><div class="greybox11 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox11" value="greybox11" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox11"><div class="bluebox11 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox11" value="bluebox11" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox11"><div class="greenbox11 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox11" value="greenbox11" /></div>
			</div>
			<div class="jbox">
				<div><label for="yellowbox11"><div class="yellowbox11 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="yellowbox11" value="yellowbox11" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox11"><div class="redbox11 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox11" value="redbox11" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox12"><div class="greybox12 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox12" value="greybox12" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox12"><div class="bluebox12 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox12" value="bluebox12" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox12"><div class="greenbox12 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox12" value="greenbox12" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox12"><div class="orangebox12 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox12" value="orangebox12" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox12"><div class="redbox12 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox12" value="redbox12" /></div>
			</div>
            
           <div class="jbox">
				<div><label for="greybox15"><div class="greybox15 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox15" value="greybox15" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox15"><div class="bluebox15 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox15" value="bluebox15" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox15"><div class="greenbox15 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox15" value="greenbox15" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox15"><div class="orangebox15 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox15" value="orangebox15" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox15"><div class="redbox15 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox15" value="redbox15" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox13"><div class="greybox13 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox13" value="greybox13" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox13"><div class="bluebox13 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox13" value="bluebox13" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox13"><div class="greenbox13 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox13" value="greenbox13" /></div>
			</div>
			<div class="jbox">
				<div><label for="yellowbox13"><div class="yellowbox13 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="yellowbox13" value="yellowbox13" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox13"><div class="redbox13 box-sizing"></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox13" value="redbox13" /></div>
			</div>

			<div class="jbox">
				<div><label for="greybox14"><div class="greybox14 box-sizing"><p class="greybox14-head box-heading"></p></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greybox14" value="greybox14" /></div>
			</div>
			<div class="jbox">
				<div><label for="bluebox14"><div class="bluebox14 box-sizing"><p class="bluebox14-head box-heading"></p></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="bluebox14" value="bluebox14" /></div>
			</div>
			<div class="jbox">
				<div><label for="greenbox14"><div class="greenbox14 box-sizing"><p class="greenbox14-head box-heading"></p></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="greenbox14" value="greenbox14" /></div>
			</div>
			<div class="jbox">
				<div><label for="orangebox14"><div class="orangebox14 box-sizing"><p class="orangebox14-head box-heading"></p></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="orangebox14" value="orangebox14" /></div>
			</div>
			<div class="jbox">
				<div><label for="redbox14"><div class="redbox14 box-sizing"><p class="redbox14-head box-heading"></p></div></label></div>
				<div style="text-align:center"><input type="radio" name="gpfjbox" id="redbox14" value="redbox14" /></div>
			</div>
			<div class="clear"></div>
			</fieldset>

			<div style="margin-top:10px">
			<fieldset>
				<legend>Box Properties</legend>
				<table border="0" cellpadding="4" cellspacing="0" width="100%">
				<tr>
				<td><label for="gpfjboxwidth">Width</label></td>
				<td><input type="text" name="gpfjboxwidth" id="gpfjboxwidth" value="520" style="width:60px" /> px</td>
				</tr>
				<tr>
				<td><label for="gpfjboxpadtb">Padding Top/Bottom</label></td>
				<td><input type="text" name="gpfjboxpadtb" id="gpfjboxpadtb" value="10" style="width:60px" /> px</td>
				</tr>
				<tr>
				<td><label for="gpfjboxpadlr">Padding Left/Right</label></td>
				<td><input type="text" name="gpfjboxpadlr" id="gpfjboxpadlr" value="20" style="width:60px" /> px</td>
				</tr>
				<tr>
				<td><label for="gpfjboxtemplate">Text Template</label></td>
				<td>
					<select name="gpfjboxtemplate" id="gpfjboxtemplate" />
					<option value="" selected="selected">No Template</option>
					<option value="testimonial">Testimonial Template</option>
					<option value="buynow">Buy Now Template</option>
					<option value="product">Product Detail Template</option>
					</select>
				</td>
				</tr>
				</table>
			</fieldset>
			</div>
		</div>

		<div class="mceActionPanel">
			<input type="hidden" id="gpfjboxperson" name="gpfjboxperson" value="<?php echo PT_REL_IMAGES; ?>/person.png" />
			<input type="hidden" id="gpfjboxecover" name="gpfjboxecover" value="<?php echo PT_REL_IMAGES; ?>/box.png" />
			<input type="hidden" id="gpfjboxbtn" name="gpfjboxbtn" value="<?php echo PT_REL_IMAGES; ?>/buttons/yellow_add-to-cart.png" />
			<input type="submit" id="insert" name="insert" value="{#insert}" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onClick="tinyMCEPopup.close();" />
		</div>
	</form>
</body>
</html>