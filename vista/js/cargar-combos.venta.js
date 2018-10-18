function cargarComboNumero(p_nombreCombo, p_tipo,p_tipoComprobante){
    $.post
    (
	"../controlador/linea.telefonica.cargar.combo.controlador.php",{
            p_tipoComprobante: p_tipoComprobante
        }
    ).done(function(resultado){
	var datosJSON = $.parseJSON( JSON.stringify(resultado) );
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione un numero</option>';
            }else{
                html += '<option value="0">Todas los numeros</option>';
            }

            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.numero_linea_telefonica+'">'+item.numero_linea_telefonica+'</option>';
            });
            $(p_nombreCombo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}



function cargarRecibo(p_nombreCombo, p_tipo, p_dni,p_linea){
    $.post
    (
	"../controlador/recibo.cargar.combo.controlador.php",
        {
            p_dni: p_dni,
            p_linea: p_linea
        }
    ).done(function(resultado){
	var datosJSON = $.parseJSON( JSON.stringify(resultado) );
	
        if (datosJSON.estado===200){
            var html = "";
            if (p_tipo==="seleccione"){
                html += '<option value="">Seleccione una serie</option>';
            }else{
                html += '<option value="0">Todas las series</option>';
            }

            $.each(datosJSON.datos, function(i,item) {
                html += '<option value="'+item.numero_recibo+'">'+item.descripcion+'</option>';
            });
            $(p_nombreCombo).html(html);
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
    }).fail(function(error){
	var datosJSON = $.parseJSON( error.responseText );
	swal("Error", datosJSON.mensaje , "error");
    });
}