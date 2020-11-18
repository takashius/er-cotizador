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
	$id = $_GET['id'];
	$sql = "SELECT 
		`wp_er_cotizaciones`.*, 
		`wp_posts`.`post_title`, 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'nombre') as 'nombre', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'apellido') as 'apellido', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'cedula-rif') as 'cedulaRif', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'correo') as 'correo', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'telefono') as 'telefono', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'ciudad') as 'ciudad', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'direccion') as 'direccion', 
		(SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'direccion-cont') as 'direccionCont'
	FROM 
		`wp_er_cotizaciones`, `wp_posts` 
	WHERE `wp_er_cotizaciones`.`ID` = '$id' 
		AND `wp_er_cotizaciones`.`cliente_id` = `wp_posts`.`ID`";
	$query = $wpdb->prepare($sql); 
	$cotizacion = $wpdb->get_results($query);
	$cotiza = $cotizacion[0];

	$sql_clientes = "SELECT `wp_posts`.`ID`, 
    `wp_posts`.`post_title`, 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'nombre') as 'nombre', 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'apellido') as 'apellido'
    FROM `wp_posts`
    WHERE 
        `post_type` = 'er-clientes' AND 
        `post_status` = 'publish'
    ORDER BY `post_title`";
    $query_clientes = $wpdb->prepare($sql_clientes);
    $clientes = $wpdb->get_results($query_clientes);

	$sql_productos = "SELECT `wp_posts`.`ID`, 
    `wp_posts`.`post_title` as 'title', 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'prodPrecio') as 'precio', 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'prodVisible') as 'visible', 
    (SELECT `meta_value` FROM `wp_postmeta` WHERE `wp_postmeta`.`post_id` = `wp_posts`.`ID` AND `wp_postmeta`.`meta_key` = 'prodIva') as 'iva'
    FROM `wp_posts`
    WHERE 
        `post_type` = 'er-productos' AND 
        `post_status` = 'publish'
    ORDER BY `post_title`";
    $query_productos = $wpdb->prepare($sql_productos);
    $productos = $wpdb->get_results($query_productos);
?>


<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo get_site_url(); ?>/wp-admin/admin.php?page=er-cotizador">Cotizaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
  </ol>
</nav>
<div class="container" id="ivaConfig" val="12">
    <div class="card-body">
		<div class="row">
			<div class="col">
				<h1><?php echo __( 'Editar cotizacion', 'er-cotizador' ); ?></h1>
			</div>
			<div class="col">
				<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#editarCotizacion">
				<i class="fa fa-cogs"></i> <?php echo __( 'Ajustes', 'er-cotizador' ); ?>
				</button>
			</div>
		</div>
    </div>
	<div class="row">
		<div class="col">
			<div class="card">
				<h5 class="card-header"><?php echo $cotiza->post_title ?></h5>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Cedula/Rif: <?php echo $cotiza->cedulaRif ?></li>
					<li class="list-group-item">Telefono: <?php echo $cotiza->telefono ?></li>
					<li class="list-group-item">Correo: <?php echo $cotiza->correo ?></li>
					<li class="list-group-item">Ciudad: <?php echo $cotiza->ciudad ?></li>
					<li class="list-group-item">Direccion:  <?php echo $cotiza->direccion ?> - <?php echo $cliente->direccionCont ?></li>
				</ul>
			</div>
		</div>
		<div class="col">
			<div>
				<div class="card">
					<button type="button" class="btn btn-primary btn-lg btn-block"><?php echo __( 'Guardar cotizacion', 'er-cotizador' ); ?></button>
					<button type="button" class="btn btn-secondary btn-lg btn-block"><?php echo __( 'Guardar y enviar', 'er-cotizador' ); ?></button>
					<button type="button" class="btn btn-secondary btn-lg btn-block"><?php echo __( 'Enviar al cliente', 'er-cotizador' ); ?></button>
					<button type="button" class="btn btn-secondary btn-lg btn-block"><?php echo __( 'Nota de Entrega', 'er-cotizador' ); ?></button>
					<button type="button" class="btn btn-secondary btn-lg btn-block"><?php echo __( 'Facturar', 'er-cotizador' ); ?></button>
					<button type="button" class="btn btn-secondary btn-lg btn-block"><?php echo __( 'Facturar (Forma libre)', 'er-cotizador' ); ?></button>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col mt-5"> 
		<table class="table table-bordered">
			<thead class="bg-primary text-white">
				<tr>
				<th scope="col" width="40%"><?php echo __( 'Producto', 'er-cotizador' ); ?></th>
				<th scope="col" width="5%"><?php echo __( 'Cantidad', 'er-cotizador' ); ?></th>
				<th scope="col" width="15%"><?php echo __( 'Precio Unitario', 'er-cotizador' ); ?></th>
				<th scope="col" width="5%"><?php echo __( 'Iva', 'er-cotizador' ); ?></th>
				<th scope="col" width="15%" colspan="2"><?php echo __( 'Total', 'er-cotizador' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr class="clonar" style="display: none;" itemid="0">
					<td>
                        <span class="prodLabel" style="display:none !important;"></span> 
                        <span class="prodSelect">
                            <select class="general" style="width:100%;">
								<?php foreach($productos as $producto){ ?>
									<option id="<?php echo $producto->ID?>" itemprop="<?php echo $producto->precio?>" itemtype="<?php echo $producto->iva?>"><?php echo $producto->title?></option>
								<?php }?>
                            </select>
                        </span>
					</td>
					<td class="center">
                        <span class="cantProd">1</span>
                        <input type="text" class="tableInput" style='display:none !important;'>
					</td>
					<td class="right">
                        <span class="precioUnitario">0,00</span>
                        <input type="text" class="tableInput inputPrecio" style='display:none !important;'>
					</td>
					<td>
                        <div class="left" style="width: 20%; float: left;"><a href="#" class="btn-action glyphicons check btn-success btn-iva"><i></i></a></div>
                        <div class="right ivaPrecio" style="width: 80%; float: left;">0,00</div>
					</td>
					<td class="right precioTotal">0,00</td>
                    <td class="center" width="40px"><a href="#" class="btn-action glyphicons remove_2 btn-danger"><i></i></a></td>
				</tr>
                <tr class="selectable vacio" style="display: none;">
                    <th colspan="6" class="center">La cotizacion no posee productos</th>
                </tr>
				<tr class="selectable">
					<th colspan="6"><a href="" id="agregarProd" class="btn btn-primary"><?php echo __( 'Agregar Producto', 'er-cotizador' ); ?></a></th>
				</tr>
			</tbody>
		</table>
		<div class="row">
            <div class="col">
                <table class="table table-borderless table-condensed">
                    <tbody>
                        <tr><td colspan="2">&nbsp;</td></tr>
                        <tr>
                            <td>Porcentaje de descuento</td>
                            <td><input type="text" name="descuento" value="" id="descuento" style="width: 50px;" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
            <div class="col">
                <table class="table table-borderless table-condensed cart_total">
                    <tbody>
                        <tr>
                            <td class="right">Subtotal:</td>
                            <td class="right strong" id="subtotalPre"></td>
                        </tr>
                        <tr>
                            <td class="right">Descuento:</td>
                            <td class="right strong" id="subdesc"></td>
                        </tr>
                        <tr>
                            <td class="right">IVA:</td>
                            <td class="right strong" id="ivaPre"></td>
                        </tr>
                        <tr>
                            <td class="right">Total:</td>
                            <td class="right strong" id="totalPre"></td>
                        </tr>
                        <tr id="gananciaElement" style="display: none;">
                            <td class="right">Ganancia:</td>
                            <td class="right strong" id="gananciaPre"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
		</div>
	</div>

	<div class="modal fade" id="editarCotizacion" tabindex="-1" aria-labelledby="editarCotizacionLabel" aria-hidden="true">
        
        <div class="modal-dialog">
            <div class="modal-content">
            <div id="loader_new_cotiza" class="pre-load-web">
                <div class="imagen-load"><div class="preloader"></div> <?php echo __( 'Cargando...', 'er-cotizador' ); ?></div>
            </div>
            <div class="modal-header">
                <h5 class="modal-title" id="editarCotizacionLabel"><?php echo __( 'Ajustes de la cotizacion', 'er-cotizador' ); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCotiza" class="needs-validation" novalidate>
                    <div class="form-group">
                        <label for="cotiza_title" class="col-form-label"><?php echo __( 'Titulo de la cotizacion', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="cotiza_title" value="<?php echo $cotiza->titulo ?>" required>
                        <div class="invalid-feedback" id="cotiza_title_error">
                            Coloca un titulo.
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cotiza_cliente" class="col-form-label"><?php echo __( 'Cliente', 'er-cotizador' ); ?></label>
                        <select class="form-control select2" id="cotiza_cliente" name="state">
                            <?php
                            foreach($clientes as $cliente){
								if($cliente->ID == $cotiza->cliente_id){
									$selected = "selected";
								}else{
									$selected = "";
								}
                                echo '<option value="'.$cliente->ID.'" '.$selected.'>('.$cliente->post_title.') '.$cliente->nombre.' '.$cliente->apellido.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cotiza_status" class="col-form-label"><?php echo __( 'Estatus', 'er-cotizador' ); ?></label>
                        <select class="form-control select2" id="cotiza_status" name="state">
							<option value="1" <?php if($cotiza->status == 1) echo "selected" ?>><?php echo __( 'Abierta', 'er-cotizador' ); ?></option>
							<option value="2" <?php if($cotiza->status == 2) echo "selected" ?>><?php echo __( 'Aprobada', 'er-cotizador' ); ?></option>
							<option value="3" <?php if($cotiza->status == 3) echo "selected" ?>><?php echo __( 'Realizada', 'er-cotizador' ); ?></option>
							<option value="4" <?php if($cotiza->status == 4) echo "selected" ?>><?php echo __( 'Cancelada', 'er-cotizador' ); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cotiza_numfact" class="col-form-label"><?php echo __( 'Numero de factura', 'er-cotizador' ); ?></label>
                        <input type="text" class="form-control" id="cotiza_numfact" value="<?php echo $cotiza->factura ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cotiza_coment" class="col-form-label"><?php echo __( 'Comentarios:', 'er-cotizador' ); ?></label>
                        <textarea class="form-control" id="cotiza_coment"><?php echo $cotiza->comentarios ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo __( 'Cancelar', 'er-cotizador' ); ?></button>
                <button type="button" id="cotizaButton" rel="<?php echo $cotiza->ID ?>" class="btn btn-primary"><?php echo __( 'Guardar cotizacion', 'er-cotizador' ); ?></button>
            </div>
            </div>
        </div>
    </div>

</div>