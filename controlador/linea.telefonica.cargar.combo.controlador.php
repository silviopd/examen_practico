<?php

    

    require_once '../negocio/Linea_Telefonica.php';
    require_once '../util/funciones/Funciones.clase.php';

    try {
	$obj = new Linea_Telefonica();
        $tipoComprobante = $_POST["p_tipoComprobante"];
        $resultado = $obj->cargarNumero($tipoComprobante);
	Funciones::imprimeJSON(200, "", $resultado);
	
    } catch (Exception $exc) {
	Funciones::imprimeJSON(500, $exc->getMessage(), "");
	
    }
