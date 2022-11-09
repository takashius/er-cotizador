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
		$tablaCotiza = $wpdb->prefix . "er_cotizaciones";
		$tablaCotizaProd = $wpdb->prefix . "er_cotiza_prods";
		$tablaClientes = $wpdb->prefix . "er_cotiza_clientes";
		$tablaProductos = $wpdb->prefix . "er_productos";

		$query = 'CREATE TABLE '.$tablaCotiza.' ('
		.'`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,'
        .'`titulo` varchar(60) NOT NULL,'
        .'`cliente_id` bigint(20) NOT NULL,'
        .'`comentarios` text NOT NULL,'
		.'`factura` int NOT NULL DEFAULT 0,'
		.'`invitados` int NOT NULL DEFAULT 0,'
        .'`tasa` float(3,2) NOT NULL DEFAULT 0,'
        .'`fechafactura` varchar(60) NOT NULL,'
		.'`status` tinyint NOT NULL DEFAULT 1,'
		.'`total` double NULL,'
		.'`pordesc` int NULL,'
		.'`montdesc` double NULL,'
        .'`fecha` datetime NOT NULL DEFAULT now()'
        .');';
		$wpdb->get_results($query);

		$query = 'CREATE TABLE '.$tablaCotizaProd.' ('
		.'`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,'
        .'`id_prod` bigint(20) NOT NULL,'
        .'`id_cotiza` bigint(20) NOT NULL,'
        .'`titulo` varchar(60) NOT NULL,'
		.'`precio` float(12,2) NOT NULL,'
		.'`cantidad` int NOT NULL,'
        .'`iva` smallint NOT NULL'
        .');';
		$wpdb->get_results($query);

		$query = 'CREATE TABLE '.$tablaClientes.' ('
		.'`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,'
        .'`titulo` varchar(60) NOT NULL,'
        .'`nombre` varchar(80) NOT NULL,'
        .'`apellido` varchar(80) NULL,'
        .'`cedulaRif` varchar(40) NOT NULL,'
		.'`ciudad` varchar(80) NULL,'
		.'`correo` varchar(60) NOT NULL,'
		.'`telefono` varchar(20) NULL,'
		.'`direccion` varchar(100) NOT NULL,'
        .'`direccionCont` varchar(100) NULL,'
		.'`status` tinyint NOT NULL DEFAULT 1,'
        .'`fecha` datetime NOT NULL DEFAULT now()'
        .');';
		$wpdb->get_results($query);

		$query = 'CREATE TABLE '.$tablaProductos.' ('
		.'`ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,'
        .'`titulo` varchar(60) NOT NULL,'
		.'`precio` float(12,2) NOT NULL,'
		.'`iva` tinyint NOT NULL DEFAULT 0,'
		.'`status` tinyint NOT NULL DEFAULT 1,'
        .'`fecha` datetime NOT NULL DEFAULT now()'
        .');';
		$wpdb->get_results($query);
	}

}
