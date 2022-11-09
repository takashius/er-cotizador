<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://erdesarrollo.com.ve
 * @since      1.0.0
 *
 * @package    Er_Cotizador
 * @subpackage Er_Cotizador/admin/partials
 */

    global $wpdb;
    $prefix = $wpdb->prefix;
 

    $sql = "SELECT `ID`, `titulo`, `precio`, `iva` FROM `".$prefix."er_productos` WHERE `status` = 1";
    $query = $wpdb->prepare($sql);
    $productos = $wpdb->get_results($query);
?>
<div id="loader_new_cotiza" class="pre-load-web">
    <div class="imagen-load"><div class="preloader"></div> <?php echo __( 'Cargando...', 'er-cotizador' ); ?></div>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=er-cotizador">Cotizaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
  </ol>
</nav>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h1 class="display-6"><?php echo __( 'Productos', 'er-cotizador' ); ?></h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#nuevoProducto"><?php echo __( 'Nuevo producto', 'er-cotizador' ); ?></button>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="listProductos" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><?php echo __( 'Titulo', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Precio', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Iva', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Fecha', 'er-cotizador' ); ?></th>
                    <th width="70"><?php echo __( 'Acciones', 'er-cotizador' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($productos as $producto){
                        $date=date_create($producto->fecha);
                ?>
                <tr>
                    <td><?php echo $producto->titulo ?></td>
                    <td><?php echo $producto->precio ?></td>
                    <td><?php echo $producto->iva ?></td>
                    <td><?php echo date_format($date,"d/m/Y") ?></td>
                    <td style='text-align:center;vertical-align:middle'>
                        <a type="button" class="btn btn-success" rel='{
                            "id": "<?php echo $producto->ID ?>",
                            "titulo": "<?php echo $producto->titulo ?>",
                            "precio": "<?php echo $producto->precio ?>",
                            "iva": "<?php echo $producto->iva ?>"
                        }' aria-label="Left Align">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a type="button" class="btn btn-danger" rel="<?php echo $producto->ID ?>" aria-label="Left Align">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                
                
            </tbody>
            <tfoot>
                <tr>
                    <th><?php echo __( 'Titulo', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Precio', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Iva', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Fecha', 'er-cotizador' ); ?></th>
                    <th width="70"><?php echo __( 'Acciones', 'er-cotizador' ); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="modal fade" id="nuevoProducto" tabindex="-1" aria-labelledby="nuevoProductoLabel" aria-hidden="true">
        
        <div class="modal-dialog">
            <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoProductoLabel"><?php echo __( 'Nuevo Producto', 'er-cotizador' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newProducto" class="needs-validation" novalidate>
                    <input type="hidden" id="newProducto_ID">
                    <div class="form-group">
                        <label for="newProducto_titulo" class="col-form-label"><?php echo __( 'Titulo', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="newProducto_titulo" required>
                        <div class="invalid-feedback" id="newProducto_titulo_error">
                            El nombre del producto es obligatorio.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newProducto_precio" class="col-form-label"><?php echo __( 'Precio', 'er-cotizador' ); ?></label>
                        <div class="input-group mb-3">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" id="newProducto_precio" required>
                        </div>
                        <div class="invalid-feedback" id="newProducto_precio_error">
                            El precio es obligatorio.
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="form-control" id="newProducto_iva">
                        <label for="newProducto_iva" class="col-form-label"><?php echo __( 'El producto genera iva', 'er-cotizador' ); ?></label>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __( 'Cancelar', 'er-cotizador' ); ?></button>
                <button type="button" id="newProductoButton" rel="<?php echo get_site_url(); ?>" class="btn btn-primary"><?php echo __( 'Guardar producto', 'er-cotizador' ); ?></button>
            </div>
            </div>
        </div>
    </div>
</div>