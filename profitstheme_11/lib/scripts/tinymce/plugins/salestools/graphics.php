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
	<title>Insert Sales Graphics</title>
	<script type="text/javascript" src="<?php echo site_url('wp-includes/js/tinymce/tiny_mce_popup.js?ver='.time()); ?>"></script>

	<script type="text/javascript">
	tinyMCEPopup.requireLangPack();
	var GpfGraphicsDialog = {
		init: function() {
			var ed = tinyMCEPopup.editor, f = document.forms[0], dom = ed.dom, n = ed.selection.getNode();
			tinyMCEPopup.resizeToInnerSize();
		},

		insert: function( ) {
			var ed = tinyMCEPopup.editor, f = document.forms[0], h, u;
			u = '<?php echo get_bloginfo('template_url')?>/lib/images/';
		
			h = '<img src="' + u;
		
			for (var i=0; i < f.gpfgraph.length; i++) {
   				if (f.gpfgraph[i].checked) {
					var v = f.gpfgraph[i].value;
					h += v;
				}
			}

			h += '" />';
			
			ed.execCommand('mceInsertRawHTML', false, h);

			tinyMCEPopup.close();
		}
	};

	tinyMCEPopup.onInit.add(GpfGraphicsDialog.init, GpfGraphicsDialog);

	</script>

	<link href="css/graphics.css" rel="stylesheet" type="text/css" />
</head>
<body id="johnsonbox" style="display: none">
	<form onSubmit="GpfGraphicsDialog.insert();return false;">
		<div id="frmbody">
			<fieldset>
			<legend>Curved Arrows</legend>
            
            <div class="jbox">
				<div><label for="arrow7-left-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-left-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-left-orange" value="arrows/arrow7-left-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-left-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-left-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-left-red" value="arrows/arrow7-left-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-left-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-left-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-left-blue" value="arrows/arrow7-left-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-left-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-left-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-left-green" value="arrows/arrow7-left-green.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-right-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-right-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-right-orange" value="arrows/arrow7-right-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-right-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-right-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-right-red" value="arrows/arrow7-right-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-right-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-right-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-right-blue" value="arrows/arrow7-right-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow7-right-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow7-right-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow7-right-green" value="arrows/arrow7-right-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="arrow8-left-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-left-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-left-orange" value="arrows/arrow8-left-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-left-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-left-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-left-red" value="arrows/arrow8-left-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-left-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-left-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-left-blue" value="arrows/arrow8-left-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-left-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-left-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-left-green" value="arrows/arrow8-left-green.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-right-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-right-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-right-orange" value="arrows/arrow8-right-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-right-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-right-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-right-red" value="arrows/arrow8-right-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-right-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-right-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-right-blue" value="arrows/arrow8-right-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-right-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-right-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-right-green" value="arrows/arrow8-right-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="arrow9-left-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-left-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-left-orange" value="arrows/arrow9-left-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-left-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-left-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-left-red" value="arrows/arrow9-left-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-left-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-left-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-left-blue" value="arrows/arrow9-left-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-left-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-left-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-left-green" value="arrows/arrow9-left-green.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-right-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-right-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-right-orange" value="arrows/arrow9-right-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-right-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-right-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-right-red" value="arrows/arrow9-right-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-right-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-right-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-right-blue" value="arrows/arrow9-right-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow9-right-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow9-right-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow9-right-green" value="arrows/arrow9-right-green.png" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="arrow1-left-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-left-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-left-orange" value="arrows/arrow1-left-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-left-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-left-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-left-red" value="arrows/arrow1-left-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-left-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-left-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-left-blue" value="arrows/arrow1-left-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-left-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-left-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-left-green" value="arrows/arrow1-left-green.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-right-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-right-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-right-orange" value="arrows/arrow1-right-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-right-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-right-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-right-red" value="arrows/arrow1-right-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-right-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-right-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-right-blue" value="arrows/arrow1-right-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow1-right-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow1-right-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow1-right-green" value="arrows/arrow1-right-green.png" /></div>
			</div>
			
			<div class="jbox">
				<div><label for="arrow3-left-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-left-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-left-orange" value="arrows/arrow3-left-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-left-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-left-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-left-red" value="arrows/arrow3-left-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-left-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-left-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-left-blue" value="arrows/arrow3-left-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-left-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-left-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-left-green" value="arrows/arrow3-left-green.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-right-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-right-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-right-orange" value="arrows/arrow3-right-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-right-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-right-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-right-red" value="arrows/arrow3-right-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-right-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-right-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-right-blue" value="arrows/arrow3-right-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow3-right-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow3-right-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow3-right-green" value="arrows/arrow3-right-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="arrow11-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-orange" value="arrows/arrow11-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow11-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-red" value="arrows/arrow11-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow11-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-blue" value="arrows/arrow11-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow11-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-green" value="arrows/arrow11-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="arrow11-up-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-up-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-up-orange" value="arrows/arrow11-up-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow11-up-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-up-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-up-red" value="arrows/arrow11-up-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow11-up-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-up-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-up-blue" value="arrows/arrow11-up-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow11-up-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow11-up-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow11-up-green" value="arrows/arrow11-up-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="arrow6-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-orange" value="arrows/arrow6-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow6-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-red" value="arrows/arrow6-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow6-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-blue" value="arrows/arrow6-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow6-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-green" value="arrows/arrow6-green.png" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="arrow6-up-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-up-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-up-orange" value="arrows/arrow6-up-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow6-up-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-up-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-up-red" value="arrows/arrow6-up-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow6-up-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-up-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-up-blue" value="arrows/arrow6-up-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow6-up-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow6-up-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow6-up-green" value="arrows/arrow6-up-green.png" /></div>
			</div>

			<div class="jbox">
				<div><label for="arrow8-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-orange" value="arrows/arrow8-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-red" value="arrows/arrow8-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-blue" value="arrows/arrow8-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-green" value="arrows/arrow8-green.png" /></div>
			</div>

			<div class="jbox">
				<div><label for="arrow8-up-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-up-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-up-orange" value="arrows/arrow8-up-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-up-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-up-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-up-red" value="arrows/arrow8-up-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-up-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-up-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-up-blue" value="arrows/arrow8-up-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="arrow8-up-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/arrows/arrow8-up-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="arrow8-up-green" value="arrows/arrow8-up-green.png" /></div>
			</div>

			<div class="clear"></div>
			</fieldset>

			<fieldset style="margin-top:10px">
			<legend>Badges</legend>

			<div class="jbox">
				<div><label for="badges1-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges1-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges1-orange" value="badges/badges1-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges1-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges1-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges1-red" value="badges/badges1-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges1-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges1-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges1-blue" value="badges/badges1-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges1-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges1-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges1-green" value="badges/badges1-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="badges7-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges7-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges7-orange" value="badges/badges7-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges7-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges7-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges7-red" value="badges/badges7-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges7-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges7-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges7-blue" value="badges/badges7-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges7-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges7-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges7-green" value="badges/badges7-green.png" /></div>
			</div>
						
			<div class="jbox">
				<div><label for="badges2-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges2-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges2-orange" value="badges/badges2-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges2-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges2-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges2-red" value="badges/badges2-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges2-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges2-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges2-blue" value="badges/badges2-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges2-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges2-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges2-green" value="badges/badges2-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="badges8-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges8-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges8-orange" value="badges/badges8-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges8-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges8-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges8-red" value="badges/badges8-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges8-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges8-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges8-blue" value="badges/badges8-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges8-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges8-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges8-green" value="badges/badges8-green.png" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="badges3-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges3-orange.png&w=70&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges3-orange" value="badges/badges3-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges3-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges3-red.png&w=70&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges3-red" value="badges/badges3-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges3-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges3-blue.png&w=70&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges3-blue" value="badges/badges3-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges3-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges3-green.png&w=70&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges3-green" value="badges/badges3-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="badges9-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges9-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges9-orange" value="badges/badges9-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges9-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges9-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges9-red" value="badges/badges9-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges9-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges9-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges9-blue" value="badges/badges9-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges9-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges9-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges9-green" value="badges/badges9-green.png" /></div>
			</div>
			
			<div class="jbox">
				<div><label for="badges4-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges4-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges4-orange" value="badges/badges4-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges4-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges4-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges4-red" value="badges/badges4-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges4-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges4-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges4-blue" value="badges/badges4-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges4-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges4-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges4-green" value="badges/badges4-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="badges10-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges10-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges10-orange" value="badges/badges10-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges10-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges10-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges10-red" value="badges/badges10-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges10-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges10-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges10-blue" value="badges/badges10-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges10-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges10-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges10-green" value="badges/badges10-green.png" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="badges5-black"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges5-black.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges5-black" value="badges/badges5-black.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges5-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges5-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges5-red" value="badges/badges5-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges5-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges5-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges5-blue" value="badges/badges5-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges5-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges5-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges5-orange" value="badges/badges5-orange.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="badges11-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges11-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges11-orange" value="badges/badges11-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges11-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges11-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges11-red" value="badges/badges11-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges11-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges11-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges11-blue" value="badges/badges11-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges11-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges11-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges11-green" value="badges/badges11-green.png" /></div>
			</div>
            
			<div class="jbox">
				<div><label for="badges6-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges6-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges6-orange" value="badges/badges6-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges6-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges6-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges6-red" value="badges/badges6-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges6-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges6-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges6-blue" value="badges/badges6-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges6-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges6-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges6-green" value="badges/badges6-green.png" /></div>
			</div>
            
            <div class="jbox">
				<div><label for="badges12-orange"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges12-orange.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges12-orange" value="badges/badges12-orange.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges12-red"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges12-red.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges12-red" value="badges/badges12-red.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges12-blue"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges12-blue.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges12-blue" value="badges/badges12-blue.png" /></div>
			</div>
			<div class="jbox">
				<div><label for="badges12-green"><img src="<?php echo get_bloginfo('template_url'); ?>/thumb.php?src=<?php echo pt_to_relative(PT_REL_IMAGES); ?>/badges/badges12-green.png&w=72&h=&zc=1" border="0" style="cursor:pointer" /></label></div>
				<div style="text-align:center"><input type="radio" name="gpfgraph" id="badges12-green" value="badges/badges12-green.png" /></div>
			</div>


			<div class="clear"></div>
			</fieldset>

		</div>

		<div class="mceActionPanel">
			<input type="submit" id="insert" name="insert" value="{#insert}" />
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onClick="tinyMCEPopup.close();" />
		</div>
	</form>
</body>
</html>