-- -----------------------------------------------------------------------------
-- TABLA DETALLES PEDIDO FACTURA
-- -----------------------------------------------------------------------------
DELIMITER //
CREATE TRIGGER TG_DETALLEPEDIDOFACTURA_UPDATE BEFORE UPDATE ON detalle_pedido_factura
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.id_pedido_factura != OLD.id_pedido_factura) THEN
		SET @sql = CONCAT(@sql , "id_pedido_factura:" , OLD.id_pedido_factura , ":",NEW.id_pedido_factura , ";");
	END IF;

	IF (NEW.cod_contable != OLD.cod_contable) THEN
		SET @sql = CONCAT(@sql , "cod_contable:" , OLD.cod_contable , ":",NEW.cod_contable, ";");
	END IF;

	IF (NEW.nro_cajas != OLD.nro_cajas) THEN
		SET @sql = CONCAT(@sql , "nro_cajas:" , OLD.nro_cajas , ":",NEW.nro_cajas, ";");
	END IF;

	IF (NEW.costo_und != OLD.costo_und) THEN
		SET @sql = CONCAT(@sql , "costo_und:" , NEW.costo_und , ":",OLD.costo_und, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('detalle_pedido_factura', @sql , NEW.id_user);

		
	END //

DELIMITER ;
-- -----------------------------------------------------------------------------

-- -----------------------------------------------------------------------------
-- TABLA FACTURA INFORMATIVAshow tables;
-- -----------------------------------------------------------------------------
DELIMITER //
CREATE TRIGGER TG_FACTURAINFORMATIVA_UPDATE BEFORE UPDATE ON factura_informativa
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nro_factura_informativa != OLD.nro_factura_informativa) THEN
		SET @sql = CONCAT(@sql , "nro_factura_informativa:" , OLD.nro_factura_informativa , ":",NEW.nro_factura_informativa , ";");
	END IF;

	IF (NEW.nro_pedido != OLD.nro_pedido) THEN
		SET @sql = CONCAT(@sql , "nro_pedido:" , OLD.nro_pedido , ":",NEW.nro_pedido, ";");
	END IF;

	IF (NEW.fecha_emision != OLD.fecha_emision) THEN
		SET @sql = CONCAT(@sql , "fecha_emision:" , OLD.fecha_emision , ":",NEW.fecha_emision, ";");
	END IF;

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , NEW.identificacion_proveedor , ":",OLD.identificacion_proveedor, ";");
	END IF;

	IF (NEW.fele_aduana != OLD.fele_aduana) THEN
		SET @sql = CONCAT(@sql , "fele_aduana:" , OLD.fele_aduana , ":",NEW.fele_aduana, ";");
	END IF;

	IF (NEW.seguro_aduana != OLD.seguro_aduana) THEN
		SET @sql = CONCAT(@sql , "seguro_aduana:" , OLD.seguro_aduana , ":",NEW.seguro_aduana , ";");
	END IF;

	IF (NEW.moneda != OLD.moneda) THEN
		SET @sql = CONCAT(@sql , "moneda:" , OLD.moneda , ":",NEW.moneda, ";");
	END IF;

	IF (NEW.tipo_cambio != OLD.tipo_cambio) THEN
		SET @sql = CONCAT(@sql , "tipo_cambio:" , OLD.tipo_cambio , ":",NEW.tipo_cambio, ";");
	END IF;

	IF (NEW.enviado_comtabilidad != OLD.enviado_comtabilidad) THEN
		SET @sql = CONCAT(@sql , "enviado_comtabilidad:" , NEW.enviado_comtabilidad , ":",OLD.enviado_comtabilidad, ";");
	END IF;

	IF (NEW.fecha_envio != OLD.fecha_envio) THEN
		SET @sql = CONCAT(@sql , "fecha_envio:" , OLD.fecha_envio , ":",NEW.fecha_envio, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('factura_informativa', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA FACTURA_INFIORMATIVA_DETALLE
-- -----------------------------------------------------------------------------
DELIMITER //
CREATE TRIGGER TG_FACTURAINFORMATIVADETALLE_UPDATE BEFORE UPDATE ON factura_informativa_detalle
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nro_factura_informativa != OLD.nro_factura_informativa) THEN
		SET @sql = CONCAT(@sql , "nro_factura_informativa:" , OLD.nro_factura_informativa , ":",NEW.nro_factura_informativa , ";");
	END IF;

	IF (NEW.cod_contable != OLD.cod_contable) THEN
		SET @sql = CONCAT(@sql , "cod_contable:" , OLD.cod_contable , ":",NEW.cod_contable, ";");
	END IF;

	IF (NEW.nro_cajas != OLD.nro_cajas) THEN
		SET @sql = CONCAT(@sql , "nro_cajas:" , OLD.nro_cajas , ":",NEW.nro_cajas, ";");
	END IF;

	

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('factura_informativa_detalle', @sql , NEW.id_user);

		
	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA GASTOS INICIALES
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_GASTOSINICIALES_UPDATE BEFORE UPDATE ON gastos_iniciales
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nro_pedido != OLD.nro_pedido) THEN
		SET @sql = CONCAT(@sql , "nro_pedido:" , OLD.nro_pedido , ":",NEW.nro_pedido , ";");
	END IF;

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , NEW.identificacion_proveedor , ":",OLD.identificacion_proveedor, ";");
	END IF;

	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto, ";");
	END IF;

	IF (NEW.nro_factura != OLD.nro_factura) THEN
		SET @sql = CONCAT(@sql , "nro_factura:" , OLD.nro_factura , ":",NEW.nro_factura, ";");
	END IF;

	IF (NEW.fecha_emision != OLD.fecha_emision) THEN
		SET @sql = CONCAT(@sql , "fecha_emision:" , NEW.fecha_emision , ":",OLD.fecha_emision, ";");
	END IF;

	IF (NEW.fecha_inicio != OLD.fecha_inicio) THEN
		SET @sql = CONCAT(@sql , "fecha_inicio:" , OLD.fecha_inicio , ":",NEW.fecha_inicio, ";");
	END IF;

		IF (NEW.fecha_fin != OLD.fecha_fin) THEN
		SET @sql = CONCAT(@sql , "fecha_fin:" , OLD.fecha_fin , ":",NEW.fecha_fin, ";");
	END IF;

		IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor, ";");
	END IF;

		IF (NEW.enviado_contabilidad != OLD.enviado_contabilidad) THEN
		SET @sql = CONCAT(@sql , "enviado_contabilidad:" , OLD.enviado_contabilidad , ":",NEW.enviado_contabilidad, ";");
	END IF;

		IF (NEW.fecha_envio != OLD.fecha_envio) THEN
		SET @sql = CONCAT(@sql , "fecha_envio:" , OLD.fecha_envio , ":",NEW.fecha_envio, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('gastos_iniciales', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA GASTOS NACIONALIZACION
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_GASTOSNACIONALIZACION_UPDATE BEFORE UPDATE ON gastos_nacionalizacion
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.codigo_nacionalizacion != OLD.codigo_nacionalizacion) THEN
		SET @sql = CONCAT(@sql , "codigo_nacionalizacion:" , OLD.codigo_nacionalizacion , ":",NEW.codigo_nacionalizacion , ";");
	END IF;

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , NEW.identificacion_proveedor , ":",OLD.identificacion_proveedor, ";");
	END IF;

	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto, ";");
	END IF;

	IF (NEW.nro_factura != OLD.nro_factura) THEN
		SET @sql = CONCAT(@sql , "nro_factura:" , OLD.nro_factura , ":",NEW.nro_factura, ";");
	END IF;

	IF (NEW.fecha_emision != OLD.fecha_emision) THEN
		SET @sql = CONCAT(@sql , "fecha_emision:" , NEW.fecha_emision , ":",OLD.fecha_emision, ";");
	END IF;

	IF (NEW.fecha_inicio != OLD.fecha_inicio) THEN
		SET @sql = CONCAT(@sql , "fecha_inicio:" , OLD.fecha_inicio , ":",NEW.fecha_inicio, ";");
	END IF;

		IF (NEW.fecha_fin != OLD.fecha_fin) THEN
		SET @sql = CONCAT(@sql , "fecha_fin:" , OLD.fecha_fin , ":",NEW.fecha_fin, ";");
	END IF;

		IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor, ";");
	END IF;

		IF (NEW.enviado_contabilidad != OLD.enviado_contabilidad) THEN
		SET @sql = CONCAT(@sql , "enviado_contabilidad:" , OLD.enviado_contabilidad , ":",NEW.enviado_contabilidad, ";");
	END IF;

		IF (NEW.fecha_envio != OLD.fecha_envio) THEN
		SET @sql = CONCAT(@sql , "fecha_envio:" , OLD.fecha_envio , ":",NEW.fecha_envio, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('gastos_nacionalizacion', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA UMPUESTOS DE NACIONALIZACION
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_IMPUESTOSNACIONALIZACION_UPDATE BEFORE UPDATE ON impuestos_nacionalizacion
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.id_nacionalizacion != OLD.id_nacionalizacion) THEN
		SET @sql = CONCAT(@sql , "id_nacionalizacion:" , OLD.id_nacionalizacion , ":",NEW.id_nacionalizacion , ";");
	END IF;

	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto, ";");
	END IF;

	IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor, ";");
	END IF;

	IF (NEW.nro_documento != OLD.nro_documento) THEN
		SET @sql = CONCAT(@sql , "nro_documento:" , OLD.nro_documento , ":",NEW.nro_documento, ";");
	END IF;

	IF (NEW.fecha_emision != OLD.fecha_emision) THEN
		SET @sql = CONCAT(@sql , "fecha_emision:" , NEW.fecha_emision , ":",OLD.fecha_emision, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('impuestos_nacionalizacion', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA UMPUESTOS DE INCOTERM
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_INCOTERM_UPDATE BEFORE UPDATE ON incoterm
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.tipo != OLD.tipo) THEN
		SET @sql = CONCAT(@sql , "tipo:" , OLD.tipo , ":",NEW.tipo , ";");
	END IF;

	IF (NEW.pais != OLD.pais) THEN
		SET @sql = CONCAT(@sql , "pais:" , OLD.pais , ":",NEW.pais, ";");
	END IF;

	IF (NEW.incoterms != OLD.incoterms) THEN
		SET @sql = CONCAT(@sql , "incoterms:" , OLD.incoterms , ":",NEW.incoterms, ";");
	END IF;

	IF (NEW.ciudad != OLD.ciudad) THEN
		SET @sql = CONCAT(@sql , "ciudad:" , OLD.ciudad , ":",NEW.ciudad, ";");
	END IF;

	IF (NEW.tarifa != OLD.tarifa) THEN
		SET @sql = CONCAT(@sql , "tarifa:" , NEW.tarifa , ":",OLD.tarifa, ";");
	END IF;

	IF (NEW.notas != OLD.notas) THEN
		SET @sql = CONCAT(@sql , "notas:" , NEW.notas , ":",OLD.notas, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('incoterm', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA NACIONALIZACION
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_NACIONALIZACION_UPDATE BEFORE UPDATE ON nacionalizacion
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.codigo_nacionalizacion != OLD.codigo_nacionalizacion) THEN
		SET @sql = CONCAT(@sql , "codigo_nacionalizacion:" , OLD.codigo_nacionalizacion , ":",NEW.codigo_nacionalizacion , ";");
	END IF;

	IF (NEW.nro_pedido != OLD.nro_pedido) THEN
		SET @sql = CONCAT(@sql , "nro_pedido:" , OLD.nro_pedido , ":",NEW.nro_pedido, ";");
	END IF;

	IF (NEW.nro_factura_informativa != OLD.nro_factura_informativa) THEN
		SET @sql = CONCAT(@sql , "nro_factura_informativa:" , OLD.nro_factura_informativa , ":",NEW.nro_factura_informativa, ";");
	END IF;

	IF (NEW.moneda != OLD.moneda) THEN
		SET @sql = CONCAT(@sql , "moneda:" , NEW.moneda , ":",OLD.moneda, ";");
	END IF;

	IF (NEW.tipo_cambio != OLD.tipo_cambio) THEN
		SET @sql = CONCAT(@sql , "tipo_cambio:" , OLD.tipo_cambio , ":",NEW.tipo_cambio, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('nacionalizacion', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA PEDIDO
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_PEDIDO_UPDATE BEFORE UPDATE ON pedido
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nro_pedido != OLD.nro_pedido) THEN
		SET @sql = CONCAT(@sql , "nro_pedido:" , OLD.nro_pedido , ":",NEW.nro_pedido , ";");
	END IF;

	IF (NEW.regimen != OLD.regimen) THEN
		SET @sql = CONCAT(@sql , "regimen:" , OLD.regimen , ":",NEW.regimen, ";");
	END IF;

	IF (NEW.nro_referendo != OLD.nro_referendo) THEN
		SET @sql = CONCAT(@sql , "nro_referendo:" , OLD.nro_referendo , ":",NEW.nro_referendo, ";");
	END IF;

	IF (NEW.id_incoterm != OLD.id_incoterm) THEN
		SET @sql = CONCAT(@sql , "id_incoterm:" , NEW.id_incoterm , ":",OLD.id_incoterm, ";");
	END IF;

	IF (NEW.guia_bl != OLD.guia_bl) THEN
		SET @sql = CONCAT(@sql , "guia_bl:" , OLD.guia_bl , ":",NEW.guia_bl, ";");
	END IF;

	IF (NEW.peso_kgs != OLD.peso_kgs) THEN
		SET @sql = CONCAT(@sql , "peso_kgs:" , OLD.peso_kgs , ":",NEW.peso_kgs, ";");
	END IF;

	IF (NEW.costo_pedido != OLD.costo_pedido) THEN
		SET @sql = CONCAT(@sql , "costo_pedido:" , NEW.costo_pedido , ":",OLD.costo_pedido, ";");
	END IF;

	IF (NEW.fele_aduana != OLD.fele_aduana) THEN
		SET @sql = CONCAT(@sql , "fele_aduana:" , OLD.fele_aduana , ":",NEW.fele_aduana, ";");
	END IF;

	IF (NEW.seguro_aduana != OLD.seguro_aduana) THEN
		SET @sql = CONCAT(@sql , "seguro_aduana:" , OLD.seguro_aduana , ":",NEW.seguro_aduana, ";");
	END IF;
	
	IF (NEW.fele_prepagado != OLD.fele_prepagado) THEN
		SET @sql = CONCAT(@sql , "fele_prepagado:" , OLD.fele_prepagado , ":",NEW.fele_prepagado, ";");
	END IF;

	IF (NEW.tarifa_antes_fob != OLD.tarifa_antes_fob) THEN
		SET @sql = CONCAT(@sql , "tarifa_antes_fob:" , OLD.tarifa_antes_fob , ":",NEW.tarifa_antes_fob, ";");
	END IF;

	IF (NEW.fecha_envio != OLD.fecha_envio) THEN
		SET @sql = CONCAT(@sql , "fecha_envio:" , OLD.fecha_envio , ":",NEW.fecha_envio, ";");
	END IF;

	IF (NEW.notas != OLD.notas) THEN
		SET @sql = CONCAT(@sql , "notas:" , OLD.notas , ":",NEW.notas, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('pedido', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA PEDIDO FACTURA
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_PEDUDOFACTURA_PDATE BEFORE UPDATE ON pedido_factura
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nro_pedido != OLD.nro_pedido) THEN
		SET @sql = CONCAT(@sql , "nro_pedido:" , OLD.nro_pedido , ":",NEW.nro_pedido , ";");
	END IF;

	IF (NEW.id_factura_proveedor != OLD.id_factura_proveedor) THEN
		SET @sql = CONCAT(@sql , "id_factura_proveedor:" , OLD.id_factura_proveedor , ":",NEW.id_factura_proveedor , ";");
	END IF;

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , OLD.identificacion_proveedor , ":",NEW.identificacion_proveedor , ";");
	END IF;

	IF (NEW.fecha_emision != OLD.fecha_emision) THEN
		SET @sql = CONCAT(@sql , "fecha_emision:" , OLD.fecha_emision , ":",NEW.fecha_emision , ";");
	END IF;

	IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor , ";");
	END IF;

	IF (NEW.moneda != OLD.moneda) THEN
		SET @sql = CONCAT(@sql , "moneda:" , OLD.moneda , ":",NEW.moneda , ";");
	END IF;

	IF (NEW.tipo_cambio != OLD.tipo_cambio) THEN
		SET @sql = CONCAT(@sql , "tipo_cambio:" , OLD.tipo_cambio , ":",NEW.tipo_cambio , ";");
	END IF;

	IF (NEW.enviado_comtabilidad != OLD.enviado_comtabilidad) THEN
		SET @sql = CONCAT(@sql , "enviado_comtabilidad:" , OLD.enviado_comtabilidad , ":",NEW.enviado_comtabilidad , ";");
	END IF;

	IF (NEW.fecha_envio != OLD.fecha_envio) THEN
		SET @sql = CONCAT(@sql , "fecha_envio:" , OLD.fecha_envio , ":",NEW.fecha_envio , ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('pedido_factura', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA PRODUCTO
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_PRODUCTO_UPDATE BEFORE UPDATE ON producto
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.cod_contable != OLD.cod_contable) THEN
		SET @sql = CONCAT(@sql , "cod_contable:" , OLD.cod_contable , ":",NEW.cod_contable , ";");
	END IF;

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , OLD.identificacion_proveedor , ":",NEW.identificacion_proveedor , ";");
	END IF;

	IF (NEW.cod_ice != OLD.cod_ice) THEN
		SET @sql = CONCAT(@sql , "cod_ice:" , OLD.cod_ice , ":",NEW.cod_ice , ";");
	END IF;

	IF (NEW.nombre != OLD.nombre) THEN
		SET @sql = CONCAT(@sql , "nombre:" , OLD.nombre , ":",NEW.nombre , ";");
	END IF;

	IF (NEW.contenidoml != OLD.contenidoml) THEN
		SET @sql = CONCAT(@sql , "contenidoml:" , OLD.contenidoml , ":",NEW.contenidoml , ";");
	END IF;

	IF (NEW.unidad != OLD.unidad) THEN
		SET @sql = CONCAT(@sql , "unidad:" , OLD.unidad , ":",NEW.unidad , ";");
	END IF;

	IF (NEW.cantidad_unidad != OLD.cantidad_unidad) THEN
		SET @sql = CONCAT(@sql , "cantidad_unidad:" , OLD.cantidad_unidad , ":",NEW.cantidad_unidad , ";");
	END IF;

	IF (NEW.grado_alcoholico != OLD.grado_alcoholico) THEN
		SET @sql = CONCAT(@sql , "grado_alcoholico:" , OLD.grado_alcoholico , ":",NEW.grado_alcoholico , ";");
	END IF;

	IF (NEW.pais_origen != OLD.pais_origen) THEN
		SET @sql = CONCAT(@sql , "pais_origen:" , OLD.pais_origen , ":",NEW.pais_origen , ";");
	END IF;

	IF (NEW.estado != OLD.estado) THEN
		SET @sql = CONCAT(@sql , "estado:" , OLD.estado , ":",NEW.estado , ";");
	END IF;

	IF (NEW.custodia_doble != OLD.custodia_doble) THEN
		SET @sql = CONCAT(@sql , "custodia_doble:" , OLD.custodia_doble , ":",NEW.custodia_doble , ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('producto', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA PROVEEDOR
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_PROVEEDOR_UPDATE BEFORE UPDATE ON proveedor
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nombre != OLD.nombre) THEN
		SET @sql = CONCAT(@sql , "nombre:" , OLD.nombre , ":",NEW.nombre , ";");
	END IF;

	IF (NEW.tipo_provedor != OLD.tipo_provedor) THEN
		SET @sql = CONCAT(@sql , "tipo_provedor:" , OLD.tipo_provedor , ":",NEW.tipo_provedor, ";");
	END IF;

	IF (NEW.categoria != OLD.categoria) THEN
		SET @sql = CONCAT(@sql , "categoria:" , OLD.categoria , ":",NEW.categoria, ";");
	END IF;

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , NEW.identificacion_proveedor , ":",OLD.identificacion_proveedor, ";");
	END IF;

	IF (NEW.notas != OLD.notas) THEN
		SET @sql = CONCAT(@sql , "notas:" , OLD.notas , ":",NEW.notas, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('proveedor', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------



-- ----------------------------------------------------------------------------
-- TABLA tarifacacional
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_TARIFANACIONAL_UPDATE BEFORE UPDATE ON tarifa_nacional
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , OLD.identificacion_proveedor , ":",NEW.identificacion_proveedor , ";");
	END IF;

	IF (NEW.regimen != OLD.regimen) THEN
		SET @sql = CONCAT(@sql , "regimen:" , OLD.regimen , ":",NEW.regimen , ";");
	END IF;

	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto , ";");
	END IF;

	IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor , ";");
	END IF;

	IF (NEW.porcentaje != OLD.porcentaje) THEN
		SET @sql = CONCAT(@sql , "porcentaje:" , OLD.porcentaje , ":",NEW.porcentaje , ";");
	END IF;

	IF (NEW.notas != OLD.notas) THEN
		SET @sql = CONCAT(@sql , "notas:" , OLD.notas , ":",NEW.notas , ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('tarifa_nacional', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- ----------------------------------------------------------------------------
-- TABLA TARIFASIMPUESTOS
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_TARIFASIMPUESTOS_UPDATE BEFORE UPDATE ON tarifas_impuestos 
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto , ";");
	END IF;

	IF (NEW.regimen != OLD.regimen) THEN
		SET @sql = CONCAT(@sql , "regimen:" , OLD.regimen , ":",NEW.regimen , ";");
	END IF;

	IF (NEW.porcentaje != OLD.porcentaje) THEN
		SET @sql = CONCAT(@sql , "porcentaje:" , OLD.porcentaje , ":",NEW.porcentaje , ";");
	END IF;

	IF (NEW.estado != OLD.estado) THEN
		SET @sql = CONCAT(@sql , "estado:" , OLD.estado , ":",NEW.estado , ";");
	END IF;

	IF (NEW.notas != OLD.notas) THEN
		SET @sql = CONCAT(@sql , "notas:" , OLD.notas , ":",NEW.notas , ";");
	END IF;

	IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor , ";");
	END IF;

	
	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('tarifas_impuestos', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- ----------------------------------------------------------------------------
-- TABLA USUARIO
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_USUARIO_UPDATE BEFORE UPDATE ON usuario
FOR EACH ROW 
BEGIN
SET @sql = "";
	IF (NEW.nombres != OLD.nombres) THEN
		SET @sql = CONCAT(@sql , "nombres:" , OLD.nombres , ":",NEW.nombres , ";");
	END IF;

	IF (NEW.email != OLD.email) THEN
		SET @sql = CONCAT(@sql , "email:" , OLD.email , ":",NEW.email , ";");
	END IF;

	IF (NEW.cargo != OLD.cargo) THEN
		SET @sql = CONCAT(@sql , "cargo:" , OLD.cargo , ":",NEW.cargo , ";");
	END IF;

	IF (NEW.username != OLD.username) THEN
		SET @sql = CONCAT(@sql , "username:" , OLD.username , ":",NEW.username , ";");
	END IF;

	IF (NEW.password != OLD.password) THEN
		SET @sql = CONCAT(@sql , "password:" , OLD.password , ":",NEW.password , ";");
	END IF;

	IF (NEW.usertype != OLD.usertype) THEN
		SET @sql = CONCAT(@sql , "usertype:" , OLD.usertype , ":",NEW.usertype , ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`, `datos`, `id_user`) VALUES ('usuario', @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------