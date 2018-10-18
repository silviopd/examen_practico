-- Function: f_generar_correlativo(character varying)

-- DROP FUNCTION f_generar_correlativo(character varying);

CREATE OR REPLACE FUNCTION f_generar_correlativo(p_tabla character varying)
  RETURNS SETOF integer AS
$BODY$
	
	begin
		return query
		select 
			c.numero+1 
		from 
			correlativo c 
		where 
			c.tabla = p_tabla;
	end
	
$BODY$
  LANGUAGE plpgsql VOLATILE
