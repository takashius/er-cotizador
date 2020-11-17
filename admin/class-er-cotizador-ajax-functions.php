<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/admin
 * @author     Erick Hernandez <erick@erdearrollo.com.ve>
 */
class Er_Cotizador_Ajax_Functions {

    /**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
    private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

    }

    function my_action() {
        global $wpdb; // this is how you get access to the database
    
        $whatever = intval( $_POST['whatever'] );
    
        $whatever += 10;
    
            echo $whatever;
    
        wp_die(); // this is required to terminate immediately and return a proper response
    }

    function save_cotiza() {
        global $wpdb; 
    
        $title = $_POST['title'];
        $cliente = $_POST['cliente'];
		$coment = $_POST['coment'];
		
		$array = array(
			"titulo" => $title,
			"cliente_id" => $cliente,
			"comentarios" => $coment
		);
    
		try{
			$wpdb->insert( $wpdb->prefix."er_cotizaciones", $array );
			$lastid = $wpdb->insert_id;
			echo $lastid;
		}catch(Exception $e){
			echo $e;
		}
    
        wp_die();
	}
	
	function edit_cotiza() {
        global $wpdb; 
    
        $id = $_POST['id'];
        $title = $_POST['title'];
        $cliente = $_POST['cliente'];
		$coment = $_POST['coment'];
		$status = $_POST['status'];
		$factura = $_POST['factura'];
		
		$array = array(
			"titulo" => $title,
			"cliente_id" => $cliente,
			"comentarios" => $coment,
			"status" => $status,
			"factura" => $factura
		);

		$where = array(
			"ID" => $id
		);
    
		try{
			$wpdb->update( $wpdb->prefix."er_cotizaciones", $array, $where );
			echo "ok";
		}catch(Exception $e){
			echo $e;
		}

		wp_die();
	}
}