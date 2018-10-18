<?php

require_once '../datos/Conexion.clase.php';

class Recibo extends Conexion {

    public function cargarRecibo($dni,$numero_linea) {
        try {
            $sql = "SELECT 
  recibo.dni, recibo.numero_linea_telefonica,
  ('Reci: '||recibo.numero_recibo|| ' /Fec Vec '|| recibo.fecha_vencimiento_deuda)::varchar as descripcion, 
  recibo.importe, 
  recibo.numero_recibo, 
  recibo.estado
FROM 
  public.recibo, 
  public.linea_telefonica
WHERE 
  linea_telefonica.dni = recibo.dni AND
  linea_telefonica.numero_linea_telefonica = recibo.numero_linea_telefonica and recibo.estado='P' and linea_telefonica.dni=:p_dni and recibo.numero_linea_telefonica=:p_linea;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $dni);
            $sentencia->bindParam(":p_linea", $numero_linea);
            $sentencia->execute();

            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarImporte($dni,$numero_linea,$recibo) {
        try {
            $sql = "SELECT 
    recibo.importe,recibo.fecha_vencimiento_deuda as fecha
FROM 
  public.recibo, 
  public.linea_telefonica
WHERE 
  linea_telefonica.dni = recibo.dni AND
  linea_telefonica.numero_linea_telefonica = recibo.numero_linea_telefonica and recibo.estado='P' and linea_telefonica.dni=:p_dni and recibo.numero_linea_telefonica=:p_linea and recibo.numero_recibo=:p_recibo ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $dni);
            $sentencia->bindParam(":p_linea", $numero_linea);
            $sentencia->bindParam(":p_recibo", $recibo);
            $sentencia->execute();

            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
