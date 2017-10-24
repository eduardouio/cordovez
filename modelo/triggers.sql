/*******************************************************************************
  Copyright 2017 cordovez S.A.
  @autor: Eduardo Villota
  @date: 22-08-2017
  @version 1.0
*******************************************************************************/

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

	IF (NEW.detalle_pedido_factura != OLD.detalle_pedido_factura) THEN
		SET @sql = CONCAT(@sql , "detalle_pedido_factura:" , OLD.detalle_pedido_factura , ":",NEW.detalle_pedido_factura , ";");
	END IF;

	IF (NEW.cod_contable != OLD.cod_contable) THEN
		SET @sql = CONCAT(@sql , "cod_contable:" , OLD.cod_contable , ":",NEW.cod_contable, ";");
	END IF;

	IF (NEW.nro_cajas != OLD.nro_cajas) THEN
		SET @sql = CONCAT(@sql , "nro_cajas:" , OLD.nro_cajas , ":",NEW.nro_cajas, ";");
	END IF;

	IF (NEW.costo_und != OLD.costo_und) THEN
		SET @sql = CONCAT(@sql , "costo_und:" , OLD.costo_und , ":",NEW.costo_und, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('detalle_pedido_factura','UPDATE' , @sql , NEW.id_user);

	END //
DELIMITER ;

-- TRIGGER DE ELIMINACION

DELIMITER //
CREATE TRIGGER TG_DETALLEPEDIDOFACTURA_DELETE BEFORE DELETE ON detalle_pedido_factura
	FOR EACH ROW
		BEGIN
			SET @sql = "";
			SET @sql = CONCAT("id_pedido_factura:" , OLD.id_pedido_factura , ";",
												"detalle_pedido_factura:" , OLD.detalle_pedido_factura , ";",
												"cod_contable:" , OLD.cod_contable , ";",
												"nro_cajas:" , OLD.nro_cajas , ";",
												"costo_und:",OLD.costo_und
											);
			INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('detalle_pedido_factura','DELETE' , @sql , OLD.id_user);
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

	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , OLD.identificacion_proveedor , ":",NEW.identificacion_proveedor, ";");
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

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_informativa','UPDATE' , @sql , NEW.id_user);
	END //

DELIMITER ;

-- TRIGGER ELIMINACION

DELIMITER //
	CREATE TRIGGER TG_FACTURAINFORMATIVA_DELETE BEFORE DELETE ON factura_informativa
	FOR EACH ROW
	BEGIN
		SET @sql = "";
		SET @sql = CONCAT("nro_factura_informativa:" , OLD.nro_factura_informativa , ";",
 											"nro_pedido:" , OLD.nro_pedido, ";",
 											"identificacion_proveedor:" ,OLD.identificacion_proveedor, ";",
 											"fele_aduana:" , OLD.fele_aduana , ";",
 											"seguro_aduana:" , OLD.seguro_aduana , ";",
 											"moneda:" , OLD.moneda , ";",
 											"tipo_cambio:" , OLD.tipo_cambio);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_informativa','DELETE' , @sql , OLD.id_user);
	END//
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



	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_informativa_detalle','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------

-- TRIGGER DELETE

DELIMITER //

CREATE TRIGGER TG_FACTURAINFORMATIVADETALLE_DELETE BEFORE DELETE ON factura_informativa_detalle
	FOR EACH ROW
		BEGIN
			SET @sql = "";
			SET @sql = CONCAT("nro_factura_informativa:" , OLD.nro_factura_informativa , ";" ,
												"cod_contable:" , OLD.cod_contable , ";",
												"nro_cajas:" , OLD.nro_cajas );

			INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_informativa_detalle','DELETE' , @sql , OLD.id_user);
		END//

DELIMITER ;


-- -----------------------------------------------------------------------------
-- TABLA FACTURA PAGOS
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_FACTURA_PAGOS_UPDATE BEFORE UPDATE ON factura_pagos
	FOR EACH ROW
		BEGIN
			SET @sql = "";
			IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
				SET @sql = CONCAT(@sql, "identificacion_proveedor:" , OLD.identificacion_proveedor , ":", NEW.identificacion_proveedor,";");
			END IF;

			IF (NEW.nro_factura != OLD.nro_factura) THEN
				SET @sql = CONCAT(@sql, "nro_factura:" , OLD.nro_factura , ":", NEW.nro_factura,";");
			END IF;

			IF (NEW.fecha_emision != OLD.fecha_emision) THEN
				SET @sql = CONCAT(@sql, "fecha_emision:" , OLD.fecha_emision , ":", NEW.fecha_emision,";");
			END IF;

			IF (NEW.valor != OLD.valor) THEN
				SET @sql = CONCAT(@sql, "valor:" , OLD.valor , ":", NEW.valor,";");
			END IF;

			IF (NEW.saldo != OLD.saldo) THEN
				SET @sql = CONCAT(@sql, "saldo:" , OLD.saldo , ":", NEW.saldo,";");
			END IF;

			IF (NEW.comentarios != OLD.comentarios) THEN
				SET @sql = CONCAT(@sql, "comentarios:" , OLD.comentarios , ":", NEW.comentarios,";");
			END IF;

			INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos','UPDATE' , @sql , NEW.id_user);
		END//

DELIMITER ;

-- TRIGGER DE ELIMINACION

DELIMITER //
CREATE TRIGGER TG_FACTURA_PAGOS_DELETE BEFORE DELETE ON factura_pagos
	FOR EACH ROW
		BEGIN
		SET @sql = "";
		SET @sql = CONCAT("identificacion_proveedor:" , OLD.identificacion_proveedor , ";",
		 									"nro_factura:" , OLD.nro_factura , ";",
		 									"fecha_emision:" , OLD.fecha_emision , ";",
		 									"valor:" , OLD.valor , ";",
		 									"saldo:" , OLD.saldo , ";",
		 									"comentarios:" , OLD.comentarios);
		INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos','DELETE' , @sql , OLD.id_user);
		END//
DELIMITER ;


-- -----------------------------------------------------------------------------
-- TABLA PAGOS PEDIDO
-- -----------------------------------------------------------------------------
DELIMITER //
CREATE TRIGGER TG_FACTURA_PAGOS_PEDIDO_UPDATE BEFORE UPDATE ON factura_pagos_pedido
FOR EACH ROW
BEGIN
SET @sql = "";

IF(NEW.nro_pedido != OLD.nro_pedido)THEN
	SET @sql = CONCAT(@sql, "nro_pedido:" , OLD.nro_pedido , ":", NEW.nro_pedido,";");
END IF;
IF(NEW.id_factura_pagos != OLD.id_factura_pagos)THEN
	SET @sql = CONCAT(@sql, "id_factura_pagos:" , OLD.id_factura_pagos , ":", NEW.id_factura_pagos,";");
END IF;
IF(NEW.valor != OLD.valor)THEN
	SET @sql = CONCAT(@sql, "valor:" , OLD.valor , ":", NEW.valor,";");
END IF;
IF(NEW.concepto != OLD.concepto)THEN
	SET @sql = CONCAT(@sql, "concepto:" , OLD.concepto , ":", NEW.concepto,";");
END IF;
IF(NEW.fecha_inicio != OLD.fecha_inicio)THEN
	SET @sql = CONCAT(@sql, "fecha_inicio:" , OLD.fecha_inicio , ":", NEW.fecha_inicio,";");
END IF;
IF(NEW.fecha_fin != OLD.fecha_fin)THEN
	SET @sql = CONCAT(@sql, "fecha_fin:" , OLD.fecha_fin , ":", NEW.fecha_fin,";");
END IF;


INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos_pedido','UPDATE' , @sql , NEW.id_user);
END//
DELIMITER ;

-- TRIGER DE ELIMINACION

DELIMITER //
CREATE TRIGGER TG_FACTURA_PAGOS_PEDIDO_DELETE BEFORE DELETE ON factura_pagos_pedido
FOR EACH ROW
BEGIN
SET @sql = "";
SET @sql = CONCAT (	"nro_pedido:", OLD.nro_pedido,";",
										"id_factura_pagos:", OLD.id_factura_pagos,";",
										"valor:", OLD.valor,";",
										"concepto:", OLD.concepto,";",
										"fecha_inicio:", OLD.fecha_inicio,";",
										"fecha_fin:", OLD.fecha_fin
									);

INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos_pedido','DELETE' , @sql , OLD.id_user);
END//
DELIMITER ;

-- -----------------------------------------------------------------------------
-- TABLA FACTURA PAGOS PEDIDO GASTO INICAL R70
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_FACTURAS_PAGOS_GAS_INICIAL_R70_UPDATE BEFORE UPDATE ON factura_pagos_pedido_gasto_inicial_r70
FOR EACH ROW
	BEGIN
		SET @sql = "";

		IF (NEW.id_gastos_iniciales != OLD.id_gastos_iniciales) THEN
			SET @sql = CONCAT(@sql, "id_gastos_iniciales:", OLD.id_gastos_iniciales, ":" , NEW.id_gastos_iniciales,";");
		END IF;
		IF (NEW.id_factura_pagos != OLD.id_factura_pagos) THEN
			SET @sql = CONCAT(@sql, "id_factura_pagos:", OLD.id_factura_pagos, ":" , NEW.id_factura_pagos,";");
		END IF;
		IF (NEW.valor != OLD.valor) THEN
			SET @sql = CONCAT(@sql, "valor:", OLD.valor, ":" , NEW.valor,";");
		END IF;

		INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos_pedido_gasto_inicial_r70','UPDATE' , @sql , NEW.id_user);
	END//
DELIMITER ;

-- TRIGER ELIMINACION

DELIMITER //
CREATE TRIGGER TG_FACTURAS_PAGOS_GAS_INICIAL_R70_DELETE BEFORE DELETE ON factura_pagos_pedido_gasto_inicial_r70
FOR EACH ROW
	BEGIN
	SET @sql = "";
	SET @sql = CONCAT("id_gastos_iniciales:" , OLD.id_gastos_iniciales,";",
										"id_factura_pagos:" , OLD.id_factura_pagos,";",
										"valor:" , OLD.valor
									);

		INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos_pedido_gasto_inicial_r70','DELETE' , @sql , OLD.id_user);
	END//
DELIMITER ;


-- -----------------------------------------------------------------------------
-- TABLA FACTURA PAGOS PEDIDO NACIONALIZACION
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_FATURA_PAGO_PEDIDO_GASTONACIONALIZACION_UPDATE BEFORE UPDATE ON factura_pagos_pedido_gasto_nacionalizacion
FOR EACH ROW
BEGIN
SET @sql = "";

	IF(NEW.id_gastos_iniciales != OLD.id_gastos_iniciales) THEN
		SET @sql = CONCAT(@sql, "id_gastos_iniciales:",OLD.id_gastos_iniciales,":", NEW.id_gastos_iniciales,";");
	END IF;
	IF(NEW.id_factura_pagos != OLD.id_factura_pagos) THEN
		SET @sql = CONCAT(@sql, "id_factura_pagos:",OLD.id_factura_pagos,":", NEW.id_factura_pagos,";");
	END IF;
	IF(NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql, "valor:",OLD.valor,":", NEW.valor,";");
	END IF;

INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos_pedido_gasto_nacionalizacion','UPDATE' , @sql , NEW.id_user);
END//
DELIMITER ;

--TRIGER ELIMINACION

DELIMITER //
CREATE TRIGGER TG_FATURA_PAGO_PEDIDO_GASTONACIONALIZACION_DELETE BEFORE DELETE ON factura_pagos_pedido_gasto_nacionalizacion
FOR EACH ROW
BEGIN
	SET @sql = "";
	SET @sql = CONCAT("id_gastos_iniciales:", OLD.id_gastos_iniciales,";",
										"id_factura_pagos:", OLD.id_factura_pagos,";",
										"valor:", OLD.valor
									);

INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('factura_pagos_pedido_gasto_nacionalizacion','DELETE' , @sql , OLD.id_user);
END//
DELIMITER ;

-- -----------------------------------------------------------------------------
-- TABLA GASTOS INICIALES
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_GASTOSINICIALESR70_UPDATE BEFORE UPDATE ON gastos_iniciales_r70
FOR EACH ROW
BEGIN
SET @sql = "";
	IF (NEW.nro_pedido != OLD.nro_pedido) THEN
		SET @sql = CONCAT(@sql , "nro_pedido:" , OLD.nro_pedido , ":",NEW.nro_pedido , ";");
	END IF;

	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto, ";");
	END IF;

	IF (NEW.valor_provisionado != OLD.valor_provisionado) THEN
		SET @sql = CONCAT(@sql , "valor_provisionado:" , OLD.valor_provisionado , ":",NEW.valor_provisionado, ";");
	END IF;

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('gastos_iniciales_r70','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------

-- TRIGGER DELETE
DELIMITER //
CREATE TRIGGER TG_GASTOSINICIALESR70_DELETE BEFORE DELETE ON gastos_iniciales_r70
FOR EACH ROW
BEGIN
	SET @sql = "";
	SET @sql = CONCAT("nro_pedido:",OLD.nro_pedido,";",
										"concepto:",OLD.concepto,";",
										"valor_provisionado:",OLD.valor_provisionado,";",
										"comentarios:",OLD.comentarios
									);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('gastos_iniciales_r70','DELETE' , @sql , OLD.id_user);
END //
DELIMITER ;


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

	IF (NEW.concepto != OLD.concepto) THEN
		SET @sql = CONCAT(@sql , "concepto:" , OLD.concepto , ":",NEW.concepto, ";");
	END IF;

	IF (NEW.nro_factura != OLD.nro_factura) THEN
		SET @sql = CONCAT(@sql , "nro_factura:" , OLD.nro_factura , ":",NEW.nro_factura, ";");
	END IF;

		IF (NEW.valor_provisionado != OLD.valor_provisionado) THEN
		SET @sql = CONCAT(@sql , "valor_provisionado:" , OLD.valor_provisionado , ":",NEW.valor_provisionado, ";");
	END IF;

		IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('gastos_nacionalizacion','UPDATE' , @sql , NEW.id_user);

	END //
DELIMITER ;
-- -----------------------------------------------------------------------------

-- TRIGGER DE ELIMINACION

DELIMITER //
CREATE TRIGGER TG_GASTOSNACIONALIZACION_DELETE BEFORE DELETE ON gastos_nacionalizacion
FOR EACH ROW
BEGIN
		SET @sql = "";
		SET @sql = CONCAT("codigo_nacionalizacion:", OLD.codigo_nacionalizacion,";",
											"concepto:", OLD.concepto,";",
											"nro_factura:", OLD.nro_factura,";",
											"valor_provisionado:", OLD.valor_provisionado,";",
											"comentarios:", OLD.comentarios
											);
INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('gastos_nacionalizacion','DELETE' , @sql , OLD.id_user);
END //
DELIMITER ;

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

	IF (NEW.valor_provisionado != OLD.valor_provisionado) THEN
		SET @sql = CONCAT(@sql , "valor_provisionado:" , OLD.valor_provisionado , ":",NEW.valor_provisionado, ";");
	END IF;

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('impuestos_nacionalizacion','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_IMPUESTOSNACIONALIZACION_DELETE BEFORE DELETE ON impuestos_nacionalizacion
FOR EACH ROW
BEGIN
	SET @sql = "";
	SET @sql = CONCAT("id_nacionalizacion:" , OLD.id_nacionalizacion,";",
										"concepto:" , OLD.concepto,";",
										"valor_provisionado:" , OLD.valor_provisionado,";",
										"comentarios:" , OLD.comentarios
									);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('impuestos_nacionalizacion','DELETE' , @sql , OLD.id_user);

END //

DELIMITER ;
-- -----------------------------------------------------------------------------
-- TABLA IMPUESTOS DE INCOTERM
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_INCOTERM_UPDATE BEFORE UPDATE ON incoterm_provicion_internacional
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

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , NEW.comentarios , ":",OLD.comentarios, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('incoterm_provicion_internacional','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------

--- TRIGGER DE ELIMINACION
DELIMITER //
CREATE TRIGGER TG_INCOTERM_DELETE BEFORE DELETE ON incoterm_provicion_internacional
FOR EACH ROW
BEGIN
	SET @sql = "";
		SET @sql = CONCAT(
			"tipo:", OLD.tipo, ";",
			"pais:", OLD.pais, ";",
			"incoterms:", OLD.incoterms, ";",
			"ciudad:", OLD.ciudad, ";",
			"tarifa:", OLD.tarifa, ";",
			"comentarios:", OLD.comentarios
		);

INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('incoterm_provicion_internacional','DELETE' , @sql , OLD.id_user);

END //

DELIMITER ;

-- -----------------------------------------------------------------------------
-- TABLA LIQUIDACION IMPUESTOS
-- -----------------------------------------------------------------------------
DELIMITER //
CREATE TRIGGER TG_LIQUIDACION_IMPUESTOS_UPDATE BEFORE UPDATE ON liquidacion_impuestos
FOR EACH ROW
BEGIN
	SET @sql = "";

	IF(NEW.id_impuestos != OLD.id_impuestos) THEN
		SET @sql = CONCAT(@sql, "id_impuestos:", OLD.id_impuestos, ";" , NEW.id_impuestos,";");
	END IF;
	IF(NEW.nro_documento != OLD.nro_documento) THEN
		SET @sql = CONCAT(@sql, "nro_documento:", OLD.nro_documento, ";" , NEW.nro_documento,";");
	END IF;
	IF(NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql, "valor:", OLD.valor, ";" , NEW.valor,";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('liquidacion_impuestos','UPDATE' , @sql , NEW.id_user);
END//
DELIMITER ;

-- TRIGGER DE ELIMINACION
DELIMITER //
CREATE TRIGGER TG_LIQUIDACION_IMPUESTOS_DELETE BEFORE DELETE ON liquidacion_impuestos
FOR EACH ROW
BEGIN
	SET @sql = "";

	SET @sql = CONCAT(
										"id_impuestos:" , OLD.id_impuestos , ";",
										"nro_documento:" , OLD.nro_documento , ";",
										"valor:" , OLD.valor
										);

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('liquidacion_impuestos','DELETE' , @sql , OLD.id_user);
END //
DELIMITER ;

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

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('nacionalizacion','UPDATE' , @sql , NEW.id_user);

	END //
DELIMITER ;
-- -----------------------------------------------------------------------------

-- TRIGER DE ELIMINACION

DELIMITER //
CREATE TRIGGER TG_NACIONALIZACION_DELETE BEFORE DELETE ON nacionalizacion
FOR EACH ROW
BEGIN
	SET @sql = "";
	SET @sql = CONCAT("codigo_nacionalizacion:" , OLD.codigo_nacionalizacion , ";",
										"nro_pedido:" , OLD.nro_pedido , ";",
										"nro_factura_informativa:" , OLD.nro_factura_informativa , ";",
										"moneda:" , OLD.moneda , ";",
										"tipo_cambio:" , OLD.tipo_cambio
									);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('nacionalizacion','DELETE' , @sql , OLD.id_user);

END //
DELIMITER ;

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

	IF (NEW.fele_aduana != OLD.fele_aduana) THEN
		SET @sql = CONCAT(@sql , "fele_aduana:" , OLD.fele_aduana , ":",NEW.fele_aduana, ";");
	END IF;

	IF (NEW.seguro_aduana != OLD.seguro_aduana) THEN
		SET @sql = CONCAT(@sql , "seguro_aduana:" , OLD.seguro_aduana , ":",NEW.seguro_aduana, ";");
	END IF;

	IF (NEW.estado_pedido != OLD.estado_pedido) THEN
		SET @sql = CONCAT(@sql , "estado_pedido:" , OLD.estado_pedido , ":",NEW.estado_pedido, ";");
	END IF;

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios, ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('pedido','UPDATE' , @sql , NEW.id_user);

	END //
DELIMITER ;


-- TRIGER de ELIMINACION
DELIMITER //
CREATE TRIGGER TG_PEDIDO_DELETE BEFORE DELETE ON pedido
FOR EACH ROW
BEGIN
SET @sql = "";

	SET @sql = CONCAT("nro_pedido:" , OLD.nro_pedido , ";",
										"regimen:" , OLD.regimen , ";",
										"nro_referendo:" , OLD.nro_referendo , ";",
										"id_incoterm:" , OLD.id_incoterm , ";",
										"fele_aduana:" , OLD.fele_aduana , ";",
										"seguro_aduana:" , OLD.seguro_aduana , ";",
										"estado_pedido:" , OLD.estado_pedido , ";",
										"comentarios:" , OLD.comentarios
										);

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('pedido','DELETE' , @sql , OLD.id_user);
	END //

DELIMITER ;
-- -----------------------------------------------------------------------------


-- -----------------------------------------------------------------------------
-- TABLA PEDIDO FACTURA
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_PEDUDOFACTURA_UPDATE BEFORE UPDATE ON pedido_factura
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

	IF (NEW.vencimiento_pago != OLD.vencimiento_pago) THEN
		SET @sql = CONCAT(@sql , "vencimiento_pago:" , OLD.vencimiento_pago , ":",NEW.vencimiento_pago , ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('pedido_factura','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;

-- TRIGGERS de ELIMINACION

DELIMITER //
CREATE TRIGGER TG_PEDUDOFACTURA_DELTE BEFORE DELETE ON pedido_factura
FOR EACH ROW
BEGIN
SET @sql = "";
	SET @sql = CONCAT("nro_pedido:" , OLD.nro_pedido , ";",
										"id_factura_proveedor:" , OLD.id_factura_proveedor , ";",
										"identificacion_proveedor:" , OLD.identificacion_proveedor , ";",
										"fecha_emision:" , OLD.fecha_emision , ";",
										"valor:" , OLD.valor , ";",
										"moneda:" , OLD.moneda , ";",
										"tipo_cambio:" , OLD.tipo_cambio , ";",
										"vencimiento_pago:" , OLD.vencimiento_pago
									);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('pedido_factura','DELETE' , @sql , OLD.id_user);
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

	IF (NEW.capacidad_ml != OLD.capacidad_ml) THEN
		SET @sql = CONCAT(@sql , "capacidad_ml:" , OLD.capacidad_ml , ":",NEW.capacidad_ml , ";");
	END IF;

	IF (NEW.cantidad_x_caja != OLD.cantidad_x_caja) THEN
		SET @sql = CONCAT(@sql , "cantidad_x_caja:" , OLD.cantidad_x_caja , ":",NEW.cantidad_x_caja , ";");
	END IF;

	IF (NEW.grado_alcoholico != OLD.grado_alcoholico) THEN
		SET @sql = CONCAT(@sql , "grado_alcoholico:" , OLD.grado_alcoholico , ":",NEW.grado_alcoholico , ";");
	END IF;

	IF (NEW.costo_unidad != OLD.costo_unidad) THEN
		SET @sql = CONCAT(@sql , "costo_unidad:" , OLD.costo_unidad , ":",NEW.costo_unidad , ";");
	END IF;

	IF (NEW.estado != OLD.estado) THEN
		SET @sql = CONCAT(@sql , "estado:" , OLD.estado , ":",NEW.estado , ";");
	END IF;

	IF (NEW.custodia_doble != OLD.custodia_doble) THEN
		SET @sql = CONCAT(@sql , "custodia_doble:" , OLD.custodia_doble , ":",NEW.custodia_doble , ";");
	END IF;

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios , ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('producto','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;
-- -----------------------------------------------------------------------------
-- TREIGGER DE ELIMINACION
DELIMITER //
CREATE TRIGGER TG_PRODUCTO_DELETE BEFORE DELETE ON producto
FOR EACH ROW
BEGIN
SET @sql = "";
SET @sql = CONCAT("cod_contable:" , OLD.cod_contable , ";" ,
									"identificacion_proveedor:" , OLD.identificacion_proveedor , ";" ,
									"cod_ice:" , OLD.cod_ice , ";" ,
									"nombre:" , OLD.nombre , ";" ,
									"capacidad_ml:" , OLD.capacidad_ml , ";" ,
									"cantidad_x_caja:" , OLD.cantidad_x_caja , ";" ,
									"grado_alcoholico:" , OLD.grado_alcoholico , ";" ,
									"costo_unidad:" , OLD.costo_unidad , ";" ,
									"estado:" , OLD.estado , ";" ,
									"custodia_doble:" , OLD.custodia_doble , ";" ,
									"comentarios:" , OLD.comentarios
							);

INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('producto','DELETE' , @sql , OLD.id_user);
END //

DELIMITER ;
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

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios, ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('proveedor','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;


-- TRIGGER DE ELIMINACION
DELIMITER //
CREATE TRIGGER TG_PROVEEDOR_DELETE BEFORE DELETE ON proveedor
FOR EACH ROW
BEGIN
SET @sql = "";
SET @sql = CONCAT("nombre:" , OLD.nombre , ";",
									"tipo_provedor:" , OLD.tipo_provedor , ";",
									"categoria:" , OLD.categoria , ";",
									"identificacion_proveedor:" , OLD.identificacion_proveedor , ";",
									"comentarios:" , OLD.comentarios
								);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('proveedor','DELETE' , @sql , OLD.id_user);

	END //
DELIMITER ;

-- -----------------------------------------------------------------------------



-- ----------------------------------------------------------------------------
-- TABLA tarifacacional
-- -----------------------------------------------------------------------------

DELIMITER //
CREATE TRIGGER TG_TARIFAPROVICIONNACIONAL_UPDATE BEFORE UPDATE ON tarifa_provicion_nacional
FOR EACH ROW
BEGIN
SET @sql = "";
	IF (NEW.identificacion_proveedor != OLD.identificacion_proveedor) THEN
		SET @sql = CONCAT(@sql , "identificacion_proveedor:" , OLD.identificacion_proveedor , ":",NEW.identificacion_proveedor , ";");
	END IF;

	IF (NEW.regimen != OLD.regimen) THEN
		SET @sql = CONCAT(@sql , "regimen:" , OLD.regimen , ":",NEW.regimen , ";");
	END IF;

	IF (NEW.tipo_provicion != OLD.tipo_provicion) THEN
		SET @sql = CONCAT(@sql , "tipo_provicion:" , OLD.tipo_provicion , ":",NEW.tipo_provicion , ";");
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

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios , ";");
	END IF;

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('tarifa_provicion_nacional','UPDATE' , @sql , NEW.id_user);
	END //
DELIMITER ;

-- TRIGGER DE ELIMINACION

DELIMITER //
CREATE TRIGGER TG_TARIFAPROVICIONNACIONAL_DELETE BEFORE DELETE ON tarifa_provicion_nacional
FOR EACH ROW
BEGIN
SET @sql = "";
	SET @sql = CONCAT("identificacion_proveedor:" , OLD.identificacion_proveedor, ";",
										"regimen:" , OLD.regimen, ";",
										"tipo_provicion:" , OLD.tipo_provicion, ";",
										"concepto:" , OLD.concepto, ";",
										"valor:" , OLD.valor, ";",
										"porcentaje:" , OLD.porcentaje, ";",
										"comentarios:" , OLD.comentarios
									);

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('tarifa_provicion_nacional','DELETE' , @sql , OLD.id_user);
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

	IF (NEW.comentarios != OLD.comentarios) THEN
		SET @sql = CONCAT(@sql , "comentarios:" , OLD.comentarios , ":",NEW.comentarios , ";");
	END IF;

	IF (NEW.valor != OLD.valor) THEN
		SET @sql = CONCAT(@sql , "valor:" , OLD.valor , ":",NEW.valor , ";");
	END IF;


	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('tarifas_impuestos','UPDATE' , @sql , NEW.id_user);

	END //

DELIMITER ;

-- TRIGGER DE ELIMINACION
DELIMITER //
CREATE TRIGGER TG_TARIFASIMPUESTOS_DELETE BEFORE DELETE ON tarifas_impuestos
FOR EACH ROW
BEGIN
SET @sql = "";
SET @sql = CONCAT("concepto:" , OLD.concepto , ";",
									"regimen:" , OLD.regimen , ";",
									"porcentaje:" , OLD.porcentaje , ";",
									"estado:" , OLD.estado , ";",
									"comentarios:" , OLD.comentarios , ";",
									"valor:" , OLD.valor
									);
	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('tarifas_impuestos','DELETE' , @sql , OLD.id_user);
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

	INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('usuario','UPDATE' , @sql , NEW.id_user);

	END //
DELIMITER ;
-- -----------------------------------------------------------------------------

-- --- TRIGGERS DE ELIMINACION DE USUARIO
DELIMITER //
CREATE TRIGGER TG_USUARIO_DELETE BEFORE DELETE ON usuario
FOR EACH ROW
BEGIN
SET @sql = "";
SET @sql = CONCAT("id_user:" , OLD.id_user , ";",
									"nombres:" , OLD.nombres , ";",
									"email:" , OLD.email , ";",
									"cargo:" , OLD.cargo , ";",
									"username:" , OLD.username , ";",
									"password:" , OLD.password , ";",
									"usertype:" , OLD.usertype
								);
INSERT INTO `seguimiento`( `tabla`,`accion` ,`datos`, `id_user`) VALUES ('usuario','DELETE' , @sql , OLD.id_user);
	END //
DELIMITER ;
-- -----------------------------------------------------------------------------
