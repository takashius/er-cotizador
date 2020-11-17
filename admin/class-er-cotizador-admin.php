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
class Er_Cotizador_Admin {

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
	 * The current path of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $current_path;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		global $wp;
		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/er-cotizador-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( "boostrap-min", plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), "4.5.3", 'all' );
		wp_enqueue_style( "boostrap-grid-min", plugin_dir_url( __FILE__ ) . 'css/bootstrap-grid.min.css', array(), "4.5.3", 'all' );
		wp_enqueue_style( "font-awesome", 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css', array(), "4.4.0", 'all' );
		if(get_current_screen()->base == "toplevel_page_er-cotizador"){
			wp_enqueue_style( "DataTables-min", plugin_dir_url( __FILE__ ) . 'css/datatables.min.css', array('boostrap-min'), "1.10.22", 'all' );
		}
		wp_enqueue_style( "Select2", plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), "4.1.0", 'all' );
		wp_enqueue_style( "select2-bootstrap-theme", plugin_dir_url( __FILE__ ) . 'css/select2-bootstrap.min.css', array(), "0.1.0", 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( "jquery-min", plugin_dir_url( __FILE__ ) . 'js/jquery-3.5.1.min.js', array( ), "3.5.1", false );
		wp_enqueue_script( "bootstrap-min", plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery-min' ), "1.10.22", false );
		if(get_current_screen()->base == "toplevel_page_er-cotizador"){
			wp_enqueue_script( "DataTables-min", plugin_dir_url( __FILE__ ) . 'js/datatables.min.js', array( 'jquery-min', 'bootstrap-min' ), "1.10.22", false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/er-cotizador-admin.js', array( 'jquery-min' ), $this->version, false );
		}
		if(get_current_screen()->base == "admin_page_er-cotizador-edit"){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/er-cotizador-edit.js', array( 'jquery-min' ), $this->version, false );
		}
		wp_enqueue_script( "Select2", plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array( 'jquery-min' ), "4.1.0", false );
	}

	/**
	 * Register the Menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {
		$key = 'edit.php?post_type=er-clientes';
		add_menu_page(
			__( 'Cotizaciones', 'er-cotizador' ), // Title of the page
			__( 'Cotizaciones', 'er-cotizador' ), // Text to show on the menu link
			'manage_options', // Capability requirement to see the link
			'er-cotizador',
			array( $this, 'home_page' ),
			'dashicons-chart-bar'
		);
		add_submenu_page(
			'er-cotizador',
			__( 'Clientes', 'er-cotizador' ), 
			__( 'Clientes', 'er-cotizador' ),
			'manage_options', 
			'edit.php?post_type=er-clientes');
		add_submenu_page(
			'er-cotizador',
			__( 'Productos', 'er-cotizador' ), 
			__( 'Productos', 'er-cotizador' ),
			'manage_options', 
			'edit.php?post_type=er-productos');
		add_submenu_page(
			'er-cotizador',
			__( 'Rubros', 'er-cotizador' ), 
			__( 'Rubros', 'er-cotizador' ),
			'manage_options', 
			'edit-tags.php?taxonomy=rubro&post_type=er-productos');
		add_submenu_page(
			'edit.php?post_type=er-clientes',
			__( 'Editar Cotizacion', 'er-cotizador' ), 
			__( 'Editar Cotizacion', 'er-cotizador' ), 
			"manage_options", 
			'er-cotizador-edit', 
			array( $this, 'edit_page' )
		);

	}

	/**
	 * Register the Menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function home_page() {

		include_once( 'partials/er-cotizador-admin-display.php' );

	}

	/**
	 * Register the Menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function edit_page() {

		include_once( 'partials/er-cotizador-admin-edit.php' );

	}

}
