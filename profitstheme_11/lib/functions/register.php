<?php
function pt_widgets_init(){
	if (!function_exists('register_sidebar'))
        	return;

	register_sidebar(
		array(
			'name' => 'sidebar1' 
		)
	);
	register_sidebar(
		array(
			'name' => 'sidebar2'
		)
	);
	register_sidebar(
		array(
			'name' => 'botwidget1'
		)
	);
	register_sidebar(
		array(
			'name' => 'botwidget2'
		)
	);
	register_sidebar(
		array(
			'name' => 'botwidget3'
		)
	);
	register_sidebar(
		array(
			'name' => 'botwidget4'
		)
	);

	register_sidebar(
		array(
			'name' => 'landing page'
		)
	);

	register_sidebar(
		array(
			'name' => 'membership'
		)
	);


}
add_action('init', 'pt_widgets_init');

function pt_menu_init(){
	register_nav_menus(
		array(
			'primary-menu' => __( 'Top Navigation 1' ),
			'secondary-menu' => __( 'Top Navigation 2' ),
			'tertiary-menu' => __( 'Footer Menu' ),
			'member-menu' => __( 'Member Menu' ),
			'non-member-menu' => __( 'Non-Member Menu' ),
		)
	);

}
add_action( 'init', 'pt_menu_init' );
