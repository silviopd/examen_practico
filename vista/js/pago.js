$("#btnregresar").click(function () {
    document.location.href = "pago.listado.vista.php";
});

$(document).ready(function () {
//    obtenerPorcentajeIGV();
});

$("#cbonumero").change(function () {
    var dni = $("#txtcodigocliente").val();
    var numero = $("#cbonumero").val();
    cargarRecibo("#cborecibo", "seleccione", dni, numero);
});


function obtenerImporte() {
    var tipoComprobante = $("#txtcodigocliente").val();
    var numero = $("#cbonumero").val();
    var recibo = $("#cborecibo").val();
//    alert(tipoComprobante+"  "+numero + " "+recibo);
    $.post
            (
                    "../controlador/recibo.obtener.importe.controlador.php",
                    {
                        p_dni: tipoComprobante,
                        p_linea: numero,
                        p_recibo: recibo
                    }
            ).done(function (resultado) {
        var datosJSON = resultado;
        if (datosJSON.estado === 200) {

            $.each(datosJSON.datos, function (i, item) {
                $("#txtimporte").val(item.importe);
                $("#txtfecha").val(item.fecha);
            });

        } else {
            swal("Mensaje del sistema", resultado, "warning");
        }
    }).fail(function (error) {
        var datosJSON = $.parseJSON(error.responseText);
        swal("Error", datosJSON.mensaje, "error");
    });

}

$("#cborecibo").change(function () {
    obtenerImporte();
});

$("#btnagregar").click(function () {
    if ($("#cbonumero").val() === null || $("#cbonumero").val().toString() == '') {
        swal("Verifique", "Debese seleccionar un numero telefonico", "warning");
        return 0;
    } else if ($("#cborecibo").val().toString() == '') {
        swal("Verifique", "Debese seleccionar un recibo", "warning");
        return 0;
    }


    //capturar las variables para agregar al detalle
    var codigoArticulo = $("#cborecibo").val();
    var fecha = $("#txtfecha").val();
    var importe = $("#txtimporte").val();



    //Elaborar una variable con el HTML para agregar al detalle
    var fila = '<tr>' +
            '<td class="text-center">' + codigoArticulo + '</td>' +
            '<td>' + fecha + '</td>' +
            '<td class="text-right">' + importe + '</td>' +
            '<td id="celiminar" class="text-center"><a href="#"> <i style="font-size:20px;" class="fa fa-close text-orange"></i> </a></td>' +
            '</tr>';


    //Validacion
    var a = 'no';
    $("#detalleventa tr").each(function () {
        var codigotabla = $(this).find("td").eq(0).html();
        if (codigoArticulo === codigotabla) {
            a = 'si';
        }
        ;
    });

    if (a == 'si') {
        swal("Verifique", "Ya se encuentra agregado en la tabla el boleto nro " + codigoArticulo, "warning");
        $("#cborecibo").val("");
        $("#txtimporte").val("");
        return 0;
    }
    //

    $("#detalleventa").append(fila);

    //LLamar a la función calcular totales
    calcularTotales();

    //Limpiar los controles y enfocar a la caja de texto txtarticulo
    $("#cbonumero").val("");
    $("#cborecibo").empty();
    $("#txtimporte").val("");


});


$(document).on("click", "#celiminar", function () {

    var filaEliminar = $(this).parents().get(0); //Capturar la fila que se desea eliminar

    swal({
        title: "Confirme",
        text: "¿Desea eliminar el registro seleccionado?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#ff0000',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: true,
        closeOnCancel: true
    },
            function (isConfirm) {
                if (isConfirm) { //el usuario hizo clic en el boton SI     
                    filaEliminar.remove();
                    calcularTotales();
                    $("#txtarticulo").focus();
                }
            });
});

function calcularTotales() {
    var neto = 0;

    $("#detalleventa tr").each(function () {
        var importe = $(this).find("td").eq(2).html();
        neto = neto + parseFloat(importe);
    });

    //Mostrar los totales
    $("#txtimporteneto").val(neto.toFixed(2));
}

$("#txtcodigocliente").keypress(function (evento) {
    if (evento.which === 13) { //Significa que el usuario ha presionado la tecla ENTER
        evento.preventDefault();
        $("#btnagregar").click();
    } else {
        return validarNumeros(evento);
    }
});



var arrayDetalle = new Array(); //permite almacenar todos los articulos agregados en el detalle de la venta

$("#frmgrabar").submit(function (evento) {
    evento.preventDefault();

    if (document.getElementById("detalleventa").rows.length == 0) {
        swal("Verifique", "Ingrese un boleto, tabla vacia", "warning");
        return 0;
    }
    ;

    swal({
        title: "Confirme",
        text: "¿Esta seguro de grabar la venta?",
        showCancelButton: true,
        confirmButtonColor: '#3d9205',
        confirmButtonText: 'Si',
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        imageUrl: "../imagenes/pregunta.png"
    },
            function (isConfirm) {

                if (isConfirm) { //el usuario hizo clic en el boton SI     

                    //procedo a grabar

                    /*CAPTURAR TODOS LOS DATOS NECESARIOS PARA GRABAR EN EL VENTA_DETALLE*/

                    /*limpiar el array*/
                    arrayDetalle.splice(0, arrayDetalle.length);
                    /*limpiar el array*/

                    /*RECORREMOS CADA FILA DE LA TABLA DONDE ESTAN LOS ARTICULOS VENDIDOS*/
                    $("#detalleventa tr").each(function () {
                        var codigorecibo = $(this).find("td").eq(0).html();
                        var fecha = $(this).find("td").eq(1).html();
                        var importe = $(this).find("td").eq(2).html();

                        var objDetalle = new Object(); //Crear un objeto para almacenar los datos

                        /*declaramos y asignamos los valores a los atributos*/
                        objDetalle.codigorecibo = codigorecibo;
                        objDetalle.precio = fecha;
                        objDetalle.importe = importe;
                        /*declaramos y asignamos los valores a los atributos*/

                        arrayDetalle.push(objDetalle); //agregar el objeto objDetalle al array arrayDetalle

                    });

                    /*RECORREMOS CADA FILA DE LA TABLA DONDE ESTAN LOS ARTICULOS VENDIDOS*/

                    //Convertimos el array "arrayDetalle" a formato de JSON
                    var jsonDetalle = JSON.stringify(arrayDetalle);

                    //alert(jsonDetalle);
                    //return 0;


                    /*CAPTURAR TODOS LOS DATOS NECESARIOS PARA GRABAR EN EL VENTA_DETALLE*/

                    $.post(
                            "../controlador/pago.agregar.controlador.php",
                            {
                                p_datosFormulario: $("#frmgrabar").serialize(),
                                p_datosJSONDetalle: jsonDetalle
                            }
                    ).done(function (resultado) {
                        var datosJSON = resultado;

                        if (datosJSON.estado === 200) {
                            //swal("Exito", datosJSON.mensaje, "success");
                            //document.location.href = "venta.listado.vista.php";

                            swal({
                                title: "Exito",
                                text: datosJSON.mensaje,
                                type: "success",
                                showCancelButton: false,
                                //confirmButtonColor: '#3d9205',
                                confirmButtonText: 'Ok',
                                closeOnConfirm: true,
                            },
                                    function () {
                                        document.location.href = "pago.listado.vista.php";
                                    });


                        } else {
                            swal("Mensaje del sistema", resultado, "warning");
                        }

                    }).fail(function (error) {
                        var datosJSON = $.parseJSON(error.responseText);
                        swal("Error", datosJSON.mensaje, "error");
                    });

                }
            });
});