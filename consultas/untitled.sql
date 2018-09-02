 select 
 SUBSTRING(nro_pedido, -2) AS 'anio',
 par.nro_pedido as 'Pedido',
 inv.nro_factura_informativa as 'Nro Fac Inf',
 inv.fecha_emision,
 inv.nro_refrendo,
 inv.valor,
 par.tipo_cambio,
 par.bg_isclosed
 from factura_informativa as inv 
 left join parcial as par on (par.id_parcial = inv.id_parcial)
ORDER BY 
par.bg_isclosed DESC,
anio DESC, 
nro_pedido DESC,
par.id_parcial DESC
limit 600;