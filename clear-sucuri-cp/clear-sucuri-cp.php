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
 * @package           Clear-CloudProxy-Cache
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
function activate_clear_sucuri_cp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clear_sucuri_cp-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-clear_sucuri_cp-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_clear_sucuri_cp' );
register_deactivation_hook( __FILE__, 'deactivate_clear_sucuri_cp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-clear_sucuri_cp.php';

/**
 * Begins execution of the plugin.
 * @since    1.0.0
 */
function run_clear_sucuri_cp() {

	$plugin = new clear_sucuri_cp();
	$plugin->run();

}
run_clear_sucuri_cp();

/*
* Adding the wp-admin bar menu link.
*/

// Add a parent shortcut link

function custom_toolbar_link($wp_admin_bar) {
	$args = array(
		'id' => 'clear-cloudproxy-cache',
		'title' => 'Clear CloudProxy',
		'href' => 'https://waf.sucuri.net',
		'meta' => array(
			'class' => 'clear-cloudproxy-wpa-title',
			'title' => 'Go to CloudProxy Dashboard'
		)
	);
	$wp_admin_bar->add_node($args);

// Add the first child link

	$args = array(
		'id' => 'wpbeginner-guides',
		'title' => 'WPBeginner Guides',
		'href' => 'http://www.wpbeginner.com/category/beginners-guide/',
		'parent' => 'wpbeginner',
		'meta' => array(
			'class' => 'wpbeginner-guides',
			'title' => 'Visit WordPress Beginner Guides'
		)
	);
	$wp_admin_bar->add_node($args);

// Add another child link
	$args = array(
		'id' => 'wpbeginner-tutorials',
		'title' => 'WPBeginner Tutorials',
		'href' => 'http://www.wpbeginner.com/category/wp-tutorials/',
		'parent' => 'wpbeginner',
		'meta' => array(
			'class' => 'wpbeginner-tutorials',
			'title' => 'Visit WPBeginner Tutorials'
		)
	);
	$wp_admin_bar->add_node($args);

// Add a child link to the child link

	$args = array(
		'id' => 'wpbeginner-themes',
		'title' => 'WPBeginner Themes',
		'href' => 'http://www.wpbeginner.com/category/wp-themes/',
		'parent' => 'wpbeginner-tutorials',
		'meta' => array(
			'class' => 'wpbeginner-themes',
			'title' => 'Visit WordPress Themes Tutorials on WPBeginner'
		)
	);
	$wp_admin_bar->add_node($args);

}

add_action('admin_bar_menu', 'custom_toolbar_link', 999);
