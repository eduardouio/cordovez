CREATE VIEW pedidoFacturaView 
AS
  SELECT
	  fp.id_pedido_factura, 
  	fp.nro_pedido, 
  	fp.id_factura_proveedor, 
	  fp.identificacion_proveedor, 
	  pr.nombre,
	  fp.fecha_emision, 
	  fp.vencimiento_pago,
	  DATEDIFF(fecha_emision , vencimiento_pago ) AS estado, 
	  fp.moneda, 
	  fp.date_create, 
	  fp.id_user  
  FROM
    pedido_factura AS fp
  LEFT JOIN proveedor AS pr USING(identificacion_proveedor);


CREATE VIEW detallePedidosView
AS
  SELECT
    pr.id_producto, 
    pr.nombre as 'producto',
    pr.capacidad_ml,
    prv.nombre,
    prv.id_proveedor,
    prv.identificacion_proveedor,
    dpf.nro_cajas,
    dpf.costo_und,
    dpf.detalle_pedido_factura
  FROM detalle_pedido_factura AS dpf 
  LEFT JOIN producto AS pr USING(cod_contable) 
  LEFT JOIN proveedor AS prv USING(identificacion_proveedor)
  WHERE dpf.id_pedido_factura = 4;
