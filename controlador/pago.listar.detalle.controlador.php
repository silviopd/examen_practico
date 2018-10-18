<?php

require_once '../negocio/Pago.clase.php';
require_once '../util/funciones/Funciones.clase.php';

try {

    if (!isset($_POST["numeroVenta"])) {
        Funciones::imprimeJSON(500, "Faltan parametros", "");
        exit;
    }

    $numeroVenta = $_POST["numeroVenta"];

    $objVenta = new Pago();
    $resultado = $objVenta->listarVentaDetalle($numeroVenta);

    Funciones::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    //Funciones::mensaje($exc->getMessage(), "e");
    Funciones::imprimeJSON(500, $exc->getMessage(), "");
}
    
