<?php

/**
 * Fired during plugin activation
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 * @author     Erick Hernandez <erick@erdearrollo.com.ve>
 */
class Er_Cotizador_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$nombreTabla = $wpdb->prefix . "er_cotizaciones";

		$query = 'CREATE TABLE '.$nombreTabla.' ('
		.'`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,'
        .'`titulo` varchar(60) NOT NULL,'
        .'`cliente_id` bigint(20) NOT NULL,'
        .'`comentarios` text NOT NULL,'
        .'`factura` int NOT NULL,'
        .'`fecha` datetime NOT NULL'
        .');';
		$wpdb->get_results($query);
	}

}
