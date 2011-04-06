<?php

//ADMIN MENU INTERFACES

add_action('admin_menu','gd_ccs_menu');

function gd_ccs_menu() {

	//create new top-level menu
	add_menu_page('GD CC Shortcodes','GD CC Shortcodes','administrator','gd_ccs_settings','gd_ccs_settings_page','/wp-content/plugins/gd-constant-contact-shortcodes/images/gdicon.png');

	//call register settings function
	add_action('admin_init','register_gd_ccs_settings');
}
