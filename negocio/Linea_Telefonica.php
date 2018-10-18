<?php

require_once '../datos/Conexion.clase.php';

class Linea_Telefonica extends Conexion {
    

    public function cargarNumero($dni){
        try {
            $sql = "SELECT 
  distinct linea_telefonica.dni,linea_telefonica.numero_linea_telefonica, 
  recibo.estado
FROM 
  public.linea_telefonica, 
  public.recibo
WHERE 
  linea_telefonica.dni = recibo.dni AND
  linea_telefonica.numero_linea_telefonica = recibo.numero_linea_telefonica and recibo.estado='P' and linea_telefonica.dni=:p_dni;";
            $sentencia = $this->dblink->prepare($sql);
             $sentencia->bindParam(":p_dni", $dni);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    
}
