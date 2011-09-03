<?php
/*
Plugin Name: GD Constant Contact Shortcodes
Plugin URI: http://www.guilddev.com/wordpress-plugins/
Description: This is a plugin that allows you to stick shortcodes into pages or posts in your WordPress site that can be used to allow visitors to sign up to be included in your Constant Contact newsletter lists.
Version: 0.2
Author: Bryan Haddock
Author URI: http://www.guilddev.com
*/

/*  Copyright 2011  Bryan Haddock

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function gd_ccs_includeAdminCSS() {
	echo '<link type="text/css" rel="stylesheet" href="/wp-content/plugins/gd-constant-contact-shortcodes/css/gd-ccs.css" />' . "\n";
}
function gd_ccs_includePublicCSS() {
	echo '<link type="text/css" rel="stylesheet" href="/wp-content/plugins/gd-constant-contact-shortcodes/css/gd-ccs-sc.css" />' . "\n";
}
add_action('admin_head','gd_ccs_includeAdminCSS');
add_action('wp_head','gd_ccs_includePublicCSS');


include("inc/inc_admin_menu_hooks.php");

function register_gd_ccs_settings() { // whitelist options
  register_setting( 'gd_ccs_options_group', 'gd_ccs_username' );
  register_setting( 'gd_ccs_options_group', 'gd_ccs_passwd' );
  register_setting( 'gd_ccs_options_group', 'gd_ccs_apikey' );
  register_setting( 'gd_ccs_options_group', 'gd_ccs_defaultlist' );
  register_setting( 'gd_ccs_options_group', 'gd_ccs_subscribemessage' );
  register_setting( 'gd_ccs_options_group', 'gd_ccs_successmessage' );
}

include("inc/inc_gd_ccs_settings_page.php");
include("inc/inc_display_gd_ccs_form.php");
add_shortcode('gd-ccsform','display_gd_ccs_form');