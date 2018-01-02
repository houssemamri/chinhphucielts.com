<?php

$file = ( isset($_GET['file']) ) ? $_GET['file'] : 'custom-site.css';

$filepath = TEMPLATEPATH . '/custom/' . $file;

if ( !is_writeable( $filepath ) ) {
	$error = '<p>The <code>custom/' . $file . '</code> is not writeable. To enable file editing via admin dashboard, you need to set the permissions of this file to 666.</p>';
}

if ( !file_exists( $filepath ) ) {
	$error = '<p>The <code>custom/' . $file . '</code> does not appear to exist.</p>';
}

if ( file_exists( $filepath ) ) {
	if ( filesize( $filepath ) > 0 ) {
		$content = @fopen($filepath, 'r');
		$content = @fread($content, filesize($filepath));
		$content = htmlspecialchars($content);
	} else {
		$content = '';
	}
} else {
	$content = '';
}

$disabled = ( isset( $error ) ) ? 'disabled' : '';
?>
<div class="pt-custom-editor" style="width:95%;padding:0 20px;">
<?php if ( isset( $error ) ) { echo '<div class="error" style="margin:5px 0;width:95%">' . $error . '</div>'; } ?>

<?php if ( file_exists( $filepath ) ) { ?>
<h3>Currently Editing: <span style="background:#E5E5E5">&nbsp;custom/<?php echo $file; ?>&nbsp;</span></h3>
<?php } ?>

<form method="post" name="pt-editor" id="pt-editor">
<?php 
$selected = ( get_option('pt_enable_custom') == 'true' ) ? ' checked="checked"' : '';

echo '<p>';
echo '<label for="enablecss">Load custom file(s) to Profits Theme</label> <input type="checkbox" name="enablecustom" id="enablecustom" value="true"' . $selected . ' />';
echo '</p>';
?>
<input type="hidden" name="filename" id="filename" value="<?php echo $filepath; ?>" />
<input type="hidden" name="action" id="action" value="editor" />
<textarea class="widefat custom_editor" name="newcontent" id="newcontent" class="large-text" style="height:460px"<?php echo $disabled; ?>><?php echo $content; ?></textarea>
<?php if ( $file == 'custom-site.css' ) { ?>
<p>Quick Color Reference: <input type="text" name="color-editor" class="color {hash:true}" value="#FFFFFF" /></p>
<?php } ?>
<?php if ( !isset( $error ) ) { ?>
<p class="submit"><input name="save" type="submit" value="Save Changes" /></p>
<?php } ?>
<p><em><strong>Note:</strong> The changes you've made in this editor will not affect both membership and landing pages.</em></p>
</form>
</div>