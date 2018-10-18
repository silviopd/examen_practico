<?php


require_once '../negocio/Pago.clase.php';
require_once '../util/funciones/Funciones.clase.php';

if (! isset($_POST["p_datosFormulario"]) ){
    Funciones::imprimeJSON(500, "Faltan parametros", "");
    exit();
}

$datosFormulario = $_POST["p_datosFormulario"];
$datosJSONDetalle = $_POST["p_datosJSONDetalle"];

//Convertir todos los datos que llegan concatenados a un array
parse_str($datosFormulario, $datosFormularioArray);

/*
echo '<pre>';
print_r($datosFormularioArray);
echo '</pre>';
*/

try {
    $objVenta = new Pago();
    $objVenta->setFecha_pago( $datosFormularioArray["txtfec"]);
    $objVenta->setTotal( $datosFormularioArray["txtimporteneto"]);
        
    
    //Enviar los datos del detalle en formato JSON
    $objVenta->setDetalleVenta( $datosJSONDetalle );
    
    $resultado = $objVenta->agregar();
    
    if ($resultado == true){
        Funciones::imprimeJSON(200, "La venta ha sido registrada correctamente", "");
    }
    
} catch (Exception $exc) {
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}



