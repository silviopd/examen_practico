<?php

require_once '../negocio/Cliente.clase.php';

$obj = new Cliente();

$valorBusqueda = $_GET["term"];

$resultado = $obj->cargarDatosCliente($valorBusqueda);

$datos = array();

for ($i = 0; $i < count($resultado); $i++) {
    $registro = array
            (
                "label" => $resultado[$i]["dni"],
                "value" => array
                            (
                                "dni" => $resultado[$i]["dni"],
                                "nombre" => $resultado[$i]["nombre"],
                                "direccion" => $resultado[$i]["direccion"]                                
                            )
            );
    
    $datos[$i] = $registro;
}

echo json_encode($datos);