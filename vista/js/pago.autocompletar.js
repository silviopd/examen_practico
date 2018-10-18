/*INICIO: BUSQUEDA DE CLIENTES*/
$("#txtcodigocliente").autocomplete({
    source: "../controlador/cliente.autocompletar.controlador.php",
    minLength: 1, //Filtrar desde que colocamos 3 o mas caracteres
    focus: f_enfocar_registro,
    select: f_seleccionar_registro
});

function f_enfocar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtcodigocliente").val(registro.dni);
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtcodigocliente").val(registro.dni);
    $("#txtnombrecliente").val(registro.nombre);
    $("#lbldireccioncliente").val(registro.direccion);
    
    
    cargarComboNumero("#cbonumero", "seleccione",registro.dni);
    
    event.preventDefault();
}

/*FIN: BUSQUEDA DE CLIENTES*/
