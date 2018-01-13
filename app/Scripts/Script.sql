consulta pra vista de stock
-- -----------------------------------------------------------------
-- Vista de lista de productos con stock mayor a cero organizados por pedido
-- factura, aplica para regimen 70 y R10 abiertos
-- -----------------------------------------------------------------
alter view stockActiveProductsInCustomsView
AS
SELECT 
  pf.nro_pedido,  
  ped.regimen,
  dpf.id_pedido_factura,
  pf.id_factura_proveedor,
  pf.identificacion_proveedor,
  prov.nombre AS proveedor,
  dpf.detalle_pedido_factura , 
  pro.nombre AS producto,
  dpf.costo_caja,
  dpf.cod_contable, 
  dpf.grado_alcoholico,
  dpf.nro_cajas
FROM 
	 detalle_pedido_factura AS dpf
    LEFT JOIN producto AS pro USING(cod_contable) 
    LEFT JOIN pedido_factura AS pf USING(id_pedido_factura) 
    LEFT JOIN pedido AS ped USING (nro_pedido)
    LEFT JOIN proveedor AS prov ON (pf.identificacion_proveedor = prov.identificacion_proveedor)
WHERE dpf.nro_cajas > 0  
AND (ped.bg_isclosed = 0)
ORDER BY pf.nro_pedido ASC;


-- --- ---Cambios a cordovez
ALTER TABLE cordovezApp.factura_informativa_detalle ADD detalle_pedido_factura mediumint(9) NOT NULL COMMENT 'Identificador de la tabla de detalle de pedido para referenciar a la factura a la que pertenecen los productos y poder calcular el stock de las facturas de pedido';
ALTER TABLE `cordovezApp`.`pedido_factura` 
ADD COLUMN `bg_isclosed` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Verifica si una factura de proveedor ha sido cerrada, cuando una factura infromativa toma todos los productos de la factura del proveeedor\nla cierra.	' AFTER `id_user`;

ALTER TABLE `cordovezApp`.`factura_informativa_detalle` 
DROP FOREIGN KEY `FK_FAC_INFO_DETALLE_PRODUCTO`;
ALTER TABLE `cordovezApp`.`factura_informativa_detalle` 
DROP COLUMN `grado_alcoholico`,
DROP COLUMN `cod_contable`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id_factura_informativa`),
DROP INDEX `FK_FAC_INFO_DETALLE_PRODUCTO` ;


ALTER TABLE `cordovezApp`.`factura_informativa_detalle` 
ADD COLUMN `detalle_pedido_factura` MEDIUMINT(9) NOT NULL COMMENT 'Identificador de la tabla de detalle de pedido para referenciar a la factura a la que pertenecen los productos y poder calcular el stock de las facturas de pedido' AFTER `grado_alcoholico_nacionalizacion`,
ADD INDEX `fk_factura_informativa_detalle_pedido_idx` (`detalle_pedido_factura` ASC);
ALTER TABLE `cordovezApp`.`factura_informativa_detalle` 
ADD CONSTRAINT `fk_factura_informativa_detalle_pedido`
  FOREIGN KEY (`detalle_pedido_factura`)
  REFERENCES `cordovezApp`.`detalle_pedido_factura` (`detalle_pedido_factura`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


ALTER TABLE `cordovezApp`.`factura_informativa_detalle` 
CHANGE COLUMN `grado_alcoholico_nacionalizacion` `grado_alcoholico` DECIMAL(5,3) NULL DEFAULT NULL COMMENT 'grado alcoholoco con el uq e sale la factura infromativa en la nacionalizacion	' ;


ALTER TABLE `cordovezApp`.`factura_informativa_detalle` 
CHANGE COLUMN `grado_alcoholico` `grado_alcoholico` DECIMAL(5,3) NOT NULL COMMENT 'grado alcoholoco con el uq e sale la factura infromativa en la nacionalizacion	' ,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`id_factura_informativa`, `detalle_pedido_factura`, `grado_alcoholico`);



Cambios cordovez agregar nuevios parametros;


ALTER TABLE `cordovezApp`.`tarifa_gastos` 
DROP PRIMARY KEY,
ADD PRIMARY KEY (`identificacion_proveedor`, `concepto`, `pais_origen`, `valor`, `tipo_gasto`);
DROP TABLE cordovezApp.nacionalizacion ;
DROP TABLE ci_sessions;
camnbiar el nombre de la columna de gastos nacionalizacion por id_factura_informativa


ALTER TABLE `cordovezApp`.`factura_informativa` 
ADD COLUMN `fecha_salida_almacenera` DATE NULL DEFAULT NULL AFTER `fecha_emision`;



