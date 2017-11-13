ALTER VIEW pedidoFacturaView 
AS
  SELECT
	  fp.id_pedido_factura, 
    fp.nro_pedido, 
		fp.id_factura_proveedor, 
	  fp.identificacion_proveedor, 
	  pr.nombre,
    fp.fecha_emision, 
    fp.valor, 
    fp.moneda, 
	  fp.tipo_cambio, 
    fp.vencimiento_pago,
    DATEDIFF(fecha_emision , vencimiento_pago ) AS dias_transcurridos, 
    fp.date_create, 
	  fp.last_update, 
	  fp.id_user  
  FROM
    pedido_factura AS fp
  LEFT JOIN proveedor AS pr USING(identificacion_proveedor);


ALTER VIEW detallePedidosView
AS
  SELECT
	dpf.*,
    pf.nro_pedido,
    pf.id_factura_proveedor,
    pr.nombre,
    pr.grado_alcoholico as 'grado_alcoholico_original',
    pr.custodia_doble
  FROM detalle_pedido_factura AS dpf 
  LEFT JOIN pedido_factura as pf USING(id_pedido_factura)
  LEFT JOIN producto as pr USING(cod_contable);
  
  
ALTER VIEW `detallePedidosView` 
AS 
select 
`dpf`.`detalle_pedido_factura` AS `detalle_pedido_factura`,
`dpf`.`id_pedido_factura` AS `id_pedido_factura`,
`dpf`.`cod_contable` AS `cod_contable`,
`dpf`.`grado_alcoholico` AS `grado_alcoholico`,
`dpf`.`nro_cajas` AS `nro_cajas`,
`dpf`.`costo_caja` AS `costo_cajas`,
`dpf`.`date_create` AS `date_create`,
`dpf`.`last_update` AS `last_update`,
`dpf`.`id_user` AS `id_user`,`pf`.
`nro_pedido` AS `nro_pedido`,
`pf`.`id_factura_proveedor` AS `id_factura_proveedor`,
`pr`.`nombre` AS `nombre`,
`pr`.`grado_alcoholico` AS `grado_alcoholico_original`,
`pr`.`custodia_doble` AS `custodia_doble` from 
((`detalle_pedido_factura` `dpf` join `pedido_factura` `pf` on((`dpf`.`id_pedido_factura` = `pf`.`id_pedido_factura`))) join `producto` `pr` on((`dpf`.`cod_contable` = `pr`.`cod_contable`)))
