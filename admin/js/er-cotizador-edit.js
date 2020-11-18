$(document).ready(function() {
    $('#editarCotizacion').on('shown.bs.modal', function () {
		$('#newCotiza_title').trigger('focus')
    });
    
	$('.general').select2({
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

    $('#agregarProd').on('click', function(e){
        var clonar = $('.clonar').find(".general");
        if (clonar.data('select2')) {
            clonar.select2('destroy').end();
        }
        var nuevo = $('.clonar').clone().removeClass('clonar');
        nuevo.addClass('elementos');
        nuevo.find('.general').select2({
            placeholder: "Seleccione una opcion.",
            allowClear: true,
            theme: "bootstrap"
        });
        nuevo.find('.general').select2('open');
        nuevo.show();
        $('.clonar').before(nuevo);
        clonar.select2({
            theme: "bootstrap"
        });
        nuevo.find('.general').on('select2:close', function (evt) {
            precio = parseFloat($('option:selected', this).attr('itemprop'));
            iva = parseFloat($('option:selected', this).attr('itemtype'));
            id = parseFloat($('option:selected', this).attr('id'));
            precioTtl = precio;
            if(!iva || iva == NaN){
                nuevo.find('.btn-iva').removeClass('check');
                nuevo.find('.btn-iva').addClass('unchecked');
            }else{
                nuevo.find('.btn-iva').removeClass('unchecked');
                nuevo.find('.btn-iva').addClass('check');
            }
            nombre = $(this).val();
            nuevo.find('.prodSelect').attr('style',"display:none !important");
            nuevo.find('.prodLabel').html(nombre);
            nuevo.find('.inputPrecio').attr('itemprop', precio);
            nuevo.find('.prodLabel').attr('itemid', id);
            nuevo.find('.precioUnitario').html(number_format(precioTtl, 2, ',', '.'));
            nuevo.find('.prodLabel').show();
            calcular_subtotal(nuevo);
        });
        $('.vacio').fadeOut('slow');
        e.preventDefault();
    });

    $('body').on('click', '.prodLabel', function(){
        var $this = $(this);
        var $next = $this.next();
        $this.hide();
        $next.show();
        $next.find('.general').select2("open");
        $next.find('.general').on('click', function (evt) {
            precio = parseFloat($('option:selected', this).attr('itemprop'));
            iva = parseFloat($('option:selected', this).attr('itemtype'));
            id = parseFloat($('option:selected', this).attr('id'));
            precioTtl = precio;
            if(!iva || iva == NaN){
                $this.parent().parent().find('.btn-iva').removeClass('check');
                $this.parent().parent().find('.btn-iva').addClass('unchecked');
            }else{
                $this.parent().parent().find('.btn-iva').removeClass('unchecked');
                $this.parent().parent().find('.btn-iva').addClass('check');
            }
            nombre = $(this).val();
            $next.attr('style',"display:none !important");
            $this.html(nombre);
            $this.attr('itemid', id);
            $this.parent().parent().find('.precioUnitario').html(number_format(precioTtl, 2, ',', '.'));
            $this.show();
            calcular_subtotal($this.parent().parent());
        });
        $next.find('.general').on('close', function (evt) {
            $next.attr('style',"display:none !important");
            $this.show();
        });
    });

    $('body').on('click', '.cantProd', function(){
        var $this = $(this);
        var $next = $this.next();
        $this.hide();
        $next.val($this.html());
        $next.show();
        $next.focus();
        $next.on('blur', function () {
            $next.attr('style',"display:none !important");
            $(this).prev().html('Guardando...');
            $(this).prev().show();
            $this.html($next.val());
            calcular_subtotal($this.parent().parent());
        });
    });
    
    $('body').on('click', '.precioUnitario', function(){
        var $this = $(this);
        var $next = $this.next();
        var $input = $next[0];
        $this.hide();
        $next.val(limpiar_numero($this.html()));
        $next.show();
        $next.focus();
        $next.on('blur', function () {
            $next.attr('style',"display:none !important");
            $(this).prev().html('Guardando...');
            $(this).prev().show();
            cant = $input.value;
            $this.html(number_format($next.val(), 2, ',', '.'));
            calcular_subtotal($this.parent().parent());
        });
    });
    
    $("#descuento").on('change', function(){
        calcular_total();
    });

    function calcular_subtotal(obj){
        ivaConfig = $('#ivaConfig').attr('val');
        valorIva = ivaConfig/100;
        id = obj.attr('itemid');
        cantidad = parseInt(obj.find('.cantProd').html());
        precio = parseFloat(limpiar_numero(obj.find('.precioUnitario').html()));
        precioTotal = cantidad*precio;
        if(obj.find(".btn-iva").hasClass('check')){
            iva = precioTotal*valorIva;
            precioFinal = precioTotal+iva;
        }else{
            iva = 0;
            precioFinal = precioTotal+iva;
        }
        obj.find('.ivaPrecio').html(number_format(iva, 2, ',', '.'));
        obj.find('.precioTotal').html(number_format(precioFinal, 2, ',', '.'));
        calcular_total();
    }
    
    function calcular_total(){
        var $subtotal = 0;
        var $iva = 0;
        var $total = 0;
        var $proveedor = 0;
        var $ttldesc = 0;
		var calcBsS = $("#tipoMoneda").attr('rel');
		var tasa = parseInt($("#tasaActual").attr('rel'));
        var $descuento = parseInt($('#descuento').val());
        ivaConfig = $('#ivaConfig').attr('val');
        valorIva = ivaConfig/100;
        
        $('.elementos').each(function(){
            cantidad = parseInt($(this).find('.cantProd').html());
            precioPro = parseInt($(this).find('.inputPrecio').attr('itemprop'));
            precio = parseFloat(limpiar_numero($(this).find('.precioUnitario').html()));
			if(calcBsS == 1){
				precio = precio*tasa;
				$(this).find('.precioUnitario').html(number_format(precio, 2, ',', '.'));
				calcular_subtotal($(this));
			}
            precioTotal = cantidad*precio;
            precioPro = cantidad*precioPro;
            descuento = 0;
            
            if($descuento > 0){
                descuento = precioTotal * ($descuento/100);
            }
            
            if($(this).find(".btn-iva").hasClass('check')){
                iva = (precioTotal-descuento)*valorIva;
                precioFinal = (precioTotal-descuento)+iva;
            }else{
                iva = 0;
                precioFinal = (precioTotal-descuento)+iva;
            }
            $subtotal = $subtotal + precioTotal;
            $ttldesc = $ttldesc + descuento;
            $iva = $iva + iva;
            $total = $total + precioFinal;
            $proveedor = $proveedor + precioPro;
        });
        $('#subtotalPre').html(number_format($subtotal, 2, ',', '.'));
        $('#subdesc').html(number_format($ttldesc, 2, ',', '.'));
        $('#ivaPre').html(number_format($iva, 2, ',', '.'));
        $('#totalPre').html(number_format($total, 2, ',', '.'));
        $('#gananciaPre').html(number_format($subtotal-$proveedor, 2, ',', '.'));
    }
});

function limpiar_numero(numero){
    numero = numero.replace(/\./g, "");
    numero = numero.replace(/\,/g, ".");
    return numero;
}

function number_format(number, decimals, dec_point, thousands_sep) {

    number = (number + '')
            .replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + (Math.round(n * k) / k)
                        .toFixed(prec);
            };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
            .split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '')
            .length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1)
                .join('0');
    }
    return s.join(dec);
}