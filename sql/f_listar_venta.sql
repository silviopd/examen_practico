-- Function: f_listar_venta(date, date, integer)

-- DROP FUNCTION f_listar_venta(date, date, integer);

CREATE OR REPLACE FUNCTION f_listar_venta(
    IN p_fecha1 date,
    IN p_fecha2 date,
    IN p_tipo integer)
  RETURNS TABLE(numero_venta integer, fec_pago date, cli character varying, num character varying, tot numeric, esta character varying) AS
$BODY$
	begin
	return query
	-- consulta sql
		SELECT 
  distinct on(pago.num_pago) pago.num_pago,
  pago.fecha_pago, 
  cliente.nombre, 
  linea_telefonica.numero_linea_telefonica, 
  pago.total, 
  (case when pago.estado='E' then 'ACTIVO' else 'ANULADO' end)::varchar as estado
FROM 
  public.cliente, 
  public.linea_telefonica, 
  public.pago, 
  public.recibo, 
  public.pago_detalle
WHERE 
  cliente.dni = linea_telefonica.dni AND
  linea_telefonica.dni = recibo.dni AND
  linea_telefonica.numero_linea_telefonica = recibo.numero_linea_telefonica AND
  pago_detalle.numero_recibo = recibo.numero_recibo AND
  pago_detalle.numero_pago = pago.num_pago AND 
		(case p_tipo 
		when 1 then fecha_pago=current_date --solo hoy
		when 2 then fecha_pago >= p_fecha1 and fecha_pago <= p_fecha2
		else true end)
order by 1 asc;
	end
$BODY$
  LANGUAGE plpgsql VOLATILE
