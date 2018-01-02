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
	<title>Embed Flash Video</title>
	<script type="text/javascript" src="<?php echo site_url('wp-includes/js/tinymce/tiny_mce_popup.js?ver='.time()); ?>"></script>

	<script type="text/javascript">
	tinyMCEPopup.requireLangPack();
	var GpfVideoDialog = {
		init: function() {

			tinyMCEPopup.resizeToInnerSize();
		},

		insert: function( ) {
			var ed = tinyMCEPopup.editor, f = document.forms[0]; v = f.gpfvideo.value;

			ed.execCommand('mceInsertRawHTML', false, v);

			tinyMCEPopup.close();
		}
	};

	tinyMCEPopup.onInit.add(GpfVideoDialog.init, GpfVideoDialog);

	</script>

	<link href="css/video.css" rel="stylesheet" type="text/css" />
</head>
<body id="johnsonbox" style="display: none">
	<form onsubmit="GpfVideoDialog.insert();return false;">
		<div id="frmbody">
			<fieldset>
			<legend>Embed Video From Youtube, Vimeo, Viddler, etc.</legend>
			<p style="text-align:center">
			<label for="gpfvideo">Paste the video embed code below:</label>
			<textarea name="gpfvideo" id="gpfvideo" cols="75" rows="6"></textarea>
			</p>
			</fieldset>

		</div>

		<div class="mceActionPanel">
			<input type="submit" id="insert" name="insert" value="{#insert}" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
		</div>
	</form>
</body>
</html>