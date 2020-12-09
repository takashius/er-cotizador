$(document).ready(function() {
    const idCotiza = $("#idCotiza").attr('itemid');
    const urlBase = $('#url_site').attr('item_ref');
    const ivaConfig = $('#ivaConfig').attr('val');

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
		};
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

    calcular_total();

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
                nuevo.find('.btn-iva').find('i').removeClass('fa-check-square');
                nuevo.find('.btn-iva').find('i').addClass('fa-square');
            }else{
                nuevo.find('.btn-iva').find('i').removeClass('fa-square');
                nuevo.find('.btn-iva').find('i').addClass('fa-check-square');
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
                $this.parent().parent().find('.btn-iva').find('i').removeClass('fa-check-square');
                $this.parent().parent().find('.btn-iva').find('i').addClass('fa-square');
            }else{
                $this.parent().parent().find('.btn-iva').find('i').removeClass('fa-square');
                $this.parent().parent().find('.btn-iva').find('i').addClass('fa-check-square');
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

    $(".save-fact").on('click', function(e){
        const data = {
            action: 'save_pdf',
            id: idCotiza,
            presupuesto: false,
            libre: false
        };
        $('#loader').attr('style', 'visibility: visible;');
        save_pdf(data);
        e.preventDefault();
    });

    $(".save-fact-libre").on('click', function(e){
        const data = {
            action: 'save_pdf',
            id: idCotiza,
            presupuesto: false,
            libre: true
        };
        $('#loader').attr('style', 'visibility: visible;');
        save_pdf(data);
        e.preventDefault();
    });

    $(".save-presupuesto").on('click', function(e){
        const data = {
            action: 'save_pdf',
            id: idCotiza,
            presupuesto: true,
            libre: false
        };
        $('#loader').attr('style', 'visibility: visible;');
        save_pdf(data);
        e.preventDefault();
    });

    $(".send_mail").on('click', function(e){
        
        $('#loader').attr('style', 'visibility: visible;');
        send_mail();
        
        e.preventDefault();
    });
    
    $("body").on('click', '.guardar', function(e){
        guardar(false);
        e.preventDefault();
    });
    
    $("body").on('click', '.guardar_enviar', function(e){
        guardar(true);
        e.preventDefault();
    });

    $('body').on('click', '.btn-iva', function(e){
        var $icon = $(this).find('i');
        if($icon.hasClass('fa-square')){
            $icon.removeClass('fa-square');
            $icon.addClass('fa-check-square');
        }else{
            $icon.removeClass('fa-check-square');
            $icon.addClass('fa-square');
        }
        calcular_subtotal($(this).parent().parent().parent());
        e.preventDefault();
    });
    
    $('body').on('click', '.remove_item', function(){
        var $this = $(this);
        bootbox.confirm("&iquest;seguro que desea eliminar el producto de esta cotización?", function(result) {
            if(result)
                quitar_producto($this.parent().parent());
        });
        e.preventDefault();
    });

    function send_mail(){
        const data = {
            action: 'send_cotiza',
            id: idCotiza
        };

        jQuery.post(ajaxurl, data, function(response) {
            $('#loader').attr('style', 'visibility: hidden;');
            notificacion("Se enviado el correo correctamente", 'success');
        }).fail(function(error) {
            $('#loader').attr('style', 'visibility: hidden;');
            console.log( '[ ERROR ]', error );
            notificacion("Ocurrio un error al enviar la factura, recargue la página e intente nuevamente", 'error');
        });
    }

    function save_pdf(data){
        jQuery.post(ajaxurl, data, function(response) {
            $('#loader').attr('style', 'visibility: hidden;');
            notificacion("Se generado la factura correctamente", 'success');
            var link = document.createElement('a');
            link.href = urlBase + '/wp-content/uploads/reporte.pdf';
            link.download = 'factura_' + idCotiza + '.pdf';
            link.dispatchEvent(new MouseEvent('click'));
        }).fail(function(error) {
            $('#loader').attr('style', 'visibility: hidden;');
            console.log( '[ ERROR ]', error );
            notificacion("Ocurrio un error al generar la factura, recargue la página e intente nuevamente", 'error');
        });
    }

    function calcular_subtotal(obj){
        valorIva = ivaConfig/100;
        id = obj.attr('itemid');
        cantidad = parseInt(obj.find('.cantProd').html());
        precio = parseFloat(limpiar_numero(obj.find('.precioUnitario').html()));
        precioTotal = cantidad*precio;
        if(obj.find(".btn-iva").find('i').hasClass('fa-check-square')){
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
        valorIva = ivaConfig/100;
        
        $('.elementos').each(function(){
            cantidad = parseInt($(this).find('.cantProd').html());
            precioPro = parseInt($(this).find('.inputPrecio').attr('itemprop'));
            precio = parseFloat(limpiar_numero($(this).find('.precioUnitario').html()));
            precioTotal = cantidad*precio;
            precioPro = cantidad*precioPro;
            descuento = 0;
            
            if($descuento > 0){
                descuento = precioTotal * ($descuento/100);
            }
            
            if($(this).find(".btn-iva").find('i').hasClass('fa-check-square')){
                iva = (precioTotal)*valorIva;
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
    
    function quitar_producto(obj){
        obj.fadeOut('slow');
        if(obj.attr('itemid') != 0){
            const data = {
                action: 'delete_prod',
                id: obj.attr('itemid')
            };
            jQuery.post(ajaxurl, data, function(response) {
                obj.remove();
                if($('.elementos').length <= 0){
                    $('.vacio').fadeIn('slow');
                }
                calcular_total();
                notificacion("Se ha borrado correctamente", 'success');
            }).fail(function(error) {
                console.log(msj);
                notificacion("Ocurrio un error al intentar borrar, recargue la página e intente nuevamente", 'error');
            });
        }else{
            obj.remove();
            if($('.elementos').length <= 0){
                $('.vacio').fadeIn('slow');
            }
        }
        calcular_total();
    }
    
    function guardar(send){
        const enviar = (send)?true:false;
        let elementos = new Array();
        $('.elementos').each(function(a){
            if($(this).find(".btn-iva").find('i').hasClass('fa-check-square')){
                iva = 1;
            }else{
                iva = 0;
            }
            item = {
                id: $(this).attr('itemid'),
                cotiza: idCotiza,
                nombre: $(this).find('.prodLabel').html(),
                prod: $(this).find('.prodLabel').attr('itemid'),
                cantidad: parseInt($(this).find('.cantProd').html()),
                precio: parseFloat(limpiar_numero($(this).find('.precioUnitario').html())),
                iva: iva
            };
            elementos.push(item);
        });
        cotizacion = {
            elementos : elementos,
            id: idCotiza,
            total: limpiar_numero($("#totalPre").html()),
            pordesc: parseInt($('#descuento').val()),
            ttldesc: limpiar_numero($("#subdesc").html())
        };
        const data = {
			action: 'save_prods',
			cotizacion: cotizacion
		};

        $('#loader').attr('style', 'visibility: visible;');
        jQuery.post(ajaxurl, data, function(response) {
            $(".elementos[itemid='0']").each(function(i){
                $(this).attr('itemid', response[i]);
            });
            if(enviar){
                send_mail();
            }else{
                $('#loader').attr('style', 'visibility: hidden;');
                notificacion("Se ha guardado correctamente", 'success');
            }
            
        }).fail(function(error) {
            console.log( '[ ERROR ]', error );
            notificacion("Ocurrio un error al intentar guardar, recargue la página e intente nuevamente", 'error');
        });
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