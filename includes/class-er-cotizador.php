<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/includes
 * @author     Erick Hernandez <erick@erdearrollo.com.ve>
 */
class Er_Cotizador {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Er_Cotizador_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    2.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ER_COTIZADOR_VERSION' ) ) {
			$this->version = ER_COTIZADOR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'er-cotizador';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Er_Cotizador_Loader. Orchestrates the hooks of the plugin.
	 * - Er_Cotizador_i18n. Defines internationalization functionality.
	 * - Er_Cotizador_Admin. Defines all hooks for the admin area.
	 * - Er_Cotizador_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-er-cotizador-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-er-cotizador-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-er-cotizador-admin.php';
		
		/**
		 * Clase responsable del custom post type de cliente.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-er-cotizador-ajax-functions.php';

		$this->loader = new Er_Cotizador_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Er_Cotizador_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Er_Cotizador_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Er_Cotizador_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'er_settings_init' );
		$this->loader->add_filter( 'wp_mail_content_type', $this, 'tipo_de_contenido_html' );

		$this->define_ajax_functions_hooks();
	}

	/**
	 * Hoocks relacionados con las llamadas ajax de las cotizaciones
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_ajax_functions_hooks() {
		$ajax_functions = new Er_Cotizador_Ajax_Functions( $this->get_plugin_name(), $this->get_version() );
		
		$this->loader->add_action( 'wp_ajax_save_cotiza', $ajax_functions, 'save_cotiza' );
		$this->loader->add_action( 'wp_ajax_edit_cotiza', $ajax_functions, 'edit_cotiza' );
		$this->loader->add_action( 'wp_ajax_save_prods', $ajax_functions, 'save_prods' );
		$this->loader->add_action( 'wp_ajax_save_pdf', $ajax_functions, 'save_pdf' );
		$this->loader->add_action( 'wp_ajax_send_cotiza', $ajax_functions, 'send_cotiza' );
		$this->loader->add_action( 'wp_ajax_delete_prod', $ajax_functions, 'delete_prod' );
		$this->loader->add_action( 'wp_ajax_delete_cotiza', $ajax_functions, 'delete_cotiza' );
		$this->loader->add_action( 'wp_ajax_save_cliente', $ajax_functions, 'save_cliente' );
		$this->loader->add_action( 'wp_ajax_delete_cliente', $ajax_functions, 'delete_cliente' );
		$this->loader->add_action( 'wp_ajax_save_producto', $ajax_functions, 'save_producto' );
		$this->loader->add_action( 'wp_ajax_delete_producto', $ajax_functions, 'delete_producto' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Er_Cotizador_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	function tipo_de_contenido_html() {
		return 'text/html';
	}
   

}
