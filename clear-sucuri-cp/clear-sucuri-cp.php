<?php

/**
 * Clear Sucuri's CloudProxy Cache Plugin
 *
 * This plugin adds a simple link on top of the WordPress admin bar to clear
 * the cache that is stored on CloudProxy servers. It saves you time instead of
 * going to Sucuri' website and doing the manual procedure. Its just a simple click
 * away. I hope you enjoy it!
 *
 * @link              https://salrocks.com/
 * @since             1.0.0
 * @package           Clear_CloudProxy_Cache
 *
 * @wordpress-plugin
 * Plugin Name:       Clear CloudProxy Cache
 * Plugin URI:        http://salrocks.com/
 * Description:       A simple link to clear the CloudProxy Cache
 * Version:           1.0.0
 * Author:            Salvador Aguilar
 * Author URI:        https://salrocks.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:		  /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_clear_cloudproxy_cache() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clear-sucuri-cp-activator.php';
	Clear_CloudProxy_Cache_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_clear_cloudproxy_cache() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clear-sucuri-cp-deactivator.php';
	Clear_CloudProxy_Cache_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_clear_cloudproxy_cache' );
register_deactivation_hook( __FILE__, 'deactivate_clear_cloudproxy_cache' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-clear-sucuri-cp.php';

/**
 * Begins execution of the plugin.
 * @since    1.0.0
 */
function run_Clear_CloudProxy_Cache() {

	$plugin = new Clear_CloudProxy_Cache();
	$plugin->run();

}
run_Clear_CloudProxy_Cache();

/*
* Adding the wp-admin bar menu link.
*/

// Add a parent shortcut link

function custom_toolbar_link($wp_admin_bar) {
	$args = array(
		'id' => 'clear-cloudproxy-cache',
		'title' => 'CloudProxy Cache',
		'href' => '#',
		'meta' => array(
			'class' => 'clear-cloudproxy-wpa-title',
			'title' => 'Go to CloudProxy Dashboard'
		)
	);
	$wp_admin_bar->add_node($args);

// Add the first child link for the Sucuri' CloudProxy Dashboard

	$args = array(
		'id' => 'clear-cloudproxy-cache-waf',
		'title' => 'Go to CloudProxy Dashboard',
		'href' => 'https://waf.sucuri.net',
		'parent' => 'clear-cloudproxy-cache',
		'meta' => array(
			'class' => 'clear-cloudproxy-wpa-link',
			'title' => 'Go to CloudProxy Dashboard'
		)
	);
	$wp_admin_bar->add_node($args);

// Add another child link
	$args = array(
		'id' => 'clear-cloudproxy-cache-purge',
		'title' => 'Clear All CloudProxy Caches',
		'href' => '#',
		'parent' => 'clear-cloudproxy-cache',
		'meta' => array(
			'class' => 'clear-cloudproxy-wpa-link',
			'title' => 'Clear All CloudProxy Caches'
		)
	);
	$wp_admin_bar->add_node($args);

}

add_action('admin_bar_menu', 'custom_toolbar_link', 999);

// Adding the menu link on wp-admin

function clear_sucuri_cp_add_menu_page() {
	add_menu_page(
		__( 'CloudProxy', 'textdomain' ),
		'CloudProxy',
		'manage_options',
		'clear-sucuri-cp',
		'',
		'dashicons-shield',
		66
	);

	add_submenu_page( 'clear-sucuri-cp', 'Sucuri CloudProxy Dashboard', 'Sucuri CloudProxy Dashboard', 'manage_options', 'clear-sucuri-cp-dashboard', 'my_plugin_options');

	add_submenu_page( 'clear-sucuri-cp', 'Settings', 'Settings', 'manage_options', 'clear-sucuri-cp-settings', 'my_plugin_options2');

	add_submenu_page( 'clear-sucuri-cp', 'Donate!', 'Donate!', 'manage_options', 'clear-sucuri-cp-donate', 'my_plugin_options3');

}
add_action( 'admin_menu', 'clear_sucuri_cp_add_menu_page' );

