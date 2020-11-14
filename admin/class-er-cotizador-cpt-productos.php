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
class Er_Cotizador_Productos {

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

    function productos_post_type() {

		$labels = array(
			'name'                  => _x( 'Productos', 'Productos', 'productos_types' ),
			'singular_name'         => _x( 'Producto', 'Producto', 'productos_types' ),
			'menu_name'             => __( 'Productos', 'productos_types' ),
			'name_admin_bar'        => __( 'Productos', 'productos_types' ),
			'archives'              => __( 'Item Archives', 'productos_types' ),
			'attributes'            => __( 'Item Attributes', 'productos_types' ),
			'parent_item_colon'     => __( 'Parent Item:', 'productos_types' ),
			'all_items'             => __( 'Productos', 'productos_types' ),
			'add_new_item'          => __( 'Agregar producto', 'productos_types' ),
			'add_new'               => __( 'Agregar', 'productos_types' ),
			'new_item'              => __( 'Agregar', 'productos_types' ),
			'edit_item'             => __( 'Editar', 'productos_types' ),
			'update_item'           => __( 'Actualizar', 'productos_types' ),
			'view_item'             => __( 'Ver', 'productos_types' ),
			'view_items'            => __( 'Ver', 'productos_types' ),
			'search_items'          => __( 'Buscar', 'productos_types' ),
			'not_found'             => __( 'No se encontró', 'productos_types' ),
			'not_found_in_trash'    => __( 'No se encontró en la papelera', 'productos_types' ),
			'featured_image'        => __( 'Imagen destacada', 'productos_types' ),
			'set_featured_image'    => __( 'Agregar imagen destacada', 'productos_types' ),
			'remove_featured_image' => __( 'Quitar imagen destacada', 'productos_types' ),
			'use_featured_image'    => __( 'Usar imagen destacada', 'productos_types' ),
			'insert_into_item'      => __( 'Agregar', 'productos_types' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'productos_types' ),
			'items_list'            => __( 'Listado', 'productos_types' ),
			'items_list_navigation' => __( 'Items list navigation', 'productos_types' ),
			'filter_items_list'     => __( 'Filter items list', 'productos_types' ),
		);
		$args = array(
			'label'                 => __( 'Producto', 'productos_types' ),
			'description'           => __( 'Listado de productos', 'productos_types' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
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
		register_post_type( 'er-productos', $args );

    }
    
	function productos_data() {
		add_meta_box( 'er-produto-detalle-box', __( 'Datos del producto', 'er-cotizador' ), array( $this, 'er_productos_data_callback' ), 'er-productos' );
    }
    
    function er_productos_data_callback( $post ) {
	
		$precio = get_post_meta( $post->ID, 'prodPrecio', true );
		$visible = get_post_meta( $post->ID, 'prodVisible', true );
		$iva = get_post_meta( $post->ID, 'prodIva', true );
		
		// Usaremos este nonce field más adelante cuando guardemos en twp_save_meta_box()
		wp_nonce_field( 'er_producto_meta_box', 'er_producto_nonce' );
		?>
		<div class="container">
			<div class="row">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Precio" name="productoPrecio" value="<?php echo $precio; ?>" >
                    <div class="input-group-append">
                        <span class="input-group-text">.00</span>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-sm">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" value="visible" <?php echo $visible?"checked":""; ?> class="custom-control-input" id="prodcutoVisible" name="prodcutoVisible">
                        <label class="custom-control-label" for="prodcutoVisible">¿Es visible?</label>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" value="iva" <?php echo $iva?"checked":""; ?> class="custom-control-input" id="productoIva" name="productoIva">
                        <label class="custom-control-label" for="productoIva">¿Este producto genera IVA?</label>
                    </div>
                </div>
            </div>
		</div>
		<?php
		
	}

	function er_productos_save_meta_box( $post_id ) {
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if( !isset( $_POST['er_producto_nonce'] ) || !wp_verify_nonce( $_POST['er_producto_nonce'], 'er_producto_meta_box' ) ) return;
		if( !current_user_can( 'edit_post' ) ) return;
		
		if( isset( $_POST['productoPrecio'] ) )
			update_post_meta( $post_id, 'prodPrecio', $_POST['productoPrecio'] );
        if( isset( $_POST['prodcutoVisible'] ) ){
            update_post_meta( $post_id, 'prodVisible', true );
        }else{
            update_post_meta( $post_id, 'prodVisible', false );
        }
		if( isset( $_POST['productoIva'] ) ){
            update_post_meta( $post_id, 'prodIva', true );
        }else{
            update_post_meta( $post_id, 'prodIva', false );
        }
    }

    function crear_productos_taxonomies() {
        $labels = array(
          'name'             => _x( 'Rubros', 'taxonomy general name' ),
          'singular_name'    => _x( 'Rubro', 'taxonomy singular name' ),
          'search_items'     =>  __( 'Buscar por Rubro' ),
          'all_items'        => __( 'Todos los Rubros' ),
          'parent_item'      => __( 'Rubro padre' ),
          'parent_item_colon'=> __( 'Rubro padre:' ),
          'edit_item'        => __( 'Editar Rubro' ),
          'update_item'      => __( 'Actualizar Rubro' ),
          'add_new_item'     => __( 'Añadir nuevo Rubro' ),
          'new_item_name'    => __( 'Nombre del nuevo Rubro' ),
        );
        
        /* Registramos la taxonomía y la configuramos como jerárquica (al estilo de las categorías) */
        register_taxonomy( 'rubro', array( 'er-productos' ), array(
          'hierarchical'       => true,
          'labels'             => $labels,
          'show_ui'            => true,
          'query_var'          => true,
          'rewrite'            => array( 'slug' => 'rubro' ),
        ));
        
        /* Si quieres añadir la siguiente taxonomía del ejemplo, sustituye esta línea por la del código correspondiente */
        
      }

}