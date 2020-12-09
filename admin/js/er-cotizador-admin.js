$(document).ready(function() {
	let table = $('#listado').DataTable({
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