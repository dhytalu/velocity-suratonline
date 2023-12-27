<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://velocitydeveloper.com
 * @since             1.0.0
 * @package           Velocity_Surat
 *
 * @wordpress-plugin
 * Plugin Name:       Velocity Surat Online
 * Plugin URI:        https://velocitydeveloper.com
 * Description:       Addon plugin for Velocitydeveloper Client
 * Version:           1.0.0
 * Author:            Velocity
 * Author URI:        https://velocitydeveloper.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       velocity-addons
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

if (!defined('VELOCITY_SURAT_VERSION'))		define('VELOCITY_SURAT_VERSION', '1.0.0'); // Plugin version constant
if (!defined('VELOCITY_SURAT_PLUGIN'))		define('VELOCITY_SURAT_PLUGIN', trim(dirname(plugin_basename(__FILE__)), '/')); // Name of the plugin folder eg - 'velocity-toko'
if (!defined('VELOCITY_SURAT_PLUGIN_DIR'))	define('VELOCITY_SURAT_PLUGIN_DIR', plugin_dir_path(__FILE__)); // Plugin directory absolute path with the trailing slash. Useful for using with includes eg - /var/www/html/wp-content/plugins/velocity-toko/
if (!defined('VELOCITY_SURAT_PLUGIN_URL'))	define('VELOCITY_SURAT_PLUGIN_URL', plugin_dir_url(__FILE__)); // URL to the plugin folder with the trailing slash. Useful for referencing src eg - http://localhost/wp/wp-content/plugins/velocity-toko/

// Load everything
$includes = [
	'admin/register-page.php',	// Page Register
	'inc/ajax.php',		// AJAX
	'inc/enqueue.php',	// Load css & js
	'inc/shortcode.php',
	'inc/post-surat.php',	// Post Pengajuan Surat
	'inc/post-surat-metabox.php'	// Metabox Post Pengajuan Surat
];
foreach ($includes as $include) {
	require_once(VELOCITY_SURAT_PLUGIN_DIR . $include);
}

function get_velocitysurat_part($path = null)
{

	if (empty($path))
		return false;

	include(VELOCITY_SURAT_PLUGIN_DIR . $path . '.php');
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}

/**
 * The code that runs during plugin activation.
 * This action is documented in classes/class-velocity-surat-activator.php
 */
function activate_velocity_surat()
{
	require_once plugin_dir_path(__FILE__) . 'classes/class-velocity-surat-activator.php';
	Velocity_Surat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in classes/class-velocity-surat-deactivator.php
 */
function deactivate_velocity_surat()
{
	require_once plugin_dir_path(__FILE__) . 'classes/class-velocity-surat-deactivator.php';
	Velocity_Surat_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_velocity_surat');
register_deactivation_hook(__FILE__, 'deactivate_velocity_surat');
