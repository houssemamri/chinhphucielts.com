<?php
// Define Absolute Paths
define('PT_USE_RELATIVE', false);
define('PT_URL_VALIDATOR', false);
define('PT_LIB', TEMPLATEPATH . '/lib');
define('PT_CLASSES', PT_LIB . '/classes');
define('PT_FUNCTIONS', PT_LIB . '/functions');
define('PT_ADMIN', PT_LIB . '/admin');
define('PT_LAYOUTS', PT_LIB . '/layouts');
define('PT_CSS', PT_LIB . '/css');
define('PT_SCRIPTS', PT_LIB . '/scripts');
define('PT_SKINS', PT_LIB . '/skins');
define('PT_PAYMENT', PT_LIB . '/payment');

// Define Relative Paths
define('PT_REL_SCRIPTS', get_bloginfo('template_url') . '/lib/scripts');
define('PT_REL_CSS', get_bloginfo('template_url')  . '/lib/css');
define('PT_REL_SKINS', get_bloginfo('template_url')  . '/lib/skins');
define('PT_REL_IMAGES', get_bloginfo('template_url')  . '/lib/images');

// PT Version
$pt_version = '1.3.8';

// Init Profits Theme
require_once(PT_LIB . '/init.php');