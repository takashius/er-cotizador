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
				var isStatusColumn = (($(this).text() == 'Estatus') ? true : false);
				var select = $('<select style="width: 100px;"><option>Abierta</option><option selected="selected">Aprobada</option><option>Realizada</option><option>Cancelada</option></select>')
					.appendTo( $(this).empty() )
					.on( 'change', function () {
						var val = $(this).val();
				
					table.column( i )
						.search( val ? '^'+$(this).val()+'$' : val, true, false )
						.draw();
				} );
				table.column( i )
						.search( "Aprobada" )
						.draw();
			}
		}
	} );

	$('#nuevaCotizacion').on('shown.bs.modal', function () {
		$('#recipient-name').trigger('focus')
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
				$('#loader_new_cotiza').attr('style', 'visibility: hidden;');
			}).fail(function(error) {
				console.log( error );
			});
		}
	});
} );