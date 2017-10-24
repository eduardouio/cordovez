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
  
  