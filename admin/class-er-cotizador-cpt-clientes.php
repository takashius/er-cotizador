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
class Er_Cotizador_Clientes {

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

    // Register Custom Post Type
	function clientes_post_type() {

		$labels = array(
			'name'                  => _x( 'Clientes', 'Listado de clientes', 'clientes_types' ),
			'singular_name'         => _x( 'Cliente', 'Cliente', 'clientes_types' ),
			'menu_name'             => __( 'Clientes', 'clientes_types' ),
			'name_admin_bar'        => __( 'Clientes', 'clientes_types' ),
			'archives'              => __( 'Item Archives', 'clientes_types' ),
			'attributes'            => __( 'Item Attributes', 'clientes_types' ),
			'parent_item_colon'     => __( 'Parent Item:', 'clientes_types' ),
			'all_items'             => __( 'Clientes', 'clientes_types' ),
			'add_new_item'          => __( 'Agregar cliente', 'clientes_types' ),
			'add_new'               => __( 'Agregar', 'clientes_types' ),
			'new_item'              => __( 'Agregar', 'clientes_types' ),
			'edit_item'             => __( 'Editar', 'clientes_types' ),
			'update_item'           => __( 'Actualizar', 'clientes_types' ),
			'view_item'             => __( 'Ver', 'clientes_types' ),
			'view_items'            => __( 'Ver', 'clientes_types' ),
			'search_items'          => __( 'Buscar', 'clientes_types' ),
			'not_found'             => __( 'No se encontró', 'clientes_types' ),
			'not_found_in_trash'    => __( 'No se encontró en la papelera', 'clientes_types' ),
			'featured_image'        => __( 'Imagen destacada', 'clientes_types' ),
			'set_featured_image'    => __( 'Agregar imagen destacada', 'clientes_types' ),
			'remove_featured_image' => __( 'Quitar imagen destacada', 'clientes_types' ),
			'use_featured_image'    => __( 'Usar imagen destacada', 'clientes_types' ),
			'insert_into_item'      => __( 'Agregar', 'clientes_types' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'clientes_types' ),
			'items_list'            => __( 'Listado', 'clientes_types' ),
			'items_list_navigation' => __( 'Items list navigation', 'clientes_types' ),
			'filter_items_list'     => __( 'Filter items list', 'clientes_types' ),
		);
		$args = array(
			'label'                 => __( 'Cliente', 'clientes_types' ),
			'description'           => __( 'Listado de clientes', 'clientes_types' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail' ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => false,
			'menu_position'         => 0,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => false,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
		);
		register_post_type( 'er-clientes', $args );

    }
    
	function clientes_data() {
		add_meta_box( 'er-cliente-detalle-box', __( 'Datos del cliente', 'er-cotizador' ), array( $this, 'er_clientes_data_callback' ), 'er-clientes' );
	}

	function er_clientes_data_callback( $post ) {
	
		$nombre = get_post_meta( $post->ID, 'nombre', true );
		$apellido = get_post_meta( $post->ID, 'apellido', true );
		$cedula_rif = get_post_meta( $post->ID, 'cedula-rif', true );
		$correo = get_post_meta( $post->ID, 'correo', true );
		$telefono = get_post_meta( $post->ID, 'telefono', true );
		$ciudad = get_post_meta( $post->ID, 'ciudad', true );
		$direccion = get_post_meta( $post->ID, 'direccion', true );
		$direccion2 = get_post_meta( $post->ID, 'direccion-cont', true );
		
		// Usaremos este nonce field más adelante cuando guardemos en twp_save_meta_box()
		wp_nonce_field( 'er_cliente_meta_box', 'er_cliente_nonce' );
		?>
		<div class="container">
			<div class="row">
				<div class="col-sm form-group">
					<label for="clienteNombre">Nombre</label>
					<input type="text" value="<?php echo $nombre; ?>" class="form-control" id="clienteNombre" name="clienteNombre">
				</div>
				<div class="col-sm form-group">
				<label for="clienteApellido">Apellido</label>
					<input type="text" value="<?php echo $apellido; ?>" class="form-control" id="clienteApellido" name="clienteApellido">
				</div>
			</div>
			<div class="row">
				<div class="col-sm form-group">
					<label for="clienteCedulaRif">Cédula/Rif</label>
					<input type="text" value="<?php echo $cedula_rif; ?>" class="form-control" id="clienteCedulaRif" name="clienteCedulaRif">
				</div>
				<div class="col-sm form-group">
				<label for="clienteCiudad">Ciudad</label>
					<input type="tel" value="<?php echo $ciudad; ?>" class="form-control" id="clienteCiudad" name="clienteCiudad">
				</div>
			</div>
			<div class="row">
				<div class="col-sm form-group">
					<label for="clienteCorreo">Correo</label>
					<input type="email" value="<?php echo $correo; ?>" class="form-control" id="clienteCorreo" name="clienteCorreo">
				</div>
				<div class="col-sm form-group">
				<label for="clienteTelefono">Teléfono</label>
					<input type="tel" value="<?php echo $telefono; ?>" class="form-control" id="clienteTelefono" name="clienteTelefono">
				</div>
			</div>
			<div class="row">
				<div class="col-sm form-group">
					<label for="clienteDir1">Dirección</label>
					<input type="text" value="<?php echo $direccion; ?>" class="form-control" id="clienteDir1" name="clienteDir1">
				</div>
			</div>
			<div class="row">
				<div class="col-sm form-group">
					<label for="clienteDir2">Dirección 2</label>
					<input type="text" value="<?php echo $direccion2; ?>" class="form-control" id="clienteDir2" name="clienteDir2">
				</div>
			</div>
		</div>
		<?php
		
	}

	function er_clientes_save_meta_box( $post_id ) {
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if( !isset( $_POST['er_cliente_nonce'] ) || !wp_verify_nonce( $_POST['er_cliente_nonce'], 'er_cliente_meta_box' ) ) return;
		if( !current_user_can( 'edit_post' ) ) return;
		
		if( isset( $_POST['clienteNombre'] ) )
			update_post_meta( $post_id, 'nombre', $_POST['clienteNombre'] );
		if( isset( $_POST['clienteApellido'] ) )
			update_post_meta( $post_id, 'apellido', $_POST['clienteApellido'] );
		if( isset( $_POST['clienteCedulaRif'] ) )
			update_post_meta( $post_id, 'cedula-rif', $_POST['clienteCedulaRif'] );
		if( isset( $_POST['clienteCorreo'] ) )
			update_post_meta( $post_id, 'correo', $_POST['clienteCorreo'] );
		if( isset( $_POST['clienteTelefono'] ) )
			update_post_meta( $post_id, 'telefono', $_POST['clienteTelefono'] );
		if( isset( $_POST['clienteCiudad'] ) )
			update_post_meta( $post_id, 'ciudad', $_POST['clienteCiudad'] );
		if( isset( $_POST['clienteDir1'] ) )
			update_post_meta( $post_id, 'direccion', $_POST['clienteDir1'] );
		if( isset( $_POST['clienteDir2'] ) )
			update_post_meta( $post_id, 'direccion-cont', $_POST['clienteDir2'] );
    }

	function list_clientes_posts_columns( $column_name, $post_id ) {
    
		$meta = get_post_meta($post_id);
		
		switch( $column_name ):
			case 'nombre':
				echo $meta['nombre'][0];
				break;
			case 'apellido':
				echo $meta['apellido'][0];
				break;
			case 'cedula':
				echo $meta['cedula-rif'][0];
				break;
			case 'correo':
				echo $meta['correo'][0];
				break;
		endswitch;
		
    }
    
	function set_clientes_columns( $defaults ) {
		$defaults = array(
            'cb' => $columns['cb'],
        );
		$defaults['title']      = __('Cliente'); // Cambio el nombre de la columna Cliente
		$defaults['nombre']     = __('Nombre');
		$defaults['apellido']   = __('Apellido');
		$defaults['cedula']     = __('Cedula/Rif');
		$defaults['correo']     = __('Correo');
	
		return $defaults;
    }
    
}