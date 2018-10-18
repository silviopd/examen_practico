<?php

require_once '../datos/Conexion.clase.php';

class Cliente extends Conexion {
    
    public function cargarDatosCliente($dni) {
        try {
            $sql = "
		select 
		    *
		from 
		    cliente 
		where 
		    dni like :p_dni";
            $sentencia = $this->dblink->prepare($sql);
            $dni = '%'.  strtolower($dni).'%';
            $sentencia->bindParam(":p_dni", $dni);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
}
