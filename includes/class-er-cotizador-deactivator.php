<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 * @author     Erick Hernandez <erick@erdearrollo.com.ve>
 */
class Er_Cotizador_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;
		$sql = 'DROP TABLE '.$wpdb->prefix.'er_cotizaciones;';
		$wpdb->get_results($sql);
	}

}
