$(document).ready(function() {
    $('#editarCotizacion').on('shown.bs.modal', function () {
		$('#newCotiza_title').trigger('focus')
    });
    
	$('.select2').select2({
		theme: "bootstrap"
    });
    
    $('#cotizaButton').on('click', ()=>{
        const id = $( '#cotizaButton' ).attr('rel');
        const title = $('#cotiza_title').val() || null;
		const cliente = $('#cotiza_cliente').val();
		const coment = $('#cotiza_coment').val();
		const status = $('#cotiza_status').val();
        const factura = $('#cotiza_numfact').val() || 0;
        
        let error = false;
		const data = {
			action: 'edit_cotiza',
			id: id,
			title: title,
			cliente: cliente,
			coment: coment,
			status: status,
			factura: factura
		}; console.log('[DATA]', data);
		if(title === null){
			$('#cotiza_title_error').fadeIn();
			error = true;
		}else{
			$('#cotiza_title_error').fadeOut();
			error = false;
		}

		if(!error){
			$('#loader_new_cotiza').attr('style', 'visibility: visible;');
			jQuery.post(ajaxurl, data, function(response) {
                $('#loader_new_cotiza').attr('style', 'visibility: hidden;');
                $('#editarCotizacion').modal('hide');
			}).fail(function(error) {
				console.log( error );
			});
		}
    });
});