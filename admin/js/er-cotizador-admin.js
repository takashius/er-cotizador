$(document).ready(function() {
	let table = $('#listado, #listClientes, #listProductos').DataTable({
		"aoColumnDefs" : [
			{
			  'bSortable' : false,
			  'aTargets' : [ 0 ]
			}]
	});

	$("#listado thead th").each( function ( i ) {
		if(i == 0){
			if ($(this).text() !== '') {
				var isStatusColumn = (($(this).text() == 'Status') ? true : false);
				var select = $('<select style="width: 100px;"><option selected="selected">Abierta</option><option>Aprobada</option><option>Realizada</option><option>Cancelada</option></select>')
					.appendTo( $(this).empty() )
					.on( 'change', function () {
						let val = $(this).val();
				
					table.column( i )
						.search( val ? '^'+$(this).val()+'$' : val, true, false )
						.draw();
				} );
				table.column( i )
						.search( "Abierta" )
						.draw();
			}
		}
	} );

	$('#nuevaCotizacion').on('shown.bs.modal', function () {
		$('#newCotiza_title').trigger('focus')
	});
	
	$('#nuevoProducto').on('shown.bs.modal', function () {
		const id = $('#newProducto_ID').val() || null;
		if(id){
			$('#nuevoProductoLabel').html("Editar Producto");
		}else{
			$('#nuevoProductoLabel').html("Nuevo Producto");
		}
		$('#newProducto_titulo').trigger('focus')
	});

	$('#nuevoProducto').on('hidden.bs.modal', function () {
		$('#newProducto_ID').val('');
		$('#newProducto_titulo').val('');
		$('#newProducto_precio').val('');
		$('#newProducto_titulo_error').fadeOut();
		$('#newProducto_precio_error').fadeOut();
		$('#newProducto_iva').prop('checked', false);
	});

	$('.select2').select2({
		theme: "bootstrap"
	});

	$('#newCotizaButton').on('click', ()=>{
		const title = $('#newCotiza_title').val() || null;
		const cliente = $('#newCotiza_cliente').val() || null;
		const coment = $('#newCotiza_coment').val();
		const url = $( '#newCotizaButton' ).attr('rel') + "/wp-admin/admin.php?page=er-cotizador-edit";
		let error = false;
		const data = {
			action: 'save_cotiza',
			title: title,
			cliente: cliente,
			coment: coment
		};
		if(title === null){
			$('#newCotiza_title_error').fadeIn();
			error = true;
		}else{
			$('#newCotiza_title_error').fadeOut();
			error = false;
		}

		if(!error){
			$('#loader_new_cotiza').attr('style', 'visibility: visible;');
			jQuery.post(ajaxurl, data, function(response) {
				window.location.href = url + "&id=" + response;
			}).fail(function(error) {
				console.log( error );
			});
		}
	});

	$('#nuevoCliente').on('shown.bs.modal', function () {
		const id = $('#newCliente_ID').val() || null;
		if(id){
			$('#nuevoClienteLabel').html("Editar Cliente");
		}else{
			$('#nuevoClienteLabel').html("Nuevo Cliente");
		}
		$('#newCliente_titulo').trigger('focus')
	});

	$('#nuevoCliente').on('hidden.bs.modal', function () {
		$('#newCliente_ID').val('');
		$('#newCliente_titulo').val('');
		$('#newCliente_nombre').val('');
		$('#newCliente_apellido').val('');
		$('#newCliente_cedulaRif').val('');
		$('#newCliente_ciudad').val('');
		$('#newCliente_correo').val('');
		$('#newCliente_telefono').val('');
		$('#newCliente_direccion').val('');
		$('#newCliente_direccionCont').val('');
		$('#newCliente_nombre_error').fadeOut();
		$('#newCliente_cedulaRif_error').fadeOut();
		$('#newCliente_ciudad_error').fadeOut();
		$('#newCliente_correo_error').fadeOut();
		$('#newCliente_direccion_error').fadeOut();
	});

	const validador = (data, label) => {
		let error = false;
		if(data === null){
			$(label).fadeIn();
			error = true;
		}else{
			$(label).fadeOut();
			error = false;
		}
		return error;
	}

	$('#newProductoButton').on('click', ()=>{
		const id = $('#newProducto_ID').val() || null;
		const titulo = $('#newProducto_titulo').val() || null;
		const precio = $('#newProducto_precio').val() || null;
		let iva = 0;
		
		if($('#newProducto_iva').prop('checked')) iva = 1

		const data = {
			action: 'save_producto',
			id,
			titulo,
			precio,
			iva
		};

		const errorTitulo = validador(titulo, '#newProducto_titulo_error');
		const errorPrecio = validador(precio, '#newProducto_precio_error');

		if(!errorTitulo && !errorPrecio){
			$('#loader_new_cotiza').attr('style', 'visibility: visible;');
			jQuery.post(ajaxurl, data, function(response) {
				location.reload();
			}).fail(function(error) {
				console.log( error );
			});
		}
	});

	$('#listClientes tbody').on( 'click', '.btn-success', function () {
		const $this = $(this);
		const data = JSON.parse($this.attr('rel'));
		$('#newCliente_ID').val(data.id);
		$('#newCliente_titulo').val(data.titulo || '');
		$('#newCliente_nombre').val(data.nombre || '');
		$('#newCliente_apellido').val(data.apellido || '');
		$('#newCliente_cedulaRif').val(data.cedulaRif || '');
		$('#newCliente_ciudad').val(data.ciudad || '');
		$('#newCliente_correo').val(data.correo || '');
		$('#newCliente_telefono').val(data.telefono || '');
		$('#newCliente_direccion').val(data.direccion || '');
		$('#newCliente_direccionCont').val(data.direccionCont || '');

		$('#nuevoCliente').modal('show');
		
	})

	$('#listProductos tbody').on( 'click', '.btn-success', function () {
		const $this = $(this);
		console.log($this.attr("rel"));
		const data = JSON.parse($this.attr("rel"));
		$('#newProducto_ID').val(data.id);
		$('#newProducto_titulo').val(data.titulo || '');
		$('#newProducto_precio').val(data.precio || '');
		if(data.iva == 1){
			$('#newProducto_iva').prop('checked', true);
		}
		$('#nuevoProducto').modal('show');
		
	})

	$('#newClienteButton').on('click', ()=>{
		const id = $('#newCliente_ID').val() || null;
		const nombre = $('#newCliente_nombre').val() || null;
		const titulo = $('#newCliente_titulo').val() || null;
		const apellido = $('#newCliente_apellido').val();
		const cedulaRif = $('#newCliente_cedulaRif').val() || null;
		const ciudad = $('#newCliente_ciudad').val() || null;
		const correo = $('#newCliente_correo').val() || null;
		const telefono = $('#newCliente_telefono').val();
		const direccion = $('#newCliente_direccion').val() || null;
		const direccionCont = $('#newCliente_direccionCont').val();
		const data = {
			action: 'save_cliente',
			id,
			titulo,
			nombre,
			apellido,
			cedulaRif,
			ciudad,
			correo,
			telefono,
			direccion,
			direccionCont
		};
		
		const errorNombre = validador(nombre, '#newCliente_nombre_error');
		const errorCedula = validador(cedulaRif, '#newCliente_cedulaRif_error');
		const errorCiudad = validador(ciudad, '#newCliente_ciudad_error');
		const errorCorreo = validador(correo, '#newCliente_correo_error');
		const errorDirecc = validador(direccion, '#newCliente_direccion_error');

		if(!errorNombre && !errorCedula && !errorCiudad && !errorCorreo && !errorDirecc){
			$('#loader_new_cotiza').attr('style', 'visibility: visible;');
			jQuery.post(ajaxurl, data, function(response) {
				location.reload();
			}).fail(function(error) {
				console.log( error );
			});
		}
	});

	$('#listado tbody').on( 'click', '.btn-danger', function () {
		const $this = $(this);
		bootbox.confirm("&iquest;seguro que desea eliminar esta cotización?", function(result) {
			if(result){
				
				$('#loader_new_cotiza').attr('style', 'visibility: visible;');
				const data = {
					action: 'delete_cotiza',
					id: $this.attr('rel')
				}
				jQuery.post(ajaxurl, data, function(response) {
					$('#loader_new_cotiza').attr('style', 'visibility: none;');
					table
					.row( $this.parents('tr') )
					.remove()
					.draw();
					notificacion("Se ha borrado correctamente", 'success');
				}).fail(function(error) {
					$('#loader_new_cotiza').attr('style', 'visibility: none;');
					console.log( error );
					notificacion("Ocurrio un error al intentar borrar, recargue la página e intente nuevamente", 'error');
				});
			}
		});
		
	} );

	$('#listClientes tbody').on( 'click', '.btn-danger', function () {
		const $this = $(this);
		bootbox.confirm("&iquest;seguro que desea eliminar este cliente?", function(result) {
			if(result){
				
				$('#loader_new_cotiza').attr('style', 'visibility: visible;');
				const data = {
					action: 'delete_cliente',
					id: $this.attr('rel')
				}
				jQuery.post(ajaxurl, data, function(response) {
					$('#loader_new_cotiza').attr('style', 'visibility: none;');
					table
					.row( $this.parents('tr') )
					.remove()
					.draw();
					notificacion("Se ha borrado correctamente", 'success');
				}).fail(function(error) {
					$('#loader_new_cotiza').attr('style', 'visibility: none;');
					console.log( error );
					notificacion("Ocurrio un error al intentar borrar, recargue la página e intente nuevamente", 'error');
				});
			}
		});
		
	} );

	$('#listProductos tbody').on( 'click', '.btn-danger', function () {
		const $this = $(this);
		bootbox.confirm("&iquest;seguro que desea eliminar este producto?", function(result) {
			if(result){
				
				$('#loader_new_cotiza').attr('style', 'visibility: visible;');
				const data = {
					action: 'delete_producto',
					id: $this.attr('rel')
				}
				jQuery.post(ajaxurl, data, function(response) {
					$('#loader_new_cotiza').attr('style', 'visibility: none;');
					table
					.row( $this.parents('tr') )
					.remove()
					.draw();
					notificacion("Se ha borrado correctamente", 'success');
				}).fail(function(error) {
					$('#loader_new_cotiza').attr('style', 'visibility: none;');
					console.log( error );
					notificacion("Ocurrio un error al intentar borrar, recargue la página e intente nuevamente", 'error');
				});
			}
		});
		
	} );


	$("input[id*='newProducto_precio']").keydown(function (event) {


        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || 
            (event.keyCode >= 96 && event.keyCode <= 105) || 
            event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
            event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault(); 
        //if a decimal has been added, disable the "."-button

    });

} );

function notificacion(texto, tipo){
    tipo = (tipo)?tipo:'alert'; // alert|error|success|information|warning|primary|confirm
    var layout = 'bottom';
    notyfy({
        text: texto,
        type: tipo,
        dismissQueue: true,
        layout: layout,
        timeout: 4000,
        buttons: (tipo != 'confirm') ? false : [{
                addClass: 'btn btn-primary', text: 'Ok', onClick: function($notyfy) {
                    $notyfy.close();
                    //return true;
                }
            },
            {
                addClass: 'btn btn-danger', text: 'Cancel', onClick: function($notyfy) {
                    $notyfy.close();
                    //return false;
                }
            }]
    });
    return false;
}