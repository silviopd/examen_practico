$("#btnagregar").click(function(){
    document.location.href = "pago.vista.php";
});

$("#btnfiltrar").click(function(){
    listar();
});


function listar(){
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    var tipo   = $("#rbtipo:checked").val();
    
    $.post
    (
        "../controlador/pago.listado.controlador.php",
        {
            p_fecha1: fecha1,
            p_fecha2: fecha2,
            p_tipo: tipo
        }
    ).done(function(resultado){
        var datosJSON = resultado;
        
        if (datosJSON.estado===200){
            var html = "";

            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tr style="background-color: #ededed; height:25px;">';
            
            html += '<th style="text-align: center" style="font-size:13px">OPCIONES</th>';
            html += '<th style="font-size:13px">N.Pago</th>';
            html += '<th style="font-size:13px">Fecha</th>';
            html += '<th style="font-size:13px">Cliente</th>';
            html += '<th style="font-size:13px">Numero Linea</th>';
            html += '<th style="font-size:13px">Total Pagado</th>';
            html += '<th style="font-size:13px">Estado</th>';
            
            html += '</tr>';
            html += '</thead>';
            html += '<tbody>';

            //Detalle
            $.each(datosJSON.datos, function(i,item) {
                
                if (item.esta === "ACTIVO"){
                    html += '<tr>';
                    html += '<td align="center">';
                    html += '<button type="button" class="btn btn-danger btn-xs" onclick="anular(' + item.numero_venta + ')"><i class="fa fa-close"></i></button>';
                    html += '&nbsp;&nbsp;';
                    html += '<button type="button" style="font-size:10px; vertical-align:middle" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Detalle Venta" onclick="informacion(' + item.numero_venta + ')"><i class="fa fa-navicon"></i></button>';html += '</td>';
                }else{                    
                    html += '<tr style="text-decoration:line-through; color:red">';
                    html += '<td align="center">';
                    html += '&nbsp;&nbsp;';
                    html += '<button type="button" style="font-size:10px; vertical-align:middle" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-toggle="tooltip" data-placement="top" title="Detalle Venta" onclick="informacion(' + item.numero_venta + ')"><i class="fa fa-navicon"></i></button>';html += '</td>';
                }
                
                
                html += '<td align="center" style="font-size:12px">'+item.numero_venta+'</td>';
                html += '<td style="font-size:12px">'+item.fec_pago+'</td>';
                html += '<td style="font-size:12px">'+item.cli+'</td>';
                html += '<td style="font-size:12px">'+item.num+'</td>';
                html += '<td style="font-size:12px">'+item.tot+'</td>';
                html += '<td style="font-size:12px">'+item.esta+'</td>';
                html += '</tr>';
            });

            html += '</tbody>';
            html += '</table>';
            html += '</small>';
            
            $("#listado").html(html);
            
            $('#tabla-listado').dataTable({
               "aaSorting": [[1, "asc"]],
                "sScrollX": "100%",
                "sScrollXInner": "150%",
                "bScrollCollapse": true,
                "bPaginate": true,
                "bProcessing": true
            });
            
            
            
	}else{
            swal("Mensaje del sistema", resultado , "warning");
        }
        
    }).fail(function(error){
        var datosJSON = $.parseJSON( error.responseText );
        swal("Error", datosJSON.mensaje , "error"); 
    });
    
}


$(document).ready(function(){
    listar();
});


function anular(numeroVenta){
   swal({
            title: "Confirme",
            text: "¿Esta seguro de anular la venta seleccionada?",

            showCancelButton: true,
            confirmButtonColor: '#d93f1f',
            confirmButtonText: 'Si',
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: true,
            imageUrl: "../imagenes/eliminar.png"
	},
	function(isConfirm){
            if (isConfirm){
                $.post(
                    "../controlador/pago.anular.controlador.php",
                    {
                        p_numero_venta: numeroVenta
                    }
                    ).done(function(resultado){
                        var datosJSON = resultado;   
                        if (datosJSON.estado===200){ //ok
                            listar();
                            swal("Exito", datosJSON.mensaje , "success");
                        }

                    }).fail(function(error){
                        var datosJSON = $.parseJSON( error.responseText );
                        swal("Error", datosJSON.mensaje , "error");
                    });
                
            }
	});
   
}

function informacion(numeroVenta) {
    $.post
            (
                    "../controlador/pago.listar.detalle.controlador.php",
                    {
                        numeroVenta: numeroVenta
                    }
            ).done(function (resultado) {
        var datosJSON = resultado;

        if (datosJSON.estado === 200) {
            var html = "";
            html += '<small>';
            html += '<table id="tabla-listado" class="table table-bordered table-striped">';
            html += '<thead>';
            html += '<tbody>';
            $.each(datosJSON.datos, function (i, item) {
                html += '<tr>';
                html += '<td style="font-size:12px; vertical-align:middle; text-align: right">' + item.numero_linea_telefonica + '</td>';
                html += '<td style="font-size:12px; vertical-align:middle; text-align: right">' + item.numero_recibo + '</td>';
                html += '<td style="font-size:12px; vertical-align:middle; text-align: right">' + item.fecha_vencimiento_deuda + '</td>';
                html += '<td style="font-size:12px; vertical-align:middle; text-align: right">' + item.importe + '</td>';
                html += '</tr>';

                $("#txtclientemodal").val(item.nombre);
            });
            html += '</tbody>';
            html += '</table>';
            html += '</small>';

            $("#detalleventa-informacion").html(html);
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });
}

$("input[name='rbtipo']").change(function () {
    if ($("input[name='rbtipo']:checked").val() == 2) {
        $("#txtfecha1").prop("disabled", false);
        $("#txtfecha2").prop("disabled", false);
    } else {
        $("#txtfecha1").prop("disabled", true);
        $("#txtfecha2").prop("disabled", true);
    }
});