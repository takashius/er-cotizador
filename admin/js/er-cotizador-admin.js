$(document).ready(function() {
	$('#example').DataTable();
	$('#nuevaCotizacion').on('shown.bs.modal', function () {
		$('#recipient-name').trigger('focus')
	});
	$('.select2').select2({
		theme: "bootstrap"
	});
} );