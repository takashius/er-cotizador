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
		if(get_current_screen()->base == "toplevel_page_er-cotizador" || get_current_screen()->base == "cotizaciones_page_er-clientes" || get_current_screen()->base == "cotizaciones_page_er-productos"){
			wp_enqueue_style( "DataTables-min", plugin_dir_url( __FILE__ ) . 'css/datatables.min.css', array('boostrap-min'), "1.10.22", 'all' );
		}
		wp_enqueue_style( "jquery.notyfy", plugin_dir_url( __FILE__ ) . 'css/jquery.notyfy.css', array(), $this->version, 'all' );
		wp_enqueue_style( "jquery.notyfy-themes", plugin_dir_url( __FILE__ ) . 'css/jquery.notyfy-themes.default.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wp-color-picker' );
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
		wp_enqueue_script( "jquery.notyfy", plugin_dir_url( __FILE__ ) . 'js/jquery.notyfy.js', array( 'jquery-min' ), $this->version, false );
		if(get_current_screen()->base == "toplevel_page_er-cotizador" || get_current_screen()->base == "cotizaciones_page_er-clientes" || get_current_screen()->base == "cotizaciones_page_er-productos"){
			wp_enqueue_script( "DataTables-min", plugin_dir_url( __FILE__ ) . 'js/datatables.min.js', array( 'jquery-min', 'bootstrap-min' ), "1.10.22", false );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/er-cotizador-admin.js', array( 'jquery-min' ), $this->version, false );
		}
		if(get_current_screen()->base == "admin_page_er-cotizador-edit"){
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/er-cotizador-edit.js', array( 'jquery-min', 'jquery.notyfy' ), $this->version, false );
		}
		wp_enqueue_script( "bootbox", 'https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js', array( 'jquery-min' ), "5.4.0", 'all' );
    	wp_enqueue_media();
		wp_enqueue_script( "Select2", plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array( 'jquery-min' ), "4.1.0", false );
		wp_enqueue_script( "page-config", plugin_dir_url( __FILE__ ) . 'js/page-config.js', array( 'jquery-min', 'wp-color-picker' ), $this->version, false );
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
			'dashicons-chart-bar',
			27
		);
		add_submenu_page(
			'er-cotizador',
			__( 'Clientes', 'er-cotizador' ), 
			__( 'Clientes', 'er-cotizador' ),
			'manage_options', 
			'er-clientes',
			array( $this, 'home_clientes' ));
		add_submenu_page(
			'er-cotizador',
			__( 'Productos', 'er-cotizador' ), 
			__( 'Productos', 'er-cotizador' ),
			'manage_options', 
			'er-productos',
			array( $this, 'home_productos' ));
		add_submenu_page(
			'edit.php?post_type=er-clientes',
			__( 'Editar Cotizacion', 'er-cotizador' ), 
			__( 'Editar Cotizacion', 'er-cotizador' ), 
			"manage_options", 
			'er-cotizador-edit', 
			array( $this, 'edit_page' )
		);
		add_submenu_page(
			'edit.php?post_type=er-clientes',
			__( 'Editar Cotizacion', 'er-cotizador' ), 
			__( 'Editar Cotizacion', 'er-cotizador' ), 
			"manage_options", 
			'er-cotizador-pdf', 
			array( $this, 'show_pdf' )
		);
		add_options_page( 
			'Cotizador', 
			'Cotizador', 
			'manage_options', 
			'er-cotizador-options', 
			array( $this, 'er_options_page' ) );
	}

	function er_settings_init(  ) { 

		register_setting( 'erCotizador', 'er_settings' );
	
		add_settings_section(
			'er_erCotizador_section', 
			__( 'Configuracion de plugin', 'er-cotizador' ), 
			array( $this, 'er_settings_section_callback' ), 
			'erCotizador'
		);
	
		add_settings_section(
			'er_erCotizador_money_section', 
			__( 'Asuntos financieros', 'er-cotizador' ), 
			array( $this, 'er_settings_money_section_callback' ), 
			'erCotizador'
		);
	
		add_settings_section(
			'er_erCotizador_colors_mail', 
			__( 'Colores para correo', 'er-cotizador' ), 
			array( $this, 'er_settings_colors_mail_callback' ), 
			'erCotizador'
		);
	
		add_settings_field( 
			'er_name', 
			__( 'Nombre de la empresa', 'er-cotizador' ), 
			array( $this, 'er_name_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_rif', 
			__( 'RIF de la empresa', 'er-cotizador' ), 
			array( $this, 'er_rif_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_dir_ln_1', 
			__( 'Direccion', 'er-cotizador' ), 
			array( $this, 'er_dir_ln_1_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_dir_ln_2', 
			__( 'Direccion (Ln 2)', 'er-cotizador' ), 
			array( $this, 'er_dir_ln_2_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_tel', 
			__( 'Telefono', 'er-cotizador' ), 
			array( $this, 'er_tel_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_mail', 
			__( 'Correo', 'er-cotizador' ), 
			array( $this, 'er_mail_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_logo', 
			__( 'Logo', 'er-cotizador' ), 
			array( $this, 'er_logo_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_logo_pos', 
			__( 'Logo posicion', 'er-cotizador' ), 
			array( $this, 'er_logo_posicion_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_logo_tam', 
			__( 'Logo tamaño (%)', 'er-cotizador' ), 
			array( $this, 'er_logo_tam_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_banner_pos', 
			__( 'Posicion Marca de agua', 'er-cotizador' ), 
			array( $this, 'er_banner_posicion_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_banner_tam', 
			__( 'Tamaño Marca de agua (%)', 'er-cotizador' ), 
			array( $this, 'er_banner_tam_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_banner', 
			__( 'Banner para correo', 'er-cotizador' ), 
			array( $this, 'er_banner_render' ), 
			'erCotizador', 
			'er_erCotizador_section' 
		);
	
		add_settings_field( 
			'er_iva', 
			__( 'Impuesto al Valor Agregado (IVA)', 'er-cotizador' ), 
			array( $this, 'er_iva_render' ), 
			'erCotizador', 
			'er_erCotizador_money_section' 
		);
	
		add_settings_field( 
			'er_moneda', 
			__( 'Simbolo de moneda', 'er-cotizador' ), 
			array( $this, 'er_moneda_render' ), 
			'erCotizador', 
			'er_erCotizador_money_section' 
		);
	
		add_settings_field( 
			'er_costo_pxp', 
			__( 'Costo por persona', 'er-cotizador' ), 
			array( $this, 'er_costo_pxp_render' ), 
			'erCotizador', 
			'er_erCotizador_money_section' 
		);
	
		add_settings_field( 
			'er_color_ppl', 
			__( 'Color Principal', 'er-cotizador' ), 
			array( $this, 'er_color_ppl_render' ), 
			'erCotizador', 
			'er_erCotizador_colors_mail' 
		);
	
		add_settings_field( 
			'er_color_sec', 
			__( 'Color Secundario', 'er-cotizador' ), 
			array( $this, 'er_color_sec_render' ), 
			'erCotizador', 
			'er_erCotizador_colors_mail' 
		);
	
		add_settings_field( 
			'er_color_bg', 
			__( 'Color de fondo', 'er-cotizador' ), 
			array( $this, 'er_color_bg_render' ), 
			'erCotizador', 
			'er_erCotizador_colors_mail' 
		);
	
		add_settings_field( 
			'er_color_title', 
			__( 'Color de titulos', 'er-cotizador' ), 
			array( $this, 'er_color_title_render' ), 
			'erCotizador', 
			'er_erCotizador_colors_mail' 
		);
	}

	function er_name_render(  ) { 

		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_name]' value='<?php echo $options['er_name']; ?>'>
		<?php
	
	}
	
	
	function er_rif_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_rif]' value='<?php echo $options['er_rif']; ?>'>
		<?php
	
	}
	
	
	function er_dir_ln_1_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_dir_ln_1]' value='<?php echo $options['er_dir_ln_1']; ?>'>
		<?php
	
	}
	
	
	function er_dir_ln_2_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_dir_ln_2]' value='<?php echo $options['er_dir_ln_2']; ?>'>
		<?php
	
	}
	
	
	function er_tel_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_tel]' value='<?php echo $options['er_tel']; ?>'>
		<?php
	
	}
	
	
	function er_mail_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_mail]' value='<?php echo $options['er_mail']; ?>'>
		<?php
	
	}
	
	
	function er_logo_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input id="er_logo" type="hidden" name="er_settings[er_logo]" value="<?php echo $options['er_logo']; ?>" />
		<img src="<?php echo $options['er_logo']?>" width="100">
		<input type="button" class="button-primary upload_image_button" rel="er_logo" value="<?php echo __( 'Seleccionar imagen', 'er-cotizador' ) ?>" />
		<?php
	
	}
	
	function er_logo_posicion_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' placeholder="Pos X" name='er_settings[er_logo_pos_x]' value='<?php echo $options['er_logo_pos_x']?$options['er_logo_pos_x']:"10"; ?>'>
		<input type='text' placeholder="Pos Y" name='er_settings[er_logo_pos_y]' value='<?php echo $options['er_logo_pos_y']?$options['er_logo_pos_y']:"8"; ?>'>
		<?php
	
	}
	
	function er_logo_tam_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' placeholder="" class="regular-text" name='er_settings[er_logo_tam]' value='<?php echo $options['er_logo_tam']?$options['er_logo_tam']:"33"; ?>'>
		<?php
	
	}
	
	function er_banner_posicion_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' placeholder="Pos X" name='er_settings[er_banner_pos_x]' value='<?php echo $options['er_banner_pos_x']?$options['er_banner_pos_x']:"40"; ?>'>
		<input type='text' placeholder="Pos Y" name='er_settings[er_banner_pos_y]' value='<?php echo $options['er_banner_pos_y']?$options['er_banner_pos_y']:"140"; ?>'>
		<?php
	
	}
	
	function er_banner_tam_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' placeholder="" class="regular-text" name='er_settings[er_banner_tam]' value='<?php echo $options['er_banner_tam']?$options['er_banner_tam']:"110"; ?>'>
		<?php
	
	}
	
	
	function er_banner_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input id="er_banner" type="hidden" name="er_settings[er_banner]" value="<?php echo $options['er_banner']; ?>" />
		<img src="<?php echo $options['er_banner']?>" width="100">
		<input type="button" class="button-primary upload_image_button" rel="er_banner" value="<?php echo __( 'Seleccionar imagen', 'er-cotizador' ) ?>" />
		<?php
	
	}
	
	function er_iva_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_iva]' value='<?php echo $options['er_iva']; ?>'>
		<?php
	
	}
	
	function er_moneda_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text" name='er_settings[er_moneda]' value='<?php echo $options['er_moneda']?$options['er_moneda']:'$'; ?>'>
		<?php
	
	}
	
	function er_costo_pxp_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<span class="switch-button">
            <input type="checkbox" name="er_settings[er_costo_pxp]" id="switch-label" class="switch-button__checkbox" <?php echo $options['er_costo_pxp']?'checked="true"':''; ?>>
            <label for="switch-label" class="switch-button__label"></label>
        </span>
		<?php
	
	}
	
	
	function er_color_ppl_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text color-field" name='er_settings[er_color_ppl]' value='<?php echo $options['er_color_ppl']?$options['er_color_ppl']:'#008080'; ?>'  data-default-color='#008080'>
		<?php
	
	}
	
	
	function er_color_sec_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text color-field" name='er_settings[er_color_sec]' value='<?php echo $options['er_color_sec']?$options['er_color_sec']:'#8CF7FC'; ?>'  data-default-color='#8CF7FC'>
		<?php
	
	}
	
	
	function er_color_bg_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text color-field" name='er_settings[er_color_bg]' value='<?php echo $options['er_color_bg']?$options['er_color_bg']:'#2a2a2a'; ?>'  data-default-color='#2a2a2a'>
		<?php
	
	}
	
	
	function er_color_title_render(  ) { 
	
		$options = get_option( 'er_settings' );
		?>
		<input type='text' class="regular-text color-field" name='er_settings[er_color_title]' value='<?php echo $options['er_color_title']?$options['er_color_title']:'#ffffff'; ?>'  data-default-color='#ffffff'>
		<?php
	
	}
	
	
	function er_settings_section_callback(  ) { 
	
		echo __( 'Configura parametros de tu empresa para las facturas y cotizaciones', 'er-cotizador' );
	
	}
	
	
	function er_settings_money_section_callback(  ) { 
	
		echo __( 'Configura parametros relacionados a la moneda y calculos', 'er-cotizador' );
	
	}
	
	
	function er_settings_colors_mail_callback(  ) { 
	
		echo __( 'Seleccione los colores para el correo de presupuesto', 'er-cotizador' );
	
	}
	
	
	function er_options_page(  ) { 
	
			?>
			<form action='options.php' method='post'>
	
				<h2><?php echo __( 'Er-Cotizador', 'er-cotizador' ) ?></h2>
	
				<?php
				settings_fields( 'erCotizador' );
				do_settings_sections( 'erCotizador' );
				submit_button();
				?>
	
			</form>
			<?php
	
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
	public function home_clientes() {

		include_once( 'partials/er-cotizador-clientes-display.php' );

	}

	/**
	 * Register the Menu for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function home_productos() {

		include_once( 'partials/er-cotizador-productos-display.php' );

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
