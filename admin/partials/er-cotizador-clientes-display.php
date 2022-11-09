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
 

    $sql = "SELECT `ID`, `titulo`, `nombre`, `apellido`, `cedulaRif`, `correo`, `telefono`, `fecha`, `ciudad`, `direccion`, `direccionCont` FROM `".$prefix."er_cotiza_clientes` WHERE `status` = 1";
    $query = $wpdb->prepare($sql);
    $clientes = $wpdb->get_results($query);
?>
<div id="loader_new_cotiza" class="pre-load-web">
    <div class="imagen-load"><div class="preloader"></div> <?php echo __( 'Cargando...', 'er-cotizador' ); ?></div>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=er-cotizador">Cotizaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
  </ol>
</nav>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h1 class="display-6"><?php echo __( 'Clientes', 'er-cotizador' ); ?></h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#nuevoCliente"><?php echo __( 'Nuevo cliente', 'er-cotizador' ); ?></button>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="listClientes" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th><?php echo __( 'Titulo', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Nombre', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Cedula/Rif', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Correo', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Telefono', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Fecha', 'er-cotizador' ); ?></th>
                    <th width="70"><?php echo __( 'Acciones', 'er-cotizador' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($clientes as $cliente){
                        $date=date_create($cliente->fecha);
                ?>
                <tr>
                    <td><?php echo $cliente->titulo ?></td>
                    <td><?php echo $cliente->nombre ?> <?php echo $cliente->apellido ?></td>
                    <td><?php echo $cliente->cedulaRif ?></td>
                    <td><?php echo $cliente->correo ?></td>
                    <td><?php echo $cliente->telefono ?></td>
                    <td><?php echo date_format($date,"d/m/Y") ?></td>
                    <td style='text-align:center;vertical-align:middle'>
                        <a type="button" class="btn btn-success" rel='{
                            "id": "<?php echo $cliente->ID ?>",
                            "titulo": "<?php echo $cliente->titulo ?>",
                            "nombre": "<?php echo $cliente->nombre ?>",
                            "apellido": "<?php echo $cliente->apellido ?>",
                            "cedulaRif": "<?php echo $cliente->cedulaRif ?>",
                            "correo": "<?php echo $cliente->correo ?>",
                            "ciudad": "<?php echo $cliente->ciudad ?>",
                            "telefono": "<?php echo $cliente->telefono ?>",
                            "direccion": "<?php echo $cliente->direccion ?>",
                            "direccionCont": "<?php echo $cliente->direccionCont ?>"
                        }' aria-label="Left Align">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a type="button" class="btn btn-danger" rel="<?php echo $cliente->ID ?>" aria-label="Left Align">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php } ?>
                
                
            </tbody>
            <tfoot>
                <tr>
                    <th><?php echo __( 'Titulo', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Nombre', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Cedula/Rif', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Correo', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Telefono', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Fecha', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Acciones', 'er-cotizador' ); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="modal fade" id="nuevoCliente" tabindex="-1" aria-labelledby="nuevoClienteLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="nuevoClienteLabel"><?php echo __( 'Nuevo Cliente', 'er-cotizador' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newCliente" class="needs-validation" novalidate>
                <input type="hidden" id="newCliente_ID">
                    <div class="form-group">
                        <label for="newCliente_titulo" class="col-form-label"><?php echo __( 'Titulo', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="newCliente_titulo">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="newCliente_nombre" class="col-form-label"><?php echo __( 'Nombre', 'er-cotizador' ); ?></label>
                                <input type="text" class="form-control" id="newCliente_nombre" required>
                                <div class="invalid-feedback" id="newCliente_nombre_error">
                                    Nombre del cliente es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="newCliente_apellido" class="col-form-label"><?php echo __( 'Apellido', 'er-cotizador' ); ?></label>
                                <input type="text" class="form-control" id="newCliente_apellido">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="newCliente_cedulaRif" class="col-form-label"><?php echo __( 'Cédula/Rif', 'er-cotizador' ); ?></label>
                                <input type="text" class="form-control" id="newCliente_cedulaRif" required>
                                <div class="invalid-feedback" id="newCliente_cedulaRif_error">
                                    Coloque la cedula o Rif.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="newCliente_ciudad" class="col-form-label"><?php echo __( 'Ciudad', 'er-cotizador' ); ?></label>
                                <input type="text" class="form-control" id="newCliente_ciudad" required>
                                <div class="invalid-feedback" id="newCliente_ciudad_error">
                                    La ciudad es obligatoria.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="newCliente_correo" class="col-form-label"><?php echo __( 'Correo', 'er-cotizador' ); ?></label>
                                <input type="text" class="form-control" id="newCliente_correo" required>
                                <div class="invalid-feedback" id="newCliente_correo_error">
                                    Correo del cliente es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="newCliente_telefono" class="col-form-label"><?php echo __( 'Teléfono', 'er-cotizador' ); ?></label>
                                <input type="text" class="form-control" id="newCliente_telefono">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="newCliente_direccion" class="col-form-label"><?php echo __( 'Dirección', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="newCliente_direccion" required>
                        <div class="invalid-feedback" id="newCliente_direccion_error">
                            La direccion del cliente es obligatoria.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newCliente_direccionCont" class="col-form-label"><?php echo __( 'Dirección L2', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="newCliente_direccionCont">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __( 'Cancelar', 'er-cotizador' ); ?></button>
                <button type="button" id="newClienteButton" rel="<?php echo get_site_url(); ?>" class="btn btn-primary"><?php echo __( 'Guardar cliente', 'er-cotizador' ); ?></button>
            </div>
            </div>
        </div>
    </div>
</div>