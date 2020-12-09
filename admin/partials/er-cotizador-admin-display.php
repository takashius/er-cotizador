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
    $sql_clientes = "SELECT `wp_posts`.`ID`, 
    `wp_posts`.`post_title`, 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'nombre') as 'nombre', 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'apellido') as 'apellido', 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'cedula-rif') as 'cedula-rif'
    FROM `wp_posts`
    WHERE 
        `post_type` = 'er-clientes' AND 
        `post_status` = 'publish'
    ORDER BY `post_title`";
    $query_clientes = $wpdb->prepare($sql_clientes);
    $clientes = $wpdb->get_results($query_clientes);

    $sql_cotizaciones = "SELECT 
		`wp_er_cotizaciones`.*, 
		`wp_posts`.`post_title` as 'title', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'cedula-rif') as 'cedulaRif'
	FROM 
		`wp_er_cotizaciones`, `wp_posts` 
	WHERE 
        `wp_er_cotizaciones`.`cliente_id` = `wp_posts`.`ID`";
    $query_cotizaciones = $wpdb->prepare($sql_cotizaciones);
    $cotizaciones = $wpdb->get_results($query_cotizaciones);
?>
<div id="loader_new_cotiza" class="pre-load-web">
    <div class="imagen-load"><div class="preloader"></div> <?php echo __( 'Cargando...', 'er-cotizador' ); ?></div>
</div>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
  </ol>
</nav>
<div class="container">
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h1 class="display-6"><?php echo __( 'Cotizaciones', 'er-cotizador' ); ?></h1>
            </div>
            <div class="col">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#nuevaCotizacion"><?php echo __( 'Nueva cotizacion', 'er-cotizador' ); ?></button>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="listado" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>N°</th>
                    <th><?php echo __( 'Cotizacion', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Cliente', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'RIF', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Fecha', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Acciones', 'er-cotizador' ); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($cotizaciones as $cotiza){?>
                <tr>
                    <td><?php
                        switch($cotiza->status){
                            case 1:
                                echo __( 'Abierta', 'er-cotizador' );
                                break; 
                            case 2:
                                echo __( 'Aprobada', 'er-cotizador' );
                                break; 
                            case 3:
                                echo __( 'Realizada', 'er-cotizador' );
                                break;
                            case 4:
                                echo __( 'Cancelada', 'er-cotizador' );
                                break;
                            default:
                                echo __( 'Abierta', 'er-cotizador' );
                                break;
                        }
                    ?></td>
                    <td><?php echo $cotiza->ID ?></td>
                    <td><?php echo $cotiza->titulo ?></td>
                    <td><?php echo $cotiza->title ?></td>
                    <td><?php echo $cotiza->cedulaRif ?></td>
                    <td><?php echo $cotiza->fecha ?></td>
                    <td style='text-align:center;vertical-align:middle'>
                        <a href="<?php echo get_site_url()."/wp-admin/admin.php?page=er-cotizador-edit&id=".$cotiza->ID; ?>" type="button" class="btn btn-success" aria-label="Left Align">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a type="button" class="btn btn-danger" rel="<?php echo $cotiza->ID ?>" aria-label="Left Align">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                    <?php }
                ?>
                
                
            </tbody>
            <tfoot>
                <tr>
                    <th>Status</th>
                    <th>N°</th>
                    <th><?php echo __( 'Cotizacion', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Cliente', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'RIF', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Fecha', 'er-cotizador' ); ?></th>
                    <th><?php echo __( 'Acciones', 'er-cotizador' ); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="modal fade" id="nuevaCotizacion" tabindex="-1" aria-labelledby="nuevaCotizacionLabel" aria-hidden="true">
        
        <div class="modal-dialog">
            <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title" id="nuevaCotizacionLabel"><?php echo __( 'Nueva cotizacion', 'er-cotizador' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="newCotiza" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="newCotiza_title" class="col-form-label"><?php echo __( 'Titulo de la cotizacion', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="newCotiza_title" required>
                        <div class="invalid-feedback" id="newCotiza_title_error">
                            Coloca un titulo.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newCotiza_cliente" class="col-form-label"><?php echo __( 'Cliente', 'er-cotizador' ); ?></label>
                        <select class="form-control select2" id="newCotiza_cliente" name="state">
                            <?php
                            foreach($clientes as $cliente){
                                echo '<option value="'.$cliente->ID.'">('.$cliente->post_title.') '.$cliente->nombre.' '.$cliente->apellido.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="newCotiza_coment" class="col-form-label"><?php echo __( 'Comentarios:', 'er-cotizador' ); ?></label>
                        <textarea class="form-control" id="newCotiza_coment"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __( 'Cancelar', 'er-cotizador' ); ?></button>
                <button type="button" id="newCotizaButton" rel="<?php echo get_site_url(); ?>" class="btn btn-primary"><?php echo __( 'Guardar cotizacion', 'er-cotizador' ); ?></button>
            </div>
            </div>
        </div>
    </div>
</div>