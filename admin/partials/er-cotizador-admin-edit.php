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
?>

<script type="text/javascript" >
	jQuery(document).ready(function($) {

		var data = {
			'action': 'my_action',
			'whatever': 1234
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
		}).fail(function(error) {
            console.log( error );
        });
	});
</script>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Cotizaciones</a></li>
    <li class="breadcrumb-item active" aria-current="page">Editar</li>
  </ol>
</nav>
<div class="container">
    <div class="card-body">
        <h1 class="display-6"><?php echo __( 'Editar cotizaciones', 'er-cotizador' ); ?></h1>
    </div>
	<div class="row">
		<div class="col">
			<div class="card">
				<h5 class="card-header">Nombre de Empresa</h5>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">Cedula</li>
					<li class="list-group-item">Telefono</li>
					<li class="list-group-item">Correo</li>
					<li class="list-group-item">Ciudad</li>
					<li class="list-group-item">Direccion</li>
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
				<th scope="col"width="15%"><?php echo __( 'Total', 'er-cotizador' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<th>1</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>Otto</td>
				<td>@mdo</td>
				</tr>
				<tr>
				<th>2</th>
				<td>Jacob</td>
				<td>Otto</td>
				<td>Thornton</td>
				<td>@fat</td>
				</tr>
				<tr>
				<th>3</th>
				<td>Larry</td>
				<td>Otto</td>
				<td>the Bird</td>
				<td>@twitter</td>
				</tr>
				<tr class="selectable">
					<th colspan="6"><a href="" id="agregarProd" class="btn btn-primary"><?php echo __( 'Agregar Producto', 'er-cotizador' ); ?></a></th>
				</tr>
			</tbody>
		</table>
		</div>
	</div>
</div>