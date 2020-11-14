<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://erdesarrollo.com.ve
 * @since             1.0.0
 * @package           Er_Cotizador
 *
 * @wordpress-plugin
 * Plugin Name:       Er Cotizador
 * Plugin URI:        https://erdesarrollo.com.ve
 * Description:       Crea cotizaciones de productos para enviar por correo o descargar en PDF con la posibilidad de convertirlas en facturas.
 * Version:           1.0.0
 * Author:            Erick Hernandez
 * Author URI:        https://erdesarrollo.com.ve
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       er-cotizador
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ER_COTIZADOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-er-cotizador-activator.php
 */
function activate_er_cotizador() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-er-cotizador-activator.php';
	Er_Cotizador_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-er-cotizador-deactivator.php
 */
function deactivate_er_cotizador() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-er-cotizador-deactivator.php';
	Er_Cotizador_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_er_cotizador' );
register_deactivation_hook( __FILE__, 'deactivate_er_cotizador' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-er-cotizador.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_er_cotizador() {

	$plugin = new Er_Cotizador();
	$plugin->run();

}
run_er_cotizador();